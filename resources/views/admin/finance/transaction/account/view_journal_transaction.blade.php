@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .Custom-Box {
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }

  .box-header>.box-tools {
    position: absolute !important;
    right: 10px !important;
    top: 2px !important;

  }

  .showSeletedName {
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
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
    font-size: 15px!important;
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
  .dtvrDate{
    width:7%;
  }
  .dtVrno{
    width:7%;
  }
  .dtglName{
    width:28%;
  }
  .dtaccName{
    width:28%;
  }
  .dtRemark{
    width:28%;
  }
  .dtDrcrAmt{
    width:10%;
    text-align:right;
  }
  .dtAction{
    width:5%;
  }
  .action_btn{
    width:5%;
  }
  [data-tip] {
    position:relative;
  }
  [data-tip]:before {
    content:'';
    /* hides the tooltip when not hovered */
    display:none;
    content:'';
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-bottom: 5px solid #1a1a1a; 
    position:absolute;
    top:12px;
    left:35px;
    z-index:8;
    font-size:0;
    line-height:0;
    width:0;
    height:0;
  }
  [data-tip]:after {
    display:none;
    content:attr(data-tip);
    position:absolute;
    top:17px;
    left:0px;
    padding:3px 3px;
    background:#1a1a1a;
    color:#fff;
    z-index:9;
    font-size: 0.75em;
    height:25px;
    line-height:18px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    white-space:nowrap;
    word-wrap:normal;
  }
  [data-tip]:hover:before,
  [data-tip]:hover:after {
    display:block;
  }
  .box-header {
      color: #444;
      display: block;
      padding: 3px;
      position: relative;
  }
  table.dataTable {
      clear: both;
      margin-top: 0px !important;
      margin-bottom: 6px !important;
      max-width: none !important;
  }
  .hideCol{
    display:none;
  }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Journal Transaction

      <small> Journal Transaction Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Report/MIS</a></li>

      <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">Journal Transaction Report</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Journal Transaction</h2>

        <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/Account/Journal-Trans') }}" class="btn btn-primary" style="margin-right: 10px;padding: 1px 5px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Journal Trans</a>

        </div>

        @if(Session::has('alert-success'))

          <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;    text-align: initial;">

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

            <h4>

            <i class="icon fa fa-check"></i>

            Success...!

            </h4>

            {!! session('alert-success') !!}

          </div>

        @endif

        @if(Session::has('alert-error'))

          <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;    text-align: initial;">

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

            <h4>

            <i class="icon fa fa-ban"></i>

            Error...!

            </h4>

            {!! session('alert-error') !!}

          </div>

        @endif

      </div><!-- /.box-header -->

      <div class="box-body" style="margin-top: -2%;">

        <form id="myForm">
          @csrf
          <div class="row" style="margin-top: 13px;">

            <div class="col-md-3">

              <div class="form-group">

                <label for="exampleInputEmail1"> Account Code: </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>

                    <input list="accList" name="accCode" id="accCode" class="form-control " placeholder="Select Account Code" >

                    <datalist id="accList">

                      <option selected="selected" value="">-- Select --</option>

                      @foreach ($acc_list as $key)
                  
                        <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>
                      @endforeach

                    </datalist>

                  </div>

              </div>

            </div>

            <div class="col-md-3">

              <div class="form-group">

                <label for="exampleInputEmail1"> Series Code: </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>

                    <input list="seriesList" name="seriesCode" id="seriesCode" class="form-control" placeholder="Select Series" >

                    <datalist id="seriesList">

                      <option selected="selected" value="">-- Select --</option>

                      @foreach ($series_list as $key)
                  
                        <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>
                      @endforeach

                    </datalist>

                  </div>
                  <small>  
                      <div class="pull-left showSeletedName" id="seriesText"></div>
                  </small>

              </div>

            </div>

            <div class="col-md-3">

              <div class="form-group">

                <label for="exampleInputEmail1"> To Date: </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                    <?php 

                      $CurrentDate =date("d-m-Y");

                      $FromDate = date("d-m-Y", strtotime($fromDate));
                      $ToDate   = date("d-m-Y", strtotime($toDate));

                      $spliDate    = explode('-', $CurrentDate);
                                   
                      $yearGet     = Session::get('macc_year');
                         
                      $fyYear      = explode('-', $yearGet);
                         
                      $get_Month   = $spliDate[1];
                      $get_year    = $spliDate[2];

                      if($get_Month >=3 && $get_year == $fyYear[1]){
                          $vrDate = $ToDate;
                      }else{
                          $vrDate = $CurrentDate;
                      }

                    ?>
                    <input type="hidden" value="{{$FromDate}}" id="fromdate">
                    <input type="hidden" value="{{$ToDate}}" id="todate">
                    <input type="text" name="to_date" id="to_date" class="form-control todatePicker" placeholder="Select Transaction Date" value="<?php echo $vrDate; ?>">

                  </div>
              </div>

            </div>

            <div class="col-md-3" style="margin-top: 10px;">

              <div class="">

                <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch" style="padding: 2px 5px;"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                <button type="button" class="btn btn-default" name="searchdata" id="ResetId" style="padding: 2px 5px;"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

              </div>

            </div>

          </div>
        </form>
        <style>
          #InwardDispatch {
            width: 100% !important;
          }
        </style>  
        <table id="InwardDispatch" class="table table-bordered table-striped table-hover" style="width:100%">

          <thead class="theadC">

            <tr>

              <th class="text-center dtvrDate">Vr Date</th>
              <th class="text-center dtVrno">Vr No</th>
              <th class="text-center dtglName">Gl Name</th>
              <th class="text-center hideCol">Gl Code</th>
              <th class="text-center dtaccName">Account Name</th>
              <th class="text-center hideCol">Account Code</th>
              <th class="text-center dtDrcrAmt">Debit-DR </th>
              <th class="text-center dtDrcrAmt">Credit-CR</th>
              <th class="text-center dtAction">Action</th>
              <th class="text-center dtAction">PDF</th>

            </tr>

          </thead>

          <tbody id="defualtSearch">

          </tbody>

        </table>

      </div><!-- /.box-body -->

    </div>

  </section>

  <section class="content" style="margin-top: -2%;">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body" style="padding: 2%;">

            <div class="divTable">

              <div class="divTableBody" id="chieldBodyDetails">

                <div class="row">

                  <div class="col-md-12">

                    <div style="font-weight: 700;">Particular :&nbsp; <small id="perticularText" style="font-weight: 600;"></small></div>
                    
                  </div>
                  
                </div>
                
              </div><!-- /.divTableBody -->
              
            </div><!-- /.div table -->
            
          </div><!-- /.box-body -->
          
        </div><!-- /.Custom-Box -->
        
      </div><!-- /.col -->
      
    </div><!-- /.row -->
    
  </section><!-- /.section -->

