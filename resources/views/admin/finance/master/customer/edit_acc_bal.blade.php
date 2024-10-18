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

  .showSeletedName{



    font-size: 12px;



    margin-top: 2px;



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
.creditCls{
  display: none;
}
.SubmitBtn{
  display: none;
}
</style>







<div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



            Master Account Balance



            <small>Update Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Master</a></li>



            <li class="active"><a href="{{ url('/Master/Customer-Vendor/Edit-Acc-Balence-Mast') }}"> Master Account Balance
            </a></li>



            <li class="active"><a href="{{ url('/Master/Customer-Vendor/Edit-Acc-Balence-Mast') }}">Update Account Balance
            </a></li>



          </ol>



        </section>



	<section class="content">



    <div class="row">



      <div class="col-sm-1"></div>



      <div class="col-sm-8">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Account Balance </h2>


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



                          <span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="true"></i></span>





                            <input list="compList"  id="comp_code" name="comp_code" class="form-control  pull-left" value="{{ $accbal_list->COMP_CODE }}" placeholder="Select Company Name">

                            <input type="hidden"  id="comp_name" name="emp_comp_name" readonly>



                          <datalist id="compList">

                          

                           

                             <option value="">--SELECT--</option>

                             @foreach($comp_list as $key)



                             <option value="{{ $key->COMP_CODE }}" data-xyz ="{{ $key->COMP_NAME }}">{{ $key->COMP_CODE }} = {{ $key->COMP_NAME }}</option>



                             @endforeach

                          </datalist>



                        </div>

                        <div class="pull-left showSeletedName" id="compText">{{ $accbal_list->COMP_NAME }}</div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Fy Year : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>

                          

                        

                         <select id="fy_code" name="fy_code" class="form-control">

                            <option value="{{ $accbal_list->FY_CODE }}">{{ $accbal_list->FY_CODE }}</option>

                          </select>



                      </div>

                      

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



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i></span>





                            <input list="pfctList"  id="pfct_code" name="pfct_code" class="form-control  pull-left" value="{{ $accbal_list->PFCT_CODE }}" placeholder="Select Center Code" autocomplete="off">

                             <input type="hidden"  id="pfct_name" name="emp_pfct_name" readonly>




                          <datalist id="pfctList">

                          

                           

                             <option value="">--SELECT--</option>

                             @foreach($pfct_list as $key)



                             <option value="{{ $key->PFCT_CODE }}" data-xyz ="{{ $key->PFCT_NAME }}">{{ $key->PFCT_CODE }} = {{ $key->PFCT_NAME }}</option>



                             @endforeach

                          </datalist>
                          <input type="hidden" id="pfct_name" name="pfct_name" value="{{ $accbal_list->PFCT_NAME }}">


                        </div>

                        <div class="pull-left showSeletedName" id="pfctText">{{ $accbal_list->PFCT_NAME }}</div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('pfct_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Account Code : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input list="accList"  id="acc_code" name="acc_code" class="form-control  pull-left" value="{{ $accbal_list->ACC_CODE }}" placeholder="Select Acc Code" >

                          <input type="hidden"  id="acc_name" name="emp_acc_name" readonly>

                        

                          <datalist id="accList">



                             <option value="">--SELECT--</option>

                             @foreach($acc_list as $row)

                            <option value="{{ $row->ACC_CODE }}" data-xyz ="{{ $row->ACC_NAME }}" >{{ $row->ACC_CODE }} = {{ $row->ACC_NAME }}</option>



                             @endforeach

                           </datalist>



                      </div>

                      <div class="pull-left showSeletedName" id="accText">{{ $accbal_list->ACC_NAME }}</div>

                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('acc_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                </div>

                <div class="row">



                



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       YROPDR Code:<span class="required-field" id="yearopendebit"></span> 





                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>





                            <input  id="pdr_code" name="pdr_code" class="form-control  pull-left rightcontent" value="{{ $accbal_list->YROPDR ?? '' }}" placeholder="Enter YROPDR Code" autocomplete="off">



                          



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



                        YROPCR Code: <span class="required-field creditCls" id="yearopencrebit" ></span>





                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-money"></i></span>



                          <input  id="pcr_code" name="pcr_code" class="form-control  pull-left rightcontent" value="{{ $accbal_list->YROPCR ?? '' }}" placeholder="Enter YROPCR Code" autocomplete="off">

                        



                      </div>

                      

                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('pcr_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>
                  <center><span id="showanyoneReq"></span></center>
                </div>



                <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Block Account Balance: 

                        <span class="required-field"></span>

                      </label>

                     
                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="acc_bal_block" value="YES" <?php if($accbal_list->ACCBAL_BLOCK=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="acc_bal_block" value="NO" <?php if($accbal_list->ACCBAL_BLOCK=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO


                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                  </div>
                </div>



                

                <!-- /.col -->







              <!-- /.row -->





              <!-- /.row -->





              <div style="text-align: center;">



                <input type="hidden" name="accbal_id" id="accbal_id" value="<?php echo $accbal_list->FY_CODE.'~'.$accbal_list->COMP_CODE.'~'.$accbal_list->ACC_CODE; ?>">

                 <button type="button" class="btn btn-primary SaveBtn" id="submitData"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  Update</button>

                 <button type="Submit" class="btn btn-primary SubmitBtn" id="finalBtn">



                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  {{ $button }}





                 </button>



              </div>



            </form>



          </div><!-- /.box-body -->



           



          </div>



      </div>



      <div class="col-sm-3">



        <div class="box-tools pull-right">



          <a href="{{ url('/Master/Customer-Vendor/View-Acc-Balence-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Account Balance</a>



        </div>



      </div>







    </div>



     



	</section>



</div>







@include('admin.include.footer')



<script type="text/javascript">



    $(document).ready(function(){


         $("#comp_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#compList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



         

          if(msg == 'No Match'){

            document.getElementById("compText").innerHTML = '';
           $('#comp_name').val('');

          }else{

           document.getElementById("compText").innerHTML = msg; 
           $('#comp_name').val(msg);
          }



        });



        $("#fy_code").bind('change', function () {  

          var val = $(this).val();

          var vrDate = val.split("-");

          var startvrDate = '1-04-'+vrDate[0];
          var endvrDate ='31-03-'+vrDate[1];

          $('.transdatepicker').datepicker({

            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            todayHighlight: 'true',
            startDate :startvrDate,
            endDate : endvrDate,
            autoclose: 'true'
          });

        });



        
         $("#pfct_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#pfctList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){ 
            $('#pfct_name').val('');
            document.getElementById("pfctText").innerHTML = '';
          }else{
            $('#pfct_name').val(msg);
          document.getElementById("pfctText").innerHTML = msg; 
          }



          //alert(msg+xyz);






        });

         $("#acc_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
            $(this).val('');
            document.getElementById("accText").innerHTML = ''; 
            $('#acc_name').val('');
            $('#accclass_code').val('');
            $('#acctype_code').val('');
          }else{
           document.getElementById("accText").innerHTML = msg; 

           var accountcode =  $('#acc_code').val();

           $('#acc_name').val(msg);

          }




        });



    });

</script>



<script type="text/javascript">



  

      $("#comp_code" ).change(function() {



           $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        

      var comp_code = $("#comp_code").val();

      //alert(comp_code);return false;





      $.ajax({

        url: "{{ url('/finance/get_year') }}",

        method : 'POST',

        type: 'JSON',

        data: {comp_code: comp_code},

      })

      .done(function(data) {

        //alert(data);return false;



       // var obj = $.parseJSON(data);

        console.log(data);



        $("#fy_code").html(data);



      })

    

    });



</script>



<script type="text/javascript">

$(document).ready(function(){

$(window).load(function() {
 
  var pdrcode = $("#pdr_code").val();

  if(pdrcode!=''){

    $("#pcr_code").prop('disabled', true);
     $("#yearopencrebit").addClass('creditCls');
     $("#yearopendebit").show();
     // $('#submitData').hide(); 
     // $('#finalBtn').removeClass('SubmitBtn');
  }else{

    $("#pcr_code").prop('disabled', false);
    // $('#submitData').show(); 
    // $('#finalBtn').addClass('SubmitBtn');

  }

  var pcr_code = $("#pcr_code").val();

  console.log(pdrcode);



  if(pcr_code!=''){

    $("#pdr_code").prop('disabled', true);
    $("#yearopencrebit").removeClass('creditCls');
    $("#yearopendebit").hide();
    // $('#submitData').hide(); 
    // $('#finalBtn').removeClass('SubmitBtn');
     $('#submitData').hide(); 
     // $('#finalBtn').removeClass('SubmitBtn');
     $('#finalBtn').show();
  }else{

    $("#pdr_code").prop('disabled', false);
    // $('#submitData').show(); 
    // $('#finalBtn').addClass('SubmitBtn');
    $('#submitData').show(); 
    $('#finalBtn').hide(); 

  }
  // $('#submitData').hide(); 
  // $('#finalBtn').show();
});


$("#pdr_code").on('input', function(event) {



  var pdrcode = $("#pdr_code").val();

  console.log(pdrcode);



  if(pdrcode!=''){

    $("#pcr_code").prop('disabled', true);
     $("#yearopencrebit").addClass('creditCls');
     $("#yearopendebit").show();
     $('#submitData').hide(); 
     // $('#finalBtn').removeClass('SubmitBtn');
     $('#finalBtn').show();
  }else{

    $("#pcr_code").prop('disabled', false);
    $('#submitData').show(); 
    $('#finalBtn').hide(); 
    // $('#finalBtn').addClass('SubmitBtn');

  }

  

    });



$("#pcr_code").on('input', function(event) {



  var pdrcode = $("#pcr_code").val();

  console.log(pdrcode);



  if(pdrcode!=''){

    $("#pdr_code").prop('disabled', true);
    $("#yearopencrebit").removeClass('creditCls');
    $("#yearopendebit").hide();
    // $('#submitData').hide(); 
    // $('#finalBtn').removeClass('SubmitBtn');
     $('#submitData').hide(); 
     // $('#finalBtn').removeClass('SubmitBtn');
     $('#finalBtn').show();
  }else{

    $("#pdr_code").prop('disabled', false);
    // $('#submitData').show(); 
    // $('#finalBtn').addClass('SubmitBtn');
    $('#submitData').show(); 
    $('#finalBtn').hide(); 

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

$('#submitData').on('click',function(){
       var debitAmt =  $('#pdr_code').val();
       console.log('debitAmt',debitAmt);
       var creditAmt =  $('#pcr_code').val();
        console.log('creditAmt',creditAmt);
       
       // if($.trim(debitAmt)=='' || $.trim(creditAmt)==''){
       //    $('#showanyoneReq').html('YROPDR Amt or YROPCR Amt field is required ').css({'color':'red','text-align':'center'});
       // }  

       // if($.trim(debitAmt)!='' && $.trim(creditAmt)=='' || $.trim(debitAmt)=='' && $.trim(creditAmt)!='' ){
         
       // }else if($.trim(debitAmt)=='' && $.trim(creditAmt)=='' ){
       //   $('#showanyoneReq').html('YROPDR Amt or YROPCR Amt field is required ').css({'color':'red','text-align':'center'});
       // }else{

       // }

       if($.trim(debitAmt)=='' && $.trim(creditAmt)=='' ){
         $('#showanyoneReq').html('YROPDR Amt or YROPCR Amt field is required ').css({'color':'red','text-align':'center'});
       }
});

});
</script>




@endsection