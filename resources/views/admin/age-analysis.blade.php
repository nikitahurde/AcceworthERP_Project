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
.showSeletedName{



    font-size: 15px;



    margin-top: 1%;

    margin-bottom: 3%;



    text-align: center;



    font-weight: 600;



    color: #4f90b5;

    text-transform: capitalize;

    text-align: center;



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

           Age Analysis
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

             <small><b> : Age Analysis Details</b></small> 

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ url('/Dashboard/Age-Analysis') }}"><i class="fa fa-dashboard"></i> Age Analysis</a></li>
          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Age Analysis</h3>

                  <div class="box-tools pull-right"></div>

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

                  <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                       <div class="form-group">

                      <label for="exampleInputEmail1">Account Type :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input type="hidden" name="accType" id="accType" value="">
                           <input list="accTypeList" id="accType1" name="accType1" class="form-control  pull-left" value="{{ old('accType1')}}" placeholder="Select Account Type" autocomplete="off">



                          <datalist id="accTypeList">

                            <option selected="selected" value="">-- Select Account Type--</option>

                            @foreach ($accTypeList as $key)

                            <option value='<?php echo $key->ATYPE_NAME." [".$key->ATYPE_CODE."]" ; ?>'   data-xyz ="<?php echo $key->ATYPE_CODE; ?>" ><?php echo $key->ATYPE_NAME." [".$key->ATYPE_CODE."]" ; ?></option>

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="typeText"></div>

                     </small>

                  </div>
                    </div>
                    <div class="col-sm-4">
                        <div style="margin-top: 3%;">

                         <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" style="padding: 2px;">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();" style="padding: 2px;">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Reset &nbsp;&nbsp;</button>

                        </div>
                    </div>
                  <div class="col-sm-2"></div>
                  </div>

                  <table id="ageAnalysisTbl" class="table table-bordered table-striped table-hover">

                    <thead>

                      <tr>

                        <th class="text-center">VR-DATE</th>

                        <th class="text-center">VRNO</th>

                        <th class="text-center">ACCOUNT NAME</th>

                        <th class="text-center">DRAMT</th>

                        <th class="text-center">DAYS</th>

                        <th class="text-center">00-31</th>

                        <th class="text-center">31-60</th>

                        <th class="text-center">61-90</th>

                        <th class="text-center">91-180</th>

                        <th class="text-center"> > 180 </th>

                      </tr>

                    </thead>

                    <tbody id="defualtSearch">

                    </tbody>

                    

                  </table>

                  
                </div><!-- /.box-body -->
                  
              </div><!-- /.box -->

            </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->


        <section class="content"> <!-- Bar Graph -->

          <div class="row">
            <div class="col-md-12">
              <!-- LINE CHART -->

              <!-- BAR CHART -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <div style="text-align: center;"><h3 class="box-title"><b>Party Wise Age Analysis Bar Chart</b></h3></div>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">

                  <div class="col-sm-3"></div>

                  <div class="col-sm-4">
                    <div class="form-group">

                      <label>Party : 
                        <span class="required-field"></span>
                      </label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>

                          <input list="partyList"  id="party_code" name="party_code" class="form-control  pull-left serieswidth" value="" placeholder="Select Party"  oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                          <datalist id="partyList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($age_analysis as $key)

                            <option value='<?php echo $key->ACC_CODE; ?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>"><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                            @endforeach

                          </datalist>

                        </div>
                         <div class="pull-left showSeletedName" id="partyText"></div>
                        <small id="serscode_err" style="color: red;" class="form-text text-muted">
                        </small>
                       
                        <small id="series_code_errr" style="color: red;"></small>
                    </div>
                    
                  </div>

                  <div class="col-sm-2">
                    <button type="button" id="makeGraph" class="btn btn-primary" style="margin-top: 7% !important;padding: 2px;">&nbsp;&nbsp;<i class="fa fa-bar-chart"></i> &nbsp;&nbsp;Make Graph&nbsp;&nbsp;</button>
                  </div>
                  <div class="col-sm-3"></div>
                  <br>
                  <div class="col-sm-12">  
                    <div class="chart">
                      <canvas id="barChart" style="height:230px"></canvas>
                    </div>
                  </div>

                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col (RIGHT) -->
          </div><!-- /.row -->

        </section> <!-- /.Bar Graph -->


      </div>



@include('admin.include.footer')


