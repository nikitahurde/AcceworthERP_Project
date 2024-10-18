@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .numriRight{
    text-align: right !important;
  }
  
 .required-field::before {
    content: "*";
    color: red;
  }
  .Custom-Box {
    /*border: 1px solid #e0dcdc;
    border-radius: 10px;*/ 
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }
  @media screen and (max-width: 600px) {

    .PageTitle{
      float: left;
    }

  }
.text-center{
  text-align: center;
}
.title{
    margin-top: 50px;
    margin-bottom: 20px;
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
.container{
    max-width: 1200px;
    margin: 0px auto;
    padding: 0px 15px;
}
.inputboxclr{
  border: 1px solid #d7d3d3;
}
.tdthtablebordr{
  border: 1px solid #00BB64;
}
input:focus{border:1px solid yellow;} 
.space{margin-bottom: 2px;}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    padding-bottom: 0px !important;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    text-align: center;
}
.inputfield{
  width:100%;
}
</style>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>
       Master Chequebook 
      <small>Add Details</small>
    </h1>

    <ul class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

      <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}"> Cash Bank</a></li>

      <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}">Add Cash Bank</a></li>

    </ul>

  </section> <!-- /. section-->

  <form action="{{ url('configration/Setting/update-chequebook-data') }}" method="POST" enctype="multipart/form-data">

    @csrf
    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Update Chequebook</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/configration/Setting/view-chequeBook') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Chequebook</a>

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

              <div class="row">
                <div class="col-md-3">

                  <div class="form-group">

                    <label>

                      Company Code : 

                      <span class="required-field"></span>

                    </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" class="form-control" name="company_code" value="{{ $compCode }}" maxlength="6" readonly>

                      </div>

                  </div>
                  <!-- /.form-group -->
                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Series Code : <span class="required-field"></span></label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" class="form-control" name="company_name" value="{{$chequebook_list[0]->SERIES_CODE}}" placeholder="Enter Company Name" maxlength="40" readonly>

                    </div>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>GL Code<span class="required-field"></span></label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" class="form-control" name="contact_no2" value="{{$chequebook_list[0]->GL_CODE}}" placeholder="Enter GL Code" maxlength="20" readonly>

                    </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label>

                      Chequebook Date: 

                      <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type="text" class="form-control" name="fax_no" value="{{$chequebook_list[0]->CHQBKDATE}}" placeholder="Enter Fax Number" maxlength="20" readonly>

                    </div> 

                  </div><!-- /.form-group -->

                </div>

              </div><!-- /. row-->

              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label>From cheque No:<span class="required-field"></span>

                    </label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="email" class="form-control" name="emailid" value="{{$chequebook_list[0]->FROMCHEQUENO}}" placeholder="Enter Email Id" maxlength="20" readonly>

                    </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>To Cheque No:<span class="required-field"></span>

                    </label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="email" class="form-control" name="emailid" value="{{$chequebook_list[0]->TOCHEQUENO}}" placeholder="Enter Email Id" maxlength="20" readonly>

                    </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Last Cheque No:<span class="required-field"></span>

                    </label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="email" class="form-control" name="emailid" value="{{$chequebook_list[0]->LASTCHEQUENO}}" placeholder="Enter Email Id" maxlength="20" readonly>

                    </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->
                
              </div><!-- /. row-->
              
            </div><!-- /. box-body-->
            
          </div><!-- /. custom box-->
          
        </div><!-- /. col-->
        
      </div> <!-- /. row-->
    </section> <!-- /. section-->

    <section class="content" style="margin-top: -10%;">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-body">
                <div class="table-responsive">
                  <input type="hidden" value="{{$chequebook_list[0]->CHQBHID}}" name="headID">
                  <input type="hidden" value="{{$chequebook_list[0]->CHQBBID}}" name="bodyID">
                  <input type="hidden" value="{{$chequebook_list[0]->SLNO}}" name="slNum">
                  <input type="hidden" value="{{$chequebook_list[0]->dataFl}}" name="checkField">
                  <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">
                    <tr>
                      <!-- <th>Sr.No.</th> -->
                      <th>Cheque No</th>
                      <th>Cheque Date</th>
                      <th>GL Code</th>
                      <th>GL Name</th>
                      <th>Account Code</th>
                      <th>Account Name</th>
                      <th>Amount</th>
                      <th>Remark</th>
                    </tr>

                    <?php $srNo =1; foreach($chequebook_list as $row){ ?>

                      <tr>
                      <!-- <td>{{$srNo}}</td> -->
                      <td style="width: 7%;">
                        <input type="text" class="inputfield numriRight" id="chequeNo" name="cheque_No" value="{{$row->CHEQUENO}}" autocomplete="off">
                      </td>
                      <td style="width: 9%;">
                        <?php if($row->CHEQUEDATE == '0000-00-00'){$yrbgdate = '00-00-0000'; }else{$yrbgdate = date("d-m-Y", strtotime($row->CHEQUEDATE));}  ?>
                        <input type="text" class="inputfield" id="chequeDate" name="cheque_Date" value="{{$yrbgdate}}" autocomplete="off">
                      </td>
                      <td style="width: 9%;">
                        <input type="text" class="inputfield" id="chequeDate" name="gl_code" value="{{$row->glCode}}" autocomplete="off">
                      </td>
                      <td style="width: 15%;">
                        <input type="text" class="inputfield" id="chequeDate" name="gl_name" value="{{$row->glName}}" readonly autocomplete="off">
                      </td>
                      <td  style="width: 9%;">
                        <input type="text" class="inputfield" id="chequeDate" name="acc_code" value="{{$row->ACC_CODE}}" autocomplete="off">
                      </td>
                      <td  style="width: 15%;">
                        <input type="text" class="inputfield" id="chequeDate" name="acc_name" value="{{$row->ACC_NAME}}" readonly autocomplete="off">
                      </td>
                      <td style="width: 15%;">
                        <input type="text" class="inputfield numriRight" id="chequeDate" name="amount" value="{{$row->AMOUNT}}" autocomplete="off">
                      </td>
                      <td  style="width: 21%;">
                        <input type="text" class="inputfield" id="chequeDate" name="remark" value="{{$row->REMARK}}" autocomplete="off">
                      </td>
                    </tr>


                    <?php $srNo++;} ?>
                    
                  </table><!-- /. table-->
                </div><!-- /. table-responsive-->

                <div class="row" style="text-align:center;"> 
                  
                  <button class="btn btn-success" type="submit" id="submitdata"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>
                  <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>
                </div><!-- /. row-->

            </div><!-- /. box-body-->

          </div><!-- /. Custom-Box-->

        </div><!-- /. col-->

      </div><!-- /. row-->

    </section><!-- /. section-->
  </form><!-- /. form-->
</div> <!-- /. content-wrapper-->


@include('admin.include.footer')


<script type="text/javascript">
   $(document).ready(function(){      
    $(".Number").keypress(function(event){
        var keycode = event.which;
        if (!(keycode >= 48 && keycode <= 57)) {
            event.preventDefault();
        }
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

<script type="text/javascript">

  $(document).ready(function() {
  $(".Number").on("keypress", function(evt) {
    var keycode = evt.charCode || evt.keyCode;
    if (keycode == 46 || this.value.length==10) {
      return false;
    }
  });

  });

</script>

<script type="text/javascript">

  $(document).ready(function() {
    $(".pincode").on("keypress", function(evt) {
      var keycode = evt.charCode || evt.keyCode;
      if (keycode == 46 || this.value.length==6) {
        return false;
      }
    });

  });

</script>

@endsection
