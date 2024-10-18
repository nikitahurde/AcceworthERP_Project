@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



@include('admin.include.sidebar')





<style type="text/css">

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
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
  }
  .columnhide{
  display:none;}

  .chieldtblecls>tbody>tr>td {
    line-height: 2.5;
  }

  .tabTable > table > tbody > tr > th{
    border:1px solid grey !important;
    background-color: #b6d2f0;
    padding:5px;
  }
  .tabTable > table > tbody > tr > td{
    border:1px solid grey !important;
    padding:5px;
  }
  .tabtask{
   padding: 6px !important; 
   font-weight:700;
  }

  .modal-header .close {
    margin-top: -32px;
  }

  .alignLeftClass{



    text-align: left;



  }



  .alignRightClass{



    text-align: right;



  }



  .alignCenterClass{



    text-align: center;



  }
  
   


  .tabs {
     display: flex;
     flex-wrap: wrap;
     /*max-width: 700px;*/
     background: #efefef;
     box-shadow: 0 48px 80px -32px rgba(0, 0, 0, 0.25);
}

.input {
     position: absolute;
     opacity: 0;
}

/*.label {
     width: 100%;
    padding: 9px 30px;
    background: #e5e5e5;
    cursor: pointer;
    font-weight: bold;
    font-size: 14px;
    color: #7f7f7f;
    transition: background 0.1s, color 0.1s;
}

.label:hover {
     background: #d8d8d8;
}

.label:active {
     background: #ccc;

}

.input:focus + .label {
     z-index: 1;
}

.input:checked + .label {
     background: #52a0ce;
     color: #000;
}*/
.actionBTN{
    font-size: 10px;
    padding: 0px 2px;
}

.panel {
     display: none;
     padding: 20px 30px 30px;
     background: #fff;
     width: 100%;
}

@media (min-width: 600px) {
     .label {
          width: auto;
     }

     .panel {
          order: 99;
     }
}

.input:checked + .label + .panel {
     display: block;

}



</style>













  <div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



            Master Account 



            <small>View Details</small>



          </h1>







          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/finance/view-party-finance-master')}}">Master Account</a></li>



            <li class="Active"><a href="{{ URL('/finance/view-party-finance-master')}}">View Account</a></li>



          </ol>



        </section>









        <!-- Main content -->

        <section class="content">



          <div class="row">



            <div class="col-xs-12">



              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">View Account</h3>



                  <div class="box-tools pull-right">



                    <a href="{{ url('/Master/Customer-Vendor/Account-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Account</a>



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

                        <!-- <th class="text-center">Sr.No</th> -->



                        <th class="text-center">Account Code</th>
                        <th class="text-center">Account Name</th>
                        <th class="text-center">Account Type</th>
                        <th class="text-center">Account Category</th>

                        <th class="text-center">Account Class</th>
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













