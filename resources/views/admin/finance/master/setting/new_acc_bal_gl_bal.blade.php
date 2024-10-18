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
  .crBal{
    display:none;
  }

  .defualtSearchNew{

    display: none;

  }
  .rightcontent{

  text-align:right;


}

::placeholder {
  
  text-align:left;
}

  .showSeletedName {

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

 }
 .alignRightClass{
  text-align: right;
 }
 .alignCenterClass{
  text-align: center;
 }
 .aligncenterClass{
  text-align: center;
 }
.showhideGl{
  display: none;
}
.hideAccc{
  display: none;
}
.showhideaccC{
  display: none;
}
.showthforaccgl{
  display: none;
}
 @media only screen and (max-width: 600px) {
  
  .dataTables_filter{
    margin-left: 35%;
  }
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
    font-size: 15px!important;
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
.showhideaccC{
  display: none;
}
.showhideGl{
  display: none;
}

</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

           Account Balance / GL Balance

            <small> Acc Bal/Gl Bal</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Configuration</a></li>
            <li><a href="{{ url('/dashboard') }}">CF New Year</a></li>

            <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">Acc Bal/Gl Bal </a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

            <!--   <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Acc Bal/Gl Bal </h2> -->

              <?php $fisYear   =  Session::get('macc_year'); 
                    $GetYear = explode('-', $fisYear);
                               
                                $firstyear = $GetYear[0] + 1;
                                $lastyear = $GetYear[1] + 1;

                                  $nextyr = $firstyear.'-'.$lastyear;

                           ?>

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Carry Forword GL Balance For Financial Year <?= $nextyr ?></h2>

              <!-- <div class="box-tools pull-right">

                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

              </div> -->



            </div><!-- /.box-header -->

            <div class="box-body">

             <form id="myForm">



               @csrf

                <?php date_default_timezone_set('Asia/Kolkata'); ?>

             
              

              <div class="row">

                 <!--  <div class="col-md-3">
                      

                    <div class="form-group">

                      <label for="exampleInputEmail1">Period : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                           <input list="period_list" id="period_code" name="glC_code" class="form-control  pull-left" value="" placeholder="Select Period" autocomplete="off">

                          <datalist id="period_list">

                            <option selected="selected" value="">-- Select --</option>

                            <option value='Single Period'   data-xyz ="Single Period" >Single Period</option>
                            <option value='Double Period'   data-xyz ="Double Period" >Double Period</option>
                           
                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="gl_codeText"></div>

                     </small>

                     <small id="show_err_acct_code">
                     </small>

                  </div>

                </div> --><!-- /.col -->

                  <div class="col-md-3" style="display: none;">

                  <div class="form-group">
                    <?php

                   $From_date = date("d-m-Y", strtotime($fromDate));
                   $To_date = date("d-m-Y", strtotime($toDate));

                     ?>
                    
                    <input autocomplete="off" type="hidden" name="" id="from_date_default" value="{{ $From_date }}">
                    <input autocomplete="off" type="hidden" name="" id="to_date_default" value="{{ $To_date }}">
                      <label for="exampleInputEmail1">From Date : </label>

                      <div class="input-group">
                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                         <input autocomplete="off" type="text" name="from_date" id="from_date" class="form-control datepicker rightcontent" placeholder="Enter From  Date" value="<?php echo $From_date; ?>" style="width: 120%;">

                      </div>
                    <small id="show_err_from_date" style="color: red;"></small>
                     


                  </div>

                </div><!-- /.col -->

                <div class="col-md-3" style="display: none;">

                  <div class="form-group">

                      <label for="exampleInputEmail1">To Date: </label>

                      <div class="input-group">
                            <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                            <input autocomplete="off" type="text" name="to_date" id="to_date" class="form-control datepicker1 rightcontent" placeholder="Enter To  Date" value="{{$To_date}}" style="width: 120%;">

                      </div>

                      <small id="show_err_to_date" style="color:red;"></small>

                  </div>

                </div><!-- /.col -->

               
                
              </div>

              <div class="row">
                  <div class="col-md-4"></div>
                 <div class="col-md-4"  style="text-align: center;margin-top: 3.4%;">
                  <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch" style="padding: 5px;"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Proceed</button>

                      <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Cancel</button>
                </div>
                <div class="col-md-4"></div>
                
              </div>

             </form>

            </div><!-- /.box-body -->

            <div>&nbsp;</div>

<form id="accbalform">
 @csrf

<div class="box-body" style="margin-top: 0%;">

<table id="InwardDispatch" class="table table-bordered table-striped table-hover">

  <thead class="theadC">

     <!--  < ?php $totalDr=0;$totalcr=0;foreach ($acc_led_list as $key) {
         $totalDr += $key->dr_amt;
         $totalcr += $key->cr_amt;
      } ?> -->
      <input type="hidden" id="totalDebitAmt" value="">
      <input type="hidden" id="totalCreditAmt" value="">
    <tr>

      <!-- <th class="text-center">Sr. No</th> -->
      <th class="text-center">GL Code</th>
      <th class="text-center">Closing Dr.Amt </th>
      <th class="text-center">Closing Cr.Amt </th>
      <th class="text-center">PFCT Code</th>
      
    </tr>

  </thead>

  <tbody id="defualtSearch">

    

  </tbody>

  <tfoot align="right">
    <tr>
      <th></th><th></th><th></th><th></th>
    </tr>
  </tfoot>
  

</table>


<div style="text-align: center;">

            <input type="hidden" id="taxaplyYorN" value="NO" name="taxaplyYorN">
            <input type="hidden" id="taxCodeU" value="">
            
            <button type="button" name="submit" value="submit" id="submaccglbal" class='btn btn-success' disabled style="width: 16%;">&nbsp;Submit&nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button> 

          </div>


</div><!-- /.box-body -->

<div class="container">
 
  <!-- Trigger the modal with a button -->
 

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" style="margin-top: 150px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
           <h4 class="modal-title" style="text-align: center;color: red;"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp; Alert</h4>
        </div>
        <div class="modal-body">
          <h5><b>GL Code Already Exist For This Financial Year .Are You Overrite ? .</b></h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="submitData()">Procceed</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>


</form>  

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

       $( window ).on( "load", function() {
            $('#totl_dr_val').html(0);
            $('#totl_cr_val').html(0);
        });


       $("#glC_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#gl_codeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
             $(this).val('');
            document.getElementById("gl_codeText").innerHTML = '';
          }else{
            document.getElementById("gl_codeText").innerHTML = msg;
          } 

        });


    });



