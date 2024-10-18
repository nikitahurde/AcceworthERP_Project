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
 .alignRightClass{
  text-align: right !important;
}
.alignLeftClass{
  text-align: left !important;
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

</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Contra Trans Report
            <small>Contra Trans Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Reports</a></li>

            <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">Contra Trans Report</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Contra Transaction Report</h2>

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

                    <?php $FromDate= date("d-m-Y", strtotime($fromDate));  
                        $ToDate= date("d-m-Y", strtotime($toDate));   ?>

                      <label for="exampleInputEmail1"> From Date: </label>

                      <div class="input-group">
                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                        <input type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="Select Transaction Date" value="{{$FromDate}} " autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_from_date">

                        

                      </small>

                  </div>

                 </div>



                 <div class="col-md-3">

                   <div class="form-group">

                      <label for="exampleInputEmail1"> To Date: </label>

                      <div class="input-group">
                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                        <input type="text" name="to_date" id="to_date" class="form-control datepicker1" placeholder="Select Transaction Date" value="{{$ToDate}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_to_date">

                      </small>

                  </div>

                 </div>

                 <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Account Code : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>
                           <input list="accountList" id="acct_code" name="acct_code" class="form-control  pull-left" value="{{ old('acct_code')}}" placeholder="Select Account Code" autocomplete="off">



                          <datalist id="accountList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($acc_list as $key)

                            

                            <option value='<?php echo $key->series_code?>'   data-xyz ="<?php echo $key->series_name; ?>" ><?php echo $key->series_name ; echo " [".$key->series_code."]" ; ?></option>

                            

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

                <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Vr No : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-list-ol" aria-hidden="true"></i>

                          </div>
                          <input type="text" id="vr_num" name="vr_num" class="form-control  pull-left" value="{{ old('trans_code')}}" placeholder="Enter vr no" autocomplete="off">


                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans">

                        

                      </small>
                     <span id='searcherr' style="color: red;"></span>
                  </div>

                </div><!-- /.col -->



                 

                <!--  <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Bank Name : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-building-o" aria-hidden="true"></i>

                          </div>

                          <input list="depotList"  id="bank_code" name="bank_code" class="form-control  pull-left" value="{{ old('bank_code')}}" placeholder="Select Bank Name" >



                          <datalist id="depotList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($bank_list as $key)

                            

                            <option value='< ?php echo $key->bank_code?>'   data-xyz ="< ?php echo $key->bank_name; ?>" >< ?php echo $key->bank_name ; echo " [".$key->bank_code."]" ; ?></option>



                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="depotText"></div>

                     </small>

                     <small id="show_err_dept_code">

                        

                      </small>

                     

                  </div>

                </div> -->

              </div><!-- /.row -->



              <div class="row">

                <div class="col-md-4" ></div>

                <div class="col-md-4" style="text-align: center;">

                    <div class="">

               <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

               </div>

                </div>
                
                <div class="col-md-4" ></div>

              </div>

              



               

             </form>

            </div><!-- /.box-body -->



            <div class="box-body" style="margin-top: -2%;">

<table id="InwardDispatch" class="table table-bordered table-striped table-hover">

  <thead class="theadC">

    

    <tr>

      <th class="text-center">Date</th>
      <th class="text-center">Vr. No</th>
      <th class="text-center">Account Code</th>
      <th class="text-center">Account Name </th>
      <th class="text-center">Debit Amt </th>
      <th class="text-center">Credit Amt </th>
      <th class="text-center">Series Code </th>

    </tr>

  </thead>

  <tbody id="defualtSearch">

    

  </tbody>
<tfoot align="right">
    <tr>
      <th></th><th></th><th></th><th></th><th></th><th></th><th></th>
    </tr>
  </tfoot>
  

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

          if(msg ==  'No Match'){
            $("#acct_code").val('');
            document.getElementById("accountText").innerHTML = '';
          }else{

          document.getElementById("accountText").innerHTML = msg; 
          }


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

          //document.getElementById("transText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             document.getElementById("itemText").innerHTML = '';

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
             document.getElementById("itemText").innerHTML = '';

          }


        });



       $("#item_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#itemList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         if(msg=='No Match'){

             $(this).val('');
             document.getElementById("itemText").innerHTML = '';

          }


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




