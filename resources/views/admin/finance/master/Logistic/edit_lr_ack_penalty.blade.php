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

  .tdthtablebordr{
 
  border: 1px solid #00BB64;
 }

 .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    text-align: center;
}

</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master LR Ack Penalty Master

            <small>Update Details</small>



          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Logistic</a></li>


            <li><a href="{{ url('/logistic-transportation/master/lr-acknowledgement-penalty') }}">Master</a></li>

            <li class="active"><a href="{{ url('/logistic-transportation/master/lr-acknowledgement-penalty') }}"> Update LR Ack Penalty</a></li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

    
    <!-- <div class="col-sm-2"></div> -->
      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update LR Ack Penalty</h2>

              <div class=" box-tools pull-right">

                <a href="{{ url('/logistic-transportation/master/view-lr-acknowledgement-penalty') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-search"></i>&nbsp;&nbsp;View LR Ack Penalty</a>

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

            <form id="feetCerForm">

               @csrf

               <div class="row" style="">
                
                <div class="col-sm-12">

                  <div class="box box-primary Custom-Box">

                    <div class="box-body">

                      <div class="table-responsive">

                        <table class="table tdthtablebordr" border="1" cellspacing="0" id="tblFleetTran">

                          <tr>

                            <!-- <th><input class='check_all' type='checkbox' onclick="select_all()" title="Delete All Row"></th> -->

                            <th>Penalty Code <small style="color:red;font-size:14px;">*</small> </th>

                            <th style="width:200px;">Head <small style="color:red;font-size:14px;">*</small></th>

                            <th>Index<small style="color:red;font-size:14px;">*</small></th>

                            <th>Rate<small style="color:red;font-size:14px;">*</small></th>

                            <th>Amount<small style="color:red;font-size:14px;">*</small></th>

                            <th>GL Code<small style="color:red;font-size:14px;">*</small></th>

                            <th>Default<small style="color:red;font-size:14px;">*</small></th>
                            
                          </tr>

                          <tr class="useful">
                            
                            <!-- <td class="tdthtablebordr" style='padding-top: 2%;'>
                              <input type='checkbox' class='case' title="Delete Single Row" onclick="select_all()"/>
                            </td>

                            <td class="tdthtablebordr" style='padding-top: 2%;'>

                              <span id='snum'>1.</span>

                              <input type='hidden' name='TravelDetlSlno[]' id='TravelDetlSlno_id' value='1'>

                            </td>
 -->
                            <td class="tdthtablebordr" style='padding-top: 2%;'>

                              <input type="text" id="penalty_code1" class="form-control" name="penalty_code[]" placeholder="Penalty Code" value="{{$lrData->PENALTY_CODE }}" maxlength="4" readonly="">
                              
                              <small id="penaltycodeErr1"></small>


                            </td>

                            <td class="tdthtablebordr" style='padding-top: 2%;'>
                               <input type="text" id="head1" class="form-control" name="head[]" placeholder="Head" value="{{$lrData->HEAD }}">
                              
                              <small id="headErr1"></small>
                            </td>

                            <td class="tdthtablebordr" style='padding-top: 2%;'>
                              
                             <input list="lrList1" class="form-control ccode" name="lrIndex[]" id="lrIndex1" placeholder="Index"  autocomplete="off" onchange="funlrIndex(1)" value="{{$lrData->INDEX_CODE}}">

                                <datalist id="lrList1">

                                 <option selected="selected" value="">--Select--</option>

                                  <option value='L' data-xyz ="LUMSUM ADDITION" > [ LUMSUM ADDITION]</option>
                                  <option value='M' data-xyz ="LUMSUM DEDUCTION" >[ LUMSUM DEDUCTION ] </option>
                                  

                                </datalist>

                              <input type="hidden" id="lrIndex_name1" name="lrIndex_name[]" value="{{$lrData->INDEX_NAME }}">

                              <small id="lrIndexErr1"></small>

                            </td>

                           <td class="tdthtablebordr" style='padding-top: 2%;'>
                              
                             <input type="text" class="form-control Number text-right" name="rate[]" id="rate1" value="{{$lrData->RATE }}" placeholder="Rate"  autocomplete="off">

                             <small id="rateErr1"></small>
                                
                           </td>

                           <td class="tdthtablebordr" style='padding-top: 2%;'>
                              
                            <input type="text" name="amt[]" id="amt1" class="form-control Number text-right" placeholder="Amount"  value="{{$lrData->AMOUNT }}" autocomplete="off"> 

                            <small id="amountErr1"></small>

                           </td>

                            <td class="tdthtablebordr" style='padding-top: 2%;'>
                              
                              <input list="glList1" class="form-control" name="glcode[]" id="glcode1" placeholder="GL Code" value="{{$lrData->GL_CODE }}"  onchange="funGlCode(1)" autocomplete="off" >

                              <datalist id="glList1">
                                 @foreach($gl_list as $rows)
                              <option value="{{$rows->GL_CODE}}"data-xyz ="{{ $rows->GL_NAME }}">{{ $rows->GL_CODE}} = {{ $rows->GL_NAME }}</option>
                              @endforeach
                              </datalist>

                              <input type="hidden" id="glcode_name1" name="glcode_name[]" value="{{$lrData->GL_NAME }}">
                             

                              <small id="glcodeErr1"></small>

                            </td>

                            <td class="tdthtablebordr" style='padding-top: 2%;'>
                              <input list="defaultList1" class="form-control ccode" name="default[]" id="defaultval1" value="NO" autocomplete="off">

                                <datalist id="defaultList1">

                                 <option value='NO' data-xyz ="NO" > [ NO ]</option>
                                  
                                </datalist>
                            </td>
                            
                          </tr>

                    </table>

                    </div>

                   <!--  <button type="button" class='btn btn-danger delete' id="deletehidn"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                    <button type="button" class='btn btn-info addmore' id="addmorhidn"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button> -->
                   </div>
                  </div>
              </div>
            </div>

             
            <div style="text-align: center;">
                <input type="hidden" name="certID" id="certID" value="">
                <button type="button" class="btn btn-primary" id="saveData">

              <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

               </button>
               <button type="reset" class="btn btn-warning" id="resetData">

              <i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Reset 

               </button>
              

            </div>

            </form>

             

          </div><!-- /.box-body -->

           

          <!-- </div> -->

      </div>
      



    </div>

     

	</section>

