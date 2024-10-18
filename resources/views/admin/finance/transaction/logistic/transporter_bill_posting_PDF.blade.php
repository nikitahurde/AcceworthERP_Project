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
        
      </td>
     <!--  <td class="removeSpaceLogo" style="width:15%;">
        <table>
            <tr><td><img src="{{ asset('public/dist/img/inceeboxIMG.png') }}" style="width:100px;height:60px;" alt="job image" title="job image"></td></tr>
        </table>
      </td> -->
    </tr>
</table>

<table class="table table_highlight">
  <tr class="table_highlight">

    <td class="removeSpaceLogo" style="width:50%;">
      <table>

        <tr>
          <th>TRANSPORTER NAME</th>
          <th>:</th>
          <td><?= $dataAccDetail[0]->ACCNAME ?> - <?= $dataAccDetail[0]->ACCCODE ?></td>
        </tr>

        <tr>
          <th>ADDRESS</th>
          <th>:</th>
          <td><?= $dataAccDetail[0]->ADD1 ?></td>
        </tr>

        <tr>
          <th>E-MAIL</th>
          <th>:</th>
          <td><?= $dataAccDetail[0]->EMAIL_ID ?></td>
        </tr>

      </table>
    </td>

    <td class="removeSpaceLogo" style="width:50%;">
        <table>
          
          <tr>
            <th>BILL NO</th>
            <th>:</th>
            <?php $FY_CODE = Session::get('macc_year'); 

                $explodefy = explode('-', $FY_CODE);
             ?>

            <td><?php echo $dataheadB[0]->SERIES_CODE ?>/<?= $explodefy[0] ?>/<?php echo $JvVrNo ?></td>
          </tr>

          <tr>
            <th>BILL DATE</th>
            <th>:</th>
            <td><?= $pay_vr_date ?></td>
          </tr>
           <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <td>&nbsp;</td>
          </tr>

        </table>
    </td>

  </tr>
</table>



<table class="table table_highlight">

 

  <tr class="table_highlight">
    <th class="table_highlight">REF.NO.<br>REF.DATE</th>
    <th class="table_highlight">LRNO<br>LRDATE<br>ITEM NAME</th>
    <th class="table_highlight">FRT.ORDER NO<br>FRT.ORDER DATE</th>
    <th class="table_highlight">FROM PLACE<br>TO PLACE</th>
    <th class="table_highlight">TARGET DATE<br>REACHED DATE</th>
    <th class="table_highlight">TRUCK NO<br>TRUCK TYPE</th>
    <th class="table_highlight">QTY/<br>SHORTAG QTY</th>
    <th class="table_highlight">RATE</th>
    <th class="table_highlight">TOTAL<br>FREIGHT</th>
    <th class="table_highlight">BASIC<br>AMOUNT</th>
    <th class="table_highlight">ADDITION</th>
    <th class="table_highlight">DEDUCTION</th>
    <th class="table_highlight">ADAVANCED</th>
    <th class="table_highlight">TDS</th>
    <th class="table_highlight">BALENCE FREIGHT</th>
  </tr>

<?php $Freightamt=0;$amt=0;$add=0;$addless=0;$lessadv=0;$netamt=0;$balancefreightamt=0;$totcaltdsrate=0;$basicAmt=0;$COUNT=count($dataheadB); foreach($dataheadB as $key) { 

        $Freightamt += $key->TRIP_FREIGHT_AMT;
        $addless += $key->ADD_LESS_CHRG;
        $lessadv += $key->LESS_ADVANCE;
        $basicAmt += $key->BASIC_AMT;
        $netamt += $key->NET_AMOUNT;
        $lrdate = $key->LR_DATE;
        $tripDay = $key->TRIP_DAY;


          $totFreight = floatval($key->TRIP_FREIGHT_AMT) - floatval(abs($key->ADD_LESS_CHRG));


         $caltds =  floatval($key->TRIP_FREIGHT_AMT) + floatval($key->ADD_LESS_CHRG);

         $caltdsrate = floatval($caltds) * floatval($tdsRate) /100;


        

         $gstamttotal = $GRANDTOT / $COUNT;

         $FreightAmt = floatval($totFreight) + floatval($gstamttotal) - floatval($caltdsrate); 
        // $FreightAmt = floatval($totFreight) + floatval($caltdsrate); 

         $totcaltdsrate +=$caltdsrate;

         $amtnetfreight = floatval($key->TRIP_FREIGHT_AMT) - floatval($caltdsrate);
         //print_r($amtnetfreight);
         $lessfreight = floatval($amtnetfreight) + floatval($key->ADD_LESS_CHRG);
         $balancefreight = floatval($FreightAmt) - floatval($key->LESS_ADVANCE);

         $balancefreightamt += $balancefreight;

        $target_date = date('Y-m-d', strtotime($lrdate. ' + '.$tripDay.' days'));
  ?>
 
  <tr class="table_highlight">
    <td class="table_highlight"><?= $key->LR_NO ?><br><?= $key->LR_DATE ?></td>
    <td class="table_highlight"><?= $key->LR_NO ?><br><?= $key->LR_DATE ?><br><?= $key->ITEM_NAME ?></td>
    <td class="table_highlight"><?= $key->FPO_NO ?></td>
    <td class="table_highlight"><?= $key->FROM_PLACE ?><br><?= $key->TO_PLACE ?></td>
    <td class="table_highlight"><?= $target_date ?><br><?= $key->ARRIVAL_DATE ?></td>
    <td class="table_highlight"><?= $key->vehicleNo ?><br><?= $key->VEHICLE_TYPE ?></td>
    <td class="table_highlight numberRight"><?= $key->QTY ?><br><?= $key->SHORTAGE_QTY ?></td>
    <td class="table_highlight numberRight"><?= $key->FPO_RATE ?></td>
    <td class="table_highlight numberRight"><?= $key->TRIP_FREIGHT_AMT ?></td>
    <td class="table_highlight numberRight"><?= $key->BASIC_AMT ?></td>
    <td class="table_highlight numberRight">0</td>
    <td class="table_highlight numberRight"><?= $key->ADD_LESS_CHRG ?></td>
    <td class="table_highlight numberRight"><?= $key->LESS_ADVANCE ?></td>
   <!--  <td class="table_highlight"><?= $key->NET_AMOUNT ?></td> -->
     <td class="table_highlight numberRight"><?= $caltdsrate; ?></td>
    <td class="table_highlight numberRight"><?= number_format((float)$balancefreight, 2, '.', ''); ?></td>
  </tr>

<?php } ?>

  <tr class="table_highlight">
    <td class="table_highlight" colspan="8"></td>
    <td class="table_highlight numberRight" ><?php $totalamt = number_format((float)$Freightamt, 2, '.', ''); echo $totalamt; ?></td>
    <td class="table_highlight numberRight" ><?php $totalbasicamt = number_format((float)$basicAmt, 2, '.', ''); echo $totalbasicamt; ?></td>
    <td class="table_highlight numberRight" >0</td>
    <td class="table_highlight numberRight" ><?php $totaladdless = number_format((float)$addless, 2, '.', ''); echo $totaladdless; ?></td>
    <td class="table_highlight numberRight" ><?php $totallessadv = number_format((float)$lessadv, 2, '.', ''); echo $totallessadv; ?></td>
    <td class="table_highlight numberRight" ><?php $totcaltdsrate1 = number_format((float)$totcaltdsrate, 2, '.', ''); echo $totcaltdsrate1; ?></td>
    <td class="table_highlight numberRight" ><?php $totalnetamt = number_format((float)$balancefreightamt, 2, '.', ''); echo $totalnetamt; ?></td>
  </tr>

