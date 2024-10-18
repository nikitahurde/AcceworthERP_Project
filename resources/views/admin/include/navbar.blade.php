

<style type="text/css">

  /* Absolute Center Spinner */
.overlay-spinner {
    position: fixed;
    z-index: 999;
    height: 2em;
    width: 2em;
    overflow: show;
    margin: auto;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}

/* Transparent Overlay */
.overlay-spinner:before {
    content: '';
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.overlay-spinner:not(:required) {
    /* hide "loading..." text */
    font: 0/0 a;
    color: transparent;
    text-shadow: none;
    background-color: transparent;
    border: 0;
}

.overlay-spinner:not(:required):after {
    content: '';
    display: block;
    font-size: 10px;
    width: 1em;
    height: 1em;
    margin-top: -0.5em;
    -webkit-animation: spinner 1500ms infinite linear;
    -moz-animation: spinner 1500ms infinite linear;
    -ms-animation: spinner 1500ms infinite linear;
    -o-animation: spinner 1500ms infinite linear;
    animation: spinner 1500ms infinite linear;
    border-radius: 0.5em;
    -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
   box-shadow: rgba(74 156 204) 1.5em 0 0 0, rgba(74 156 204) 1.1em 1.1em 0 0, rgba(74 156 204) 0 1.5em 0 0, rgba(74 156 204) -1.1em 1.1em 0 0, rgba(74 156 204) -1.5em 0 0 0, rgba(74 156 204) -1.1em -1.1em 0 0, rgba(74 156 204) 0 -1.5em 0 0, rgba(74 156 204) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
@-moz-keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
@-o-keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
@keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

.hideloader{
  display: none;
}

  /* Absolute Center Spinner */
.modalspinner {
    position: fixed;
    z-index: 999;
    height: 2em;
    width: 2em;
    overflow: show;
    margin: auto;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}

/* Transparent Overlay */
.modalspinner:before {
    content: '';
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.modalspinner:not(:required) {
    /* hide "loading..." text */
    font: 0/0 a;
    color: transparent;
    text-shadow: none;
    background-color: transparent;
    border: 0;
}

.modalspinner:not(:required):after {
    content: '';
    display: block;
    font-size: 10px;
    width: 1em;
    height: 1em;
    margin-top: -0.5em;
    -webkit-animation: modlspinner 1500ms infinite linear;
    -moz-animation: modlspinner 1500ms infinite linear;
    -ms-animation: modlspinner 1500ms infinite linear;
    -o-animation: modlspinner 1500ms infinite linear;
    animation: modlspinner 1500ms infinite linear;
    border-radius: 0.5em;
    -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
   box-shadow: rgba(74 156 204) 1.5em 0 0 0, rgba(74 156 204) 1.1em 1.1em 0 0, rgba(74 156 204) 0 1.5em 0 0, rgba(74 156 204) -1.1em 1.1em 0 0, rgba(74 156 204) -1.5em 0 0 0, rgba(74 156 204) -1.1em -1.1em 0 0, rgba(74 156 204) 0 -1.5em 0 0, rgba(74 156 204) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes modlspinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
@-moz-keyframes modlspinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
@-o-keyframes modlspinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
@keyframes modlspinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

.hideloaderOnModl{
  display: none;
}



  .signOutBox {

    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

    border: 1px solid #d2cfcf;

    border-radius: 5px;

}

 .fyText{
    font-size: 18px;;
    font-weight: 800;
    color: white;
}
  .firstyear{
    line-height: 1px;
    margin-top: 13px;
  }
  .seperator{
    line-height: 1px;
  }
  .secondyear{
    line-height: 1px;
    margin-top: 14px;
  }
  .compName{
    text-align: center;
    list-style-type: none;
    margin-bottom: -56px;
    margin-top: 20px;
    font-size: 16px;
    font-weight: 800;
    color: #fff;
  }
@media only screen and (max-width: 600px) {

  .demo{
    width: 10px;
  }

  .btn.btn-flat {
      border-radius: 0;
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      box-shadow: none;
      border-width: 1px;
  }

  .btnPrimary {
      background-color: #3c8dbc !important;
      border-color: #367fa9 !important;
  }
  .fyText{
    padding-right: 85px;
    padding-top: 6%;
    font-size: 15px;
    font-weight: 800;
    color: white;
  }
  .compName{
    text-align: center;
    list-style-type: none;
    margin-bottom: -56px;
    margin-top: 21px;
    font-size: 14px;
    font-weight: 800;
    color: #fff;
    padding-right: 10%;
  }

}


</style>



<header class="main-header">

    <div  style="position: fixed;">

        <!-- Logo -->
<?php $compName = Session::get('company_name'); 
  

    $usertype = Session::get('usertype');



?>

        
        <?php if(isset($compName)) { ?>

        <a href="{{ url('/dashboard') }}" class="logo ">
          
          <!-- mini logo for sidebar mini 50x50 pixels -->
          

          <?php 




            $macyaer = Session::get('macc_year');

            if(isset($macyaer)){

              $explode = explode('-',$macyaer);

              $fYear = $explode[0];
              $sYear = $explode[1];

            }else{
              $c_name = 'AceWorth';
            }

          ?>

          <?php
            $FnYear = '';
            $SnYear = '';
            if(isset($fYear) && isset($sYear)){
              $FnYear = $fYear; 
              $SnYear = $sYear;
            }else{

              $FnYear = '0000'; 
              $SnYear = '0000';
            }

           ?>
          
          <span class="logo-mini"> <p class="firstyear">{{$FnYear}}</p> <p class="seperator"> - </p> <p class="secondyear">{{$SnYear}}</p></span>
       
          <!-- logo for regular state and mobile devices -->
         

          <span class="logo-lg" style="font-size: 16px;font-weight: 600;">  
                 FY - {{Session::get('macc_year')}}</span>


            

        </a>
      <?php } else { ?>

        
     <a href="{{ url('/useractivity') }}" class="logo "></a>
        
      <?php } ?>
    </div>

        <!-- Header Navbar: style can be found in header.less -->

        <nav class="navbar navbar-fixed-top navbar-static-top" role="navigation">

          <!-- Sidebar toggle button-->

          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

            <span class="sr-only">Toggle navigation</span>

          </a>


          <ul class="compName">

            <?php if($usertype=='CRM')  {    ?>
            <li>  CRM PORTAL </li>
            <?php } else{ ?>
              <li> {{strtoupper(Session::get('company_name'))}} </li>
            <?php } ?>
          </ul>
      

          <!-- Navbar Right Menu -->

          <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

              
              

              <li class="dropdown user user-menu">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                  <img src="data:image/jpeg;base64,<?php echo base64_encode(Session::get('userImg')); ?>" class="user-image" alt="User Image">

                  <span class="hidden-xs">{{strtoupper(Session::get('username'))}}</span>

                </a>

                <ul class="dropdown-menu signOutBox" style="padding-right: 1%;">

                  <!-- User image -->

                  <li class="user-header">

                    <img src="data:image/jpeg;base64,<?php echo base64_encode(Session::get('userImg')); ?>" class="img-circle" alt="User Image">

                    <p>

                      {{strtoupper(Session::get('username'))}} - {{strtoupper(Session::get('usertype'))}}

                     

                    </p>

                  </li>

                  <!-- Menu Body -->

                 

                  <!-- Menu Footer-->

                  <li class="user-footer">
                   

                    <div class="pull-left">

                      <?php if(isset($compName)) { ?>
                      <a href="#" class="btn btn-primary btn-flat btnPrimary" data-toggle="modal" data-target="#exampleModal">Profile</a>
                    <?php } else { ?>
                      <a href="{{ url('/useractivity') }}"></a>
                    <?php } ?>
                    </div>

                    <div class="pull-right">

                      <a href="{{ url('logout') }}" class="btn btn-primary btn-flat btnPrimary">Sign out</a>

                    </div>

                  </li>

                </ul>

              </li>

              <!-- Control Sidebar Toggle Button -->

              

            </ul>

          </div>



        </nav>


      </header>

       

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <h4 class="box-title PageTitle" style="font-weight: 800;color: #5696bb;">Profile Details</h4>
      </div>
      <div class="modal-body">
       <div class="box box-primary Custom-Box">

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

            <form action="{{ url('form-mast-user-save') }}" method="POST" >

               @csrf

               <div class="row">

                <div class="col-md-6">

                  <div class="form-group">



                      <label>

                       Name : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-user"></i></span>

                          <input type="text" class="form-control" name="name" value="{{ Session::get('username') }}" placeholder="Enter  Name" readonly="">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('name', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                </div>

                 
    <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Email-Id : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-user"></i></span>

                          <input type="text" class="form-control" name="email_id" value="{{ Session::get('email_id') }}" placeholder="Enter User Email Id" readonly="">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('email_id', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>


                 

              </div>

              <!-- /.row -->



               <div class="row">

                <div class="col-md-6">



                    

                    <div class="form-group">

                      <label>

                        User-Id : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-user"></i></span>

                          <input type="text" class="form-control" name="user_name" value="{{ Session::get('userid') }}" placeholder="Enter User Name" readonly="">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('user_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>

              

                   <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Password : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-key"></i></span>

                          <input type="password" class="form-control" name="password" placeholder="Enter Password" value="<?php echo '*****************'; ?>" readonly="">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('password', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                   

              </div>



              <div class="row">



                 <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        User Type : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-user"></i></span>

                         <input type="text" name="" class="form-control" value="{{ Session::get('usertype') }}" readonly="">

                          

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('user_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                 

                </div>

                

              </div>

             


              <div style="text-align: center;">

                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                <a href="{{ url('/sendotpmail') }}" class="btn btn-success btn md" >Change Password</a>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>
      
    </div>
  </div>
</div>
