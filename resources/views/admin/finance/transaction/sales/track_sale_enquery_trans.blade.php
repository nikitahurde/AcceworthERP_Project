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
  .rightcontent{

  text-align:right;


}
::placeholder {
  
  text-align:left;
}

  .Custom-Box {
      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  .showinmobile{
    display: none;
  }

  .secondSection{

    display: none;
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


.stepwizard-step p {
    margin-top: 10px;
}

.stepwizard-row {
    display: table-row;
}

.stepwizard {

    display: table;

    width: 100%;

    position: relative;

}


.stepwizard-step button[disabled] {

    opacity: 1 !important;

    filter: alpha(opacity=100) !important;

}

.stepwizard-row:before {

    top: 14px;

    bottom: 0;

    position: absolute;

    content: " ";

    width: 100%;

    height: 1px;

    background-color: #ccc;

    z-order: 0;
}

.stepwizard-step {

    display: table-cell;

    text-align: center;

    position: relative;
}

.btn-circle {

  width: 30px;

  height: 30px;

  text-align: center;

  padding: 6px 0;

  font-size: 12px;

  line-height: 1.428571429;

  border-radius: 15px;
}

.setwidthsel{

  width: 100px;

}

.amntFild{

  display: none;

}

.nonAccFild{

 display: none;

}

.showSeletedName{
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
}

.settblebrodr{
  border: 1px solid #cac6c6;
}

.tdlboxshadow{

  box-shadow: 0px 1px 4px -1px rgba(161,155,161,1);

}


.btn {

    display: inline-block;

    font-weight: 400;

    text-align: center;

    vertical-align: middle;

    cursor: pointer;

    -webkit-user-select: none;

    -moz-user-select: none;

    -ms-user-select: none;

    user-select: none;

    padding: .375rem .75rem;

    font-size: 14px;

    line-height: 1.5;

    border-radius: .25rem;

    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.btn-success {

    color: #fff;

    background-color: #28a745;

    border-color: #28a745;

}

.btn-info {

    color: #fff;

    background-color: #04a9ff;

    border-color: #04a9ff;

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

.but{

    width:105px;

    background:#00BB64;

    border:1px solid #00BB64;

    height:40px;

    border-radius:3px;

    color:white;

    margin-top:10px;

    margin:0px 0px 0px 11px;

    font-size: 14px;

}

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 6px;

    padding-bottom: 0px !important;

    line-height: 1.42857143;

    vertical-align: top;

    border-top: 1px solid #ddd;

    text-align: center;
}

.ref::before {

  color: navy;

  content: "Ch :";
}

.toalvaldesn{

    text-align: right;

    font-weight: 800;

    margin-top: 1%;
}

.debitotldesn{

    width: 277%;

    margin-left: 45%;

    text-align: end;

}

.credittotldesn{

    width: 277%;

    margin-left: -11%;

    text-align: end;
}

.debitcreditbox{

  width: 91px;

  text-align: end;
}

.savebtnstyle{

    color: #fff;

    background-color: #204d74;

    border-color: #122b40;
}

.cnaclbtnstyle{

    color: #fff;

    background-color: #d9534f;

    border-color: #d43f3a;
}

.instrumentlbl{

    font-size: 12px;

    margin-left: -5px;
}

.instTypeMode{

    width: 56%;

    margin-bottom: 5px;
}

.textdesciptn{

  width: 250px;

  margin-bottom: 5px;
}

.tdsratebtn{

  margin-top: 18% !important;

  font-weight: 600 !important;

  font-size: 10px !important;

}
.viewbtnitem{
    padding-bottom: 0px;
    padding-top: 0px;
    font-size: 12px;
    margin-bottom: 1px;
    margin-top: 2px;
}
.showdetail{
  display: none;
}
.tdsInputBox{

  margin-bottom: 2%;

}

.modltitletext{
  font-weight: 800;
  color: #5696bb;
  text-align: center;
  font-size: 16px;
}

.textSizeTdsModl{

  font-size: 13px;

}

.btn_new{
    display: inline-block;
    font-weight: 600;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding: 0.375rem 0.75rem;
    font-size: 14px;
    line-height: 1.5;
    border-radius: 1.25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.bankshowwhenrecpt{

  display: none !important;
}

.setboxWidthIndex{

  width: 25px;

  border: 1px solid #b8b6b6;

}

.SetInCenter{

  margin-top: 18%;

}

.AddM{

  width: 24px;

}
.divhsn{
      color: #3c8dbc;
    font-size: 13px;
    font-weight: 800;
    margin-bottom: 8%;
}
.aplynotStatus{
  display: none;
}
@media screen and (max-width: 600px) {

  .debitotldesn{

    width: 89px;

    margin-bottom: 5px;

    margin-left: 13%;

  }

  .credittotldesn{

    width: 89px;

    margin-bottom: 5px;

    margin-left: -34%;
  }

  .totlsetinres{

    width: 130%;

  }

  .textdesciptn{

    margin-bottom: -1%;

  }

  .debitcreditbox{

    margin-top: 0%;

  }

  .rowClass{

    overflow-x: scroll;

  }

}

</style>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Track Sales Enquiry Transaction
        <small>Add Details</small>
      </h1>

      <ul class="breadcrumb">

        <li>
          <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
        </li>

        <li>
          <a href="{{ url('/dashboard') }}">Transaction</a>
        </li>

        <li class="active">
          <a href="{{ url('/Transaction/Purchase/Purchase-Enquiry-Trans') }}">Track Sales Enquiry</a>
        </li>

       

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Track Sales Enquiry Transaction</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('Transaction/Purchase/View-Purchase-Enquiry-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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
            <div class="overlay-spinner hideloader"></div>
<style type="text/css">


.panel.with-nav-tabs .panel-heading{
    padding: 5px 5px 0 5px;
}
.panel.with-nav-tabs .nav-tabs{
  border-bottom: none;
}
.panel.with-nav-tabs .nav-justified{
  margin-bottom: -1px;
}

.with-nav-tabs.panel-info .nav-tabs > li > a,
.with-nav-tabs.panel-info .nav-tabs > li > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li > a:focus {
  color: #31708f;
}
.with-nav-tabs.panel-info .nav-tabs > .open > a,
.with-nav-tabs.panel-info .nav-tabs > .open > a:hover,
.with-nav-tabs.panel-info .nav-tabs > .open > a:focus,
.with-nav-tabs.panel-info .nav-tabs > li > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li > a:focus {
  color: #31708f;
  background-color: #bce8f1;
  border-color: transparent;
}
.with-nav-tabs.panel-info .nav-tabs > li.active > a,
.with-nav-tabs.panel-info .nav-tabs > li.active > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li.active > a:focus {
  color: #31708f;
  background-color: #fff;
  border-color: #bce8f1;
  border-bottom-color: transparent;
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu {
    background-color: #d9edf7;
    border-color: #bce8f1;
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a {
    color: #31708f;   
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
    background-color: #bce8f1;
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a,
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
    color: #fff;
    background-color: #31708f;
}

</style>


<div class="row">

 <form id="salesordertrans">
        @csrf
      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

          	
              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <tr>

                    <th style="width: 10px;"> Sr.No.</th>

                    <th>Enquiry No</th>

                    <th>Enquiry Date</th>

                    <th>Track Date</th>

                    <th>Track Remark</th>

                    <th>Notes</th>

                  </tr>

                  <tr class="useful">

                  
                    <td class="tdthtablebordr">
                      <span id='snum1' style="width: 10px;">1.</span>
                    </td> 

                     

                    <td class="tdthtablebordr">
                      <div class="input-group" style="display: inline-flex;border: none;margin-top: -3%;padding-bottom: 20px;">
                        <input list="EnqList1" class="inputboxclr SetInCenter" style="width: 90px;margin-bottom: 5px;height: 29px;" id='enq_no' name="enq_no" onchange="getEnqDate()" value=""  oninput="this.value = this.value.toUpperCase()" placeholder="Enquiry No" /> 

                           <datalist id="EnqList1">

                            <?php foreach($enq_list as $key) { 
                            		$explode = explode('-', $key->FY_CODE);
                            		$fy_yr = $explode[0];

                            	?>

                              <option value="{{ $fy_yr }} {{ $key->VRNO }} {{ $key->SERIES_CODE }}" data-xyz="{{ $key->VRNO }}">{{ $fy_yr }} {{ $key->VRNO }} {{ $key->SERIES_CODE }}</option>
                             
                            <?php }  ?>


                          </datalist>
                      </div>
                  
                     
                    </td>

                    <td class="tdthtablebordr tooltips" style="padding-top: 2%;">

                      <input type="text" class="inputboxclr getAccNAme" style="width: 110px;margin-bottom: 5px;height: 29px;" id='enquiry_date' name="enquiry_date" value="" placeholder="Enquiry Date" readonly />

                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small><br>

                     

                    </td>

                    <td class="tdthtablebordr" style="padding-top: 2%;">
                     

                       <div class="form-group">

                     
                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <input type="text" id='track_date' name="track_date" class="form-control transdatepicker rightcontent" placeholder="Select Transaction Date" autocomplete="off" style="width: 110px;height: 28px;" >

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_to_date">

                      </small>

                  </div>
                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: 6%;">

                     

                       <textarea id="track_remark" rows="1" style="width: 190px;margin-bottom:2%;height: 29px;" class="" name="track_remark" placeholder="Enter Description"></textarea>
                     
                      </div>

                    </td>

                    <td>
                       <div style="display: inline-flex;border: none;margin-top: 6%;">
                       
                      <textarea id="notes" rows="1" style="width: 190px;margin-bottom:2%;height: 29px;" class="" name="notes" placeholder="Enter Notes"></textarea>

                      </div>

                    </td> 


                    

                  

                  </tr>

                </table>

              </div>


            

        
<style type="text/css">

  .rTable { display: table; }

.rTableRow { display: table-row; }

.rTableHeading { display: table-header-group; }

.rTableBody { display: table-row-group; }

.rTableFoot { display: table-footer-group; }

.rTableCell, .rTableHead { display: table-cell; }

  .rTable {
   display: table;
   /*width: 100%;*/
}

.rTableRow {

   display: table-row;

}

.rTableHeading {

   display: table-header-group;

   background-color: #ddd;

}

.rTableCell, .rTableHead {

   display: table-cell;

   padding: 3px 10px;

   border: 1px solid #ebe7e7;

}

.rTableHeading {

   display: table-header-group;

   background-color: #ddd;

   font-weight: bold;

}

.rTableFoot {

   display: table-footer-group;

   font-weight: bold;

   background-color: #ddd;

}

.rTableBody {

   display: table-row-group;

}

.setInline{

  display: flex;

  margin-bottom: 4px;

}

.rowClass{

  margin: 0px;

  margin-top: 3%;

}

.rowClass1{

  margin: 0px;

  margin-top: 0%;

}

.rowClassonModel{

   margin: 0px;

  margin-top: 1%;

}

.LableTextField{

  text-align: center;

  font-weight: 600;

}

.distClass{

  display: none;



}

.sgstBlock{

  display: none;

}

.cgstBlock{

  display: none;

}

.afforblck{

  display: none;

}

.affiveblck{

  display: none;

}

.afsixblck{

  display: none;

}

.afsevenblck{

  display: none;

}

.afheadeightblck{

  display: none;

}

.afheadnineblck{

  display: none;

}

.afheadtenblck{

  display: none;

}

.afheadelvnblck{

  display: none;

}

.afheadtwelblck{

  display: none;

}

.getheading{

  border: none;

  width: 61px;

}
.settaxcodemodel{
  font-size: 16px;
    font-weight: 800;
    color: #5d9abd;
}
.boxer {
  display: table;
  border-collapse: collapse;
}
.boxer .box-row {
  display: table-row;
}
.boxer .box-row:first-child {
  font-weight:bold;
}
.boxer .box10 {
  display: table-cell;
  vertical-align: top;
  border: 1px solid #ddd;
  padding: 5px;
}
.boxer .hidebordritm {
  display: table-cell;
  vertical-align: top;
  border: none;
  padding: 5px;
}
.boxer .ebay {
  padding:5px 1.5em;
}
.boxer .google {
  padding:5px 1.5em;
}
.boxer .amazon {
  padding:5px 1.5em;
}
.center {
  text-align:center;
}
.right {
  float:right;
}
.texIndbox{
  width: 7%; 
  text-align: center;
}
 .texIndbox1{
  width: 5%; 
  text-align: center;
}
.texIndbox2{
  width: 45%; 
  text-align: center;
}
.rateIndbox{
  width: 15%;
  text-align: center;
}
.itmdetlheading{
  vertical-align: middle !important;
  text-align: center;
}
.itmdetlheading1{
  vertical-align: middle !important;
  text-align: center;
  width: 40%;
}
.rateBox{
  width: 20%;
  text-align: center;
  vertical-align: middle !important;
}
.amountBox{
  width: 20%;
  text-align: center;
  vertical-align: middle !important;
}
.inputtaxInd{
  background-color: white !important;
  border: none;
  text-align: center;
  height: 25px;
}
.showind_Ch{
  display: none;
}
</style>    

      <br>

       

        
        <p class="text-center">

          <button class="btn btn-success" type="button" id="submitdata" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

        </p>

     
  </div><!-- /.box-body -->

</div>

</div>
</form>

</div>
            
    

          

            

          </div><!-- /.box-body -->

        </div><!-- /.custom -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.section -->


 <!-- show modal when click on view btn after item select item -->

        <div id="allItemShow" class="modal fade" tabindex="-1">

        <div class="modal-dialog modal-md" style="margin-top: 13%;">

            <div class="modal-content" style="border-radius: 5px;">

                <div class="modal-header">

                  <div class="row">

                      <div class="col-md-12" style="text-align: center;">

                        <h5 class="modal-title modltitletext" id="exampleModalLabel">Item Details</h5>

                      </div>

                  </div>

                </div>

                <div class="modal-body table-responsive">
                    <div class="boxer" id="itemListShow">

                    </div>

                </div>

                <div class="modal-footer" style="text-align: center;" id="footer_item_1">

                </div>

            </div>

        </div>

      </div>

<style type="text/css">
  /* DivTable.com */
.divTable{
  display: table;
  width: 100%;
}
.divTableRow {
  display: table-row;
}
.divTableHeading {
  background-color: #EEE;
  display: table-header-group;
}
.divTableCell, .divTableHead {
  border: 1px solid #999999;
  display: table-cell;
  padding: 3px 8px;
  text-align: center;
    font-weight: bold;
  

}
.divTableHeading {
  background-color: #EEE;
  display: table-header-group;
  font-weight: bold;
}
.divTableFoot {
  background-color: #EEE;
  display: table-footer-group;
  font-weight: bold;
}
.divTableBody {
  display: table-row-group;
}
</style>
<!-- start enquiry vendor--->



<!-- end enquiry vendor--->
</div>

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/enquery_trans.js') }}" ></script>


<script type="text/javascript">

  
  function getEnqDate(){
    //console.log(itemid);
      var enqno =  $('#enq_no').val();

      var vr_no = enqno.split(' ');

      var enq_no = vr_no[1];
   
    
        $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

        });

        $.ajax({

          url:"{{ url('get-enqdate-by-enqnum') }}",

          method : "POST",

          type: "JSON",

          data: {enq_no: enq_no},

           success:function(data){

                var data1 = JSON.parse(data);

                console.log('asd',data1.data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                  
                    if(data1.data==''){
                       $("#enquiry_date").val('');
                        $('#submitdata').prop('disabled',true);
                    
                    }else{

                    	var date = new Date(data1.data.VRDATE);
    

    					var enq_date =  ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '-' + ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '-' + date.getFullYear();

                      $("#enquiry_date").val(enq_date);
                      $('#submitdata').prop('disabled',false);

                    }


                } /*if close*/

           }  /*success function close*/

        });  /*ajax close*/

      

  }/*function close*/
</script>

<script type="text/javascript">
  function getvalue(getvalue,staticvalue){


      if(staticvalue==1){

         
          $('#cancelbtn'+getvalue).empty();
          $('#appliedbtn'+getvalue).empty();

          var appliedbtn ='<small class="label label-success"><i class="fa fa-check"></i>&nbsp; Applied</small>';


          $('#appliedbtn'+getvalue).append(appliedbtn);
         
          $('#qpApplyOrNot'+getvalue).html('1');

         // $('#submitdata').prop('disabled', false);
         // $('#cancelbtn'+getvalue).html('');

         var dataCl =0;
         $(".quaPcountrow").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                dataCl += parseFloat(this.value);
            }

          $("#allquaPcount").val(dataCl);

        });


      
      }else{
           
          $('#appliedbtn'+getvalue).empty();
          $('#cancelbtn'+getvalue).empty();

         var cnclbtn ='<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

         $('#cancelbtn'+getvalue).append(cnclbtn);
         $('#quaP_count'+getvalue).val(0);
         $('#qpApplyOrNot'+getvalue).html('0');
         $('#itmOnQp'+getvalue).val('');
        
          //$('#appliedbtn'+getvalue).html('');
          //$('#submitdata').prop('disabled', true);

          var dataCl =0;
         $(".quaPcountrow").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                dataCl += parseFloat(this.value);
            }

          $("#allquaPcount").val(dataCl);

        });

         
      }

  }

