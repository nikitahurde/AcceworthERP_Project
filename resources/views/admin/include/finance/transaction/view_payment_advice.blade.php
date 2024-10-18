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

 @media only screen and (max-width: 600px) {
  
  .dataTables_filter{
    margin-left: 35%;
  }
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

            Payment Advice

            <small> Payment Advice Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report/MIS</a></li>

            <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">Payment Advice Report</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Payment Advice</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/finance/payment-advice') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Payment Advice</a>

              </div>

              <!-- <div class="box-tools pull-right">

                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

              </div> -->

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



            </div><!-- /.box-header -->

            <div class="box-body">

            <form id="myForm">
              @csrf
                      <div class="row">
                      
                        <div class="col-md-3">

                          <div class="form-group">

                             <label for="exampleInputEmail1"> Account Code: </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-calendar"></i>

                              </div>

                              <input list="AccList" type="text" name="accCode" id="accCode" class="form-control " placeholder="Select Account Code" >

                              <datalist id="AccList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($acc_list as $key)
                            
                                  <option value='<?php echo $key->acc_code?>'   data-xyz ="<?php echo $key->acc_name; ?>" ><?php echo $key->acc_name ; echo " [".$key->acc_code."]" ; ?></option>
                                @endforeach

                              </datalist>

                            </div>

                            <small id="show_err_to_date">

                            </small>

                          </div>

                        </div>
                        
                        <div class="col-md-3">

                          <div class="form-group">

                             <label for="exampleInputEmail1"> Bank Code: </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-calendar"></i>

                              </div>

                              <input list="BankList" name="BankCode" id="BankCode" class="form-control" placeholder="Select Bank Code" >

                              <datalist id="BankList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($bank_list as $key)
                            
                                  <option value='<?php echo $key->bank_code?>'   data-xyz ="<?php echo $key->bank_name; ?>" ><?php echo $key->bank_name ; echo " [".$key->bank_code."]" ; ?></option>
                                @endforeach

                              </datalist>

                            </div>
                            <small>  
                                <div class="pull-left showSeletedName" id="BankText"></div>
                            </small>
                            <small id="show_err_to_date">

                            </small>

                          </div>

                        </div>

                        <div class="col-md-3">

                          <div class="form-group">

                             <label for="exampleInputEmail1"> To Date: </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-calendar"></i>

                              </div>

                              <input type="text" name="to_datecash" id="to_datecash" class="form-control datepicker1" placeholder="Select Transaction Date" value="<?php echo date('d-m-Y'); ?>">

                            </div>
                            <small id="show_err_to_date">

                            </small>

                          </div>

                        </div>

                        <div class="col-md-3" style="margin-top: 3.5%;">

                              <div class="">

                               <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch" style="padding: 6px 6px;"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                                <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

                              </div>

                        </div>

                      </div>

                  </form>


            </div><!-- /.box-body -->



            <div class="box-body" style="margin-top: -2%;">

<table id="InwardDispatch" class="table table-bordered table-striped table-hover">

  <thead class="theadC">

    

    <tr>

      <th class="text-center">Sr.NO</th>

      <th class="text-center">Vr Date</th>

      <th class="text-center">Vr No</th>

      <th class="text-center">Acc Code</th>

      <th class="text-center">Advice Amount</th>

      <th class="text-center">Tds Amount</th>

      <th class="text-center">Net Amount</th>

      <th class="text-center">Action</th>

    </tr>

  </thead>

  <tbody id="defualtSearch">

    

  </tbody>

  

</table>



</div><!-- /.box-body -->

           

          </div>

  </section>

</div>



<div class="modal fade" id="journalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-sm" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          You Want To Delete This ...!

        </div>

        <div class="modal-footer">

       <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>

      <form action="{{ url('/finance/delete-journal-transaction') }}" method="post">

      @csrf

            <input type="hidden" name="journalid" value="" id='getuserid'>

            <input type="submit" value="delete" class="btn btn-sm btn-danger" style="margin-top: -20%;">

          </form>

         </div>

      </div>

    </div>

  </div>
 


@include('admin.include.footer')


<script type="text/javascript">
  function deleteJournalT(id){
      //console.log(id);
     $('#getuserid').val(id);

  }
</script>
<script type="text/javascript">
  $(document).ready(function(){

      $("#BankCode").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#BankList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        //alert(msg+xyz);

         if(msg=='No Match'){

           $(this).val('');
        

        }

      });
      
  })
</script>
<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(accCode='',BankCode=''){


          $('#InwardDispatch').DataTable({

              
              processing: true,
              serverSide: true,
              scrollX: true,
              //dom : 'Bfrtip',
              pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
              buttons: [
                        'excelHtml5'
                        ],
              
              ajax:{
                url:'{{ url("view-payment-advice") }}',
                data: {accCode:accCode,BankCode:BankCode}
              },
              columns: [

                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex'
                },
                {
                    data:'vr_date',
                    name:'vr_date'
                },
                {
                    data:'vr_no',
                    name:'vr_no',
                    className: "text-right"

                },
                {
                    data:'acc_code',
                    name:'acc_code'
                },
              
                {
                    data:'advice_amt',
                    name:'advice_amt',
                    className: "text-right"
                },
                
                  
                {
                    data:'tds_amt',
                    name:'tds_amt',
                    className: "text-right"
                },
                {
                    data:'net_amt',
                    name:'net_amt',
                    className: "text-right"
                },
                {
                    data:'action',
                    name:'action'
                },

              ]


          });


       }


      $('#btnsearch').click(function(){

          var acct_code =  $('#accCode').val();
          var bank_code =  $('#BankCode').val();
          //console.log(acct_code);

          if (acct_code!='' || bank_code!='') {

              $('#show_err_acct_code').html('');

            $('#InwardDispatch').DataTable().destroy();
            load_data(acct_code,bank_code);

          }else{

            /*$('#show_err_from_date').html('Please select from date').css('color','red');
            
           $('#show_err_to_date').html('Please select to date').css('color','red');
           $('#show_err_dept_code').html('Please select depot name').css('color','red');
           $('#show_err_acct_code').html('Please select account code').css('color','red');
           $('#show_err_trans').html('Please select transporter').css('color','red');*/
           $('#InwardDispatch').DataTable().destroy();
            load_data();
          }


        });


        $('#ResetId').click(function(){
           
           $('#accCode').val('');
           $('#BankCode').val('');

         // document.getElementById("depotText").innerHTML = '';
         // document.getElementById("accountText").innerHTML = '';
          $('#InwardDispatch').DataTable().destroy();
          load_data();

        });



  });

</script>


@endsection