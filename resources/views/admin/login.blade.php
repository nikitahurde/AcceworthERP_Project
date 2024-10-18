

<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=3.0, minimum-scale=0.86">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!------ favicon start ---------->


  <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('public/dist/img/ErpIcon.png') }}">


  <!------ favicon start ---------->

  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{ URL::asset('public/dist/img/ErpIcon.png') }}">
  <meta name="theme-color" content="#ffffff">


  <title>LOGIN - ERP</title>



  <link href="{{ URL::asset('public/dist/css/bootswatch/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">

  <script src="{{ URL::asset('public/dist/css/bootstrap.min.js') }}"></script>

  <script src="{{ URL::asset('public/dist/css/jquery.min.js') }}"></script>

<link rel="stylesheet" href="{{ URL::asset('public/dist/css/notifIt.css') }}">
 <!-- Font Awesome -->

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->

   <link rel="stylesheet" href="{{ URL::asset('public/dist/font-awesome/css/font-awesome.min.css') }}">

    <!-- Ionicons -->

  <link rel="stylesheet" href="{{ URL::asset('public/dist/css/animate.css') }}">



  <!------ Include the above in your HEAD tag ---------->



    <link href="{{ URL::asset('public/dist/css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">

    <script src="{{ URL::asset('public/dist/css/bootstrap.min.js') }}"></script>

    <script src="{{ URL::asset('public/dist/css/jquery.min.js') }}"></script>

  <!------ Include the above in your HEAD tag ---------->

  



</head>

<style>
  .login-reg-panel{
    top: 43%;
    text-align:center;
    width:17%;
    right:0;left:0;
    margin:auto;
    height:250px;
    margin-right: 68%;
}
.white-panel{
    background-image: linear-gradient(to right, #0093dd , #fafcff) !important;
    height:310px;
    width:420%;
    right:calc(60% - 60px);
    transition:.3s ease-in-out;
    z-index:0;
    box-shadow: 0 0 10px 9px #00000096;
    margin-top: 140%;
    border-radius: 10px;
}
.login-reg-panel input[type="radio"]{
    position:relative;
    display:none;
}
.login-reg-panel{
    color:#B8B8B8;
}
.login-reg-panel #label-login, 
.login-reg-panel #label-register{
    border:1px solid #abdcf5;
    padding:5px 5px;
    width:150px;
    display:block;
    text-align:center;
    border-radius:6px;
    cursor:pointer;
    font-weight: 600;
    font-size: 18px;
    background-image: linear-gradient(to left, #0093dd , #fafcff) !important;
}
.proceedBtn{
  margin-left: 17% !important;
  font-family: 'Times New Roman', serif;
  margin-top: 12%;
}
.logInBtn{
  font-family: 'Times New Roman', serif;
  margin-top: 4%;
}
.login-info-box{
    width:30%;
    padding:0 50px;
    top:20%;
    left:0;
    position:absolute;
    text-align:left;
}
.register-info-box{
    width:30%;
    padding:0 50px;
    top:20%;
    right:0;
    position:absolute;
    text-align:left;
    
}
.right-log{right:50px !important;}

.login-show, 
.register-show{
    z-index: 1;
    display:none;
    opacity:0;
    transition:0.3s ease-in-out;
    color:#242424;
    text-align:left;
    padding:46px;
}
.show-log-panel{
    display:block;
    opacity:0.9;
}
input{
  font-size: 14px !important;
}

.login-show input[type="button"] {
    max-width: 150px;
    width: 100%;
    background: #444444;
    color: #f9f9f9;
    border: none;
    padding: 10px;
    text-transform: uppercase;
    border-radius: 2px;
    float:right;
    cursor:pointer;
}
.login-show a{
    display:inline-block;
    padding:10px 0;
}


.register-show input[type="button"] {
    max-width: 150px;
    width: 100%;
    background: #444444;
    color: #f9f9f9;
    border: none;
    padding: 10px;
    text-transform: uppercase;
    border-radius: 2px;
    float:right;
    cursor:pointer;
}
.credit {
    position:absolute;
    bottom:10px;
    left:10px;
    color: #3B3B25;
    margin: 0;
    padding: 0;
    font-family: Arial,sans-serif;
    text-transform: uppercase;
    font-size: 12px;
    font-weight: bold;
    letter-spacing: 1px;
    z-index: 99;
}

.input-group-text {
    display: -ms-flexbox !important;
    display: flex !important;
    -ms-flex-align: center !important;
    align-items: center !important;
    padding: 0.375rem 0.75rem !important;
    margin-bottom: 0 !important;
    font-size: 1rem !important;
    font-weight: 200 !important;
    line-height: 0.5 !important;
    color: #495057 !important;
    text-align: center !important;
    white-space: nowrap !important;
    background-color: #fdc25b !important;
    border: 1px solid #ced4da !important;
    border-radius: 0.25rem !important;
}
.form-group {
    margin-bottom: 10px !important;
}
.classUserPassCheck{
  display: none;
}
.alert-danger-new {
  color: #721c24;
  background-color: #ffe1a6;
  border-color: #ffd999;
  width: 107%;
}
.closeBtn{
  margin-top: -2%;
}
.brand_logo_container {
    position: absolute;
    height: 146px;
    width: 146px;
    top: -50px;
    border-radius: 141%;
    background: linear-gradient(to top, #f1f7fc , #fafcff) !important;
    padding: -5px;
    text-align: center;
    margin-top: 24%;
}
.brand_logo {
    height: 144px;
    width: 141px;
    border-radius: 60%;
}

.aceworth_img{

  width: 119%;
  height: 108%;
  margin-left: -1%;
  margin-top: -9%;

}


  body#LoginForm {
    background: url(public/dist/img/curveBackground.png) !important;
    -webkit-background-size: cover !important;
    -moz-background-size: cover !important;
    -o-background-size: cover !important;
    background-size: cover !important;  
  }
  /*body {
    overflow: hidden; 
  }*/


.form-heading { color:#fff; font-size:23px;}

.panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}

.panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}

