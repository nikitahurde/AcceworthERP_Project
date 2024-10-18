@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')

<style>
  

  .text-right{
    text-align: right;
  }

  .datebill{
     width: 90px;
     text-align: right;
  }
  .texIndbox{
    text-align: left !important;
  }
  .texIndboxright{
    text-align: right !important;
  }
  .modltitletext {
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
}

</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Score Card Defination
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

             <small><b>Score Card Defination Details</b></small> 

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>Score Card Defination</a></li>
          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Score Card Defination</h3>

                  <div class="box-tools pull-right">

          <a href="#" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Score Card Defination</a>

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
              <form action="">
                <div class="box-body">

                <table id="example" class="table table-bordered table-striped table-hover">

                    <thead>

                      <tr>

                        <th class="text-left" style="width:10px;">Sr No</th>
                        <th class="text-left" style="width:170px;">Function</th>

                        <th class="text-left" style="width:170px;">Task List</th>

                        <th class="text-left" style="width:50px;">Weightage</th>

                        <th class="text-left" style="width:70px;">Self Score</th>
                        
                        <th class="text-left" style="width:70px;">Create Task</th>

                        <th class="text-left" style="width:50px;">Action</th>

                       </tr>

                    </thead>

                    <tbody>
                      <?php $srno = 1; ?> 
                        @foreach ($emptasklist as $row)
                     <tr>
                       <td>{{$srno}}</td>
                       <td>{{$row->FUNCTION}}</td>
                       <td>{{$row->TASK}}</td>
                       <td class="text-right">{{$row->WEIGHTAGE}}</td>
                       <td class="text-right">{{$row->SELF_SCORE}}</td>
                       <td>{{$row->CREATED_BY}}</td>
                       <td class="text-center">
                         <?php if($row->SELF_SCORE > 0) { ?>
                              <div>
                                <button type="button" disabled class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                              </button>
                              </div>
                              <div>
                                <small class="label label-success"><i class="fa fa-check"></i> Submitted</small>
                              </div>
                              <?php }  else { ?>
                              
                              <?php if($row->SELF_SCORE=='0') {?>
                                     <button type="button" onclick="return showSelfScore('<?= $row->SCORETASKID ?>','<?= $row->SCORECARDID ?>','<?= $row->SLNO ?>','<?= $row->FUNCTION ?>','<?= $row->TASK ?>','<?= $row->WEIGHTAGE?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                              </button>
                                <?php } } ?>
                       </td>

                     </tr>
                     <?php $srno++; ?>
                    @endforeach

                   </tbody>
                </table>

               </div><!-- /.box-body -->
               </form>   
              </div><!-- /.box -->

            </div><!-- /.col -->

          </div><!-- /.row -->

          <div class="modal fade" id="showselftaskList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



          <div class="modal-dialog modal-lg" role="document">



            <div class="modal-content">



              <div class="modal-header">



               <center><h3 class="modal-title" id="exampleModalLabel" style="font-size: 17px;color: #3c8dbc;">Score Card for Function Head</h3></center> 



                <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                  <span aria-hidden="true">&times;</span>



                </button>



              </div>

              <form action="{{ url('Add-Score-Self-Head') }}" method="post">

              @csrf

              <div class="modal-body">

                  <div class="box-body">

                    <div class="table-responsive" style="border-top: 1px solid !important;">

                        <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                          <tr>

                            <th style="width:250px;">Function</th>

                            <th style="width:250px;">Task</th>

                            <th style="width:150px;">Weightage</th>

                            <th style="width:150px;">Score</th>

                          </tr>

                          <tbody id="selfScoreData">
                             
                          </tbody>
                          
                        </table>

                      </div><!-- /div -->

                      <div class="row" style="display: flex;">
                         
                          <div class="col-md-6"> 
                            <div class="form-group">
                            
                            <textarea type="text" name="remark" cols="10" rows="3" id="functionHead_remark" class="form-control" placeholder="Enter Remark" id="" style="margin: 0px 152px 0px 0px; width: 257px; height: 76px;"></textarea>
                            <small id="msg"></small>
                           
                            </div>

                          </div>

                      </div>

                      <br>
                      
                      <div class="row">
                          
                        <button type="submit" class="btn btn-sm btn-primary" id="selfscorebtn" style="margin-left: 10px;" disabled>Submit</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" style="margin-left: 10px;">Cancel</button>

                          </div>
                      </div>

               </form>

          </div><!-- /.box-body -->
                 
        </div>



       <div class="modal-footer">


      </div>
    </div>
  

        </section><!-- /.content -->

      </div>



@include('admin.include.footer')

<script>
  
  

</script>

<script type="text/javascript">
$(function() {
$("#example").DataTable({
//"scrollX": true,



});

});

function showSelfScore(scoretaskId='',scorecardId='',slno='',taskfunction='',task='',weightage=''){
 

  $("#selfScoreData").html('');

    if(scoretaskId){

      var bodyscoreTbl = "<tr class='useful'><td class='tdthtablebordr><span style='width: 190px;'>"+taskfunction+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+task+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+weightage+"</span></td><td class='tdthtablebordr' style='text-align:center;'><input type='hidden' name='scoretaskId' value="+scoretaskId+"><input type='hidden' name='scorecardId' value="+scorecardId+"><input type='hidden' name='slno' value="+slno+"><input type='hidden' id='weightage' name='weightage' value="+weightage+"></span><input type='text' name='selfScore' id='selfScore' oninput='funselfScore()' class='form-control' value='' style='width:150px;text-align:center;'autocomplete='off'><small id='selfScoreErr'></small></td></tr>";

    } 
      $("#selfScoreData").append(bodyscoreTbl);
        
      $("#showselftaskList").modal('show');

}

function funselfScore(){

  var score = $('#selfScore').val();
  var weightage = $('#weightage').val();
  var weight = parseInt(weightage);

  if(score < 0 || score == '') {
    $('#selfscorebtn').attr('disabled',true);
    $('#selfScoreErr').html('Enter Score in between Weightage range').css('color','red');
    

  }else if(score > weight){
     $('#selfscorebtn').attr('disabled',true); 
     $('#selfScoreErr').html('Score is grater than Weightage').css('color','red');
   
  }else if(score > 0 && score < weight){
    $('#selfscorebtn').attr('disabled',false);
    $('#selfScoreErr').html('');
   
    
  // }
     
  }else{}
  
}

function funScore(id){
  
 var taskScore = $('#score'+id).val();
 if(taskScore < 1 || taskScore >5){
  $('#funScoreErr'+id).html('Enter Score between 1-5 range').css('color','red');
 }else{
    $('#funScoreErr'+id).html('');
 }
}

$('.number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
   if (this.value.length==1) {
    return false;}
});

$("#score_type").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#scoreList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg == 'No Match'){
           document.getElementById("plantText").innerHTML = msg;  
        }else{
            document.getElementById("plantText").innerHTML = '';  
        }

       


    });

</script>
@endsection



