<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!------ favicon start ---------->


    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('public/dist/img/ErpIcon.png') }}">


    <!------ favicon start ---------->

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ URL::asset('public/dist/img/ErpIcon.png') }}">
    <meta name="theme-color" content="#ffffff">

    <title>Dashboard | {{ $title ?? 'title' }}</title>

    <!-- Tell the browser to be responsive to screen width -->

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.5 -->

    <link rel="stylesheet" href="{{ URL::asset('public/bootstrap/css/bootstrap.min.css') }}">


    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" /> -->



    <!-- DataTables -->

    <link rel="stylesheet" href="{{ URL::asset('public/plugins/datatables/dataTables.bootstrap.css') }}">



    <!-- Font Awesome -->

    <link rel="stylesheet" href="{{ URL::asset('public/dist/font-awesome/css/font-awesome.min.css') }}">


    <!-- Ionicons -->
   

    <link rel="stylesheet" href="{{ URL::asset('public/dist/css/ionicons.min.css') }}">

    <!-- jvectormap -->

    <link rel="stylesheet" href="{{ URL::asset('public/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">

    <!-- Theme style -->

    <link rel="stylesheet" href="{{ URL::asset('public/dist/css/AdminLTE.min.css') }}">

    <!-- AdminLTE Skins. Choose a skin from the css/skins

         folder instead of downloading all of them to reduce the load. -->

    <link rel="stylesheet" href="{{ URL::asset('public/dist/css/skins/_all-skins.min.css') }}">



    <!-- Select2 -->

    <link rel="stylesheet" href="{{ URL::asset('public/plugins/select2/select2.min.css') }}">



    <!-- <link rel="stylesheet" href="{{ URL::asset('public/dist/css/animate.css') }}"> -->

    <!-- <link rel="stylesheet" href="{{ URL::asset('public/dist/css/notifIt.min.css') }}"> -->
    
    <link rel="stylesheet" href="{{ URL::asset('public/dist/css/notifIt.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/dist/css/bootstrap-datepicker.min.css') }}">


  <!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
    
  <link rel="stylesheet" href="{{ URL::asset('public/dist/css/bootstrap-multiselect.css') }}" />

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/dist/css/bootstrap-datepicker.min.css') }}">

  <link rel="stylesheet" href="{{ URL::asset('public/dist/css/jquery-ui.css') }}">

  <link rel="stylesheet" href="{{ URL::asset('public/dist/css/bootstrap-multiselect.css') }}" />

  <link rel="stylesheet" href="{{ URL::asset('public/dist/css/bootstrap-datetimepicker.css') }}" />

   <link rel="stylesheet" href="{{ URL::asset('public/dist/css/example-styles.css') }}">

  </head>
<style>

  body{
    line-height: 6px;
  }

  label {
      display: inline-block !important;
      max-width: 100% !important;
      margin-bottom: 5px !important;
      font-weight: 700 !important;
      font-size: 12px !important;
  }

  .skin-blue .content-header {
      background: transparent !important;
      margin-top: 2% !important; 
  }

  .small-box .icon {
      -webkit-transition: all .3s linear !important;
      -o-transition: all .3s linear !important;
      transition: all .3s linear !important;
      position: absolute !important;
      top: -10px !important;
      right: 10px !important;
      z-index: 0 !important;
      font-size: 90px !important;
      color: rgba(0,0,0,0.15) !important;
      line-height: 117px !important;
  }

  .content-header h1{

    margin-top:2%;

  }

  .content-header .breadcrumb{

    margin-top:2%;

  }

.main-header .sidebar-toggle {
    float: left !important;
    background-color: transparent !important;
    background-image: none !important;
    padding: 22px 15px !important;
    font-family: fontAwesome !important;
}

.tooltips {
  position: relative;
}
.tooltiphide{
  display: none;
}

.form-control {

  border: 1px solid #d4d4d4;

  border-radius: 4px;

  font-size: 13px;

  height: 30px;

}

input::file-selector-button {
    font-size:12px !important;
    font-weight: 600 !important;
    border: thin solid grey !important;
    border-radius: 3px !important;
    color: #fff !important;
    background-color: #28a745 !important;
    border-color: #28a745 !important;
    cursor: pointer !important;
}

.tooltips .tooltiptext {
  visibility: hidden;
  width: 210px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 6;
  bottom: 120%;
  left: 28%;
  margin-left: -60px;
}

.tooltips .tooltiptextitem {
  visibility: hidden;
  width: 210px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 26;
  bottom: 86%;
  left: 28%;
  margin-left: -60px;
}

.tooltips .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: black transparent transparent transparent;
}

.tooltips:hover .tooltiptext {
  visibility: visible;
}
.Custom-Box {
  box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
}
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #c2d9ff;
}
thead th {
  height: 42px;
  background-color: #b8daff;
}
 
.datepicker table tr td.day.focused, .datepicker table tr td.day:hover {
    background: #04c !important;
    cursor: pointer;
}

.tooltips .tooltiptextitem::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: black transparent transparent transparent;
}

.tooltips:hover .tooltiptextitem {
  visibility: visible;
}

.tooltips .tooltipcoderef {
    visibility: hidden; 
    width: 117px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 26;
    bottom: 86%;
    left: 10%;
    margin-left: -60px;
}

.tooltips .tooltipcoderef::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: black transparent transparent transparent;
}

.tooltips:hover .tooltipcoderef {
  visibility: visible;
}

.Custom-Box {
  box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
}

