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
  .second-page{
    page-break-before: always;
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
  .borderLeftbottom{
    border-left :0;
  }
  .fontBold{
    font-size: 11px;
    font-weight: bold;
  }
  .fontBold1{
    font-weight: bold;
  }
  .numberRight{
    text-align:right;
  }
</style>



<table class="table table_highlight">
  
  <tr class="table_highlight">

    <td class="removeSpaceLogo" style="width:30%;">
      <table>
          <tr>
            <td><img src="{{ asset('public/dist/img/MUKUNDGROUPLOGO.png') }}" style="width:75px;height:75px;" alt="job image" title="job image"></td>
          </tr>
      </table>
    </td>

    <td class="removeSpaceLogo" style="width:50%;">
        <table>
            <tr>
              <td class="removeSpaceLogo" style="font-size: 14px;font-weight: bold;text-align: center;"><?php echo $compDetail[0]->COMP_NAME ?></td>
            </tr>
            <tr>
              <td class="removeSpaceLogo" style="font-size: 12px;text-align: center;"><?php echo $compDetail[0]->ADD1 ?> <?php echo $compDetail[0]->ADD2 ?> <?php echo $compDetail[0]->ADD3 ?><?php echo ' '.strtoupper($compDetail[0]->CITY_NAME).' '.strtoupper($compDetail[0]->DIST_NAME).' '.strtoupper($compDetail[0]->STATE_NAME).' '.$compDetail[0]->PIN_CODE ?> 
              </td>
            </tr>
            <tr>
              <td class="removeSpaceLogo" style="font-size: 12px;text-align: center;">Ph. <?php echo $compDetail[0]->PHONE1.', '.$compDetail[0]->PHONE2; ?>, &nbsp;&nbsp;&nbsp; Email : <?php echo $compDetail[0]->EMAIL_ID ?>
              </td>
            </tr>
            <tr>
              <th style="text-align: center;font-size: 15px;">TAX INVOICE</th>
            </tr>
            <tr>
              <td class="removeSpaceLogo fontBold" style="text-align: center;"><?php echo ($compDetail[0]->GST_NO) ? 'GST NO : '.$compDetail[0]->GST_NO : "----"; ?>  <?php echo ($compDetail[0]->STATE_NAME) ? 'STATE : '.strtoupper($compDetail[0]->STATE_NAME) : "----"; ?> <?php echo ($compDetail[0]->PAN_NO) ? 'PAN NO : '.$compDetail[0]->PAN_NO : "----"; ?>
              </td>
            </tr>
            <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
        </table>
      </td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Page : {PAGENO} of {nbpg}</td>
  </tr>

</table>
 
<table class="table table_highlight">

  <tr class="table_highlight">

    <td class="removeSpaceLogo" style="width: 50%;border-left: 1px solid lightgrey;">

       <table style="width:180%">
        <tr style="width:70% !important;float:left;">
          <td class="fontBold">IRN NO. : </td>
          <td class="fontBold">IRN DATE : </td>
        </tr>
        <tr style="width:30% !important;float:right;">
          <td class="fontBold">ACK NO. : </td>
          <td class="fontBold">ACK DATE : </td>
        </tr>
      </table>

    </td>

  </tr>  
  
</table>

<table class="table table_highlight">

  <tr class="table_highlight">

   <td class="removeSpaceLogo" style="width: 50%;border-left: 1px solid lightgrey;">
        <table>
          <tr>
            <th>&nbsp;&nbsp;Billing To,</th>
          </tr>
            <tr>
              <td class="removeSpace fontBold">&nbsp;&nbsp; <?php echo $dataAccDetail[0]->ACCNAME; ?></td>
            </tr>
            <tr>
              <td class="removeSpace fontBold">&nbsp;&nbsp; <?php echo $dataAccDetail[0]->ADD1.' '.$dataAccDetail[0]->CITY_NAME.' '.$dataAccDetail[0]->DIST_NAME.' '.$dataAccDetail[0]->STATE_NAME.' '.$dataAccDetail[0]->PIN_CODE; ?></td>
            </tr>
            <tr>
              <td class="removeSpace fontBold">&nbsp;&nbsp; GST NO : <?php echo ($dataAccDetail[0]->GST_NUM) ? $dataAccDetail[0]->GST_NUM : "----"; ?></td>
            </tr>
            <tr>
              <td class="removeSpace fontBold">&nbsp;&nbsp; PAN NO : <?php echo ($dataAccDetail[0]->PAN_NO) ? $dataAccDetail[0]->PAN_NO : "----"; ?></td>
            </tr>
           <!--  <tr>
              <td class="removeSpace">&nbsp;&nbsp; MO. NO. : < ?php echo ($dataAccDetail[0]->CONTACT_NO) ? $dataAccDetail[0]->CONTACT_NO : "----";; ?></td>
            </tr> -->
          
        </table>
      </td>

    <td style="width:50%;" td class="removeSpace borderLeftSide">
      
      <table>
        
        <tr>
          <td style="width:60%;">
            <table>
              <tr>
                <td class="fontBold"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $BillTypeNameOrg; ?> </td>
                <br>
              </tr>
               <tr>
                <th>&nbsp;</th>
              </tr>
              <tr>
                <td class="removeSpace fontBold">Bill No</td>
                <td class="removeSpace fontBold">:</td>

                <?php 

                      $explodefy = explode('-',$dataheadB[0]->FY_CODE);

                      $fy_code = $explodefy[0]; 

                ?>

                <td class="removeSpace fontBold"><?= $pdfbillNo; ?> </td>
              </tr>
              <tr>
                <td class="removeSpace fontBold">Date</td>
                <td class="removeSpace fontBold">:</td>
                <?php $vr_date       = date("d-m-Y", strtotime($tr_vr_date)); ?>
                <td class="removeSpace fontBold"><?php echo $vr_date ? $vr_date : "----"; ?></td>
              </tr>

              <tr>
                <td class="removeSpace fontBold">Issuing Office</td>
                <td class="removeSpace fontBold">:</td>
                <td class="removeSpace fontBold"><?php echo $compDetail[0]->CITY_NAME.','.$compDetail[0]->STATE_NAME.','.$compDetail[0]->STATECODE; ?></td>
              </tr>

              <tr>
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

    <td style="width:33%;">
      <table>

        <tr>
          <th class="removeSpace fontBold">&nbsp;&nbsp;Consignor's Name & Address : </th>
        </tr>

            <tr>
              <td class="removeSpace fontBold">&nbsp;&nbsp; <?php echo $dataAccDetail[0]->ACCNAME; ?></td>
            </tr>
            <tr>
              <td class="removeSpace">&nbsp;&nbsp; <?php echo $dataAccDetail[0]->ADD1.' '.$dataAccDetail[0]->CITY_NAME.' '.$dataAccDetail[0]->DIST_NAME.' '.$dataAccDetail[0]->STATE_NAME.' '.$dataAccDetail[0]->PIN_CODE; ?></td>
            </tr>
            <tr>
              <td class="removeSpace">&nbsp;&nbsp; GST NO : <?php echo ($dataAccDetail[0]->GST_NUM) ? $dataAccDetail[0]->GST_NUM : "----"; ?></td>
            </tr>
            <tr>
              <td class="removeSpace">&nbsp;&nbsp; PAN NO : <?php echo ($dataAccDetail[0]->PAN_NO) ? $dataAccDetail[0]->PAN_NO : "----"; ?></td>
            </tr>
            <!-- <tr>
              <td class="removeSpace">&nbsp;&nbsp; MO. NO. : < ?php echo ($dataAccDetail[0]->CONTACT_NO) ? $dataAccDetail[0]->CONTACT_NO : "----";; ?></td>
            </tr> -->

        <!-- <tr>
          <td class="removeSpace fontBold">&nbsp;&nbsp; < ?php echo $dataheadB[0]->CP_NAME; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">&nbsp;&nbsp; < ?php echo $consinerDetail[0]->ADD1.' '.$consinerDetail[0]->CITY_NAME.' '.$consinerDetail[0]->DIST_NAME.' '.$consinerDetail[0]->STATE_NAME.' '.$consinerDetail[0]->PIN_CODE; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">&nbsp;&nbsp; GST NO : < ?php echo ($consinerDetail[0]->GST_NUM) ? $consinerDetail[0]->GST_NUM : "----"; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">&nbsp;&nbsp; PAN NO : < ?php echo ($consinerDetail[0]->PAN_NO) ? $consinerDetail[0]->PAN_NO : "----"; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">&nbsp;&nbsp; MO. NO. : < ?php echo ($consinerDetail[0]->CONTACT_NO) ? $consinerDetail[0]->CONTACT_NO : "----";; ?></td>
        </tr> -->
      </table>
    </td>
    <td style="width:33%;" class="removeSpace borderLeftSide">
      
      <table>
        <tr>
          <th class="removeSpace fontBold">&nbsp;&nbsp;Consignee's Name & Address : </th>
        </tr>

        <?php if($consineeDetail) { ?>
        <tr>
          <td class="removeSpace fontBold">&nbsp;&nbsp; <?php echo $dataheadB[0]->SP_NAME; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">&nbsp;&nbsp; <?php echo $consineeDetail[0]->ADD1.' '.$consineeDetail[0]->CITY_NAME.' '.$consineeDetail[0]->DIST_NAME.' '.strtoupper($consineeDetail[0]->STATE_NAME).' '.$consineeDetail[0]->PIN_CODE; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">&nbsp;&nbsp; GST NO : <?php echo ($consineeDetail[0]->GST_NUM) ? $consineeDetail[0]->GST_NUM : "----"; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">&nbsp;&nbsp; PAN NO : <?php echo ($consineeDetail[0]->PAN_NO) ? $consineeDetail[0]->PAN_NO : "----"; ?></td>
        </tr>
       <!--  <tr>
          <td class="removeSpace">&nbsp;&nbsp; MO. NO. : < ?php echo ($consineeDetail[0]->CONTACT_NO) ? $consineeDetail[0]->CONTACT_NO : "----"; ?></td>
        </tr> -->
      <?php  } else{?>
        <tr>
          <td class="removeSpace fontBold">&nbsp;&nbsp; <?php echo $dataheadB[0]->CP_NAME; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">&nbsp;&nbsp; <?php echo $consinerDetail[0]->ADD1.' '.$consinerDetail[0]->CITY_NAME.' '.$consinerDetail[0]->DIST_NAME.' '.strtoupper($consinerDetail[0]->STATE_NAME).' '.$consinerDetail[0]->PIN_CODE; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">&nbsp;&nbsp; GST NO : <?php echo ($consinerDetail[0]->GST_NUM) ? $consinerDetail[0]->GST_NUM : "----"; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">&nbsp;&nbsp; PAN NO : <?php echo ($consinerDetail[0]->PAN_NO) ? $consinerDetail[0]->PAN_NO : "----"; ?></td>
        </tr>
        <!-- <tr>
          <td class="removeSpace">&nbsp;&nbsp; MO. NO. : < ?php echo ($consinerDetail[0]->CONTACT_NO) ? $consinerDetail[0]->CONTACT_NO : "----";; ?></td>
        </tr> -->
      <?php } ?>
      </table>

    </td>

    <td style="width:34%;" class="removeSpace borderLeftSide">
      
      <table style="line-height:1;">
       
        <tr>
          <td class="removeSpace">Description of Service : <?php echo ($hsnDetail[0]->HSN_NAME) ? $hsnDetail[0]->HSN_NAME : "----"; ?></td>
        </tr>
         <tr>
          <th>&nbsp;&nbsp;</th>
        </tr>
        <tr>
          <td class="removeSpace">SAC Code : <?php echo ($itemDetail[0]->HSN_CODE) ? $itemDetail[0]->HSN_CODE : "----"; ?></td>
        </tr>
        <tr>
          <th>&nbsp;&nbsp;</th>
        </tr>
        <tr>
          <td class="removeSpace">GST payable under reverse charge : No</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;</td>
        </tr>
      
      </table>

    </td>
    
  </tr>
  
</table>
<table class="table table_highlight">

  <tr class="table_highlight">
    <th class="table_highlight text-left" style="background-color: #d9d9d9 !important;">DESCRIPTION</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">LR QTY</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">CHRG QTY</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">FRT RATE</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">AMT(INR)</th>
  </tr>
  
  <?php 
        $datacount = count($dataheadB);
        $headcount = 10-$datacount;
    $totlAmt=0;$totlgrossQty=0;$totalnetQty=0;$total_amt=0;$totalFreightRate=0;$totalAQty=0;$freightRate1=0;
   foreach($dataheadB as $row){ $totlAmt +=$row->AMOUNT;
   
         $lrDate =  ($row->LR_DATE) ? $row->LR_DATE : "----"; 
              $InvcNo =  ($row->INVC_NO) ? $row->INVC_NO : "----"; 
              $DelvryNo =  ($row->DELIVERY_NO) ? $row->DELIVERY_NO : "----"; 
              $VehicleType =  ($row->VEHICLE_TYPE) ? $row->VEHICLE_TYPE : "----"; 
              $ModelNo =  ($row->MODEL) ? $row->MODEL : "----"; 
              $vehicleNo = ($row->vehicleNoHead) ? $row->vehicleNoHead : "----"; 
              $lrno = ($row->LR_NO) ? $row->LR_NO : "----"; 
              $destination = ($row->TO_PLACE) ? $row->TO_PLACE : "----"; 
              $d_qty = ($row->DISPATCH_QTY) ? $row->DISPATCH_QTY : "----"; 
              $freightRate = ($row->FSO_RATE) ? $row->FSO_RATE : "0.00"; 
              $amount = ($row->AMOUNT) ? $row->AMOUNT : "0.00"; 
              $grossQty = ($row->GROSS_WEIGHT) ? $row->GROSS_WEIGHT : "0.000";  
              $freightRate1= $freightRate;
              $remark = ($row->REMARK) ? $row->REMARK : "----";  

              $totalAQty        +=$d_qty;
              $totlgrossQty     +=$grossQty;
              $total_amt        +=$amount;
              $totalFreightRate +=$freightRate;

            }
      ?>

    <tr class="table_highlight">
      <td class="table_highlight text-left" style="width:60%;">Freight Charge as per Annexure</td>
      <td class="table_highlight text-right numberRight" style="width:10%;"><?php $totl_grossQty = number_format((float)$totalAQty, 3, '.', ''); echo $totl_grossQty; ?></td>
      <td class="table_highlight text-right numberRight" style="width:10%;"><?php $total_AQty = number_format((float)$totalAQty, 3, '.', ''); echo $total_AQty; ?></td>
      <td class="table_highlight text-right numberRight" style="width:10%;"><?php $freight_Rate1 = number_format((float)$freightRate1, 2, '.', ''); echo $freight_Rate1; ?></td>
      <td class="table_highlight text-right numberRight" style="width:10%;"><?php $total_Amt = number_format((float)$total_amt, 2, '.', ''); echo $total_Amt; ?></td>
    </tr>
  
 

    <tr class="table_highlight" style="border:none;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;"
>
    
      <td class="table_highlight" style="width:60%;">&nbsp;</td>
      <td class="table_highlight" style="width:10%;">&nbsp;</td>
      <td class="table_highlight" style="width:10%;">&nbsp;</td>
      <td class="table_highlight" style="width:10%;">&nbsp;</td>
      <td class="table_highlight" style="width:10%;">&nbsp;</td>
      
    </tr>
  
  
   <?php if ($SGSTGET!='0.00' || $SGSTGET!='0') { ?>
    <tr class="table_highlight">
      <td  style="text-align: right;border-bottom:none;" class="fontBold1" colspan="4"><span>SGST  <?=  round($CGSTRATE, 0); ?> % </span></td>
      <td class="table_highlight fontBold1" style="text-align: right;border-bottom:none;"><?php $Totall_sgstAmt = number_format((float)round($SGSTGET,0), 2, '.', ''); echo $Totall_sgstAmt; ?> </td>
    </tr>
    <tr class="table_highlight">
      <td  style="text-align: right;border-bottom:none;" class="fontBold1" colspan="4"><span>CGST <?=  round($SGSTRATE, 0); ?> % </span></td>
      <td class="table_highlight fontBold1" style="text-align: right;border-bottom:none;"><?php $Totall_cgstAmt = number_format((float)round($CGSTGET,0), 2, '.', ''); echo $Totall_cgstAmt; ?> </td>
    </tr>
  <?php } ?>
  <?php if ($ROUNDOFF1!='0.00' || $ROUNDOFF1!='0') { ?>
    <tr class="table_highlight">
      <td  style="text-align: right;border-bottom:none;" class="fontBold1" colspan="4"><span>ROUND OFF &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></td>
      <td class="table_highlight fontBold1" style="text-align: right;border-bottom:none;"><?php echo $ROUNDOFF1; ?> </td>
    </tr>
  <?php } ?>

   <?php if ($IGSTGET!='0.00' || $IGSTGET!='0') { ?>
   <tr class="table_highlight">
    <td  style="text-align: right;border-bottom:none;" class="fontBold1" colspan="4"><span>IGST <?=   round($IGSTRATE, 0); ?></span></td>
    <td class="table_highlight fontBold1" style="text-align: right;border-bottom:none;"><?php $Totall_igstAmt = number_format((float)round($IGSTGET,0), 2, '.', ''); echo $Totall_igstAmt; ?> </td>
   </tr>
  <?php } ?>

   <?php  
      $total_amt = number_format((float)$GRANDTOT, 2, '.', ''); 
      $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );
      $amountInWord = $f->format($total_amt); 
    ?>

   <tr class="table_highlight">
    <td colspan="4" class="fontBold"><span>Amount In Words : <?php echo ucwords($amountInWord); ?> Only</span></td>
    <td class="table_highlight fontBold"  style="text-align: right;"><?php $Totall_NetAmnt = number_format((float)round($GRANDTOT,0), 2, '.', ''); echo $Totall_NetAmnt; ?></td>
  </tr>


  
