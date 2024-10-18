
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

  <h6>{{Session::get('company_name')}}</h6>

  <p>{{$plant->address1}}{{$plant->address2}}{{$plant->address3}}</p>
  <p>{{$plant->city}} - {{$plant->pin}}</p>
  <p>Phone No.- {{$plant->phone1}}</p>
  <p>GST NO - {{$plant->gst_no}}</p>

</div>

<div style="border: 1px solid #c1c1c140;padding-left: 5px;">


  <p>{{ $party->comp_name }}</p>
  <p>{{ $party->address1 }}, {{ $party->address2 }},{{ $party->address3 }}</p>
  <p>{{ $party->city }} - {{ $party->pin }}</p>
  <p>Phone No.- {{ $party->phone1 }}</p>
  <p>GST NO - {{ $party->gst_num }}</p>

</div>

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
      <th class="text-center">Vr Date</th>
      <th class="text-center">Vr no. </th>
      <th class="text-center">Trans. code</th>
      <th class="text-center">Plant Code</th>
      <th class="text-center">Series</th>
      <th class="text-center">Profit Cent.</th>
      <th class="text-center">Item Name</th>
      <th class="text-center">Qty</th>
      <th class="text-center">A-Qty</th>
    </tr>

  </thead>

  <tbody id="defualtSearch">


  <?php  $sr_no=1; foreach($data1 as $key) { 


    ?>
    <tr>
      <td>{{ $sr_no++ }}</td>
      <td>{{ $key->vr_date }}</td>
      <td>{{ $key->vrno }}</td>
      <td>{{ $key->tran_code }}</td>
      <td>{{ $key->plantCode }}</td>
      <td>{{ $key->seriesCode }}</td>
      <td>{{ $key->pfctCode }}</td>
      <td>{{ $key->item_code }}- {{ $key->item_name }}</td>
      <td>{{ $key->quantity }}</td>
      <td>{{ $key->Aquantity }}</td>
     
    </tr>

  <?php } ?>

  </tbody>

  

</table>




           

          </div>

  </section>

</div>



