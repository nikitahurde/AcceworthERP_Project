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
  .second-page{
    page-break-before: always;
  }
  .fontBold{
    font-size: 12px;
    font-weight: bold;
  }
  .fontBold1{
    font-weight: bold;
  }
</style>

<?php  

	$compName       = Session::get('company_name');
	$userName  = Session::get('username');
	$compSplit      = explode('-',$compName);
	$fycode         = $provsaleBillData[0]['FY_CODE'];
	$fiscalYr       = explode('-', $fycode); 
	$series_code    = $provsaleBillData[0]['SERIES_CODE']; 
	$billNo         = $fiscalYr[0].'/'.$series_code.'/'.$provsaleBillData[0]['VRNO'];   
	$tr_vrDate      = date('Y-m-d',strtotime($provsaleBillData[0]['VRDATE']));
	$getVrDate      = date('Y-m-d',strtotime($vrDate));
	$workOrdrNo     = $provsaleBillData[0]['FSO_REF_NO'];
	$workOrdrDt     = '';
	$descOfService  = $provsaleBillData[0]['ITEM_NAME'];
	$serviceAccCode = $provsaleBillData[0]['ITEM_CODE'];

?>

<table class="table table-bordered partyDetail" style="margin-bottom: 0px;">
    <tr>
      <th style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 15px;">TAX INVOICE</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="text-align: right;">Page : {PAGENO} of {nbpg}</span></th>
    </tr>
</table>


<table class="table table_highlight">
    
    <tr class="table_highlight">

      <td class="removeSpaceLogo" style="width:10%;">
        <table>
            <tr><td><img src="{{ asset('public/dist/img/MUKUNDGROUPLOGO.png') }}" style="width:75px;height:75px;" alt="job image" title="job image"></td></tr>
        </table>
      </td>

      <td class="removeSpaceLogo" style="width:50.3%;">
        <table>
            <tr>
            	<td class="removeSpace" style="font-size: 14px;font-weight: bold;"><?php echo $compDetail[0]->COMP_NAME ?></td>
            </tr>
            <tr>
            	<td class="removeSpace" style="font-size: 12px;"><?php echo $compDetail[0]->ADD1 ?> <?php echo $compDetail[0]->ADD2 ?> <?php echo $compDetail[0]->ADD3 ?><?php echo ' '.$compDetail[0]->CITY_NAME.' '.$compDetail[0]->DIST_NAME.' '.$compDetail[0]->STATE_NAME.' '.$compDetail[0]->PIN_CODE ?>
            	</td>
            </tr>
        </table>
      </td>

      <td class="removeSpaceLogo" style="width: 29.7%;border-left: 1px solid lightgrey;">
        <table style="margin-top: 1%;">
          <?php if(isset($compDetail[0]->GST_NO)){ ?>
          <tr>
            <th class="removeSpace fontBold1">GST NO</th>
            <th class="removeSpace fontBold1">:</th>
            <td class="removeSpace fontBold1"><?php echo $compDetail[0]->GST_NO; ?></td>
          </tr>
          <?php } ?>
          <?php if(isset($compDetail[0]->PAN_NO)){ ?>
          <tr>
            <th class="removeSpace fontBold1">PAN NO</th>
            <th class="removeSpace fontBold1">:</th>
            <td class="removeSpace fontBold1"><?php echo $compDetail[0]->PAN_NO;?></td>
          </tr>
          <?php } ?>
          <?php if(isset($compDetail[0]->EMAIL_ID)){ ?>
          <tr>
            <th class="removeSpace fontBold1">EMAIL ID</th>
            <th class="removeSpace fontBold1">:</th>
            <td class="removeSpace fontBold1"><?php echo $compDetail[0]->EMAIL_ID;?></td>
          </tr>
          <?php } ?>
          <?php if(isset($compDetail[0]->PHONE1)){ ?>
          <tr>
            <th class="removeSpace fontBold1">PHONE NO</th>
            <th class="removeSpace fontBold1">:</th>
            <td class="removeSpace fontBold1"><?php echo $compDetail[0]->PHONE1.', '.$compDetail[0]->PHONE2;?></td>
          </tr>
          <?php } ?>
          <?php if(isset($compDetail[0]->STATE_NAME)){ ?>
          <tr>
            <th class="removeSpace fontBold1">STATE</th>
            <th class="removeSpace fontBold1">:</th>
            <td class="removeSpace fontBold1"><?php echo strtoupper($compDetail[0]->STATE_NAME);?></td>
          </tr>
          <?php } ?>
        </table>
      </td>
      <td class="removeSpaceLogo" style="width: 10%;">
      	<table>
	          <tr>
	            <td class="removeSpace">
	            	
	            </td>
	          </tr>
	          
      	</table>
      </td>

    </tr>
