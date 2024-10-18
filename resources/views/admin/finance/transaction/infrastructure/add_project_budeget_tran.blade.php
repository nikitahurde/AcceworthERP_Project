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
  .showinmobile{
    display: none;
  }
  .inputboxclr{
    border-color: rgb(210, 214, 222);
    border: 1px solid lightgrey;
    margin-top: 2px;
  }
  .rowInput{
    margin:0px;
    margin-bottom: 2px;
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

  table {
    border-collapse: collapse;
  }

  .table-responsive {
      display: block;
      width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
  }

  .table {
      width: 100%;
      margin-bottom: 1rem;
      color: #212529;
  }

  .table thead th {
      vertical-align: bottom;
      border-bottom: 2px solid #dee2e6;
  }
  .table td, .table th {
      padding: .75rem;
      vertical-align: top;

  }
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 2px;
      padding-bottom: 0px !important;
      vertical-align: top;
  }
</style>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>
      Project Budget
      <small> Add Details</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('/dashboard') }}">Master</a></li>
      <li class="active"><a href="{{ url('Transaction/Infrastructure/View-Unit-Sale-Tran') }}">Project Budget</a></li>
      <li class="active"><a href="{{ url('Transaction/Infrastructure/View-Unit-Sale-Tran') }}">Add Project Budget </a></li>
    </ol>

  </section>

<form id="projectBudget">
  @csrf
  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> Add Project Budget</h2>

            <div class="box-tools pull-right showinmobile">

              <a href="{{ url('Transaction/Infrastructure/view-project-budget-tranasction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Project Budget</a>

            </div>

            <div class="box-tools pull-right hideinmobile">

              <a href="{{ url('Transaction/Infrastructure/view-project-budget-tranasction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Project Budget</a>

            </div>

          </div><!-- /.box-header -->

          <div class="box-body">

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label>Project Code : 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </div>

                    <input list="projectList"  id="project_code" name="project_code" class="form-control  pull-left" value="" placeholder="Select Project Code"  oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                    <datalist id="projectList">

                      <option selected="selected" value="">-- Select --</option>

                      @foreach ($projectList as $key)

                      <option value='<?php echo $key->PROJECT_CODE; ?>'   data-xyz ="<?php echo $key->PROJECT_NAME; ?>"><?php echo $key->PROJECT_NAME ; echo " [".$key->PROJECT_CODE."]" ; ?></option>

                      @endforeach

                    </datalist>

                  </div><!-- ./input group -->
                            
                </div><!-- /.form-group -->
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Project Name : 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </div>

                    <input type="text"  id="project_name" name="project_name" class="form-control  pull-left" value="" placeholder="Select Project Name"  oninput="this.value = this.value.toUpperCase()" autocomplete="off" readonly>

                  </div><!-- ./input group -->
                            
                </div><!-- /.form-group -->
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch" style="margin-top: 7%;" onclick="searchData();"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>
                
              </div><!-- /.col -->
        
            </div><!-- ./ROW -->

            <div class="table-responsive">

              <table class="table tdthtablebordr" border="1" cellspacing="0" id="tblProj_details">

              </table>
            </div>

            <div class="row" style="text-align:center;margin-bottom: 5px;font-weight: 700;">
              <small id="fieldReqMsg" style="color:red;"></small>
            </div>

            <div class="row" style="text-align: center;">

              <button class="btn btn-success" type="button" id="submitdata" onclick="submitCBData(0)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>
              
            </div><!--  /. ROW -->

          </div><!-- /.box body -->

        </div><!-- /. CUSTOME BOX -->

      </div><!-- /.COL 12 --> 

    </div><!--  /. ROW -->

  </section><!-- /.SECTION -->

</form><!-- /.form -->

</div>

@include('admin.include.footer')

