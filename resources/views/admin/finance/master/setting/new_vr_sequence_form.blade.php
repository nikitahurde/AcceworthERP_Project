@extends('admin.main')


@section('AdminMainContent')


@include('admin.include.header')



<meta name="csrf-token" content="{{ csrf_token() }}">



@include('admin.include.navbar')



@include('admin.include.sidebar')

<style type="text/css">


  .required-field::before {


    content: "*";

    color: red;

  }

  .rightcontent{

  text-align:right;


}
.showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }

::placeholder {
  
  text-align:left;
}

.alert {
  padding: 20px;
  background-color: green;
  color: white;
}

.alert1 {
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}

</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->


        <section class="content-header">


          <h1>


            Master Vr Sequence


            <?php if($button=='Save') { ?>



            <small>Add Details</small>



            <?php } else { ?>



              <small>Update Details</small>



            <?php } ?>


          </h1>

          <ol class="breadcrumb">


            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>


           <?php if($button=='Save') { ?>

            <li class="Active"><a href="{{ URL('/finance/vr-sequence')}}">Master Vr Sequence</a></li>



            <li class="Active"><a href="{{ URL('/finance/vr-sequence')}}">Add Vr Sequence</a></li>



           <?php } else { ?>


             <li class="Active"><a href="{{ URL('/finance/edit-vr-sequence/'.base64_encode($vrseq_id))}}">Master Vr Sequence</a></li>



             <li class="Active"><a href="{{ URL('/finance/edit-vr-sequence/'.base64_encode($vrseq_id))}}">Update Vr Sequence</a></li>



           <?php } ?>



            







          </ol>







        </section>







  <section class="content">







    <div class="row">


      <div class="col-sm-1"></div>

      <div class="col-sm-9">


        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <?php if($button=='Save') { ?>

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add  Vr Sequence</h2>

             <?php } else{  ?>

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update  Vr Sequence</h2>

             <?php } ?>

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

            <div id="alertmsg"></div>

          <div class="box-body">

            <form action="{{ url($action) }}" method="POST" >

               @csrf


               <div class="row">

                  
                  


                   <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        FY Code: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-code"></i></span>

                           <?php $fisYear   =  Session::get('macc_year'); 

                                $GetYear = explode('-', $fisYear);
                               
                                $firstyear = $GetYear[0] + 1;
                                $lastyear = $GetYear[1] + 1;

                                  $nextyr = $firstyear.'-'.$lastyear;

                                  $fromDate = '01-04'.'-'.$firstyear;
                                  $toDate = '31-03'.'-'.$lastyear;

                           ?>

                          <input type="text" class="form-control" name="fy_code" id="fy_code" value="{{ $nextyr }}" placeholder="Enter Fy Code" maxlength="9" readonly="">

                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>
                          
                        

                      </div> 
                      
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fy_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>


                  <div class="col-md-8">

                 
                  <div class="form-group">

                      <label for="exampleInputEmail1">Record Type : <span class="required-field"></span> </label>


                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="qtyvalradio" id="allcomp" value="allcomp" checked="">&nbsp;&nbsp;&nbsp;<b>All Company</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="qtyvalradio" id="partcomp" value="partcomp" >&nbsp;&nbsp;&nbsp;<b>Particular Company</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          
                        <!--   <p><sapn>column 4</sapn> <sapn>column 8</sapn></p> -->
                      

                      </div>
                     <small id="type_err"></small>

                      <small>  

                        <div class="pull-left showSeletedName" id="pfctText"></div>

                     </small>

                     <small id="show_err_dept_code">

                      </small>
                     
                  </div>

                </div>

              </div>



              <!-- /.row -->







              <!-- /.row -->



              <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Company Name : 


                      </label>


                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                         

                          <input list="compList" type="text" class="form-control" name="company_code" id="company_code" placeholder="Select Company" maxlength="6" value="{{ $company_code }}" readonly="">

                          <datalist id="compList">

                              <option value="">--SELECT--</option>

                              @foreach($comp_list as $key)

                              <option value="{{ $key->COMP_CODE }}" data-xyz ="<?php echo $key->COMP_NAME; ?>"> {{ $key->COMP_CODE }} = {{ $key->COMP_NAME }}</option>

                              @endforeach
                        
                           </datalist>

                             <?php $fisYear   =  Session::get('macc_year'); 

                                $GetYear = explode('-', $fisYear);
                               
                                $firstyear = $GetYear[0] + 1;
                                $lastyear = $GetYear[1] + 1;

                                  $nextyr = $firstyear.'-'.$lastyear;


                           ?>

                          <input type="hidden" class="form-control" name="fy_code" id="fy_code" value="{{ $nextyr }}" placeholder="Enter Fy Code" maxlength="9">

                        </div>


                          <div class="pull-left showSeletedName" id="compText"></div>
                          <small id="comp_err" class="form-text text-muted">


                            {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}


                          </small>

                    </div>


                    <!-- /.form-group -->


                  </div>

                 


              </div>

              <!-- /.row -->



               


              <!-- /.row -->



















              <div style="text-align: center;">





                <button type="Button" class="btn btn-primary" id="btnsearch">

                <i class="fa fa-floppy-o" aria-hidden="true" ></i>&nbsp;&nbsp; Proceed

                 </button>

                <!--  <button type="Submit" id="submitBtn" class="btn btn-primary">

                  <input type="hidden" name="vrseqId" value="{{$vrseq_id}}">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 

                 </button>
 -->






              </div>







            </form>







          </div><!-- /.box-body -->







           







          </div>







      </div>







      <div class="col-sm-2">







        <div class="box-tools pull-right">







          <a href="{{ url('/Master/Setting/View-Vr-Sequence') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Vr Sequence </a>







        </div>







      </div>

 












    </div>






     

