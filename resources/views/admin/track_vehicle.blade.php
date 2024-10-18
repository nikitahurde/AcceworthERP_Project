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

#vehicleTrack_data{
  -webkit-box-shadow: 0px 2px 9px 0px rgba(0,0,0,0.75) !important;
  -moz-box-shadow: 0px 2px 9px 0px rgba(0,0,0,0.75)!important;
  box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75)!important;
}

#trip_data{
  -webkit-box-shadow: 0px 2px 9px 0px rgba(0,0,0,0.75) !important;
  -moz-box-shadow: 0px 2px 9px 0px rgba(0,0,0,0.75)!important;
  box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75)!important; 
}

.modal-body {
    position: relative;
    padding: 15px;
    margin-bottom: -8%;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
/*.table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
    border: 1px solid #f4f4f4;
}*/
#trip_data tbody>tr>td{
  border: 1px solid #cfc8c8!important;padding: 2px 2px;
}
#trip_data label{
  padding:2px;
  line-height: 0.9;
}

#vehicleTrack_data{
  margin-top:0%;
}

#vehicleTrack_data tbody>tr>td{
  border: 1px solid #cfc8c8!important;padding: 2px 2px;
}
#vehicleTrack_data label{
  padding:2px;
  line-height: 0.9;
}

</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Track Vehicle 
             <small><b> : View Details</b></small> 

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ url('/dashoard/track-vehicle') }}"><i class="fa fa-dashboard"></i>Track Vehicle</a></li>
          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Track Vehicle</h3>

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
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="trackTypeList">Track Type : </label>
                        <select class="form-control" id="trackTypeListId" name="trackType">
                          <option value="blank">------Select Type------</option>
                          <option value="AllVel" selected>All Vehicle</option>
                          <option value="RunningVel">Running Vehicle</option>
                          <option value="IdelVel">Idel Vehicle</option>
                        </select>
                        <small id="show_err_track_type"></small>
                      </div>
                    </div>
                    <div class="col-sm-4" style="margin-top: 1%;">

                        <button type="button" class="btn btn-primary" id="ProceedBtnId">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                        <button type="button" class="btn btn-info" name="searchdata" id="ResetId" onClick="window.location.reload();">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>

                        <button type="button" class="btn btn-warning" name="searchdata" id="SyncVehicle" onClick="syncVehicle()">&nbsp;&nbsp;<i class="fa fa-random" aria-hidden="true"></i> &nbsp;&nbsp;Sync. Vehicle&nbsp;&nbsp;</button>

                    </div>
                    <div class="col-sm-3"></div>
                  </div>
                </div>
              </div>

              <small id="dataError" style="color: red;font-size:12px;font-weight:600;"></small>
              <div class="modalspinner hideloaderOnModl"></div>

               <!-- <div class="overlay-spinner hideloader"></div>  -->  
              <table id="trackVelTblId" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>

                    <th class="text-center" style="width:100px;">Vehicle No</th>

                    <th class="text-center" style="width:104;">Entity Name</th>

                    <th class="text-center" style="width:104;">Vehicle Speed</th>

                    <th class="text-center" style="width:104;">Ignition</th>

                    <th class="text-center" style="width:104;">Location</th>

                    <th class="text-center" style="width:104;">Last Update Date/Time</th>

                    <th class="text-center" style="width:104;">Plant Name</th>

                    <th class="text-center" style="width:104;">Account Name</th>

                    <th class="text-center" style="width:104;">Trip No</th>

                    <th class="text-center" style="width:104;">Trip Date</th>

                    <th class="text-center" style="width:104;">From Place</th>

                    <th class="text-center" style="width:104;">To Place</th>

                    <th class="text-center" style="width:104;">Transporter Name</th>

                    <th class="text-center" style="width:104;">DO No.</th>

                    <th class="text-center" style="width:104;">Item Name</th>

                    <th class="text-center" style="width:104;">Remark</th>
                    
                    <th class="text-center" style="width:104;">Consignee</th>

                    <th class="text-center" style="width:104;">Action</th>
                    
                  </tr>

                </thead>

                <tbody id='tblTrackVel'>

                  

                </tbody>

              </table><!-- /. table -->
                  
            </div><!-- /.box-body -->

        </div><!-- /.box -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.content -->

