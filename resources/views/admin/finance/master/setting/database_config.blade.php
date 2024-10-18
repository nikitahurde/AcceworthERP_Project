@extends('admin.main')





@section('AdminMainContent')





@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')




@include('admin.include.sidebar')


<style type="text/css">



  .required-field::before {



    content: "*";



    color: red;


  }

 .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
  }

.beforhidetble{
  display: none;
}
.popover{
    left: 70.4922px!important;
    width: 110%!important;
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

.dt-buttons{
    margin-bottom: -30px!important;
  }
  .dt-button{
    display: inline-block!important;
    font-weight: 600 !important;
    text-align: center!important;
    white-space: nowrap!important;
    vertical-align: middle!important;
    -webkit-user-select: none!important;
    -moz-user-select: none!important;
    -ms-user-select: none!important;
    user-select: none!important;
    border: 1px solid transparent!important;
    padding: .375rem .75rem!important;
    font-size: 12px!important;
    line-height: 1.5!important;
    border-radius: .25rem!important;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out!important;
  }
  .dt-button:before {
    content: '\f02f';
    font-family: FontAwesome;
    padding-right: 5px;
  }
  .buttons-excel{
    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
  }
  .buttons-excel:before {
    content: '\f1c9';
    font-family: FontAwesome;
    padding-right: 5px;
  }
@media screen and (max-width: 600px) {

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

    <h1> Database Config

      <small>Add Details</small>
    </h1>

    <ol class="breadcrumb">


      <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ URL('/dashboard')}}">Configuration</a></li>
     
      <li class="Active"><a href="#">Database Config</a></li>
      
      

    </ol>

  </section>

  <section class="content">

      <div class="row">

       <!-- <div class="col-sm-2"></div> -->

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Database Config</h2>

              <div class="box-tools pull-right">

              <a href="#" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Database Config</a>

            </div>
                
            </div><!-- /.box-header -->

            
            
            @if(Session::has('alert-success'))


                <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">
                
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                  <h4><i class="icon fa fa-check"></i>

                     Success...!

                  </h4>

                  {!! session('alert-success') !!}

                </div>

              @endif

              @if(Session::has('alert-error'))
              <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                 <h4> <i class="icon fa fa-ban"></i>

                    Error...!
                 </h4>

                  {!! session('alert-error') !!}
              </div>

            @endif

            <div class="box-body">

              <form action="{{url('/configration/list-database-table')}}" method="post" enctype="multipart/form-data">
                  @csrf

                <div class="col-md-3"></div>

                <div class="col-md-6">

                  <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>To Database : <span class="required-field"></span> </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                        <input type="text" id="from_db" name="from_db" class="form-control  pull-left" value="{{$dbname}}"  autocomplete="off" readonly="">

                      </div>

                      <small id="fromdbErr"></small>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('from_db', '<p class="help-block" style="color:red;">:message</p>') !!}

                       </small>

                    </div>

                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label> From Database :<span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                        <input list="toDB_list" id="to_db" name="to_db" class="form-control  pull-left" value="" placeholder="Select To Database" autocomplete="off">

                        <datalist id="toDB_list">
                           
                          @foreach($database_list as $rows)

                            <option value="<?php if($rows->Database == 'information_schema' || $rows->Database == 'mysql' || $rows->Database == 'performance_schema' || $rows->Database == 'phpmyadmin' || $rows->Database ==  $dbname || $rows->Database == 'test'){ }else{ echo $rows->Database;} ?>"data-xyz ="{{ $rows->Database }}">{{$rows->Database}}</option>
                             
                           @endforeach
                          
                        </datalist>

                      </div>

                      <small id="todbErr"></small>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('to_db', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>
                    </div>

                  </div>
                  </div> 
                  <div class="row text-center" style="margin-top: 4%;">
                    <button class="btn btn-primary" type="button" id="ProceedBtnId"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Proceed&nbsp;&nbsp;</button>
                     <button type="button" class="btn btn-warning" name="searchdata" id="ResetId" onClick="window.location.reload();">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>
                </div>
                <div class="row  text-center">
                  
                </div>

                </div>
               

              </form>

              <div style="margin-top:10%;">

              <table id="showTblCol" class="table table-bordered table-striped table-hover">
                
                <!-- <div class="row">
                  <div class="col-md-6">fdgdf</div>
                  <div class="col-md-6">dfgsg</div>
                </div> -->
                <thead>

                  <tr id="tblHeading" style="display:none;">
                    
                    <th></th>
                        <th colspan="3">From Database : <p id="toDatabase"  style="margin: -18px 96px 10px;"></p></th>
                        <th colspan="3">To Database : <p id="fromDatabase"  style="margin: -18px 96px 10px;"></p></th>
                    <th></th>
                  </tr>

                  <tr>

                    <th class="text-center" width="19%">TABLE NAME</th>

                   
                    
                    <th class="text-center" width="9%">COLUMN NAME</th>

                    <th class="text-center" width="7%">DATA TYPE</th>

                    <th class="text-center" width="7%">CHARACTER MAXIMUM LENGTH</th>

                    <th class="text-center" width="9%">COLUMN NAME</th>

                    <th class="text-center" width="7%">DATA TYPE</th>

                    <th class="text-center"  width="7%">CHARACTER MAXIMUM LENGTH</th>

                    <th class="text-center"  width="7%">ACTION</th>

                  </tr>

                </thead>
                  <div class="modalspinner hideloaderOnModl"></div>
                <tbody>
                  
                </tbody>

             </table>

             </div>

             <div class="modal fade" id="updateCol" >
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">

                      <div class="modal-header text-left">
                        <h3 class="modal-title" id="exampleModalLongTitle">Are You Sure...!</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px;">
                          <span aria-hidden="true"><i class="fa fa-times-circle-o"></i></span>
                        </button>
                      </div>

                      <div class="modal-body">

                        <small id="errormsg" style="color: red;font-weight: 600;font-size: 14px;"></small>
                      
                        <div class="alertmsg"><i class="fa fa-caret-right"></i> You Want To Alter This Column...!
                        <input type="hidden" name="col_name" id="col_name" value="">
                        <input type="hidden" name="tbl_name" id="tbl_name" value="">
                        <input type="hidden" name="data_type" id="data_type" value="">
                        <input type="hidden" name="data_length" id="data_length" value="">
                        <input type="hidden" name="data_flag" id="data_flag" value="">
                        </div>
                      </div>  

                        
                      <div class="modal-footer" style="border-top: none !important;text-align: right;">

                         <button type="button" style="" class="btn btn-sm btn-warning" data-dismiss="modal">Cancel</button>
                         <button type="button" style="" id="btnProceed"class="btn btn-sm btn-success" onclick="funupdateCol()">Proceed</button>
                        
                      <!--   <button type="button" class="btn btn-primary">Save changes</button> -->
                      </div>
                    </div>
                  </div>
                </div>  

            </div><!-- /.box-body -->

          </div>

        </div>

      <!--   <div class="col-sm-4">

         
        </div> -->

      </div>

    </section>

</div>



@include('admin.include.footer')


<script type="text/javascript">

 $('#ProceedBtnId').click(function(){

   var from_db   =  $('#from_db').val();
   var target_db =  $('#to_db').val();

    if (target_db!='') {

       $('#ProceedBtnId').attr('disabled',true);
       $('#to_db').attr('disabled',true);

        $('#showTblCol').DataTable().destroy();
        $('#todbErr').html('');
        load_data_query(from_db,target_db);

    }else{


      $('#todbErr').html('Please select Target Database').css('color','red');
        return false;

      // $('#showTblCol').DataTable().destroy();


    }

 });

 load_data_query();


  function load_data_query(fromDB= '',targetDB =''){

    var date1 = new Date();
    var month = date1.getMonth() + 1;
    var tdate = date1.getDate();
    var mn    = month.toString().length > 1 ? month : "0" + month;
    var yr    = date1.getFullYear();
    var hr    =  date1.getHours(); 
    var min   = date1.getMinutes();
    var sec   = date1.getSeconds(); 

    var curr_date = tdate+''+mn+''+yr;
    var curr_time = hr+':'+min+':'+sec;

    var t = $('#showTblCol').DataTable({
    
      footerCallback: function ( row, data, start, end, display ) {
          var api = this.api(), data;

          // converting to interger to find total
          var intVal = function ( i ) {
              return typeof i === 'string' ?
                  i.replace(/[\$,]/g, '')*1 :
                  typeof i === 'number' ?
                      i : 0;
          };

          var rowcount = data.length;
          var getRow = rowcount-1;
          
          if(rowcount > 0){
             $('.buttons-excel').attr('disabled',false);
             $('#tblHeading').css('display','');
             $('#fromDatabase').text(fromDB);
             $('#toDatabase').text(targetDB);
          }else{
             $('.buttons-excel').attr('disabled',true);

          }
        },
      
          
        processing: true,
        serverSide: true,
        scrollX: true,
        pageLength:'25',
        dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
        buttons: [
                  {
                    extend: 'excelHtml5',
                    title: 'database_config_'+curr_date+'_'+curr_time,
                    footer: true
                  }
                  ],
        ajax:{
          url:'{{ url("/configration/list-database-table") }}',

          data: {fromDB:fromDB,targetDB:targetDB},
         

        },
         // beforeSend: function() {
         //        $('.modalspinner').removeClass('hideloaderOnModl');
         // },
        columns: [
          
         
           { data:"TABLE_NAME",className:""},

           { data:"COLUMN_NAME",className:""},

           { data:"DATA_TYPE",className:"text-"},

           { data:"CHARACTER_MAXIMUM_LENGTH",className:"text-right"},

           { data:"COL_NAME",className:""},

           { data:"DTYPE",className:""},

           { data:"CMLENGTH",className:"text-right"},

           {  
            render: function (data, type, full, meta){

                    var pervious_col = full['CHARACTER_MAXIMUM_LENGTH'];
                    var current_col = full['CMLENGTH'];

                    // var tbl_name = full['TABLE_NAME'];
                    // var col_name = full['COL_NAME'];
                    // var data_type = full['DTYPE'];
                    // var data_length = full['CMLENGTH'];


                    var deletebtn ='<button type="button" class="btn btn-xs btn-warning" style="font-size: 8px;"data-toggle="modal" onclick="funshowdata(\''+full['TABLE_NAME']+'\',\''+full['COLUMN_NAME']+'\',\''+full['DATA_TYPE']+'\','+full['CHARACTER_MAXIMUM_LENGTH']+',\''+full['COL_NAME']+'\',\''+full['DTYPE']+'\','+full['CMLENGTH']+','+full['DT_RowIndex']+')" ><i class="fa fa-pencil"></i></button>';
                    
                     return deletebtn;

                     },className:"text-center",
        

       },

        ],
        // complete: function() {
        //     $('.modalspinner').addClass('hideloaderOnModl');
        //   },

    });


  }

function funupdateCol(){
  
 var tblname =  $('#tbl_name').val();
 var colname =  $('#col_name').val();
 var datatype =  $('#data_type').val();
 var col_length = $('#data_length').val();
 console.log('datatype',datatype);
 var dataFlag = $('#data_flag').val();
 console.log('collength',col_length);

 var collength = '';
 if(datatype == 'int' && col_length == ''){
     collength = 11;
 }else{
     collength = col_length;
 }

 if(tblname!='' && colname!='' && datatype!='' && collength!=''){

   $.ajaxSetup({

        headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

  });

  $.ajax({

    url:"{{ url('/configuration/update-column') }}",
    
    data: {tblname:tblname,colname:colname,datatype:datatype,collength:collength,dataFlag:dataFlag},
    
    success:function(data){

      var data1 = JSON.parse(data);
      
      if(data1.response =='success'){
       
       // $('#updateCol').modal('hide');
       $('#updateCol').modal('toggle');

        $('#showTblCol').DataTable().destroy();

        var from_db   =  $('#from_db').val();
        var target_db =  $('#to_db').val();

        load_data_query(from_db,target_db);

      }else{
       
      }

    }
  });

 }
}

function funshowdata(tbl_name,col_name,data_type,predata_length,currdb_colname,currdb_dtype,newdata_length){
  
  $('#tbl_name').val(tbl_name);
  $('#col_name').val(col_name);
  $('#data_type').val(data_type);
  $('#data_length').val(predata_length);
  $('#data_flag').val('');
  // $('#currdata_length').val(predata_length);

  var newdatalen = parseInt(newdata_length);
  var prevdatalen = parseInt(predata_length);
  
  if(prevdatalen > newdatalen){
     
     $('.alertmsg').css('display','');
     $('#errormsg').html('');
     $('#btnProceed').prop('disabled',false);
     $('#updateCol').modal('show');
   
  }else if(prevdatalen < newdatalen){
    
     $('#errormsg').html('Can not Update this Column').css('color','red');
     $('.alertmsg').css('display','none');
     $('#btnProceed').prop('disabled',true);
     $('#updateCol').modal('show');

  }else{

  }

  if(currdb_colname == 'null' && currdb_colname == 'null' && currdb_colname == 'null'){

     $('#data_flag').val(0);
     $('.alertmsg').css('display','');
     $('#errormsg').html('');
     $('#btnProceed').prop('disabled',false);
     $('#updateCol').modal('show');

  }else{
    console.log('else');
  }



 
}
</script>




@endsection