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

::placeholder {
  
  text-align:left;
}

.showinmobile{
  display: none;
}

.beforhidetble{
  display: none;
}
.popover{
   left: 53.4922px!important;
    width: 128%!important;
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
     top: 80%;
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

  .showinmobile{

    display: block;

  }
  .PageTitle{
    float: left;
  }
  .hideinmobile{
    display: none;
  }
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

            Master Item Category Quality

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/finance/glsch')}}">Master Item Category Quality</a></li>

            <li class="Active"><a href="{{ URL('/finance/glsch')}}">Add Item Category Quality </a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-7">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Item Category Quality</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/finance/view-category-quality-master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item Cate Quality</a>

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

            <form action="{{ url('Master/Item/form-item-category-quality-save') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Item Category : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>

                         <input list="itemcatList" class="form-control" name="icatg_code" value="{{old('icatg_code')}}" placeholder="Select Item Category" id="item_category" maxlength="6">
                         
                          <datalist id="itemcatList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($item_cat_mast as $key)

                            <option value='<?php echo $key->ICATG_CODE?>'   data-xyz ="<?php echo $key->ICATG_NAME; ?>" ><?php echo $key->ICATG_NAME ; echo " [".$key->ICATG_CODE."]" ; ?></option>

                            @endforeach

                          </datalist>
                        </div>
                        <small>  
                          <div class="pull-left showSeletedName" id="itemcatText"></div>
                        </small>
                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('icatg_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       IQUA Char : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                         <input list="iquacharList" class="form-control" name="iqua_code" value="{{old('iqua_code')}}" placeholder="Select IQUA Char" id="iqua_char" maxlength="6">
                         
                          <datalist id="iquacharList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($item_qua_mast as $key)

                            <option value='<?php echo $key->IQUA_CODE?>'   data-xyz ="<?php echo $key->IQUA_NAME; ?>" ><?php echo $key->IQUA_CODE ; echo " [".$key->IQUA_NAME."]" ; ?></option>

                            @endforeach

                          </datalist>
                        </div>
                        <small>  
                          <div class="pull-left showSeletedName" id="iquacharText"></div>
                        </small>
                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('iqua_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  

              </div>

              <!-- /.row -->

              <div class="row">


                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       IQUA Um : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                         <input list="iqua_umList" class="form-control" name="iqua_um" value="{{old('iqua_um')}}" placeholder="Select IQUA Um" id="iqua_um" readonly="" maxlength="3">
                         
                         
                        </div>
                        <small>  
                          <div class="pull-left showSeletedName" id="iqua_umText"></div>
                        </small>
                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('iqua_um', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-6">
                      <div class="form-group">

                        <label> Char. F-value : <span class="required-field"></span>
                        </label>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                            <input type="text" class="form-control" name="char_fromvalue" value="{{ old('char_fromvalue') }}" id="char_fromvalue" placeholder="Enter Char Fvalue" autocomplete="off">
                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('char_fromvalue', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                      </div>
                  </div>
                
              </div>

              <!-- /.row -->

              <div class="row">
                  

                  <div class="col-md-6">
                      <div class="form-group">

                        <label> Char. To-value : <span class="required-field"></span>
                        </label>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                            <input type="text" class="form-control" name="char_tovalue" value="{{ old('char_tovalue') }}" id="char_tovalue" placeholder="Enter Char Tovalue" autocomplete="off">
                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('char_tovalue', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                      </div>
                  </div>
              </div>



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

        <div class="box-tools pull-right hideinmobile">

          <a href="{{ url('/Master/Item/View-Item-Category-Quality-Mast') }}" class="btn btn-primary" style="margin-right: 0px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item  Category Quality</a>

        </div>

      </div>



    </div>

     

  </section>

</div>



@include('admin.include.footer')

<script type="text/javascript">

$(document).ready(function(){
    $('.Number').keypress(function (event) {
      var keycode = event.which;
      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
          event.preventDefault();
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
  
    $("#glschType").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#glshList option').filter(function() {

          return this.value == val;

        }).data('xyz');
        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){

            $(this).val('');
            
        }
    
    });

  });
</script>

<script type="text/javascript">
  
      $("#iqua_char" ).change(function() {

           $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
         });
        
      var iqua_char = $("#iqua_char").val();
      //alert(comp_name);return false;


      $.ajax({
        url: "{{ url('get_item_desc_and_um') }}",
        method : 'POST',
        type: 'JSON',
        data: {iqua_char: iqua_char},
      })
      .done(function(data) {

       var obj = $.parseJSON(data);


       console.log(obj);

       $("#iqua_um").val(obj.IQUA_UM);
       $("#iqua_desc").prop( 'readonly', true );
       $("#iqua_um").prop( 'readonly', true );

        //$("#macc_year").html(data);

      })
    
    });

</script>


@endsection