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
  .topheading{
    padding-top: -1px;
    padding-bottom: -1px;
    padding-left: -1px;
    padding-right: -1px;
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
  .headingCenter{
    text-align:center;
  }
</style>

<?php 
  
  $seriesCd = $data030[0]->SERIES_CODE;
  $fyCd     = $data030[0]->FY_CODE;
  $vrSeq     = $data030[0]->VRNO;
  $splitFy  = explode('-',$fyCd);

 ?>

<table class="table table-bordered partyDetail" style="margin-bottom: 0px;">
    <tr>
      <th class="topheading" style="text-align: center;font-size: 14px;border: 1px solid white;"> <?php echo $data030[0]->PFCT_NAME; ?></th>
    </tr>
    <tr>
      <th class="topheading" style="text-align: center;font-size: 12px;border: 1px solid white;"> PAYMENT VOUCHER - <?php echo $data030[0]->SERIES_NAME; ?></th>
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
            <tr><td class="removeSpace" style="font-size: 12px;"><?php echo $compDetail[0]->ADD1 ?> <?php echo $compDetail[0]->ADD2 ?> <?php echo $compDetail[0]->ADD3 ?><?php echo ' '.$compDetail[0]->CITY.','.$compDetail[0]->DIST.','.$compDetail[0]->STATE.','.$compDetail[0]->PIN_CODE ?></td></tr>
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
          <?php if($compDetail[0]->EMAIL_ID){ ?>
          <tr>
            <th class="removeSpace">EMAIL ID</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $compDetail[0]->EMAIL_ID;?></td>
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
            <tr><td>&nbsp;<!-- <img src="{{ asset('public/dist/img/inceeboxIMG.png') }}" style="width:100px;height:60px;" alt="job image" title="job image"> --></td></tr>
        </table>
      </td>
    </tr>
</table>

<table class="table table_highlight" style="border-bottom:1px solid white;border-top:1px solid white;">
  <tr>
    <th>Payment Advice No.: <?php echo $splitFy[0].' '.$seriesCd.' '.$vrSeq?></th>
    <th>Date : <?php echo date("d-m-Y", strtotime($data030[0]->VRDATE)); ?></th>
  </tr>
</table>

<table class="table table_highlight" style="border-bottom:1px solid white;border-top:1px solid white;">
  <tr>  
    <th class="removeSpace">To,</th>
  </tr>
  <tr>
    <th class="removeSpace"> <?php echo $accDetails[0]->ACC_NAME;?> ( CODE : <?php echo $accDetails[0]->ACC_CODE;?> )</th>
  </tr>
  <tr>
    <th class="removeSpace"><?php echo $accDetails[0]->ADD1 ?><?php echo ' '.$accDetails[0]->CITY_NAME.','.$accDetails[0]->DIST_NAME.','.$accDetails[0]->STATE_NAME.','.$accDetails[0]->PIN_CODE ?></th>
  </tr>
  <tr>
    <th class="removeSpace">phone : <?php echo $accDetails[0]->CONTACT_NO; ?> Email :<?php echo $accDetails[0]->EMAIL_ID; ?></th>
  </tr>
</table>

<table class="table table_highlight" style="border-top:1px solid white;">
  <tr style="border-top:1px solid white;">
    <th>Kind Attn : &nbsp; <?php echo $accDetails[0]->ACC_NAME;?></th>
  </tr>
  <tr>
    <th class="removeSpace">Dear Sir / Madam,</th>
  </tr>
  <tr>
    <th>This is to inform you that your payment(s) have been released. The details are mention below:</th>
  </tr>
</table>

<?php  
      $drAmount = $data030[0]->DRAMT;
      $valDrAmt = number_format((float)$drAmount, 2, '.', ''); 
      $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );
      $drAmtInWord = $f->format($valDrAmt); 
    ?>

<table class="table table_highlight" style="border-bottom:1px solid white;">
  <tr>
    <td style="width: 60%;border-left: 1px solid lightgrey;">
      <table>

        <tr>
          <td style="width:30%;">Name Of Beneficiary</td>
          <td style="width:5%;">:</td>
          <td style="width:65%;"><?php echo $accDetails[0]->ACC_NAME;?></td>
        </tr>

        <tr>
          <td style="width:30%;" class="removeSpace">Bank name & Address</td>
          <td style="width:5%;" class="removeSpace">:</td>
          <td style="width:65%;" class="removeSpace"><?php echo $accDetails[0]->BANK_NAME;?> &nbsp; , &nbsp; <?php echo $accDetails[0]->BANK_ADDRESS;?></td>
        </tr>

        <tr>
          <td style="width:30%;padding-bottom: -5px;" class="removeSpace">&nbsp;</td>
          <td style="width:5%;padding-bottom: -5px;" class="removeSpace">&nbsp;</td>
          <td style="width:65%;padding-bottom: -5px;" class="removeSpace">&nbsp;</td>
        </tr>

      </table>
    </td>

    <td style="width: 40%;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;">
      <table>
        
        <tr>
          <td style="width:30%;" class="removeSpace">Account No.</td>
          <td style="width:5%;" class="removeSpace">:</td>
          <td style="width:65%;" class="removeSpace"><?php echo $accDetails[0]->ACC_NUMBER;?></td>
        </tr>

        <tr>
          <td style="width:30%;" class="removeSpace">IFSC Code No.</td>
          <td style="width:5%;" class="removeSpace">:</td>
          <td style="width:65%;" class="removeSpace"><?php echo $accDetails[0]->IFSC_CODE;?></td>
        </tr>

        <tr>
          <td style="width:30%;padding-bottom: -5px;" class="removeSpace">Amount</td>
          <td style="width:5%;padding-bottom: -5px;" class="removeSpace">:</td>
          <td style="width:65%;padding-bottom: -5px;" class="removeSpace"><?php echo $data030[0]->DRAMT; ?></td>
        </tr>

      </table>
    </td>
  </tr>

  <tr style="border-top: 1px solid lightgrey;">
    <td colspan="2" style="border-right: 1px solid lightgrey;border-left: 1px solid lightgrey;border-top: 1px solid lightgrey;">
      <table>
        <tr>
          <td style="width:13%;" class="removeSpace">Amount in words</td>
          <td style="width:3%;" class="removeSpace">:</td>
          <td style="width:84%;" class="removeSpace">Rs - <?php echo $amtInWord;?></td>
        </tr>
        <tr>
          <td style="width:13%;" class="removeSpace">Particular</td>
          <td style="width:3%;" class="removeSpace">:</td>
          <td style="width:84%;" class="removeSpace"><?php if($data030[0]->INST_TYPE){echo $data030[0]->INST_TYPE;}else{echo '----';}?> - <?php echo $data030[0]->SERIES_NAME; ?> Being Paid Against <?php echo $data030[0]->PARTICULAR;?></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<table class="table table_highlight">
  <tr>
    <th class="table_highlight headingCenter">Sl. No.</th>
    <th class="table_highlight headingCenter">Reference</th>
    <th class="table_highlight headingCenter">Reference</th>
    <th class="table_highlight headingCenter">Allocated</th>
    <th class="table_highlight headingCenter">Other Pay/Adj/Allocated</th>
  </tr>
  <tr>
    <th style="border-left: 1px solid lightgrey;">1</th>
    <th style="border-left: 1px solid lightgrey;">&nbsp;</th>
    <th style="border-left: 1px solid lightgrey;">&nbsp;</th>
    <th style="border-left: 1px solid lightgrey;">&nbsp;</th>
    <th style="border-left: 1px solid lightgrey;">&nbsp;</th>
  </tr>
  <tr>
    <th style="border-left: 1px solid lightgrey;">&nbsp;</th>
    <th style="border-left: 1px solid lightgrey;">&nbsp;</th>
    <th style="border-left: 1px solid lightgrey;">&nbsp;</th>
    <th style="border-left: 1px solid lightgrey;">&nbsp;</th>
    <th style="border-left: 1px solid lightgrey;">&nbsp;</th>
  </tr>
  <tr>
    <th style="border-left: 1px solid lightgrey;">&nbsp;</th>
    <th style="border-left: 1px solid lightgrey;">&nbsp;</th>
    <th style="border-left: 1px solid lightgrey;">&nbsp;</th>
    <th style="border-left: 1px solid lightgrey;">&nbsp;</th>
    <th style="border-left: 1px solid lightgrey;">&nbsp;</th>
  </tr>
  <tr>
    <th style="border-top: 1px solid lightgrey;" colspan="2">Total :</th>
    <th style="border-top: 1px solid lightgrey;">&nbsp;</th>
    <th style="border-top: 1px solid lightgrey;text-align:right;"><?php echo $data030[0]->DRAMT; ?></th>
    <th style="border-top: 1px solid lightgrey;">&nbsp;</th>
  </tr>
</table>
<table class="table table_highlight">
  <tr>
    <td>Note : 1) Allocated amount is against respective bills.</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table style="width:100%;border-collapse: collapse;">

  <tr>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:50px;"> Entered by</td>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:50px;">Approved By </td>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:50px;">Checked By</td>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:50px;">Received By</td>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:50px;">Authorised Signatory</td>
  </tr>
</table>