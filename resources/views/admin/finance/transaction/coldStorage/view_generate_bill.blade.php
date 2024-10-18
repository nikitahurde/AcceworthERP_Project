@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style>
  .chieldtblecls tr td{
    border: 1px solid #ccc4c4 !important;
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
  }
  .columnhide{
    display:none;
  }
  .required-field::before {
    content: "*";
    color: red;
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
  .chieldtblecls tbody tr td {
    padding: 4px;
  }
  .chieldtblecls>tbody>tr>td {
    line-height: 0.5;
  }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>Generate Bill<small><b>Bill Details</b></small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}"> Transaction </a></li>

      <li class="active"><a href="{{ url('/view-mast-dealer') }}">Bill</a></li>

      <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Generate Bill</a></li>

    </ol>

  </section>

  <!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">
             
        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Generate Bill</h3>

            <div class="box-tools pull-right">

              <a href="{{ url('/Transaction/ColdStorage/add-bill-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Bill</a>

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

              <table id="example" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>

                    <th class="text-center">#</th>
                    <th class="text-center">Vr. No.</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Acc Name</th>
                    <th class="text-center">Plant Name</th>
                    <th class="text-center">Tax Code</th>
                    <th class="text-center">Action</th>

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


@include('admin.include.footer')

<script type="text/javascript">

   function format ( d ) {
  //  console.log('d',d.id);
    // `d` is the original data object for the row
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.BILTYHID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th>Sr. No.</th>'+
            '<th>Cold Storage</th>'+
            '<th>Chamber</th>'+
            '<th>Floor</th>'+
            '<th>Block</th>'+
            '<th>Qty</th>'+
        '</tr></tbody>'+
    '</table>';
}

   $(document).ready(function(){

     $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

    

    var t = $("#example").DataTable({

       processing: true,
       serverSide:false,
       //scrollY:500,
       scrollX:true,
       paging: true,
       ajax:{

        url : "{{ url('/Transaction/ColdStorage/view-bill-trans') }}"

       },
       searching : true,
    

        columns: [
         
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.SBILLHID+')"><i class="fa fa-plus" id="minus'+full.SBILLHID+'" title="Toggle"></i></button>'
            }
          },
          { 
            data:"VRNO",
            name:"VRNO"
          },
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
              },
              className:'dtvrDate'
          },
          {  
            render: function (data, type, full, meta){

              var accCd    = (full['ACC_CODE'] != null) ? full['ACC_CODE'] : '---';
              var accNm    = (full['ACC_NAME'] != null) ? full['ACC_NAME'] : '---';

              var acc_name = 'display' && accNm.length > 15 ? accNm.substr(0, 15) + '…' : accNm;
              return '<span data-tip="'+accNm+'">'+ acc_name+' ( '+accCd+' )</span> ';

            }
          },
          {  
            render: function (data, type, full, meta){

              var packingCd    = (full['PLANT_CODE'] != null) ? full['PLANT_CODE'] : '---';
              var packingNm    = (full['PLANT_NAME'] != null) ? full['PLANT_NAME'] : '---';

              var pack_name = 'display' && packingNm.length > 15 ? packingNm.substr(0, 15) + '…' : packingNm;
              return '<span data-tip="'+packingNm+'">'+ pack_name+' ( '+packingCd+' )</span> ';

            }
          },
          {
              data:'TAX_CODE',
              name:'TAX_CODE'
          },
          {  
            render: function (data, type, full, meta){
                   
                      var enableBtn = 'enable';
                      var deletebtn ='<a href="" class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dealerDelete();" disabled><i class="fa fa-trash" title="Delete"></i></button>'; 

                      return deletebtn;
            }
        
          },

        ],

    });

    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        console.log(tr);
        var row = t.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });

});


  function getVrno(vrno){

    $("#jobcard_no").val(vrno);

  }

   function showchildtable(tblid){
            var tblid;

            

             $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });
             
             $("#minus"+tblid).toggleClass('fa-plus fa-minus rotate');

             $.ajax({

              url:"{{ url('view-bilty-chield-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {tblid:tblid},

               success:function(data){

                  var data1 = JSON.parse(data);

                  console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                         var objrow = data1.data;
                         var srNo=1;
                         var tableid = objrow[0].BILTYHID;
                       $.each(objrow, function (row, objrow) {

                       
                      
                               $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td>'+objrow.CS_CODE+'[ '+objrow.CS_NAME+' ]</td><td>'+objrow.CHAMBER_CODE+'[ '+objrow.CHAMBER_NAME+' ]</td><td>'+objrow.FLOOR_CODE+'[ '+objrow.FLOOR_NAME+' ]</td><td>'+objrow.BLOCK_CODE+'[ '+objrow.BLOCK_CODE+' ]</td><td>'+objrow.QTY+'</td></tr>');
                              srNo++;


                            });

                      }
                      
                  }
               }

          });
    }
</script>

<script type="text/javascript">
	
	function downloadPDF(uniqNo,headId,vrno,tCode){


      var uniqNo,headId,vrno,tCode;
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

        url:"{{ url('pdf-donwload-when-view-jobcard-pages') }}",

        method : "POST",

        type: "JSON",

        data: {uniqNo: uniqNo,headId:headId,vrno:vrno,tCode:tCode},

        success:function(data){
          console.log('data',data);
          var data1 = JSON.parse(data);
          console.log('data1',data1);
          console.log('data1',data1);
          var fyYear = data1.data[0].FY_CODE;
          var fyCd = fyYear.split('-');
          var seriesCd = data1.data[0].SERIES_CODE;
          var vrNo = data1.data[0].VRNO;
          var fileN = 'JOBCARD_'+fyCd[0]+''+seriesCd+''+vrNo;
          var link = document.createElement('a');
          link.href = data1.url;
          link.download = fileN+'.pdf';
          link.dispatchEvent(new MouseEvent('click'));
        }

      });
    }
</script>

<script type="text/javascript">
  function pindentDelete(id) {

    //alert(id);return false;

    $("#indentDelete").modal('show');

    $("#bodyID").val(id);
  }
  
</script>

<script type="text/javascript">
  
  function validation(){

     var closing_dt = $("#closing_dt").val();

     if(closing_dt==''){

          $("#closing_err").html('This field is required');
          return false;
     }else{

        $("#closing_err").html('');
         
     }

  }

</script>

@endsection



