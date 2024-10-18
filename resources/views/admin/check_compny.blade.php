@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')


<meta name="csrf-token" content="{{ csrf_token() }}">


<style type="text/css">

  .required-field::before {

    content: "*";

    color: red;

}

.jsw_img{

    width: 24%;

    margin-left: 66%;

    margin-top: -64px;

}

.aceworth_img{

    margin-left: 13%;
    width: 26%;
    margin-top: -2%;
    margin-bottom: -4%;

}

.biztech_img{

    padding-top: 16%;padding-left: 13%;

  }

  .biz_Img{

    width: 47%;

    margin-left: 25%;

    margin-top: 3%;

  }

  .address-text {

    margin-left: 24%;

    width: 58%;

    padding-top: 7%;

  }

  .submit_btn{

    text-align: center;

    margin-top: 2%;

    margin-bottom: 4%;



  }
  .title-heading{
    margin-left: 373px;
    font-size: 15px;
    font-weight: bold;
  }

  body

  { 

    background-image: url({{url('public/dist/img/background_cmp_img.jpg')}});

    background-repeat: no-repeat;

    background-size: cover;

  





  }

  .modal .modal-popout-bg {

    background-image: url({{url('public/dist/img/cool-background.png')}});



  }

  .modal_diloge{

    margin: 140px auto;

  }

.modal-bakgraoun-img{
    background-image: url({{url('public/dist/img/compbackimg.png')}});
    background-repeat: no-repeat;
    height: 200px;
   
}
.centered {
    color: #fff;
    font-size: 15px;
    font-weight: bold;
    text-align: center;
    margin-top: 29px;
    background-color: #00000059;
    margin-right: 20px;
}
.imgInRes{
  margin-left: 24px;
}
  @media only screen and (max-width: 600px) {

    .modal_diloge{

        margin: 32px auto;

        width: 90%;

      }

    .jsw_img {

        width: 35%;

        margin-left: 64%;

        margin-top: -47px;

    }

    .aceworth_img {

         margin-left: 3%;
         width: 26%;
         margin-top: -2%;

    }

    .form-class{

      width: 73%;

      margin-left: 13%;

    }

    .form-submit-btn{

      margin-right: 10%;

    }

    .modal-bakgraoun-img {
    background-image: url(public/dist/img/compbackimg.png);
    background-repeat: no-repeat;
    height: 200px;
    margin-left: 11%;
}

    .centered {
    color: #fff;
    font-size: 15px;
    font-weight: bold;
    text-align: center;
    margin-top: 29px;
    background-color: #00000059;
    margin-right: 21%;
}
.title-heading {
    margin-left: 107px;
    margin-top: 29px;
    font-size: 15px;
    font-weight: bold;
    /* margin-right: 163px; */
}
.titleinrespnsive{
    text-align: center;
    margin-top: -5%;
    margin-right: 19%;
}
.imgInRes{
  margin-left: 0px;
}


  }

</style>

 <!-- =========== Start : demo page ============= -->



      <!-- Button trigger modal -->



<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" data-keyboard="false" data-backdrop="static">

  <div class="modal-dialog modal_diloge" role="document" >

    <div class="modal-content modal-popout-bg" style="border-radius: 7px;">

      <!-- start : header logos -->

      <div class="modal-header">

        <!-- start : aceworth logos -->

       <!--  <div class="modal-title" id="exampleModalLabel">

          <img src="{{ URL::asset('public/dist/img/logo_new.png') }}" class="aceworth_img">

        </div> -->

        <div class="modal-title" >

         <img src="{{ URL::asset('public/dist/img/jswlogo.png') }}" class="aceworth_img">

        </div>

         <!-- end : aceworth logos -->



         <!-- start : jsw logos -->
<?php  $name = Session::get('name'); ?>
      <div class="modal-title titleinrespnsive">
        <span  class="title-heading">Welcome To {{ ucfirst($name) }}</span>
      </div>

        <!-- end : jsw logos -->

      </div>

      <!-- end : header logos -->

      <div class="row imgInRes">

        <!-- start : address and logo -->
       <div class="col-md-6  modal-bakgraoun-img">

         &nbsp;
          <p class="centered">Welcome To Logistic Management System <br>
           And <br>
          Warehouse Management System
         </p>
         
       </div>

       <!-- end : address and logo -->



       <!-- start : form -->

        <div class="col-md-6 form-class">

          <form action="{{ url('company-submit') }}" accept-charset="utf-8" class="form-horizontal" method="POST" >

            @csrf

          <div class="modal-body">

            <div>

              <label>Company name : <span class="required-field"><span></span></span></label>

              <select class="form-control" style="width: 100%" name="company_name" id="company_name">

                <option value="">select company</option>
               
                @foreach($comp_name as $row)

                <option value="{{  $row->COMP_CODE}}-{{$row->COMP_NAME }}">{{$row->COMP_CODE}}-{{$row->COMP_NAME }}</option>

                 @endforeach
              
              </select>

              <small id="emailHelp" class="form-text text-muted">

                {!! $errors->first('company_name', '<p class="help-block" style="color:red;">:message</p>') !!}

              </small>

            </div>

            <div>&nbsp;</div>

            <div>

              <label>Fy Year : <span class="required-field"><span></span></span></label>

              <select class="form-control" style="width: 100%" name="macc_year" id="macc_year">

                <option value="">--select year--</option>
              </select>

              <small id="emailHelp" class="form-text text-muted">

                {!! $errors->first('macc_year', '<p class="help-block" style="color:red;">:message</p>') !!}

              </small>

            </div>



          </div>

          <div class="submit_btn form-submit-btn">           

            <button type="submit" class="btn btn-primary">

              Continue &nbsp;&nbsp;

              <i class="fa fa-sign-in" aria-hidden="true"></i>

            </button>

          </div>

          </form>

        </div>

        <!-- end : form -->

      </div>

    

    </div>

  </div>

</div>



 <!-- =========== End : demo page ============= -->





  <!-- jQuery 2.1.4 -->

    <script src="{{ URL::asset('public/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

    <!-- Bootstrap 3.3.5 -->

    <script src="{{ URL::asset('public/bootstrap/js/bootstrap.min.js') }}"></script>

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

    <script src="{{ URL::asset('public/dist/js/pages/dashboard2.js') }}"></script>

    <!-- AdminLTE for demo purposes -->

    <script src="{{ URL::asset('public/dist/js/demo.js') }}"></script>

  </body>

</html>


<script type="text/javascript">
  
      $("#company_name" ).change(function() {

           $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
         });
        
      var comp_name = $("#company_name").val();
      //alert(comp_name);return false;


      $.ajax({
        url: "{{ url('get_comp') }}",
        method : 'POST',
        type: 'JSON',
        data: {comp_name: comp_name},
      })
      .done(function(data) {

       // var obj = $.parseJSON(data);
        console.log(data);

        $("#macc_year").html(data);

      })
    
    });

</script>
<script type="text/javascript">


    $(window).on('load',function(){

        $('#exampleModal').modal('show');

         console.log( "ready!" );

      $(".select2").select2();



    });
   

</script>





@endsection