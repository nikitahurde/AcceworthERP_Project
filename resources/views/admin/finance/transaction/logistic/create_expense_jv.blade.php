@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')
<style type="text/css">

    .tdsratebtnHide{
      display: none;
    }
    .PageTitle{
      margin-right: 1px !important;
    }
    .required-field::before {
      content: "*";
      color: red;
    }
    .textRight{
      text-align: right;
    }
    .rightcontent{
      text-align:right;
    }
    ::placeholder {
      text-align:left;
    }
    .text-center{
      text-align: center;
    }
    .tdthtablebordr{
      border: 1px solid #00BB64;
    }
    .modltitletext{
      font-weight: 800;
      color: #5696bb;
      text-align: center;
      font-size: 16px;
    }
    .aplynotStatus{
      display: none;
    }
    .inputtaxInd{
      background-color: white !important;
      border: none;
      text-align: center;
    }
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
    .alignRightClass{
      text-align: right;
    }
    .alignCenterClass{
      text-align: center;
    }
    .alignLeftClass{
      text-align: left;
    }
    .showSeletedName {
      font-size: 12px;
      margin-top: 2%;
      text-align: center;
      font-weight: 600;
      color: #4f90b5;
    }
    .modal-header .close {
      margin-top: -25px !important;
      margin-right: 2% !important;
    }
    ::placeholder {
      text-align:left;
    }
    .inputBoxT{
      width:100%;
      font-size:12px;
    }
    .applyBTn{
      margin-top: 7px;
    }
    .iconBtnSty{
      border-radius: 100px;
      padding: 4px;
    }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>
      Create Expense Jv 
      <small> : Report Details</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Report</a></li>

      <li><a href="{{ url('/dashboard') }}">Logistic</a></li>

      <li class="active"><a href="{{ url('/report/purchase/purchase-indent-report') }}">Create Expense Jv</a></li>

    </ol>

  </section><!-- --sectio -->

  <section class="content" style="min-height: 150px;margin-bottom: -26px;">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Create Expense Jv</h2>

      </div><!-- /.box-header -->

      <div class="box-body">

        <?php date_default_timezone_set('Asia/Kolkata'); ?>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-2">

            <?php 

              $CurrentDate =date("d-m-Y");
                 
              $FromDate    = date("d-m-Y", strtotime($fromDate));  
                 
              $ToDate      = date("d-m-Y", strtotime($toDate));  
                 
              $formCurrentDt = date("Y-m-d", strtotime($CurrentDate));

              if($formCurrentDt > $toDate){
                $vrDate =$ToDate;
              }else{
                $vrDate =$CurrentDate;
              }

            ?>

            <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

            <input type="hidden" name="" value="<?php echo $vrDate; ?>" id="ToDateFy">

            <div class="form-group">

              <label for="exampleInputEmail1"> From Date : </label>

              <div class="input-group">

                <div class="input-group-addon">

                  <i class="fa fa-calendar"></i>

                </div>
              
                <?php $currentDate = date('d-m-Y'); ?>
                <input type="text" name="from_date" id="from_date" class="form-control fromDatePc rightcontent datepicker" placeholder="Select From Date" value="<?= $FromDate; ?>" autocomplete="off">

              </div>

              <small id="emailHelp" class="form-text text-muted">
                    {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}
              </small>

              <small id="show_err_from_date"></small>

            </div>

          </div><!-- /.col -->

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1"> To Date : </label>

              <div class="input-group">

                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
              
                <input type="text" name="to_date" id="to_date" class="form-control toDatePc rightcontent" placeholder="Select To Date" value="{{$vrDate}}" autocomplete="off">

              </div>

              <small id="emailHelp" class="form-text text-muted">
                    {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}
              </small>

              <small id="show_err_to_date"></small>

            </div>

          </div><!-- /.col -->

         

         <!-- /.col -->

        

         
              
        </div><!-- /.row -->

        <div class="row">

          <!-- /.col -->
         <div class="col-md-5"></div>
          <div class="col-md-3">

            <div style="margin-top: 5%;">

              <button type="button" class="btn btn-primary btn-sm" name="searchdata" id="btnsearch" style="padding:0px 2px;"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>&nbsp;&nbsp;&nbsp;

              <button type="button" class="btn btn-default btn-sm" name="searchdata" id="ResetId" style="padding:0px 2px;" ><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

            </div>

          </div><!-- /.col -->
          <div class="col-md-3"></div>

        </div><!-- /.row -->

      </div><!-- /.box-body -->

    </div><!-- /.custom box -->

