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

.beforhidetble{
  display: none;
}
.popover{
    left: 70.4922px!important;
    width: 110%!important;
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

    <section class="content-header">

      <h1>Master Project Details <small>Add Details</small> </h1>


      <ol class="breadcrumb">


        <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ URL('/dashboard')}}">Master</a></li>
        
        <li class="Active"><a href="#">Master Project Detail</a></li>

        <li class="Active"><a href="#">Add Project Details</a></li>

      </ol>

    </section>

    <section class="content">

    <div class="row">

     <!-- <div class="col-sm-1"></div> -->

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Project Detail</h2>

            <div class="box-tools pull-right">

              <a href="{{ url('/Master/Infrastructure/View-Project-Detail-Master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Project Detail</a>

            </div>
         
          </div><!-- /.box-header -->
          
          @if(Session::has('alert-success'))

          <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">
          
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

              <h4><i class="icon fa fa-check"></i>

                 Success...!

              </h4>

              {!! session('alert-success') !!}

          </div>

          @endif

          @if(Session::has('alert-error'))

          <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

             <h4> <i class="icon fa fa-ban"></i>

                Error...!
             </h4>

             {!! session('alert-error') !!}
          </div>

          @endif

          <div class="box-body">
            <form action="#" method="POST" enctype="multipart/form-data" id="projectDetailForm">
            <div class="row">

            <div class="col-sm-12">

              <div class="box box-primary Custom-Box">

                <div class="box-body">

                  <div class="table-responsive">

                    <table class="table tdthtablebordr" border="1" cellspacing="0" id="tblProj_details">

                      <tr>

                        <th>

                          <input class='check_all' type='checkbox' onclick="select_all()" title="Delete All Row">

                        </th>

                        <th>Sr.No.</th>

                        <th>Project Code <small style="color:red;font-size:14px;text-align:center;">*</small> </th>

                        <th>Wing No <small style="color:red;font-size:14px;">*</small></th>

                        <th>Tower No <small style="color:red;font-size:14px;">*</small></th>

                        <th>Floor No <small style="color:red;font-size:14px;">*</small></th>
                        
                        <th>Units <small style="color:red;font-size:14px;">*</small></th>
                        
                      </tr>

                      <?php if($data){ ?>

                       <tr class="useful">
                        
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          <input type='checkbox' class='case' title="Delete Single Row" onclick="select_all()"/  disabled="">
                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <span id='snum'>1.</span>

                          <input type='hidden' name='ProjectInfoDetlSlno[]' id='ProjectInfoDetlSlno' value='1'>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          <input type="text" name="projectId" id="projectId" value="{{$data->PROJECTID}}">
                          <input list='projectcode_list' name='project_code' id='project_code1' value='{{$data->PROJECT_CODE }} - {{$data->PROJECT_NAME}}' class='' style="margin-bottom:5px;" autocomplete="off" onclick="funProjCode(1)" >

                          <datalist id='projectcode_list'>
                            <?php foreach($project_code as $key) { ?>

                            <option value='<?= $key->PROJECT_CODE ?> - <?= $key->PROJECT_NAME ?>' data-xyz='<?= $key->PROJECT_NAME?>'>{{ $key->PROJECT_CODE   }} = {{ $key->PROJECT_NAME  }}</option>

                            <?php } ?>
                          </datalist>


                          <small id="project_codeErr1"></small>

                        </td>
                        
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                         <input type="text" name='wing_no' id='wing_no1' class=""  autocomplete="off" style="margin-bottom:5px;" maxlength="3" value="{{$data->WING_NO  }}"><br>
                         
                          <small id="wing_noErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type="text" name='tower_no' id='tower_no1' class=""  autocomplete="off" style="margin-bottom:5px;"  maxlength="3" value="{{$data->TOWER_NO }}"><br>

                          <small id="tower_noErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type="text" name='floorNo' id='floorNo1'  value="{{$data->FLOOR_NO }}" class="Number" autocomplete="off" style="margin-bottom:5px;"  maxlength="3"><br>

                         <small id="floorNoErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type="text" name='unit' id='unit1' value="{{$data->UNIT_NO  }}" class="Number" autocomplete="off" style="margin-bottom:5px;" maxlength="6"><br>

                         <small id="unitErr1"></small>

                        </td>
                      </tr> 

                     

                      <?php } ?>

                      

                    </table>

              </div>

             <!--  <button type="button" class='btn btn-danger delete' id="deleteFunction"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

              <button type="button" class='btn btn-info addmore' id="addmorhidn"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>
 -->
              <div class="text-center col-md-12">
                
                <button type="button" class="btn btn-success" id="AddProjectDetail"><i class="fa fa-floppy-o"></i> Update</button>
                <button class="btn btn-warning" id="btnReset" type="reset"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp;Reset</button>
              </div>
             </div>

            </div>
        </div>
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

function funProjCode(id){

 $("#project_code"+id).bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#projectcode_list option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

     if(msg == 'No Match'){
      $('#project_code'+id).val('');
     }else{

     }
    })
  }  

