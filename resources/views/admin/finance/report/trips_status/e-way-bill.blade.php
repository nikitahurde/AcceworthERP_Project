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

  .required-field::before {

    content: "*";

    color: red;

  }
  .textfl{

    text-align: left;

  }
  .modal-header .close {
    margin-top: -32px;
}

#blink{
	font-weight: 400;
	/*font-size: 14px;*/
	font-family: cursive;
	color: #fff;
	animation: blink 1s linear infinite;
}

@keyframes blink{
0%{opacity: 0;}
50%{opacity: .5;}
100%{opacity: 1;}
}


#expiredInFourHr{
	color:#fff !important;
	background-color: #e15865;
}
#validToday{
	
	font-weight: 400;
	background-color: #37a752;
	color:#fff !important ;
}
#expired{
	color:#fff !important ;
	font-weight: 400;
	background-color: #e15865;
}
#upcoming{
	background-color: #f1cf64;
	font-weight: 400;
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


            E-Way Bill - Trips/LR



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li class="Active"><a href="{{ URL('/Dashboard/Trips-status')}}">E-Way Bill - Trips/LR</a></li>



            <li class="Active"><a href="{{ URL('/Dashboard/Trips-status')}}">View E-Way Bill - Trips/LR</a></li>



          </ol>



        </section>







        <!-- Main content -->



        <section class="content">



          <div class="row">



            <div class="col-xs-12">



              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View E-Way Bill - Trips/LR </h3>



                  <div class="box-tools pull-right">



                    <a href="{{ url('/Dashboard/Trips-status') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Go  Back</a>



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

            

            <table id="example" class="table table-bordered table-striped table-hover">

             <thead>

                <tr>
              	<th>D.O.Date</th>
                <th>D.O.No</th>
                <th>LR No </th>
                <th>LR Date</th>
                <th>Vehicle No</th>
                <th>Consignee Code</th>
                <th>Consignee Name</th>
                <th>Item Code</th>
                <th>Item Name</th>
                <th>Qty</th>
                <th>Invoice No</th>
                <th>Account  Code </th>
                <th>Account  Name </th>
                <th>Eway Bill No</th>
                <th>Valid Upto Date</th>
                <th>Action</th>
               </tr>
             </thead>

             <tbody>
          <?php  $srno = 1;  

          foreach ($ewaybill_info as $value) { ?>

          <?php date_default_timezone_set('Asia/Kolkata');
          $current_date = date('Y-m-d');
          // echo $current_date;

          $vdt = '';

          if($value->EWAYB_VALIDDT !='undefined' && $value->EWAYB_VALIDDT != '' && $value->EWAYB_VALIDDT != 'NULL'){

						$validUpDt = $value->EWAYB_VALIDDT;

						// check 4 hours
						
						$date    = explode(' ', $validUpDt);
						$getDt   = $date[0];
						$getTime = $date[1];
						$getPM   = $date[2];
						$getTP   = $getTime .' '.$getPM ;
						
						$newtime =  date("H:i:s", strtotime($getTP));
						
						$date8 = date('H:i:s A', strtotime($newtime. '- 8 hours'));
						$date4 = date('H:i:s A', strtotime($newtime. '+4 hours'));

         // echo $date4;
						$getdate4P = explode(' ',$date4);
						$getdate_4P = $getdate4P[1];
						$dtFA       = $getdate4P[0];
						
						$current_time = date('H:i:s A', strtotime('now'));
						$getP   = explode(' ',$current_time);
						$get_pm = $getP[1];
						$getPm = $getP[0]; 

            $vdate    = explode('/',$getDt);
            $v_date  = $vdate[0];
            $v_month = $vdate[1];
            $v_yr    = $vdate[2];

            $evalid_dt = $v_date.'-'.$v_month.'-'.$v_yr;

            $vdt = date('Y-m-d', strtotime($evalid_dt));

            if($vdt == $current_date){ 

            $time1 = strtotime($getPm);
            $time2 = strtotime($dtFA);
            $difference11 = round(abs($time2 - $time1) / 60,2);
            $hrs = floor($difference11 / 60);
            $min = $difference11 - ($hrs * 60);

            $totalHr = $hrs.':'.$min; 

            if($getdate_4P == $get_pm){

              // 4 hours

              if( $totalHr <= '4:0' ){ ?>

               <tr id="expiredInFourHr">

                <td id="expiredInFourHr">
                  <?php 
                  $do_date    = $value->DO_DATE;
                  if($do_date == '' || $do_date == 'NULL'){
                  echo '';
                  }else{
                  $data       =  date('d-m-Y', strtotime($do_date));
                  echo $data;
                  } ?>
                </td>

                <td id="expiredInFourHr">{{$value->DO_NUMBER}}</td>

                <td id="expiredInFourHr">{{$value->LR_NO}}</td>

                <td id="expiredInFourHr">
                  <?php 
                    $lr_date    = $value->LR_DATE;
                    if($lr_date == '' || $lr_date == 'NULL'){
                    echo '';
                    }else{
                    $data1       =  date('d-m-Y', strtotime($lr_date));
                    echo $data1;
                  } ?>
                </td>

                <td id="expiredInFourHr">{{$value->VEHICLE_NO}}</td>

                <td id="expiredInFourHr">{{$value->CP_CODE}}</td>
                <td id="expiredInFourHr">{{$value->CP_NAME}} </td>

                <td id="expiredInFourHr">{{$value->ITEM_CODE}}</td>
                <td id="expiredInFourHr">{{$value->ITEM_NAME}}</td>

                <td id="expiredInFourHr">
                 <?php $val_um = $value->UM;
                 if($val_um!= '' ||  $val_um!= null ) { ?>

                 {{$value->QTY}} <span class="label label-success"> {{$val_um}}</span>
               
                 <?php } else{
                 ?> {{$value->QTY}}
              <?php } ?>
                </td>

                <td id="expiredInFourHr">{{$value->INVC_NO}}</td>

                <td id="expiredInFourHr">{{$value->ACC_CODE}}</td>
                <td id="expiredInFourHr">{{$value->ACC_NAME}} </td>

                <td id="expiredInFourHr">{{$value->EBILL_NO}}</td>

                <td id="expiredInFourHr">
                  <?php 
                    $valid_date    = $value->EWAYB_VALIDDT;

                    if($valid_date == '' || $valid_date == null || $valid_date =='undefined'){

                     ?><label for=""class="btn btn-primary" style="border-radius: 1.25em;">Not Found</label>

                    <?php }else{

                      $eway_vdt = explode(' ',$valid_date);
                      $edt      = $eway_vdt[0];
                      
                      $edate    = explode('/',$edt);
                      $ew_date  = $edate[0];
                      $ew_month = $edate[1];
                      $ew_yr    = $edate[2];

                    ?>
                    <span id="blink"><?php echo $ew_date.'-'.$ew_month.'-'.$ew_yr; ?>  </span>

                   <?php } ?>
                </td>

                <td class="text-center" id="expiredInFourHr">

                  <?php 

                    if($get_pm){ ?>
                      
                      <?php if($current_time < $date4){ ?>

                         <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" onclick="funShowEwayBInfo('{{$value->EBILL_NO}}');">
                                 <i class="fa fa-plus"></i>
                         </button>

                           <label for="" class="label label-success"><span id="blink"><?php echo $totalHr; ?> Hr to expired</span></label> 

                      <?php  } else{ ?>
                       
                           <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" onclick="funShowEwayBInfo('{{$value->EBILL_NO}}');" disabled>
                              <i class="fa fa-plus"></i>
                           </button>

                      <?php }
                    } ?>
                  
                </td>
              </tr>
                           
              <?php $srno++;  }else{ ?>
                

              <?php } 

            }else{ ?>

            <!-- valid today date -->

            <tr id="validToday">

                  <td id="validToday">
                    <?php 
                    $do_date    = $value->DO_DATE;
                    if($do_date == '' || $do_date == 'NULL'){
                    echo '';
                    }else{
                    $data       =  date('d-m-Y', strtotime($do_date));
                    echo $data;
                    } ?>
                  </td>

                  <td id="validToday">{{$value->DO_NUMBER}}</td>

                  <td id="validToday">{{$value->LR_NO}}</td>

                  <td id="validToday">
                    <?php 
                      $lr_date    = $value->LR_DATE;
                      if($lr_date == '' || $lr_date == 'NULL'){
                      echo '';
                      }else{
                      $data1       =  date('d-m-Y', strtotime($lr_date));
                      echo $data1;
                    } ?>
                  </td>

                  <td id="validToday">{{$value->VEHICLE_NO}}</td>

                  <td id="validToday">{{$value->CP_CODE}}</td>

                  <td id="validToday">{{$value->CP_NAME}}</td>

                  <td id="validToday">{{$value->ITEM_CODE}}</td>
                  <td id="validToday">{{$value->ITEM_NAME}} </td>

                  <td id="validToday">
                   <?php $val_um = $value->UM;
                   if($val_um!= '' ||  $val_um!= null ) { ?>

                   {{$value->QTY}} <span class="label label-success"> {{$val_um}}</span>
                 
                   <?php } else{
                   ?> {{$value->QTY}}
                   <?php } ?> 
                  </td>

                  <td id="validToday">{{$value->INVC_NO}}</td>

                  <td id="validToday">{{$value->ACC_CODE}}</td>
                  <td id="validToday">{{$value->ACC_NAME}} </td>

                  <td id="validToday">{{$value->EBILL_NO}}</td>

                  <td id="validToday">

                    <?php 
                      $valid_date    = $value->EWAYB_VALIDDT;

                      if($valid_date == '' || $valid_date == null || $valid_date == 'undefined'){

                       ?><label for=""class="btn btn-primary" style="border-radius: 1.25em;">Not Found</label>

                      <?php }else{
                     
                        $eway_vdt = explode(' ',$valid_date);
                        $edt      = $eway_vdt[0];
                        
                        $edate    = explode('/',$edt);
                        $ew_date  = $edate[0];
                        $ew_month = $edate[1];
                        $ew_yr    = $edate[2];
                        echo $ew_date.'-'.$ew_month.'-'.$ew_yr;
                      } ?>

                  </td>

                  <td class="text-center" id="validToday">

                    <?php 
                    if(isset($value->EWAYB_VALIDDT)){

                      $dt = $value->EWAYB_VALIDDT;
                      $date = explode(' ', $dt);
                      $getDt = $date[0];
                      $getTime = $date[1];
                      $getPM = $date[2];
                      date_default_timezone_set('Asia/Kolkata');
                      
                      $getTP = $getTime .' '.$getPM ;
                      
                      $newtime =  date("H:i:s", strtotime($getTP));
                      
                      $date8 = date('H:i:s A', strtotime($newtime. '- 8 hours'));
                      $date4 = date('H:i:s A', strtotime($newtime. '+4 hours'));
                      
                      $current_time = date('H:i:s A', strtotime('now'));
                      $getP = explode(' ',$current_time);
                      $get_pm = $getP[1];

                    }else{

                      $get_pm = '';
                      $current_time = '';
                      $date8 = '';
                      $date4 = '';

                    }

                    if($get_pm){

                      if($current_time > $date8 ){ ?>
                        
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" onclick="funShowEwayBInfo('{{$value->EBILL_NO}}');">
                                <i class="fa fa-plus"></i>
                        </button>

                        <?php }else if($current_time < $date4){ ?>

                           <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" onclick="funShowEwayBInfo('{{$value->EBILL_NO}}');">
                                <i class="fa fa-plus"></i>
                        </button>

                        <?php  }

                        else{ ?>

                         <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" onclick="funShowEwayBInfo('{{$value->EBILL_NO}}');" disabled>
                                <i class="fa fa-plus"></i>
                         </button>

                        <?php }
                      }

                    ?>
                  </td>

              </tr>

            <?php $srno++;}

          } 

          }else{
             $getdate_4P = '';
             $get_pm = '';
             $dtFA = '';
             $getPm = '';
          }

          } ?>

            <?php foreach ($ewaybill_info as $value) { 
              
              date_default_timezone_set('Asia/Kolkata');
              $current_date = date('Y-m-d');
              $vdt = '';

              if($value->EWAYB_VALIDDT !='undefined' && $value->EWAYB_VALIDDT != '' && $value->EWAYB_VALIDDT != 'NULL'){

              $validUpDt = $value->EWAYB_VALIDDT;

              $date    = explode(' ', $validUpDt);
              $getDt   = $date[0];

              $vdate    = explode('/',$getDt);
              $v_date  = $vdate[0];
              $v_month = $vdate[1];
              $v_yr    = $vdate[2];

              $evalid_dt = $v_date.'-'.$v_month.'-'.$v_yr;

              $vdt = date('Y-m-d', strtotime($evalid_dt));
              
              if($vdt > $current_date){ ?>

                <tr id="upcoming">

                <td id="upcoming">

                  <?php $do_date    = $value->DO_DATE;

                  if($do_date == '' || $do_date == 'NULL'){
                    echo '';
                  }else{
                  $data       =  date('d-m-Y', strtotime($do_date));
                  echo $data;
                    } ?>

                </td>

                <td id="upcoming">{{$value->DO_NUMBER}}</td>

                <td id="upcoming">{{$value->LR_NO}}</td>

                <td id="upcoming">

                  <?php 
                  $lr_date    = $value->LR_DATE;

                  if($lr_date == '' || $lr_date == 'NULL'){
                    echo '';
                  }else{
                  $data1       =  date('d-m-Y', strtotime($lr_date));
                  echo $data1;
                    } ?>

                </td>

                <td id="upcoming">{{$value->VEHICLE_NO}}</td>

                <td id="upcoming">{{$value->CP_CODE}}</td>
                <td id="upcoming">{{$value->CP_NAME}} </td>

                <td id="upcoming">{{$value->ITEM_CODE}}</td>
                <td id="upcoming">{{$value->ITEM_NAME}}</td>

                <td id="upcoming">

                  <?php $val_um = $value->UM;
                   if($val_um!= '' ||  $val_um!= null ) { ?>

                   {{$value->QTY}} <span class="label label-success"> {{$val_um}}</span>
                 
                   <?php } else{
                   ?> {{$value->QTY}}
                   <?php } ?> 

                </td>

                <td id="upcoming">{{$value->INVC_NO}}</td>

               <td id="upcoming">{{$value->ACC_CODE}}</td>
               <td id="upcoming">{{$value->ACC_NAME}}</td>

               <td id="upcoming">{{$value->EBILL_NO}}</td>

               <td id="upcoming">

                  <?php $valid_date    = $value->EWAYB_VALIDDT;

                  if($valid_date == '' || $valid_date == 'NULL'){ ?>

                  <label for=""class="btn btn-primary" style="border-radius: 1.25em;">Not Found</label>

                  <?php }else{
                  
                  $eway_vdt = explode(' ',$valid_date);
                  $edt      = $eway_vdt[0];
                  
                  $edate    = explode('/',$edt);
                  $ew_date  = $edate[0];
                  $ew_month = $edate[1];
                  $ew_yr    = $edate[2];
                  echo $ew_date.'-'.$ew_month.'-'.$ew_yr;

                  } ?>

               </td>

                <td class="text-center" id="upcoming">

                   <button type="button" disabled="" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" onclick="funShowEwayBInfo('{{$value->EBILL_NO}}');"><i class="fa fa-plus"></i></button>
      
                </td>
              </tr>

              <?php $srno++;}
   				  
              }
              
              } ?>


              
              <?php foreach ($ewaybill_info as $value) { ?>

              <?php date_default_timezone_set('Asia/Kolkata');

       				$current_date = date('Y-m-d');

			        if($value->EWAYB_VALIDDT !='undefined' && $value->EWAYB_VALIDDT != '' && $value->EWAYB_VALIDDT != 'NULL'){

              $validUpDt = $value->EWAYB_VALIDDT;

              $date    = explode(' ', $validUpDt);
              $getDt   = $date[0];

              $vdate    = explode('/',$getDt);
              $v_date  = $vdate[0];
              $v_month = $vdate[1];
              $v_yr    = $vdate[2];

              $evalid_dt = $v_date.'-'.$v_month.'-'.$v_yr;

              $vdt = date('Y-m-d', strtotime($evalid_dt));
              
              if($vdt < $current_date){ ?>

                <tr id="expired">

                  <td id="expired">

                    <?php $do_date    = $value->DO_DATE;

                    if($do_date == '' || $do_date == 'NULL'){
                      echo '';

                    }else{

                      $data  =  date('d-m-Y', strtotime($do_date));
                        echo $data;
                    } ?>

                  </td>

                  <td id="expired">{{$value->DO_NUMBER}}</td>

                  <td id="expired">{{$value->LR_NO}}</td>

                  <td id="expired">

                    <?php $lr_date    = $value->LR_DATE;

                    if($lr_date == '' || $lr_date == 'NULL'){
                      echo '';

                    }else{

                      $data1  = date('d-m-Y', strtotime($lr_date));
                        echo $data1;
                   } ?>

                  </td>

                  <td id="expired">{{$value->VEHICLE_NO}}</td>

                  <td id="expired">{{$value->CP_CODE}}</td>
                  <td id="expired">{{$value->CP_NAME}} </td>

                  <td id="expired">{{$value->ITEM_CODE}}</td>
                  <td id="expired">{{$value->ITEM_NAME}}</td>

                  <td id="expired">{{$value->QTY}}</td>

                  <td id="expired">{{$value->INVC_NO}}</td>

                  <td id="expired">{{$value->ACC_CODE}}</td>
                  <td id="expired">{{$value->ACC_NAME}}</td>

                  <td id="expired">{{$value->EBILL_NO}}</td>

                  <td id="expired">
                   <?php $valid_date   = $value->EWAYB_VALIDDT;

                   if($valid_date == '' || $valid_date == null || $valid_date == 'undefined'){ ?>

                    <label for=""class="label label-primary" style="border-radius: 1.25em;">Not Found</label>

                   <?php }else{

                      $eway_vdt = explode(' ',$valid_date);
                      $edt = $eway_vdt[0];

                      $edate = explode('/',$edt);
                      $ew_date = $edate[0];
                      $ew_month = $edate[1];
                      $ew_yr = $edate[2];
                      echo $ew_date.'-'.$ew_month.'-'.$ew_yr;

                    } ?>

                  </td>

                  <td class="text-center" id="expired" >
                    
                    <button type="button" disabled="" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" onclick="funShowEwayBInfo('{{$value->EBILL_NO}}');"> <i class="fa fa-plus"></i></button>

                  </td>
                </tr>
                       
                <?php $srno++; }  } }?>
              

              
                        <!-- End Expired Eway bill No -->
                      
                    </tbody>

                  </table>

        <div class="modal" id="myModal">

          <div class="modal-dialog modal-lg">
          				    
          	<div class="modal-content">

          		<div class="modal-header">
				        <h4 class="modal-title">Extend EWB Validity</h4>
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				      </div>

				      <!-- Modal body -->
				      <div class="modal-body">
                
               	<div class="modalspinner hideloaderOnModl"></div>
          				      	
          				<div class="row">

          				  <div class="col-md-3">

          				    <div class="form-group">

	                      <label for="exampleInputEmail1">EWB No. <span class="required-field"></span></label>

	                      <div class="input-group">

	                         <input type="text" id="ewbNo" name="ewbNo" class="form-control " value="" placeholder="" autocomplete="off" readonly="">

	                      </div>

	                    </div>

    				      	</div>

  				      		<div class="col-md-3">

  				      			<div class="form-group">

                        <label for="exampleInputEmail1">Vehicle No. <span class="required-field"></span></label>

                        <div class="input-group">

                         <input type="text" id="vehicleNo" name="vehicleNo" class="form-control " value="" placeholder="" autocomplete="off" readonly="">

                        </div>

  			               </div>
  				      		</div>

  				      		<div class="col-md-3">

  				      			<div class="form-group">

                       <label for="exampleInputEmail1">From Place <span class="required-field"></span></label>

                        <div class="input-group">

                         <input type="text" id="fromPlace" name="fromPlace" class="form-control " value="" placeholder="" autocomplete="off" >

                        </div>

  			             </div>
  				      		</div>

               			<div class="col-md-3">

                			<div class="form-group">

                    		<label for="exampleInputEmail1">From State <span class="required-field"></span></label>

                    		<div class="input-group">

                          <input type="text" id="fromState" name="fromState" class="form-control " value="" placeholder="" autocomplete="off">

                        </div>

                      </div>
                    </div>
          				      		
          		    </div>

          				<div class="row">

                 		<div class="col-md-3">

  				      			<div class="form-group">

	                      <label for="exampleInputEmail1">Remaining Distance <span class="required-field"></span></label>

	                      <div class="input-group">

	                         <input type="text" id="remainingDistance" name="remainingDistance" class="form-control " value="" placeholder="" autocomplete="off">

	                      </div>

  			                 </div>
				      		  </div>

               			<div class="col-md-3">

                			<div class="form-group">

                        <label for="exampleInputEmail1">Trans Doc No <span class="required-field"></span></label>

                        <div class="input-group">

                           <input type="text" id="transDocNo" name="transDocNo" class="form-control " value="" placeholder="" autocomplete="off" readonly="">

                        </div>

                      </div>
                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                     		<label for="exampleInputEmail1">Trans Doc Date <span class="required-field"></span></label>

                      		<div class="input-group">

                           <input type="text" id="transDocDate" name="transDocDate" class="form-control " value="" placeholder="" autocomplete="off" readonly="">

                          </div>

                      </div>
                    </div>

                    <div class="col-md-3">

                    	<div class="form-group">

                        <label for="exampleInputEmail1">Trans Mode <span class="required-field"></span></label>

                        <div class="input-group">

                           <input type="text" id="transMode" name="transMode" class="form-control " value="" placeholder="" autocomplete="off" readonly="">

                        </div>

                      </div>
                    </div>

								  </div>

		              <div class="row">

                    <div class="col-md-3">

                      <div class="form-group">

                        <label for="exampleInputEmail1">Extend Rsn Code <span class="required-field"></span></label>

                        <div class="input-group">

                             <input type="text" id="extnRsnCode" name="extnRsnCode" class="form-control " value="" placeholder="" autocomplete="off" readonly="">

                        </div>

                     	</div>
              	    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label for="exampleInputEmail1">Extend Remarks <span class="required-field"></span></label>

                        <div class="input-group">

                             <input type="text" id="extnRemarks" name="extnRemarks" class="form-control " value="" placeholder="" autocomplete="off">

                        </div>

                      </div>
                    </div>

                    <div class="col-md-3">

                    	<div class="form-group">

                      	<label for="exampleInputEmail1">User Gstin <span class="required-field"></span></label>

                       	<div class="input-group">

                           <input type="text" id="userGstin" name="userGstin" class="form-control " value="" placeholder="" autocomplete="off" readonly="">

                        </div>

                      </div>
                    </div>
		
  		             <div class="col-md-3">

                     	<div class="form-group">

                        <label for="exampleInputEmail1">From Pincode <span class="required-field"></span></label>

                        <div class="input-group">

                             <input type="text" id="fromPincode" name="fromPincode" class="form-control " value="" placeholder="" autocomplete="off" >

                        </div>

                      </div>
                    </div>

                  </div>

		              <div class="row">

                    <div class="col-md-3">

                     	<div class="form-group">

                            <label for="exampleInputEmail1">Consignment Status <span class="required-field"></span></label>

				                    <select class="form-control" name="consignmentStatus" id="consignmentStatus"autocomplete="off">
                            
                                <option value="M" selected>M</option>
                                <option value="T">T</option>

                            </select>

                        </div>
                    </div>

             				<input type="hidden" id="transitType" name="transitType" class="form-control " value="" placeholder="" autocomplete="off">

							    </div>

              		<div class="row col-md-12" style="width: 100%;margin-top: 2%;margin-bottom:  2%" id="errorMsg">
              		</div>
          				       
          		</div>

  				    <div class="modal-footer">
  				        
				        <div class="text-center">

                  <button  class="btn btn-sm btn-success" id="extendValidity" style="padding-top: 3px;padding-bottom: 3px;font-size: 14px;" 
                  >Extend</button>   

                  <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal"style="padding-top: 3px;padding-bottom: 3px;font-size: 14px;">Cancel</button>    
               	</div>

  				    </div>

			    </div>
			  </div>
				</div>



                </div><!-- /.box-body -->



              </div><!-- /.box -->



            </div><!-- /.col -->



          </div><!-- /.row -->



        </section><!-- /.content -->



      </div>







