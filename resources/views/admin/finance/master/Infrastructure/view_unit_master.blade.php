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
  .modal-header .close {
    margin-top: -32px;
  }
  .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
  }

</style>







<div class="content-wrapper">



  <!-- Content Header (Page header) -->



  <section class="content-header">


    <h1>


      Master Unit 



      <small>View Details</small>



    </h1>



    <ol class="breadcrumb">



      <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



      <li><a href="{{ URL('/dashboard')}}">Master</a></li>



      <li class="Active"><a href="#">Master Unit </a></li>



      <li class="Active"><a href="#">View Unit </a></li>



    </ol>



  </section>







  <!-- Main content -->



  <section class="content">



    <div class="row">



      <div class="col-xs-12">



        <div class="box box-primary Custom-Box">



          <div class="box-header with-border" style="text-align: center;">



            <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Unit </h3>



            <div class="box-tools pull-right">



              <a href="{{ url('/Master/Infrastructure/add-unit-master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Unit Master</a>



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

                  <th class="text-center">Unit Code</th>
                  <th class="text-center">Unit Name</th>
                  <th class="text-center">Unit Type</th>
                  <th class="text-center">Unit Area</th>
                  <th class="text-center">Unit Um</th>
                  <th class="text-center">Unit Rate</th>
                  <th class="text-center">Wing No</th>
                  <th class="text-center">Tower No</th>
                  <th class="text-center">Floor No</th>
                  <th class="text-center">Unit No</th>

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












<div class="modal fade" id="exampleModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



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

        <form action="#" method="post" >



          @csrf



          <input type="hidden" name="costcat" id="costcat" value="">
          <input type="hidden" name="AssetViewLink" id="AssetViewLink" value="Master/Employee/View-Emp-Grade-Mast">

          <input type="hidden" name="tblName" id="tblName" value="MASTER_UNIT">


          <!-- <input type="hidden" name="tblId" id="tblId" value="{{('UNITID')}}"> -->


          <input type="hidden" name="colName" id="colName" value="UNITID">
          <input type="hidden" name="colNameTwo" id="colNameTwo" value="UNIT_NAME">



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
      processing: false,
      serverSide:false,
//scrollY:500,
// scrollX:true,
      paging: true,
      dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
        buttons:  [
                    {
                      extend: 'excelHtml5',
                      exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8,9]
                      },
                      title: 'MASTER UNIT'+$("#headerexcelDt").val(),
                      filename: 'MASTER_UNIT_'+$("#headerexcelDt").val(),
                    }
                  ],
      ajax:{

        url : "{{ url('/Master/Infrastructure/view-unit-master') }}"

      },
      searching : true,


      columns: [


// { data:"DT_RowIndex",className:"text-center"},


        { data:"UNIT_CODE",className:"text-center"},
        { data:"UNIT_NAME",className:"text-center"},
        { data:"UNIT_TYPE",className:"text-center"},
        { data:"UNIT_AREA",className:"text-center"},
        { data:"UNIT_UM",className:"text-center"},
        { data:"UNIT_RATE",className:"text-center"},
        { data:"WING_NO",className:"text-center"},
        { data:"TOWER_NO",className:"text-center"},
        { data:"FLOOR_NO",className:"text-center"},
        { data:"UNIT_NO",className:"text-center"},


        {  
          render: function (data, type, full, meta){



// var enableBtn = 'enable';
// var deletebtn ='<input type="hidden" id="deleteinput_'+full['DT_RowIndex']+'" value="'+full['UNITID']+'"><a href="edit-unit-master/'+btoa(full['UNITID'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <input type="hidden" id="deleteinput_'+full['DT_RowIndex']+'" value="'+full['UNITID']+'"> <button  class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getId(\''+full['UNITID']+'\','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button>';



            var enableBtn = 'enable';
            var deletebtn ='<input type="hidden" id="deleteinput_'+full['UNITID']+'" value="'+full['UNITID']+'"><a href="edit-unit-master/'+btoa(full['UNITID'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a>|<input type="hidden" name="acctypeCode" id="deleteinput_'+full['UNITID']+'"value="'+full['UNITID']+'"><button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getId(\''+full['UNITID']+'\','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button>';


            return deletebtn;

          },className:"text-center",


        },



        ],




    });



  });


  function getId(typeId,rowId)


  {

//alert(id);return false;
    var getval = $('#deleteinput_'+typeId).val();

    console.log('getval',getval);



    $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks :<span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea></div></div>');

    $("#exampleModalDelete").modal('show');

    $("#acctypeID").val(getval);

  }
</script>
<script type="text/javascript">

  function funDelData(){
    console.log('ch');

    var AssetCode = $("#costcat").val();
    console.log('AssetCode',AssetCode);
    var del_remark = $("#del_remark").val();
    // var tblId = $("#tblId").val();
    var tblName = $("#tblName").val();
    var colName1 = $("#colName").val();
    console.log('colName1',colName1);
    var colName2 = $("#colNameTwo").val();

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

      data: {AssetCode:AssetCode,del_remark:del_remark,tblName:tblName,colName1:colName1,colName2:colName2,AssetViewLink:AssetViewLink},

      success:function(data){

        var data1 = JSON.parse(data);

        if(data1.response =='success'){

          $('#costTypeDelete').modal('hide');
          $('#del_remark').val('');
          location.reload();
        }else{

        }

      }

    });

  }
  function getId(tblId,rowId)
  {
// console.log('Id',tblId);
    var getval = $('#deleteinput_'+rowId).val();
// console.log('tblId',tblId);
// console.log('getval',getval);
// console.log('deleteinput_', 'deleteinput_'+tblId);

    $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea></div></div>')

    $("#exampleModalDelete").modal('show');

    $("#costcat").val(getval);

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







