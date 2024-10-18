    
@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



@include('admin.include.sidebar')

<style type="text/css">
  .settitle{
    font-weight: 600;
    font-size: 17px;
  }
  sup {
    top: -0.2em;
}
.shadow-lg  { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
.Box1:hover{
    border: 1px solid #a9e1f5;
    border-radius: 5px;
}
.Box2:hover{
    border: 1px solid #a0f5ce;
    border-radius: 5px;
}
/*.small-box h3 {
    font-size: 32px !important;
    font-weight: bold;
    margin: 0 0 10px 0;
    white-space: nowrap;
    padding: 0;
}*/
.tabtask{
  font-weight: 600;
}

/* New Box Css  */

.bg-info, .bg-info>a {
    color: #fff!important;
}

.bg-info {
    background-color: #17a2b8!important;
}

.bg-success, .bg-success>a {
    color: #fff!important;
}
.bg-success {
    background-color: #28a745!important;
}
.bg-warning, .bg-warning>a {
    color: #1f2d3d!important;
}
.bg-warning {
    background-color: #ffc107!important;
}
.bg-danger, .bg-danger>a {
    color: #fff!important;
}
.bg-danger {
    background-color: #dc3545!important;
}
.bg-purple, .bg-purple>a {
    color: #fff!important;
}
.bg-purple {
    background-color: #6f42c1!important;
}
.bg-fuchsia, .bg-fuchsia>a {
    color: #fff!important;
}
.bg-fuchsia {
    background-color: #f012be!important;
}
.bg-maroon, .bg-maroon>a {
    color: #fff!important;
}
.bg-maroon {
    background-color: #d81b60!important;
}
.bg-lime, .bg-lime>a {
    color: #1f2d3d!important;
}
.bg-lime {
    background-color: #01ff70!important;
}
.bg-teal, .bg-teal>a {
    color: #fff!important;
}
.bg-teal {
    background-color: #20c997!important;
}
.bg-olive, .bg-olive>a {
    color: #fff!important;
}
.bg-olive {
    background-color: #3d9970!important;
}
.bg-navy, .bg-navy>a {
    color: #fff!important;
}
.bg-navy {
    background-color: #001f3f!important;
}
.bg-lightblue, .bg-lightblue>a {
    color: #fff!important;
}
.bg-lightblue {
    background-color: #3c8dbc!important;
}
.bg-orange, .bg-orange>a {
    color: #1f2d3d!important;
}
.bg-orange {
    background-color: #fd7e14!important;
}
.small-box {
    border-radius: 0.25rem;
    box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
    display: block;
    margin-bottom: 20px;
    position: relative;
}

.small-box>.inner {
    padding: 10px;
}
@media (min-width: 1200px)
.col-lg-3 .small-box h3, .col-md-3 .small-box h3, .col-xl-3 .small-box h3 {
    font-size: 2.2rem;
}
@media (min-width: 992px)
.col-lg-3 .small-box h3, .col-md-3 .small-box h3, .col-xl-3 .small-box h3 {
    font-size: 1.6rem;
}
.small-box h3 {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0 0 10px;
    padding: 0;
    white-space: nowrap;
}
.small-box p {
    font-size: 1rem;
}
.small-box .icon {
    color: rgba(0,0,0,.15);
    z-index: 0;
}

.small-box .icon>i.fa, .small-box .icon>i.fab, .small-box .icon>i.fad, .small-box .icon>i.fal, .small-box .icon>i.far, .small-box .icon>i.fas, .small-box .icon>i.ion {
    font-size: 70px;
    top: 20px;
}

.small-box .icon>i {
    font-size: 90px;
    position: absolute;
    right: 15px;
    top: 15px;
    transition: -webkit-transform .3s linear;
    transition: transform .3s linear;
    transition: transform .3s linear,-webkit-transform .3s linear;
}

.small-box>.small-box-footer {
    background-color: rgba(0,0,0,.1);
    color: rgba(255,255,255,.8);
    display: block;
    padding: 3px 0;
    position: relative;
    text-align: center;
    text-decoration: none;
    z-index: 10;
}

/*.small-box {
    /* border-radius: 2px; */
    position: relative;
    display: block;
    margin-bottom: 20px;
    box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
    border-radius: 5px;
    box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
}*/
/*.content{
  height: auto !important;
}*/
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #ffffff;
}
tr, td{
  font-size: 12px !important;
  padding: 0px !important;
}
.showcursor{
  cursor: pointer
}
.btn-xs{
  padding: 0px 5px !important;
}
.modltitletext{
    text-align: center;
    font-size: 16px;
    font-weight: 700;
    color: #69b0cb;
}
.showSeletedName{
  color: #5597b1;
    font-weight: 700;
}
.statusHead{
  font-size: 16px;
    font-weight: 700;
    color: #69b0cb;
}
.setmargin{
  padding-left: 4px;
}
.block_one{
    border: 1px solid #d7cfcf;
    padding: 5px;
    margin-bottom: 10px;
    border-top-color: #3c8dbc;
}
.bloc_two{
    border: 1px solid #d7cfcf;
    padding: 5px;
    margin-bottom: 10px;
    border-top-color: #e9350c !important;
}
.block_three{
    border: 1px solid #d7cfcf;
    padding: 5px;
    margin-bottom: 10px;
    border-top-color: #ff9800c9 !important;
}
@keyframes blinker {
  50% {
    opacity: 0;
  }
}

@media only screen and (max-width: 600px) {

  .boxTextName {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    max-width: 150px;
  }

}
.firstColtbl{
  width:20%;
  line-height: 1;
}
.secColtbl{
  width:21%;
  line-height: 1;
}
.thirdColtbl{
  width:22%;
  line-height: 1;
}
.desColtbl{
  width:27%;
  line-height: 1;
}
.Actntbl{
  width:10%;
  line-height: 1;
}
.f_secColTbl{
  width:15%;
}
.s_secColTbl{
  width:15%;
}
.t_secColTbl{
  width:16%;
}
.ff_secColTbl{
  width:17%;
}
.ss_secColTbl{
  width:27%;
}
.sss_secColTbl{
  width:10%;
}
[data-tip] {
  position:relative;

}
[data-tip]:before {
  content:'';
  /* hides the tooltip when not hovered */
  display:none;
  content:'';
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 5px solid #1a1a1a; 
  position:absolute;
  top:20px;
  left:45px;
  z-index:8;
  font-size:0;
  line-height:0;
  width:0;
  height:0;
}
[data-tip]:after {
  display:none;
  content:attr(data-tip);
  position:absolute;
  top:25px;
  left:0px;
  padding:3px 3px;
  background:#1a1a1a;
  color:#fff;
  z-index:9;
  font-size: 0.75em;
  height:25px;
  line-height:18px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  white-space:nowrap;
  word-wrap:normal;
}
[data-tip]:hover:before,
[data-tip]:hover:after {
  display:block;
}
</style>
<style>

.expiredFirstLine{
  font-size: 16px;
  font-weight: 600;
}

.expiredSecondLine{
  font-size: 16px;
  font-weight: 600;
  margin-top: 3.3%;
}
  
@media only screen and (max-width: 600px) {    

.expiredFirstLine{
  font-size: 12px;
  font-weight: 600;
}

.expiredSecondLine{
  font-size: 12px;
  font-weight: 600;
  margin-top: 3.5%;
}  

}
.textHide{
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  max-width: 250px;
}
</style>

