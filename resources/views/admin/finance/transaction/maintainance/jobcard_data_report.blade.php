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
  .textCenterS{
    text-align: center;
  }
</style>


<?php  
          $compName      = Session::get('company_name');
          $compSplit     = explode('-',$compName);
          $fycode        = $datahead[0]->FY_CODE;
          $fiscalYr      = explode('-', $fycode); 
          $series_code   = $datahead[0]->SERIES_CODE; 
          $transDate     = $datahead[0]->VRDATE;
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
            
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
             <tr><td>&nbsp;</td></tr>
        
        </table>
        <table>
          <tr>

            <th>EQUIPMENT</th>
            <th>:</th>
            <td><?php echo $datahead[0]->EQP_CODE ?> - <?php echo $datahead[0]->EQP_NAME ?></td>
            <td>&nbsp;</td>
            <th>JOB TYPE</th>
            <th>:</th>
            <td><?php echo $datahead[0]->JOB_TYPE ?></td>
          </tr>
        </table>
      </td>

      <td  style="width: 50%;border-left: 1px solid lightgrey;padding-top: 10px;">
        <table>
         
          <tr>
            <th>DATE</th>
            <th>:</th>
            <td><?php echo $vr_Date;?></td>
          </tr>
          
          <tr>
            <th><?php echo $vrPName; ?></th>
            <th>:</th>
            <td><?php echo $fiscalYr[0].' '.$series_code.' '.$datahead[0]->VRNO; ?></td>
          </tr>
         
          <tr>
            <th>DOC TYPE</th>
            <th>:</th>
            <td> <?php echo $datahead[0]->SERIES_CODE?> - <?php echo $datahead[0]->SERIES_NAME?></td>
          </tr>
           <tr>
            <th>DEPARTMENT</th>
            <th>:</th>
            <td><?php echo $datahead[0]->DEPT_CODE ?> - <?php echo $datahead[0]->DEPT_NAME ?></td>
          </tr>
          <tr>
            <th>SR Code</th>
            <th>:</th>
            <td><?php echo $datahead[0]->SR_CODE ?> - <?php echo $datahead[0]->SR_NAME ?></td>
          </tr>
          
          <tr><td>&nbsp;</td></tr>
          <tr><td>&nbsp;</td></tr>

          <tr><td>&nbsp;</td></tr>
        </table>
      </td>
    </tr>
</table>

       <?php $rowCount = count($dataheadB); ?>

      <?php if($rowCount > 0)  { ?>
      <table id="InwardDispatch" class="table table-bordered" style="margin-bottom: 0px;">

        <thead class="theadC">

          <tr style="padding-top: 20%;text-align: center;">
            <th class="text-center" style="border-left: 1px solid lightgrey;font-size: 11px;width: 8px;">SR.NO</th>
            <th class="text-center" style="font-size: 11px;">ITEM DESCRIPTION</th>
            <th class="text-center" style="font-size: 11px;">QTY</th>
            <th class="text-center" style="font-size: 11px;">UM</th>
            <th class="text-center" style="font-size: 11px;">AQTY</th>
            <th class="text-center" style="font-size: 11px;">AUM</th>
            
          </tr>

        </thead>

        <tbody id="defualtSearch">

     
         
          <?php  $sum = 0; $bal=0; $sr_no=1; foreach($dataheadB as $key) {

            if($key->tablNme == 'JOBCARD_HEAD'){
              $qtyRecd = $key->QTYRECD;
              $perticular = $key->REMARK;
              $umCd = $key->UM;
              $aumCd = $key->AUM;
              }else{
                $qtyRecd='';
                $perticular='';
                $umCd='';
                $aumCd='';
              }

          
           ?>

            <tr style="padding-top: 20%;">
              <td class="table_highlight" style="border-left: 1px solid lightgrey;">{{ $sr_no}}</td>
              <td class="bodyTextS">{{$key->ITEM_NAME}} - {{$key->ITEM_CODE}}  <?php if($perticular){echo '[ '.$perticular.' ]';}?></td>
              
              <td class="bodyTextS" style="text-align: center;">{{ $qtyRecd }}</td>
              <td style="text-align: center;">{{ $umCd }}</td>
              <td class="bodyTextS" style="text-align: center;">{{ $key->AQTYRECD }}</td>
              <td style="text-align: center;">{{ $aumCd }}</td>
            
            </tr>

          <?php $sr_no++;$sum++; }   ?>

           <?php $getRow = 9 -$rowCount; for($q=0;$q<$getRow;$q++){ ?>
            <tr style="border:none;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;"><td >&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
          <?php } ?>
        
        </tbody>
          

        <!-- <tr class="list-item total-row">
            <th colspan="5" class="removeSpacetax"></th>
            <th colspan="3" class="tableitem removeSpacetax" style="text-align: left;"> Total</th>
            <td data-label="Grand Total" class="tableitem bodyTextS textRightS removeSpacetax">
              
            </td>
        </tr> -->

  </table>
  
<?php } ?>



  <?php $rowCount1 = count($dataheadB2); ?>

  <?php if($rowCount > 0 && $rowCount1 > 0) { ?>
  
      <br>

  <?php } ?>


