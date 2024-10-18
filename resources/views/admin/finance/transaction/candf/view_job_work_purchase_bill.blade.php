@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')

<style>
  .text-right{
    text-align: right;
  }

  /* ---- custom table css ----- */

    .divTable{
      display: table;
      width: 100%;
    }
    .divTableRow {
      display: table-row;
    }
    .divTableCell {
      border: 1px solid #d4d4d4;
      display: table-cell;
      padding: 6px 8px;
      text-align: center;
      font-weight: bold;
      background-color: #f5deba;
    }
    .divTableBodyRow {
      border: 1px solid #d4d4d4;
      display: table-cell;
      padding: 3px 8px;
      text-align: center;
      font-size: 12px;
    }
    .divTableFoot {
      background-color: #EEE;
      display: table-footer-group;
      font-weight: bold;
    }
    .divTableBody {
      display: table-row-group;
    }
    .colmnOneCDT{
      width: 5%;
    }
    .colmnTwoCDT{
      width: 9%;
      text-align:left;
    }
    .colmnThreeCDT{
      width: 10%;
      text-align:left;
    }
    .colmnFourCDT{
      width: 13%;
      text-align:left;
    }
    .colmnFiveCDT{
      width: 10%;
      text-align:left;
    }

/* ---- custom table css ----- */
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            View Job Work Purchase Bill

           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

             <small><b>Purchase Transaction Details</b></small> 

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">Master Account</a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Mast Acc</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> View Job Work Purchase Bill</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/transaction/CandF/job-work-purchase-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Job Work Purchase Bill</a>

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

                     
                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">Vr No.</th>

                        <th class="text-center">Vr Date</th>

                        <th class="text-center">Acc Name</th>
                        <th class="text-center">Cp Name</th>
                        <th class="text-center">Series Name</th>
                        <th class="text-center">Plant Name</th>
                        <th class="text-center">Item Name</th>
                        <th class="text-center">Transporter Name</th>
                        
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

        <section class="content" style="margin-top: -4%;">

                <div class="row">

                  <div class="col-xs-12">

                    <div class="box box-primary Custom-Box">

                      <div class="box-body">

                        <div class="divTable">

                          <div class="divTableBody" id="chieldBodyDetails">
                            
                          </div><!-- /.divTableBody -->
                          
                        </div><!-- /.div table -->
                        
                      </div><!-- /.box-body -->
                      
                    </div><!-- /.Custom-Box -->
                    
                  </div><!-- /.col -->
                  
                </div><!-- /.row -->
    
          </section><!-- /.section -->

      </div>







 





@include('admin.include.footer')

