@include('admin.include.header')

<style>
	table,th{
	    font-size: 10px;
	    padding : 5px 5px 5px 5px;
	}
	table,td{
      font-size: 10px;
      padding : 5px 5px 5px 5px;
	}
  table,tr,td{
    font-size: 10px;
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
  .removeSpace{
    padding-top: -4px;
  }
  .removeSpaceLogo{
    padding-top: -2px;
    padding-bottom: -2px;
    padding-left: -2px;
    padding-right: -2px;
  }
  .belowSpaceRemove{
    padding-bottom:-4px;
  }
  .removeSpacetax{
    padding-top: 2px;
    padding-bottom: 2px;
    vertical-align: top;
  }
  .removetdSpace{
    padding-top: 1px;
    padding-bottom: 1px;
  }
  .numberRight{
    text-align:right;
  }
</style>

<?php  

    $compName    = Session::get('company_name');
    $compSplit   = explode('-',$compName);
    $fycode      = $dataheadB[0]->FY_CODE;
    $fiscalYr    = explode('-', $fycode); 
    $series_code = $dataheadB[0]->SERIES_CODE; 
    $transDate   = $dataheadB[0]->BUILTY_DT;
    $vr_Date     = date("d-m-Y", strtotime($transDate));
    $biltyNo     = $fiscalYr[0].' '.$series_code.' '.$dataheadB[0]->VRNO;      

    $totalQty=0; 

    foreach($dataheadB as $row){
      $totalQty += $row->bodyQty;

    }
?>


<table class="table table-bordered partyDetail" style="margin-bottom: 0px;">
    <tr>
      <th style="text-align: center;font-size: 15px;"> BILTY TRANSACTION</th>
    </tr>
</table>

<table class="table table_highlight">
    
    <tr class="table_highlight">

      <td class="removeSpaceLogo" style="width:10%;">
        <table>
            <tr><td><img src="{{ asset('public/dist/img/MUKUNDGROUPLOGO.png') }}" style="width:75px;height:75px;" alt="job image" title="job image"></td></tr>
        </table>
      </td>

      <td class="removeSpaceLogo" style="width:45%;">
        <table>
            <tr><td class="removeSpace" style="font-size: 14px;font-weight: bold;"><?php echo $compDetail[0]->COMP_NAME ?></td></tr>
            <tr><td class="removeSpace" style="font-size: 12px;"><?php echo $compDetail[0]->ADD1 ?> <?php echo $compDetail[0]->ADD2 ?> <?php echo $compDetail[0]->ADD3 ?><?php echo ' '.$compDetail[0]->CITY_NAME.','.$compDetail[0]->DIST_NAME.','.$compDetail[0]->STATE_NAME.','.$compDetail[0]->PIN_CODE ?></td></tr>
        </table>
      </td>

      <td class="removeSpaceLogo" style="width: 30%;border-left: 1px solid lightgrey;">
        <table>
          <tr>
            <th colspan="3" style="font-size: 14px;">ORIGINAL</th>
          </tr>
          <?php if($compDetail[0]->GST_NO){ ?>
          <tr>
            <th class="removeSpace">GST NO</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $compDetail[0]->GST_NO; ?></td>
          </tr>
          <?php } ?>
          <?php if($compDetail[0]->PAN_NO){ ?>
          <tr>
            <th class="removeSpace">PAN NO</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $compDetail[0]->PAN_NO;?></td>
          </tr>
          <?php } ?>
          <?php if($compDetail[0]->EMAIL){ ?>
          <tr>
            <th class="removeSpace">EMAIL ID</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $compDetail[0]->EMAIL;?></td>
          </tr>
          <?php } ?>
          <?php if($compDetail[0]->PHONE1){ ?>
          <tr>
            <th class="removeSpace">PHONE NO</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $compDetail[0]->PHONE1;?></td>
          </tr>
          <?php } ?>
          
        </table>
      </td>

      <td class="removeSpaceLogo" style="width:15%;">
        <table>
            <tr><td><img src="{{ asset('public/dist/img/inceeboxIMG.png') }}" style="width:100px;height:60px;" alt="job image" title="job image"></td></tr>
        </table>
      </td>
    </tr>
</table>

<table class="table table_highlight">
    <tr class="table_highlight">
      <td>
        COLD STORAGE AND WAREHOUSE LIC NO.1/2020-21 DATE OF ISSUE 12-10-2020 ISSUED BY-OFFICE OF THE DISTRICT DEPUTY REGISTRAR-CO-OPERATIVE SOCIETIES-NAGPUR. <br>
        ISSUED UNDER PROVISION OF THE BOMBAY WAREHOUSE ACT 1956 AND THE BOMBAY WAREHOUSE RULES 1960.<br>
        SUBJECT TO NAGPUR JURISDICTION.
      </td>
    </tr>
</table>

<table class="table table_highlight">
  <tr class="table_highlight">
    <td style="width:80%;border-right: 1px solid white;padding-top: -2px;padding-bottom:-2px;">
      <table>
        <tr>
          <th class="removeSpacetax">BILTY</th>
          <td class="removeSpacetax">:</td>
          <td class="removeSpacetax">&nbsp;</td>
        </tr>
        <tr>
          <th class="removeSpacetax">C.W.R.NO</th>
          <td class="removeSpacetax">:</td>
          <td class="removeSpacetax"><?php echo $biltyNo; ?></td>

          <th class="removeSpacetax">DATE OF ISSUE OF C.W.R.</th>
          <td class="removeSpacetax">:</td>
          <td class="removeSpacetax"><?php echo $vr_Date;?></td>
        </tr>
        <tr>
          <th class="removeSpacetax">SERVICE TYPE</th>
          <td class="removeSpacetax">:</td>
          <td class="removeSpacetax">COLD STORAGE</td>

          <th class="removeSpacetax">COMMODITY TYPE</th>
          <td class="removeSpacetax">:</td>
          <td class="removeSpacetax"><?php echo (empty($itemCategory[0]->ICATG_NAME)) ? '' : ($itemCategory[0]->ICATG_NAME); ?></td>
        </tr>
        <tr>
          <th class="removeSpacetax">INWARD VEHICLE NO</th>
          <td class="removeSpacetax">:</td>
          <td class="removeSpacetax"><?php echo $dataheadB[0]->VEHICLE_NO;?></td>

          <th class="removeSpacetax">VEHICLE INTIME</th>
          <td class="removeSpacetax">:</td>
          <td class="removeSpacetax"><?php echo date("d-m-Y", strtotime($dataheadB[0]->BUILTY_DT));?></td>
        </tr>
      </table>
      
    </td>
    <td style="width:20%;border-left:1px solid white;padding-top: -2px;padding-bottom:-2px;">
      <table>
        <tr><td>
        <?php 

        $customXML = new SimpleXMLElement(QrCode::size(60)->generate($biltyNo));
        $dom = dom_import_simplexml($customXML);
        echo $dom->ownerDocument->saveXML($dom->ownerDocument->documentElement);

        ?>
        </td></tr>
        <!-- <tr><td>{!! QrCode::size(70)->generate('< ?php echo $biltyNo;?>') !!}</td></tr> -->
        <!-- <tr><td>< ?php echo QrCode::size(70)->generate('kamini') ?></td></tr> -->
      </table>
      
    </td>
  </tr>
 
</table>

<table class="table table_highlight removeSpace">
  
  <tr class="table_highlight removeSpace belowSpaceRemove" style="border-bottom:1px solid white;">
    <td>
      <table>
        <tr>
          <th class="removeSpace belowSpaceRemove">MATERIAL RECEIVED FROM :</th>
          <td class="removeSpace belowSpaceRemove"><?php echo $dataheadB[0]->ACC_NAME;?></td>
        </tr>
      </table>
    </td>
  </tr>

</table>

<table class="table table_highlight removeSpace">
  
  <tr class="table_highlight removeSpace belowSpaceRemove" style="border-bottom:1px solid white;border-top:1px solid white;">
    <td>
      <table>
        <tr>
          <th class="removeSpace belowSpaceRemove">DETAILED ADDRESS :</th>
          <td class="removeSpace belowSpaceRemove"><?php echo $dataheadB[0]->ADD1;?></td>
        </tr>
      </table>
    </td>
  </tr>

</table>

<table class="table table_highlight removeSpace" style="width:100%;">

  <tr class="table_highlight removeSpace" style="border-bottom:1px solid white;border-top:1px solid white;">

    <td>
      <table>
        <tr>
          <th class="removeSpace belowSpaceRemove">CITY/VILLAGE</th>
          <th class="removeSpace belowSpaceRemove">:</th>
          <td class="removeSpace belowSpaceRemove"><?php echo $dataheadB[0]->CITY_NAME;?></td>
        </tr>
      </table>
    </td>

    <td>
      <table>
        <tr>
          <th class="removeSpace belowSpaceRemove">TEHSIL</th>
          <th class="removeSpace belowSpaceRemove">:</th>
          <td class="removeSpace belowSpaceRemove"><?php echo $dataheadB[0]->DIST_NAME;?></td>
        </tr>
      </table>
    </td>

    <td>
      <table>
        <tr>
          <th class="removeSpace belowSpaceRemove">DISTRICT</th>
          <th class="removeSpace belowSpaceRemove">:</th>
          <td class="removeSpace belowSpaceRemove"><?php echo $dataheadB[0]->DIST_NAME;?></td>
        </tr>
      </table>
    </td>

  </tr>
</table>

<table class="table table_highlight removeSpace" style="width:100%;">
  <tr class="table_highlight removeSpace" style="border-bottom:1px solid white;border-top:1px solid white;">
      <td>
        <table>
          <tr>
            <th class="removeSpace belowSpaceRemove">GST NO (IF ANY)</th>
            <th class="removeSpace belowSpaceRemove">:</th>
            <td class="removeSpace belowSpaceRemove"><?php if($dataheadB[0]->GST_NUM){echo $dataheadB[0]->GST_NUM;}else{echo '----';}?></td>
          </tr>
        </table>
      </td>

      <td>
        <table>
          <tr>
            <th class="removeSpace belowSpaceRemove">NAME AND MOBILE NO. OF CONTACT PERSON</th>
            <th class="removeSpace belowSpaceRemove">:</th>
            <td class="removeSpace belowSpaceRemove"><?php echo $dataheadB[0]->CONTACT_PERSON.' '.$dataheadB[0]->CONTACT_NO;?></td>
          </tr>
        </table>
      </td>

    </tr>
</table>

<table class="table table_highlight">

  <tr class="table_highlight removeSpace">
    
    <td>
      <table>
        <tr>
          <th class="removeSpace belowSpaceRemove">RECEIPT VALID TILL</th>
          <td class="removeSpace belowSpaceRemove">:</td>
          <td class="removeSpace belowSpaceRemove"><?php echo date("d-m-Y", strtotime($dataheadB[0]->RECIEPT_TILL_DT));?></td>
        </tr>
      </table>
    </td>

    <td>
      <table>
        <tr>
          <th class="removeSpace belowSpaceRemove">STACK NO</th>
          <td class="removeSpace belowSpaceRemove">:</td>
          <td class="removeSpace belowSpaceRemove"><?php if(($dataheadB[0]->STACK_NO == '') || ($dataheadB[0]->STACK_NO == null)){echo '0';}else{echo $dataheadB[0]->STACK_NO;}?></td>
        </tr>
      </table>
    </td>

    <td style="border-right: 1px solid lightgrey;">
      <table>
        <tr>
          <th class="removeSpace belowSpaceRemove">ICEEBOX STACKCARD NO</th>
          <td class="removeSpace belowSpaceRemove">:</td>
          <td class="removeSpace belowSpaceRemove"><?php echo $biltyNo; ?></td>
        </tr>
      </table>
    </td>

  </tr>
  
</table>

<table class="table table_highlight">
  
  <tr class="table_highlight">
    <th class="table_highlight">DISCRIPTION OF GOODS</th>
    <th class="table_highlight">CLASS/STANDARD OF QUALITY/GRADE*</th>
    <th class="table_highlight">CONDITION OF GOODS-BAD/AVERAGE/GOOD</th>
    <th class="table_highlight">PACKAGING TYPE</th>
    <th class="table_highlight">IDENTIFICATION MARK (IF ANY)</th>
    <th class="table_highlight">QUANTITY IN NUMBERS</th>
    <th class="table_highlight">QUANTITY IN WEIGHT-METRIC</th>
    <th class="table_highlight">MARKET RATE AT TH TIME OF DEPOSIT (IN RUPEES IN MT)*</th>
    <th class="table_highlight">VALUATION OF TOTAL CONSIGNMENT</th>
  </tr>

  <tr class="table_highlight">
    <td class="table_highlight" style="width:10%;"><?php echo $dataheadB[0]->ITEM_NAME; ?></td>
    <td class="table_highlight" style="width:10%;"><?php echo $dataheadB[0]->CLASS_STD_QTY; ?></td>
    <td class="table_highlight" style="width:10%;"><?php echo $dataheadB[0]->COND_GOODS; ?></td>
    <td class="table_highlight" style="width:15%;"><?php echo $dataheadB[0]->PACKING_NAME; ?></td>
    <td class="table_highlight" style="width:10%;"><?php echo $dataheadB[0]->IDENTY_MARK; ?></td>
    <td class="table_highlight numberRight" style="width:10%;"><?php echo $dataheadB[0]->BILTY_QTY; ?></td>
    <td class="table_highlight numberRight" style="width:10%;"><?php echo $dataheadB[0]->BILTY_AQTY; ?></td>
    <td class="table_highlight numberRight" style="width:15%;"><?php echo $dataheadB[0]->MARKET_RATE; ?></td>
    <td class="table_highlight numberRight" style="width:10%;"><?php echo $dataheadB[0]->MARKET_VALUE; ?></td>
  </tr>

  <?php  
      $marketValue = $dataheadB[0]->MARKET_VALUE;
      $ValueInword = number_format((float)$marketValue, 2, '.', ''); 
      $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );
      $marketValueInWord = $f->format($ValueInword); 
    ?>

  <tr class="table_highlight">
    <th class="table_highlight" style="font-size:12px;" colspan="9">VALUATION OF GOODS (IN WORDS) : RUPEES <?php echo strtoupper($marketValueInWord); ?> ONLY</th>
  </tr>