</div>



@include('admin.include.footer')

<script type="text/javascript">

$( window ).on( "load", function() {

    $('#truck_no').css('border-color','#ff0000').focus();

})

$('#resetData').click(function(){
   location.reload();
});

function funlrIndex(id){

  var lrindex = $('#lrIndex'+id).val();
  var xyz      = $('#lrList'+id+' option').filter(function() {

  return this.value == lrindex;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';
  
  if(msg == 'No Match'){

      $('#lrIndex'+id).val('');
      $('#lrIndex_name'+id).val('');

  }else{
    $('#lrIndex_name'+id).val(msg);
   
  }
}

function funGlCode(id){

  var glcode = $('#glcode'+id).val();
  var xyz      = $('#glList'+id+' option').filter(function() {

  return this.value == glcode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';
  
  if(msg == 'No Match'){

      $('#glcode'+id).val('');
      $('#glcode_name'+id).val('');

  }else{
    $('#glcode_name'+id).val(msg);
   
  }
}










$(".delete").on('click', function() {

    var val =  $('.case:checkbox:checked').val();

    var certCode = $('#cert_code'+val).val();
    var incre = parseInt(val);
   
    var chkarrLen = chkCerCode.length;

    for(var j=0;j<chkarrLen;j++){

      if(chkCerCode[j] == certCode){
        chkCerCode.splice(j,1);
        
      }
    }

    $('.case:checkbox:checked').parents('#tblFleetTran tr').remove();
      var tbllengthh = $('#tblFleetTran tr').length;

      for(var k=val;k<tbllengthh;k++){

          incre = parseInt(incre) + parseInt(1);
          $('#cert_code'+incre).attr('id', 'cert_code'+k);
          $('#certCodeErr'+incre).attr('id', 'certCodeErr'+k);
          $('#checkId'+incre).attr('id', 'checkId'+k);

          $('#cert_no'+incre).attr('id', 'cert_no'+k);
          $('#cert_noErr'+incre).attr('id', 'cert_noErr'+k);
          $('#cert_date'+incre).attr('id', 'cert_date'+k);

          $('#cert_dateErr'+incre).attr('id', 'cert_dateErr'+k);
          $('#certRnew_dueDt'+incre).attr('id', 'certRnew_dueDt'+k);
          $('#certRnew_dueDtErr'+incre).attr('id', 'certRnew_dueDtErr'+k);

          $('#cert_rnew_dt'+incre).attr('id', 'cert_rnew_dt'+k);
          $('#cert_rnew_dtErr'+incre).attr('id', 'cert_rnew_dtErr'+k);
          $('#checkId'+k).attr("value",k);
      }

  $('.check_all').prop("checked", false); 

    checkAccommo();

  });

    
    
 $(document).ready(function(){

  $('#saveData').on('click',function(){

   
   var count=$('#tblFleetTran tr').length;
   var countTr = count-1;

   for(var l=1;l <= countTr;l++){

    var penalty_code  =  $('#penalty_code'+l).val();
    if(penalty_code == ''){
      
      $('#penaltycodeErr'+l).html('Penalty Code Field Is Required').css('color','red');
      return false;

    }else{
      $('#penaltycodeErr'+l).html('');
     
    }
    
    
    var head  =  $('#head'+l).val();
    
    if(head == ''){

      $('#headErr'+l).html('Head Field Is Required').css('color','red');
      return false;

    }else{
       $('#headErr'+l).html('');
      
    }
    

    var lrIndex  =  $('#lrIndex'+l).val();
    var lrIndexName  =  $('#lrIndex_name'+l).val();
    
    if(lrIndex == ''){

      $('#lrIndexErr'+l).html('Index Field Is Required').css('color','red');
      return false;

    }else{
       $('#lrIndexErr'+l).html('');
       
    }
    
    var rate  =  $('#rate'+l).val();
    
    if(rate == ''){

      
    }else{
       $('#rateErr'+countTr).html('');
        
    }
   

    var amt  =  $('#amt'+l).val();
    
    if(amt == ''){

     

    }else{
      $('#amountErr'+l).html('');
      
    }

    var glcode  =  $('#glcode'+l).val();
    var glname  =  $('#glcode_name'+l).val();
    
    if(glcode == ''){

      $('#glcodeErr'+l).html('GL Code Field Is Required').css('color','red');
      return false;

    }else{
      $('#glcodeErr'+l).html('');
     
    }

    var defaultval  =  $('#defaultval'+l).val();
    if(defaultval == ''){

    }else{
      
    }
   

    
  }
   
   $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

             }
  });

  $.ajax({

          url:"{{ url('/logistic-transportation/master/update-lr-acknowledgement-penalty') }}",

           type: "POST",

           data: {penalty_code:penalty_code,head:head,lrIndex:lrIndex,lrIndexName:lrIndexName,rate:rate,amt:amt,glcode:glcode,glname:glname,defaultval:defaultval},

           success:function(data){

            var data1 = JSON.parse(data);

            if(data1.response == 'success'){
              console.log('success');

              setTimeout(function () {
                  
                var pageName = btoa('LRAckPenalty');
                  
                window.location.href = "{{ url('/logistic/fleet-certificate-tran/success-message')}}/"+pageName+"";

                }, 500);

            }
            if(data1.response == 'error'){

              console.log('error');

            }
            // if(data1.response == 'duplicate'){
            //   $('#truckNoErr').html('Truck No is already Exit').css('color','red');
            //  $('#feetCerForm')[0].reset();
            // }

          }

    });

    }) 
  })

$(document).ready(function(){
  
 $('.Number').keypress(function (event) {
      var keycode = event.which;
      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
          event.preventDefault();
      }
  });


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