</script>


<script type="text/javascript">
	
	function getIndentNo(indentno){

      var indNo =  $('#indentno'+indentno).val();

      var indvrno = indNo.split(' ');
      var IndentNo = indvrno[2];

      var xyz = $('#indentnoList'+indentno+' option').filter(function() {

        return this.value == indNo;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#indentno'+indentno).val('');
        $('#indent_date'+indentno).val('');
        $("#ItemList"+indentno).empty();
      }else{

        $('#series_code,#Plant_code,#tax_code,#due_days,#vr_date,#party_rf_no,#consine_code,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);
        $('#party_ref_date').prop('disabled',true);

        $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

        });

        $.ajax({

            url:"{{ url('get-indent-no-by-enquiry') }}",

            method : "POST",

            type: "JSON",

            data: {IndentNo: IndentNo},

             success:function(data){

                  var data1 = JSON.parse(data);

                  //console.log(data1);

                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                    $("#ItemList"+indentno).empty();

                    $('#ItemCodeId1').prop('readonly',false);
                    
                    $.each(data1.data, function(k, getData){

                        var indendDate = getData.VRDATE;
                        var slipD =  indendDate.split('-');

                        var vrDate = slipD[2]+'-'+slipD[1]+'-'+slipD[0];
                      
                      $("#indent_date"+indentno).val(vrDate);


                      $("#ItemList"+indentno).append($('<option>',{

                        value:getData.ITEM_CODE,

                        'data-xyz':getData.ITEM_NAME,
                        text:getData.ITEM_NAME


                      }));

                    }); 
                        

                  } /*if close*/

             }  /*success function close*/

        });  /*ajax close*/
      }

   
      

  }/*function close*/

  function showItemDetail(viewid){

    var ItemCode =  $('#ItemCodeId'+viewid).val();

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

    $.ajax({

            type: 'POST',

            url: "{{ url('get-item-um-aum') }}",

            data: {ItemCode:ItemCode}, // here $(this) refers to the ajax object not form

            success: function (data) {

              var data1 = JSON.parse(data);

             // console.log(data1);

              if(data1.data==''){
                   
              }else{  
                    //console.log();
                  $("#itemCodeshow"+viewid).html(data1.data_hsn.ITEM_NAME+'<p>('+data1.data_hsn.ITEM_CODE+')</p>');
                  $("#hsncodeshow"+viewid).html(data1.data_hsn.HSN_CODE);
                  $("#taxcodeshow"+viewid).html(data1.data_hsn.TAX_CODE);
                  $("#itemDetailshow"+viewid).html(data1.data_hsn.ITEM_DETAIL);
                  $("#itemtypeshow"+viewid).html(data1.data_hsn.TAX_TYPE);
                  $("#itemgroupshow"+viewid).html(data1.data_hsn.ITEMGROUP_CODE);
                  $("#itemclassshow"+viewid).html(data1.data_hsn.ITEMCLASS_CODE);
                  $("#itemcategoryshow"+viewid).html(data1.data_hsn.ICATG_CODE);
              }
           //  console.log(data1.data);
            }

        });

  }

  function qty_parameter(qty){

   var ItemCode = $("#ItemCodeId"+qty).val();
   var indHeadId = $("#indend_headId"+qty).val();
   var indBodyId = $("#indend_bodyId"+qty).val();
   var ItemCodeOnQp = $("#itmOnQp"+qty).val();

   if(ItemCodeOnQp == ''){
    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/get-qty-parameter-frm-indend-by-itm') }}",

            data: {ItemCode:ItemCode,indHeadId:indHeadId,indBodyId:indBodyId}, // here $(this) refers to the ajax object not form

            success: function (data) {


              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                      if(data1.data==''){

                        }else{

                          $('#qua_par_'+qty).empty();
                           //$('#footer_qaulity_btn'+qty).empty();
                           // $('#footer_ok_btn'+qty).empty();


                           var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox1'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div></div>";

                          $('#qua_par_'+qty).append(TableHeadData);

                        var sr_no=1;
                          $.each(data1.data, function(k, getData) {



                            if(data1.item_code){
                              var item_code = data1.item_code;
                            }else if(getData.item_code){
                               var item_code = getData.ITEM_CODE;
                            }

                            if(getData.IQUA_CODE){
                              var IQUACHAR = getData.IQUA_CODE;
                            }else if(getData.IQUA_CHAR){
                               var IQUACHAR = getData.IQUA_CHAR;
                            }

                            if(getData.CHAR_FROMVALUE){
                              var FROM_VALUE = getData.CHAR_FROMVALUE;
                            }else if(getData.VALUE_FROM){
                               var FROM_VALUE = getData.VALUE_FROM;
                            }

                            if(getData.CHAR_TOVALUE){
                              var TO_VALUE = getData.CHAR_TOVALUE;
                            }else if(getData.VALUE_TO){
                               var TO_VALUE = getData.VALUE_TO;
                            }

                            $('#itmOnQp'+qty).val(item_code);

                            var quaP_count = data1.data.length;
                            $('#quaP_count'+qty).val(quaP_count);
                          var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.ICATG_CODE+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+item_code+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control inputtaxInd' value="+IQUACHAR+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent' value="+FROM_VALUE+" ></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent' value="+TO_VALUE+" ></div></div> ";

                          $('#qua_par_'+qty).append(TableBody);
                              
                             
                          sr_no++ });


                          var butn =  $('#footer_quality_btn'+qty).find(':button').html();

                         if(butn != 'Ok' || butn =='undefined'){

                         var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOkbtn"+qty+"' onclick='getvalue("+qty+",1)' style='width: 36px;'>Ok</button>";

                           $('#footer_quality_btn'+qty).append(tblData);

                             var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'   onclick='getvalue("+qty+",0)'>Cancel</button>";
                             
                           $('#footer_ok_btn'+qty).append(cancelfooter);

                         }else{
                          
                         }

                        }

                    }
           
            
            },

        });
  }else{}



  }