</table>


<?php if($gstTaxData=='1'){ ?>

<table class="table table_highlight">
  <tr>
    <th>TERMS :- </th>
  
  <tr>
    <td>1) Payemnt should be made by Payee's Account Cheques in favor of <span class="fontBold1">"<?php echo $compDetail[0]->COMP_NAME ?>"</span> only.</td>
  </tr>
  <tr>
     <td>2) No claims and /or discrepancy if any shall be considered unless brought to the notice of the company in writing within 3 days of the receipt of the bill.</td>
  </tr>
  <tr>
     <td>3) Dispute if any shall be subjected to the jurisdiction of Mumbai Courts only.</td>
  </tr>
 
</table>
<?php } else { ?>

  <table class="table table_highlight">
  <tr>
    <th>Remark: * In the GST Regine, GST on GTA Service is liability under the reverse charge of the service recipients.</th>
  
  <tr>
    <td>1. All Payment by RTGS/cheques in favor of <span class="fontBold1">"<?php echo $compDetail[0]->COMP_NAME ?>"</span> should be crossed to payees only.</td>
  </tr>
  <tr>
     <td>2. Interest @ 18% per annum will be charged on bills remaining unpaid after 15 Days from the date of bill.</td>
  </tr>
  <tr>
     <td>3. Subject To Nagpur Jurisdiction Only.</td>
  </tr>

    <tr>
      <th>&nbsp;</th>
      </tr>
       
</table>

<?php } ?>

