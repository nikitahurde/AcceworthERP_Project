
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

<div style="border: 1px solid #c1c1c140;padding-left: 5px;text-align: center;">

  <h5 style="font-weight: bold;">ITEM LEDGER</h5>
  <h6>{{Session::get('company_name')}}</h6>

  <p>{{ $plant->ADD1 }}{{ $plant->ADD2 }}{{ $plant->ADD3 }}</p>
  <p>{{$plant->CITY}} - {{$plant->PIN_CODE}}</p>
  

</div>


<!-- <table class="table table-bordered partyDetail" style="margin-bottom: 0px;">
    <tr>
      <th style="text-align: center;font-size: 15px;"> Account Ledger </th>

        <div style="border: 1px solid #c1c1c140;padding-left: 5px;">

          <h6>{{Session::get('company_name')}}</h6>

          <p>{{ $plant->ADD1 }}{{ $plant->ADD2 }}{{ $plant->ADD3 }}</p>
          <p>{{$plant->CITY}} - {{$plant->PIN_CODE}}</p>
          <p>Phone No.- {{$plant->PHONE1}}</p>
          <p>GST NO - {{$plant->GST_NO}}</p>

        </div>
    </tr>
</table> -->

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
            <th class="removeSpace">ITEM CODE </th>
            <th class="removeSpace">:</th>
          
            <td class="removeSpace"><?php echo $data030[1]->ITEM_NAME; echo '  ['.$data030[1]->ITEM_CODE.']'; ?></td>
            
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
            <td class="removeSpace"><?php echo $data030[1]->FromDate; ?></td>

            <th class="removeSpace">To Date</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo $data030[1]->ToDate; ?></td>
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
            <th class="text-center" style="border-left: 1px solid lightgrey;font-size: 11px;">SR.NO</th>
            <th class="text-center" style="font-size: 11px;">Vr Date</th>
            <th class="text-center" style="font-size: 11px;">Vr no</th>
            <th class="text-center" style="font-size: 11px;">Particular</th>
            <th class="text-center" style="font-size: 11px;">Bal Type</th>
            <th class="text-center" style="font-size: 11px;">QTYRECD</th>
            <th class="text-center" style="font-size: 11px;">QTYISSUED</th>
            <th class="text-center" style="font-size: 11px;">Balance</th>
            <th class="text-center" style="font-size: 11px;">CLSVAL</th>
          </tr>

        </thead>

        <tbody id="defualtSearch">




      
          <?php $rowCount = count($data030); ?>
          <?php  $sum = 0;$QTYRECD=0; $bal=0; $QTYISSUED=0;$CLSVAL=0; $sr_no=1; foreach($data030 as $key) {

            if($key->QTYRECD){
             
              $QTYRECD += $key->QTYRECD;
            }else{
              /*$dr =  str_replace(',', '', $key->DrAmt);*/
              // $CrAmt = number_format((float)$key->CrAmt, 2, '.', '');

              $QTYISSUED += $key->QTYISSUED;
            }

              $clval = $key->CLVAL;
              $bl =  $key->balence;
              
              
              $bal += $bl;
              $CLSVAL += $clval;

             
           ?>




            <tr style="padding-top: 20%;">
              <td class="table_highlight" style="border-left: 1px solid lightgrey;">{{ $sr_no}}</td>
              <td class="bodyTextS">{{$key->VRDATE}} </td>
              <td class="bodyTextS textRightS">{{ $key->VRNO }}</td>
              <td class="bodyTextS">{{ $key->PARTICULAR }}</td>
              <td>{{ $key->BalType }}</td>
              <td class="bodyTextS textRightS">{{ $key->QTYRECD }}</td>
              <td class="bodyTextS textRightS"> {{ $key->QTYISSUED }}</td>
              <td class="bodyTextS textRightS">{{ $key->balence }}</td>
              <td class="bodyTextS">{{ $key->CLVAL }}</td>
       
            </tr>

          <?php $sr_no++;$sum++; }   ?>

         
           <?php $getRow = 9 -$rowCount; for($q=0;$q<$getRow;$q++){ ?>
            <tr style="border:none;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;"><td >&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
          <?php } ?>
          
        </tbody>
          

        <tr class="list-item total-row">
            <th colspan="2" style="border-right-color:white;" class="removeSpacetax"></th>
            <th colspan="3" class="tableitem removeSpacetax" style="text-align: right;"> Total</th>
            <td data-label="Grand Total" class="tableitem bodyTextS textRightS removeSpacetax">
             
              <?php $qtyRecd = number_format((float)$QTYRECD, 2, '.', ''); echo $qtyRecd; ?>
            </td>
            <td data-label="Grand Total" class="tableitem bodyTextS textRightS removeSpacetax">
             
              <?php $qtyIssued = number_format((float)$QTYISSUED, 2, '.', ''); echo $qtyIssued; ?>
            </td>
            <td data-label="Grand Total" class="tableitem bodyTextS textRightS removeSpacetax">
             
             <?php $bal_amt = number_format((float)$bal, 2, '.', ''); echo $bal_amt; ?>
            </td>
            <td data-label="Grand Total" class="tableitem bodyTextS textRightS removeSpacetax">
             
             <?php $cl_val = number_format((float)$CLSVAL, 2, '.', ''); echo $cl_val; ?>
            </td>
            
            
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