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
            <th class="removeSpace">SERIES</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"> <?php echo $dataheadB[0]->SERIES_CODE?> - <?php echo $dataheadB[0]->SERIES_NAME?></td>
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

        <tr style="padding-top: 20%;">
          <td class="table_highlight" style="border-left: 1px solid lightgrey;width:7%;text-align:center;">1</td>
          <td class="bodyTextS" style="width:19%;">&nbsp;</td>
          <td class="bodyTextS textRightS" style="width:9%;">&nbsp;</td>
          <td class="bodyTextS textRightS" style="width:14%;">&nbsp;</td>
          <td style="width:5%;">&nbsp;</td>
          <td class="bodyTextS textRightS" style="width:14%;">&nbsp;</td>
          <td style="width:6%;">&nbsp;</td>
          <td class="bodyTextS textRightS" style="width:11%;">&nbsp;</td>
          <td class="bodyTextS textRightS" style="width:15%;">&nbsp;</td>
   
        </tr>

      <?php $getRow = 9 - 1; for($q=0;$q<$getRow;$q++){ ?>
        <tr style="border:none;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;"><td >&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
      <?php } ?>
    </tbody>
      

    <tr class="list-item total-row">
        <th colspan="5" style="border-right-color:white;" class="removeSpacetax"></th>
        <th colspan="3" class="tableitem removeSpacetax" style="text-align: left;"> Total</th>
        <td data-label="Grand Total" class="tableitem bodyTextS textRightS removeSpacetax">
          &nbsp;
        </td>
    </tr>

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
      
    <tr>
      <td class="bodyTextS" style="width:16%;">&nbsp;</td>
      <td class="bodyTextS textRightS" style="width:8%;">&nbsp;</td>
      <td class="bodyTextS textRightS" style="width:15%;">&nbsp;</td>
      <td class="bodyTextS textRightS" style="width:8%;">&nbsp;</td>
      <td class="bodyTextS textRightS" style="width:15%;">&nbsp;</td>
      <td class="bodyTextS textRightS" style="width:8%;">&nbsp;</td>
      <td class="bodyTextS textRightS" style="width:15%;">&nbsp;</td>
      <td class="bodyTextS textRightS" style="width:15%;">&nbsp;</td>
    </tr>
      
    <tr>
      <td class="bodyTextS">Total</td>
      <td></td>
      <td class="bodyTextS textRightS">&nbsp;</td>
      <td></td>
      <td class="bodyTextS textRightS">&nbsp;</td>
      <td></td>
      <td class="bodyTextS textRightS">&nbsp;</td>
      <td class="bodyTextS textRightS">&nbsp;</td>
      
    </tr>

  </table>

<table class="table table_highlight" style="width: 100%;" style="margin-bottom: 0px;">
  <tr>
    <th colspan="3" style="border-bottom: 1px solid lightgrey;">TERMS & CONDITIONS : </th>
  </tr>
  <tr>
    <td>1</td>
    <td>:</td>
    <td></td>
  </tr>
  <tr>
    <td>2</td>
    <td>:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>3</td>
    <td>:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>4</td>
    <td>:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>5</td>
    <td>:</td>
    <td>&nbsp;</td>
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

