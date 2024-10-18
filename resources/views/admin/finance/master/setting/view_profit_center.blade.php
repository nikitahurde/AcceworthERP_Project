@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">
  .modal-header .close {
    margin-top: -32px;
  }
  .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
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
  @media screen and (max-width: 600px) {

    .PageTitle{
      float: left;
    }

  }
</style>

  <div class="content-wrapper">

    <section class="content-header">

      <h1> Master Profit Center <small>View Details</small></h1>

      <ol class="breadcrumb">

        <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ URL('/dashboard')}}">Master</a></li>

        <li class="Active"><a href="{{ URL('/finance/view-mast-profit-center')}}">Master Profit Center </a></li>

        <li class="Active"><a href="{{ URL('/finance/view-mast-profit-center')}}">View Profit Center </a></li>

      </ol>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-xs-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h3 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">View Profit Center</h3>

              <div class="box-tools pull-right">

                <a href="{{ url('/Master/Setting/Profit-Center-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Profit Center</a>

              </div>

            </div><!-- /.box-header -->

            @if(Session::has('alert-success'))

              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-check"></i> Success...!</h4>

                 {!! session('alert-success') !!}

              </div>

            @endif

            @if(Session::has('alert-error'))

              <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-ban"></i> Error...!</h4>

                {!! session('alert-error') !!}

              </div>

            @endif

            <div class="box-body">

              <table id="example" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>
                      <th class="text-center">Company Code</th>
                      <th class="text-center">Company Name</th>
                      <th class="text-center">Profit Center Code</th>
                      <th class="text-center">Profit Center Name</th>
                      <th class="text-center">Fax No </th>
                      <th class="text-center">Eamil Id </th>
                      <th class="text-center">Phone No </th>
                      <th class="text-center">Address </th>
                      <th class="text-center">Status</th>
                  </tr>

                </thead>

                <tbody>

                </tbody>

              </table>

            </div><!-- /.box-body -->

          </div><!-- /.box -->

        </div><!-- /.col -->

      </div><!-- /.row -->

    </section><!-- /.content -->

  </div>

  <div class="modal fade" id="pfctDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-sm" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

         You Want To Delete This Profit Center Data...!

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>

          <form action="{{ url('delete-pfct') }}" method="post">

            @csrf

            <input type="hidden" name="pfctId" id="pfctId" value="">

            <input type="submit" value="Delete" style="margin-top: -15%;" class="btn btn-sm btn-danger">

          </form>

        </div>

      </div>

    </div>

  </div>

@include('admin.include.footer')

<script type="text/javascript">
   $(document).ready(function(){

     $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

    

    var t = $("#example").DataTable({
      footerCallback: function ( row, data, start, end, display ) {
          var api = this.api(), data;

          var rowcount = data.length;
          var getRow = rowcount-1;
          
          if(rowcount > 0){
             $('.buttons-excel').attr('disabled',false);
          }else{
             $('.buttons-excel').attr('disabled',true);
          }
          
         },
       processing: true,
       serverSide:false,
       // scrollY:500,
       scrollX:true,
       paging: true,
       dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
        buttons:  [
                    {
                      extend: 'excelHtml5',
                      exportOptions: {
                            columns: [0,1,2,3,4,5,6,7]
                      },
                      title: ' MASTER PROFIT CENTER'+$("#headerexcelDt").val(),
                      filename: 'MASTER_PROFIT_CENTER'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/Master/Setting/View-Profit-Center-Mast') }}"

       },
       searching : true,
    

       columns: [
        
       
          { data:"COMP_CODE"},
          { data:"COMP_NAME"},
           { data:"PFCT_CODE"},
          { 
            render: function (data, type, full, meta){

              var pfctName = full['PFCT_NAME'];
              var pfct_name = 'display' && pfctName.length > 15 ? pfctName.substr(0, 15) + '…' : pfctName;
              return '<span data-tip="'+pfctName+'">'+ pfct_name+'</span> ';


            }
          },
          { data: "FAX_NO",
            render: function (data, type, full, meta){
              if(full['FAX_NO']){
                var faxNo = full['FAX_NO'];
              }else{
                var faxNo ='----';
              }

              return faxNo;
            }
          },

          { data: "EMAIL_ID",
            render: function (data, type, full, meta){

              if(full['EMAIL_ID']){
                var emailId = full['EMAIL_ID'];
              }else{
                var emailId ='----';
              }

              return emailId;
            }
          },

          { data: "PHONE1",
            render: function (data, type, full, meta){
              
              if(full['PHONE1']){
                var phone1 = full['PHONE1'];
              }else{
                var phone1 ='----';
              }

              if(full['PHONE2']){
                var phone2 = full['PHONE2'];
              }else{
                var phone2 ='----';
              }

              if(full['PHONE1'] && full['PHONE2']){

                 return phone1+' / '+phone2;

              }else if(full['PHONE1']){

                 return full['PHONE1'];

              }else if(full['PHONE2']){

                 return full['PHONE2'];

              }else{
                return '-----';
              }

             
            }
          },
          { 
            render: function (data, type, full, meta) {
              if(full['ADD1']==null){
                var add1='';
              }else{
                var add1=full['ADD1'];
              }

              if(full['ADD2']==null){
                var add2='';
              }else{
                var add2=full['ADD2'];
              }
              if(full['ADD3']==null){
                var add3='';
              }else{
                var add3=full['ADD3'];
              }
              var address = add1;
              var fulladdress =  add1 + "&nbsp;" + add2 +"&nbsp;"+add3+"&nbsp;"+full['DISTRICT']+"&nbsp;"+full['CITY']+"&nbsp;"+full['STATE']+"&nbsp;"+full['PIN_CODE']+"&nbsp;"+full['COUNTRY'];
              return '<span data-tip="'+fulladdress+'">'+ address+'</span> ';
            }
          },
         
         {  
            render: function (data, type, full, meta){

                   
                     
                      var enableBtn = 'enable';
                      var deletebtn ='<input type="hidden" id="deleteinput_'+full['COMP_CODE']+'_'+full['PFCT_CODE']+'" value="'+full['COMP_CODE']+'_'+full['PFCT_CODE']+'"><a href="Edit-Profit-Center-Mast/'+btoa(full['PFCT_CODE'])+'/'+btoa(full['COMP_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getId(\''+full['COMP_CODE']+'\',\''+full['PFCT_CODE']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';
                     

                      return deletebtn;

                     },className:'text-center'
        

       },
        
         
        
      ],

       


     });



});
</script>


<script type="text/javascript">


  function getId(cmpcd,pfctcode)
  {
   var getval = $('#deleteinput_'+cmpcd+'_'+pfctcode).val();
    $("#pfctDelete").modal('show');

    $("#pfctId").val(getval);



  }



</script>


@endsection







