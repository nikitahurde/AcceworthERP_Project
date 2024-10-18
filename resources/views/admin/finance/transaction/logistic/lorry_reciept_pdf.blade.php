@include('admin.include.header')

<style>
  .table_highlight{
    margin-bottom: 0px;
    border-left: 1px solid lightgrey;
    border-right: 1px solid lightgrey;
    border-top: 1px solid lightgrey;
    border-bottom: 1px solid lightgrey;
  }
  .removeSpaceLogo{
    padding-top: 2px;
    padding-bottom: 2px;
    padding-left: 2px;
    padding-right: 2px;
  }
  table,th{
      font-size: 10px;
      padding : 2px 2px 2px 2px;
  }
  table,td{
      font-size: 10px;
      padding : 2px 2px 2px 2px;
  }
  table,tr,td{
    font-size: 10px;
  }
  .removeSpace{
    padding-top: 1px;
    padding-left: 1px;
    padding-right: 1px;
    padding-bottom: 1px;
  }
  .borderLeftSide{
    border-left :1px solid lightgrey;
  }
  .fontBold{
    font-weight: bold;
  }
  .numberRight{
    text-align:right;
  }
</style>

<?php $totlAmt1=0;
   foreach($dataheadB as $row1){ $totlAmt1 +=$row1->MATERIAL_VAL; } ?>



<table class="table table-bordered" style="margin-bottom: 0px;">
    <tr>
      <th style="text-align: center;font-size: 15px;">LORRY RECEIPT</th>
    </tr>
</table>

<table class="table table_highlight">
  
  <tr class="table_highlight">

    <td class="removeSpaceLogo" style="width:15%;">
      <table>
          <tr>
            <td><img src="{{ asset('public/dist/img/MUKUNDGROUPLOGO.png') }}" style="width:75px;height:75px;" alt="job image" title="job image"></td>
          </tr>
      </table>
    </td>

    <td class="removeSpaceLogo" style="width:50%;">
        <table>
            <tr>
              <td class="removeSpaceLogo" style="font-size: 14px;font-weight: bold;"><?php echo $compDetail[0]->COMP_NAME ?></td>
            </tr>
            <tr>
              <td class="removeSpaceLogo" style="font-size: 12px;"><?php echo $compDetail[0]->ADD1 ?>, <?php echo $compDetail[0]->ADD2 ?>, <?php echo $compDetail[0]->ADD3 ?>, <?= $compDetail[0]->CITY_NAME ?> - <?= $compDetail[0]->PIN_CODE ?>
              </td>
            </tr>
            <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
            <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
        </table>
      </td>

      <td class="removeSpaceLogo" style="width: 35%;border-left: 1px solid lightgrey;">
        <table>

          <tr>
            <th class="removeSpace">GST NO</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo ($compDetail[0]->GST_NO) ? $compDetail[0]->GST_NO : "----"; ?></td>
          </tr>
          <tr>
            <th class="removeSpace">PAN NO</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo ($compDetail[0]->PAN_NO) ? $compDetail[0]->PAN_NO : "----"; ?></td>
          </tr>
          <tr>
            <th class="removeSpace">EMAIL ID</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo ($compDetail[0]->EMAIL_ID) ? $compDetail[0]->EMAIL_ID : "----"; ?></td>
          </tr>
          <tr>
            <th class="removeSpace">PHONE NO</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo ($compDetail[0]->PHONE1) ? $compDetail[0]->PHONE1 : "----"; ?></td>
          </tr>
          
        </table>
      </td>

  </tr>
</table>

