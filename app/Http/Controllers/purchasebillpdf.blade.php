
  <div class="content-wrapper">

        <!-- Content Header (Page header) -->



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                
                  
                </div><!-- /.box-header -->

                

                <div class="box-body">

 


    <!-- sample order purchase -->

    <div id="invoiceholder" style="border: 1px solid #867d7d">
  <div id="invoice" class="effect2" style="padding: 40px;">

      <div class="row" style="margin-top:-30px;">

          <div class="logo" style="margin-top:50px;float: right;"> <img src="{{ URL::asset('public/dist/img/'.$company->logo) }}" alt="Logo" /> </div>
        <div class="col-md-8">
        <div>
         <p style="font-size:12px;font-weight: bold;color: #0078a6">SHUBHALAXMI TRADING CORPORATION</p>
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
      <br>
    
    
    <div id="invoice-mid">   
     <div style="border: 1px solid #a59d9d;text-align: center;"> <span style="font-size: 16px;font-weight: bold;">Purchase Order</span></div>
     <table class="table table-bordered" style="margin-bottom: -28px !important;" >
             
        <tbody>
          <tr class="table-bordered">
            <td class="table-bordered" style="text-align: center;font-weight: bold;font-size: 12px;">Vendor Details
            </td>
            <td rowspan="2" class="table-bordered"><p><span>Purchase Ord No : {{ $getheaddata->vr_no }} </span><span style="float: right;">Purchase Ord date : </span></p><p>Tax Code : {{ $getheaddata->tax_code }} </p><p>Ref No : {{ $getheaddata->partyref_no}} </p><p>Ref Date : {{ $getheaddata->partyref_date}} </p>
            </td>

          </tr>
           <tr class="table-bordered">
            <td class="table-bordered">
              <p><b>M/S</b> :                {{ $acc_name->acc_name}} </p>
              <p><b>Address</b> :            {{ $acc_name->address1}}</p>
              <p><b>Phone</b> :              {{ $acc_name->phone1}},{{ $acc_name->phone2}}</p>
              <p><b>GSTIN</b> :              452654654</p>
              <p><b>Place of supply</b> :    {{ $acc_name->address1}}</p>
               
            </td>
          </tr>
          </tbody>

          
          
        </table>


            
    </div><!--End Invoice Mid-->
    <br>
    <div id="invoice-bot">
      
      <div id="table">
        <table class="table-main table table-bordered">
          <thead>    
              <tr class="tabletitle  table-bordered">
                <th class="table-bordered">Item Code</th>
                <th class="table-bordered">Item Name</th>
                <th class="table-bordered">Acc Code</th>
                <th class="table-bordered">Quantity</th>
                <th class="table-bordered">UM</th>
                <th class="table-bordered">A Quantity</th>
                <th class="table-bordered">AUM</th>
                <th class="table-bordered">Rate</th>
                <th class="table-bordered">Basic Amount</th>
              </tr>
          </thead>

        
            <?php $val=0;$tax_cgst=0;$tax_sgst=0;$tax_amt=0; foreach($getbodydata as $key) { 
         
                
                

                 $val += $key->basic_amt;

                 $tax_cgst += $key->cgst;

                 $tax_sgst += $key->sgst;

                 $tax_amt += $key->grand_total;
            ?>
          <tr class="list-item  table-bordered">

            <td data-label="Type" class="tableitem table-bordered">{{ $key->item_code }}</td>
            <td data-label="Description" class="tableitem table-bordered">{{ $key->item_name }}</td>
             <td data-label="Description" class="tableitem table-bordered">{{ $key->acc_code }}</td>
            <td data-label="Quantity" class="tableitem table-bordered">{{ $key->quantity }}</td>
            <td data-label="Quantity" class="tableitem table-bordered">{{ $key->um_code }}</td>
            <td data-label="Unit Price" class="tableitem table-bordered">{{ $key->Aquantity }}</td>
            <td data-label="Taxable Amount" class="tableitem table-bordered">{{ $key->aum_code }}</td>
            <td data-label="Taxable Amount" class="tableitem table-bordered">{{ $key->aum_code }}</td>
            <td data-label="%" class="tableitem table-bordered">{{ $key->basic_amt }} </td>
          </tr>
            <?php }  ?>
        
            <tr class="list-item total-row table-bordered">
                <th colspan="8" class="tableitem table-bordered"> Total</th>
                <td data-label="Grand Total" class="tableitem table-bordered" style="text-align: right;
}">{{ $val }}</td>
            </tr>
            <?php $gst = $tax_cgst + $tax_sgst ?>
             <tr class="list-item total-row table-bordered">
                <th colspan="8" class="tableitem table-bordered">GST/IGST/CGST</th>
                <td data-label="Grand Total" class="tableitem table-bordered" style="text-align: right;
}">{{ $gst }}</td>


            
             <tr class="list-item total-row table-bordered">
                <th colspan="8" class="tableitem table-bordered">Tax Ammount</th>
                <td data-label="Grand Total" class="tableitem table-bordered" style="text-align: right;
}">{{ $tax_amt }}</td>
            </tr>
            
        </table>
      </div><!--End Table-->
       
      
    </div><!--End InvoiceBot-->
    <footer>
     
    </footer>
  </div><!--End Invoice-->
</div>




                </div><!-- /.box-body -->

              </div><!-- /.box -->

            </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->

      </div>





<script type="text/javascript">
  
  $( window ).load(function() {
 alert('hi');
});
</script>

 









