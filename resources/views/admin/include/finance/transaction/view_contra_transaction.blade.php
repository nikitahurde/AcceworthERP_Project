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

            Contra Transaction

            <small> Contra Transaction Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report/MIS</a></li>

            <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">Contra Transaction Report</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Contra Transaction</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/finance/contra-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Contra Trans</a>

              </div>
              </div><!-- /.box-header -->


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



            



            <div class="box-body" style="margin-top: -2%;">

<table id="InwardDispatch" class="table table-bordered table-striped table-hover">

  <thead class="theadC">

    

    <tr>

      <th class="text-center">Sr.NO</th>

      <th class="text-center">Vr No</th>

      <th class="text-center">Vr Date</th>

      <th class="text-center">Fy Code</th>

      <th class="text-center">Series Code</th>

      <th class="text-center">Series Name</th>

      <th class="text-center">Particular</th>

      <th class="text-center">Pfct Code</th>

      <th class="text-center">Pfct Name</th>

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



<div class="modal fade" id="contraDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

      <form action="{{ url('/delete-contra-transaction') }}" method="post">

      @csrf

            <input type="hidden" name="contranum" value="" id='getuserid'>

            <input type="submit" value="delete" class="btn btn-sm btn-danger" style="margin-top: -20%;">

          </form>

         </div>

      </div>

    </div>

  </div>
 


@include('admin.include.footer')


<script type="text/javascript">
  function deleteContra(id){
      console.log(id);
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

        function load_data(){


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
                url:'{{ url("/finance/view-contra-transaction") }}',
               
              },
              columns: [

                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex'
                },
                {
                    data:'vr_no',
                    name:'vr_no',
                    className:'text-right'
                },
                
                {
                    data:'contra_date',
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
                    data:'fy_code',
                    name:'fy_code'
                },
                {
                    data:'series_code',
                    name:'series_code'
                },
                {
                    data:'series_code',
                    name:'series_code'
                },
                {
                    data:'particular',
                    name:'particular'
                },
                {
                    data:'pfct_code',
                    name:'pfct_code'
                },
                 {
                    data:'pfct_code',
                    name:'pfct_code'
                },
                {
                    data:'action',
                    name:'action'
                },

              ]


          });


       }






  });

</script>


@endsection