</script>
  
 <script type="text/javascript">

$(document).ready(function(){

    var counter = 2;
        
    $("#addButton").click(function () {
                
    if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
    }   
        
    var newTextBoxDiv = $(document.createElement('div'))
         .attr("class", 'rowcount' + counter);

         //onsole.log(counter);
         var count1 = counter-1;

    getcount=$('.divTableBody .trrowget').length;

    var newrow = '<div class="divTableRow rowcount TextBoxesGroup_'+counter+' trrowget"><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'" style="padding-bottom: 10px;"><input type="checkbox" class="casecheck" id="tablesecnd'+counter+'"></div> </div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1" style="padding-bottom: 10px;"><span id="snumtwo'+counter+'">'+getcount+'.</span></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1" style="padding-top: 10px;"><input list="accList'+counter+'" type="textbox" id="acc_code'+counter+'" name="enqacc_code[]" onchange="accCodeGet('+counter+');" style="width: 103px;"><datalist id="accList'+counter+'"><option value="">-- Select --</option>@foreach($acc_list as $key)<option value="<?php echo $key->ACC_CODE;?>" data-xyz ="<?php echo $key->ACC_NAME ?>"><?php echo $key->ACC_NAME;  ?></option>@endforeach</datalist></div><button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewAccDetail'+counter+'" data-toggle="modal" data-target="#view_AccD'+counter+'" onclick="showAccountDetail('+counter+')"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1" style="padding-bottom: 10px;" class="tooltips"><input type="textbox" name="enqacc_name[]" readonly id="acc_name'+counter+'" value=""><small class="tooltiptext tooltiphide" id="accountNameTooltip'+counter+'"></small></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1" style="padding-bottom: 10px;"><input type="textbox" name="city_name[]" id="city'+counter+'" value=""></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1" style="padding-bottom: 10px;"><input type="textbox" id="phone'+counter+'" name="contact_no[]" value="" style="width: 100px;"  maxlength="10"></div></div></div><div class="modal fade" id="view_AccD'+counter+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-md" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><div class="col-md-12"><h5 class="modal-title modltitletext" id="exampleModalLabel" style="text-align: center;">Account Detail</h5></div></div></div><div class="modal-body table-responsive"><div class="boxer" id=""> <div class="box-row"> <div class="box10 texIndbox1">Acc Code</div> <div class="box10 rateIndbox">Acc Name</div> <div class="box10 rateIndbox">Acc Type Code</div> <div class="box10 rateIndbox">Acc Category Code</div><div class="box10 rateBox">Acc Class Code</div> <div class="box10 amountBox">GST Type</div><div class="box10 amountBox">GST No</div></div><div class="box-row"><div class="box10 itmdetlheading1"><small id="accCodeshow'+counter+'"> </small> </div> <div class="box10 itmdetlheading"> <small id="acctypecodeshow'+counter+'"> </small> </div> <div class="box10 itmdetlheading"> <small id="acccatshow'+counter+'"> </small> </div><div class="box10 itmdetlheading"> <small id="accclassshow'+counter+'"> </small></div> <div class="box10 itmdetlheading"> <small id="gsttypsshow'+counter+'"> </small> </div><div class="box10 itmdetlheading"> <small id="gstnoshow'+counter+'"> </small> </div> </div></div> </div> <div class="modal-footer" style="text-align: center;"><button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button></div></div></div></div></div>';

    //newTextBoxDiv.after().html(newrow);
            
    $(".divTableBody").append(newrow);

                
    counter++;
     });



     /*$("#removeButton").click(function () {
    var count2 = counter - 1;
       console.log(count2);

    if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   
        
    counter--;
            
        $(".TextBoxesGroup_"+count2).remove();
            
     });*/
     $(".removeBtntbl").on('click', function() {
        $('.casecheck:checkbox:checked').parents(".trrowget").remove();
        //console.log('yes');

        checksectbl();
     });

     function checksectbl(){

    obj = $('.divTableRow .TextBoxesGroup').find('span'); 

    objfirst = $('table tr').find('span'); 


    if(obj.length==0){
      
      $('#submitdata').prop('disabled',true);
    }else if(objfirst.length == 0){
      $('#submitdata').prop('disabled',true);
    }else{
      $.each( obj, function( key, value ) {

          id= value.id;
          $('#'+id).html(key+1);

      });
    } 
      
  }

        
     $("#getButtonValue").click(function () {
        
    var msg = '';
    for(i=1; i<counter; i++){
      msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
    }
        alert(msg);
     });
  });