</table>

<table class="table table_highlight">
  <tr class="table_highlight removeSpace">
    <th style="text-align: center">STORAGE AND RENTAL DETAIL</th>
  </tr>
</table>

<table class="table table_highlight">
    
    <tr class="table_highlight">
      <th class="table_highlight removetdSpace" colspan="4">LOCATION</th>
      <th class="table_highlight removetdSpace">TOTAL SQFT OR TOTAL UNITS OF BAGS</th>
    </tr>  

    <?php $qty_total =0; foreach($dataheadB as $row){ $qty_total += $row->bodyQty;?>

      <tr class="table_highlight">
        
        <td class="table_highlight removetdSpace" style="width:20%;"><?php echo $row->CS_NAME; ?></td>
        <td class="table_highlight removetdSpace" style="width:20%;"><?php echo $row->CHAMBER_NAME; ?></td>
        <td class="table_highlight removetdSpace" style="width:21%;"><?php echo $row->FLOOR_NAME; ?></td>
        <td class="table_highlight removetdSpace" style="width:21%;"><?php echo $row->BLOCK_NAME; ?></td>
        <td class="table_highlight removetdSpace numberRight" style="width:18%;"><?php echo $row->bodyQty; ?></td>

      </tr>

    <?php } ?>

    <?php  
      $totlQtyGet = number_format((float)$qty_total, 2, '.', ''); 
      $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );
      $qtywords = $f->format($totlQtyGet); 
    ?>

    <tr class="table_highlight">
      <th class="table_highlight removetdSpace" colspan="4">QUANTITY (IN WORDS) : <?php echo strtoupper($qtywords); ?> ONLY</th>
      <td class="table_highlight removetdSpace numberRight"><?php $floatTot_amt = number_format((float)$qty_total, 3, '.', ''); echo $floatTot_amt; ?></td>
    </tr>

