@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



@include('admin.include.sidebar')

<style type="text/css">
  .required-field::before {

    content: "*";

    color: red;

  }
  .showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }

  .rightcontent{

  text-align:right;


}

::placeholder {
  
  text-align:left;
}

.showinmobile{
  display: none;
}


.beforhidetble{
  display: none;
}
.popover{
    left: 92.4922px!important;
    width: 100%!important;
}
.setetxtintd{
    font-size: 12px !important;
    padding-top: 2% !important;
    padding-bottom: 2% !important;
}
.nameheading{
    font-size: 12px;
}
.setheightinput{
    height: 0%;
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


}


</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master General Ledger

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/Master/General-Ledger/Gl-Mast')}}">Master General Ledger</a></li>

            <li class="Active"><a href="{{ URL('/Master/General-Ledger/Gl-Mast')}}">Add General Ledger </a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-7">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add  General Ledger</h2>

              
              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/Master/General-Ledger/View-Gl-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View General Ledger</a>

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

            <form action="{{ url('form-glmast-save') }}" method="POST" >

               @csrf

               <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Company Code :</label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input list="comp_codeList"  id="comp_code" name="comp_code" class="form-control  pull-left " value="{{ old('comp_code')}}" placeholder="Select Company Code" maxlength="6" autocomplete="off">

                            <datalist id="comp_codeList">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($comp_list as $key)

                              <option value='<?php echo $key->COMP_CODE?>'   data-xyz ="<?php echo $key->COMP_NAME; ?>" ><?php echo $key->COMP_NAME ; echo " [".$key->COMP_CODE."]" ; ?></option>

                              @endforeach

                            </datalist>
                            <input type="hidden"id="comp_name" name="comp_name">
                        </div>  

                        <small>  

                          <div class="pull-left showSeletedName" id="comp_codeText"></div>

                       </small>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                  </div><!-- /.col -->

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                      General Ledger Type : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                          <input list="gltypeList" type="text" name="glsch_type" class="form-control" placeholder="Select General Ledger Type" style="z-index: 1;" id="glschType" autocomplete="off" value="{{old('glsch_type')}}" maxlength="12">

                         <datalist id="gltypeList">
                            <option value ="">--Select--</option>
                            <option value ="A" data-xyz="ASSETS">ASSETS</option>
                            <option value ="B" data-xyz="LIABILITIES">LIABILITIES</option>
                            <option value ="X" data-xyz="EXPENDITURES">EXPENDITURES</option>
                            <option value ="R" data-xyz="REVENUES">REVENUES</option>
                            <option value ="Z" data-xyz="OTHERS">OTHERS</option>
                         </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('glsch_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                        <small id="glschTypeName" class="showSeletedName"></small>  


                    </div>

                    <!-- /.form-group -->

                  </div>

                  <!-- /.col -->

              </div>

              <!-- /.row -->

              <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                        <label for="exampleInputEmail1">General Schedule Code : <span class="required-field"></span></label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input list="glsch_codeList"  id="glsch_code" name="glsch_code" class="form-control  pull-left " value="{{ old('glsch_code')}}" placeholder="Select General Schedule Code" maxlength="6" autocomplete="off">



                            <datalist id="glsch_codeList">

                              

                            </datalist>

                        </div>

                        <small id="glschCodeErr"></small>

                        <small>  

                          <div class="pull-left showSeletedName" id="glsch_codeText"></div>

                       </small>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('glsch_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       General Ledger Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">
                         
                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span> 

                         
                           <input type="text" class="form-control codeCapital" name="gl_code" value="{{old('gl_code')}}" placeholder="Enter General Ledger Code" id="gl_code_search" maxlength="6" autocomplete="off" readonly="">
                       
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('gl_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>

                  

              </div>

              <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       General Ledger Name : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="gl_name" value="{{old('gl_name')}}" placeholder="Enter General Ledger Name" maxlength="40" style="z-index: 1;" autocomplete="off">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('gl_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                   <div class="col-md-6">

                    <div class="form-group">

                      <label>

                      Account Tag : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="account_tag" value="Yes" id="accTYES">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio" class="optionsRadios1" name="account_tag" value="No" id="accTNo" checked="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('account_tag', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                      Cost Tag : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="cost_tag" value="Yes" id="costYES">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio" class="optionsRadios1" name="cost_tag" value="No" id="costNO" checked="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('cost_tag', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                      Asset Tag : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="asset_tag" value="Yes" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio" class="optionsRadios1" name="asset_tag" value="No" checked="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('assest_tag', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>
                
              </div>
              <div class="row">
                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Auto Posting : 

                      

                      </label>

                      <div class="input-group">

                         

                          <input type="radio" class="optionsRadios1" name="autoposting" value="1" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio" class="optionsRadios1" name="autoposting" value="0" checked="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        

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

      <div class="col-sm-3">
 
        <div class="box-tools pull-right hideinmobile">

          <a href="{{ url('/Master/General-Ledger/View-Gl-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View General Ledger </a>

        </div>

      </div>



    </div>

     

  </section>

</div>







@include('admin.include.footer')

<script type="text/javascript">

    $(document).ready(function(){ 

        $('#gl_code_search').on('input',function(){

          var glschCode = $('#glsch_code').val();
          var glCodeCr  = $('#gl_code_search').val();
          var glschCdLength = glschCode.length
          var glCdLength = glCodeCr.length

          if(glCdLength < glschCdLength){
            var newGlCd = glschCode;
            $('#gl_code_search').val(newGlCd);
          }
          
        });

        $("#comp_code").bind('change', function () {
          var val = $(this).val();
          var xyz = $('#comp_codeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
            $("#comp_code").val('');
            $("#comp_name").val('');
            $("#comp_codeText").html('');
          }else{
            $("#comp_codeText").html(msg);
            $("#comp_name").val(msg);
          }

        });

        $("#glsch_code").bind('change', function () {    

          var val = $(this).val();

          var xyz = $('#glsch_codeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
              $(this).val('');
              $('#gl_code_search').val('');
              // document.getElementById("glsch_codeText").innerHTML = ''; 
          }else{
              // document.getElementById("glsch_codeText").innerHTML = msg; 
              $(this).val(val+'['+msg+']');

              fungenGlCode(val);
              // $("#gl_code_search").val(val);
              var glschCode =  $('#glsch_code').val();

              var getFirstLetter = glschCode.charAt(0);

              if((getFirstLetter == 'A') || (getFirstLetter=='B')){
                $('#accTYES').prop('checked',true);
              }else{
                $('#accTNo').prop('checked',true);
              }

              if((getFirstLetter == 'R') || (getFirstLetter=='X')){
                $('#costYES').prop('checked',true);
              }else{
                $('#costNO').prop('checked',true);
              }
          }


        });
    });


    function fungenGlCode(gltype_code){

    var glschType = $('#glschType').val();
    // console.log('gltype_code',gltype_code);

    if(glschType){

      var splite_gl = glschType.split("[");
      var likename =  gltype_code;
      // console.log('likename',likename);
      var tbl_name = 'MASTER_GL';
      var col_code = 'GL_CODE';
    

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

       });

      $.ajax({

       url:"{{ url('/Master/generate-dyanamic-code') }}",

       data: {likename:likename,tbl_name:tbl_name,col_code:col_code},

        success:function(data){
          var data1 = JSON.parse(data);

          if(data1.response == 'success'){

            var newcode = data1.data;
            
            if(newcode != '' || newcode != null){
              $('#gl_code_search').val(newcode);
            }else{
              $('#gl_code_search').val('');
            }

          }
        },error:function(){

        }
      });

    }
    
    
  }
</script>


<script type="text/javascript">
  $(document).ready(function(){
  
    $("#glschType").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#gltypeList option').filter(function() {

          return this.value == val;

        }).data('xyz');
        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){

            $(this).val('');
            $('#glschTypeName').html('');
            $('#glsch_code').val('');
            $('#gl_code_search').val('');
            
        }else{

            // $('#glschTypeName').html(msg);
            $('#glschType').val(val+'['+msg+']');

            $.ajaxSetup({

              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
     
           });

           $.ajax({

                url:"{{ url('/Master/GL/List-GL-Schedule') }}",

                 data: {gltypeCode: val},

                 success:function(data){

                   var data1 = JSON.parse(data);

                    if(data1.response == 'success'){

                    var count_data = data1.data.length;

                    if(count_data > 0){
                        
                        $("#glsch_codeList").empty();
                        $("#glsch_code").prop('readonly',false);
                        $("#glschCodeErr").html('');

                      $.each(data1.data, function(k, getdata){

                        $("#glsch_codeList").append($('<option>',{

                          value:getdata.GLSCH_CODE ,

                          'data-xyz':getdata.GLSCH_NAME,
                          text:getdata.GLSCH_NAME

                        }));

                      });
                     
                    }else{

                       $("#glsch_codeList").empty();
                       $("#gl_code_search").val('');
                       $("#glsch_code").val('');
                       $("#glsch_code").prop('readonly',true);
                       // $("#gl_code_search").val('');
                       $("#glschCodeErr").html('*General Schedule Code List Not Available...!').css('color','red');
                       // console.log('Not');
                    }

                   }else if(data1.response == 'list_not_available'){
                    // console.log('list_not_available');


                   }else{

                   }
                  }
            });
        }
    
    });

  });
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('.Number').keypress(function (event) {
      var keycode = event.which;
      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
          event.preventDefault();
      }
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