<!----- START : TAX CALC MODAL -------->

     

<!----- END : TAX CALC MODAL -------->

<!-- ------ SIMULATION MODAL ------------  -->
  
  

<!-- ------ SIMULATION MODAL ------------  -->

</section>

<section class="content">

  <div class="box box-primary Custom-Box">

    <div class="box-header with-border" style="text-align: center;"></div>

    <div class="box-body" style="margin-top: -2%;">

      <table id="TransportBillTable" class="table table-bordered table-striped table-hover">

        <thead class="theadC">

          <tr>
            <!-- <th class="text-center">#</th> -->
            <th class="text-center">Sr.No</th>
            <th class="text-center">Date</th>
            <th class="text-center">Vehicle No </th>
            <th class="text-center">Vr No </th>
            <th class="text-center">Transporter</th>
            <th class="text-center">To Place</th>
            <th class="text-center">Consinee</th>
            <th class="text-center">Owner</th>
            <th class="text-center">Vehicle Type</th>
            
           
        
            
          </tr>

        </thead>

        <tbody id="defualtSearch">

        </tbody>
 
        <tfoot align="right">
          <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
        </tfoot>

      </table>

     

      <div class="row">

          <div class="col-md-12" style="text-align: center;">

            <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">

             <button type="submit" name="submit" value="submit" id="submitinparty" class='btn btn-success btn-sm' onclick="submitBillGenerate(0)" disabled="" style="font-size: 12px;line-height: 1;padding: 4px;">Save</button> 

            <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();" style="font-size: 12px;line-height: 1;padding: 4px;"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

            <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitBillGenerate(1)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download Pdf</button>

          <!--   <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitBillGenerate(1)" disabled style="font-size: 12px;line-height: 1;padding: 4px;"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download Pdf</button> -->
          </div>

      </div>

    </div><!-- /.box-body -->
        
  </div><!-- /.custom box -->

</section><!-- /.section -->

</div>

<!------- MODAL FOR CALCULATE TDS ------------>

   
<!------- MODAL FOR CALCULATE TDS ------------>
 
@include('admin.include.footer')




<script type="text/javascript">




