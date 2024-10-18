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
          $partyDate     = $dataheadB[0]->PARTYREFDATE;
    
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
            <tr><td>&nbsp;</td></tr>
            <tr><td style="font-weight: bold;">Supplier Name - <?php echo $vendorData->ACC_CODE.' - '.$vendorData->ACC_NAME ?></td></tr>
            <tr><td>&nbsp;</td></tr>
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

          <tr>
            <th class="removeSpace">GST NO</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace">wer345</td>
          </tr>
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
          <tr>
            <th class="removeSpace">PARTY REF. NO</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $dataheadB[0]->PARTYREFNO?></td>
          </tr>
          <tr>
            <th class="removeSpace">PARTY REF. DATE</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $partyRef_Date;?></td>
          </tr>
          <tr>
            <th class="removeSpace">DOC TYPE</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"> <?php echo $dataheadB[0]->SERIES_CODE;?> - <?php echo $dataheadB[0]->SERIES_NAME; ?> </td>
          </tr>
        </table>
      </td>
    </tr>
</table>




      <table id="InwardDispatch" class="table table-bordered" style="margin-bottom: 0px;">

        <thead class="theadC">

          <tr style="padding-top: 20%;text-align: center;">
            <th class="text-center" style="border-left: 1px solid lightgrey;font-size: 11px;">SR.NO</th>
            <th class="text-center" style="font-size: 11px;">ITEM DESCRIPTION</th>
            <th class="text-center" style="font-size: 11px;">QTY</th>
            <th class="text-center" style="font-size: 11px;">UM</th>
            <th class="text-center" style="font-size: 11px;">AQTY</th>
            <th class="text-center" style="font-size: 11px;">AUM</th>
          </tr>

        </thead>

        <tbody id="defualtSearch">

     
          <?php $rowCount = count($dataheadB); ?>
          <?php  $sum = 0;  $sr_no=1; foreach($dataheadB as $key) {

           ?>

            <tr style="padding-top: 20%;">
              <td class="table_highlight" style="border-left: 1px solid lightgrey;">{{ $sr_no}}</td>
              <td class="bodyTextS">{{$key->ITEM_NAME}}  <?php if($key->PARTICULAR){echo '[ '.$key->PARTICULAR.' ]';}?></td>
              <td class="bodyTextS textRightS">{{ $key->QTYRECD }}</td>
              <td>{{ $key->UM }}</td>
              <td class="bodyTextS textRightS">{{ $key->AQTYRECD }}</td>
              <td>{{ $key->AUM }}</td>
       
            </tr>

          <?php $sr_no++;$sum++; }   ?>

          <?php $getRow = 9 -$rowCount; for($q=0;$q<$getRow;$q++){ ?>
            <tr style="border:none;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;"><td >&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
          <?php } ?>
        </tbody>
          
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