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

 .modal-header .close {
    margin-top: -32px;
  }
  
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



Master Account Category



<small>View Details</small>



</h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Master</a></li>



            <li class="active"><a href="{{ url('/fMaster/Customer-Vendor/View-Acc-Category-Mast') }}">Master Account Category</a></li>



            <li class="active"><a href="{{ url('/Master/Customer-Vendor/View-Acc-Category-Mast') }}">View Account Category</a></li>



          </ol>



</section>







<!-- Main content -->



<section class="content">



<div class="row">



<div class="col-xs-12">











<div class="box box-primary Custom-Box">



<div class="box-header with-border" style="text-align: center;">



<h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Account Category</h3>



<div class="box-tools pull-right">



<a href="{{ url('/Master/Customer-Vendor/Acc-Category-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Account Category</a>



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



      <th class="text-center">Account Category Code</th>



      <th class="text-center">Account Category Name</th>



      <th class="text-center">Account Category Block</th>



      <th class="text-center">Action</th>



    </tr>



  </thead>



</table>



</div><!-- /.box-body -->



</div><!-- /.box -->



</div><!-- /.col -->



</div><!-- /.row -->



</section><!-- /.content -->



</div>







  <div class="modal fade" id="categoryDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



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



      <form action="#" method="post">
       @csrf
        <input type="hidden" name="acccatid" value="" id="categoryid">

        <input type="hidden" name="AssetViewLink" id="AssetViewLink" value="Master/Customer-Vendor/View-Acc-Category-Mast">

        <input type="hidden" name="tblName" id="tblName" value="MASTER_ACATG">
        <input type="hidden" name="tblName2" id="tblName2" value="">
        <input type="hidden" name="colName" id="colName" value="ACATG_CODE">
        <input type="hidden" name="colNameTwo" id="colNameTwo" value="ACATG_NAME">
        <input type="hidden" name="colNameThree" id="colNameThree" value="">
        <input type="hidden" name="colNameFour" id="colNameFour" value="">

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
                                columns: [0,1,2]
                          },
                      title: 'MASTER ACCOUNT CATEGORY '+$("#headerexcelDt").val(),
                      filename: 'MASTER_ACCOUNT_CATEGORY_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/Master/Customer-Vendor/View-Acc-Category-Mast') }}"

       },
       searching : true,
    

       columns: [
        
       
         // { data:"DT_RowIndex",className:"text-center"},
         { data: "ACATG_CODE" },
         { data: "ACATG_NAME" },
        
         { render: function (data, type, full, meta){


                  if(full['ACATG_BLOCK']=='NO'){
                      return '<span class="label label-success">Active</span>';
                    }else if(full['ACATG_BLOCK']=='YES'){

                      return '<span class="label label-danger">Inactive</span>';
                    }else{

                      return '<span class="label label-danger">Not Found</span>';
                    }
                         

                     },className:"text-center"
          },
         {  
            render: function (data, type, full, meta){
                     
                      var enableBtn = 'enable';
                      var deletebtn ='<input type="hidden" id="deleteinput_'+full['ACATG_CODE']+'" value="'+full['ACATG_CODE']+'"><a href="Edit-Acc-Category/'+btoa(full['ACATG_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID(\''+full['ACATG_CODE']+'\','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                     

                      return deletebtn;

                     },className:"text-center"
        

       },
        
         
        
      ],

       


     });



});
</script>





<script type="text/javascript">

function funDelData(){

 var AssetCode  = $("#categoryid").val();
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

  function getID(accCate,rowId){

    var getval = $('#deleteinput_'+accCate).val();

    $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea></div></div>');

    $("#categoryDelete").modal('show');

    $('#categoryid').val(getval);
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


