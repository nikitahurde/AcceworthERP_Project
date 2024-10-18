@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')

<style>
  

  .text-right{
    text-align: right;
  }

  .datebill{
     width: 90px;
     text-align: right;
  }
  .texIndbox{
    text-align: left !important;
  }
  .texIndboxright{
    text-align: right !important;
  }
  .modltitletext {
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
}
/*.table>tbody>tr:hover {
  background-color: #697068 !important;
}*/
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #697068 !important;
}

.table tbody  tr  td #expired {
  color:white !important;
}
@keyframes blinker {
  50% {
    opacity: 0;
  }
}

/* ----- excel btn css ------ */


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

  table.dataTable {
      clear: both;
      margin-top: 10px !important;
      margin-bottom: 6px !important;
      max-width: none !important;
  }
 
  @media screen and (max-width: 600px) {

  .PageTitle{

    float: left;

  }

}

  /* /.----- excel btn css ------ */


</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Vehicle Documentation Updation
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

             <small><b>View Details</b></small> 

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>Vehicle Documentation Updation</a></li>
          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Vehicle Documentation Updation</h3>

                  <div class="box-tools pull-right">

                    <a href="{{url('/logistic/fleet-certificate-transaction-form')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Vehicle Doc</a>

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

            <form action="">
            <div class="box-body">
               <!-- <div class="overlay-spinner hideloader"></div>  -->  
              <table id="example" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>

                    <th class="text-center" style="width:25px;">Sr No</th>

                    <th class="text-center" style="width:100px;">Vehicle No</th>

                    <th class="text-center" style="width:104;">Certificate Code</th>

                    <th class="text-center" style="width:104;">Certificate Name</th>

                    <th class="text-center" style="width:104;">Certificate Number</th>

                    <th class="text-center" style="width:104;">Certificate Date</th>

                    <th class="text-center" style="width:104;">Renew Date</th>

                    <th class="text-center" style="width:104;">Vehicle Information</th>

                    <th class="text-center" style="width:104;">Action</th>
                    
                  </tr>

                </thead>

                <tbody>

                  <?php $srno = 1;?>

                  @foreach ($expireData as $row)

                   <tr  style="background-color: #d15b4d ;"> 

                    <td class="text-center"  style="color:white;">
                      {{$srno}}
                    </td>

                    <td  style="color:white;">
                    
                    {{$row->TRUCK_NO }} 
                      
                    </td>
                   
                    <td  style="color:white;">
                      
                      {{ $row->CERTF_CODE }} 
                       
                    </td>

                    <td  style="color:white;">
                      
                     {{$row->CERTF_NAME }} 
                       
                    </td>

                    <td class="text-right"  style="color:white;">
                      
                     {{$row->CERTF_NO}} 
                       
                    </td>
                    
                    <td class="text-right"  style="color:white;">
                     <?php  $cer_date = $row->CERTF_DATE;

                        if($cer_date !='' || $cer_date != null){
                           $cerDate = date("d-m-Y", strtotime($row->CERTF_DATE));
                        
                       ?>
                       <span style="width:30px"> {{$cerDate}}</span>
                       <?php }else{ ?>
                       <span style="width:30px"> {{$cer_date}}</span>
                       <?php } ?>
                    </td>

                    <td class="text-right" style="color:white;">

                      <?php  $cer_renew_date = date("d-m-Y", strtotime($row->CERTF_RENEW_DATE)); ?>
                       
                      <span style="width:30px">{{$cer_renew_date}}</span>
                       
                    </td>

                     <td class="text-center">
                        <button type="button" class="btn btn-xs btn-primary" style="font-size: 8px;"data-toggle="modal" data-target="#vehicalInforamtion" onclick="funVehiInfo('{{$row->TRUCK_NO }}', '{{ $row->CERTF_CODE }}' , '{{$row->CERTF_NAME }}')">
                          <i class="fa fa-plus"> Info</i>
                        </button>
                      </td>

                    <td align="center" >
                      <span class="label label-danger">Expired</span>
                    </td>
                   
                   </tr>
                  <?php $srno++; ?>

                  @endforeach

                  @foreach($twoDayData as $row)

                   <tr> 
                      <td class="text-center">
                        {{$srno}}
                      </td>

                      <td >
                      
                      {{$row->TRUCK_NO }} 
                        
                      </td>
                     
                      <td>
                        
                       {{ $row->CERTF_CODE }} 
                         
                      </td>

                      <td>
                        
                       {{$row->CERTF_NAME }}
                         
                       </td>

                      <td class="text-right">
                        
                       {{$row->CERTF_NO}} 
                         
                      </td>
                      
                      <td class="text-right">
                      <?php  $cer_date = $row->CERTF_DATE;

                        if($cer_date !='' || $cer_date != null){
                           $cerDate = date("d-m-Y", strtotime($row->CERTF_DATE));
                        
                       ?>
                       <span style="width:30px"> {{$cerDate}}</span>
                       <?php }else{ ?>
                       <span style="width:30px"> {{$cer_date}}</span>
                       <?php } ?>
                      
                      </td>

                      <td class="text-right">

                        <?php  $cer_renew_date = date("d-m-Y", strtotime($row->CERTF_RENEW_DATE)); ?>
                         
                        <span style="width:30px;font-weight:900;animation: blinker 1s linear infinite;color:red;">{{$cer_renew_date}}</span>
                         
                      </td>

                      <td class="text-center">
                        <button type="button" class="btn btn-xs btn-primary" style="font-size: 8px;"data-toggle="modal" data-target="#vehicalInforamtion" onclick="funVehiInfo('{{$row->TRUCK_NO }}', '{{ $row->CERTF_CODE }}' , '{{$row->CERTF_NAME }}')">
                          <i class="fa fa-plus"> Info</i>
                        </button>
                      </td>

                      <td align="center">

                         <?php 
                          date_default_timezone_set('Asia/Kolkata');
                          $current_date = date('d-m-Y');
                          $cer_renew_date = date("d-m-Y", strtotime($row->CERTF_RENEW_DATE));
                          $diff = strtotime($cer_renew_date) - strtotime($current_date);
                          $days = abs(round($diff / 86400));

                          if($days==0){ ?>
                           
                           <small style="font-size: 10px;"class="label label-danger"><b style="font-size: 12px;animation: blinker 1s linear infinite;color:white;"> Expire Today </b></small>

                          <?php  } else { ?>
                         
                           <small style="font-size: 10px;"class="label label-danger">Expire in <b style="font-size: 14px;">{{$days}}</b> days</small>

                          <?php } ?>
                         
                       
                         
                      </td>
                     
                      

                     
                  </tr>
                  <?php $srno++; ?>

                  @endforeach

                  @foreach($fiveDayData as $row)

                  <tr> 

                      <td class="text-center">
                        {{$srno}}
                      </td>

                      <td >
                      
                      {{$row->TRUCK_NO }} 
                        
                      </td>
                     
                      <td>
                        
                        {{ $row->CERTF_CODE }}  
                         
                      </td>
                      <td>
                        
                       {{$row->CERTF_NAME }}
                         
                      </td>

                      <td class="text-right">
                        
                       {{$row->CERTF_NO}} 
                         
                      </td>
                      
                      <td class="text-right">
                       <?php  $cer_date = $row->CERTF_DATE;

                        if($cer_date !='' || $cer_date != null){
                           $cerDate = date("d-m-Y", strtotime($row->CERTF_DATE));
                        
                       ?>
                       <span style="width:30px"> {{$cerDate}}</span>
                       <?php }else{ ?>
                       <span style="width:30px"> {{$cer_date}}</span>
                       <?php } ?>
                      
                      </td>

                      <td class="text-right">

                        <?php  $cer_renew_date = date("d-m-Y", strtotime($row->CERTF_RENEW_DATE)); ?>
                         
                        <span style="width:30px">{{$cer_renew_date}}</span>
                         
                      </td>

                     <td class="text-center">
                        <button type="button" class="btn btn-xs btn-primary" style="font-size: 8px;"data-toggle="modal" data-target="#vehicalInforamtion" onclick="funVehiInfo('{{$row->TRUCK_NO }}', '{{ $row->CERTF_CODE }}' , '{{$row->CERTF_NAME }}')">
                          <i class="fa fa-plus"> Info</i>
                        </button>
                      </td>

                      <td class="text-center">

                         <?php 
                          date_default_timezone_set('Asia/Kolkata');
                          $current_date = date('d-m-Y');
                          $cer_renew_date = date("d-m-Y", strtotime($row->CERTF_RENEW_DATE));
                          $diff = strtotime($cer_renew_date) - strtotime($current_date);
                          $days = abs(round($diff / 86400));
                           
                         ?>

                         <small style="font-size: 10px;"class="label label-warning">Expire in <b style="font-size: 14px;">{{$days}}</b> days</small>
                         
                        <!--  <span class="label label-warning">Expired in <b>{{$days}}</b></span> -->
                        
                      </td>
                      
                  <?php $srno++ ?>
                     
                  </tr>
                  @endforeach

                  @foreach($tenDayData as $row)
                  <tr> 
                      <td class="text-center">
                        {{$srno}}
                      </td>

                      <td >
                      
                      {{$row->TRUCK_NO }} 
                        
                      </td>
                     
                      <td>
                        
                        {{ $row->CERTF_CODE }} 
                         
                      </td>
                      <td>
                        
                       {{$row->CERTF_NAME }} 
                         
                      </td>

                      <td class="text-right">
                        
                       {{$row->CERTF_NO}} 
                         
                      </td>
                      
                      <td class="text-right">
                      <?php  $cer_date = $row->CERTF_DATE;

                        if($cer_date !='' || $cer_date != null){
                           $cerDate = date("d-m-Y", strtotime($row->CERTF_DATE));
                        
                       ?>
                       <span style="width:30px"> {{$cerDate}}</span>
                       <?php }else{ ?>
                       <span style="width:30px"> {{$cer_date}}</span>
                       <?php } ?>
                      </td>

                      <td class="text-right">

                        <?php  $cer_renew_date = date("d-m-Y", strtotime($row->CERTF_RENEW_DATE)); ?>
                         
                        <span style="width:30px">{{$cer_renew_date}}</span>
                         
                      </td>

                      <td class="text-center">
                        <button type="button" class="btn btn-xs btn-primary" style="font-size: 8px;"data-toggle="modal" data-target="#vehicalInforamtion" onclick="funVehiInfo('{{$row->TRUCK_NO }}', '{{ $row->CERTF_CODE }}' , '{{$row->CERTF_NAME }}')">
                          <i class="fa fa-plus"> Info</i>
                        </button>
                      </td>

                      <td align="center">

                         <?php 
                          date_default_timezone_set('Asia/Kolkata');
                          $current_date = date('d-m-Y');
                          $cer_renew_date = date("d-m-Y", strtotime($row->CERTF_RENEW_DATE));
                          $diff = strtotime($cer_renew_date) - strtotime($current_date);
                          $days = abs(round($diff / 86400));
                           
                         ?>
                          <small style="font-size: 10px;"class="label label-success">Expire in <b style="font-size: 14px;">{{$days}}</b> days</small>
                         <!-- <span class="label label-success">Expired in <b>{{$days}}</b></span> -->
                        
                      </td>
                  
                  </tr>
                  <?php $srno++ ?>
                  @endforeach



                </tbody>
                </table>

                <!-- <div class="text-center">
                  <button class="btn btn-success">Save</button>
                  <button class="btn btn-warning">Reset</button>
                </div> -->

                  
                </div><!-- /.box-body -->

                
               </form>
               <div class="modal fade" id="vehicalInforamtion" >
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">

                      <div class="modal-header text-center">
                        <h3 class="modal-title" id="exampleModalLongTitle">Live Vehicle Information</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px;">
                          <span aria-hidden="true"><i class="fa fa-times-circle-o"></i></span>
                        </button>
                      </div>

                      <div class="modal-body">
                       <div class="modalspinner hideloaderOnModl"></div>
                       <div class="row col-md-12" style="padding-top:1%;padding-bottom: 1%;">
                          <div class="col-md-6">
                            <label class="col-md-6 text-left" for="" style="font-size: 14px !important;">Vehicle No :</label>
                            <div class="col-md-6" ><p id="vehi_number"style="line-height: 1.0;"></p></div>
                          </div>

                          <div class="col-md-6">
                            <label class="col-md-6  text-left" style="font-size: 14px !important;">Owner Name :</label>
                            <div class="col-md-6" ><p id="ownername" style="line-height: 1.0;"></p></div>
                          </div>

                         

                        </div>

                        <div class="row col-md-12" style="padding-top:1%;padding-bottom: 1%;">

                           <div class="col-md-6">
                            <label class="col-md-6 text-left" for="" style="font-size: 14px !important;line-height: 1.0;">Registration Date :</label>
                            <div class="col-md-6" ><p id="regnDate" style="line-height: 1.0;"></p></div>
                          </div>
                           <div class="col-md-6">
                            <label class="col-md-6" for="" style="font-size: 14px !important;">Mobile No :</label>
                            <div class="col-md-6" ><p id="mobileNo" style="line-height: 1.0;"></p></div>
                          </div>

                          
                          
                        </div><br>

                        <div class="row col-md-12" style="padding-top:1%;padding-bottom: 1%;">
                          
                          <div class="col-md-6">
                            <label class="col-md-6" for="" style="font-size: 14px !important;">Chassis No :</label>
                            <div class="col-md-6" ><p id="chassisNo" style="line-height: 1.0;"></p></div>
                          </div>

                          <div class="col-md-6">
                            <label class="col-md-6" for="" style="font-size: 14px !important;">Engine No :</label>
                            <div class="col-md-6" ><p id="engineNo" style="line-height: 1.0;"></p></div>
                          </div>

                        </div>

                        <div class="row col-md-12" style="padding-top:1%;padding-bottom: 1%;">

                          <div class="col-md-6">
                            <label class="col-md-6" for="" style="font-size: 14px !important;">Certificate Name :</label>
                            <div class="col-md-6" ><p id="cert_name" style="line-height: 1.0;"></p></div>
                          </div>
                          
                          <div class="col-md-6">
                            <label class="col-md-6" for="" style="font-size: 14px !important;line-height: 1.2;">Certificate Renew Due Date :</label>
                            <div class="col-md-6" ><p id="due_date" style="line-height: 1.0;"></p></div>
                            <small style="font-weight: 700;color: red;" id="due_dt_err"></small>
                          </div>

                          <!-- <div class="col-md-6">
                            <label class="col-md-6" for="" style="font-size: 14px !important;">Certificate Renew Date :</label>
                            <div class="col-md-6" ><p id="renew_date" style="line-height: 1.0;"></p></div>
                          </div> -->

                        </div>

                        
                      </div>  

                        
                      <div class="modal-footer" style="border-top: none !important;text-align: center;">
                        <button type="button" style="width:10%;margin-top:5%;padding-bottom: 2px;padding-top:2px;" class="btn btn-sm btn-warning" data-dismiss="modal">Close</button>
                      <!--   <button type="button" class="btn btn-primary">Save changes</button> -->
                      </div>
                    </div>
                  </div>
                </div>   
              </div><!-- /.box -->

            </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->

      </div>