.login-form .form-control {

  background: #f7f7f7 none repeat scroll 0 0;

  border: 1px solid #d4d4d4;

  border-radius: 4px;

  font-size: 12px;

  height: 35px;


}

.main-div {

  background: #ffffff none repeat scroll 0 0;

  border-radius: 5px;

  margin: 10px auto 30px;

  max-width: 80%;

  padding: 50px 70px 70px 71px;

}



@media only screen and (max-width: 600px) {

    .main-div {

        background: #ffffff none repeat scroll 0 0;

        border-radius: 5px;

        margin: 10px auto 30px;

        max-width: 100%;

        padding: 50px 70px 70px 71px;

      }



     

  }



.login-form .form-group {

  margin-bottom:10px;

}

.login-form{ text-align:center;}

.forgot a {

  color: #777777;

  font-size: 14px;

  text-decoration: underline;

}

.login-form  .btn.btn-primary {

  background: #f0ad4e none repeat scroll 0 0;

  border-color: #f0ad4e;

  color: #ffffff;

  font-size: 14px;

  width: 100%;

  height: 40px;

  padding: 0;

}

.forgot {

  text-align: left; margin-bottom:30px;

}

.botto-text {

  color: #ffffff;

  font-size: 14px;

  margin: auto;

}

.login-form .btn.btn-primary.reset {

  background: #ff9900 none repeat scroll 0 0;

}

.back { text-align: left; margin-top:10px;}