load_data_query()


  function load_data_query(from_date='',to_date=''){



   
      $('#TransportBillTable').DataTable({


        footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;

                $( api.column(7).footer() ).html('<small class="texttotal" id="settextfot">Total :- </small>').css('text-align','right');

                $( api.column(8).footer() ).html('<small id="basicTotalAmt"></small><br><small id="nextAmtTot"></small><input type="hidden" id="totlFreightAmt" name="totlFreightAmt" value="">');

                console.log(api.column(9));
            
          }, 

          processing: true,
          serverSide: true,
         // scrollX: true,
          pageLength:'25',
         
          ajax:{
            url:'{{ url("/logistic/create-expense-jv") }}',
            data: {from_date:from_date,to_date:to_date}
          },

          columns: [

           /* { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.TRIPHID+')"><i class="fa fa-plus" id="minus'+full.TRIPHID+'" title="Toggle"></i></button>'
          }
         },*/
            { 
              data:"DT_RowIndex",
              name:"DT_RowIndex",
              className:"text-center",
              'render': function (data, type, full, meta){
                         return '<input type="checkbox" name="flit_id[]" onclick="clickCheck()" class="flitClass" value="'+full['TRIPHID']+'"><input type="hidden" name="tripHeadid"  value="'+full['tripHeadId']+'">';
                     }
            },
            {
                data:'VRDATE',
                name:'VRDATE'
            },
            {
                data:'VehicleNo',
                name:'VehicleNo',
                className: "alignCenterClass",

                 render: function (data, type, full, meta){
                  
                  var vehicle_no = full['VehicleNo'];

                 
                 return vehicle_no;

                }
            },
            {
                data:'VRNO',
                name:'VRNO',
                className: "alignCenterClass",

            },
            {
                data:'TRANSPORT_NAME',
                name:'TRANSPORT_NAME'
            },
            
            {
                data:'TO_PLACE',
                name:'TO_PLACE'
            },
            {   data:'CP_CODE',
               render: function (data, type, full, meta){
                   var cp_code =  full['CP_CODE']+' - '+full['CP_NAME'];

                   return cp_code;
                },
            },
            {
                data:'OWNER',
                name:'OWNER',  
            },
            {
                data:'VEHICLE_TYPE',
                name:'VEHICLE_TYPE',
            },
           
            
          ]


      });


   }
  

  $(document).ready(function() {

    var fromdateintrans = $('#FromDateFy').val();
      var todateintrans = $('#ToDateFy').val();

     $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      startDate :fromdateintrans,
      endDate : todateintrans,      
      autoclose: 'true'

    });

    $("#from_date").click(function() {

      $("#to_date").val('');
      $('#to_date').datepicker('destroy');

    });

    $("#to_date").click(function() {

        var fromDate = $('#from_date').val();
        console.log('fromDate',fromDate);
        var splitFrom    = fromDate.split("-");

        var mergeFrDate = splitFrom[1]+'-'+splitFrom[0]+'-'+splitFrom[2];
        var getmergeFr = new Date(mergeFrDate);

        getmergeFr.setDate(getmergeFr.getDate() + 1); 

        var getdate = getmergeFr.getDate();
        var getMonth=getmergeFr.getMonth()+1;
        var getYear = getmergeFr.getFullYear();
        var netDate =getYear+'-'+getMonth+'-'+getdate;

        var dt = new Date(netDate);
        var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(dt);
        var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(dt);

        var middleDateStart =da+'-'+mo+'-'+getYear;

        $('#to_date').datepicker({
          format: 'dd-mm-yyyy',
          orientation: 'bottom',
          todayHighlight: 'true',
          startDate: middleDateStart,
          endDate: todateintrans,
          autoclose: 'true'
        });
         $('#to_date').datepicker('show');

        
    });
   

    $('#btnsearch').click(function(){

          var from_date  =  $('#from_date').val();

          var to_date    =  $('#to_date').val();

        
     
          if (from_date!='' || to_date!='') {

            
            if(from_date!=''){
              if(to_date==''){
                $('#show_err_to_date').html('Please select to date').css('color','red');
                return false;
              }
            }

            if(to_date!=''){
              if(from_date==''){
                $('#show_err_from_date').html('Please select from date').css('color','red');
                return false;
              }
            }

            $('#TransportBillTable').DataTable().destroy();

            load_data_query(from_date,to_date);

          }else{
            $('#TransportBillTable').DataTable().destroy();
            load_data_query();
            
          }


        });


    $('#ResetId').click(function(){
  
      $('#item_code').val('');
      $('#vr_num').val('');
      $('#accountText').html('');

    
      $('#TransportBillTable').DataTable().destroy();
      load_data_query();

    });
  

});

</script>

<script type="text/javascript">
  
   function showchildtable(tblid){
            var tblid;

            
            console.log('tblid',tblid);

             $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });
             
             $("#minus"+tblid).toggleClass('fa-plus fa-minus rotate');

             $.ajax({

              url:"{{ url('view-fleet-trans-chield-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {tblid:tblid},

               success:function(data){

                  var data1 = JSON.parse(data);

                  console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                         var objrow = data1.data;
                         var srNo=1;
                         var tableid = objrow[0].FLEETTRANEXPID;

                         console.log(tableid);
                       $.each(objrow, function (row, objrow) {

                        
                         $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td class="text-center"><p>'+objrow.IND_NAME+' </p></td><td class="text-center">'+objrow.GL_CODE+'</td><td class="text-right">'+objrow.AMOUNT+'</td></tr>');
                              srNo++;

                          });

                      }
                      
                  }
               }

          });
    }
</script>