</table>

<table class="table table_highlight">
	<tr class="table_highlight">
		<?php if ($billFormat=='TATA_BILL') { ?>
			<td style="border-right: 1px solid lightgrey;width:50%;">
		<?php }else if($billFormat=='JCOP_BILL'){?>
				<td style="border-right: 1px solid lightgrey;width:60%;">
		<?php }else{ ?>

				<td style="border-right: 1px solid lightgrey;width:50%;">
		<?php } ?>
		<?php if ($billFormat=='TATA_BILL') { ?>
			<table>
				<tr class="removeSpace">
					<th class="removeSpace">Billing To</th>
				</tr>
				<tr class="removeSpace">
					<th class="removeSpace"><?php echo $provsaleBillData[0]['ACC_NAME']; ?></th>
				</tr>
				<tr class="removeSpace">
					<td class="removeSpace"><?php echo $add_address; ?></td>
				</tr>
				<tr class="removeSpace">
					<td class="removeSpace">PAN NO. <?php echo $acc_pan; ?></td>
				</tr>
				<tr class="removeSpace">
					<td class="removeSpace">GSTIN NO. <?php echo $acc_gstin; ?></td>
				</tr>
				<tr class="removeSpace">
					<td class="removeSpace">STATE NAME : <?php echo $accstate; ?> </td>
				</tr>
			</table>
		<?php }else if($billFormat=='JCOP_BILL'){?>
			<table>
				
				<tr>
					<td style="border-right: 1px solid lightgrey;width:20%;">
						<table>
							<tr class="removeSpace">
								<th class="removeSpace">Billing To</th>
							</tr>
							<tr class="removeSpace">
								<th class="removeSpace"><?php echo $provsaleBillData[0]['ACC_NAME']; ?></th>
							</tr>
							<tr class="removeSpace">
								<td class="removeSpace"><?php echo $add_address; ?></td>
							</tr>
							<tr class="removeSpace">
								<td class="removeSpace">PAN NO. <?php echo $acc_pan; ?></td>
							</tr>
							<tr class="removeSpace">
								<td class="removeSpace">GSTIN NO. <?php echo $acc_gstin; ?></td>
							</tr>
							<tr class="removeSpace">
								<td class="removeSpace">STATE NAME : <?php echo $accstate; ?> </td>
							</tr> 
						</table>
					</td>
					<td style="border-right: 1px solid lightgrey;width:20%;">
						<table>
							<tr class="removeSpace">
								<th class="removeSpace">Name of Consignor</th>
							</tr>
							<tr class="removeSpace">
								<th class="removeSpace"><?php echo $GETSPDETAILS[0]['ACC_NAME']; ?></th>
							</tr>
							<tr class="removeSpace">
								<td class="removeSpace"><?php echo $GETSPADDRDETAILS[0]['ADD1'].','.$GETSPADDRDETAILS[0]['CITY_NAME'].','.$GETSPADDRDETAILS[0]['DIST_NAME'].','.$GETSPADDRDETAILS[0]['STATE_NAME'].','.$GETSPADDRDETAILS[0]['PIN_CODE']; ?></td>
							</tr>
							<tr class="removeSpace">
								<td class="removeSpace">PAN NO. <?php echo $GETSPDETAILS[0]['PAN_NO']; ?></td>
							</tr>
							<tr class="removeSpace">
								<td class="removeSpace">GSTIN NO. <?php echo $GETSPADDRDETAILS[0]['GST_NUM']; ?></td>
							</tr>
							<tr class="removeSpace">
								<td class="removeSpace">STATE NAME : <?php echo $GETSPADDRDETAILS[0]['STATE_NAME']; ?> </td>
							</tr> 
						</table>
					</td>
					<td style="width:20%;">
						<table>
							<tr class="removeSpace">
								<th class="removeSpace">Name of Consignee</th>
							</tr>
							<tr class="removeSpace">
								<th class="removeSpace"><?php echo $GETCPDETAILS[0]['ACC_NAME']; ?></th>
							</tr>
							<tr class="removeSpace">
								<td class="removeSpace"><?php echo $GETCPADDRDETAILS[0]['ADD1'].','.$GETCPADDRDETAILS[0]['CITY_NAME'].','.$GETCPADDRDETAILS[0]['DIST_NAME'].','.$GETCPADDRDETAILS[0]['STATE_NAME'].','.$GETCPADDRDETAILS[0]['PIN_CODE']; ?></td>
							</tr>
							<tr class="removeSpace">
								<td class="removeSpace">PAN NO. <?php echo $GETCPDETAILS[0]['PAN_NO']; ?></td>
							</tr>
							<tr class="removeSpace">
								<td class="removeSpace">GSTIN NO. <?php echo $GETCPADDRDETAILS[0]['GST_NUM']; ?></td>
							</tr>
							<tr class="removeSpace">
								<td class="removeSpace">STATE NAME : <?php echo $GETCPADDRDETAILS[0]['STATE_NAME']; ?> </td>
							</tr> 
						</table>
					</td>
				</tr>
			</table>
		<?php }else{?>
			<table>
				<tr class="removeSpace">
					<th class="removeSpace">Billing To</th>
				</tr>
				<tr class="removeSpace">
					<th class="removeSpace"><?php echo $provsaleBillData[0]['ACC_NAME']; ?></th>
				</tr>
				<tr class="removeSpace">
					<td class="removeSpace"><?php echo $add_address; ?></td>
				</tr>
				<tr class="removeSpace">
					<td class="removeSpace">PAN NO. <?php echo $acc_pan; ?></td>
				</tr>
				<tr class="removeSpace">
					<td class="removeSpace">GSTIN NO. <?php echo $acc_gstin; ?></td>
				</tr>
				<tr class="removeSpace">
					<td class="removeSpace">STATE NAME : <?php echo $accstate; ?> </td>
				</tr>
			</table>
		<?php } ?>
			<table style="border-top: 1px solid lightgrey;width: 100%;">
				<tr>
					<td></td>
				</tr>
				<tr>
					<td class="removeSpace fontBold1" style="vertical-align: baseline !important;">IRN NO. : </td>
					<td class="removeSpace">&nbsp;</td>
					<td class="removeSpace">&nbsp;</td>
					<td class="removeSpace fontBold1" style="vertical-align: baseline !important;">IRN DATE : </td>
				</tr>
				<tr>
					<td class="removeSpace fontBold1" style="vertical-align: bottom !important;">ACK NO. : </td>
					<td class="removeSpace">&nbsp;</td>
					<td class="removeSpace">&nbsp;</td>
					<td class="removeSpace fontBold1" style="vertical-align: bottom !important;">ACK DATE : </td>
				</tr>
			</table>
			
		</td>
	<?php if ($billFormat=='TATA_BILL') { ?>
			<td style="border-right: 1px solid lightgrey;width:30%;">
	<?php }else if($billFormat=='JCOP_BILL'){?>
			<td style="border-right: 1px solid lightgrey;width:20%;">
	<?php }else{ ?>

			<td style="border-right: 1px solid lightgrey;width:30%;">
	<?php } ?>
			<table>
				<td>
					<tr>
						<th class="removeSpace">Description of service</th>
						<th class="removeSpace">:</th>
						<th class="removeSpace" style="margin-bottom: 2%"><?php echo $ITEMHSN[0]['HSN_NAME']; ?></th>
					</tr>
					<tr>
						<th class="removeSpace">Service Accounting Code</th>
						<th class="removeSpace">:</th>
						<th class="removeSpace" style="margin-bottom: 2%"><?php echo $ITEMHSN[0]['HSN_CODE']; ?></th>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<th class="removeSpace">Place of supply</th>
						<th class="removeSpace">:</th>
						<th class="removeSpace" style="margin-bottom: 2%"><?php echo $getAccCity; ?></th>
					</tr>
				</td>
			</table>
		</td>