</script>

<script type="text/javascript">
  function accCodeGet(accId){

      var AccCode =  $('#acc_code'+accId).val();

      var xyz = $('#accList'+accId+' option').filter(function() {

        return this.value == AccCode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      $('#accountNameTooltip'+accId).removeClass('tooltiphide');
      $('#accountNameTooltip'+accId).html(msg);

      if(msg == 'No Match'){

        $('#phone'+accId).val('');
        $('#acc_code'+accId).val('');
        $('#acc_name'+accId).val('');
        $('#city'+accId).val('');
        $('#accountNameTooltip'+accId).addClass('tooltiphide');

        $('#viewAccDetail'+accId).addClass('showdetail');
         $('#addButton').prop('disabled',true);

      }else{

        $('#addButton').prop('disabled',false);

        $('#viewAccDetail'+accId).removeClass('showdetail');
                      

        $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({

          url:"{{ url('get-data-by-acc_code') }}",

          method : "POST",

          type: "JSON",

          data: {AccCode: AccCode},

           success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                // console.log('data1.data',data1.data);

                    if(data1.data[0].CITY_CODE){
                      $("#city"+accId).prop('readonly',true);
                    }else{
                      $("#city"+accId).prop('readonly',false);
                    }
                    
                    $("#acc_name"+accId).val(data1.data[0].ACC_NAME);
                    $("#city"+accId).val(data1.data[0].CITY_CODE);
                    $("#phone"+accId).val(data1.data[0].CONTACT_NO);

                    $("#submitdata").prop('disabled',false);
                    

                    }
                   

                } /*if close*/

            /*success function close*/

      });  /*ajax close*/

      }

  }

  function showAccountDetail(acid){

    var AccCode =  $('#acc_code'+acid).val();

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

    $.ajax({

            type: 'POST',

            url: "{{ url('get-data-by-acc_code') }}",

            data: {AccCode:AccCode}, // here $(this) refers to the ajax object not form

            success: function (data) {

              var data1 = JSON.parse(data);

             // console.log(data1);

              if(data1.data==''){
                   
              }else{  
                    //console.log();
                  $("#accCodeshow"+acid).html(data1.data[0].ACC_NAME+'<p>('+data1.data[0].ACC_CODE+')</p>');
                  $("#acctypecodeshow"+acid).html(data1.data[0].ATYPE_CODE);
                  $("#acccatshow"+acid).html(data1.data[0].ACATG_CODE);
                  $("#accclassshow"+acid).html(data1.data[0].ACLASS_CODE);
                  $("#gsttypsshow"+acid).html(data1.data[0].GST_TYPE);
                  $("#gstnoshow"+acid).html(data1.data[0].GST_NUM);
              }
           //  console.log(data1.data);
            }

        });

  }