@include('admin.include.footer')

<script type="text/javascript">

function funVehiInfo(vehicleNo, certcode, certname){
  
  var truck_no = vehicleNo;
  // var truck_no = vehicleNo;
  var certCode = certcode;
  
  var certName = certname;
  

  if(truck_no){

    $.ajaxSetup({

      headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }
    });

    // $('.overlay-spinner').removeClass('hideloader');
    /* setTimeout(function(){ 
        $('.overlay-spinner').removeClass('hideloader');
    },500);*/

    $.ajax({

         url:"{{ url('/logistic/fleet-certi-vehical-info') }}",

         type: "POST",

         data: {truck_no:truck_no},

         beforeSend: function() {
                $('.modalspinner').removeClass('hideloaderOnModl');
         },

         success:function(data){

       
          var data1 = JSON.parse(data);
          var vehicle_data = data1.data;
          
          $('#cert_name').text('');
          $('#due_date').text('');
          $('#due_dt_err').html('');
          $('#vehi_number,#ownername,#regnDate,#mobileNo,#chassisNo,#engineNo').text('');
          if(certCode == 'CF'){

           $('#cert_name').text(certName);
           $('#due_date').text(data1.data.fitUpto);
           // $('#renew_date').text();


          }else if(certCode == 'Insurance'){

            $('#cert_name').text(certName);
            $('#due_date').text(data1.data.insuranceUpto);

          }else if(certCode == 'Pollution'){

            $('#cert_name').text(certName);
            $('#due_date').text(data1.data.puccUpto);
            


          }else{

            $('#cert_name').text(certName);
            $('#due_date').text('');
            $('#due_dt_err').html('Infomation not found.');

          }
          $('#vehi_number').text(data1.data.vehicleNo);
          $('#ownername').text(data1.data.ownerName);
          $('#regnDate').text(data1.data.regnDate);
          // $('#presentAddr').text(data1.data.presentAddr);
          $('#mobileNo').text(data1.data.mobileNo);
          $('#chassisNo').text(data1.data.chassisNo);
          $('#engineNo').text(data1.data.engineNo);
          // $('#fuelDesc').text(data1.data.fuelDesc);
          // // $('#fitUpto').text(data1.data.fitUpto);
          // $('#insuranceCompNm').text(data1.data.insuranceCompNm);
          // $('#insurancePolicyNo').text(data1.data.insurancePolicyNo);
          // $('#insuranceUpto').text(data1.data.insuranceUpto);
          // $('#wheelbase').text(data1.data.wheelbase);
          $('.overlay-spinner').removeClass('hideloader');

          $('#vehicalInforamtion').show();
         



         },

          complete: function() {
            $('.modalspinner').addClass('hideloaderOnModl');
          },
    });

  }
}
$(function() {

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

  $("#example").DataTable({
   
    pageLength: 50,
    dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
    buttons: [
              {
                extend: 'excelHtml5',
                title: 'vehicle_documentation_updation_'+curr_date+'_'+curr_time,
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,8]
                }
              }
            ],


  });

});

$('.number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
   if (this.value.length==1) {
    return false;}
});



</script>
@endsection



