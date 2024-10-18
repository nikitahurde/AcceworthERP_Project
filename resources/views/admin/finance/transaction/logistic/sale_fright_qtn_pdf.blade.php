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
    padding:13px;
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
    <th style="text-align: center;font-size: 15px;"><?php echo $titleName; ?></th>
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

      <td class="removeSpaceLogo" style="width:50%;">
        <table>
          <tr>
            <td class="removeSpaceLogo" style="font-size: 14px;font-weight: bold;"><?php echo $compDetail[0]->COMP_NAME ?></td>
          </tr>
          <tr>
            <td class="removeSpaceLogo" style="font-size: 12px;"><?php echo $compDetail[0]->ADD1 ?> <?php echo $compDetail[0]->ADD2 ?> <?php echo $compDetail[0]->ADD3 ?><?php echo ' '.$compDetail[0]->CITY.','.$compDetail[0]->DIST.','.$compDetail[0]->STATE.','.$compDetail[0]->PIN_CODE ?>
          </td>
          </tr><?php
          $ph1 = $compDetail[0]->PHONE1;
          $ph2 = $compDetail[0]->PHONE2;

          if($ph2){
            $phone = $ph1.','.$ph2;
          }else{
            $phone = $ph1;
          }

          ?>
          <tr class="removeSpaceLogo"><td>Phone : <?php echo $phone; ?> </td></tr>
          <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
          <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
        </table>
      </td>

      <td class="removeSpaceLogo" style="width: 35%;border-left: 1px solid lightgrey;">
        <table>


          <?php foreach($dataheadB  as $row){ ?>

            <?php $dt = $row->VRDATE;
            if($dt){


              $do_date = date('d-m-Y',strtotime($dt));
            }else{
              $do_date = '';
            }
            ?>



            <?php $dt = $row->REF_DATE;
            if($dt){
              $do_date = date('d-m-Y',strtotime($dt));
            }else{
              $do_date = '';
            }

            ?>




            <?php $fy_yr = $dataheadB[0]->FY_CODE;
            if($fy_yr){
              $getfy_yr = explode('-',$fy_yr);
            }else{
              $getfy_yr= '';
            }


            $series = $dataheadB[0]->SERIES_CODE;
            $vrno =  $dataheadB[0]->VRNO;

            if($fy_yr!='' && $series!='' && $vrno !=''){

              $seriescode = $getfy_yr[0].'/'.$series.'/'.$vrno;
            }else{
              $seriescode = '';
            }


            ?>

          <?php } ?>
          <tr>
            <!-- <th class="">Quotation.No : </th> -->
            <td style="font-weight:bold;">Quotation.No</td>
            <td>:</td>
            <td style="font-weight:bold;"><?php echo $seriescode; ?></td>
          </tr>

          <tr>
            <th class="removeSpace">Quatation Date</th>
            <th class="removeSpace">:</th>
            <td class="removeSpace"><?php echo ($dataheadB[0]->VRDATE) ? date("d-m-Y", strtotime($dataheadB[0]->VRDATE)) : "----"; ?></td>
          </tr>



          <tr>
            <!-- <th class="removeSpace">Ref No:  <?php echo $dataheadB[0]->REF_NO; ?></th>  -->
            <td style="font-weight:bold;">Ref No</td>
            <td>:</td>
            <td><?php echo $dataheadB[0]->REF_NO; ?></td>
          </tr>

          <tr>
            <!-- <th class="removeSpace">Ref Date:  < ?php echo $dataheadB[0]->REF_DATE; ?></th>  -->
            <?php $refdt = $dataheadB[0]->REF_DATE;
            if($refdt){
              $reference_dt =   date("d-m-Y", strtotime($refdt));
            }else{
              $reference_dt =   date("d-m-Y", strtotime($refdt));
            }
            ?>
            <td style="font-weight:bold;">Ref Date</td>
            <td>:</td>
            <td><?php echo $reference_dt; ?></td>
          </tr>



<!-- <th class="removeSpace">:</th>
  <td class="removeSpace"></td> -->
<!--   </tr>
<tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
<tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
<tr class="removeSpaceLogo"><td>&nbsp;</td></tr> -->

</table>
</td>

</tr>
</table>