</script>

<script type="text/javascript">

  $(document).ready(function() {

    $('#due_days').on('input',function(){
      
        dueDays = parseInt($('#due_days').val());

        if(dueDays){

          var vr_date = $('#vr_date').val();
    
          var explodeDate =  vr_date.split('-');
          var expDate= explodeDate[0];
          var expMonth= explodeDate[1];
          var expYear= explodeDate[2];
          var mergeDate = expMonth+'-'+expDate+'-'+expYear;
          var getduedate = new Date(mergeDate);

          getduedate.setDate(getduedate.getDate() + dueDays); 

          var getdate = getduedate.getDate();
          var getMonth=getduedate.getMonth()+1;
          var getYear = getduedate.getFullYear();
          var duedate1 =getYear+'-'+getMonth+'-'+getdate;


          var d = new Date(duedate1);
          var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
          var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

          var duedate =da+'-'+mo+'-'+getYear;

          if(isNaN(dueDays)){
            
            $("#due_date").val('');
            $('#due_days').css('border-color','#ff0000').focus();
          }else{

          $("#due_date").val(duedate);
          $("#getdue_date").val(duedate);
          $('#due_days').css('border-color','#d2d6de');
           $('#indentno1').prop('readonly',false);
          }

         if (/\D/g.test(this.value))
          {
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
          }

        }else{
          $('#due_date').val('');
          $("#getdue_date").val('');
          $('#indentno1').prop('readonly',true);
        }

        

       
    });

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
  
  function getvrnoBySeries(){

    var seriesCode = $('#series_code').val();
    var transcode = $('#transcode').val();

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('get-vr-sequence-by-series') }}",

          method : "POST",

          type: "JSON",

          data: {seriesCode: seriesCode,transcode:transcode},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  if(data1.vrno_series == ''){

                  }else{
                    if(data1.vrno_series){
                      var getlastno = data1.vrno_series.LAST_NO;
                    }else{
                      var getlastno = '';
                    }

                    if(data1.vrnodata == ''){
                      $('#vrseqnum').val(getlastno);
                      $('#getVrNo').val(getlastno);
                    }else{
                      var lastNo = parseInt(getlastno) + parseInt(1);
                      $('#vrseqnum').val(lastNo);
                      $('#getVrNo').val(lastNo);
                    }
                  }

              }

          }

    });

  }

