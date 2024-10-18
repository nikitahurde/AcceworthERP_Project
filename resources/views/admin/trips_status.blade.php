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

.small-box>.inner {
    padding: 6px !important;
    height: 75px !important;
}
.info-box {
    box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
    border-radius: 0.25rem;
    background-color: #fff;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 1rem;
    min-height: 80px;
    padding: 0.5rem;
    position: relative;
    width: 100%;
}

.info-box .info-box-text, .info-box .progress-description {
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    text-transform: none;
    font-size: 15px;
    font-weight: 600;
}

.info-box-content .fa{
  display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1;
    font-weight: 400;
    font-size: 35px;

}

.info-box .info-box-content {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    -ms-flex-pack: center;
    justify-content: center;
    line-height: 1.8;
    -ms-flex: 1;
    flex: 1;
    padding: 0 10px;
    overflow: hidden;
}
.info-box .info-box-icon {
    border-radius: 0.25rem;
    -ms-flex-align: center;
    align-items: center;
    display: -ms-flexbox;
    display: flex;
    font-size: 2.875rem;
    -ms-flex-pack: center;
    justify-content: center;
    text-align: center;
    width: 70px;
}


/*.info-box .info-box-content {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    -ms-flex-pack: center;
    justify-content: center;
    line-height: 1.8;
    -ms-flex: 1;
    flex: 1;
    padding: 0 10px;
    overflow: hidden;
}*/
.info-box-content {
    padding: 5px 10px;
    margin-left: 0px;
}

.info-box-icon {
    border-top-left-radius: 2px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 2px;
    display: block;
    float: left;
    height: 90px;
    width: 90px;
    text-align: center;
    font-size: 45px;
    line-height: 90px;
    background: rgba(0,0,0,0.0);
}

.info-box .info-box-text, .info-box .progress-description {
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.info-box .progress {
    background: rgba(0,0,0,0.2);
    margin: 6px -2px 6px -10px;
    height: 2px;
}
.bg-info {
    background-color: #17a2b8!important;
    color: #fff!important;
}
.bg-success {
    background-color: #28a745!important;
     color: #fff!important;
}
.bg-warning {
    background-color: #ffc107!important;
    color: #111 !important;
}
.bg-danger {
    background-color: #dc3545!important;
    color: #fff!important;
}

.bg-gradient-info {
    background: #17a2b8 linear-gradient(180deg,#3ab0c3,#17a2b8) repeat-x!important;
    color: #fff;
}
/*.table>tbody>tr:hover {
  background-color: #697068 !important;
}*/
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #697068 !important;
}
@keyframes blinker {
  50% {
    opacity: 0;
  }
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
  left:35px;
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

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

           Trips / LR Status
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

             <small><b>View Details</b></small> 

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>Trips/LR Status</a></li>
          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <!-- <div class="box  Custom-Box" style="margin-top:5%;"> -->

                <!-- <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Trips / LR Status</h3> -->

                  <!-- <div class="box-tools pull-right">

                    <a href="#" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Vehical Doc</a>

                  </div> -->

                <!-- </div>/.box-header -->

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

            <div class="row">
              <a href="{{ url('/Trips/DO-for-planning')}}">
              <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-gradient-info">
                  
                  <span class="info-box-icon" ><i class="fa fa-list-ol"></i></span>
                  <div class="info-box-content" data-tip="Pending Trip Plan - D.O.">
                    <span class="info-box-text">Pending Trip Plan - D.O.</span>
                    <span class="info-box-number">Status</span>
                    <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                    Pending
                    </span>
                  </div>

                </div>

               </div></a>
               
               <a href="{{ url('/Trips/do-for-lr-status')}}">
               <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-success">

                  <span class="info-box-icon"><i class="fa fa-list-ol" aria-hidden="true"></i></span>
                  <div class="info-box-content" data-tip="Pending LR - Trips">
                    <span class="info-box-text">Pending LR - Trips </span>
                    <span class="info-box-number">{{$countdolr}}</span>
                    <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                    Pending
                    </span>
                  </div>

                </div>

               </div></a>

               <!-- <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-warning">
                  
                  <span class="info-box-icon" ><i class="fa fa-list-ol"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">LR for Outword Pending</span>
                    <span class="info-box-number">41,410</span>
                    <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                    Pending
                    </span>
                  </div>

                </div>

               </div> -->

                <a href="{{url('/Trips/pending-outward-trip-status')}}">
              <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-danger">
                  
                  <span class="info-box-icon" ><i class="fa fa-list-ol"></i></span>
                  <div class="info-box-content" data-tip="Pending Outword - Trips/LR">
                    <span class="info-box-text">Pending Outward - Trips/LR</span>
                    <span class="info-box-number">{{$countOutwardPending}}</span>
                    <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                    LR Done
                    </span>
                  </div>

                </div>

               </div></a>

              </div>

              <div class="row">
               <a href="{{ url('/Trips/epod-status')}}">
               <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-gradient-info">
                  
                  <span class="info-box-icon" ><i class="fa fa-list-ol"></i></span>
                  <div class="info-box-content" data-tip="Pending EPOD - Trips/LR">
                    <span class="info-box-text">Pending EPOD - Trips/LR</span>
                    <span class="info-box-number">{{$pending_epod_count}}</span>
                    <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                    Pending
                    </span>
                  </div>

                </div>

               </div></a>
              
               <a href="{{ url('/Trips/lr-ack-status')}}">
               <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-success">
                  
                  <span class="info-box-icon" ><i class="fa fa-list-ol"></i></span>
                  <div class="info-box-content" data-tip="Pending LR Acknowledge - Trips/LR">
                    <span class="info-box-text">Pending LR Acknowledge - Trips/LR</span>
                    <span class="info-box-number">{{$countlr_ack}}</span>
                    <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                    Running Trip
                    </span>
                  </div>

                </div>

               </div></a>

              <!--  <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-warning">
                  
                  <span class="info-box-icon" ><i class="fa fa-list-ol"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">E-Way Bill</span>
                    <span class="info-box-number">41,410</span>
                    <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                    Expiry in next 2 day
                    </span>
                  </div>

                </div>

               </div> -->
               <a href="{{url('/Trips/ewaybill-status')}}">
               <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-danger">
                  
                  <span class="info-box-icon" ><i class="fa fa-list-ol"></i></span>
                  <div class="info-box-content" data-tip="E-Way Bill - Trips/LR">
                    <span class="info-box-text">E-Way Bill - Trips/LR</span>
                    <span class="info-box-number">{{$countEwb}}</span>
                    <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                   Expiry next 2 days 
                    </span>
                  </div>

                </div>

               </div></a>

              </div>

             </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->

      </div>



@include('admin.include.footer')

<script type="text/javascript">


</script>
@endsection



