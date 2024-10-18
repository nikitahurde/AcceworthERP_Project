@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')

<style type="text/css">
  .bg-yellow, .callout.callout-warning, .alert-warning, .label-warning, .modal-warning .modal-body {
    background-color: #ce830c !important;
}
</style>
  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
            Purchase Order Transaction
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>Purchase Order Transaction Details</b></small>

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

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Purchase Order Trans</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/finance/transaction/purchase-order-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Purchase Order Trans</a>

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

                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">Vr No</th>
                        
                        <th class="text-center">Vr Date</th>

                        <th class="text-center">Acc Name</th>

                        <th class="text-center">Series Name</th>

                        <th class="text-center">Plant Name</th>

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


 <div class="modal fade" id="orderDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-header">





        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>





        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>



      <div class="modal-body">



      You Want To Delete This Purchase Order Data...!



      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>



          <form action="{{ url('/finance/delete-purchase-body-order') }}" method="post">



            @csrf



            <input type="hidden" name="bodyID" id="bodyID" value="">



            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">



          </form>



      </div>



    </div>



  </div>



</div>

@include('admin.include.footer')

<script type="text/javascript">

    function format(d) {
      //  console.log('d',d.id);
        // `d` is the original data object for the row
        return '<table border="0" class="table table-bordered table-striped table-hover" id="childData_'+d.id+'" style="padding-left:50px;">'+
            '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
                '<th>Sr. No.</th>'+
                '<th>Item Name</th>'+
                '<th>Qty</th>'+
                '<th>A-Qty</th>'+
                '<th>Rate</th>'+
                '<th>Basic</th>'+
                '<th>Approve Remark</th>'+
                '<th>Approve Status</th>'+
                '<th style="width:10%;">Action</th>'+
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

        url : "{{ url('/finance/transaction/view-purchase-order-transaction') }}"

       },
       searching : true,
    

       columns: [
        
         { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.vr_no+','+full.id+')"><i class="fa fa-plus" title="Edit"></i></button>'
            }
         },
         { data:"DT_RowIndex",className:"text-center"},
         { data: "vr_no" },
         {
                    data:'vr_date',
                    className:'text-right',
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

                   
                      var series = '<p>'+full['acc_name']+'</p>'+'<p style="line-height:2px;">('+full['acc_code']+')</p>';
                    

                      return series;


                         

                     }
        

       },
         {  
            render: function (data, type, full, meta){

                   
                      var series = '<p>'+full['series_name']+'</p>'+'<p style="line-height:2px;">('+full['series_code']+')</p>';
                    

                      return series;


                         

                     }
        

       },
         {  
            render: function (data, type, full, meta){

                   
                      var series = '<p>'+full['plant_name']+'</p>'+'<p style="line-height:2px;">('+full['plant_code']+')</p>';
                    

                      return series;


                         

                     }
        

       },
         {  
            render: function (data, type, full, meta){

                    var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

                   
                      var enableBtn = 'enable';
                      var deletebtn ='<a href="edit-dealer/'+Base64.encode(full['id'])+'/'+Base64.encode(enableBtn)+'" class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dealerDelete('+full['id']+');" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                      console.log(full['flag']);

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


function showchildtable(vrno,tblid){
            var vrno,tblid;

            //alert(tblid);

             $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });

             $.ajax({

              url:"{{ url('view-purchase-order-chield-row-data') }}",

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
                         var tableid = objrow[0].purchase_order_head_id;

                      
                       $.each(objrow, function (i, objrow) {

                         console.log(objrow);

                        if(objrow.approve_remark==null || objrow.approve_remark==''){

                        var approval_btn1 ='<small class="label label-danger"><i class="fa fa-times"></i> No Remark</small>';
                      }else{

                        var approval_btn1 =objrow.approve_remark;
                      }

                        if(objrow.flag=='1'){

                        var approval_btn ='<small class="label label-success"><i class="fa fa-check"></i> Approve</small>';
                      }else if(objrow.flag=='0'){

                        var approval_btn ='<small class="label label-warning"><i class="fa fa-clock-o"></i> Pending</small>';
                      }else{

                        var approval_btn ='<small class="label label-danger"><i class="fa fa-ban"></i> Rejected</small>';
                      }

                      if(objrow.flag=='1'|| objrow.flag=='0'){
                      
                      var enableBtn = 'enable';
                      var deletebtn ='<a class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" disabled><i class="fa fa-trash" title="Delete"></i></button>';

                    }else{

                        var enableBtn = 'enable';
                      var deletebtn ='<a href="edit-purchase-order/'+btoa(objrow.purchase_order_head_id)+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return porderDelete('+objrow.id+');"><i class="fa fa-trash" title="Delete"></i></button>';
                    }
 
                             // console.log(objrow.item_code);

                               $('#childData_'+tableid).append('<tr><td class="text-right">'+srNo+'</td><td>'+objrow.item_name+' <p>( '+objrow.item_code+')</p></td><td class="text-right">'+objrow.quantity+'</td><td class="text-right">'+objrow.Aquantity+'</td><td class="text-right">'+objrow.rate+'</td><td class="text-right">'+objrow.basic_amt+'</td><td class="text-right">'+approval_btn1+'</td><td class="text-right">'+approval_btn+'</td><td class="text-right">'+deletebtn+'</td></tr>');
                              srNo++;
                             });

                      }
                      
                  }
               }

          });
    }
</script>

<script type="text/javascript">
  function porderDelete(id) {

    $("#orderDelete").modal('show');

    $("#bodyID").val(id);
  }
  
</script>


@endsection