<style>
 

.unstyled {
  margin: 0;
  list-style: none;
}
.unstyled a, .unstyled #test {
  width: 120px;
  text-decoration: none;
  padding: .5em 1em;
  background-color: #213347;
  border-radius: 4px;
  display: block;
  margin-bottom: .5em;
  font-size:15px;
  font-weight:300;
  font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
}
.unstyled a:hover, .unstyled #test:hover {
  background-color: #f25c5d;
}

.cf, .alert {
  *zoom: 1;
}
.cf:before, .alert:before, .cf:after, .alert:after {
  display: table; 
  content: "";
  line-height: 0;
}
.cf:after, .alert:after {
  clear: both;
}

#alerts {
  width: 400px;
  top: 12px;
  right: 50px;
  position: fixed;
  z-index: 9999;
  list-style: none;
}

.alert {
  width: 100%;
  margin-bottom: 8px;
  display: block;
  position: relative;
  border-left: 4px solid;
  right: -50px;
  opacity: 0;
  line-height: 1;
  padding: 0;
  transition: right 400ms, opacity 400ms, line-height 300ms 100ms, padding 300ms 100ms;
  display: table;
}

.alert:hover {
  cursor: pointer;
  box-shadow: 0 0 6px rgba(0, 0, 0, 0.3);
}

.open {
  right: 0;
  opacity: 1;
  line-height: 2;
  padding: 3px 15px;
  transition: line-height 200ms, padding 200ms, right 350ms 200ms, opacity 350ms 200ms;
}

.alert-title {
  font-weight: bold;
}

.alert-block {
  width: 80%;
  width: -webkit-calc(100% - 10px);
  width: calc(100% - 10px);
  text-align: left;
}
.alert-block em, .alert-block small {
  font-size: .75em;
  opacity: .75;
  display: block;
}

.alert i {
  font-size: 2em;
  width: 1.5em;
  max-height: 48px;
  top: 50%;
  margin-top: -12px;
  display: table-cell;
  vertical-align: middle;
}

.alert-success {
  color: #fff;
  border-color: #539753;
  background-color: #8fbf2f;
}

.alert-error {
  color: #fff;
  border-color: #dc4a4d;
  background-color: #f25c5d;
}

.alert-trash {
  color: #fff;
  border-color: #dc4a4d;
  background-color: #f25c5d;
}

.alert-info {
  color: #fff;
  border-color: #076d91;
  background-color: #3397db;
}

.alert-warning {
  color: #fff;
  border-color: #dd6137;
  background-color: #f7931d;
}

#reportsChart li>a:hover {

  color:#fff;
}

#reportsChart li.active>a:hover {

  color:#444;
}

.mkGimg {
    position: absolute !important;
    text-align: center;
    margin-left: 51%;
    top: 5px !important;
    color: steelblue;
    margin-top: 20%;
    transform: translate(-10%, -10%);
    opacity:0.1;
    width:35%;
    height:50%;

}