.setPagename{
    position: fixed;
    background-color: #3c8dbc;
    color: #ffffff;
    width: 265px;
    margin-top: 50px;
    z-index: 1;
    font-size: 19px;
    font-weight: 600;
    text-align: center;
    height: 36px;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;

}
.showhidepageTtitle{
  display: none;
}

.buttons-pdf{
    background-color: #3c8dbc !important;
    border-color: #367fa9 !important;
    color: white !important;
}

.buttons-pdf:hover, .buttons-pdf:active, .buttons-pdf.hover {
  background-color: #367fa9 !important;
}
.input-group-addon {
    padding: 2px 12px !important;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.form-control {
    border: 1px solid #d4d4d4;
    border-radius: 4px;
    font-size: 12px;
    height: 22px;
    font-weight: 600;
    padding: 3px 12px;
}
.form-group {
    margin-bottom: 11px;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 0px;
    line-height: 1.5;
    border: 1px solid #d7d7d7;
    border-top: 1px solid #d7d7d7 !important;
    border-right: 1px solid #d7d7d7 !important;
    font-size: 12px;
    padding-left: 5px;
    padding-right: 5px;
    vertical-align: middle;
    color:black;
  }
  table.dataTable thead > tr > th {
      padding-right: 30px;
      vertical-align: middle;
  }
  .table>tfoot>tr>td, .table>tfoot>tr>th{
    padding: 9px;
    line-height: 0;
    border: 1px solid #d7d7d7;
    border-top: 1px solid #d7d7d7 !important;
    border-right: 1px solid #d7d7d7 !important;
    font-size: 12px;
    padding-left: 5px;
    padding-right: 5px;
    vertical-align: middle;
  }
  .table>tbody>tr>td.dataTables_empty{
    padding: 10px !important;
  }
  .chieldtblecls>tbody>tr>th{
    line-height: 1;
  }
  .chieldtblecls>tbody>tr>td{
    line-height: 0.5;
  }
  small{
    line-height:1;
  }
  .btn {
    display: inline-block;
    padding: 0px 4px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.5;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
  }
  #login{
    font-size:10px !important;
    width:22px;
  }

  .modal-header .close {
    margin-top: -32px;
 }

 .modal-footer .btn-danger{
    margin-top: -12% !important;
 }
 /*.deleteMsg::before {
  content: '\f0b0';
 }*/
 /*.modal-body .deleteMsg::before {
  content: '\f008';
  font: var(--fa-font-regular);
}*/


  /*.btn-danger{
    margin-top: -12%;
  }
  .close{
    margin-top: -32px;
  }*/
@media only screen and (max-width: 600px) {

  .content-header h1{

    margin-top:6%;

  }

}

 @media only screen and (max-width: 600px) {

  .skin-blue .content-header {
      background: transparent !important;
      margin-top: 4% !important; 
  }

}

@media only screen and (min-width: 481px) and (max-width: 768px){
  .skin-blue .content-header {
      background: transparent !important;
      margin-top: 5% !important; 
  }
}

@media only screen, (max-width: 1024px){
     
    .skin-blue .content-header {
        background: transparent !important;
        margin-top: 1% !important; 
    }
}


@media only screen and (max-width: 1366px){
    .skin-blue .content-header {
        background: transparent !important;
        margin-top: 2% !important; 
    }
}


@media (max-width: 767px){
    .main-sidebar, .left-side {
        padding-top: 47px !important;
    }
}

@media (max-width: 767px){
    .main-sidebar, .left-side {
        padding-top: 47px !important;
    }
}

/* ~~~~~~ Start : Data Table Buttons ~~~~~~ */

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

/* ~~~~~~ End : Data Table Buttons ~~~~~~ */
</style>
  <!-- <body class="hold-transition skin-blue sidebar-mini" oncontextmenu="return false;"> -->

  <body class="hold-transition skin-blue sidebar-mini">


    <div class="wrapper">

      <div class="row" style="margin-top: -1px;">
        <div class="col-md-5">
       
        </div>
        <div class="col-md-7">
          <div class="setPagename showhidepageTtitle" id="getPageNameOnScrol"></div>
        </div>
      </div>
      <div id="allEnqShow" class="modal fade" tabindex="-1">

        <div class="modal-dialog modal-md" style="margin-top: 13%;">

            <div class="modal-content" style="border-radius: 5px;">

                <div class="modal-header">

                  <div class="row">

                      <div class="col-md-12" style="text-align: center;">

                        <h5 class="modal-title modltitletext" id="exampleModalLabel">Item Details</h5>

                      </div>

                  </div>

                </div>

              <form id="salesenqtrans">
                   @csrf
                    <div class="modal-body table-responsive">
                        <div class="boxer" id="itemListShow">

                        </div>

                    </div>
                  

                  <div class="modal-footer" style="text-align: center;" id="footer_item">

                  </div>

              </form>

            </div>

        </div>

  </div>


<?php 

    date_default_timezone_set('Asia/Kolkata');

    $getCurrDtTim = date('Y-m-d H:i:s');
   
    $getExp = explode(" ",$getCurrDtTim);

    $secExp = explode("-",$getExp[0]);

    $expTime = explode(":",$getExp[1]);

    $getnewDt = $secExp[0].''.$secExp[1].''.$secExp[2].'_'.$expTime[0].''.$expTime[1].''.$expTime[2];

  ?>

  <input type="hidden" id="headerexcelDt" value="{{$getnewDt}}">