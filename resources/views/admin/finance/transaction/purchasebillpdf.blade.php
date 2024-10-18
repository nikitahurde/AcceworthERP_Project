
@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">
  
  @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
*{
  margin: 0;
  box-sizing: border-box;
  -webkit-print-color-adjust: exact;
}
body{
  background: #E0E0E0;
  font-family: 'Roboto', sans-serif;
}
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
.col-left {
    float: left;
}
.col-right {
    float: right;
}

.table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
    border: 1px solid #a59d9d !important;
}
h1{
  font-size: 1.5em;
  color: #444;
}
h2{font-size: .9em;}
h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: 1.1em;
  color: #666;
  line-height: 1em;
}
a {
    text-decoration: none;
    color: #00a63f;
}



.table {
    width: 100%;
    max-width: 100%;
  
}

.table-bordered {
    border: 1px solid #adabab !important;
}

#invoiceholder{
  width:100%;
  height: 100%;
  padding: 50px 0;
}
#invoice{
  position: relative;
  margin: 0 auto;
  width: 700px;
  background: #FFF;

}

.invoice{
  position: relative;
  margin: 0 auto;
  width: 700px;
  background: #FFF;
  border: 1px solid #cccaca;
}

[id*='invoice-']{ /* Targets all id with 'col-' */
/*  border-bottom: 1px solid #EEE;*/
  padding: 20px;
}

#invoice-top{border-bottom: 2px solid #008fa6;}
#invoice-mid{min-height: 110px;}
#invoice-bot{ min-height: 240px;}

.logo{
    display: inline-block;
    vertical-align: middle;
  width: 110px;
    overflow: hidden;
}
.info{
    display: inline-block;
    vertical-align: middle;
    margin-left: 20px;
}
.logo img,
.clientlogo img {
    width: 100%;
}
.clientlogo{
    display: inline-block;
    vertical-align: middle;
  width: 50px;
}
.clientinfo {
    display: inline-block;
    vertical-align: middle;
    margin-left: 20px
}
.title{
  float: right;
}
.title p{text-align: right;}
#message{margin-bottom: 30px; display: block;}
h2 {
    margin-bottom: 5px;
    color: #444;
}
.col-right td {
    color: #666;
    padding: 5px 8px;
    border: 0;
    font-size: 0.75em;
    border-bottom: 1px solid #eeeeee;
}
.col-right td label {
    margin-left: 5px;
    font-weight: 600;
    color: #444;
}
.cta-group a {
    display: inline-block;
    padding: 7px;
    border-radius: 4px;
    background: rgb(196, 57, 10);
    margin-right: 10px;
    min-width: 100px;
    text-align: center;
    color: #fff;
    font-size: 0.75em;
}
.cta-group .btn-primary {
    background: #00a63f;
}
.cta-group.mobile-btn-group {
    display: none;
}
table{
  width: 100%;
  border-collapse: collapse;
}
td{
    padding: 5px;
    border-bottom: 1px solid #cccaca;
    font-size: 0.8em;
    text-align: left;
}

.tabletitle th {
  border-bottom: 2px solid #ddd;
  text-align: right;
}
.tabletitle th:nth-child(2) {
    text-align: left;
}
th {
    font-size: 0.9em;
    text-align: left;
    padding: 5px 10px;
}
.item{width: 50%;}
.list-item td {
    text-align: right;
}
.list-item td:nth-child(2) {
    text-align: left;
}
.total-row th,
.total-row td {
    text-align: right;
    font-weight: 700;
    font-size: .75em;
    border: 0 none;
}
.table-main {
    
}
footer {
    border-top: 1px solid #eeeeee;;
    padding: 15px 20px;
}
.effect2
{
  position: relative;
}
.effect2:before, .effect2:after
{
  z-index: -1;
  position: absolute;
  content: "";
  bottom: 15px;
  left: 10px;
  width: 50%;
  top: 80%;
  max-width:300px;
  background: #777;
  -webkit-box-shadow: 0 15px 10px #777;
  -moz-box-shadow: 0 15px 10px #777;
  box-shadow: 0 15px 10px #777;
  -webkit-transform: rotate(-3deg);
  -moz-transform: rotate(-3deg);
  -o-transform: rotate(-3deg);
  -ms-transform: rotate(-3deg);
  transform: rotate(-3deg);
}
.effect2:after
{
  -webkit-transform: rotate(3deg);
  -moz-transform: rotate(3deg);
  -o-transform: rotate(3deg);
  -ms-transform: rotate(3deg);
  transform: rotate(3deg);
  right: 10px;
  left: auto;
}


