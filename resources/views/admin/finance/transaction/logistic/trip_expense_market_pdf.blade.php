@include('admin.include.header')

<style type="text/css">
  p{
    font-size: 10px;
  }
  table,th{
    font-size: 10px;
    padding : 5px 5px 5px 5px;
  }
  table,td{
    font-size: 9px;
    padding : 5px 5px 5px 5px;
  }
  table,tr,td{
    font-size: 10px;
    padding : 5px 5px 5px 5px;
  }
  table,tr,td,table,tr,td{
    font-size: 10px;
    padding : 5px 5px 5px 5px;
  }
  

  .partyDetail td{
      width: 50%;
  }
  .table_highlight{
      margin-bottom: 0px;
      border-left: 1px solid lightgrey;
      border-right: 1px solid lightgrey;
      border-top: 1px solid lightgrey;
      border-bottom: 1px solid lightgrey;
  }
  .td_style{
    padding-top:3px;
   /* font-size: 11px;*/
  }
  .text_size{
    font-weight: bold;
  }
  .setpadding{
    padding-top: 3px;
  }
  .bodyTextS{
     /* font-size: 11px;*/
  }
  .textRightS{
    text-align: right;
  }
  .textleftS{
    text-align: left;
  }
  .textCenter{
    text-align: center;
  }
  .headingStyle{
    border-bottom: 1px solid lightgrey;
  }
  .removeSpace{
    padding-top: -2px;
  }
  .removeSpacetax{
    padding-top: 2px;
    padding-bottom: 2px;
    vertical-align: top;
  }
</style>


<?php  
          $compName      = Session::get('company_name');
          $compSplit     = explode('-',$compName);
          $fycode        = $dataheadB[0]->FY_CODE;
          $fiscalYr      = explode('-', $fycode); 
          $series_code   = $dataheadB[0]->SERIES_CODE; 
          $transDate     = $dataheadB[0]->VRDATE;
          $vr_Date       = date("d-m-Y", strtotime($transDate));
        //  $partyDate     = $dataheadB[0]->PREFDATE;
         $pdfName = 'TRIP EXPENSE SLIP';
         
           ?>
<table class="table table-bordered partyDetail" style="margin-bottom: 0px;">
    <tr>
      <th style="text-align: center;font-size: 15px;"> {{$pdfName}} </th>
    </tr>
</table>
<table class="table table_highlight">
    
    <tr class="table_highlight">
      <td style="width: 70%;">
        <table>
            <tr><td style="font-size:15px;font-weight:bold;"><?php echo $compDetail[0]->COMP_NAME ?></td></tr>
            <tr><td><?php echo $compDetail[0]->ADD1 ?> <?php echo $compDetail[0]->ADD2 ?> <?php echo $compDetail[0]->ADD3 ?><?php echo ' '.$compDetail[0]->CITY.' - '.$compDetail[0]->PIN_CODE.' '.$compDetail[0]->STATE_NAME ?></td></tr>
        </table>
      </td>

      <td  style="width: 30%;border-left: 1px solid lightgrey;">
        <table>
          <?php if($compDetail[0]->CIN_NO){ ?>
          <tr>
            <th>CIN NO</th>
            <th>:</th>
            <td><?php echo $compDetail[0]->CIN_NO; ?></td>
          </tr>
          <?php } ?>
          <?php if($compDetail[0]->PAN_NO){ ?>
          <tr>
            <th class="removeSpace">PAN NO</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $compDetail[0]->PAN_NO; ?></td>
          </tr>
          <?php } ?>
          <tr>
            <th class="removeSpace"><?php echo $vrNoPname; ?></th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $fiscalYr[0].' '.$series_code.' '.$dataheadB[0]->VRNO; ?></td>
          </tr>
          <tr>
            <th class="removeSpace">Slip Date</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $vr_Date;?></td>
          </tr>
          
          <tr>
            <th class="removeSpace">Trip Type</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"> <?php echo $dataheadB[0]->TRIP_TYPE?></td>
          </tr>
        </table>
      </td>
    </tr>
</table>

<table class="table table_highlight">
  <tr class="table_highlight" style="border-bottom: 1px solid white;">
    <th class="removeSpacetax">Driver</th>
    <th class="removeSpacetax">Vehicle</th>
    <th class="removeSpacetax">Model</th>
    <th class="removeSpacetax">Source</th>
    <th class="removeSpacetax">Destination</th>
    <th class="removeSpacetax">Material</th>
  </tr>
  <tr class="table_highlight">
    <td style="width: 19%;" class="removeSpacetax"><?= $dataheadB[0]->DRIVER_NAME;  ?></td>
    <td style="width: 16%;" class="removeSpacetax"><?= $dataheadB[0]->VEHICLE_NO; ?></td>
    <td style="width: 17%;" class="removeSpacetax"><?= $dataheadB[0]->MODEL; ?></td>
    <td style="width: 16%;" class="removeSpacetax"><?= $dataheadB[0]->FROM_PLACE; ?></td>
    <td style="width: 16%;" class="removeSpacetax"><?= $dataheadB[0]->TO_PLACE; ?></td>
    <td style="width: 16%;" class="removeSpacetax">HR COIL</td>
  </tr>
