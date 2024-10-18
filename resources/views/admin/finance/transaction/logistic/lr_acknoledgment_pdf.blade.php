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
.uparrow::before {
  content: '\F176';
  font-family: FontAwesome; 
  font-weight: 400;
  display: inline-block;
  vertical-align: middle;
  }

.downarrow::before {
  content: '\F175';
  font-family: FontAwesome; 
  font-weight: 400;
  display: inline-block;
  vertical-align: middle;
  
}
.element:before {
    content: "\f000";
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;
/*--adjust as necessary--*/
    color: #000;
    font-size: 18px;
    padding-right: 0.5em;
    position: absolute;
    top: 10px;
    left: 0;
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
        //  $partyDate     = $dataheadB[0]->PREFDATE;
         $pdfName = 'LR ACKNOWLEDGMENT';
         
           ?>
<table class="table partyDetail" style="margin-bottom: 0px;">
   <tr>
    <th style="font-size:15px;font-weight:bold;text-align:center;"><?php echo $compDetail[0]->COMP_NAME ?></th>
  </tr>
  <tr>
    <td style="text-align:center;"><?php echo $compDetail[0]->ADD1 ?> <?php echo $compDetail[0]->ADD2 ?> <?php echo $compDetail[0]->ADD3 ?><?php echo ' '.$compDetail[0]->CITY.' - '.$compDetail[0]->PIN_CODE.' '.$compDetail[0]->STATE_NAME ?></td>
   
  </tr>
  <tr> <th style="text-align: center;font-size: 15px;"> {{$pdfName}} </th></tr>
</table>
<table class="table table_highlight">
    
    <tr class="table_highlight">
      <td style="width: 50%;">
        <table>
              <tr>
                <td style="font-weight:bold;">To,</td>
              </tr>
              <tr>
                <td style="font-weight:bold;"><?php echo $dataheadB[0]->TRANSPORT_NAME; ?><?php if($transpoterDetails){ echo ','.$transpoterDetails[0]->CITY_NAME; }else{echo ' '; } ?> <?php if($transpoterDetails){ echo ' - '.$transpoterDetails[0]->PAN_NO; }else{echo ' '; } ?></td>
              </tr>
            
        </table>
      </td>

      <td  style="width: 50%;border-left: 1px solid lightgrey;">
        <table>
         
          <tr>
            <th class="removeSpace">Voucher No.</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $fiscalYr[0].' '.$series_code.' '.$dataheadB[0]->VRNO; ?></td>
          </tr>
          <tr>
            <th class="removeSpace">Voucher Date</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $vr_Date;?></td>
          </tr>
        
        </table>
      </td>
    </tr>
</table>

<table class="table table_highlight">
  <tr class="table_highlight" style="border-bottom: 1px solid white;">
    <th class="removeSpacetax">LR Details</th>
    <th class="removeSpacetax" style="text-align:center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vehicle No</th>
    <th class="removeSpacetax" style="text-align:right;"><?php echo $dataheadB[0]->VEHICLE_NO;?></th>
  </tr>
  
</table>





<table class="table table_highlight">
  <tr class="table_highlight">
    <td style="width:30%;border-right: 1px solid lightgrey;">
      <table>
        <tr>
          <td class="removeSpacetax">LR NO.</td>
          <td>:</td>
          <td class="removeSpacetax"><?= $dataheadB[0]->LR_NO ?></td>
        </tr>
         <tr>
          <td class="removeSpacetax">LR DATE</td>
          <td>:</td>

          <td class="removeSpacetax"><?= date("d-m-Y", strtotime($dataheadB[0]->LR_DATE));  ?></td>
         </tr>
         <tr>
          <td class="removeSpacetax">LR QTY</td>
          <td>:</td>
          <td class="removeSpacetax"><?php if($dataheadB[0]->QTY){echo $dataheadB[0]->QTY;}else{ echo '0.000'; } ?></td>
        </tr>
         <tr>
          <td class="removeSpacetax">SHORTAGE QTY</td>
          <td>:</td>
          <td class="removeSpacetax"><?= $dataheadB[0]->SHORTAGE_QTY ?></td>
        </tr>
         <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
         
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
         
        </tr>

      </table>
      
    </td>
    <td style="width:20%;border-right: 1px solid lightgrey;">
      <table>
        <tr>
          <td>ACK Date</td>
          <td>:</td>
          <td><?= date("d-m-Y", strtotime($dataheadB[0]->ACK_DATE));  ?></td>
        </tr>
        <tr>
          <td>Recv. Date</td>
          <td>:</td>
          <?php $ackdate =  date("d-m-Y", strtotime($dataheadB[0]->ACK_DATE)); 

                $transactiondate =  date("d-m-Y", strtotime($dataheadB[0]->ACK_VR_DATE));
           ?>

          <td><?php if($transactiondate){echo $transactiondate;}else{echo $ackdate;} ?></td>
         
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
         
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
         
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
         
        </tr>
       
       
      </table>
      
    </td>
     <?php  $trip_days = $dataheadB[0]->TRIP_DAY;

               $delivery_days = $dataheadB[0]->TRIP_DAY;

               $tripdelDay = $trip_days - $delivery_days;

          ?>

    <td style="width:50%;border-right: 1px solid lightgrey;">
      <table>
       
        <tr>
          <td>From Place</td>
          <td>:</td>
          <td><?= $dataheadB[0]->FROM_PLACE ?></td>
        </tr>
        <tr>
          <td>To Place</td>
          <td>:</td>
          <td><?= $dataheadB[0]->TO_PLACE ?> </td>
        </tr>
        <tr>
          <td>Actual Trip Days</td>
          <td>:</td>
          <td><?= $dataheadB[0]->TRIP_DAY ?></td>
        </tr>
        <tr>
          <td>Late Delivery Days</td>
          <td>:</td>
          <td><?= $tripdelDay ?></td>
        </tr>
       <tr>
          <td>Warai No</td>
          <td>:</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Warai Date</td>
          <td>:</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      
    </td>
  </tr>
 
</table>

<table class="table table_highlight">
    <tr class="table_highlight">
      <td style="width: 50%;border-right: 1px solid lightgrey;">
        <table>
          <tr style="border-bottom: 1px solid lightgrey;">

            <th>Paid Amount Details</th>
          </tr>
        </table>
      </td>
      <td style="width: 50%;">
        <table>
          <tr style="border-bottom: 1px solid lightgrey;">
            <th>Deduction Details</th>
          </tr>

        </table>
      </td>
    </tr>

  </table>


<table class="table table_highlight">
    <tr class="table_highlight">
      <td style="width: 50%;border-right: 1px solid lightgrey;">
        <table>
          <?php foreach($addDetails AS $row) { ?>
          <tr>
            <td><?php echo $row->DESCRIPTION ?></td>
            <td><?php echo $row->AMOUNT ?></td>
          </tr>

        <?php } ?>
          

        </table>
      </td>
      <td style="width: 50%;">
        <table>
          <?php foreach($deductionDetails AS $key) { ?>
          <tr>
            <td><?php echo $key->DESCRIPTION ?></td>
            <td><?php echo $key->AMOUNT ?></td>
          </tr>

        <?php } ?>
          

        </table>
      </td>
    </tr>

  </table>




<!-- <table class="table table-bordered">
  <tr>
    <th class="textRightS" style="font-size: 11px;">
      For < ?php echo $compSplit[1];?>
      <br><br><br><br><br>
      Authorised Signatory
    </th>
  </tr>
</table> -->

