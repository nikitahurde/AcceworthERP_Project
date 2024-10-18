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
  ::placeholder {
    text-align:left;
  }
  .Custom-Box {
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  .showSeletedName{
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
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
  .inputboxclr{
    border: 1px solid #d7d3d3;
  }
  .tdthtablebordr{
    border: 1px solid #00BB64;
  }
  input:focus{border:1px solid yellow;} 

  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 6px;
    padding-bottom: 0px !important;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    text-align: center;
  }
  .debitcreditbox{
    width: 91px;
    text-align: end;
  }
  .onFocusBorder{
    border-color: red !important;
  }
  .modltitletext{
    font-weight: 800;
    color: #5696bb;
    margin-left: -11%;
    font-size: 16px;
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

	              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Edit Engine Table Config</h2>

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

			                      

			                        <input list="tranCodeList" type="text" name="tranCode" id="tranCode" class="form-control" value="{{$col_list[0]->TRAN_CODE}}" maxlength="30" placeholder="Select Tran Code" readonly>


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

                                  <input type="text" name="tranCodeName" id="tranCodeName" class="form-control" value="{{$col_list[0]->TRAN_CODENAME}}" readonly>

                              </div>
                                <small id="tCodeNameValMsg" class="form-text text-muted">

                                </small>

                        </div>

                      </div>

	                  	<div class="col-md-2"></div>
	                
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

            <form id="editenginTable">
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

                    <?php $sr =1;
                          $impldAllColName;
                          $allTblName=array(); 
                          $rowCount = count($table_list);
                          foreach($table_list as $rows){ 
                          $table_Name = $rows->TABLE_NAME; 
                          $allTblName[] = $rows->TABLE_NAME;

                          $getMaster = substr($table_Name, 0, 4);
                          if($getMaster == 'MAST'){
                            $mastTble = $table_Name;
                            $tableName = 'MASTERS'; 
                          }else{
                            $mastTble = '';
                            $tableName = $rows->TABLE_NAME; 
                          }
                    ?>

                      <tr class="useful">
                        
                        <td class="tdthtablebordr"  style="width: 5%;">
                          <input type='checkbox' class='case'  />
                        </td>

                        <td class="tdthtablebordr" style="width: 10%;">
                          <span id='snum' style="width: 10px;"><?php echo $sr;?></span>
                        </td> 

                        <td class="tdthtablebordr" style="width:20%">
                          <div class="input-group">

                            <input list="tblList_<?php echo $sr;?>" class="inputboxclr classTblName" id='tblName_<?php echo $sr;?>' onchange="getTblNameList(<?php echo $sr;?>,'<?php echo $tableName;?>');" value="{{$tableName}}"  name="tblName[]" readonly/>

                            <datalist id="tblList_<?php echo $sr;?>">

                                <option selected="selected" value="">-- Select --</option>

                            </datalist>

                            <p style="margin-top:3%;">
                              <input list="masterList_<?php echo $sr;?>" class="inputboxclr" id="masterName_<?php echo $sr;?>" name="masterName[]" onchange="getTblColumnList(<?php echo $sr;?>,this.value);" value="{{$mastTble}}" readonly/>
                              <datalist id="masterList_<?php echo $sr;?>">
                                <option selected="selected" value="">-- Select --</option>
                              </datalist>
                            </p>

                          </div>
                        </td>

                          <?php $colName = array(); $colType=array(); $colength=array(); $colNameAll = array(); foreach($col_list as $keys){
                              $colNameAll[] = $keys->COLUMN_NAME;
                              if($tableName == $keys->TABLE_NAME){
                                $colName[] = $keys->COLUMN_NAME;
                                $colType[] =$keys->COLUMN_TYPE;
                                $colength[] =$keys->COLUMN_LEN;
                              }

                          ?>

                          <?php }  $impldcolName = implode(",",$colName); 
                                  $impldAllColName = implode(",",$colNameAll);
                                  $impldcolType = implode(",",$colType); 
                                  $impldcolength = implode(",",$colength); 
                          ?>

                        <td class="tdthtablebordr" style="width:20%">
                          <div class="form-group" id="divColName_<?php echo $sr;?>" style="margin-top: 0%;">
                            <input type="text" class="inputboxclr" id="columnName_<?php echo $sr;?>" onclick="getMultiColName(<?php echo $sr;?>);" value="{{$impldcolName}}" style="margin-bottom: 5px;margin-top: 8%;" name="columnName[]"/>
                            <input type='hidden' name='colType[]' id='colType_<?php echo $sr;?>' value="{{$impldcolType}}"/>
                              <input type='hidden' name='colLen[]' id='colLen_<?php echo $sr;?>' value="{{$impldcolength}}"/>
                            <br>
                            <small style="color:red;" id="errorColName_<?php echo $sr;?>"></small>
                          </div>
                        </td>

                        <td class="tdthtablebordr" style="width:40%">

                          <input type='text' class='debitcreditbox dr_amount inputboxclr'  id='whereClause_<?php echo $sr;?>' name='whereClause[]' style='width:100%;margin-top:5%;' readonly/>

                        </td>


                      </tr> 

                      <!-- modal show -->

                      <div id="taxSelectModel<?php echo $sr;?>" class="modal fade" tabindex="-1">

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
                                        <div class="row" id="showtaxcodeMul<?php echo $sr;?>" style="line-height: 0.3 !important;">
                                          
                                        </div>
                                      </div>
                                      
                                    </div>

                                </div>

                                <div class="modal-footer" style="text-align: center;" id="taxCodeSelect<?php echo $sr;?>">

                                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="selectColumnData(<?php echo $sr;?>);" style="width: 83px;">Ok</button>   

                                </div>

                            </div>

                        </div>

                      </div>

                      <!-- modal show -->

                       
                    <?php $sr++;} $imAllTblName = implode(",",$allTblName); ?>

                </table>

                <input type="hidden" id='tcode_1' name='tCode'>
                <input type="hidden" id='tcodeName_1' name='tCodeName'>

                <input type="hidden" id="hiddenTblName" value="{{$imAllTblName}}" name="hiddenTblName[]">

                <input type="hidden" id="hiddenColName" value="{{$impldAllColName}}" name="hiddenColName[]">
                
                <input type="hidden" id="tblSrNo" value="{{$rowCount}}" name="getSrNo">

            </div><!-- /div -->

      

      <br>

        <p class="text-center">

          <button class="btn btn-success" type="button" id="submitdata" ><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Reset</button>

        </p>

      </div>

    </form>

  </div><!-- /.box-body -->

</div>

</div>

</div>

</section>




</div>



@include('admin.include.footer')


<script type="text/javascript">

  $(document).ready(function(){

    $(window).on('load',function(){
      getTblNameList();
      var transCode = $('#tranCode').val();
      var tranName = $('#tranCodeName').val();
      $('#tcode_1').val(transCode);
      $('#tcodeName_1').val(tranName);
    });

    $('.allcheckbox').multiselect({

      nonSelectedText: 'Select',
      enableFiltering: true,
      enableCaseInsensitiveFiltering: true,
      buttonWidth:'170px',
      includeSelectAllOption: true,
      maxHeight: 150

      
    });

  });


  function getMultiColName(rowId){
    $('#taxSelectModel'+rowId).modal('show');
    var tableName = $('#tblName_'+rowId).val();
    getTblNameList(rowId,tableName);
  }

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
        
      }else{

        var tabNameStatus = 'unmatch';

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

                  if(data1.tblStatus == 'match'){

                    $("#columnName_"+rowID).empty();

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

                        var existData = $('#columnName_'+rowID).val();
                        var splitdata = existData.split(',');

                        $.each(objcity, function(key, value) {

                          if(jQuery.inArray(value.COLNAME, splitdata) !== -1){
                            var checkedVal = 'checked';
                            var disabledchk = 'disabled';
                          }else{
                            var checkedVal = '';
                            var disabledchk = '';
                          }
                          if(value.COLLENGTH == null){
                            var colLength = value.COLLENGTH =0;
                          }else{
                            var colLength = value.COLLENGTH;
                          }
                          var rowNo = key + 1;

                          if(rowNo > 10 && rowNo < 20){

                             var dataRow2 = '<div style="margin-left:5%">'+rowNo+') <input type="checkbox" '+checkedVal+' class="taxcodeset'+rowID+'" id="nameTbl_'+rowID+'" name="tblColName[]" data-chr="'+value.DATATYPE+'" data-len="'+colLength+'" value="'+value.COLNAME+'" style="margin-left:2%;" '+disabledchk+'><label for="html" style="margin-left:2%;">'+value.COLNAME+'</label></div><br>';

                            $('#secondCol_'+rowID).append(dataRow2);

                          }else if(rowNo >= 20 && rowNo < 30){

                            var dataRow3 = '<div style="margin-left:5%">'+rowNo+') <input type="checkbox" '+checkedVal+' class="taxcodeset'+rowID+'" id="nameTbl_'+rowID+'" name="tblColName[]" data-chr="'+value.DATATYPE+'" data-len="'+colLength+'" value="'+value.COLNAME+'" style="margin-left:2%;" '+disabledchk+'><label for="html" style="margin-left:2%;">'+value.COLNAME+'</label></div><br>';

                            $('#thirdCol_'+rowID).append(dataRow3);

                           //console.log('above 20 less 30',);

                          }else if(rowNo >= 30 && rowNo < 45){

                            var dataRow4 = '<div style="margin-left:5%">'+rowNo+') <input type="checkbox" '+checkedVal+' class="taxcodeset'+rowID+'" id="nameTbl_'+rowID+'" name="tblColName[]" data-chr="'+value.DATATYPE+'" data-len="'+colLength+'" value="'+value.COLNAME+'" style="margin-left:2%;" '+disabledchk+'><label for="html" style="margin-left:2%;">'+value.COLNAME+'</label></div><br>';

                            $('#fourCol_'+rowID).append(dataRow4);

                            //console.log('above 30 less 45',);

                          }else{

                            //console.log('else',rowNo);

                            var taxData = '<div style="margin-left:5%">'+rowNo+') <input type="checkbox" '+checkedVal+' class="taxcodeset'+rowID+'" name="tblColName[]" id="nameTbl_'+rowID+'" data-chr="'+value.DATATYPE+'" data-len="'+colLength+'" value="'+value.COLNAME+'" style="margin-left:2%;" '+disabledchk+'><label for="html" style="margin-left:2%;">'+value.COLNAME+'</label></div><br>';

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


  /* ----- Start : get Selected Column Name On Modal ----- */


  function selectColumnData(getRowId){

    /* ------ get all checkbox cheked value --------*/

      var allselCol = [];
      $('input:checkbox.taxcodeset'+getRowId+'').each(function () {
         var sThisVal = (this.checked ? $(this).val() : "");
          if(sThisVal!=''){
             allselCol.push(sThisVal);
          }
      });

    /* ------ get all checkbox cheked value --------*/

    /* ------ get previous column name --------*/

    var colName = $('#columnName_'+getRowId).val();
    var splitColNme = colName.split(',');

    /* ------ get previous column name --------*/

    /* ------ get new checkbox checked column name --------*/

    var colCount = allselCol.length;

    var sNewSelCal=[];
    for(var i=0;i<colCount;i++){
      if(jQuery.inArray(allselCol[i], splitColNme) !== -1){

      }else{
        var checkedVal = allselCol[i];
        sNewSelCal.push(checkedVal);
      }
    }

    /* ------ get new checkbox checked column name --------*/

    /* ------ find repeated column name --------*/

    var hidnClVal = $('#hiddenColName').val();
    var spliVal = hidnClVal.split(',');

    var existCol = [];

    $.grep(spliVal, function(el) {

        if ($.inArray(el, sNewSelCal) != -1) {
            existCol.push(el);
        }

    });

    /* ------ find repeated column name --------*/

    /* ------------ get data type of new selected column --------*/

    var newDataType   = [];
    var newDataLength = [];
    for(var j=0;j<sNewSelCal.length;j++){
      //sNewSelCal[j];
      $('input:checkbox.taxcodeset'+getRowId+'').each(function () {
         var sThisVal1 = (this.checked ? $(this).val() : "");
          if(sThisVal1!=''){
            if(sThisVal1 == sNewSelCal[j]){
              var dataType=  $(this).attr('data-chr');
              newDataType.push(dataType);

              var dataLength=  $(this).attr('data-len');
              newDataLength.push(dataLength);

            }
          }
      });
    }

    /* ------------ get data type of new selected column --------*/

    /* ------ if checkbox already selected column name then show msg or not--------*/

    if(existCol.length >0){
      $('#errorColName_'+getRowId).html('* Please Select Another Columns.');
    }else{
      $('#errorColName_'+getRowId).html('');

      if(sNewSelCal.length >0){
        var prevColVal = $('#columnName_'+getRowId).val();
        var newVal = prevColVal+','+sNewSelCal;
       // console.log('newVal',newVal);
        $('#columnName_'+getRowId).val(newVal);
        
        var allPrevColVal = $('#hiddenColName').val();
        var allNewVal = allPrevColVal+','+sNewSelCal;
        $('#hiddenColName').val(allNewVal);
      }

      if(newDataType.length > 0){
        var oldDataType = $('#colType_'+getRowId).val();
        $('#colType_'+getRowId).val(oldDataType+','+newDataType);
      }

      if(newDataLength.length > 0){
        var oldDataLength = $('#colLen_'+getRowId).val();
        $('#colLen_'+getRowId).val(oldDataLength+','+newDataLength);
      }
    }

    /* ------ if checkbox already selected column name then show msg or not--------*/


  }


  /* ----- Start : get Selected Column Name On Modal ----- */


  $(document).ready(function(){

    $("#submitdata").click(function(event) {

      var trcount=$('table tr').length;

      var data = $("#editenginTable").serialize();

      $('.overlay-spinner').removeClass('hideloader');

      $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
      });

     $.ajax({

          type: 'POST',

          url: "{{ url('/configration/update-engine-table-config') }}",

          data: data, 

          success: function (data) {
            var data1 = JSON.parse(data);
            
            if (data1.response == 'error') {
              var responseVar = false;
              var url = "{{url('/configration/update-engine-table/update-data-msg')}}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });
            }else{
              var responseVar = true;
              var url = "{{url('/configration/update-engine-table/update-data-msg')}}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });
            }  
          },

      });
              
    });
  });

</script>




@endsection