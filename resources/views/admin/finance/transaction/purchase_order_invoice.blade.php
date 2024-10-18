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
    border: 1px solid #a59d9d;
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
  font-size: 0.9em;
  color: #666;
  line-height: 1.2em;
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
    padding: 10px;
    border-bottom: 1px solid #cccaca;
    font-size: 0.70em;
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
    font-size: 0.7em;
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

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
            Purchase Indent
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>Purchase Indent Details</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">Master Purchase Indent</a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Purchase Indent</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                
                  <div class="box-tools pull-right">


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

  <div id="invoiceholder" style="border: 1px solid #867d7d">
  <div id="invoice" class="effect2">

    <div class="logo" style="float: right;"> <img src="{{ URL::asset('public/dist/img/'.$company->logo) }}" alt="Logo" /> </div>
      <div class="row" style="margin-top:-30px;">

        
        <div class="col-md-8">
        <div>
          <p style="font-size: 20px;font-weight: bold;color: #0078a6;width:408px;"><?php echo $compnyName[1] ?></p>
        </div>
        <div>
        <p style="background-color: #c4cecd;width: 408px;padding: 5px;">Manufacturing & Supply Of Precision Press Tool And Room Component</p>
         </div>
         <div>
           <p>{{ $company->add1}}</p>
           <p>{{ $company->add2}}</p>
           <p>{{ $company->city}} - {{ $company->pin_code}}</p>
           <!-- <p>{{ $company->phone1}}</p> -->
         </div>
       </div>


      
      

      </div>
      
    <div id="invoice-top" style="margin-top: -38px;">
      
    </div>


    
    <div id="invoice-mid">   
      <div style="border: 1px solid #a59d9d;"> <center><span style="font-size: 16px;font-weight: bold;">Purchase Order</span></center></div>
      <table class="table table-bordered" style="margin-bottom: -28px !important;" >
          
          
        <tbody>
          <tr>

           
            <td style="text-align: center;width: 50%;font-weight: bold;font-size: 12px;">Vendor Details</td>
            <td rowspan="2"><p><span>Purchase Ord No : {{ $getheaddata->vr_no }} </span><span style="float: right;">Purchase Ord date : </span></p><p>Tax Code : {{ $getheaddata->tax_code }} </p><p>Ref No : {{ $getheaddata->partyref_no}} </p><p>Ref Date : {{ $getheaddata->partyref_date}} </p></td>

          </tr>
           <tr>
            <td >
              <p><b>M/S</b> :                {{ $acc_name->acc_name}} </p>
              <p><b>Address</b> :            {{ $acc_name->address1}}</p>
              <p><b>Phone</b> :              {{ $acc_name->phone1}},{{ $acc_name->phone2}}</p>
              <p><b>GSTIN</b> :              452654654</p>
              <p><b>Place of supply</b> :    {{ $acc_name->address1}}</p>
               
            </td>
          </tr>
          </tbody>

          
          
        </table>
             
          <!-- <div class="row" style="margin-left: 0px;margin-right: 0px;">
          <div class="col-sm-12" style="border: 1px solid #e0e0e0;padding-top: 10px;">
            <center><span style="font-size: 16px;font-weight: bold;">Purchase Order</span></center>
          <th><b>GSTIN :2323423423432 </b></th><br>
            <div class="row">
              <div class="col-xs-8 col-sm-6" style="border: 1px solid #e0e0e0;padding-top: 10px;">
              
                
                  <div  style="text-align: center;font-weight: bold;font-size: 12px;border-bottom: 1px solid #e0e0e0;">Vendor Details
                  </div><br>

              <div>
                  <p><b>M/S</b> :                {{ $acc_name->acc_name}} </p>
              <p><b>Address</b> :            {{ $acc_name->address1}}</p>
              <p><b>Phone</b> :              {{ $acc_name->phone1}},{{ $acc_name->phone2}}</p>
              <p><b>GSTIN</b> :              452654654</p>
              <p><b>Place of supply</b> :    {{ $acc_name->address1}}</p>
                </div>
                 
              </div>
                 

              
              <div class="col-xs-4 col-sm-6" style="border: 1px solid #e0e0e0;padding-top: 10px;">
                 <div >
                    <p><span>Purchase Ord No : {{ $getheaddata->vr_no }} </span><span style="float: right;">Purchase Ord date : </span></p><p>Tax Code : {{ $getheaddata->tax_code }} </p><p>Ref No : {{ $getheaddata->partyref_no}} </p><p>Ref Date : {{ $getheaddata->partyref_date}} </p>
                  </div>
              </div>
            </div>
          </div>
        </div>
         -->
        <!-- <div class="clearfix">
            <div class="col-left">
                <div class="clientlogo"><img src="https://cdn3.iconfinder.com/data/icons/daily-sales/512/Sale-card-address-512.png" alt="Sup" /></div>
                <div class="clientinfo">
                    <h2 id="supplier">{{ $userdata->name }}</h2>
                    <p><span id="email">{{ $userdata->email_id }}</span><br></p>
                </div>
            </div>
            <div class="col-right">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><span>Invoice Total</span><label id="invoice_total">61.2</label></td>
                            <td><span>Currency</span><label id="currency">EUR</label></td>
                        </tr>
                        <tr>
                            <td><span>Payment Term</span><label id="payment_term">60 gg DFFM</label></td>
                            <td><span>Invoice Type</span><label id="invoice_type">EXP REP INV</label></td>
                        </tr>
                        <tr><td colspan="2"><span>Note</span>#<label id="note">None</label></td></tr>
                    </tbody>
                </table>
            </div>
        </div> -->       
    </div><!--End Invoice Mid-->
    
    <div id="invoice-bot">
      
      <div id="table">
        <table class="table-main table table-bordered" >
          <thead>    
              <tr class="tabletitle">
                <th>Item Code</th>
                <th>Item Name</th>
                <th>Acc Code</th>
                <th>Quantity</th>
                <th>UM</th>
                <th>A Quantity</th>
                <th>AUM</th>
                <th>SGST</th>
                <th>CGST</th>
                <th>Rate</th>
                <th>Basic Amount</th>
              </tr>
          </thead>

            <?php $tax_rate=array();
            $row=array(); ?>

      
            <?php   $val=0;$tax_cgst=0;$tax_sgst=0;$tax_amt=0; foreach($getbodydata as $key) { 
         
                
                

                 $val += $key->basic_amt;

                 $tax_cgst += $key->cgst;

                 $tax_sgst += $key->sgst;

                 $tax_amt += $key->grand_total;
            ?>
          <tr class="list-item">

            <td data-label="Type" class="tableitem">{{ $key->item_code }}</td>
            <td data-label="Description" class="tableitem">{{ $key->item_name }}</td>
             <td data-label="Description" class="tableitem">{{ $key->acc_code }}</td>
            <td data-label="Quantity" class="tableitem">{{ $key->quantity }}</td>
            <td data-label="Quantity" class="tableitem">{{ $key->um_code }}</td>
            <td data-label="Unit Price" class="tableitem">{{ $key->Aquantity }}</td>
            <td data-label="Taxable Amount" class="tableitem">{{ $key->aum_code }}</td>
            <td data-label="Taxable Amount" class="tableitem" colspan="2"><span style="margin-right: 50px;">{{ $key->cgst }} </span><span>{{ $key->sgst }}</span>
            </td>
              <td data-label="Taxable Amount" class="tableitem">{{ $key->aum_code }}</td>
            <td data-label="%" class="tableitem">{{ $key->basic_amt }} </td>
          </tr>
            <?php }  ?>
        
            <tr class="list-item total-row">
                <th colspan="10" class="tableitem"> Total</th>
                <td data-label="Grand Total" class="tableitem" style="text-align: right;
}">{{ $val }}</td>
            </tr>
            <?php $gst = $tax_cgst + $tax_sgst ?>
             <tr class="list-item total-row">
                <th colspan="10" class="tableitem">GST/IGST/CGST</th>
                <td data-label="Grand Total" class="tableitem" style="text-align: right;">{{ $gst }}</td>
              </tr>

              
             <tr class="list-item total-row">
                <th colspan="10" class="tableitem">Grand Total</th>
                <td data-label="Grand Total" class="tableitem" style="text-align: right;
}">{{ $tax_amt }}</td>
            </tr>
            
        </table>
      </div><!--End Table-->
       
      
    </div><!--End InvoiceBot-->
    <footer>
     
    </footer>
  </div><!--End Invoice-->