<table class="table table_highlight">

  <tr class="table_highlight">

    <td style="width:50%;">
      <table>

        <tr>
          <td class="removeSpace fontBold">VEHICLE NO</td>
          <td class="removeSpace fontBold">:</td>
          <td class="removeSpace fontBold"><?php echo ($dataheadB[0]->vehicleNoHead) ? $dataheadB[0]->vehicleNoHead : "----"; ?></td>
           <td class="removeSpace fontBold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TRANSHIPMENT VEHICLE NO</td>
        </tr>

        <tr>
          <td class="removeSpace fontBold">CATEGORY</td>
          <td class="removeSpace">:</td>
          <td class="removeSpace">Transport</td>
        </tr>

        <tr style="text-align:center;">
          <td colspan="3" >INSURANCE AT OWNER'S RISK</td>
        </tr>

        <tr>
          <td class="removeSpace fontBold">Truck Type</td>
          <td class="removeSpace">:</td>
          <td class="removeSpace"><?php echo $vehicle_type ? $vehicle_type : "----"; ?> - <?php echo $vehicle_type_name ? $vehicle_type_name : "----"; ?></td>
        </tr>

        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>

        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>

      </table>
    </td>
    <td style="width:50%;" td class="removeSpace borderLeftSide">
      
      <table>
        
        <tr>
          <td style="width:100%;">
            <table>

              <tr>
                <td class="removeSpace fontBold">Lr No</td>
                <td class="removeSpace">:</td>
                <td class="removeSpace"><?php echo ($dataheadB[0]->LR_NO) ? $dataheadB[0]->LR_NO : "----"; ?></td>
                <td class="removeSpace fontBold">&nbsp;&nbsp;Lr Date</td>
                <td class="removeSpace">:</td>
                <td class="removeSpace"><?php echo ($dataheadB[0]->LR_DATE) ? date("d-m-Y", strtotime($dataheadB[0]->LR_DATE)) : "----"; ?></td>

              </tr>
              <tr>
                <td class="removeSpace fontBold">FROM PLACE</td>
                <td class="removeSpace">:</td>
                <td class="removeSpace"><?php echo ($dataheadB[0]->FROM_PLACE) ? $dataheadB[0]->FROM_PLACE : "----"; ?></td>
              </tr>

              <tr>
                <td class="removeSpace fontBold">TO PLACE</td>
                <td class="removeSpace">:</td>
                <td class="removeSpace"><?php echo ($dataheadB[0]->TO_PLACE) ? $dataheadB[0]->TO_PLACE : "----"; ?></td>
              </tr>

              <tr>
                <td class="removeSpace fontBold">E-WAYBILL NO</td>
                <td class="removeSpace">:</td>
                <td class="removeSpace"><?php echo ($dataheadB[0]->EBILL_NO) ? $dataheadB[0]->EBILL_NO : "----"; ?></td>
              </tr>

              <tr>
                <td class="removeSpace fontBold">E-WBILL DATE</td>
                <td class="removeSpace">:</td>
                <td class="removeSpace"><?php echo ($dataheadB[0]->E_BILL_CREATE_DATE) ? $dataheadB[0]->E_BILL_CREATE_DATE : "----"; ?></td>

                <td class="removeSpace fontBold">&nbsp;&nbsp;VALID DATE</td>
                <td class="removeSpace">:</td>
                <td class="removeSpace fontBold"><?php echo ($dataheadB[0]->EWAYB_VALIDDT) ? $dataheadB[0]->EWAYB_VALIDDT : "----"; ?></td>

              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </td>
         
        </tr>

      </table>

    </td>
    
  </tr>
  
</table>

<table class="table table_highlight">

  <tr class="table_highlight">

    <td style="width:50%;">
      <table>

        <tr>
          <th class="removeSpace fontBold">Consignor's Name & Address : </th>
        </tr>

        <tr>
          <td class="removeSpace fontBold"><?php echo $dataAccDetail[0]->ACCNAME; ?></td>
        </tr>
        <tr>
          <td class="removeSpace"><?php echo $dataAccDetail[0]->ADD1.' '.$dataAccDetail[0]->CITY_NAME.' '.$dataAccDetail[0]->DIST_NAME.' '.$dataAccDetail[0]->STATE_NAME.' '.$dataAccDetail[0]->PIN_CODE; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">GST NO : <?php echo ($dataAccDetail[0]->GST_NUM) ? $dataAccDetail[0]->GST_NUM : "----"; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">PAN NO : <?php echo ($dataAccDetail[0]->PAN_NO) ? $dataAccDetail[0]->PAN_NO : "----"; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">MO. NO. : <?php echo ($dataAccDetail[0]->CONTACT_NO) ? $dataAccDetail[0]->CONTACT_NO : "----";; ?></td>
        </tr>
      </table>
    </td>
    <td style="width:50%;" class="removeSpace borderLeftSide">
      
      <table>
        <tr>
          <th class="removeSpace fontBold">Consignee's Name & Address : </th>
        </tr>

        <tr>
          <td class="removeSpace fontBold"><?php echo $dataheadB[0]->CP_NAME; ?></td>
        </tr>
        <tr>
          <td class="removeSpace"><?php echo $consinerDetail[0]->ADD1.' '.$consinerDetail[0]->CITY_NAME.' '.$consinerDetail[0]->DIST_NAME.' '.$consinerDetail[0]->STATE_NAME.' '.$consinerDetail[0]->PIN_CODE; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">GST NO : <?php echo ($consinerDetail[0]->GST_NUM) ? $consinerDetail[0]->GST_NUM : "----"; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">PAN NO : <?php echo ($consinerDetail[0]->PAN_NO) ? $consinerDetail[0]->PAN_NO : "----"; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">MO. NO. : <?php echo ($consinerDetail[0]->CONTACT_NO) ? $consinerDetail[0]->CONTACT_NO : "----"; ?></td>
        </tr>

      </table>

    </td>
    
  </tr>
  
