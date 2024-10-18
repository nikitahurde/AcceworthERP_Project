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
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
          Freight Purchase Bill
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b> Freight Purchase Bill Details</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">Freight Purchase Bill</a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Freight Purchase Bill</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Freight Purchase Bill</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/logistic/transaction/transporter-bill-posting') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Freight Purchase Bill</a>

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

                          <th class="text-center dtvrDate">#</th>
                          <th class="text-center dtvrDate">Jr Date</th>
                          <th class="text-center dtVrno">Vr No</th>
                          <th class="text-center dtglName">Gl Name</th>
                          <th class="text-center hideCol">Gl Code</th>
                          <th class="text-center dtaccName">Account Name</th>
                          <th class="text-center hideCol">Account Code</th>
                          <th class="text-center dtRemark">Remark</th>
                          <th class="text-center dtDrcrAmt">Vehicle No</th>
                          <th class="text-center dtDrcrAmt">Do No</th>
                          <th class="text-center dtAction">Action</th>
                          <th class="text-center dtAction">Pdf</th>

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



      You Want To Delete This Delivery Order...!



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





@include('admin.include.footer')

<script type="text/javascript">

   function format ( d ) {
  //  console.log('d',d.id);
    // `d` is the original data object for the row
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.TRIPHID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th>Sr. No.</th>'+
            '<th>Delivery No</th>'+
            '<th>Delivery Date</th>'+
            '<th>Consinee</th>'+
            '<th>From Place</th>'+
            '<th>To Place</th>'+
            '<th>Item Name/Item Code</th>'+
            '<th>Batach No</th>'+
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

        url : "{{ url('/logistic/transaction/view-transporter-bill-posting') }}"

       },
       searching : true,
    

       columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.VRNO+','+full.TRIPHID+')"><i class="fa fa-plus" id="minus'+full.VRNO+''+full.TRIPHID+'" title="Edit"></i></button>'
          }
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
                  data :'VRNO',
                  render: function (data, type, full, meta){
                         
                    var fy_code = full['FY_CODE'].split('-');

                    var VRNO = fy_code[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];
                          
                    return VRNO;
                               
                  },
                  className:'dtVrno'
                },
                {   
                    data :'TRANSPORT_CODE',
                    render: function (data, type, full, meta){

                      if(full['TRANSPORT_CODE'] == null){
                        var glCode = '--';
                      }else{
                        var glCode = full['TRANSPORT_CODE'];
                      }
                      
                      if(full['TRANSPORT_NAME'] == null){
                        var gName = '--';
                        return '-- ( -- )';
                      }else{
                        var glName = full['TRANSPORT_NAME'];
                        var gName = 'display' && glName.length > 15 ? glName.substr(0, 15) + '…' : glName;
                        return '<span data-tip="'+glName+'">'+ gName+' ( '+glCode+' )</span> ';
                      }    
                  },
                  className:'dtglName'
                },
                {
                    data:'TRANSPORT_CODE',
                    name:'TRANSPORT_CODE',
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
                        var accName ='display' && ac_Name.length > 15 ? ac_Name.substr(0, 15) + '…' : ac_Name;
                        return '<span data-tip="'+ac_Name+'">'+ accName+' ( '+accCode+' )</span> ';
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
                    render: function (data, type, full, meta){

                      if((full['REMARK'] == null)){

                        var ref = ' -- ';
                        return ref;

                      }else{

                        var ref = full['REMARK'];
                        var perticular ='display' && ref.length > 15 ? ref.substr(0, 15) + '…' : ref;
                         return '<span data-tip="'+ref+'">'+ perticular+'</span> ';

                      }

                  },
                  className:'dtRemark'
                },
                {
                    data:'VEHICLE_NO',
                    name:'VEHICLE_NO',
                    className:'dtDrcrAmt'
                },
                {
                    data:'DO_NO',
                    name:'DO_NO',
                    className:'dtDrcrAmt'
                },
                {
                    render: function (data, type, full, meta){

                      var deletebtn ='<a href="Edit-Journal-Trans/'+btoa(full['COMP_CODE'])+'/'+btoa(full['FY_CODE'])+'/'+btoa(full['TRAN_CODE'])+'/'+btoa(full['SERIES_CODE'])+'/'+btoa(full['VRNO'])+'" class="btn btn-warning btn-xs" title="edit" style="font-size: 10px;padding: 0px 2px;"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" style="font-size: 10px;padding: 0px 2px;" data-toggle="modal" onclick="return deleteJournal(\''+full['COMP_CODE']+'\',\''+full['FY_CODE']+'\',\''+full['TRAN_CODE']+'\',\''+full['SERIES_CODE']+'\',\''+full['VRNO']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';
                      return deletebtn;

                    }
                 },
              {
                render:function(data, type, full, meta){

                  return '<button class="btn btn-success pdfbtndn btn-xs" type="button" style="font-size: 10px;padding: 0px 2px;" id="pdfDown" onclick="downloadPDF('+full['DT_RowIndex']+','+full['TRIPHID']+','+full['VRNO']+',\''+full['TRAN_CODE']+'\',\''+full['COMP_CODE']+'\',\''+full['ACC_CODE']+'\');"><i class="fa fa-download" aria-hidden="true"></i></button>';
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

              url:"{{ url('view-bill-posting-chield-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {vrno: vrno,tblid:tblid},

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
                         var tableid = objrow[0].TRIPHID;
                       $.each(objrow, function (row, objrow) {

                        
                              
                               $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td class="text-center">'+objrow.TRIP_NO+'</td><td class="text-center">'+objrow.DO_NO+'</td><td class="text-center">'+objrow.LR_NO+'</td><td class="text-center">'+objrow.LR_DATE+'</td><td class="text-center">'+objrow.ITEM_CODE+'</td><td><p>'+objrow.ITEM_NAME+' </p><p style="line-height: 2px;">( '+objrow.ITEM_CODE+')</p></td><td class="text-right">'+objrow.REMARK+'</td><td class="text-right">'+objrow.QTY+'</td></tr>');
                              srNo++;

                             });

                      }
                      
                  }
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


@endsection



