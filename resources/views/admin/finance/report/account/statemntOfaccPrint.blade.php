<style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even) {
    background-color: #dddddd;
  }
  .textSize{
    font-size:10px;
  }
  .textAmtRight{
    text-align:right;
  }
</style>

<style>
@page { size: auto;  margin: 0mm; }
</style>

<?php for($i=0;$i<count($AllAccData);$i++){ 

  $opbBalAmt = $getAccOpng[$i][0]->BAL;
  $hidnOpngBal = 0;

  ?>

  <div style="text-align:center;margin-top: 20px;"><?php echo $compName;?><br>STATEMENT OF ACCOUNT<br>FOR ACCOUNT YEAR <?php echo $macc_year; ?></div>


  <div style="margin-top:25px;"><?php echo $allDataGet[$i][0]->ACC_NAME; ?></div>
  <div style="margin-top:1px;"><?php echo $accAddres[$i]->ADD1; ?></div>
  <div style="margin-bottom:25px;">Dear Sir/s</div>

  <center><div>Sub : Confirmation of Accounts for <?php echo $macc_year; ?></div></center>
  <div>We shall thank you to confirm & certify the following transactions as the same is required by us for Income Tax purposes.Please return it to us in two copies, duly signed by you mentioning your Income Tax PAN or GIR No. , Ward & Circle.</div>


  <table>

    <tr>
      <th class="textSize">DATE</th>
      <th class="textSize">PARTICULARS</th>
      <th class="textSize">VOUCH-REF</th>
      <th class="textSize">DEBIT (DR)</th>
      <th class="textSize">CREDIT (CR)</th>
      <th class="textSize">BALANCE</th>
    </tr>

    <tr>
      <td class="textSize"> <?php echo date('d-m-Y',strtotime($getAccOpng[$i][0]->yropDate)) ?> </td>
      <td class="textSize">OPENING BALANCE</td>
      <td class="textSize"> ---- </td>
      <td class="textSize textAmtRight"> <?php echo $getAccOpng[$i][0]->dramt; ?> </td>
      <td class="textSize textAmtRight"> <?php echo $getAccOpng[$i][0]->CrAmt; ?> </td>
      <td class="textSize textAmtRight"><?php echo $opbBalAmt; ?></td>
    </tr>
    <?php for($j=0;$j<count($allDataGet[$i]);$j++){ $slNo=$j + 1; ?>

      <?php 
        $vrDate          = date('d-m-Y',strtotime($allDataGet[$i][$j]->VRDATE));
        $perticular_text = $allDataGet[$i][$j]->particular;
        $accCode         = $allDataGet[$i][$j]->acc_code;
        $accName         = $allDataGet[$i][$j]->ACC_NAME;
        $drAmnt          = $allDataGet[$i][$j]->DrAmt;
        $crAmnt          = $allDataGet[$i][$j]->CrAmt;
        $rdrAmnt          = $allDataGet[$i][$j]->rDrAmt;
        $rcrAmnt          = $allDataGet[$i][$j]->rCrAmt;


        $fyCode          = $allDataGet[$i][$j]->fy_code;
        $splitFyCd       = explode('-',$fyCode);
        $fyStartYr       = $splitFyCd[0];
        $seriesCode      = $allDataGet[$i][$j]->series_code;
        $vrNo            = $allDataGet[$i][$j]->VRNO;

        $voucherRef      = $fyStartYr.' '.$seriesCode.' '.$vrNo;
             
      ?>

      <tr>
        <td class="textSize" style="width:10%;"> <?php echo $vrDate; ?> </td>
        <td class="textSize" style="width:42%;"> <?php echo $perticular_text; ?> </td>
        <td class="textSize" style="width:12%;"> <?php echo $voucherRef; ?> </td>
        <td class="textSize textAmtRight" style="width:12%;"><?php echo $drAmnt; ?></td>
        <td class="textSize textAmtRight" style="width:12%;"><?php echo $crAmnt; ?></td>
        <td class="textSize textAmtRight" style="width:12%;"> <?php if($slNo == 1){ 

                $oldOpngVal =$opbBalAmt;
                $newOpngBal = $oldOpngVal + $rdrAmnt - $rcrAmnt;

                $hidnOpngBal = $newOpngBal;

              }else{

                 $newOpngBal1 = $hidnOpngBal;
                 $newOpngBal = $newOpngBal1 + $rdrAmnt - $rcrAmnt;
                 $hidnOpngBal = $newOpngBal; 

              }

              $str1 = substr($newOpngBal, 1);
              echo $str1;
            ?> 
        </td>
      </tr>

    <?php } ?>

  </table>

  <div style="text-align:right;margin-top:10px;">For <?php echo $compName;?></div>
  <div>&nbsp;</div>
  <div>&nbsp;</div>
  <div style="text-align:right;">Authorised Signatory</div>
  <div style="border:1px solid lightgrey;border-style: dashed;margin-top:10px;"></div>
  <div style="text-align:center;margin-top:10px;">CONFIRMATION</div>

  <div style="margin-top:10px;">I/We hereby confirm & certify that the above statement is correct as per my/our book of a/c.</div>
  <div>Further note that my/our GIR/PAN No.is ____________________  Ward/Circle is _________________</div>

  <div style="margin-top:20px;">for <?php echo $allDataGet[$i][0]->ACC_NAME; ?> (Pl. Affix Stamp & Signature)</div>

  <div style="margin-top:50px;">Date : ______________ Place : _________________</div>

  <div style="page-break-after: always;"></div>
<?php } ?>


<script>
    var mediaQueryList = window.matchMedia('print');
    mediaQueryList.addListener(function(mql) {
      if ((mql.matches)) {
        console.log('before');
      }else{
        
        var link = window.location.href;
        var getseperate = link.split('/');

        var folderName = getseperate[0]+'//'+getseperate[2]+'/'+getseperate[3];
     
        window.parent.location = folderName+"/report-statement-of-acc";

      }
    });
  </script>