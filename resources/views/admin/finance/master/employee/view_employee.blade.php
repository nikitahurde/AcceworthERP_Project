@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')

<style>
  .chieldtblecls tr td{
    border: 1px solid #ccc4c4 !important;
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
  }


  .tabs {
     display: flex;
     flex-wrap: wrap;
     /*max-width: 700px;*/
     background: #efefef;
     box-shadow: 0 48px 80px -32px rgba(0, 0, 0, 0.25);
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
.input {
     position: absolute;
     opacity: 0;
}

.label {
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
}

.panel {
     display: none;
     padding: 20px 30px 30px;
     background: #fff;
     width: 100%;
}
.modal-header .close {
    margin-top: -32px;
}
.actionBTN{
    font-size: 10px;
    padding: 0px 2px;
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
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
            Master Employee
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>View  Details</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">Master Employee</a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Employee</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Employee</h3>

                  <div class="box-tools pull-right">

                  <a href="{{ url('/Master/Employee/Add-Employee') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Employee</a>

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

                @if(Session::has('alert-success-family'))
                
                 <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                  <h4>

                    <i class="icon fa fa-check"></i>

                    Success...!

                  </h4>

                   {!! session('alert-success-family') !!}

                 </div>

                @endif

                @if(Session::has('alert-error-family'))
                  
                  <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                    <h4>

                      <i class="icon fa fa-ban"></i>

                      Error...!

                    </h4>

                    {!! session('alert-error-family') !!}

                  </div>

                @endif

                <div class="box-body">

                  <table id="example" class="table table-bordered table-striped table-hover">

                    <thead>

                      <tr>

                        <th class="text-center">#</th>

                        <!-- <th class="text-center">Sr.No</th> -->

                        <th class="text-center">Employee Code</th>
                        
                        <th class="text-center">Employee Name</th>

                        <th class="text-center">DOB</th>

                        <th class="text-center">Gender</th>

                        <th class="text-center">Email</th>

                        <th class="text-center">Mobile</th>

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







 <div class="modal fade" id="empDataDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

 <div class="modal-dialog modal-sm" role="document">


    <div class="modal-content">



      <div class="modal-header">



        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>




        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>







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

          <input type="hidden" name="delempcode" id="delempcode" value="">
          
          <input type="hidden" name="AssetViewLink" id="AssetViewLink" value="Master/Employee/View-Employee-Mast">
          
          <input type="hidden" name="tblName" id="tblName" value="MASTER_EMP">
          <input type="hidden" name="tblName2" id="tblName2" value="MASTER_EMPFAMILY">
          <input type="hidden" name="tblName3" id="tblName3" value="MASTER_EMPCAREER">
          <input type="hidden" name="tblName4" id="tblName4" value="MASTER_EMPEDU">
          
          <input type="hidden" name="colName" id="colName" value="EMP_CODE">
          <input type="hidden" name="colNameTwo" id="colNameTwo" value="EMP_NAME">
          <input type="hidden" name="colNameThree" id="colNameThree" value="DOB">
          <input type="hidden" name="colNameFour" id="colNameFour" value="EMAIL">
          
          <input type="hidden" name="colNameFive" id="colNameFive" value="CONTACT_NO">
          
          <input type="hidden" name="colNameSix" id="colNameSix" value="ADHAR_NO">
          
          <input type="button" value="Delete" id="del_data" style="margin-top: -12%;" class="btn btn-sm btn-danger" disabled="" onclick="funDelData()">




          </form>



      </div>




    </div>



  </div>




</div>





@include('admin.include.footer')

<script type="text/javascript">

   // function format ( d ) {
  

//     return '<div class="tabs"><input name="tabs" type="radio" id="tab-1" checked="checked" class="input"/><label for="tab-1" class="label">Employee Details</label><div class="panel"><input type="hidden" value='+d.EMP_CODE+' id="empcode"><table border="0" class="table table-bordered table-striped table-hover chieldtblecls"   style="padding-left:50px;" id="empData_'+d.EMP_CODE+'">'+
        
//     '</table></div>'+
//      '<input name="tabs" type="radio" id="tab-2" class="input" onclick="secondchild()" /><label for="tab-2" class="label">Family Details</label><div class="panel"><input type="hidden" value='+d.EMP_CODE+' id="empfcode"><table border="0" class="table table-bordered table-striped table-hover chieldtblecls col-md-12" id="familyData_'+d.EMP_CODE+'" style="padding-left:50px;"></table></div><input name="tabs" type="radio" id="tab-3" class="input" onclick="thirdchild()" /><label for="tab-3" class="label">Career Details</label><div class="panel"><table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="careerData_'+d.EMP_CODE+'" style="padding-left:50px;"><input type="hidden" value='+d.EMP_CODE+' id="empcarcode"></table></div>'+
//        '<input name="tabs" type="radio" id="tab-4" class="input" onclick="fourthchild()" /><label for="tab-4" class="label">Education Details</label><div class="panel"><input type="hidden" value='+d.EMP_CODE+' id="educationcode"><table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="educationData_'+d.EMP_CODE+'" style="padding-left:50px;"></table></div>'
       
//      '</div>';
// }

function format(d) {
    uniqTblID = d.EMP_CODE;
    return '<div id="childData_'+uniqTblID+'" class="chieldTable">'+
            '<div class="nav-tabs-custom">'+
              '<ul class="nav nav-tabs" style="background-color: #ebe7db;height: 32px;">'+
                '<li class="active"><a href="#tab1_'+uniqTblID+'" class="tabtask" data-toggle="tab" aria-expanded="true">Employee Details</a></li>'+
                '<li class=""><a href="#tab2_'+uniqTblID+'" class="tabtask" data-toggle="tab" aria-expanded="false">Family Details</a></li>'+
                '<li class=""><a href="#tab3_'+uniqTblID+'" class="tabtask" data-toggle="tab" aria-expanded="false">Career Details</a></li>'+
                '<li class=""><a href="#tab4_'+uniqTblID+'" class="tabtask" data-toggle="tab" aria-expanded="false">Education Details</a></li>'+
              '</ul>'+

              '<div class="tab-content">'+

                  '<div class="tab-pane active tabTable" id="tab1_'+uniqTblID+'">'+
                    '<table class="table-border" style="width: 100%;">'+
                      '<tr id="tabOne'+uniqTblID+'">'+
                        // '<th>Sr No.</th>'+
                        '<th>Emp Name</th>'+
                        '<th>Email</th>'+
                        '<th>Mobile</th>'+
                        '<th>Account No</th>'+
                        '<th>DOJ</th>'+
                        '<th>Designation</th>'+
                        '<th>Department</th>'+
                        '<th>Present Address</th>'+
                        '<th>Aadhar Card</th>'+
                      '</tr>'+

                    '</table>'+
                  '</div>'+

                  '<div class="tab-pane tabTable" id="tab2_'+uniqTblID+'">'+
                   '<table class="table-border" style="width: 100%;">'+
                      '<tr id="tabTwo'+uniqTblID+'">'+
                        // '<th>Sr. No.</th>'+
                        '<th>Relative Name</th>'+
                        '<th>Relative DOB</th>'+
                        '<th>Relative Relation</th>'+
                        '<th>Gender</th>'+
                        '<th>Email</th>'+
                        '<th>Mobile</th>'+
                      '</tr>'+
                    '</table>'+
                  '</div>'+

                  '<div class="tab-pane tabTable" id="tab3_'+uniqTblID+'">'+
                    '<table class="table-border" style="width: 100%;">'+
                      '<tr  id="tabThree'+uniqTblID+'">'+
                        // '<th>Sr No.</th>'+
                        '<th>Employee Code</th>'+
                        '<th>Company Name</th>'+
                        '<th>Designation</th>'+
                        '<th>Department</th>'+
                        '<th>From/To Date</th>'+
                      '</tr>'+
                    '</table>'+
                  '</div>'+

                  '<div class="tab-pane tabTable" id="tab4_'+uniqTblID+'">'+
                    '<table class="table-border" style="width: 100%;">'+
                      '<tr  id="tabFour'+uniqTblID+'">'+
                        // '<th>Sr No.</th>'+
                        '<th>Emp Code</th>'+
                        '<th>Course Name</th>'+
                        '<th>University Name</th>'+
                        '<th>Passing Year</th>'+
                        '<th>Percentage</th>'+
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

       processing: true,
       serverSide:false,
       //scrollY:500,
       scrollX:true,
       paging: true,
       ajax:{

        url : "{{ url('/Master/Employee/View-Employee-Mast') }}"

       },
       searching : true,
    

       columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
             return '<button id="showchildtable" onclick="plusBtnClick('+full['DT_RowIndex']+')"><i class="fa fa-plus" id="minus'+full['DT_RowIndex']+'"title="Edit"></i></button><input type="hidden" value='+full['EMP_CODE']+' class="empCode_'+full['DT_RowIndex']+'">';
          }
         },
         // { data:"DT_RowIndex",className:"text-center"},
         { data:"EMP_CODE",className:"text-center"},
         { data:"EMP_NAME",className:"text-center"},
         // { render: function (data, type, full, meta){
             
         //     var empCode  = full['EMP_CODE'];
         //     var empName  = full['EMP_NAME'];
            

         //     var empCodeName = empName+' ['+empCode+' ]';

         //     return  empCodeName;


         //    }},
         {
                    data:'DOB',
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
         { data: "GENDER" },
         { data: "EMAIL" },
         { data: "CONTACT_NO",className:"text-right" },
        
         
         {  
            render: function (data, type, full, meta){

                    
                     // var flag ='employee';
                      var enableBtn = 'enable';
                      var deletebtn ='<input type="hidden" id="deleteinput_'+full['EMP_CODE']+'" value="'+full['EMP_CODE']+'"><a href="Edit-Emp-Mast/'+btoa(full['EMP_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return funempcode(\''+full['EMP_CODE']+'\','+full['DT_RowIndex']+');" ><i class="fa fa-trash" title="Delete"></i></button>';


                    

                      return deletebtn;


                         

                     }
        

       },

         
         
        
      ],

       


     });


     $('#example tbody').on('click', 'td.details-control', function () {

       var tr = $(this).closest('tr');
       // console.log(tr);
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
  
   var emp_code = $('.empCode_'+getId).val();

    $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

    $("#minus"+getId).toggleClass('fa-plus fa-minus rotate');

    $.ajax({

              url:"{{ url('view-employee-chield-employee-data') }}",

               method : "POST",

               type: "JSON",

               data: {emp_code: emp_code},

               success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){

                       
                      }else{

                        var srNo=1;
                        var tableid = data1.data.EMP_CODE;
                        
                        var flag='family';

                        var deletebtn1 ='<a href="edit-employee/'+flag+'/'+btoa(tableid)+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return empDelete('+tableid+');" disabled><i class="fa fa-trash" title="Delete"></i></button>';

                        var adharImg = data1.data.ADHAR_CARD;
                        var adharImage = '';
                        if(adharImg != 'noimage'){
                            adharImage = '<img height="50" width="50" src="{{ URL::asset("public/dist/img/credit/") }}/'+data1.data.ADHAR_CARD+'">';
                        }else{
                            adharImage = '-----';
                            // var msg = adharImage ?  xyz : 'No Match';
                        }

                        var panCardImg = data1.data.PAN_CARD;
                        var panCImage = '';
                        if(panCardImg != 'noimage'){
                            panCImage = '<img height="100" width="200" src="{{ URL::asset("public/dist/img/credit/") }}/'+data1.data.PAN_CARD+'">';
                        }else{
                            panCImage = '';
                        }



                        $('#empData_'+tableid).empty();
                        $('#tabOne'+tableid ).after('<tr><td>'+data1.data.EMP_NAME+ " "+'['+data1.data.EMP_CODE+']</td>><td class="">'+data1.data.EMAIL+'</td><td class="text-right">'+data1.data.CONTACT_NO+'</td><td class="text-right">'+data1.data.BANK_ACCOUNT_NO+'</td><td class="text-right">'+data1.data.DOJ+'</td><td class="">'+data1.data.DESIG_CODE+' ['+data1.data.DESIG_NAME+']</td><td class="">'+data1.data.DEPT_NAME+' [ '+data1.data.DEPT_CODE+' ] </td><td class="">'+data1.data.ADD1+' , '+data1.data.ADD2+' , '+data1.data.ADD3+' </td><td class="" style="width:50px;height:50px;">'+adharImage+'</td></tr>');

                        }
                      
                  }
              }
          });

 
 }

