@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



@include('admin.include.sidebar')


<style>
  .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
}
</style>


  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master User 

            <small>View Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/view-mast-user') }}">Master User</a></li>

            <li class="active"><a href="{{ url('/view-mast-user') }}">View User</a></li>

          </ol>

        </section>

        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">

              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">View User</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/Master/Setting/User-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add User</a>

          </div>

                </div><!-- /.box-header -->

                 @if(Session::has('alert-success'))



              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;margin-top: 1%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>

                  <i class="icon fa fa-check"></i>

                  Success...!

                </h4>

                 {!! session('alert-success') !!}

              </div>


            @endif



            @if(Session::has('alert-error'))



              <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;margin-top: 1%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>

                  <i class="icon fa fa-ban"></i>

                  Error...!

                </h4>

                {!! session('alert-error') !!}

              </div>



            @endif



            

                <div class="box-body">
                  <input type="hidden" value="{{Session::get('username')}}" id="logUser">
                  <table id="example" class="table table-bordered table-striped table-hover">

                    <thead>

                      <tr>

                        <!-- <th class="text-center">Sr.NO</th> -->

                        <th class="text-center">User Id</th>

                       <!--  <th class="text-center">Usercode</th> -->

                        <th class="text-center">Email-Id</th>

                        <th class="text-center">User type</th>

                        <th class="text-center">User Image</th>

                        <th class="text-center">Status</th>

                        <th class="text-center">Action</th>

                      </tr>

                    </thead>

                    <tbody>
                    <?php  
                    $i=0;
                    foreach ($data as $index => $value) {
                      $imgData = $value->IMAGE;
                    ?>
                      <tr>
                        
                        <!-- <td style="text-align:center;"><?php $i++;?>{{$i}}</td> -->
                        
                        <td>{{$value->USER_NAME}} [ {{$value->USER_CODE}}]</td>

                        <td>{{$value->EMAIL_ID }}</td>

                        <td>{{$value->USER_TYPE}}</td>

                       

                        <td class="text-center"> <?php if($imgData){ echo '<img src="data:image/jpeg;base64,'.base64_encode($value->IMAGE). '" style="height:70px;width:60px"/>';}  ?></td>

                        <td  class="text-center">

                          <?php if( $value->FLAG == 0 ) { ?>

                            <span class="label label-success">Active</span>

                          <?php  } else if( $value->FLAG == 1 ) { ?>

                            <span class="label label-danger">Inactive</span>

                          <?php  } else { ?>

                          <span class="label label-danger">Not Found</span>

                          <?php } ?>

                        </td>

                        <td  class="text-center">

                          <?php

                          $usercode = $value->USER_CODE; 
                           
                           if($value->USER_NAME == 'logUser'){
                            $notDelete = 'disabled';
                           }else{
                            $notDelete ='';
                           }

                          if($value->ACCESS_FLAG == 1){ ?>

                             <a href="Edit-User-Mast/<?php echo base64_encode($usercode); ?>" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" disabled <?php  echo  $notDelete; ?> ><i class="fa fa-trash" title="Delete"></i></button>

                          <?php  } else { ?>
                            
                             <a href="Edit-User-Mast/<?php echo base64_encode($usercode); ?>" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getId('<?php echo $value->USER_CODE;?>');" <?php  echo  $notDelete; ?> ><i class="fa fa-trash" title="Delete"></i></button>


                          <?php }?>
                          
                        </td>
                      </tr>

     
                       
                  
                   <?php  
                   } ?>

                     
                    </tbody>
                    
                     <tfoot>

                      <tr>

                       <!--  <th>Rendering engine</th>

                        <th>Browser</th>

                        <th>Platform(s)</th>

                        <th>Engine version</th>

                        <th>CSS grade</th> -->


                      </tr>

                    </tfoot> 

                  </table> <div class="text-right">
                    {{ $data->links() }}
                  </div>

                </div><!-- /.box-body -->

              </div><!-- /.box -->

            </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->

      </div>





