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
.arrow{
  left: 59.4828%;
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

.panel-heading {
    padding: 0px 0px !important;
    border-bottom: none !important;
    border-top-left-radius: 3px !important;
    border-top-right-radius: 3px !important;
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



            Asset Depreciation Tran



            <small>: Add Details</small>



          </h1>



          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/finance/transaction/asset/asset-transaction') }}"> Asset </a></li>

            <li class="active"><a href="{{ url('/finance/transaction/asset/asset-transaction') }}">Asset Transaction</a></li>

            <li class="active"><a href="{{ url('/finance/transaction/asset/asset-transaction') }}">Add Asset Dep. Tran</a></li>


          </ol>

        </section>



	<section class="content">



    <div class="row">


      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Asset Depreciation Tran. </h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/finance/transaction/asset/view-asset-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Asset Depreciation Tran.</a>

              </div>

              <div class="box-tools pull-right">


                  <a href="{{ url('/finance/transaction/asset/view-asset-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Asset Depreciation Tran.</a>


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

                        Year-Month : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>

                           <input type="text" class="form-control" name="year_month" id="yearMonth" value="{{ old('year_month')}}" placeholder="Enter Year Month (YYYY-MM)" maxlength="7" autocomplete="off">

                           <input type="hidden" name="startDt" id="startDt" value="{{ $YRBEGDATE }}">
                           <input type="hidden" name="endDt" id="endDt" value="{{ $YRENDDATE }}">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('year_month', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                          <small id="mmyyMag">
                            
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>


                  <div class="col-md-4" style="margin-top: 1%;margin-bottom:2%">

                    <button type="Submit" id="proceedBtn" style="padding:2px;" class="btn btn-primary" onclick="proceedBtn(1)">
                      &nbsp;&nbsp;
                      <i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Proceed&nbsp;&nbsp;
                   </button>
                   &nbsp; &nbsp;
                   <button type="button" class="btn btn-default" style="padding:2px;" name="searchdata" id="ResetId">&nbsp;&nbsp;<i class="fa fa-reply" aria-hidden="true"></i>&nbsp;&nbsp;Reset&nbsp;&nbsp;</button>
                    
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-2"></div>

                  

                </div>

                <div id="getMsg" style="text-align: center;"></div>

                <!-- /.col -->

              <!-- /.row -->


              <div style="text-align: center;">

                 

              </div>


          </div><!-- /.box-body -->


          <div class="box-body" style="margin-top: -2%;">

            
              <table id="AssetDepReportTable" class="table table-bordered table-striped table-hover">
                <thead class="theadC">

                  <tr>
                    <th class="text-center">Asset Name</th>
                    <th class="text-center">Asset No</th>
                    <th class="text-center"> Capitalize Date </th>
                    <th class="text-center">Cost Center</th>
                    <th class="text-center">Profit Center</th>
                    <th class="text-center">Particular</th>
                    <th class="text-center">Plan Amt</th>
                    <th class="text-center">Amt Posted</th>
                    <th class="text-center">Amt TBP</th>
                    <th class="text-center">Cumul. Amt</th>
                    
                  </tr>

                </thead>

                <tbody id="defualtSearch">

                  

                </tbody>
               

              </table>

          </div><!-- /.box-body -->

          <div style="text-align:center;padding-bottom: 2%;padding-top: 2%;">
            <button class="btn btn-primary" type="button" id="planData" onclick="assetPlanorPlanPostBtn('planBtn')"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>&nbsp; Plan</button>&nbsp;&nbsp;
            <button class="btn btn-primary" type="button" id="plantPostData" onclick="assetPlanorPlanPostBtn('planPostBtn')"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>&nbsp; Plan & Post</button>
            <input type="hidden" name="ajaxDta" id="getDataAjx" value="0">
          </div>

        </div>

      </div>

    </div>

  </div>


</section>
<!-- MODAL -->

<div id="glNotFound" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-sm" style="margin-top: 13%;">
      <div class="modal-content" style="border-radius: 5px;">
          <div class="modal-header" style="text-align: center;">
            <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;">&nbsp;&nbsp;Alert..<i class="fa fa-exclamation" aria-hidden="true"></i> </h5>
            
          </div>
          <div class="modal-body">
            <p id='ModlErMsg'></p>
          </div>
          <div class="modal-footer" style="text-align: center;">
              <button type="button"  id="cancleBtn"  class="btn btn-danger" data-dismiss="modal" style="width: 90px;">Cancel</button>
              <button type="button" id="okBtn" class="btn btn-primary"data-dismiss="modal" onclick="proceedBtn(2)" style="width: 90px;">Ok</button>
          </div>
      </div>
  </div>
</div>
<!-- MODAL -->

</div>



@include('admin.include.footer')



<script type="text/javascript">

  function proceedBtn(tabId){

    var mmYY       = $('#yearMonth').val();
    
    if(tabId ==1){
      var ajxCode    = 101;
    }else{
      var ajxCode    = 103;
    }
    
    if(mmYY!=''){

      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
      });

      $.ajax({

            url:"{{ url('get-data-from-assetdeptran') }}",

            method : "GET",

            type: "JSON",

            data: {mmYY: mmYY,ajxCode:ajxCode},

            success:function(data){

              var data1 = JSON.parse(data);

              $('#mmyyMag').html('');

              if(data1.response == 'AlreadyExist'){

                var dataCount = data1.data.length;

                var found1 = '';

                for(var y=0;y<dataCount;y++){

                  if(data1.data[y].POST_AMT == 0.00){
                    found1 ='yes';
                  }else{
                    found1 ='no';
                  }
                }

                if(found1 == 'no'){

                  var modlMsg = '<b style="font-weight:600;"><i class="fa fa-caret-right" aria-hidden="true"></i> Depreciation Posting For Selected Month, Already Posted. Can Not Be Repost...!</b>';
                  $('#okBtn').hide();

                }else{
                   var modlMsg = '<i class="fa fa-caret-right" aria-hidden="true"></i><span style="font-weight:600;"> Depreciation Already Planed. You Want To Overwrite? </span>'; 
                   $('#okBtn').show();
                }
                $("#ModlErMsg").html(modlMsg);
                $("#glNotFound").modal('show');  

               /* var errMag1 = 'Depreciation Already Planed. You Want To Overwrite';
                  $('#mmyyMag').html("<p style='color:red'>"+ errMag1 +"</p>");*/

                 

              }else if(data1.response == 'success'){
                         
                  $('#getDataAjx').val('1');

              }else if(data1.response == 'successM'){
                  $('#getDataAjx').val('1');
              }else if (data1.response == 'error') {

                  var errMag = '<i class="fa fa-caret-right" aria-hidden="true"></i><span style="font-weight:600;"> Please Select Previous Month-Year...! </span>';

                  $('#mmyyMag').html("<p style='color:red'>"+ errMag +"</p>");
              }

            }

      });


  setTimeout(function () {

      var dataAjxVal = $('#getDataAjx').val();

      if(dataAjxVal == '1'){

        var ajxCode = 102;

        $('#AssetDepReportTable').DataTable({
          destroy: true,
          processing: true,
          serverSide: true,
          scrollX: true,
          pageLength:'25',
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
          
          buttons:  [],
         
          ajax:{
            url:'{{ url("get-data-from-assetdeptran") }}',
            data: {mmYY:mmYY,ajxCode:ajxCode}
          },
          columns: [

            { 
              render: function (data, type, full, meta){
                  
                var itemName = '<form ><p>'+full['ASSET_NAME']+'</p>'+'<p style="line-height:2px;">('+full['ASSET_CODE']+')<input type="hidden" id="AssetCodeId'+full['DT_RowIndex']+'" value="'+full['ASSET_CODE']+'"></p><input type="hidden" name="assetCode[]" value="'+full['ASSET_CODE']+'">';
                return itemName;

              }
            },
            {
                data:'ASSET_NO',
                name:'ASSET_NO',
                className:'datebill'
            },
            {
                data:'CAPITALIZE_DATE',
                name:'CAPITALIZE_DATE',
                className:'text-right'
            },
            {
                data:'COST_CENTER',
                name:'COST_CENTER',
                className: "alignCenterClass"
            },
            {
              data:'PFCT_CODE',
              name:'PFCT_CODE',
              className: "alignCenterClass"
            },
            {
                data:'PARTICULAR',
                name:'PARTICULAR'
            },
            {
                data:'PLANAMT',
                name:'PLANAMT',
                className: "alignRightClass"
               
            },
            {
                data:'POSTAMT',
                name:'POSTAMT',
                className: "alignRightClass"
               
            },
            {
                data:'TBPAMT',
                name:'TBPAMT',
                className: "alignRightClass"
               
            },
            {
                className: "alignRightClass",
                render: function (data, type, full, meta){
                  
                var CUMAMT = '<form ><p>'+full['CUM_AMT']+'</p>'+'<input type="hidden" name="CUMAMT" value="'+full['CUM_AMT']+'">';

                $('#yearMonth').prop('readonly', true);
                $('#asset_code').prop('readonly', true);

                return CUMAMT;

              }
               
            }
            
          ]


      });

      funcheckTable();
      }

  }, 500);

    }else{

      var errMag = 'The Year-Month field is required.';

      $('#mmyyMag').html("<p style='color:red'>"+ errMag +"</p>");


    }


  }


function funcheckTable(){

    setTimeout(function() {

      var table = $('#AssetDepReportTable').DataTable();

      if ( ! table.data().any() ) {

          $("#emplist").prop('disabled',true);

          $("#getMsg").html('<b style="font-weight:600;"><i class="fa fa-caret-right" aria-hidden="true"></i> Depreciation Posting For Selected Month, Already Posted. Can Not Be Repost...!</b>');

      }else{

        $("#emplist").prop('disabled',false);

      }
   }, 600);
}
    

function assetPlanorPlanPostBtn(btnName){

  var mmYY    = $('#yearMonth').val();

  var nameBtn = btnName;
 
  if(mmYY!=''){


    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }
    });

    $.ajax({

          url:"{{ url('submit-asset-plan-amt') }}",

          method : "POST",

          type: "JSON",

          data: {mmYY: mmYY,nameBtn:nameBtn},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $("#GlList").empty();

                $('#errorItem').html("<p style='color:red'>"+ data1.response +"</p>");

              }else if(data1.response == 'success'){
                       
                var pageName = btoa('AssetTran');
                 
                 window.location.href = "{{ url('/finance/transaction/asset/asset-tran-success-message')}}/"+pageName+"";
                  
              }

          }

    });

  }


}


function assetGroup(asgroupCode){

    var ASGROUPCODE = asgroupCode;
   

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('get-gl-by-asgroupcode') }}",

          method : "POST",

          type: "JSON",

          data: {ASGROUPCODE: ASGROUPCODE},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $("#GlList").empty();

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  
                  $.each(data1.data, function(k, getData){

                    $("#GlList").empty();

                    $("#GlList").append($('<option>',{

                      value:getData.GL_CODE,

                      'data-xyz':getData.GL_NAME,
                      text:getData.GL_NAME

                    }));

                  });

              }

          }

    });

}


$(document).ready(function() {

  $('#ResetId').click(function(){

    location.reload();

  });

  var YRBEGDATE = $('#startDt').val();
  var YRENDDATE = $('#endDt').val();

    $('#yearMonth').datepicker({
       format: "mm-yyyy",
       autoclose: true, 
       orientation: 'bottom', 
       startView: "months", 
       minViewMode: "months",
       startDate :YRBEGDATE,
       endDate : YRENDDATE  

    });


});

</script>

@endsection