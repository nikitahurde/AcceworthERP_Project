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

            Master Fleet Certificate

            <small>Add Details</small>



          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Logistic</a></li>


            <li><a href="{{ url('/logistic/fleet-certificate-transaction-form') }}">Master</a></li>

            <li class="active"><a href="{{ url('/logistic/fleet-certificate-transaction-form') }}"> Add Fleet Certificate </a></li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

    
    <!-- <div class="col-sm-2"></div> -->
      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Fleet Certificate </h2>

              <div class=" box-tools pull-right">

                <a href="{{ url('/logistic/view-fleet-certificate-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-search"></i>&nbsp;&nbsp;View Fleet Certificate</a>

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

               <!-- @csrf -->
 
               <div class="row col-md-12">

                <div class="col-md-4"></div>

                <div class="col-sm-3">

                  <div class="form-group">

                    <label>Vehicle Number:</label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                      <!-- <input type="text" class="form-control" name="truck_no" id="truck_no" placeholder="Enter Truck No" value="" onchange="funTruckNo(1)" autocomplete="off"> -->

                      <input list="truckList" class="form-control" name="truck_no" id="truck_no" placeholder="Enter Vehicle No" value="" onchange="funTruckNo()" autocomplete="off">

                                <datalist id="truckList">
                                  
                                  @foreach($truckData as $rows)

                                   <option value="{{ $rows->TRUCK_NO}}" data-xyz="<?= $rows->TRUCK_NO?>">{{ $rows->TRUCK_NO}}</option>

                                  @endforeach

                                </datalist>



                    </div>
                    <br>
                    <small id="truckNoErr"></small>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('truck_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>

              </div><br><br>

              <div class="row" style="padding-top: 6%;!important;">
                
                <div class="col-sm-12">

                  <div class="box box-primary Custom-Box">

                    <div class="box-body">

                      <div class="table-responsive">

                        <table class="table tdthtablebordr" border="1" cellspacing="0" id="tblFleetTran">

                          <tr>

                            <th><input class='check_all' type='checkbox' onclick="select_all()" title="Delete All Row"></th>

                             <th>Certificate Code <small style="color:red;font-size:14px;">*</small> </th>

                            <th>Certificate Number <small style="color:red;font-size:14px;">*</small></th>

                            <th>Certificate Date <small style="color:red;font-size:14px;">*</small></th>

                            <th>Certificate Renew Due Date<small style="color:red;font-size:14px;">*</small></th>

                            <th>Certificate Renew Date <small style="color:red;font-size:14px;">*</small></th>
                            
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
                              
                              <input type="hidden" name="certCode[]" value="">
                              
                              <input list="certList" class="form-control ccode" name="cert_code[]" id="cert_code1" placeholder="Enter Certificate Code" value="{{ old('cert_code')}}"  onchange="funCertCode(1)" autocomplete="off">

                                <datalist id="certList">

                                 <option selected="selected" value="">--Select--</option>

                                  <option value='CF' data-xyz ="Certificate Of Fitness" > [ Certificate Of Fitness ]</option>
                                  <option value='S-Permit' data-xyz ="State Permit" > [ State Permit ]</option>
                                  <option value='N-Permit' data-xyz ="National Permit" >[ National Permit ]</option>
                                  <option value='RTO' data-xyz ="RTO Tax" >[ RTO Tax ] </option>
                                  <option value='Danta' data-xyz ="Danta Tax" >[ Danta Tax ] </option>
                                  <option value='Insurance' data-xyz ="Vehicle Insurance" > [ Vehicle Insurance ] </option>
                                  <option value='Pollution' data-xyz ="PUC" > [ PUC ] </option>

                                </datalist>
                                <input type="hidden" name="cert_name[]" id="cert_name1"value="">
                                
                                <small id="certCodeErr1" style="font-weight:700;"></small>

                            </td>

                            <td class="tdthtablebordr" style='padding-top: 2%;'>
                              
                              <input type="text" class="form-control Number" name="cert_no[]" id="cert_no1" value="{{ old('cert_no')}}" placeholder="Enter Certificate Number" maxlength="10"  onchange="funCertNo(1)" autocomplete="off">

                              <small id="cert_noErr1" style="font-weight:700;"></small>

                            </td>

                           <td class="tdthtablebordr" style='padding-top: 2%;'>
                              
                             <input type="text" class="form-control" name="cert_date[]" id="cert_date1" value="" placeholder="Enter Certificate Date" onclick="funCertDate(1)" autocomplete="off">

                             <small id="cert_dateErr1" style="font-weight:700;"></small>
                                
                           </td>

                           <td class="tdthtablebordr" style='padding-top: 2%;'>
                              
                            <input type="text" name="certRnew_dueDt[]" id="certRnew_dueDt1" class="form-control renew_deuDt" placeholder="Enter Certificate Renew"  value="{{ old('certRnew_dueDt')}}"   autocomplete="off"> 

                            <small id="certRnew_dueDtErr1" style="font-weight: 700;"></small>

                           </td>

                            <td class="tdthtablebordr" style='padding-top: 2%;'>
                              
                              
                              <input type="text" name="cert_rnew_dt[]" id="cert_rnew_dt1" class="form-control" placeholder="Enter Certificate Renew Date" value="{{ old('cert_rnew_dt')}}" readonly="" autocomplete="off">

                              <small id="cert_rnew_dtErr1" style="font-weight:700;"></small>

                            </td>
                          
                          </tr>

                    </table>

                    <div class="modal fade" id="infovehicalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            ...
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    </div>

                    <small id="infoErr" style="font-weight: 700;"></small><br><br>

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

function funTruckNo(){

  var truck_no = $('#truck_no').val();
  var xyz      = $('#truckList option').filter(function() {

  return this.value == truck_no;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';
  
  if(msg == 'No Match'){

      $('#truck_no').val('');

  }else{
    $('#truck_no').css('border-color','#d2d6de');
    $('#truck_no').attr('readonly',true);
    // $('#cert_code'+id).prop('disabled',false);
    // $('#cert_code'+id).css('border-color','#ff0000').focus();
  }
}


var chkCerCode = [];
function funCertCode(id){
  
    $('#truckNoErr').html('');

    var certCode = $('#cert_code'+id).val();

    var xyz = $('#certList option').filter(function() {

    return this.value == certCode;

     }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';
          
    if(msg == 'No Match'){

      $('#cert_code'+id).val('');
      $('#cert_name'+id).val('');
      $('#cert_date'+id).val('');
      $('#certRnew_dueDt'+id).val('');
      $('#cert_rnew_dt'+id).val('');
    }else{
    
    $('#cert_name'+id).val(msg);
    var dArrLen = chkCerCode.length;
    
    if(dArrLen > 0){
      
      for(var k=0; k< dArrLen;k++){

          if(chkCerCode[k] == certCode){
           
           $('#certCodeErr'+id).html('Please select another certificate code').css('color','red');
             return false;
          }else{
            // var dataArray = chkCerCode.push(certCode);
          }

      }
       $('#certCodeErr'+id).html('');
       var dataArray = chkCerCode.push(certCode);
     

    }else{
      
      var dataArray = chkCerCode.push(certCode);
     
    }

    var truck_no = $('#truck_no').val();
    
    if(truck_no != '' && certCode != '' ){

      $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

           }
      });

      $.ajax({

         url:"{{ url('/logistic/fleet-certi-vehical-info') }}",

         type: "POST",

         data: {truck_no:truck_no},

         success:function(data){

          var data1 = JSON.parse(data);
          var vehicle_data = data1.data;

          if(data1.response == 'success'){

           if(certCode == 'CF'){

            var crdate = data1.data.fitUpto;
            var dueDt =  crdate.split("/");

            var cr_dDate = new Date(dueDt[2], dueDt[1] - 1, dueDt[0]);
            
            var getdate1  = cr_dDate.getDate();
            var getMonth1 = cr_dDate.getMonth()+1;
            var getYear1  = cr_dDate.getFullYear();

            var mo        = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(cr_dDate);
            var da        = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(cr_dDate);
              
            var formDate =da+'-'+mo+'-'+getYear1;
            // var formDate ='10-12-2021';
            var currDate = new Date();
            
            if(cr_dDate < currDate){
            	
            	$('#certRnew_dueDtErr'+id).html('Certificate of Fitness was expired ').css('color','red');
            	$('#certRnew_dueDt'+id).val(formDate);
            	$('#certRnew_dueDt'+id).prop('disabled',true);
            	$('.addmore').prop('disabled',true);
            	$('#saveData').prop('disabled',true);

            }else{

            	$('#certRnew_dueDt'+id).val(formDate);
	            $('#certRnew_dueDt'+id).prop('readonly', true);

	            var d = new Date(cr_dDate);

	            d.setDate(d.getDate() - 1);
	             
	            var getdate   = d.getDate();
	            var getMonth  = d.getMonth()+1;
	            var getYear   = d.getFullYear();
	            var dueDate   = getYear+'-'+getMonth+'-'+getdate;
	              
	            var d         = new Date(dueDate);
	            var mo        = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
	            var da        = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
	              
	            var next_date =da+'-'+mo+'-'+getYear;
	              $('#cert_rnew_dt'+id).val(next_date);
            }
            
               
           }

           if(certCode == 'Insurance'){

            var insurance_no = data1.data.insurancePolicyNo;
            var insuranceUpto = data1.data.insuranceUpto;
            
            $('#cert_no'+id).val(insurance_no);

            var issue_Dt = insuranceUpto.split("/");

            // var insuranceUpto = new Date();

            var insur_dDate = new Date(issue_Dt[2], issue_Dt[1] - 1, issue_Dt[0]);
            var getIdate  = insur_dDate.getDate();
            var getIMonth = insur_dDate.getMonth()+1;
            var getIYear  = insur_dDate.getFullYear();

            var mo        = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(insur_dDate);

            var da        = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(insur_dDate);

            var issuDueDt =da+'-'+mo+'-'+getIYear;

            var currDate = new Date();

            if(insur_dDate < currDate){

            	$('#certRnew_dueDtErr'+id).html('Insurance was expired ').css('color','red');
            	$('#certRnew_dueDt'+id).val(issuDueDt);
            	$('#certRnew_dueDt'+id).prop('disabled',true);
            	$('.addmore').prop('disabled',true);
            	$('#saveData').prop('disabled',true);

            }else{

              $('#certRnew_dueDt'+id).val(issuDueDt);
      				$('#certRnew_dueDt'+id).prop('readonly', true);
      				
      				var d  = new Date(insur_dDate);
      				
      				d.setDate(d.getDate() - 1);
      				
      				var getIsuDate  = d.getDate();
      				var getIsuMonth = d.getMonth()+1;
      				var getIsuYear  = d.getFullYear();
      				var issueRdDt   = getIsuYear+'-'+getIsuMonth+'-'+getIsuDate;
      				
      				var d           = new Date(issueRdDt);
      				var mo          = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
      				var da          = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
      				
      				var next_date   =da+'-'+mo+'-'+getIsuYear;
      				$('#cert_rnew_dt'+id).val(next_date);

            }

            

           }

           if(certCode == 'Pollution'){

            var puccNo = data1.data.puccNo;
            var puccUpto = data1.data.puccUpto;
            
            $('#cert_no'+id).val(puccNo);

            if(puccUpto == undefined){
             
             $('#certCodeErr'+id).html('Information Not Find').css('color','red');
              
            }else{

	            var issue_Dt = puccUpto.split("/");

	            // var puccUptodate = new Date(issue_Dt[2], issue_Dt[1] - 1, issue_Dt[0]);

	            var pucc_dDate = new Date(issue_Dt[2], issue_Dt[1] - 1, issue_Dt[0]);
	            var getPuccdate  = pucc_dDate.getDate();
	            var getPuccMonth = pucc_dDate.getMonth()+1;
	            var getPuccYear  = pucc_dDate.getFullYear();

	            var mo        = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(pucc_dDate);

	            var da        = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(pucc_dDate);

	            var puccDt =da+'-'+mo+'-'+getPuccYear;

	            var currDate = new Date();

	            if(pucc_dDate < currDate){

	            	$('#certRnew_dueDtErr'+id).html('Pollution was expired ').css('color','red');
	            	$('#certRnew_dueDt'+id).val(puccDt);
	            	$('#certRnew_dueDt'+id).prop('disabled',true);
	            	$('.addmore').prop('disabled',true);
	            	$('#saveData').prop('disabled',true);

	            }else{

	            	$('#certRnew_dueDt'+id).val(puccDt);
		            $('#certRnew_dueDt'+id).prop('readonly', true);

		            var d = new Date(pucc_dDate);

		            d.setDate(d.getDate() - 1);
		           
		            var getpuccDate   = d.getDate();
		            var getpuccMonth  = d.getMonth()+1;
		            var getpuccYear   = d.getFullYear();
		            var puccRdDt  = getpuccYear+'-'+getpuccMonth+'-'+getpuccDate;

		            var dt         = new Date(puccRdDt);
		            
		            var mo        = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(dt);
		            var da        = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(dt);

		            
		            var next_date =da+'-'+mo+'-'+getpuccYear;
					      $('#cert_rnew_dt'+id).val(next_date);

	            }

            }
         }
          
          }
         

          

         }
      });


    }
    

    
  }
}

function funCertNo(id){

  var certNo = $('#cert_no'+id).val();
  
  if(certNo == ''){
     
  }else{

   $('#certCodeErr'+id).html('');
    // $('#cert_no'+id).attr('readonly',true);
    // $('#cert_date'+id).prop('disabled',false);
    // $('#cert_date'+id).css('border-color','#ff0000').focus();
  }
}

function funCertDate(id){

	var certRDueDate = $('#certRnew_dueDt'+id).val();
	
	if(certRDueDate == ''){

		$('#cert_date'+id).datepicker({
	      format: 'dd-mm-yyyy',
	      orientation: 'bottom',
	      todayHighlight: 'true',
	      // endDate: 'today',
	      autoclose: 'true'
	    });

	    $('#cert_date'+id).datepicker('show');

	    var chkDate = $('#cert_date'+id).val();

        $('#certCodeErr'+id).html('');
	    
 
    }else{

    var dueDt        = certRDueDate.split("-");
	
  	var d            = new Date(dueDt[2], dueDt[1] - 1, dueDt[0]);
  	
  	d.setDate(d.getDate() - 1);
  	var getdate      = d.getDate();
  	var getMonth     = d.getMonth()+1;
  	var getYear      = d.getFullYear();
  	var formDate     = getYear+'-'+getMonth+'-'+getdate;
  	
  	var d            = new Date(formDate);
  	var mo           = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
  	var da           = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
	
	  var prev_date    =da+'-'+mo+'-'+getYear;
	
  	$('#cert_date'+id).datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      endDate: prev_date,
      autoclose: 'true'
    });

    $('#cert_date'+id).datepicker('show');
  }
}