<div class="modal fade" id="userDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-header">





        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>





        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>



      <div class="modal-body">

        <i class="fa fa-caret-right"></i> &nbsp;You Want To Delete This User Data...!
        <div class="row" style="margin-top: 5%;" id="delText">


      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>



          <form action="#" method="post">



            @csrf



            <input type="hidden" name="UserID" id="UserID" value="">



             <input type="hidden" name="AssetViewLink" id="AssetViewLink" value="Master/Asset/View-Asset-Group">

            <input type="hidden" name="tblName" id="tblName" value="MASTER_USER">
            <input type="hidden" name="tblName2" id="tblName2" value="">
            <input type="hidden" name="colName" id="colName" value="USER_CODE">
            <input type="hidden" name="colNameTwo" id="colNameTwo" value="USER_NAME">
            <input type="hidden" name="colNameThree" id="colNameThree" value="ACC_CODE">
            <input type="hidden" name="colNameFour" id="colNameFour" value="ACC_NAME">

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
//    $(document).ready(function(){

//      $.ajaxSetup({

//           headers: {

//               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

//           }

//          });

//      var logUser = $('#logUser').val();

//     var t = $("#example").DataTable({

//        processing: true,
//        serverSide:false,
//        //scrollY:500,
//        scrollX:true,
//        paging: true,
//        ajax:{

//         url : "{{ url('/Master/Setting/View-User-Mast') }}"

//        },
//        searching : true,
    

//        columns: [
        
       
//          { data:"DT_RowIndex",className:"text-center"},
//          { data:"USER_NAME" },
//          { data:"EMAIL_ID" },
//          { data:"USER_TYPE" },
         
//          // {  
//          //  render: function (data, type, full,url){
             
//          //   if(full['IMAGE'] != null){
               
//          //      return '<img src="data:image/jpeg;base64,{0},' + full['IMAGE'] + '" />';
            
//          //    }

//          //  }
//          //  },

//               {
//             data: 'IMAGE',
//             name: 'image',
//                render: function (full, type, row, meta) {
//                var imgsrc = 'data:image/png;base64,'+full['IMAGE'];
//                return '<img class="img-responsive" src="' + imgsrc +'" " height="50px" width="50px">';
//               }


//             },
//           { render: function (data, type, full, meta){


//                   if(full['FLAG']==0){
//                       return '<span class="label label-success">Active</span>';
//                     }else if(full['FLAG']==1){

//                       return '<span class="label label-danger">Inactive</span>';
//                     }else{

//                       return '<span class="label label-danger">Not Found</span>';
//                     }
                         

//                      },className:"text-center"
//           },
          
         
//          {  
//             render: function (data, type, full, meta){

                  

//                     if(full['USER_NAME'] == logUser){
//                       var notDelete = 'disabled';
//                     }else{
//                       var notDelete ='';
//                     }

//                     //console.log('notDelete',notDelete);

//                      if(full['ACCESS_FLAG']==1){
//                       return '<a href="Edit-User-Mast/'+btoa(full['USER_CODE'])+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" disabled '+notDelete+'><i class="fa fa-trash" title="Delete"></i></button>';
//                     }else{

//                       return '<a href="Edit-User-Mast/'+btoa(full['USER_CODE'])+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getId(\''+full['USER_CODE']+'\');" '+notDelete+'><i class="fa fa-trash" title="Delete"></i></button>';
//                     }
                         

//                 }
        

//        },
         
         
        
//       ],

       


//      });



// });
</script>





<script type="text/javascript">

function funDelData(){

 var AssetCode  = $("#UserID").val();
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

  function getId(id)
  {

    $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+id+'" rows="2" oninput="deleteRemark()"></textarea></div></div>');

    $("#userDelete").modal('show');

    $("#UserID").val(id);

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



