
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

          $compName  = Session::get('company_name');
          $compSplit = explode('-',$compName);
          $fyCode    = $data030[0]->FY_CODE;
          $splitFy   = explode('-', $fyCode);
          $transDate =$data030[0]->VRDATE;

          $vr_Date       = date("d-m-Y", strtotime($transDate));
 ?>


<table class="table table_highlight">
    
    <tr class="table_highlight">
      <td>
        <table>
            <tr><td style="font-size: 12px;"><?php echo $compDetail[0]->COMP_NAME ?></td></tr>
            <tr><td style="font-size: 12px;"><?php echo $compDetail[0]->ADD1 ?> <?php echo $compDetail[0]->ADD2 ?> <?php echo $compDetail[0]->ADD3 ?></td></tr>
            
        </table>
      </td>

      <td style="width: 50%;border-left: 1px solid lightgrey;">
        <table>
          <tr>
            <th>VR. NO</th>
            <td>:</td>
            <td><?php echo $splitFy[0].' '.$data030[0]->SERIES_CODE.' '.$data030[0]->VRNO; ?></td>
          </tr>
          <tr>
            <th>DATE</th>
            <td>:</td>
            <td><?php echo $vr_Date; ?></td>
          </tr>
        </table>
      </td>
    </tr>
</table>
<table class="table table-bordered partyDetail" style="margin-bottom: 0px;">
    <tr>
      <th style="text-align: center;font-size: 13px;"> <?php echo strtoupper($data030[0]->SERIES_NAME); ?> VOUCHER </th>
    </tr>
</table>

<table id="InwardDispatch" class="table table-bordered" style="margin-bottom: 0px;">

    <thead class="theadC">

      <tr style="padding-top: 20%;text-align: center;">
        <th class="text-center" style="border-left: 1px solid lightgrey;font-size: 11px;width: 15px;">SR.NO</th>
        <th class="text-center" style="font-size: 11px;">ACC NAME / CODE</th>
        <th class="text-center" style="font-size: 11px;">DR AMT</th>
        <th class="text-center" style="font-size: 11px;">CR AMT</th>
      </tr>

    </thead>

    <tbody id="defualtSearch">

 
      <?php $rowCount = count($data030); ?>
      <?php $sr_no=1;$totalDr=0;$totalCr=0; foreach($data030 as $key) {
        $totalDr +=$key->DRAMT;
        $totalCr +=$key->CRAMT;
       ?>

        <tr style="padding-top: 20%;">



          <td class="table_highlight" style="border-left: 1px solid lightgrey;width: 15px;">{{ $sr_no}}</td>
          <td class="bodyTextS">{{ $key->ACC_NAME }} ( {{$key->ACC_CODE}} )<br>{{$key->PARTICULAR}}</td>
          <td class="bodyTextS textRightS">{{ $key->DRAMT }}</td>
          <td class="bodyTextS textRightS">{{ $key->CRAMT }}</td>
        </tr>

      <?php $sr_no++;}   ?>

      <?php $getRow = 9 -$rowCount; for($q=0;$q<$getRow;$q++){ ?>
        <tr style="border:none;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;"><td >&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
      <?php } ?>
    </tbody>
          

    <tr class="list-item total-row">
        <th colspan="2" class="tableitem removeSpacetax" style="text-align: left;"> Total</th>
        <td data-label="Grand Total" class="tableitem bodyTextS textRightS removeSpacetax">
         <?php $dr_amt = number_format((float)$totalDr, 2, '.', ''); echo $dr_amt; ?>
        </td>
        <td data-label="Grand Total" class="tableitem bodyTextS textRightS removeSpacetax">
         <?php $cr_amt = number_format((float)$totalCr, 2, '.', ''); echo $cr_amt; ?>
        </td>
    </tr>

</table>


<table style="width:100%;border-collapse: collapse;">
  <tr>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;"> Entered by</td>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Checked By</td>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Approved By </td>
    <td style="font-size:12px;width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Authorised Signatory</td>
  </tr>
</table>
 