<table class="table table_highlight">

  <tr class="table_highlight">
    <style>
      
    </style>

    <td style="width:50%;">
      <table>

        <tr>
          <th class="removeSpace fontBold">To,</th>
        </tr>

        <tr>
          <td class="removeSpace fontBold"><?php echo $dataAccDetail[0]->ACCNAME; ?></td>
        </tr>
        <tr>
          <td class="removeSpace"><?php echo $dataAccDetail[0]->ADD1.' '.$dataAccDetail[0]->CITY_NAME.' '.$dataAccDetail[0]->DIST_NAME.' '.$dataAccDetail[0]->STATE_NAME.' '.$dataAccDetail[0]->PIN_CODE; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">GST NO : <?php echo ($dataAccDetail[0]->GST_NUM) ? $dataAccDetail[0]->GST_NUM : "----"; ?></td>
        </tr>
        <tr>
          <td class="removeSpace">PAN NO : <?php echo ($dataAccDetail[0]->PAN_NO) ? $dataAccDetail[0]->PAN_NO : "----"; ?></td>
        </tr>
       
      </table>
    </td>
    
    
  </tr>
  
</table>


<table class="table table_highlight">
  <?php 
  $cpList = array(); 

  $uniqCpCode= array_unique($cpList);
  $cpCodeList = implode(",", $uniqCpCode);

  ?>
<!--  <tr class="table_highlight">
<th style="width:10%;">Customer&nbsp;&nbsp; : </th>
<
<td style="width:90%;">< ?php echo $cpCodeList; ?></td>

<td style="width:90%;"></td>

</tr> -->
<!-- <tr class="table_highlight">
<th style="width:10%;">Transports : </th>
<td style="width:90%;"></td>
</tr> -->
</table>


<table class="table table_highlight">

  <tr class="table_highlight" style="text-align:left;">

    <td><p style="font-size: 11;font-weight:bold;">&nbsp; Subject :- Quotation for transportation of material.</p> <br>

      <p style="font-size: 11;"> &nbsp;Dear Sir,</p>

      <p style="font-size: 11;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;As per the above mentioned Subject we are pleased to quote our lowest Rates.</p><br><br>

    </td>


  </tr>

</table>



<table class="table table_highlight">
  <tr>
<!-- <th class="table_highlight textCenter"></th>
<th class="table_highlight textCenter"></th>
<th class="table_highlight textCenter"></th>
<th class="table_highlight textCenter"></th> -->


