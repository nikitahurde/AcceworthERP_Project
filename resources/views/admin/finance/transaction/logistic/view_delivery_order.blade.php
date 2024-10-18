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
           Delivery Order
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>Delivery Order Details</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">Delivery Order</a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Delivery Order</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Delivery Order</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/Logistic/Delivery-Order') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Delivery Order</a>

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

                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">Vr Date.</th>

                        <th class="text-center">Vr No.</th>

                        <th class="text-center">Rake No</th>

                        <th class="text-center">Acc Name</th>

                        <th class="text-center">Series Name</th>

                        <th class="text-center">Plant Name</th>

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


<div class="modal fade" id="deliveryOrderDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-header">



        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>



        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>



      <div class="modal-body">
        <i class="fa fa-caret-right"></i> &nbsp;You Want To Delete This Data...!
        <div class="row" style="margin-top: 5%;" id="delText"></div>
      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>



          <form action="#" method="POST">

            @csrf

             <!-- Table Head Id/Body Id -->
            <input type="hidden" name="dorderHid" id="headId" value="">
            <input type="hidden" name="dorderBid" id="bodyId" value="">

            <!-- Table Name -->
            <input type="hidden" name="firstTable" id="firstTable" value="DORDER_BODY">
            <input type="hidden" name="secondTable" id="secondTable" value="TRIP_BODY">
            <input type="hidden" name="thirdTable" id="thirdTable" value="CFOUTWARD_TRAN">
            <input type="hidden" name="forthTable" id="forthTable" value="DORDER_HEAD">

            <!-- Table Fields Name -->
            <input type="hidden" name="colNameOne" id="colNameOne" value="DORDERHID">
            <input type="hidden" name="colNameTwo" id="colNameTwo" value="DORDERBID">
            <input type="hidden" name="colNameThree" id="colNameThree" value="DORDER_NO">
            <input type="hidden" name="colNameFour" id="colNameFour" value="DORDER_DATE">
            <input type="hidden" name="colNameFour" id="colNameFive" value="DO_NO">
            <input type="hidden" name="colNameSix" id="colNameSix" value="ORDER_NO">

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
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.DORDERHID+'" style="padding-left:50px;">'+
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

        url : "{{ url('/Transaction/Logistic/View-Delivery-Order') }}"

       },
       searching : true,
    

       columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.VRNO+','+full.DORDERHID+')"><i class="fa fa-plus" id="minus'+full.VRNO+''+full.DORDERHID+'" title="Edit"></i></button>'
          }
         },
          { data:"DT_RowIndex",className:"text-center"},
           
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

          { render: function (data, type, full, meta){

                   
                   var fy_code = full['FY_CODE'].split('-');
                      

                      var VRNO = fy_code[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];
                    

                      return VRNO;


                         

          }

          },
        {  
            render: function (data, type, full, meta){

                   
                      var rake_no = full['RAKE_NO'];
                    

                      return rake_no;


                         

                     }
        

       },
         {  
            render: function (data, type, full, meta){

                   
                      var series = full['ACC_NAME']+' - ('+full['ACC_CODE']+')';
                    

                      return series;


                         

                     }
        

       },
         {  
            render: function (data, type, full, meta){

                   
                      var series = full['SERIES_NAME']+' - ('+full['SERIES_CODE']+')'; 
                  
                      return series;


                         

                     }
        

       },
         {  
            render: function (data, type, full, meta){

                   
                      var series = full['PLANT_NAME']+' - ('+full['PLANT_CODE']+')';
                    

                      return series;
        }
        
       },
         {  
            render: function (data, type, full, meta){

                   
              var enableBtn = 'enable';
              var getBodyId = '1001';
              var deletebtn ='<a href="edit-dealer/'+btoa(full['DORDERHID'])+'/'+btoa(enableBtn)+'" class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return deleteDO('+full['DORDERHID']+','+getBodyId+');"><i class="fa fa-trash" title="Delete"></i></button>';
            

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


  function deleteDO(hid,bId)
  {
    $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+hid+'" rows="2" oninput="deleteRemark()"></textarea></div></div>');

    $("#deliveryOrderDelete").modal('show');


    $("#headId").val(hid);
    $("#bodyId").val(bId);

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

function funDelData(){

 var headId       = $("#headId").val();
 var bodyId       = $("#bodyId").val();
 var del_remark   = $("#del_remark").val();
 var firstTable   = $("#firstTable").val();
 var secondTable  = $("#secondTable").val();
 var thirdTable   = $("#thirdTable").val();
 var forthTable   = $("#forthTable").val();
 var colNameOne   = $("#colNameOne").val();
 var colNameTwo   = $("#colNameTwo").val();
 var colNameThree = $("#colNameThree").val();
 var colNameFour  = $("#colNameFour").val();
 var colNameFive  = $("#colNameFive").val();
 var colNameSix   = $("#colNameSix").val();
 

  $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

  });

  $.ajax({

    url:"{{ url('/transparent/delete-data-common') }}",
    
    method : "POST",
    
    type: "JSON",
    
    data: {headId: headId,bodyId:bodyId,del_remark:del_remark,firstTable:firstTable,secondTable:secondTable,thirdTable:thirdTable,forthTable:forthTable,colNameOne:colNameOne,colNameTwo:colNameTwo,colNameThree:colNameThree,colNameFour:colNameFour,colNameFive:colNameFive,colNameSix:colNameSix},
    
    success:function(data){

     var data1 = JSON.parse(data);
     
     if(data1.response =='success'){
          var responseVar = true;
          var pageURL = 'Transaction~Logistic~View-Delivery-Order';
          var pageMsg = 'Data~was~successfully~Deleted';
          var url = "{{url('/transaction/delete-data')}}";
          setTimeout(function(){ window.location = url+'/'+responseVar+'/'+pageURL+'/'+pageMsg; });
     }else{
          var responseVar = false;
          var pageURL = 'Transaction~Logistic~View-Delivery-Order';
          
          var pageMsg = 'Delivery~Order~Number~Found~In~Other~Transaction';
          var url = "{{url('/transaction/delete-data')}}";
          setTimeout(function(){ window.location = url+'/'+responseVar+'/'+pageURL+'/'+pageMsg; });
     }

    }
  
});

}

   function showchildtable(vrno,tblid){
            var vrno,tblid;

           

             $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });
             
             $("#minus"+vrno+''+tblid).toggleClass('fa-plus fa-minus rotate');

             $.ajax({

              url:"{{ url('view-delivery-order-chield-row-data') }}",

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
                         var tableid = objrow[0].DORDERHID;
                       $.each(objrow, function (row, objrow) {

                        
                               $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td class="text-center">'+objrow.DORDER_NO+'</td><td class="text-center">'+objrow.DORDER_DATE+'</td><td class="text-center">'+objrow.CP_NAME+' - '+objrow.CP_CODE+'</td><td class="text-center">'+objrow.FROM_PLACE+'</td><td class="text-center">'+objrow.TO_PLACE+'</td><td><p>'+objrow.ITEM_NAME+' </p><p style="line-height: 2px;">( '+objrow.ITEM_CODE+')</p></td><td class="text-right">'+objrow.BATCH_NO+'</td><td class="text-right">'+objrow.QTY+'</td></tr>');
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



