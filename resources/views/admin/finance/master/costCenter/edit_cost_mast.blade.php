@extends('admin.main')





@section('AdminMainContent')





@include('admin.include.header')





@include('admin.include.navbar')


<meta name="csrf-token" content="{{ csrf_token() }}">



@include('admin.include.sidebar')





<style type="text/css">



  .PageTitle{



    margin-right: 1px !important;



  }



 .required-field::before {



    content: "*";



    color: red;



  }







  .Custom-Box {

  

   box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);



  }



</style>















<div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



            Master Cost



            <small>Update Details</small>



          </h1>





          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>



            <li class="active"><a href="{{ url('/Master/Cost-Center/Edit-Cost-Mast/'.base64_encode($mastCost_list->COST_CODE)) }}">Master Cost</a></li>



            <li class="active"><a href="{{ url('/Master/Cost-Center/Edit-Cost-Mast/'.base64_encode($mastCost_list->COST_CODE)) }}">Update Cost</a></li>



          </ol>



        </section>







	<section class="content">



    <div class="row">



      <div class="col-sm-1"></div>



      <div class="col-sm-8">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Cost Master </h2>



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



            <form action="{{ url('/Master/Cost-Center/Cost-Update') }}" method="POST" >



               @csrf



                <div class="row">

                  <div class="col-md-6">



                    <div class="form-group">



                      <label> Cost Code : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">


                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>


                          <input type="text" class="form-control" name="cost_code" value="{{ $mastCost_list->COST_CODE }}" placeholder="Enter Cost Code" maxlength="20" readonly="">



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('cost_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label> Cost Name : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="cost_name" value="{{ $mastCost_list->COST_NAME}}" placeholder="Enter Cost Name" maxlength="40">



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('cost_name', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->

                  </div>





                </div>



                <div class="row">



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Cost Type : <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                          <input list="costTypeList" class="form-control" name="costtype_code" id="costtype_code" value="{{$mastCost_list->CTYPE_CODE}}">

                          <datalist id="costTypeList">

                             @foreach($costype_list as $key)
                               
                               <option value="{{ $key->CTYPE_CODE }}" data-xyz="{{ $key->CTYPE_NAME }}">{{$key->CTYPE_CODE}} = {{$key->CTYPE_NAME}}  </option>

                             @endforeach
                            

                          </datalist>

                          <input type="hidden" id="costtype_name" name="costtype_name" value="{{$mastCost_list->CTYPE_NAME}}">

                         </div>



                        <small id="emailHelp" class="form-text text-muted">



                          {!! $errors->first('costtype_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                        </small>



                    </div>



                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Cost Group : <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-object-group"></i></span>

                          <input list="costgroupList"  class="form-control" id="costgroup_code" name="costgroup_code" value="{{$mastCost_list->CGROUP_CODE}}" readonly='true'>

                          <datalist id="costgroupList">
                            
                          </datalist>
                          <input type="hidden" id="costgroup_name" name="costgroup_name" value="{{$mastCost_list->CGROUP_NAME}}">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">



                          {!! $errors->first('costgroup_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                        </small>



                    </div>



                    <!-- /.form-group -->

                  </div>



                </div>



                <div class="row">

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>

                        Cost Category :<span class="required-field"></span>

                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>

                          <input list="costCatList" class="form-control" id="costcatg_code" name="costcatg_code" value="{{$mastCost_list->CCATG_CODE}}">

                          <datalist id="costCatList">

                            @foreach($costcatg_list as $key)

                              <option value="{{ $key->CCATG_CODE }}" data-xyz="{{ $key->CCATG_CODE }}"> {{ $key->CCATG_CODE }} = {{ $key->CCATG_NAME }}</option>


                            @endforeach
                            
                          </datalist>

                          <input type="hidden" id="costcatg_name" name="costcatg_name" value="{{$mastCost_list->CCATG_NAME}}">

                        </div>


                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('costcatg_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>


                    </div>


                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>

                        Cost Class :<span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                         <input list="costClassList"  class="form-control" id="costclass_code" name="costclass_code" value="{{ $mastCost_list->CCLASS_CODE }}">

                         <datalist id="costClassList">

                          @foreach($costclss_list as $key)

                            <option value="{{ $key->CCLASS_CODE }}" data-xyz="{{ $key->CCLASS_NAME }}"> {{ $key->CCLASS_CODE }} = {{ $key->CCLASS_NAME }}</option>

                          @endforeach
                           
                         </datalist>

                         <input type="hidden" id="costclass_name" name="costclass_name" value="{{ $mastCost_list->CCLASS_NAME }}">


                        </div>


                        <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('costclass_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                        </small>

                    </div>

                    <!-- /.form-group -->

                  </div>


                </div>

               
                <div class="row">

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>

                        Cost Block : 

                        <span class="required-field"></span>

                      </label>



                      <div class="input-group">



                          <input type="radio" class="optionsRadios1" name="cost_block" value="YES" <?php if($mastCost_list->COST_BLOCK=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                          <input type="radio" class="optionsRadios1" name="cost_block" value="NO" <?php if($mastCost_list->COST_BLOCK=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('cost_block', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>

                    <!-- /.form-group -->

                  </div>
               </div>


              <div style="text-align: center;">


                <input type="hidden" name="EcostId" value="{{ $mastCost_list->COST_CODE }}">

                 <button type="Submit" class="btn btn-primary">
                  <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

                 </button>


              </div>


            </form>


          </div><!-- /.box-body -->

          </div>


      </div>


      <div class="col-sm-3">


        <div class="box-tools pull-right">


          <a href="{{ url('/Master/Cost-Center/View-Cost-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Cost</a>

        </div>

      </div>


    </div>


	</section>


</div>

@include('admin.include.footer')

<script type="text/javascript">

   $("#costtype_code").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#costTypeList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){

         $(this).val('');
         $('#costgroupList').empty();
         $('#costtype_name').val('');
         $('#costgroup_code').val('');
         $('#costgroup_name').val('');

      }else{
        // console.log('read');
         $('#costtype_name').val(msg);
         $('#costgroup_code').prop('readonly',false);
         var costtype_code = val;
        
         $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

         $.ajax({

        url: "{{ url('/get-cost-group-by-cost-type') }}",

        method : 'POST',

        type: 'JSON',

        data: {costtype_code: costtype_code},

        success:function(data){

          var data1 = JSON.parse(data);

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
      }

  });

  $("#costgroup_code").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#costgroupList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){

         $(this).val('');
         $('#costgroup_name').val('');
      }else{
         $('#costgroup_name').val(msg);
          }

  });

  $("#costclass_code").bind('change', function () {  

    var val = $(this).val();

    var xyz = $('#costClassList option').filter(function() {

    return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';
    if(msg=='No Match'){

       $(this).val('');
       $('#costclass_name').val('');

    }else{
       $('#costclass_name').val(msg);
    }

  });

  $("#costcatg_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#costCatList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
          if(msg=='No Match'){

             $(this).val('');
             $('#costcatg_name').val('');

          }else{
            $('#costcatg_name').val(msg);
          }

  });

  $(document).ready(function() {



    $('.Number').keypress(function (event) {

      var keycode = event.which;

      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

          event.preventDefault();

      }

    });





  });

</script>











@endsection