$("#certRnew_dueDt1").click(function() {
          
	var cert_date = $('#cert_date1').val();
  
  var dueDt     = cert_date.split("-");

	var d         = new Date(dueDt[2], dueDt[1] - 1, dueDt[0]);

	d.setDate(d.getDate() - 1);
	var getdate   = d.getDate();
	var getMonth  = d.getMonth()+1;
	var getYear   = d.getFullYear();
	var formDate  = getYear+'-'+getMonth+'-'+getdate;

	var d         = new Date(formDate);
	var mo        = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
	var da        = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

	var next_date =da+'-'+mo+'-'+getYear;
	
	if(cert_date != ''){

		$('#certRnew_dueDt1').datepicker({
	      format: 'dd-mm-yyyy',
	      orientation: 'bottom',
	      todayHighlight: 'true',
	      startDate: next_date,
	      autoclose: 'true'
	    });

	   $('#certRnew_dueDt1').datepicker('show');
	     
	}
	 



	}).on("change", function() {
	var dateObject = $('#certRnew_dueDt1').datepicker('getDate'); 

	  // var dateObject = renewDate;
	dateObject.setDate(dateObject.getDate() - 1);
	var getdate = dateObject.getDate();
	var getMonth=dateObject.getMonth()+1;
	var getYear = dateObject.getFullYear();
	var formDate =getYear+'-'+getMonth+'-'+getdate;

	var d = new Date(formDate);
	var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
	var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

	var next_date =da+'-'+mo+'-'+getYear;

	$('#cert_rnew_dt1').val(next_date);
	});
 