<?php if($rowCount1 > 0) { ?>

<table class="table table-bordered" style="margin-bottom: 0px;">
    <tr>
      <th style="font-size: 11px;">SERVICE ITEM</th>
    </tr>
</table>

 <table id="InwardDispatch1" class="table table-bordered" style="margin-bottom: 0px;">

        <thead class="theadC">

          <tr style="padding-top: 20%;text-align: center;">
            <th class="text-center" style="border-left: 1px solid lightgrey;font-size: 11px;width: 8px;">SR.NO</th>
            <th class="text-center" style="font-size: 11px;">ITEM DESCRIPTION</th>
            <th class="text-center" style="font-size: 11px;">QTY</th>
            <th class="text-center" style="font-size: 11px;">UM</th>
            <th class="text-center" style="font-size: 11px;">AQTY</th>
            <th class="text-center" style="font-size: 11px;">AUM</th>
            
          </tr>

        </thead>

        <tbody id="defualtSearch">

     
          
          <?php  $sum1 = 0; $bal1=0; $sr_no1=1; foreach($dataheadB2 as $row) {

            if($row->tablNme == 'JOBCARD_HEAD'){
              $qtyRecd = $row->QTYRECD;
              $perticular = $row->REMARK;
              $umCd = $row->UM;
              $aumCd = $row->AUM;
              }else{
                $qtyRecd='';
                $perticular='';
                $umCd='';
                $aumCd='';
              }

          
           ?>

            <tr style="padding-top: 20%;">
              <td class="table_highlight" style="border-left: 1px solid lightgrey;">{{ $sr_no1}}</td>
              <td class="bodyTextS">{{$row->ITEM_NAME}} - {{$row->ITEM_CODE}}  <?php if($perticular){echo '[ '.$perticular.' ]';}?></td>
              
              <td class="bodyTextS" style="text-align: center;">{{ $qtyRecd }}</td>
              <td style="text-align: center;">{{ $umCd }}</td>
              <td class="bodyTextS" style="text-align: center;">{{ $row->AQTYRECD }}</td>
              <td style="text-align: center;">{{ $aumCd }}</td>
            
            </tr>

          <?php $sr_no1++;$sum1++; }   ?>

           <?php $getRow1 = 9 -$rowCount1; for($q=0;$q<$getRow1;$q++){ ?>
            <tr style="border:none;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;"><td >&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
          <?php } ?>
        
        </tbody>
          

        <!-- <tr class="list-item total-row">
            <th colspan="5" class="removeSpacetax"></th>
            <th colspan="3" class="tableitem removeSpacetax" style="text-align: left;"> Total</th>
            <td data-label="Grand Total" class="tableitem bodyTextS textRightS removeSpacetax">
              
            </td>
        </tr> -->

  </table>

<?php } ?>

<table class="table table-bordered" style="margin-bottom: 0px;">
  <tr>
    <th class="textRightS" style="font-size: 11px;">
      For <?php echo $compSplit[1];?>
      <br><br><br><br><br>
      Authorised Signatory

    </th>
  </tr>
</table>
<table class="table table-bordered" style="margin-bottom: 0px;">
  <tr>
    <th class="textCenterS" style="font-size: 11px;">
     
      <br><br><br><br><br>
      Service Engineer

    </th>
    <th class="textCenterS" style="font-size: 11px;">
     
      <br><br><br><br><br>
      HOD Maintainance
    </th>

    <th class="textCenterS" style="font-size: 11px;">
     
      <br><br><br><br><br>
      Department

    </th>
  </tr>
</table>

