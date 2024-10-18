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
            Top Creditors
            <small>   Top Creditors Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ url('/home/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Advanced Elements</li>
          </ol>
        </section>
  <section class="content">
     <div class="box box-primary Custom-Box">
  
            <div class="box-header with-border" style="text-align: center;">
               
              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Top Creditors</h2>
              <!-- <div class="box-tools pull-right">
                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>
              </div> -->

            </div><!-- /.box-header -->
           
            <div class="box-body">
              <table id="example" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th class="text-center">Acc Code</th>
                    <th class="text-center">Acc Name</th>
                    <th class="text-center">DR Amt</th>
                  </tr>
                </thead>
                <tbody>

                     <?php foreach ($top_sale_list as $row) { ?>
                    <tr>
                        <td align="center">{{ $row->ACC_CODE }}</td>
                        <td align="center">{{ $row->ACC_NAME }}</td>
                        <td align="center">{{ $row->drAmt }}</td>
                       
                    </tr>

                  <?php }?>
                </tbody>
              </table>

            </div><!-- /.box-body -->
           
      </div>
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
Processing: true,
              serverSide: true,
              scrollX: false,
             // dom : 'Bfrtip',
             pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
             buttons: [
                        {
                        extend: 'excelHtml5',
                        title: 'top_creditors_'+curr_date+'_'+curr_time,
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

@endsection