</script>

<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(bank_code= '', acct_code='',from_date='',to_date='',vr_num=''){


          $('#InwardDispatch').DataTable({


              footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;

     
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0.00;
                };
     
                var monTotal = api
                  .column( 4 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                  }, 0 );
          
                var tueTotal = api
                  .column( 5 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
            
                    $( api.column( 3 ).footer() ).html('Total :-');
                    $( api.column( 4).footer() ).html(monTotal);
                    $( api.column( 5).footer() ).html(tueTotal);
                    
                  },

              
              processing: true,
              serverSide: true,
              scrollX: true,
            //  dom : 'Bfrtip',
              pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
              buttons: [
                        'excelHtml5'
                        ],
              columnDefs: [

                            { "width": "10%", "targets": 0, "className": "alignLeftClass"},

                            { "width": "10%", "targets": 1, "className": "alignRightClass"},

                            { "width": "10%", "targets": 2, "className": "alignRightClass"},
                            { "width": "10%", "targets": 3, "className": "alignLeftClass"},
                            { "width": "10%", "targets": 4, "className": "alignRightClass"},
                            { "width": "10%", "targets": 5, "className": "alignRightClass"},
                            { "width": "10%", "targets": 6, "className": "alignRightClass"},

                          ],
              ajax:{
                url:'{{ url("/report-contra") }}',
                data: {bank_code:bank_code,acct_code:acct_code,vr_num:vr_num,from_date:from_date,to_date:to_date}
              },
              columns: [

               {
                    data:'contra_date',
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
                    data:'vr_no',
                    name:'vr_no'
                },
                {
                    data:'acc_code',
                    name:'acc_code'
                },
                {
                    data:'acc_name',
                    name:'acc_name'
                },
                {
                    data:'debit_to',
                    render: $.fn.dataTable.render.number(',', '.', 2, '')
                },
                {
                    data:'credit_by',
                    render: $.fn.dataTable.render.number(',', '.', 2, '')
                },
                {
                    data:'series_code',
                    name:'series_code'
                }

              ]


          });


       }


       $('#btnsearch').click(function(){



          var from_date =  $('#from_date').val();

          var to_date =  $('#to_date').val();

          var bank_code =  $('#bank_code').val();

          var acct_code =  $('#acct_code').val();
         
          var vr_num =  $('#vr_num').val();

          var btnsearch =  $('#btnsearch').val();

          //var trans_code =  $('#trans_code').val();
          //alert(from_date);return false;

          if (bank_code!='' || acct_code!='' || from_date!='' || to_date!='' || vr_num!='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');

            if(from_date!=''){
                  if(to_date==''){
                    $('#show_err_to_date').html('Please select to date').css('color','red');
                  //  setTimeout(function(){$('#show_err_to_date').html('');},4000);
                    return false;
                  }
                }

                if(to_date!=''){
                  if(from_date==''){
                    $('#show_err_from_date').html('Please select from date').css('color','red');
                  //  setTimeout(function(){$('#show_err_from_date').html('');},4000);
                    return false;
                  }
                }

            $('#InwardDispatch').DataTable().destroy();
            load_data(bank_code,acct_code,from_date,to_date,vr_num);

          }else{
          	$('#InwardDispatch').DataTable().destroy();
          	load_data();
             /*$('#show_err_from_date').html('Please select from date').css('color','red');
            
             $('#show_err_to_date').html('Please select to date').css('color','red');
             $('#show_err_dept_code').html('Please select depot').css('color','red');
             $('#show_err_acct_code').html('Please select account code').css('color','red');
             $('#show_err_trans').html('Please select transporter').css('color','red');*/
          }


        });

       $('#ResetId').click(function(){

              $('#from_date').val('');
              
              $('#to_date').val('');
              
              $('#acct_code').val('');
              
              $('#vr_num').val('');

          document.getElementById("accountText").innerHTML = '';
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

@endsection