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

.showSeletedName{



    font-size: 15px;



    margin-top: 2%;



    text-align: center;



    font-weight: 600;



    color: #4f90b5;



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



            Master Transaction



            <small>Update Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Master</a></li>



            <li class="active"><a href="{{ url('/form-mast-account-type') }}">Master Transaction</a></li>



            <li class="active"><a href="{{ url('/form-mast-account-type') }}">Update Transaction</a></li>



          </ol>



        </section>



	<section class="content">



    <div class="row">



      <div class="col-sm-1"></div>



      <div class="col-sm-8">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Transaction </h2>



               <div class="box-tools pull-right showinmobile">



          <a href="{{ url('/finance/view-mast-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>



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



            <form action="{{ url('/finance/form-mast-transaction-update') }}" method="POST" >



               @csrf



               <div class="row">



                



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Transaction Code: 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>



                          <input list="tranList" class="form-control" id="transaction_code" name="transaction_code" value="{{ $transaction_list->TRAN_CODE }}" placeholder="Enter Transaction Code" maxlength="2" autocomplete="off" readonly>

                          <datalist id="tranList">

                             <option value="">--SELECT--</option>

                             @foreach($trans_code_list as $key)


                             <option value="{{ $key->tran_code }}" data-xyz ="{{ $key->tran_code }}">{{ $key->tran_code }} = {{ $key->tran_head }}</option>


                             @endforeach

                          </datalist>
                            
                        </div>

                        <div class="pull-left showSeletedName" id="trancodeText"></div>

                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('transaction_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>







                    </div>



                    <!-- /.form-group -->



                  </div>







                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Transaction Head : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>



                          <input list="tranheadList" class="form-control" id="transaction_head" name="transaction_head" value="{{ $transaction_list->TRAN_HEAD }}" placeholder="Enter Transaction Head" maxlength="40" autocomplete="off" readonly="">

                         

                      </div>


                <div class="pull-left showSeletedName" id="tranheadText"></div>

                      <small id="emailHelp" class="form-text text-muted">


                        {!! $errors->first('transaction_head', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

              </div>

              <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Auto Post Code : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="auto_postcode" value="YES" <?php if($transaction_list->AUTO_POSTCODE=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="auto_postcode" value="NO" <?php if($transaction_list->AUTO_POSTCODE=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('auto_postcode', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Transaction Block : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                         



                          <input type="radio" class="optionsRadios1" name="transaction_block" value="YES" <?php if($transaction_list->TRAN_BLOCK=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="transaction_block" value="NO" <?php if($transaction_list->TRAN_BLOCK=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('transaction_block', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>



                <!-- /.col -->



                

              </div>



              <!-- /.row -->



              <!-- /.row -->





              <div style="text-align: center;">

                <input type="hidden" name="transId" value="{{ $transaction_list->TRAN_CODE }}">

                 <button type="Submit" class="btn btn-primary">



                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 



                 </button>



              </div>



            </form>



          </div><!-- /.box-body -->



           



          </div>



      </div>



      <div class="col-sm-3">



        <div class="box-tools pull-right hideinmobile">



          <a href="{{ url('/Master/Setting/View-Transaction-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>



        </div>



      </div>







    </div>



     



	</section>



</div>







@include('admin.include.footer')

<script type="text/javascript">



  

      $("#transaction_code" ).change(function() {



           $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        

      var tran_code = $("#transaction_code").val();

      //alert(comp_code);return false;





      $.ajax({

        url: "{{ url('/finance/get_tranhead') }}",

        method : 'POST',

        type: 'JSON',

        data: {tran_code: tran_code},

      })

      .done(function(data) {

        //alert(data);return false;



      var obj = JSON.parse(data);
console.log(obj.data.tran_head);
if(obj.response=='success'){

       $("#transaction_head").val(obj.data.tran_head);
       $("#tranheadText").html(obj.data.tran_head);
}else{
       $("#transaction_head").val('');
       $("#tranheadText").html('');
}
       



      })

    

    });



</script>


<script type="text/javascript">
  $("#transaction_code").bind('change', function () {  
          var val = $(this).val();

          var xyz = $('#tranList option').filter(function() {

          return this.value == val;

          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';

          document.getElementById("trancodeText").innerHTML = msg; 



        });

  $("#transaction_head").bind('change', function () {  
          var val = $(this).val();

          var xyz = $('#tranheadList option').filter(function() {

          return this.value == val;

          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';

          document.getElementById("tranheadText").innerHTML = msg; 



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