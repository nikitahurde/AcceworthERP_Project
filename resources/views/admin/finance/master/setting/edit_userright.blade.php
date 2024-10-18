


<?php  
 $getdata=[]; 
 $useridd=[];
 $addform=[]; 

 ?>


        <?php foreach($form_name as $key) {

               $getdata[]= $key->FORMCODE;
               $addform[]= $key->ADD_FORM;
               $useridd[]= $key->USER_CODE;
               
       } ?>

       
<style type="text/css">
  
  .blink_me {
  animation: blinker 1s linear infinite;
  
}

@keyframes blinker {  
  50% { opacity: 0.5; }
}
</style>

  <form method="POST" action="{{ url('/Master/Setting/update-user_right_data') }}" >

               @csrf

         
              <!-- /.row -->
           

               <div class="row">

                 <div class="col-md-6">
                  <div class="form-group">

                      <label>

                       4 . Form: 

                        <span class="required-field"></span>

                      </label>

                     
                </div>
                </div>
                <div class="col-md-6">
                     <input type="hidden" name="userid" id="userid">

                    <input type="hidden" name="user_name" id="user_name"> 
                  <button type="button" class="btn btn-primary btn-sm blink_me" onclick="return geteditFormName();" style="width: 250px;">CLICK FOR SELECT FORM</button>
                  
                </div>
                
              </div> 

              <!-- /.row -->



              <div style="text-align: center;">

                <div id='loadingmessage' style='display:none'>
                      <img src="{{ URL::asset('public/dist/img/loader/Spinner-1s-200px (1).gif') }}" class="user-image" alt="User Image">
                </div>

                <a href="{{ url('/Master/Setting/view-user-right')}}" class="btn btn-danger" id="btncancel">

                <i class="fa fa-window-close" aria-hidden="true"></i>&nbsp;&nbsp; Cancel 

                 </a>
                
                 <button type="Submit" class="btn btn-primary" id="btnsubmit">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

                 </button>

              </div>
            

                <!-- modalmodalmodal -->

  <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">

  <div class="modal-dialog modal_diloge modal-lg" role="document" >

    <div class="modal-content modal-popout-bg" style="border-radius: 7px;">

      <!-- start : header logos -->

      <div class="modal-header">

       

      <div style="text-align: center;">

        <span class="access_cont menutext">Access Control Update</span>

      </div>

      </div>

        <center><span id="msg"></span></center>
        <div class="modal-body">

          <!-- <div class="row">
            <div class="col-md-12">
              <div class="col-md-4"></div>
            <div class="col-md-4">
             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                <select id="Transaction" name="Transaction" class="form-control" onchange="getTransaction(this.value)">
                <option value="">--SELECT--</option>
                <option value="All">All Form</option>
                <option value="Master">Master</option>
                <option value="Configuration">Configuration</option>
                <option value="Master Company">Company</option>
                <option value="Transaction">Transaction</option>
                <option value="Reports">Report</option>
                
                </select>
              </div>
            </div>
           </div>
           </div>
        </div> -->
        <div id="headingForm" class="menutext" style="border-bottom: 1px;text-align:center;text-transform: uppercase;font-size: 15px;border-bottom-style:1px solid;">All Form</div>
        <br/>
        
        <div id="appnedFormEdit">

        <div class='row'><div class='col-md-12'><div class='col-md-4'></div><div class='col-md-2 menutext'>ADD</div><div class='col-md-2 menutext'>EDIT</div><div class='col-md-2 menutext'>DELETE</div><div class='col-md-2 menutext'>VIEW</div></div></div>


        <div class='row'>
          

         <?php $sr_no =1; foreach($UNIQU_TABLE as $key) { 

          ?>
          
                  
          <div class='col-md-12'>
          <div class='col-md-4'>
              <input type='hidden' value='<?= $sr_no ?>' name="totalcount" id="totalcount">
              <input class='form-check-input filtercheck' type='checkbox' value='<?php echo $key->FORMCODE ?>_<?= $key->FORMNAME ?>' <?php if(in_array($key->USER_CODE,$useridd)){ echo 'checked'; } ?>  id='forms_<?= $sr_no ?>' name='form_name_<?= $sr_no ?>' onclick='check_access(<?= $sr_no ?>)'>&nbsp;&nbsp;<label><?php echo $key->FORMNAME ?> <?php echo '['.$key->FORMCODE.']' ?></label> 
          </div>

          <div class='col-md-2'>
            <input class='form-check-input filtercheck formcehck_<?= $sr_no ?>' type='checkbox' value='add' <?php if($key->ADD_FORM=='YES') {echo 'checked';} ?> id='inward_trans' name='add_<?= $sr_no ?>' >
          </div>
            <div class='col-md-2'><input class='form-check-input filtercheck formcehck_<?= $sr_no ?>' type='checkbox' value='edit'  <?php if($key->EDIT_FORM=='YES') {echo 'checked';} ?> id='inward_trans' name='edit_<?= $sr_no ?>' ></div>
            <div class='col-md-2'><input class='form-check-input filtercheck formcehck_<?= $sr_no ?>' type='checkbox' value='delete'  <?php if($key->DELETE_FORM=='YES') {echo 'checked';} ?> id='inward_trans' name='delete_<?= $sr_no ?>' ></div>
            <div class='col-md-2'><input class='form-check-input filtercheck formcehck_<?= $sr_no ?>' type='checkbox' value='view' <?php if($key->VIEW_FORM=='YES') {echo 'checked';} ?> id='inward_trans' name='view_<?= $sr_no ?>'></div>
          
        </div>

      <?php $sr_no++; }  ?>
          
     
        </div>
      <!-- finnace  master -->

      <div class="modal-footer">
        <div style="text-align: center;">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>

        </div>
      </div>


    </div>

  </div>

  </div>
