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
  .rightcontent{

  text-align:right;


}
::placeholder {
  
  text-align:left;
}

  .Custom-Box {
      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  .showinmobile{
    display: none;
  }

  .secondSection{

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

  width: 100px;

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

.settblebrodr{
  border: 1px solid #cac6c6;
}

.tdlboxshadow{

  box-shadow: 0px 1px 4px -1px rgba(161,155,161,1);

}


.btn {

    display: inline-block;

    font-weight: 400;

    text-align: center;

    vertical-align: middle;

    cursor: pointer;

    -webkit-user-select: none;

    -moz-user-select: none;

    -ms-user-select: none;

    user-select: none;

    padding: .375rem .75rem;

    font-size: 14px;

    line-height: 1.5;

    border-radius: .25rem;

    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.btn-success {

    color: #fff;

    background-color: #28a745;

    border-color: #28a745;

}

.btn-info {

    color: #fff;

    background-color: #04a9ff;

    border-color: #04a9ff;

}


.text-center{

  text-align: center;

}


.title{

    margin-top: 50px;

    margin-bottom: 20px;

}


table {

   border-collapse: collapse;

}

.table-responsive {

    display: block;

    width: 100%;

    overflow-x: auto;

    -webkit-overflow-scrolling: touch;

}

.table {

    width: 100%;

    margin-bottom: 1rem;

    color: #212529;
}

.table thead th {

    vertical-align: bottom;

    border-bottom: 2px solid #dee2e6;

}

.table td, .table th {

    padding: .75rem;

    vertical-align: top;

}

.container{

    max-width: 1200px;

    margin: 0px auto;

    padding: 0px 15px;

}

.inputboxclr{

  border: 1px solid #d7d3d3;
}

.tdthtablebordr{
  border: 1px solid #00BB64;
}

input:focus{border:1px solid yellow;} 

.space{margin-bottom: 2px;}

.but{

    width:105px;

    background:#00BB64;

    border:1px solid #00BB64;

    height:40px;

    border-radius:3px;

    color:white;

    margin-top:10px;

    margin:0px 0px 0px 11px;

    font-size: 14px;

}

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 6px;

    padding-bottom: 0px !important;

    line-height: 1.42857143;

    vertical-align: top;

    border-top: 1px solid #ddd;

    text-align: center;
}

.ref::before {

  color: navy;

  content: "Ch :";
}

.toalvaldesn{

    text-align: right;

    font-weight: 800;

    margin-top: 1%;
}

.debitotldesn{

    width: 277%;

    margin-left: 45%;

    text-align: end;

}

.credittotldesn{

    width: 277%;

    margin-left: -11%;

    text-align: end;
}

.debitcreditbox{

  width: 91px;

  text-align: end;
}

.savebtnstyle{

    color: #fff;

    background-color: #204d74;

    border-color: #122b40;
}

.onFocusBorder{
  border-color: red !important;
}

.multiSelectFocusBorder{
  border: 1px solid red !important;
}

.cnaclbtnstyle{

    color: #fff;

    background-color: #d9534f;

    border-color: #d43f3a;
}

.instrumentlbl{

    font-size: 12px;

    margin-left: -5px;
}

.instTypeMode{

    width: 56%;

    margin-bottom: 5px;
}

.textdesciptn{

  width: 250px;

  margin-bottom: 5px;
}

.tdsratebtn{

  margin-top: 3% !important;

  font-weight: 600 !important;

  font-size: 10px !important;

}

.tdsInputBox{

  margin-bottom: 2%;

}

.modltitletext{
  font-weight: 800;
  color: #5696bb;
  margin-left: -11%;
  font-size: 16px;
}

.textSizeTdsModl{

  font-size: 13px;

}

.btn_new{
    display: inline-block;
    font-weight: 600;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding: 0.375rem 0.75rem;
    font-size: 14px;
    line-height: 1.5;
    border-radius: 1.25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.bankshowwhenrecpt{

  display: none !important;
}

.setboxWidthIndex{

  width: 25px;

  border: 1px solid #b8b6b6;

}

.SetInCenter{

    text-align: center !important;

}

.AddM{

  width: 24px;

}
.divhsn{
      color: #3c8dbc;
    font-size: 13px;
    font-weight: 800;
    margin-bottom: 8%;
}
@media screen and (max-width: 600px) {

  .debitotldesn{

    width: 89px;

    margin-bottom: 5px;

    margin-left: 13%;

  }

  .credittotldesn{

    width: 89px;

    margin-bottom: 5px;

    margin-left: -34%;
  }

  .totlsetinres{

    width: 130%;

  }

  .textdesciptn{

    margin-bottom: -1%;

  }

  .debitcreditbox{

    margin-top: 0%;

  }

  .rowClass{

    overflow-x: scroll;

  }

}

</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Engine Table Config

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Configration</a></li>

            <li class="active"><a href="{{ url('configration/engine-table-config') }}">Engine Table Config</a></li>

          </ol>

        </section>

	<section class="content">

	<div class="row">

	    <div class="col-sm-12">

	        <div class="box box-primary Custom-Box">

	            <div class="box-header with-border" style="text-align: center;">

	              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Engine Table Config</h2>

	              <div class="box-tools pull-right">

	                <a href="{{ url('configration/view-engine-table-config') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Engine Tbl Config</a>

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
	           
	              	<div class="row">

	              		<div class="col-md-3"></div>

	                 	<div class="col-md-3">

		                    <div class="form-group">

		                      	<label>

		                        	Tran Code : 

		                        <span class="required-field"></span>

		                      	</label>

			                    <div class="input-group">

			                          <span class="input-group-addon">

			                            <i class="fa fa-caret-down"></i>

			                          </span>

			                      

			                        <input list="tranCodeList" type="text" name="tranCode" id="tranCode" class="form-control" value="{{ old('tranCode')}}" maxlength="30" onchange="getTranCode();" placeholder="Select Tran Code">

			                        <datalist id="tranCodeList">

			                        <option selected="selected" value="">-- Select --</option>

		                                @foreach ($tranCode as $key)

		                                <option value='<?php echo $key->TRAN_CODE?>'   data-xyz ="<?php echo $key->TRAN_HEAD; ?>" ><?php echo $key->TRAN_CODE ; echo " [".$key->TRAN_HEAD."]" ; ?></option>

		                                @endforeach

			                      

			                        </datalist>

			                    </div>

		                      	<div class="pull-left showSeletedName" id="tranCodeText"></div>
		                      	<small id="tCodeValMsg" class="form-text text-muted">

		                      	</small>

		                    </div>

	                  	</div>

                      <div class="col-md-4">

                        <div class="form-group">

                            <label>

                              Tran Code Name : 

                              <div class="input-group" style='margin-top: 2%;'>

                                    <span class="input-group-addon">

                                      <i class="fa fa-caret-down"></i>

                                    </span>

                                  <input type="text" name="tranCodeName" id="tranCodeName" class="form-control" value="{{ old('tranCodeName')}}" readonly>

                              </div>
                                <small id="tCodeNameValMsg" class="form-text text-muted">

                                </small>

                        </div>

                      </div>

	                  	<div class="col-md-2"></div>
	                
	                </div>


	              	<div style="text-align: center;margin-top:2%;">

	                 	<button type="Submit" onclick="searchTbl(1)" class="btn btn-primary">

	                		<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp; Search 

	                 	</button>

	              	</div>

	          	</div><!-- /.box-body -->

	           

	        </div>

	    </div>

	</div>
     
	</section>

	{{-- Engine Body Start --}}


	<section class="content" style="margin-top: -10%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

            <form id="salesordertrans">
              @csrf
              <div class="table-responsive" style="overflow: visible;">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  	<tr>

	                    <th style="border-top: 1px solid #00bb64;border-bottom: 1px solid #00bb64;"><input class='check_all' type='checkbox' onclick="select_all()"/></th>

	                    <th style="width: 10px;border-top: 1px solid #00bb64;border-bottom: 1px solid #00bb64;"> Sr.No.</th>

	                    <th style="border-top: 1px solid #00bb64;border-bottom: 1px solid #00bb64;">Table Name <small class="required-field"></small></th>

	                    <th style="border-top: 1px solid #00bb64;border-bottom: 1px solid #00bb64;">Column Name <small class="required-field"></small></th>

	                    <th style="border-top: 1px solid #00bb64;border-bottom: 1px solid #00bb64;">Where Clause</th>

                    </tr>

                  	<tr class="useful">

	                    <td class="tdthtablebordr"  style="width: 5%;">
	                      <input type='checkbox' class='case'  />
	                    </td>

	                    <td class="tdthtablebordr" style="width: 10%;">
	                      <span id='snum' style="width: 10px;">1.</span>
	                    </td> 

		                <td class="tdthtablebordr" style="width:20%">

		                  <div class="input-group">
		                  	
		                    <input list="tblList_1" class="inputboxclr classTblName" id='tblName_1' onchange="getTblNameList(1,this.value);"   name="tblName[]" readonly />

		                      <datalist id="tblList_1">

		                          <option selected="selected" value="">-- Select --</option>

		                      </datalist>

                          <p style="margin-top:3%;">
                            <input list="masterList_1" class="inputboxclr" id="masterName_1" name="masterName[]" onchange="getTblColumnList(1,this.value);" readonly/>
                              <datalist id="masterList_1">
                                <option selected="selected" value="">-- Select --</option>
                              </datalist>
                          </p>

                          <small id="errorTblName_1"></small>

		                  </div>
		                  
		                </td>

	                    <td class="tdthtablebordr" style="width:20%">

	                      	<div class="form-group" id="divColName_1" style="margin-top: 0%;">

                                {{-- <select class="allcheckbox form-control" multiple="" id="columnName_1" onchange="getMultiColName(1,this.value);" style="margin-bottom: 5px;margin-top: 8%;" name="columnName[]">

                                
                                </select> --}}

                              <input type="text" class="inputboxclr" id="columnName_1" onclick="getMultiColName(1);" style="margin-bottom: 5px;margin-top: 8%;" name="columnName[]" disabled/>

                              <input type='hidden' name='colType[]' id='colType_1' value=''/>
                              <input type='hidden' name='colLen[]' id='colLen_1' value=''/>
                            <br>
                            <small id="errorColName_1"></small>
                          </div>

	                    </td>

	                    <td class="tdthtablebordr" style="width:40%">

                          <input type='text' class='debitcreditbox dr_amount inputboxclr'  id='whereClause_1' name='whereClause[]' style='width:100%;margin-top:5%;' readonly/>

	                    </td>

                  	</tr>

                </table>

                <input type="hidden" id='tcode_1' name='tCode'>
                <input type="hidden" id='tcodeName_1' name='tCodeName'>

                <input type="hidden" id="hiddenTblName" value="" name="hiddenTblName[]">

                <input type="hidden" id="hiddenColName" value="" name="hiddenColName[]">
                
                <input type="hidden" id="tblSrNo" value="1" name="getSrNo">

            </div><!-- /div -->

      

      <br>

        <button type="button" class='btn btn-danger delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

        <button type="button" class='btn btn-info addmore' id="addmorhidn" onclick="getTranCode()" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

        <p class="text-center">

          <button class="btn btn-success" type="button" id="submitdata" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Reset</button>

        </p>

      </div>

    </form>

  </div><!-- /.box-body -->

</div>

</div>

</div>

</section>



	{{-- Engine Body END --}}


  <div id="taxSelectModel1" class="modal fade" tabindex="-1">

        <div class="modal-dialog modal-md" style="margin-top: 5%;width: 85%;">

            <div class="modal-content" style="border-radius: 5px;">

                <div class="modal-header">

                  <div class="row">

                    <h5 class="modal-title modltitletext" id=""  style="font-weight: 800;text-align: center;margin-left: -1%;">Select Columns</h5>

                  </div>

                </div>

                <div class="modal-body table-responsive">

                    <div  style="line-height: 23px;">

                      <div class="col-sm-12">
                        <div class="row" id="showtaxcodeMul1" style="line-height: 0.3 !important;">
                          
                        </div>
                      </div>
                      
                    </div>

                </div>

                <div class="modal-footer" style="text-align: center;" id="taxCodeSelect1">

                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="selectColumnData(1);" style="width: 83px;">Ok</button>   

                </div>

            </div>

        </div>

      </div>


      <div id="addModal"></div>



</div>



@include('admin.include.footer')


<script type="text/javascript">

  $(document).ready(function(){

    $('.allcheckbox').multiselect({

      nonSelectedText: 'Select',
      enableFiltering: true,
      enableCaseInsensitiveFiltering: true,
      buttonWidth:'170px',
      includeSelectAllOption: true,
      maxHeight: 150

      
    });

  });


  /* -----Delete Row Function Start----- */
  
    $(".delete").on('click', function() {

      var noSr = $('#getSrNo').val();

      var newSR = noSr - 1;

      $('#getSrNo').val(newSR);

      $('.case:checkbox:checked').parents("tr").remove();

      $('.check_all').prop("checked", false); 

      check();

    });


  /* -----Delete Row Function End----- */


  /* -----Add More Function Start------*/
    
  var i=2;

  $(".addmore").on('click',function(){


     var count = $('table tr').length;

     var getSrNo = $('#tblSrNo').val();

      $("#columnName_"+getSrNo).removeClass('onFocusBorder');
      $("#columnName_"+getSrNo).css('border-color','#d2d6de');

     $('#tblSrNo').val(i);

      var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span></td>";

       data +="<td class='tdthtablebordr' style='width:20%'><div class='input-group'><input list='tblList_"+i+"' class='inputboxclr classTblName' id='tblName_"+i+"' onchange='getTblNameList("+i+",this.value);' name='tblName[]' /><datalist id='tblList_"+i+"'><option selected='selected' value=''>-- Select --</option></datalist><p style='margin-top:3%;'><input list='masterList_"+i+"' class='inputboxclr' id='masterName_"+i+"' name='masterName[]' onchange='getTblColumnList("+i+",this.value);' readonly /><datalist id='masterList_"+i+"'><option selected='selected' value=''>-- Select --</option></datalist></p><p><small id='errorTblName_"+i+"'></small></p></div></td>";

       data +="<td class='tdthtablebordr' style='width:20%'><div class='form-group' id='divColName_"+i+"' style='margin-top: 0%;'><input type='text' class='inputboxclr' id='columnName_"+i+"' onclick='getMultiColName("+i+");' style='margin-bottom: 5px;margin-top: 8%;' name='columnName[]' disabled/><input type='hidden' name='colType[]' id='colType_"+i+"' value=''/><input type='hidden' name='colLen[]' id='colLen_"+i+"' value=''/><br><small id='errorColName_"+i+"'></small></div></td>";

       data +="<td class='tdthtablebordr' style='width:40%'><input type='text' class='debitcreditbox dr_amount inputboxclr'  id='whereClause_"+i+"' name='whereClause[]' style='width:100%;margin-top:5%;' readonly/></td>";

      $('table').append(data);

      var modalData = "<div id='taxSelectModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-md' style='margin-top: 5%;width: 85%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='font-weight: 800;text-align: center;margin-left: -1%;'>Select Tax Code</h5></div></div></div><div class='modal-body table-responsive'><div style='line-height: 23px;'><div class='col-sm-12'><div class='row' id='showtaxcodeMul"+i+"' style='line-height: 0.3 !important;'></div></div></div></div><div class='modal-footer' style='text-align: center;' id='taxCodeSelect"+i+"'><button type='button' class='btn btn-primary' data-dismiss='modal' onclick='selectColumnData("+i+");' style='width: 83px;'>Ok</button></div></div></div></div>";

      $('#addModal').append(modalData);

      /*$('#columnName_'+i).multiselect({

        nonSelectedText: 'Select',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'170px',
        includeSelectAllOption: true,
        maxHeight: 150

        
      });*/


      i++;

  });  /*--function close--*/

  function select_all() {

    $('input[class=case]:checkbox').each(function(){ 

      if($('input[class=check_all]:checkbox:checked').length == 0){ 

        $(this).prop("checked", false); 

      }else{

        $(this).prop("checked", true); 

      } 

    });

  }

  function check(){

    obj = $('table tr').find('span');

      $.each( obj, function( key, value ) {

        //console.log('key ',key);

          id= value.id;

          $('#'+id).html(key+1);

      });
  }

  /* -----Add More Function End------*/


  /* ----- START : search click function----- */


  function searchTbl(clickID){

    var tranCode = $('#tranCode').val();
    var tranCodeName = $('#tranCodeName').val();

    $('#tcode_1').val(tranCode);
    $('#tcodeName_1').val(tranCodeName);

    $("#tblName_1").prop('readonly',false);

    $('#tblName_1').addClass('onFocusBorder').focus();

    $("#tblName_1").blur();


  }
  

  /* ----- END : search click function----- */


  /* -----get Transaction Code Onchane Start----- */


  function getTranCode(){

    setTimeout(function() {

      var Tcode = $('#tranCode').val();
      
      var getSrNo = $('#tblSrNo').val();

      $("#tranCode").prop('readonly',true);

      var xyz = $('#tranCodeList option').filter(function() {

      return this.value == Tcode;

      }).data('xyz');

      var tranName = xyz ?  xyz : 'No Match';

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });


        $.ajax({

          url:"{{ url('search-trancode-code') }}",

           method : "POST",

           type: "JSON",

           data: {Tcode: Tcode},

           success:function(data){

                
                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#showSearchCodeList').empty();

                }else if(data1.response == 'Success'){

                  //console.log('getSrNo',getSrNo);

                  var sr_no = getSrNo;

                  var newArr = [];

                  var headTbl = data1.getTranCodeList[0].TABLE_HEAD;
                  
                  newArr.push({'TblName' : headTbl});

                  var bodyTbl = data1.getTranCodeList[0].TABLE_BODY;
                  
                  newArr.push({'TblName' : bodyTbl});

                  newArr.push({'TblName' : 'MASTERS'});

                  //console.log('arr ',newArr.length);

                      objcity = newArr;

                       $('#tblList_'+sr_no).empty();

                      $.each(objcity, function (i, objcity) {


                        $('#tblList_'+sr_no).append($('<option>', { 

                          value: objcity.TblName,

                          'data-xyz': objcity.TblName,

                          text : objcity.TblName 

                        }));

                      });

                      
                }
           }

        });

      }, 500);

  }
  

  /* -----get Transaction Code Onchane End----- */


  /* -----get Masters/Head/Body Table Start----- */
    

    function getTblNameList(rowID,masterVal){


      var masterTblName = masterVal;

      var curHidVal = $('#hiddenTblName').val();

      var hiddenTname = [];

      $.ajaxSetup({

        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

      });


      if(masterTblName == 'MASTERS'){

        $('#masterName_'+rowID).addClass('onFocusBorder').focus();
        $('#masterName_'+rowID).blur();
        $("#tblName_"+rowID).removeClass('onFocusBorder');
        $("#tblName_"+rowID).css('border-color','#d2d6de');

        $.ajax({

          url:"{{ url('get-masters-table') }}",

          method : "POST",

          type: "JSON",

          data: {masterTblName: masterTblName},

          success:function(data){
                
                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#showSearchCodeList').empty();

                }else if(data1.response == 'Success'){


                      objcity = data1.masterTbl;

                      $('#masterList_'+rowID).empty();

                      $.each(objcity, function (i, objcity) {

                         //console.log('arr ',objcity.tblName);

                        $("#masterName_"+rowID).prop('readonly',false);

                        $('#masterList_'+rowID).append($('<option>', { 

                          value: objcity.tblName,

                          'data-xyz': objcity.tblName,

                          text : objcity.tblName 

                        }));

                      });

                      
                }
           }

        });


      }else{

       
        if(rowID == 1){

          $('#hiddenTblName').val(masterTblName);

          $('#columnName_'+rowID).prop("disabled", false);
          $('#columnName_'+rowID).addClass('onFocusBorder').focus();
          $('#columnName_'+rowID).blur();
          $("#tblName_"+rowID).removeClass('onFocusBorder');
          $("#tblName_"+rowID).css('border-color','#d2d6de');
          $('#errorTblName_'+rowID).html('');

        }else{

          var cur_val_new = $('#hiddenTblName').val();

          if(cur_val_new){

            var expName =  cur_val_new.split(',');

            var tblNameCot = expName.length;

            for(var t= 0;t<tblNameCot;t++){

              var newTblName = masterTblName;

              hiddenTname.push(expName[t]);
            

            }

            var checkInArr = hiddenTname.includes(masterTblName);

            if(checkInArr){

              $('#hiddenTblName').val(cur_val_new);

              $('#errorTblName_'+rowID).css('color','red').html('* Please Select Another Table.');
              $('#columnName_'+rowID).removeClass('onFocusBorder');
              
              $("#tblName_"+rowID).addClass('onFocusBorder').focus();
              $("#tblName_"+rowID).css('border-color','red');
              $('#tblName_'+rowID).blur();

              var tabNameStatus = 'match';


            }else{

              $('#hiddenTblName').val(cur_val_new + "," + masterTblName);

              $('#errorTblName_'+rowID).html('');

              var tabNameStatus = 'unmatch';

              $('#columnName_'+rowID).prop("disabled", false);
              
              $('#columnName_'+rowID).addClass('onFocusBorder').focus();
              $('#columnName_'+rowID).blur();
              $("#tblName_"+rowID).removeClass('onFocusBorder');
              $("#tblName_"+rowID).css('border-color','#d2d6de');


            }

          }

          
          //console.log('name =>',getNameTbl);


        }

       
        $.ajax({

          url:"{{ url('get-tablecolumn-list') }}",

           method : "POST",

           type: "JSON",

           data: {masterTblName: masterTblName,tabNameStatus:tabNameStatus},

           success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#showSearchCodeList').empty();

                }else if(data1.response == 'Success'){

                  objcity = data1.tblColList;

                  //console.log('status',data1.tblStatus);

                  if(data1.tblStatus == 'match'){

                     $("#columnName_"+rowID).empty();

                     //$('#columnName_'+rowID).multiselect('rebuild');

                  }else{

                    /* --- START : MASTERS COLUMN NAME --- */

                      var srNo = 2;
                     
                        $("#showtaxcodeMul"+rowID).empty();
                        $("#firstCol_"+rowID).empty();
                        $("#secondCol_"+rowID).empty();
                        $("#thirdCol_"+rowID).empty();
                        $("#fourCol_"+rowID).empty();

                        var taxData1 = '<div class="col-sm-3" id="firstCol_'+rowID+'" style="padding-top: 2%;padding-bottom: 2%;"></div>';

                        $('#showtaxcodeMul'+rowID).append(taxData1);

                        var taxData2 = '<div class="col-sm-3" id="secondCol_'+rowID+'" style="padding-top: 2%;padding-bottom: 2%;"></div>';

                        $('#showtaxcodeMul'+rowID).append(taxData2);

                        var taxData3 = '<div class="col-sm-3" id="thirdCol_'+rowID+'" style="padding-top: 2%;padding-bottom: 2%;"></div>';

                        $('#showtaxcodeMul'+rowID).append(taxData3);

                        var taxData4 = '<div class="col-sm-3" id="fourCol_'+rowID+'" style="padding-top: 2%;padding-bottom: 2%;"></div>';

                        $('#showtaxcodeMul'+rowID).append(taxData4);

                        $.each(objcity, function(key, value) {

                          var rowNo = key + 1;

                          if(rowNo > 10 && rowNo < 20){

                             var dataRow2 = '<div style="margin-left:5%">'+rowNo+') <input type="checkbox" class="taxcodeset" id="nameTbl_'+rowID+'" name="tblColName[]" data-chr="'+value.DATATYPE+'" data-len="'+value.COLLENGTH+'" value="'+value.COLNAME+'" style="margin-left:2%;"><label for="html" style="margin-left:2%;">'+value.COLNAME+'</label></div><br>';

                            $('#secondCol_'+rowID).append(dataRow2);

                          }else if(rowNo >= 20 && rowNo < 30){

                            var dataRow3 = '<div style="margin-left:5%">'+rowNo+') <input type="checkbox" class="taxcodeset" id="nameTbl_'+rowID+'" name="tblColName[]" data-chr="'+value.DATATYPE+'" data-len="'+value.COLLENGTH+'" value="'+value.COLNAME+'" style="margin-left:2%;"><label for="html" style="margin-left:2%;">'+value.COLNAME+'</label></div><br>';

                            $('#thirdCol_'+rowID).append(dataRow3);

                           //console.log('above 20 less 30',);

                          }else if(rowNo >= 30 && rowNo < 45){

                            var dataRow4 = '<div style="margin-left:5%">'+rowNo+') <input type="checkbox" class="taxcodeset" id="nameTbl_'+rowID+'" name="tblColName[]" data-chr="'+value.DATATYPE+'" data-len="'+value.COLLENGTH+'" value="'+value.COLNAME+'" style="margin-left:2%;"><label for="html" style="margin-left:2%;">'+value.COLNAME+'</label></div><br>';

                            $('#fourCol_'+rowID).append(dataRow4);

                            //console.log('above 30 less 45',);

                          }else{

                            //console.log('else',rowNo);

                            var taxData = '<div style="margin-left:5%">'+rowNo+') <input type="checkbox" class="taxcodeset" name="tblColName[]" id="nameTbl_'+rowID+'" data-chr="'+value.DATATYPE+'" data-len="'+value.COLLENGTH+'" value="'+value.COLNAME+'" style="margin-left:2%;"><label for="html" style="margin-left:2%;">'+value.COLNAME+'</label></div><br>';

                            $('#firstCol_'+rowID).append(taxData);

                          }
                          

                          srNo++;
                          
                        });

                        //$('#columnName_'+rowID).multiselect('rebuild');

                    /* --- END : MASTERS COLUMN NAME --- */

                  }

                      
                }
           }

        });


      }





    }

  /* -----get Masters/Head/Body Table End----- */


  /* ----- Start: get Table Column Name ----- */


    function getTblColumnList(rowID,tblName){

      var tblNameCur = $("#masterName_"+rowID).val();

      var hiddenTname = [];

        if(rowID == 1){
          //console.log('bottom');
          $('#hiddenTblName').val(tblNameCur);

          $('#columnName_'+rowID).prop("disabled", false);
          $('#columnName_'+rowID).addClass('onFocusBorder').focus();
          $('#columnName_'+rowID).blur();
          $("#masterName_"+rowID).removeClass('onFocusBorder');
          $("#masterName_"+rowID).css('border-color','#d2d6de');

        }else{

          var cur_val_new = $('#hiddenTblName').val();

          if(cur_val_new){

            var expName =  cur_val_new.split(',');

            var tblNameCot = expName.length;

            for(var t= 0;t<tblNameCot;t++){

              var newTblName = tblName;

              hiddenTname.push(expName[t]);
            

            }

            var checkInArr = hiddenTname.includes(tblName);

            //console.log('currVal',cur_val_new);

            if(checkInArr){

              $('#hiddenTblName').val(cur_val_new);

              //console.log('yes');
              //console.log('arrN',hiddenTname);

              $('#columnName_'+rowID).prop("disabled", true);

              $('#errorTblName_'+rowID).css('color','red').html('* Please Select Another Table.');
              $('#columnName_'+rowID).removeClass('onFocusBorder');
              
              $("#masterName_"+rowID).addClass('onFocusBorder').focus();
              $("#masterName_"+rowID).css('border-color','red');
              $('#masterName_'+rowID).blur();

              var tabNameStatus = 'match';


            }else{

              
              $('#hiddenTblName').val(cur_val_new + "," + tblName);

               $('#errorTblName_'+rowID).html('');

              $('#columnName_'+rowID).prop("disabled", false);

             
              var tabNameStatus = 'unmatch';

              $('#columnName_'+rowID).addClass('onFocusBorder').focus();
              $('#columnName_'+rowID).blur();
              $("#masterName_"+rowID).removeClass('onFocusBorder');
              $("#masterName_"+rowID).css('border-color','#d2d6de');


            }

          }else{

            console.log('val not found...!');
          }

          
          //console.log('name =>',getNameTbl);


        }


        $.ajaxSetup({

          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }

        });

        $.ajax({

          url:"{{ url('get-tablecolumn-list') }}",

           method : "POST",

           type: "JSON",

           data: {masterTblName: tblName,tabNameStatus:tabNameStatus},

           success:function(data){

                
                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#showSearchCodeList').empty();

                }else if(data1.response == 'Success'){

                  objcity = data1.tblColList;

                  if(data1.tblStatus == 'match'){

                     $("#columnName_"+rowID).empty();

                     //$('#columnName_'+rowID).multiselect('rebuild');

                  }else{

                    /* --- START : MASTERS COLUMN NAME --- */

                      var srNo = 2;
                     
                        $("#showtaxcodeMul"+rowID).empty();
                        $("#firstCol_"+rowID).empty();
                        $("#secondCol_"+rowID).empty();
                        $("#thirdCol_"+rowID).empty();
                        $("#fourCol_"+rowID).empty();

                        var taxData1 = '<div class="col-sm-3" id="firstCol_'+rowID+'" style="padding-top: 2%;padding-bottom: 2%;"></div>';

                        $('#showtaxcodeMul'+rowID).append(taxData1);

                        var taxData2 = '<div class="col-sm-3" id="secondCol_'+rowID+'" style="padding-top: 2%;padding-bottom: 2%;"></div>';

                        $('#showtaxcodeMul'+rowID).append(taxData2);

                        var taxData3 = '<div class="col-sm-3" id="thirdCol_'+rowID+'" style="padding-top: 2%;padding-bottom: 2%;"></div>';

                        $('#showtaxcodeMul'+rowID).append(taxData3);

                        var taxData4 = '<div class="col-sm-3" id="fourCol_'+rowID+'" style="padding-top: 2%;padding-bottom: 2%;"></div>';

                        $('#showtaxcodeMul'+rowID).append(taxData4);

                        $.each(objcity, function(key, value) {

                          var rowNo = key + 1;

                          if(rowNo > 10 && rowNo < 20){

                             var dataRow2 = '<div style="margin-left:5%">'+rowNo+') <input type="checkbox" class="taxcodeset" id="nameTbl_'+rowID+'" name="taxcodeit[]" data-chr="'+value.DATATYPE+'" data-len="'+value.COLLENGTH+'" value="'+value.COLNAME+'" style="margin-left:2%;"><label for="html" style="margin-left:2%;">'+value.COLNAME+'</label></div><br>';

                            $('#secondCol_'+rowID).append(dataRow2);

                          }else if(rowNo >= 20 && rowNo < 30){

                            var dataRow3 = '<div style="margin-left:5%">'+rowNo+') <input type="checkbox" class="taxcodeset" id="nameTbl_'+rowID+'" name="taxcodeit[]" data-chr="'+value.DATATYPE+'" data-len="'+value.COLLENGTH+'" value="'+value.COLNAME+'" style="margin-left:2%;"><label for="html" style="margin-left:2%;">'+value.COLNAME+'</label></div><br>';

                            $('#thirdCol_'+rowID).append(dataRow3);

                           //console.log('above 20 less 30',);

                          }else if(rowNo >= 30 && rowNo < 45){

                            var dataRow4 = '<div style="margin-left:5%">'+rowNo+') <input type="checkbox" class="taxcodeset" id="nameTbl_'+rowID+'" name="taxcodeit[]" data-chr="'+value.DATATYPE+'" data-len="'+value.COLLENGTH+'" value="'+value.COLNAME+'" style="margin-left:2%;"><label for="html" style="margin-left:2%;">'+value.COLNAME+'</label></div><br>';

                            $('#fourCol_'+rowID).append(dataRow4);

                            //console.log('above 30 less 45',);

                          }else{

                            //console.log('else',rowNo);

                            var taxData = '<div style="margin-left:5%">'+rowNo+') <input type="checkbox" class="taxcodeset" id="nameTbl_'+rowID+'" name="taxcodeit[]" data-chr="'+value.DATATYPE+'" data-len="'+value.COLLENGTH+'" value="'+value.COLNAME+'" style="margin-left:2%;"><label for="html" style="margin-left:2%;">'+value.COLNAME+'</label></div><br>';

                            $('#firstCol_'+rowID).append(taxData);

                          }
                          

                          srNo++;
                          
                        });

                        //$('#columnName_'+rowID).multiselect('rebuild');

                    /* --- END : MASTERS COLUMN NAME --- */

                  }

                      
                }
           }

        });


    }



  /* ----- End: get Table Column Name ----- */


  /* ----- Start : get Multi Column Name ----- */


  function getMultiColName(rowId,multiColName){


    $('#taxSelectModel'+rowId).modal('show');

   
  }


  /* ----- End : get Multi Column Name ----- */


  /* ----- Start : get Selected Column Name On Modal ----- */


  function selectColumnData(getRowId){


    $('#addmorhidn').prop("disabled", false);

    var hiddenColName = [];

    var vals    = [];
    var valsChr = [];
    var valsLen = [];
    $('#nameTbl_'+getRowId+':checked').each(function(i){
      vals[i]    = $(this).val();
      valsChr[i] = $(this).attr('data-chr');
      valsLen[i] = $(this).attr('data-len');
    });

    var countVal = vals.length;

    console.log('chr',valsChr);
    console.log('val',valsLen);

    var hiddenVal = $('#hiddenColName').val();

    if(getRowId==1){

      setTimeout(function() {

        $('#hiddenColName').val(vals);
        
        $('#columnName_'+getRowId).val(vals);
        $('#colType_'+getRowId).val(valsChr);
        $('#colLen_'+getRowId).val(valsLen);

        $('#whereClause_'+getRowId).prop("readonly", false);

        var colN = $('#columnName_'+getRowId).val();

        if(colN!=''){

          $('#submitdata').prop("disabled", false);

        }else{

          $('#submitdata').prop("disabled", true);
        }
    

      }, 300);


    }else{

      setTimeout(function() {

        var hiddenVal = $('#hiddenColName').val();

        var hideColNm =  hiddenVal.split(',');

        var tblColLen = hideColNm.length;
        
        for(var t= 0;t<tblColLen;t++){

          hiddenColName.push(hideColNm[t]);
        

        }
   

      }, 400);

      //console.log('vals',vals);
      //console.log('hide',hiddenColName);

      setTimeout(function() {

        var array1 = vals.filter(function(val) {
            return hiddenColName.indexOf(val) == -1;
        });

         //console.log('arr get',array1);
         var compArr = array1.length;
         var getCurrVal = vals.length;

         if(compArr == getCurrVal){

            var arr3=vals.concat(hiddenColName).sort();

            $('#hiddenColName').val(arr3);
            $('#columnName_'+getRowId).val(vals);
            $('#colType_'+getRowId).val(valsChr);
            $('#colLen_'+getRowId).val(valsLen);

            $('#whereClause_'+getRowId).prop("readonly", false);

            $('#addmorhidn').prop("disabled", false);

            $('#submitdata').prop("disabled", false);

            $('#errorColName_'+getRowId).html('');
            
            var newSr = getRowId + 1;
            $('#columnName_'+getRowId).removeClass('onFocusBorder');
            $('#columnName_'+getRowId).blur();
            $('#tblName_'+newSr).addClass('onFocusBorder').focus();
            $('#tblName_'+newSr).blur();

         }else{

            $('#hiddenColName').val(hiddenColName);
            
            $('#addmorhidn').prop("disabled", true);

            $('#submitdata').prop("disabled", true);

            $('#errorColName_'+getRowId).css('color','red').html('* Please Select Another Columns.');

            $('#whereClause_'+getRowId).prop("readonly", true);

            $('#columnName_'+getRowId).addClass('onFocusBorder').focus();
            $('#columnName_'+getRowId).blur();
            
            $("#masterName_"+getRowId).removeClass('onFocusBorder').focus();
            $("#masterName_"+getRowId).css('border-color','#d2d6de');
            

            $("#tblName_"+getRowId).removeClass('onFocusBorder').focus();
            $("#tblName_"+getRowId).css('border-color','#d2d6de');
           

         }



      }, 500);

     

    }

    


    

  }


  /* ----- Start : get Selected Column Name On Modal ----- */


  

	$(document).ready(function(){


    $("#submitdata").click(function(event) {

      var trcount=$('table tr').length;

      var data = $("#salesordertrans").serialize();

      $('.overlay-spinner').removeClass('hideloader');

      $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
      });

      //console.log('form data ',data);

     $.ajax({

          type: 'POST',

          url: "{{ url('/configration/engine-table-config-save') }}",

          data: data, 

          success: function (data) {

            var data1 = JSON.parse(data);
            
            if (data1.response == 'error') {
              var responseVar = false;
              var url = "{{url('/configration/save-engine-table/save-data-msg')}}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });
            }else{
              var responseVar = true;
              var url = "{{url('/configration/save-engine-table/save-data-msg')}}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });
            } 

          },

      });

      
              
    });

	    $("#tranCode").bind('change', function () {  

	        var val = $(this).val();

	        var xyz = $('#tranCodeList option').filter(function() {

	        return this.value == val;

	        }).data('xyz');

	        var msg = xyz ?  xyz : 'No Match';

	        //alert(msg+xyz);

	       //document.getElementById("tranCodeText").innerHTML = msg; 

         $('#tranCodeName').val(msg);

	        if(msg=='No Match'){

	           $(this).val('');
	        

	        }

	    });

	});


</script>




@endsection



