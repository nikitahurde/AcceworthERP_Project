




<p class="modal-title modltitletext text-center" id="exampleModalLabel_" style="font-size:16px;text-align:center;margin:1">{{Session::get('company_name')}}</p>
<p style="font-size:16px;text-align:center; margin:0">{{$plant->ADD1}}{{$plant->ADD2}}{{$plant->ADD3}}</p>
<p style="font-size:16px;text-align:center; margin:0">Ph: {{$plant->PHONE1}}</p>
<p style="font-size:16px;text-align:center;">{{ $title }}</p>



<table style="width:100%;border-collapse: collapse;">
   <tr>
    <td>&nbsp;</td>
    <?php $example = explode('-', $data1[0]->FY_CODE); ?>
    <td style="text-align:right;padding:5px;width:50%;">Vr.No. : {{ $example[1] }} {{ $data1[0]->VRNO}} {{ $data1[0]->SERIES_CODE}}</td>
   </tr>
  
   <tr>
    <td style="">  </td>
    <td style="text-align:right;">Sales Tax :</td>
   </tr>
    
  
</table>

<table style="width:100%;border-collapse: collapse;">
  <tr>
    <td style="border:1px solid #a5a2a2;padding:5px;">SN</td>
    <td style="border:1px solid #a5a2a2; padding:5px;">ICODE  & PARTICULARS</td>
    <td style="border:1px solid #a5a2a2; padding:5px;">QTY. RECD</td>
    <td style="border:1px solid #a5a2a2; padding:5px;">AQTY. RECD</td>
  
  </tr>

<?php $sr=1; $AQTYRECD=0; $QTYRECVD = 0; foreach ($data1 as $key) {

    $QTYRECVD += $key->QTYRECD;
    $AQTYRECD += $key->AQTYRECD;
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
    <td style="border:1px solid #a5a2a2;padding:5px;">{{ $key->QTYRECD }} {{ $key->UM }}</td>
    <td style="border:1px solid #a5a2a2;padding:5px;">{{ $key->AQTYRECD }} {{ $key->AUM }}</td>
    
  </tr>

  <?php $sr++; } ?>
  <tr>
    <td colspan="2" style="border:1px solid #a5a2a2;padding:5px;text-align:left;">Total</td>
    <td style="border:1px solid #a5a2a2;padding:5px;">{{ number_format($QTYRECVD,3) }}</td>
    <td style="border:1px solid #a5a2a2;padding:5px;">{{ number_format($AQTYRECD,3) }}</td>
  </tr>
  
  

</table>