<script>

  $(document).ready(function(){

    $('#project_code').on('change',function(){

      var projectcode =  $('#project_code').val();

      var xyz = $('#projectList option').filter(function() {

      return this.value == projectcode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){

        $('#project_code').val('');
        $('#project_name').val('');
         
      }else{
        $('#project_name').val(msg);
      }

    });

  });

  function searchData(){

    var projectCode = $('#project_code').val();

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

      url:"{{ url('get-all-projectwbs-against-project') }}",
      method : "POST",
      type: "JSON",
      data: {projectCode: projectCode},
      success:function(data){
        var data1 = JSON.parse(data);

        if (data1.response == 'error') {

          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

        }else if(data1.response == 'success'){

          if(data1.data_wbs == ''){

          }else{

            $('#submitdata').prop('disabled',false);
            var headData = "<tr><th class='tdthtablebordr'>Sr.No.</th><th class='tdthtablebordr'>WBS Code</th><th class='tdthtablebordr'>WBS Name</th><th class='tdthtablebordr'>WBS Plan Start Date</th><th class='tdthtablebordr'>WBS Plan End Date</th><th class='tdthtablebordr'>Plan Amount<span class='required-field'></span></th><th class='tdthtablebordr'>Budget Amount<span class='required-field'></span></th><th class='tdthtablebordr'>Gl Code</th><th class='tdthtablebordr'>Gl Name</th></tr>";

            $('#tblProj_details').append(headData);

            var slno=1;
            $.each(data1.data_wbs, function(k, getData){

              var wbsStartDt  = getData.WBS_PLAN_STDATE;
              var slitStDt    = wbsStartDt.split('-');
              var formStartDt = slitStDt[2]+'-'+slitStDt[1]+'-'+slitStDt[0];

              var wbsEndDt  = getData.WBS_PLAN_ENDATE;
              var slitEndDt    = wbsEndDt.split('-');
              var formEndDt = slitEndDt[2]+'-'+slitEndDt[1]+'-'+slitEndDt[0];

              var bodyData ="<tr>"+
              "<td>"+slno+"</td>"+
              "<td style='width:10%;'><div class='row rowInput'><div class='input-group'><input type='hidden' class='rowCountCls' name='rowCount[]' id='rowCount"+slno+"' value='"+slno+"'><input type='text' class='inputboxclr' id='wbsCode"+slno+"' name='wbsCode[]' value='"+getData.WBS_CODE+"' placeholder='Select WBS Code' readonly='' autocomplete='off'></div></div></td>"+
                "<td style='width:10%;'><div class='row rowInput'><div class='input-group'><input type='text' class='inputboxclr' id='wbsName"+slno+"' value='"+getData.WBS_NAME+"' name='wbsName[]' placeholder='Select WBS Name' readonly='' autocomplete='off'></div></div></td>"+
                "<td style='width:10%;'><div class='row rowInput'><div class='input-group'><input type='text' class='inputboxclr' id='wbsPlanStartDate"+slno+"' value='"+formStartDt+"' name='wbsPlanStartDate[]' placeholder='Enter WBS Plan Start Date' readonly='' autocomplete='off'></div></div></td>"+
                "<td style='width:10%;'><div class='row rowInput'><div class='input-group'><input type='text' class='inputboxclr' id='wbsPlanEndDate"+slno+"' value='"+formEndDt+"' name='wbsPlanEndDate[]' placeholder='Enter WBS Plan End Date' readonly='' autocomplete='off'></div></div></td>"+
                "<td><div class='row rowInput'><div class='input-group'><input type='text' class='inputboxclr' id='planAmt"+slno+"' value='' name='planAmt[]' placeholder='Enter Plan Amount' autocomplete='off'></div></div></td>"+
                "<td><div class='row rowInput'><div class='input-group'><input type='text' class='inputboxclr' id='budgetAmt"+slno+"' value='' name='budgetAmt[]' placeholder='Enter Budget Amount' autocomplete='off'></div></div></td>"+
                "<td><div class='row rowInput'><div class='input-group'><input list='glList"+slno+"' class='inputboxclr' id='glCode"+slno+"' value='' name='glCode[]' onchange='glListFun("+slno+")' placeholder='Enter Gl Code' autocomplete='off'><datalist id='glList"+slno+"'><option selected='selected' value=''>-- Select --</option>@foreach ($glList as $key)<option value='<?php echo $key->GL_CODE; ?>'   data-xyz ='<?php echo $key->GL_NAME; ?>' ><?php echo $key->GL_NAME ; echo ' ['.$key->GL_CODE.']' ; ?></option>@endforeach</datalist></div></div></td>"+
                "<td><div class='row rowInput'><div class='input-group'><input type='text' class='inputboxclr' id='glName"+slno+"' readonly value='' name='glName[]' placeholder='Enter Gl Name' autocomplete='off'></div></div></td></tr>";

              $('#tblProj_details').append(bodyData);

              var wbsPlanStartDate = new Date(getData.WBS_PLAN_STDATE);
              var wbsPlanEndDate = new Date(getData.WBS_PLAN_ENDATE);

              console.log('date ',getMonthDifference(wbsPlanStartDate,wbsPlanEndDate));

            slno++;});
          }
        }/*/.success codn*/
      } /* /. success fun*/

    });/*/.ajax*/

  }

  function getMonthDifference(startDate, endDate) {
    return (
      endDate.getMonth() -
      startDate.getMonth() +
      12 * (endDate.getFullYear() - startDate.getFullYear())
    );
  }

  function glListFun(slNo){

    var glcode =  $('#glCode'+slNo).val();

    var xyz = $('#glList'+slNo+' option').filter(function() {

    return this.value == glcode;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){

      $('#glCode'+slNo).val('');
      $('#glName'+slNo).val('');
       
    }else{
      $('#glName'+slNo).val(msg);
    }

  }

  function submitCBData(valp){

    var rowIDget       =[];
    var valueplanAmt   =[];
    var valuebudgetAmt =[];

    $(".rowCountCls").each(function () {
        
         rowIDget.push(this.value);

    });

    for(var y=0;y<rowIDget.length;y++){

      var colIdSlno = rowIDget[y];

      var planAmt   = $('#planAmt'+colIdSlno).val();
      var budgetAmt = $('#budgetAmt'+colIdSlno).val();

      valueplanAmt.push(planAmt);
      valuebudgetAmt.push(budgetAmt);

    }

    var found_planAmt = valueplanAmt.find(function (plan_amt) {
      return plan_amt == '';
    });

    var found_budgetAmt = valuebudgetAmt.find(function (budget_amt) {
      return budget_amt == '';
    });

    if(found_planAmt == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else if(found_budgetAmt == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else{

      var data = $("#projectBudget").serialize();

      $.ajaxSetup({
        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
      });

      $.ajax({

          type: 'POST',
          url: "{{ url('/Transaction/Infrastructure/Save-project-budget-transaction') }}",
          dataType: "json",
          data: data, 

          success: function (data) {

            var data1 = JSON.parse(JSON.stringify(data));

            if (data1.response == 'Error') {
              var responseVar = false;
              var tranName= 'PROJECTBUDGET';
              var url = "{{url('/Transaction/Infrastructure/save-Trans-Success-Msg')}}"
              setTimeout(function(){ window.location = url+'/'+responseVar+'/'+tranName; });
            }else{
              var responseVar = true;
              var tranName= 'PROJECTBUDGET';
              var url = "{{url('/Transaction/Infrastructure/save-Trans-Success-Msg')}}"
              setTimeout(function(){ window.location = url+'/'+responseVar+'/'+tranName; });
            }
        
          },
      });

    }

  }
  
</script>

@endsection