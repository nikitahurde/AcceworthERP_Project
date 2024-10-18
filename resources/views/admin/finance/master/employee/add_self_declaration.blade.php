@extends('admin.main')







@section('AdminMainContent')







@include('admin.include.header')



<meta name="csrf-token" content="{{ csrf_token() }}">



@include('admin.include.navbar')







@include('admin.include.sidebar')





<style type="text/css">





.stepwizard-step p {

    margin-top: 10px;

}



.stepwizard-row {

    display: table-row;

}



.stepwizard {

    display: table;

    width: 100%;

    position: relative;

}



.stepwizard-step button[disabled] {

    opacity: 1 !important;

    filter: alpha(opacity=100) !important;

}



.stepwizard-row:before {

    top: 14px;

    bottom: 0;

    position: absolute;

    content: " ";

    width: 100%;

    height: 1px;

    background-color: #ccc;

    z-order: 0;



}



.stepwizard-step {

    display: table-cell;

    text-align: center;

    position: relative;

}



.btn-circle {

  width: 30px;

  height: 30px;

  text-align: center;

  padding: 6px 0;

  font-size: 12px;

  line-height: 1.428571429;

  border-radius: 15px;

}

.setwidthsel{

  width: 72px;

}

.amntFild{

  display: none;

}

.nonAccFild{

 display: none;

}

.showSeletedName{



    font-size: 15px;



    margin-top: 2%;



    text-align: center;



    font-weight: 600;



    color: #4f90b5;



  }

.headBox{

  width: 100px !important;

}

.staticBlock{

  width: 90px;

}
.settaxcodemodel{
    font-size: 18px;
    font-weight: 800;
    color: #5d9abd;

  }

.DatePickerToFrom{

    padding: 2px !important;

    border-radius: 1px !important;

    border: 1px solid #767676 !important;

}


.HeadTextshow{

    color: #3c8dbc;
    font-size: 90%;
    font-weight: 800;

}
.required-field::before {

    content: "*";

    color: red;

  }
.TaxCodeMargin{
  margin-left: 4%;
}
.StaticBlockGet{
  -webkit-appearance: menulist-button;
    height: 24px;
    width: 60%;
}
.submitbtnC{
  display: none;
} 
.rightnumber{
  text-align: right;
}

input[type=checkbox], input[type=radio] {
    margin: 4px 15px 0 !important;
    margin-top: 1px\9;
    line-height: normal;
}

</style>

<style>
  @media only screen and (max-width: 600px) {
   .TaxCodeMargin{
      margin-left: 0%;
    }
  }

</style>





