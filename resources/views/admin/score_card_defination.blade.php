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

 
.dt-buttons{
    margin-bottom: -30px!important;
  }

  .dt-button{
  
    display: inline-block!important;
    font-weight: 600 !important;
    text-align: center!important;
    white-space: nowrap!important;
    vertical-align: middle!important;
    -webkit-user-select: none!important;
    -moz-user-select: none!important;
    -ms-user-select: none!important;
    user-select: none!important;
    border: 1px solid transparent!important;
    padding: .375rem .75rem!important;
    font-size: 15px!important;
    line-height: 1.5!important;
    border-radius: .25rem!important;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out!important;
  }

  .dt-button:before {
    content: '\f02f';
    font-family: FontAwesome;
    padding-right: 5px;
  }

  .buttons-excel{
    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
  }

  .buttons-excel:before {
    content: '\f1c9';
    font-family: FontAwesome;
    padding-right: 5px;
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

          <a href="{{ url('Transaction/ScoreCard/add-score-card-trans')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Score Card Defination</a>

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

                        <th class="text-left" style="width:170px;">Sr No</th>

                        <th class="text-left" style="width:170px;">Name</th>

                        <th class="text-left" style="width:170px;">Function</th>

                        <th class="text-left" style="width:170px;">Task List</th>

                        <th class="text-left" style="width:70px;">Weightage</th>

                        <th class="text-left" style="width:70px;">Self Score</th>

                        <th class="text-left" style="width:70px;">Function Score</th>
                        
                        <th class="text-left" style="width:70px;">Admin Score</th>
                        
                        <th class="text-left" style="width:70px;">Create Task</th>

                        <th class="text-left" style="width:70px;">Status</th>

                      </tr>

                    </thead>

                    <tbody>

                   
                     <?php $srno = 1; ?>
                      
                     @foreach ($tasklist as $row)
                      
                      <tr> 
                          <td>
                            {{$srno}}
                          </td> 
                          <td align="">
                          
                          {{$row->ENAME}} [{{$row->ECODE}}]
                            
                          </td>
                         
                          <td align="">
                            
                           {{$row->FUNCTION}} 
                             
                          </td>
                          <td align="">
                            
                           {{$row->TASK}} 
                             
                          </td>
                          
                          <td align="center">

                           <span style="width:30px">{{$row->WEIGHTAGE}}</span>
                          
                          </td>

                          <td align="center">
                             
                            <span style="width:30px">{{$row->SELF_SCORE}}</span>
                             
                          </td>

                          <td align="center">
                             
                            <span style="width:30px">{{$row->FUNCTION_SCORE}}</span>
                             
                          </td>
                          <td align="center">
                             
                            <span style="width:30px">{{$row->ADMIN_SCORE}}</span>
                             
                          </td>
                          <td align="">
                            
                          {{$row->CREATED_BY}}
                             
                          </td>

                          <td align="center">
                           <?php 
                            $selfscore = $row->SELF_SCORE;
                            $funScore  = $row->FUNCTION_SCORE;
                            $adminScore = $row->ADMIN_SCORE;

                            if($selfscore != '0' && $funScore != '0' && $adminScore != '0'){
                           ?>
                          <span class="label label-success">Complete</span>
                           <?php } else{ ?>
                           <span class="label label-warning">Pending</span>
                           <?php } ?>

                          </td>
                      </tr>
                      <?php  $srno++;   ?>
                      
                      @endforeach
                     
                     
                 
                   
                </tbody>
                </table>

                <!-- <div class="text-center">
                  <button class="btn btn-success">Save</button>
                  <button class="btn btn-warning">Reset</button>
                </div> -->

                  
                </div><!-- /.box-body -->
               </form>   
              </div><!-- /.box -->

            </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->

      </div>



@include('admin.include.footer')

<script>
  
  

</script>

<script type="text/javascript">
$(function() {
   var date1 = new Date();
                var month = date1.getMonth() + 1;
                var tdate = date1.getDate();
                var mn    = month.toString().length > 1 ? month : "0" + month;
                var yr    = date1.getFullYear();
                var hr    = date1.getHours(); 
                var min   = date1.getMinutes();
                var sec   = date1.getSeconds(); 

                var curr_date = tdate+''+mn+''+yr;
                var curr_time = hr+':'+min+':'+sec;

$("#example").DataTable({
"scrollX": true,
Processing: true,
              serverSide: true,
              scrollX: false,
             // dom : 'Bfrtip',
             pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
               buttons: [
                        {
                        extend: 'excelHtml5',
                        title: 'score_card_defination_'+curr_date+'_'+curr_time,
                        footer: true
                      }
                        ],

               columns: [

              
                {
                    data:'VRDATE',
                    className:'text-right',
                    render: function (data) {
                        var date = new Date(data);
                        var month = date.getMonth() + 1;
                        if(data=='0000-00-00'){
                          return '00-00-0000';
                        }else{
                          
                          return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                        }
                    }
                },
                
                {  
                  render: function (data, type, full, meta){
                         
                    var seriesC = full['SERIES_CODE'];
                    var getFY   = full['FY_CODE'].split(" ");
                    var FYNEW   = getFY[0];
                    var VR      = full['VRNO'];

                    var VRNEW  = seriesC+' '+FYNEW+' '+VR;
                    var NEWACC = full['ACC_NAME']+' '+'['+full['ACC_CODE']+']';

                    return VRNEW;
                               
                  }  
                },
                
                {   
                  render: function (data, type, full, meta){
                    
                    var NEWACC = full['ACC_CODE']+' '+'['+full['ACC_NAME']+']';

                    return NEWACC;   
                  },
                },

                  {
                    data:'SRNO',
                    name:'SRNO',
                    className:'text-right'
                },

                  {
                    data:'NAME',
                    name:'NAME',
                    className:'text-right'
                },

                {
                    data:'FUNCTION',
                    name:'FUNCTION',
                    className:'text-right'
                },


                  {
                    data:'TASKLIST',
                    name:'TASKLIST',
                    className:'text-right'
                },

                {
                    data:'WEIGHTAGE',
                    name:'WEIGHTAGE',
                    className:'text-right'
                },

                {
                    data:'SELF_SCORE',
                    name:'SELF_SCORE',
                    className:'text-right'
                },



                {
                    data:'FUNCTION_SCORE',
                    name:'FUNCTION_SCORE',
                    className:'text-right'
                },

                 {
                    data:'ADMIN_SCORE',
                    name:'ADMIN_SCORE',
                    className:'text-right'
                },
                 {
                    data:'CREATETASK',
                    name:'CREATETASK',
                    className:'text-right'
                },
                 {
                    data:'STATUS',
                    name:'STATUS',
                    className:'text-right'
                },
                
                
               
              ]
              





});

});

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