<style>
	table.billDetails tr{
		padding: 1%;
	}
</style>

		<td style="width:20%;">
			<table class="billDetails">
				<tr>
					<th class="removeSpace" style="text-align:center;" colspan="3">ORIGINAL FOR BUYER</th>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr >
					<th class="removeSpace">Bill No.</th>
					<td class="removeSpace">:</td>
					<td class="removeSpace"><?php echo $pdfBillNo; ?></td>
				</tr>
				
				<tr style="padding-top: 1em;">
					<th class="removeSpace">Date</th>
					<td class="removeSpace">:</td>
					<td class="removeSpace"><?php $getVrDt = date("d-m-Y", strtotime($getVrDate)); echo $getVrDt; ?></td>
				</tr>
				
				<tr>
					<th class="removeSpace">Work Order No.</th>
					<td class="removeSpace">:</td>
					<td class="removeSpace"><?php echo $workOrdrNo; ?></td>
				</tr>
				
				<tr>
					<th class="removeSpace">Work Order Dt.</th>
					<td class="removeSpace">:</td>
					<td class="removeSpace"><?php echo $workOrdrDt; ?></td>
				</tr>
			</table>	
		</td>

	</tr>
</table>

<table class="table table_highlight">
	<tr class="table_highlight">
		<th>Transportation Bill.</th>
	</tr>