<table class="table table_highlight">

  <tr class="table_highlight">
    <td style="width:50%;">
      <table>
        <tr>
          <th>Account Details </th>
        </tr>
        <tr>
          <th>Account Name : </th><td><?php echo $compDetail[0]->COMP_NAME ?></td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <th>Name of Bank :</th><td><?php echo $compDetail[0]->BANK_NAME ?></td>
        </tr>
        <tr>
          <th>Account No : </th><td><?php echo $compDetail[0]->ACC_NUMBER ?></td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <th>IFSC Code:</th><td><?php echo $compDetail[0]->IFSC_CODE ?></td>
        </tr>
      </table>
    </td>
  </tr>
  
</table>

<table style="width:100%;border-collapse: collapse;">
  <tr>
    <td class="text-center" style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;"> <p style="vertical-align: baseline;font-weight: bold;"> {{ $createdBy }} </p><br><br><br> <p style="vertical-align: bottom;font-size:11px;font-weight: bold;">Prepared by</p></td>
    <td class="text-center" style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;vertical-align: bottom;font-size:11px;font-weight: bold;">Checked By</td>
    <td class="text-center" style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;vertical-align: bottom;font-size:11px;font-weight: bold;">Approved By </td>
    <td class="text-center" style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;"><p style="vertical-align: baseline;font-weight: bold;"> <?php echo $compDetail[0]->COMP_NAME; ?> </p><br><br><br><p style="vertical-align: bottom;font-size:11px;font-weight: bold;">Authorised Signatory</p></td>
  </tr>
