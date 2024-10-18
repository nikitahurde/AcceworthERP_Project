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


   box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);



  }

  .showSeletedName{



    font-size: 15px;



    margin-top: 2%;



    text-align: center;



    font-weight: 600;



    color: #4f90b5;



  }
.rightcontent{

  text-align:right;


}
.creditCls{
  display: none;
}
::placeholder {
  
  text-align:left;
}
.showinmobile{
  display: none;
}
.SubmitBtn{
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

}

</style>






<div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



            Master District 



            <small> Add Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/master/geogaraphycal/district-master')}}">Geographical  </a></li>



            <li class="Active"><a href="{{ URL('/master/geogaraphycal/district-master')}}">Add District </a></li>



          </ol>



        </section>



  <section class="content">



    <div class="row">



      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add District</h2>

               <div class="box-tools pull-right">

                <a href="{{ url('/master/geogaraphycal/view-district-master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View District</a>

              </div>



            </div><!-- /.box-header -->



             @if(Session::has('alert-success'))


              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">


                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>

                  <i class="icon fa fa-check"><i>

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


              <form action="{{ url('/master/geogaraphycal/district-master-save') }}" method="POST" id="CountryForm">

                @csrf

                  <div class="row">

                    <div class="col-lg-12">

                      <div class="row">

                        <div class="col-sm-4">
                          
                          <div class="form-group">

                            <label>

                             District Name : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                                <input type="text" class="form-control" name="district_name" id="districtName" value="{{old('district_name')}}" oninput="funGenDistCode(this)" placeholder="Enter District Name" autocomplete="off">

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('district_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                        </div>

                        <div class="col-sm-4">
                          
                          <div class="form-group">

                            <label>

                             District Code : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input type="text" class="form-control" name="district_code" id="districtCode" value="" placeholder="District Code" autocomplete="off" readonly="">

                            </div> 

                            <small id="distCodeErr" style="font-weight:600;"></small>

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('district_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                        </div>
                        
                        <div class="col-sm-4">
                          
                          <div class="form-group">

                            <label>

                             State Code : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input list="stateList" class="form-control" name="state_code" id="stateCode" value="{{old('state_code')}}" placeholder="Enter State Code" maxlength="6" autocomplete="off">

                                <datalist id="stateList">

                                  <option selected="selected" value="">-- Select --</option>

                                  @foreach ($state_list as $key)

                                  <option value='<?php echo $key->STATE_CODE; ?>'   data-xyz ="<?php echo $key->STATE_NAME; ?>"><?php echo $key->STATE_NAME ; echo " [".$key->STATE_CODE."]" ; ?></option>

                                  @endforeach

                                </datalist>

                            </div> 
                            <input type="hidden" id="state_name" name="state_name" value="">

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('state_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                        </div>

                      </div>


                      
                    </div>

                  </div>

                  <div style="text-align: center;">
                
                     <button type="Submit" class="btn btn-primary" id="submitdata">
                    

                    <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                     </button>
                     <button class="btn btn-warning"><i class="fa fa-refresh"></i>&nbsp;&nbsp; Reset</button>

                  </div>
                  

              </form>

            </div>

          </div>

        </div>

      </div>

    </section>

</div>


@include('admin.include.footer')



<script type="text/javascript">

  function funGenDistCode(element){

    var distName = $('#districtName').val();
    var tbl_name = 'MASTER_DISTRICT';
    var col_code = 'DISTRICT_CODE';
    
    if(distName){

      var max_chars = 3;
  
      var element_value ;
      if(distName.length >= max_chars) {
        element_value = element.value.substr(0, 3);
        element_value = element_value.toUpperCase();
      }else if(distName.length <= max_chars){
         $('#districtCode').val('');
      }else{
        $('#districtCode').val('');
      }
   
      // var aname = element_value;
      var likename = element_value;
      
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
              $('#districtCode').val(newcode);
            }else{
              $('#districtCode').val('');
            }

          }
        },
        error:function(){
          
          $('#distCodeErr').html('*District Code is not Generated...!').css('color','red');
          $('#submitdata').prop('disabled',true);

        }
      }); /* /.ajax*/

    }else{
      $('#districtCode').val('');
    } /* /. codn*/
     
  }

 

$(document).ready(function(){
  
  $("#stateCode").bind('change', function () {  



    var val = $(this).val();



    var xyz = $('#stateList option').filter(function() {



    return this.value == val;



    }).data('xyz');



    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){

      $('#state_name').val('');

    }else{
      $('#state_name').val(msg);
    }



  });



    });

</script>



@endsection