</table>

<table class="table table_highlight">
	<tr class="table_highlight">
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">From Place</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">To Place</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Dely No</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Inv. No.</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Inv. Dt.</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Wagon No./<br>Shipment No.</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Item Name</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Net Qty.</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Gross Qty.</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Wt.Recd</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Sh/<br>Ex Qty.</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Net Wt.Shrt/<br>Exc</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Rate</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Freight Amount</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Vehicle No.</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">LR No. <br>LR Date</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Recp Dt</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">All Days <br>Ack. Days</th>
		<th class="table_highlight text-center" style="background-color: #d9d9d9 !important;">Late Days</th>
	</tr>

	<?php 
		$netAmt=0;
		$grossAmt=0;
		$frightAmt=0;
		foreach($provsaleBillData as $row){ 

		$INVCDATE = date("d-m-Y", strtotime($row['INVC_DATE']));
		$LRDATE = date("d-m-Y", strtotime($row['LR_DATE']));
		$DELIVERYDATE = date("d-m-Y", strtotime($row['DELIVERY_DATE']));

		 $netAmt += $row['NET_WEIGHT'];
		 $grossAmt += $row['GROSS_WEIGHT'];
		 $frightAmt += $row['BASICAMT'];

	?>




	<tr>
		<td class="table_highlight text-left" style="width:6%;"><?php echo $row['FROM_PLACE']; ?></td>
		<td class="table_highlight text-left" style="width:6%;"><?php echo $row['TO_PLACE']; ?></td>
		<td class="table_highlight text-right" style="width:7%;"><?php echo $row['DELIVERY_NO']; ?></td>
		<td class="table_highlight text-right" style="width:7%;"><?php echo $row['INVC_NO']; ?></td>
		<td class="table_highlight text-right" style="width:7%;"><?php echo $INVCDATE; ?></td>
		<td class="table_highlight text-left" style="width:9%;"><?php echo $row['WAGON_NO']; ?></td>
		<td class="table_highlight text-left" style="width:7%;"><?php echo $row['ALIAS_ITEM_NAME']; ?></td>
		<td class="table_highlight text-right" style="width:7%;"><?php echo $row['NET_WEIGHT']; ?></td>
		<td class="table_highlight text-right" style="width:7%;"><?php echo $row['GROSS_WEIGHT']; ?></td>
		<td class="table_highlight text-right" style="width:7%;"><?php echo $row['ACK_QTY']; ?></td>
		<td class="table_highlight text-right" style="width:5%;"><?php echo $row['SHORTAGE_QTY']; ?></td>
		<td class="table_highlight text-right" style="width:4%;"><?php echo 'NF'; ?></td>
		<td class="table_highlight text-right" style="width:8%;"><?php echo $row['RATE']; ?></td>
		<td class="table_highlight text-right" style="width:8%;"><?php echo $row['BASICAMT']; ?></td>
		<td class="table_highlight text-left" style="width:8%;"><?php echo $row['VEHICLE_NO']; ?></td>
		<td class="table_highlight text-left" style="width:9%;"><?php echo $row['LR_NO']; ?><br><?php echo $LRDATE; ?></td>
		<td class="table_highlight text-right" style="width:8%;"><?php echo $DELIVERYDATE; ?></td>
		<?php 
			$differenceFormat = '%a';
			$datetime1 = date_create($LRDATE);
    		$datetime2 = date_create($DELIVERYDATE);

    		$interval = date_diff($datetime1, $datetime2);

    		$getDays = $interval->format($differenceFormat); 

    		$trpDays = $row['TRIP_DAYS'];

    		$lateDays =  $getDays - $trpDays;
    	?>
		<td class="table_highlight text-center" style="width:5%;"><?php echo $row['TRIP_DAYS']; ?><br><?php echo $getDays; ?></td>
		<td class="table_highlight text-center" style="width:5%;"><?php echo $lateDays; ?></td>
	</tr>

	<?php } ?>
	<tr class="list-item total-row table-bordered" style="border-left: 1px solid lightgrey;">
    <th colspan="7" class="tableitem table-bordered fontBold" style="text-align: right;"> TOTAL : </th>
    <td data-label="Net Total" class="tableitem table-bordered fontBold" style="text-align: right;"><?php echo number_format((float)$netAmt, 3, '.', '') ?></td>
    <td data-label="Gross Total" class="tableitem table-bordered fontBold" style="text-align: right;"><?php echo number_format((float)$grossAmt, 3, '.', '') ?></td>
    <th colspan="4" class="tableitem table-bordered" style="text-align: right;"></th>
    <td data-label="Freight Amount Total" class="tableitem table-bordered fontBold" style="text-align: right;"><?php echo number_format((float)$frightAmt, 2, '.', '') ?></td>
  </tr>

