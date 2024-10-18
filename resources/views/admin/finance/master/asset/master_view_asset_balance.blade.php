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

            Master Asset Balance 

            <small> View Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('Master/Asset/Asset-Balance-Master') }}">Master Asset </a></li>

            <li class="active"><a href="{{ url('Master/Asset/Asset-Balance-Master') }}">Master Asset Bal.</a></li>

            <li class="active"><a href="{{ url('Master/Asset/View-Asset-Balance-Master') }}">View Asset Balance</a></li>



          </ol>



        </section>


        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">

              <div class="box box-primary Custom-Box">


                <div class="box-header with-border" style="text-align: center;">


                  <h3 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Asset Balance List </h3>


                  <div class="box-tools pull-right">


                    <a href="{{ url('Master/Asset/Asset-Balance-Master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Asset Balance</a>


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

                <div class="col-sm-12">

                  <table id="example" class="table table-bordered table-striped table-hover">

                    <thead>

                      <tr>

                        <th class="text-center">Company Code</th>

                        <th class="text-center">Company Name</th>

                        <th class="text-center">FY Code</th>

                        <th class="text-center">Asset Code</th>

                        <th class="text-center">Asset Name</th>
                        
                        <th class="text-center">YROPGB</th>

                        <th class="text-center">YRDRGB</th>

                        <th class="text-center">YRCRGB</th>

                        <th class="text-center">YRCLGB</th>

                        <th class="text-center">YROPDB</th>

                        <th class="text-center">RYDRDB</th>

                        <th class="text-center">YRCRDB</th>

                        <th class="text-center">YRCLDB</th>

                        <th class="text-center">YRCLNB</th>

                        <th class="text-center">YROPNB</th>

                        <th class="text-center">Status</th>

                        <th class="text-center">Action</th>

                      </tr>

                    </thead>

                    <tbody>

                  </tbody>

                  </table>

                </div>

              </div><!-- /.box-body -->

              </div><!-- /.box -->

            </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->

      </div>


    <!-- ----- Delete Modal ------ -->

  <div class="modal fade" id="costTypeDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

              <input type="hidden" name="AssetCode" id="AssetCode" value="">

              <input type="hidden" name="AssetViewLink" id="AssetViewLink" value="Master/Asset/View-Asset-Balance-Master">

              <input type="hidden" name="tblName" id="tblName" value="MASTER_ASBAL">

              <input type="hidden" name="colName" id="colName" value="ASSET_CODE">
              <input type="hidden" name="colNameTwo" id="colNameTwo" value="COMP_CODE">
              <input type="hidden" name="colNameThree" id="colNameThree" value="FY_CODE">
              <input type="hidden" name="colNameFour" id="colNameFour" value="">

              <input type="hidden" name="colNameFive" id="colNameFive" value="">

              <input type="hidden" name="colNameSix" id="colNameSix" value="">

              <input type="button" value="Delete" id="del_data" style="margin-top: -12%;" class="btn btn-sm btn-danger" disabled="" onclick="funDelData()">

            </form>

        </div>

      </div>

    </div>

  </div>


  <!-- ----- -/ Delete Modal ------ -->
 


@include('admin.include.footer')




<script type="text/javascript">
   $(document).ready(function(){

     $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

    var viewName = 'AssetView';

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
       scrollX:true,
       paging: true,
       searching : true,
       dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
        buttons:  [
                    {
                      extend: 'excelHtml5',
                      exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                      },
                      title: 'MASTER ASSET BALANCE'+$("#headerexcelDt").val(),
                      filename: 'MASTER_ASSET_BALANCE_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('Master/Asset/View-Asset-Balance-Master') }}",
        data: {viewName:viewName}

       },
       
       columns: [
        
         {
            data:"COMP_CODE"},
            // render: function (data, type, full, meta) {
            //     var name = full['COMP_NAME'];
            //     var code = full['COMP_CODE'];
            //     return name+' [ '+code+' ]';
            // }
    

          { data: "COMP_NAME" },

         
         { data: "FY_CODE" },
         { data: "ASSET_CODE" },
         { data: "ASSET_NAME" },
         // {
         //    data:'ASSET_CODE',
         //    render: function (data, type, full, meta) {
         //        var name = full['ASSET_NAME'];
         //        var code = full['ASSET_CODE'];
         //        return name+' [ '+code+' ]';
         //    }
         // },
         { data: "YROPGB",className:"text-right" },
         { data: "YRDRGB",className:"text-right"},
         { data: "YRCRGB",className:"text-right" },
         { data: "YRCLGB",className:"text-right" },
         { data: "YROPDB",className:"text-right" },
         { data: "RYDRDB",className:"text-right" },
         { data: "YRCRDB",className:"text-right" },
         { data: "YRCLDB",className:"text-right" },
         { data: "YRCLNB",className:"text-right" },
         { data: "YROPNB",className:"text-right" },
         { render: function (data, type, full, meta){


                  if(full['FLAG']=='1'){
                      return '<span class="label label-success">Active</span>';
                    }else if(full['FLAG']=='0'){

                      return '<span class="label label-danger">Inactive</span>';
                    }else{

                      return '<span class="label label-danger">Not Found</span>';
                    }
                         

                     },className:"text-center"
          },
         {  
            render: function (data, type, full, meta){
                     
                      var enableBtn = 'enable';
                      var deletebtn ='<a href="Update-Asset-Balance-Master/'+btoa(full['ASSET_CODE'])+'/'+btoa(full['COMP_CODE'])+'/'+btoa(full['FY_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID(\''+full['ASSET_CODE']+'\',\''+full['COMP_CODE']+'\',\''+full['FY_CODE']+'\','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                     

                      return deletebtn;

                     }
        

       },
        
         
        
      ],

       


     });



});
</script>


<script type="text/javascript">

  function funDelData(){

 var AssetCode = $("#AssetCode").val();
 var del_remark = $("#del_remark").val();
 var tblName = $("#tblName").val();
 var colName1 = $("#colName").val();
 var colName2 = $("#colNameTwo").val();
 var colName3 = $("#colNameThree").val();
 console.log('colName3',colName3);
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
    
    data: {AssetCode: AssetCode,del_remark:del_remark,tblName:tblName,colName1:colName1,colName2:colName2,colName3:colName3,colName4:colName4,colName5:colName5,colName6:colName6,AssetViewLink:AssetViewLink},
    
    success:function(data){

     var data1 = JSON.parse(data);
     console.log('data1',data1);
     
     if(data1.response =='success'){

       $('#costTypeDelete').modal('hide');
       $('#del_remark').val('');
       location.reload();
     }else{

     }

    }
  
});

}

  function getID(assetCd,compCd,fyCd,rowId){

    var getval = $('#deleteinput_'+costType).val();

    $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea></div></div>')

    $("#costTypeDelete").modal('show');

    $("#AssetCode").val(assetCd+'/'+compCd+'/'+fyCd);
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







