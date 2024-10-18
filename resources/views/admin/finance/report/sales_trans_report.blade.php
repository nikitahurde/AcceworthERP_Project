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
  .modltitletext{
    font-weight: 800;
    color: #5696bb;
    font-size: 16px;
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
.rightcontent{

  text-align:right;


}

.alignRightClass{
  text-align: right !important;
}
.alignLeftClass{
  text-align: left !important;
}
.SapBillBackColor{
  background-color: #dfccf5;
}
.DisPatchBackColor{
  background-color: #c2f3e3;
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

.buttonClass{
  margin-left: -10%;
}

@media only screen and (max-width: 600px) {
  .buttonClass{
    margin-left: 0%;
  }
  .dataTables_filter{
    margin-left: 35%;
  }
}


</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
              Sales Transaction Report
            <!-- < ?php echo ucwords($form_name) ?>  -->

            <small><b><!-- < ?php echo $form_number; ?> --></b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report/MIS</a></li>

            <li class="active"><a href="{{ url('/rept-sap-despatch') }}">List Sales Transaction Report</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Sales Transaction Report</h2>

              <!-- <div class="box-tools pull-right">

                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

              </div> -->



            </div><!-- /.box-header -->

            <div class="box-body">

             <form id="myForm">



               @csrf

               <?php date_default_timezone_set('Asia/Kolkata'); ?>

               <div class="row">

                 <div class="col-md-3">

                  <div class="form-group">
                    <?php

                   $From_date = date("d-m-Y", strtotime($from_date));
                   $To_date = date("d-m-Y", strtotime($to_date));

                     ?>
                    
                    <input autocomplete="off" type="hidden" name="" id="from_date_default" value="{{ $From_date }}">
                    <input autocomplete="off" type="hidden" name="" id="to_date_default" value="{{ $To_date }}">
                      <label for="exampleInputEmail1">From Date : </label>

                      <div class="input-group">
                          <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                         <input autocomplete="off" type="text" name="from_date" id="from_date" class="form-control datepicker rightcontent" placeholder="Enter From  Date" value="<?php echo $From_date; ?>" >

                      </div>
                    <small id="show_err_from_date" style="color: red;"></small>
                     


                  </div>

                </div><!-- /.col -->

                <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">To Date: </label>

                      <div class="input-group">
                          <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                            <input autocomplete="off" type="text" name="to_date" id="to_date" class="form-control datepicker1 rightcontent" placeholder="Enter To  Date" value="<?php echo date('d-m-Y'); ?>">

                      </div>

                      <small id="show_err_to_date" style="color:red;"></small>

                  </div>

                </div><!-- /.col -->

                

                <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Account Code : </label>

                      <div class="input-group">

                           <input autocomplete="off" list="accountList" id="acct_code" name="acct_code" class="form-control  pull-left" value="{{ old('acct_code')}}" placeholder="Select Account Code" >

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

                     <small id="show_err_acct_code" style="color: red;">

                     </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-3">
                  <div class="form-group">

                      <label for="exampleInputEmail1">Vr No : </label>

                      <div class="input-group">

                        
                          <input autocomplete="off" Type="text"  id="vr_no" name="vr_no" class="form-control  pull-left" value="{{ old('vr_no')}}" placeholder="Enter Vr No" >

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="depotText"></div>

                     </small>

                     <small id="dept_code_err" style="color: red;">

                     </small>

                     

                  </div>

                  
                </div>
                
               

              </div>

              <div class="row">

                <div class="col-md-4">
                  
                </div>

                <div class="col-md-3">

                  <button type="button" class="btn btn-primary buttonClass" name="searchdata" id="searchdata"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>
               
                <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>
                  
                </div>
                
              </div>
              
              
             </form>

            </div><!-- /.box-body -->



            <div class="box-body" style="margin-top: -2%;">


<button type="button" id="btnpdf" class="btn btn-danger btn-sm" style="margin-left: 70px !important;
    margin-bottom: -49px !important;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF </button>

<table id="SapVsDispatch" class="table table-bordered table-striped table-hover">

  <thead class="theadC">

    

    <tr>

      <th class="text-center">VR No</th>

      <th class="text-center">VR Date</th>

      <th class="text-center">Account Name</th>

      <th class="text-center">Account Code</th>

      <th class="text-center">Basic Ammount</th>

      <th class="text-center">Tax</th>

     <!--  <th class="text-center">Account Code</th> 

      <th class="text-center">Date </th>

      <th class="text-center">Vehicle No</th> -->

      

      

      

    </tr>

  </thead>
  <tfoot align="right">
    <tr><th></th><th></th><th></th><th></th><th></th><th></th></tr>
  </tfoot>

</table>



</div><!-- /.box-body -->

           

          </div>

  </section>

</div>

<div class="modal fade" id="tax_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document" style="margin-top: 5%;">

          <div class="modal-content" style="border-radius: 5px;">

            <div class="modal-header">

              <div class="row">

                
                <div class="col-md-5">
                  <div class="form-group">
                      <lable class="settaxcodemodel modltitletext col-md-4" style="padding: 0px;">Tax Code - </lable>
                               
                      <input type="text" class="settaxcodemodel modltitletext col-md-7" id="tax_code1" style="border: none; padding: 0px;" readonly>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <h5 class="modal-title modltitletext" id="exampleModalLabel">Tax / Charges / etc Calculation</h5>
                </div>

                <div class="col-md-1"></div>

              </div>

            </div>

            <div class="modal-body table-responsive">

                
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr><th scope="col">Tax Indicator</th>
                    <th scope="col">Rate Indicator</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Ammount</th>
                  </tr>
                </thead>
                  <tbody id="tax_rate_1">
                  <!-- End of 'box-row' -->
                  <!-- Start of 'box-row' -->
                  <!-- End of 'box-row' -->  
                  </tbody>   

                </table>

            </div>

            <div class="modal-footer" style="text-align: center;" id="footer_tax_btn1">
              <button type="button" class="btn btn-primary btn-md" data-dismiss="modal">OK</button>
            
            </div>

          </div>

        </div>

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

          if(msg=='No Match'){

             $(this).val('');
          

          }

        });


       $("#dept_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#depotList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          if(msg=='No Match'){

             $(this).val('');
          

          }

        });



        load_data();

        function load_data(depotCode = '', accountCode = '',fromDate='',toDate='',vrNo=''){


          $('#SapVsDispatch').DataTable({

              footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
     
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                var monTotal = api
                  .column( 1 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                  }, 0 );
          
                var tueTotal = api
                  .column( 2 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                  var twoTotal = api
                  .column( 4)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
            
                  //  $( api.column( 2 ).footer() ).html('Total :-');
                    $( api.column( 3 ).footer() ).html('Total :-');
                    //$( api.column( 1).footer() ).html(tueTotal);
                    //$( api.column( 2).footer() ).html(twoTotal);
                    $( api.column( 4).footer() ).html(twoTotal);
                    
                  },
              processing: true,
              serverSide: true,
              scrollX: true,
              //dom : 'Bfrtip',
              pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
              buttons: [
                        'excelHtml5'
                        ],
              columnDefs: [

                            { "width": "10%", "targets": 0, "className": "alignRightClass"},

                            { "width": "10%", "targets": 1, "className": "alignRightClass"},

                            { "width": "20%", "targets": 2, "className": "alignLeftClass"},

                            { "width": "10%", "targets": 3, "className": "alignRightClass" },

                            { "width": "10%", "targets": 4, "className": "alignRightClass" },

                            { "width": "10%", "targets": 5 },

                            

                           

                            

                          ],
              ajax:{
                url:'{{ url("/sales-trans-report") }}',
                data: {depotCode:depotCode,accountCode:accountCode,fromDate:fromDate,toDate:toDate,vrNo:vrNo}
              },
              columns: [
              {
                    data:'vr_no',
                    name:'vr_no'
                },
                {
                    data:'vr_date',
                    render: function (data) {
        var date = new Date(data);
        var month = date.getMonth() + 1;
        if(data=='0000-00-00'){
          return '00-00-0000';

        }else{
          
        return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
        }
    }
                },
                 
                {
                    data:'acc_name',
                    name:'acc_name'
                },
                {
                    data:'acc_code',
                    name:'acc_code'
                },
               
                {
                    data:'basic_amt',
                    name:'basic_amt'
                },
                 {  
            render: function (data, type, full, meta){

                      
                      var deletebtn =' <button class="btn btn-primary btn-xs" data-toggle="modal" style="margin-left:30px;" onclick="return getTax('+full['id']+');">Tax Cal</button>';
                     

                      return deletebtn;
                         

              }
        

       },
        
                
              ]


          });


       }


        $('#searchdata').click(function(){

          var from_date =  $('#from_date').val();

          var to_date =  $('#to_date').val();

          var dept_code =  $('#bank_code').val();

          var acct_code =  $('#acct_code').val();

          var vr_no =  $('#vr_no').val();

         

          if (dept_code != '' || acct_code != '' || from_date!='' || to_date !='' || vr_no!='') {
            $('#show_err_from_date').html('');
            
           $('#show_err_to_date').html('');
           $('#dept_code_err').html('');
           $('#acct_code_err').html('');

           if(from_date != ''){

            if(to_date==''){
               $('#show_err_to_date').html('Please select to date');
              return false;
            }
           }


           if(acct_code==''){
               $('#show_err_acct_code').html('Please select account code');
              return false;
            }
           

            $('#SapVsDispatch').DataTable().destroy();
            load_data(dept_code, acct_code,from_date,to_date,vr_no);


          }else{


          /* $('#show_err_from_date').html('Please select from date');
            
           $('#show_err_to_date').html('Please select to date');
           $('#dept_code_err').html('Please select depot code');
           $('#acct_code_err').html('Please select account code');*/
           $('#SapVsDispatch').DataTable().destroy();
            load_data();
          }


        });


        $('#ResetId').click(function(){

          $('#dept_code').val('');
          $('#acct_code').val('');
          document.getElementById("depotText").innerHTML = '';
          document.getElementById("accountText").innerHTML = '';
          $('#SapVsDispatch').DataTable().destroy();
          $('#searcherr').html('');
          load_data();

        });







    });