</table>

<table class="table table_highlight">
	<tr class="table_highlight">
		<td style="width:46%;">
		<table>
				<tr>
					<th>Amount in Words-Rs - <?php echo $grandTotWord; ?></th>
				</tr>
		</table>
	</td>
	<td style="border-left: 1px solid lightgrey;width:54%;">
		<table style="margin-top:5px;margin-left:12px;">
			<?php 
				if ($SGSTGET>0) {
			 ?>
				<tr>
					<th class="removeSpace">SGST</th>
					<th class="removeSpace">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $saleBillTaxData[0]['SGST_RATE']; ?> %&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th class="removeSpace text-right"><?php echo number_format((float)$SGSTGET, 2, '.', '') ?></th>
				</tr>
				<tr>
					<th class="removeSpace">CGST</th>
					<th class="removeSpace">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $saleBillTaxData[0]['CGST_RATE']; ?> %&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th class="removeSpace text-right"><?php echo number_format((float)$CGSTGET, 2, '.', '') ?></th>
				</tr>
			<?php 
					}else if($IGSTGET>0){ 
						
			?>
				<tr>
					<th class="removeSpace">IGST</th>
					<th class="removeSpace">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $saleBillTaxData[0]['IGST_RATE']; ?> %&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th class="removeSpace text-right"><?php echo number_format((float)$IGSTGET, 2, '.', '') ?></th>
				</tr>
			<?php }else{} ?>
				<tr>
					<th class="removeSpace" style="font-weight:bold;">Grand Total : </th>
					<th class="removeSpace">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th class="removeSpace text-right" style="font-weight:bold;"> <?php echo number_format((float)$MGETGRANDTOT, 2, '.', '') ?></th>
				</tr>	
		</table>
	</td>
	</tr>