</div>
<style>
  .displayMsg{
    display: none;
  }
  .apiMsg{
    margin-bottom: 1%;
    margin-top: 1%;
    text-align: center;
    font-size: 15px;
  }
  
</style>
<!-- TRACK SINGLE VEHICLE: MODAL -->

<div class="modal fade" id="singleVelTrack" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div style="text-align:center;">
          <h4 class="modal-title" id="exampleModalLabel">Track Vehicle</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
        </button>
      </div>
      <div id="showMsg" class="apiMsg displayMsg"></div>
      <div id="showTblMsg" style="color:red;text-align: center"></div>
      <div class="modal-body">
        
        <!-- <div class="row col-md-12"> -->
        <!--  Trip data details -->
        <p id="trip_p" style="font-size: 16px; font-weight: 700;">Trip Details :</p>
        <div class="boxShadow">
         <table class="table-hover table-bordered col-md-12" id="trip_data">
           
           <tbody>
             <tr>
               <td style="width: 50%;">
                <div class="row">
                  <div class="col-md-3">
                    <label for="">Plant Name</label>
                  </div>
                  <div class="col-md-9">
                     <p id="plant_name" style="margin: 0px -4px;line-height:1.0;"></p>
                  </div>
                </div>
               </td>

              <td style="width: 50%;">

                 <div class="row">
                  <div class="col-md-3">
                    <label for="">Account Name</label>
                  </div>
                  <div class="col-md-9">
                     <p id="accountName" style="margin: 0px -4px;line-height:1.0;"></p>
                  </div>
                </div>
                
              </td>
             </tr>

             <tr>
               <td>

                 <div class="row">
                  <div class="col-md-3">
                    <label for="">Trip No</label>
                  </div>
                  <div class="col-md-9">
                     <p id="trip_no" style="margin: 0px -4px;line-height:1.0;"></p>
                  </div>
                </div>
               
               </td>

              <td>

                <div class="row">
                  <div class="col-md-3">
                    <label for="">Trip Date</label>
                  </div>
                  <div class="col-md-9">
                     <p id="trip_date" style="margin: 0px -4px;line-height:1.0;"></p>
                  </div>
                </div>

              </td>

             </tr>

              <tr>
               <td>

                <div class="row">
                  <div class="col-md-3">
                     <label for="">From Place</label>
                  </div>
                  <div class="col-md-9">
                     <p id="from_place" style="margin: 0px -4px;line-height:1.0;"></p>
                  </div>
                </div>
               
               </td>
              <td>

                <div class="row">
                  <div class="col-md-3">
                     <label for="">To Place</label>
                  </div>
                  <div class="col-md-9">
                     <p id="to_place" style="margin: 0px -4px;line-height:1.0;"></p>
                  </div>
                </div>
                
              </td>
             </tr>

              <tr>
               <td>

                <div class="row">
                  <div class="col-md-3">
                      <label for="">Owner</label>
                  </div>
                  <div class="col-md-9">
                     <p id="ownerName" style="margin: 0px -4px;line-height:1.0;"></p>
                  </div>
                </div>
               
               </td>
               <td>

                 <div class="row">
                  <div class="col-md-4">
                      <label for="" >Transport Name</label>
                  </div>
                  <div class="col-md-8">
                     <p id="tranName" style="margin: 0px -42px;line-height:1.0;"></p>
                  </div>
                </div>
                
                
               </td>
              </tr> 

              <tr>
               <td>

                <div class="row">
                  <div class="col-md-3">
                     <label for="">DO No.</label>
                  </div>
                  <div class="col-md-9">
                     <p id="do_no" style="margin: 0px -4px;line-height:1.0;"></p>
                  </div>
                </div>
               
               </td>
              <td>

                <div class="row">
                  <div class="col-md-3">
                     <label for="">Item Name</label>
                  </div>
                  <div class="col-md-9">
                     <p id="item_name" style="margin: 0px -4px;line-height:1.0;"></p>
                  </div>
                </div>
                
              </td>
             </tr>  

             <tr>
               <td>

                <div class="row">
                  <div class="col-md-3">
                     <label for="">Remark</label>
                  </div>
                  <div class="col-md-9">
                     <p id="remark" style="margin: 0px -4px;line-height:1.0;"></p>
                  </div>
                </div>
               
               </td>
              <td>

                <div class="row">
                  <div class="col-md-3">
                     <label for="">Consignee</label>
                  </div>
                  <div class="col-md-9">
                     <p id="consignee_name" style="margin: 0px -4px;line-height:1.0;"></p>
                  </div>
                </div>
                
              </td>
             </tr>                   

           </tbody>
         </table>
         </div>

         <!-- Vehicle Track Details -->
        <!-- <p style="font-size: 16px;font-weight: 700;margin-top:2%;">Track Details</p> -->

       <div class="row" id="track_p" style="margin-top: 20%;">
         <div class="col-md-6">
           <p style="font-size: 16px;font-weight: 700;">Track Details : </p>
         </div>
         <div class="col-md-6 text-right">
            <button id="refreshApi"class="btn btn-primary" style="font-size: 10px; padding: 1px 6px; margin-bottom: 1%;border-radius: 10px;" onclick="funRefApi()"><i class="fa fa-refresh"></i></button>
         </div>
       </div> 
       <div id="boxShadow">
         <table class="table-hover table-bordered col-md-12" id="vehicleTrack_data">
          
           <tbody>
             <tr>
               <td style="width: 50%;">
                <div class="row">
                  <div class="col-md-3">
                    <label for="">Entity Name</label>
                  </div>
                  <div class="col-md-9">
                     <p id="entityName" style="margin: 0px -4px;line-height:1.0;"></p>
                  </div>
                </div>
               </td>

              <td style="width: 50%;">
                 <div class="row">
                  <div class="col-md-3">
                     <label for="">Last Update</label>
                  </div>
                  <div class="col-md-9">
                     <p id="timestamp" style="margin: 0px -4px;line-height:1.0; color: red; animation: blinker 4s linear infinite;"></p>
                  </div>
                </div>
                 
                
              </td>
             </tr>

             <tr>
               <td>

                 <div class="row">
                  <div class="col-md-3">
                    <label for="">Location</label>
                  </div>
                  <div class="col-md-9">
                     <p id="location" style="margin: 0px -4px;line-height:1.0;"></p>
                  </div>
                </div>
               
               </td>

              <td>

                <div class="row">
                  <div class="col-md-3">
                    <label for="">Speed</label>
                  </div>
                  <div class="col-md-9">
                     <p id="speed" style="margin: 0px -4px;line-height:1.0;"></p>
                  </div>
                </div>

              </td>

             </tr>

              <tr>
               <td>

                <div class="row">
                  <div class="col-md-3">
                    <label for="">Ignition</label>
                  </div>
                  <div class="col-md-9">
                     <p id="ignition" style="margin: 0px -4px;line-height:1.0;"></p>
                  </div>
                </div>
               
               </td>
              <td>

                <div class="row">
                  <div class="col-md-3">
                     <label for="">Vehicle No</label>
                  </div>
                  <div class="col-md-9">
                     <p id="vehicleNo" style="margin: 0px -4px;line-height:1.0;"></p>
                  </div>
                </div>
                
              </td>
             </tr>

            </tbody>
         </table>
       </div>
          
        <!-- </div> -->
        <div class="row"  id="loadMapWithDetails" style="width:100%;height:300px;padding-top:0%;    margin: 11% 0%;margin-bottom: 0%;">
          
        </div>
        
      </div>
      <div class="modal-footer" style="text-align:center;margin-top:9%">
        <button type="button" class="btn btn-primary" data-dismiss="modal">&nbsp;&nbsp;<i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Close&nbsp;&nbsp;</button>
      </div>
    </div>
  </div>
