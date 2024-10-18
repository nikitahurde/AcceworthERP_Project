
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

<table style="width:100%;border-collapse: collapse;">
   <tr>
      <td style="padding:5px;width:50%;"><?php $no =1; foreach($data030 as $key) { if($no==1){echo $key->ACC_CODE;} }?></td>
      <td style="text-align:right;padding:5px;width:50%;">ee</td>
   </tr>
   <tr>
      <td style="">Date : <?php $no =1; foreach($data030 as $key) { if($no==1){echo $key->VRDATE;} }?></td>
      <td style="text-align:right;padding:5px;width:50%;"> ee</td>
   </tr>
   <tr>
      <td style=""> VrNo : <?php $no =1; foreach($data030 as $key) { if($no==1){echo $key->VRNO;} }?></td>
      <td style="text-align:right;">ee</td>
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

     <tr>
      <th class="text-center">Sr.No</th>
      <th class="text-center">I Code & Perticular</th>
      <th class="text-center">Qty Recd</th>
      <th class="text-center">Rate</th>
      <th class="text-center">Basic</th>
    </tr>

  </thead>

  <tbody id="defualtSearch">


  <?php $sum = 0; $bal=0; $sr_no=1; foreach($data030 as $key) { 

            $bal +=$key->BASICAMT;
    ?>
    <tr>
      <td>{{ $sr_no}}</td>
      <td>{{$key->ITEM_CODE}}</td>
      <td style="text-align: right;">{{$key->QTYISSUED}}</td>
      <td style="text-align: right;"> {{$key->RATE}}</td>
      <td style="text-align: right;">{{$key->BASICAMT}}</td>
     
    </tr>

 
  <?php $sr_no++;} ?>


    
  </tbody>
  <tr class="list-item total-row">
                <th colspan="4" class="tableitem" style="text-align: right;"> Total</th>
                <td data-label="Grand Total" class="tableitem" style="text-align: right;"><?php echo $bal.'.00'; ?></td>
    </tr>
 
</table>

<table style="width:100%;border-collapse: collapse;">
  <tr>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;"> Entered by</td>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Checked By</td>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Approved By </td>
    <td style="width:25%;border:1px solid #a5a2a2;padding-left:5px;padding-top:70px;">Authorised Signatory</td>
  </tr>
</table>
 




           

          </div>

  </section>

</div>



