@extends('admin.main')



@section('AdminMainContent')


@include('admin.include.header')




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

  .showSeletedName{



    font-size: 15px;



    margin-top: 2%;
    margin-bottom: 2%;



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



            Master General Ledger Balance



            <small>Add Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Master</a></li>



            <li class="active"><a href="{{ url('/Master/General-Ledger/Gl-Bal-Mast') }}">Master General Ledger Balance</a></li>



            <li class="active"><a href="{{ url('/Master/General-Ledger/Gl-Bal-Mast') }}">Add General Ledger Balance</a></li>



          </ol>



        </section>



	<section class="content">



    <div class="row">



      <div class="col-sm-1"></div>



      <div class="col-sm-8">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add General Ledger Balance </h2>

              <div class="box-tools pull-right showinmobile">

                  <a href="{{ url('/Master/General-Ledger/View-Gl-Bal-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View  General Ledger Balance</a>

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



                       Company Name: 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>





                            <input type="text"  id="comp_code" name="comp_code" class="form-control  pull-left" value="{{ $compCode }}" autocomplete="off" placeholder="Select Company Name" maxlength="11" readonly="">



                          <!-- <datalist id="compList">

                          

                           

                             <option value="">--SELECT--</option>

                             @foreach($comp_list as $key)



                             <option value="{{ $key->COMP_CODE }}" data-xyz ="{{ $key->COMP_NAME }}">{{ $key->COMP_CODE }} = {{ $key->COMP_NAME }}</option>



                             @endforeach

                          </datalist> -->



                        </div>

                        <div class="pull-left showSeletedName" id="compText">{{$comp_name}}</div>
                        <input type="hidden" id="comp_name" name="comp_name" value="{{$comp_name}}">



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Fy Code : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>

                          <input type="text"  id="fy_code" name="fy_code" class="form-control  pull-left" value="{{$fisYear}}" placeholder="Select Fy Code" maxlength="11" readonly="" autocomplete="off">

                        

                          <!-- <datalist id="fyList">



                             <option value="">--SELECT--</option>

                             @foreach($fy_list as $row)

                            <option value="{{ $row->FY_CODE }}" data-xyz ="{{ $row->FY_CODE }}" >{{ $row->FY_CODE }}</option>



                             @endforeach

                           </datalist> -->



                      </div>

                      <div class="pull-left showSeletedName" id="fyText"></div>

                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('fy_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                </div>

               <div class="row">



                



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       Profit Center Code: 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>



                            <?php $pfctcnt = count($pfct_list); ?>

                            <input list="pfctList"  id="pfct_code" name="pfct_code" class="form-control  pull-left" value="<?php if($pfctcnt == 1){echo $pfct_list[0]->PFCT_CODE;}else{} ?>" placeholder="Select Profit Center Code" maxlength="11" autocomplete="off">



                          <datalist id="pfctList">

                          

                           

                             <option value="">--SELECT--</option>

                             @foreach($pfct_list as $key)



                             <option value="{{ $key->PFCT_CODE }}" data-xyz ="{{ $key->PFCT_NAME }}">{{ $key->PFCT_CODE }} = {{ $key->PFCT_NAME }}</option>



                             @endforeach

                          </datalist>



                        </div>
                        <input type="hidden" id="pfct_name" name="pfct_name" value="">
                        <div class="pull-left showSeletedName" id="pfctText"></div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('pfct_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        General Ledger Code : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-desc"></i></span>
                          <?php $glcount = count($gl_list); ?>
                          <input list="glList"  id="gl_code" name="gl_code" class="form-control  pull-left" value="{{ old('gl_code')  }}<?php if($glcount == 1){echo $gl_list[0]->GL_CODE;}else{echo old('gl_code');} ?>" placeholder="Select General Ledger Code" maxlength="11" autocomplete="off">
                          
                        

                          <datalist id="glList">



                             <option value="">--SELECT--</option>

                             @foreach($gl_list as $row)

                            <option value="{{ $row->GL_CODE }}" data-xyz ="{{ $row->GL_NAME }}" >{{ $row->GL_CODE }} = {{ $row->GL_NAME }}</option>



                             @endforeach

                           </datalist>

                           <input type="hidden" id="gl_name" name="gl_name" value="">

                      </div>

                      <div class="pull-left showSeletedName" id="glText"></div>

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


                       YROPDR Amt: 


                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>





                            <input  id="pdr_code" name="pdr_code" class="form-control  pull-left rightcontent" value="{{ old('pdr_code')  }}"placeholder="Enter YROPDR Code" autocomplete="off">



                          



                        </div>

                       



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('pdr_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        YROPCR Amt: 





                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-desc"></i></span>



                          <input  id="pcr_code" name="pcr_code" class="form-control  pull-left rightcontent" value="" placeholder="Enter YROPCR Code" value="{{ old('pcr_code')  }}" autocomplete="off">

                        



                      </div>

                      

                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('pcr_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                </div>



                

                <!-- /.col -->







              <!-- /.row -->





              <!-- /.row -->





              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">



                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  {{ $button }}





                 </button>



              </div>



            </form>



          </div><!-- /.box-body -->



           



          </div>



      </div>



      <div class="col-sm-3 hideinmobile">



        <div class="box-tools pull-right">



          <a href="{{ url('/Master/General-Ledger/View-Gl-Bal-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View General Ledger Balance</a>



        </div>



      </div>







    </div>



     



	</section>



</div>







@include('admin.include.footer')



<script type="text/javascript">



    $(document).ready(function(){


      $( window ).on( "load", function() {

        var pfctcode = $('#pfct_code').val();

          var pfctcodelist = $('#pfctList option').filter(function() {

          return this.value == pfctcode;

          }).data('xyz');

          var msgpfct = pfctcodelist ?  pfctcodelist : 'No Match';

          if(msgpfct == 'No Match'){
            $('#pfct_code').val('');
            $('#pfct_name').val('');
            document.getElementById("pfctText").innerHTML = '';
          }else{
            $('#pfct_name').val(msgpfct);
          document.getElementById("pfctText").innerHTML = msgpfct; 
          }

        var glcode = $('#gl_code').val();

          var glodelist = $('#glList option').filter(function() {

          return this.value == glcode;

          }).data('xyz');

          var msggl = glodelist ?  glodelist : 'No Match';

          if(msggl == 'No Match'){
            $('#gl_code').val('');
            document.getElementById("glText").innerHTML = '';
          }else{

          document.getElementById("glText").innerHTML = msggl; 
          }

      });



        $("#comp_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#compList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



          document.getElementById("compText").innerHTML = msg; 



        });



        $("#fy_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#fyList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



          document.getElementById("fyText").innerHTML = msg; 



        });



         $("#pfct_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#pfctList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
            $('#pfct_code').val('');
            $('#pfct_name').val('');
            document.getElementById("pfctText").innerHTML = '';
          }else{
            $('#pfct_name').val(msg);
          document.getElementById("pfctText").innerHTML = msg; 
          }




        });

         $("#gl_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#glList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);
          if(msg == 'No Match'){
            $('#gl_code').val('');
            $('#gl_name').val('');
            document.getElementById("glText").innerHTML = '';
          }else{
             $('#gl_name').val(msg);
          document.getElementById("glText").innerHTML = msg; 
          }




        });



    });

</script>

<script type="text/javascript">

  $(document).ready(function(){

$("#pdr_code").on('input', function(event) {



  var pdrcode = $("#pdr_code").val();

  console.log(pdrcode);



  if(pdrcode!=''){

    $("#pcr_code").prop('disabled', true);

  }else{

    $("#pcr_code").prop('disabled', false);

  }

  

    });



$("#pcr_code").on('input', function(event) {



  var pdrcode = $("#pcr_code").val();

  console.log(pdrcode);



  if(pdrcode!=''){

    $("#pdr_code").prop('disabled', true);

  }else{

    $("#pdr_code").prop('disabled', false);

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