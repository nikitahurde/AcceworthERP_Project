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



         Manage Fleet Challan Receipt



            <small> Manage Fleet Challan Receipt</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Fleet</a></li>



            <li class="active"><a href="{{ url('/fleet-challan-receipt') }}"> Fleet Challan Receipt</a></li>



          </ol>



        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Manage Fleet Challan Receipt</h2>



              <!-- <div class="box-tools pull-right">



                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>



              </div> -->

            </div><!-- /.box-header -->

            <div class="box-body">

             <form id="myForm">
             @csrf

              <div class="row">


                
                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Date: </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                    <input  id="date" name="date" class="form-control datepicker" value="{{ date('d-m-Y') }}" >
                         

                      </div>


                    

                  </div>



                </div>
                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Challan No: </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                           <input id="challan_no" name="challan_no" class="form-control"  placeholder="Enter Challan No" >
                          

                      </div>



                        <small>  
                        
                        <div class="pull-left showSeletedName" id="accountText"></div>
                        
                        </small>

                     <small id="show_err_acct_code">

                     </small>

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

<table id="PartyBill" class="table table-bordered table-striped table-hover submitbill">


  <thead class="theadC">

    <tr>

      
     <th class="text-center">Sr.No</th>
     <th class="text-center">Date</th>
  
      <th class="text-center">L R No </th>

      <th class="text-center">Depot/Plant </th>

      <th class="text-center">Invoice No </th>

      <th class="text-center">Account Code</th>

      <th class="text-center">Area</th>

      <th class="text-center">Transporter</th>

      <th class="text-center">Truck No</th>

      <th class="text-center">Qty</th>
      <th class="text-center">Material</th>

      <th class="text-center">Deisel</th>

      <th class="text-center">Drv - Exp</th>

      <th class="text-center">P - Exp</th>

      <th class="text-center">Fooding</th>

      <th class="text-center">Lu - Exp</th>

      <th class="text-center">Toll</th>

      <th class="text-center">Other Exp</th>

      <th class="text-center">TOtal Adv</th>
      <th class="text-center">Action</th>
     
    </tr>


  </thead>

  <tbody id="defualtSearch">

  </tbody>

</table>

<!-- <button type="submit" name="submit" value="submit" id="submitinparty" class='btn btn-success'>submit</button> 
 -->


</div><!-- /.box-body -->
 </div>



  </section>



</div>

@include('admin.include.footer')

 <script>
   $(function () {


        $(".select2").select2();


        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});

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

          document.getElementById("accountText").innerHTML = msg; 

        });


    });


</script>



<script type="text/javascript">
  $(document).ready(function(){
   $('.submitbill').DataTable({
           'scrollX': true,
        });
    });
</script>

