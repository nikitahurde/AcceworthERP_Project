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
</style>

<div class="content-wrapper">

  <section class="content-header">

    <h1>View Inward Storage<small><b>Inward Storage Details</b></small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}"> Master </a></li>

      <li class="active"><a href="{{ url('/transaction/ColdStorage/view-inward-storage-transaction') }}">Vehicle Storage</a></li>

      <li class="active"><a href="{{ url('/transaction/ColdStorage/view-inward-storage-transaction') }}">View Vehicle Storage</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-xs-12">
             
        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Inward Storage</h3>

            <div class="box-tools pull-right">

              <a href="{{ url('/transaction/ColdStorage/add-inward-storage-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Inward Storage</a>

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

                <h4><i class="icon fa fa-ban"></i>Error...!</h4>

                  {!! session('alert-error') !!}

              </div>

            @endif

            <div class="box-body">

              <table id="example" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>

                    <th class="text-center">Sr.NO</th>
                    <th class="text-center">Vr No.</th>
                    <th class="text-center">Vr Date.</th>
                    <th class="text-center">Acc Name</th>
                    <th class="text-center">Series Name</th>
                    <th class="text-center">Plant Name</th>
                    <th class="text-center">Vehicle No</th>
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

<!--  ------- START : MODAL FOR DELETE --------------  -->

<div class="modal fade" id="indentDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        You Want To Delete This Purchase Indent Data...!

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>

          <form action="{{ url('/finance/delete-purchase-body-indent') }}" method="post">

            @csrf

            <input type="hidden" name="bodyID" id="bodyID" value="">

            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">

          </form>

      </div>

    </div>

  </div>

</div>

<!--  ------- END : MODAL FOR DELETE --------------  -->

@include('admin.include.footer')

<script type="text/javascript">

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

          url : "{{ url('/transaction/ColdStorage/view-inward-storage-transaction') }}"

        },
        searching : true,
  
        columns: [
        
          { data:"",className:'details-control',
              render: function(data, type, full, meta) {
              return '<button id="showchildtable" class="actionBTN" onclick="showchildtable('+full.CSVEHICLEHID+')"><i class="fa fa-plus " id="minus'+full.CSVEHICLEHID+'" title="Edit"></i></button>'
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
              data:'VRDATE',
              className:'text-right',
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
                  var accName ='display' && ac_Name.length > 15 ? ac_Name.substr(0, 15) + '…' : ac_Name;
                  return '<span data-tip="'+ac_Name+'">'+ accName+' ( '+accCode+' )</span> ';
                }

            },
            className:'dtaccName'
          },
          {  
            data :'SERIES_NAME',
              render: function (data, type, full, meta){

                if(full['SERIES_CODE'] == null){
                  var seriesCode ='--';
                }else{
                  var seriesCode =full['SERIES_CODE'];
                }

                if(full['SERIES_NAME'] == null){
                  var seriesName ='--';
                  return '-- ( -- )';
                }else{
                  var series_Name = full['SERIES_NAME'];
                  var seriesName ='display' && series_Name.length > 15 ? series_Name.substr(0, 15) + '…' : series_Name;
                  return '<span data-tip="'+series_Name+'">'+ seriesName+' ( '+seriesCode+' )</span> ';
                }

            },
      
          },
          {  
            data :'PLANT_CODE',
            render: function (data, type, full, meta){

                if(full['PLANT_CODE'] == null){
                  var plantCode ='--';
                }else{
                  var plantCode =full['PLANT_CODE'];
                }

                if(full['PLANT_NAME'] == null){
                  var plantName ='--';
                  return '-- ( -- )';
                }else{
                  var plant_Name = full['PLANT_NAME'];
                  var plantName ='display' && plant_Name.length > 15 ? plant_Name.substr(0, 15) + '…' : plant_Name;
                  return '<span data-tip="'+plant_Name+'">'+ plantName+' ( '+plantCode+' )</span> ';
                }

            },
        
          },
          {  
            
            data:'VEHICLE_NO',
            name:'VEHICLE_NO'
        
          },
          {  
            render: function (data, type, full, meta){
                   
              var enableBtn = 'enable';
              var deletebtn ='<a href="edit-vehicle-inward/'+btoa(full['VEHICLEID'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return dealerDelete('+full['VEHICLEID']+');"><i class="fa fa-trash" title="Delete"></i></button>';
          
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


   function showchildtable(vrno,tblid){
            var vrno,tblid;

           

             $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });

             $("#minus"+vrno+''+tblid).toggleClass('fa-plus fa-minus rotate');

             $.ajax({

              url:"{{ url('view-gate-entry-purchase-chield-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {vrno: vrno,tblid:tblid},

               success:function(data){

                  var data1 = JSON.parse(data);

                  //console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                         var objrow = data1.data;
                         var srNo=1;
                         var tableid = objrow[0].GRNGATEHID;
                       $.each(objrow, function (row, objrow) {


                        console.log('qtyrcd',objrow.QTYRECD);


                      if(objrow.FLAG=='1' || objrow.FLAG=='0'){
                      
                      var enableBtn = 'enable';
                      var deletebtn ='<a class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" disabled><i class="fa fa-trash" title="Delete"></i></button>';

                    }else{

                        var enableBtn = 'enable';
                      var deletebtn ='<a href="edit-purchase-indent/'+btoa(objrow.GRNGATEHID)+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return pindentDelete('+objrow.GRNGATEHID+');"><i class="fa fa-trash" title="Delete"></i></button>';
                    }
                               $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td><p>'+objrow.ITEM_NAME+' </p><p style="line-height: 2px;">( '+objrow.ITEM_CODE+')</p></td><td class="text-right">'+objrow.QTYRECD+'</td><td class="text-right">'+objrow.AQTYRECD+'</td></tr>');
                              srNo++;
                             });

                      }
                      
                  }
               }

          });
    }
</script>



@endsection