</table>


<div class="second-page"></div>

<table class="table table_highlight">
  
  <tr class="table_highlight">

    <td class="removeSpaceLogo" style="width:20%;">
      <table>
          <tr>
            <td><img src="{{ asset('public/dist/img/MUKUNDGROUPLOGO.png') }}" style="width:75px;height:75px;" alt="job image" title="job image"></td>
          </tr>
      </table>
    </td>

    <td class="removeSpaceLogo" style="width:60%;">
        <table>
            <tr>
              <td class="removeSpaceLogo" style="font-size: 14px;font-weight: bold;text-align: center;"><?php echo $compDetail[0]->COMP_NAME ?></td>
            </tr>
            <tr>
              <td class="removeSpaceLogo" style="font-size: 12px;text-align: center;"><?php echo $compDetail[0]->ADD1 ?> <?php echo $compDetail[0]->ADD2 ?> <?php echo $compDetail[0]->ADD3 ?><?php echo ' '.strtoupper($compDetail[0]->CITY_NAME).' '.strtoupper($compDetail[0]->DIST_NAME).' '.strtoupper($compDetail[0]->STATE_NAME).' '.$compDetail[0]->PIN_CODE ?> 
              </td>
            </tr>
            <tr>
              <td class="removeSpaceLogo" style="font-size: 12px;text-align: center;">Ph. <?php echo $compDetail[0]->PHONE1.', '.$compDetail[0]->PHONE2; ?>, &nbsp;&nbsp;&nbsp; Email : <?php echo $compDetail[0]->EMAIL_ID ?>
              </td>
            </tr>
            <tr>
              <th style="text-align: center;font-size: 15px;">TAX INVOICE</th>
            </tr>
            <tr>
              <td class="removeSpaceLogo fontBold" style="text-align: center;"><?php echo ($compDetail[0]->GST_NO) ? 'GST NO : '.$compDetail[0]->GST_NO : "----"; ?>  <?php echo ($compDetail[0]->STATE_NAME) ? 'STATE : '.strtoupper($compDetail[0]->STATE_NAME) : "----"; ?> <?php echo ($compDetail[0]->PAN_NO) ? 'PAN NO : '.$compDetail[0]->PAN_NO : "----"; ?>
              </td>
            </tr>
            <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
        </table>

      </td>
      <td style="width:20%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Page : {PAGENO} of {nbpg}</td>
  </tr>