</table>

<table class="table table_highlight">

    <tr class="table_highlight">

      <td>
        <table class="table_highlight">
          <tr>
            <th style="text-align:center;">RENTAL DETAILS</th>
          </tr>
          <tr class="table_highlight">
            <th class="table_highlight" style="width:65%;">TOTAL <?php echo $dataheadB[0]->BILTY_UM; ?>/UNITS</th>
            <td class="table_highlight numberRight" style="width:35%;"><?php $tot_qty = number_format((float)$totalQty, 2, '.', ''); echo $tot_qty; ?></td>
          </tr>
          <tr class="table_highlight">
            <th class="table_highlight" style="width:65%;">STORAGE CHARGES TYPE</th>
            <?php $storageType = $dataheadB[0]->STORAGE_TYPE;
                  $storage_type = str_replace('_', ' ', $storageType);

              ?>
            <td class="table_highlight" style="width:35%;"><?php echo $storage_type; ?></td>
          </tr>
          <tr class="table_highlight">
            <th class="table_highlight" style="width:65%;">RENTAL CHARGES PER <?php echo $dataheadB[0]->BILTY_UM; ?>/PER MONTH</th>
            <td class="table_highlight numberRight" style="width:35%;"><?php echo $dataheadB[0]->RATE_PER_MONTH; ?></td>
          </tr>
        </table>
      </td>

      <td style="width: 50%;border-left: 1px solid lightgrey;">
        <table>
          <tr>
            <th class="removeSpace" colspan="2">CUSTOMER REPRESNTATIVE-PRESENT AT THE TIME OF ISSUING RECEIPT</th>
          </tr>
          <tr>
            <td class="removeSpace">NAME : <?php echo $dataheadB[0]->DRIVER_NAME; ?></td>
            <td class="removeSpace">CONTACT : <?php echo $dataheadB[0]->DRIVER_CONTACT_NO; ?></td>
          </tr>
          <tr>
            <td class="removeSpace"><img src="{{ asset('public/dist/img/dumyUser.jpg') }}" style="width:75px;height:60px;" alt="job image" title="job image"></td>
            <td class="removeSpace" style="padding-top: 10px;"><img src="{{ asset('public/dist/img/dumySign.png') }}" style="width:75px;height:45px;" alt="job image" title="job image"></td>
          </tr>
        </table>
      </td>
    </tr>
  
