@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style>
  .modal-header .close {
    margin-top: -32px;
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
  .actionBtn{
    font-size: 10px;
    padding: 0px 2px;
  }
</style>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1> Master Company  <small>View Details</small></h1>

      <ol class="breadcrumb">

        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ url('/dashboard') }}">Master</a></li>

        <li class="active"><a href="{{ url('/view-mast-company') }}">Master Company</a></li>

        <li class="active"><a href="{{ url('/view-mast-company') }}">View  Company</a></li>

      </ol>

    </section>

    <!-- Main content -->

    <section class="content">

      <div class="row">

        <div class="col-xs-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h3 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">View Comapny</h3>

              <div class="box-tools pull-right">

                <a href="{{ url('/Master/Setting/Company-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Company</a>

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

                    <th class="text-center">Company Code</th>
                    <th class="text-center">Company Name</th>

                    <th class="text-center">Address  </th>

                    <th class="text-center">Contact No </th>

                    <!-- <th class="text-center">Fax No </th> -->

                    <th class="text-center">Email Id</th>

                   

                    <th class="text-center">Logo</th>

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

  <div class="modal fade" id="comapnyDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

        <div class="modal-footer">

          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">cancel</button>

          <form action="#" method="post">

            @csrf

            <input type="hidden" name="CompanyID" id="CompanyID" value="">

			<input type="hidden" name="AssetViewLink" id="AssetViewLink" value="Master/Asset/View-Asset-Group">
			
			<input type="hidden" name="tblName" id="tblName" value="MASTER_COMP">
			<input type="hidden" name="tblName2" id="tblName2" value="">
			<input type="hidden" name="colName" id="colName" value="COMP_CODE">
			<input type="hidden" name="colNameTwo" id="colNameTwo" value="COMP_NAME">
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
                            columns: [0,1,2,3,4,5,6]
                      },
                      title: ' MASTER COMPANY'+$("#headerexcelDt").val(),
                      filename: 'MASTER_COMPANY_'+$("#headerexcelDt").val(),
                    }
                  ],
      ajax:{

        url : "{{ url('/Master/Setting/View-Company-Mast') }}"

      },
      searching : true,
    
      columns: [
        
           { data:"COMP_CODE"},
           { 
            render: function (data, type, full, meta) {
              var comp_name = full['COMP_NAME'];

             var compName = 'display' && comp_name.length > 11 ? comp_name.substr(0, 11) + '…' : comp_name;
             return '<span data-tip="'+comp_name+'">'+ compName+'</span> ';
            
            }
           },
           { 
            render: function (data, type, full, meta) {
              if(full['ADD1']==null){
                var add1='';
              }else{
                var add1=full['ADD1'];
              }

              if(full['ADD2']==null){
                var add2='';
              }else{
                var add2=full['ADD2'];
              }
              if(full['ADD3']==null){
                var add3='';
              }else{
                var add3=full['ADD3'];
              }
              var address = add1;
              var fulladdress =  add1 + "&nbsp;" + add2 +"&nbsp;"+add3+"&nbsp;"+full['DIST_CODE']+"&nbsp;"+full['CITY_CODE']+"&nbsp;"+full['STATE_CODE']+"&nbsp;"+full['PIN_CODE']+"&nbsp;"+full['COUNTRY_CODE'];
              return '<span data-tip="'+fulladdress+'">'+ address+'</span> ';
              // return fulladdress;
            }
          },
           { 
            render: function (data, type, full, meta) {

              var phoneNo2 = full['PHONE2'];
              var phoneNo1 = full['PHONE1'];
              if(phoneNo1 != '' && phoneNo2 != '' && phoneNo2 != null){
                return phoneNo1+' / '+phoneNo2;
              }else{
                return full['PHONE1'];
              }
              
            },className:"text-right"
          },
           { data:"EMAIL_ID"},
          {  
            render: function (data, type, full, meta){

              var url =    "{{ URL::asset('public/dist/img') }}";

              if(full['LOGO']){
                return "<img src='"+url+'/'+full['LOGO']+"' style='height:50px;width:50px;'>";
              }else{
                  return '';
              }

            },className:"text-center"

          },
           { 
            render: function (data, type, full, meta){

              if(full['BLOCK_COMP']=='NO'){
                  return '<span class="label label-success">Active</span>';
                }else if(full['BLOCK_COMP']=='YES'){

                  return '<span class="label label-danger">Inactive</span>';
                }else{

                  return '<span class="label label-danger">Not Found</span>';
                }

            },
            className:"text-center"
          },
          {  
            render: function (data, type, full, meta){
                  
              var disableBtn = 'disabled';
              var deletebtn ='<input type="hidden" id="deleteinput_'+full['COMP_CODE']+'" value="'+full['COMP_CODE']+'"><a href="Edit-Company-Mast/'+btoa(full['COMP_CODE'])+'" class="btn btn-warning btn-xs actionBtn" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBtn" data-toggle="modal" onclick="return getId(\''+full['COMP_CODE']+'\','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                     
              return deletebtn;
                        
            },className:"text-center"
    
          },
                 
      ],

    });

  });
</script>


<script type="text/javascript">

function funDelData(){

 var AssetCode  = $("#CompanyID").val();
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
     
     if(data1.response =='success'){

       // $('#costTypeDelete').modal('hide');
       // $('#del_remark').val('');
       location.reload();
     }else{

     }

    }
  
});

}

  function getId(id,rowId){

  	$('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea></div></div>');

    $("#comapnyDelete").modal('show');

    $("#CompanyID").val(id);

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