<script type="text/javascript">
  
    $(document).ready(function(){

         var creditAmount = 0;
         var grandAmt = 0;
         var totlFreightAmt = 0;
       // $('#TransportBillTable').DataTable();

        $("#TransportBillTable").on('change', function() {
          var creditAmount = 0;
          var grandAmt = 0;
          var totlFreightAmt = 0;
            var checkedCount = $("#TransportBillTable input:checked").length;
            console.log('count',checkedCount);
            if(checkedCount == 0){
              $("#simulation").prop('disabled',true);
              $("#submitinparty").prop('disabled',true);
              $("#submitdatapdf").prop('disabled',true);
              $("#tds_rate").prop('disabled',true);
            }else{
              $("#simulation").prop('disabled',false);
              $("#submitinparty").prop('disabled',false);
              $("#submitdatapdf").prop('disabled',false);
              $("#tds_rate").prop('disabled',false);
            }
           
            for (var i = 0; i < checkedCount; i++) {
              var ii= i+1;
              var amount = $("#TransportBillTable input:checked")[i].parentNode.parentNode.children[11].innerHTML;

              var vehicle_no = $("#TransportBillTable input:checked")[i].parentNode.parentNode.children[1].innerHTML;

               var freightAmt = $("#TransportBillTable input:checked")[i].parentNode.parentNode.children[7].innerHTML;
      
              if (amount != "") {
                creditAmount += parseFloat(amount);
              } else {
                creditAmount = 0;

              }

              if (freightAmt != "") {
                totlFreightAmt += parseFloat(freightAmt);
              } else {
                totlFreightAmt = 0;

              }

            }

            $("#totlFreightAmt").val(totlFreightAmt.toFixed(2));
            $("#basicTotalAmt").text(creditAmount.toFixed(2));
            $("#nextAmtTot").text(creditAmount.toFixed(2));
            $("#basic").val(creditAmount.toFixed(2));
            $("#getNetAmnt").val(creditAmount.toFixed(2));
          //  $("#netAmt").text(grandAmt.toFixed(2));
            //$("#netAmount").val(grandAmt.toFixed(2));
        });

    }); 
</script>


<script type="text/javascript">
  
  function clickCheck(){

    $('#pertText').val('');

    $('.flitClass').each(function(){

      if($(this).is(":checked")){

          var getpertText = $('#pertText').val();

          var getString = $(this).val();

         // getString.replaceAll("~", "-");
                 
          $('#pertText').val(getpertText+','+getString);
            
              var chekcValue = $(this).val();

              $("#chekcValue").val(chekcValue);

             $("#submitinparty").prop('disabled',false);
             $("#submitdatapdf").prop('disabled',false);
            
      }else{
    
      }
    });

  }
  
</script>


  <script type="text/javascript">
    
    function submitBillGenerate(valp){  

      var downloadFlg = valp;

      $('#pdfYesNoStatus').val(downloadFlg);

      var flitClass=[];
      var newAarry =[];

      $('.flitClass').each(function(){
          if($(this).is(":checked"))
          {
           var flitClass1 = $(this).val();


           flitClass.push(flitClass1);
           
           }
      });


    

        $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        $.ajax({

          url:"{{ url('/logistic/save-expense-jv-self') }}",

           method : "POST",

           type: "JSON",

           data: {flitClass: flitClass,downloadFlg:downloadFlg},

           
           success:function(data){

           console.log(data);

              var data1 = JSON.parse(data);

              
              if(data1.response == 'error') {
               var responseVar = false;

              var url = "{{url('create-expense-jv-self')}}";
              setTimeout(function(){ window.location = url; });
              }else{
               

               var ulrLenght = data1.url.length;

                for(var q=0;q<ulrLenght;q++){

                          var fileN     = 'JVTRAN_'+q;
                          
                          var link      = document.createElement('a');
                          link.href = data1.url[q];
                          link.download = 'JVTRAN_.pdf';

                          link.dispatchEvent(new MouseEvent('click'));

                        }

               var responseVar = true;

              var url = "{{url('create-expense-jv-self')}}";
              setTimeout(function(){ window.location = url; });
              }

            
           }

        });


    }

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