</table>

<table class="table table_highlight">

  <tr class="table_highlight" style="border-bottom:1px solid white;">
    <th>REMARKS/NOTES:</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  <tr>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  <tr>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  <tr>
    <th style="padding-top: -1px;">CUSTOMER SIGNATURE AND STAMP</th>
    <th style="padding-top: -1px;">ISSUE TIME</th>
    <th style="padding-top: -1px;">ICEEBOX AUTHORISED SIGNATURE AND STAMP</th>
  </tr>
</table>

<table class="table table_highlight">
  <tr class="table_highlight">
    <th>** PLEASE TURN OVER-FOR SPACE OF ENDORSEMENT FOR PARTY CREATING LIEN,MORTGAGE OF ENCUMBRANCES OF THE GOODS**</th>
  </tr>
</table>

<table class="table table_highlight">
  <tr>
    <th style="text-align:center;">COLD STORAGE / WAREHOUSE DESPATCH ACKNOWLEDGEMENT (OUTWARD)</th>
  </tr>
  <tr>
    <td>** THE BELOW MENTIONED GOODS ARE HEREBY RELEASED FROM THIS RECEIPT FOR DELIVERY FROM COLD STORAGE / WAREHOUSE. ANY UNRELEASED BALENCE OF THE GOODS IS SUBJECT TO LIEN FOR UNPAID CHARGES AND ADVANCES ON THE RELEASED PORTION.**</td>
  </tr>
