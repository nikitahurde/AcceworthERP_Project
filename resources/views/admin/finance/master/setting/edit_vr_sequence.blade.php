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

</style>



<div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



            Master Vr Sequence


              <small>Update Details</small>

          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>


             <li class="Active"><a href="{{ URL('/finance/edit-vr-sequence/'.base64_encode($vrseq_id))}}">Master Vr Sequence</a></li>

             <li class="Active"><a href="{{ URL('/finance/edit-vr-sequence/'.base64_encode($vrseq_id))}}">Update Vr Sequence</a></li>

         

          </ol>



        </section>



  <section class="content">



    <div class="row">



      <div class="col-sm-2"></div>



      <div class="col-sm-7">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Master Vr Sequence</h2>


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



            <form action="{{ url($action) }}" method="POST" >



               @csrf



               <div class="row">



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Company Name : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>


                          <input list="compList" class="form-control" name="company_code" id="company_code" maxlength="6">

                         <datalist id="compList">

                            <option value="">--SELECT--</option>



                            @foreach($comp_list as $key)

                      

                            <option value="{{ $key->comp_code }}" > {{ $key->comp_code }} = {{ $key->comp_name }}</option>

                            @endforeach



                          </datalist>



                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}



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



                        Transaction Code : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <select class="form-control" name="tran_code" id="transactnid" maxlength="2">



                            <option value="">--SELECT--</option>



                            @foreach($transaction_list as $key)



                            <option value="{{ $key->tran_code }}" > {{ $key->tran_code }} = {{ $key->tran_head }}</option>



                            @endforeach



                          </select>



                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}



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



                        Series Code : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          

                          <select class="form-control" id="seriesid" name="series_code" maxlength="6">

                           
                            <option value="">--SELECT--</option>


                          </select>

                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('series_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                   <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        From No : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control rightcontent" name="from_no" value="" placeholder="Enter From No" maxlength="11">


                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('from_no', '<p class="help-block" style="color:red;">:message</p>') !!}



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



                        To No : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control rightcontent" name="to_no" value="" placeholder="Enter To No" maxlength="11">

                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('to_no', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                   <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Last No : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control rightcontent" name="last_no" value="" placeholder="Enter Last No" maxlength="11">


                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('last_no', '<p class="help-block" style="color:red;">:message</p>') !!}



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



                       House Block : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <input type="radio" class="optionsRadios1" name="vrseq_block" value="YES" <?php if($vrseq_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                          <input type="radio" class="optionsRadios1" name="vrseq_block" value="NO" <?php if($vrseq_block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO



                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('vrseq_block', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>







                    </div>



                    <!-- /.form-group -->



                  </div>



                </div>




              <div style="text-align: center;">



                 <button type="Submit" class="btn btn-primary">

                  <input type="hidden" name="vrseqId" value="{{$vrseq_id}}">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 



                 </button>



              </div>



            </form>



          </div><!-- /.box-body -->



           



          </div>



      </div>



      <div class="col-sm-3">



        <div class="box-tools pull-right">



          <a href="{{ url('/Master/Setting/View-Vr-Sequence') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Vr Sequence </a>



        </div>



      </div>







    </div>



  </section>



</div>





@include('admin.include.footer')


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
                              value: objcity.fy_code,
                              text : objcity.fy_code 
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

                      $('#seriesid').empty();
                      
                        $.each(objcity, function (i, objcity) {
                          $('#seriesid').append($('<option>', { 

                              value: objcity.series_code,
                              text : objcity.series_code 
                          }));
                        });
                  }
             }

          });

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
@endsection