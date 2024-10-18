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
  .rightcontent{

  text-align:right;


}

::placeholder {
  
  text-align:left;
}
.showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }
  .Custom-Box {

    /*border: 1px solid #e0dcdc;

    border-radius: 10px;

*/    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }
  .showinmobile{
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

  @media screen and (max-width: 600px) {

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

            New Master FY

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/form-mast-fy') }}">Master FY</a></li>

            <li class="active"><a href="{{ url('/form-mast-fy') }}">Add FY</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add New FY</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/Master/Setting/Fy-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View FY</a>

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

            <form action="{{ url('form-mast-new-fy-save') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Company Code : 

                        <span class="required-field"></span>
                        <span style="font-size: 11px;"> ( Put * for all Companies )</span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                            <?php 
                              $compName = Session::get('company_name');
                              $compName = Session::get('company_name');
                              $spliComp = explode('-',$compName);
                              $mcompcode = $spliComp[0];
                              $explode = explode('-', $compName);
                              $com_code = $explode[0];
                            ?>

                           <input type="text" class="form-control" name="company_code" oninput="getCompCode(this.value)" id="company_code" value="" placeholder="Enter Company Code" autocomplete="off" maxlength="6">

                           <input type="hidden" name="mcomp_code" id="mcomp_codeId" value="{{$mcompcode}}" />

                        </div>
                           <div class="pull-left showSeletedName" id="companyText"></div>
                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                          <small id="checkCompCode" style="color:red;font-size:12px;"></small>


                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        FY Code: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-code"></i></span>

                           <?php 

                                $fisYear   =  Session::get('macc_year'); 

                                $GetYear = explode('-', $fisYear);
                               
                                $firstyear = $GetYear[0] + 1;
                                $lastyear = $GetYear[1] + 1;

                                $nextyr = $firstyear.'-'.$lastyear;

                                $fromDate = '01-04'.'-'.$firstyear;
                                $toDate = '31-03'.'-'.$lastyear;

                           ?>

                          <input type="text" class="form-control" name="fy_code" id="fy_code" value="{{ $nextyr }}" placeholder="Enter FY Code" maxlength="9" readonly="">

                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>
                      </div> 
                      
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fy_code', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        FY From Date : 

                        <span class="required-field"></span>

                      </label>


                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>

                          <input type="text" class="form-control  rightcontent" name="fy_from_date" value="{{ $fromDate }}" placeholder="Enter From Date" maxlength="12" readonly>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fy_from_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                

                 <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        FY To Date: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>

                          <input type="text" class="form-control  rightcontent" name="fy_to_date" value=" {{ $toDate }}" placeholder="Enter To Date" maxlength="12" readonly="">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fy_to_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

              </div>



              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-2 hideinmobile">

        <div class="box-tools pull-right">

          <a href="{{ url('/Master/Setting/View-Fy-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View FY</a>

        </div>

      </div>



    </div>

     

  </section>

</div>



@include('admin.include.footer')
<script type="text/javascript">
  $(document).ready(function(){
    $('#fy_code').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var fy_code = $('#fy_code').val();

        if(fy_code == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-fy-code') }}",

             method : "POST",

             type: "JSON",

             data: {fy_code: fy_code},

             success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                       var objcity = data1.data;
                       $('#shoemsgonin').html('');
                       $('#showSearchCodeList').show();
                          $('#showSearchCodeList').empty();
                         $.each(objcity, function (i, objcity) {
                           $('#showSearchCodeList').append('<span class="custom-option">'+
                            objcity.fy_code+'</span><br>');
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

  function getCompCode(compCode) {

    console.log('compcode',compCode);

    var compLength = compCode.length;

    var mcompcode = $('#mcomp_codeId').val();

    if (compLength==2 && compCode==mcompcode) {

      /* Do Nothing */

    }else if(compCode=='*'){

      /* Do Nothing */

    }else{

      if (compLength>=2) {
        $('#company_code').val('');
        $('#checkCompCode').html('*Invalid Company Code...!');
      }else{

      }

    }
   
  }

 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Depot Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var HelpFyCode = $('#fycodeH').val();

         // alert(HelpFyCode);return false;

           if(HelpFyCode == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-fy-code-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {HelpFyCode: HelpFyCode},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Depot Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.fy_code+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.comp_code+'</td></tr>');
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
          $('.popover').fadeOut();
    })
  });
</script>

<script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script>
<script type="text/javascript">

  

  $(document).ready(function() {

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      
      autoclose: 'true'

    });

});

</script>
<script type="text/javascript">
  $(document).ready(function() {

  jQuery.extend(jQuery.expr[':'], {
    focusable: function (el, index, selector) {
        return $(el).is('a, button, :input, [tabindex]');
    }
});

$(document).on('keypress', 'input,select', function (e) {
    if (e.which == 13) {
        e.preventDefault();
        // Get all focusable elements on the page
        var $canfocus = $(':focusable');
        var index = $canfocus.index(document.activeElement) + 1;
        if (index >= $canfocus.length) index = 0;
        $canfocus.eq(index).focus();
    }
});




});


</script>
@endsection