<script type="text/javascript">

   function format ( d ) {
  //  console.log('d',d.id);
    // `d` is the original data object for the row
    return '<table border="0" class="table table-bordered table-striped table-hover" id="childData_'+d.PBILLHID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th>Sr. No.</th>'+
            '<th>Item Code</th>'+
            '<th>Item Name</th>'+
            '<th>Qty</th>'+
            '<th>A-Qty</th>'+
            '<th>Rate</th>'+
            '<th>Basic</th>'+
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
         'fnCreatedRow': function (nRow, aData, iDataIndex) {
                  
            $(nRow).attr('onclick', "showBodyDetail(\""+aData['PBILLHID']+"\")"); // or whatever you choose to set as the id
        },
       ajax:{

        url : "{{ url('/transaction/CandF/view-job-work-purchase-bill') }}"

       },
       searching : true,
    

       columns: [
        
         
         { data:"DT_RowIndex",className:"text-center"},
         {  
            render: function (data, type, full, meta){
                   
              var fy_code = full['FY_CODE'].split('-');

              var VRNO = fy_code[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];
                    
              return VRNO;
                         
            }  
          },
         { data: "VRDATE" ,
            className:"text-right",
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

                   
                      var series = full['ACC_NAME']+' - ('+full['ACC_CODE']+')'; 
                  
                      return series;


                         

                     }
        

       },
       {  
            render: function (data, type, full, meta){

                   
                      var cpname = full['CP_NAME']+' - ('+full['CP_CODE']+')'; 
                  
                      return cpname;


                         

                     }
        

       }, 
       {  
            render: function (data, type, full, meta){

                   
                      var series = full['SERIES_NAME']+' - ('+full['SERIES_CODE']+')'; 
                  
                      return series;


                         

                     }
        

       },
       {  
            render: function (data, type, full, meta){

                   
                      var plant_name = full['PLANT_NAME']+' - ('+full['PLANT_CODE']+')'; 
                  
                      return plant_name;


                         

                     }
        

       }, 

        {  
            render: function (data, type, full, meta){

                   
                      var item_name = full['JWITEM_NAME']+' - ('+full['JWITEM_CODE']+')'; 
                  
                      return item_name;


                         

                     }
        

       },  
         {  
            render: function (data, type, full, meta){

                   
                      var trpt_name = full['TRPT_NAME']+' - ('+full['TRPT_CODE']+')'; 
                  
                      return trpt_name;


                         

                     }
        

       },    
                  
         {  
            render: function (data, type, full, meta){

                      var enableBtn = 'enable';
                      var deletebtn ='<a class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                    

                      return deletebtn;


                         

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
    } );



});


   function showchildtable(tblid){
            var tblid;

             $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });

             $.ajax({

              url:"{{ url('transaction/CandF/view-job-work-purchase-bill-chield-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {tblid:tblid},

               success:function(data){

                  var data1 = JSON.parse(data);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                         var objrow = data1.data;
                         var srNo=1;
                         var tableid = objrow[0].PBILLHID;
                       $.each(objrow, function (i, objrow) {
                               $('#childData_'+tableid).append('<tr><td class="text-right">'+srNo+'</td><td>'+objrow.ITEM_CODE+'</td><td>'+objrow.ITEM_NAME+'</td><td class="text-right">'+objrow.QTYRECD+'</td><td class="text-right">'+objrow.AQTYRECD+'</td><td class="text-right">'+objrow.RATE+'</td><td class="text-right">'+objrow.BASICAMT+'</td></tr>');
                              srNo++;
                             });

                      }
                      
                  }
               }

          });
    }



    function showBodyDetail(headId){

      var fieldName = headId;

      var pageIndentity='JOB_WORK_PUR_BILL';

      $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

      });

      $.ajax({

          url:"{{ url('show-details-on-click-of-row-in-view-page') }}",

          method : "POST",

          type: "JSON",

          data: {fieldName:fieldName,pageIndentity:pageIndentity},

          success:function(data){

            var data1 = JSON.parse(data);
           
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
              }else if(data1.response == 'success'){

                  $('#chieldBodyDetails').empty();

                  var headData = "<div class='divTableRow'><div class='divTableCell'>Sr.No</div><div class='divTableCell'>VR DATE</div><div class='divTableCell'>Item Code</div><div class='divTableCell'>Item Name</div><div class='divTableCell'>QTY RECD</div><div class='divTableCell'>AQTY RECD</div><div class='divTableCell'>RATE</div><div class='divTableCell'>Basic Amt</div><div class='divTableCell'>Cr Amt</div></div>";

                    $('#chieldBodyDetails').append(headData);

                  if(data1.dataDetails==''){
                   
                  }else{

                    var slno=1,totlQty=0,totlRate=0,totlBasic=0,totlCrAmt=0,totlAQty=0;
                    $.each(data1.dataDetails, function(k, getData){
                      totlQty +=parseFloat(getData.QTYRECD);
                      totlRate +=parseFloat(getData.RATE);
                      totlBasic +=parseFloat(getData.BASICAMT);
                      totlCrAmt +=parseFloat(getData.CRAMT);
                      totlAQty +=parseFloat(getData.AQTYRECD);

                      var doDate     = getData.VRDATE;
                      var splitDt    = doDate.split('-');
                      var formDoDate = splitDt[2]+'-'+splitDt[1]+'-'+splitDt[0];
                      var bodyData ="<div class='divTableRow'><div class='divTableBodyRow colmnOneCDT'>"+slno+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT' style='text-align:left;'>"+formDoDate+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT'>"+getData.ITEM_CODE+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+getData.ITEM_NAME+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT' style='text-align:right;'>"+getData.QTYRECD+"</div>"+
                        "<div class='divTableBodyRow colmnFourCDT' style='text-align:right;'>"+getData.AQTYRECD+"</div>"+
                        "<div class='divTableBodyRow colmnFiveCDT' style='text-align:right;'>"+getData.RATE+"</div>"+
                        "<div class='divTableBodyRow colmnFiveCDT' style='text-align:right;'>"+getData.BASICAMT+"</div>"+
                        "<div class='divTableBodyRow colmnFiveCDT' style='text-align:right;'>"+getData.CRAMT+"</div></div>";

                      $('#chieldBodyDetails').append(bodyData);

                    slno++;});

                    var footerData = "<div class='divTableRow'><div class='divTableBodyRow'></div><div class='divTableBodyRow'></div><div class='divTableBodyRow'></div><div class='divTableBodyRow' style='text-align:right;'></div><div class='divTableCell' style='text-align:right;'>"+totlQty.toFixed(3)+"</div><div class='divTableCell' style='text-align:right;'>"+totlAQty.toFixed(3)+"</div><div class='divTableCell' style='text-align:right;'>"+totlRate.toFixed(2)+"</div><div class='divTableCell' style='text-align:right;'>"+totlBasic.toFixed(2)+"</div><div class='divTableCell' style='text-align:right;'>"+totlCrAmt.toFixed(2)+"</div></div>";

                    $('#chieldBodyDetails').append(footerData);
                    
                  } /* /. CHECK DATA*/

              }/* /. RESPONSE CHECK*/

          }/* /. SUCCESS FUNCTION*/

      });/* /. AJAX FUCNTION*/

  }

    function downloadPDF(uniqNo,headId,vrno,tCode){
      var uniqNo,headId,vrno,tCode;
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

        url:"{{ url('pdf-donwload-when-view-sales-pages') }}",

        method : "POST",

        type: "JSON",

        data: {uniqNo: uniqNo,headId:headId,vrno:vrno,tCode:tCode},

        success:function(data){

          var data1 = JSON.parse(data);
          console.log('data1',data1);
          var fyYear = data1.data[0].FY_CODE;
          var fyCd = fyYear.split('-');
          var seriesCd = data1.data[0].SERIES_CODE;
          var vrNo = data1.data[0].VRNO;
          var fileN = 'SBILL_'+fyCd[0]+''+seriesCd+''+vrNo;
          var link = document.createElement('a');
          link.href = data1.url;
          link.download = fileN+'.pdf';
          link.dispatchEvent(new MouseEvent('click'));
        }

      });
    }
</script>

<script type="text/javascript">
  function dealerDelete(id) {

    $("#dealerDelete").modal('show');

    $("#DealerID").val(id);
  }
  
</script>


@endsection



