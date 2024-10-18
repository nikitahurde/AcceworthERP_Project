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
  .showinmobile{
  display: none;
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



           Master Remark



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

           

            <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Master Remark</a></li>

            <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Add Remark</a></li>

           

           <?php } else { ?>



             <li class="Active"><a href="{{ URL('/Master/Item/Edit-Item-Group-Mast/'.base64_encode($id))}}">Add  Remark</a></li>

             <li class="Active"><a href="{{ URL('/Master/Item/Edit-Item-Group-Mast/'.base64_encode($id))}}">Update  Remark</a></li>

           <?php } ?>

            



          </ol>



        </section>



  <section class="content">


    <div class="row col-md-12">
      
    </div>
    <div class="row">



      <div class="col-md-2"></div>





      <div class="col-md-8">



        <div class="box box-primary Custom-Box" >

          <div class="box-header with-border" style="text-align: center;">

            <?php if($button=='Save') { ?>

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add  Remark</h2>
               <div class="box-tools pull-right">

                <a href="{{ url('/Master/Setting/View-Master-Remark') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View  Remark</a>

              </div>



             <?php } else{  ?>



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update  Remark</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/Master/Setting/View-Master-Remark') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View  Remark</a>

              </div>

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







          <div class="box-body">

            <form action="{{ url($action) }}" method="POST" >

                     @csrf

                     <div class="row">

                      

                        <div class="col-md-3">

                          <div class="form-group">

                            <label>

                              Transaction Code : 

                              <span class="required-field"></span>

                            </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                                 <input list="tcodeList" type="text" class="form-control" name="t_code" id="t_code" value="{{$t_code}}" placeholder="T Code" maxlength="6" <?php if($button=='Update'){ echo 'readonly';} ?>>
                                <datalist id="tcodeList">
                                
                                  @foreach($tranCodeList as $rows)
                     
                                    <option value="{{ $rows->TRAN_CODE }}" data-xyz ="{{ $rows->TRAN_HEAD }}">{{ $rows->TRAN_CODE }} = {{ $rows->TRAN_HEAD}}</option>

                                  @endforeach
                                </datalist>

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                                  {!! $errors->first('t_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
                           
                            </div>

                          <!-- /.form-group -->

                        </div>



                        <div class="col-md-5">

                          <div class="form-group">

                            <label>

                              Transaction Name: 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input type="text" class="form-control" name="t_name" id="t_name" value="{{$t_name}}" placeholder="EnterTransaction Name" readonly="">
                  
                                  
                            </div> 
                            
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('t_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                          <!-- /.form-group -->

                        </div>

                        <div class="col-md-4">

                          <div class="form-group">

                            <label>

                             Sr No : 

                              <span class="required-field"></span>

                            </label>


                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                                <input type="text" class="form-control"  id="srno" name="srno" value="{{$srno}}" placeholder="" readonly="">

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('srno', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                          <!-- /.form-group -->

                        </div>

                    </div>

                    <!-- /.row -->



                    <div class="row">

                      <div class="col-md-8">

                          <div class="form-group">

                            <label>

                             Remark : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                                 <textarea id="remark" name="remark" rows="3" class="form-control" placeholder="Remarks">{{$remark}}</textarea>

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('remark', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                          <!-- /.form-group -->

                        </div>

                    </div>

                    <?php if($button == 'Update') { ?>
                      <input type="hidden" name="remark_id" value="{{$id}}">
                    <?php } ?>

                    <div style="text-align: center;">

                       <button type="Submit" class="btn btn-primary">

                      <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}}

                       </button>

                    </div>

                  </form>

            </div><!-- /.box-body -->



           



          </div>



      </div>



  </div>



     



  </section>



</div>


@include('admin.include.footer')


<script type="text/javascript">

 $("#t_code").bind('change', function () {  

    var val = $(this).val();
    var xyz = $('#tcodeList option').filter(function() {

    return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
      
      $('#t_name').val('');

    }else{
      
      $('#t_name').val(msg);
      var tcode = $('#t_code').val();

      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });
  
        $.ajax({

            type: 'POST',

            url: "{{ url('/Master/Setting/TCODEInformation') }}",

            
            data: {tcode:tcode},

            success: function (data) {

              var obj = JSON.parse(data);

              if(obj.response == 'success'){
                console.log('srno');
                console.log('srnodb',obj.data);
                var srNo = obj.data;

                $('#srno').val(srNo);

              }
            }
          })
    }
});


</script>



@endsection