@include('admin.include.footer')




<script type="text/javascript">

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
        
       var rowcount = data.length;

        if(rowcount > 0){
           $('.buttons-excel').attr('disabled',false);
        }else{
           $('.buttons-excel').attr('disabled',true);
        }
  },
  "search": true,
  scrollX: true,
   pageLength:'25',
   dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
      
   buttons: [
                {
                  extend: 'excelHtml5',
                  exportOptions: {
                                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                  },
                  title: 'EWAY_BILL_TRIP_LR_'+$("#headerexcelDt").val(),
                  filename: 'EWAY_BILL_TRIP_LR_'+$("#headerexcelDt").val(),
                  footer: true
                }
    ],
     



});

});

function funShowEwayBInfo(ewbNo){
	
	$.ajaxSetup({

      headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }
    });

     $.ajax({

         url:"{{ url('/Trips/ewaybill-refreshEwb') }}",

         type: "POST",

         data: {ewbNo:ewbNo},

         beforeSend: function() {
            $('.modalspinner').removeClass('hideloaderOnModl');
         },

         success:function(data){
         	var data1 = JSON.parse(data);
         	var info = data1.info.response;

         	if(info != ''){

    				$('#ewbNo').val(info.ewbNo);
    				$('#vehicleNo').val(info.vehicleNo);
    				$('#fromPlace').val(info.fromPlace);
    				$('#fromState').val(info.fromStateCode);
    				$('#transDocNo').val(info.docNo);
    				$('#transDocDate').val(info.transDocDate);
    				$('#transMode').val(info.transMode);
    				$('#extnRsnCode').val('1');
    				$('#userGstin').val(info.userGstin);
    				$('#fromPincode').val(info.fromPincode);
    				$('#transitType').val(info.transitType);
    				$('#consignmentStatus').val(info.consignmentStatus);

    				var chkconigment = $('#consignmentStatus').val();
    				
    				if(chkconigment == '' || chkconigment == null){

    					var tranMode = $('#transMode').val();
    					
    					if(tranMode == 1 || tranMode == 2 || tranMode == 3 || tranMode == 4){
    						$('#consignmentStatus').val('M');
    					}else{
    						$('#consignmentStatus').val('');
    					}


    				}else{

    				}


         	}

        },
         complete: function() {
            $('.modalspinner').addClass('hideloaderOnModl');
          },
     });
}