function secondchild(){

    var emp_code = $('#empfcode').val();


    $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });

             $.ajax({

              url:"{{ url('view-employee-chield-family-data') }}",

               method : "POST",

               type: "JSON",

               data: {emp_code: emp_code},

               success:function(data){

                  var data1 = JSON.parse(data);
                



                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){

                       
                      }else{

                        var srNo=1;
                        var tableid = data1.data.EMP_CODE;
                        

                        var flag='family';

                        var deletebtn1 ='<a href="edit-employee/'+flag+'/'+btoa(tableid)+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dealerDelete('+tableid+');" disabled><i class="fa fa-trash" title="Delete"></i></button>';

                        
                        $('#familyData_'+tableid).empty();

                        $('#tabTwo'+tableid).after('<tr><td>'+data1.data.RNAME+'</td><td class="text-right">'+data1.data.RDOB+'</td><td>'+data1.data.RRELATION+'</td><td>'+data1.data.RGENDER+'</td><td>'+data1.data.REMAIL+'</td><td class="text-right">'+data1.data.RCONTACT+'</td></tr>');
                      }
                  }
               }
            });

    


  }

  function thirdchild(){

    var emp_code = $('#empcarcode').val();
    
    $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
            });

             $.ajax({

              url:"{{ url('view-employee-chield-career-data') }}",

               method : "POST",

               type: "JSON",

               data: {emp_code: emp_code},

               success:function(data){

                  var data1 = JSON.parse(data);
                  
                  


                  if (data1.response == 'error') {
                     
                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){
                      
                      if(data1.data==''){
                       
                      
                      }else{
                        
                        var srNo=1;
                        var tableid = data1.data.EMP_CODE;
                        

                        var flag='Career';

                        var deletebtn1 ='<a href="edit-employee/'+flag+'/'+btoa(tableid)+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dealerDelete('+tableid+');" disabled><i class="fa fa-trash" title="Delete"></i></button>';

                        
                        $('#tabThree'+tableid).empty();

                        $('#tabThree'+tableid).append('<tr><td>'+data1.data.EMP_CODE+'</td><td>'+data1.data.COMPANY+'</td><td>'+data1.data.DESIGNATION+'</td><td>'+data1.data.DEPARTMENT+'</td><td class="text-left">'+data1.data.FROM_DATE+' , '+data1.data.TO_DATE+' </td></tr>');
                      }
                  }
               }
            });

}

 function fourthchild(){

    var emp_code = $('#educationcode').val();
    
    
    $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
            });

             $.ajax({

              url:"{{ url('view-employee-chield-education-data') }}",

               method : "POST",

               type: "JSON",

               data: {emp_code: emp_code},

               success:function(data){

                  var data1 = JSON.parse(data);
                  
                  


                  if (data1.response == 'error') {
                     
                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){
                      
                      if(data1.data==''){
                      
                      
                      }else{
                        
                        var srNo=1;
                        var tableid = data1.data.EMP_CODE;
                        

                        var flag='Education';

                        var deletebtn1 ='<a href="edit-employee/'+flag+'/'+btoa(tableid)+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dealerDelete('+tableid+');" disabled><i class="fa fa-trash" title="Delete"></i></button>';

                        
                        $('#tabFour'+tableid).empty();

                        $('#tabhFour'+tableid).append('<tr><td>'+data1.data.EMP_CODE+'</td><td>'+data1.data.COURSE+'</td><td>'+data1.data.UNIVERSITY+'</td><td class="text-right">'+data1.data.PASSING_YEAR+'</td><td class="text-right">'+data1.data.PERCENTAGE+'</td></tr>');
                      }
                  }
               }
            });

}

   function showchildtable(emp_code){
           //var emp_code;


           var emp_code = $("#emp_code").val();
           


             $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });

             $.ajax({

              url:"{{ url('view-employee-chield-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {emp_code: emp_code},

               success:function(data){

                  var data1 = JSON.parse(data);
              
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                        var flag ='education';
                        var objrow = data1.data;

                        
                        var srNo=1;

                        var tableid = objrow[0].EMP_CODE;

                        $.each(objrow, function (i, objrow) {

                          var deletebtn3 ='<a href="edit-employee/'+flag+'/'+btoa(tableid)+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dealerDelete('+objrow.EMP_CODE+');" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                        
                          $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td>'+objrow.COURSE+' </td><td> '+objrow.UNIVERSITY+'</td><td class="text-right">'+objrow.PASSING_YEAR+'</td><td class="text-right">'+objrow.PERCENTAGE+'</td><td class="text-right">'+deletebtn3+'</td></tr>');
                              srNo++;

                             });

                        

                      }
                      
                  }
                

               
                  
               }

          });
    }
