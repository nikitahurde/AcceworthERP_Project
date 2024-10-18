
@include('admin.include.header')

<style type="text/css">
  p{
    font-size: 10px;
  }
  table,th{
    font-size: 10px;
    padding: : 5px 5px 5px 5px;
  }
  table,td{
    padding: : 5px 5px 5px 5px;
  }
</style>


<div style="border: 1px solid #c1c1c140;padding-left: 5px;">

  <h4 style="text-align: center;"><?php $compName = Session::get('company_name'); $compSplit = explode('-',$compName);echo $compSplit[1];?></h4>
  <h6 style="text-align: center;">SNo 10, Banik Villa, T N Mukherjee Road South Subhash Pally</h6>
  <h6 style="text-align: center;">Ph: +91 9325357239</h6>

</div>

<table style="width:100%;border:0;">
  
   <tr>
      <td style="">Date :  <?php echo $data030[0]->VRDATE; ?></td>
      <!-- <td style="text-align:right;padding:5px;width:50%;"> 2332</td> -->
   </tr>
   <tr>

      <?php  $fycode = $data030[0]->FY_CODE;
             $fiscalYr = explode('-', $fycode); 
             $series_code = $data030[0]->SERIES_CODE; 

       ?>
      <td style=""> VrNo :  <?php echo $fiscalYr[0].' '.$series_code.' '.$data030[0]->VRNO; ?></td>
      <!-- <td style="text-align:right;">ee</td> -->
   </tr>
</table>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->
<div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">{{ $title }}</h2>


            </div>


 

  <section class="content">
     <div class="box box-primary Custom-Box">


<table id="InwardDispatch" class="table table-bordered table-striped table-hover">

  <thead class="theadC">

     <tr style="padding-top: 20%;">
      <th class="text-center">Sr.No</th>
      <th class="text-center">Item Code & Perticular</th>
      <th class="text-center">Item Name</th>
      <th class="text-center">Qty Recd</th>
      <th class="text-center">AQty Recd</th>
    </tr>

  </thead>

  <tbody id="defualtSearch">



  <?php  $bal=0; $sr_no=1; foreach($data030 as $key) { 

             $bal +=$key->QTYRECD;

   ?> 
          
    ?>
    <tr style="padding-top: 20%;">
      <td>{{ $sr_no}}</td>

      <td>{{$key->ITEM_CODE}}</td>

      <td>{{$key->ITEM_NAME}}</td>

     
      <td style="text-align: right;">{{ $key->QTYRECD }}</td>

      <td style="text-align: right;">{{ $key->AQTYRECD }}</td>
     
    </tr>

 
  <?php $sr_no++;}   ?>


    
  </tbody>
 <!--  <tr class="list-item total-row">
                <th colspan="3" class="tableitem" style="text-align: right;"> Total</th>
                <td data-label="Grand Total" class="tableitem" style="text-align: right;">< ?php echo $bal; ?></td>
    </tr> -->
 
</table>
</div>
</section>



</div>



<table style="width:100%;border-collapse: collapse;">
  <tr>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;"> Entered by</td>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Checked By</td>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Approved By </td>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Authorised Signatory</td>
  </tr>
</table>