$(document).ready(function(){

    $('#extendValidity').on('click',function(){

      var ewbNo = $('#ewbNo').val();
      var vehicleNo = $('#vehicleNo').val();
      var fromPlace = $('#fromPlace').val();
      var fromState = $('#fromState').val();
      var remainingDistance = $('#remainingDistance').val();
      var transDocNo = $('#transDocNo').val();
      var transDocDate = $('#transDocDate').val();
      var transMode = $('#transMode').val();
      var extnRsnCode = $('#extnRsnCode').val();
      var extnRemarks = $('#extnRemarks').val();
      var userGstin = '05AAAAT2562R1Z3';
      var fromPincode = $('#fromPincode').val();
      var transitType = $('#transitType').val();
      var consignmentStatus = $('#consignmentStatus').val(); 

      $.ajaxSetup({

          headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
      });

      $.ajax({

         url:"{{ url('/Trips/ewaybill-extendEwb') }}",

         type: "POST",

         data: {ewbNo:ewbNo,vehicleNo:vehicleNo,fromPlace:fromPlace,fromState:fromState,remainingDistance:remainingDistance,transDocNo:transDocNo,transDocDate:transDocDate,transMode:transMode,extnRsnCode:extnRsnCode,extnRemarks:extnRemarks,userGstin:userGstin,fromPincode:fromPincode,transitType:transitType,consignmentStatus:consignmentStatus},

         success:function(data){
          
          var data1 = JSON.parse(data);
          
          var response = data1.response;
          if(response == 'success'){

            var validUptoDt = data1['valid_data']['validUpto'];
            var upto_date = validUptoDt.split(" ");
            var uptoDt = upto_date[0];
            var uptoTime = upto_date[1];
            var uptoPm = upto_date[2];

            var datesplit = uptoDt.split("/");
            var getdt = datesplit[0];
            var getmonth = datesplit[1];
            var getYear = datesplit[2];

            var validUpto = getYear+'-'+getmonth+'-'+getdt+' '+uptoTime+ ' '+uptoPm;


            $.ajax({

               url:"{{ url('/Trips/ewaybill-update-validUpto') }}",

               type: "POST",

               data: {ewbNo:ewbNo,validUpto:validUpto},

               success:function(data){
                var data1 = JSON.parse(data);
                
                var response = data1.response;
                if(response == 'success'){

                  $('#myModal').modal('hide');
                  $('#succMsg').html('E - way bill processed successfully');
                   location.reload();
                  
                }else{

                   $('#errorMsg').html('Problem while performing operation');
                }

               }
               
            });
            
          }else if(response == 'error'){

            var msg = data1['message'];
            
            $('#errorMsg').html('<i class="fa fa-caret-right" aria-hidden="true"></i> '+msg).css({"height": "2%", color: "#df1010","font-weight": "600", padding: "9px","text-align": "center" });
          }else{
             console.log('test');
          }

         }
         
     });

    });
});




 

</script>





@endsection