</table>

<table class="table table_highlight">
	<tr class="table_highlight" style="line-height:1;">
		<td style="width:40%;">
		<table style="line-height:0.8;">
				<tr>
					<th><b>Remark : </b></th>
				</tr>
				<tr>
					<th><b>*Whether the Tax is payable on Reverse Charge Basis - No</b></th>
				</tr>
				<tr>
					<td>*All Payments by RTGS / Cheque is favor of <?php echo $compDetail[0]->COMP_NAME; ?> should be crossed & account payees only.</td>
				</tr>
				<tr>
					<td>*Interest @18 % per annum will be charged on bills remaining unpaid after days from the date of bill.</td>
				</tr>
				<tr>
					<td>*Subject to Nagpur Jurisdiction only</td>
				</tr>
		</table>
	</td>
	<td style="border-left: 1px solid lightgrey;width:30%;">
		<table style="margin-top:2px;margin-left:12px;line-height:0.8 !important;">
				<tr>
					<td class="removeSpace">Account Details </td>
					<td class="removeSpace">:</td>
					<td class="removeSpace"> ----- </td>
				</tr>
				<tr>
					<td class="removeSpace">Account Name </td>
					<td class="removeSpace">:</td>
					<td class="removeSpace"> <?php echo $compDetail[0]->COMP_NAME; ?></td>
				</tr>
				<tr>
					<td class="removeSpace">Account No </td>
					<td class="removeSpace">:</td>
					<td class="removeSpace"> <?php echo $compDetail[0]->ACC_NUMBER; ?></td>
				</tr>
				<tr>
					<td class="removeSpace">Name of Bank </td>
					<td class="removeSpace">:</td>
					<td class="removeSpace"> <?php echo $compDetail[0]->BANK_NAME.','.$compDetail[0]->BRANCH_NAME.','.$compDetail[0]->CITY_NAME; ?></td>
				</tr>
				<tr>
					<td class="removeSpace">IFSC Code </td>
					<td class="removeSpace">:</td>
					<td class="removeSpace"> <?php echo $compDetail[0]->IFSC_CODE; ?></td>
				</tr>
		</table>
	</td>
	<td style="border-left: 1px solid lightgrey;width:30%;">
		<table>
				<tr>
					<td><span style="font-weight:bold;">Declaration :- </span> "I/we have taken registration under the CGST Act,  2017 and have exercised the option to pay tax on services of GTA in relation to transport of goods supplied by us during the Financial Year <?php echo $fisYear; ?> under forward charge."</td>
				</tr>
		</table>
	</td>
	</tr>
</table>
<table style="width:100%;border-collapse: collapse;">
  <tr>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;"> <p style="vertical-align: baseline;font-weight: bold;"> {{ $userName }} </p><br><br><br><br> <p style="vertical-align: bottom;">Prepared by</p></td>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;vertical-align: bottom;">Checked By</td>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;vertical-align: bottom;">Approved By </td>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;"><p style="vertical-align: baseline;font-weight: bold;"> <?php echo $compDetail[0]->COMP_NAME ?> </p><br><br><br><br><p style="vertical-align: bottom;">Authorised Signatory</p></td>
  </tr>
</table>

<div class="second-page"></div>

<table class="table table-bordered partyDetail" style="margin-bottom: 0px;">
    <tr>
      <th style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 15px;">TAX INVOICE</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="text-align: right;">Page : {PAGENO} of {nbpg}</span></th>
    </tr>
    <tr>
    	<th style="text-align: center;font-size: 15px;">ANNEXURE</th>
    </tr>
</table>

