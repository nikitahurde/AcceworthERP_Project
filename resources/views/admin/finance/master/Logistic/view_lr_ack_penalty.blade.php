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
  .modal-body {
    position: relative;
    padding: 9px;
}
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
           Master LR Ack Penalty
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small>View Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/logistic-transportation/master/view-lr-acknowledgement-penalty') }}">Master LR Ack Penalty</a></li>

            <li class="active"><a href="{{ url('/logistic-transportation/master/view-lr-acknowledgement-penalty') }}">View LR Ack Penalty</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View LR Ack Penalty</h3>

                  <div class="box-tools pull-right">

                   <a href="{{ url('/logistic-transportation/master/lr-acknowledgement-penalty') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add LR Ack Penalty</a>

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

                        <!-- <th class="text-center">#</th> -->
                        <th class="text-center">Penalty Code </th>

                        <th class="text-center">Head</th>

                        <th class="text-center">Index Code</th>

                        <th class="text-center">Index Name</th>

                        <th class="text-center">Rate</th>

                        <th class="text-center">Amount</th>

                        <th class="text-center">GL Code</th>

                        <th class="text-center">GL Name</th>

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







 <div class="modal fade" id="lrAckDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-header">





        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>





        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>



      <div class="modal-body">

        <i class="fa fa-caret-right"></i> You Want To Delete Data...!
        <div class="row" style="margin-top: 5%;" id="delText">

      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>



          <form action="{{ url('/logistic-transportation/master/delete-lr-acknowledgement-penalty') }}" method="post">



            @csrf



            <input type="hidden" name="lrAckId" id="lrAckId" value="">

            <input type="hidden" name="AssetViewLink" id="AssetViewLink" value="Master/Asset/View-Asset-Group">

            <input type="hidden" name="tblName" id="tblName" value="MASTER_LRACK_PENALTY">
            <input type="hidden" name="tblName2" id="tblName2" value="">
            <input type="hidden" name="colName" id="colName" value="ID">
            <input type="hidden" name="colNameTwo" id="colNameTwo" value="PENALTY_CODE">
            <input type="hidden" name="colNameThree" id="colNameThree" value="HEAD">
            <input type="hidden" name="colNameFour" id="colNameFour" value="HEAD">

            <input type="hidden" name="colNameFive" id="colNameFive" value="INDEX_NAME">

            <input type="hidden" name="colNameSix" id="colNameSix" value="">

            <input type="button" value="Delete" id="del_data" style="margin-top: -12%;" class="btn btn-sm btn-danger" disabled="" onclick="funDelData()">


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
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.FREIGHTROUTEID +'" style="padding-left:50px;">'+
         '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th class="removeextraSInC">Sr. No.</th>'+
            '<th class="removeextraSInC">From Place</th>'+
            '<th class="removeextraSInC">To Place</th>'+
            '<th class="removeextraSInC">KM</th>'+
             '<th class="removeextraSInC">Toll</th>'+
            '<th class="hidecolumn class="removeextraSInC"">Extra Km</th>'+
            '<th class="hidecolumn class="removeextraSInC"">Less Km</th>'+
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
       //scrollY:500,
       scrollX:true,
       paging: true,
       dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
        buttons:  [
                    {
                      extend: 'excelHtml5',
                      exportOptions: {
                            columns: [0,1,2,3,4,5,6,7]
                      },
                      title: 'MASTER LR ACK PENALTY'+$("#headerexcelDt").val(),
                      filename: 'MASTER_LR_ACK_PENALTY_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/logistic-transportation/master/view-lr-acknowledgement-penalty') }}"

       },
       searching : true,
    

       columns: [
        
        { data:"PENALTY_CODE"},
        { data:"HEAD"},
        { data:"INDEX_CODE"},
        { data:"INDEX_NAME"},
        // { render: function (data, type, full, meta){


        //         var indexcode = full['INDEX_CODE'];
        //         var indexname = full['INDEX_NAME'];

        //         var indexCodeName = indexname + ' ['+ indexcode + ' ]';
        //         return indexCodeName;


        //     },className:"text-left"
        //   },
        { data:"RATE",className:"text-right"},
        { data:"AMOUNT",className:"text-right"},
        { data:"GL_CODE"},
        { data:"GL_NAME"},
        // { render: function (data, type, full, meta){


        //         var glcode = full['GL_CODE'];
        //         var glname = full['GL_NAME'];

        //         var glCodeName = glname + ' ['+ glcode + ' ]';
        //         return glCodeName;


        //     },className:"text-left"
        //   },
         
         {  
            render: function (data, type, full, meta){

                  

                     if(full['FLAG']==1){
                      return '<a href="/logistic-transportation/master/edit-lr-acknowledgement-penalty/'+btoa(full['PENALTY_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil actionBTN" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                    }else{

                      return '<a href="edit-lr-acknowledgement-penalty/'+btoa(full['PENALTY_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID('+full['ID']+','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                    }
                         

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


   function showchildtable(tblid){
            var tblid;

           

             $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });

             $("#minus"+tblid).toggleClass('fa-plus fa-minus rotate');

             $.ajax({

              url:"{{ url('view-mast-freight-rate-Chield-Row-Data') }}",

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
                         var tableid = objrow[0].FREIGHTRATEID;
                         var totalRow = objrow.length;
                        //console.log('totalRow',totalRow);
                       $.each(objrow, function (i, objrow) {

                        if(objrow.KM==null){
                          var km = 0;
                        }else{
                          var km = objrow.KM;
                        }

                        if(objrow.TOLL==null){
                          var toll = 0;
                        }else{
                          var toll = objrow.TOLL;
                        }

                        if(objrow.EXTRA_KM==null){
                          var extra_km = 0;
                        }else{
                          var extra_km = objrow.EXTRA_KM;
                        }

                        if(objrow.LESS_KM==null){
                          var less_km = 0;
                        }else{
                          var less_km = objrow.LESS_KM;
                        }
                       
                      $('#childData_'+tableid).append('<tr><td class="text-center hidecolumn">'+srNo+'</td><td class="hidecolumn">'+objrow.VEHICLE_TYPE+' <p> ('+objrow.FROM_PLACE+')</p></td><td class="hidecolumn">'+objrow.TO_PLACE+'</td><td class="text-right hidecolumn">'+km+'</td><td class="text-right hidecolumn">'+toll+'</td><td class="text-right hidecolumn">'+extra_km+'</td><td class="text-right hidecolumn">'+less_km+'</td></tr>');
                        srNo++;
                    });



                      }
                      
                  }
               }

          });
    }
</script>

<script type="text/javascript">

function funDelData(){

 var AssetCode  = $("#lrAckId").val();
 var del_remark = $("#del_remark").val();
 var tblName    = $("#tblName").val();
 var tblName2   = $("#tblName2").val();
 var colName1   = $("#colName").val();
 var colName2   = $("#colNameTwo").val();
 var colName3   = $("#colNameThree").val();
 var colName4   = $("#colNameFour").val();
 var colName5   = $("#colNameFive").val();
 var colName6   = $("#colNameSix").val();

 var AssetViewLink = $("#AssetViewLink").val();
 
 $.ajaxSetup({

        headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

  });

  $.ajax({

    url:"{{ url('/Master/Asset/Delete-Data') }}",
    
    method : "POST",
    
    type: "JSON",
    
    data: {AssetCode: AssetCode,del_remark:del_remark,tblName:tblName,tblName2:tblName2,colName1:colName1,colName2:colName2,colName3:colName3,colName4:colName4,colName5:colName5,colName6:colName6,AssetViewLink:AssetViewLink},
    
    success:function(data){

     var data1 = JSON.parse(data);
     
     if(data1.response =='success'){

       // $('#costTypeDelete').modal('hide');
       // $('#del_remark').val('');
       location.reload();
     }else{

     }

    }
  
});

}

 function getID(id,rowId) {

    //alert(id);return false;


    $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea></div></div>');

    $("#lrAckDelete").modal('show');

    $("#lrAckId").val(id);
  }

  function deleteRemark(){
    
    var remark = $('#del_remark').val();

    if(remark.length > 10){
       $('#del_data').attr('disabled',false);
    }else{
      $('#del_data').attr('disabled',true);
    }

    // console.log('remark',remark);
  }
  
</script>


@endsection