</table>

<table class="table table_highlight">

  <tr class="table_highlight">

    <td style="width:50%;" td class="removeSpace"></td>

    <td style="width:50%;" td class="removeSpace borderLeftbottom" style="border-left: none;">
      
      <table>
        
        <tr>
          <td style="width:60%;">
            <table>
              <tr>
                <td class="removeSpace fontBold">Annexure No.</td>
                <td class="removeSpace fontBold">:</td>
                <td class="removeSpace fontBold">1</td>
                <td class="removeSpace fontBold"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $BillTypeNameOrg; ?> </td>
                <br>
              </tr>
              <tr>
                <td class="removeSpace fontBold">Bill No</td>
                <td class="removeSpace fontBold">:</td>
                <td class="removeSpace fontBold"><?php echo $pdfbillNo; ?> </td>
              </tr>
              <tr>
                <td class="removeSpace fontBold">Date</td>
                <td class="removeSpace fontBold">:</td>
                <?php $vr_date       = date("d-m-Y", strtotime($tr_vr_date)); ?>
                <td class="removeSpace fontBold"><?php echo $vr_date ? $vr_date : "----"; ?></td>
              </tr>

              <tr>
                <td class="removeSpace fontBold">Transporter Name</td>
                <td class="removeSpace fontBold">:</td>
                <td class="removeSpace fontBold"><?php echo ($dataheadB[0]->TRANSPORT_NAME) ? $dataheadB[0]->TRANSPORT_NAME : "----"; ?></td>
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
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;" >Sr. No.</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;" >Invoice No <br> Invoice Date</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Billing Doc. No.</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Lr No</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Wagon No</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Vehicle No</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Vehicle Type</th>
     <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Material Name</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">From Place</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">To Place</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Min Guarantee</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">LR. Qty <br> (MT)</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Charged Qty</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Cust. Receipt Dt.</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Rate <br> (INR)</th>
    <th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Amount <br> (INR)</th>
  </tr>
  
  <?php 
        $srNo = 1;
        $datacount = count($dataheadB);
        $headcount = 10-$datacount;
    $totlAmt=0;$totlgrossQty=0;$totalnetQty=0;$total_amt=0;$total_netqty=0;$totalFreightRate=0;$totalAQty=0;$totamot=0;
