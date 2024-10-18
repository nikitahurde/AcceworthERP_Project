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

  .settaxcodemodel{
    font-size: 16px;
    font-weight: 800;
    color: #5d9abd;

  }

  .modltitletext{
    font-weight: 800;
    color: #5696bb;
    font-size: 16px;
    text-align: center;
  }

  .actionBTN {
    font-size: 10px;
    padding: 0px 2px;
}

</style>







  <div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">


          <h1>


            Master Employee Pay



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/finance/view-cost-category')}}">Master Employee Pay</a></li>



            <li class="Active"><a href="{{ URL('/finance/view-cost-category')}}">View Employee Pay </a></li>



          </ol>



        </section>

        <section class="content">



          <div class="row">



            <div class="col-xs-12">



              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Employee Pay </h3>

                  <div class="box-tools pull-right">

                    <a href="{{ url('Master/Employee/Emp-Pay-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Employee Pay</a>
                  
                  </div>

                </div>

                @if(Session::has('alert-success'))

                  <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                    <h4>

                      <i class="icon fa fa-check"></i>Success...!

                    </h4>

                   {!! session('alert-success') !!}

                  </div>

                @endif

                @if(Session::has('alert-error'))

                <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                  <h4>

                   <i class="icon fa fa-ban"></i> Error...!

                  </h4>

                 {!! session('alert-error') !!}
                </div>

                @endif

                <div class="box-body">

                  <table id="example" class="table table-bordered table-striped table-hover">

                     <thead>
                      <tr>

                        <th class="text-center">Sr.No</th>

                        <th class="text-center">Date</th>

                        <th class="text-center">Employee Code</th>

                        <th class="text-center">Employee Name</th>
                        
                        <th class="text-center">Grade Code</th>

                        <th class="text-center">Plant Code</th>
                       
                        <th class="text-center">Plant Name</th>
                        
                        <th class="text-center">PFCT Code</th>

                        <th class="text-center">PFCT Name</th>
                        
                        <th class="text-center">Designation Code</th>

                        <th class="text-center">Designation Name</th>
                        
                        <th class="text-center">From Date</th>

                        <th class="text-center">To Date</th>
                       
                        <th class="text-center">CTC</th>
                        
                        <th class="text-center">Calculation</th>

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



    <div class="modal fade" id="cal_ctc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">

            <div class="modal-dialog" role="document" style="margin-top: 5%;">

              <div class="modal-content" style="border-radius: 5px;">

                <div class="modal-header">

                 <div class="row">

                  <div class="col-md-5">
                    <div class="form-group">
                     <lable class="settaxcodemodel col-md-6" style="padding: 6px;">Grade Code - </lable>
                     <input type="text" class="settaxcodemodel col-md-6" id="gradeCodes" style="border: none; padding:6px;" readonly>
                    </div>
                 </div>
                                          
               <div class="col-md-6">
                  <h5 class="modal-title modltitletext" id="exampleModalLabel">Pay / Charges / etc Calculation</h5>
               </div>

                 <div class="col-md-1"></div>

                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                     <lable class="settaxcodemodel col-md-3" style="padding: 6px;">Employee Name - </lable>
                     <input type="text" class="settaxcodemodel col-md-6" id="employee_name" style="border: none; padding:6px;" readonly>
                    </div>
                 </div>
                </div>

               </div>

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
                .boxer .box10 {
                  display: table-cell;
                  vertical-align: top;
                  border: 1px solid #ddd;
                  padding: 5px;
                }
                .boxer .ebay {
                  padding:5px 1.5em;
                }
                .boxer .google {
                  padding:5px 1.5em;
                }
                .boxer .amazon {
                  padding:5px 1.5em;
                }
                .center {
                  text-align:center;
                }
                .right {
                  float:right;
                }
                .texIndbox{
                  width: 15%; 
                  text-align: center;
                }
                .texIndbox_itm{
                  width: 20%;
                }
                .texIndbox_vr{
                  width: 12%;
                }
                .rateIndbox{
                  width: 15%;
                  text-align: center;
                }
                .rateBox{
                  width: 20%;
                  text-align: center;
                }
                .amountBox{
                  width: 20%;
                  text-align: center;
                }
                .inputtaxInd{
                  background-color: white !important;
                  border: none;
                  text-align: center;
                }
                .showind_Ch{
                  display: none;
                }
              </style>

              <div class="modal-body table-responsive" style="height: 70vh;overflow-y: auto;">
                  <div class="modalspinner hideloaderOnModl"></div>
                  <div class="boxer" id="calculation_data">
                  

                  </div>
                  <div class="boxer" id="basic_rate_body"></div>

              </div>

              <div class="modal-footer">

                <center>
                <span  id="footer_modal_pay" style="width: 56px;"></span>
              <!--  <button class="btn btn-primary">cal</button> -->
              </center>
                                      
              </div>

            </div>

          </div>

        </div>


        <div class="modal fade" id="EmployeePayDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
              <input type="hidden" name="emppay" id="emppay" value="">

              <input type="hidden" name="AssetViewLink" id="AssetViewLink" value="Master/Employee/View-Emp-Pay-Mast">

              <input type="hidden" name="tblName" id="tblName" value="MASTER_EMPWAGEBODY">
              <input type="hidden" name="tblName2" id="tblName2" value="MASTER_EMPWAGEHEAD">

              <input type="hidden" name="colName" id="colName" value="EMP_PAYID">
              <input type="hidden" name="colNameTwo" id="colNameTwo" value="ID">
              <input type="hidden" name="colNameThree" id="colNameThree" value="GRADE_CODE">
              <input type="hidden" name="colNameFour" id="colNameFour" value="GRADE_NAME">

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
       // scrollY:500,
       scrollX:true,
       paging: true,
       dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
        buttons:  [
                    {
                      extend: 'excelHtml5',
                      exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                      },
                      title: 'MASTER EMPLOYEE PAY '+$("#headerexcelDt").val(),
                      filename: 'MASTER_EMPLOYEE_PAY_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/Master/Employee/View-Emp-Pay-Mast') }}"

       },
       searching : true,
    
        
       columns: [
        

       
         { data:"DT_RowIndex",className:"text-center"},
         { data: "DATE",className:'text-right'},
         { data: "EMP_CODE",className:'text-left'},
         { data: "EMP_NAME",className:'text-left'},
         { data: "GRADE_CODE",className:'text-left'},
         { data: "PLANT_CODE",className:'text-left'},
         { data: "PLANT_NAME",className:'text-left'},
         { data: "PFCT_CODE",className:'text-left'},
         { data: "PFCT_NAME",className:'text-left'},
         { data: "DESIG_CODE",className:'text-left'},
         { data: "DESIG_NAME",className:'text-left'},
         { data: "FROM_DATE",className:'text-left'},
         { data: "TO_DATE",className:'text-left'},
         
         // { 
         //  render: function (data, type, full, meta){
             
         //     var empCode  = full['EMP_CODE'];
         //     var empName  = full['EMP_NAME'];
         //     var empGrade = full['GRADE_CODE'];

         //     var empCodeNameGrade =empName+' ['+empCode+' ] '+'<button class="btn btn-success btn-xs"style="width:40px;font-weight:900;">'+empGrade+'</button>';

         //     return  empCodeNameGrade;


         //    }
         // },
     
         // { render: function (data, type, full, meta){
             
         //     var plantCode  = full['PLANT_CODE'];
         //     var plantName  = full['PLANT_NAME'];
            

         //     var plantCodeName = plantName+' ['+plantCode+' ]';

         //     return  plantCodeName;


         //    }
         //  },
         
         // { render: function (data, type, full, meta){
             
         //     var pfctCode  = full['PFCT_CODE'];
         //     var pfctName  = full['PFCT_NAME'];
             
         //     var pfctCodeName = pfctName+' ['+pfctCode+' ]';

         //     return  pfctCodeName;


         //    }
         // },
         
         // { render: function (data, type, full, meta){
             
         //     var desigCode  = full['DESIG_CODE'];
         //     var desigName  = full['DESIG_NAME'];
             
         //     var desigCodeName = desigName+' ['+desigCode+' ]';

         //     return  desigCodeName;


         //    }
         // },
         // { 
         //  render: function (data, type, full, meta){
             
         //     var fromDt  = full['FROM_DATE'];
         //     var toDt  = full['TO_DATE'];
             
         //     var fromToDate = fromDt+' '+toDt;

         //     return  fromToDate;


         //    }
         // },
         { data: "CTC" },
         
          {
            render:function(data,type,full,meta){

              var grade        =full['GRADE_CODE'];
              var employeeName =full['EMP_NAME'];
              return '<button class="btn btn-primary btn-xs actionBTN"  data-toggle="modal" data-target="#cal_ctc" value='+full['ID']+' onclick="return funcCalCtc(\''+grade+'\','+full['ID']+',\''+employeeName+'\');">Calc</button>';
            },className:"text-center",
          },

         { render: function (data, type, full, meta){


                  if(full['EMPPAY_BLOCK']=='NO'){
                      return '<span class="label label-success">Active</span>';
                    }else if(full['EMPPAY_BLOCK']=='YES'){

                      return '<span class="label label-danger">Inactive</span>';
                    }else{

                      return '<span class="label label-danger">Not Found</span>';
                    }
                         

                     },className:"text-center"
          },

         
          {  
            render: function (data, type, full, meta){

                      var enableBtn = 'enable';
                      var deletebtn ='<input type="hidden" id="deleteinput_'+full['ID']+'" value='+full['ID']+'><a href="Edit-Emp-Pay-Mast/'+btoa(full['ID'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getId('+full['ID']+','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                     

                      return deletebtn;

                     },className:"text-center",
        

       },
         
      ],

    });
});
</script>



