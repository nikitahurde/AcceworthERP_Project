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

      Item Batch Bal Master

      <small> Add Details</small>

    </h1>

    <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/Master/Item/View-Item-Batch-balance') }}">Item Batch Bal Master</a></li>

           

            <li class="active"><a href="{{ url('/Master/Item/View-Item-Batch-balance') }}">Update Item Batch Bal Master </a></li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-1"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> Update Item Batch Bal Master</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/Master/Item/View-Item-Batch-balance') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item Batch Bal Master</a>

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

            <form action="{{ url('/Master/Item/Update-Item-Batch-balance') }}" method="POST" >
            <input type="hidden" value="{{ $editdata->ITEM_CODE}}" name="codehidn">


             @csrf

             <div class="row">

              <div class="col-md-4">

                
                    <div class="form-group">

                      <label>

                        Item Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                           <input list='itemcode_list'class="form-control codeCapital nextOnEnterBtn" name="item_code" id="itemcode" value="{{ $editdata->ITEM_CODE}}" placeholder="Enter Item Code"  autocomplete="off" onchange='funItemcode();' readonly="">
                           
                            <datalist id="itemcode_list">
                                <?php foreach($item_code as $key) { ?>
                                  <option value="{{ $key->ITEM_CODE }}" data-xyz ="{{ $key->ITEM_NAME }}" data-type="{{ $key->UM }}~{{ $key->AUM }}"> {{ $key->ITEM_NAME }}</option>
                               
                                <?php } ?>
                            </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('item_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>

              </div>

              <!-- /.form-group -->

              

              <div class="col-md-4">

                <div class="form-group">

                      <label>

                        Item Name: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="itemname" name="Name_item" class="form-control  pull-left nextOnEnterBtn" value="{{ $editdata->ITEM_NAME}}" placeholder="Enter Item name" autocomplete="off" readonly="">


                            <datalist id='glList'>
                              
                            </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('Name_item', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>

              </div>
              <!-- /.form-group -->



              <div class="col-md-4">

                <div class="form-group">

                      <label>

                        Batch No : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                            </div>

                            <input type="text"  name="batch_no" class="form-control  pull-left nextOnEnterBtn" value="{{ $editdata->BATCH_NO}}" placeholder="Enter Batch No" autocomplete="off" readonly="">
                           
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('batch_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                <!-- /.form-group -->

                
              </div>

              <!-- /.col -->

            </div>

             <div class="row">

              <div class="col-md-4">

                
                    
                    <div class="form-group">

                      <label>

                       Rqty Recd : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-calendar" aria-hidden="true"></i>

                            </div>

                          <input type="text" class="form-control nextOnEnterBtn" name="rqty_recd" id="rqtyrecd1" value="{{ $editdata->RQTYRECD}}" placeholder="Select Rqty Recd" autocomplete="off" >
                           
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('rqty_recd', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
              </div>

              <!-- /.form-group -->
              <div class="col-md-4">

                
                    
                    <div class="form-group">

                      <label>

                       Raqty Recd : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-calendar" aria-hidden="true"></i>

                            </div>

                          <input type="text" class="form-control nextOnEnterBtn" name="raqty_recd" id="raqtyrecd" value="{{ $editdata->RAQTYRECD}}" placeholder="Select Raqty Recd" autocomplete="off" >
                           
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('raqty_recd', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
              </div>

              

              <div class="col-md-4">

                <div class="form-group">

                      <label>

                        Rqty Issued : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>

                           <input type="text" class="form-control nextOnEnterBtn" name="rqty_issued" id="RqtyIssued" value="{{ $editdata->RQTYISSUED}}" placeholder="Select Rqty Issued" autocomplete="off" >


                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>
                        

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('rqty_issued', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>

              </div>
              <!-- /.form-group -->



              
              <!-- /.col -->

            </div>
            

             <div class="row">
              <div class="col-md-4">

                <div class="form-group">

                      <label>

                        Raqty Issued : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-calendar" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="raqtyissued" name="raqty_issued" class="form-control  pull-left nextOnEnterBtn" value="{{ $editdata->RAQTYISSUED}}" placeholder="Select Raqty Recd" autocomplete="off">
                           
                        </div>

                         <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('raqty_issued', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                <!-- /.form-group -->

                
              </div>


              <div class="col-md-4">

                <div class="form-group">

                      <label>

                        UM : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-calendar" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="um" name="Um" class="form-control  pull-left nextOnEnterBtn" value="{{ $editdata->UM}}" placeholder="Select Um" autocomplete="off"readonly>
                           
                        </div>

                         <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('Um', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                <!-- /.form-group -->

                
              </div>

              <div class="col-md-4">

                
                    <div class="form-group">

                      <label>

                        Aum : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-calendar" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="aum" name="Aum" class="form-control  pull-left nextOnEnterBtn" value="{{ $editdata->AUM}}" placeholder="Select Aum" autocomplete="off"readonly>
                           
                        </div>

                           <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('Aum', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>
                    </div>

              </div>

              <!-- /.form-group -->

              

            
              <!-- /.form-group -->

              <!-- /.col -->

            </div>
            


            

            <!-- /.row -->
           


            <div style="text-align: center;">


             <button type="Submit" class="btn btn-primary">

              <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update
            </button>

          </div>

        </form>

      </div><!-- /.box-body -->

      

    </div>

  </div>

  <div class="col-sm-3 hideinmobile">

    <div class="box-tools pull-right">

      <a href="{{ url('/Master/Item/View-Item-Batch-balance') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item Batch Bal Master</a>

    </div>

  </div>

</div>

</section>

</div>


@include('admin.include.footer')



<script type="text/javascript">
 

function funItemcode(){
 var itemCd = $('#itemcode').val();

    var xyz = $('#itemcode_list option').filter(function() {
      return this.value == itemCd;

    }).data('xyz');

    var datatype = $('#itemcode_list option').filter(function() {
      return this.value == itemCd;

    }).data('type');

    console.log('datatype',datatype);
     
    var msg = xyz ?  xyz : 'No Match';
    
    if(msg=='No Match'){
      $('#itemname').val('');
      $('#itemcode').val('');
      $('#um').val('');
      $('#aum').val('');
    }else{
     
      var splitData     = datatype.split("~");
      
      var um  = splitData[0];
      var aum = splitData[1];
       $('#itemname').val(msg);
        $('#um').val(um);
      $('#aum').val(aum);
    
    }
 }
     

$(document).ready(function() {


      $('#start_date').datepicker({

        format: 'dd-mm-yyyy',
        orientation: 'bottom',
        todayHighlight: 'true',
        // startDate :fromdateintrans,
        // endDate : 'today',
        autoclose: 'true'
      });

    
  
 // $('#start_date').datepicker({
 //      format: 'yyyy-mm-dd',
 //      orientation: 'bottom',
 //      todayHighlight: 'true',
 //      autoclose: 'true'

 //    });
  

    $('#end_date').datepicker({
      format: 'dd-mm-yyyy',
     orientation: 'bottom',
      todayHighlight: 'true',
      autoclose: 'true'

    });
    $('#actual_date').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      autoclose: 'true'

    });

     $('#actend_date').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      autoclose: 'true'

    });
    

});


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
        title: 'Help Acc Class Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var AccClsHelp = $('#AccClsHelp').val();

           if(AccClsHelp == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-AccCode-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {AccClsHelp: AccClsHelp},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Acc Class Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                            var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.ACLASS_CODE+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.ACLASS_NAME+'</td></tr>');
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
    $('#AccClassSearch').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var AccClassSearch = $('#AccClassSearch').val();

        if(AccClassSearch == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-acc-class-get') }}",

             method : "POST",

             type: "JSON",

             data: {AccClassSearch: AccClassSearch},

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
                            objcity.ACLASS_CODE+'</span><br>');
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

<!-- <script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script> -->







@endsection