<script>
      

  $(document).ready(function() {   

    $("#party_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#partyList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

       

        // $('#plant_name').val(msg);

        if(msg == 'No Match'){

            $('#party_code').val('');
             document.getElementById("partyText").innerHTML = 'No Match'; 
        }else{
           document.getElementById("partyText").innerHTML = msg; 

        }


    });

      $("#makeGraph").click(function(){

         $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });


        var acc_code =  $('#party_code').val();

        console.log('acc',acc_code);
            
            if(acc_code != ''){

              $.ajax({

                  url:"{{ url('party-wise-data-for-bargraph') }}",

                  method : "POST",

                  type: "JSON",

                  data: {acc_code: acc_code},

                  success:function(data){

                      var data1 = JSON.parse(data);
                      
                      if (data1.response == 'Error') {

                          $('#serscode_err').html("<p style='color:red'>"+ data1.message +"</p>");
                            
                      }else if(data1.response == 'Success'){

                          var getD = [];
                          $.each(data1.age_analysis, function(i, jsonData){
                              

                                getD.push(jsonData.ZEROTOTHRTEE);
                                getD.push(jsonData.THARTIONETOSIXTY);
                                getD.push(jsonData.SIXTYONETONINTY);
                                getD.push(jsonData.NINTYONETOONEEAIGHTY);
                                getD.push(jsonData.ONEEAIGHTYTOABOVE);

                              /*console.log('ZEROTOTHRTEE ',jsonData.ZEROTOTHRTEE);
                              console.log('THARTIONETOSIXTY ',jsonData.THARTIONETOSIXTY);
                              console.log('SIXTYONETONINTY ',jsonData.SIXTYONETONINTY);
                              console.log('NINTYONETOONEEAIGHTY ',jsonData.NINTYONETOONEEAIGHTY);
                              console.log('ONEEAIGHTYTOABOVE ',jsonData.ONEEAIGHTYTOABOVE);*/
                              
                             
                          });

                          console.log('arr',getD);

                            var areaChartData = {
                              
                              labels: ['0-30','31-60','61-90','91-180','> 180'],
                              datasets: [
                               
                                {
                                  label: "Digital Goods",
                                  fillColor: "rgba(60,141,188,0.9)",
                                  strokeColor: "rgba(60,141,188,0.8)",
                                  pointColor: "#3b8bba",
                                  pointStrokeColor: "rgba(60,141,188,1)",
                                  pointHighlightFill: "#fff",
                                  pointHighlightStroke: "rgba(60,141,188,1)",
                                  data: getD
                                }
                              ]
                            };

                            //-------------
                            //- BAR CHART -
                            //-------------
                            var barChartCanvas = $("#barChart").get(0).getContext("2d");
                            var barChart = new Chart(barChartCanvas);
                            var barChartData = areaChartData;
                            barChartData.datasets[0].fillColor = "#00a65a";
                            barChartData.datasets[0].strokeColor = "#00a65a";
                            barChartData.datasets[0].pointColor = "#00a65a";
                            var barChartOptions = {
                              //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                              scaleBeginAtZero: true,
                              //Boolean - Whether grid lines are shown across the chart
                              scaleShowGridLines: true,
                              //String - Colour of the grid lines
                              scaleGridLineColor: "rgba(0,0,0,.05)",
                              //Number - Width of the grid lines
                              scaleGridLineWidth: 1,
                              //Boolean - Whether to show horizontal lines (except X axis)
                              scaleShowHorizontalLines: true,
                              //Boolean - Whether to show vertical lines (except Y axis)
                              scaleShowVerticalLines: true,
                              //Boolean - If there is a stroke on each bar
                              barShowStroke: true,
                              //Number - Pixel width of the bar stroke
                              barStrokeWidth: 2,
                              //Number - Spacing between each of the X value sets
                              barValueSpacing: 5,
                              //Number - Spacing between data sets within X values
                              barDatasetSpacing: 1,
                              //String - A legend template
                              legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                              //Boolean - whether to make the chart responsive
                              responsive: true,
                              maintainAspectRatio: true
                            };

                            barChartOptions.datasetFill = false;
                            barChart.Bar(barChartData, barChartOptions);
                          


                      }
                   }

              });

            }else{
             
              $("#serscode_err").html('*Required Party Code.');
              
          }

      });

    });


</script>

<script type="text/javascript">

  $(document).ready(function(){



    $("#accType1").bind('change', function () { 
          
          var val = $(this).val();

          var xyz = $('#accTypeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg =='No Match'){
            $('#accType').val('');
          }else{
            $('#accType').val(msg);
          }

    });

    load_data();

        function load_data(accType=''){
               
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
                
          $('#ageAnalysisTbl').DataTable({

            footerCallback: function ( row, data, start, end, display ) {
              var api = this.api(), data;

                 var rowcount = data.length;

              if(rowcount > 0){
                 $('.buttons-excel').attr('disabled',false);
              }else{
                 $('.buttons-excel').attr('disabled',true);
              }
            },

              processing: true,
              serverSide: true,
              scrollX: true,
             // dom : 'Bfrtip',
             pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
               buttons: [
                        {
                        extend: 'excelHtml5',
                        title: 'age_analysis_'+curr_date+'_'+curr_time,
                        footer: true
                      }
                        ],

              ajax:{
                url:'{{ url("/accont/report/view-party-wise-ageAnalysis") }}',
                data: {accType:accType}
              },

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
                    data:'DRAMT',
                    name:'DRAMT',
                    className:'text-right'
                },
                {
                    data:'DAYS',
                    name:'DAYS',
                    className:'text-right'
                },
                {
                    data:'ZEROTOTHRTEE',
                    name:'ZEROTOTHRTEE',
                    className:'text-right'
                },
                {
                    data:'THARTIONETOSIXTY',
                    name:'THARTIONETOSIXTY',
                    className:'text-right'
                },
                {    
                    data:'SIXTYONETONINTY',
                    name:'SIXTYONETONINTY',
                    className:'text-right'
                },
                {    
                    data:'NINTYONETOONEEAIGHTY',
                    name:'NINTYONETOONEEAIGHTY',
                    className:'text-right'
                },
                {    
                    data:'ONEEAIGHTYTOABOVE',
                    name:'ONEEAIGHTYTOABOVE',
                    className:'text-right'
                },
               
              ]


          });


       }


      $('#btnsearch').click(function(){

          var accType =  $('#accType').val();
       
          if (accType!='') {

            $('#ageAnalysisTbl').DataTable().destroy();
            load_data(accType);

          }else{

           $('#ageAnalysisTbl').DataTable().destroy();
            load_data();
          }


        });


        $('#ResetId').click(function(){
           
          $('#accType').val('');
          
          $('#ageAnalysisTbl').DataTable().destroy();
          load_data();

        });



  });

</script>

<script type="text/javascript">
$(function() {
$("#example").DataTable({
"scrollX": true,




});

});
</script>
@endsection



