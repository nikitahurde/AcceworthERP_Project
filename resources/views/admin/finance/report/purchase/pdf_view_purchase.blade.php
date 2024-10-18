




<p class="modal-title modltitletext text-center" id="exampleModalLabel_" style="font-size:16px;text-align:center;margin:1">{{Session::get('company_name')}}</p>
<p style="font-size:16px;text-align:center; margin:0">{{$plant->ADD1}}{{$plant->ADD2}}{{$plant->ADD3}}</p>
<p style="font-size:16px;text-align:center; margin:0">Ph: {{$plant->PHONE1}}</p>
<p style="font-size:16px;text-align:center;">{{ $title }}</p>



<table style="width:100%;border-collapse: collapse;">
   <tr>
    <td style="padding:5px;width:50%;">{{$party[0]->ACC_NAME}}</td>

    <?php $example = explode('-', $data1[0]->FY_CODE); ?>
    <td style="text-align:right;padding:5px;width:50%;">Vr.No. : {{ $example[1] }} {{ $data1[0]->VRNO}} {{ $data1[0]->SERIES_CODE}}</td>
   </tr>
   <tr>
    <td style="">Pty Bill :  {{ $data1[0]->PARTYBILLNO}} </td>
    <td style="text-align:right;">Date : </td>
   </tr>
   <tr>
    <td style=""> Dt. {{ $data1[0]->PARTYBILLDATE}}</td>
    <td style="text-align:right;">Sales Tax :</td>
   </tr>
    
  
</table>

<table style="width:100%;border-collapse: collapse;">
  <tr>
    <td style="border:1px solid #a5a2a2;padding:5px;">SN</td>
    <td style="border:1px solid #a5a2a2; padding:5px;">ICODE  & PARTICULARS</td>
    <td style="border:1px solid #a5a2a2; padding:5px;">QTY. RECD</td>
    <td style="border:1px solid #a5a2a2; padding:5px;">RATE</td>
    <td style="border:1px solid #a5a2a2;padding:5px; ">AMOUNT</td>
  </tr>

<?php $sr=1; $Amt = 0; foreach ($data1 as $key) {

    $Amt += $key->BASICAMT;
 ?>
  
  <tr style="height:400px;">
    <td style="border:1px solid #a5a2a2;padding:5px;"><?= $sr; ?></td>
    <td style="border:1px solid #a5a2a2;padding:5px;">
      <table style="width:100%;" cellspacing="0">
                        <tr style="padding:5px;margin:0;">
                              <td class="child" style="width:70px;font-size:15px;">
                                    {{ $key->ITEM_CODE}} </td>
                              <td class="child" >{{ $key->ITEM_NAME }}</td>
                        </tr>
            </table>
    </td>
    <td style="border:1px solid #a5a2a2;padding:5px;">{{ $key->QTYRECD }}</td>
    <td style="border:1px solid #a5a2a2;padding:5px;">{{ $key->RATE  }}</td>
    <td style="border:1px solid #a5a2a2;padding:5px;">{{ $key->BASICAMT }}</td>
  </tr>

  <?php $sr++; } ?>
  <tr>
    <td colspan="4" style="border:1px solid #a5a2a2;padding:5px;text-align:left;">Sub Total</td>
    <td style="border:1px solid #a5a2a2;">{{ number_format($Amt,2) }}</td>
  </tr>
  
  <tr>
    <td colspan="2" style="border:1px solid #a5a2a2;padding:5px;">
          
      </td>
    <td colspan="2" style="border:1px solid #a5a2a2;padding:5px;">
       <table style="width:100%;" cellspacing="0">
                    
                        <tr style="padding:5px;margin:0;">
                              <td>CGST : </td>
                        </tr>
                        <tr style="padding:5px;margin:0;">
                              <td>SGST : </td>
                        </tr>
            </table>
       
    </td>
    <td style="border:1px solid #a5a2a2;padding:5px;">
      <table style="width:100%;" cellspacing="0">
                    
                        <tr style="text-align:right;">
                              <td> </td>
                        </tr>
                        <tr style="text-align:right;">
                              <td> </td>
                        </tr>
            </table>
    </td>
  </tr>

  <tr>
    <td colspan="4" style="border:1px solid #a5a2a2;padding:5px;">Rupees : {{ $numwords }} </td>
    <td style="border:1px solid #a5a2a2;padding:5px;"></td>
  </tr>

  
</table>
<!-- <table style="width:100%;border-collapse: collapse;">
  <tr>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;"> Entered by</td>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Checked By</td>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Approved By </td>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Authorised Signatory</td>
  </tr>
</table> -->
 


