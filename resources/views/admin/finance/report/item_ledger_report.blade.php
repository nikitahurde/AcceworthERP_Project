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
  .vdateAlign{
    text-align: center;
    width: 12%;
  }

  .alignRightClass{
    text-align: right;
  }

  .alignCenterClass{
    text-align: center;
  }

  .showSeletedName {

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

 }

 @media only screen and (max-width: 600px) {
  
  .dataTables_filter{
    margin-left: 35%;
  }

  .divScroll{
    overflow-x: scroll;
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
.hiddencolum{
  display: none;
}
.boxer {
    display: table;
    border-collapse: collapse;
  }
  .boxer .box-row {
    display: table-row;
  }
  .boxer .box-row:first-child {
    font-weight:bold;
  }
  .boxer .box10 {
    display: table-cell;
    vertical-align: top;
    border: 1px solid #ddd;
    padding: 5px;
  }
  
   .texIndbox1{
    width: 5%; 
    text-align: center;
  }
  .rateIndbox{
    width: 15%;
    text-align: center;
  }
  .itmdetlheading{
    vertical-align: middle !important;
    text-align: left;
  }
  .modltitletext {
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
  }
  .hsdiv{
    display: none;
  }
  .noDataF{
    color: #f65371;
  }
</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Item Ledger Report
            <small>Item Ledger Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">List Item Ledger Report</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Item Ledger Report</h2>

              <!-- <div class="box-tools pull-right">

                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

              </div> -->



            </div><!-- /.box-header -->

            <div class="box-body">

             <form id="myForm">



               @csrf

                <?php date_default_timezone_set('Asia/Kolkata'); ?>

              <div class="row">

                <div class="col-md-4">

                   <div class="form-group">

                    <?php $FromDate= date("d-m-Y", strtotime($fromDate));  
                         $ToDate= date("d-m-Y", strtotime($toDate)); 
                         $CurrentDate =date("d-m-Y");

                          ?>

                      <label for="exampleInputEmail1"> From Date: </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                       <input type="hidden" value="{{$FromDate}}" id="frmDate">
                        <input type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="Select Transaction Date" value="{{$FromDate}} " autocomplete="off">

                      </div>

                      <small id="showmsgfrdate"></small>
                      
                      <small id="show_err_from_date">

      

                      </small>

                  </div>

                 </div>



                 <div class="col-md-4">

                   <div class="form-group">

                      <label for="exampleInputEmail1"> To Date: </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                        <input type="hidden" value="{{$CurrentDate}}" id="todateVal">
                        <input type="text" name="to_date" id="to_date" class="form-control datepicker1" placeholder="Select Transaction Date" value="{{$CurrentDate}}" autocomplete="off">

                      </div>

                      <small id="showmsgtodate"></small>

                      <small id="show_err_to_date">

                      </small>

                  </div>

                 </div>

                 

                 <div class="col-md-4">

                   <div class="form-group">

                      <label for="exampleInputEmail1">Item Code : <span class="required-field"></span> </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>



                           <input list="itemList" id="item_code" name="item_code" class="form-control  pull-left" value="{{ old('item_code')}}" placeholder="Select Item Code" autocomplete="off">



                          <datalist id="itemList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($itemc_list as $key)

                            

                            <option value='<?php echo $key->ITEM_CODE?>'   data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                            

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="itemText"></div>

                     </small>

                     <small id="show_err_item">

                        

                     </small>

                  </div>

                  
                </div><!-- /.col -->

              </div><!-- /.row -->



              <div class="row">

                <div class="col-md-3">

                 
                  <div class="form-group">

                      <label for="exampleInputEmail1">T Code : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-building-o" aria-hidden="true"></i>

                          </div>

                          <input list="tranList"  id="tran_code" name="tran_code" class="form-control  pull-left" value="{{ old('pfct_code')}}" placeholder="Select Tran Code" autocomplete="off">



                          <datalist id="tranList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($tran_list as $key)

                            

                            <option value='<?php echo $key->TRAN_CODE; ?>'   data-xyz ="<?php echo $key->TRAN_HEAD; ?>" ><?php echo $key->TRAN_HEAD ; echo " [".$key->TRAN_CODE."]" ; ?></option>



                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="pfctText"></div>

                     </small>

                     <small id="show_err_dept_code">

                      </small>
                     
                  </div>

                </div>

                <div class="col-md-3">

                 
                  <div class="form-group">

                      <label for="exampleInputEmail1">Pfct Code : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-building-o" aria-hidden="true"></i>

                          </div>

                          <input list="pfctList"  id="pfct_code" name="pfct_code" class="form-control  pull-left" value="{{ old('pfct_code')}}" placeholder="Select Pfct Code" autocomplete="off">



                          <datalist id="pfctList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($pfct_list as $key)

                            

                            <option value='<?php echo $key->PFCT_CODE?>'   data-xyz ="<?php echo $key->PFCT_NAME; ?>" ><?php echo $key->PFCT_NAME ; echo " [".$key->PFCT_CODE."]"; ?></option>



                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="pfctText"></div>

                     </small>

                     <small id="show_err_dept_code">

                      </small>
                     
                  </div>

                </div><!-- /.col -->



                <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Vr No : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>



                          <input type="text" id="vr_num" name="vr_num" class="form-control  pull-left" value="{{ old('vr_num')}}" placeholder="Enter vr no" autocomplete="off">


                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans">

                        

                      </small>
                     <span id='searcherr' style="color: red;"></span>
                  </div>

                </div><!-- /.col -->

                

                <div class="col-md-3" style="margin-top: 3%;">
                  


                    <div class="">

               <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch" style="padding: 5px;"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

               </div>

                </div>

              </div>

              



               

             </form>

            </div><!-- /.box-body -->



            <div class="box-body divScroll" style="margin-top: -2%;">

  <button type="button" id="btnpdf" class="btn btn-danger btn-sm" style="margin-left: 5px !important;
    margin-bottom: -44px !important;" disabled=""><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF </button>
<table id="InwardDispatch" class="table table-bordered table-striped table-hover itmLedger tableScroll">


  <thead class="theadC">

    

    <tr>
      <th class="text-center" style="width: 5%;">Sr. No</th>
      <th class="text-center" style="width: 12%;">Date</th>
      
      <th class="text-center" style="width: 12%;">Vr no</th>
     <!--  <th class="text-center">T-Code</th> -->
      <th class="text-center" style="width: 15%;">Remark</th>
      <th class="text-center" style="width: 15%;">Received Qty</th>
      <th class="text-center" style="width: 15%;">Issued Qty</th>
      <th class="text-center" style="width: 15%;">Closing Qty</th>
      <th class="text-center hiddencolum">opn</th>
      

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



</div><!-- /.box-body -->


<div class="box-body hsdiv" style="margin-top: 0%;" id="detailsbox">
  <div class="row" style="border: 1px solid #d2d6de;margin: 5px;padding-top:30px;padding-bottom:30px;box-shadow: 0px 0px 8px -3px rgb(0 0 0 / 75%);border-radius: 5px;">

      <div class='row' style="margin-left: 20px;">
        <div class="col-md-4">
        <p id="tNature"></p>
        </div>
        <div class="col-md-4">
        <p id="qtyrecd"></p>
        </div>
        <div class="col-md-4">
        <p id="qtyissued"></p>
        </div>
      </div>
      
      <div class='row' style="margin-left: 20px;">
        <div class="col-md-4">
           <p id="accCode"></p>
        </div>
        <div class="col-md-4">
          <p id="rate"></p>
        </div>
        <div class="col-md-4">
          <p id="dr_amt"></p>
        </div>
         
      </div>
      <div class='row' style="margin-left: 20px;">
        <div class="col-md-4">
          <p id="particuler"></p>
        </div>
      </div>

  </div>
</div>
 <!--    <div style="text-align: center;font-weight: bold;" id="errorItem"></div> -->
  <div  style="margin-left: 20px;font-weight: bold;"><span id="detailsitem" style="font-size:14px;"></span>&nbsp;&nbsp;&nbsp;<span id="detailscalval" style="font-size:14px;"></span></div><br>
  


  </section>

</div>





@include('admin.include.footer')

<script type="text/javascript">
  
  $('#btnpdf').click(function(){

         var from_date =  $('#from_date').val();

          var to_date =  $('#to_date').val();

          var item_code =  $('#item_code').val();

          var pfct_code =  $('#pfct_code').val();

          var tran_code =  $('#tran_code').val();
         
          var vr_num =  $('#vr_num').val();

          var btnsearch =  $('#btnsearch').val();
          
          /*var vrno       =  $('#vr_num').val();

          var vrnum = vrno.split(' ');

          var vr_num = vrnum[2];*/

         // var btnsearch =  $('#btnsearch').val();

          //var trans_code =  $('#trans_code').val();
          //alert(from_date);return false;

          if (item_code!='' || pfct_code!='' || from_date!='' || to_date!='' || vr_num!='') {

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

                                url:"{{ url('/report/item-ledger-report-pdf/pdf') }}",

                                method : "POST",

                                type: "GET",

                                data: {item_code:item_code,pfct_code:pfct_code,vr_num:vr_num,from_date:from_date,to_date:to_date,tran_code:tran_code},

                                

                                success: function(response){

                                 console.log('response',response);

                                  if(response.response == 'success' && response.data !=''){

                                      var link = document.createElement('a');
                                      link.href = response.url;
                                      link.download = 'item ledger report.pdf';
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

          }else{
             document.getElementById("itemText").innerHTML = msg;
          }


        });



       $("#pfct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#pfctList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          if(msg == 'No Match'){
            document.getElementById("pfctText").innerHTML = ''; 
            var val = $(this).val('');
          }else{
            document.getElementById("pfctText").innerHTML = msg; 
          }

          

        });


       $("#series_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#seriesList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("seriesText").innerHTML = msg; 

        });





      

    });



  