// function funCertRnewDuedt(id){

// 	var cert_date = $('#cert_date'+id).val();
// 	console.log('cert_date',cert_date);
	
// 	var dueDt     = cert_date.split("-");
	
// 	var d         = new Date(dueDt[2], dueDt[1] - 1, dueDt[0]);
	
// 	d.setDate(d.getDate() + 1);
// 	var getdate   = d.getDate();
// 	var getMonth  = d.getMonth()+1;
// 	var getYear   = d.getFullYear();
// 	var formDate  = getYear+'-'+getMonth+'-'+getdate;
	
// 	var d         = new Date(formDate);
// 	var mo        = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
// 	var da        = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
	
// 	var next_date =da+'-'+mo+'-'+getYear;
// 	console.log('next_date',next_date);

//     // var certRnewDueDt = $('#certRnew_dueDt'+id).val();
  
// 	if(cert_date == ''){
	     
// 	}else{

// 	  $('#certRnew_dueDt'+id).datepicker({
//       format: 'dd-mm-yyyy',
//       orientation: 'bottom',
//       todayHighlight: 'true',
//       startDate: next_date,
//       autoclose: 'true'
//     });

//      $('#certRnew_dueDt'+id).datepicker('show');


	   
// 	}
// }

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


  function checkAccommo(){

      obj = $('#tblFleetTran tr').find('span');
      $.each( obj, function(key, value) {

          id=value.id;
          $('#'+id).html(key+1);

      });

  }