@media screen and (max-width: 767px) {
    h1 {
        font-size: .9em;
    }
    #invoice {
        width: 100%;
    }
    #message {
        margin-bottom: 20px;
    }
    [id*='invoice-'] {
        padding: 20px 10px;
    }
    .logo {
        width: 140px;
    }
    .title {
        float: none;
        display: inline-block;
        vertical-align: middle;
        margin-left: 40px;
    }
    .title p {
        text-align: left;
    }
    .col-left,
    .col-right {
        width: 100%;
    }
    .table {
        margin-top: 20px;
    }
    #table {
        white-space: nowrap;
        overflow: auto;
    }
    td {
        white-space: normal;
        border: 2px solid #b9b1b1;
    }
    tr,th{
      border: 2px solid #b9b1b1;
    }
    .cta-group {
        text-align: center;
    }
    .cta-group.mobile-btn-group {
        display: block;
        margin-bottom: 20px;
    }
     /*==================== Table ====================*/
    .table-main {
        border: 0 none;
    }  
      .table-main thead {
        border: none;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
      }
      .table-main tr {
        border-bottom: 2px solid #eee;
        display: block;
        margin-bottom: 20px;
      }
      .table-main td {
        font-weight: 700;
        display: block;
        padding-left: 40%;
        max-width: none;
        position: relative;
        border: 1px solid #cccaca;
        text-align: left;
      }
      .table-main td:before {
        /*
        * aria-label has no advantage, it won't be read inside a table
        content: attr(aria-label);
        */
        content: attr(data-label);
        position: absolute;
        left: 10px;
        font-weight: normal;
        text-transform: uppercase;
      }
      .sd{
        color: red;
      }
    .total-row th {
        display: none;
    }
    .total-row td {
        text-align: left;
    }
    footer {text-align: center;}


}


</style>

<div class="content-wrapper">


 <section class="content-header">

    <h1> Purchase Bill Transaction
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

        <a href="{{ url('/finance/form-transaction-mast') }}"> Purchase Bill Transaction</a>

      </li>

    </ul>

  </section>



<div class="box-body">

 
<div id="invoiceholder"><div id="invoice" class="effect2" style="padding:40px;border: 1px solid #cccaca;"><div class="row"><center><span style="font-weight: bold;font-size: 20px;">Purchase Bill </span><p>{{ $company->city }} - {{ $company->pin_code}}</p></center></div><div></div><div id="invoice-mid"><div style="font-size: 10px;"><p >{{ $comp_details[0]->add1 }}</p><p>{{ $comp_details[0]->add2 }}</p><p>{{ $comp_details[0]->add3 }}</p></div><br><div><span><b>Subject : Purchase Bill </b></span></div><br><div style="font-size: 10px;"><p>Dear Sir ,</p><p>Thank you for your quation and price list. We glad to place our first order with you for the following items</p></div></div><div id="invoice-bot"><div id="table" style="overflow-x: scroll;"><table class="table-main table table-bordered" style="border:1px solid #000;border-collapse:collapse;"><thead><tr class="tabletitle" style="border:1px solid #000;"><th style="border:1px solid #000;">Item Code</th><th style="border:1px solid #000;">Item Name</th><th style="border:1px solid #000;">Quantity</th><th style="border:1px solid #000;">UM</th><th style="border:1px solid #000;">A Quantity</th><th style="border:1px solid #000;">AUM</th><th style="border:1px solid #000;">Basic Amount</th></tr></thead> <?php $val=0; 
foreach($purchase_bill_body as $key) { 

        $val += $key->basic_amt;

        ?>
      <tr>
        
          <td>{{ $key->item_code }}</td>
          <td> {{ $key->item_name }}</td>
          <td style="text-align: right;">{{ $key->quantity }}  </td>
          <td style="text-align: right;">{{ $key->um_code }}  </td>
          <td style="text-align: right;">{{ $key->Aquantity }}</td>
           <td style="text-align: right;">{{ $key->aum_code }}</td>
          <td style="text-align: right;">{{ $key->basic_amt}}</td>
     
     </tr>

   <?php } ?><tr class="list-item total-row" style="border:1px solid #000;"><th colspan="6" class="tableitem"> Total</th><td data-label="Grand Total" class="tableitem" style="text-align: right;}">{{$val}}</td></table></div><div style="font-size: 10px;"><p>The above goods are require immidiatly as our stock is about  to exhust very soon. we request you to send the good thorugh your "Motor" van as the garage inward is supposed to be borme you.</p><p>We shall arrange payemnt within ten days to comply with 5/10 net 30 terms .please send all commercial and financial document along with goods .we reserve right to the reject the goods if recevied late  </p></div><div style="font-size: 12px;"><p>Yours Fithfully</p><p>X.Y.X.Z</p><P>Purchase Manager</P></div></div><footer></footer></div></div>