<div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">

        <h1>Master Self Declaration
            <small>Add Details</small></h1>

          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/finance/tran-tax-mast')}}">Master Self Declaration  </a></li>



            <li class="Active"><a href="{{ URL('/finance/tran-tax-mast')}}">Add Self Declaration </a></li>



          </ol>



        </section>



  <section class="content">



    <div class="row">



      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Self Declaration</h2>

               <div class="box-tools pull-right">

                <a href="{{url('/Master/Employee/view-self-declaration')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Self Declaration</a>

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





            <div class="box-body" style="overflow-x: auto;">







               <form action="{{url('/Master/Employee/self-declaration-save')}}" method="POST" id="wagetypeform">

                @csrf
                 

                  <div class="row">

                    <div class="col-xs-12">

                      <div class="row">
                        <div class="col-md-4 TaxCodeMargin">

                          <div class="form-group">
                        
                          <label>Company Code : <span class="required-field"></span></label>

                           <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="text" class="form-control" value="{{$compName}}" readonly="" name="compName">
                             

                           </div>
                           <small> 

                              <div class="pull-left showSeletedName" id="taxText"></div>

                             </small>

                           <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('compName', '<p class="help-block" style="color:red;">:message</p>') !!}

                           </small>

                        </div>



                          <!-- /.form-group -->

                      </div>
                        <div class="col-md-2 TaxCodeMargin">

                          <div class="form-group">

                          <label>FY Year : <span class="required-field"></span></label>

                           <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="text" class="form-control" value="{{$fisYear}}" readonly="" name="fy_year">

                          </div>
                          <small> 

                              <div class="pull-left showSeletedName" id="taxText"></div>

                             </small>

                          <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('fy_year', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                        </div>



                          <!-- /.form-group -->

                      </div>

                      <div class="col-md-3 TaxCodeMargin">

                          <div class="form-group">

                          <label>Emp Code : <span class="required-field"></span></label>

                           <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input list="emp_list"  id="emp_code" name="emp_code" class="form-control  pull-left"  placeholder="Select Emp Code" oninput="empcode(1)" autocomplete="off">

                            <datalist id="emp_list">

                              @foreach($emp_list as $rows)

                                <option value="{{$rows->EMP_CODE }}" data-xyz ="{{$rows->EMP_NAME}}">{{ $rows->EMP_CODE }} = {{ $rows->EMP_NAME}}</option>
                                             

                              @endforeach

                            </datalist>

                             

                          </div>
                          <small> 

                              <div class="pull-left showSeletedName" id="taxText"></div>

                             </small>

                          <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('emp_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                        </div>



                          <!-- /.form-group -->

                      </div>
                      </div>

                      <div class="row" style="margin-top: 3%;">

                          <div class="col-md-12" >

                           
                              <table class="table table-bordered table-striped table-hover">

                                

                                <tbody>

                                  <style>
                                    .TdBold{
                                    font-weight:bold;
                                  }
                                  </style>                           

                                  <tr align="center">

                                    <td class="TdBold" style="width:10%;">Sr.No</td>

                                    <td class="TdBold" style="width:20%;">Wage Indicator</td>

                                    <td class="TdBold" style="width:15%;">Provisional Amt</td>

                                    <td class="TdBold" style="width:15%;">Actual Amt</td>

                                     <td class="TdBold" style="width:15%;">Range Amt</td>

                                  </tr>

                                  

                                  <?php 
                                 
                                    $dataSr = 1;

                                    $dataRow = 20;

                                    for($i=0;$i<$dataRow;$i++){
                                     
                                 ?>
                                    <tr>
                                       <th class="text-center"><?php echo $dataSr; ?>
                                       </th>

                                       <td class="row">
                                      
                                        <div class="input-group col-sm-12">
                                           <input type="hidden" name="srno" id="srno" value="">
                                           <input list="wageindicator_list<?php echo $dataSr; ?>"  id="wageindicator_code<?php echo $dataSr; ?>" name="wageindicator_code[]" class="form-control  pull-left" value=""onchange="indicator(<?php echo $dataSr; ?>)" placeholder="Select Wage Indicator"  disabled autocomplete="off">

                                            <datalist id="wageindicator_list<?php echo $dataSr; ?>">
                                            
                                               <option value="">--SELECT--</option>

                                               @foreach($wageindicator_list as $rows)
                                                 
                                                @if($rows->WAGEIND_TYPE == 'EARNING')
                                                <option value="{{ $rows->WAGEIND_CODE}}" data-xyz ="<?php echo $rows->WAGEIND_NAME; ?>">{{ $rows->WAGEIND_CODE }} = {{ $rows->WAGEIND_NAME }}</option>
                                                @endif
                                               

                                               @endforeach

                                            </datalist>

                                          </div>
                                           <input type="hidden" name="wageIndType[]" id="wageIndType<?php echo $dataSr; ?>" value="">
                                          <small id="wageindicatorErr<?php echo $dataSr; ?>"></small>
                                          <div class="pull-left showSeletedName" id="wageIndicatorText<?php echo $dataSr; ?>"></div>

                                    </td>

                                    <td>
                                      <input type="text" name="provAmt[]" class="form-control  pull-left"  id="provAmt<?php echo $dataSr; ?>" value="" placeholder="Prov Amt" autocomplete="off" oninput="funProvAmt(<?php echo $dataSr; ?>)">
                                       <small id="provAmtErr<?php echo $dataSr; ?>">
                                      </small>
                                    </td>

                                    <td>

                                      <input type="text" name="actualAmt[]" class="form-control  pull-left"  id="actualAmt<?php echo $dataSr; ?>" value="" placeholder="Actual Amt" autocomplete="off">
                                       <small id="actualAmtErr<?php echo $dataSr; ?>">
                                      </small>
                                    </td>

                                    <td>

                                      <input type="text" name="rangeAmt[]" class="form-control  pull-left"  id="rangeAmt<?php echo $dataSr; ?>" value="" placeholder="Range Amt" autocomplete="off">
                                       <small id="actualAmtErr<?php echo $dataSr; ?>">
                                      </small>
                                    </td>

                                   </tr>
                                 <?php 
                                  $dataSr++;  }
                                 ?>
                                 
                               </tbody>

                              </table>
                        
                          </div>
                        </div>

                        <div class="text-center">
                          <div id="showAllErrMsg"></div><br>
                        </div>

                        <div style="text-align: center;">
                          <div id="showAllErrMsg"></div><br>
                            <button type="button" id="submitokbtn" class="btn btn-primary okbtnhideaftrcheck"  onclick="return checkvalidation()">OK</button>

                        
                           <button type="submit" class="btn btn-primary submitbtnC"  style="margin-left: 10%;" id="submitbtn" ><i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;&nbsp;Save</button>
                        </div>

                  </div>
                </div>
               </form>
            </div>
        </div>
  </div>
</div>

</section>



</div>

@include('admin.include.footer')

<script type="text/javascript">



 function funProvAmt(rowId){

   var provAmt = $('#provAmt'+rowId).val();
   var nextId = rowId+1;
    
    if(provAmt != ''){

       $('#provAmtErr'+rowId).html('');
       $('#wageindicator_code'+nextId).prop('disabled', false);
       // $('#actualAmtErr'+rowId).html('Required').css('color','red');

    }else {
       // $('#actualAmtErr'+rowId).html('');
       $('#actualAmt'+rowId).val('');
       $('#provAmtErr'+rowId).html('Required').css('color','red');
       $('#wageindicator_code'+nextId).prop('disabled', true);
    }

  }

  // function funActualAmt(rowId){

  //  var actualAmt = $('#actualAmt'+rowId).val();
  //  var nextId = rowId+1;
    
  //   if(actualAmt != ''){

  //      $('#actualAmtErr'+rowId).html('');
  //      $('#wageindicator_code'+nextId).prop('disabled', false);

  //   }else {
  //      $('#actualAmtErr'+rowId).html('Required').css('color','red');
  //      $('#wageindicator_code'+nextId).prop('disabled', true);
  //   }

  // }

 function empcode(inputid){
  var emp_code =  $('#emp_code').val();

   if(emp_code){
    $('#empcodeErr').html('');
    $('#wageindicator_code'+inputid).prop('disabled', false);
    $('#wageindicatorErr'+inputid).html('Required').css('color','red');

   }else{

    $('#empcodeErr').html('Required');

   }
 }


 function indicator(headid){

     var valInd = $('#wageindicator_code'+headid).val();

      var xyzInd = $('#wageindicator_list'+headid+' option').filter(function() {

        return this.value == valInd;


        }).data('xyz');

        var msgInd = xyzInd ?  xyzInd : 'No Match';

        if(msgInd=='No Match'){

          $('#wageindicator_code'+headid).val('');

           $('#wageIndicatorText'+headid).html('');

           $('#wageindicatorErr'+headid).html('Required').css('color','red');

           $('#provAmtErr'+headid).html('');

        }else{

          $('#wageIndicatorText'+headid).html(msgInd);

          $('#wageindicatorErr'+headid).html('');

          $('#provAmtErr'+headid).html('Required').css('color','red');
          
        }

        var wageInd = $('#wageindicator_code'+headid).val();
        
        var wageindicator_code = $('#wageindicator_code'+headid).val();
 }    

 function checkvalidation(){
 	

    var empcode =  $('#emp_code').val();

    if(empcode == ''){

    	$('#showAllErrMsg').html('');

    	$('#showAllErrMsg').html('<div class="alert alert-danger alert-dismissible" role="alert"><strong>Error ...!</strong>Employee Code Are Required.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    	return false;
    }
 	for(var j=1;j<=20;j++){

 		

 	    var wageIndi =  $('#wageindicator_code'+j).val();
        var wageIndi_err =  $('#wageindicatorErr'+j).html();

 		var provAmt = $('#provAmt'+j).val();
 		var provAmt_err =  $('#provAmtErr'+j).html();

 		var actualAmt =  $('#actualAmt'+j).val();
        
        var actualAmt_err =  $('#actualAmtErr'+j).html();
        

        console.log('provAmt_err'+j,provAmt_err);
        console.log('actualAmt_err'+j,actualAmt_err);

        if(provAmt_err == 'Required' || actualAmt_err == 'Required' || wageIndi_err == 'Required'){

        	$('#showAllErrMsg').html('');

        	$('#showAllErrMsg').html('<div class="alert alert-danger alert-dismissible" role="alert"><strong>Error ...!</strong> Some Fields Are Required.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                
            $('#submitbtn').addClass('submitbtnC');

            $('#submitokbtn').show();

            return false;
        }else{
        	
        	 $('#submitokbtn').hide();

        	 $('#submitbtn').removeClass('submitbtnC');

        	
        }
       

        

 	}

 }

</script>

@endsection