</div>


<!-- /. TRACK SINGLE VEHICLE: MODAL -->

@include('admin.include.footer')

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvxy7I23WXAJkp5B5bUBXVwmab5gEy5To">
</script>

<script type="text/javascript">


/* START : Load Data Table */

load_data_query();

function load_data_query(velType= ''){

      var getDefalutType = 'AllVel';

      $('#trackVelTblId').DataTable({

          footerCallback: function ( row, data, start, end, display ) {
          var api = this.api(), data;

          var rowcount = data.length;
          var getRow = rowcount-1;
          
          if(rowcount > 0){
             $('.buttons-excel').attr('disabled',false);
          }else{
             $('.buttons-excel').attr('disabled',true);
          }
          
         },
          processing: true,
          serverSide: false,
          info: true,
          bPaginate: false,
          scrollY: 450,
          scrollX: true,
          scroller: true,
          fixedHeader: true,
          order: [[0, 'asc'],[1, 'asc']],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons:  [
                    {
                      extend: 'excelHtml5',
                      exportOptions: {
                                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
                          },
                      title: 'TRACK VEHICLE '+$("#headerexcelDt").val(),
                      filename: 'TRACK_VEHICLET_'+$("#headerexcelDt").val(),
                    }
                  ],
          info: true,
          ajax:{
            url:'{{ url("/get-data-track-vehicle") }}',
            data: {velType:velType,getDefalutType:getDefalutType}
          },
          columns: [
            {
                data:'VEHICLE_NO',
                name:'VEHICLE_NO',
                className: "text-left"
               
            },
            {
                data:'ENTITY_NAME',
                name:'ENTITY_NAME',
                className: "text-left"
               
            },
            {
                data:'SPEED',
                name:'SPEED',
                className: "text-right"
               
            },
            {
                data:'IGNITION',
                name:'IGNITION',
                className: "text-left"
               
            },
            {
                data:'LOCATION',
                name:'LOCATION',
                className: "text-left"
               
            },
            {  
              render: function (data, type, full, meta){

               
                var velDtTim = full['VEHICLE_TIME'];
              
                var spliteVelTime = velDtTim.split(" ");

                var spliteDate =  spliteVelTime[0].split("-");

                var dd = spliteDate[2];
                var mm = spliteDate[1];
                var yy = spliteDate[0];

                var fullDateTime = dd+'-'+mm+'-'+yy+' '+spliteVelTime[1];
                return fullDateTime;


               },
               className: "text-right"
        
            },
            {  
              render: function (data, type, full, meta){

               
                var PLANTCODE = full['PLANT_CODE'];
                var PLANTNAME = full['PLANT_NAME'];
              
                
                return PLANTCODE+' - '+PLANTNAME;


               },
               className: "text-right"
        
            },
            {  
              render: function (data, type, full, meta){

               
                var ACCCODE = full['ACC_CODE'];
                var ACCNAME = full['ACC_NAME'];
              
                
                return ACCCODE+' - '+ACCNAME;


               },
               className: "text-right"
        
            },
            {  
              render: function (data, type, full, meta){

               
                var TRIPNO = full['TRIP_NO'];
               
                return TRIPNO;


               },
               className: "text-right"
        
            },
            {  
              render: function (data, type, full, meta){

               
                var TRIPDT = full['TRIP_DATE'];
               
                return TRIPDT;


               },
               className: "text-right"
        
            },
            {  
              render: function (data, type, full, meta){

               
                var FROMPLACE = full['FROM_PLACE'];
               
                return FROMPLACE;


               },
               className: "text-right"
        
            },
            {  
              render: function (data, type, full, meta){

               
                var TOPLACE = full['TO_PLACE'];
               
                return TOPLACE;


               },
               className: "text-right"
        
            },
            {  
              render: function (data, type, full, meta){

               
                var TRPTNAME = full['TRPT_NAME'];
                var TRPTCODE = full['TRPT_CODE'];
               
                return TRPTCODE+' - '+TRPTNAME;


               },
               className: "text-right"
        
            },
            {  
              render: function (data, type, full, meta){

               
                var DONO = full['DO_NO'];
                
                return DONO;


               },
               className: "text-right"
        
            },
            {  
              render: function (data, type, full, meta){

               
                var ITEMCODE = full['ITEM_CODE'];
                var ITEMNAME = full['ITEM_NAME'];
                
                return ITEMCODE+' - '+ITEMNAME;


               },
               className: "text-right"
        
            },
            {  
              render: function (data, type, full, meta){

               
                var REMARK = full['REMARK'];
               
                
                return REMARK;


               },
               className: "text-right"
        
            },
            {  
              render: function (data, type, full, meta){

               
                var CPCODE = full['CP_CODE'];
                var CPNAME = full['CP_NAME'];
               
                
                return CPCODE+' - '+CPNAME;


               },
               className: "text-right"
        
            },
            {  
              render: function (data, type, full, meta){
                var getId = full['ID'];
                var velNo = full['VEHICLE_NO'];
                var lat   = full['LATITUDE'];
                var long  = full['LONGITUDE'];

                var deletebtn ='<button type="button" onclick="return getTrackVehicle('+getId+',\'' +velNo+ '\',\'' +lat+ '\',\'' +long+ '\')" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-truck" title="Track Vehicle...!"></i></button>';
              
                return deletebtn;

               },
               className: "text-center"
        
            },
            
            
          ]


      });


  }