</script>

<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(item_code= '', pfct_code='',from_date='',to_date='',vr_num='',tran_code=''){


          $('#InwardDispatch').DataTable({

              

            footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
                var dataobject = api.column(7).data();
                if(dataobject[0] < 0){
                  $('#totl_issu_qty').html(dataobject[0]);
                }else{
                  $('#totl_recv_qty').html(dataobject[0]);
                }
                //$('#getval').html(dataobject[0]);
     
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                var rowcount = data.length;
                
                var getRow = rowcount-1;
                var opebal = api.column(6).data();
                if(opebal[getRow]){
                 var closngQty = opebal[getRow];
                }else{
                 var closngQty = 0;
                }
     
                var tueTotal = api
                  .column( 4 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                var twoTotal = api
                  .column( 5 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                var threeTotal = api
                  .column( 6 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );


                   
                    $( api.column( 4 ).footer() ).html(parseFloat(tueTotal).toFixed(2));
                    $( api.column( 5 ).footer() ).html(parseFloat(twoTotal).toFixed(2));
                    $( api.column( 6 ).footer() ).html(closngQty);
                    
                  },

              'fnCreatedRow': function (nRow, aData, iDataIndex) {
                console.log('aData',aData['TRAN_CODE']);
                  $(nRow).attr('onclick', "showDetail("+aData['VRNO']+",\"" + aData['TRAN_CODE'] + "\",\""+aData['ITEM_CODE']+"\");"); // or whatever you choose to set as the id
              },
              processing: true,
              serverSide: true,
              responsive: true,
              /*scrollX: true,*/
              pageLength:'25',
              dom: "<'top'<'row'  <'col-sm-12'>>" +"<'row'<'col-sm-4'B><'col-sm-4'<'toolbar'> ><'col-sm-4'f>>><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",

              buttons: [
                      /*{
                          extend: 'excelHtml5',
                          exportOptions: {
                                columns: [0,1,2,3,4,5,6]
                          }
                        },*/
                       
                        ],
              ajax:{
                url:'{{ url("/report-item-ledger") }}',
                data: {item_code:item_code,pfct_code:pfct_code,vr_num:vr_num,from_date:from_date,to_date:to_date,tran_code:tran_code},
                 
              },
              columns: [

                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex',
                    className: "alignCenterClass",
                },
                {
                    data:'VRDATE',
                    className:'vdateAlign',
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
                     render: function (data, type, full, meta) {

                      var mvrate = full['MAVGRATE'];
                      var clval = full['CLVAL'];

                      console.log('CLVAL',clval);

                      if(mvrate){
                        getitembalData(mvrate,clval);
                      }else{
                        
                      }

                        if(full['series_code']){

                        var series_code = full['series_code'];
                        }else{
                        var series_code = '';
                        }
                        
                        var vr_no = full['VRNO'];
                       
                          
                        return series_code + ' ' + vr_no;
                      
                        
                    },

                    className:'alignRightClass',
                    
                },
                 
                {
                    data:'PARTICULAR',
                    name:'PARTICULAR'
                },
                
                {
                   data:'QTYRECD',
                   name:'QTYRECD',
                   
                    className:'alignRightClass'
                },
                {
                    data:'QTYISSUED',
                    name:'QTYISSUED',
                   
                    className:'alignRightClass'
                },
                {
                    data:'balence',
                    name:'balence',
                    className:'alignRightClass'
                },
                {
                    data:'balence',
                    name:'balence',
                    className:'hiddencolum'
                },

              ]


          });

           //$("div.toolbar").html('<span class="label label-danger" style="margin-right: 32%;font-size: 12px;">Opening Bal : <b id="getval"></b></span>').css('text-align','center');

       }


       $('#btnsearch').click(function(){



          var from_date =  $('#from_date').val();

          var to_date =  $('#to_date').val();

          var item_code =  $('#item_code').val();

          var pfct_code =  $('#pfct_code').val();

          var tran_code =  $('#tran_code').val();
         
          var vr_num =  $('#vr_num').val();

          var btnsearch =  $('#btnsearch').val();

          //var trans_code =  $('#trans_code').val();
          //alert(from_date);return false;

         if(item_code=='')
         {
             $('#show_err_item').html('Please Select Item Code').css('color','red');

             $('#InwardDispatch').DataTable().destroy();
            load_data();

                return false;
         }

          if (item_code!='' || pfct_code!='' || from_date!='' || to_date!='' || vr_num!='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');
            $('#show_err_item').html('');

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
            load_data(item_code,pfct_code,from_date,to_date,vr_num,tran_code);

            $('#btnpdf').prop('disabled',false);

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

              
              
              $('#item_code').val('');
              
              $('#pfct_code').val('');
              $('#vr_num').val('');
               $('#btnpdf').prop('disabled',true);

          document.getElementById("itemText").innerHTML = '';
          document.getElementById("pfctText").innerHTML = '';
          $('#InwardDispatch').DataTable().destroy();
          load_data();

        });

  });





