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


           Unit Sale Tran



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ url('Transaction/Infrastructure/Add-Unit-Sale-Tran') }}"> Unit Sale Tran</a></li>



            <li class="Active"><a href="{{ url('Transaction/Infrastructure/Add-Unit-Sale-Tran') }}">View  Unit Sale Tran</a></li>



          </ol>



        </section>







        <!-- Main content -->



        <section class="content">



          <div class="row">



            <div class="col-xs-12">



              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View  Unit Sale Tran</h3>



                  <div class="box-tools pull-right">



          <a href="{{ url('Transaction/Infrastructure/Add-Unit-Sale-Tran') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add  Unit Sale Tran</a>



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
                        <th class="text-center">Unit Code</th>
                        <th class="text-center">Unit Name</th>

                        <th class="text-center"> Acc Code</th>
                        <th class="text-center"> Acc Name</th>

                        <th class="text-center"> Customer 1</th>    
                        <th class="text-center"> Customer 2</th>    
                        <th class="text-center"> Customer 3</th>    
                        <th class="text-center"> Customer 4</th>    
                        <th class="text-center"> Phone 1</th>    
                        <th class="text-center"> Phone 2</th>    
                        <th class="text-center"> Phone 3</th>    
                        <th class="text-center"> Phone 4</th>    
                        <th class="text-center"> Unit_area</th>    
                        <th class="text-center"> Unit_UM</th>    
                        <th class="text-center"> Unit_Rate</th>    
                        <th class="text-center"> Unit_Amount</th> 
                        <th class="text-center"> Unit_code</th>
                        <th class="text-center"> Unit_name</th>
                        <th class="text-center"> Acc_code</th>
                        <th class="text-center"> Acc_name</th>
                        <th class="text-center"> Milestone_code</th> 
                        <th class="text-center"> Milestone_name</th> 
                        <th class="text-center"> Milestone_date</th> 
                        <th class="text-center"> Amount</th> 
                        <th class="text-center"> Particular</th> 
                        <th class="text-center"> Action</th> 
                        

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
          
          <input type="hidden" name="tblName" id="tblName" value="UNIT_SALE_TRAN">
         
          
          <input type="hidden" name="colName" id="colName" value="UNIT_CODE">
          <input type="hidden" name="colNameTwo" id="colNameTwo" value="UNIT_NAME">
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
       ajax:{

        url : "{{ url('Transaction/Infrastructure/View-Unit-Sale-Tran') }}"

       },
       searching : true,


       columns: [
        
       
         
          { data:"UNIT_CODE",  className:"text-center"},
          { data:"UNIT_NAME",  className:"text-center"},
           { data:"ACC_CODE",   className:"text-center"},
           { data:"ACC_NAME",   className:"text-center"},
           { data:"CUSTOMER1",  className:"text-center"},
           { data:"CUSTOMER2",  className:"text-center"},
           { data:"CUSTOMER3",  className:"text-center"},
           { data:"CUSTOMER4",  className:"text-center"},
           { data:"PHONE1",     className:"text-center"},
           { data:"PHONE2",     className:"text-center"},
           { data:"PHONE3",     className:"text-center"},
           { data:"PHONE4",     className:"text-center"},
           { data:"UNIT_AREA",  className:"text-center"},
           { data:"UNIT_UM",    className:"text-center"},
           { data:"UNIT_RATE",  className:"text-center"},
           { data:"UNIT_AMOUNT",className:"text-center"},
           { data:"UNIT_CODE",className:"text-center"},
           { data:"UNIT_NAME",className:"text-center"},
           { data:"ACC_CODE",className:"text-center"},
           { data:"ACC_NAME",className:"text-center"},
           { data:"MILESTONE_CODE",className:"text-center"},
           { data:"MILESTONE_NAME",className:"text-center"},
           { data:"MILESTONE_DATE",className:"text-center"},
           { data:"AMOUNT",className:"text-center"},
           { data:"PARTICULAR",className:"text-center"},
         
         {  
             render: function (data, type, full, meta){

                       var enableBtn = 'enable';
                       var deletebtn ='<input type="hidden" id="deleteinput_'+full['UNIT_CODE']+'" value="'+full['UNIT_CODE']+'"><a href="Edit-Unit-Sale-Tran/'+btoa(full['UNIT_CODE'])+'" id="getId"class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return dleteitemType(\''+full['UNIT_CODE']+'\','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                     
                     return deletebtn;

                    },className:"text-center"
        
         },
      
      ],

     });



});
</script>



<script type="text/javascript">

function funDelData(){
 
 var AssetCode  = $("#costcat").val();
 
 var del_remark = $("#del_remark").val();
 //console.log('del_remark',del_remark);
 var tblName    = $("#tblName").val();
 var colName1   = $("#colName").val();
  //console.log('colName1',colName1);
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
    
    data: {AssetCode:AssetCode,del_remark:del_remark,tblName:tblName,colName1:colName1,colName2:colName2,colName3:colName3,colName4:colName4,colName5:colName5,colName6:colName6,AssetViewLink:AssetViewLink},
    
    success:function(data){

     var data1 = JSON.parse(data);
     
     if(data1.response =='success'){

       $('#itemtypeDelete').modal('hide');
       $('#projectId').val('');
       location.reload();
     }else{

     }

    }
  
  });

}
  function dleteitemType(itemtype,rowId){
       console.log('itemtype',itemtype);
    var getval = $('#deleteinput_'+itemtype).val();
//console.log('input',getval);
    $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea></div></div>');

    $('#itemtypeDelete').modal('show');

    $('#costcat').val(getval);
    //console.log('projectId',projectId);

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