.back a {color: #444444; font-size: 13px;text-decoration: none;}

.alertClass{

  font-size: 12px;

  font-weight: 600;

  text-align: center;

  color: red;

  padding-top: 4%;

}

.alertClassNew {

    font-size: 12px;

    font-weight: 600;

    text-align: center;

    color: #60d226;

    padding-top: 4%;

}

.box-shadow{

      -webkit-box-shadow: 0px 0px 11px -1px rgb(110 110 110 / 75%);
    -moz-box-shadow: 0px 0px 11px -1px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 11px -1px rgb(122 122 122 / 75%);
    border: 1px solid #c9c9c9;

}

.box-shadow12{
  border: 1px solid black;

}

.aceLogoImg1{

  width: 119%;
  height: 108%;
  margin-left: -1%;
  margin-top: 4%;

}

.aceworth_imgErp{

  width: 119%;
  height: 92%;
  margin-left: -14%;

}

.biztech_img{

  width: 119%;
  height: 92%;
  margin-left: -8%;

}

.biz_Img{

   width: 133%;

  }

.address-text{

    margin-left: 32%;

    width: 101%;

    padding-top: 18%;



  }

.FadeInwin{
            opacity: 0; 
            transition: opacity 2s;
}
.setinfobox{
  margin-top: -33px;
}

.bg-primary {
    background-color: #00a0df !important;
}

.bg-effect-header{
  background-image: linear-gradient(to right, #0093dd , #fafcff) !important;
  -webkit-box-shadow: 0px 0px 11px -1px rgb(110 110 110 / 75%);
  -moz-box-shadow: 0px 0px 11px -1px rgba(0,0,0,0.75);
  box-shadow: 0px 2px 5px -1px rgb(122 122 122 / 75%);
 
}

.bg-effect-footer{
  background-image: linear-gradient(to left, #0093dd , #fafcff) !important;
}

#footerLogin{
    position: fixed;
    padding: 10px 10px 8px 10px;
    bottom: 0;
    width: 100%;
    height: 40px;
    background: grey;
}
.aceLogo{
    height: 28px;
    width: 174px;
}

.footerText{
    text-align: right;
    margin-top: 8px;
}

.aceLogoNav{
  display: none;
}
.erpImg{
  display: none;
}

.LoginBox{
  margin-top: 7%;
}

.loginPanel{
    margin-top: 10% !important;
}
.ImgErpBottom{
  display: none;
}
.mkGimg{
  position:fixed; 
  top:6px; 
  left:6px;
  width: 100px;

}
.aceLogoImg{
  position: fixed;
  top: 25px;
  right: 6px;
  width: 30%;
  
}
.logInBtnIcon:before {
    content: "\25AE";  /* this is your text. You can also use UTF-8 character codes as I do here */
    font-family: FontAwesome;
    left:-5px;
    position:absolute;
    top:0;
 }

html{ height: 100%; }
            body{ padding: 0; margin: 0; height: 100%; }
            /*h2{color: white; font-family: sans-serif; background-color: teal; padding: 10px; font-weight: lighter; }
            h2 a{ float: right; color: white; text-decoration: none; vertical-align: bottom; }*/
            #wrap{width: 550px;margin: 0 auto; }
            pre, pre.noclick{ text-align: left; background-color: #EEE; border-left: 5px solid teal; cursor: pointer; border-top: 1px solid transparent; border-bottom: 1px solid transparent; border-right: 1px solid transparent; }
            pre:hover{ background-color: #f4f4f4; border-color: teal; }
            pre:active{ background-color: #DDD; }
            pre.noclick{ cursor: inherit; }
            pre.noclick:hover{ background-color: #EEE; border-top-color: transparent; border-right-color: transparent; border-bottom-color: transparent; }
            footer{font-family: sans-serif; font-size: 12px;}
            footer p{color: #aaa;}
            footer p a{color: yellowgreen; text-decoration: none;}
            .title{font-size: 57px; font-weight: bold; color: #555;margin-bottom: 0;}
            .subtitle{font-size: 14px; color: #999;margin-top: -10px; }
            .version{ font-size: 10px; font-weight: lighter; font-family: sans-serif; color: #555; }
            .s{ color: teal; }
            .b{ color: purple; }
            .f{ font-weight: bold; }
            .n{ font-weight: bold; }
            pre{padding: 10px; background-color: #EEE;}
            hr{ height: 5px; border: 0; margin: 0; }
      .comment{color: #AAA;}
      .string{color: teal;}
      .tag{color: blue;}
      .attr{color: green;}
      .button_download{
        display: block;
        font-family: sans-serif;
        cursor: pointer;
        width: 60px;
        padding: 10px 30px 10px 30px;
        font-weight: bold;
        font-size: 20px;
        text-decoration: none;
        text-align: center;
        margin: 0 auto;
        background-color: #444;
        color: #EEE;
        transition: all 0.3s;
        -moz-transition: all 0.3s;
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        -ms-transition: all 0.3s;
      }
      /*.button_download:hover{
        width: 480px;
        background-color: yellowgreen;
        color: #444;
      }*/
      .step{ font-weight: bold; }

@media only screen and (max-width: 600px) {


  .LoginBox{
    margin-top: 38%;
  }

  
  .aceworth_imgErp{

    width: 119%;
    height: 100%;
    margin-top: -10%;

  }

  .aceworth_img {
    width: 105%;
    height: 100%;
    margin-top: -3%;
    margin-left: -4%;
  }
  .ImgErpBottom {
    display: block;
    margin-left: -5%;
    margin-top: 20%;
  }

  .loginPanel{
    margin-top: 63% !important;
  }

  .brand_logo_container {
      position: absolute !important;
      height: 157px !important;
      width: 155px !important;
      top: 130px !important;
      border-radius: 141% !important;
      background: linear-gradient(to top, #f1f7fc , #fafcff) !important;
      padding: -5px !important;
      text-align: center !important;
      margin-top: 15% !important;
  }

  body#LoginForm{ 
    background-image:url("public/dist/img/curveBackground.png");
    background-repeat: no-repeat;
    background-size: cover;
  }

  .erpImg{
    display: block;
  }

  .ImgErp{
    display: none;
  }

  .aceworthLogFooter{
    display: none;
  }

  .aceLogo{
    height: 45px;
    width: 174px;
  }

  .boxFooterLogoAceW{
    margin-top: 32%;
    margin-left: 28%;
  }

  .footerText{
    text-align: center;
    margin-top: 0px;
    font-size: 10px;
  }

  .aceLogoNav{
    display: block;
    width: 60%;
    margin-left: 40%;
  }

  .biztech_img{

    padding-top: 16%;padding-left: 13%;

  }

  .biz_Img{

    width: 81%;

  }

  .row-class{

    margin-top: -31%;
    width: 100%;
    position: fixed;

  }

  .logInBtn{
    font-family: 'Times New Roman', serif;
    margin-top: 10%;
  }

  .proceedBtn{
    margin-left: 15% !important;
    font-family: 'Times New Roman', serif;
    margin-top: 10%;
  }

  .address-text {

    margin-left: 0%;

    width: 101%;

    padding-top: 18%;

    padding-bottom: 20%;

  }

  .setinfobox{
    margin-top: 1px;
  }
  .FadeInwin{
            opacity: 0; 
            transition: opacity 2s;
  }

  .brand_logo {
    height: 119px;
    width: 117px;
    border-radius: 60%;
  }

  .brand_logo_container {
    position: absolute !important;
    height: 124px !important;
    width: 126px !important;
    top: 130px !important;
    border-radius: 141% !important;
    background: linear-gradient(to top, #f1f7fc , #fafcff) !important;
    padding: -5px !important;
    text-align: center !important;
    margin-top: 15% !important;
  }

  .white-panel {
    background-image: linear-gradient(to right, #0093dd , #fafcff) !important;
    height: 310px;
    width: 420%;
    right: calc(60% - 60px);
    transition: .3s ease-in-out;
    z-index: 0;
    box-shadow: 0 0 10px 9px #00000096;
    margin-top: 15%;
    border-radius: 10px;
  }

}
.text-muted {
    color: #ff0000!important;
    border-color: #ff0000;
    margin: 0px;
}
p {
    margin-top: 0;
    margin-bottom: -0.5rem;
}
.alert-danger {
    color: #ffffff;
    background-color: #dc3545d9;
    border-color: #dc3545d9;
}
.serverText {
    margin-top: 35px;
    text-align: center;
    margin-left: 265px;
    font-size: 26px;
    font-weight: 800;
    font-style: italic;
    color: #29166f;
}
</style>


<body id="LoginForm">

  <div class="container">

    <div class="row row-class">

      <div class="col-lg-6 ImgErp">

        <div class="serverText">Main  ERP </div>

        <div>
          <img src="{{ URL::asset('public/dist/img/MUKUNDGROUPLOGO.png') }}" class="mkGimg">
        </div>

        <img src="{{ URL::asset('public/dist/img/erpNew.png') }}" class="aceworth_img">

      </div>

      <div class="col-lg-6">

        <div class="login-reg-panel loginPanel">
          <div class="d-flex justify-content-center" style="margin-left: 209%;">
            <div class="brand_logo_container">
              <img src="{{ URL::asset('public/dist/img/usrLogo.png') }}" class="brand_logo" alt="Logo">
            </div>
          </div>
          <div class="login-info-box">
          </div>
                    
          <div class="register-info-box">
           
          </div>
                    
          <div class="white-panel">

          <form action="{{ url('login') }}" accept-charset="utf-8" class="form-horizontal" id="Login" method="POST" >

            @csrf

            <div class="login-show">

              <div style="margin-top: 7%;margin-bottom: 11%;">
                
                <div class="form-group">

                    <div class="input-group">

                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                      </div>
                      <input type="text" value="{{old('username')}}" onkeydown='handleEnter(event)' name="username" class="form-control" id="inputEmail" placeholder="Enter Unername"  />                
                    </div>

                    <small id="valErrMsg_1" class="form-text text-muted">
                    </small>
                    <small class="form-text text-muted">

                    {!! $errors->first('username', '<p class="help-block" style="color:red;font-size: 11px;">:message</p>') !!}

                  </small> 

                </div>

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-key"></i></div>
                    </div>
                    <input type="password" value="" class="form-control" onkeydown='handleEnter(event)' id="inputPassword" placeholder="Enter Password" name="password"  oninput="getpass(this.value)"/>                  
                  </div>
                    <small id="valErrMsg_2" style="color: red;font-size: 11px;font-weight: 700;" class="form-text text-muted">
                    </small>
                   <small class="form-text text-muted">

                    {!! $errors->first('password', '<p class="help-block" style="color:red;font-size: 11px;">:message</p>') !!}

                  </small> 
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-building-o"></i></div>
                    </div>
                    <input list="compList" name="company_name" id="companyName" onkeydown='handleEnter(event)' class="form-control" placeholder="Select Company" autocomplete="off" readonly/>

                      <datalist id="compList">

                        <option selected="selected" value="">-- Select Company--</option>

                        @foreach ($comp_name as $row)

                          <option value='{{$row->COMP_CODE}}-{{$row->COMP_NAME }}' data-xyz ="{{$row->COMP_NAME }}" ><?php echo $row->COMP_NAME; echo " [".$row->COMP_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>               
                  </div>
                  <small class="form-text text-muted">

                    {!! $errors->first('company_name', '<p class="help-block" style="color:red;font-size: 11px;">:message</p>') !!}

                  </small>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>

                    <input list="fyList" name="fyCode" id="fyCode" onkeydown='handleEnter(event)' class="form-control" placeholder="Select Accounting Year" autocomplete="off" readonly/>

                    <datalist id="fyList">
                      
                    </datalist>                   
                  </div>
                  <small id="fyListMsg" class="form-text text-muted">

                    {!! $errors->first('fyCode', '<p class="help-block" style="color:red;font-size: 11px;">:message</p>') !!}

                  </small>

                </div>

                <div class="logInBtn" style="text-align: -webkit-center;"> 
                 <input type="Submit" id="label-register" class="logInBtnIcon" style="color: #303030;" value="LogIn">
                </div>
                <input type="hidden" value="" id="checkLogIn">
            
              </div>

              <div class="text-center">

                <small class="mr-25">

                    @if($message = Session::get('error'))

                        <div class="alert alert-danger alertMessage" role="alert">

                          <button type="button" class="close closeBtn" data-dismiss="alert" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                          </button>

                          <strong>Failed...!</strong>

                          {{ $message }}

                        </div>

                    @endif

                </small>


                <small class="mr-25 classUserPassCheck" id="checkUsrPasMsg">

                    <div class="alert alert-danger-new alertMessage" role="alert">

                      <button type="button" class="close closeBtn" data-dismiss="alert" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                      </button>

                      <strong>Failed...!</strong>

                      <span id="showMsg"></span>
                      
                    </div>

                </small>



              </div>

            </div>
            </form>

          </div>
        </div>

      </div>

     

      <div class="col-lg-6 ImgErpBottom">

        <div>
          <img src="{{ URL::asset('public/dist/img/logo_new.png') }}" class="aceLogoImg" alt="Company Logo">
        </div>

        <div>
          <img src="{{ URL::asset('public/dist/img/MUKUNDGROUPLOGO.png') }}" class="mkGimg">
        </div>

        <img src="{{ URL::asset('public/dist/img/erpNew.png') }}" class="aceworth_img">

      </div>

    </div>



  </div>

 <footer id="footerLogin" class="navbar navbar-expand-lg navbar-dark bg-effect-footer" style="color: white;">
      <div class="col-lg-12">
        <div class="row">
          
          <div class="col-lg-4 aceworthLogFooter">
            <img src="{{ URL::asset('public/dist/img/logo_new.png') }}" class="aceLogo" alt="Company Logo">
          </div>

          <div class="col-lg-8 footerText">
            <strong>Copyright &copy; <?php echo date('Y'); ?>-<?php echo date('Y',strtotime('+1 year')); ?> <a href="http://aceworth.in/" target="_blank" style="color: #063568 !important;"> Biztech Consultancy Services</a>.</strong> &nbsp; All rights reserved.
          </div>

        </div>
      </div>
    </footer>


    <!-- jQuery 2.1.4 -->

    <script src="{{ URL::asset('public/plugins/jQuery/jQuery-2.1.4.min.js') }}" ></script>

   

    <!-- Bootstrap 3.3.5 -->

    <script src="{{ URL::asset('public/bootstrap/js/bootstrap.min.js') }}"></script>

    

    <!-- DataTables -->

    <script src="{{ URL::asset('public/plugins/datatables/jquery.dataTables.min.js') }}">   

    </script>

    <script src="{{ URL::asset('public/plugins/datatables/dataTables.bootstrap.min.js') }}">

    </script>
    <script src="{{ URL::asset('public/dist/js/dataTables.buttons.min.js') }}">
    </script>


    <script type="text/javascript" src="{{ URL::asset('public/dist/js/datatable/dataTables.buttons.min.js') }}"></script> 

    <script type="text/javascript" src="{{ URL::asset('public/dist/js/datatable/jszip.min.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('public/dist/js/datatable/buttons.html5.min.js') }}"></script>
     
      <!-- SlimScroll -->

    <script src="{{ URL::asset('public/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Select2 -->

    <script src="{{ URL::asset('public/plugins/select2/select2.full.min.js') }}"></script>

    <!-- FastClick -->

    <script src="{{ URL::asset('public/plugins/fastclick/fastclick.min.js') }}"></script>

    <!-- AdminLTE App -->

    <script src="{{ URL::asset('public/dist/js/app.min.js') }}"></script>

    <!-- Sparkline -->

    <script src="{{ URL::asset('public/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- jvectormap -->

    <script src="{{ URL::asset('public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>

    <script src="{{ URL::asset('public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- SlimScroll 1.3.0 -->

    <script src="{{ URL::asset('public/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>

    <!-- ChartJS 1.0.1 -->

    <script src="{{ URL::asset('public/plugins/chartjs/Chart.min.js') }}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

    <!-- <script src="{{ URL::asset('public/dist/js/pages/dashboard2.js') }}"></script> -->

    <!-- AdminLTE for demo purposes -->

    <!-- <script src="{{ URL::asset('public/dist/js/notifIt.min.js') }}"></script> -->

    <script src="{{ URL::asset('public/dist/js/notifIt.js') }}"></script>




    <script src="{{ URL::asset('public/plugins/input-mask/jquery.inputmask.js') }}"></script>

    <script src="{{ URL::asset('public/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>

    <script src="{{ URL::asset('public/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<?php if(Request::segment(1)=='userinactivity') { ?>
<script type="text/javascript">

  $(window).load(function() {

      notif({
        msg: "Access Denied...!<b>User Inactivity...! </b>",
        type: "error",
        position: "center"
      });

      var delay = 1500; 
      var url = "{{url('/')}}"
      setTimeout(function(){ window.location = url;}, delay);

  });
   
  
</script>
<?php } ?>

<?php if(Request::segment(1)=='userlogout') { ?>
<script type="text/javascript">


  $(window).load(function() {

      notif({
        msg: "User Password Change Successfully...! </b>",
        type: "success",
        position: "center"
      });

      var delay = 3500; 
      var url = "{{url('/')}}"
      setTimeout(function(){ window.location = url;}, delay);

  });
   
  
</script>
<?php } ?>

<script type="text/javascript">

  $(document).ready(function(){
    $('.login-info-box').fadeOut();
    $('.login-show').addClass('show-log-panel');
  });

  function getpass(passVal){

    var userName = $('#inputEmail').val();
    var password = $('#inputPassword').val();
    //console.log('userName',userName);
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

        url: "{{ url('check-login-details') }}",
        method : 'POST',
        type: 'JSON',
        data: {userName: userName,password: password},
        success:function(data){

         var data1 = JSON.parse(data);
                    
          if (data1.response == 'error') {
            $('#valErrMsg_2').html('Please Enter Correct Password');
            $('#companyName').prop('readonly',true);
            $('#fyCode').prop('readonly',true);
            $('#companyName,#fyCode').val('');        
          }else if(data1.response == 'success'){
            $('#valErrMsg_2').html('');
            $('#companyName').prop('readonly',false);

          }

        }
      });

  }


 $(document).ready(function () {

  $(".alert").fadeIn( 500 ).delay( 2000 ).fadeOut( 3000, function(){
      $(".alert").alert('close');
  });

  console.log('Login Page...!');

    $("#companyName").change(function() {

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        var comp_name = $("#companyName").val();

        var xyz = $('#compList option').filter(function() {

        return this.value == comp_name;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg == 'No Match'){
         
          $('#companyName').val('');
         
        }
    
      console.log('comp_name',comp_name);

      $.ajax({
        url: "{{ url('get_comp_login') }}",
        method : 'POST',
        type: 'JSON',
        data: {comp_name: comp_name},
        success:function(data){

          var data1 = JSON.parse(data);
                    
          if (data1.response == 'error') {

            $('#fyListMsg').html("<p style='color:red'>"+ data1.message +"</p>");
                    
          }else if(data1.response == 'success'){

            console.log('success');

            $("#fyList").empty();

            var getYrCount  = data1.fy_list.length;

            console.log('countYr',getYrCount);

            if(getYrCount == 1){

              $('#fyCode').prop('readonly',false);

              $('#fyCode').val(data1.fy_list[0].FY_CODE);

              

            }else{

              $.each(data1.fy_list, function(k, getData){

                $('#fyCode').prop('readonly',false);

                $("#fyList").append($('<option>',{

                  value:getData.FY_CODE,

                  'data-xyz':getData.FY_CODE,
                  text:getData.FY_CODE


                }));

              });
            }

          }

          $("#fyCode").html(data);

        }
      })
     
    });


    $('#fyCode').on('change',function(){

      var fy_code = $("#fyCode").val();

        var xyz = $('#fyList option').filter(function() {

        return this.value == fy_code;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg == 'No Match'){
          $('#fyCode').val('');
        }

    });

    $( window ).on( "load", function() {
        $('.FadeInwin').css("opacity","1");
    });

    



   
    
});


function handleEnter(event) {
    if (event.key==="Enter") {
      const form = document.getElementById('Login')
      const index = [...form].indexOf(event.target);
      form.elements[index + 1].focus();
      event.preventDefault();
    }
}

</script>
  


  </body>

</html>

