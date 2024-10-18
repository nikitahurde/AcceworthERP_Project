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

.showSeletedName{

    font-size: 12px;

    margin-top: 1%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }

.beforhidetble{
  display: none;
}
.popover{
    left: 80.4922px!important;
    width: 100%!important;
}
.setetxtintd{
    font-size: 12px !important;
    padding-top: 2% !important;
    padding-bottom: 2% !important;
}
.nameheading{
    font-size: 12px;
}
.setheightinput{
    height: 0%;
}
.custom-options {
     position: absolute;
     display: block;
     top: 100%;
     left: 0;
     right: 0;
     border-top: 0;
     background: #f3eded;
     transition: all 0.5s;
     opacity: 0;
     visibility: hidden;
     pointer-events: none;
     z-index: 2;
     -webkit-box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
     -moz-box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
     box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
}
 .custom-select .custom-options {
     opacity: 1;
     visibility: visible;
     pointer-events: all;
}
 .custom-option {
    position: relative;
    display: block;
    padding-top: 10px;
    padding-left: 21%;
    font-size: 14px;
    font-weight: 600;
    color: #3b3b3b;
    line-height: 2px;
    cursor: pointer;
    transition: all 0.5s;
}
 
.CloseListDepot{
  display: none;
}
 @media screen and (max-width: 600px) {

  
   .popover {
    left: 56.4922px!important;
    width: 100%!important;
  }
   .setheightinput{
    width: 65%!important;
  }
  #serachcode{
    margin-left: 5%!important;
  }


}

</style>


