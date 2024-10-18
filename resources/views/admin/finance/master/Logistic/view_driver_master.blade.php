@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



@include('admin.include.sidebar')





<style type="text/css">

  .boxer {
    display: table;
    border-collapse: collapse;
  }
  .boxer .box-row {
    display: table-row;
  }
  .boxer .box-row:first-child {
    font-weight:bold;
  }
  .chieldtblecls tr td{
    border: 1px solid #ccc4c4 !important;
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
  }
  .columnhide{
  display:none;}

  .chieldtblecls>tbody>tr>td {
    line-height: 2.5;
  }

  .tabTable > table > tbody > tr > th{
    border:1px solid grey !important;
    background-color: #b6d2f0;
    padding:5px;
  }
  .tabTable > table > tbody > tr > td{
    border:1px solid grey !important;
    padding:5px;
  }
  .tabtask{
   padding: 6px !important; 
   font-weight:700;
  }

  .modal-header .close {
    margin-top: -32px;
  }

  .alignLeftClass{



    text-align: left;



  }

  .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
  }

  .alignRightClass{



    text-align: right;



  }



  .alignCenterClass{



    text-align: center;



  }
  
   


  .tabs {
     display: flex;
     flex-wrap: wrap;
     /*max-width: 700px;*/
     background: #efefef;
     box-shadow: 0 48px 80px -32px rgba(0, 0, 0, 0.25);
}

.input {
     position: absolute;
     opacity: 0;
}

.label {
     width: 100%;
    padding: 9px 30px;
    background: #e5e5e5;
    cursor: pointer;
    font-weight: bold;
    font-size: 14px;
    color: #7f7f7f;
    transition: background 0.1s, color 0.1s;
}

.label:hover {
     background: #d8d8d8;
}

.label:active {
     background: #ccc;

}

.input:focus + .label {
     z-index: 1;
}

.input:checked + .label {
     background: #52a0ce;
     color: #000;
}
.actionBTN{
    font-size: 10px;
    padding: 0px 2px;
}

.panel {
     display: none;
     padding: 20px 30px 30px;
     background: #fff;
     width: 100%;
}

@media (min-width: 600px) {
     .label {
          width: auto;
     }

     .panel {
          order: 99;
     }
}

.input:checked + .label + .panel {
     display: block;

}



</style>













  <div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



            Master Driver 



            <small> : View Details</small>



          </h1>


          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/master/logistic/view-driver-master') }}">Logistics</a></li>

            <li class="active"><a href="{{ url('/master/logistic/view-driver-master') }}">View Driver Master</a></li>

          </ol>


        </section>


        <!-- Main content -->

        <section class="content">



          <div class="row">



            <div class="col-xs-12">



              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">View Drivers List</h3>



                  <div class="box-tools pull-right">



                    <a href="{{ url('/master/logistic/driver-master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Driver</a>



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

                        <th class="text-center">Vehicle No.</th>
                        <th class="text-center">Driver Code</th>
                        <th class="text-center">Driver Name</th>
                        <th class="text-center">Driver Mobile No.</th>
                        <th class="text-center">License No.</th>
                        <th class="text-center">License Exp. Date</th>
                        <th class="text-center">From Date</th>
                        <th class="text-center">To Date</th>
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



<div class="modal fade" id="costCatDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



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


            <input type="hidden" name="itemdelete" id="ItemID" value="">

            <input type="hidden" name="AssetViewLink" id="AssetViewLink" value="Master/Asset/View-Asset-Group">

            <input type="hidden" name="tblName" id="tblName" value="MASTER_DRIVER">
            <input type="hidden" name="tblName2" id="tblName2" value="">
            <input type="hidden" name="colName" id="colName" value="VEHICLE_NO">
            <input type="hidden" name="colNameTwo" id="colNameTwo" value="EMP_CODE">
            <input type="hidden" name="colNameThree" id="colNameThree" value="EMP_NAME">
            <input type="hidden" name="colNameFour" id="colNameFour" value="MOBILE_NO">

            <input type="hidden" name="colNameFive" id="colNameFive" value="">

            <input type="hidden" name="colNameSix" id="colNameSix" value="">

            <input type="button" value="Delete" id="del_data" style="margin-top: -12%;" class="btn btn-sm btn-danger" disabled="" onclick="funDelData()">



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
                      title: 'MASTER DRIVER LIST'+$("#headerexcelDt").val(),
                      filename: 'MASTER_DRIVER_LIST_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/master/logistic/view-driver-master') }}"

       },
       searching : true,
    

       columns: [
        
         { data:"VEHICLE_NO",className:'text-left'},
         { data:"EMP_CODE",className:'text-left'},
         { data:"EMP_NAME",className:'text-left'},
         // { 
         //  render: function (data, type, full, meta){

         //    var EMPCODE = full['EMP_CODE'];
         //    var EMPNAME = full['EMP_NAME'];
          
         //    return  EMPCODE+' - '+EMPNAME;

         //   },
         //   className:"text-left"
         // },
         { data:"MOBILE_NO",className:"text-right"},
         { data:"LICENSE_NO",className:"text-left"},
         { data:"LICENSE_EXPDT",className:"text-right"},
         { data:"FROM_DATE",className:"text-right"},
         { data:"TO_DATE",className:"text-right"},
         {  
            render: function (data, type, full, meta){
                    
                      if(full['BLOCK_DRIVER']=='YES'){

                       var enableBtn = 'enable';
                       var deletebtn ='<input type="hidden" id="deleteinput_'+full['DT_RowIndex']+'" value="'+full['EMP_CODE']+'"><a href="edit-driver-mast/'+btoa(full['EMP_CODE'])+'/'+btoa(full['VEHICLE_NO'])+'" class="btn btn-warning btn-xs actionBTN" title="Edit Driver Data"><i class="fa fa-pencil" title="Edit Driver Data"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getId(\''+full['VEHICLE_NO']+'\',\''+full['EMP_CODE']+'\','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal">INACTIVE</button>';
                     
                       return deletebtn;                                 

                      }else{

                       var enableBtn = 'enable';
                       var deletebtn ='<input type="hidden" id="deleteinput_'+full['DT_RowIndex']+'" value="'+full['EMP_CODE']+'"><a href="edit-driver-mast/'+btoa(full['EMP_CODE'])+'/'+btoa(full['VEHICLE_NO'])+'" class="btn btn-warning btn-xs actionBTN" title="Edit Driver Data"><i class="fa fa-pencil" title="Edit Driver Data"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getId(\''+full['VEHICLE_NO']+'\',\''+full['EMP_CODE']+'\','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button> | <button class="btn btn-success btn-xs actionBTN" data-toggle="modal">ACTIVE</button>';
                     
                       return deletebtn;

                      }

                      

                     },className:"text-center"
        

         },
         
      ],

       


     });


});

  function getId(vehicleno,emp_code,rowId)
  {
     // console.log('Id',tblId);
    var getval = $('#deleteinput_'+rowId).val();
    // console.log('tblId',tblId);
    // console.log('getval',getval);
    // console.log('deleteinput_', 'deleteinput_'+tblId);
    
    $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea></div></div>')

    $("#costCatDelete").modal('show');
    $("#ItemID").val(vehicleno);
   // console.log('vehicleno',vehicleno);

  }

  function deleteRemark(){
    
    var remark = $('#del_remark').val();

    if(remark.length > 10){
       $('#del_data').attr('disabled',false);
    }else{
      $('#del_data').attr('disabled',true);
    }
  }

  function funDelData(){

 var AssetCode  = $("#ItemID").val();
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

</script>





@endsection