$fso_rt=0;
   foreach($dataheadB as $row){ $totlAmt +=$row->AMOUNT;?>
    <tr class="table_highlight">
      <?php   
              $LRDATE       = date("d-m-Y", strtotime($row->LR_DATE));
              $INVCDATE       = date("d-m-Y", strtotime($row->INVC_DATE));
              $ACKDATE       = date("d-m-Y", strtotime($row->ACK_DATE));
              $lrDate =  ($LRDATE) ? $LRDATE : "----"; 
              $InvDate =  ($INVCDATE) ? $INVCDATE : "----"; 
              $ACKDT =  ($ACKDATE) ? $ACKDATE : "----"; 
              $InvcNo =  ($row->INVC_NO) ? $row->INVC_NO : "----"; 
              $DelvryNo =  ($row->DELIVERY_NO) ? $row->DELIVERY_NO : "----"; 
              $WAGONNO =  ($row->WAGON_NO) ? $row->WAGON_NO : "----"; 
              $VehicleType =  ($row->VEHICLE_TYPE) ? $row->VEHICLE_TYPE : "----"; 
              $WHEELTYPENAME =  ($row->WHEELTYPE_NAME) ? $row->WHEELTYPE_NAME : "----"; 
              $VEHICLETYPENAME =  ($row->VEHICLE_TYPE_NAME) ? strtoupper($row->VEHICLE_TYPE_NAME) : "----"; 
              $VEHICLEMODEL =  ($row->MODEL) ? $row->MODEL : "----"; 
              $MINGUARANTEE =  ($row->MIN_GUARANTEE) ? $row->MIN_GUARANTEE : "----"; 
              $ITEMNAME =  ($row->ITEM_NAME) ? $row->ITEM_NAME : "----"; 
              $FROMPLACE =  ($row->FROM_PLACE) ? $row->FROM_PLACE : "----"; 
              $TOPLACE =  ($row->TO_PLACE) ? $row->TO_PLACE : "----"; 
              $ModelNo =  ($row->MODEL) ? $row->MODEL : "----"; 
              $vehicleNo = ($row->vehicleNoHead) ? $row->vehicleNoHead : "----"; 
              $lrno = ($row->LR_NO) ? $row->LR_NO : "----"; 
              $billNo = '12345'; 
              $destination = ($row->TO_PLACE) ? $row->TO_PLACE : "----"; 
              $d_qty = ($row->DISPATCH_QTY) ? $row->DISPATCH_QTY : "----"; 
              $freightRate = ($row->FSO_RATE) ? $row->FSO_RATE : "0.00"; 
              $ISSUEDQTY = ($row->ISSUED_QTY) ? $row->ISSUED_QTY : "0.00"; 
              $NETQTY = ($row->NET_WEIGHT) ? $row->NET_WEIGHT : "0.00"; 
              $amount = ($row->AMOUNT) ? $row->AMOUNT : "0.00"; 
              $FREIGHTQTY = ($row->FREIGHT_QTY) ? $row->FREIGHT_QTY : "0.00"; 
              $grossQty = ($row->GROSS_WEIGHT) ? $row->GROSS_WEIGHT : "0.000"; 
              $FSORATE = ($row->FSO_RATE) ? $row->FSO_RATE : "0.000"; 
              $MINGUARENTEE = '00';

              $TOTAMT = floatval($FSORATE * $NETQTY);
              
              $remark = ($row->REMARK) ? $row->REMARK : "----";  

              $totalAQty        +=$d_qty;
              $totlgrossQty     +=$grossQty;
              $total_amt        +=$amount;
              $totamot          +=$TOTAMT;
              $fso_rt           +=$FSORATE;
              $totalFreightRate +=$freightRate;
              $total_netqty     +=$NETQTY;
      ?>
      <td class="table_highlight" style="width:2%;"><?php echo $srNo; ?></td>
      <td class="table_highlight" style="width:7%;"><?php echo $InvcNo; ?><br><?php echo $InvDate; ?></td>
      <td class="table_highlight" style="width:7%;"><?php echo $DelvryNo; ?></td>
      <td class="table_highlight" style="width:8%;"><?php echo $lrno; ?></td>
      <td class="table_highlight" style="width:6%;"><?php echo $WAGONNO; ?></td>
      <td class="table_highlight" style="width:8%;"><?php echo $vehicleNo; ?></td>
      <td class="table_highlight" style="width:7%;"><?php echo $VEHICLETYPENAME.' '.$VEHICLEMODEL; ?></td>
      <td class="table_highlight" style="width:6%;"><?php echo $ITEMNAME; ?></td>
      <td class="table_highlight" style="width:8%;"><?php echo $FROMPLACE; ?></td>
      <td class="table_highlight" style="width:8%;"><?php echo $TOPLACE; ?></td>
      <td class="table_highlight" style="width:5%;"><?php echo $MINGUARANTEE; ?></td>
      <td class="table_highlight numberRight" style="width:3%;"><?php echo $NETQTY; ?></td>
      <td class="table_highlight numberRight" style="width:4%;"><?php echo $NETQTY; ?></td>
      <td class="table_highlight numberRight" style="width:7%;"><?php echo $ACKDT; ?></td>
      <td class="table_highlight numberRight" style="width:7%;"><?php echo $FSORATE; ?></td>
      <td class="table_highlight numberRight" style="width:7%;"><?php $getTotAmt = number_format((float)$TOTAMT, 2, '.', ''); echo $getTotAmt; ?></td>
    </tr>
  <?php $srNo++;} ?>
  <?php for ($j=0; $j < $headcount; $j++) { ?>

    <tr class="table_highlight" style="border:none;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;"
>
    
      <td class="table_highlight" style="width:2%;">&nbsp;</td>
      <td class="table_highlight" style="width:7%;">&nbsp;</td>
      <td class="table_highlight" style="width:7%;">&nbsp;</td>
      <td class="table_highlight" style="width:8%;">&nbsp;</td>
      <td class="table_highlight" style="width:6%;">&nbsp;</td>
      <td class="table_highlight" style="width:8%;">&nbsp;</td>
      <td class="table_highlight" style="width:7%;">&nbsp;</td>
      <td class="table_highlight" style="width:6%;">&nbsp;</td>
      <td class="table_highlight" style="width:8%;">&nbsp;</td>
      <td class="table_highlight" style="width:8%;">&nbsp;</td>
      <td class="table_highlight" style="width:5%;">&nbsp;</td>
      <td class="table_highlight numberRight" style="width:3%;">&nbsp;</td>
      <td class="table_highlight numberRight" style="width:4%;">&nbsp;</td>
      <td class="table_highlight numberRight" style="width:7%;">&nbsp;</td>
      <td class="table_highlight numberRight" style="width:7%;">&nbsp;</td>
      <td class="table_highlight numberRight" style="width:7%;">&nbsp;</td>
    </tr>
  <?php } ?>
  <tr>
    <td class="table_highlight" colspan="8" style="border-right: 1px solid white;"></td>
    <td class="table_highlight fontBold" colspan="3" style="text-align: right;border-left: 1px solid white;">Annex Total:</td>
    <td class="table_highlight numberRight fontBold" style="width:10%;"><?php $floatgross_qty = number_format((float)$total_netqty, 3, '.', ''); echo $floatgross_qty; ?></td>
     <td class="table_highlight numberRight fontBold" style="width:10%;"><?php $FreightRate = number_format((float)$total_netqty, 3, '.', ''); echo $FreightRate; ?></td>
    <td class="table_highlight numberRight fontBold" style="width:7%;"></td>
    <td class="table_highlight numberRight fontBold" style="width:7%;"></td>
    <td class="table_highlight numberRight fontBold" style="width:7%;"><?php $tot_amot = number_format((float)$totamot, 2, '.', ''); echo $tot_amot; ?></td>
  </tr>

</table>
<table style="width:100%;border-collapse: collapse;">
  <tr>
    <td class="text-center" style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;"> <p style="vertical-align: baseline;font-weight: bold;"> {{ $createdBy }} </p><br><br><br><br> <p style="vertical-align: bottom;font-size:11px;font-weight: bold;">Prepared by</p></td>
    <td class="text-center" style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;vertical-align: bottom;font-size:11px;font-weight: bold;">Checked By</td>
    <td class="text-center" style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;vertical-align: bottom;font-size:11px;font-weight: bold;">Approved By </td>
    <td class="text-center" style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;"><p style="vertical-align: baseline;font-weight: bold;"> <?php echo $compDetail[0]->COMP_NAME; ?> </p><br><br><br><br><p style="vertical-align: bottom;font-size:11px;font-weight: bold;">Authorised Signatory</p></td>
  </tr>
</table>