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

            Master Excel Configuration

            <small>Add Details</small>



          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Setting</a></li>


            <li><a href="{{ url('/Master/Setting/Excel-Configuration') }}">Excel Configuration</a></li>

            <li class="active"><a href="{{ url('/Master/Setting/Excel-Configuration') }}"> Add Excel Configuration</a></li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

    
    <!-- <div class="col-sm-2"></div> -->
      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Excel Configuration</h2>

              <div class=" box-tools pull-right">

                <a href="{{ url('/Master/Setting/View-Excel-Configuration') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-search"></i>&nbsp;&nbsp;View Excel Configuration</a>

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

            <form id="excelConfigForm">

               <!-- @csrf -->
 
               <div class="row col-md-12">

               

                <div class="col-sm-2">

                  <div class="form-group">

                    <label>Transaction Name :<span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                      <input list="transList" class="form-control" name="tran_code" id="tran_code" placeholder="Enter Transaction Name" value="" autocomplete="off">
                      <input type="hidden" name="tran_name" id="tran_name">

                        <datalist id="transList">
                          
                         <option value='DO' data-xyz ="Delivery Order"> DO = Delivery Order</option>
                         <option value='RAKE' data-xyz ="Delivery Order"> RAKE = RAKE Order</option>
                         <option value='LR' data-xyz ="Lorry Receipt" > LR = Lorry Receipt</option>
                         <option value='SO' data-xyz ="Sale Order" > SO = Sale Order</option>
                         <option value='EPROC' data-xyz ="Eproc Status" > EPROC = Eproc Status</option>

                        </datalist>
                    </div>
                    <br>
                    <small id="tranNameErr"></small>
                    <small id="tranNameShow"></small>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>

                <div class="col-md-2">

                        <div class="form-group">

                          <label>Series Code: 


                          </label>

                          <div class="input-group">

                            <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-newspaper-o" aria-hidden="true" id="serisicon"></i>

                                <div class="" id="appndbtn">
                                    
                                </div>
                            </span>
                            
                            <input list="seriesList"  id="series_code" name="series" class="form-control  pull-left" value="" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                            <datalist id="seriesList">

                            

                            </datalist>

                          </div>

                          <small id="series_code_errr" style="color: red;"></small>

                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Series Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>


                              <input type="text" class="form-control" name="tran" value="" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>

                <div class="col-sm-2">

                  <div class="form-group">

                    <label>Excel Config Code :<span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input type="text" class="form-control" name="excelCfgCode" id="excelCfgCode" placeholder="Enter Excel Config Code" max="6" value="" autocomplete="off">
                      
                    </div>
                    <br>
                    <small id="exlCfgCodeErr"></small>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('excelCfgCode', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>

                <div class="col-sm-2">

                  <di v class="form-group">

                    <label>Excel Config Name :<span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                      <input type="text" class="form-control" name="excelCfgName" id="excelCfgName" placeholder="Enter Excel Config Name" max="40" value="" autocomplete="off">
                      
                    </div>
                    <br>
                    <small id="exlCfgNameErr"></small>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('excelCfgName', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>

                <div class="col-sm-2"></div>

              </div><br>

              <div class="row" style="padding-top: 6%;!important;">
                
                <div class="col-sm-12">

                  <div class="box box-primary Custom-Box">

                    <div class="box-body">

                      <div class="table-responsive">

                        <table class="table tdthtablebordr" border="1" cellspacing="0" id="tblExcelConfig">

                          <tr>

                            <th><input class='check_all' type='checkbox' onclick="select_all()" title="Delete All Row"></th>

                            <th>Sr.No.</th>

                            <th>Table Column <small style="color:red;font-size:14px;">*</small> </th>

                            <th>Excel Column <small style="color:red;font-size:14px;">*</small></th>
                          
                          </tr>

                          <tr class="useful">
                            
                            <td class="tdthtablebordr" style='padding-top: 2%;'>
                              <input type='checkbox' class='case' title="Delete Single Row" onclick="select_all();"/>
                            </td>

                            <td class="tdthtablebordr" style='padding-top: 2%;'>

                              <span id="snum">1.</span>

                              <input type="hidden" name="excelConfDetlSlno[]" id="excelConfDetlSlno_id" value="1">

                            </td>

                            <td class="tdthtablebordr" style='padding-top: 2%;padding-left:5%;'>
                              
                             <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                              <input list="tblColList" class="form-control" name="tblcolName[]" id="tblcolName1" placeholder="Enter Transaction Name" value="" autocomplete="off" style="width:80%;" onchange ="funColName(1)" disabled>

                                <datalist id="tblColList">
                                    
                                   

                                </datalist>
                             </div>
                             <small id="colNameErr1"></small> 
                              
                            </td>

                            <td class="tdthtablebordr" style='padding-top: 2%;padding-left:5%'>
                              
                              <input type="text" class="form-control" id="excelColName1" name="excelColName[]" style="width:80%" autocomplete="off" disabled oninput="funTempExcelCol(1)"><br>

                              <input type="hidden" id="tempExcel_col1" name="tempExcel_col[]">
                              <small id="excelColNameErr1" ></small>

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

  $("#series_code").bind('change', function () {  

          var val = $(this).val();

          console.log('val',val);
          
          var xyz = $('#seriesList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
         
          if(msg == 'No Match'){

              $(this).val('');
               $("#seriesName").val('');

          }else{

             $("#seriesName").val(msg);
            
          }

        });
  
</script>


<script type="text/javascript">

$( window ).on( "load", function() {

    // $('#tran_name').css('border-color','#ff0000').focus();

})

$('#resetData').click(function(){
   location.reload();
});

function funTempExcelCol(id){
  var temp_val = $('#excelColName'+id).val();
  
  if(temp_val != ''){
   $('#tempExcel_col'+id).val('COL'+id);
  }else{
    $('#tempExcel_col'+id).val('');
  }
}

 function select_all() {

      $('input[class=case]:checkbox').each(function(){ 

          if($('input[class=check_all]:checkbox:checked').length == 0){ 

              $(this).prop("checked", false); 

          } else {

              $(this).prop("checked", true); 

          } 

      });

  }

  


var chkTblName = [];
function funColName(id){

    
    var tblName = $('#tblcolName'+id).val();
    var xyz = $('#tblColList option').filter(function() {

    return this.value == tblName;

     }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';
          
    if(msg == 'No Match'){

      $('#tblcolName'+id).val('');
    }else{
    
    var dArrLen = chkTblName.length;
    
    if(dArrLen > 0){
      
      for(var k=0; k< dArrLen;k++){
         
          if(chkTblName[k] == tblName){

           $('#tblcolName'+id).val('');
           
           $('#colNameErr'+id).html('Please select another column name').css('color','red');

           
           return false;
          }else{
            // var dataArray = chkCerCode.push(certCode);
          }

      }
       $('#colNameErr'+id).html('');
       var dataArray = chkTblName.push(tblName);

    }else{
      
      var dataArray = chkTblName.push(tblName);
    }
    // console.log('dataArray',chkTblName);
    $('#tblcolName'+id).css('border-color','#d2d6de');
    $('#tblcolName'+id).attr('readonly',true);
    $('#excelColName'+id).prop('disabled',false);
    
  }
}

$("#tran_code").bind('change', function () {  

          var val = $(this).val();

          console.log('val',val);
          
          var xyz = $('#transList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          $('#tranNameShow').html('<span style="font-size: 14px;font-weight: 800;color: #3c8dbc;">'+msg+'</span>');
         
          if(msg == 'No Match'){

              $(this).val('');

              $("#tblColList").empty();

          }else{
            $('#tran_name').val(msg);
            var trancode = $('#tran_code').val();
            
            $('#tran_code').prop('readonly',true);

            if(trancode != ''){

              $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                   }
              });

              $.ajax({

                      url:"{{ url('form-excel-config-table-col') }}",

                       type: "POST",

                       data: {trancode:trancode},

                       success:function(data){

                        var data1 = JSON.parse(data);

                        if(data1.response == 'success'){


                          if(data1.data ==''){

                          }else{

                              $("#tblColList").empty();
                             
                              $.each(data1.data, function(k, row){
                                
                                if(row['COLUMN_NAME'] != 'FLAG' && row['COLUMN_NAME'] != 'CREATED_BY' && row['COLUMN_NAME'] != 'CREATED_DATE' && row['COLUMN_NAME'] != 'LAST_UPDATE_BY' && row['COLUMN_NAME'] != 'LAST_UPDATE_DATE' ){
                                  
                                $("#tblColList").append($('<option>',{

                                  value:row['COLUMN_NAME'],

                                  'data-xyz':row['COLUMN_NAME'],
                                  text:row['COLUMN_NAME']

                                }));
                              }

                              });
                              $('#tblcolName1').prop('disabled',false);

                          }


                          if(data1.data_series==''){

                          }else{

                            $("#seriesList").empty();
                            $.each(data1.data_series, function(k, row){
                                
                                $("#seriesList").append($('<option>',{

                                  value:row['SERIES_CODE'],

                                  'data-xyz':row['SERIES_NAME'],
                                  text:row['SERIES_NAME']

                                }));
                              
                              });


                          }
                          
                          



                        }else{

                            $("#tblColList").empty();

                        }
                        

                       }
              })
            }

          }
 })

// $(".delete").on('click', function() {

//     var val =  $('.case:checkbox:checked').val();

//     var tblcolName = $('#tblcolName'+val).val();

//     var chkarrLen = chkTblName.length;

//     for(var j=1;j<=chkarrLen;j++){

//       if(chkTblName[j] == tblcolName){
//         chkTblName.pop(tblcolName);
//       }
//     }
    
//     $('.case:checkbox:checked').parents('#tblExcelConfig tr').remove();

//     $('.check_all').prop("checked", false); 

//     checkAccommo();

//   });

 

//   function checkAccommo(){

//       obj = $('#tblExcelConfig tr').find('span');
//       $.each( obj, function(key, value) {

//           id=value.id;
//           $('#'+id).html(key+1);

//       });

//   }


$(function(){

var i=2;

  var chkCert = [];
  
  $(".addmore").on('click',function(){ 

    count=$('#tblExcelConfig tr').length;

    countTr = count-1;

    var tblcolName  =  $('#tblcolName'+countTr).val();
   
    if(tblcolName == ''){
      
      $('#colNameErr'+countTr).html('Column Name Field Is Required').css('color','red');
      return false;

    }else{

      $('#colNameErr'+countTr).html('');

    }
    
    var excelColName  =  $('#excelColName'+countTr).val();
   
    if(excelColName == ''){

      $('#excelColNameErr'+countTr).html('');
      $('#tempExcel_col'+countTr).val('');
      
      $('#excelColNameErr'+countTr).html('Excel Column Field Is Required').css('color','red');

      
      return false;

    }else{

        $('#excelColName'+countTr).prop('readonly',true);
        $('#excelColNameErr'+countTr).html('');
      
        var data='<tr><td class="tdthtablebordr" style="padding-top: 23px;"><input type="checkbox" class="case" name="del[]" id="del" value="'+count+'" /></td><td class="tdthtablebordr" style="padding-top: 22px;"><span id="snum'+i+'">'+count+'.</span><input type="hidden" name="excelConfDetlSlno[]" id="excelConfDetlSlno_id" value="'+count+'"></td>';

        data += '<td class="tdthtablebordr" style="padding-top: 2%;padding-left:5%;"><div class="input-group"><span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span><input list="tblColList" class="form-control" name="tblcolName" id="tblcolName'+count+'" placeholder="Enter Transaction Name" value="" autocomplete="off" style="width:80%;"onchange="funColName('+count+')"><datalist id="tblColList"></datalist></div><small id="colNameErr'+count+'"></small> </td><td class="tdthtablebordr" style="padding-top: 2%;padding-left:5%"><input type="text" class="form-control" id="excelColName'+count+'" name="excelColName[]" style="width:80%" autocomplete="off" disabled oninput="funTempExcelCol('+count+')"><input type="hidden" id="tempExcel_col'+count+'" name="tempExcel_col[]"><br><small id="excelColNameErr'+count+'"></small></td></tr>';

        $('#tblExcelConfig').append(data);
        
        i++;
    }

 })


})

var all_tblCol       = [];
var all_excelCol     = [];
var all_tempExcelCol = [];

$(document).ready(function(){


  $("#excelCfgCode").attr('maxlength','6');

  $('#saveData').on('click',function(){

    var tran_name = $('#tran_name').val();
    var tran_code = $('#tran_code').val();
    var excelCfgCode = $('#excelCfgCode').val();
    var excelCfgName = $('#excelCfgName').val();

    if(tran_code == ''){

      $('#tranNameErr').html('*Transaction Field is required.').css('color','red');
      return false;

    }else{

      if (excelCfgCode == '') {
        $('#exlCfgCodeErr').html('*Excel Config Code Field is required.').css('color','red');
        return false;
      }else{
        $('#exlCfgCodeErr').html('');
        $('#tranNameErr').html('');
      }

      if (excelCfgName == '') {
        $('#exlCfgNameErr').html('*Excel Config Name Field is required.').css('color','red');
        return false;
      }else{
        $('#exlCfgNameErr').html('');
        $('#tranNameErr').html('');
      }

    }

   var count=$('#tblExcelConfig tr').length;
   var countTr = count-1;

   for(var l=1;l <= countTr;l++){

      var tblcolName  =  $('#tblcolName'+l).val();
      
      if(tblcolName == ''){
        
        $('#colNameErr'+l).html('Table Column Field Is Required').css('color','red');
        $('#tranNameErr').html('');
        return false;

      }else{
        $('#tranNameErr').html('');
        $('#colNameErr'+l).html('');
        all_tblCol.push(tblcolName);
       }
      
      
      var excelColName  =  $('#excelColName'+l).val();
      
      if(excelColName == ''){

        $('#excelColNameErr'+l).html('Certificate No Field Is Required').css('color','red');
        return false;

      }else{
         $('#excelColNameErr'+l).html('');
         all_excelCol.push(excelColName);
      }

      var tempExcel_col  =  $('#tempExcel_col'+l).val();
      
      if(tempExcel_col == ''){

        // $('#tempExcel_colErr'+l).html('Certificate No Field Is Required').css('color','red');
        // return false;

      }else{
         // $('#excelColNameErr'+l).html('');
         all_tempExcelCol.push(tempExcel_col);
      }

  }
   
   $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

             }
  });

  $.ajax({

          url:"{{ url('form-excel-configuration-save') }}",

           type: "POST",

           data: {tran_code:tran_code,tran_name:tran_name,all_tblCol:all_tblCol,all_excelCol:all_excelCol,all_tempExcelCol:all_tempExcelCol,excelCfgCode:excelCfgCode,excelCfgName:excelCfgName},

           success:function(data){

            var data1 = JSON.parse(data);

            if(data1.response == 'success'){

              setTimeout(function () {
                  
                var pageName = btoa('ExcelConfig');
                  
                window.location.href = "{{ url('/Master/Setting/View-Excel-Configuration/success-message')}}/"+pageName+"";

                }, 500);

            }
            if(data1.response == 'error'){

              console.log('error');

            }
            if(data1.response == 'duplicate'){
              $('#tranNameErr').html('Transaction Name is already Exit').css('color','red');
              $('#exlCfgCodeErr').html('Excel Config Code is already Exit').css('color','red');
             $('#excelConfigForm')[0].reset();
            }

          }

    });

    });

 


  })





</script>





@endsection