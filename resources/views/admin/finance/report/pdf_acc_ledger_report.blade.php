
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


<table class="table table_highlight">
    
    <tr class="table_highlight">

      <td class="removeSpaceLogo" style="width:10%;">
        <table>
            <tr><td><img src="{{ asset('public/dist/img/MUKUNDGROUPLOGO.png') }}" style="width:75px;height:75px;" alt="job image" title="job image"></td></tr>
        </table>
      </td>

      <td class="removeSpaceLogo" style="width:55%;">
        <table>
            <tr><td class="removeSpace" style="font-size: 14px;font-weight: bold;">{{Session::get('company_name')}}</td></tr>
            <tr><td class="removeSpace" style="font-size: 12px;"><?php echo $plant->ADD1 ?> <?php echo $plant->ADD2 ?> <?php echo $plant->ADD3 ?><?php echo ' '.$plant->CITY.' - '.$plant->PIN_CODE ?></td></tr>
        </table>
      </td>

      

    </tr>
</table>

<!-- <table class="table table-bordered partyDetail" style="margin-bottom: 0px;">
    <tr>
      <th style="text-align: center;font-size: 15px;"> Account Ledger </th>

        <div style="border: 1px solid #c1c1c140;padding-left: 5px;">

          <h6>{{Session::get('company_name')}}</h6>

          <p>{{ $plant->ADD1 }}{{ $plant->ADD2 }}{{ $plant->ADD3 }}</p>
          <p>{{$plant->CITY_CODE}} - {{$plant->PIN_CODE}}</p>
          <p>Phone No.- {{$plant->PHONE1}}</p>
          <p>GST NO - {{$plant->GST_NO}}</p>

        </div>
    </tr>
</table> -->
<table class="table table-bordered partyDetail" style="margin-bottom: 0px;">
   
    <tr>
      <th style="text-align: center;font-size: 13px;"> ACCOUNT LEDGER </th>
    </tr>
</table>