<div class="modal fade" id="partyDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



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



          <form action="#" method="POST">



            @csrf



            <input type="hidden" name="partyId" id="partyId" value="">

            <input type="hidden" name="AssetViewLink" id="AssetViewLink" value="Master/Asset/View-Asset-Group">

            <input type="hidden" name="tblName" id="tblName" value="MASTER_ACC">
            <input type="hidden" name="tblName2" id="tblName2" value="MASTER_ACCADD">
            <input type="hidden" name="colName" id="colName" value="ACC_CODE">
            <input type="hidden" name="colNameTwo" id="colNameTwo" value="ACC_CODE">
            <input type="hidden" name="colNameThree" id="colNameThree" value="ATYPE_CODE">
            <input type="hidden" name="colNameFour" id="colNameFour" value="GL_CODE">

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

 function format(d) {
    uniqTblID = d.ACC_CODE;
    return '<div id="childData_'+uniqTblID+'" class="chieldTable">'+
            '<div class="nav-tabs-custom">'+
              '<ul class="nav nav-tabs" style="background-color: #ebe7db;height: 32px;">'+
                '<li class="active"><a href="#tab1_'+uniqTblID+'" class="tabtask" data-toggle="tab" aria-expanded="true">Basic Details</a></li>'+
                '<li class=""><a href="#tab2_'+uniqTblID+'" class="tabtask" data-toggle="tab" aria-expanded="false">Direct/Indirect Tax</a></li>'+
                '<li class=""><a href="#tab3_'+uniqTblID+'" class="tabtask" data-toggle="tab" aria-expanded="false">Address Details</a></li>'+
                '<li class=""><a href="#tab4_'+uniqTblID+'" class="tabtask" data-toggle="tab" aria-expanded="false">Bank Details</a></li>'+
              '</ul>'+

              '<div class="tab-content">'+

                  '<div class="tab-pane active tabTable" id="tab1_'+uniqTblID+'">'+
                    '<table class="table-border" style="width: 100%;">'+
                      '<tr id="tabOne'+uniqTblID+'">'+
                        '<th>Acc Code</th>'+
                        '<th>Acc Name</th>'+
                        '<th>Acc Type Code</th>'+
                        '<th>Acc Category Code</th>'+
                        '<th>Acc Class Code</th>'+
                      '</tr>'+

                    '</table>'+
                  '</div>'+

                  '<div class="tab-pane tabTable" id="tab2_'+uniqTblID+'">'+
                   '<table class="table-border" style="width: 100%;">'+
                      '<tr id="tabTwo'+uniqTblID+'">'+
                        '<th>TAX Code</th>'+
                        '<th>TDS Code</th>'+
                        '<th>TAN No</th>'+
                        '<th>TIN No</th>'+
                        '<th>Sale Tax No</th>'+
                        '<th>CSale Tax No</th>'+
                        '<th>Service Tax No</th>'+
                        '<th>Pan No</th>'+
                      '</tr>'+
                    '</table>'+
                  '</div>'+

                  '<div class="tab-pane tabTable" id="tab3_'+uniqTblID+'">'+
                    '<table class="table-border" style="width: 100%;">'+
                      '<tr  id="tabThree'+uniqTblID+'">'+
                        '<th>Address</th>'+
                        '<th>Contact Person</th>'+
                        '<th>City</th>'+
                        '<th>Pin Code</th>'+
                        '<th>District</th>'+
                        '<th>State</th>'+
                        '<th>Email</th>'+
                        '<th>Phone No</th>'+
                      '</tr>'+
                    '</table>'+
                  '</div>'+

                  '<div class="tab-pane tabTable" id="tab4_'+uniqTblID+'">'+
                    '<table class="table-border" style="width: 100%;">'+
                      '<tr  id="tabFour'+uniqTblID+'">'+
                        '<th>Bank Name</th>'+
                        '<th>Account Number</th>'+
                        '<th>Branch</th>'+
                        '<th>IFSC Code</th>'+
                        '<th>Address</th>'+
                      '</tr>'+
                    '</table>'+
                  '</div>'+
                
              '</div>'+
            '</div>'+
          '</div>';

  }
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
          serverSide: false,
          info: true,
          /*bPaginate: false,
          scrollY: 500,
          scrollX: true,
          scroller: true,*/
          scrollX:true,
          paging: true,
          fixedHeader: true,
          "pageLength": 25,
          language: {
              processing: "<img style='width:30px;' src='<?php echo url('public/dist/img/loading_gif.gif') ?>'>"
          },
          //order: [[2, 'asc'],[3, 'asc']],
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          //dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'><'col-sm-3'i><'col-sm-6'>>",
          buttons:  [
                    {
                      extend: 'excelHtml5',
                      exportOptions: {
                                columns: [1,2,3,4,5]
                          },
                      title: ' MASTER ACCOUNT '+$("#headerexcelDt").val(),
                      filename: 'MASTER_ACCOUNT_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/Master/Customer-Vendor/View-Account-Mast') }}"

       },
       searching : true,
    

       columns: [
        
         { data:"ACC_CODE",className:'details-control',
            render: function(data, type, full, meta) {
             return '<button class="actionBTN" id="showchildtable" onclick="plusBtnClick('+full['DT_RowIndex']+')"><i class="fa fa-plus" id="minus'+full.DT_RowIndex+'" title="Toggle"></i></button><input type="hidden" value='+full['ACC_CODE']+' class="accCode_'+full['DT_RowIndex']+'">';
          }
         },
         // { data:"DT_RowIndex",className:"text-center"},
         { data:"ACC_CODE",className:"text-left"},
         { data:"ACC_NAME",className:"text-left"},
          // { render: function (data, type, full, meta){
             
          //    var accCode  = full['ACC_CODE'];
          //    var accName  = full['ACC_NAME'];
            

          //    var accCodeName = accName+' ['+accCode+' ]';

          //    return  accCodeName;


          //   }
          // },
         { 
           render: function (data, type, full, meta){

            var atype_code = full['ATYPE_CODE'];
            var atype_name = full['ATYPE_NAME'];
            return atype_code+' - '+atype_name;

          }
         },
         { 
           render: function (data, type, full, meta){

            var acate_code = '';
            var acate_name = '';

            if(full['ACATG_CODE'] != null && full['ACATG_CODE'] != '' ){
              acate_code = full['ACATG_CODE'];
            }else{
              acate_code ='';
            }

            if(full['ACATG_NAME'] != null && full['ACATG_NAME'] != '' ){
              acate_name = full['ACATG_NAME'];
            }else{
              acate_name ='';
            }
            if(acate_code != '' && acate_name != ''){
               return acate_code+' - '+acate_name;
             }else{
               return '';
             }
           

           }
         },
         { render: function (data, type, full, meta){

            var aclass_code = '';
            var aclass_name = '';

            if(full['ACLASS_CODE'] != null && full['ACLASS_CODE'] != '' ){
              aclass_code = full['ACLASS_CODE'];
            }else{
              aclass_code ='';
            }

            if(full['ACLASS_NAME'] != null && full['ACLASS_NAME'] != '' ){
              aclass_name = full['ACLASS_NAME'];
            }else{
              aclass_name ='';
            }
            if(aclass_code != '' && aclass_name != ''){
               return aclass_code+' - '+aclass_name;
             }else{
               return '';
             }
           }
         },

         { 
            render: function (data, type, full, meta){


              if(full['ACC_BLOCK']=='NO'){
                  return '<span class="label label-success">Active</span>';
              }else if(full['ACC_BLOCK']=='YES'){

                return '<span class="label label-danger">Inactive</span>';
              }else{

                return '<span class="label label-danger">Not Found</span>';
              }
                         

            },className:"text-center"
          },
         
         {  
            render: function (data, type, full, meta){
                    
                      var enableBtn = 'enable';
                      var deletebtn ='<a href="Edit-Account-Mast/'+btoa(full['ACC_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getId(\''+full['ACC_CODE']+'\','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                     

                      return deletebtn;

                     },className:"text-center"
        

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

function plusBtnClick(getId){
  
   var acc_code = $('.accCode_'+getId).val();
   console.log('acc_code', acc_code);

    $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

    $("#minus"+getId).toggleClass('fa-plus fa-minus rotate');

    $.ajax({

              url:"{{ url('view-party-finance-chield-data') }}",

               method : "POST",

               type: "JSON",

               data: {acc_code: acc_code},

               success:function(data){


                  var data1 = JSON.parse(data);
                 
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                  }
                  else if(data1.response == 'success'){

                      if(data1.data==''){
                      
                        
                       
                      }else{
                       
                        var srNo=1;
                        var tableid = data1.data[0].ACC_CODE;
                        var flag='master_acc';

                        var acc_code = (data1.data[0].ACC_CODE != null) ? data1.data[0].ACC_CODE : '---';
                        var acc_name = (data1.data[0].ACC_NAME != null) ? data1.data[0].ACC_NAME : '---';
                        var acctype_code = (data1.data[0].  ATYPE_CODE != null) ? data1.data[0].  ATYPE_CODE : '---';
                        var acccategory_code = (data1.data[0].ACATG_CODE != null) ? data1.data[0].ACATG_CODE : '---';
                        var accclass_code = (data1.data[0].ACLASS_CODE != null) ? data1.data[0].ACLASS_CODE : '---';
                        
                        var deletebtn1 ='<a href="edit-master_party/'+flag+'/'+btoa(tableid)+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return empDelete('+tableid+');" disabled><i class="fa fa-trash" title="Delete"></i></button>';

                        
                        // $('#basicData_'+tableid).empty();

                        // $('#basicData_'+tableid ).append('<thead style="border: 2px solid #c1c1c1;"><tr><th>Acc Code</th><th>Acc Name</th><th>Acc Type Code</th><th>Acc Category Code</th><th>Acc Class Code</th></tr></thead><tbody><tr><td class="">'+acc_code+'</td><td>'+acc_name+'</td><td>'+acctype_code+'</td><td class="text-right">'+acccategory_code+'</td><td class="text-right">'+accclass_code+'</td></tr></tbody>');

                        $('#tabOne'+tableid).after('<tr><td>'+acc_code+'</td><td>'+acc_name+'</td><td>'+acctype_code+'</td><td>'+acccategory_code+'</td><td>'+accclass_code+'</td></tr>');

                        var tax_code = (data1.data[0].TAX_CODE != null) ? data1.data[0].TAX_CODE : '---';

                        var tds_code = (data1.data[0].TDS_CODE != null ) ? data1.data[0].TDS_CODE : '---';

                        var tinno = (data1.data[0].TIN_NO != null) ? data1.data[0].TIN_NO : '---';
                        var tan_no = (data1.data[0].TAN_NO != null) ? data1.data[0].TAN_NO : '---';
                        var sales_taxno = (data1.data[0].SALES_TAXNO != null) ? data1.data[0].SALES_TAXNO : '---';
                        var csales_taxno = (data1.data[0].CSALES_TEXNO != null) ? data1.data[0].CSALES_TEXNO : '---';
                        var service_taxno = (data1.data[0].SERVICE_TAXNO != null) ? data1.data[0].SERVICE_TAXNO : '---';
                        var panno = (data1.data[0].PAN_NO != null) ? data1.data[0].PAN_NO : '---';

                        // $('#taxData_'+tableid ).append('<thead style="border: 2px solid #c1c1c1;"><tr><th>TAX Code:</th><th>TDS Code</th><th>TAN No</th><th>TIN No</th><th>Sale Tax No</th><th>CSale Tax No</th><th>Service Tax No</th><th>Pan No</th></tr></thead><tbody><tr><td class="text-right">'+tax_code+'</td><td class="text-right">'+tds_code+'</td><td class="text-right">'+tan_no+'</td><td class="text-right">'+tinno+'</td><td class="text-right">'+sales_taxno+'</td><td class="text-right">'+csales_taxno+'</td><td class="text-right">'+service_taxno+'</td><td>'+panno+'</td></tr></tbody>');

                        $('#tabTwo'+tableid).after('<tr><td>'+tax_code+'</td><td>'+tds_code+'</td><td>'+tan_no+'</td><td>'+tinno+'</td><td>'+sales_taxno+'</td><td>'+csales_taxno+'</td><td>'+service_taxno+'</td><td>'+panno+'</td></tr>');

                        
                        // $('#addressData_'+tableid).append('<thead style="border: 2px solid #c1c1c1;"><tr><th>Address</th><th>Contact Person</th><th>City</th><th>Pin Code</th><th>District</th><th>State</th><th>Email</th><th>Phone No</th></tr></thead>');

                        var srNo = 0;

                        $.each( data1.data, function(k, getData){

                           
                           var adds=getData.addAddress;
                           var acc_code = (getData.accCode !=  undefined || null ) ? getData.accCode : '---';
                           var addInfo = (getData.addAddress !=  undefined || null ) ? getData.addAddress : '---';
                           var contactPerson = (getData.contactPerson !=  undefined || null ) ? getData.contactPerson : '---';
                           var addCity = (getData.addCity !=  undefined || null ) ? getData.addCity : '---';
                           var addPin = (getData.addPin !=  undefined || null ) ? getData.addPin : '---';
                           var addDistrict = (getData.addDistrict !=  undefined || null ) ? getData.addDistrict : '---';
                           var addState = (getData.addState !=  undefined || null ) ? getData.addState : '---';
                           var addEmail = (getData.addEmail !=  undefined || null ) ? getData.addEmail : '---';
                           var addPhone = (getData.addPhone !=  undefined || null ) ? getData.addPhone : '---';

                          $('#tabThree'+acc_code).after('<tr><td>'+addInfo+'</td><td>'+contactPerson+'</td><td>'+addCity+'</td><td class="text-right">'+addPin+'</td><td>'+addDistrict+'</td><td>'+addState+'</td><td>'+addEmail+'</td><td class="text-right">'+addPhone+'</td></tr>');


                           // $('#tabThree'+tabId).after('<tr><td>'+data1.data.ECC_NO+'</td><td>'+data1.data.RANGE_NO+'</td><td>'+data1.data.RANGE_NAME+'</td><td>'+data1.data.RANGE_ADD1+'</td><td>'+data1.data.RANGE_ADD2+'</td><td>'+data1.data.DIVISION+'</td><td>'+data1.data.COLLECTOR+'</td></tr>');


                            srNo++;

                        });

                        var acc_number = (data1.data[0].ACC_NUMBER != null) ? data1.data[0].ACC_NUMBER : '---';
                        var bank_name = (data1.data[0].BANK_NAME != null) ? data1.data[0].BANK_NAME : '---';
                        var branch_name = (data1.data[0].BRANCH_NAME != null) ? data1.data[0].BRANCH_NAME : '---';
                        var bank_address = (data1.data[0].BANK_ADDRESS != null) ? data1.data[0].BANK_ADDRESS : '---';
                        var ifsc_code = (data1.data[0].IFSC_CODE != null) ? data1.data[0].IFSC_CODE : '---';
                       
                        $('#tabFour'+tableid ).after('<tr><td>'+bank_name+'</td><td class="text-right">'+acc_number+'</td><td>'+branch_name+'</td><td>'+ifsc_code+'</td><td>'+bank_address+'</td></tr>');


                      }
                    }
              }
          });

 
 }
</script>



<script type="text/javascript">

function funDelData(){

 var AssetCode  = $("#partyId").val();
 var del_remark = $("#del_remark").val();
 var tblName    = $("#tblName").val();
 var tblName2   = $("#tblName2").val();
 var colName1   = $("#colName").val();
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
    
    data: {AssetCode: AssetCode,del_remark:del_remark,tblName:tblName,tblName2:tblName2,colName1:colName1,colName2:colName2,colName3:colName3,colName4:colName4,colName5:colName5,colName6:colName6,AssetViewLink:AssetViewLink},
    
    success:function(data){

     var data1 = JSON.parse(data);

    console.log('data1.response',data1.response);
     
     if(data1.response =='success'){

       // $('#costTypeDelete').modal('hide');
       // $('#del_remark').val('');

       location.reload();
     }else{
      console.log('else');
     }

    }
  
});

}

  function getId(id,rowId)
  {
    $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea></div></div>');

    $("#partyDelete").modal('show');


    $("#partyId").val(id);

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















