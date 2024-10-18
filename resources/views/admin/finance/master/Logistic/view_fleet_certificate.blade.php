@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



@include('admin.include.sidebar')

<style>
   .boxer {
    display: table;
    border-collapse: collapse;
  }
  .boxer .box-row {
    display: table-row;
  }
  .boxer .box-row:first-child {
    font-weight:bold;
  }
  .chieldtblecls tr td{
    border: 1px solid #ccc4c4 !important;
    line-height: 1.0;
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
  }

  .chieldtblecls>tbody>tr>td {
    line-height: 1.0;
  }
  .columnhide{
    display:none;
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

            Master Fleet Certificate 

            <small>View Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/view-manufature')}}">Master Fleet Certificate </a></li>

            <li class="Active"><a href="{{ URL('/view-manufature')}}">View Fleet Certificate </a></li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">

             



              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Fleet Certificate</h3>

                  <div class="box-tools pull-right">

                    <a href="{{ url('/logistic/fleet-certificate-transaction-form') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Fleet Certificate</a>

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

                        <th class="text-center"></th>
                        <th class="text-center">Company Code/Name</th>
                        <th class="text-center">Vehicle Number</th>

                        <th class="text-center">Certificate Code</th>

                        <th class="text-center">Certificate Name</th>

                        <th class="text-center">Certificate Number</th>

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






<div class="modal fade" id="mfgDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-header">





        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>





        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>



      <div class="modal-body">



      You Want To Delete This Manufacturing Data...!



      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>



          <form action="{{ url('delete-manufature') }}" method="post">



            @csrf



            <input type="hidden" name="mfgId" id="mfgId" value="">



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
                            columns: [1,2,3,4,5]
                      },
                      title: 'MASTER FLEET CERTIFICATE'+$("#headerexcelDt").val(),
                      filename: 'MASTER_FLEET_CERTIFICATE_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/logistic/view-fleet-certificate-transaction') }}"

       },
       searching : true,
    

       columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable(\''+full.TRUCK_NO+'\','+full.ID+');"><i class="fa fa-plus" id="minus'+full.ID+'" title="Toggle"></i></button>'
          }
         },

          { 
            render: function (data, type, full, meta){

              var compCode = full['COMP_CODE'];
              var compName = full['COMP_NAME'];

              return compCode+' - '+compName;


            },
            className:"text-center"
          },
       
         { data:"TRUCK_NO" },
         { data:"CERTF_CODE" },
         { data:"CERTF_NAME" },
         // { render: function (data, type, full, meta){
             
         //     var cert_code  = full['CERTF_CODE'];
         //     var cert_name  = full['CERTF_NAME'];
            

         //     var certcodename = cert_name+' ['+cert_code+' ]';

         //     return  certcodename;


         //    }
         //  },
         { data:"CERTF_NO" },
        
         {  
            render: function (data, type, full, meta){

              var deletebtn ='<a href="edit-manufature/'+btoa(full['TRUCK_NO'])+'" class="btn btn-warning btn-xs actionBTN" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                     
              return deletebtn;
                         

          },className:'text-center'
        

       },
         
         
        
      ],

       


     });

     $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        console.log(tr);
        var row = t.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });

 

});
</script>





<script type="text/javascript">

  function format ( d ) {
  
  return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.TRUCK_NO+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th>Sr. No.</th>'+
            '<th>CERT NAME/CODE</th>'+
            '<th>CERT NO</th>'+
            '<th>CERT DATE</th>'+
            '<th>CERT RENEW DUE DATE</th>'+
            '<th>CERT RENEW  DATE</th>'+
        '</tr></tbody>'+
    '</table>';
}

 function showchildtable(truckNo,tblid){
          
          var truckNo,tblid;

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });
             
             $("#minus"+tblid).toggleClass('fa-plus fa-minus rotate');

             $.ajax({

              url:"{{ url('/view-fleet-cert-chield-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {truckNo:truckNo,tblid:tblid},

               success:function(data){

                  var data1 = JSON.parse(data);
                  // console.log('data1',data1);

                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                         var objrow = data1.data;
                         var srNo=1;
                         var tableid = objrow[0].TRUCK_NO ;
                       $.each(objrow, function (row, objrow) {

                        var certdate = objrow.CERTF_DATE;
                        console.log('certdate',certdate);

                        if(certdate == '' || certdate == null){
                          
                          cert_dt = '----';
                           
                         }else{
                           
                           var date = new Date(certdate);
                           var month = date.getMonth() + 1;
                           var cert_dt =  date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                         }
                       

                        // var cert_dt = certDate ? certDate : '----';

                        var certrdeudate = objrow.CRENEW_DUEDT;
                        var cduedate = new Date(certrdeudate);
                        var monthd = cduedate.getMonth() + 1;
                        var certRDueDate =  cduedate.getDate() + "-" + (monthd.toString().length > 1 ? monthd : "0" + monthd) + "-" +  cduedate.getFullYear();

                        var certrewdate = objrow.CERTF_RENEW_DATE;
                        var crdate = new Date(certrewdate);
                        var monthr = crdate.getMonth() + 1;
                        var certRewDate =  crdate.getDate() + "-" + (monthr.toString().length > 1 ? monthr : "0" + monthr) + "-" +  crdate.getFullYear();

                        var cert_code = objrow.CERTF_CODE;
                        var cert_name = objrow.CERTF_NAME;

                        var certCodeName = cert_name +' ['+ cert_code  +' ]';
                        var certNo = objrow.CERTF_NO;
                        var cert_no = certNo ? certNo : '----';



                      $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td class="text-left"><p>'+certCodeName+' </p></td><td class="text-right">'+cert_no+'</td><td class="text-right">'+cert_dt+'</td><td class="text-right">'+certRDueDate+'</td><td class="text-right">'+certRewDate+'</td></tr>');

                           srNo++;

                          });



                      }
                      
                  }
               }

          });
    }

  function getId(id)

  {

    $("#mfgDelete").modal('show');

    $("#mfgId").val(id);

  }

</script>



@endsection