<table class="table table_highlight">
    
    <tr class="table_highlight">

      <td class="removeSpaceLogo" style="width:10%;">
        <table>
            <tr><td><img src="{{ asset('public/dist/img/MUKUNDGROUPLOGO.png') }}" style="width:75px;height:75px;" alt="job image" title="job image"></td></tr>
        </table>
      </td>

      <td class="removeSpaceLogo" style="width:47%;">
        <table>
            <tr>
            	<td class="removeSpace" style="font-size: 14px;font-weight: bold;"><?php echo $compDetail[0]->COMP_NAME ?></td>
            </tr>
            <tr>
            	<td class="removeSpace" style="font-size: 12px;"><?php echo $compDetail[0]->ADD1 ?> <?php echo $compDetail[0]->ADD2 ?> <?php echo $compDetail[0]->ADD3 ?><?php echo ' '.$compDetail[0]->CITY_NAME.','.$compDetail[0]->DIST_NAME.','.$compDetail[0]->STATE_NAME.','.$compDetail[0]->PIN_CODE ?>
            	</td>
            </tr>
        </table>
      </td>

      <td class="removeSpaceLogo" style="width: 33%;border-left: 1px solid lightgrey;">
        <table>
          <tr>
            <th class="removeSpace">Annexure No</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace">1</td>
          </tr>
          <tr>
            <th class="removeSpace">Bill No</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $pdfBillNo; ?></td>
          </tr>
          <tr>
            <th class="removeSpace">Date</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php $getVrDt = date("d-m-Y", strtotime($getVrDate)); echo $getVrDt; ?></td>
          </tr>
          <tr>
            <th class="removeSpace">Transporter Name</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $compDetail[0]->COMP_NAME ?></td>
          </tr>
        </table>
      </td>
      <td class="removeSpaceLogo" style="width: 20%;">
      	<table>
	          <tr>
	            <th class="removeSpace">ORIGINAL FOR BUYER</th>
	          </tr>
	          
      	</table>
      </td>

    </tr>