</style>
 <!-- =========== Start : demo page ============= -->



      <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Dashboard 


            <small style="font-weight: 600;color: #3c8dbc;">| ERP Management System</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Dashboard</li>

          </ol>

        </section>



        <!-- Main content -->
        

      
      <section class="content">

        <div class="row">

          <div>
           <img src="{{ url('/public/dist/img/MUKUNDGROUPLOGO.png')}}" class="mkGimg">
          </div>

          <?php if(Session::get('usertype')=='user') { ?>
                <?php 
                   if($userid){
                    $getUid = base64_encode($userid); 
                   }else{
                    $getUid ='';
                   }
               
                ?>
                
              <a href="{{ url('/finance/user-approval-list/'.$getUid) }}" class="small-box-footer" <?php if($getUid==''){ echo 'readonly';} ?>>
             <div class="col-lg-3 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                <?php if(Session::get('userid')) { ?>
                  <h3><?php if(isset($totalcount)){echo $totalcount;}else{echo '';} ?>
                  <sup style="font-size: 20px"></sup>
                  </h3>
                <?php } else { ?>
                  <h3><?php echo '0'; ?>
                  <sup style="font-size: 20px"></sup>
                  </h3>
                <?php }?>
                  <p>Pending For Approval</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-plus"></i>
                </div>
                <span class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></span>
              </div>
            </div>
             </a>
          <?php } else if(Session::get('usertype')=='employee') { ?>
                <?php 
                   if($userid){
                    $getUid = base64_encode($userid); 
                   }else{
                    $getUid ='';
                   }
               
                ?>
                
              <a href="{{ url('/finance/user-approval-list/'.$getUid) }}" class="small-box-footer" <?php if($getUid==''){ echo 'readonly';} ?>>
             <div class="col-lg-3 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                <?php if(Session::get('userid')) { ?>
                  <h3><?php if(isset($totalcount)){echo $totalcount;}else{echo '';} ?>
                  <sup style="font-size: 20px"></sup>
                  </h3>
                <?php } else { ?>
                  <h3><?php echo '0'; ?>
                  <sup style="font-size: 20px"></sup>
                  </h3>
                <?php }?>
                  <p>Task List Pending For Approval</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-plus"></i>
                </div>
                <span class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></span>
              </div>
            </div>
             </a>
          <?php }else { ?>

          <section class="col-sm-7 connectedSortable ui-sortable">

            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs" style="background-color: #fd7e14;" id="reportsChart">
                  <li class="active"><a href="#mis_report" class="tabtask" data-toggle="tab" aria-expanded="true">MIS</a></li>
                  <li class=""><a href="#tab_2" class="tabtask" data-toggle="tab" aria-expanded="false">Logistics</a></li>
                  <li class=""><a href="#c_and_f_report" class="tabtask" data-toggle="tab" aria-expanded="false">C & F</a></li>
                  <li class=""><a href="#cold_storage_report" class="tabtask" data-toggle="tab" aria-expanded="false">Cold Storage</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="mis_report">
                 
                 <div class="row">
                 <!--  <h4 class="mb-2" style="margin-left: 2.5%;">Sales Report <small style="color:#3c8dbc;"><i>: Showing Sales Report Utility</i></small></h4> -->

                  <a href="{{ url('/Dashboard/Top-Sales') }}" id="salePrty">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h3>Top 10</h3>
                          <p style="font-size: 16px;font-weight: 700;">Sale Party</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-user"></i>
                        </div>
                        <div class="small-box-footer">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div>
                  </a>

                  <a href="{{ url('/Dashboard/Top-Item') }}" id="saleItem">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3>Top 10</h3>
                          <p style="font-size: 16px;font-weight: 700;">Sale Item</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-pie-chart"></i>
                        </div>
                          <div class="small-box-footer">
                            <i class="fa fa-arrow-circle-right"></i>
                          </div>
                      </div>
                    </div><!-- ./col -->
                  </a>

                </div> 

                <div class="row">

                  <a href="{{ url('/Dashboard/Top-debitors') }}" id="DebitorsDue">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3>Top 10</h3>
                          <p style="font-size: 16px;font-weight: 700;">Debtors Due's</p>
                        </div>
                        <div class="icon">
                         <i class="fa fa-user-plus"></i>
                        </div>
                        <div class="small-box-footer">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div><!-- ./col -->
                  </a>

                  <a href="{{ url('/Dashboard/Top-creditor') }}" id="CreditorsDue">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3>Top 10</h3>
                          <p style="font-size: 16px;font-weight: 700;">Creditors Due's</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-user-plus"></i>
                        </div>
                        <div class="small-box-footer">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div><!-- ./col -->
                  </a>

                </div>

                <div class="row">
                  <a href="{{ url('Dashboard/Open-Order') }}" id="pendingOrder">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-lightblue">
                        <div class="inner">
                          <h3 style="font-size: 26px;">Top 10</h3>
                          <p style="font-size: 16px;font-weight: 700;">Pending Order</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-bars"></i>
                        </div>
                        <div class="small-box-footer">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div><!-- ./col -->
                  </a>

                  <a href="{{ url('Dashboard/Age-Analysis') }}" id="partyWise">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-maroon">
                        <div class="inner">
                          <h3 style="font-size: 28px !important;">Party Wise</h3>
                          <p style="font-size: 18px;font-weight: 600;">Age Analysis</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-bar-chart"></i>
                        </div>
                        <div class="small-box-footer">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div><!-- ./col -->
                  </a>
                </div>

                <div class="row">
                  <a href="{{ url('Dashboard/Score-Card-Defination') }}" id="taskList">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-teal">
                        <div class="inner">
                          <h4 style="font-size: 26px;font-weight:700;">Score Card</h4>
                          <p style="font-size: 16px;font-weight: 700;">Task List</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-bars"></i>
                        </div>
                        <div class="small-box-footer">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div><!-- ./col -->
                  </a>

                  <a href="{{url('/reports/stock/stock-age-wise-analysis')}}" id="stockWise">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-orange">
                        <div class="inner">
                          <h4 style="font-size: 26px;font-weight:700;">Stock Wise</h4>
                          <p style="font-size: 16px;font-weight: 700;">Age Analysis</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-bar-chart"></i>
                        </div>
                        <div class="small-box-footer">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div><!-- ./col -->
                  </a>

                </div>

                

                </div>

                <!-- End MIS TAB -->
                <div class="tab-pane" id="tab_2">

                  <div class="row">
                    <a href="{{url('/Dashboard/Trips-status')}}" id="tripLrStatus">
                        <div class="col-lg-6 col-xs-6">
                          <!-- small box -->
                          <div class="small-box bg-info">
                            <div class="inner">
                              <h3>Trips/LR Status</h3>
                              <p style="font-size: 16px;font-weight: 700;">All Status</p>
                            </div>
                            <div class="icon">
                              <i class="fa fa-truck"></i>
                            </div>
                            <div class="small-box-footer">
                              <i class="fa fa-arrow-circle-right"></i>
                            </div>
                          </div>
                        </div><!-- ./col -->
                    </a>

                    <a href="{{ url('/Dashboard/Vehical-doc-updation')}}" id="vehicleDoc">
                      <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                          <div class="inner" id="">
                            <div data-tip="<?php echo $countData; ?> Vehicle Doc Updation...">
                              <h3  class="boxTextName textHide">
                              {{$countData}} Vehicle Doc Updation
                            </div>
                          </h3>
                          <div class="row">
                            <div class="col-md-12 expiredFirstLine">
                              Expired Vel. : {{$countExpData}} /
                              In 2 Days : {{$twodayC}} 
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12 expiredSecondLine"> 
                              In 5 Days : {{$fivedayC}} /
                              In 10 Days : {{$tenDayC}}
                           </div>
                          </div>
                         
                          </div>
                          <div class="icon">
                            <i class="fa fa-pencil-square-o"></i>
                          </div>
                          <div class="small-box-footer">
                            <i class="fa fa-arrow-circle-right"></i>
                          </div>
                        </div>
                      </div><!-- ./col -->
                    </a>
                  </div>

                  <div class="row">
                    

                    <a href="{{ url('/dashoard/track-vehicle') }}" id="DebitorsDue">
                      <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                          <div class="inner">
                            <h3>Track Vehicle</h3>
                            <p style="font-size: 16px;font-weight: 700;"> <?php echo $eTrans; ?> 
                          Total Vehicle </p>
                          </div>
                          <div class="icon">
                           <i class="fa fa-map-marker"></i>
                          </div>
                          <div class="small-box-footer">
                            <i class="fa fa-arrow-circle-right"></i>
                          </div>
                        </div>
                      </div><!-- ./col -->
                    </a>

                    <a href="{{ url('/transaction/Logistics/Daily-padta-report') }}" id="partyWise">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-maroon">
                        <div class="inner">
                          <h3>Daily Padta</h3>
                          <p style="font-size: 18px;font-weight: 600;">Profitability</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-bar-chart"></i>
                        </div>
                        <div class="small-box-footer">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div><!-- ./col -->
                  </a>
                  </div>

                  <div class="row">
                  <a href="{{ url('/transaction/Logistics/Daily-trip-plan-report') }}" id="">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-lightblue">
                        <div class="inner">
                          <h3>Daily Trip Plan</h3>
                          <p style="font-size: 16px;font-weight: 700;">Status</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-bars"></i>
                        </div>
                        <div class="small-box-footer">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div><!-- ./col -->
                  </a>

                   <a href="{{ url('/transaction/Logistics/Bill-status-report') }}" id="">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-orange">
                        <div class="inner">
                          <h3>eProc Bill Status</h3>
                          <p style="font-size: 16px;font-weight: 700;">Status</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-bars"></i>
                        </div>
                        <div class="small-box-footer">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div><!-- ./col -->
                  </a>
                </div>

                 <div class="row">
                  <a href="{{url('/transaction/Logistics/Trip-compleation-status')}}" id="">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        
                        <div class="inner">
                          <h3>Trip Status at a Glance</h3>
                          <p style="font-size: 16px;font-weight: 700;">Status</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-bar-chart"></i>
                        </div>
                        <div class="small-box-footer">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div><!-- ./col -->
                  </a>

                  <a href="{{url('/transaction/logistics/trip-exp-payment-advice')}}" id="">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-info">
                        
                        <div class="inner">
                          <h3>Pending for Payment Advice - Market</h3>
                          <p style="font-size: 16px;font-weight: 700;">Status</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-truck"></i>
                        </div>
                        <div class="small-box-footer">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div><!-- ./col -->
                  </a>

                  <a href="{{url('/transaction/logistics/e-invoice-report')}}" id="">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-info">
                        
                        <div class="inner">
                          <h3>e-Invoice</h3>
                          <p style="font-size: 16px;font-weight: 700;">Status</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-truck"></i>
                        </div>
                        <div class="small-box-footer">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div><!-- ./col -->
                  </a>

                </div>
                  
                </div>
                <!-- End Logistics Tab -->
                <div class="tab-pane" id="c_and_f_report">

                  <div class="row">
                    <a href="{{ url('/report/c_and_f/stock-summary') }}" id="">
                      <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                          <div class="inner">
                            <h3>Stock Summary</h3>
                            <p style="font-size: 16px;font-weight: 700;">Summary Status</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-archive" aria-hidden="true"></i>
                          </div>
                          <div class="small-box-footer">
                            <i class="fa fa-arrow-circle-right"></i>
                          </div>
                        </div>
                      </div>
                    </a>

                     <a href="{{ url('/report/c_and_f/stock-ledger') }}" id="">
                      <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                          <div class="inner">
                            <h3>Stock Ledger</h3>
                            <p style="font-size: 16px;font-weight: 700;">Summary Status</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-pie-chart"></i>
                          </div>
                            <div class="small-box-footer">
                              <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                      </div><!-- ./col -->
                    </a>

                  </div> 

                  <div class="row">
                    <a href="{{ url('/report/c-and-f/rake-do-summary') }}" id="DebitorsDue">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3>Rake DO - Summary</h3>
                          <p style="font-size: 16px;font-weight: 700;">Summary Status</p>
                        </div>
                        <div class="icon">
                         <i class="fa fa-bar-chart" aria-hidden="true"></i>
                        </div>
                        <div class="small-box-footer">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div><!-- ./col -->
                  </a>
                  </div>
                  
                </div>
                <div class="tab-pane" id="cold_storage_report">
                  
                  <div class="row">
                    <a href="{{ url('/transaction/ColdStorage/Bilty-Report') }}" id="">
                      <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                          <div class="inner">
                            <h3>Bilty</h3>
                            <p style="font-size: 16px;font-weight: 700;">Bilty Status</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-archive" aria-hidden="true"></i>
                          </div>
                          <div class="small-box-footer">
                            <i class="fa fa-arrow-circle-right"></i>
                          </div>
                        </div>
                      </div>
                    </a>

                    <a href="{{ url('/transaction/ColdStorage/Sale-bill-Report') }}" id="">
                      <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                          <div class="inner">
                            <h3>Sale Bill</h3>
                            <p style="font-size: 16px;font-weight: 700;">Status </p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                          </div>
                          <div class="small-box-footer">
                            <i class="fa fa-arrow-circle-right"></i>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>

                  <div class="row">
                    <a href="{{ url('/report-pending-complete-bill-payment') }}" id="DebitorsDue">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3>Customer Outstanding</h3>
                          <p style="font-size: 16px;font-weight: 700;">Status</p>
                        </div>
                        <div class="icon">
                         <i class="fa fa-bar-chart" aria-hidden="true"></i>
                        </div>
                        <div class="small-box-footer">
                          <i class="fa fa-arrow-circle-right"></i>
                        </div>
                      </div>
                    </div><!-- ./col -->
                  </a>

                  
                  </div>

                </div>
              </div>
            </div>
            </section>

  <?php } ?>
          <section class="col-sm-5 connectedSortable ui-sortable">

            @if(Session::has('alert-success'))

              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4> <i class="icon fa fa-check"></i> Success...!</h4>

                 {!! session('alert-success') !!}
              </div>

            @endif

            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs" style="background-color: #ebe7db;">
                <li class="active"><a href="#tab_1" class="tabtask" data-toggle="tab" aria-expanded="true">Favourite</a></li>
                <li class=""><a href="#tab_2" class="tabtask" data-toggle="tab" aria-expanded="false">My Task</a></li>
                <li class=""><a href="#tab_3" class="tabtask" data-toggle="tab" aria-expanded="false">Task</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <input type="hidden" value="{{Session::get('userid')}}" id="LoginUser">
                  <table class="table table-striped table-bordered table-hover" style="width: 100%;">

                    <?php $srno=1; foreach ($pageData as $key) { ?>

                      <tr>
                        <td class="showcursor" onclick="clicklink('<?php echo $srno;?>','<?php echo $key->form_link;?>')"><span>{{$key->FORM_CODE}} - {{$key->FORM_NAME}}</span></td>
                        <td class="text-center"><button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dleteuserTCode('<?php echo $key->USERTCODEID;?>','<?php echo $srno; ?>');"><i class="fa fa-trash" style='padding: 0px;font-size: 13px;' title="Delete"></i></button></td>
                        <!-- model for delete data -->
                        <div class="modal fade" id="usertcodeDelete<?php echo $srno; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                You Want To Delete This Data...!
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>
                                  <form action="{{ url('/delete-user-tcode-data') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="usertcodeId" id="usertcodeId<?php echo $srno; ?>" value="">
                                    <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">
                                  </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- model for delete data -->
                      </tr>

                  <?php $srno++;} ?>
                  </table>
                  <a href="{{ url('Dashboard/user/tcode/form') }}" class="btn btn-primary btn-xs" title="edit" style="margin-top: 10px;">Add More</i></a>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <table class="table-border">
                      <tr>
                        <th class="firstColtbl">From User</th>
                        <th class="secColtbl">Task Name</th>
                        <th class="thirdColtbl">Target Date</th>
                        <th class="desColtbl">Description</th>
                        <th class="Actntbl">Action</th>
                      </tr>
                    <?php $tSrno =1; foreach ($MytaskData as $Mdata) {?>
                      <tr>
                        <td class="firstColtbl">{{$Mdata->USER_NAME}}</td>
                        <td class="secColtbl">{{$Mdata->TASK_NAME}}</td>
                        <td class="thirdColtbl">{{$Mdata->TARGET_DATE}}</td>
                        <td class="desColtbl">{{$Mdata->DESCRIPTION}}</td>
                        <td class="Actntbl"><?php if($Mdata->CL_DATE && $Mdata->CL_REMARK){ ?><div id="AplyIconBT<?php echo $tSrno; ?>"><i class="fa fa-check-circle" aria-hidden="true" style="color: green;font-size: 21px;margin-left: 3px;"></i></div><?php }else{ ?><button type="button" class="btn btn-primary btn-xs" id="task_status<?php echo $tSrno; ?>" data-toggle="modal" data-target="#taskStatus<?php echo $tSrno; ?>" style="padding-bottom: 0px;padding-top: 0px;" onclick="getUniqId('<?php echo $Mdata->TASKID; ?>','<?php echo $tSrno; ?>');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><?php } ?></div>

                          <!-- modal -->

                        <div class="modal fade" id="taskStatus<?php echo $tSrno; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                          <div class="modal-dialog" role="document" style="margin-top: 5%;">

                            <div class="modal-content" style="border-radius: 5px;">

                              <div class="modal-header">

                                <div class="row">
                                  <input type="hidden" id="itmOnQp1">
                                  <div class="col-md-12">
                                    <h5 class="modal-title modltitletext" id="exampleModalLabel">Update Task Status</h5>
                                  </div>

                                </div>

                              </div>
                              <form id="update_task_status<?php echo $tSrno; ?>">
                              <div class="modal-body table-responsive">
                                
                                <div class="box box-primary Custom-Box block_one">
                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label> From User: <span class="required-field"></span></label>

                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                          <input type="text"  id="fromUserUT" name="fromUserUT" class="form-control  pull-left" value="{{ $Mdata->USER_NAME }}" placeholder="Enter Close Date" readonly>

                                        </div> 

                                      </div>
                                      <!-- /.form-group -->
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label> Task: <span class="required-field"></span></label>

                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                          <input type="text"  id="taskUT" name="taskUT" class="form-control  pull-left" value="{{ $Mdata->TASK_NAME }}" placeholder="Enter Task" readonly>

                                        </div> 

                                      </div>
                                      <!-- /.form-group -->
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label> Target: <span class="required-field"></span></label>
                                        <?php $targetDate    = date("d-m-Y", strtotime($Mdata->TARGET_DATE));  ?>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                          <input type="text"  id="targetUT" name="targetUT" class="form-control  pull-left" value="{{ $targetDate }}" placeholder="Enter Target" readonly>

                                        </div> 

                                      </div>
                                      <!-- /.form-group -->
                                    </div>

                                  </div>

                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label> Description: <span class="required-field"></span></label>

                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                          <textarea type="text"  id="taskUT" name="taskUT" class="form-control  pull-left" placeholder="Enter Description" readonly>{{ $Mdata->DESCRIPTION }}</textarea>

                                        </div> 

                                      </div>
                                      <!-- /.form-group -->
                                    </div>
                                  </div>

                                </div>

                                <div class="box box-primary Custom-Box bloc_two">
                                    
                                  <div class="row">
                                    <div class="col-md-12">
                                      <table style="line-height: 1.5;">
                                        <thead>
                                          <tr>
                                            <td style="font-weight: bold;text-align: center;width: 14%;">Vr Date</td>
                                            <td style="font-weight: bold;text-align: center;">Remark</td>
                                            <td style="font-weight: bold;text-align: center;width: 24%;">Remark By</td>
                                          </tr>
                                        </thead>
                                        <tbody id="allTaskGet<?php echo $tSrno; ?>">
                                          
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>

                                  <div class="row" style="margin-top: 10px;">
                                  
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <?php $vrDateUP =date("d-m-Y"); ?>
                                        <div class="col-md-6">
                                          <label> Remark: <span class="required-field"></span></label>
                                          <input type="hidden" value="{{$vrDateUP}}" name="vrDateUP">
                                        </div>
                                        <div class="col-md-6" style="text-align: end;">
                                            <label>Vr Date: <?php echo $vrDateUP; ?></label>
                                        </div>
                                        <?php $vrDateUP =date("d-m-Y"); ?>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                          <textarea type="text" id="remarkUP<?php echo $tSrno; ?>" name="remarkUP" class="form-control  pull-left" value="" placeholder="Enter Remark" ></textarea>
                                        </div> 
                                      </div>
                                    </div>
                                  </div>

                                </div>

                                <div class="box box-primary Custom-Box block_three">
                                  <div class="row">  

                                    <div class="col-md-8">
                                      <div class="form-group">
                                        <label> Close Remark: <span class="required-field"></span></label>

                                        <div class="input-group">

                                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                          <input type="text"  id="close_remark<?php echo $tSrno; ?>" name="close_remark" class="form-control  pull-left" value="" placeholder="Enter Remark" oninput="addCloseDate('<?php echo $tSrno; ?>')">

                                        </div> 

                                        <small id="emailHelp" class="form-text text-muted">

                                          {!! $errors->first('close_remark', '<p class="help-block" style="color:red;">:message</p>') !!}

                                        </small>
                                        <small>
                                          <div class="pull-left showSeletedName" id="makeText"></div>
                                        </small>

                                      </div>
                                      <!-- /.form-group -->
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label> Close Date: <span class="required-field"></span></label>
                                        <?php $closeDate =date("d-m-Y"); ?>
                                        <div class="input-group">
                                          <input type="hidden" id="taskId<?php echo $tSrno; ?>" value="" name="uniqTaskId">
                                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                          <input type="text"  id="closeDate<?php echo $tSrno; ?>" name="closeDate" class="form-control  pull-left" value="" placeholder="Enter Close Date" readonly>

                                        </div> 

                                        <small id="emailHelp" class="form-text text-muted">

                                          {!! $errors->first('closeDate', '<p class="help-block" style="color:red;">:message</p>') !!}

                                        </small>
                                        <small>
                                          <div class="pull-left showSeletedName" id="makeText"></div>
                                        </small>

                                      </div>
                                      <!-- /.form-group -->
                                    </div>
                                  </div>
                                </div>
                                <div id="errorMsg<?php echo $tSrno; ?>" style="text-align:center;"></div>
                            </div>
                          </form>

                          <div class="modal-footer" style="text-align: center;">
                           
                            <button type="button" id="saveBtn<?php echo $tSrno; ?>" class="btn btn-primary" onclick="updataskSatus('<?php echo $tSrno; ?>');"> 
                              &nbsp;&nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  Save &nbsp;&nbsp;
                            </button>

                            <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-bottom: -69px;"> &nbsp;&nbsp;<i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Cancle &nbsp;&nbsp;
                            </button>
                          
                          </div>
                              
                      </div>

                    </div>

                  </div>

                          <!-- modal -->


                        </td>

                       
                      </tr>
                    <?php $tSrno++;} ?>
                  </table>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                  <table class="table-border" style="line-height:1;">

                      <tr>
                        <th class="f_secColTbl">From User</th>
                        <th class="s_secColTbl">To User</th>
                        <th class="t_secColTbl">Task Name</th>
                        <th class="ff_secColTbl">Target Date</th>
                        <th class="ss_secColTbl">Description</th>
                        <th class="sss_secColTbl">Action</th>
                      </tr>

                    <?php $srnum=1; foreach ($taskData as $taskT) { ?>
                      <tr>
                        <td class="f_secColTbl">{{$taskT->USER_NAME}}</td>
                        <td class="s_secColTbl">{{$taskT->TO_USER_NAME}}</td>
                        <td class="t_secColTbl">{{$taskT->TASK_NAME}}</td>
                        <td class="ff_secColTbl">{{$taskT->TARGET_DATE}}</td>
                        <td class="ss_secColTbl">{{$taskT->DESCRIPTION}}</td>
                        <td class="sss_secColTbl">
                        <div style="display: inline-flex;">

                        <?php if($taskT->STATUS =='0'){ ?>

                          <button type="button" class="btn btn-danger btn-xs" id="openTask<?php echo $srnum; ?>" data-toggle="modal" data-target="#open_task<?php echo $srnum; ?>" style="padding-bottom: 0px;padding-top: 0px;" onclick="getUniqId('<?php echo $taskT->TASKID; ?>','<?php echo $srnum; ?>');">Open</button>
                          <div class="modal fade" id="open_task<?php echo $srnum; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="margin-top: 5%;">
                                <div class="modal-content" style="border-radius: 5px;">
                                  <div class="modal-header">
                                    <div class="row">
                                      <input type="hidden" id="itmOnQp1">
                                      <div class="col-md-12">
                                        <h5 class="modal-title modltitletext" id="exampleModalLabel">Close Task</h5>
                                      </div>
                                    </div>
                                  </div>
                                    <form id="opentasktrans<?php echo $srnum; ?>">
                                      <div class="modal-body table-responsive">
                                          <div class="box box-primary Custom-Box block_one">
                                            <div class="row">  
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label> To User: <span class="required-field"></span></label>
                                                  <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                                    <input type="text" class="form-control  pull-left" value="{{ $taskT->TO_USER_NAME }}" placeholder="Enter Close Date" readonly>

                                                  </div> 
                                                </div>
                                              </div>

                                              <div class="col-md-4">
                                                <div class="form-group">
                                                    <label> Task: <span class="required-field"></span></label>
                                                    <div class="input-group">
                                                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                                      <input type="text" class="form-control  pull-left" value="{{ $taskT->TASK_NAME }}" placeholder="Enter Task" readonly>
                                                    </div> 
                                                </div>
                                              </div>
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                    <label> Target: <span class="required-field"></span></label>
                                                    <?php $targetDate    = date("d-m-Y", strtotime($taskT->TARGET_DATE));  ?>
                                                  <div class="input-group">
                                                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                                      <input type="text" class="form-control  pull-left" value="{{ $targetDate }}" placeholder="Enter Target" readonly>
                                                  </div> 
                                                </div>
                                              </div>
                                            </div>

                                            <div class="row">
                                              <div class="col-md-12">
                                                <div class="form-group">
                                                  <label> Description: <span class="required-field"></span></label>
                                                  <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                                    <textarea type="text" class="form-control  pull-left" placeholder="Enter Description" readonly>{{ $taskT->DESCRIPTION }}</textarea>
                                                  </div> 
                                                </div>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="box box-primary Custom-Box bloc_two">
                                            <div class="row">
                                              <div class="col-md-12">
                                                <table style="line-height: 1.5;">
                                                  <thead>
                                                    <tr>
                                                      <td style="font-weight: bold;text-align: center;width: 14%;">Vr Date</td>
                                                      <td style="font-weight: bold;text-align: center;">Remark</td>
                                                      <td style="font-weight: bold;text-align: center;width: 24%;">Remark By</td>
                                                    </tr>
                                                  </thead>
                                                  <tbody id="allOpenTask<?php echo $srnum; ?>">
                                                    
                                                  </tbody>
                                                </table>
                                              </div>
                                            </div>

                                            <div class="row" style="margin-top:10px;">
                                                <div class="col-md-4">
                                                  <div class="form-group">
                                                    <label> Vr Date: <span class="required-field"></span></label>
                                                    <?php $vrDateUP =date("d-m-Y"); ?>
                                                    <div class="input-group">
                                                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                                      <input type="hidden" name="tranTaskId" value="{{$taskT->TASKID}}">
                                                      <input type="text" class="form-control  pull-left" name="openVrDt" value="{{$vrDateUP}}" placeholder="Enter Vr Date" readonly>
                                                    </div> 
                                                  </div>
                                                </div>
                                                <div class="col-md-8">
                                                  <div class="form-group">
                                                    <label> Remark: <span class="required-field"></span></label>
                                                    <?php $vrDateUP =date("d-m-Y"); ?>
                                                    <div class="input-group">
                                                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                                      <textarea type="text" class="form-control  pull-left" name="openRemark" value="" placeholder="Enter Remark" ></textarea>
                                                    </div> 
                                                  </div>
                                                </div>
                                            </div>
                                          </div>
                                      </div>
                                    </form>
                                    <div class="modal-footer" style="text-align: center;">
                                   
                                      <button type="button" class="btn btn-primary" onclick="saveopenTask('<?php echo $srnum; ?>');">
                                          <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  Save
                                        </button>
                                      <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Cancle</button>
                                    </div>
                                </div>
                            </div>
                          </div>

                        <?php }else if($taskT->STATUS =='1'){?>

                          <button type="button" class="btn btn-warning btn-xs" id="closedTask<?php echo $srnum; ?>" data-toggle="modal" data-target="#closed_status<?php echo $srnum; ?>" style="padding-bottom: 0px;padding-top: 0px;" onclick="getclosedTask('<?php echo $taskT->TASKID; ?>','<?php echo $srnum; ?>');">Complete</button>

                        <?php }else if($taskT->STATUS =='2'){ ?>

                          <button type="button" class="btn btn-success btn-xs" style="padding-bottom: 0px;padding-top: 0px;" >Closed</button>

                        <?php } ?>
                        </div>
                        </td>
                        <div class="modal fade" id="closed_status<?php echo $srnum; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                          <div class="modal-dialog" role="document" style="margin-top: 5%;">

                            <div class="modal-content" style="border-radius: 5px;">

                              <div class="modal-header">

                                <div class="row">
                                  <input type="hidden" id="itmOnQp1">
                                  <div class="col-md-12">
                                    <h5 class="modal-title modltitletext" id="exampleModalLabel">Close Task</h5>
                                  </div>

                                </div>

                              </div>
                              <form id="closedtasktrans<?php echo $srnum; ?>">
                                <div class="modal-body table-responsive">
                                
                                  <div class="row">  
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>  Closed: <span class="required-field"></span></label>

                                        <div class="input-group">
                                          <input type="hidden" name="taskTranId" id="taskTranId<?php echo $srnum; ?>">
                                          <input type="radio" class="optionsRadios1" name="closedTask" value="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          <input type="radio" class="optionsRadios1" name="closedTask" value="1" checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                        </div> 

                                      </div>
                                      <!-- /.form-group -->
                                    </div>

                                    <div class="col-md-6">
                                    </div>

                                  </div>
                                </div>
                              </form>

                              <div class="modal-footer" style="text-align: center;">
                               
                                <button type="button" class="btn btn-primary" onclick="saveClosedTask(<?php echo $srnum; ?>);">

                                  <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  Save
                                   </button>
                              
                              </div>
                              
                            </div>

                          </div>

                        </div>
                      </tr>
                    <?php $srnum++;} ?>
                  </table>
                
                   <button type="button" class="btn btn-primary btn-xs" id="add_task" data-toggle="modal" data-target="#AddTask" style="padding-bottom: 0px;padding-top: 0px;">Add More</button>

                </div><!-- /.tab-pane -->
              </div><!-- /.tab-content -->
            </div>

            <!-- <a href="#" onclick="Alert.success('Success! This alert box indicates a successful or positive action. ','Success',{displayDuration: 5000, pos: 'top'})">Success Alert</a> -->
          </section>
          
        </div>
        
      </section>
      <div class="modal fade" id="AddTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document" style="margin-top: 5%;">

          <div class="modal-content" style="border-radius: 5px;">

            <div class="modal-header">

              <div class="row">
                <input type="hidden" id="itmOnQp1">
                <div class="col-md-12">
                  <h5 class="modal-title modltitletext" id="exampleModalLabel">Assign Task</h5>
                </div>

              </div>

            </div>
            <form id="tasktrans">
            <div class="modal-body table-responsive">
              
              <div class="row">  
                <div class="col-md-6">
                  <div class="form-group">
                    <label> Vr Date: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                      <?php $CurrentDate =date("d-m-Y"); ?>
                      <input type="text"  id="vr_date" name="vr_date" class="form-control  pull-left" value="{{ $CurrentDate }}" placeholder="Enter Vr Date" readonly>

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>
                    <small>
                      <div class="pull-left showSeletedName" id="makeText"></div>
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label> From User Code: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                      <input type="text"  id="from_user_Code" name="from_user_Code" class="form-control  pull-left" value="{{ Session::get('userid') }}" placeholder="Enter From User Code" readonly>

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('from_user_Code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>
                    <small>
                      <div class="pull-left showSeletedName" id="makeText"></div>
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>

              </div>

              <div class="row">
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label> To User Code: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                      <input list="userList"  id="to_user_Code" name="to_user_Code" class="form-control  pull-left" value="" placeholder="Enter To User Code">
                      <datalist id="userList">

                        <option  value="">-- Select --</option>
                          @foreach($user_list as $key)

                            <option value='<?php echo $key->USER_CODE?>'   data-xyz ="<?php echo $key->USER_NAME; ?>" ><?php echo $key->USER_NAME ; echo " [".$key->USER_CODE."]" ; ?></option>

                          @endforeach

                      </datalist>
                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('to_user_Code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>
                    <small>
                      <div class="pull-left showSeletedName" id="toUserName"></div>
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>

                <div class="col-md-4">

                  <div class="form-group">
                    <label> Task Code: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                      <input list="taskList1"  id="task_code" name="task_code" class="form-control  pull-left" value="" placeholder="Enter Task Code" autocomplete="off">
                      <datalist id="taskList1">

                        <option  value="">-- Select --</option>
                          @foreach($task_list as $key)
                            
                            <option value='<?php echo $key->TASK_CODE?>'   data-xyz ="<?php echo $key->TASK_NAME; ?>" ><?php echo $key->TASK_NAME ; echo " [".$key->TASK_CODE."]" ; ?></option>

                          @endforeach

                      </datalist>
                    </div> 
                    <input type="hidden" value="" name="taskName" id="taskName">
                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('task_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>
                    <small>
                      <div class="pull-left showSeletedName" id="taskText"></div>
                    </small>

                  </div>

                  
                  <!-- /.form-group -->
                </div>

                <div class="col-md-4">
                <div class="form-group">
                  <label> Target Date: <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                    <input type="text"  id="target_date" name="target_date" class="form-control  pull-left transdatepicker" value="{{ old('target_date') }}" placeholder="Enter Target Date">

                  </div> 

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('target_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>
                  <small>
                    <div class="pull-left showSeletedName" id="makeText"></div>
                  </small>

                </div>
                <!-- /.form-group -->
              </div>

              </div>

            <div class="row">
              
              <div class="col-md-12">
                <div class="form-group">
                  <label> Description: <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                    <textarea type="text"  id="description" name="description" class="form-control  pull-left" value="{{ old('description') }}" placeholder="Enter Description"></textarea>

                  </div> 

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('description', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>
                  <small>
                    <div class="pull-left showSeletedName" id="makeText"></div>
                  </small>

                </div>
                <!-- /.form-group -->
              </div>
            </div>
          </div>
        </form>

            <div class="modal-footer" style="text-align: center;">
             
              <button type="button" class="btn btn-primary" onclick="saveTaskAssign();">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  Save
                 </button>
            
            </div>
            
          </div>

        </div>

      </div>
        <!-- <section class="content">


        <div class="row"> 
          <div class="col-lg-12">

            <a href="{{ url('/Dashboard/Top-Sales') }}">
              <div class="col-lg-3 col-xs-3">
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3>Top 10</h3>
                    <p style="font-size: 16px;font-weight: 700;">Sale Party</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-user"></i>
                  </div>
                  <div class="small-box-footer">
                    <i class="fa fa-arrow-circle-right"></i>
                  </div>
                </div>
              </div>
            </a>
             
            <a href="{{ url('/Dashboard/Top-Item') }}">
              <div class="col-lg-3 col-xs-3">
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>Top 10</h3>
                    <p style="font-size: 16px;font-weight: 700;">Sale Item</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-pie-chart"></i>
                  </div>
                    <div class="small-box-footer">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                </div>
              </div>
            </a>

            <a href="{{ url('/Dashboard/Top-debitors') }}">
              <div class="col-lg-3 col-xs-3">
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>Top 10</h3>
                    <p style="font-size: 16px;font-weight: 700;">Debitors Due's</p>
                  </div>
                  <div class="icon">
                   <i class="fa fa-user-plus"></i>
                  </div>
                  <div class="small-box-footer">
                    <i class="fa fa-arrow-circle-right"></i>
                  </div>
                </div>
              </div>
            </a>

            <a href="{{ url('/Dashboard/Top-creditor') }}">
              <div class="col-lg-3 col-xs-3">
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3>Top 10</h3>
                    <p style="font-size: 16px;font-weight: 700;">Creditors Due's</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-user-plus"></i>
                  </div>
                  <div class="small-box-footer">
                    <i class="fa fa-arrow-circle-right"></i>
                  </div>
                </div>
              </div>
            </a>
            
          </div>
        </div>  

        <div class="clearfix visible-sm-block"></div>

        <div class="row"> 

          <div class="col-lg-12">

            <a href="{{ url('Dashboard/Open-Order') }}">
              <div class="col-lg-3 col-xs-3">
               
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3 style="font-size: 26px;">Top 10</h3>
                    <p style="font-size: 16px;font-weight: 700;">Pending Order</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-bars"></i>
                  </div>
                  <div class="small-box-footer">
                    <i class="fa fa-arrow-circle-right"></i>
                  </div>
                </div>
              </div>
            </a>

            <a href="{{ url('Dashboard/Age-Analysis') }}">
              <div class="col-lg-3 col-xs-3">
               
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3 style="font-size: 28px !important;">Party Wise</h3>
                    <p style="font-size: 18px;font-weight: 600;">Age Analysis</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-bar-chart"></i>
                  </div>
                  <div class="small-box-footer">
                    <i class="fa fa-arrow-circle-right"></i>
                  </div>
                </div>
              </div>
            </a>
            
          </div>

        </div> 

      </section> -->
      
    </div><!-- /.row -->




 <!-- =========== End : demo page ============= -->

@include('admin.include.footer')

<script>

  function clicklink(srno,pagelink){

    window.location.href =pagelink;
  }

  function getUniqId(uniqId,sr_no){

    $('#taskId'+sr_no).val(uniqId);

    $('#errorMsg'+sr_no).html('');

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

              url:"{{ url('fetch-all-task-of-user') }}",
              method : "POST",
              type: "JSON",
              data: {uniqId: uniqId},
              success:function(data){
                  var data1 = JSON.parse(data);
                  if (data1.response == 'error') {
                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                  }else if(data1.response == 'success'){
                    $('#allTaskGet'+sr_no).empty(); 
                    $('#allOpenTask'+sr_no).empty(); 
                    $.each(data1.task_data, function(k, getData) {
                      var dateForm =getData.VRDATE;
                      var slipdate = dateForm.split('-');
                      var taskDate = slipdate[2]+'-'+slipdate[1]+'-'+slipdate[0];
                      var loginUser = $('#LoginUser').val();
                      var taskUser = getData.USER_CODE;
                      if(loginUser == taskUser){
                        var add_Class = '';
                      }else{
                        var add_Class ='color:red';
                      }
                      var tbodyData = '<tr><td><div class="setmargin">'+taskDate+'</div></td><td><div class="setmargin">'+getData.REMARK+'</div></td><td style='+add_Class+'><div class="setmargin">'+getData.USER_NAME+'</div></td></tr>';
                      $('#allTaskGet'+sr_no).append(tbodyData);
                    });

                    $.each(data1.task_data, function(k, getData) {
                      var dateFormopn =getData.VRDATE;
                      var slipdateopn = dateFormopn.split('-');
                      var taskDateopn = slipdateopn[2]+'-'+slipdateopn[1]+'-'+slipdateopn[0];
                      var loginUseropn = $('#LoginUser').val();
                      var taskUseropn = getData.USER_CODE;
                      if(loginUseropn == taskUseropn){
                        var add_Classopn = '';
                      }else{
                        var add_Classopn ='color:red';
                      }

                      var tbodyDataopn = '<tr><td><div class="setmargin">'+taskDateopn+'</div></td><td><div class="setmargin">'+getData.REMARK+'</div></td><td style='+add_Classopn+'><div class="setmargin">'+getData.USER_NAME+'</div></td></tr>';
                      $('#allOpenTask'+sr_no).append(tbodyDataopn);
                    });
                  }
              }
      });

  }

  /*function OpenAllTaskStatus(taskId,){

  }*/

  function getclosedTask(taskTrnId,sr_no){
    $('#taskTranId'+sr_no).val(taskTrnId);
  }

  function dleteuserTCode(rowId,srNo){
      console.log(rowId);
      $('#usertcodeDelete'+srNo).modal('show');
     $('#usertcodeId'+srNo).val(rowId);

  }

  function addCloseDate(srnum){
      var getDate   = new Date();
      var get_date  = getDate.getDate();
      var get_month = getDate.getMonth() + 1;
      var get_year  = getDate.getFullYear();
      var closeDate = get_date+'-'+get_month+'-'+get_year;
      
      var closeRemark = $('#close_remark'+srnum).val();
      if(closeRemark){
        $('#closeDate'+srnum).val(closeDate);
      }else{
        $('#closeDate'+srnum).val('');
      }
  }

  function saveTaskAssign(){
    var data = $("#tasktrans").serialize();

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $.ajax({

            type: 'POST',

            url: "{{ url('/assign-task-to-user') }}",

            data: data, // here $(this) refers to the ajax object not form

            success: function (data) {

             // console.log('data',data);
              //  console.log('data',data);
               window.location.href = "{{ url('dashboard') }}";
              },

    });
  }


  function updataskSatus(srNum){

    var remarkUP = $('#remarkUP'+srNum).val();
    var close_remark = $('#close_remark'+srNum).val();
    
    console.log('remarkUP',remarkUP);
    console.log('close_remark',close_remark);

    if (remarkUP=='' || close_remark=='') {

      $('#errorMsg'+srNum).html('<span style="font-size:11px;font-weight:600;color:red;">*Please fill at least one of the above fields..!</span>');

    }else{

      $('#saveBtn'+srNum).prop('disabled',false);

      var data = $("#update_task_status"+srNum).serialize();

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $.ajax({

              type: 'POST',

              url: "{{ url('/update-task-status-of-user') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

               // console.log('data',data);
                //  console.log('data',data);
                 window.location.href = "{{ url('dashboard') }}";

                 //$('#AplyIconBT'+srNum).html('<i class="fa fa-check-circle" aria-hidden="true" style="color: green;font-size: 21px;margin-left: 3px;"></i>');
                },

      });

    }
  }

  function saveClosedTask(srNum){
    var data = $("#closedtasktrans"+srNum).serialize();

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $.ajax({

            type: 'POST',

            url: "{{ url('/save-closed-task-trans') }}",

            data: data, // here $(this) refers to the ajax object not form

            success: function (data) {

             // console.log('data',data);
              //  console.log('data',data);
               window.location.href = "{{ url('dashboard') }}";

               //$('#AplyIconBT'+srNum).html('<i class="fa fa-check-circle" aria-hidden="true" style="color: green;font-size: 21px;margin-left: 3px;"></i>');
              },

    });
  }

  function saveopenTask(srNum){
    var data = $("#opentasktrans"+srNum).serialize();

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $.ajax({

            type: 'POST',

            url: "{{ url('/save-reply-of-fromuser-for-touser') }}",

            data: data, // here $(this) refers to the ajax object not form

            success: function (data) {

             // console.log('data',data);
              //  console.log('data',data);
               window.location.href = "{{ url('dashboard') }}";

               //$('#AplyIconBT'+srNum).html('<i class="fa fa-check-circle" aria-hidden="true" style="color: green;font-size: 21px;margin-left: 3px;"></i>');
              },

    });
  }


  $(document).ready(function(){
    $('.transdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true'

    });

    $('#target_date').on('change',function(){
      var targetDate = $('#target_date').val();
      var vr_date = $('#vr_date').val();

      if(targetDate < vr_date){
        $('#target_date').val('');
      }else{
       
      }
     
    });

    $("#task_code").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#taskList1 option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
      if(msg=='No Match'){

         $(this).val('');
         $('#taskText').html('');
         $('#taskName').val('');

      }else{
        $('#taskText').html(msg);
        $('#taskName').val(msg);
      }

    });

    $("#to_user_Code").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#userList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
      if(msg=='No Match'){

         $(this).val('');
         $('#to_user_Code').val('');
         $('#toUserName').html('');

      }else{
        $('#toUserName').html(msg);
      }

    });
  });
