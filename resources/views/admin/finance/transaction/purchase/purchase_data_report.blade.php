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
    font-size: 11px;
  }
  .text_size{
    font-weight: bold;
  }
  .setpadding{
    padding-top: 3px;
  }
  .bodyTextS{
      font-size: 11px;
  }
  .textRightS{
    text-align: right;
  }
  .textleftS{
    text-align: left;
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
    vertical-align: middle;
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
          $partyDate     = $dataheadB[0]->PREFDATE;
    
          if($partyDate == '0000-00-00'){
            $partyRef_Date ='00-00-0000';
          }else{
            $partyRef_Date = date("d-m-Y", strtotime($partyDate));
          }
          
           ?>
<table class="table table-bordered partyDetail" style="margin-bottom: 0px;">
    <tr>
      <th style="text-align: center;font-size: 15px;"> {{$pdfName}} </th>
    </tr>
</table>
<table class="table table_highlight">
    
    <tr class="table_highlight">
      <td>
        <table>
            <tr><td style="font-size: 14px;font-weight: bold;"><?php echo $compDetail[0]->COMP_NAME ?></td></tr>
            <tr><td style="font-size: 12px;"><?php echo $compDetail[0]->ADD1 ?> <?php echo $compDetail[0]->ADD2 ?> <?php echo $compDetail[0]->ADD3 ?><?php echo ' '.$compDetail[0]->CITY.' - '.$compDetail[0]->PIN_CODE.' '.$compDetail[0]->STATE_NAME ?></td></tr>
        </table>
      </td>

      <td  style="width: 50%;border-left: 1px solid lightgrey;">
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

          <?php if($dataheadB[0]->GST_NO){ ?>
            <tr>
              <th class="removeSpace">GST NO</th>
              <th class="removeSpace">:</th>
              <td class="removeSpace"><?php echo $dataheadB[0]->GST_NO ?></td>
            </tr>
          <?php } ?>

          
          <tr>
            <th class="removeSpace"><?php echo $vrPName; ?></th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $fiscalYr[0].' '.$series_code.' '.$dataheadB[0]->VRNO; ?></td>
          </tr>
          <tr>
            <th class="removeSpace">DATE</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $vr_Date;?></td>
          </tr>
          <?php if($dataheadB[0]->PREFNO){ ?>
            <tr>
              <th class="removeSpace">PARTY REF. NO</th>
              <th class="removeSpace">:</th>
              <td class="removeSpace"><?php echo $dataheadB[0]->PREFNO?></td>
            </tr>
          <?php } ?>
          <tr>
            <th class="removeSpace">PARTY REF. DATE</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $partyRef_Date;?></td>
          </tr>
          <tr>
            <th class="removeSpace">DOC TYPE</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"> <?php echo $dataheadB[0]->SERIES_CODE?> - <?php echo $dataheadB[0]->SERIES_NAME?></td>
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
            <th>NAME & ADDRESS OF SUPPLIER</th>
          </tr>
        </table>
      </td>
      <td style="width: 50%;border-left: 1px solid lightgrey;">
        <table>
          <tr>
            <th>RECIPIENT CONSINEE'S NAME & ADDRESS</th>
          </tr>
        </table>
      </td>
    </tr>
    <tr class="table_highlight" style="border-bottom-color: white;">
      <td>
        <table>
          <tr>
            <td style="font-weight: bold;"><?php echo $dataAccDetail[0]->ACCCODE ?> - <?php echo $dataAccDetail[0]->ACCNAME ?> </td>
          </tr>
          <tr>
            <td class="removeSpace"><?php echo $dataAccDetail[0]->ADD1; ?></td>
          </tr>
        </table>
      </td>
      <td style="border-left: 1px solid lightgrey;">
        <table>
          <tr>
            <td style="font-weight: bold;"><?php if($consinerDetail){ echo $consinerDetail[0]->ACC_CODE; }else{ echo '----';} ?></td>
          </tr>
          <tr>
            <td class="removeSpace"><?php if($consinerDetail){ echo $consinerDetail[0]->ADD1; }else{ echo '----';}?></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr class="table_highlight">
      <td>
        <table>
          <tr>
            <th>STATE</th>
            <th>:</th>
            <td><?php echo $dataAccDetail[0]->STATE_NAME ?></td>
          </tr>
          <tr>
            <th class="removeSpace">GSTN  NO</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo  $dataAccDetail[0]->GST_NUM; ?></td>
          </tr>
          <tr>
            <th class="removeSpace">PAN  NO</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $dataAccDetail[0]->PAN_NO; ?> </td>
          </tr>
          <tr>
            <th class="removeSpace">EMAIL ID</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $dataAccDetail[0]->EMAIL_ID ?></td>
          </tr>
        </table>
      </td>
      <td style="border-left: 1px solid lightgrey;">
        <table>
          <tr>
            <th>STATE</th>
            <th>:</th>
            <td><?php if($consinerDetail){ echo $consinerDetail[0]->STATE_NAME; }else{echo '----';} ?></td>
          </tr>
          <tr>
            <th class="removeSpace">GSTN  NO</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php if($consinerDetail){ echo $consinerDetail[0]->GST_NUM; }else{echo '----';} ?></td>
          </tr>
          <tr>
            <th class="removeSpace">PAN  NO</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php if($consinerDetail){ echo $consinerDetail[0]->PAN_NO; }else{echo '----';} ?> </td>
          </tr>
          <tr>
            <th class="removeSpace">EMAIL ID</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php if($consinerDetail){ echo $consinerDetail[0]->EMAIL_ID; }else{echo '----';} ?></td>
          </tr>
        </table>
      </td>
    </tr>
</table>
<table class="table table_highlight">
  <?php if($pdfName == 'PURCHASE CONTRACT'){ ?>
    <tr>
      <th> * Please find the purchase contract of the below material/services as per terms & conditions.</th>
    </tr>
  <?php } ?>

  <?php if($pdfName == 'PURCHASE ORDER'){ ?>
    <tr>
      <th> * Please supply the below material/services as per terms & conditions.</th>
    </tr>
  <?php } ?>
</table>

<!-- < ?php if($pdfName == 'SALES CHALLAN' || $pdfName == 'SALES BILL'){ ?>
<table class="table table_highlight">
    <tr class="table_highlight">
      <td>
        <table>
          <tr>
            <td>DISPATCH FROM</td>
            <td>:</td>
            <td>< ?php echo $dataheadB[0]->plant_city; ?></td>
          </tr>
          <tr>
            <td class="removeSpace">TRANSPORTER CODE</td>
            <td class="removeSpace">:</td>
            <td class="removeSpace">< ?php echo $dataheadB[0]->TRPT_CODE; ?></td>
          </tr>
          <tr>
            <td class="removeSpace">VEHICAL NO</td>
            <td class="removeSpace">:</td>
            <td class="removeSpace">< ?php echo $dataheadB[0]->VEHICAL_NO; ?></td>
          </tr>
          <tr>
            <td class="removeSpace">E-WAY BIL NO</td>
            <td class="removeSpace">:</td>
            <td class="removeSpace">< ?php echo $dataheadB[0]->E_WAY_BILL_NO; ?></td>
          </tr>
        </table>
      </td>
      <td style="width: 50%;border-left: 1px solid lightgrey;">
        <table>
          <tr>
            <td>DISPATCH TO</td>
            <td>:</td>
            <td>< ?php echo $consinerDetail[0]->CITY_CODE; ?></td>
          </tr>
          <tr>
            <td class="removeSpace">SHIPMENT NO</td>
            <td class="removeSpace">:</td>
            <td class="removeSpace">< ?php echo $consinerDetail[0]->CITY_CODE; ?></td>
          </tr>
          <tr>
            <td class="removeSpace">TRANSPORTER NAME</td>
            <td class="removeSpace">:</td>
            <td class="removeSpace">< ?php echo $dataheadB[0]->TRPT_NAME; ?></td>
          </tr>
          <tr>
            <td class="removeSpace">LR ON./LR DATE</td>
            <td class="removeSpace">:</td>
            <td class="removeSpace">< ?php echo $dataheadB[0]->LR_NO; ?></td>
          </tr>
        </table>
      </td>
    </tr>
</table>
< ?php } ?> -->
  <?php $sgst=array(); $cgst =array();$igst =array(); foreach ($dataTax as $row) { 

            if($row->TAXIND_CODE=='SG1'){

              $sgst[] = $row->TAX_AMT;
              $sgstrate[] = $row->TAX_RATE;
            }else{
            }

            if($row->TAXIND_CODE=='CG1'){

              $cgst[] = $row->TAX_AMT;
              $cgstrate[] = $row->TAX_RATE;
            }else{
            
            }

            if($row->TAXIND_CODE=='IGST'){
              $igst[] = $row->TAX_AMT;
              $igstrate[] = $row->TAX_RATE;
            }else{
              
            }

         }

  
  ?>

      <table id="InwardDispatch" class="table table-bordered" style="margin-bottom: 0px;">

        <thead class="theadC">

          <tr style="padding-top: 20%;text-align: center;">
            <th class="text-center" style="border-left: 1px solid lightgrey;font-size: 11px;width: 8px;">SR.NO</th>
            <th class="text-center" style="font-size: 11px;">ITEM DESCRIPTION</th>
            <th class="text-center" style="font-size: 11px;">HSN</th>
            <th class="text-center" style="font-size: 11px;">QTY</th>
            <th class="text-center" style="font-size: 11px;">UM</th>
            <th class="text-center" style="font-size: 11px;">AQTY</th>
            <th class="text-center" style="font-size: 11px;">AUM</th>
            <th class="text-center" style="font-size: 11px;">RATE</th>
            <!-- <th class="text-center" colspan="2">CGST</th>
            <th class="text-center" colspan="2">SGST</th>
            <th class="text-center" colspan="2">IGST</th> -->
            <th class="text-center" style="font-size: 11px;">BASIC</th>
          </tr>

        </thead>

        <tbody id="defualtSearch">

     
          <?php $rowCount = count($dataheadB); ?>
          <?php  $sum = 0; $bal=0; $sr_no=1; foreach($dataheadB as $key) {

            if($key->tablNme == 'PQTN_HEAD' || $key->tablNme == 'PCNTR_HEAD'){
                $qtyRecd = $key->QTYRECD;
              }else if($key->tablNme == 'GRN_HEAD'){
                $qtyRecd = $key->QTYRECED;
              }else if($key->tablNme == 'PORDER_HEAD'){
                $qtyRecd = $key->QTYRECD;
              }else if($key->tablNme == 'PBILL_HEAD'){
                $qtyRecd = $key->QTYRECD;
              }else{
                $qtyRecd='';
              }

            if($key->tablNme == 'GRN_HEAD'){
              $perticular = $key->REMARK;
              $umCd = $key->UM_CODE;
              $aumCd = $key->AUM_CODE;
            }else{
              $perticular =$key->PARTICULAR;
              $umCd = $key->UM;
              $aumCd = $key->AUM;
            }

              $bal +=$key->BASICAMT;
             // echo $key->PARTICULAR;
           ?>

            <tr style="padding-top: 20%;">
              <td class="table_highlight" style="border-left: 1px solid lightgrey;width:7%;text-align:center;">{{ $sr_no}}</td>
              <td class="bodyTextS" style="width:19%;">{{$key->ITEM_NAME}}  <?php if($perticular){echo '[ '.$perticular.' ]';}?></td>
              <td class="bodyTextS textRightS" style="width:9%;">{{ $key->HSN_CODE }}</td>
              <td class="bodyTextS textRightS" style="width:14%;">{{ $qtyRecd }}</td>
              <td>{{ $umCd }}</td>
              <td class="bodyTextS textRightS" style="width:14%;">{{ $key->AQTYRECD }}</td>
              <td>{{ $aumCd }}</td>
              <td class="bodyTextS textRightS" style="width:11%;"> {{$key->RATE}}</td>
              <td class="bodyTextS textRightS" style="width:15%;">{{$key->BASICAMT}}</td>
       
            </tr>

          <?php $sr_no++;$sum++; }   ?>

          <?php $getRow = 9 -$rowCount; for($q=0;$q<$getRow;$q++){ ?>
            <tr style="border:none;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;"><td >&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
          <?php } ?>
        </tbody>
          

        <tr class="list-item total-row">
            <th colspan="5" style="border-right-color:white;" class="removeSpacetax"></th>
            <th colspan="3" class="tableitem removeSpacetax" style="text-align: left;"> Total</th>
            <td data-label="Grand Total" class="tableitem bodyTextS textRightS removeSpacetax">
              <?php $bal_amt = number_format((float)$bal, 2, '.', ''); echo $bal_amt; ?>
            </td>
        </tr>

        <?php foreach($taxDetail as $taxAm) { if($taxAm->TCFLAG == 'RT'){?>

          <?php if(isset($taxAm->CR_AMT)){ if($taxAm->CR_AMT != null || ($taxAm->CR_AMT != 0.00)){ ?>
            <tr class="list-item total-row">
              
              <?php if($taxAm->IND_NAME == 'GRAND'){ ?>
                <th colspan="5" style="border-right-color:white;">Rs. <?php echo $numwords; ?> Only</th>
                <th colspan="3" class="tableitem textleftS removeSpacetax"> {{$taxAm->IND_NAME}} TOTAL</th>
              <?php }else{ ?>
                <th colspan="5" style="border-right-color:white;"></th>
                <th colspan="3" class="tableitem textleftS removeSpacetax"> {{$taxAm->IND_NAME}}</th>
              <?php } ?>
              
              <td data-label="Grand Total" class="tableitem bodyTextS textRightS removeSpacetax">
                {{$taxAm->CR_AMT}}
              </td>
            </tr>
          <?php } }?>

        <?php }} ?>
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
          <th>%</th>
          <th>AMOUNT</th>
          <th>%</th>
          <th>AMOUNT</th>
          <th>%</th>
          <th>AMOUNT</th>
        </tr>

          
            <?php $cgst_total =0;$sgst_total=0;$igst_total=0;foreach($taxDetail as $HsnTAmt) { if($HsnTAmt->TCFLAG == 'R_IT'){

               $cgst_total += $HsnTAmt->cgstamt;
               $igst_total += $HsnTAmt->igstamt;
               $sgst_total += $HsnTAmt->sgstamt;
               $cgst_amt = $HsnTAmt->cgstamt;
               $igst_amt = $HsnTAmt->igstamt;
               $sgst_amt = $HsnTAmt->sgstamt;
               $totalAmt = $cgst_amt + $igst_amt + $sgst_amt;
               $totalAllAmt = $cgst_total + $igst_total + $sgst_total;
              ?> 
              <tr>
              <td class="bodyTextS" style="width:16%;">{{ $HsnTAmt->IND_CODE }}</td>
              <td class="bodyTextS textRightS" style="width:8%;">{{ $HsnTAmt->cgstrate }}</td>
              <td class="bodyTextS textRightS" style="width:15%;">{{ $HsnTAmt->cgstamt }}</td>
              <td class="bodyTextS textRightS" style="width:8%;">{{ $HsnTAmt->sgstrate }}</td>
              <td class="bodyTextS textRightS" style="width:15%;">{{ $HsnTAmt->sgstamt }}</td>
              <td class="bodyTextS textRightS" style="width:8%;">{{ $HsnTAmt->igstrate }}</td>
              <td class="bodyTextS textRightS" style="width:15%;">{{ $HsnTAmt->igstamt }}</td>
              <td class="bodyTextS textRightS" style="width:15%;"><?php $floatTot_amt = number_format((float)$totalAmt, 2, '.', ''); echo $floatTot_amt; ?></td>
              
              </tr>
          <?php }} ?>
          
          <tr>
            <td class="bodyTextS">Total</td>
            <td></td>
            <td class="bodyTextS textRightS"><?php $cgstTot_amt = number_format((float)$cgst_total, 2, '.', ''); echo $cgstTot_amt; ?></td>
            <td></td>
            <td class="bodyTextS textRightS"><?php $sgstTot_amt = number_format((float)$sgst_total, 2, '.', ''); echo $sgstTot_amt; ?></td>
            <td></td>
            <td class="bodyTextS textRightS"><?php $igdtTot_amt = number_format((float)$igst_total, 2, '.', ''); echo $igdtTot_amt; ?></td>

            <td class="bodyTextS textRightS"><?php $floatTotall_amt = number_format((float)$totalAllAmt, 2, '.', ''); echo $floatTotall_amt; ?></td>
          </tr>

      </table>
    

<table class="table table_highlight" style="width: 100%;" style="margin-bottom: 0px;">
  <tr>
    <th colspan="3" style="border-bottom: 1px solid lightgrey;">TERMS & CONDITIONS : </th>
  </tr>
  <?php if($dataConfig[0]->RFHEAD1 && $dataheadB[0]->RFHEAD1){ ?>
    <tr>
      <td><?php echo $dataConfig[0]->RFHEAD1;?></td>
      <td>:</td>
      <td><?php echo $dataheadB[0]->RFHEAD1; ?></td>
    </tr>
  <?php }else{ ?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  <?php } ?>
  <?php if($dataConfig[0]->RFHEAD2 && $dataheadB[0]->RFHEAD2){ ?>
    <tr>
      <td><?php echo $dataConfig[0]->RFHEAD2;?></td>
      <td>:</td>
      <td><?php echo $dataheadB[0]->RFHEAD2; ?></td>
    </tr>
   <?php }else{ ?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  <?php } ?>
  <?php if($dataConfig[0]->RFHEAD3 && $dataheadB[0]->RFHEAD3){ ?>
    <tr>
      <td><?php echo $dataConfig[0]->RFHEAD3;?></td>
      <td>:</td>
      <td><?php echo $dataheadB[0]->RFHEAD3; ?></td>
    </tr>
   <?php }else{ ?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  <?php } ?>
  <?php if($dataConfig[0]->RFHEAD4 && $dataheadB[0]->RFHEAD4){ ?>
    <tr>
      <td><?php echo $dataConfig[0]->RFHEAD4;?></td>
      <td>:</td>
      <td><?php echo $dataheadB[0]->RFHEAD4; ?></td>
    </tr>
   <?php }else{ ?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  <?php } ?>
  <?php if($dataConfig[0]->RFHEAD5 && $dataheadB[0]->RFHEAD5){ ?>
    <tr>
      <td><?php echo $dataConfig[0]->RFHEAD5;?></td>
      <td>:</td>
      <td><?php echo $dataheadB[0]->RFHEAD5; ?></td>
    </tr>
   <?php }else{ ?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  <?php } ?>
    
</table>


<table class="table table-bordered">
  <tr>
    <th style="font-size: 11px;text-align:left;border-right:1x solid white;">
       &nbsp;
      <br><br><br><br><br>
      Prepared By

    </th>
    <th class="textRightS" style="font-size: 11px;border-right:1x solid white;">
      &nbsp;
      <br><br><br><br><br>
      Account Head

    </th>
    <th class="textRightS" style="font-size: 11px;">
      For <?php echo $compSplit[1];?>
      <br><br><br><br><br>
      Authorised Signatory

    </th>
  </tr>
</table>