$(function(){

  var i=2;

  $(".addmore").on('click',function(){
        
        count=$('#tblProj_details tr').length;

        countTr = count-1;
        
        var project_code  =  $('#project_code'+countTr).val();

        if(project_code == ''){
          $('#project_codeErr'+countTr).html('Project Code Is Required').css('color','red');
          return false;
        }
        else{
          $('#project_codeErr'+countTr).html('');
        }
        

        var wing_no  =  $('#wing_no'+countTr).val();

        if(wing_no == ''){
          $('#wing_noErr'+countTr).html('Wing No Is Required').css('color','red');
          return false;
        }else{
          $('#wing_noErr'+countTr).html('');
        }
        
        var tower_no  =  $('#tower_no'+countTr).val();
        if(tower_no == ''){
          $('#tower_noErr'+countTr).html('Tower No Is Required').css('color','red');
          return false;
        }else{
          $('#tower_noErr'+countTr).html('');
        }

        var floorNo  =  $('#floorNo'+countTr).val();
        if(floorNo == ''){
          $('#floorNoErr'+countTr).html('Floor No Is Required').css('color','red');
        return false;

        }else{
        
        $('#floorNoErr'+countTr).html('');
        }

        var unit  =  $('#unit'+countTr).val();

        if(unit == ''){
          $('#unitErr'+countTr).html('Unit Is Required').css('color','red');
        return false;

        }else{

          $('#unitErr'+countTr).html('').css('color','red');

        var data="<tr><td class='tdthtablebordr' style='padding-top: 23px;'><input type='checkbox' class='case'/></td><td class='tdthtablebordr' style='padding-top: 22px;'><span id='snum"+i+"'>"+count+".</span><input type='hidden' name='ProjectInfoDetlSlno[]' id='ProjectInfoDetlSlno' value='"+count+"'></td>";

        data +="<td class='tdthtablebordr' style='padding-top: 2%;'><input list='projectcode_list' name='project_code[]' id='project_code"+count+"' value='' class='' style='margin-bottom:5px;'' autocomplete='off' onclick='funProjCode("+count+")'><datalist id='projectcode_list'><?php foreach($project_code as $key) { ?><option value='<?= $key->PROJECT_CODE ?> - <?= $key->PROJECT_NAME ?>' data-xyz='<?= $key->PROJECT_NAME?>'>{{ $key->PROJECT_CODE   }} = {{ $key->PROJECT_NAME  }}</option> <?php } ?></datalist><small id='project_codeErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input type='text' name='wing_no[]' id='wing_no"+count+"' class=''  autocomplete='off' style='margin-bottom:5px;'><br><small id='wing_noErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input type='text' name='tower_no[]' id='tower_no"+count+"' class=''  autocomplete='off' style='argin-bottom:5px;'><br><small id='tower_noErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'> <input  type='text' name='floorNo[]' id='floorNo"+count+"' class='' autocomplete='off' style='margin-bottom:5px;'><br><small id='floorNoErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'> <input  type='text' name='unit[]' id='unit"+count+"' class='' autocomplete='off' style='margin-bottom:5px;'><br><small id='unitErr"+count+"'></small></td></tr>";

        $('#tblProj_details').append(data);

        i++;

       
       
       }

    });

});

$(".delete").on('click', function() {
   
   
   $('.case:checkbox:checked').parents('#tblProj_details tr').remove();

    $('.check_all').prop("checked", false); 

    check();

});

function check(){

      obj = $('#tblProj_details tr').find('span');
      
      $.each( obj, function( key, value ) {

          id=value.id;

          $('#'+id).html(key+1);

      });

}

$('#AddProjectDetail').on('click',function(){

  var data         = $('#projectDetailForm').serialize();

  var count        = $('#tblProj_details tr').length;
  var trCount      = count-1;

  console.log('count',count);
  console.log('trCount',trCount);
  for(var q=0;q<trCount;q++){

       var w = q +1;
       console.log('w',w);

       var project_code =  $('#project_code'+w).val();
       var wing_no =  $('#wing_no'+w).val();
       var tower_no =  $('#tower_no'+w).val();
       var floorNo =  $('#floorNo'+w).val();
       var unit =  $('#unit'+w).val();


       if(project_code == ''){
          $('#project_codeErr'+w).html('Project Code Is Required').css('color','red');
          return false;
        }
        else{
          $('#project_codeErr'+w).html('');
        }
        

        var wing_no  =  $('#wing_no'+w).val();

        if(wing_no == ''){
          $('#wing_noErr'+w).html('Wing No Is Required').css('color','red');
          return false;
        }else{
          $('#wing_noErr'+w).html('');
        }
        
        var tower_no  =  $('#tower_no'+w).val();
        if(tower_no == ''){
          $('#tower_noErr'+w).html('Tower No Is Required').css('color','red');
          return false;
        }else{
          $('#tower_noErr'+w).html('');
        }

        var floorNo  =  $('#floorNo'+w).val();
        if(floorNo == ''){
          $('#floorNoErr'+w).html('Floor No Is Required').css('color','red');
        return false;

        }else{
        
        $('#floorNoErr'+w).html('');
        }

        var unit  =  $('#unit'+w).val();

        if(unit == ''){
          $('#unitErr'+w).html('Unit Is Required').css('color','red');
        return false;

        }else{
          $('#unitErr'+w).html('');

          $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

          });

          $.ajax({

               type: 'POST',

               url: "{{ url('/Master/Infrastructure/Update-Project-Detail-Master') }}",
               
               data: data,

               success: function (data) {
               var data1 = JSON.parse(data);
               
               if(data1.response == 'success'){
             
                // location.reload();

                 window.location.href = "{{ url('/Master/Infrastructure/View-Project-Detail-Master')}}";

               
               }else{

               }

              }
          });

        }

  }

  // console.log('data',data);

})

$(document).ready(function(){

    $('.Number').keypress(function (event) {

      var keycode = event.which;

      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

          event.preventDefault();

      }

  });

});

</script>











@endsection