<table width="100%" border="1" cellspacing="0" cellpadding="0" class="invoice">
  <tr>
    <td colspan="2">

      <div class="row">
        <div class="col-md-6 logo" >
            <img src="{{ URL::asset('public/dist/img/'.$comp_details[0]->logo) }}" alt="Logo" width="80" height="50" style="padding: 5px 0px 5px 5px;">
        </div>
        
        <div class="col-md-6" style="text-align: center;">
          <h4 style="font-weight: bold;margin-left: 180px;">TAX INVOICE</h4>
        </div>

       
      </div>
     
    
     
     
    </td>
  </tr>
  <tr>
    <td>
    
      <div class="col-md-12">
      
        <p><b>{{ $comp_details[0]->comp_name }}- {{ $comp_details[0]->plant_name }}</b></p>

        <p>{{ $comp_details[0]->add1 }}</p> 
        <p>{{ $comp_details[0]->add2 }}</p> 

        <p>{{ $comp_details[0]->add3 }} </p>
        <p>{{ $comp_details[0]->city }} - {{ $comp_details[0]->pin_code}} </p>

        <p><b>Buyer Code -</b> {{ $purchase_bill[0]->acc_code }}</p>
        <p><b>PO DATE -</b> {{ $purchase_bill[0]->vr_date }}</p>
        <p><b>PO NO -</b> {{ $purchase_bill[0]->po_vrno }}</p>
         

      </div>
   
</td>

      <!-- <div class="col-md-3">
        <img src=