</div>
</div>
              <!-- modalmodalmodal -->
 </form>



        <script type="text/javascript">
          $(document).ready(function(){

 $('.allcheckbox').multiselect({
  nonSelectedText: 'Select',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'212px',
  includeSelectAllOption: true,
  maxHeight: 200

  
 });

 $('#update_form').on('submit', function(event){
  event.preventDefault();

  //alert('hello');return false;

  $('.overlay-spinner').removeClass('hideloader');

  
  var form_data = $(this).serialize();

   $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
   type: 'POST',
   url:"{{ url('/update-user_right_data') }}",
   //method:"POST",
   data:form_data,
   success:function(data)
   {
    var obj = JSON.parse(data);

    if(obj.response=='success'){

      $('.overlay-spinner').addClass('hideloader');
  
         var url = "{{url('finance/view-user-update-msg')}}"
        setTimeout(function(){ window.location = url+'/update'; });
    }else{
      notif({
        msg: "ERROR..! </b>",
        type: "error",
        position: "center"
      });
      setTimeout(function () { 
      window.location.reload();
    }, 2500);

      $("#btnsubmit").prop('disabled', false);
      $("#btncancel").prop('disabled', false);
    }
   }
  });
 });

 });
</script>


<script type="text/javascript">
    
    function geteditFormName(){

      $("#exampleModal1").modal();
    }

</script>