</script>

<script type="text/javascript">

 function funDelData(){

var tblNameArr = [];

 var AssetCode  = $("#delempcode").val();
 var del_remark = $("#del_remark").val();
 var tblName    = $("#tblName").val();
 var tblName2    = $("#tblName2").val();
 var tblName3    = $("#tblName3").val();
 var tblName4    = $("#tblName4").val();
 var colName1   = $("#colName").val();
 var colName2   = $("#colNameTwo").val();
 var colName3   = $("#colNameThree").val();
 var colName4   = $("#colNameFour").val();
 var colName5   = $("#colNameFive").val();
 var colName6   = $("#colNameSix").val();

 if(tblName != ''){
   tblNameArr.push(tblName);
 }
 if(tblName2!= ''){
  tblNameArr.push(tblName2); 
 }
 if(tblName3 != ''){
  tblNameArr.push(tblName3);
 }
 if(tblName4 != ''){
  tblNameArr.push(tblName4);
 }else{}

 var AssetViewLink = $("#AssetViewLink").val();
 
 $.ajaxSetup({

        headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

  });

  $.ajax({

    url:"{{ url('/Master/Asset/Delete-Mul-Table') }}",
    
    method : "POST",
    
    type: "JSON",
    
    data: {AssetCode:AssetCode,del_remark:del_remark,tblNameArr:tblNameArr,colName1:colName1,colName2:colName2,colName3:colName3,colName4:colName4,colName5:colName5,colName6:colName6,AssetViewLink:AssetViewLink},
    
    success:function(data){

     var data1 = JSON.parse(data);
     
     if(data1.response =='success'){

       // $('#costTypeDelete').modal('hide');
       // $('#del_remark').val('');
       location.reload();
     }else if(data1.response =='error'){
       location.reload();
     }

    }
  
});

}
 function funempcode(empId,rowId)
  {
   
    var getval = $('#deleteinput_'+empId).val();

    $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea><input type="hidden" id="delempcode" name="emp_code'+rowId+'" value=""></div></div>')
    
    // $('#delempcode').val(empId);
   
    $("#empDataDelete").modal('show');

    $("#delempcode").val(getval);
    console.log('getval',getval);

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



