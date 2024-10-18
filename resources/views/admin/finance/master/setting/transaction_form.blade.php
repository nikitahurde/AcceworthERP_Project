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
.showSeletedName{



    font-size: 15px;



    margin-top: 2%;



    text-align: center;



    font-weight: 600;



    color: #4f90b5;



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



            Master Transaction


            <small>Add Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Master</a></li>



            <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}">Master Transaction</a></li>



            <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}">Add Transaction</a></li>



          </ol>



        </section>



	<section class="content">



    <div class="row">



      <div class="col-sm-1"></div>



      <div class="col-sm-8">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Transaction </h2>


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



            <form action="{{ url('/finance/form-mast-transaction-save') }}" method="POST" >



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



                          <input list="tranList" class="form-control" id="transaction_code" name="transaction_code" value="{{ old('transaction_code')}}" placeholder="Enter Transaction Code" maxlength="2" id="transCodeSearch" autocomplete="off">

                           <datalist id="tranList">

                             <option value="">--SELECT--</option>

                             @foreach($trans_code_list as $key)


                             <option value="{{ $key->tran_code }}" data-xyz ="{{ $key->tran_code }}">{{ $key->tran_code }} = {{ $key->tran_head }}</option>


                             @endforeach

                          </datalist>


                           
                          <span class="input-group-addon" style="padding: 1px 7px;">
                            
                            <div class="">
                                <button type="button" id="login" class="btn btn-xs btn-info gly-radius"> <i class="fa fa-info" aria-hidden="true"></i></button>
                            </div>
                            <div id="myForm" class="hide">
                                 <div class="row">
                                      <div class="col-md-9">
                                        <input type="text" name="GlmstnameH" id="TransCodeH" class="form-control input-md setheightinput" style="text-transform: uppercase;">
                                      </div>
                                      <div class="col-md-3" style="margin-left: -7%;">
                                        
                                        <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                <div id="result">
                                <table class="table table-bordered" style="margin-top: 3%;" id="HideWhenSearch">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Transaction Code</th>
                                     <th class="nameheading">Transaction Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($trans_mst_list as $key) { ?>

                                      <tr>
                                        <td class="setetxtintd"><?php echo $key->TRAN_CODE; ?></td>
                                        <td class="setetxtintd"><?php echo $key->TRAN_HEAD; ?></td>
                                      </tr>
                                     
                                    <?php } ?>
                                  </tbody>
                                </table>

                                <table class="table table-bordered beforhidetble" style="margin-top: 3%;" id="ShowWhenSeaech">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Transaction Code</th>
                                     <th class="nameheading">Transaction Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                  </tbody>
                                </table>
                                <span id="errorItem"></span>

                            </div>
                            </div>
                            
                          </span>

                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>
                          



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



                          <input type="text" class="form-control" id="transaction_head" name="transaction_head" value="{{ old('transaction_head') }}" placeholder="Enter Transaction Head" maxlength="40" autocomplete="off" readonly="">

                           


                      </div>

                    <div class="pull-left showSeletedName" id="tranheadText"></div>

                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('transaction_head', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>


                <!-- /.col -->



              </div>

              <div class="row">
                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                      Auto Post Code: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                        <input type="radio" class="optionsRadios1" name="auot_postcode" value="1" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="optionsRadios1" name="auot_postcode" value="0" checked="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('auot_postcode', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                 <!-- /.form-group -->
                  </div>
              </div>

              <!-- /.row -->



              <!-- /.row -->



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
//console.log(obj.response);
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
          //console.log('val',val);
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


<script type="text/javascript">
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Transaction Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var TransCodeH = $('#TransCodeH').val();

           if(TransCodeH == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-transaction-code-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {TransCodeH: TransCodeH},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Gl Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.tran_code+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.tran_head+'</td></tr>');
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
    $('#transCodeSearch').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var transCodeSearch = $('#transCodeSearch').val();

        if(transCodeSearch == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-transactn-oninput') }}",

             method : "POST",

             type: "JSON",

             data: {transCodeSearch: transCodeSearch},

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
                            objcity.tran_code+'</span><br>');
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
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script>




@endsection