<table class="table table_highlight">
    
    <tr class="table_highlight">
      <td>
        <table>
           <tr>
            <th class="removeSpace">&nbsp;</th>
            <th class="removeSpace">&nbsp;</th>
            <td class="removeSpace">&nbsp;</td>
          </tr>
          
           <tr>
            <th class="removeSpace">ACC CODE </th>
            <th class="removeSpace">:</th>
            <?php if($data030[0]->tableName=='ACC_TRAN') { ?>
            <td class="removeSpace"><?php echo $data030[0]->acc_name;  echo '  ['.$data030[0]->acc_code.']'; ?></td>
            <?php } else if($data030[0]->tableName=='GL_TRAN') { ?>

               <td class="removeSpace"><?php echo $data030[0]->gl_name;  echo '  ['.$data030[0]->gl_code.']'; ?></td>
             <?php } ?>
          </tr>
          <tr>
            <th class="removeSpace">&nbsp;</th>

            <th class="removeSpace">&nbsp;</th>
            <td class="removeSpace">&nbsp;</td>
          </tr>
            
           <!--  <tr><td style="font-size: 12px;">Phone No.- {{$plant->PHONE1}}</td></tr> -->
            <!-- <tr><td>GST NO - {{$plant->GST_NO}}</td></tr> -->
        </table>
      </td>
      <td  style="width: 50%;border-left: 1px solid lightgrey;">
        <table>
           <tr>
            <th class="removeSpace">&nbsp;</th>
            <th class="removeSpace">&nbsp;</th>
            <td class="removeSpace">&nbsp;</td>
          </tr>
          
          <tr>
            <th class="removeSpace">From Date</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo date('d/m/Y',strtotime($data030[0]->FromDate)); ?></td>

            <th class="removeSpace">To Date</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo date('d/m/Y',strtotime($data030[0]->ToDate)); ?></td>
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

 <table id="InwardDispatch" class="table table-bordered" style="margin-bottom: 0px;">

        <thead class="theadC">

         

          <tr style="padding-top: 20%;text-align: center;">
            <th class="text-center" style="font-size: 11px;">Vr Date</th>
            <th class="text-center" style="font-size: 11px;">Vr no</th>
            <th class="text-center" style="font-size: 11px;">Particular</th>
            <th class="text-center" style="font-size: 11px;">Dr Amt</th>
            <th class="text-center" style="font-size: 11px;">Cr Amt</th>
            <th class="text-center" style="font-size: 11px;">Balance</th>
            <th class="text-center" style="font-size: 11px;">Bal Type</th>
            <th class="text-center" style="font-size: 11px;">Ref Code</th>
          </tr>

        </thead>

        <tbody id="defualtSearch">

          <?php $openingBal = $op_drAmt - $op_crAmt; ?>

          <?php $rowCount = count($data030); ?>
          <?php $opBalAmt=0; $totDrAmt =0;$totCrAmt=0;$sum = 0;$DrAmt=0; $bal=0; $CrAmt=0; $sr_no=1; foreach($data030 as $key) {

            $fyCode = $key->fy_code;
            $splitFy = explode('-',$fyCode);
            $startFyYr = $splitFy[0];

            if($sr_no == 1){

             $opBalAmt = $openingBal + $key->rDrAmt - $key->rCrAmt;
            }else{
              $hopAmt  = $opBalAmt;
              $opBalAmt = $opBalAmt + $key->rDrAmt - $key->rCrAmt;
            }

            $totDrAmt += $key->rDrAmt;
            $totCrAmt += $key->rCrAmt;
            $balTot   = $totDrAmt - $totCrAmt;

            if($opBalAmt >= 0){
              $balType = 'Dr';
            }else{
              $balType = 'Cr';
            }
           ?>

            <tr style="padding-top: 20%;">
              <td class="bodyTextS" style="width: 10%;"><?php echo date('d/m/Y',strtotime($key->VRDATE)); ?> </td>
              <td class="bodyTextS textRightS" style="width: 10%;"><?php echo $startFyYr.' '.$key->series_code.' '.$key->VRNO; ?></td>
              <td class="bodyTextS" style="width: 47%;">{{ $key->particular }}</td>
              <td class="bodyTextS textRightS" style="width: 7%;">{{ $key->DrAmt }}</td>
              <td class="bodyTextS textRightS" style="width: 7%;"> {{ $key->CrAmt }}</td>
              <td class="bodyTextS textRightS" style="width: 7%;"><?php echo number_format((float)$opBalAmt, 2, '.', ''); ?></td>
              <td style="width: 7%;text-align:center;">{{ $balType }}</td>
              <td class="bodyTextS" style="width: 5%;">{{ $key->REF_NAME }}</td>
            </tr>

          <?php $sr_no++;$sum++; }   ?>

            
        </tbody>
          
        <tr class="list-item total-row">
            <th colspan="1" style="border-right-color:white;" class="removeSpacetax"></th>
            <th colspan="3" class="tableitem removeSpacetax" style="text-align: left;"> Total</th>
            <td data-label="Grand Total" class="tableitem bodyTextS textRightS removeSpacetax">
             
              <?php echo number_format((float)$totDrAmt, 2, '.', ''); ?>
            </td>
            <td data-label="Grand Total" class="tableitem bodyTextS textRightS removeSpacetax">
             
             <?php echo $totCrAmt; ?>
            </td>
            <td data-label="Grand Total" class="tableitem bodyTextS textRightS removeSpacetax">
             
             <?php $bal_amt = number_format((float)$balTot, 2, '.', ''); echo $bal_amt; ?>
            </td>
            <td>&nbsp;</td>
        </tr>

      </table>

      <table class="table table-bordered">
        <tr>
          <th class="textRightS" style="font-size: 11px;">
            
            <?php $comp_name =   Session::get('company_name');

              $exp = explode('-', $comp_name);

              echo 'For ' .$exp[1];

            ?>
            <br><br><br><br><br>
            Authorised Signatory
          </th>
        </tr>
      </table>