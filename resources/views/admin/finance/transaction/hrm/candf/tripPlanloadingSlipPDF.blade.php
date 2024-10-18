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
      <th style="text-align: center;font-size: 15px;"><?php if($titleName == 'LOADING PLAN'){echo 'LOADING PLAN';}else{echo 'LOADING SLIP';} ?></th>
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
              <td class="removeSpaceLogo" style="font-size: 12px;"><?php echo $compDetail[0]->ADD1 ?> <?php echo $compDetail[0]->ADD2 ?> <?php echo $compDetail[0]->ADD3 ?><?php echo ' '.$compDetail[0]->CITY_NAME.','.$compDetail[0]->DIST_NAME.','.$compDetail[0]->STATE_NAME.','.$compDetail[0]->PIN_CODE ?>
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
          <tr>
              <th class="">LS.No : <?php echo $seriescode; ?></th>
             <!--  <th class="">:</th>
              <th class="removeSpace"></th> -->
          </tr>

           <tr>
              <th class="removeSpace">Date : <?php echo $dataheadB[0]->VRDATE; ?></th>
             <!--  <th class="">:</th>
              <th class="removeSpace"></th> -->
          </tr>
          
          <tr>
            <th class="removeSpace">To,</th>
           <!--  <th class="removeSpace">:</th>
            <td class="removeSpace"></td> -->
          </tr>
          <tr>
            <th class="removeSpace"><?php echo $dataheadB[0]->RCOMP_NAME ?></th>
            <!-- <th class="removeSpace">:</th>
            <td class="removeSpace"></td> -->
          </tr>
        
          <tr>
            <th class="removeSpace">AGENT - TATA STEEL, NAGPUR</th>
            <!-- <th class="removeSpace">:</th>
            <td class="removeSpace"></td> -->
          </tr>
            <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
            <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
            <tr class="removeSpaceLogo"><td>&nbsp;</td></tr>
          
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

  <tr class="table_highlight">
    <td><b>Vehicle No.</b> : <?php echo $dataheadB[0]->VEHICLE_NO ?></td>
    <td><B>Consignee </B>: <?php echo $dataheadB[0]->CP_NAME; ?> [ <?php echo $dataheadB[0]->CP_CODE; ?> ]</td>
    <td><B>Destination</B> : <?php echo $dataheadB[0]->TO_PLACE ?> </td>
  </tr>

</table>


<table class="table table_highlight">

  <tr class="table_highlight">
    <th class="table_highlight textCenter">Do No.</th>
    <th class="table_highlight textCenter">Rake/Wagon No.</th>
    <th class="table_highlight textCenter">Do Date</th>
    <th class="table_highlight textCenter">Item</th>
    <th class="table_highlight textCenter">Material Code</th>
    <th class="table_highlight textCenter">Description</th>
    <th class="table_highlight textCenter">QTY</th>
    <th class="table_highlight textCenter">UM</th>
    <th class="table_highlight textCenter">AQTY</th>
    <th class="table_highlight textCenter">AUM</th>
   
  </tr>

  <?php foreach($dataheadB  as $row){ ?>
    <tr>
      <?php $dt = $row->VRDATE;
         if($dt){
          $do_date = date('d-m-Y',strtotime($dt));
         }else{
          $do_date = '';
         }
      ?>

      <?php $rake_no  = $row->RAKE_NO;
            $wagon_no = $row->WAGON_NO;
            $rake_wagon = '';
            if($rake_no!='' && $wagon_no!=''){
              $rake_wagon = $rake_no.' / '.$wagon_no;
            }else if($rake_no!='' && $wagon_no==''){
              $rake_wagon = $rake_no;
            }else if($wagon_no!='' && $rake_no==''){
              $rake_wagon = $wagon_no;
            }else{
              $rake_wagon = '';
            }
      ?>
      <td class="table_highlight numberRight" style="width:9%;"><?php echo $row->DO_NO; ?></td><td class="table_highlight" style="width:9%;"><?php echo $rake_wagon; ?></td>
      <td class="table_highlight numberRight" style="width:9%;"><?php echo $do_date; ?></td>
      <td class="table_highlight" style="width:10%;"><?php echo $row->ITEM_NAME; ?></td>
      <td class="table_highlight" style="width:10%;"><?php echo $row->ALIAS_ITEM_CODE; ?></td>
      <td class="table_highlight" style="width:20%;"><?php echo $row->ITEM_REMARK; ?></td>
      <td class="table_highlight numberRight" style="width:11%;"><?php echo $row->QTY; ?></td>
      <td class="table_highlight text-center" style="width:11%;"><?php echo $row->UM; ?></td>
      <td class="table_highlight numberRight" style="width:11%;"><?php echo $row->AQTY; ?></td>
      <td class="table_highlight text-center" style="width:10%;"><?php echo $row->AUM; ?></td>
    
     
    </tr>
  <?php } ?>

    <?php $rowCtn = count($dataheadB); 

    for ($i = $rowCtn; $i < 10; ++$i) {?>
      <tr style="border:none;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;">
      <td style="width:15%;">&nbsp;</td>
      <td style="width:15%;">&nbsp;</td>
      <td style="width:12%;">&nbsp;</td>
      <td style="width:12%;">&nbsp;</td>
      <td style="width:9%;">&nbsp;</td>
      <td style="width:5%;">&nbsp;</td>
      <td Style="width:9%;">&nbsp;</td>
      <td Style="width:5%;">&nbsp;</td>
      <td style="width:9%;">&nbsp;</td>
      <td style="width:9%;">&nbsp;</td>
     
    </tr>
    <?php }?>
    
</table>

<table style="width:100%;border-collapse: collapse;">
  <tr>
   <!--  <td style="font-size:12px;width:50%;border:1px solid #a5a2a2;padding-left:5px;top:0%;">&nbsp;<br> Remark : </td>
  
    <td style="font-size:12px;width:50%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;"><br>For <?php echo $compDetail[0]->COMP_NAME; ?></td> -->
    <td style="font-size:12px;font-weight:bold;width:50%;border:1px solid #a5a2a2;padding-left:5px;padding-top:-65px;">Remark</td>
    <td style="font-size:12px;width:50%;font-weight: bold;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">For <?php echo $compDetail[0]->COMP_NAME; ?></td>
  </tr>
</table>