@extends('admin.main')







@section('AdminMainContent')







@include('admin.include.header')



<meta name="csrf-token" content="{{ csrf_token() }}">




@include('admin.include.navbar')







@include('admin.include.sidebar')





<style type="text/css">

  .amountfl{

    text-align: right;

  }

  .textfl{

    text-align: left;

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



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



            Master House Cash 



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/Master/House-bank-cash/View-House-Cash-Mast')}}">Master House Cash </a></li>



            <li class="Active"><a href="{{ URL('/Master/House-bank-cash/View-House-Cash-Mast')}}">View House Cash </a></li>



          </ol>



        </section>







        <!-- Main content -->



        <section class="content">



          <div class="row">



            <div class="col-xs-12">



             







              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">View House Cash</h3>



                  <div class="box-tools pull-right">



          <a href="{{ url('/Master/House-bank-cash/House-Cash-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add House Cash</a>



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



                        <th class="text-center">Gl Code</th>
                        <th class="text-center">Gl Name</th>
                        <th class="text-center">Cash Code</th>
                        <th class="text-center">Cash Name</th>
                        <th class="text-center">Comp Code</th>
                        <th class="text-center">Comp Name</th>
                        <th class="text-center">PFCT Code</th>
                        <th class="text-center">PFCT Name</th>
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









<div class="modal fade" id="houseCashDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">







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
           
           <input type="hidden" name="houseId" id="houseId" value="">
           
           <input type="hidden" name="AssetViewLink" id="AssetViewLink" value="Master/Asset/View-Asset-Group">
           
           <input type="hidden" name="tblName" id="tblName" value="MASTER_HOUSECASH">
           <input type="hidden" name="tblName2" id="tblName2" value="">
           <input type="hidden" name="colName" id="colName" value="CASH_CODE">
           <input type="hidden" name="colNameTwo" id="colNameTwo" value="CASH_NAME">
           <input type="hidden" name="colNameThree" id="colNameThree" value="GL_CODE">
           <input type="hidden" name="colNameFour" id="colNameFour" value="GL_NAME">
           
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
                            columns: [0,1,2,3,4,5,6,7,8]
                      },
                      title: 'MASTER HOUSE CASH'+$("#headerexcelDt").val(),
                      filename: 'MASTER_HOUSE_CASH_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/Master/House-bank-cash/View-House-Cash-Mast') }}"

       },
       searching : true,
    

       columns: [
        
       
         // { data:"DT_RowIndex",className:"text-center"},
         { render: function (data, type, full, meta){
              if((full['GL_CODE']=='') || (full['GL_CODE']==null)){
                var glCd = '--';  
              }else{
                var glCd = full['GL_CODE'];
              }
              return glCd;
            }
          },
          { render: function (data, type, full, meta){
            if((full['GL_NAME']=='') || (full['GL_NAME']==null)){
                var glName = '--';  
              }else{
                var glName = full['GL_NAME'];
            }

            return glName;
          }
         },
         {  render: function (data, type, full, meta){
              if((full['CASH_CODE']=='') || (full['CASH_CODE']==null)){
                var cashCd = '--';  
              }else{
                var cashCd = full['CASH_CODE'];
              }
              return cashCd;
            }
         },
         { render: function (data, type, full, meta){
             if((full['CASH_NAME']=='') || (full['CASH_NAME']==null)){
                var cashName = '--';  
              }else{
                var cashName = full['CASH_NAME'];
              }

              return cashName;
          }
         },
         {  render: function (data, type, full, meta){

              if((full['COMP_CODE']=='') || (full['COMP_CODE']==null)){
                var compCd = '--';  
              }else{
                var compCd = full['COMP_CODE'];
              }
              return compCd;
            }
          },
          {  render: function (data, type, full, meta){
             if((full['COMP_NAME']=='') || (full['COMP_NAME']==null)){
                var compName = '--';  
              }else{
                var compName = full['COMP_NAME'];
              }
              return compName;
          }
         },
         {  render: function (data, type, full, meta){
              if((full['PFCT_CODE']=='') || (full['PFCT_CODE']==null)){
                var pfctCd = '--';  
              }else{
                var pfctCd = full['PFCT_CODE'];
              }
              return pfctCd;
            }
          },
         {render: function (data, type, full, meta){
           if((full['PFCT_NAME']=='') || (full['PFCT_NAME']==null)){
                var pfctName = '--';  
              }else{
                var pfctName = full['PFCT_NAME'];
              }

              return  pfctName;
          }
         },
         
         { render: function (data, type, full, meta){


                  if(full['CASH_CODE_BLOCK']=='NO'){
                      return '<span class="label label-success">Active</span>';
                    }else if(full['CASH_CODE_BLOCK']=='YES'){

                      return '<span class="label label-danger">Inactive</span>';
                    }else{

                      return '<span class="label label-danger">Not Found</span>';
                    }
                         

                     },className:"text-center"
          },
         {  
            render: function (data, type, full, meta){

                      var enableBtn = 'enable';
                      var deletebtn ='<input type="hidden" id="deleteinput_'+full['CASH_CODE']+'" value="'+full['CASH_CODE']+'"><a href="Edit-House-Cash/'+btoa(full['CASH_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID(\''+full['CASH_CODE']+'\','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                     

                      return deletebtn;

                     },className:"text-center"
        

       },
        
         
        
      ],

       


     });



});
</script>



<script type="text/javascript">

 function funDelData(){

 var AssetCode  = $("#houseId").val();
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


function getID(cash_code,rowId){
    
  var getval = $('#deleteinput_'+cash_code).val();

  $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea></div></div>');

  $("#houseCashDelete").modal('show');

    $("#houseId").val(getval);

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