<script type="text/javascript">

function funDelData(){

 var AssetCode  = $("#emppay").val();
 var del_remark = $("#del_remark").val();
 var tblName    = $("#tblName").val();
 var tblName2    = $("#tblName2").val();
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

  function getId(tblId,rowId)
  {
    
    var getval = $('#deleteinput_'+tblId).val();

    $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea></div></div>')

    $("#EmployeePayDelete").modal('show');


    $("#emppay").val(getval);

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

  
  function funcCalCtc(grade,payid,employeeName){
    
     var emppay_id = payid;
    
     $('#gradeCodes').val(grade);
     $('#employee_name').val(employeeName);
      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/Master/Employee/emp-pay-structure-master') }}",

            data: {emppay_id:emppay_id}, // here $(this) refers to the ajax object not form

            success: function (data) {

             
              var obj = JSON.parse(data);

              if (obj.response == 'error') {

                  // $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(obj.response == 'success'){
                  if(obj.data ==''){

                  }else{
                    console.log('data',obj.data);
                      $('#calculation_data').empty();

                         var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox'>Wage Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div><div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div></div>";

                          $('#calculation_data').append(TableHeadData);
                         var counter = 1;
                        

                          var countI ='';
                          var dataI ='';
                         $.each(obj.data, function(k, getData) {

                            var datacount = obj.data.length;
                            dataI = datacount;

                            var TableData = "<div class='box-row' id='basicrows'><div class='box10 texIndbox'><input type='text' id='wage_ind_"+counter+"' name='head_wage_ind[]' class='form-control inputtaxInd' style='z-index: 0;' value=\""+getData.WAGE_IND+"\" readonly></div><div class='box10 rateIndbox'><input type='text' id='rate_code_"+counter+"' name='rate_code[]' class='form-control inputwageInd' value="+getData.RATE_IND+" readonly></div><div class='box10 rateBox '><input type='text' id='rate_"+counter+"' name='rate[]' class='form-control text-right inputwageInd' value="+getData.RATE+" readonly><input type='hidden' id='logic_"+counter+"' name='logic[]' class='form-control inputwageInd' value="+getData.LOGIC+" readonly></div><div class='box10 amountBox'><input type='text' id='amt_"+counter+"' name='amount[]' class='form-control text-right' value="+getData.AMOUNT+" readonly></div></div>";

                            
                             countI = counter;
                             counter++;
                            

                          
                              $('#calculation_data').append(TableData);
                        })
                      }

                           var butn =  $('#footer_modal_pay').find(':button').html();

                           if(butn != 'Ok' || butn =='undefined'){

                           var tblfootData = "<button type='button' class='btn btn-primary ' style='width: 10%;' data-dismiss='modal' id='ApplyOkbtn'>Ok</button>";
                               
                              $('#footer_modal_pay').html(tblfootData);

                           }else{
                            
                           }

              }
           }
        })

   }

</script>

@endsection