<div class="box box-primary Custom-Box">


 
<div class="box-body divScroll" style="margin-top: 0%;">
<table id="InwardDispatch" class="table table-bordered table-striped table-hover itmLedger tableScroll">

  <thead class="theadC">

    <tr>
      <!-- <th class="text-center" style="width: 5%;">Sr. No</th> -->
      <th class="text-center" id="itemlable">Company Code</th>
      
      <th class="text-center"  id="opn_qty">Transaction Code</th>
      <!--  <th class ="text-center">T-Code</th> -->
      <th class="text-center"  id="recev_qty">Series Code</th>
      <th class="text-center"  id="recev_qty">From No</th>
      <th class="text-center"  id="recev_qty">To No</th>
      <th class="text-center"  id="recev_qty">Last No</th>
      
    </tr>

  </thead>

  <tbody id="defualtSearch">

    

  </tbody>
  <tfoot align="right">
    <tr>
      <th></th><th></th><th></th><th></th><th></th><th></th>
    </tr>
  </tfoot>
  

</table>

<div style="text-align: center;">

            <input type="hidden" id="taxaplyYorN" value="NO" name="taxaplyYorN">
            <input type="hidden" id="taxCodeU" value="">
            
            <button type="buttom" name="submit" value="submit" id="submitbtn" class='btn btn-success' disabled style="width: 16%;">&nbsp;Submit&nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button> 

  </div>


</div>

</div>

<div class="container">
 
  <!-- Trigger the modal with a button -->
 

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" style="margin-top: 150px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title" style="text-align: center;color: red;"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp; Alert</h4>
        </div>
        <div class="modal-body">
          <h5><b>Vr Seq Already Exist For This Financial Year .Are You Overrite ? .</b></h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="submitData()">Procceed</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>



  </section>







</div>







@include('admin.include.footer')

<script type="text/javascript">
  $(document).ready(function(){

  $("#company_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#compList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

       //  document.getElementById("compText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');  
             document.getElementById("compText").innerHTML = '';        
          }else{
            document.getElementById("compText").innerHTML = msg;
          }

        });



  $("#pfct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#pfctList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

        // document.getElementById("pfctText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             document.getElementById("pfctText").innerHTML = ''; 
          }else{
            document.getElementById("pfctText").innerHTML = msg; 
          }

        });





       $("#transactnid").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#tranList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

        // document.getElementById("tranText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          
             document.getElementById("tranText").innerHTML = ''; 
          }else{
            document.getElementById("tranText").innerHTML = msg; 
          }

        });


        $("#seriesid").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#seriesList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         //document.getElementById("tranText").innerHTML = msg; 

          if(msg=='No Match'){
             $(this).val('');
          }

        });

   });
</script>

<script type="text/javascript">
  $(document).ready(function() {

    $("#last_no").on('input', function(event) {

      var from_no = parseInt($('#from_no').val());
      var last_no = parseInt($(this).val());

      console.log("Form No...! ", from_no);

      console.log("Last No...! ", last_no);

      if (last_no < from_no ) {

        console.log("error...");

         $("#lastNoError").html('Last No Is Grater Than Form No.');

        $('#submitBtn').prop('disabled',true);

      }else{

        console.log("Last No...! ");
         $("#lastNoError").html('');
        $('#submitBtn').prop('disabled',false);

      }





    });


  });
