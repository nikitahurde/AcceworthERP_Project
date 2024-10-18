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
 .alignLeftClass{
    text-align: left;
  }
  .alignRightClass{
    text-align: right;
  }
  .alignCenterClass{
    text-align: center;
  }
.showmsg{
    display: none;
  }


</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

             Transporter Bill Posting

            <small> Transporter Bill Posting Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Fleet</a></li>

            <li class="active"><a href="{{ url('/logistic/trpt-bill-generate') }}">Transporter Bill Posting</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Transporter Bill Posting</h2>

              <!-- <div class="box-tools pull-right">

                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

              </div> -->



            </div><!-- /.box-header -->

            <div class="box-body">

             <form id="myForm">



               @csrf




              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                      <label for="exampleInputEmail1">From Date : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                            <input type="text" name="TR_DATE" id="transDate" class="form-control datepicker" placeholder="Select Date" value="{{ date('d-m-Y') }}">

                      </div>

                     <small id="show_err_trans_date">

                        

                     </small>

                  </div>

                </div><!-- /.col -->
                
                <div class="col-md-2">

                  <div class="form-group">

                      <label for="exampleInputEmail1">To Date : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                            <input type="text" name="to_date" id="to_date" class="form-control datepicker" placeholder="Select Date" value="">

                      </div>

                     <small id="show_err_trans_date">

                        

                     </small>

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Vehicle No : <span class="required-field"></span></label>

                      <div class="input-group">

                            <input list="vehicleList" name="vehicle_no" id="vehicle_no" class="form-control" placeholder="Vehicle No" value="">

                            <datalist id="vehicleList">

                              <?php foreach ($vehicle_list as $key) { ?>

                                 <option value="<?= $key->TRUCK_NO ?>"><?= $key->TRUCK_NO ?></option>
                                  
                              <?php } ?>
                             
                            </datalist>

                      </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Account Code : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>



                           <input list="accountList" id="acct_code" name="acct_code" class="form-control  pull-left" value="{{ old('acct_code')}}" placeholder="Select Account Code" >



                          <datalist id="accountList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($acc_list as $key)

                            
 
                            <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                            

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

                

                <div class="col-md-3" style="margin-top: 1%;">

                    <div class="">

               <button type="button" class="btn btn-primary btn-sm" name="searchdata" id="btnsearch" value="btnsearch" style="padding:2px 8px;"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                <button type="button" class="btn btn-default btn-sm" name="searchdata" id="ResetId" style="padding:2px 8px;"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

               </div>

                </div>

              </div>

              



               

             </form>

            </div><!-- /.box-body -->


  <div class="alert alert-success alert-dismissible showmsg" id="showwhen" style="width: 96%;margin-left: 2%;">

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

        <h4>

        <i class="icon fa fa-check"></i>

        Success...!

        </h4>

         Party Bill Was Added Successfully...!

  </div>



            <div class="box-body">

<table id="PartyBillManage" class="table table-bordered table-striped table-hover billgenerate">

  <thead class="theadC">

    

    <tr>

      <th class="text-center">Sr. No. </th>

      <th class="text-center">L R No </th>

      <th class="text-center">Date</th>

      <th class="text-center">Depot/Plant </th>

      <th class="text-center">Area</th>

      <th class="text-center">Truck No</th>

      <th class="text-center">Qty</th>

      <th class="text-center">Material</th>

      <th class="text-center">LR Received Date</th>

      <th class="text-center">Bill No</th>

      <th class="text-center">Rate</th>


    </tr>

  </thead>

  <tbody id="defualtSearch">

    

  </tbody>

  

</table>




</div><!-- /.box-body -->

           

</div>

<div style="text-align:center;">
<button type="submit" name="submit" value="submit" align="center" id="submitinparty" class='btn btn-success'>submit</button> 

</div>

  </section>

</div>





@include('admin.include.footer')

<script type="text/javascript">
  
</script>

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




    });



</script>
<script type="text/javascript">
  $(document).ready(function(){
   $('.billgenerate').DataTable({
            "scrollX": true
        });
    });
