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
  .headingStyle{
    border-bottom: 1px solid lightgrey;
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
          $compSplit     = explode('-',$compName);
    
          $transDate     = $dataheadB[0]->VRDATE;
          $vr_Date       = date("d-m-Y", strtotime($transDate));
        //  $partyDate     = $dataheadB[0]->PREFDATE;
         $pdfName = 'ADHOC ADVANCE SLIP';
         
           ?>
<table class="table table-bordered partyDetail" style="margin-bottom: 0px;">
    <tr>
      <th style="text-align: center;font-size: 15px;"> {{$pdfName}} </th>
    </tr>
</table>
<table class="table table_highlight">
    
    <tr class="table_highlight">

      <td class="removeSpaceLogo" style="width:15%;">
      <table>
          <tr>
            <td>
               <?php if($compDetail[0]->LOGO) { ?>
                      <img src= "{{ URL::asset('public/dist/img') }}/<?= $compDetail[0]->LOGO ?>" style="width:50px;height:50px" value="{{ URL::asset('public/dist/img/<?= $compDetail[0]->LOGO ?>') }}" style="width:75px;height:75px;"/>
               <?php  } else{ ?>
                  <img src="{{ asset('public/dist/img/MUKUNDGROUPLOGO.png') }}" style="width:75px;height:75px;" alt="job image" title="job image"></td>
               <?php } ?>

             
          </tr>
          <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
            <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
      </table>
    </td>

      <td style="width: 70%;">
        <table>
            <tr><td style="font-size:15px;font-weight:bold;"><?php echo $compDetail[0]->COMP_NAME ?></td></tr>
            <tr><td><?php echo $compDetail[0]->ADD1 ?> <?php echo $compDetail[0]->ADD2 ?> <?php echo $compDetail[0]->ADD3 ?><?php echo ' '.$compDetail[0]->CITY.' - '.$compDetail[0]->PIN_CODE.' '.$compDetail[0]->STATE_NAME ?></td></tr>

            <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
            <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
            <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>

        </table>
      </td>

      <td  style="width: 30%;border-left: 1px solid lightgrey;">
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
            <th class="removeSpace">Slip Date</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $vr_Date;?></td>
          </tr>
            <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
            <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
            <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
           
        </table>
      </td>
    </tr>
</table>

<table class="table table_highlight">
  <tr class="table_highlight" style="border-bottom: 1px solid white;">
    <th class="removeSpacetax">Driver</th>
    <th class="removeSpacetax">Vehicle</th>
    <th class="removeSpacetax">Mobile No</th>
  </tr>
  <tr class="table_highlight">
    <td style="width: 19%;" class="removeSpacetax"><?= $dataheadB[0]->EMP_NAME;  ?></td>
    <td style="width: 16%;" class="removeSpacetax"><?= $dataheadB[0]->VEHICLE_NO; ?></td>
    <td style="width: 17%;" class="removeSpacetax"><?= $dataheadB[0]->MOBILE_NO; ?></td>
    
  </tr>
 
</table>



<table class="table table_highlight">
        <tr class="table_highlight">
          <th style="font-size:13px;" class="textCenter">Bank Code</th>
          <th style="border-left: 1px solid lightgrey;font-size:13px;" class="textCenter">Bank Name</th>
          <th style="border-left: 1px solid lightgrey;font-size:13px;" class="textCenter">Diesel</th>
          <th style="border-left: 1px solid lightgrey;font-size:13px;" class="textCenter">Cash</th>
          <th style="border-left: 1px solid lightgrey;font-size:13px;" class="textCenter">Amount</th>
        </tr>

        <?php $pmtamt=0; foreach($dataheadB as $row) { 

            $pmtamt += $row->PAYMENT;
          ?>
        <tr>
          <td style="width:40%;font-size:13px;" class="textCenter"><?= $row->BANK_CODE; ?></td>
          <td style="width:20%;border-left: 1px solid lightgrey;font-size:13px;" ><?= $row->BANK_NAME; ?></td>
          <td style="width:20%;border-left: 1px solid lightgrey;font-size:13px;" class="textRightS"><?= $row->DIESEL_AMT; ?></td>
          <td style="width:20%;border-left: 1px solid lightgrey;font-size:13px;" class="textRightS"><?= $row->CASH_AMT; ?></td>
          <td style="width:20%;border-left: 1px solid lightgrey;font-size:13px;" class="textRightS"><?= $row->PAYMENT; ?></td>
        </tr>

      <?php } ?>



      <tr class="list-item total-row">
            <th  class="removeSpacetax" style="border-top: 1px solid lightgrey;"></th>
            <th  class="removeSpacetax" style="border-top: 1px solid lightgrey;"></th>
            <th  class="removeSpacetax" style="border-top: 1px solid lightgrey;"></th>
            <th class="tableitem removeSpacetax" style="text-align: left;border-top: 1px solid lightgrey;border-left: 1px solid lightgrey;font-size:13px;"> Total</th>
            <td style="border-left: 1px solid lightgrey;border-top: 1px solid lightgrey;font-size:13px;" data-label="Grand Total" class="tableitem  textRightS removeSpacetax">
              <?php $total_pmtamt = number_format((float)$pmtamt, 2, '.', ''); echo $total_pmtamt; ?>
            </td>
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