<script type="text/javascript">
    
    function geteditFormName1(){


        var user_code =  $("#userid").val();


        //alert(user_code);
      

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

           });


       $.ajax({

                url:"{{ url('get-formName-getdata-update') }}",

                 method : "POST",

                 type: "JSON",

                 data: {user_code: user_code},

                 success:function(data){

                  console.log(data);

                 var obj = JSON.parse(data);

                 $("#exampleModal1").modal();

                 $("#appnedFormEdit").empty();

                 var heading = "<div class='row'><div class='col-md-12'><div class='col-md-4'></div><div class='col-md-2 menutext'>ADD</div><div class='col-md-2 menutext'>EDIT</div><div class='col-md-2 menutext'>DELETE</div><div class='col-md-2 menutext'>VIEW</div></div></div>";

                 $("#appnedFormEdit").append(heading);

                 var srno =1;

               //   console.log('user',obj.user_right);  

                  var getdata = [];
                  var adddata = [];
                  var editdata = [];
                  var dsf = [];

                  $.each(obj.user_right, function(j, sData) {

                    getdata.push(sData.FORMCODE);
                    adddata.push(sData.ADD_FORM);
                    editdata.push(sData.EDIT_FORM);
                    
                    var sdd = sData.ADD_FORM;

                    if(sdd=='YES'){
                      dsf.push('checked');
                    }else{
                      dsf.push('NO');
                    }
                 

                  });


              
                $.each(obj.data, function(k, getData) {

                     

                     if(jQuery.inArray(getData.form_code, getdata) != -1) {
                            var checked = 'checked';
                        } else {
                            var checked = '';
                        }

                     
                  
                 

                    if(jQuery.inArray('YES', editdata) != -1) {

                          var editchecked = 'checked';
                        } else {
                            var editchecked = '';


                        }
              
                          var addchecked = [];
                      $.each(obj.user_right, function(j, sData) {

                        if(sData.ADD_FORM =='YES'){

                          var addchec ='checked';

                          addchecked.push(addchec);
                        }

                        });
                         
                     var tableBody = "<div class='row'><div class='col-md-12'><div class='col-md-4'><input type='hidden' value='"+srno+"'><input class='form-check-input filtercheck' type='checkbox' value='"+getData.form_code+"' id='forms_"+srno+"' name='form_name_"+srno+"' onclick='check_access("+srno+")' "+checked+">&nbsp;&nbsp;<label>"+getData.form_name+"</label> </div><div class='col-md-2'><input class='form-check-input filtercheck formcehck_"+srno+"' type='checkbox' value='add' id='inward_trans' name='add_"+srno+"' "+addchecked+"></div><div class='col-md-2'><input class='form-check-input filtercheck formcehck_"+srno+"' type='checkbox' value='edit' id='inward_trans' name='edit_"+srno+"' "+editchecked+"></div><div class='col-md-2'><input class='form-check-input filtercheck formcehck_"+srno+"' type='checkbox' value='delete' id='inward_trans' name='delete_"+srno+"' disabled></div><div class='col-md-2'><input class='form-check-input filtercheck formcehck_"+srno+"' type='checkbox' value='view' id='inward_trans' name='view_"+srno+"' disabled></div></div></div>";
                      srno++;

                      $("#appnedFormEdit").append(tableBody);

                    
                       
                    
                 });
                

                   $("#totalcount").val(srno);
                 
               
                   
                 }

              });



    }
  </script>


 <script type="text/javascript">
     $(document).ready(function(){
      $("#username").on('change', function (){

      
        var username = $(this).val();

        if(username!=''){
          $("#user_name").val(username);
          $("#user_name1").val(username);
        }else{
          $("#user_name").val('');
          $("#user_name1").val('');
        }

       
      });




      $("#user_code").on('change', function (){

        $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

           });

        var userid = $(this).val();

        
        
      // alert(userid);return false;

         $.ajax({

                url:"{{ url('get-userright-username') }}",

                 method : "POST",

                 type: "JSON",

                 data: {userid: userid},

                 success:function(returndata){

        
                 var obj = JSON.parse(returndata);
               //  alert(obj.response);return false;


                 if(obj.response=='success'){

                   
                    $("#username").val(obj.data);
                 //   $("#showedit").html('');
                   
                 }else{
                  $("#username").val(obj.data);

                 }

                   
                 }

              });


      });

     });
  </script>

 <script type="text/javascript">

  function check_access(id)
  {
   
          var isChecked  = $('#forms_'+id).is(':checked');
          
          //var isChecked  = $('#forms_'+id).attr('checked');

          if(isChecked){

          $('.formcehck_'+id).prop('disabled',false);
       //   $('.formcehck_'+id).prop('checked', true);

          }else{
            $('.formcehck_'+id).prop('disabled',true);
            $('.formcehck_'+id).prop('checked', false);
          }

  }

</script>