</script>
<script type="text/javascript">

  $(document).ready(function(){

   // load_data();

        function load_data(acct_code=''){


          $('#PartyBillManage').DataTable({

              
              processing: true,
              serverSide: true,
              scrollX: true,
              dom : 'Bfrtip',
              buttons: [
                        'excelHtml5'
                        ],
              columnDefs: [

                            { "width": "10%", "targets": 0, "className": "alignLeftClass"},

                            { "width": "10%", "targets": 1, "className": "alignLeftClass"},

                            { "width": "10%", "targets": 2, "className": "alignLeftClass"},

                            { "width": "10%", "targets": 3, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 4, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 5, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 6, "className": "alignRightClass" },

                            { "width": "10%", "targets": 7, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 8, "className": "alignLeftClass" },
                            { "width": "10%", "targets": 9, "className": "alignLeftClass" },
                            { "width": "10%", "targets": 10, "className": "alignLeftClass" },
                            { "width": "10%", "targets": 11, "className": "alignLeftClass" },

                          ],
              ajax:{
                url:'{{ url("/logistic/trpt-bill-generate") }}',
                data: {acct_code:acct_code}
              },
              columns: [


                {
                    data:'DT_RowIndex',
                    'render': function (data, type, full, meta){
                         return '<input type="checkbox" name="flit_id[]" class="flitClass" value="'+full['id'] + '">';
                     }
                },
                {
                    data:'LR_NO',
                    name:'LR_NO'
                },
                {
                    data:'LR_DATE',
                    render: function (data) {
        var date = new Date(data);
        var month = date.getMonth() + 1;
        return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
    }
                },
                {
                    data:'VEHICLE_NO',
                    name:'VEHICLE_NO'
                },
                {
                    data:'TO_PLACE',
                    name:'TO_PLACE'
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
                    data:'FSO_RATE',
                    name:'FSO_RATE'
                },
                {
                    data:'FSO_QTY',
                    name:'FSO_QTY'
                },
                {
                    data:'FPO_NO',
                    name:'FPO_NO'
                },
                {
                    data:'AMOUNT',
                    name:'AMOUNT'
                },
                
                

              ]


          });


       }


       $('#btnsearch').click(function(){
        
          var acct_code =  $('#acct_code').val();
        //  console.log(transDate);

          if (acct_code!='') {

            $('#show_err_acct_code').html('');

            $('#PartyBillManage').DataTable().destroy();
            load_data(acct_code);

          }else{

           //  $('#show_err_trans_date').html('Please select Date').css('color','red');
             $('#show_err_acct_code').html('Please Enter Transporter').css('color','red');
          }

        });


       $('#ResetId').click(function(){

              
              $('#chalanno').val('');
              $('#transDate').val('');

          document.getElementById("accountText").innerHTML = '';
          $('#PartyBillManage').DataTable().destroy();
         // load_data();

         $('.billgenerate').DataTable({
                          
         });

        });




  });


</script>

<script type="text/javascript">

$(document).ready(function(){
    $('#submitinparty').on("click", function (){

         var flitClass=[];

        $('.flitClass').each(function(){
            if($(this).is(":checked"))
            {
             var flitClass1 = $(this).val();
             flitClass.push(flitClass1);
             
             }
        });


         
       // flitClass = flitClass.toString();

        //console.log('data=> ',flitClass);

        var transDate = $('#transDate').val();
        var bill_no = $('#bill_no').val();
        //console.log(dateTr);
        $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        $.ajax({

          url:"{{ url('save-party-bil') }}",

           method : "POST",

           type: "JSON",

           data: {flitClass: flitClass,transDate:transDate,bill_no:bill_no},

           
           success:function(data){
           // console.log(data.length);
              var data1 = JSON.parse(data);

              var msg = data1.message;
              var party = data1.party;


              var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

                 var regex = /\s+/gi;
                 var wordCount = msg.trim().replace(regex, ' ').split(' ').length;

              if(msg == 'Success'){

                
                  window.location.href = "send-mail-for-party-bil/"+Base64.encode(party);
                     
                  $('#showwhen').removeClass('showmsg');
                  //return false;

                
              }
           }

        });

       });

  });
</script>


<script type="text/javascript">

$(document).ready(function() {
    $('#submitinparty11').on('click',function(){
      
      
      
      $('.flitClass:checkbox:checked').each(function(){
        var flitClass = $(this).val();
        var transDate = $('#transDate').val();
        var bill_no = $('#bill_no').val();
        //console.log(dateTr);
        $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        $.ajax({

          url:"{{ url('save-party-bil') }}",

           method : "POST",

           type: "JSON",

           data: {flitClass: flitClass,transDate:transDate,bill_no:bill_no},

           
           success:function(data){
            //console.log(data.length);
              var data1 = JSON.parse(data);

              var msg = data1.message;
              var party = data1.party;


              var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

                 var regex = /\s+/gi;
                 var wordCount = msg.trim().replace(regex, ' ').split(' ').length;

              if(wordCount == '1'){

                
                  window.location.href = "send-mail-for-party-bil/"+Base64.encode(party);
                     
                  $('#showwhen').removeClass('showmsg');
                  return false;

                
              }
           }

        });
      });
     
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
      //endDate : 'today'
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