</table>
<table class="table table_highlight">
	<tr class="table_highlight" style="text-align: center;">
	<th class="text-center table_highlight" style="background-color: #d9d9d9 !important;" width="2%">Sr. No.</th>
    <th class="text-center table_highlight" style="background-color: #d9d9d9 !important;" width="5%">LR No </th>
    <th class="text-center table_highlight" style="background-color: #d9d9d9 !important;" width="20%">Consignor</th>
    <th class="text-center table_highlight" style="background-color: #d9d9d9 !important;" width="20%">Consignee</th>
    <th class="text-center table_highlight" style="background-color: #d9d9d9 !important;" width="5%">Transaction No.</th>
    <th class="text-center table_highlight" style="background-color: #d9d9d9 !important;" width="4%">Bill Amount</th>
    <th class="text-center table_highlight" style="background-color: #d9d9d9 !important;" width="4%">SGST</th>
     <th class="text-center table_highlight" style="background-color: #d9d9d9 !important;" width="4%">CGST</th>
    <th class="text-center table_highlight" style="background-color: #d9d9d9 !important;" width="4%">IGST</th>
    <th class="text-center table_highlight" style="background-color: #d9d9d9 !important;" width="5%">Total Amount <br> (INR)</th>
	</tr>

	<?php 
		
		$srNo     =1;
		$basicTot = 0;
		$sgstTot  = 0;
		$cgst     = 0;
		$grandTot = 0;
		$ROUNDOFF = 0;
		foreach($MBILLDATA as $row){ 

			$GETBASICAMT = $row['TBASIC'];
			$CGSTAMT     = $row['TCGST'];
			$SGSTAMT     = $row['TSGST'];
			$IGSTAMT     = $row['TIGST'];
			$ROUNDOFFAMT     = $row['ROUNDOFF'];
			
			$basicTot    += $row['TBASIC'];
			$sgstTot     += $row['TSGST'];
			
			$MTOTAMT     = $row['TGRANDTOT'];
			$ROUNDOFF    += $row['ROUNDOFF'];
			$cgst        += $row['TCGST'];
			$grandTot    += $MTOTAMT;

			$checkNum1 = '';
	    	if (isset($ROUNDOFFAMT)){
			    if (substr(strval($ROUNDOFFAMT), 0, 1) == "-"){
			    	$checkNum1 = 'It is negative';
				} else {
				    $checkNum1 = 'It is not negative';
				}
			}

	    	if ($checkNum1=='It is negative') {

				$MGETTOT = $MTOTAMT + (- $ROUNDOFFAMT);
				
			}else{

				$MGETTOT = $MTOTAMT - ($ROUNDOFFAMT);

			}

	?>

	<tr>
		<td class="table_highlight text-center" style="width:6%;"><?php echo $srNo; ?></td>
		<td class="table_highlight text-left" style="width:5%;"><?php echo $row['LR_NO']; ?></td>
		<td class="table_highlight text-left" style="width:6%;"><?php echo $row['ACC_NAME']; ?> [<?php echo $row['ACC_CODE']; ?>]</td>
		<td class="table_highlight text-left" style="width:7%;"><?php echo $row['CP_NAME']; ?> [<?php echo $row['CP_CODE']; ?>]</td>
		<td class="table_highlight text-right" style="width:7%;"><?php echo $row['TRANSACTION_NO']; ?></td>
		<td class="table_highlight text-right" style="width:7%;"><?php echo $row['TBASIC']; ?></td>
		<td class="table_highlight text-right" style="width:7%;"><?php echo $row['TSGST']; ?></td>
		<td class="table_highlight text-right" style="width:7%;"><?php echo $row['TCGST']; ?></td>
		<td class="table_highlight text-right" style="width:7%;"><?php echo $row['TIGST']; ?></td>
		<td class="table_highlight text-right" style="width:7%;"><?php echo number_format((float)$MGETTOT, 2, '.', ''); ?></td>
	</tr>

	<?php $srNo++; } ?>
	<tr class="list-item total-row table-bordered" style="border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;">
    <th colspan="5" class="tableitem table-bordered" style="text-align: right;"> Annex Total : </th>
    <td data-label="Bill Amt Total" class="tableitem table-bordered fontBold1" style="text-align: right;"><?php echo number_format((float)$basicTot, 2, '.', '') ?></td>
    <td data-label="SGST Total" class="tableitem table-bordered fontBold1" style="text-align: right;"><?php echo number_format((float)$sgstTot, 2, '.', '') ?></td>
    <td data-label="CGST Amount Total" class="tableitem table-bordered fontBold1" style="text-align: right;"><?php echo number_format((float)$cgst, 2, '.', '') ?></td>
    <td class="tableitem table-bordered"></td>
    <?php 

    	$checkNum = '';
    	if (isset($ROUNDOFF)){
		    if (substr(strval($ROUNDOFF), 0, 1) == "-"){
		    	$checkNum = 'It is negative';
			} else {
			    $checkNum = 'It is not negative';
			}
		}

    	if ($checkNum=='It is negative') {

			$MGETGRANDTOT = $grandTot + (- $ROUNDOFF);
			
		}else{

			$MGETGRANDTOT = $grandTot - ($ROUNDOFF);

		}

     ?>
    <td data-label="Grand Total" class="tableitem table-bordered fontBold1" style="text-align: right;border-right: solid 1px lightgrey;"><?php echo number_format((float)$MGETGRANDTOT, 2, '.', '') ?></td>
	
  </tr>

</table>
<table style="width:100%;border-collapse: collapse;">
  <tr>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;"> <p style="vertical-align: baseline;font-weight: bold;"> {{ $userName }} </p><br><br><br><br> <p style="vertical-align: bottom;">Prepared by</p></td>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;vertical-align: bottom;">Checked By</td>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;vertical-align: bottom;">Approved By </td>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;"><p style="vertical-align: baseline;font-weight: bold;"> <?php echo $compDetail[0]->COMP_NAME ?> </p><br><br><br><br><p style="vertical-align: bottom;">Authorised Signatory</p></td>
  </tr>
</table>