</div>

<br>

    <!-- sample order purchase -->

    <div id="invoiceholder" style="border: 1px solid #867d7d">
  <div id="invoice" class="effect2">

      <div class="row">
       <center><span style="font-weight: bold;font-size: 20px;">Sample Purchase Order Latter </span>
        <p>Color World</p><p>New Delhi,Dhaka - 12011</p></center>


      </div>
      <div></div>
       
    <div id="invoice-mid">   
        <div style="font-size: 10px;">
           <p >{{ $company->add1}}</p>
           <p>{{ $company->add2}}</p>
           <p>{{ $company->city}} - {{ $company->pin_code}}</p>
           <!-- <p>{{ $company->phone1}}</p> -->
      </div><br>
      <div>
        <span><b>Subject : Order For Verious Points </b></span>
      </div><br>
      <div style="font-size: 10px;">
        <p>Dear Sir ,</p>
        <p>Thank you for your quation and price list. We glad to place our first order with you for the following items</p>
      </div>
     
             
    </div><!--End Invoice Mid-->
    
    <div id="invoice-bot">
      
      <div id="table">
        <table class="table-main table table-bordered">
          <thead>    
              <tr class="tabletitle">
                <th>Item Code</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>UM</th>
                <th>A Quantity</th>
                <th>AUM</th>
                
                <th>Basic Amount</th>
              </tr>
          </thead>
            <?php $val=0; foreach($getbodydata as $key) { 

                 $val += $key->basic_amt;
            ?>
          <tr class="list-item">

            <td data-label="Type" class="tableitem">{{ $key->item_code }}</td>
            <td data-label="Description" class="tableitem">{{ $key->item_name }}</td>
            <td data-label="Quantity" class="tableitem">{{ $key->quantity }}</td>
            <td data-label="Quantity" class="tableitem">{{ $key->um_code }}</td>
            <td data-label="Unit Price" class="tableitem">{{ $key->Aquantity }}</td>
            <td data-label="Taxable Amount" class="tableitem">{{ $key->aum_code }}</td>
             
            
            <td data-label="%" class="tableitem">{{ $key->basic_amt }} </td>
          </tr>
            <?php } ?>
        
            <tr class="list-item total-row">
                <th colspan="6" class="tableitem"> Total</th>
                <td data-label="Grand Total" class="tableitem" style="text-align: right;
}">{{ $val }}</td>
            
        </table>
      </div><!--End Table-->

    <div style="font-size: 10px;">
      <p>The above goods are require immidiatly as our stock is about  to exhust very soon. we request you to send the good thorugh your "Motor" van as the garage inward is supposed to be borme you.  </p>

       <p>We shall arrange payemnt within ten days to comply with 5/10 net 30 terms .please send all commercial and financial document along with goods .we reserve right to the reject the goods if recevied late  </p>
    </div>

    <div style="font-size: 12px;">
      <p>Yours Fithfully</p>
      <p>X.Y.X.Z</p>
      <P>Purchase Manager</P>
    </div>
      
    </div><!--End InvoiceBot-->

    
    <footer>
     
    </footer>
  </div><!--End Invoice-->
</div>
    <!-- sample order purchase -->




                </div><!-- /.box-body -->

              </div><!-- /.box -->

            </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->

      </div>







 





@include('admin.include.footer')




@endsection



