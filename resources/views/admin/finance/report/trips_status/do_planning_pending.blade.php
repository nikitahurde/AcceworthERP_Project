@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')


<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')



<style type="text/css">

  .amountfl{

    text-align: right;

  }

  .textfl{

    text-align: left;

  }

  .showSeletedName{

     font-size: 12px;
     margin-top: 1.2%;
     margin-bottom: 3%;
     text-align: center;
     font-weight: 600;
     color: #4f90b5;
     text-transform: capitalize;
     text-align: center;

  }
  .modal-header .close {
    margin-top: -32px;
}

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
  .alignRightClass{
    text-align: right;
  }
  .alignCenterClass{
    text-align: center;
  }
  .showSeletedName {
    font-size: 12px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  }
  .rightcontent{
    text-align:right;
  }
  ::placeholder {
    text-align:left;
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
    font-size: 12px!important;
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
  .vrDateDataTbl{
    width: 7%;
    text-align: left;
  }
  .vrVrNoDataTbl{
    width: 9%;
    text-align: left;
  }
  .refDataTbl{
    width: 19%;
    text-align: left;
  }
  .drAmtDataTbl{
    width: 15%;
    text-align: right;
  }
  .crAmtDataTbl{
    width: 15%;
    text-align: right;
  }
  .balAmtDataTbl{
    width: 15%;
    text-align: left;
  }
  .balTypeDataTbl{
    width: 5%;
    text-align: left;
  }
  .pfctDataTbl{
    width: 15%;
    text-align: left;
  }
  .btn-sm {
    padding: 4px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
  }

  .content-header h1 {
      margin-top: 2%;
  }
  .content-header .breadcrumb {
      margin-top: 2%;
  }
  .box-header {
      color: #444;
      display: block;
      padding: 3px;
      position: relative;
  }
  table.dataTable {
      clear: both;
      margin-top: 0px !important;
      margin-bottom: 6px !important;
      max-width: none !important;
  }
  .content {
      min-height: 250px;
      padding: 9px;
      margin-right: auto;
      margin-left: auto;
      padding-left: 15px;
      padding-right: 15px;
  }

</style>







  <div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">


          <h1>


            DO Planning Pending



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li class="Active"><a href="{{ URL('/Dashboard/Trips-status')}}">DO Planning Pending</a></li>



            <li class="Active"><a href="{{ URL('/Dashboard/Trips-status')}}">View DO  Planning Pending</a></li>



          </ol>



        </section>







        <!-- Main content -->



        <section class="content">



          <div class="row">



            <div class="col-xs-12">



              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View DO Planning Pending </h3>



                  <div class="box-tools pull-right">


                    <a href="{{ url('/Dashboard/Trips-status') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Go Back</a>



                  </div>



                </div><!-- /.box-header -->



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


                  <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">

                      <div class="form-group">

                        <label>

                       Account Name : 


                        </label>

                         <div class="input-group">

                            <div class="input-group-addon">

                                <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                            </div>

                            <input list="acc_list"  id="acc_code" name="acc_code" class="form-control  pull-left " value="{{ old('acc_code')}}" placeholder="Select Account Code"  autocomplete="off" maxlength="10">

                            <datalist id="acc_list">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($acc_list as $key)

                                <option value='<?php echo $key->ACC_CODE ?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo" [".$key->ACC_CODE."]" ; ?></option>

                                @endforeach

                             
                                

                            </datalist>

                          </div>

                          <div class="pull-left showSeletedName" id="plantText"></div>
                          <small id="show_err_acc_code"></small>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('blood_group', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>
                   
                    </div>
                    <div class="col-md-2">

                      <div class="form-group">

                        <label>

                       Series Name : 


                        </label>

                         <div class="input-group">

                            <div class="input-group-addon">

                                <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                            </div>

                            <input list="series_list"  id="series_code" name="series_code" class="form-control  pull-left " value="{{ old('series_code')}}" placeholder="Select Series Code"  autocomplete="off" maxlength="10">

                            <datalist id="series_list">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($series_list as $key)

                                <option value='<?php echo $key->SERIES_CODE  ?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME; echo" [".$key->SERIES_CODE ."]" ; ?></option>

                                @endforeach

                             
                                

                            </datalist>

                          </div>

                          <div class="pull-left showSeletedName" id="seriesText"></div>
                          <!-- <small id="show_err_acc_code"></small> -->

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('blood_group', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>
                   
                    </div>

                    <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch" style="margin-top:1%;padding: 1px;font-size: 12px;">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                    <button type="button" class="btn btn-warning" name="searchdata" id="ResetId" style="margin-top:1%;padding: 1px;font-size: 12px;">&nbsp;&nbsp;<i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>

                  </div>
                  <table id="tblpendingReport" class="table table-bordered table-striped table-hover">



                    <thead>
                      <tr>

                        <th class="text-center" width="7%">DO Date</th>
                        <th class="text-center" width="7%">DO No</th>
                        <th class="text-center" width="12%">Consinee Name</th>
                        <th class="text-center" width="10%">To Place</th>
                        <th class="text-center" width="5%">Material Number</th>
                        <th class="text-center" width="12%">Item Name</th>
                        <th class="text-center" width="10%">Detailed Material Name</th>
                        <th class="text-center" width="5%">Rake No</th>
                        <th class="text-center" width="5%">Wagon No</th>
                        <th class="text-center" width="5%">Qty</th>
                        <th class="text-center" width="5%">UM</th>
                        <th class="text-center" width="5%">Account Code</th>
                        <th class="text-center" width="13%">Account Name</th>
                        <th class="text-center" width="5%">Action</th>


                    </tr>
                    </thead>

                    <tbody>

                      

                    </tbody>

                    <tfoot align="right">
                   <!--  <tr>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr> -->
                  </tfoot>



                  </table>



                </div><!-- /.box-body -->



              </div><!-- /.box -->



            </div><!-- /.col -->



          </div><!-- /.row -->



        </section><!-- /.content -->



      </div>


@include('admin.include.footer')




<script type="text/javascript">




  $("#acc_code").bind('change', function () {  

    var val = $(this).val();

    var xyz = $('#acc_list option').filter(function() {

    return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';
    if(msg == 'No Match'){

      document.getElementById("plantText").innerHTML = msg; 
      $('#show_err_acc_code').html('');
      $(this).val('');
      
    }else{

      document.getElementById("plantText").innerHTML = msg; 
      $('#show_err_acc_code').html('');
    }

  });

   $("#series_code").bind('change', function () {  

    var val = $(this).val();

    var xyz = $('#series_list option').filter(function() {

    return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';
    if(msg == 'No Match'){

      document.getElementById("seriesText").innerHTML = msg; 
      // $('#show_err_acc_code').html('');
      $(this).val('');
      
    }else{

      document.getElementById("seriesText").innerHTML = msg; 
      // $('#show_err_acc_code').html('');
    }

  });

 $(document).ready(function(){


$('#btnsearch').click(function(){

  var acc_code   =  $('#acc_code').val();
  var series_code   =  $('#series_code').val();
  var allData = '';
    
     if(acc_code !='' || series_code !=''){

      $('#show_err_acc_code').html('');
      $('#tblpendingReport').DataTable().destroy();
      load_data(acc_code,series_code,allData); 

    }else{
      document.getElementById("plantText").innerHTML = ''; 
      $('#tblpendingReport').DataTable().destroy();
      allData = 'blank';
      load_data(acc_code,series_code,allData);
     
    }
  });

  $('#ResetId').click(function(){

          $('#acc_code').val('');
          document.getElementById("plantText").innerHTML = '';
  });


  load_data();

 

  function load_data(acc_code= '',series_code= '',allData=''){
    
    
     var date1 = new Date();
     var month = date1.getMonth() + 1;
     var tdate = date1.getDate();
     var mn = month.toString().length > 1 ? month : "0" + month;
     var yr = date1.getFullYear();
     var hr =  date1.getHours(); 
     var min = date1.getMinutes();
     var sec = date1.getSeconds(); 

     var curr_date = tdate+''+mn+''+yr;
     var curr_time = hr+':'+min+':'+sec;
     // console.log('curr_time',curr_time);

     $('#tblpendingReport').DataTable({


      footerCallback: function ( row, data, start, end, display ) {
        
       var rowcount = data.length;

        if(rowcount > 0){
           $('.buttons-excel').attr('disabled',false);
        }else{
           $('.buttons-excel').attr('disabled',true);
        }
      },

     Processing: true,
     serverSide: false,
     scrollX: true,
   // dom : 'Bfrtip',
    pageLength:'50',
    dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
             buttons: [
                        {
                        extend: 'excelHtml5',
                         exportOptions: {
                                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13]
                         },
                        title: 'DO_PLANNING_PENDING_'+$("#headerexcelDt").val(),
                        filename: 'DO_PLANNING_PENDING_'+$("#headerexcelDt").val(),
                        footer: true
                      }
                        ],

     
      ajax:{
        url:'{{ url("/Trips/DO-for-planning") }}',
        data: {acc_code:acc_code,series_code:series_code,allData:allData},
        dataType: "JSON",
      },

      columns: [
    
      {   
          data:'do_date',
          render: function (data, type, full, meta) {

            var doDate = full['do_date'];
            
            var doArr =   doDate.split(' ');

            var extDate = doArr[0];



            var extArr = extDate.split('-');

            var year =  extArr[0];
            var month =  extArr[1];
            var mdate=  extArr[2];

            return mdate+'-'+month+'-'+year;

          },
          className:'text-right',
          
      },
      {

          data:'DORDER_NO',
          name:'DORDER_NO',
          className:'text-right',
          
      },
      {   

          render: function (data, type, full, meta) {

            var cp_code = full['CP_CODE'];
            var cp_name = full['CP_NAME'];

            return cp_name+'['+cp_code+']';

           


          },
          className:'',
          
      },
       
      {

          data:'TO_PLACE',
          name:'TO_PLACE',
          className:'',
          
      },
      {data:'ALIAS_ITEM_CODE'},
      {
          render: function (data, type, full, meta) {

            var item_code = full['ITEM_CODE'];
            var item_name = full['ITEM_NAME'];

            return item_name+'['+item_code+']';

           


          },
          className:'',
          
      },
     
      {data:'ALIAS_ITEM_NAME'},
      {data:'RAKE_NO'},
      {data:'DO_WAGON_NO'},
      {

          data:'QTY',
          name:'QTY',

          render: function (data, type, full, meta) {

            var qty = full['QTY'];
            var um = full['UM'];

            if(qty=='' || qty == null){
               return '----' ;
            }else{
               return qty;
            }

          },
          className:'text-right',
          
      },
       {

          data:'UM',
          name:'UM',

          render: function (data, type, full, meta) {

           var um = full['UM'];

            if(um=='' || um == null){
               return '---' ;
            }else{
               return um;
            }

          },
          className:'text-left',
          
      },
      {

          data:'ACC_CODE',
          name:'ACC_CODE',
          className:'',
          
      },
      {

          data:'ACC_NAME',
          name:'ACC_NAME',
          className:'',
          
      },
      { render : function (data, type, full, meta){
       return '<span class="label label-danger">Pending</span>';
      },
     },
      


      ],

     });



  }

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