/* END : Load Data Table */


/* ..........START : Search Button Click ......... */

    $('#ProceedBtnId').click(function(){

      var trackType   =  $('#trackTypeListId').val();

      console.log('to_place',trackType);
           
      $("#trackTypeListId").prop('readonly',true);
     
   
        if (trackType!='') {

          if(trackType=='blank'){
            $('#show_err_track_type').html('*Please Select Track Type').css('color','red');
          return false;
          }else{
            $('#show_err_track_type').html('');
          }
        
          $('#trackVelTblId').DataTable().destroy();

          load_data_query(trackType);

        }else{

          $('#trackVelTblId').DataTable().destroy();

          load_data_query();

        }


    });

/* ..........END : Search Button Click ......... */


function funRefApi(){

  var vhiNo = $('#vehicleNo').text();
  // console.log('vhiNo',vhiNo);

  if(vhiNo){
     getTrackVehicle('',vhiNo,'','');
  }else{

  }

}

function getTrackVehicle(velId,velNo,lats,longs){

  console.log('velNo',velNo);
  console.log('velId',velId);
  console.log('lat',lats);
  console.log('long',longs);

  var getLat = parseInt(lats);
  var getLong = parseInt(longs);

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({

      url:"{{ url('/get-live-track-vehicle-data-from-api') }}",

      method : "POST",

      type: "JSON",

      data: {velNo:velNo,velId:velId,lats:lats,longs:longs},

      success:function(data){

        var data1 = JSON.parse(data);

        var LatGet = parseInt(data1['track_data']['latitude']);
        var LongGet = parseInt(data1['track_data']['longitude']);

        if (data1['track_data']['message']!='') {

        var msg = data1['track_data']['message'];

        }else{

          var msg = '';

        }

        var track_data = data1['track_data'];
        
        var trip_data = data1['trip_data'];
        var count_tripData = trip_data.length;
       
        if(count_tripData > 0 ){

          if(trip_data[0]['TRIP_NO'] == null || trip_data[0]['TRIP_NO'] == '' ){

            $('#track_p').css('track_p','0%');
            $('#trip_p').css('display','none');
            $('#trip_data').css('display','none');
            // $('#showTblMsg').css('display','');
            $('#showTblMsg').html('<span style="color:red;"><i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;&nbsp;Trip Details not Found</span>');

          }else{
            
            // $('#showTblMsg').css('display','none');
            // $('#showTblMsg').html('');
            if(trip_data[0]['PLANT_CODE'] != '' && trip_data[0]['PLANT_NAME'] != '' ){

             var plantName =trip_data[0]['PLANT_CODE']+' - '+trip_data[0]['PLANT_NAME'];
             $('#plant_name').text(plantName);
            }else{
              $('#plant_name').text('');
            }

            if(trip_data[0]['ACC_CODE'] != '' && trip_data[0]['ACC_NAME'] != '' ){

              var accName =trip_data[0]['ACC_CODE']+' - '+trip_data[0]['ACC_NAME'];
              $('#accountName').text(accName);
            }else{
              $('#accountName').text('');
            }

            var tripNo = trip_data[0]['TRIP_NO'] != '' ?  trip_data[0]['TRIP_NO'] : '';

            if(trip_data[0]['VRDATE'] != ''){

              $('#trip_date').text(trip_data[0]['VRDATE']);
            }else{
              $('#trip_date').text('');
            }

            var fromPlace = trip_data[0]['FROM_PLACE'] != '' ?  trip_data[0]['FROM_PLACE'] : '';
            var toPlace = trip_data[0]['TO_PLACE'] != '' ?  trip_data[0]['TO_PLACE'] : '';
            var owner = trip_data[0]['OWNER'] != '' ?  trip_data[0]['OWNER'] : '';
            var do_no = trip_data[0]['DO_NO'] != '' ?  trip_data[0]['DO_NO'] : '';
            var item_code = trip_data[0]['ITEM_CODE'] != '' ?  trip_data[0]['ITEM_CODE'] : '';
            var item_name = trip_data[0]['ITEM_NAME'] != '' ?  trip_data[0]['ITEM_NAME'] : '';
            var remarks_data = trip_data[0]['REMARK'] != '' ?  trip_data[0]['REMARK'] : '';
            var cp_code = trip_data[0]['CP_CODE'] != '' ?  trip_data[0]['CP_CODE'] : '';
            var cp_name = trip_data[0]['CP_NAME'] != '' ?  trip_data[0]['CP_NAME'] : '';

            $('#trip_no').text(tripNo);
            $('#from_place').text(fromPlace);
            $('#to_place').text(toPlace);
            $('#ownerName').text(owner);
            $('#do_no').text(do_no);
            $('#remark').text(remarks_data);

            if(trip_data[0]['TRANSPORT_CODE'] != '' && trip_data[0]['TRANSPORT_NAME'] != '' ){

              var transName =trip_data[0]['TRANSPORT_CODE']+' - '+trip_data[0]['TRANSPORT_NAME'];
              $('#tranName').text(transName);
            }else{
              $('#tranName').text('');
            }

            if(trip_data[0]['ITEM_CODE'] != '' && trip_data[0]['ITEM_NAME'] != '' ){

              var itemsName =trip_data[0]['ITEM_CODE']+' - '+trip_data[0]['ITEM_NAME'];
              $('#item_name').text(itemsName);
            }else{
              $('#item_name').text('');
            }
 

            if(trip_data[0]['CP_CODE'] != '' && trip_data[0]['CP_NAME'] != '' ){

              var do_no =trip_data[0]['CP_CODE']+' - '+trip_data[0]['CP_NAME'];
              $('#consignee_name').text(transName);
            }else{
              $('#do_no').text('');
            }

          }

        }else{

          $('#track_p').css('margin-top','0%');
          $('#trip_p').css('display','none');
          $('#trip_data').css('display','none');
          // $('#showTblMsg').css('display','');
          $('#showTblMsg').html('<span style="color:red;"><i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;&nbsp;Trip Details not Found</span>');
        }

        $('#singleVelTrack').modal('show');

        if (msg=='success') {
            $('#showMsg').addClass('displayMsg');
            $('#loadMapWithDetails').css('display','');

            // Track vehicle data

            if(track_data == ''){
              
              // $('#showTblMsg').css('display','');
              $('#showTblMsg').html('<span style="color:red;"><i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;&nbsp;Track Details not Found</span>');

            }else{

              // $('#showTblMsg').css('display','none');
              // $('#showTblMsg').html('');

              $('#track_p').css('display','');
              $('#vehicleTrack_data').css('display','');
              $('.modal-footer').css('margin-top','9%');

              var entity_Name = track_data['entityName'] != '' ? track_data['entityName'] : '';
              $('#entityName').text(entity_Name);

              var ignition_data = track_data['ignition'] != '' ? track_data['ignition'] : '';
              $('#ignition').text(ignition_data);

              var location_data = track_data['location'] != '' ? track_data['location'] : '';
              $('#location').text(location_data);

              var speed_data = track_data['speed'] != '' ? track_data['speed'] : '-----';
              $('#speed').text(speed_data);

              var timestamp_data = track_data['timestamp'] != '' ? track_data['timestamp'] : '';
              $('#timestamp').text(timestamp_data);

              var vehicleNo_data = track_data['vehicleNo'] != '' ? track_data['vehicleNo'] : '';
              $('#vehicleNo').text(vehicleNo_data);

            }
            
            if(count_tripData> 0 && track_data != ''){
               $('#showTblMsg').html('');
            } 
         
        }else{
          
          if(count_tripData == 0 && msg!='success'){

            $('#trip_p').css('display','none');
            $('#trip_data').css('display','none');
            // $('#showTblMsg').css('display','');
            $('#showTblMsg').html('<span style="color:red;"><i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;&nbsp;Trip and Track Details not Found</span>');
            
          }else{
            // $('#showTblMsg').css('display','');
            $('#showTblMsg').html('<span style="color:red;"><i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;&nbsp;Track Details not Found</span>');
          }

          $('#track_p').css('display','none');
          $('#vehicleTrack_data').css('display','none');
          $('.modal-footer').css('margin-top','22%');
          $('#loadMapWithDetails').css('display','none');
          $('#showMsg').removeClass('displayMsg');
         
          $('#showMsg').html('<span style="color:red;"><i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;&nbsp;'+msg+'</span>');


        }


        var uluru = { lat: LatGet, lng: LongGet };

        var maps = new google.maps.Map(document.getElementById("loadMapWithDetails"), {
          zoom: 8,
          center: uluru,
        });

        var marker = new google.maps.Marker({
          position: uluru,
          map: maps,
        });

      }

  });

  


}