</script>

<script type="text/javascript">

  $(".delete").on('click', function() {

      $('.case:checkbox:checked').parents("tr").remove();

      $('.check_all').prop("checked", false); 

      var bsic_amt = 0;

       $(".getqtytotal").each(function () {
          //add only if the value is number
          if (!isNaN(this.value) && this.value.length != 0) {
              bsic_amt += parseFloat(this.value);
          }
         // console.log(bsic_amt);
        $("#basicTotal").val(bsic_amt.toFixed(2));

      });

      var dataCl =0;
         $(".quaPcountrow").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                dataCl += parseFloat(this.value);
            }

          $("#allquaPcount").val(dataCl);

        });

      check();

  }); /*--function close--*/

  function check(){

    obj = $('table tr').find('span'); 

    objtwo = $('.divTableRow .TextBoxesGroup').find('span'); 

    
    if(obj.length==0){
      $('#basicTotal').val(0.00);
      $("#allquaPcount").val(0);
      $('#submitdata').prop('disabled',true);
    }else if(objtwo.length == 0){
      $('#submitdata').prop('disabled',true);
    }else{
      $.each( obj, function( key, value ) {

          id= value.id;
          $('#'+id).html(key+1);

      });
    } 
      
  }


  var i=2;
  var adrow = 1;
  $(".addmore").on('click',function(){


      count=$('table tr').length;
      //console.log(count);

      var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span> <input  type='hidden' name='tds_rate[]' id='TdsRateByAccCode"+i+"' class='getRateForAcc'><input type='hidden' name='tds_code[]' id='TdsSection"+i+"'><input type='hidden' name='' id='accNtdsrate"+i+"'></td>";

      data +="<td class='tdthtablebordr'><div class='input-group'><input list='ItemList"+i+"' class='inputboxclr SetInCenter' style='width: 90px;margin-bottom: 5px;' id='ItemCodeId"+i+"' name='item_code[]' onchange='getItemName("+i+")' value=''  oninput='this.value = this.value.toUpperCase()' /><datalist id='EnqList"+i+"'> <?php foreach($enq_list as $key) { ?><option value='{{ $key->VRNO }}' data-xyz='{{ $key->VRNO }}'>{{ $key->FY_CODE }} {{ $key->VRNO }} {{ $key->SERIES_CODE }}</option><?php } ?></datalist></div><input type='hidden' id='indend_headId"+i+"' name='indentHeadId[]'><input type='hidden' name='indentBodyId[]' id='indend_bodyId"+i+"'><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail"+i+"' data-toggle='modal' data-target='#view_detail"+i+"' onclick='showItemDetail("+i+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button><input type='hidden' id='hsn_code"+i+"' name='hsn_code[]' value=''><div class='divhsn' id='showHsnCd"+i+"'></div><input type='hidden' id='taxByItem"+i+"' name='tax_byitem[]'><input type='hidden' id='taxratebytax"+i+"' value=''></td><td class='tdthtablebordr tooltips' style='padding-top:2%'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+i+"' name='item_name[]' readonly /><small class='tooltiptextitem tooltiphide' id='itemNameTooltip"+i+"'></small><br><textarea id='remark_data"+i+"' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description'></textarea></td><br><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox getqtytotal dr_amount inputboxclr SetInCenter' id='qty"+i+"' name='qty[]' onclick='showbtn("+i+")' oninput='CalAQty("+i+")' style='width: 80px'/><input type='text' name='unit_M[]' id='UnitM"+i+"' class='inputboxclr SetInCenter AddM' readonly><input type='hidden' id='Cfactor"+i+"'></div></td> <td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input type='text' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddM' readonly><input type='hidden' name='indtcode[]' id='indtcode"+i+"' class='inputboxclr SetInCenter AddM'><input type='hidden' name='indseriescode[]' id='indseriescode"+i+"' class='inputboxclr SetInCenter AddM'><input type='hidden' name='inslno[]' id='inslno"+i+"' class='inputboxclr SetInCenter AddM'><input type='hidden' name='indvrno[]' id='indvrno"+i+"' class='inputboxclr SetInCenter AddM'></div><div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox1'>Item Code</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div><div class='box-row'><div class='box10 itmdetlheading1'><small id='itemCodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='hsncodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemDetailshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemtypeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemgroupshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemclassshow"+i+"'> </small> </div><div class='box10 itmdetlheading'><small id='itemcategoryshow"+i+"'> </small></div></div></div></div> <div class='modal-footer' style='text-align: center;'> <button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div> </div></div></div></td><td><input type='hidden' id='quaP_count"+i+"' value='0' name='quaP_count[]' class='quaPcountrow'><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='qltParamter"+i+"' data-toggle='modal' data-target='#quality_parametr"+i+"' onclick='qty_parameter("+i+")' style='padding-bottom: 0px;padding-top: 0px;' disabled>Quality Parametr </button><div id='appliedbtn"+i+"'></div><div id='cancelbtn"+i+"'></div><div id='qpApplyOrNot"+i+"' class='aplynotStatus'>0</div><small id='qPnotfountbtn"+i+"' class='label label-danger'></small></td>";

      $('table').append(data);

      var qpdomModel ="<div class='modal fade' id='quality_parametr"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><input type='hidden' id='itmOnQp"+i+"'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Qaulity Parameter</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id='qua_par_"+i+"'></div></div><div class='modal-footer'><center><small style='text-align: center;' id='footer_ok_btn"+i+"'></small>&nbsp;<small style='text-align: center;' id='footer_quality_btn"+i+"'></small></center></div></div></div></div>";

      $('#quaPdomModel_2').append(qpdomModel);

        $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        var Plant_code =  $('#Plant_code').val();
      //  console.log(Plant_code);

          $.ajax({

            url:"{{ url('get-pfct-code-name') }}",

            method : "POST",

            type: "JSON",

            data: {Plant_code: Plant_code},

            success:function(data){
              console.log(i);
              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                  $("#indentnoList"+adrow).empty();
                  $.each(data1.indend, function(k, getData){

                    var yearf = getData.FY_CODE;

                    var startyear = yearf.split('-');

                    $("#indentnoList"+adrow).append($('<option>',{

                      value:startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,

                      'data-xyz':startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,
                      text:startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO


                    }));

                  }); 

                  

                }

            }

          });

      i++;
      adrow++;

  });  /*--function close--*/

  function select_all() {

    $('input[class=case]:checkbox').each(function(){ 

      if($('input[class=check_all]:checkbox:checked').length == 0){ 

        $(this).prop("checked", false); 

      }else{

        $(this).prop("checked", true); 

      } 

    });
  }



