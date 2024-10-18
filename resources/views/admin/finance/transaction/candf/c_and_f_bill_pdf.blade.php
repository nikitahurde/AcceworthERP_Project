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
  .bottomHeading{
    border-bottom: 1px solid #fff !important;
  }
  .borderRight{
    border-right: 1px solid lightgrey !important;
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
      $pdfName = 'TAX INVOICE';
         
?>


<table class="table table-bordered partyDetail" style="margin-bottom: 0px;">
    <tr>
      <th style="text-align: center;font-size: 15px;"> {{$pdfName}} </th>
    </tr>
</table>

<table class="table table_highlight">

  <tr class="table_highlight">

    <td style="width: 10%;">
      <table>
          <tr><td><img src="{{ asset('public/dist/img/MUKUNDGROUPLOGO.png') }}" style="width:75px;height:75px;" alt="job image" title="job image"></td></tr>
      </table>
    </td>

    <td style="width: 60%;border-left: 1px solid lightgrey;">
      <table>
        <tr><th style="padding-top: -2px;font-size:15px;">{{$compDetail[0]->COMP_NAME}}</th></tr>
        <tr>
          <td style="padding-top: -2px;">Admin Office : <?php echo $compDetail[0]->ADD1.' '.$compDetail[0]->ADD2.' '.$compDetail[0]->ADD3 ?></td>
        </tr>
        <tr>
          <td style="padding-top: -2px;">Phone : <?php echo $compDetail[0]->PHONE1.', '.$compDetail[0]->PHONE2; ?></td>
        </tr>
        <tr>
          <td style="padding-top: -2px;">E-mail : <?php echo $compDetail[0]->EMAIL_ID; ?></td>
        </tr>
        <tr>
          <td style="padding-top: -2px;">PAN : <?php echo $compDetail[0]->PAN_NO; ?></td>
        </tr>
        <tr>
          <td style="padding-top: -2px;">GSTIN NO : <?php echo $compDetail[0]->GST_NO; ?></td>
        </tr>
      </table>      
    </td>

    <td style="width: 30%;border-left: 1px solid lightgrey;">
      <table>
        <tr>
          <th style="padding-top: -2px;">Bill No : <?php echo $billNo;?></th>
        </tr>
        <tr>
          <th style="padding-top: -2px;">Date : <?php echo date('d-m-Y',strtotime($tranDate)) ;?></th>
        </tr>
        <tr>
          <th style="padding-top: -2px;">Vendor Code :<?php echo $consignorDetails[0]->ACC_CODE; ?></th>
        </tr>
        <tr>
          <th style="padding-top: -2px;">Descrition of service : {{$item_Name}}</th>
        </tr>
        <tr>
          <th style="padding-top: -2px;">Service Accounting Code : {{$itemHSNNm}}</th>
        </tr>
        <tr>
          <th style="padding-top: -2px;">&nbsp;</th>
        </tr>

      </table>
    </td>
    
  </tr>
  
</table>

<table class="table table_highlight">
  <tr class="table_highlight">
    <td>
      <table>
        <tr>
          <th style="padding-top: -2px;">Billing To / Consignor :</th>  
        </tr>
        <tr>
          <td style="padding-top: -2px;"><?php echo $consignorDetails[0]->ACC_NAME; ?></td>  
        </tr>
        <tr>
          <td style="padding-top: -2px;"><?php echo $consignorDetails[0]->ADD1; ?></td>  
        </tr>
        <tr>
          <td style="padding-top: -2px;"><?php echo $consignorDetails[0]->CITY_NAME.' '.$consignorDetails[0]->DIST_CODE.' '.$consignorDetails[0]->STATE_NAME.' '.$consignorDetails[0]->PIN_CODE; ?></td>  
        </tr>
      </table>
    </td>
    <td>
      <table>
        <tr>
          <td style="padding-top: -2px;">JSPL PAN NO. <?php echo ($consignorDetails[0]->PAN_NO) ? $consignorDetails[0]->PAN_NO :'--'; ?></td>
        </tr>
        <tr>
          <td style="padding-top: -2px;">JSPL GSTIN NO. <?php echo ($consignorDetails[0]->GST_NUM) ? $consignorDetails[0]->GST_NUM :'--'; ?></td>
        </tr>
        <tr>
          <td style="padding-top: -2px;">State Name : <?php echo ($consignorDetails[0]->STATE_NAME) ? $consignorDetails[0]->STATE_NAME :'--'; ?>,State Code : <?php echo ($consignorDetails[0]->STATE_CODE) ? $consignorDetails[0]->STATE_CODE :'--'; ?></td>
        </tr>
        <tr>
          <td style="padding-top: -2px;">NOT FOUND</td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<table class="table table_highlight">
  <tr class="table_highlight">
    <th class="table_highlight">Sr. No.</th>
    <th class="table_highlight">Description</th>
    <th class="table_highlight">Nett.Wt.</th>
    <th class="table_highlight">Charged Wt.</th>
    <th class="table_highlight">Rate</th>
    <th class="table_highlight">Amount(Rs.)</th>
  </tr>

  <tr>
    <td class="bottomHeading borderRight" style="width:5%;vertical-align:top;">1</td>
    <td class="borderRight" style="width:55%;">
      Material Handled at {{$plantName}} By {{$compDetail[0]->COMP_NAME}}<br>
      Rake Date - <?php echo date('d-m-Y' , strtotime($rakeDate)); ?> Placed Date - <?php echo date('d-m-Y' , strtotime($placeDate)); ?> <br>
      Rake No - {{$rakeNo}} <br>
      RR No - NOT FOUND <br>
      Encl. - Annuexure (Details)
    </td>
    <td class="borderRight textRightS" style="width:10%;vertical-align:top;">{{$netWeightrake}}</td>
    <td class="borderRight textRightS" style="width:10%;vertical-align:top;">{{$netWeightrake}}</td>
    <td class="borderRight textRightS" style="width:10%;vertical-align:top;">{{$soRate}}</td>
    <td class="borderRight textRightS" style="width:10%;vertical-align:top;">{{$totAmount}}</td>
  </tr>

  <?php for($i=0;$i<2;$i++){ ?>

    <tr>
      <td class="borderRight" style="width:5%;">&nbsp;</td>
      <td class="borderRight" style="width:55%;">&nbsp;</td>
      <td class="borderRight" style="width:10%;">&nbsp;</td>
      <td class="borderRight" style="width:10%;">&nbsp;</td>
      <td class="borderRight" style="width:10%;">&nbsp;</td>
      <td class="borderRight" style="width:10%;">&nbsp;</td>
    </tr>

  <?php } ?>

  <tr>
    <td class="table_highlight removeSpacetax">Encl :-</td>
    <td class="table_highlight removeSpacetax" colspan="2">Annexure</td>
    <th class="table_highlight removeSpacetax" colspan="2">TOTAL AMOUNT</th>
    <td class="table_highlight removeSpacetax textRightS">{{$totAmount}}</td>
  </tr>

  <?php foreach($taxDetail as $row){ ?>
    <?php if(($row->TAX_RATE == '100.00') || ($row->TAX_RATE == '0.00'))
    {
      $taxRatePer ='';
    }else{
      $taxRate =$row->TAX_RATE;
      explode('.',$taxRate);
      $taxRatePer = $taxRate[0].' %';
    } ?>
    <tr>
      <td class="table_highlight removeSpacetax"> -- </td>
      <td class="table_highlight removeSpacetax" colspan="2">--</td>
      <th class="table_highlight removeSpacetax" colspan="2"><?php echo $row->IND_NAME.' '.$taxRatePer; ?></th>
      <td class="table_highlight removeSpacetax textRightS"><?php echo $row->CR_AMT; ?></td>
    </tr>

  <?php } ?>
</table>


<table class="table table-bordered" style="margin-bottom: 0px;">

    <tr>
      <th rowspan="2">HSN</th>
      <th colspan="2">CGST</th>
      <th colspan="2">SGST</th>
      <th colspan="2">IGST</th>
      <th rowspan="2">TOTAL TAX AMOUNT</th>
    </tr>
    <tr>
      <th class="textCenter">%</th>
      <th class="textCenter">AMOUNT</th>
      <th class="textCenter">%</th>
      <th class="textCenter">AMOUNT</th>
      <th class="textCenter">%</th>
      <th class="textCenter">AMOUNT</th>
    </tr>

    <?php $cgstRate = ($cgst_rate[0]) ? $cgst_rate[0] :'0.00'; ?>
    <?php $cgstAmount = ($cgst_Amt[0]) ? $cgst_Amt[0] :'0.00'; ?>
    <?php $sgstRate = ($sgst_rate[0]) ? $sgst_rate[0] :'0.00'; ?>
    <?php $sgstAmount = ($sgst_Amt[0]) ? $sgst_Amt[0] :'0.00'; ?>
    <?php $igstRate = ($igst_rate[0]) ? $igst_rate[0] :'0.00'; ?>
    <?php $igstAmount = ($igst_Amt[0]) ? $igst_Amt[0] :'0.00'; ?>
    <?php $totalTaxAmt = $cgstAmount + $sgstAmount+ $igstAmount;?>

      <tr>
        <td class="bodyTextS" style="width:16%;">{{$itemHSNCd}}</td>
        <td class="bodyTextS textCenter" style="width:8%;">{{ $cgstRate }}</td>
        <td class="bodyTextS textRightS" style="width:15%;">{{ $cgstAmount }}</td>
        <td class="bodyTextS textCenter" style="width:8%;">{{ $sgstRate }}</td>
        <td class="bodyTextS textRightS" style="width:15%;">{{ $sgstAmount }}</td>
        <td class="bodyTextS textCenter" style="width:8%;">{{ $igstRate }}</td>
        <td class="bodyTextS textRightS" style="width:15%;">{{ $igstAmount }}</td>
        <td class="bodyTextS textRightS" style="width:15%;">{{$totalTaxAmt}}</td>
        
        </tr>
      
      <tr>
        <td class="bodyTextS">Total</td>
        <td></td>
        <td class="bodyTextS textRightS">{{ $cgstAmount }}</td>
        <td></td>
        <td class="bodyTextS textRightS">{{ $sgstAmount }}</td>
        <td></td>
        <td class="bodyTextS textRightS">{{ $igstAmount }}</td>

        <td class="bodyTextS textRightS">{{ $totalTaxAmt }}</td>
      </tr>

  </table>

<table class="table table_highlight">
  
  <tr class="table_highlight">
    <td style="width:70%">
      <table>
        <tr><th class="removeSpace">Note :</th></tr>
        <tr><td class="removeSpace">1. E & O.E</td></tr>
        <tr><td class="removeSpace">2. % TDS : 2%</td></tr>
        <tr><td class="removeSpace">3. Service Covered Under GST Reverse Charge MEchanism - No</td></tr>
        <tr><td class="removeSpace">4. Interest @ 12% per annum from the date of bill.</td></tr>
        <tr><td class="removeSpace">5. Please pay by A/C payee Cheque / RTGS/NEFT Only</td></tr>
      </table>
    </td>
    <td style="width:30%">
      <table>
        <tr><th class="removeSpace">For {{$compDetail[0]->COMP_NAME}}</th></tr>
        <tr><th class="removeSpace">&nbsp;</th></tr>
        <tr><th class="removeSpace">&nbsp;</th></tr>
        <tr><th class="removeSpace">&nbsp;</th></tr>
        <tr><th class="removeSpace">&nbsp;</th></tr>
        <tr><th class="removeSpace">Authorized Signatory</th></tr>
      </table>
    </td>
  </tr>

</table>