</div>

<!-- ------ delete data modal ------ -->

  <div class="modal fade" id="journalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-sm" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          You Want To Delete This ...!

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>

          <form action="{{ url('/Transaction/Account/Delete-Journal-Trans') }}" method="post">

            @csrf

            <input type="hidden" name="journalid" value="" id='updateid'>

            <input type="submit" value="delete" class="btn btn-sm btn-danger" style="margin-top: -15%;">

          </form>

        </div>

      </div>

    </div>

  </div>

<!-- ------ delete data modal ------ -->

<!-- ---- START : SECTION FOR SHOW DETAILS ---- -->

  

<!-- ---- START : SECTION FOR SHOW DETAILS ---- -->


@include('admin.include.footer')


<script type="text/javascript">

  $( window ).on( "load", function() {

    var toDate = $('#todate').val()
    var fromDate = $('#fromdate').val()

    $('.todatePicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      startDate :fromDate,

      endDate : toDate,

      autoclose: 'true'

    });

  });  
  function deleteJournalT(id){
     $('#getuserid').val(id);

  }
</script>
<script type="text/javascript">
  $(document).ready(function(){

      $("#seriesCode").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#seriesList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        //alert(msg+xyz);

         if(msg=='No Match'){

           $(this).val('');
        

        }

      });
      
  })
