@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



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

    /*border: 1px solid #e0dcdc;

    border-radius: 10px;

*/    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  .rightcontent{

  text-align:right;


}

::placeholder {
  
  text-align:left;
}

.showinmobile{
  display: none;
}

.showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }
@media screen and (max-width: 600px) {

  .showinmobile{

    display: block;

  }
  .PageTitle{
    float: left;
  }
  .hideinmobile{
    display: none;
  }

}

</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master Item UM

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/form-mast-itemum') }}">Master Item UM</a></li>

            <li class="active"><a href="{{ url('/form-mast-itemum') }}">Add Item UM</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-1"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Item UM </h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/Master/Item/View-ItemUM_Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item UM</a>

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

            <form action="{{ url('/Master/Item/form-mast-itemum-save') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Item Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input list="itemList" type="text" class="form-control" name="item_code" id="item_code" placeholder="Select Item Code" maxlength="15">

                          <datalist id="itemList">
                          
                            <option value="">--SELECT ITEM--</option>

                            @foreach($item_code as $key)

                            <option value="{{ $key->ITEM_CODE }}" data-xyz="{{$key->ITEM_NAME}}">{{ $key->ITEM_CODE }} [{{$key->ITEM_NAME}}]</option>

                            @endforeach

                          </datalist>

                        </div>

                         <div class="pull-left showSeletedName" id="itemText"></div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('item_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       UM Code : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-arrow-right"></i></span>

                          <input type="text" class="form-control" name="um_code" id="um_code" placeholder="Select UM" maxlength="3" readonly="">

                        

                      </div>
                      <div class="pull-left showSeletedName" id="umText"></div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('um_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                <!-- /.col -->

                

              </div>

              <!-- /.row -->



              <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        AUM: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input list="aumList" name="aum" id="aum" class="form-control" placeholder="Enter AUM" value="{{ old('aum')}}" maxlength="3" >

                          <datalist id="aumList">

                            <option value="">--SELECT AUM--</option>

                          @foreach($um_code as $key)

                            <option value="{{$key->UM_CODE}}" data-xyz="{{$key->UM_NAME}}">{{ $key->UM_CODE }}-{{ $key->UM_NAME }}</option>


                            @endforeach


                          </datalist>

                        </div>

                          <small id="aumerror" class="form-text text-muted" style="color: red;">



                            {!! $errors->first('aum', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                          <small id="aumserror" class="form-text text-muted"></small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        AUM Factor: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" name="aum_factor" class="form-control rightcontent" placeholder="Enter AUM Factor" value="{{ old('aum_factor')}}" maxlength="30">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('aum_factor', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                <!-- /.col -->

                

              </div>





              

              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary" id="submitbtn">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-3 hideinmobile">

        <div class="box-tools pull-right">

          <a href="{{ url('/Master/Item/View-ItemUM_Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item UM</a>

        </div>

      </div>



    </div>

     

  </section>

</div>



@include('admin.include.footer')

<script type="text/javascript">
  
      $("#item_code" ).change(function() {

           $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
         });
        
      var item_code = $("#item_code").val();
      //alert(comp_name);return false;


      $.ajax({
        url: "{{ url('get_um_aum') }}",
        method : 'POST',
        type: 'JSON',
        data: {item_code: item_code},
      })
      .done(function(data) {

       var obj = $.parseJSON(data);

       $("#um_code").val(obj.UM);
       $("#aum").val(obj.AUM);

       //$("#aum").prop( 'readonly', true );
        //$("#macc_year").html(data);

        if(item_code && obj.UM && obj.AUM){
            //$("#submitbtn").prop('disabled',true);
            //$("#aumerror").html('The aum has already been taken for this item code');
        }else{
          // $("#submitbtn").prop('disabled',false);
           $("#aumerror").html('');
        }

      })
    
    });

</script>


<script type="text/javascript">
  
      $("#aum" ).change(function() {

           $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
         });
        
      var aum = $("#aum").val();
      var item_code = $("#item_code").val();
      //alert(comp_name);return false;


      $.ajax({
        url: "{{ url('get_um_aum') }}",
        method : 'POST',
        type: 'JSON',
        data: {item_code: item_code},
      })
      .done(function(data) {

       var obj = $.parseJSON(data);

       $("#um_code").val(obj.um);
       
       $("#um_code").prop('readonly', true);

       //$("#aum").prop( 'readonly', true );
        //$("#macc_year").html(data);

        if(aum == obj.aum){

          //alert('aum aleready exit');
          $("#aumerror").html('The aum has already been taken for this item code');

          $("#submitbtn").prop('disabled',true);
        }else{
          $("#submitbtn").prop('disabled',false);
          $("#aumerror").html('');
        }

      })
    
    });

</script>

<script type="text/javascript">
  $(document).ready(function(){

  $("#item_code").bind('change', function () {  

          var val = $(this).val();


          var xyz = $('#itemList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

        // document.getElementById("itemText").innerHTML = msg; 

          if(msg=='No Match'){
             $(this).val('');
             $('#um_code').val('');
             $('#aum').val('');

          }

        });

  $("#um_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#umcodeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("umText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

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
  $("#aum" ).change(function() {

    var aum_code = $(this).val();
    var um_code = $("#um_code").val();

    if(um_code==aum_code){
      $(this).val('');
      $("#aumserror").html('UM And AUM Can Not Be Same.').css('color','red');
    }else{
      $("#aumserror").html('');
    }


  });
</script>


@endsection