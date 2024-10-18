@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



@include('admin.include.sidebar')


<style type="text/css">
  
  .alignLeftClass{
    text-align: left;
  }
  .alignRightClass{
    text-align: right;
  }
  .alignCenterClass{
    text-align: center;
  }
  .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
  }
 /*.modal-header .close {
    margin-top: -32px;
 }*/

  @media screen and (max-width: 600px) {

    .viewpagein{
      width: auto;
    }
  }

</style>


<div class="content-wrapper">

<!-- Content Header (Page header) -->

<section class="content-header">

<h1>

Master General Schedule
<small>View Details</small>

</h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/Master/General-Ledger/View-Glsch') }}">Master  General Schedule</a></li>

            <li class="active"><a href="{{ url('/Master/General-Ledger/View-Glsch') }}">View General Schedule</a></li>

          </ol>

</section>



<!-- Main content -->

<section class="content">

<div class="row">

<div class="col-xs-12">





<div class="box box-primary Custom-Box">

<div class="box-header with-border" style="text-align: center;">

<h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View  General Schedule</h3>

<div class="box-tools pull-right">

<a href="{{ url('/Master/General-Ledger/Glsch-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add General Schedule</a>

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

                    <!-- <th class="text-center">Sr.No</th> -->

                    <th class="text-center">General Schedule Type</th>

                    <th class="text-center">General Schedule Code </th>

                    <th class="text-center">General Schedule Name </th>

                    <th class="text-center">Status</th>

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



  <div class="modal fade" id="glschDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-sm" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          <i class="fa fa-caret-right"></i> You Want To Delete This ...!
          <div class="row" style="margin-top: 5%;" id="delText"></div>

        </div>

        <div class="modal-footer">

       <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>

          <form action="#" method="post">

          @csrf

            <input type="hidden" name="id" value="" id="glschid">

             <input type="hidden" name="AssetViewLink" id="AssetViewLink" value="Master/Asset/View-Asset-Group">

            <input type="hidden" name="tblName" id="tblName" value="MASTER_GLSCH">
            <input type="hidden" name="tblName2" id="tblName2" value="">
            <input type="hidden" name="colName" id="colName" value="GLSCH_CODE">
            <input type="hidden" name="colNameTwo" id="colNameTwo" value="GLSCH_NAME">
            <input type="hidden" name="colNameThree" id="colNameThree" value="GLSCH_SEQNO">
            <input type="hidden" name="colNameFour" id="colNameFour" value="GLSCH_TYPE">

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
                            columns: [0,1,2,3]
                      },
                      title: 'MASTER GENERAL LEDGER SCHEDULE'+$("#headerexcelDt").val(),
                      filename: 'MASTER_GENERAL_LEDGER_SCHEDULE_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/Master/General-Ledger/View-Glsch') }}"

       },
       searching : true,
    

       columns: [
        
       
         // { data:"DT_RowIndex",className:"text-center"},
         { data: "GLSCH_TYPE" },
         { data: "GLSCH_CODE" },
         { data: "GLSCH_NAME" },
         { render: function (data, type, full, meta){


                  if(full['GLSCH_BLOCK']=='NO'){
                      return '<span class="label label-success">Active</span>';
                    }else if(full['GLSCH_BLOCK']=='YES'){

                      return '<span class="label label-danger">Inactive</span>';
                    }else{

                      return '<span class="label label-danger">Not Found</span>';
                    }
                         

                     },className:"text-center"
          },
         {  
            render: function (data, type, full, meta){

                      var enableBtn = 'enable';
                      var deletebtn ='<input type="hidden" id="deleteinput_'+full['GLSCH_CODE']+'" value="'+full['GLSCH_CODE']+'"><a href="Edit-Glsch/'+btoa(full['GLSCH_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return deleteGLSCH(\''+full['GLSCH_CODE']+'\','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                     

                      return deletebtn;

                     },className:"text-center"
        

       },
        
         
        
      ],

       


     });



});
</script>

<script type="text/javascript">

function funDelData(){

 var AssetCode  = $("#glschid").val();
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

  function deleteGLSCH(glschcode,rowId){
      //console.log(id);
     var getval = $('#deleteinput_'+glschcode).val();

     $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea></div></div>');

     $('#glschDelete').modal('show');
     $('#glschid').val(getval);

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