</script>

<script>
  var Alert = undefined;

(function(Alert) {
  var alert, error, trash, info, success, warning, _container;
  info = function(message, title, options) {
    return alert("info", message, title, "fa fa-info-circle", options);
  };
  warning = function(message, title, options) {
    return alert("warning", message, title, "fa fa-warning", options);
  };
  error = function(message, title, options) {
    return alert("error", message, title, "fa fa-exclamation-circle", options);
  };

  trash = function(message, title, options) {
    return alert("trash", message, title, "fa fa-trash-o", options);
  };

  success = function(message, title, options) {
    return alert("success", message, title, "fa fa-check-circle", options);
  };
  alert = function(type, message, title, icon, options) {
    var alertElem, messageElem, titleElem, iconElem, innerElem, _container;
    if (typeof options === "undefined") {
      options = {};
    }
    options = $.extend({}, Alert.defaults, options);
    if (!_container) {
      _container = $("#alerts");
      if (_container.length === 0) {
        _container = $("<ul>").attr("id", "alerts").appendTo($("body"));
      }
    }
    if (options.width) {
      _container.css({
        width: options.width
      });
    }
    alertElem = $("<li>").addClass("alert").addClass("alert-" + type);
    setTimeout(function() {
      alertElem.addClass('open');
    }, 1);
    if (icon) {
      iconElem = $("<i>").addClass(icon);
      alertElem.append(iconElem);
    }
    innerElem = $("<div>").addClass("alert-block");
    //innerElem = $("<i>").addClass("fa fa-times");
    alertElem.append(innerElem);
    if (title) {
      titleElem = $("<div>").addClass("alert-title").append(title);
      innerElem.append(titleElem);
      
    }
    if (message) {
      messageElem = $("<div>").addClass("alert-message").append(message);
      //innerElem.append("<i class="fa fa-times"></i>");
      innerElem.append(messageElem);
      //innerElem.append("<em>Click to Dismiss</em>");
//      innerElemc = $("<i>").addClass("fa fa-times");

    }
    if (options.displayDuration > 0) {
      setTimeout((function() {
        leave();
      }), options.displayDuration);
    } else {
      innerElem.append("<em>Click to Dismiss</em>");
    }
    alertElem.on("click", function() {
      leave();
    });

    function leave() {
      alertElem.removeClass('open');
      alertElem.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function() {
        return alertElem.remove();
      });
    }
    return _container.prepend(alertElem);
  };
  Alert.defaults = {
    width: "",
    icon: "",
    displayDuration: 5000,
    pos: ""
  };
  Alert.info = info;
  Alert.warning = warning;
  Alert.error = error;
  Alert.trash = trash;
  Alert.success = success;
  return _container = void 0;

})(Alert || (Alert = {}));

this.Alert = Alert;

$('#test').on('click', function() {
  Alert.info('Message');
});
</script> 
@endsection