</table>

<table class="table table_highlight" style="padding-top: 20px;">

	<tr class="table_highlight">
		<td class="removeSpaceLogo" width="35%">&nbsp;</td>
		<td class="removeSpaceLogo" width="65%">
			<table>
				<tr class="table_highlight">
				    <th class="table_highlight">DESCRIPTION</th>
				    <th class="table_highlight">AMT</th>
				  </tr>

				  <tr class="table_highlight" style="padding: 2px;">
				    <td class="table_highlight">Total Freight</td>
				    <td class="table_highlight numberRight" ><?php $totalFreightamt = number_format((float)$Freightamt, 2, '.', ''); echo $totalFreightamt; ?></td>
				  </tr>

            <?php $amtcharges=0; foreach($dataTripCharges as $key) { 

              $amtcharges += floatval($key->AMOUNT);
          ?>
          
          <tr class="table_highlight">
            <td class="table_highlight"><?= $key->DESCRIPTION ?></td>
            <td class="table_highlight numberRight"><?= $key->AMOUNT ?></td>
          </tr>

        <?php } ?>

         <tr class="table_highlight">
            <th class="table_highlight">Deduction</th>
            <th class="table_highlight numberRight" ><?php $totalamtcharges = number_format((float) $amtcharges, 2, '.', ''); echo $totalamtcharges; ?></th>
          </tr>

				  <tr class="table_highlight">
				    <th class="table_highlight">Sub Total Freight</th>
				    <th class="table_highlight numberRight" style="font-weight: bold;"><?php $totalnetFreight = floatval($Freightamt) - floatval(abs($totalamtcharges)); echo number_format((float) $totalnetFreight, 2, '.', ''); ?></th>
				  </tr>
				  <tr class="table_highlight">
				    <th class="table_highlight" colspan="1"></th>
				    <td class="table_highlight" >&nbsp;</td>
				  </tr>

           <tr class="table_highlight">
            <td class="table_highlight">GST</td>
            <td class="table_highlight numberRight" ><?php $totalgst_amt = number_format((float) $totalgstamt, 2, '.', ''); echo $totalgst_amt; ?></td>
          </tr>

			 <tr class="table_highlight">
            <td class="table_highlight">TDS 1 %</td>
            <td class="table_highlight numberRight" ><?php $totaltds_deductAmt = number_format((float) $tds_deductAmt, 2, '.', ''); echo $totaltds_deductAmt; ?></td>
          </tr>

				  
				  
				  <tr class="table_highlight">
				    <td class="table_highlight">Freight Amt</td>
				    <td class="table_highlight numberRight" style="font-weight: bold;"><?php $FreightAmt = floatval($totalnetFreight) + floatval($totalgst_amt) - floatval($totaltds_deductAmt); echo number_format((float) $FreightAmt, 2, '.', ''); ?></td>
				  </tr>
				   <tr class="table_highlight">
				    <td class="table_highlight">Less Advance</td>
				    <td class="table_highlight numberRight" style="]font-weight: bold;"><?php  echo $totallessadv ?></td>
				  </tr>
				  <tr class="table_highlight">
				    <th class="table_highlight">Net Payble Amount</th>
				    <th class="table_highlight numberRight" style="]font-weight: bold;"><?php $NetPaybleAmt = floatval($FreightAmt) - floatval($totallessadv); echo  number_format((float) $NetPaybleAmt, 2, '.', ''); ?></th>
				  </tr>
			</table>
		</td>
	</tr>
  
  

 
</table>