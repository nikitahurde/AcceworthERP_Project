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

  .required-field::before {
    content: "*";
    color: red;
  }

  .showAccName{
    border: none;
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
  }

  .defualtSearchNew{
    display: none;
  }

  .showSeletedName {
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  }

   @media only screen and (max-width: 600px) {
    
    .dataTables_filter{
      margin-left: 35%;
    }
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
    
    font-size: 14px!important;
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
  
  .textRgiht{
    text-align: right;
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

</style>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      View Contra Transaction

      <small> View Contra Transaction Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Report/MIS</a></li>

      <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">View Contra Transaction Report</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="box box-primary Custom-Box">

        <div class="box-header with-border" style="text-align: center;">

          <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">View Contra Transaction</h2>

          <div class="box-tools pull-right">

            <a href="{{ url('/Transaction/Account/Contra-Trans') }}" class="btn btn-primary" style="margin-right: 10px;padding: 1px 5px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Contra Trans</a>

          </div>
        </div><!-- /.box-header -->

        @if(Session::has('alert-success'))

          <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

              <h4> <i class="icon fa fa-check"></i> Success...! </h4>

              {!! session('alert-success') !!}

          </div>

        @endif

        @if(Session::has('alert-error'))

          <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

              <h4><i class="icon fa fa-ban"></i>Error...!</h4>

              {!! session('alert-error') !!}

          </div>

        @endif

        <div class="box-body" >

          <table id="InwardDispatch" class="table table-bordered table-striped table-hover">

            <thead class="theadC">

              <tr>

                <th class="text-center">Date</th>

                <th class="text-center">Vr No</th>

                <th class="text-center">Acc Name</th>

                <th class="text-center">Particular</th>

                <th class="text-center">Debit-DR</th>

                <th class="text-center">Credit-CR</th>

                <th class="text-center">Action</th>

              </tr>

            </thead>

            <tbody id="defualtSearch">

            </tbody>

          </table>

        </div><!-- /.box-body -->

    </div>

  </section>

</div>

<!-- ------- modal for delete ------  -->

  <div class="modal fade" id="contraDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

       <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>

      <form action="{{ url('/Transaction/Account/Delete-Contra-Trans') }}" method="post">

      @csrf

            <input type="hidden" name="contranum" value="" id='updateid'>

            <input type="submit" value="Delete" class="btn btn-sm btn-danger" style="margin-top: -15%;">

          </form>

         </div>

      </div>

    </div>

  </div>

<!-- ------- modal for delete ------  -->

@include('admin.include.footer')

<script type="text/javascript">
  function deleteContra(id){
      console.log(id);
     $('#getuserid').val(id);

  }
</script>
<script type="text/javascript">

  $(document).ready(function(){

    $("#BankCode").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#BankList option').filter(function() {

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

        function load_data(){

          $('#InwardDispatch').DataTable({
            
              processing: true,
              serverSide: true,
              scrollX: true,
              //dom : 'Bfrtip',
              pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
              buttons: [
                        'excelHtml5'
                        ],
              
              ajax:{
                url:'{{ url("/Transaction/Account/View-Contra-Trans") }}',
               
              },
              columns: [

                {
                    data:'VRDATE',
                    render: function (data) {
                        var date = new Date(data);
                        var month = date.getMonth() + 1;
                        if(data=='0000-00-00'){
                          return '00-00-0000';
                        }else{
                          
                        return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                        }
                    }
                },
                {  
                  render: function (data, type, full, meta){
                         
                    var fy_code = full['FY_CODE'].split('-');

                    var VRNO = fy_code[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];
                          
                    return VRNO;
                               
                  }  
                },
                {   
                  render:function(data, type, full, meta){

                      if(full['GL_CODE'] == null){
                        var accCode ='--';
                      }else{
                        var accCode =full['GL_CODE'];
                      }

                      if(full['GL_NAME'] == null){
                        var accName ='--';
                        return '-- ( -- )';
                      }else{
                        var ac_Name = full['GL_NAME'];
                        var accName ='display' && ac_Name.length > 15 ? ac_Name.substr(0, 15) + '…' : ac_Name;
                        return '<span data-tip="'+ac_Name+'">'+ accName+' ( '+accCode+' )</span> ';
                      }
                  }
                },
                {
                  render:function(data, type, full, meta){

                      if(full['PARTICULAR'] == null){
                        var perticular ='--';
                      }else{
                        var textPert =full['PARTICULAR'];
                        var perticular ='display' && textPert.length > 15 ? textPert.substr(0, 15) + '…' : textPert;
                        return '<span data-tip="'+textPert+'">'+ perticular+'</span> ';
                      }
                  }
                },
                {    data:'DRAMT',
                     name:'DRAMT',
                     className:'textRgiht',
                },
                {    data:'CRAMT',
                     name:'CRAMT',
                     className:'textRgiht',
                },
                {
                    render: function (data, type, full, meta){

                      var deletebtn ='<a href="Edit-Contra-Trans/'+btoa(full['COMP_CODE'])+'/'+btoa(full['FY_CODE'])+'/'+btoa(full['TRAN_CODE'])+'/'+btoa(full['SERIES_CODE'])+'/'+btoa(full['VRNO'])+'" class="btn btn-warning btn-xs" title="edit" style="font-size: 10px;padding: 0px 2px;"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" style="font-size: 10px;padding: 0px 2px;" data-toggle="modal" onclick="return deleteContra(\''+full['COMP_CODE']+'\',\''+full['FY_CODE']+'\',\''+full['TRAN_CODE']+'\',\''+full['SERIES_CODE']+'\',\''+full['VRNO']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';
                      return deletebtn;

                    }
                },

              ]


          });


       }

  });

  function deleteContra(compCd,fyCd,tranCd,seriesCd,vrNo){
    $('#contraDelete').modal('show');
    var idComb = compCd+'_'+fyCd+'_'+tranCd+'_'+seriesCd+'_'+vrNo;
    $('#updateid').val(idComb);
  }

</script>


@endsection