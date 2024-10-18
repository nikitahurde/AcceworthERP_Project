@include('admin.include.header')


<style>
	table,th{
	    font-size: 10px;
	    padding : 5px 5px 5px 5px;
	}
	table,td{
      padding : 5px 5px 5px 5px;
	}
    .leftBorder{
        border-left: 1px solid lightgray;
        border-right: 1px solid lightgray;
    }
</style>

<table class="table" style="margin-bottom: 0px;width:100%;border-top: 1px solid lightgray;" class="leftBorder">
    <tr>
      <th style="text-align: center;font-size: 15px;"> GATE PASS </th>
    </tr>
</table>

<table style="margin-bottom: 0px;width:100%;" class="leftBorder">
    <tr>
      <th style="font-size: 12px;"> To </th>
    </tr>
    <tr>
      <th style="font-size: 12px;"> The Security </th>
    </tr>
    <tr>
      <th style="font-size: 12px;"> <?php echo $compDetail[0]->COMP_NAME ?> </th>
    </tr>
    <tr>
        <th style="font-size: 12px;line-height: 12px;"> 
            <?php echo $compDetail[0]->ADD1 ?><br>
            <?php echo $compDetail[0]->ADD2 ?><br>
            <?php echo $compDetail[0]->ADD3 ?><br>
            <?php echo ' '.$compDetail[0]->CITY_NAME.' '.$compDetail[0]->DIST_NAME.' '.$compDetail[0]->STATE_NAME.'-'.$compDetail[0]->PIN_CODE ?> 
        </th>
    </tr>
</table>
<table class="leftBorder" style="width:100%;">
    <tr>
        <th>&nbsp;</th>
    </tr>
</table>
<table style="margin-bottom: 0px;width:100%;" class="leftBorder">
    <tr>
        <th style="font-size: 12px;"> Sir, </th>
    </tr>
    <tr>
        <th>
            <?php $stringCombine = $dataheadB[0]->VEHICLE_NO.$dataheadB[0]->ITEM_NAME;
                $stringCount = strlen($stringCombine);
                if($stringCount < 150){
                    $showString =$stringCombine;
                }
            ?>
            <small style="font-size: 12px;">Kindly allow </small> 
            <small style="font-size: 12px;border-bottom: 1px solid black;padding-bottom: 5px;"><?php echo  $dataheadB[0]->VEHICLE_NO;?> - <?php echo $dataheadB[0]->ITEM_NAME;?></small> 
            <small style="font-size: 12px;padding-bottom: 6px;">
                <?php for ($i = $stringCount; $i <95 ; $i++) {
                    echo '_';
                } ?>
            </small> 
            <small style="font-size: 12px;">to go</small>
           
        </th>
    </tr>
    <tr>
        <th>_________________________________________________________________for____________________________________________________________________________reason.</th>
    </tr>
</table>

<table class="leftBorder" style="width:100%;">
    <tr>
        <th>&nbsp;</th>
    </tr>
    <tr>
        <th>&nbsp;</th>
    </tr>
</table>

<table class="table" style="margin-bottom: 0px;width:100%;" class="leftBorder">
    <tr>
      <th style="width:50%;"> Security Signature </th>
      <th style="width:50%;text-align:right;"> Dept. Faculty </th>
    </tr>
</table>

<table class="table" style="margin-bottom: 0px;width:100%;border-bottom: 1px solid lightgray;" class="leftBorder">
    <tr>
      <th style="width:50%;">&nbsp;</th>
      <th style="width:50%;text-align:right;">&nbsp;</th>
    </tr>
    <tr>
      <th style="width:50%;"> Out Time : ______________</th>
      <th style="width:50%;text-align:right;"> Date : ________________ </th>
    </tr>
</table>