<div class="content-wrapper">

  <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master Cost 

            <small>Add Details</small>

          </h1>


          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/Master/Cost-Center/Cost-Mast')}}">Master Cost Master</a></li>

            <li class="Active"><a href="{{ URL('/Master/Cost-Center/Cost-Mast')}}">Add Cost Master</a></li>

          </ol>


  </section>


  <section class="content">

  <div class="row">
      <div class="col-sm-2"></div>

      <div class="col-sm-7">


        <div class="box box-primary Custom-Box">


            <div class="box-header with-border" style="text-align: center;">


               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Cost Master</h2>


            </div><!-- /.box-header -->


            @if(Session::has('alert-success'))

              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4> <i class="icon fa fa-check"></i>

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



            <form action="{{ url('Master/Cost-Center/Cost-Save')}}" method="POST" >

               @csrf

              <!-- /.row -->

              <div class="row">

                   <div class="col-md-6">

                    <div class="form-group">

                      <label>Cost Type : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                           <input list="costList" type="text" class="form-control" name="costtype_code" id="costtype_code" placeholder="Select Cost Type" maxlength="6" value="{{ old('costtype_code') }}" autocomplete="off">

                          <datalist id="costList">

                            <option value="">--SELECT--</option>

                            @foreach($costype_list as $key)

                              <option value="{{ $key->CTYPE_CODE }}" data-xyz="{{ $key->CTYPE_NAME }}"> {{ $key->CTYPE_CODE }} = {{ $key->CTYPE_NAME }}</option>

                            @endforeach

                         </datalist>
                         <input type="hidden" name="costtype_name" id="costtype_name" value="">

                        </div>

                        <div class="pull-left showSeletedName" id="costText"></div>


                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('costtype_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

 <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label> Cost Name :<span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="cost_name" value="{{ old('cost_name')}}" id="cost_name" placeholder="Enter Cost Name" maxlength="40" oninput="funGenCostCode(this)"autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('cost_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>
                 </div>                

              </div>



              <div class="row">
                  
                  <div class="col-md-6">
                    <div class="form-group">

                      <label> Cost Code : <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                        
                        <input type="text" class="form-control codeCapital" name="cost_code" value="{{ old('cost_code')}}" placeholder="Enter Cost Code" maxlength="6" id="CostCodeSearch" autocomplete="off" readonly>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                       {!! $errors->first('cost_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                </div> 

                <div class="col-md-6">

                  <div class="form-group">

                    <label>Cost Group : <span class="required-field"></span></label>
                    
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-object-group"></i></span>

                        <!--   <select class="form-control" name="costgroup_code" id="costgroup_code" value="{{ old('costgroup_code')}}" maxlength="6" autocomplete="off">
                            <option value="">--SELECT--</option>
                          </select> -->
                      <input list="costgroupList" name="costgroup_code" id="costgroup_code" class="form-control" value="{{old('costgroup_code')}}" autocomplete="off">
                      
                      <datalist id="costgroupList">
                        
                      </datalist>

                      <input type="hidden" name="costgroup_name" id="costgroup_name" value="">

                    </div>


                    <div class="pull-left showSeletedName" id="costgrpText"></div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('costgroup_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                  </div>

                </div>
            </div>

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label>Cost Category :<span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>

                     <?php $catgcount = count($costcatg_list); ?>

                    <input list="costCatList" type="text" class="form-control" name="costcatg_code" id="costcatg_code" placeholder="Select Cost Category" maxlength="6" value="<?php if($catgcount == 1){echo $costcatg_list[0]->CCATG_CODE;}else{echo old('costcatg_code');}?>" autocomplete="off">
                          
                    <datalist id="costCatList"> 
                      <option value="">--SELECT--</option>
                      @foreach($costcatg_list as $key)

                       <option value="{{ $key->CCATG_CODE }}" data-xyz="{{ $key->CCATG_NAME }}"> {{ $key->CCATG_CODE }} = {{ $key->CCATG_NAME }}</option>

                      @endforeach
                    </datalist>
                    <input type="hidden" id="costcatg_name" name="costcatg_name" value="<?php if($catgcount == 1){echo $costcatg_list[0]->CCATG_NAME;}else{echo old('costcatg_name');}?>">
                  </div>

                  <div class="pull-left showSeletedName" id="costCatText"></div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('costcatg_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">

                  <label>Cost Class :<span class="required-field"></span></label>

                    <div class="input-group"> 
                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                      <?php $classcount = count($costclss_list); ?>
                    
                      <input list="costClassList" type="text" class="form-control" name="costclass_code" id="costclass_code" placeholder="Select Cost Class" maxlength="6" value="<?php if($classcount == 1){echo $costclss_list[0]->CCLASS_CODE;}else{echo old('costclass_code');}?>" autocomplete="off">

                      <datalist id="costClassList">

                        <option value="">--SELECT--</option>

                           @foreach($costclss_list as $key)

                           <option value="{{ $key->CCLASS_CODE }}" data-xyz="{{ $key->CCLASS_NAME }}"> {{ $key->CCLASS_CODE }} = {{ $key->CCLASS_NAME }}</option>

                          @endforeach

                      </datalist>

                      <input type="hidden" id="costclass_name" name="costclass_name" value="<?php if($classcount == 1){echo $costclss_list[0]->CCLASS_NAME;}else{echo old('costclass_name');}?>">
                    </div>

                    <div class="pull-left showSeletedName" id="costClassText"></div>
                        <small id="emailHelp" class="form-text text-muted">

                           {!! $errors->first('costclass_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>
                    </div>

              </div>

              </div>

              <!-- /.row -->
              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                  <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

          </div>


      </div>

      <div class="col-sm-3">

        <div class="box-tools pull-right">

          <a href="{{ url('/Master/Cost-Center/View-Cost-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Cost Master</a>

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

         document.getElementById("compText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

        });


  $("#costtype_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#costList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("costText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             $('#costgroupList').empty();
             $('#costtype_name').val('');

          }else{
             $('#costtype_name').val(msg);
            // funGenCostCode(val);
          }

        });

  $("#costgroup_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#costgroupList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          document.getElementById("costgrpText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             $('#costgroup_name').val('');
          }else{
             $('#costgroup_name').val(msg);
          }

        });





  $("#costcatg_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#costCatList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("costCatText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             $('#costcatg_name').val('');

          }else{
            $('#costcatg_name').val(msg);
          }

  });


  $("#costclass_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#costClassList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("costClassText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             $('#costclass_name').val('');

          }else{
             $('#costclass_name').val(msg);
          }

        });

  $("#pfct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#pfctList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("pfctText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

        });
   });
