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
@keyframes blinker {
  50% {
    opacity: 0;
  }
}

</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

           Bilty Report

             <small><b>View Details</b></small> 

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"></i>Cold Storage</a></li>
            <li><a href="#"></i>Bilty Report</a></li>
          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                 <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View  Bilty Report</h3>

                  <div class="box-tools pull-right">

                    <a href="{{url('/dashboard')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>

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

                    <th class="text-center" style="width:50px;">Bilty Date</th>

                    <th class="text-center" style="width:104;">Bilty No</th>

                    <th class="text-center" style="width:104;">Account Code</th>

                    <th class="text-center" style="width:104;">Account Name</th>

                    <th class="text-center" style="width:104;">Item Code</th>

                    <th class="text-center" style="width:104;">Item Name</th>
                    <th class="text-center" style="width:104;">Bilty Qty</th>
                    <th class="text-center" style="width:104;">UM</th>

                    <th class="text-center" style="width:104;">Storage Type</th>

                    <th class="text-center" style="width:104;">Valid Date</th>

                    <th class="text-center" style="width:104;">Action</th>
                    
                  </tr>

                </thead>

                <tbody>
                  @foreach ($tenDayData as $row)
                  <tr>
                    <td class="text-right">
                      <?php
                        $bilty_dt = $row->BUILTY_DT;

                        if($bilty_dt){
                          $b_valid_date = date("d-m-Y", strtotime($bilty_dt)); 

                          echo $b_valid_date;
                        }   
                          
                      ?>

                    </td>
                    <td>
                      <?php 
                      $series_code = $row->SERIES_CODE;
                      $vrno = $row->VRNO;
                      $fy_yr = $row->FY_CODE;

                      if($fy_yr){
                        $fis_yr =  explode('-', $fy_yr);
                       
                      }
                      
                      $bilty_no =  $fis_yr[0].'/'.$series_code.'/'.$vrno;

                      echo $bilty_no;
                      ?>
                     
                    </td>

                    <td>{{$row->ACC_CODE}} </td>

                    <td>{{$row->ACC_NAME}}</td>

                    <td>{{$row->ITEM_CODE}}</td>

                    <td>{{$row->ITEM_NAME}}</td>
                   
                    <td>{{$row->BILTY_QTY}}</td>
                    <td>{{$row->BILTY_UM}}</td>
                    <td>{{$row->STORAGE_TYPE}}</td>

                    <td class="text-right">
                       <?php
                        $biltyvalid_dt = $row->RECIEPT_TILL_DT;

                        if($biltyvalid_dt){
                          $b_valid_date = date("d-m-Y", strtotime($biltyvalid_dt)); 

                          echo $b_valid_date;
                        }   
                          
                      ?>
                    </td>
                    <td>
                      
                       <?php 
                          date_default_timezone_set('Asia/Kolkata');
                          $current_date = date('d-m-Y');
                          $last_date = date("d-m-Y", strtotime($row->RECIEPT_TILL_DT));
                          $diff = strtotime($last_date) - strtotime($current_date);
                          $days = abs(round($diff / 86400));

                          if($days==0){ ?>
                           
                           <small style="font-size: 10px;"class="label label-danger"><b style="font-size: 12px;animation: blinker 1s linear infinite;color:white;"> Expire Today </b></small>

                          <?php  } else { ?>
                         
                           <small style="font-size: 10px;"class="label label-danger">Expire in <b style="font-size: 14px;">{{$days}}</b> days</small>

                         <?php } ?>

                    </td>
                  </tr>
                  @endforeach
                
                <!-- End TR for 10 days -->

                <!-- Start Tr for 20 Days -->

                @foreach ($twentyDayData as $row)
                  <tr>
                    <td class="text-right">
                      <?php
                        $bilty_dt = $row->BUILTY_DT;

                        if($bilty_dt){
                          $b_valid_date = date("d-m-Y", strtotime($bilty_dt)); 

                          echo $b_valid_date;
                        }   
                          
                      ?>

                    </td>
                    <td>
                      <?php 
                      $series_code = $row->SERIES_CODE;
                      $vrno = $row->VRNO;
                      $fy_yr = $row->FY_CODE;

                      if($fy_yr){
                        $fis_yr =  explode('-', $fy_yr);
                       
                      }
                      
                     $bilty_no =  $fis_yr[0].'/'.$series_code.'/'.$vrno;

                      echo $bilty_no;
                      ?>
                     
                    </td>

                    <td>{{$row->ACC_CODE}} </td>

                    <td>{{$row->ACC_NAME}}</td>

                    <td>{{$row->ITEM_CODE}}</td>

                    <td>{{$row->ITEM_NAME}}</td>
                    
                    <td>{{$row->BILTY_QTY}}</td>
                    <td>{{$row->BILTY_UM}}</td>
                    <td>{{$row->STORAGE_TYPE}}</td>

                    <td class="text-right">
                       <?php
                        $biltyvalid_dt = $row->RECIEPT_TILL_DT;

                        if($biltyvalid_dt){
                          $b_valid_date = date("d-m-Y", strtotime($biltyvalid_dt)); 

                          echo $b_valid_date;
                        }   
                          
                      ?>
                    </td>
                    <td>
                      
                       <?php 
                          date_default_timezone_set('Asia/Kolkata');
                          $current_date = date('d-m-Y');
                          $last_date = date("d-m-Y", strtotime($row->RECIEPT_TILL_DT));
                          $diff = strtotime($last_date) - strtotime($current_date);
                          $days = abs(round($diff / 86400));

                          if($days==0){ ?>
                           
                           <small style="font-size: 10px;"class="label label-warning"><b style="font-size: 12px;animation: blinker 1s linear infinite;color:white;"> Expire Today </b></small>

                          <?php  } else { ?>
                         
                           <small style="font-size: 10px;"class="label label-warning">Expire in <b style="font-size: 14px;">{{$days}}</b> days</small>
                          <?php } ?>

                    </td>
                  </tr>
                  @endforeach
                <!-- End Tr for 20 Days -->

                <!-- Start Tr for 30 Days -->

                 @foreach ($thirtyDayData as $row)
                  <tr>
                    <td class="text-right">
                      <?php
                        $bilty_dt = $row->BUILTY_DT;

                        if($bilty_dt){
                          $b_valid_date = date("d-m-Y", strtotime($bilty_dt)); 

                          echo $b_valid_date;
                        }   
                          
                      ?>

                    </td>
                    <td>
                      <?php 
                      $series_code = $row->SERIES_CODE;
                      $vrno = $row->VRNO;
                      $fy_yr = $row->FY_CODE;

                      if($fy_yr){
                        $fis_yr =  explode('-', $fy_yr);
                       
                      }
                      
                      $bilty_no =  $fis_yr[0].'/'.$series_code.'/'.$vrno;

                      echo $bilty_no;
                      ?>
                     
                    </td>

                    <td>{{$row->ACC_CODE}} </td>

                    <td>{{$row->ACC_NAME}}</td>

                    <td>{{$row->ITEM_CODE}}</td>

                    <td>{{$row->ITEM_NAME}}</td>
                    
                    <td>{{$row->BILTY_QTY}}</td>
                    <td>{{$row->BILTY_UM}}</td>
                    <td>{{$row->STORAGE_TYPE}}</td>

                    <td class="text-right">
                       <?php
                        $biltyvalid_dt = $row->RECIEPT_TILL_DT;

                        if($biltyvalid_dt){
                          $b_valid_date = date("d-m-Y", strtotime($biltyvalid_dt)); 

                          echo $b_valid_date;
                        }   
                          
                      ?>
                    </td>
                    <td>
                      
                       <?php 
                          date_default_timezone_set('Asia/Kolkata');
                          $current_date = date('d-m-Y');
                          $last_date = date("d-m-Y", strtotime($row->RECIEPT_TILL_DT));
                          $diff = strtotime($last_date) - strtotime($current_date);
                          $days = abs(round($diff / 86400));

                          if($days==0){ ?>
                           
                           <small style="font-size: 10px;"class="label label-success"><b style="font-size: 12px;animation: blinker 1s linear infinite;color:white;"> Expire Today </b></small>

                          <?php  } else { ?>
                         
                           <small style="font-size: 10px;"class="label label-success">Expire in <b style="font-size: 14px;">{{$days}}</b> days</small>

                          <?php } ?>
                    </td>
                  </tr>
                  @endforeach
                <!-- End Tr for 30 Days -->

                </tbody>
                </table>

                 </div><!-- /.box-body -->

                
               </form>
                 
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

    footerCallback: function ( row, data, start, end, display ) {
        var api = this.api(), data;
        var rowcount = data.length;

        if(rowcount > 0){
           $('.buttons-excel').attr('disabled',false);
        }else{
           $('.buttons-excel').attr('disabled',true);
        }

    },
 
    "pageLength": 25,
    dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
    buttons: [
                {
                  extend: 'excelHtml5',
                  title: 'bilty_report_'+curr_date+'_'+curr_time,
                  footer: true
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



