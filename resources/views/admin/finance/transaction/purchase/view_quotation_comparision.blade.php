@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')

<style type="text/css">
  
  .datebill{
     width: 50px;
     text-align: right;
  }
  .columnhide{
  display:none;
}
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
  .boxer .box10 {
    display: table-cell;
    vertical-align: top;
    border: 1px solid #ddd;
    padding: 5px;
    width: 23%;
  }
  
   .texIndbox1{
    width: 5%; 
    text-align: center;
  }
  .texIndbox{
    text-align: left;
  }
  .rateIndbox{
    width: 15%;
    text-align: center;
  }
  .itmdetlheading{
    vertical-align: middle !important;
    text-align: left;
  }
  .modltitletext {
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
  }
  .removeextraSInC{
    padding: 2px !important;
  }
  .pdfbtndn {
    padding: 2px;
    padding-left: 7px;
    padding-right: 7px;
  }
  .chieldtblecls tr td{
    border: 1px solid #ccc4c4 !important;
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
  }
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
            Quotation Comparision 
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small> : Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active"><a href="{{ url('/Transaction/Purchase/Purchase-Quo-Comparision-View') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/Transaction/Purchase/Purchase-Quo-Comparision-View') }}">View Purchase Quotation Comparision</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Quotation Comparision</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/Purchase/Purchase-Quo-Comparism-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Make Quotation Comparision</a>

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

                        <th class="text-center">#</th>
                      
                        <th class="text-center">Vr No</th>

                        <th class="text-center">Date</th>

                        <th class="text-center">Plant Code</th>

                        <th class="text-center">Pfct Code</th>

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






@include('admin.include.footer')

<script type="text/javascript">

  function format ( d ) {
   
    // `d` is the original data object for the row


    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.PQCSHID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th class="removeextraSInC">SR. NO.</th>'+
            '<th class="removeextraSInC">ACC CODE</th>'+
            '<th class="removeextraSInC">ACC_NAME</th>'+
            '<th class="removeextraSInC">ITEM CODE</th>'+
            '<th class="removeextraSInC">ITEM NAME</th>'+
            '<th class="removeextraSInC">PARTICULAR</th>'+
            '<th class="removeextraSInC">Qty</th>'+
            '<th class="removeextraSInC">UM</th>'+
            '<th class="removeextraSInC">A-Qty</th>'+
            '<th class="removeextraSInC">AUM</th>'+
            '<th class="removeextraSInC">RATE</th>'+
            '<th class="removeextraSInC">BASICAMT</th>'+
            '<th class="removeextraSInC">TAX CODE</th>'+
            '<th class="removeextraSInC">CRAMT</th>'+
            '<th class="removeextraSInC">LEVEL</th>'+
        '</tr></tbody>'+
    '</table>';
}

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

        url : "{{ url('/Transaction/Purchase/Purchase-Quo-Comparision-View') }}"

       },
       searching : true,
    

       columns: [

          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.VRNO+',\''+full.PQCSHID+'\','+full.DT_RowIndex+')"><i class="fa fa-plus" id="minus'+full.DT_RowIndex+'" title="Edit"></i></button>'
          }
         },
        
      
          { 
            render: function (data, type, full, meta){
                     
              var fy_code = full['FY_CODE'].split('-');
                        
              var VRNO = fy_code[0]+' '+full['COMP_CODE']+' '+full['PQCSHID'];
                      
              return VRNO;
             
            } 
          },
         {
                    data:'VRDATE',
                    className:'datebill',
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
          {  
            render: function (data, type, full, meta){

                   
                      var plant_cd = '<p>'+full['PLANT_CODE']+'</p>';
                    

                      return plant_cd;         

            }
        

        },
        
        {  
            render: function (data, type, full, meta){

              var pfct_cd = '<p>'+full['PFCT_CODE']+'</p>';
            

              return pfct_cd;

            }
        
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

    function showchildtable(vrno,tblid,srnoRow){
            var vrno,tblid,srnoRow;

             $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });

             $("#minus"+srnoRow).toggleClass('fa-plus fa-minus rotate');

             $.ajax({

              url:"{{ url('view-purchase-comparision-chield-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {vrno:vrno,tblid:tblid},

               success:function(data){

                  var data1 = JSON.parse(data);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                         var objrow = data1.data;
                         var srNo=1;
                         var tableid = objrow[0].PQCSHID;


                        $.each(objrow, function (i, objrow) {

                          $('#childData_'+tableid).append('<tr><td class="text-center removeextraSInC">'+srNo+'</td><td class="removeextraSInC">'+objrow.ACC_CODE+'</td><td class="text-right removeextraSInC">'+objrow.ACC_NAME+'</td><td class="text-right removeextraSInC">'+objrow.ITEM_CODE+'</td>'+objrow.ITEM_NAME+'<td class="text-right">'+objrow.ITEM_NAME+'</td><td>'+objrow.PARTICULAR+'</td><td>'+objrow.QTYRECD+'</td><td>'+objrow.UM+'</td><td>'+objrow.AQTYRECD+'</td><td>'+objrow.AUM+'</td><td>'+objrow.RATE+'</td><td>'+objrow.BASICAMT+'</td><td>'+objrow.TAX_CODE+'</td><td>'+objrow.CRAMT+'</td><td><span style="color:red;">'+objrow.LEVEL+'</span></td></tr>');
                            
                            srNo++;

                        });

                      }
                      
                  }
               }

          });
    }

</script>


@endsection