</table>





<table class="table table_highlight">
  <tr class="table_highlight">
    <td style="width:65%;border-right: 1px solid lightgrey;">
      <table>
        <tr>
          <td style="width:15%;font-size:13px;" class="removeSpacetax">Weight</td>
          <td style="width:4%;font-size:13px;" class="removeSpacetax">:</td>
          <td style="width:12%;font-size:13px;" class="removeSpacetax"><?= $dataheadB[0]->NET_WEIGHT ?></td>
          <td style="width:15%;font-size:13px;" class="removeSpacetax">loaded</td>
          <td style="width:4%;font-size:13px;" class="removeSpacetax">:</td>
          <td style="width:12%;font-size:13px;" class="removeSpacetax"><?= $dataheadB[0]->LOAD_CPCT ?></td>
          <td style="width:15%;font-size:13px;" class="removeSpacetax">loaded avg</td>
          <td style="width:4%;font-size:13px;" class="removeSpacetax">:</td>
          <td style="width:12%;font-size:13px;" class="removeSpacetax"><?= $dataheadB[0]->LOAD_AVG ?></td>
        </tr>
        <tr>
          <td style="width:15%;font-size:13px;" class="removeSpacetax">Delivery</td>
          <td style="width:4%;font-size:13px;" class="removeSpacetax">:</td>
          <td style="width:12%;font-size:13px;" class="removeSpacetax"><?= $dataheadB[0]->DELIVERY_POINT ?></td>
          <td style="width:15%;font-size:13px;" class="removeSpacetax">Empty</td>
          <td style="width:4%;font-size:13px;" class="removeSpacetax">:</td>
          <td style="width:12%;font-size:13px;" class="removeSpacetax"></td>
          <td style="width:15%;font-size:13px;" class="removeSpacetax">Empty avg</td>
          <td style="width:4%;font-size:13px;" class="removeSpacetax">:</td>
          <td style="width:12%;font-size:13px;" class="removeSpacetax"><?= $dataheadB[0]->EMPTY_AVG ?></td>
        </tr>
      </table>
      
    </td>
    <td style="width:35%;">
      <table>
        <tr>
          <td style="width:10%;font-size:13px;">Broker</td>
          <td style="width:4%;">:</td>
          <td style="width:10%;">&nbsp;</td>
          <td style="width:10%;font-size:13px;">&nbsp;</td>
          <td style="width:4%;">&nbsp;</td>
          <td style="width:10%;">&nbsp;</td>
          <td style="width:10%;font-size:13px;">&nbsp;</td>
          <td style="width:4%;">&nbsp;</td>
          <td style="width:10%;">&nbsp;</td>
         
        </tr>
        <tr>
          <td style="width:10%;font-size:13px;">Rate / ton</td>
          <td style="width:4%;">:</td>
          <td style="width:10%;font-size:13px;">0.00</td>
          <td style="width:20%;font-size:13px;">&nbsp;</td>
          <td style="width:4%;">&nbsp;</td>
          <td style="width:20%;font-size:13px;">&nbsp;</td>
          <td style="width:20%;font-size:13px;">&nbsp;</td>
          <td style="width:4%;">&nbsp;</td>
          <td style="width:20%;font-size:13px;">&nbsp;</td>
        </tr>
      </table>
      
    </td>
  </tr>
 
</table>


<table class="table table_highlight" border="1" style="border: 1px solid lightgrey;">
  <tr class="table_highlight">
    <th class="table_highlight removeSpacetax textCenter">Do No</th>
    <th class="table_highlight removeSpacetax textCenter">Do Date</th>
    <th class="table_highlight removeSpacetax textCenter">Item Code</th>
    <th class="table_highlight removeSpacetax textCenter">Item Name</th>
    <th class="table_highlight removeSpacetax textCenter">Qty</th>
    <th class="table_highlight removeSpacetax textCenter">Lr Number</th>
    
  </tr>

  <?php foreach($dataheadB as $key)  { ?>
  <tr class="table_highlight">
    <td style="width: 19%;" class="table_highlight removeSpacetax textCenter"><?= $key->DO_NO;  ?></td>
    <td style="width: 16%;" class="table_highlight removeSpacetax textRightS"><?= $key->DO_DATE; ?></td>
    <td style="width: 17%;" class="table_highlight removeSpacetax textCenter"><?= $key->ITEM_CODE; ?></td>
    <td style="width: 16%;" class="table_highlight removeSpacetax textCenter"><?= $key->ITEM_NAME; ?></td>
    <td style="width: 16%;" class="table_highlight removeSpacetax textRightS"><?= $key->QTY; ?></td>
    <td style="width: 16%;" class="table_highlight removeSpacetax textCenter"><?= $key->LR_NO; ?></td>
  </tr>

<?php } ?>
</table>