</table>

<table class="table table_highlight">

  <tr class="table_highlight">
    <th class="table_highlight">Invoice NO.<br>Invoice DATE</th>
    <th class="table_highlight">D.O.No.<br>D.O.Date</th>
    <th class="table_highlight">Delivery No.</th>
    <th class="table_highlight">Wagon No.</th>
    <th class="table_highlight">Item Description Batchno</th>
    <th class="table_highlight">Bdl/Pcs</th>
    <th class="table_highlight">Gross Quantity</th>
    <th class="table_highlight">Net Quantity</th>
    <th class="table_highlight">Amount</th>
  </tr>
  
  <?php $totlAmt=0;$totlgrossQty=0;$totalnetQty=0;$total_amt=0;$totalFreightRate=0;$totalAQty=0;
   foreach($dataheadB as $row){ $totlAmt +=$row->MATERIAL_VAL;?>
    <tr class="table_highlight">
      <?php $invcNo =  ($row->INVC_NO) ? $row->INVC_NO : "----"; 
              $invcDate = ($row->INVC_DATE) ? $row->INVC_DATE : "----"; 
              $doNum = ($row->DO_NO) ? $row->DO_NO : "----"; 
              $doDate = ($row->DO_DATE) ? date("d-m-Y", strtotime($row->DO_DATE)) : "----"; 
              $deliveryNo = ($row->DELIVERY_NO) ? $row->DELIVERY_NO : "----"; 
              $wagonNo = ($row->WAGON_NO) ? $row->WAGON_NO : "----"; 
              $a_qty = ($row->AQTY) ? $row->AQTY : "----"; 
              $freightRate = ($row->MFPO_RATE) ? $row->MFPO_RATE : "0.00"; 
              $amount = ($row->MATERIAL_VAL) ? $row->MATERIAL_VAL : "0.00"; 
              $grossQty = ($row->GROSS_WEIGHT) ? $row->GROSS_WEIGHT : "0.000"; 
              if($supp_lr=='SLR'){
                $netQty = ($row->QTY) ? $row->QTY : "0.000";  
              }else{
                $netQty = ($row->NET_WEIGHT) ? $row->NET_WEIGHT : "0.000"; 
              }
              $remark = ($row->REMARK) ? $row->REMARK : "----"; 

              $formInvcDt = date("d-m-Y", strtotime($invcDate)); 

              $totalAQty        +=$a_qty;
              $totlgrossQty     +=$grossQty;
              $totalnetQty      +=$netQty;
              $total_amt        +=$amount;
              $totalFreightRate +=$freightRate;
      ?>
      <td class="table_highlight" style="width:12%;"><?php echo $invcNo; ?><br><?php echo $formInvcDt; ?></td>
      <td class="table_highlight" style="width:15%;"><?php echo $doNum; ?><br><?php echo $doDate; ?></td>
      <td class="table_highlight" style="width:10%;"><?php echo $deliveryNo; ?></td>
      <td class="table_highlight" style="width:10%;"><?php echo $wagonNo; ?></td>
      <td class="table_highlight" style="width:16%;"><?php echo $remark; ?></td>
      <td class="table_highlight numberRight" style="width:6%;"><?php echo $a_qty; ?></td>
      <td class="table_highlight numberRight" style="width:10%;"><?php echo $grossQty; ?></td>
      <td class="table_highlight numberRight" style="width:10%;"><?php echo $netQty; ?></td>
      <td class="table_highlight numberRight" style="width:10%;"><?php echo $amount; ?></td>
    </tr>
  <?php } ?>
  <tr>
    <td class="table_highlight" colspan="4" style="border-right: 1px solid white;">Total Invoice Value :</td>
    <td class="table_highlight" style="text-align: right;border-left: 1px solid white;">Total:</td>
    <td class="table_highlight numberRight" style="width:6%;"><?php $floata_qty = number_format((float)$totalAQty, 3, '.', ''); echo $floata_qty; ?></td>
    <td class="table_highlight numberRight" style="width:10%;"><?php $floatgross_qty = number_format((float)$totlgrossQty, 3, '.', ''); echo $floatgross_qty; ?></td>
    <td class="table_highlight numberRight" style="width:10%;"><?php $floatnet_qty = number_format((float)$totalnetQty, 3, '.', ''); echo $floatnet_qty; ?></td>
    <td class="table_highlight numberRight" style="width:10%;"><?php $floatTotall_amt = number_format((float)$total_amt, 2, '.', ''); echo $floatTotall_amt; ?></td>
  </tr>
  <?php  
      $total_amt = number_format((float)$totlAmt, 2, '.', ''); 
      $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );
      $amountInWord = $f->format($total_amt); 
    ?>

  <tr class="table_highlight">
    <td class="table_highlight" colspan="10">Frieght Amount : <?php echo strtoupper($amountInWord); ?> Only</td>
  </tr>