</script>



 <script type="text/javascript">



  $(document).ready(function() {



      $("#company_code").change(function(){



         $.ajaxSetup({



            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }



         });



        var company_code =  $(this).val();

        

          $.ajax({



            url:"{{ url('fy-year-by-comp-code') }}",



             method : "POST",



             type: "JSON",



             data: {company_code: company_code},



             success:function(data){



              

                  var data1 = JSON.parse(data);



                  if (data1.response == 'error') {



                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");



                  }else if(data1.response == 'success'){

              

                    objcity = data1.data;



                      $('#fy_codeid').empty();



                        $.each(objcity, function (i, objcity) {

                          $('#fy_codeid').append($('<option>', { 

                              value: objcity.FY_CODE,

                              text : objcity.FY_CODE 

                          }));

                        });

                  }

             }



          });



      });





      $("#transactnid").change(function(){



         $.ajaxSetup({



            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }



         });



        var tran_code =  $(this).val();

        

          $.ajax({



            url:"{{ url('series-code-by-comp-code') }}",



             method : "POST",



             type: "JSON",



             data: {tran_code: tran_code},



             success:function(data){



              

                  var data1 = JSON.parse(data);



                  if (data1.response == 'error') {



                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");



                  }else if(data1.response == 'success'){

              

                    objcity = data1.data;



                      $('#seriesList').empty();

                      

                        $.each(objcity, function (i, objcity) {

                          $('#seriesList').append($('<option>', { 

                              value: objcity.SERIES_CODE,

                              'data-xyz': objcity.SERIES_CODE,

                              text : objcity.SERIES_CODE 

                          }));

                        });

                  }

             }



          });



      });



    });





</script> 

<script type="text/javascript">
$(document).ready(function(){
  $('.Number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
    if (keycode == 46 || this.value.length==10) {
    return false;
  }
});

  });
</script>

<script type="text/javascript">
  $(document).ready(function() {

  jQuery.extend(jQuery.expr[':'], {
    focusable: function (el, index, selector) {
        return $(el).is('a, button, :input, [tabindex]');
    }
});

$(document).on('keypress', 'input,select', function (e) {
    if (e.which == 13) {
        e.preventDefault();
        // Get all focusable elements on the page
        var $canfocus = $(':focusable');
        var index = $canfocus.index(document.activeElement) + 1;
        if (index >= $canfocus.length) index = 0;
        $canfocus.eq(index).focus();
    }
});

});
</script>