</script>

<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(from_date='',to_date=''){


          $('#InwardDispatch').DataTable({



              footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
     
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                var rowcount = data.length;
                var getRow = rowcount-1;
                var opebal = api.column(3).data();
                
               
                var tueTotal = api
                  .column( 2 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                  var twoTotal = api
                  .column( 3)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                  

                    $( api.column( 1 ).footer() ).html('Total :-').css('text-align','right');

                    $( api.column( 2).footer() ).html(parseFloat(tueTotal).toFixed(2));

                    $( api.column( 3).footer() ).html(parseFloat(twoTotal).toFixed(2));

                    

                    
                    
                  },

              processing: true,
             // serverSide: true,
             // scrollX: true,
              searching:false,
              pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
             
              buttons: [
                        ],

              language:[
                "thousand"
              ],
              
              ajax:{
                url:'{{ url("/Master/Setting/New_Yr_Acc_Gl_Bal") }}',
                data: {from_date:from_date,to_date:to_date}
              },

              columns: [
                // {
                //     data:'DT_RowIndex',
                //     name:'DT_RowIndex',
                //     className: "alignCenterClass"
                // },
                {

                     render: function (data, type, full, meta) {
                        if(full['GL_CODE']){

                          var GL_CODE = full['GL_CODE']+' - '+full['gl_name']+'<input type="hidden" value="'+full['GL_CODE']+'" name="gl_code[]" id="gl_code">';
                       
                        }else{
                          var GL_CODE = '---';
                        }

                        
                        return GL_CODE;
                        
                    },
                    className:'alignCenterClass',
                    
                },
                {
                    data:'cldramt',
                    name:'cldramt',

                    render: function (data, type, full, meta) {
                        if(full['cldramt']){

                          var cldramt = full['cldramt']+'<input type="hidden" value="'+full['cldramt']+'" name="crdr_amt[]" id="crdr_amt">';
                       
                        }else{
                          var cldramt = '---';
                        }

                        
                        return cldramt;
                        
                    },
                    className:'alignRightClass',
                },
                {
                    data:'clcramt',
                    name:'clcramt',

                    render: function (data, type, full, meta) {
                        if(full['clcramt']){

                          var clcramt = full['clcramt']+'<input type="hidden" value="'+full['clcramt']+'" name="clcr_amt[]" id="clcr_amt">';
                       
                        }else{
                          var clcramt = '---';
                        }

                        
                        return clcramt;
                        
                    },
                    className:'alignRightClass',
                },

                {
                    data:'pfct_code',
                    name:'pfct_code',

                    render: function (data, type, full, meta) {
                        if(full['pfct_code']){

                          var pfct_code = full['pfct_code']+'<input type="hidden" value="'+full['pfct_code']+'" name="pfct_code[]" id="pfct_code">';
                       
                        }else{
                          var pfct_code = '---';
                        }

                        
                        return pfct_code;
                        
                    },
                    className:'alignCenterClass',
                },
              ]

          });

        }


       $('#btnsearch').click(function(){



          var from_date =  $('#from_date').val();

          var to_date =  $('#to_date').val();
         
          var btnsearch =  $('#btnsearch').val();

          //var trans_code =  $('#trans_code').val();
          //alert(from_date);return false;

          if (from_date!='' || to_date!='') {

            if(from_date != ''){

              if(to_date==''){
                 $('#show_err_to_date').html('Please select to date');
                return false;
              }
           }

           $('#submaccglbal').prop('disabled',false);
            $('#InwardDispatch').DataTable().destroy();
            load_data(from_date,to_date);

          }else{

            $('#InwardDispatch').DataTable().destroy();
            load_data();
          
          }


        });

        $('#ResetId').click(function(){
              
          $('#vr_num').val('');
              
          $('#acct_code').val('');

          //document.getElementById("accountText").innerHTML = '';

          $('#InwardDispatch').DataTable().destroy();
          load_data();

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
      endDate : to_date,
      autoclose: 'true'
    });
  
});