</script>
<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(accCode='',seriesCode='',to_date='',fromdate=''){


          $('#InwardDispatch').DataTable({

              'fnCreatedRow': function (nRow, aData, iDataIndex) {
                
                  $(nRow).attr('onclick', "showBodyDetail(\""+aData['COMP_CODE']+"\",\""+aData['FY_CODE']+"\",\""+aData['TRAN_CODE']+"\",\""+aData['SERIES_CODE']+"\","+aData['VRNO']+","+aData['JVID']+")"); // or whatever you choose to set as the id
              },
              processing: true,
              serverSide: false,
              info: true,
              bPaginate: false,
              scrollY: 350,
              scrollX: true,
              scroller: true,
              fixedHeader: true,
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
              buttons: [
                        {
                          extend: 'excelHtml5',
                          exportOptions: {
                                columns: [0,1,2,4,6,7]
                          }
                        }
                      ],
              ajax:{
                url:'{{ url("/Transaction/Account/View-Journal-Trans") }}',
                data: {accCode:accCode,seriesCode:seriesCode,to_date:to_date,fromdate:fromdate}
              },
              columns: [

                {    
                      data :'VRDATE',
                      render: function (data, type, full, meta) {

                        var extDate = full['VRDATE'];
                        
                        var extArr  = extDate.split('-');
                        
                        var year    =  extArr[0];
                        var month   =  extArr[1];
                        var mdate   =  extArr[2];

                        return mdate+'-'+month+'-'+year;

                    },className:'dtVrno'
                  },
                { 
                  data :'VRNO',
                  render: function (data, type, full, meta){
                         
                    var fy_code = full['FY_CODE'].split('-');

                    var VRNO = fy_code[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];
                          
                    return VRNO;
                               
                  },
                  className:'dtVrno'
                },
                {   
                    data :'GL_NAME',
                    render: function (data, type, full, meta){

                      if(full['GL_CODE'] == null){
                        var glCode = '--';
                      }else{
                        var glCode = full['GL_CODE'];
                      }
                      
                      if(full['GL_NAME'] == null){
                        var gName = '--';
                        return '-- ( -- )';
                      }else{
                        var glName = full['GL_NAME'];
                        var gName = 'display' && glName.length > 29 ? glName.substr(0, 29) + '…' : glName;
                        return  glName+' ( '+glCode+' )</span> ';
                      }    
                  },
                  className:'dtglName'
                },
                {
                    data:'GL_CODE',
                    name:'GL_CODE',
                    className: "hideCol"

                },
                {   
                    data :'ACC_NAME',
                    render: function (data, type, full, meta){

                      if(full['ACC_CODE'] == null){
                        var accCode ='--';
                      }else{
                        var accCode =full['ACC_CODE'];
                      }

                      if(full['ACC_NAME'] == null){
                        var accName ='--';
                        return '-- ( -- )';
                      }else{
                        var ac_Name = full['ACC_NAME'];
                        var accName ='display' && ac_Name.length > 29 ? ac_Name.substr(0, 29) + '…' : ac_Name;
                        return ac_Name+' ( '+accCode+' )</span> ';
                      }

                  },
                  className:'dtaccName'
                },
                {
                    data:'ACC_CODE',
                    name:'ACC_CODE',
                    className: "hideCol"

                },
                {
                    data:'DRAMT',
                    name:'DRAMT',
                    className:'dtDrcrAmt'
                },
                {
                    data:'CRAMT',
                    name:'CRAMT',
                    className:'dtDrcrAmt'
                },
                {
                    render: function (data, type, full, meta){

                      var deletebtn ='<a href="Edit-Journal-Trans/'+btoa(full['COMP_CODE'])+'/'+btoa(full['FY_CODE'])+'/'+btoa(full['TRAN_CODE'])+'/'+btoa(full['SERIES_CODE'])+'/'+btoa(full['VRNO'])+'" class="btn btn-warning btn-xs" title="edit" style="font-size: 10px;padding: 0px 2px;"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" style="font-size: 10px;padding: 0px 2px;" data-toggle="modal" onclick="return deleteJournal(\''+full['COMP_CODE']+'\',\''+full['FY_CODE']+'\',\''+full['TRAN_CODE']+'\',\''+full['SERIES_CODE']+'\',\''+full['VRNO']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';
                      return deletebtn;

                    },
                    className:'action_btn'
                },
                {
                  render:function(data, type, full, meta){

                    return '<button class="btn btn-success pdfbtndn" type="button" id="pdfDown" onclick="downloadPDF(\''+full['COMP_CODE']+'\',\''+full['FY_CODE']+'\',\''+full['TRAN_CODE']+'\',\''+full['SERIES_CODE']+'\','+full['VRNO']+','+full['SUMDRAMT']+');"><i class="fa fa-download" aria-hidden="true"></i></button>';
                  },
                  className:'action_btn'
                },

              ]


          });


       }


      $('#btnsearch').click(function(){

          var acct_code =  $('#accCode').val();
          var seriesCode =  $('#seriesCode').val();
          var to_date =  $('#to_date').val();
          var fromdate =  $('#fromdate').val();

          if (acct_code!='' || seriesCode!='' || to_date!='') {

            $('#InwardDispatch').DataTable().destroy();
            load_data(acct_code,seriesCode,to_date,fromdate);

          }else{

           $('#InwardDispatch').DataTable().destroy();
            load_data();
          }


        });


        $('#ResetId').click(function(){
           
          $('#accCode').val('');
          $('#seriesCode').val('');
          $('#InwardDispatch').DataTable().destroy();
          load_data();

        });



  });

  function deleteJournal(compCd,fyCd,tranCd,seriesCd,vrNo){
    $('#journalDelete').modal('show');
    var idComb = compCd+'_'+fyCd+'_'+tranCd+'_'+seriesCd+'_'+vrNo;
    $('#updateid').val(idComb);
  }

  function downloadPDF(compCd,fyCd,tranCd,seriesCd,vrno,totalAmt){

    var compCd,fyCd,tranCd,seriesCd,vrno;
        //consreturn false;
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

      url:"{{ url('Transaction/Account/download-pdf-on-view-page-journal') }}",

      method : "POST",

      type: "JSON",

      data: {compCd: compCd,fyCd:fyCd,tranCd:tranCd,seriesCd:seriesCd,vrno:vrno,totalAmt:totalAmt},

      success:function(data){

        var data1 = JSON.parse(data);
        console.log('data1',data1);
        var fyYear = data1.data[0].FY_CODE;
        var fyCd = fyYear.split('-');
        var seriesCd = data1.data[0].SERIES_CODE;
        var vrNo = data1.data[0].VRNO;
        var fileN = 'JV_'+fyCd[0]+''+seriesCd+''+vrNo;
        var link = document.createElement('a');
        link.href = data1.url;
        link.download = fileN+'.pdf';
        link.dispatchEvent(new MouseEvent('click'));
      }

    });
  }

  function showBodyDetail(compCd,fyCd,tranCd,seriesCd,vrNo,jvTblId){

      $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

      });

      $.ajax({

          url:"{{ url('show-details-on-click-of-row-in-account-section-page') }}",

          method : "POST",

          type: "JSON",

          data: {compCd:compCd,fyCd:fyCd,tranCd:tranCd,seriesCd:seriesCd,vrNo:vrNo,jvTblId:jvTblId},

          success:function(data){

            var data1 = JSON.parse(data);
           
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
              }else if(data1.response == 'success'){

                  //console.log('data1.data_detail',data1.data_detail);

                  if(data1.data_detail==''){
                   
                  }else{

                    if((data1.data_detail[0].NARRATION == '') || (data1.data_detail[0].NARRATION == null)){
                      var narration = '';
                    }else{
                      var narration ='/'+data1.data_detail[0].NARRATION; 
                    }
                    $('#perticularText').html(data1.data_detail[0].PARTICULAR+narration);
                    
                  } /* /. CHECK DATA*/

              }/* /. RESPONSE CHECK*/

          }/* /. SUCCESS FUNCTION*/

      });/* /. AJAX FUCNTION*/

    }

</script>


@endsection