</script>

<script type="text/javascript">

  function getpfctData(){

    $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

    });

    var Plant_code =  $('#Plant_code').val();

    $.ajax({

            url:"{{ url('Get-Pfct-Code-Name-By-Plant') }}",

            method : "POST",

            type: "JSON",

            data: {Plant_code: Plant_code},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                  if(data1.data == ''){
                       var profitget = '';
                       var profitctr = '';
                       var pfctName = '';
                       $('#profitctrId').val(profitctr);
                       $('#pfctName').val(pfctName);
                       $('#getPfctCode').val(profitget);
                    }else{
                      $('#profitctrId').val(data1.data[0].PFCT_CODE);
                      $('#pfctName').val(data1.data[0].PFCT_NAME);
                      $('#getPfctCode').val(data1.data[0].PFCT_CODE);

                    }

                }

            }

          });

  }

  function indentData(){
    setTimeout(function() {

      var Plant_code =  $('#Plant_code').val();
      $.ajax({

            url:"{{ url('get-pfct-code-name') }}",

            method : "POST",

            type: "JSON",

            data: {Plant_code: Plant_code},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                  $("#indentnoList1").empty();
                  $.each(data1.indend, function(k, getData){

                    var yearf = getData.FY_CODE;

                    var startyear = yearf.split('-');

                    $("#indentnoList1").append($('<option>',{

                      value:startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,

                      'data-xyz':startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,
                      text:startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO


                    }));

                  }); 

                }

            }

      });

    }, 500);
  }


</script>


<script type="text/javascript">

$(document).ready(function(){

    $("#submitdata").click(function(event) {

     
          var data = $("#salesordertrans").serialize();



          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "{{ url('/Transaction/Sales/Save-Track-Sales-Enquiry-Trans') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                console.log(data);

              /* var url = "{{url('finance/view-enquiry-msg')}}"
               setTimeout(function(){ window.location = url+'/savedata'; });*/
              },

          });

              
    });


});

</script>



<script type="text/javascript">

  function ShowItemCode(itemId){

 //   var account_code = $('#account_code').val();
    var povr_num = $('#req_no').val();
    var getpovr = povr_num.split(' ');
    var povrno = getpovr[2];
    var series_code =  getpovr[1];

   // console.log(series_code);

    /*ajax close*/

  } /* ./ function*/


</script>



@endsection