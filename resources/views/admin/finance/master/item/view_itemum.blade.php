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

   .dt-buttons{
    margin-bottom: -30px!important;
  }

  .dt-button{
  
    display: inline-block!important;
    font-weight: 600 !important;
    text-align: center!important;
    white-space: nowrap!important;
    vertical-align: middle!important;
    -webkit-user-select: none!important;
    -moz-user-select: none!important;
    -ms-user-select: none!important;
    user-select: none!important;
    border: 1px solid transparent!important;
    padding: .375rem .75rem!important;
    font-size: 15px!important;
    line-height: 1.5!important;
    border-radius: .25rem!important;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out!important;
  }

  .dt-button:before {
    content: '\f02f';
    font-family: FontAwesome;
    padding-right: 5px;
  }

  .buttons-excel{
    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
  }

  .buttons-excel:before {
    content: '\f1c9';
    font-family: FontAwesome;
    padding-right: 5px;
  }
</style>



  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master Item UM

            <small>View Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/view-mast-itemum') }}">Master Item UM</a></li>

            <li class="active"><a href="{{ url('/view-mast-itemum') }}">View Item UM</a></li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">

              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">View Item UM</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/Master/Item/ItemUM_Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Item UM</a>

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


                         <th class="text-center">Item Code</th>
                         <th class="text-center">Item Name</th>
                         <th class="text-center">UM Code</th>
                         <th class="text-center">AUM</th>
                         <th class="text-center">AUM Factor</th> 
                         <th class="text-center">Action</th> 

                      </tr>

                    </thead>

                    <tbody>

                    </tbody>

                    <!-- <tfoot>

                      <tr>

                        <th>Rendering engine</th>

                        <th>Browser</th>

                        <th>Platform(s)</th>

                        <th>Engine version</th>

                        <th>CSS grade</th>

                      </tr>

                    </tfoot> -->

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

          <form action="{{ url('delete-itemum') }}" method="post">

            @csrf

            <input type="hidden" name="ItemumID" id="ItemumID" value="">

            <input type="hidden" name="AssetViewLink" id="AssetViewLink" value="Master/Asset/View-Asset-Group">
            
            <input type="hidden" name="tblName" id="tblName" value="MASTER_ASGROUP">
            <input type="hidden" name="tblName2" id="tblName2" value="">
            <input type="hidden" name="colName" id="colName" value="ASGROUP_CODE">
            <input type="hidden" name="colNameTwo" id="colNameTwo" value="ASGROUP_NAME">
            <input type="hidden" name="colNameThree" id="colNameThree" value="GL_CODE">
            <input type="hidden" name="colNameFour" id="colNameFour" value="GL_DEP_CODE">
            
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
      
      var date1 = new Date();
      var month = date1.getMonth() + 1;
      var tdate = date1.getDate();
      var mn    = month.toString().length > 1 ? month : "0" + month;
      var yr    = date1.getFullYear();
      var hr    = date1.getHours(); 
      var min   = date1.getMinutes();
      var sec   = date1.getSeconds(); 

      var curr_date = tdate+''+mn+''+yr;
      var curr_time = hr+':'+min+':'+sec;

      
      var t = $("#example").DataTable({
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            var rowcount = data.length;

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
        pageLength:'25',
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
      
          
         buttons:  [
                    {
                      extend: 'excelHtml5',
                      exportOptions: {
                            columns: [0,1,2,3,4]
                      },
                      title: 'MASTER ITEM UM'+$("#headerexcelDt").val(),
                      filename: 'MASTER_ITEM_UM_'+$("#headerexcelDt").val(),
                    }
                  ],
        ajax:{

            url : "{{ url('/Master/Item/View-ItemUM_Mast') }}"

        },
        searching : true,
  
        columns: [
                 
                   {data:'ITEM_CODE'},
                   {data:'ITEM_NAME'},
     
                   {data:'UM_CODE'},
                   {data:'AUM_CODE'},
                   {data:'AUM_FACTOR'},
                   {  
                      render: function (data, type, full, meta){
                    
                        var enableBtn = 'enable';
                        var deletebtn ='<a href="Edit-ItemUM_Mast/'+btoa(full['ITEM_CODE'])+'/'+btoa(full['UM_CODE'])+'/'+btoa(full['AUM_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getId(\''+full['ITEM_CODE']+'\',\''+full['UM_CODE']+'\',\''+full['AUM_CODE']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';

                        return deletebtn;

                      },className:"text-center"
        
                    },
         
        ],

      });

    });

</script>

<script type="text/javascript">

  function getId(id,um,aum)

  {

    $("#exampleModalDelete").modal('show');

    $("#ItemumID").val(id+'/'+um+'/'+aum);

  }

</script>

@endsection



