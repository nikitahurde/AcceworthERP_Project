@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')



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
  font-size: 12px;
  margin-top: 0%;
  font-weight: 600;
  color: #4f90b5;
  line-height: 1;
  border:none;
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

           Master General Schedule

            <small>Update Details</small>

          </h1>

         <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/Master/General-Ledger/Edit-Glsch/'.base64_encode($glsch_list->GLSCH_CODE))}}">Master General Schedule </a></li>

            <li class="Active"><a href="{{ URL('/Master/General-Ledger/Edit-Glsch/'.base64_encode($glsch_list->GLSCH_CODE))}}">Update General Schedule </a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-7">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update General Schedule</h2>

              <div class="box-tools pull-right showinmobile">

              <a href="{{ url('/Master/General-Ledger/View-Glsch') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View General Schedule</a>

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

            <form action="{{ url('form-glsch-update') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        General Schedule Type : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                          <input type="hidden" name="glschCod" value="{{ $glsch_list->GLSCH_CODE }}">

                          <input list="glschList" type="text" name="glsch_type" id="glsch_type" class="form-control" value="{{ $glsch_list->GLSCH_TYPE }}" autocomplete="off">

                          <!-- <datalist id="glschList">
                            <option value="">--Select--</option>
                            <option value="Asses" <?php if($glsch_list->GLSCH_TYPE == 'Asses'){ echo "selected"; }else{ echo '';} ?>>Asses</option>
                            <option value="Liability" <?php if($glsch_list->GLSCH_TYPE == 'Liability'){ echo "selected"; }else{ echo '';} ?>>Liability</option>
                            <option value="Expenditure" <?php if($glsch_list->GLSCH_TYPE == 'Expenditure'){ echo "selected"; }else{ echo '';} ?>>Expenditure</option>
                            <option value="Revenue" <?php if($glsch_list->GLSCH_TYPE == 'Revenue'){ echo "selected"; }else{ echo '';} ?>>Revenue</option>
                            <option value="Others" <?php if($glsch_list->GLSCH_TYPE == 'Others'){ echo "selected"; }else{ echo '';} ?>>Others</option>
                         

                          </datalist> -->
                          <datalist id="glschList">
                            <option value ="">--Select--</option>
                            <option value ="A" data-xyz="ASSETS">ASSETS</option>
                            <option value ="B" data-xyz="LIABILITIES">LIABILITIES</option>
                            <option value ="R" data-xyz="REVENUES">REVENUES</option>
                            <option value ="X" data-xyz="EXPENDITURES">EXPENDITURES</option>
                            <option value ="Z" data-xyz="OTHERS">OTHERS</option>
                         
                         </datalist>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('glsch_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                          

                    </div>
                    <div class="pull-left showSeletedName" id="glschText">{{ $glsch_list->GLSCH_NAME}}</div>
                    <!-- /.form-group -->

                  </div>
                </div>


                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       General Schedule Code : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                          <input type="text" class="form-control" name="glsch_code" id="glsch_code" value="{{ $glsch_list->GLSCH_CODE }}" placeholder="Enter Glsch Code" maxlength="20" readonly="" >

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('glsch_code', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        General Schedule Name : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          
                          <input type="text" class="form-control" name="glsch_name" value="{{ $glsch_list->GLSCH_NAME }}" placeholder="Enter Glsch Name" maxlength="30" autocomplete="off">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('glsch_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       General Schedule Sequence No : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input type="text" class="form-control " name="glsch_seqno" value="{{ $glsch_list->GLSCH_SEQNO }}" placeholder="Enter Glsch Sequense No" maxlength="4" autocomplete="off">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('glsch_seqno', '<p class="help-block" style="color:red;">:message</p>') !!}

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



                        General Schedule Block : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">


                          <input type="radio" class="optionsRadios1" name="glsch_block" value="YES" <?php if($glsch_list->GLSCH_BLOCK=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="glsch_block" value="NO" <?php if($glsch_list->GLSCH_BLOCK=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO


                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('pfct_block', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>
                
              </div>

              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-3">

        <div class="box-tools pull-right hideinmobile">

          <a href="{{ url('/Master/General-Ledger/View-Glsch') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View General Schedule</a>

        </div>

      </div>



    </div>

     

  </section>

</div>







@include('admin.include.footer')



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

 $("#glsch_type").on('change', function () {  
      
       document.getElementById("glschText").innerHTML = ''; 

        var val = $(this).val();

        var xyz = $('#glschList option').filter(function() {

          return this.value == val;

        }).data('xyz');
        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){

            $(this).val('');
            $("#glsch_code").val('');
             document.getElementById("glschText").innerHTML = '';
            
        }else{

          $("#glsch_code").val(val);

          document.getElementById("glschText").innerHTML = msg; 
        }
    
    });



   

  });


</script>
@endsection