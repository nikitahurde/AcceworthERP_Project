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

    font-size: 12px;

    margin-top: 1%;

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
.setetxtintd{
  font-size: 12px;
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

            Master FY

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/form-mast-fy') }}">Master FY</a></li>

            <li class="active"><a href="{{ url('/form-mast-fy') }}">Add  FY</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add  FY</h2>

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

            <form action="{{ url('form-mast-fy-save') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Company Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                           <input list="compList" type="text" class="form-control" name="company_code" id="company_code" value="{{old('company_code')}}" placeholder="Enter Company Code" maxlength="6" autocomplete="off">
                          <datalist id="compList">
                          
                           <option value="">--SELECT COMPANY CODE--</option>
                           @foreach($comp_code as $row)
                            <option data-xyz ="<?php echo $row->COMP_NAME; ?>" value="{{ $row->COMP_CODE }}"> {{ $row->COMP_NAME}} [{{ $row->COMP_CODE }}]</option>
                          @endforeach
                          </datalist>

                        </div>
                           <div class="pull-left showSeletedName" id="companyText"></div>
                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>FY Code:  <span class="required-field"></span></label>
                      <label id="fyFormate" style="color:red;"></label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control Number" name="fy_code" id="fy_code" value="{{old('fy_code')}}" placeholder="Enter FY Code" maxlength="9">

                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>
                          
                          <span class="input-group-addon" style="padding: 1px 7px;">
                            
                            <div class="">
                                <button type="button" id="login" class="btn btn-xs btn-info gly-radius"> <i class="fa fa-info" aria-hidden="true"></i></button>
                            </div>
                            <div id="myForm" class="hide">
                                 <div class="row">
                                      <div class="col-md-9">
                                        <input type="text" name="fycodeH" id="fycodeH" class="form-control input-md setheightinput" style="text-transform: uppercase;">
                                      </div>
                                      <div class="col-md-3" style="margin-left: -7%;">
                                        
                                        <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                <div id="result">
                                <table class="table table-bordered" style="margin-top: 3%;width: 220px" id="HideWhenSearch">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">FY Code Code</th>
                                     <th class="nameheading">Comp Code</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($help_fy_list as $key) { ?>

                                      <tr>
                                        <td class="setetxtintd"><?php echo $key->FY_CODE; ?></td>
                                        <td class="setetxtintd"><?php echo $key->COMP_CODE; ?></td>
                                      </tr>
                                     
                                    <?php } ?>
                                      
                                  </tbody>
                                </table>

                                <table class="table table-bordered beforhidetble" style="margin-top: 3%;width: 220px;display: none;" id="ShowWhenSeaech">
                                  <thead>
                                    <tr>
                                      <th class="nameheading">FY Code Code</th>
                                     <th class="nameheading">Comp Code</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                  </tbody>
                                </table>
                                <span id="errorItem"></span>

                            </div>
                            </div>
                            
                          </span>


                          
                            
                          

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

                          <input type="text" class="form-control datepicker rightcontent" name="fy_from_date" value="{{old('fy_from_date')}}" placeholder="Enter From Date" maxlength="12" autocomplete="off">

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

                          <input type="text" class="form-control datepicker rightcontent" name="fy_to_date" value="{{old('fy_to_date')}}" placeholder="Enter To Date" maxlength="12" autocomplete="off">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fy_to_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

              </div>



              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary" id="submitBTN">

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

    $('.Number').keypress(function (event) {
        var keycode = event.which;
        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
            event.preventDefault();
        }
        if (keycode == 46 || this.value.length==11) {
        return false;
      }
    });

    $('#fy_code').on('input',function(){

      var fycCode = $('#fy_code').val();
      var first4 = fycCode.length;
      if(first4 < 4){
        $('#fyFormate').html('Formate -: YYYY - YYYY');
        $('#submitBTN').prop('disabled',true);
      }else{
        
        var fy_Code = $('#fy_code').val();
        var fyform = fy_Code.replace(/(\d{4})(?=\d)/g, '$1-');
        $('#fy_code').val(fyform);

        var newFyCd = $('#fy_code').val();
        var splitFy = newFyCd.split('-');
        if(splitFy[1]){
          var last4 = splitFy[1].length;
          if(last4 < 4){
            $('#fyFormate').html('Formate -: YYYY - YYYY');
            $('#submitBTN').prop('disabled',true);
          }else{
            $('#fyFormate').html('');
            $('#submitBTN').prop('disabled',false);
          }
        }
        
      }
      
     
      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var fy_code = $('#fy_code').val();
      var compCode = $('#company_code').val();

        if(fy_code == ''){

           $('#showSearchCodeList').hide();

        }else{

          $.ajax({

            url:"{{ url('search-fy-code') }}",

             method : "POST",

             type: "JSON",

             data: {fy_code: fy_code,compCode:compCode},

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
                            objcity.FY_CODE+'</span><br>');
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
          var compCode = $('#company_code').val();

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

                 data: {HelpFyCode: HelpFyCode,compCode:compCode},

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
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.FY_CODE+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.COMP_CODE+'</td></tr>');
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


      $("#company_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#compList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $('#companyText').html('');
        }else{
          $('#companyText').html(msg);

        }

      });

});


</script>
@endsection