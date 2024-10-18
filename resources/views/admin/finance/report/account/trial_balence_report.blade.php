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
  .btnstyle{
    font-size: 13px;
  }
  .srNoDataTnl{
    width: 5%;
  }
  .glNameDataTbl{
    width: 30%;
    text-align: left;
  }
  .drAmtDataTbl{
    width: 11%;
    text-align: right;
  }
  .crAmtDataTbl{
    width: 11%;
    text-align: right;
  }
</style>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Trial Balance Report

        <small> Trial Balance Report Details</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ url('/dashboard') }}">Report</a></li>

        <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">List Trial Balance Report </a></li>

      </ol>

    </section>

    <section class="content">

      <div class="box box-primary Custom-Box">

        <div class="box-header with-border" style="text-align: center;">

          <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Trial Balance Report </h2>

          <!-- <div class="box-tools pull-right">

            <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

          </div> -->

        </div><!-- /.box-header -->

        <div class="box-body">

          <form id="myForm">

            @csrf

            <?php date_default_timezone_set('Asia/Kolkata'); ?>

            <div class="row">

              <div class="col-md-3"></div>

              <div class="col-md-2">

                <div class="form-group">
                    <?php 

                      $CurrentDate   = date("d-m-Y");
                      $FromDate      = date("d-m-Y", strtotime($fromDate));  
                      $ToDate        = date("d-m-Y", strtotime($toDate));  
                      $formCurrentDt = date("Y-m-d", strtotime($CurrentDate));

                      if($formCurrentDt > $toDate){
                        $vrDate =$ToDate;
                      }else{
                        $vrDate =$CurrentDate;
                      }
                    ?>
                    
                  <input autocomplete="off" type="hidden" name="" id="from_date_default" value="{{ $FromDate }}">
                  <input autocomplete="off" type="hidden" name="" id="to_date_default" value="{{ $vrDate }}">
                  <input autocomplete="off" type="hidden" name="" id="todayDate" value="{{ $vrDate }}">

                  <label for="exampleInputEmail1">From Date : </label>

                  <div class="input-group">
                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                     <input autocomplete="off" type="text" name="from_date" id="from_date" class="form-control datepicker rightcontent" placeholder="Enter From  Date" value="<?php echo $FromDate; ?>">

                  </div>
                  <small id="show_err_from_date" style="color: red;"></small>
                     
                </div>

              </div><!-- /.col -->

              <?php 

                date_default_timezone_set('Asia/Kolkata');

                $getCurrDtTim = date('Y-m-d H:i:s');
               
                $getExp = explode(" ",$getCurrDtTim);

                $secExp = explode("-",$getExp[0]);

                $expTime = explode(":",$getExp[1]);

                $getnewDt = $secExp[0].''.$secExp[1].''.$secExp[2].'_'.$expTime[0].''.$expTime[1].''.$expTime[2];

              ?>

              <input type="hidden" id="excelDt" value="{{$getnewDt}}">

              <div class="col-md-2">

                <div class="form-group">

                    <label for="exampleInputEmail1">To Date: </label>

                    <div class="input-group">
                          <div class="input-group-addon">

                        <i class="fa fa-calendar"></i>

                      </div>
                          <input autocomplete="off" type="text" name="to_date" id="to_date" class="form-control datepicker1 rightcontent" placeholder="Enter To  Date" value="{{$ToDate}}">
                    </div>

                    <small id="show_err_to_date" style="color:red;"></small>

                </div>

              </div><!-- /.col -->

               <div class="col-md-4">
                
                 <div class="form-group">

                      <label for="exampleInputEmail1">Search Type : <span class="required-field"></span> </label>

                      <div class="input-group">

                      
                          <input type="radio" id="searchtype" name="searchtype"  value="GL" checked=""> &nbsp; <b>By GL</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" id="searchtype" name="searchtype" value="Account">  &nbsp; <b>By Account &nbsp;&nbsp;</b>

                          <input type="radio" id="searchtype" name="searchtype" value="Both">  &nbsp; <b>Both &nbsp;&nbsp;</b>


                      </div>

                      <small id="show_err_searchtype">

                      </small>
                     
                  </div>

              </div>

              
                
            </div>
            <div class="text-center">
              <!-- <div class="col-md-3"  style="margin-top: 9px;"> -->
                <button type="button" class="btn btn-primary btnstyle" name="searchdata" id="btnsearch" value="btnsearch" style="margin-top: 1%;">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                <button type="button" class="btn btn-warning btnstyle" name="searchdata" id="ResetId" style="margin-top: 1%;">&nbsp;&nbsp;<i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

                <button type="button" id="btnpdf" class="btn btn-danger btnstyle" style="margin-top: 1%;">&nbsp;&nbsp;<i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp;&nbsp; PDF 
                </button>


              <!-- </div> -->
            </div>

            <!-- <div class="col-md-2"></div> -->

          </form>

        </div><!-- /.box-body -->

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

                <th class="text-center">Sr. No</th>
                <th class="text-center">GL Code/Account Code</th>
                <th class="text-center">YrOpDr </th>
                <th class="text-center">YrOpCr </th>
                <th class="text-center">Yr.Dr.Amt </th>
                <th class="text-center">Yr.Cr.Amt </th>
                <th class="text-center">Cl.Dr.Amt </th>
                <th class="text-center">Cl.Cr.Amt </th>
                
              </tr>

            </thead>

            <tbody id="defualtSearch">

            </tbody>

            <tfoot align="right">
              <tr>
                <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
              </tr>
            </tfoot>

          </table>

           <table id="BothDataTbl" class="table table-bordered table-striped table-hover" style="display: none;">
            
            <thead class="theadC">

              <tr>

                <th class="text-center">Sr. No</th>
                <th class="text-center">GL Code</th>
                <th class="text-center">GL Name</th>
                <th class="text-center">ACC Code</th>
                <th class="text-center">ACC Name</th>
                <th class="text-center">YrOpDr </th>
                <th class="text-center">YrOpCr </th>
                <th class="text-center">Yr.Dr.Amt </th>
                <th class="text-center">Yr.Cr.Amt </th>
                <th class="text-center">Cl.Dr.Amt </th>
                <th class="text-center">Cl.Cr.Amt </th>
               
              </tr>

            </thead>

            <tbody id="defualtSearch">

            </tbody>

            <tfoot align="right">
              <tr>
                <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
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

      function load_data(from_date='',to_date='',search_type=''){

        if(search_type == 'Both'){

          $('#BothDataTbl').DataTable({

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
                var opebal = api.column(4).data();
                
                var OneTotal = api
                  .column( 5 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                  }, 0 );
          
                var TwoTotal = api
                  .column( 6)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                  var ThreeTotal = api
                  .column( 7)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                   var FourTotal = api
                  .column( 8)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                   var FiveTotal = api
                  .column( 9)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                  var SixTotal = api
                  .column(10)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                    $( api.column( 4 ).footer() ).html('Total :-').css('text-align','right');
                    $( api.column( 5).footer() ).html(parseFloat(OneTotal).toFixed(2));
                    $( api.column( 6).footer() ).html(parseFloat(TwoTotal).toFixed(2));
                    $( api.column( 7).footer() ).html(parseFloat(ThreeTotal).toFixed(2));
                    $( api.column( 8).footer() ).html(parseFloat(FourTotal).toFixed(2));
                    $( api.column( 9).footer() ).html(parseFloat(FiveTotal).toFixed(2));
                    $( api.column( 10).footer() ).html(parseFloat(SixTotal).toFixed(2));
                    
                    
            },

            processing: true,
            serverSide: false,
            info: true,
            bPaginate: false,
            scrollY: 300,
            scrollX: true,
            scroller: true,
            fixedHeader: true,
            order: [[1, 'asc'],[2, 'asc']],
            columnDefs: [
               { orderable: false, targets:0 }
            ],
            dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
            buttons:  [
                    {
                      extend: 'excelHtml5',
                      title: 'TRIAL BALENCE BOTH '+$("#headerexcelDt").val(),
                      filename: 'TRIAL_BALENCE_BOTH'+$("#headerexcelDt").val(),
                    }
                  ],

            language:[
              "thousand"
            ],
              
            ajax:{
              url:'{{ url("/report-trial-balence") }}',
              data: {from_date:from_date,to_date:to_date,search_type:search_type}
            },

            columns: [
                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex',
                    className: "srNoDataTnl"
                },
               
                  {
                    data:'GL_CODE',
                    name:'GL_CODE',
                    className:"codeData"
                },
                {
                    data:'gl_name',
                    name:'gl_name',
                    className:"glNameDataTbl"
                },
                {
                    data:'acc_code',
                    name:'acc_code',
                    className:"codeData"
                },
                {
                    data:'acc_name',
                    name:'acc_name',
                    className:"glNameDataTbl"
                },
               
                {
                    data:'YROPDR',
                    render: function (data, type, full, meta) {
                      var yrOpDr =  parseFloat(full['YROPDR']);

                      var newYrOpDrToFix = yrOpDr.toFixed(2);

                      if (newYrOpDrToFix=='NaN') {
                        var newYrOpDr = 0.00;
                      }else{
                        var newYrOpDr = newYrOpDrToFix;
                      }
                      return newYrOpDr;
                        
                    },
                    className:'drAmtDataTbl',
                },
                {
                    data:'YROPCR',
                    render: function (data, type, full, meta) {
                      var yrOpCr =  parseFloat(full['YROPCR']);

                      var newYrOpCrToFix = yrOpCr.toFixed(2);

                      if (newYrOpCrToFix=='NaN') {
                        var newYrOpCr = 0.00;
                      }else{
                        var newYrOpCr = newYrOpCrToFix;
                      }
                      return newYrOpCr;
                        
                    },
                    className:"crAmtDataTbl"
                },
                {
                    data:'YRDRAMT',
                    render: function (data, type, full, meta) {
                      var yrDrAmt =  parseFloat(full['YRDRAMT']);

                      var newYrDrAmtToFix = yrDrAmt.toFixed(2);

                      if (newYrDrAmtToFix=='NaN') {
                        var newYrDrAmt = 0.00;
                      }else{
                        var newYrDrAmt = newYrDrAmtToFix;
                      }
                      return newYrDrAmt;
                        
                    },
                    className:"crAmtDataTbl"
                },
                {
                    data:'YRCRAMT',
                    render: function (data, type, full, meta) {
                      var yrCrAmt =  parseFloat(full['YRCRAMT']);

                      var newYrCrAmtToFix = yrCrAmt.toFixed(2);

                      if (newYrCrAmtToFix=='NaN') {
                        var newYrCrAmt = 0.00;
                      }else{
                        var newYrCrAmt = newYrCrAmtToFix;
                      }
                      return newYrCrAmt;
                        
                    },
                    className:"crAmtDataTbl"
                },
                {
                    data:'CLDRAMT',
                    render: function (data, type, full, meta) {
                      var clDrAmt =  parseFloat(full['CLDRAMT']);

                      var newClDrAmtToFix = clDrAmt.toFixed(2);

                      if (newClDrAmtToFix=='NaN') {
                        var newClDrAmt = 0.00;
                      }else{
                        var newClDrAmt = newClDrAmtToFix;
                      }
                      return newClDrAmt;
                        
                    },
                    className:"crAmtDataTbl"
                },
                {
                    data:'CLCRAMT',
                    render: function (data, type, full, meta) {
                      var clCrAmt =  parseFloat(full['CLCRAMT']);

                      var newClCrAmtToFix = clCrAmt.toFixed(2);

                      if (newClCrAmtToFix=='NaN') {
                        var newClCrAmt = 0.00;
                      }else{
                        var newClCrAmt = newClCrAmtToFix;
                      }
                      return newClCrAmt;
                        
                    },
                    className:"crAmtDataTbl"
                },

            ]

        });

        }else{      
        
        var mtype= (search_type == 'GL')?'GENERAL_LEDGER':'ACCOUNT';                                                        

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
                var opebal = api.column(4).data();
                
               var OneTotal = api
                  .column( 2 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                  }, 0 );
          
                var TwoTotal = api
                  .column( 3 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                  var ThreeTotal = api
                  .column( 4)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                   var FourTotal = api
                  .column( 5)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                   var FiveTotal = api
                  .column( 6)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                  var SixTotal = api
                  .column( 7)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                    $( api.column( 1 ).footer() ).html('Total :-').css('text-align','right');
                    $( api.column( 2).footer() ).html(parseFloat(OneTotal).toFixed(2));
                    $( api.column( 3).footer() ).html(parseFloat(TwoTotal).toFixed(2));
                    $( api.column( 4).footer() ).html(parseFloat(ThreeTotal).toFixed(2));
                    $( api.column( 5).footer() ).html(parseFloat(FourTotal).toFixed(2));
                    $( api.column( 6).footer() ).html(parseFloat(FiveTotal).toFixed(2));
                    $( api.column( 7).footer() ).html(parseFloat(SixTotal).toFixed(2));
                    
            },

            processing: true,
            serverSide: false,
            info: true,
            bPaginate: false,
            scrollY: 300,
            scrollX: true,
            scroller: true,
            fixedHeader: true,
            order: [[1, 'asc'],[2, 'asc']],
            columnDefs: [
               { orderable: false, targets:0 }
            ],
            dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
             
           buttons:  [
                    {
                      extend: 'excelHtml5',
                      exportOptions: {
                            columns: [0,1,2,3,4,5,6,7]
                      },
                      title: 'TRIAL BALENCE '+mtype+' '+$("#headerexcelDt").val(),
                      filename: 'TRIAL_BALENCE_'+mtype+'_'+$("#headerexcelDt").val(),
                    }
                  ],

            language:[
              "thousand"
            ],
              
            ajax:{
              url:'{{ url("/report-trial-balence") }}',
              data: {from_date:from_date,to_date:to_date,search_type}
            },

            columns: [
                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex',
                    className: "srNoDataTnl"
                },
                {
                     data:'gl_name',
                     render: function (data, type, full, meta) {
                        if(full['GL_CODE']){

                        var gl_code = full['GL_CODE']+' - '+full['gl_name'];
                        }else{
                        var gl_code = '---';
                        }
                        return gl_code;
                        
                    },
                    className:'glNameDataTbl',
                    
                },
                {
                    data:'yropdr',
                    name:'yropdr',
                    className:"crAmtDataTbl"
                },
                {
                    data:'yropcr',
                    name:'yropcr',
                    className:"crAmtDataTbl"
                },
                {
                    data:'yrdramt',
                    name:'yrdramt',
                    className:"crAmtDataTbl"
                },
                {
                    data:'yrcramt',
                    name:'yrcramt',
                    className:"crAmtDataTbl"
                },
                {
                    data:'cldramt',
                    name:'cldramt',
                    className:"crAmtDataTbl"
                },
                {
                    data:'clcramt',
                    name:'clcramt',
                    className:"crAmtDataTbl"
                },

            ]

        });
       }

      }

     $('#btnsearch').click(function(){

          var from_date   =  $('#from_date').val();
          
          var to_date     =  $('#to_date').val();
          var search_type =  $("input:radio[name=searchtype]:checked").val();

          if(search_type == 'Both'){
            $('#BothDataTbl').css('display','');
            $('#InwardDispatch').css('display','none');
          }else if(search_type == 'GL' || search_type == 'Account'){
            $('#BothDataTbl').css('display','none');
            $('#InwardDispatch').css('display','');
          }

          $('#from_date').prop('readonly',true);
          $('#to_date').prop('readonly',true);
          $('#btnsearch').prop('disabled',true);
         
          var btnsearch =  $('#btnsearch').val();

          if (from_date!='' || to_date!='' || search_type !='') {

            if(from_date != ''){

              if(to_date==''){
                 $('#show_err_to_date').html('Please select to date');
                return false;
              }
            }

            $('#InwardDispatch').DataTable().destroy();
            load_data(from_date,to_date,search_type);

          }else{

            $('#InwardDispatch').DataTable().destroy();
            load_data();
          
          }

      });

      $('#ResetId').click(function(){
            
        $('#vr_num').val('');
            
        $('#acct_code').val('');

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
    var todayDate = $('#todayDate').val();

    $('.datepicker1').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :from_date,
      endDate : todayDate,
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

    var from_date  =  $('#from_date').val();
    var to_date    =  $('#to_date').val();
    var acct_code  =  $('#acct_code').val();
    var acct_class =  $('#acct_class').val();
    var acct_type  =  $('#acct_type').val();
    var glsch_code =  $('#glsch_code').val();
    var pfct_code  =  $('#pfct_code').val();
    var comp_code  =  $('#comp_code').val();
    var glC_code   =  $('#glC_code').val();
    var vrno       =  $('#vr_num').val();
    if(vrno){
      var vrnum    = vrno.split(' ');
    }else{
      var vrnum    = '';
    }
    

    var vr_num = vrnum[2];

    if (acct_code!='' || from_date!='' || to_date!='' || acct_class!='' || acct_type!='' || glsch_code!='' || pfct_code!='' || comp_code!='' || glC_code!='' || vr_num!='') {

        $('#show_err_from_date').html('');
        $('#show_err_to_date').html('');
        $('#show_err_dept_code').html('');
        $('#show_err_acct_code').html('');
        $('#show_err_trans').html('');

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

            url:"{{ url('/report/acc-ledger-report-pdf/pdf') }}",

            method : "POST",

            type: "GET",

            data: {acct_code:acct_code,acct_class:acct_class,acct_type:acct_type,pfct_code:pfct_code,glC_code:glC_code,comp_code:comp_code,from_date:from_date,to_date:to_date,vr_num:vr_num},

            success: function(response){

                if(response.response == 'success' && response.data !=''){

                    var link = document.createElement('a');
                    link.href = response.url;
                    link.download = 'acc_ledger report.pdf';
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