</table>

<table class="table table_highlight">
  <tr>
    <th>To Be Billed at Nagpur "Test Certificate Encl."/eWay Bill Copy of Invoice Encl.</th>
  </tr>
  <tr>
    <td>Entered By</td>
  </tr>
  <tr>
    <td>Remarks: Person/Company responsible for paying GST - <?php echo $dataAccDetail[0]->ACCNAME; ?> ( <?php echo $dataAccDetail[0]->ACCCODE; ?> ).</td>
  </tr>
  <tr>
    <td>** Special Instruction For Driver **</td>
  </tr>

  <?php  $days = ($trip_day) ? $trip_day : "0";
  
         $dateTrip = ($tripDate) ? $tripDate : "0"; 
        /* $newDate = date('d-m-Y',strtotime($dateTrip)); */
         $newDate =  date('d-m-Y', strtotime($dateTrip. ' + '.$days.' days'));
          
    ?>

  
  <tr>
    <td>1) Vehicle must reach at cutomer's point within <?= $days ?> Days on or before  <?= $newDate ?> For Delay in Delivery Compared to the Stipulated Transit Time - penalty will be charged per Day PMT</td>
  </tr>
  <tr>
    <td>2) Acknowledged copy of L/R must be forwarded to us within 10 Ddays from date of despatch failing, a penalty of Rs. 500/- per day will be charged.</td>
  </tr>
  <tr>
    <td>3) PPE (Personal Protective Equipment ) is mandatory for Transporters representative / Driver / Helpers. Any non-compliance will attract a penalty of Rs 500/- Per incident.</td>
  </tr>
  <tr>
    <td>4) All disputes are subject to Nagpur Jurisdiction only.</td>
  </tr>

  <tr>
    <td style="font-weight: bold;">Remark</td>
  </tr>

          <tr>
            <th>&nbsp;</th>
            </tr>
          <tr>
            <th>&nbsp;</th>
          </tr>
          <tr>
            <th>&nbsp;</th>
          </tr>
          <tr>
            <th>&nbsp;</th>
          </tr>

       
</table>


<table class="table table-bordered" style="margin-bottom: 0px;">
    <tr>
      <td style="text-align: center;border-top: 1px solid white;border-bottom: 1px solid white;">---- To be filled at receiver's end ----</td>
    </tr>
</table>

<table class="table table_highlight table-bordered">
  <tr class="table_highlight"> 
    <td style="width:50%;">
      <table class="table-bordered" style='width:100%'>
        <tr>
          <td style="padding:8px;">Vehicle No.: </td>
        </tr>
        <tr>
          <td style="padding:8px;">Date & Time Of Arrival :</td>
        </tr>
        <tr>
          <td style="padding:8px;">Material : </td>
        </tr>
        <tr>
          <td style="padding:8px;">No. of Pcs/Bdls Recd : </td>
        </tr>
       
      </table>
    </td>
    <td>
      <table class="table-bordered" style='width:100%'>
        <tr>
          <td style="padding:8px;">Date & Time Of Unloading : </td>
        </tr>
        <tr>
          <td style="padding:8px;">Tonnage Received : </td>
        </tr>
        <tr>
          <td style="padding:8px;">Packing Condition of Material : </td>
        </tr>
        <tr>
          <td style="padding:8px;">&nbsp; </td>
        </tr>
        
      </table>
    </td>
  </tr>
</table>

<table class="table table_highlight">

  <tr class="table_highlight">
    <td style="width:50%;">
      <table>
        <tr>
          <th>Please acknowledge with stamp & sign</th>
        </tr>
        <tr>
          <th>&nbsp;</th>
        </tr>
        <tr>
          <th>&nbsp;</th>
        </tr>
        <tr>
          <th>&nbsp;</th>
        </tr>
        <tr>
          <th>&nbsp;</th>
        </tr>
        <tr>
          <th>&nbsp;</th>
        </tr>
      </table>
    </td>
    <td class="borderLeftSide" style="width:50%;">
      <table class="table">
        <tr>
          <th style="text-align: right;"><?php echo $compDetail[0]->COMP_NAME ?></th>
        </tr>
        <tr>
          <th>&nbsp;</th>
        </tr>
        <tr>
          <th>&nbsp;</th>
        </tr>
        <tr>
          <th>&nbsp;</th>
        </tr>
        <tr>
          <th>&nbsp;</th>
        </tr>
        <tr>
          <th style="text-align: right;">Authorised Signatory</th>
        </tr>
      </table>
    </td>
  </tr>
  
</table>