<style type="text/css">
  table,td{
    padding : 5px 5px 5px 5px;
  }
  .table_highlight{
      margin-bottom: 0px;
      border-left: 1px solid lightgrey;
      border-right: 1px solid lightgrey;
      border-top: 1px solid lightgrey;
      border-bottom: 1px solid lightgrey;
  }
  .borderNo{
    font-size:16px;
    border-color: #fff;
  }
</style>
<style>
@page { size: auto;  margin: 0mm; }
</style>
  
  <?php 

    $paddingLeftdt   = $chqConf[0]->LEAFROW;
    $paddingTopdt    = $chqConf[0]->LEAFCOLUMN;

    $paddingLeftName = $chqConf[1]->LEAFROW;
    $paddingTopName  = $chqConf[1]->LEAFCOLUMN;

    $plInword        = $chqConf[2]->LEAFROW;
    $ptInWord        = $chqConf[2]->LEAFCOLUMN;

    $plAmount        = $chqConf[3]->LEAFROW;
    $ptAmount        = $chqConf[3]->LEAFCOLUMN;

    $dateCount = strlen($chqDate);
    $fullDate=array();
    for($i=0;$i<$dateCount;$i++){
        $fullDate[]   = $chqDate[$i];
    } 

    $pay_name = str_replace('_', ' ', $bnf_name);
    $amt_word = str_replace('_', ' ', $amtInWord);

    $amtstringCount  = strlen($amt_word); 

    $PAmtWord1 = array();
    $PAmtWord2 = array();
    $PAmtWord11='';
    if($amtstringCount > 55){

      $someWord  = substr($amt_word, 0, 55);
      $splitWord = explode(' ',$someWord);
      $wordCount = count($splitWord);
      $wordPos   = $wordCount -1; 
      $lastWord  = $splitWord[$wordPos];
      
      $strsplit = explode(' ',$amt_word);
      $strWord  = $strsplit[$wordPos];

      if($lastWord == $strWord){

        for($i=0;$i<$wordPos;$i++){
          $PAmtWord1[] = $strsplit[$i].' ';
        }

        $strCount = count($strsplit);
        for($j=$wordPos;$j<$strCount;$j++){
          $PAmtWord2[] = $strsplit[$j].' ';
        }

      }else{
        $wordCount = $wordPos - 1;
        
        for($i=0;$i<$wordCount;$i++){
          $PAmtWord1[] = $strsplit[$i];
        }

        $strCount = count($strsplit);
        for($j=$wordCount;$j<$strCount;$j++){
          $PAmtWord2[] = $strsplit[$j].' ';
        }
        
      }

    }else{
      $PAmtWord11 = $amt_word;
      $PAmtWord2 = '';
    }

    if($PAmtWord11){
      $WordFirstLine =$PAmtWord11;
    }else{
      $WordFirstLine = join(" ",$PAmtWord1);
    }

    if($PAmtWord2 !=''){
      $WordSecLine1 = join(" ",$PAmtWord2);
    }else{
      $WordSecLine1 = '';
    }
    

   ?>
   <input type="hidden" value="" id="printDone">
  <table class="table table_highlight" style="float:right;margin-top:0.5%;border-color:#fff;margin-right:5%;">
    
      <tr class="table_highlight" style="border-color:#fff;">
        <td class="borderNo">{{$fullDate[0]}}</td>
        <td class="borderNo">{{$fullDate[1]}}</td>
        <td class="borderNo">{{$fullDate[3]}}</td>
        <td class="borderNo">{{$fullDate[4]}}</td>
        <td class="borderNo">{{$fullDate[6]}}</td>
        <td class="borderNo">{{$fullDate[7]}}</td>
        <td class="borderNo">{{$fullDate[8]}}</td>
        <td class="borderNo">{{$fullDate[9]}}</td>
      </tr>
  </table>

   <table style="width:100%;border-collapse: collapse;border-color:#fff;">
    <tr style="border-color:#fff;">
      <td class="borderNo" style="padding-left:<?echo $paddingLeftName;?>%;padding-top:<?echo $paddingTopName;?>%;"><?php echo strtoupper($pay_name); ?></td>
    </tr>
  </table>

  <table style="width:100%;border-collapse: collapse;border-color:#fff;">
    <tr style="border-color:#fff;">
      <td class="borderNo" style="padding-left:<?php echo $plInword;?>%;padding-top:<?php echo $ptInWord;?>%;"><?php echo $WordFirstLine; ?></td>
    </tr>
  </table>

<?php 

  $amountForm = $amount;


