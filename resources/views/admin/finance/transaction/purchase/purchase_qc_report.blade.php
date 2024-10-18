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

      <td style="width: 50%;border-left: 1px solid lightgrey;">
        <table>
          <tr>
            <th>DATE</th>
            <td>:</td>
            <td><?php echo $vr_Date;?></td>
          </tr>
          <tr>
            <th>ENQUIRY NO</th>
            <td>:</td>
            <td><?php echo $dataheadB[0]->RFQNO;?> </td>
          </tr>
        </table>
      </td>
    </tr>
</table>

<!--   <section class="content"> -->

    <!-- <div class="box box-primary Custom-Box"> -->

      <table id="InwardDispatch" class="table table-bordered" style="margin-bottom: 0px;">

        <thead class="theadC">

          <tr style="padding-top: 20%;text-align: center;">
            <th class="text-center" style="border-left: 1px solid lightgrey;font-size: 11px;width: 10px;">SR.NO</th>
            <th class="text-center" style="font-size: 11px;">ITEM DESCRIPTION</th>
            <th class="text-center" style="font-size: 11px;">QTY</th>
            <th class="text-center" style="font-size: 11px;">PARTY</th>
            <th class="text-center" style="font-size: 11px;">RATE</th>
            <th class="text-center" style="font-size: 11px;">BASIC</th>
            <th class="text-center" style="font-size: 11px;">CREDIT</th>
            <th class="text-center" style="font-size: 11px;">LEVEL</th>
          </tr>

        </thead>

        <tbody id="defualtSearch">
          <?php $rowCount = count($dataheadB); ?>
          <?php  $sum = 0; $bal=0; $sr_no=1; foreach($dataheadB as $key) {?>

            <tr style="padding-top: 20%;">
              <td class="table_highlight" style="border-left: 1px solid lightgrey;width:7%;">{{ $sr_no}}</td>
              <td class="bodyTextS" style="width:19%;">{{$key->ITEM_NAME}}  <?php if($key->PARTICULAR == 'null'){}else{echo '[ '.$key->PARTICULAR.' ]';}?></td>
              <td class="bodyTextS textRightS" style="width:10%;">{{ $key->QTYRECD }}</td>
              <td class="bodyTextS" style="width:17%;"><?php echo $key->ACC_NAME;?> [ <?php echo $key->ACC_CODE;?> ] </td>
              <td class="bodyTextS textRightS" style="width:11%;">{{ $key->RATE }}</td>
              <td class="bodyTextS textRightS" style="width:14%;"> {{$key->BASICAMT}}</td>
              <td class="bodyTextS textRightS" style="width:14%;">{{$key->CRAMT}}</td>
              <td class="bodyTextS textRightS" style="width:8%;">{{$key->LEVEL}}</td>
       
            </tr>

          <?php $sr_no++;$sum++; }   ?>
          <?php $getRow = 12 -$rowCount; for($q=0;$q<$getRow;$q++){ ?>
            <tr style="border:none;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;"><td >&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
          <?php } ?>
        </tbody>
          
      </table>

    <!-- </div> -->

 <!--  </section> -->

<!-- </div> -->

<table class="table table_highlight">
  <tr>
    <th> NOTE : </th>
  </tr>
  
</table>
<table style="width:100%;margin-bottom: 0px;">
  <tr>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;"> Entered by
    </td>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Checked By
    </td>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Approved By 
    </td>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Authorised Signatory</td>
  </tr>
</table>

<!-- <table style="width:100%;margin-bottom: 0px;">
  <tr>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;"> Entered by
    </td>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Checked By
    </td>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Approved By 
    </td>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Authorised Signatory</td>
  </tr>
</table> -->