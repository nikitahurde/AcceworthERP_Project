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



          Master Project WBS



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('Master/Infrastructure/Add-Project-Wbs-Master')}}">Master project </a></li>



            <li class="Active"><a href="{{ URL('Master/Infrastructure/Add-Project-Wbs-Master')}}">View Master project </a></li>



          </ol>



        </section>


        <!-- Main content -->



        <section class="content">



          <div class="row">



            <div class="col-xs-12">


              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Master project</h3>



                  <div class="box-tools pull-right">



          <a href="{{ url('Master/Infrastructure/Add-Project-Wbs-Master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Master project</a>



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

                      <th class="text-center">Project Code</th>
                        <!-- <th class="text-center">Project Name</th>
 -->
                        <th class="text-center"> WBS Code</th>
                         <th class="text-center"> WBS Name</th>
                        <th class="text-center"> WBS Plant Start Date</th>    
                        <th class="text-center"> WBS Plant End Date</th>    
                        <th class="text-center"> WBS Actual Start Date</th>    
                        <th class="text-center"> WBS Actual End Date</th>    
                        <th class="text-center"> WSB Status</th>    
                        <th class="text-center"> WBS Progress</th>    

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

<div class="modal fade" id="itemtypeDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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


             <input type="hidden" name="costcat" id="costcat" value="">
             <input type="hidden" name="AssetViewLink" id="AssetViewLink" value="">
          
             <input type="hidden" name="tblName" id="tblName" value="PROJECT_WBS">
         
          
             <input type="hidden" name="colName" id="colName" value="PROJECT_CODE">
             <input type="hidden" name="colNameTwo" id="colNameTwo" value="">
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
                      title: 'MASTER PROJECT WBS'+$("#headerexcelDt").val(),
                      filename: 'MASTER_PROJECT_WBS_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('Master/Infrastructure/View-Project-Wbs-Master') }}"

       },
       searching : true,
    

       columns: [
        
        
          { data: "PROJECT_CODE"},
          { data: "WBS_CODE" },
          { data: "WBS_NAME" },

          { 
            data:'WBS_PLAN_STDATE',
             className:'text-right',
              render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
                 
            },
         },
       
         //{ data: "WBS_PLAN_ENDATE" },
          { 
            data:'WBS_PLAN_ENDATE',
            className: 'text-right',
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
         // // { data: "PLAN_ENDATE" },
          { 
            data:'WBS_ACT_STDATE',
          
            
              className: 'text-right',
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
         // // { data: "ACT_STDATE" },
          { 
            data:'WBS_ACT_ENDATE',
            className: 'text-right',
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
         
         { data: "WBS_STATUS" },
         { data: "WBS_PROGRESS" ,
          className: 'text-right',
         },



          {  
             render: function (data, type, full, meta){

                       var enableBtn = 'enable';
                       var deletebtn ='<input type="hidden" id="deleteinput_'+full['PROJECTID']+'" value="'+full['PROJECTID']+'"><a href="Edit-Project-Wbs-Master/'+btoa(full['PROJECTID'])+'" id="getId"class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return dleteitemType(\''+full['PROJECTID']+'\','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                     
                     return deletebtn;

                    },className:"text-center"
        
         },
        
      
      ],

       
   });

});




</script>

<script type="text/javascript">

  function funDelData(){

 var AssetCode = $("#costcat").val();
 var del_remark = $("#del_remark").val();
 var tblName = $("#tblName").val();
 var colName1 = $("#colName").val();
 var colName2 = $("#colNameTwo").val();
 var colName3 = $("#colNameThree").val();
 var colName4 = $("#colNameFour").val();
 var colName5 = $("#colNameFive").val();
 var colName6 = $("#colNameSix").val();

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
    
    data: {AssetCode:AssetCode,del_remark:del_remark,tblName:tblName,colName1:colName1,colName2:colName2,colName3:colName3,colName4:colName4,colName5:colName5,colName6:colName6,AssetViewLink:AssetViewLink},
    
    success:function(data){
      //console.log('data',data);

      //var data1 = JSON.parse(data);
     
     if(data.response =='success'){

        $('#itemtypeDelete').modal('hide');
       $('#del_remark').val('');
       location.reload();
     }else{

     }

    }
  
});

}
  function dleteitemType(itemtype,rowId){
    
    var getval = $('#deleteinput_'+itemtype).val();
   
    $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea></div></div>');

    $('#itemtypeDelete').modal('show');

    $('#costcat').val(getval);
   
  }

  function deleteRemark(){
    
    var remark = $('#del_remark').val();
  
    if(remark.length > 10){
       $('#del_data').attr('disabled',false);
    }else{
      $('#del_data').attr('disabled',true);
    }

    console.log('remark',remark);
  }



</script>









@endsection






