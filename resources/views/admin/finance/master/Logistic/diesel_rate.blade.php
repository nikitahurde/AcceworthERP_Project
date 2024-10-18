@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



@include('admin.include.sidebar')



<style type="text/css">

  .PageTitle{

    margin-right: 1px !important;

  }

 .required-field::before {

    content: "*";

    color: red;

  }

  .Custom-Box {

    /*border: 1px solid #e0dcdc;

    border-radius: 10px;

*/    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

      .setheightinput{
    height: 0%;
  }
  .nameheading{
    font-size: 12px;
  }
  .setetxtintd{
    font-size: 12px !important;
    padding-top: 2% !important;
    padding-bottom: 2% !important;
  }

  .beforhidetble{
    display: none;
  }

 .custom-options {
     position: absolute;
     display: block;
     top: 100%;
     left: 0;
     right: 0;
     border-top: 0;
     background: #f3eded;
     transition: all 0.5s;
     opacity: 0;
     visibility: hidden;
     pointer-events: none;
     z-index: 2;
     -webkit-box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
     -moz-box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
     box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
}
 .custom-select .custom-options {
     opacity: 1;
     visibility: visible;
     pointer-events: all;
}
 .custom-option {
    position: relative;
    display: block;
    padding-top: 10px;
    padding-left: 21%;
    font-size: 14px;
    font-weight: 600;
    color: #3b3b3b;
    line-height: 2px;
    cursor: pointer;
    transition: all 0.5s;
}
 
.CloseListDepot{
  display: none;
}
.CloseListDepot{
  display: none;
}
.popover{
    left: 2.4922px!important;
    width: 169%!important;
}
.showinmobile{
  display: none;
}

 @media screen and (max-width: 600px) {

  .popover {
    left: 56.4922px!important;
    width: 100%!important;
  }
  .setheightinput{
    width: 65%!important;
  }
  #serachcode{
    margin-left: 5%!important;
  }
  .showinmobile{

    display: block;

  }
  .PageTitle{
    float: left;
  }
  .hideinmobile{
    display: none;
  }


}

</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master Diesel Rate

            <?php if($button == 'Update') { ?>

                <small>Update Details</small>

            <?php }else{ ?>

               <small>Add  Details</small>

            <?php } ?>

          

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>
            <li><a href="{{ URL('/form-mast-manufacturing')}}">Master Diesel Rate</a></li>
            <?php if($button == 'Update') { ?>
              <li class="active">
                <a href="{{ URL('/form-mast-manufacturing')}}" >Update  Diesel Rate </a>
              </li>

            <?php }else{ ?>

             <li class="active">
              <a href="{{ URL('/form-mast-manufacturing')}}" >Add  Diesel Rate </a>
             </li>


            <?php } ?>
            
          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">
              
              <?php if($button == 'Update'){ ?>
                 <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update  Diesel Rate</h2>
              <?php }else{ ?>

                   <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add  Diesel Rate</h2>
              <?php } ?>
             
 
              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-diesel-rate-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Diesel Rate</a>

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

            <form action="{{ url($action) }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Date : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                           <?php 

                                if($date){
                                  $getdate = $date;
                                }else{
                                  $getdate =  date("d-m-Y");
                                }
                                

                          ?>

                          <input type="text" class="form-control datepicker" name="date" value="{{ $getdate }}" placeholder="Enter Date" id="date">
                          <input type="hidden" class="form-control" name="id" value="{{ $id }}">

                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>

                          

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('date', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>




                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Diesel Rate: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-money"></i></span>

                          <input type="text" class="form-control" name="diesel_rate" value="{{ $diesel_rate }}" placeholder="Enter Diesel Rate" maxlength="15">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('diesel_rate', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                

                  

              </div>

              <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Petrol Rate: 

                        

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-money"></i></span>

                          <input type="text" class="form-control" name="petrol_rate" value="{{  $petrol_rate }}" placeholder="Enter Petrol Rate" maxlength="15">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('petrol_rate', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>


                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Gas Rate: 

                        

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-money"></i></span>

                          <input type="text" class="form-control" name="gas_rate" value="{{ $gas_rate }}" placeholder="Enter Gas Rate" maxlength="15">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('gas_rate', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

               
                
              </div>

              <div class="row">

                 <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Electricity Rate: 

                       

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-lightbulb-o"></i></span>

                          <input type="text" class="form-control" name="electronic_rate" value="{{ $electronic_rate }}" placeholder="Enter Electricity Rate" maxlength="15">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('electronic_rate', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                
              </div>

              <!-- /.row -->



              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{ $button }} 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-2 hideinmobile">

        <div class="box-tools pull-right">

                <a href="{{ url('/view-diesel-rate-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Diesel Rate</a>

              </div>

      </div>



    </div>

     

  </section>

</div>







@include('admin.include.footer')







<script type="text/javascript">

  

  $(document).ready(function() {

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

    });

});

</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#vehiclemfgSearch').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var vehiclemfgSearch = $('#vehiclemfgSearch').val();
        //console.log(depot_code_search);

        if(vehiclemfgSearch == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-vehicle-mfg-code') }}",

             method : "POST",

             type: "JSON",

             data: {vehiclemfgSearch: vehiclemfgSearch},

             success:function(data){

                 console.log(data);
                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                       var objcity = data1.data;
                       //$('#shoemsgonin').html('');
                       $('#showSearchCodeList').show();
                          $('#showSearchCodeList').empty();
                         $.each(objcity, function (i, objcity) {
                           $('#showSearchCodeList').append('<span class="custom-option">'+
                            objcity.vehicle_mfg_code+'</span><br>');
                         });
                        
                  }
             }

          });
       }

    });

    $("body").click(function() {
        $("#showSearchCodeList").hide("fast");
    });
  });
</script>

<script type="text/javascript">
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Vehicle Mfg Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
        html:true,
        content:  $('#myForm').html()
    }).on('click', function(){
      // had to put it within the on click action so it grabs the correct info on submit
      $('#serachcode').click(function(){

           $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

           });

          var HelpMfgCode = $('#vehiclmfgNameH').val();

          if(HelpMfgCode == ''){
            $('#HideWhenSearch').show();
            $('#ShowWhenSeaech').hide();
            $('#errorItem').html('');
          }else{

             $.ajax({

                url:"{{ url('help-vehicle-mfg-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {HelpMfgCode: HelpMfgCode},

                 success:function(data){

                     // console.log(data);
                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Company Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;
                          
                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.vehicle_mfg_code+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.vehicle_mfg_name+'</td></tr>');
                             });
                      }
                 }

              });
          }
      })
  })
})
</script>

<script type="text/javascript">
  $(document).ready(function(){
     $('body').on('click', '#closeModel', function () {
       // console.log('hii');
          $('.popover').fadeOut();
    })
  });
</script>

<script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script>

@endsection