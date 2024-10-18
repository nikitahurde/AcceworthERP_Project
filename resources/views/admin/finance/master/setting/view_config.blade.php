@extends('admin.main')



@section('AdminMainContent')


@include('admin.include.header')



@include('admin.include.navbar')


@include('admin.include.sidebar')

<style>
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



            Master Config 



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/finance/view-config-mast')}}">Master Config </a></li>



            <li class="Active"><a href="{{ URL('/finance/view-config-mast')}}">View Config </a></li>



          </ol>



        </section>







        <!-- Main content -->



        <section class="content">



          <div class="row">



            <div class="col-xs-12">



             







              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Config</h3>



                  <div class="box-tools pull-right">



          <a href="{{ url('/Master/Setting/Config-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Config</a>



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



                        <th class="text-center">Transaction  Code</th>
                        <th class="text-center">Transaction  Name</th>

                        <th class="text-center">Series Code</th>
                        <th class="text-center">Series Name</th>

                        <th class="text-center">Plant Code</th>
                        <th class="text-center">Plant Name</th>

                        <th class="text-center">PFCT Code</th>
                        <th class="text-center">PFCT Name</th>

                        <th class="text-center">GL Code</th>
                        <th class="text-center">GL Name</th>

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










<div class="modal fade" id="configDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-sm" role="document">


    <div class="modal-content">


      <div class="modal-header">


        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>


        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>


      </div>


      <div class="modal-body">


      You Want To Delete This Data...!


      </div>


      <div class="modal-footer">


          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>


          <form action="{{ url('/finance/delete-config') }}" method="post">



            @csrf







            <input type="hidden" name="configId" id="configId" value="">







            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">







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
                            columns: [0,1,2,3,4,5,6,7,8,9,10]
                      },
                      title: ' MASTER CONFIG'+$("#headerexcelDt").val(),
                      filename: 'MASTER_CONFIG_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/Master/Setting/View-Config-Mast') }}"

       },
       searching : true,
    

       columns: [
        
       
         { render: function (data, type, full, meta){

           var transcode =  (full['TRAN_CODE'] != null) ? full['TRAN_CODE'] : '---';

           return transcode;
           }
         },
         { 
           render: function (data, type, full, meta){

            // var transcode =  (full['TRAN_CODE'] != null) ? full['TRAN_CODE'] : '---';
            var tranname =  (full['TRAN_HEAD'] != null) ? full['TRAN_HEAD'] : '---';

            var tran_name = 'display' && tranname.length > 10 ? tranname.substr(0, 10) + '…' : tranname;
            return '<span data-tip="'+tranname+'">'+ tran_name+'</span> ';

           }

         },
         {data:'SERIES_CODE'},
         { render: function (data, type, full, meta){

            // var seriescode = full['SERIES_CODE'];
            var seriesname = full['SERIES_NAME'];

            // var seriescodename = seriesname+ ' [ '+ seriescode +' ] ' ;
            return seriesname;


          },
         },
         { render: function (data, type, full, meta){
             var plantcode =  (full['PLANT_CODE'] != null) ? full['PLANT_CODE'] : '---';
             return plantcode;
           }
         },
         { 
           render: function (data, type, full, meta){

            // var plantcode =  (full['PLANT_CODE'] != null) ? full['PLANT_CODE'] : '---';
            var plantname =  (full['PLANT_NAME'] != null) ? full['PLANT_NAME'] : '---';;

            // var plantcodename = plantcode+ ' [ '+ plantname +' ] ' ;
            return plantname;


          },
         },
         { render: function (data, type, full, meta){
             var pfctcode =  (full['PFCT_CODE'] != null) ? full['PFCT_CODE'] : '---';
             return pfctcode;
           }
         },
         { 
           render: function (data, type, full, meta){

            // var pfctcode =  (full['PFCT_CODE'] != null) ? full['PFCT_CODE'] : '---';
            var pfctname =  (full['PFCT_NAME'] != null) ? full['PFCT_NAME'] : '---';

            // var pfctcodename = pfctcode+ ' [ '+ pfctname +' ] ' ;
            return pfctname;


          },
         },
         {  render: function (data, type, full, meta){
              var glcode =( full['GL_CODE']  != null) ?  full['GL_CODE'] : '---';
              return glcode;
           }
         },
         { 
           render: function (data, type, full, meta){

            // var glcode = (full['GL_CODE'] != null) ? full['GL_CODE'] : '---';
            var glname =( full['glname']  != null) ?  full['glname'] : '---';



            // var glcodename = glcode+ ' [ '+ glname +' ] ' ;
            return glname;


          },
         },
        
         { render: function (data, type, full, meta){


                  if(full['CONFIG_BLOCK']=='NO'){
                      return '<span class="label label-success">Active</span>';
                    }else if(full['CONFIG_BLOCK']=='YES'){

                      return '<span class="label label-danger">Inactive</span>';
                    }else{

                      return '<span class="label label-danger">Not Found</span>';
                    }
                         

                     },className:"text-center"
          },
         {  
            render: function (data, type, full, meta){

                                       
                      var enableBtn = 'enable';
                      var deletebtn ='<input type="hidden" id="deleteinput_'+full['SERIES_CODE']+'" value="'+full['SERIES_CODE']+'"><a href="Edit-Config-Mast/'+btoa(full['COMP_CODE'])+'/'+btoa(full['TRAN_CODE'])+'/'+btoa(full['SERIES_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getId(\''+full['COMP_CODE']+'\',\''+full['TRAN_CODE']+'\',\''+full['SERIES_CODE']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';
                     

                      return deletebtn;

                     },className:"text-center"
        

       },
        
         
        
      ],

       


     });



});
</script>







<script type="text/javascript">

  function getId(compcd,transcd,seriescd)

  {
    //var getval = $('#deleteinput_'+configCode).val();

    $("#configDelete").modal('show');

    var hiddnId = compcd+'~'+transcd+'~'+seriescd;

    $("#configId").val(hiddnId);



  }



</script>

@endsection