</script>

<script type="text/javascript">

  

  $(document).ready(function() {



    $('.Number').keypress(function (event) {

      var keycode = event.which;

      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

          event.preventDefault();

      }

    });





  });

</script>


<script type="text/javascript">

function funGenCostCode(element){
  console.log('in');

    var tbl_name = 'MASTER_COST';
    var col_code = 'COST_CODE';

    var cost_type = $('#costtype_code').val();
    var cost_name = $('#cost_name').val();

    if(cost_name!= '' && cost_type !=''){

      var max_chars = 1;

      var element_value ;
      if(cost_name.length >= max_chars) {
        element_value = element.value.substr(0, 1);
        element_value = element_value.toUpperCase();
      }else if(cost_name.length <= 1){
        console.log('hello');
         $('#CostCodeSearch').val('');
      }else{
        $('#CostCodeSearch').val('');
      }
      
      // if(cost_type){
      //   var genct_code = cost_type.substr(0, 2);
      //   var costtype = genct_code;
      // }
      
      var likename = cost_type+''+element_value;
      console.log('datat',likename);
      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

       });

      $.ajax({

       url:"{{ url('/Master/generate-dyanamic-code') }}",

       data: {likename:likename,tbl_name:tbl_name,col_code:col_code},

        success:function(data){
          var data1 = JSON.parse(data);

          if(data1.response == 'success'){

            var newcode = data1.data;
            
            if(newcode != '' || newcode != null){
              $('#CostCodeSearch').val(newcode);
            }else{
              $('#CostCodeSearch').val('');
            }

          }
        }
      });

    }else{
      $('#CostCodeSearch').val('');
      $('#CostCodeSearch').prop('readonly',true);
    }
  
  }
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#CostCodeSearch').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var CostCodeSearch = $('#CostCodeSearch').val();

        if(CostCodeSearch == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-cost-code-get') }}",

             method : "POST",

             type: "JSON",

             data: {CostCodeSearch: CostCodeSearch},

             success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                       var objcity = data1.data;
                       $('#shoemsgonin').html('');
                       $('#showSearchCodeList').show();
                          $('#showSearchCodeList').empty();
                         $.each(objcity, function (i, objcity) {
                           $('#showSearchCodeList').append('<span class="custom-option">'+
                            objcity.COST_CODE+'</span><br>');
                         });
                        
                  }
             }

          });
       }

    });

    $("body").click(function() {
        $("#showSearchCodeList").hide("fast");
    });
  });
</script>

<script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script>

<script type="text/javascript">

  

      $("#costtype_code" ).change(function() {



           $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        

      var costtype_code = $("#costtype_code").val();

     // alert(comp_code);return false;





      $.ajax({

        url: "{{ url('/get-cost-group-by-cost-type') }}",

        method : 'POST',

        type: 'JSON',

        data: {costtype_code: costtype_code},

        success:function(data){

          var data1 = JSON.parse(data);

          // console.log('data',data1.data);

          if(data.data == ''){
             $("#costgroupList").empty();
             $("#costgroup_code").prop('readonly',true);

          }else{
             $("#costgroup_code").prop('readonly',false);
          }

          $("#costgroupList").empty();

          $.each(data1.data, function(k, getData){

            $("#costgroupList").append($('<option>',{

              value:getData.CGROUP_CODE,

              'data-xyz':getData.CGROUP_NAME,
              text:getData.CGROUP_NAME

            }));

          });

        }

      })

      // .done(function(data) {



      // // alert(data);return false;



      //  // var obj = $.parseJSON(data);




      //   $("#costgroup_code").html(data);



      // })

    

    });



</script>



@endsection