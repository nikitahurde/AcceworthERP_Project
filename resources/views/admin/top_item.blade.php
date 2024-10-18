@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .Custom-Box {
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  .box-header>.box-tools {
    position: absolute !important;
    right: 10px !important;
    top: 2px !important;
  }
  .required-field::before {
    content: "*";
    color: red;
  }
  .showAccName{
    border: none;
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
  }
  .defualtSearchNew{
    display: none;
  }
  .showSeletedName {
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
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
            Top Sale
            <small>   Top Sale Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ url('/home/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Top 10 Sale Item</li>
          </ol>
        </section>
  <section class="content">
     <div class="box box-primary Custom-Box">
     
            <div class="box-header with-border" style="text-align: center;">
              
              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Top Sale Against Item</h2>
              <!-- <div class="box-tools pull-right">
                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>
              </div> -->

            </div><!-- /.box-header -->
           
            <div class="box-body">
              <table id="example" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th class="text-center">Item Code</th>
                    <th class="text-center">Item Name</th>
                    <th class="text-center">DR Amt</th>
                    <th class="text-center">Qty Issued</th>
                    <th class="text-center">UM</th>
                    <th class="text-center">Avg</th>
                  </tr>
                </thead>
                <tbody>

                     <?php foreach ($top_item_list as $row) { ?>
                    <tr>
                        <td align="center">{{ $row->ITEM_CODE }}</td>
                        <td align="center">{{$row->ITEM_NAME}}</td>
                        <td align="center">{{ $row->drAmt }}</td>
                        <td align="center">{{ $row->qtyIssued }}</td>
                        <td align="center">{{$row->UM}}</td>
                        <td align="center"><?php $avgAmt = $row->qtyIssued / $row->drAmt;$bal_amt = number_format((float)$avgAmt, 2, '.', '');echo $bal_amt; ?></td>
                       
                    </tr>

                  <?php }?>
                </tbody>
              </table>

            </div><!-- /.box-body -->
           
      </div>

  </section>

  <section class="content">
    <div class="row">
            <div class="col-md-12">
              <!-- LINE CHART -->

              <!-- BAR CHART -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <div style="text-align: center;"><h3 class="box-title"><b>Top Sale Against Item Bar Chart</b></h3></div>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="barChart" style="height:230px"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col (RIGHT) -->
          </div><!-- /.row -->
  </section>


</div>



@include('admin.include.footer')

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
processing: true,
              serverSide: true,
              scrollX: false,
             // dom : 'Bfrtip',
             pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
             buttons: [
                        {
                        extend: 'excelHtml5',
                        title: 'top_item_'+curr_date+'_'+curr_time,
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
                    data:'ITEM_CODE',
                    name:'ITEM_CODE',
                    className:'text-right'
                },

                  {
                    data:'ITEM_NAME',
                    name:'ITEM_NAME',
                    className:'text-right'
                },

                  {
                    data:'QTYISSUED',
                    name:'QTYISSUED',
                    className:'text-right'
                },

                {
                    data:'UM_CODE',
                    name:'UM_CODE',
                    className:'text-right'
                },

                {
                    data:'AVERAGE',
                    name:'AVERAGE',
                    className:'text-right'
                },



                {
                    data:'DRAMT',
                    name:'DRAMT',
                    className:'text-right'
                },
                
               
              ]
              



              



});

});
</script>
<script type="text/javascript">
  
  $(document).ready(function() {
    $('.datepicker').datepicker({
      format: 'yyyy/mm/dd',
      orientation: 'bottom',
      todayHighlight: 'true',
    });
});
</script>
<?php $label=array();$Qqty=array();foreach ($top_item_list as $row) { 
            array_push($label, $row->ITEM_CODE);
            $Qqty[] = $row->qtyIssued;
            ?>
          <?php }?>

 <script>
      $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        //var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        //var areaChart = new Chart(areaChartCanvas);

        var areaChartData = {
          
            labels: <?php echo json_encode($label);?>,
          datasets: [
           
            {
              label: "Digital Goods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [<?php echo implode(", ", $Qqty);?>]
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
      });
    </script>

@endsection