$(document).ready(function() {
  
  var from_date = $('#from_date_default').val();
    var to_date = $('#to_date_default').val();

    $('.datepicker1').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :from_date,
      endDate : to_date,
      autoclose: 'true'

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

<script type="text/javascript">
$(document).ready(function (){

   $('#submaccglbal').on('click', function(e){

   var form= $("#accbalform");

   //var data = form.serializeArray();

   //alert(data);return false;

   $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });


 
   $.ajax({
      method:"POST",
      url: "{{ url('/Master/Setting/Check-Gl-bal-data') }}",
      data: form.serialize(),
      success: function(data){

        var obj =  JSON.parse(data);

        console.log(obj);

        if(obj.response=='Success'){

         
              $("#myModal").modal('show');
          

        }else if(obj.response=='error'){
            

            submitData();
            
        }
     // window.location="{{url('/Master/Item/View-Item-Bal-Mast')}}";
          
      }
   });

});


   



});


</script>

<script type="text/javascript">


    function submitData(){


      var form= $("#accbalform");

   //var data = form.serializeArray();

  // alert('hi');return false;

   $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });


 
   $.ajax({
      method:"POST",
      url: "{{ url('/Master/Setting/Save-New-Gl-Bal') }}",
      data: form.serialize(),
      success: function(data){

        console.log(data);

      window.location="{{url('/Master/General-Ledger/View-Gl-Bal-Mast')}}";
          
      }
   });


    }


</script>

@endsection