/* ~~~~~~~~~ Sync. All Vehicle ~~~~~~~~~~~~~~*/

  function syncVehicle(){

    var getParameters = 'Dashboard';
    console.log('getParameters',getParameters);

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({

      url:"{{ url('/dashboard/logistics/track-vehicle/sync-all-vehicle-etrans') }}",

      method : "POST",

      type: "JSON",

      data: {getParameters:getParameters},

      beforeSend: function() {
        $('.modalspinner').removeClass('hideloaderOnModl');

      },

      success:function(data){

        var data1 = JSON.parse(data);

        // console.log('data',data1.data.response);

        if (data1.response == 'error') {

          $('#trackVelTblId').DataTable().destroy();

          load_data_query();

          $('#dataError').html("Vehicle Data Can not Sync...! Please Check eTrans API...! ");

        }else if(data1.response == 'success'){

          $('#dataError').html("");

          console.log('total count ',data1.track_data);

          if(data1.track_data){

            $('#trackVelTblId').DataTable().destroy();

            var trackType = 'AllVel';

            load_data_query(trackType);

          }else{

            $('#trackVelTblId').DataTable().destroy();

            load_data_query();

          }
        }

      },
      complete: function() {
        console.log('end spinner');
        $('.modalspinner').addClass('hideloaderOnModl');
      },

  });

                         
  }


$(function() {
$("#example").DataTable({
 
"pageLength": 25,


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



