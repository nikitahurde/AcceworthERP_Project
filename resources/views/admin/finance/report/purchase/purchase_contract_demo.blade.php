@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')


<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')
<style type="text/css">

    .tooltip{f
      color: #66CCFF !important;
    }

  .PageTitle{
    margin-right: 1px !important;
  }

  .required-field::before {
    content: "*";
    color: red;
  }

  

  .secondSection{

    display: none;
  }

  .rightcontent{

  text-align:right;


}
.hidebtn{
display: none;
}

::placeholder {
  
  text-align:left;
}
  @media screen and (max-width: 600px) {

  .PageTitle{

    float: left;

  }

}

.showSeletedName{
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
}

.btn {

    display: inline-block;
    font-weight: 400;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding: .375rem .75rem;
    font-size: 14px;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.btn-success {

    color: #fff;
    background-color: #28a745;
    border-color: #28a745;

}

.btn-info {

    color: #fff;
    background-color: #04a9ff;
    border-color: #04a9ff;

}


.text-center{

  text-align: center;

}


.title{

    margin-top: 50px;
    margin-bottom: 20px;

}




.container{

    max-width: 1200px;
    margin: 0px auto;
    padding: 0px 15px;

}

.inputboxclr{

  border: 1px solid #d7d3d3;
}

.tdthtablebordr{
  border: 1px solid #00BB64;
}

input:focus{border:1px solid yellow;} 

.space{margin-bottom: 2px;}

.but{

    width:105px;
    background:#00BB64;
    border:1px solid #00BB64;
    height:40px;
    border-radius:3px;
    color:white;
    margin-top:10px;
    margin:0px 0px 0px 11px;
    font-size: 14px;

}



.ref::before {

  color: navy;
  content: "Ch :";
}

.toalvaldesn{

    text-align: right;
    font-weight: 800;
    margin-top: 1%;
}

.credittotldesn{

    width: 277%;
    margin-left: -11%;
    text-align: end;
}

.debitcreditbox{

  width: 91px;
  text-align: end;
}

.tdsratebtn{
  margin-top: 24% !important;
  font-weight: 800 !important;
  font-size: 11px !important;

}
.viewbtnitem{
    padding-bottom: 0px;
    padding-top: 0px;
    font-size: 12px;
    margin-bottom: 4px;
}
.modltitletext{
  font-weight: 800;
  color: #5696bb;
  text-align: center;
  font-size: 16px;
}
.SetInCenter{

  margin-top: 18%;

}
.AddM{

  width: 24px;

}
.showdetail{
  display: none;

}
.showcodename{
  color: #5696bb;
    font-size: 13px;
    font-weight: 600;
}
.aplynotStatus{
  display: none;
}

.panel.with-nav-tabs .panel-heading{
    padding: 5px 5px 0 5px;
}
.panel.with-nav-tabs .nav-tabs{
  border-bottom: none;
}
.panel.with-nav-tabs .nav-justified{
  margin-bottom: -1px;
}

.with-nav-tabs.panel-info .nav-tabs > li > a,
.with-nav-tabs.panel-info .nav-tabs > li > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li > a:focus {
  color: #31708f;
}
.with-nav-tabs.panel-info .nav-tabs > .open > a,
.with-nav-tabs.panel-info .nav-tabs > .open > a:hover,
.with-nav-tabs.panel-info .nav-tabs > .open > a:focus,
.with-nav-tabs.panel-info .nav-tabs > li > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li > a:focus {
  color: #31708f;
  background-color: #bce8f1;
  border-color: transparent;
}
.with-nav-tabs.panel-info .nav-tabs > li.active > a,
.with-nav-tabs.panel-info .nav-tabs > li.active > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li.active > a:focus {
  color: #31708f;
  background-color: #fff;
  border-color: #bce8f1;
  border-bottom-color: transparent;
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu {
    background-color: #d9edf7;
    border-color: #bce8f1;
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a {
    color: #31708f;   
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
    background-color: #bce8f1;
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a,
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
    color: #fff;
    background-color: #31708f;
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
.boxer .hidebordritm {
  display: table-cell;
  vertical-align: top;
  border: none;
  padding: 5px;
}
.center {
  text-align:center;
}
.right {
  float:right;
}
.texIndbox{
  width: 25%; 
  text-align: center;
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
  text-align: center;
}
.rateBox{
  width: 20%;
  text-align: center;
}
.amountBox{
  width: 20%;
  text-align: center;
}
.inputtaxInd{
  background-color: white !important;
  border: none;
  text-align: center;
}
@media screen and (max-width: 600px) {

  .credittotldesn{

    width: 89px;
    margin-bottom: 5px;
    margin-left: -34%;
  }

  .totlsetinres{

    width: 130%;

  }

  .debitcreditbox{

    margin-top: 0%;

  }

  .rowClass{
    overflow-x: scroll;
  }

}

</style>


<style type="text/css">



  .Custom-Box {

    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  .OperatorTd{
    width: 35px !important;
  }
  .ValuesTd{
    width: 50% !important;
  }

  .QueryTableTd{
    font-size: 14px !important;
    font-weight: 600 !important;
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

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

 }
 .rightcontent{

  text-align:right;


}

.modal-header .close {
    margin-top: -25px !important;
    margin-right: 2% !important;
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

</style>


<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Purchase Contract Report
            <small> : Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li><a href="{{ url('/dashboard') }}">Purchase</a></li>

            <li class="active"><a href="{{ url('/report/purchase/purchase-contract-report') }}">Purchase Contract Rep.</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">


              <?php
                  echo "<b>Result :</b><br>";
                  foreach ($GetData as $key) {
                    echo "<pre>";
                    print_r($key);
                  }
              ?>
            </div>
      </div>
  </section>

</div>


</div>

@include('admin.include.footer')



 

@endsection