"https://chart.googleapis.com/chart?cht=qr&chl=Hello+World&chs=160x160&chld=L|0"
        class="qr-code img-thumbnail img-responsive" style="margin-top: 50px;" />
      </div>
 -->
  <td>
      <div class="col-md-12">

         <div class="col-md-3">
          <p><b>CIN NO </b></p>
          <p><b>PAN NO </b></p>
          <p><b>GST NO </b></p>
          <p><b>INV.NO </b></p>
          <p><b>INV.DATE </b></p>
        </div> 

         <div class="col-md-3">
          <p> {{ $comp_details[0]->cin_no }}</p>
          <p>{{ $comp_details[0]->pan_no}}</p>
          <p><?php if($comp_details[0]->gst_no){ echo $comp_details[0]->gst_no; }else{ echo '---';} ?></p>
          <p> INV-04</p>
          <p> <?php echo date('d - m - Y',strtotime($purchase_bill[0]->partybill_date)); ?></p>
        </div>
         
      
      </div>
     
    </td>
  </tr>
  <tr>
    <td colspan="2">
    <div class="col-md-6">
      <p></p>
      <p><b>Name & Address of Buyer</b></p>
    </div>

    <div class="col-md-6">
      <p></p>
      <p style="margin-left: 70px;"><b>Recipient Name & Address</b></p>
    </div>
  </td>
  </tr>

  <tr>
    <td>
    <div class="col-md-12">
        <p>{{ $purchase_bill[0]->acc_name}}</p>
        <p>{{ $purchase_bill[0]->address1}}</p> 
        <p>{{ $purchase_bill[0]->address2}}</p> 

        <p>{{ $purchase_bill[0]->address3}} </p>
        <p>{{ $purchase_bill[0]->city}}- {{ $purchase_bill[0]->pin}}</p>

        <p><b>State : </b> {{ $purchase_bill[0]->state}}</p>
        <p><b>GSTN No :</b> {{ $purchase_bill[0]->gst_num}}</p>
        <p><b>PAN NO :</b> {{ $purchase_bill[0]->panno}}</p>

      </div>
    </td>
    <td>
    <div class="col-md-12">
        <p>MVS Logistic Private Limited 200035968</p>
        <p>10,bank Vill</p> 
        <p>Rly stn-barasat,Dist-North 24 Pargna</p> 

        <p>North 24 Pargana </p>
        <p>West Bengal 743248 </p>

        <p><b>State : </b> WBSLBTR033</p>
        <p><b>GSTN No :</b> 18SDFGD3</p>
        <p><b>PAN NO :</b> ADSSD435</p>

      </div>
  </td>
  </tr>

  <tr>
    <td>
         <div class="col-md-6">
          <p><b>DISPATCH FROM </b></p>
          <p><b>INCOTERMS </b></p>
          <p><b>SP MMC CODE</b></p>
          <p><b>TRANSPORT CODE </b></p>
          <p><b>VEHICLE NO</b></p>
          <p><b>E-WAY BILL NO</b></p>
          <p><b>IRN</b></p>
        </div> 

         <div class="col-md-6">
          <p> {{ $comp_details[0]->plant_name }}</p>
          <p> TRY546546FGHHF </p>
          <p> 200546565</p>
          <p> 2045256565</p>
          <p> WB54654</p>
          <p> SDF</p>
          <p> 3265dfgdfgdfgdfgdsadsadsa</p>
        </div>
         
      
    </td>

    <td>
         <div class="col-md-6">
          <p><b>DISPATCH TO </b></p>
          <p><b>SHIPMENT NO </b></p>
          <p><b>SP MMC NAME</b></p>
          <p><b>TRANSPORT NAME </b></p>
          <p><b>VEHICLE NO</b></p>
          <p><b>ESK NUM</b></p>
        </div> 

         <div class="col-md-6">
          <p> {{ $purchase_bill[0]->acc_name}}</p>
          <p> TRY546546FGHHF </p>
          <p> SELF</p>
          <p> SELF</p>
          <p> WB54654</p>
          <p> SDF</p>
        </div>
         
      
    </td>
    
  </tr>
  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <table width="100%" border="1" cellspacing="0" cellpadding="0" style="padding-right: 5px;" class="invoice">
      <tr>
        <th style="text-align: center;">Product Name/HSN Code</th>
        <th style="text-align: center;">Quantity MT/CUM</th>
        <th style="text-align: center;"> Rate per MT</th>
        <th style="text-align: center;">Amount</th>
      </tr>

      <?php $val=0; foreach($purchase_bill_body as $key) { 

        $val += $key->basic_amt;

        ?>
      <tr>
        
          <td>{{ $key->item_code }} -( {{ $key->item_name }} )</td>
          <td style="text-align: right;">{{ $key->quantity }}  {{ $key->um_code }}</td>
          <td style="text-align: right;">{{ $key->rate }}</td>
          <td style="text-align: right;">{{ $key->basic_amt}}</td>
     
     </tr>

   <?php } ?>
   <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
        <tr>
        <td></td>
        <td></td>
        <td style="text-align: center;font-weight: bold;font-size: 13px;">Net Amount</td>
        <td style="text-align: right;font-weight: bold;font-size: 13px;" >{{ $val }}</td>
      </tr>
     <tr>
      <tr>
         <td rowspan="4">&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
      </tr>
       <tr>
          <td>&nbsp;</td>
          <td style="text-align: center;font-weight: bold;font-size: 13px;">CGST</td>
          <td>&nbsp;</td>
      </tr>
      <tr>
          <td>&nbsp;</td>
          <td style="text-align: center;font-weight: bold;font-size: 13px;">SGST/UGST</td>
          <td>&nbsp;</td>
      </tr>
      <tr>
          <td>&nbsp;</td>
          <td style="text-align: center;font-weight: bold;font-size: 13px;">Round Off Value</td>
          <td>&nbsp;</td>
      </tr>
   
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td style="text-align: center;font-weight: bold;font-size: 13px;">Total Amount</td>
        <td id="basic_amt" style="text-align: right;font-weight: bold;font-size: 13px;">{{ $val }}</td>
        
     </tr>

  </tr>
  
      <tr>
        <td colspan="5" style="font-family:Verdana, Geneva, sans-serif; font-weight:bold; font-size:13px;" colspan="2">Total Amount in Words:
        <p id="basic_amt_words">{{$numwords}}</p></td>
      </tr>

       <tr>
        <td colspan="5" style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" colspan="2"><b>Remark</b>
        </td>
      </tr>

      <tr>
        <td colspan="5" style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" colspan="2"><b>574646447</b>
        </td>
      </tr>

      <tr>
        <td colspan="5" style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" colspan="2">Contact Name and Phone : Logistic Limited MVS - 9762352653
        </td>
      </tr>

      <tr>
        <td colspan="5" style="font-family:Verdana, Geneva, sans-serif; font-weight:300; font-size:13px;" colspan="2"><div style="float: right;">
            <p><b>For JSW CEMENT LIMITED</b></p><br>
            <p>Signiture</p>
            
          </div><b>Material Recevied</b><br><br><br>
          <p>Recipient/Driver Signiture</p>

          
        </td>
      </tr>
    </table>
  </tr>
  

</table>
</div>
</div>


<script type="text/javascript">
  $( window ).load(function() {


    $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      var amt =  $('#basic_amt').html();
     alert(amt);

        $.ajax({

              url:"{{ url('conavert-amt-into-word') }}",

               method : "POST",

               type: "JSON",

               data: {amt: amt},

               success:function(data){

                    //alert(data);return false;
                    $("#basic_amt_words").html(data.toUpperCase());
;
                    
               }

          });


});
</script>




@include('admin.include.footer')

@endsection