</tr>
<tr class="table_highlight">
  <th class="table_highlight textCenter" rowspan="2">Sr No.</th>
  <th class="table_highlight textCenter" rowspan="2">From(Source)<br>vehical type</th>
  <th class="table_highlight textCenter" rowspan="2">To (Destination)</th>
  <th class="table_highlight textCenter" rowspan="2">Min <br> Guarantee <br> wt</th>
  <th class="table_highlight textCenter" rowspan="2">Contract <br> Qty</th>
  <th class="table_highlight textCenter" colspan="2">Valid for Period</th>
  <th class="table_highlight textCenter" rowspan="2">Basic <br> Rate</th>
  <th class="table_highlight textCenter" rowspan="2">Rate <br> (Pmt)</th>
  </tr>
  <tr>
    <th>From</th>
    <th>To</th>
  </tr>
  <?php 
  $srno = 1;
  foreach($dataheadB as $row) {  ?>

    <tr class="table_highlight">

      <td  class="table_highlight removeSpaceLogo" style="text-align: center;width:5%;"><?php echo $srno; ?></td>

      <td class="table_highlight removeSpaceLogo" style="font-size: 10px;width:15%;"><?php echo $row->FROM_PLACE ?></td>

      <td class="table_highlight removeSpaceLogo" style="font-size: 10px;width:20%;"><?php echo $row->TO_PLACE ?></td>

      <td class="table_highlight removeSpaceLogo" style="font-size: 10px;width:10%;"><?php echo $row->VEHICLE_TYPE_NAME ?></td>

      <td class="table_highlight removeSpaceLogo" style="font-size: 10px;width:10%;"></td>

      <?php $v_fromdt = $row->VALID_FROM_DT;
      if($v_fromdt){
        $vfromdt =  date("d-m-Y", strtotime($v_fromdt));
      }else{
        $vfromdt = '';
      }
      ?>

      <td class="table_highlight removeSpaceLogo" style="font-size: 10px;width:10%;"><?php echo $vfromdt; ?></td>

      <?php $v_todt = $row->VALID_TO_DT;
      if($v_todt){
        $vtodt =  date("d-m-Y", strtotime($v_todt));
      }else{
        $vtodt = '';
      }
      ?>

      <td class="table_highlight removeSpaceLogo" style="font-size: 10px;width:10%;"><?php echo $vtodt; ?></td>

      <td class="table_highlight removeSpaceLogo" style="font-size: 10px;text-align: right;width:10%;"><?php echo $row->RATE_BASIS ?></td>

      

      <td class="table_highlight removeSpaceLogo" style="font-size: 10px;text-align: right;width:10%;"><?php echo $row->RATE ?></td>
    </tr>

    <?php $srno++;} ?>


    <?php $rowCtn = count($dataheadB); 

    for ($i = $rowCtn; $i < 10; ++$i) {?>
      <tr style="border:none;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>

      </tr>
    <?php }?>





  </table>

  <table class="table table_highlight">

    <tr> &nbsp;
      <th style="text-decoration: underline;">&nbsp;
        Terms & Condition are as under:
      </th><br><br>
    </tr>


  </table>



  <table class="table table_highlight" style="width: 100%;" style="margin-bottom: 0px;">

    <tr>
      <th colspan="3" style="border-bottom: 1px solid lightgrey;">Terms & Conditions are as under: </th>
    </tr>

    <?php if($dataheadB[0]->RFHEAD1){ ?>
      <tr>
        <td style="width:20%;"><?php echo $configData[0]->RFHEAD1;?></td>
        <td style="width:5%;">:</td>
        <td style="width:75%;"><?php echo $dataheadB[0]->RFHEAD1; ?></td>
      </tr>
    <?php }else{ ?>
      <tr>
        <td style="width:20%;">&nbsp;</td>
        <td style="width:5%;">&nbsp;</td>
        <td style="width:75%;">&nbsp;</td>
      </tr>
    <?php } ?>

    <?php if($dataheadB[0]->RFHEAD2){ ?>
      <tr>
        <td style="width:20%;"><?php echo $configData[0]->RFHEAD2;?></td>
        <td style="width:5%;">:</td>
        <td style="width:75%;"><?php echo $dataheadB[0]->RFHEAD2; ?></td>
      </tr>
    <?php }else{ ?>
      <tr>
        <td style="width:20%;">&nbsp;</td>
        <td style="width:5%;">&nbsp;</td>
        <td style="width:75%;">&nbsp;</td>
      </tr>
    <?php } ?>

    <?php if($dataheadB[0]->RFHEAD3){ ?>
      <tr>
        <td style="width:20%;"><?php echo $configData[0]->RFHEAD3;?></td>
        <td style="width:5%;">:</td>
        <td style="width:75%;"><?php echo $dataheadB[0]->RFHEAD3; ?></td>
      </tr>
    <?php }else{ ?>
      <tr>
        <td style="width:20%;">&nbsp;</td>
        <td style="width:5%;">&nbsp;</td>
        <td style="width:75%;">&nbsp;</td>
      </tr>
    <?php } ?>

    <?php if($dataheadB[0]->RFHEAD4){ ?>
      <tr>
        <td style="width:20%;"><?php echo $configData[0]->RFHEAD4;?></td>
        <td style="width:5%;">:</td>
        <td style="width:75%;"><?php echo $dataheadB[0]->RFHEAD4; ?></td>
      </tr>
    <?php }else{ ?>
      <tr>
        <td style="width:20%;">&nbsp;</td>
        <td style="width:5%;">&nbsp;</td>
        <td style="width:75%;">&nbsp;</td>
      </tr>
    <?php } ?>
    <?php if($dataheadB[0]->RFHEAD5){ ?>
      <tr>
        <td style="width:20%;"><?php echo $configData[0]->RFHEAD5;?></td>
        <td style="width:5%;">:</td>
        <td style="width:75%;"><?php echo $dataheadB[0]->RFHEAD5; ?></td>
      </tr>
    <?php }else{ ?>
      <tr>
        <td style="width:20%;">&nbsp;</td>
        <td style="width:5%;">&nbsp;</td>
        <td style="width:75%;">&nbsp;</td>
      </tr>
    <?php } ?>

  </table>


  <table class="table table-bordered">
    <tr class="table_highlight">
      <th class="textRightS" style="font-size: 11px;width:25%;">
        For <?php echo $compDetail[0]->COMP_NAME;?>
        <br><br><br><br><br>
        Authorised Signatory
      </th>
      <th class="textRightS" style="font-size: 11px;width:25%;">
        &nbsp;
      </th>
      <th class="textRightS" style="font-size: 11px;width:25%;">
        &nbsp;
      </th>
      <th class="textRightS" style="font-size: 11px;width:25%;">
        &nbsp;
      </th>
    </tr>
  </table>


