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
  .removeSpace{
    padding-top: 1px;
    padding-left: 1px;
    padding-right: 1px;
    padding-bottom: 1px;
  }
  .borderLeftSide{
    border-left :1px solid lightgrey;
  }
  .fontBold{
    font-weight: bold;
  }
  .numberRight{
    text-align:right;
  }
  .textCenter{
    text-align:center;
  }
</style>

<table class="table table-bordered" style="margin-bottom: 0px;">
    <tr>
      <th style="text-align: center;font-size: 15px;"><?php if($titleName == 'LOADING PLAN'){echo 'LOADING PLAN';}else{echo 'LOADING SLIP';} ?></th>
    </tr>
</table>

<table class="table table_highlight">
  
  <tr class="table_highlight">

    <td class="removeSpaceLogo" style="width:15%;">
      <table>
          <tr>
            <td><img src="{{ asset('public/dist/img/MUKUNDGROUPLOGO.png') }}" style="width:75px;height:75px;" alt="job image" title="job image"></td>
          </tr>
      </table>
    </td>

    <td class="removeSpaceLogo" style="width:50%;">
        <table>
            <tr>
              <td class="removeSpaceLogo" style="font-size: 14px;font-weight: bold;"><?php echo $compDetail[0]->COMP_NAME ?></td>
            </tr>
            <tr>
              <td class="removeSpaceLogo" style="font-size: 12px;"><?php echo $compDetail[0]->ADD1 ?> <?php echo $compDetail[0]->ADD2 ?> <?php echo $compDetail[0]->ADD3 ?><?php echo ' '.$compDetail[0]->CITY_NAME.','.$compDetail[0]->DIST_NAME.','.$compDetail[0]->STATE_NAME.','.$compDetail[0]->PIN_CODE ?>
              </td>
            </tr>
            <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
            <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
        </table>
      </td>

      <td class="removeSpaceLogo" style="width: 35%;border-left: 1px solid lightgrey;">
        <table>

          <tr>
            <th class="removeSpace">Vehicle NO</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo ($dataheadB[0]->VEHICLE_NO) ? $dataheadB[0]->VEHICLE_NO : "----"; ?></td>
          </tr>
          <tr>
            <th class="removeSpace">Date</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo ($dataheadB[0]->VRDATE) ? date("d-m-Y", strtotime($dataheadB[0]->VRDATE)) : "----"; ?></td>
          </tr>
          <?php $fyCd = $dataheadB[0]->FY_CODE; $sliptFy = explode('-',$fyCd);  ?>
          <tr>
            <th class="removeSpace">Slip No</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $sliptFy[0].' '.$dataheadB[0]->SERIES_CODE.' '.$dataheadB[0]->VRNO ?></td>
          </tr>
          <tr>
            <th class="removeSpace">&nbsp;</th>
            <th class="removeSpace">&nbsp;</th>
            <td class="removeSpace">&nbsp;</td>
          </tr>
          
        </table>
      </td>

  </tr>
</table>

<table class="table table_highlight">
  <?php 
      $cpList = array(); 
      foreach($dataheadB as $rowc){ 
        $cpList[] = $rowc->CP_NAME;
      }
      $uniqCpCode= array_unique($cpList);
      $cpCodeList = implode(",", $uniqCpCode);
      
  ?>
  <tr class="table_highlight">
    <th style="width:10%;">Customer&nbsp;&nbsp; : </th>
    <?php if($titleName == 'LOADING PLAN'){ ?>
      <td style="width:90%;"><?php echo $cpCodeList; ?></td>
    <?php }else{ ?>
      <td style="width:90%;"><?php echo $dataheadB[0]->CP_NAME; ?>&nbsp;<?php echo $dataheadB[0]->TO_PLACE; ?></td>
    <?php } ?>
  </tr>
  <tr class="table_highlight">
    <th style="width:10%;">Transports : </th>
    <td style="width:90%;"><?php echo $dataheadB[0]->TRPT_NAME; ?></td>
  </tr>
</table>

<table class="table table_highlight">

  <tr class="table_highlight">
    <td>Driver Name : <?php echo $dataheadB[0]->DRIVER_NAME; ?></td>
    <td>Driver Id No. : <?php echo $dataheadB[0]->DRIVER_ID; ?></td>
    <td>Mobile No. : <?php echo $dataheadB[0]->MOBILE_NUMBER; ?></td>
  </tr>

</table>

<table class="table table_highlight">

  <tr class="table_highlight" T>
    <th class="table_highlight textCenter">Item</th>
    <th class="table_highlight textCenter">Description</th>
    <th class="table_highlight textCenter">Batch No.</th>
    <th class="table_highlight textCenter">Wagon No.</th>
    <th class="table_highlight textCenter">Quantity</th>
    <th class="table_highlight textCenter">UM</th>
    <th class="table_highlight textCenter">AQuantity</th>
    <th class="table_highlight textCenter">AUM</th>
    <th class="table_highlight textCenter">Load Qty</th>
    <th class="table_highlight textCenter">Location</th>
  </tr>

  <?php foreach($dataheadB as $row){ ?>
    <tr>
      <td class="table_highlight" style="width:15%;"><?php echo $row->ITEM_NAME; ?></td>
      <td class="table_highlight" style="width:15%;"><?php echo $row->REMARK; ?></td>
      <td class="table_highlight" style="width:12%;"><?php echo $row->BATCH_NO; ?></td>
      <td class="table_highlight" style="width:12%;"><?php echo $row->WAGON_NO; ?></td>
      <td class="table_highlight numberRight" style="width:9%;"><?php if($titleName == 'LOADING PLAN'){echo $row->QTY;}else{echo $row->QTY;} ?></td>
      <td class="table_highlight textCenter" style="width:5%;"><?php echo $row->UM; ?></td>
      <td class="table_highlight numberRight" style="width:9%;"><?php if($titleName == 'LOADING PLAN'){echo '';}else{echo $row->AQTY;} ?></td>
      <td class="table_highlight textCenter" style="width:5%;"><?php echo $row->AUM; ?></td>
      <td class="table_highlight numberRight" style="width:9%;">&nbsp;</td>
      <td class="table_highlight" style="width:9%;"><?php echo $row->LOCATION_NAME; ?></td>
    </tr>
  <?php } ?>

    <?php $rowCtn = count($dataheadB); 

    for ($i = $rowCtn; $i < 10; ++$i) {?>
      <tr style="border:none;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;">
      <td style="width:15%;">&nbsp;</td>
      <td style="width:15%;">&nbsp;</td>
      <td style="width:12%;">&nbsp;</td>
      <td style="width:12%;">&nbsp;</td>
      <td style="width:9%;">&nbsp;</td>
      <td style="width:5%;">&nbsp;</td>
      <td Style="width:9%;">&nbsp;</td>
      <td Style="width:5%;">&nbsp;</td>
      <td style="width:9%;">&nbsp;</td>
      <td style="width:9%;">&nbsp;</td>
    </tr>
    <?php }?>
    
</table>

<table style="width:100%;border-collapse: collapse;">
  <tr>
    <td style="font-size:12px;width:50%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">&nbsp;<br> Loaded by</td>
  
    <td style="font-size:12px;width:50%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;"><?php echo $dataheadB[0]->USER_NAME; ?><br>Prepared by</td>
  </tr>
</table>