</script>
<script type="text/javascript">
  function getTax(id)
  {
   // alert(id);return false;
    

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/finance/get-tax-data') }}",

            data: {id: id}, // here $(this) refers to the ajax object not form

            success: function (data) {
              var data1 = JSON.parse(data);
              console.log(data1.taxcode.tax_code);


            $("#tax_model").modal('show');

            
             //$("#tax_rate_1").html(data);
             $("#tax_rate_1").html('');
             $("#tax_code1").val(data1.taxcode.tax_code);
             if(data1.response=='success'){

             $.each(data1.taxdata, function(key, value) {
                
                var tableBody = '<tr><td>'+value.tax_ind+'</td><td>'+value.rate_ind+'</td><td style="text-align:right;">'+value.tax_rate+'</td><td style="text-align:right;">'+value.tax_amt+'</td></tr>';
              
                   $("#tax_rate_1").append(tableBody);
              });
           }else{

           }


      
            },

        });

  }

</script>



<script type="text/javascript">

  

  $(document).ready(function() {


    var from_date = $('#from_date_default').val();
    var to_date = $('#to_date_default').val();
   // console.log(from_date);

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
  
  $('#btnpdf').click(function(){

           var fromDate =  $('#from_date').val();

          var toDate =  $('#to_date').val();

          var depotCode =  $('#bank_code').val();

          var accountCode =  $('#acct_code').val();

          var vrNo =  $('#vr_no').val();



         

          if (depotCode != '' || accountCode != '' || fromDate!='' || toDate !='' || vrNo!='') {
            $('#show_err_from_date').html('');
            
           $('#show_err_to_date').html('');
           $('#dept_code_err').html('');
           $('#acct_code_err').html('');

           if(from_date != ''){

            if(to_date==''){
               $('#show_err_to_date').html('Please select to date');
              return false;
            }
           }

                      $.ajaxSetup({
                                headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                              });

                             $.ajax({

                                url:"{{ url('/report/sales-trans/pdf') }}",

                                method : "POST",

                                type: "GET",

                                data: {depotCode:depotCode, accountCode:accountCode,fromDate:fromDate,toDate:toDate,vrNo:vrNo},

                                

                                success: function(response){

                                 console.log('response',response);

                                  if(response.response == 'success' && response.data !=''){

                                      var link = document.createElement('a');
                                      link.href = response.url;
                                      link.download = 'file.pdf';
                                      link.dispatchEvent(new MouseEvent('click'));

                                  }else{
                                    alert('no data');
                                  }

                                   

                                }, 

                                
                          });

          }else{
            $('#PurchaseIndentReportTable').DataTable().destroy();
            load_data_query();
            
          }


        });
</script>

@endsection