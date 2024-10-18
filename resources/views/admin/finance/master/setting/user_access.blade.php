@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')





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

    margin-left: 10%;

    width: 26%;

    margin-top: 1%;

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

  body

  { 

    background-image: url({{url('public/dist/img/security.jpg')}});

    background-repeat: no-repeat;

    background-size: cover;

  





  }

  .modal .modal-popout-bg {

    background-image: url({{url('public/dist/img/cool-background.png')}});



  }

  .modal_diloge{

    margin: 40px auto;

  }



  

.access_cont{

  font-size: 18px;

    font-weight: 800;

    color: #4e9ecc;

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

      margin-left: 2%;

      width: 36%;

      margin-top: -2%;

    }

    .form-class{

      width: 73%;

      margin-left: 13%;

    }

    .form-submit-btn{

      margin-right: 10%;

    }

  }

  .menutitle{
      text-align: center;
      padding-top: 1%;
      margin-bottom: -2%;
  }
  .menutitle1{
      text-align: center;
      padding-top: 2%;
      margin-bottom: -2%;
  }
  .menutext{
      font-size: 19px;
      font-weight: 800;
      border-bottom: 1px solid #4e9ecc;
      color: #4e9ecc;
  }



  .box-text{

    padding-top: 42px !important;

  }

</style>

 <!-- =========== Start : demo page ============= -->



      <!-- Button trigger modal -->



<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" data-keyboard="false" data-backdrop="static">

  <div class="modal-dialog modal_diloge modal-lg" role="document" >

    <div class="modal-content modal-popout-bg" style="border-radius: 7px;">

      <!-- start : header logos -->

      <div class="modal-header">

       

      <div style="text-align: center;">

        <span class="access_cont">Access Control</span>

      </div>

      </div>

      <!-- end : header logos -->

      <form method="post" action="{{ url('access-control-save') }}">

        @csrf

        <input type="hidden" name="userid" value="{{ $userid }}">

      
    


       <!-- finnace  master -->
       <div class="row" >
        <div class="menutitle">
            <span class="menutext">
               Finance
            </span>
        </div>

        <center><span id="msg"></span></center>
        <!-- start : form -->

        <div class="col-md-1"></div>

        

        

        <div class="col-md-5">

        @foreach($form_name_list4 as $row)

        <?php 

       $explode = explode('_', $row->form_number);

       $number = $explode[2];

         ?>

          <div class="form-check box-text">

            <div class="col-sm-10 my-1">

              <label class="form-check-label" for="defaultCheck1">

               {{ucwords($row->menu_name)}} - {{ucwords($row->form_name)}} <!-- - {{ $number }} -->

              </label>

            </div>

            <div class="col-sm-2 my-1">

              <input class="form-check-input filtercheck" type="checkbox" value="{{ $row->id }}" id="inward_trans" name="name1[]">

            </div>

            

          </div>

        @endforeach

       </div>

     

       



       

        <div class="col-sm-5">

          @foreach($form_name_list5 as $key)

          <?php 

          $explode1 = explode('_', $key->form_number);

          $number1 = $explode1[2];

         ?>

          <div class="form-check box-text">

            <div class="col-sm-10 my-1">

            <label class="form-check-label" for="defaultCheck1">

              {{ucwords($key->menu_name)}} - {{ucwords($key->form_name)}} <!-- - {{ $number1 }} -->

            </label>

            </div>

           <div class="col-sm-2 my-1">

            <input class="form-check-input filtercheck" type="checkbox" value="{{ $key->id }}" id="rate_form" name="name1[]">

          </div>

            

          </div>

          @endforeach

        </div>



        <div class="col-sm-1"></div>

      </div>
      <!-- finnace  master -->

      <div style="text-align: center;padding-bottom: 5%;padding-top: 5%">

        <button type="submit" id="send_form" class="btn btn-primary"  disabled onclick="return validation();">Submit</button>

      </div>

      </form>

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

   <!--  <script src="{{ URL::asset('public/dist/js/pages/dashboard2.js') }}"></script> -->

    <!-- AdminLTE for demo purposes -->

    <script src="{{ URL::asset('public/dist/js/demo.js') }}"></script>

  </body>

</html>



<script type="text/javascript">

    $(window).on('load',function(){

        $('#exampleModal').modal('show');

         console.log( "ready!" );

      $(".select2").select2();



    });



   

    $(document).ready(function() {



       

      $('.filtercheck').change(function() {



         $('#send_form').removeAttr("disabled");



      });



    });

</script>

<script type="text/javascript">

  function validation()
  {

     var c=document.getElementsByTagName('input');

    for (var i = 0; i<c.length; i++){

        if (c[i].type=='checkbox')
        {
            if (c[i].checked)

            { return true }
          else{

             $("#msg").html('Please check atleast one').css({'color':'red','font-size':'16px'});

              return false

            }

        }

    }

    return false;

  }



</script>





@endsection