$(function(){

var i=2;

  var chkCert = [];
  
  $(".addmore").on('click',function(){ 

    $('#infoErr').html('');

    count=$('#tblFleetTran tr').length;

    countTr = count-1;

    var truckNo  =  $('#truck_no').val();
   
    if(truckNo == ''){
      
      $('#truckNoErr').html('Vehicle No. Field Is Required').css('color','red');
      return false;

    }else{

      $('#truckNoErr').html('');

    }
    
    var cert_code  =  $('#cert_code'+countTr).val();
   
    if(cert_code == ''){
      
      $('#certCodeErr'+countTr).html('Certificate Code Field Is Required').css('color','red');
      $('#truckNoErr').html('');
      return false;

    }else{
      $('#truckNoErr').html('');
      $('#cert_code'+countTr).prop('readonly',true);
      $('#certCodeErr'+countTr).html('');

      

     }
    
    var cert_no  =  $('#cert_no'+countTr).val();
    
    if(cert_no == ''){

      $('#cert_noErr'+countTr).html('Certificate No Field Is Required').css('color','red');
      return false;

    }else{
       $('#cert_noErr'+countTr).html('');
       $('#cert_no'+countTr).prop('readonly',true);
    }

    var cert_date  =  $('#cert_date'+countTr).val();
    
    if(cert_date == ''){

      $('#cert_dateErr'+countTr).html('Certificate Date Field Is Required').css('color','red');
      return false;

    }else{

       $('#cert_dateErr'+countTr).html('');
       $('#cert_date'+countTr).prop('readonly',true);
    }

    var certRnew_dueDt  =  $('#certRnew_dueDt'+countTr).val();
    
    
    if(certRnew_dueDt == ''){

      $('#certRnew_dueDtErr'+countTr).html('Certificate Renew Due Date Field Is Required').css('color','red');
      return false;

    }else{
       $('#certRnew_dueDtErr'+countTr).html('');
       $('#certRnew_dueDt'+countTr).prop('readonly',true);
    }

    var cert_rnew_dt  =  $('#cert_rnew_dt'+countTr).val();
    
    if(cert_rnew_dt == ''){

      $('#cert_rnew_dtDtErr'+countTr).html('Certificate Renew  Date Field Is Required').css('color','red');
      return false;

    }else{
       $('#cert_rnew_dtErr'+countTr).html('');
       $('#cert_rnew_dt'+countTr).prop('readonly',true);

        // var data='<tr><td class="tdthtablebordr" style="padding-top: 23px;"><input type="checkbox" class="case" id="checkId'+count+'" value="'+count+'"/></td><td class="tdthtablebordr" style="padding-top: 22px;"><span id="snum'+i+'">'+count+'.</span><input type="hidden" name="TravelDetlSlno[]" id="TravelDetlSlno_id" value="'+count+'"></td>';
        var data='<tr><td class="tdthtablebordr" style="padding-top: 23px;"><input type="checkbox" class="case" id="checkId'+count+'" value="'+count+'"/></td>';

        data += '<td class="tdthtablebordr" style="padding-top: 2%;""><input type="hidden" name="certCode[]" value=""><input list="certList" class="form-control ccode" name="cert_code[]" id="cert_code'+count+'" placeholder="Enter Certificate Code" value=""  onchange="funCertCode('+count+')" autocomplete="off"><datalist id="certList"><option selected="selected" value="">--Select--</option><option value="CF" data-xyz ="Certificate Of Fitness" > [ Certificate Of Fitness ]</option><option value="S-Permit" data-xyz ="State Permit" > [ State Permit ]</option><option value="N-Permit" data-xyz ="National Permit" >[ National Permit ]</option><option value="RTO" data-xyz ="RTO Tax" >[ RTO Tax ] </option><option value="Danta" data-xyz ="Danta Tax" >[ Danta Tax ] </option><option value="Insurance" data-xyz ="Vehicle Insurance" > [ Vehicle Insurance ] </option><option value="Pollution" data-xyz ="PUC" > [ PUC ] </option></datalist> <input type="hidden" name="cert_name[]" id="cert_name'+count+'" value=""><small id="certCodeErr'+count+'" style="font-weight:700;"></small></td> <td class="tdthtablebordr" style="padding-top: 2%;"><input type="text" class="form-control Number" name="cert_no[]" id="cert_no'+count+'" value="" placeholder="Enter Certificate Number" maxlength="10"  onchange="funCertNo('+count+')" autocomplete="off"><small id="cert_noErr'+count+'" style="font-weight:700;"></small></td><td class="tdthtablebordr" style="padding-top: 2%;"><input type="text" class="form-control" name="cert_date[]" id="cert_date'+count+'" value="" placeholder="Enter Certificate Date"  onclick="funCertDate('+count+')" autocomplete="off"><small id="cert_dateErr'+count+'" style="font-weight:700;"></small></td><td class="tdthtablebordr" style="padding-top: 2%;"><input type="text" name="certRnew_dueDt[]" id="certRnew_dueDt'+count+'" class="form-control renew_deuDt" placeholder="Enter Certificate Renew"  value=""  autocomplete="off" ><small id="certRnew_dueDtErr'+count+'" style="font-weight:700;"></small></td><td class="tdthtablebordr" style="padding-top: 2%;"><input type="text" name="cert_rnew_dt[]" id="cert_rnew_dt'+count+'" class="form-control" placeholder="Enter Certificate Renew Date" value="" readonly="" autocomplete="off"><small id="cert_rnew_dtErr'+count+'" style="font-weight:700;"></small></td></tr>';

        $('#tblFleetTran').append(data);
        
       //  $("#certRnew_dueDt"+count).click(function() {
          
       //    var startDT = $('#cert_date'+count).val();

       //    $('#certRnew_dueDt'+count).datepicker({
       //    format: 'dd-mm-yyyy',
       //    orientation: 'bottom',
       //    todayHighlight: 'true',
       //    //startDate: startDT ,
       //    autoclose: 'true',

         
       //  });
        
       // $(this).datepicker().datepicker( "show" );

       //  }).on("change", function() {
       //  var dateObject = $('#certRnew_dueDt'+count).datepicker('getDate'); 

       //    // var dateObject = renewDate;
       //  dateObject.setDate(dateObject.getDate() + 1);
       //  var getdate = dateObject.getDate();
       //  var getMonth=dateObject.getMonth()+1;
       //  var getYear = dateObject.getFullYear();
       //  var formDate =getYear+'-'+getMonth+'-'+getdate;
        
       //  var d = new Date(formDate);
       //  var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
       //  var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

       //  var next_date =da+'-'+mo+'-'+getYear;
        
       //  $('#cert_rnew_dt'+count).val(next_date);
       //  });
       $("#certRnew_dueDt"+count).click(function() {
          
		var cert_date = $('#cert_date'+count).val();


		var dueDt     = cert_date.split("-");

		var d         = new Date(dueDt[2], dueDt[1] - 1, dueDt[0]);

		d.setDate(d.getDate() + 1);
		var getdate   = d.getDate();
		var getMonth  = d.getMonth()+1;
		var getYear   = d.getFullYear();
		var formDate  = getYear+'-'+getMonth+'-'+getdate;

		var d         = new Date(formDate);
		var mo        = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
		var da        = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

		var next_date =da+'-'+mo+'-'+getYear;
		
			if(cert_date != ''){

				$('#certRnew_dueDt'+count).datepicker({
			      format: 'dd-mm-yyyy',
			      orientation: 'bottom',
			      todayHighlight: 'true',
			      startDate: next_date,
			      autoclose: 'true'
			    });

			   $('#certRnew_dueDt'+count).datepicker('show');
			     
			}
		 
	    }).on("change", function() {
		var dateObject = $('#certRnew_dueDt'+count).datepicker('getDate'); 

		dateObject.setDate(dateObject.getDate() - 1);
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

    var all_certCode= [];
    var all_certName= [];
    var all_certNo= [];
    var all_certDate= [];
    var all_certRDuedate= [];
    var all_certRnewdate= [];


 $(document).ready(function(){

  $('#saveData').on('click',function(){

    var truckNo = $('#truck_no').val();

    if(truckNo == ''){

      $('#truckNoErr').html('Truck No Field is required').css('color','red');
      return false;
    }else{
      $('#truckNoErr').html('');
    }

   var count=$('#tblFleetTran tr').length;
   var countTr = count-1;

   for(var l=1;l <= countTr;l++){

    var cert_code  =  $('#cert_code'+l).val();
    var cert_name  =  $('#cert_name'+l).val();
    
    if(cert_code == ''){
      
      $('#certCodeErr'+l).html('Certificate Code Field Is Required').css('color','red');
      $('#truckNoErr').html('');
      return false;

    }else{
      $('#truckNoErr').html('');
      $('#certCodeErr'+l).html('');
      all_certCode.push(cert_code);
      all_certName.push(cert_name);
     }
    
    
    var cert_no  =  $('#cert_no'+l).val();
    
    if(cert_no == ''){

      $('#cert_noErr'+l).html('Certificate No Field Is Required').css('color','red');
      return false;

    }else{
       $('#cert_noErr'+l).html('');
       all_certNo.push(cert_no);
    }
    

    var cert_date  =  $('#cert_date'+l).val();
    
    if(cert_date == ''){

      $('#cert_dateErr'+l).html('Certificate Date Field Is Required').css('color','red');
      return false;

    }else{
       $('#cert_dateErr'+l).html('');
       all_certDate.push(cert_date);
       
    }
    

    var certRnew_dueDt  =  $('#certRnew_dueDt'+l).val();
    
    if(certRnew_dueDt == ''){

      $('#certRnew_dueDtErr'+l).html('Certificate Renew Due Date Field Is Required').css('color','red');
      return false;

    }else{
       $('#certRnew_dueDtErr'+countTr).html('');
        all_certRDuedate.push(certRnew_dueDt);
    }
   

    var cert_rnew_dt  =  $('#cert_rnew_dt'+l).val();
    
    if(cert_rnew_dt == ''){

      $('#cert_rnew_dtDtErr'+l).html('Certificate Renew  Date Field Is Required').css('color','red');
      return false;

    }else{
      all_certRnewdate.push(cert_rnew_dt);
    }
   
   

   }
   
   $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

             }
  });

  $.ajax({

          url:"{{ url('form-fleet-certificate-save') }}",

           type: "POST",

           data: {truckNo:truckNo,all_certCode:all_certCode,all_certName:all_certName,all_certNo:all_certNo,all_certDate:all_certDate,all_certRDuedate:all_certRDuedate,all_certRnewdate:all_certRnewdate},

           success:function(data){

            var data1 = JSON.parse(data);

            if(data1.response == 'success'){

              // location.reload();
              setTimeout(function () {
                  
                var pageName = btoa('FleetCertTran');
                  
                window.location.href = "{{ url('/logistic/fleet-certificate-tran/success-message')}}/"+pageName+"";

                }, 500);

            }
            if(data1.response == 'error'){

              console.log('error');

            }
            if(data1.response == 'duplicate'){
              $('#truckNoErr').html('Truck No is already Exit').css('color','red');
             $('#feetCerForm')[0].reset();
            }

          }

    });

    }) 
  })



// $(document).ready(function(){

  
//   $("#cert_rnew_dt").prop("disabled", true);

//   $('#cert_code').on('change',function(){

//         $.ajaxSetup({

//             headers: {

//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

//                }
//         });



//       var truck_no   =  $('#truck_no').val();
      
//       var cert_code  =  $('#cert_code').val();
      
//       var datastring = "truck_no="+truck_no+"&cert_code="+cert_code;

    

//         $.ajax({

//           url:"{{ url('/logistic/get-certificate-data') }}",

//            method : "POST",

//            type: "JSON",

//            data: datastring,

//            success:function(data){

//            var data1 = JSON.parse(data);
                
             
//                 if(data1.response == 'success'){



//                   $("#cert_rnew_dt").prop("disabled",false);
//                   var date1 = new Date(data1.data[0].certificate_date);
//                   //var newDate = date1.toString('dd-mm-yyyy');

                
//           var d = new Date(date1),
//          month = '' + (d.getMonth() + 1),
//          day = '' + d.getDate(),
//          year = d.getFullYear();

//         if (month.length < 2) month = '0' + month;
//         if (day.length < 2) day = '0' + day;

//         var newdate = day+'-'+month+'-'+year;

    

              

//                   $('#cert_no').val(data1.data[0].certificate_no);
//                   $('#cert_date').val(newdate);
//                   $('#cert_rnew').val(data1.data[0].certificate_renew);
//                   $('#certID').val(data1.data[0].id);
                 
               
//                 }else if(data1.response == 'error'){

//                   var date1 ="<?php echo date('d-m-Y'); ?>";
                  

//                      $("#cert_rnew_dt").prop("disabled",true);

//                   $('#cert_no').val('');
//                   $('#cert_date').val(date1);
//                   $('#cert_rnew').val('');
//                    $('#certID').val('');
//                 }else{}

//            }

//         });

//   });

// });

</script>
<script type="text/javascript">

$(document).ready(function(){
  
 // $('.datepicker').datepicker({
 //      format: 'dd-mm-yyyy',
 //      orientation: 'bottom',
 //      todayHighlight: 'true',
 //      // startDate: 'today',
 //      autoclose: 'true'
 //  });

 

//   $(function() {
    
//     $("#certRnew_dueDt1").click(function() {
      
//       var startDT = $('#cert_date1').val();

//       $('#certRnew_dueDt1').datepicker({
//       format: 'dd-mm-yyyy',
//       orientation: 'bottom',
//       todayHighlight: 'true',
//       startDate: startDT ,
//       autoclose: 'true',

     
//     });
    
//     $(this).datepicker().datepicker( "show" );

//     }).on("change", function() {

//         var dateObject = $('#certRnew_dueDt1').datepicker('getDate'); 
//         var srno = 1;
//         cerRenewDate(dateObject,srno);
        
//   });

// });



  function cerRenewDate(renewDate,slno){
    var dateObject = renewDate;
    dateObject.setDate(dateObject.getDate() - 1);
    var getdate = dateObject.getDate();
    var getMonth=dateObject.getMonth()+1;
    var getYear = dateObject.getFullYear();
    var formDate =getYear+'-'+getMonth+'-'+getdate;
    
    var d = new Date(formDate);
    var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
    var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

    var next_date =da+'-'+mo+'-'+getYear;
    
    $('#cert_rnew_dt'+slno).val(next_date);

  }

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