</script>

<script type="text/javascript">
  
  function getitembalData(mvrate,clval){

    console.log('mvrate',mvrate);

    if(clval){
      $("#detailscalval").html('CALVAL'+' - '+'<b class="label label-info">'+clval+'<b>');
    }else{
      $("#detailscalval").html('');
    }

    if(mvrate){
       $("#detailsitem").html('MVGR'+' - '+'<b class="label label-success">'+mvrate+'<b>');
      
     }else{
      
      $("#detailsitem").html('');
     }
   
  }

  $(document).ready(function() {

    $("#item_code").on('change', function(event) {

        $("#detailscalval").html('');

         $("#detailsitem").html('');

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

    $('#from_date').on('change',function(){

      var frDate = $('#from_date').val();
      
      var slipD =  frDate.split('-');
      var Tdate = slipD[0];
      var Tmonth = slipD[1];
      var Tyear = slipD[2];
      var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;
      var selectedDate = new Date(getproperDate);
      var todayDate = new Date();
        if(selectedDate > todayDate){
          $('#showmsgfrdate').html('To Date Can Not Be Greater Than Today').css('color','red');
          $('#from_date').val('');
          var getfrDate = $('#frmDate').val();
          $('#from_date').val(getfrDate);
          return false;
        }else{
          $('#showmsgfrdate').html('');
          return true;
        }
    });


    $('#to_date').on('change',function(){

      var toDate = $('#to_date').val();
      var slipD =  toDate.split('-');
      var Tdate = slipD[0];
      var Tmonth = slipD[1];
      var Tyear = slipD[2];
      var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;
      var selectedDate = new Date(getproperDate);
      var todayDate = new Date();

        if(selectedDate > todayDate){
          $('#to_date').val('');
          $('#showmsgtodate').html('To Date Can Not Be Greater Than Today').css('color','red');
          var todt = $('#todateVal').val();
          $('#to_date').val(todt);
          return false;
        }else{
          $('#showmsgtodate').html('');
          return true;
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


function showDetail(vrNo,transC,itmC){

    var vrNo,transC,itmC;


    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });

    $.ajax({

          url:"{{ url('get-detail-from-trans-in-item-ledger') }}",

          method : "POST",

          type: "JSON",

          data: {vrNo:vrNo,transC:transC,itmC:itmC},

          success:function(data){

              var data1 = JSON.parse(data);

              console.log(data1);

              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
               

              }else if(data1.response == 'success'){

                  if(data1.data==''){
                   
                  }else{

                    $('#detailsbox').removeClass('hsdiv');
                   
                    if(data1.data[0].PREFNO){
                      var partyRefN = data1.data[0].PREFNO;
                    }else{
                      var partyRefN = '<b class="noDataF">Not Found</b>';
                    }

                    if(data1.data[0].AQTYRECD){
                      var purBillNo = data1.data[0].AQTYRECD;
                    }else{
                      var purBillNo = '<b class="noDataF">Not Found</b>';
                    }
                    if(data1.data[0].AQTYISSUED){
                      var qtyIssued = data1.data[0].AQTYISSUED;
                    }else{
                      var qtyIssued = '<b class="">0.00</b>';
                    }

                    if(data1.data[0].PREFDATE){
                      var partyRDate = data1.data[0].PREFDATE;
                    }else{
                      var partyRDate = '<b class="noDataF">Not Found</b>';
                    }

                

                    if(data1.data[0].REMARK){
                      var PARTICULAR = data1.data[0].REMARK;
                    }else{
                      var PARTICULAR = '<b class="noDataF">Not Found</b>';
                    }

                    if(data1.data[0].RATE){
                      var rate = data1.data[0].RATE;
                    }else{
                      var rate = '<b class="noDataF">Not Found</b>';
                    }

                    if(data1.data[0].CRAMT){
                      var dramt = data1.data[0].CRAMT;
                    }else{
                      var dramt = '<b class="noDataF">Not Found</b>';
                    }

                    if(data1.data[0].ACC_CODE){
                      var accCode = data1.data[0].ACC_CODE+' - '+data1.data[0].ACC_NAME;
                    }else{
                      var accCode = '<b class="noDataF">Not Found</b>';
                    }

                    $('#tNature').html('<b>T NATURE </b> : '+data1.data[0].TRAN_CODE+' - '+data1.data[0].TRAN_HEAD);

                     $('#accCode').html('<b>ACC CODE </b> : '+accCode);
                    $('#rate').html('<b>RATE </b> : '+rate);
                    $('#dr_amt').html('<b>AMOUNT </b> : '+dramt);
                    $('#qtyrecd').html('<b>AQTYRECD </b> : '+purBillNo);
                    $('#qtyissued').html('<b>AQTYISSUED  </b> : '+qtyIssued);
                    $('#particuler').html('<b>PARTICULAR  </b> : '+PARTICULAR);
                    /*$('#batchNo').html('<b>Batch No </b> : '+batchN);*/
                   
                   /* $.each(obj_row, function (i, obj_row) {

                    });*/
                  }
                      
              }
          }

    });


}

</script>

@endsection