</table>

<table class="table table_highlight">
  <tr class="table_highlight">
    <th class="table_highlight" rowspan="2">DATE</th>
    <th class="table_highlight" rowspan="2">OUTWORD SLIP NO</th>
    <th class="table_highlight" rowspan="2">DURATION OF STORAGES (IN MONTHS)</th>
    <th class="table_highlight" rowspan="2">AMOUNT OF RENTAL CHARGES (IN RUPEES)</th>
    <th class="table_highlight" colspan="2">QUANTITY RELEASED</th>
    <th class="table_highlight" rowspan="2">VEHICLE NUMBER</th>
    <th rowspan="2">SIGNATURE</th>
    <th class="table_highlight" rowspan="2" style="border-bottom:1px solid white;">&nbsp;</th>
    <th class="table_highlight" colspan="3">QUANTITY BALANCE WITH ICEEBOX AFTER DESPATCH</th>
  </tr>
  <tr class="table_highlight">
    <th class="table_highlight">UM</th>
    <th class="table_highlight">AUM</th>
    <th class="table_highlight">UM</th>
    <th class="table_highlight">AUM</th>
    <th class="table_highlight">SIGNATURE</th>
  </tr>
  <tr>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th>&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
  </tr>
  <tr>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th>&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
  </tr>
  <tr>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>

    <th>&nbsp;</th>

    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
    <th class="table_highlight">&nbsp;</th>
  </tr>
</table>
<table  class="table table_highlight" style="border-bottom:1px solid white;">
  <tr class="table_highlight"  style="border-bottom:1px solid white;">
    <th style="border-bottom:1px solid white;">** PLEASE TURN OVER-FOR THE TERMS AND CONDITIONS**</th>
  </tr>
</table>
<table class="table table_highlight">
  <tr class="table_highlight" style="border-bottom:1px solid white;border-top:1px solid white;">
    <th>1. ANY QUERIES/REQUEST/CONCERNS REGARDING THE FOLLOWING  ON BILTY HAVE TO BE CLARIFIED WITHIN 24 HOURS OF ISSUING THE BILTY.</th>
  </tr>
  <tr>
    <th>2. ANY QUERIES/REQUEST/CONCERNS WOULDN'T BE DELT WITH AFTERWARDS OR ANYTIME LATER.</th>
  </tr>
</table>