<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(comp_code= '', comptype=''){

         /* $("#basic").hide();
          $("#cls_qty").hide();*/
    
     var table = $('#InwardDispatch').DataTable({
           
   

              processing: true,
              serverSide: true,
              responsive: true,
              scrollX: true,
              searching: false,
              pageLength:'10',
              dom: "<'top'<'row'  <'col-sm-12'>>" +"<'row'<'col-sm-4'B><'col-sm-4'<'toolbar'> ><'col-sm-4'f>>><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
              columnDefs: [{
                "defaultContent": "-",
                "targets": "_all"
              }],

               buttons: [
                   
                   
                ],
              ajax:{
                url:'{{ url("/vr-seq-comp-details") }}',
                data: {comp_code:comp_code,comptype:comptype},
                 
              },
              columns: [

                // {
                //     data:'DT_RowIndex',
                //     name:'DT_RowIndex',
                //     className: "alignCenterClass",
                // },
                {
                  data:'COMP_CODE',
                  name:'COMP_CODE',
                  className:'alignRightClass',

                   render: function (data, type, full, meta){

                   	var comp_code = full['COMP_CODE']+'<input type="hidden" value="'+full['COMP_CODE']+'" name="comp_code[]" id="comp_code">'
                     
                     // return comp_code;
                     return comp_code;
  

                     } 
                  
                },
                {
                  data:'TRAN_CODE',
                  name:'TRAN_CODE',
                  render: function (data, type, full, meta){

                   	var tran_code = full['TRAN_CODE']+'<input type="hidden" value="'+full['TRAN_CODE']+'" name="tran_code[]" id="tran_code">'
                     
                     // return comp_code;
                     return tran_code;
  

                     } 
                   
                },
                { data:'SERIES_CODE',
                  name:'SERIES_CODE',
                  className:'alignRightClass' 
                    
                    
                },
                 { data:'FROM_NO',
                  name:'FROM_NO',
                  className:'text-right' 
                    
                    
                },
                 { data:'TO_NO',
                  name:'TO_NO',
                  className:'text-right' 
                    
                    
                },
                 { data:'LAST_NO',
                  name:'LAST_NO',
                  className:'text-right' 
                    
                    
                },

              
               
              ],


          });

  



}

       $('.optionsRadios1').click(function(){

        var btnvalue =  $("input[name='qtyvalradio']:checked").val();

        if(btnvalue=='partcomp'){

          $("#company_code").prop('readonly',false);


        }else{
          $('#company_code').val('');
          $("#company_code").prop('readonly',true);
          $("#comp_err").html('');
        }

       });


       $('#btnsearch').click(function(){



          var comp_code =  $('#company_code').val();

         

        
        var getqtyval1 = $("input[name='qtyvalradio']:checked").val();


        if($("input[name='qtyvalradio']:checked").length == 0){

          $("#type_err").html('Please Select Type').css('color','red');

          return false;
        }

      //alert(getqtyval1);
          if(getqtyval1){

            var comptype =  getqtyval1;
          }
      
          var btnsearch =  $('#btnsearch').val();

          //var trans_code =  $('#trans_code').val();

        
         

          if (comp_code!='' || comptype!='') {

           

               // alert(getqtyval);
           if(comptype=='allcomp'){

            
            $('#InwardDispatch').DataTable().destroy();
            
            load_data(comp_code,comptype);

            $("#submitbtn").prop('disabled', false);

           }else{
  
              if(comp_code==''){

                  $("#submitbtn").prop('disabled', true);
                  $("#comp_err").html('Please Select Comp Code').css('color','red');
                  return false;
                
              }else{
                $("#comp_err").html('');
              }

            $('#InwardDispatch').DataTable().destroy();
           
            load_data(comp_code,comptype);


             $("#submitbtn").prop('disabled', false);
           }
                
           

          }else{
            
          // var table =  $('#InwardDispatch').DataTable();

            var t =  $('#InwardDispatch').DataTable();

            t.destroy();

            load_data();
          
          }


        });


       

       $('#ResetId').click(function(){

              
              
              $('#item_code').val('');
              
              $('#pfct_code').val('');
              $('#vr_num').val('');

          document.getElementById("itemText").innerHTML = '';
          document.getElementById("pfctText").innerHTML = '';
          $('#InwardDispatch').DataTable().destroy();
          load_data();

        });





  });


</script>


<script type="text/javascript">
$(document).ready(function (){

   $('#submitbtn').on('click', function(e){

   //var data = form.serializeArray();

   var fy_code = $("#fy_code").val();

   var company_code = $("#company_code").val();

  // alert(company_code);

   var getcomp = $("input[name='qtyvalradio']:checked").val();

   $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });


 
   $.ajax({
      method:"POST",
      url: "{{ url('/Master/Setting/Check-Vr-Seq-data') }}",
      data: {fy_code:fy_code,getcomp:getcomp,company_code:company_code},
      success: function(data){

        var obj =  JSON.parse(data);

        console.log(obj);

        if(obj.response=='Success'){

         
              $("#myModal").modal('show');
          

        }else if(obj.response=='error'){
            

         submitData();
            
        }
     // window.location="{{url('/Master/Item/View-Item-Bal-Mast')}}";
          
      }
   });

});


   



});


</script>

<script type="text/javascript">


function submitData(){

  // var form = $("#myForm");


   $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

   // Encode a set of form elements from all pages as an array of names and values
  // var data = form.serializeArray();

   var fy_code = $("#fy_code").val();

   var company_code = $("#company_code").val();

   var getcomp = $("input[name='qtyvalradio']:checked").val();

  // alert(company_code);return false;
   // Iterate over all form elements
   $.ajax({
   	  method:"POST",
      url: "{{ url('/Master/Setting/Save-New-Vr-Seq-No') }}",
      data: {fy_code:fy_code,getcomp:getcomp,company_code:company_code},
      success: function(data){

        	var obj =  JSON.parse(data);
         console.log('Server response',obj.response);

    window.location="{{url('/Master/Setting/View-Vr-Sequence')}}";
        /* if(obj.response=='Success'){

         	var alertmsg = '<div class="alert"><span class="closebtnonclick="this.parentElement.style.display="none";">&times;</span><strong>Success!</strong> Data Saved Successfully..!</div>'

         	$("#alertmsg").html(alertmsg);

         }else if(obj.response=='error'){

         	var alertmsg = '<div class="alert1"><span class="closebtnonclick="this.parentElement.style.display="none";">&times;</span><strong>Error!</strong> Data Already Exist For This Fianacial Year.</div>'

         	$("#alertmsg").html(alertmsg);

         }*/
      }
   });



}



</script>

@endsection