?>
  <table style="width:100%;border-collapse: collapse;border-color:#fff;">
    <tr style="border-color:#fff;">
      <td class="borderNo" style="width:75%;padding-left:<?echo $plAmount;?>%;padding-top:<?echo $ptAmount;?>%;"><?php echo $WordSecLine1; ?></td>
      <td class="borderNo" style="width:25%;padding-left:<?echo $plAmount;?>%;padding-top:<?echo $ptAmount;?>%;"> *****{{$amountForm}} /- </td>
    </tr>
  </table>


 <?php $AccPay = 'A/C Pay'; ?>
  <table style="width:100%;border-collapse: collapse;border-color:#fff;">
    <tr style="border-color:#fff;"><td class="borderNo">&nbsp;</td>
    </tr>
    <tr style="border-color:#fff;">
      <td class="borderNo" style="text-align: center;">{{$AccPay}}</td>
    </tr>
  </table>

  <script>
    var mediaQueryList = window.matchMedia('print');
    mediaQueryList.addListener(function(mql) {
      if ((mql.matches)) {
        console.log('before');
      }else{
        
        var link = window.location.href;
        var getseperate = link.split('/');

        var folderName = getseperate[0]+'//'+getseperate[2]+'/'+getseperate[3];
     
        window.parent.location = folderName+"/configration/Setting/view-offline-cheque-issue";

        /*window.parent.location = window.parent.location.href;*/
      }
    });
  </script>
<!--  final dimension  ------- DON'T TOUCH -->
  
  <!--   <table class="table table_highlight" style="float:right;margin-top:0.5%;border-color:#fff;margin-right:5%;">
    
      <tr class="table_highlight" style="border-color:#fff;">
        <td class="borderNo">{{$fullDate[0]}}</td>
        <td class="borderNo">{{$fullDate[1]}}</td>
        <td class="borderNo">{{$fullDate[3]}}</td>
        <td class="borderNo">{{$fullDate[4]}}</td>
        <td class="borderNo">{{$fullDate[6]}}</td>
        <td class="borderNo">{{$fullDate[7]}}</td>
        <td class="borderNo">{{$fullDate[8]}}</td>
        <td class="borderNo">{{$fullDate[9]}}</td>
      </tr>
  </table>

  <table style="width:100%;border-collapse: collapse;border-color:#fff;">
    <tr style="border-color:#fff;">
      <td class="borderNo" style="padding-left:9%;padding-top:20px;">{{$pay_name}}</td>
    </tr>
  </table>

  <table style="width:100%;border-collapse: collapse;border-color:#fff;">
    <tr style="border-color:#fff;">
      <td class="borderNo" style="padding-left:14%;padding-top:2%;">{{$WordFirstLine}}</td>
    </tr>
  </table>

  <table style="width:100%;border-collapse: collapse;border-color:#fff;">
    <tr style="border-color:#fff;">
      <td class="borderNo" style="width:75%;padding-left:5%;padding-top:2%;">{{$WordSecLine1}}</td>
      <td class="borderNo" style="width:25%;padding-left:2%;padding-top:2%;"> {{$amount}}</td>
    </tr>
  </table> -->

<!--  final dimension ------- DON'T TOUCH -->

 <!-- correct dimension <style type="text/css">
  
  table,th{
    font-size: 10px;
    padding : 5px 5px 5px 5px;
  }
  table,td{
    padding : 5px 5px 5px 5px;
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
  title{
    display:none !important;
  }
</style>
<style>
@page { size: auto;  margin: 0mm; }
</style>

  <table class="table table_highlight" style="float:right;margin-top:0.5%;border-color:#fff;margin-right:4%;">
    
      <tr class="table_highlight" style="border-color:#fff;">
          <td style="font-size:16px;border-color:#fff;">1</td>
      <td style="font-size:16px;border-color:#fff;">6</td>
      <td style="font-size:16px;border-color:#fff;">0</td>
          <td style="font-size:16px;border-color:#fff;">2</td>
          <td style="font-size:16px;border-color:#fff;">1</td>
      <td style="font-size:16px;border-color:#fff;">9</td>
      <td style="font-size:16px;border-color:#fff;">9</td>
      <td style="font-size:16px;border-color:#fff;">7</td>
      </tr>
  </table>

  <table style="width:100%;border-collapse: collapse;border-color:#fff;">
    <tr style="border-color:#fff;">
      <td style="border-color:#fff;"></td>
      <td style="font-size:16px;border:1px solid #a5a2a2;padding-left:5%;padding-top:20px;border-color:#fff;"> Entered by</td>
    </tr>
  </table>

  <table style="width:100%;border-collapse: collapse;border-color:#fff;">
    <tr style="border-color:#fff;">
      <td style="font-size:16px;border:1px solid #a5a2a2;padding-left:20%;padding-top:5px;border-color:#fff;"> One Lakh Ninety Five Thousand Seven Hundred Seventy </td>
    </tr>
  </table>

  <table style="width:100%;border-collapse: collapse;border-color:#fff;">
    <tr style="border-color:#fff;">
      <td style="width:75%;font-size:16px;border:1px solid #a5a2a2;padding-left:13%;padding-top:5px;border-color:#fff;"> Seven Only</td>
      <td style="width:25%;font-size:16px;border:1px solid #a5a2a2;padding-left:9%;padding-top:5px;padding-left:20px;border-color:#fff;"> 1,95,777</td>
    </tr>
  </table> -->