<table class="table table_highlight">
    <tr class="table_highlight">
      <td style="width: 50%;">
        <table>
          <tr>
            <th>PUMP DETAILS</th>
          </tr>
        </table>
      </td>
      <td style="width: 50%;">
        <table>
          <tr>
            <th>EXPENSE DETAILS</th>
          </tr>
        </table>
      </td>
    </tr>

  </table>


<table class="table table_highlight">
  <tr class="table_highlight">
    <td style="width:65%;vertical-align:top;">
      <table class="table table_highlight">
        <tr class="table_highlight">
          <th style="font-size:15px;" class="textCenter">Bank Code</th>
          <th style="border-left: 1px solid lightgrey;font-size:15px;" class="textCenter">Bank Name</th>
          <th style="border-left: 1px solid lightgrey;font-size:15px;" class="textCenter">Diesel</th>
          <th style="border-left: 1px solid lightgrey;font-size:15px;" class="textCenter">Cash</th>
          <th style="border-left: 1px solid lightgrey;font-size:15px;" class="textCenter">Amount</th>
        </tr>

        <?php $pmtamt=0; foreach($pumpDetail as $row) { 

            $pmtamt += $row->PAYMENT;
          ?>
        <tr>
          <td style="width:40%;font-size:13px;" class="textCenter"><?= $row->BANK_CODE; ?></td>
          <td style="width:20%;border-left: 1px solid lightgrey;font-size:13px;" ><?= $row->BANK_NAME; ?></td>
          <td style="width:20%;border-left: 1px solid lightgrey;font-size:13px;" ><?= $row->DIESEL_AMT; ?></td>
          <td style="width:20%;border-left: 1px solid lightgrey;font-size:13px;" ><?= $row->CASH_AMT; ?></td>
          <td style="width:20%;border-left: 1px solid lightgrey;font-size:13px;" class="textRightS"><?= $row->PAYMENT; ?></td>
        </tr>

      <?php } ?>



      <tr class="list-item total-row">
            <th  class="removeSpacetax" style="border-top: 1px solid lightgrey;"></th>
            <th  class="removeSpacetax" style="border-top: 1px solid lightgrey;"></th>
            <th  class="removeSpacetax" style="border-top: 1px solid lightgrey;"></th>
            <th class="tableitem removeSpacetax" style="text-align: left;border-top: 1px solid lightgrey;border-left: 1px solid lightgrey;font-size:13px;"> Total</th>
            <td style="border-left: 1px solid lightgrey;border-top: 1px solid lightgrey;font-size:13px;" data-label="Grand Total" class="tableitem  textRightS removeSpacetax">
              <?php $total_pmtamt = number_format((float)$pmtamt, 2, '.', ''); echo $total_pmtamt; ?>
            </td>
        </tr>
      </table>
      
    </td>
    <td style="width:35%;">
      <table class="table table_highlight" >
        <tr class="table_highlight">
          <th style="font-size:15px;">SR.NO</th>
          <th style="border-left: 1px solid lightgrey;font-size:15px;" class="textCenter">Payment Type</th>
          <th style="border-left: 1px solid lightgrey;font-size:15px;" class="textCenter">Adavance Rate</th>
          <th style="border-left: 1px solid lightgrey;font-size:15px;" class="textCenter">Adavance Amount</th>
        </tr>

       
        <tr>
          <td style="width:10%;text-align: center;font-size:13px;" class="removeSpacetax">1</td>
          <td style="width:50%;border-left: 1px solid lightgrey;font-size:13px;" class="removeSpacetax"><?= $payment_type ?></td>
          <td style="width:20%;border-left: 1px solid lightgrey;font-size:13px;" class="textRightS removeSpacetax"><?= $adv_rate ?></td>
          <td style="width:20%;border-left: 1px solid lightgrey;font-size:13px;" class="textRightS removeSpacetax"><?= $adv_amount ?></td>
        </tr>

      
         <tr class="list-item total-row" style="border-top: 1px solid lightgrey;">
            <th  style="border-top: 1px solid lightgrey" class="removeSpacetax"></th>
            <th  style="border-top: 1px solid lightgrey" class="removeSpacetax"></th>
            <th  class="tableitem removeSpacetax" style="text-align: left;border-left: 1px solid lightgrey;border-top: 1px solid lightgrey;font-size:13px;"> Total</th>
            <td  style="border-left: 1px solid lightgrey;border-top: 1px solid lightgrey;font-size:13px;" data-label="Grand Total" class="tableitem bodyTextS textRightS removeSpacetax">
              <?php $total_amt = number_format((float)$adv_amount, 2, '.', ''); echo $total_amt; ?>
            </td>
        </tr>
      </table>
      
    </td>
  </tr>
 
</table>

  

     





<table class="table table-bordered">
  <tr>
    <th class="textRightS" style="font-size: 11px;">
      For <?php echo $compSplit[1];?>
      <br><br><br><br><br>
      Authorised Signatory
    </th>
  </tr>
</table>

