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

            LR Ack Penalty

            <small>Add Details</small>



          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Master</a></li>


            <li><a href="{{ url('/logistic-transportation/master/lr-acknowledgement-penalty') }}">Master LR Ack Penalty </a></li>

            <li class="active"><a href="{{ url('/logistic-transportation/master/lr-acknowledgement-penalty') }}"> Add LR Ack Penalty</a></li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

    
    <!-- <div class="col-sm-2"></div> -->
      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add LR Ack Penalty</h2>

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

                        <table class="table tdthtablebordr" border="1" cellspacing="0" id="tblAckPenaltyTran">

                          <tr>

                            <th><input class='check_all' type='checkbox' onclick="select_all()" title="Delete All Row"></th>

                            <th>Penalty Code <small style="color:red;font-size:14px;">*</small> </th>

                            <th>Head <small style="color:red;font-size:14px;">*</small></th>

                            <th>Index<small style="color:red;font-size:14px;">*</small></th>

                            <th>Rate</th>

                            <th>Amount</th>

                            <th>GL Code<small style="color:red;font-size:14px;">*</small></th>

                            <th>Default</small></th>
                            
                          </tr>

                          <tr class="useful">
                            
                            <td class="tdthtablebordr" style='padding-top: 2%;'>
                              <input type='checkbox' class='case' title="Delete Single Row" onclick="select_all()"/>
                            </td>

                           <!--  <td class="tdthtablebordr" style='padding-top: 2%;'>

                              <span id='snum'>1.</span>

                              <input type='hidden' name='TravelDetlSlno[]' id='TravelDetlSlno_id' value='1'>

                            </td> -->

                            <td class="tdthtablebordr" style='padding-top: 2%;'>

                              <input type="text" id="penalty_code1" class="form-control" name="penalty_code[]" placeholder="Penalty Code" value="" maxlength="4" onchange="funChkPenCode(1)"autocomplete="off">
                              
                              <small id="penaltycodeErr1"></small>

                            </td>

                            <td class="tdthtablebordr" style='padding-top: 2%;'>
                               <input type="text" id="head1" class="form-control" name="head[]" placeholder="Head" value="" autocomplete="off"  disabled>
                              
                              <small id="headErr1"></small>
                            </td>

                            <td class="tdthtablebordr" style='padding-top: 2%;'>
                              
                             <input list="lrList1" class="form-control ccode" name="lrIndex[]" id="lrIndex1" placeholder="Index" value=""  autocomplete="off" onchange="funlrIndex(1)">

                                <datalist id="lrList1">

                                 <option selected="selected" value="">--Select--</option>

                                  <option value='L' data-xyz ="LUMSUM ADDITION" > [ LUMSUM ADDITION]</option>
                                  <option value='M' data-xyz ="LUMSUM DEDUCTION" >[ LUMSUM DEDUCTION ] </option>
                                  

                                </datalist>

                              <input type="hidden" id="lrIndex_name1" name="lrIndex_name[]" value="">

                              <small id="lrIndexErr1"></small>

                            </td>

                           <td class="tdthtablebordr" style='padding-top: 2%;'>
                              
                             <input type="text" class="form-control Number" name="rate[]" id="rate1" value="" placeholder="Rate"  autocomplete="off">

                             <small id="rateErr1"></small>
                                
                           </td>

                           <td class="tdthtablebordr" style='padding-top: 2%;'>
                              
                            <input type="text" name="amt[]" id="amt1" class="form-control Number" placeholder="Amount"  value="" autocomplete="off"> 

                            <small id="amountErr1"></small>

                           </td>

                            <td class="tdthtablebordr" style='padding-top: 2%;'>
                              
                              <input list="glList1" class="form-control" name="glcode[]" id="glcode1" placeholder="GL Code" value=""  onchange="funGlCode(1)" autocomplete="off">

                              <datalist id="glList1">
                                 @foreach($gl_list as $rows)
                              <option value="{{$rows->GL_CODE}}"data-xyz ="{{ $rows->GL_NAME }}">{{ $rows->GL_CODE}} = {{ $rows->GL_NAME }}</option>
                              @endforeach
                              </datalist>

                              <input type="hidden" id="glcode_name1" name="glcode_name[]" value="">
                             

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

                    <button type="button" class='btn btn-danger delete' id="deletehidn"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                    <button type="button" class='btn btn-info addmore' id="addmorhidn"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>
                   </div>
                  </div>
              </div>
            </div>

             
            <div style="text-align: center;">
                <input type="hidden" name="certID" id="certID" value="">
                <button type="button" class="btn btn-primary" id="saveData">

              <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Submit 

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