<script type="text/javascript">

  $(document).ready(function(){

    //  load_data();


       function load_data(challan_no='',tr_date=''){
      
      //alert(challan_no);return false;


          $('#PartyBill').DataTable({

              processing: true,

              serverSide: true,

              scrollX: true,

              dom : 'Bfrtip',
              oLanguage: {
        "sEmptyTable":     "Record Not Found...!"
    },

              buttons: [

                        'excelHtml5'

                        ],

              columnDefs: [



                            { "width": "10%", "targets": 0, "className": "alignCenterClass"},



                            { "width": "10%", "targets": 1, "className": "alignLeftClass"},



                            { "width": "10%", "targets": 2, "className": "alignLeftClass"},



                            { "width": "10%", "targets": 3, "className": "alignLeftClass" },



                            { "width": "10%", "targets": 4, "className": "alignLeftClass" },



                            { "width": "10%", "targets": 5, "className": "alignLeftClass" },



                            { "width": "10%", "targets": 6, "className": "alignLeftClass" },



                            { "width": "10%", "targets": 7, "className": "alignLeftClass" },



                            { "width": "10%", "targets": 8, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 9, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 10, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 11, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 12, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 13, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 14, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 15, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 16, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 17, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 18, "className": "alignLeftClass" },
                            { "width": "10%", "targets": 19, "className": "alignLeftClass" },
                            


                          ],

              ajax:{

                url:'{{ url("/logistic/fleet-challan-receipt") }}',

                data: {challan_no:challan_no,tr_date:tr_date}

              },

              
              columns: [


              {

                    data:'DT_RowIndex',

                    name:'DT_RowIndex'

                },

               

                {

                    data:'TR_DATE',

                    render: function (data) {
        var date = new Date(data);
        var month = date.getMonth() + 1;
        return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
    }

                },

                {

                    data:'LR_NO',

                    name:'LR_NO'

                },

                {

                    data:'DEPOT_CODE',

                    name:'DEPOT_CODE'

                },

                {

                    data:'INVOICE_NO',

                    data:'INVOICE_NO'

                },

                {

                    data:'ACC_CODE',

                    data:'ACC_CODE'

                },

                {

                    data:'AREA_CODE',

                    name:'AREA_CODE'

                },

                {

                    data:'TRPT_CODE',

                    name:'TRPT_CODE'

                },

                {

                    data:'TRUCK_NO',

                    name:'TRUCK_NO'

                },

                {

                    data:'UM',

                    name:'UM'

                },

                {

                    data:'ITEM_CODE',

                    name:'ITEM_CODE'

                },

                {

                    data:'DIESEL_QTY',

                    name:'DIESEL_QTY'

                },

                {

                    data:'DRIVER_EXP',

                    name:'DRIVER_EXP'

                },

                {

                    data:'ADMIN_EXP',

                    name:'ADMIN_EXP'

                },

                {

                    data:'FOODING_EXP',

                    name:'FOODING_EXP'

                },

                {

                    data:'ULOADING_EXP',

                    name:'ULOADING_EXP'

                },

                {

                    data:'TOLL_EXP',

                    name:'TOLL_EXP'

                },

                {

                    data:'OTHER_EXP',

                    name:'OTHER_EXP'

                },

                { 

                    data:'TOTAL_ADV',

                    name:'TOTAL_ADV'

                },
                {

                    data:'Action',

                    render: function (data, type, full, meta){

                    var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

                         return '<a href="edit-fleet-challan-receipt/'+Base64.encode(full['FLEETTRANID'])+'/'+Base64.encode(full['TR_DATE'])+'" name="flit_id" class="btn btn-warning"><i class="fa fa-pencil" title="Edit"></i></a>';

                     }

                },

                



              ]





          });




 }
       





       $('#btnsearch').click(function(){

        
          
          var challan_no = $("#challan_no").val();
         // var todaydate = $("#date").val();



          if (challan_no!='') {

            var tr_date = $("#date").val();

            $('#show_err_acct_code').html('');



            $('#PartyBill').DataTable().destroy();

            load_data(challan_no,tr_date);



          }else{



            

          }



        });





        $('#ResetId').click(function(){



              

              $('#dept_code').val('');



          document.getElementById("accountText").innerHTML = '';

          $('#PartyBill').DataTable().destroy();

          //load_data();
            
          $('.submitbill').DataTable({
                          
         });
                  


        });







      



  });





</script>



<script type="text/javascript">



$(document).ready(function() {

    $('#submitinparty').on('click',function(){

      

      

      $('.flitClass:checkbox:checked').each(function(){

        var flitClass = $(this).val();

        $.ajaxSetup({



          headers: {



              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')



          }



         });



        $.ajax({



          url:"{{ url('save-party-bil') }}",



           method : "POST",



           type: "JSON",



           data: {flitClass: flitClass},



           success:function(data){

              var data1 = JSON.parse(data);



              var msg = data1.message;



              if(msg == 'Success'){

                $('#showwhen').removeClass('showmsg');

              }

           }



        });

      });

     

    });

});



</script>



<script type="text/javascript">



  $(document).ready(function() {

    $('.datepicker').datepicker({



      format: 'yyyy-mm-dd',

      orientation: 'bottom',

      todayHighlight: 'true',

      //startDate :from_date,
      endDate : 'today'

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