function funChkPenCode(id){

  var penaltyCode = $('#penalty_code'+id).val();

  $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

             }
  });

  $.ajax({

          url:"{{ url('/logistic-transportation/master/check-lr-acknowledgement-penalty-code') }}",

           type: "POST",

           data: {penaltyCode:penaltyCode},

           success:function(data){

            var data1 = JSON.parse(data);

            if(data1.response == 'success'){

              $('#penaltycodeErr'+id).html('This LR Acknowledgement Penolty Code already Save').css('color','red');
            }else if(data1.response == 'error'){

              $('#head'+id).prop('disabled',false);

            }else{

            }
          }

  });


}
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
   
   
   $('.case:checkbox:checked').parents('#tblAckPenaltyTran tr').remove();

    $('.check_all').prop("checked", false); 

    check();

  });


  function check(){

      obj = $('#tblAckPenaltyTran tr').find('span');
      
      $.each( obj, function( key, value ) {

          id=value.id;
          
          $('#'+id).html(key+1);

      });

  }




$(function(){

var i=2;

  var chkPenaltycode = [];
  
  $(".addmore").on('click',function(){ 

    count=$('#tblAckPenaltyTran tr').length;

    countTr = count-1;

    
    var penalty_code  =  $('#penalty_code'+countTr).val();
    if(penalty_code == ''){
      
      $('#penaltycodeErr'+countTr).html('Penalty Code Field Is Required').css('color','red');
      return false;

    }else{
      $('#penaltycodeErr'+countTr).html('');


      var dArrLen = chkPenaltycode.length;
    
    if(dArrLen > 0){
      
      for(var k=0; k< dArrLen;k++){

          if(chkPenaltycode[k] == penalty_code){
           
           $('#penaltycodeErr'+countTr).html('Please Enter another Penalty Code').css('color','red');
             return false;
          }else{
            // var dataArray = chkCerCode.push(certCode);
          }

      }
       $('#penaltycodeErr'+countTr).html('');
       var dataArray = chkPenaltycode.push(penalty_code);
     

    }else{
      
      var dataArray = chkPenaltycode.push(penalty_code);
     
    }
    console.log('chkPenaltycode',chkPenaltycode);
      
    }
    
    
    var head  =  $('#head'+countTr).val();
    
    if(head == ''){

      $('#headErr'+countTr).html('Head Field Is Required').css('color','red');
      return false;

    }else{
       $('#headErr'+countTr).html('');
      
    }
    

    var lrIndex  =  $('#lrIndex'+countTr).val();
    var lrIndexName  =  $('#lrIndex_name'+countTr).val();
    
    if(lrIndex == ''){

      $('#lrIndexErr'+countTr).html('Index Field Is Required').css('color','red');
      return false;

    }else{
       $('#lrIndexErr'+countTr).html('');
      
    }

    var glcode  =  $('#glcode'+countTr).val();
    var glname  =  $('#glcode_name'+countTr).val();
    
    if(glcode == ''){

      $('#glcodeErr'+countTr).html('GL Code Field Is Required').css('color','red');
      return false;

    }else{
      $('#glcodeErr'+countTr).html('');

        var data='<tr><td class="tdthtablebordr" style="padding-top: 23px;"><input type="checkbox" class="case" id="checkId'+count+'" value="'+count+'"/></td>';

        data += '<td class="tdthtablebordr" style="padding-top: 2%;""><input type="text" id="penalty_code'+count+'" class="form-control" name="penalty_code[]" placeholder="Penalty Code" value="" maxlength="4" onchange="funChkPenCode('+count+')" autocomplete="off"><small id="penaltycodeErr'+count+'"></small></td><td class="tdthtablebordr" style="padding-top: 2%;"><input type="text" id="head'+count+'" class="form-control" name="head[]" placeholder="Head" value="" autocomplete="off" disabled><small id="headErr'+count+'"></small></td><td class="tdthtablebordr" style="padding-top: 2%;"><input list="lrList'+count+'" class="form-control ccode" name="lrIndex[]" id="lrIndex'+count+'" placeholder="Index" value=""  autocomplete="off" onchange="funlrIndex('+count+')"><datalist id="lrList'+count+'"><option selected="selected" value="">--Select--</option><option value="L" data-xyz ="LUMSUM"> [ LUMSUM ]</option><option value="M" data-xyz ="LUMSUM DEDUCTION" >[ LUMSUM DEDUCTION ] </option></datalist><input type="hidden" id="lrIndex_name'+count+'" name="lrIndex_name[]" value=""><small id="lrIndexErr'+count+'"></small></td><td class="tdthtablebordr" style="padding-top: 2%;"><input type="text" class="form-control Number" name="rate[]" id="rate'+count+'" value="" placeholder="Rate"  autocomplete="off"><small id="rateErr'+count+'"></small></td><td class="tdthtablebordr" style="padding-top: 2%;"><input type="text" name="amt[]" id="amt'+count+'" class="form-control Number" placeholder="Amount"  value="" autocomplete="off"><small id="amountErr'+count+'"></small></td><td class="tdthtablebordr" style="padding-top: 2%;"><input list="glList'+count+'" class="form-control" name="glcode[]" id="glcode'+count+'" placeholder="GL Code" value=""  onchange="funGlCode('+count+')" autocomplete="off" ><datalist id="glList'+count+'">@foreach($gl_list as $rows)<option value="{{$rows->GL_CODE}}"data-xyz ="{{ $rows->GL_NAME }}">{{ $rows->GL_CODE}} = {{ $rows->GL_NAME }}</option> @endforeach</datalist><input type="hidden" id="glcode_name'+count+'" name="glcode_name[]" value=""><small id="glcodeErr'+count+'"></small></td><td class="tdthtablebordr" style="padding-top: 2%;"><input list="defaultList" class="form-control ccode" name="default[]" id="defaultval'+count+'" placeholder="Default" value="NO" autocomplete="off"><datalist id="defaultList'+count+'"><option selected="selected" value="">--Select--</option><option value="NO" data-xyz ="NO" > [ NO ]</option></datalist></td></tr>';

        $('#tblAckPenaltyTran').append(data);
        
        $("#certRnew_dueDt"+count).click(function() {
          
          var startDT = $('#cert_date'+count).val();

          $('#certRnew_dueDt'+count).datepicker({
          format: 'dd-mm-yyyy',
          orientation: 'bottom',
          todayHighlight: 'true',
          //startDate: startDT ,
          autoclose: 'true',

         
        });
        
        $(this).datepicker().datepicker( "show" );

        }).on("change", function() {
        var dateObject = $('#certRnew_dueDt'+count).datepicker('getDate'); 

          // var dateObject = renewDate;
        dateObject.setDate(dateObject.getDate() + 1);
        var getdate = dateObject.getDate();
        var getMonth=dateObject.getMonth()+1;
        var getYear = dateObject.getFullYear();
        var formDate =getYear+'-'+getMonth+'-'+getdate;
        
        var d = new Date(formDate);
        var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
        var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

        var next_date =da+'-'+mo+'-'+getYear;
        
        $('#cert_rnew_dt'+count).val(next_date);
      });

        i++;
    }

    $('.datepicker').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      //startDate: 'today',
      autoclose: 'true'
    });

    $('.Number').keypress(function (event) {
      var keycode = event.which;
      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
          event.preventDefault();
      }
  });





  })


})

    var all_penaltyCode= [];
    var all_head= [];
    var all_index= [];
    var all_indexName= [];
    var all_rate= [];
    var all_amount= [];
    var all_glcode= [];
    var all_glname= [];
    var all_defaultval= [];
    
 $(document).ready(function(){

  $('#saveData').on('click',function(){

   
   var count=$('#tblAckPenaltyTran tr').length;
   var countTr = count-1;

   for(var l=1;l <= countTr;l++){

    var penalty_code  =  $('#penalty_code'+l).val();
    if(penalty_code == ''){
      
      $('#penaltycodeErr'+l).html('Penalty Code Field Is Required').css('color','red');
      return false;

    }else{
      $('#penaltycodeErr'+l).html('');
      all_penaltyCode.push(penalty_code);
    }
    
    
    var head  =  $('#head'+l).val();
    
    if(head == ''){

      $('#headErr'+l).html('Head Field Is Required').css('color','red');
      return false;

    }else{
       $('#headErr'+l).html('');
       all_head.push(head);
    }
    

    var lrIndex  =  $('#lrIndex'+l).val();
    var lrIndexName  =  $('#lrIndex_name'+l).val();
    
    if(lrIndex == ''){

      $('#lrIndexErr'+l).html('Index Field Is Required').css('color','red');
      return false;

    }else{
       $('#lrIndexErr'+l).html('');
       all_index.push(lrIndex);
       all_indexName.push(lrIndexName);
    }
    
    var rate  =  $('#rate'+l).val();
    
    if(rate == ''){

        all_rate.push(0);

    }else{
       $('#rateErr'+countTr).html('');
        all_rate.push(rate);
    }
   

    var amt  =  $('#amt'+l).val();
    
    if(amt == ''){

      all_amount.push(0);

    }else{
      $('#amountErr'+l).html('');
      all_amount.push(amt);
    }

    var glcode  =  $('#glcode'+l).val();
    var glname  =  $('#glcode_name'+l).val();
    
    if(glcode == ''){

      $('#glcodeErr'+l).html('GL Code Field Is Required').css('color','red');
      return false;

    }else{
      $('#glcodeErr'+l).html('');
      all_glcode.push(glcode);
      all_glname.push(glname);
    }

    var defaultval  =  $('#defaultval'+l).val();
    if(defaultval == ''){

    }else{
      all_defaultval.push(defaultval);
    }
   

    
  }
   
   $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

             }
  });

  $.ajax({

          url:"{{ url('/logistic-transportation/master/save-lr-acknowledgement-penalty') }}",

           type: "POST",

           data: {all_penaltyCode:all_penaltyCode,all_head:all_head,all_index:all_index,all_indexName:all_indexName,all_rate:all_rate,all_amount:all_amount,all_glcode:all_glcode,all_glname:all_glname,all_defaultval:all_defaultval},

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