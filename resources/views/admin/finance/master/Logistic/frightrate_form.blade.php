@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')



@include('admin.include.navbar')



@include('admin.include.sidebar')



<style type="text/css">

  .PageTitle{

    margin-right: 1px !important;

  }

 .required-field::before {

    content: "*";

    color: red;

  }

  .Custom-Box {

    /*border: 1px solid #e0dcdc;

    border-radius: 10px;

*/    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  .showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }

  .rightcontent{

  text-align:right;


}

::placeholder {
  
  text-align:left;
}
.showinmobile{
  display: none;
}

@media screen and (max-width: 600px) {

  .showinmobile{

    display: block;

  }
  .PageTitle{
    float: left;
  }
  .hideinmobile{
    display: none;
  }
  .datepicker{
    padding: 1px !important;
    border-radius: 1px !important;
   border:none !important;
   font-family: inherit;
    font-size: inherit;
    line-height: inherit;
  }

}
.tdthtablebordr{
  line-height:0.1 !important;
  padding: 4px !important;
}
</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master Route

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/form-mast-rate') }}">Master Route Rate</a></li>

            <li class="active"><a href="{{ url('/form-mast-rate') }}">Add Route  Rate</a></li>

          </ol>

        </section>

  <form action="{{ url('form-mast-rate-save') }}" method="POST" >

       @csrf


  <section class="content">

    <div class="row">

     
      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Route </h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-mast-freight-rate') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Route </a>

              </div>

                <div class="box-tools pull-right">

                <a href="{{ url('/view-mast-freight-rate') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Route </a>

              </div>

              
              

            </div><!-- /.box-header -->

            @if(Session::has('alert-success'))



              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>

                  <i class="icon fa fa-check"></i>

                  Success...!

                </h4>

                 {!! session('alert-success') !!}

              </div>





            @endif





            @if(Session::has('alert-error'))



              <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>

                  <i class="icon fa fa-ban"></i>

                  Error...!

                </h4>

                {!! session('alert-error') !!}

              </div>



            @endif



          <div class="box-body">

          
               <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-2">
                    <div class="form-group">

                      <label for="exampleInputEmail1">Route Code : <span class="required-field"></span></label>

                        <div class="input-group">

                         <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                         <input type="text" id="route_code" name="route_code" class="form-control  " value="{{old('route_code')}}" placeholder="Route Code" autocomplete="off" maxlength="8">

                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>
                          
                          <span class="input-group-addon" style="padding: 0px 5px;">
                            
                            <div class="">
                                <button type="button" id="login" class="btn btn-xs btn-info gly-radius"> <i class="fa fa-info" aria-hidden="true" ></i></button>
                            </div>
                            
                            <div id="myForm" class="hide">
                                 <div class="row" >
                                      <div class="col-md-9">
                                        <input type="text" name="routecodeH" id="routecodeH" class="form-control input-md setheightinput" style="text-transform: uppercase;">
                                      </div>
                                      <div class="col-md-3" style="margin-left: -7%;">
                                        
                                        <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                <div id="result">
                                <table class="table table-bordered" style="margin-top: 3%;width:200px;" id="HideWhenSearch">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Route Code</th>
                                     <th class="nameheading">Route Name</th>
                                    </tr>
                                  </thead>
                                  <tbody style="line-height:2.428571 !important ;">
                                    <?php foreach ($help_route_code_list as $key) { ?>

                                      <tr>
                                        <td class="setetxtintd"><?php echo $key->ROUTE_CODE; ?></td>
                                        <td class="setetxtintd"><?php echo $key->ROUTE_NAME; ?></td>
                                      </tr>
                                     
                                    <?php } ?>
                                      
                                  </tbody>
                                </table>

                                <table class="table table-bordered beforhidetble" style="margin-top: 3%;width:200px;display: none;" id="ShowWhenSeaech">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Route Code</th>
                                     <th class="nameheading">Route Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                  </tbody>
                                </table>
                                <span id="errorItem"></span>

                            </div>
                            </div>
                            
                          </span>
                         
                        </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('route_code', '<p class="help-block" style="color:red;line-height: 1.2;">:message</p>') !!}

                      </small>

                  </div>
                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Route Name : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>


                           <input type="text"  id="route_name" name="route_name" class="form-control  pull-left " value="{{ old('route_name')}}" placeholder="Select Route Name" autocomplete="off">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('route_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                        <small>
                          <div class="pull-left showSeletedName" id="depotText"></div>
                        </small>


                    </div>

                  </div>
              </div>

            </div><!-- /.box-body -->

       </div>

      </div>

    </div>


   


     

  </section>

  <section class="content" style="margin-top: -10%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

    
              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

 
                  <tr>

                    <th><input class='check_all'  type='checkbox' onclick="select_all()"/></th>

                    <th style="width: 10px;"> Sr.No.</th>

                    <th>From Place</th>

                    <th>To Place</th>

                    <th>km</th>

                    <th>toll</th>

                    <th>Enhance Weight Rate</th>

                    <th>Extra Mileage</th>

                    <th>Extra km</th>

                    <th>Less km</th>

                    <th>Extra Toll</th>
                   
                    <th>Trip Days</th>
                    <th>Holidays</th>


                  </tr>

                  <tr class="useful">

                    <td class="tdthtablebordr">
                      <input type='checkbox' class='case' id="firstrow" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;">1.</span>
                    </td> 

                    <td class="tdthtablebordr tooltips">

                      <input list="fromList1" class="inputboxclr getAccNAme" style="width: 120px;" id='from_place1' name="from_place[]"autocomplete="off" value=""onchange="frmplaceclick(1)" >


                      <datalist id="fromList1">
                      <?php foreach($area_code as $key) { ?>

                        <option value="<?= $key->CITY_NAME ?>" data-xyz="<?= $key->CITY_CODE ?>"><?= $key->CITY_NAME ?> [<?= $key->CITY_CODE ?>]</option>

                      <?php } ?>
                      </datalist>
                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small>
                      
                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;">

                      <input list="toList1" class="debitcreditbox dr_amount inputboxclr getqtytotal quantityC moneyformate"  id='to_place1' name="to_place[]" style="width: 120px" autocomplete="off" onchange="frmplaceclick(1)" />

                       <datalist id="toList1">
                      <?php foreach($area_code as $key) { ?>

                        <option value="<?= $key->CITY_NAME ?>" data-xyz="<?= $key->CITY_CODE ?>"><?= $key->CITY_NAME ?> [<?= $key->CITY_CODE ?>]</option>

                      <?php } ?>
                      </datalist>
              
                      </div>
                       <div><small id="errmsgqty1"></small></div>

                    </td>

                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;">

                      <input type='text' class="debitcreditbox dr_amount Number inputboxclr rightcontent"  id='km1' name="km[]"  style="width: 80px" autocomplete="off"/>

                      </div>

                    </td>

                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;">

                      <input type='text' class="debitcreditbox dr_amount Number inputboxclr rightcontent"  id='toll1' name="toll[]"  style="width: 80px" autocomplete="off"/>

                      </div>

                    </td>
                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;">

                      <input type='text' class="debitcreditbox dr_amount Number inputboxclr rightcontent"  id='weight_rate1' name="weight_rate[]"  style="width: 100px" autocomplete="off"/>

                      </div>

                    </td>

                    
                    <td class="tdthtablebordr">
                      <div style="display: inline-flex;border: none;">
                        <input type='text' class="debitcreditbox dr_amount Number inputboxclr rightcontent"  id='extraMileage1' name="extraMileage[]" Number  style="width: 80px" autocomplete="off" />
                      </div>
                    </td>

                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;">

                      <input type='text' class="debitcreditbox dr_amount Number inputboxclr rightcontent"  id='extra_km1' name="extra_km[]" value="" style="width: 80px" autocomplete="off"/>

                      </div>

                    </td>


                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;">

                      <input type='text' class="debitcreditbox dr_amount Number inputboxclr rightcontent"  id='less_km1' name="less_km[]"  style="width: 80px"autocomplete="off" />

                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;">

                      <input type='text' class="debitcreditbox dr_amount Number inputboxclr rightcontent"  id='extra_toll1' name="extra_toll[]"  style="width: 80px" autocomplete="off" />

                      </div>

                    </td>
                    <td class="tdthtablebordr">
                      <div style="display: inline-flex;border: none;">
                        <input type='text' class="debitcreditbox dr_amount Number inputboxclr rightcontent"  id='trip_days1' name="trip_days[]" Number  style="width: 80px" autocomplete="off" />
                      </div>
                    </td>
                    <td class="tdthtablebordr">
                      <div style="">
                       <input list="daysList" type='text' class="daysname"  style="padding:1px !important;width: 80px;" name="off_days[]" id="off_day1"   autocomplete="off" />
                      <datalist id="daysList">

                              <option selected="selected" value="">-- Select --</option>
                              <option  value="Sunday" data-xyz="Sunday">Sunday</option>
                              <option  value="Monday" data-xyz="Monday">Monday</option>
                              <option  value="Tuesday" data-xyz="Tuesday">Tuesday</option>
                              <option  value="Wednesday" data-xyz="Wednesday">Wednesday</option>
                              <option  value="Thursday" data-xyz="Thursday">Thursday</option>
                              <option  value="Friday" data-xyz="Friday">Friday</option>
                              <option  value="Saturday" data-xyz="Saturday">Saturday</option>

                             
                          </datalist>
                     </div>
                    </td>


                  </tr>

                </table>

              </div><!-- /div -->

            
             


        
<style type="text/css">

  .rTable { display: table; }

.rTableRow { display: table-row; }

.rTableHeading { display: table-header-group; }

.rTableBody { display: table-row-group; }

.rTableFoot { display: table-footer-group; }

.rTableCell, .rTableHead { display: table-cell; }

  .rTable {
   display: table;
   /*width: 100%;*/
}

.rTableRow {

   display: table-row;

}

.rTableHeading {

   display: table-header-group;

   background-color: #ddd;

}

.rTableCell, .rTableHead {

   display: table-cell;

   padding: 3px 10px;

   border: 1px solid #ebe7e7;

}

.rTableHeading {

   display: table-header-group;

   background-color: #ddd;

   font-weight: bold;

}

.rTableFoot {

   display: table-footer-group;

   font-weight: bold;

   background-color: #ddd;

}

.rTableBody {

   display: table-row-group;

}

.setInline{

  display: flex;

  margin-bottom: 4px;

}

.rowClass{

  margin: 0px;

  margin-top: 3%;

}

.rowClass1{

  margin: 0px;

  margin-top: 0%;

}

.rowClassonModel{

   margin: 0px;

  margin-top: 1%;

}

.LableTextField{

  text-align: center;

  font-weight: 600;

}

.distClass{

  display: none;



}

.sgstBlock{

  display: none;

}

.cgstBlock{

  display: none;

}

.afforblck{

  display: none;

}

.affiveblck{

  display: none;

}

.afsixblck{

  display: none;

}

.afsevenblck{

  display: none;

}

.afheadeightblck{

  display: none;

}

.afheadnineblck{

  display: none;

}

.afheadtenblck{

  display: none;

}

.afheadelvnblck{

  display: none;

}

.afheadtwelblck{

  display: none;

}

.getheading{

  border: none;

  width: 61px;

}
.settaxcodemodel{
  font-size: 16px;
    font-weight: 800;
    color: #5d9abd;
}

</style>    

      <br>

        <button type="button" class='btn btn-danger btn-sm delete' id="deletehidn" disabled style="padding:0px 2px;"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

        <button type="button" class='btn btn-info btn-sm addmore' id="addmorhidn" style="padding:0px 2px;"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

        <p class="text-center">

          <button class="btn btn-success btn-sm" type="submit" style="padding:0px 2px;"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

          <button class="btn btn-warning btn-sm" type="button" id="CancleBtn" onclick="location.reload();" style="padding:0px 2px;"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

        </p>

       

<style>
              .boxer {
                display: table;
                border-collapse: collapse;
              }
              .boxer .box-row {
                display: table-row;
              }
              .boxer .box-row:first-child {
                font-weight:bold;
              }
              .boxer .box10 {
                display: table-cell;
                vertical-align: top;
                border: 1px solid #ddd;
                padding: 5px;
              }
              .boxer .hidebordritm {
                display: table-cell;
                vertical-align: top;
                border: none;
                padding: 5px;
              }
              .boxer .ebay {
                padding:5px 1.5em;
              }
              .boxer .google {
                padding:5px 1.5em;
              }
              .boxer .amazon {
                padding:5px 1.5em;
              }
              .center {
                text-align:center;
              }
              .right {
                float:right;
              }
              .texIndbox{
                width: 25%; 
                text-align: center;
              }
               .texIndbox1{
                width: 5%; 
                text-align: center;
              }
              .rateIndbox{
                width: 15%;
                text-align: center;
              }
              .itmdetlheading{
                vertical-align: middle !important;
                text-align: center;
              }
              .rateBox{
                width: 20%;
                text-align: center;
              }
              .amountBox{
                width: 20%;
                text-align: center;
              }
              .inputtaxInd{
                background-color: white !important;
                border: none;
                text-align: center;
              }
              .showind_Ch{
                display: none;
              }
            </style>
      <!-- when hsn code same then show model -->

     
  </div><!-- /.box-body -->

</div>

</div>

</div>

</section>

</form>

</div>



@include('admin.include.footer')



<script type="text/javascript">

function frmplaceclick(id) {

   var selectElement = $('#from_place'+id);

   var val = selectElement.val();
   
   console.log('selectElement', val);
   
   var xyz = $('#fromList'+id+' option').filter(function() {

      return this.value == val;

   }).data('xyz');
   
   var msg = xyz ? xyz : 'No Match';
   
   if (msg == 'No Match') {

      $('#from_place'+id).val('');

   } else {
      
   }


   var selectElement = $('#to_place'+id);

   var val = selectElement.val();
   
   console.log('selectElement', val);
   
   var xyz = $('#toList'+id+' option').filter(function() {

      return this.value == val;

   }).data('xyz');
   
   var msg = xyz ? xyz : 'No Match';
   
   if (msg == 'No Match') {

      $('#to_place'+id).val('');

   } else {
      
   }

}


  $(document).ready(function() {

     var currentDate = new Date();

      $('.offday').datepicker({
          
          format : 'dd-mm-yyyy',
          todayHighlight: true,
          
          startDate :currentDate,
          maxDate: currentDate
      });

    });

    $(document).ready(function(){



        $("#Depot").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#depotList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("depotText").innerHTML = msg; 
          if(msg=='No Match'){

             $(this).val('');
             document.getElementById("depotText").innerHTML = '';

          }

        });

         $(".daysname").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#daysList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');
          }

        });

        $("#area_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#areaList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("areaText").innerHTML = msg; 
          if(msg=='No Match'){

             $(this).val('');
             document.getElementById("areaText").innerHTML = '';

          }

        });



        $("#wheel_type").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#wheelList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("wheelText").innerHTML = msg; 
          if(msg=='No Match'){

             $(this).val('');
             document.getElementById("wheelText").innerHTML = '';

          }

        });

      });



</script>
<script type="text/javascript">
  $(document).ready(function(){
  $('.Number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
});

  });
</script>


<script type="text/javascript">

  $(".delete").on('click', function() {


      var rowCount = $('#tbledata tr').length;
      
      console.log('rowCount',rowCount);
      if(rowCount == 2){
         $('#submitdata').prop('disabled',true);
      }
      $('.case:checkbox:checked').parents("tr").remove();

      $('.check_all').prop("checked", false); 

      quantity =0;
       $(".quantityC").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                quantity += parseFloat(this.value);
            }

          $("#basicTotal").val(quantity.toFixed(2));

        });

       var dataCl =0;
         $(".quaPcountrow").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                dataCl += parseFloat(this.value);
            }

          $("#allquaPcount").val(dataCl);

        });


      check();

  }); /*--function close--*/


  var i=2;

  $(".addmore").on('click',function(){

    count=$('#tbledata tr').length;
      console.log('count',count);


     var data ="<tr class='useful'><td class='tdthtablebordr'><input type='checkbox' class='case' id='firstrow' /></td><td class='tdthtablebordr'><span id='snum' style='width: 10px;'>"+count+".</span></td><td class='tdthtablebordr tooltips'><input list='fromList"+i+"' class='inputboxclr getAccNAme' style='width: 120px;' id='from_place"+i+"' name='from_place[]' onchange='frmplaceclick("+i+")' autocomplete='off'/><datalist id='fromList"+i+"'><?php foreach($area_code as $key) { ?><option value='<?= $key->CITY_NAME ?>' data-xyz='<?= $key->CITY_CODE ?>'><?= $key->CITY_NAME ?> [<?= $key->CITY_CODE ?>]</option><?php } ?></datalist><small class='tooltiptextitem tooltiphide' id='itemNameTooltip1'></small></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;'><input list='toList"+i+"' class='debitcreditbox dr_amount inputboxclr getqtytotal quantityC moneyformate'  id='to_place"+i+"' name='to_place[]' onchange='frmplaceclick("+i+")' style='width: 120px' autocomplete='off'/><datalist id='toList"+i+"'><?php foreach($area_code as $key) { ?><option value='<?= $key->CITY_NAME ?>' data-xyz='<?= $key->CITY_CODE ?>'><?= $key->CITY_NAME ?> [<?= $key->CITY_CODE ?>]</option><?php } ?></datalist></div><div><small id='errmsgqty"+i+"'></small></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;'><input type='text' class='debitcreditbox dr_amount inputboxclr rightcontent'  id='km"+i+"' name='km[]'  style='width: 80px' autocomplete='off'/></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter rightcontent'  id='toll"+i+"' name='toll[]'  style='width: 80px' autocomplete='off'/></div> </td> <td class='tdthtablebordr'><div style='display: inline-flex;border: none;'><input type='text' class='debitcreditbox dr_amount Number inputboxclr rightcontent rightcontent'  id='weight_rate1' name='weight_rate[]'  style='width: 100px' autocomplete='off'/></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;'><input type='text' class='debitcreditbox dr_amount Number inputboxclr rightcontent'  id='extraMileage"+i+"' name='extraMileage[]' Number  style='width: 80px' autocomplete='off' /></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;'><input type='text' class='debitcreditbox dr_amount inputboxclr rightcontent'  id='extra_km"+i+"' name='extra_km[]'  style='width: 80px' autocomplete='off'/></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter rightcontent'  id='less_km"+i+"' name='less_km[]'  style='width: 80px' autocomplete='off'/></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;'><input type='text' class='debitcreditbox dr_amount inputboxclr rightcontent'  id='extra_toll"+i+"' name='extra_toll[]'  style='width: 80px' autocomplete='off'/></div></td><td class='tdthtablebordr'><input type='text' class='debitcreditbox dr_amount inputboxclr rightcontent'  id='trip_days"+i+"' name='trip_days[]'  style='width: 80px' autocomplete='off' /></td><td class='tdthtablebordr'><input list='daysList' type='text' class='daysname'  style='padding:1px !important;width: 80px;' name='off_days[]' id='off_day"+i+"'   autocomplete='off' /><datalist id='daysList'><option selected='selected' value=''>-- Select --</option><option  value='Sunday' data-xyz='Sunday'>Sunday</option><option  value='Monday' data-xyz='Monday'>Monday</option><option  value='Tuesday' data-xyz='Tuesday'>Tuesday</option><option  value='Wednesday' data-xyz='Wednesday'>Wednesday</option><option  value='Thursday' data-xyz='Thursday'>Thursday</option><option  value='Friday' data-xyz='Friday'>Friday</option><option  value='Saturday' data-xyz='Saturday'>Saturday</option></datalist></td></tr>";

      $('#tbledata').append(data);


      i++;

       var currentDate = new Date();

      $('.offday').datepicker({
          format : 'dd-mm-yyyy',
          todayHighlight: true,
          
          startDate :currentDate,
          maxDate: currentDate
      });

  });  /*--function close--*/

  /*<td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input type='text' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddM'></div></td>*/

  function select_all() {

    $('input[class=case]:checkbox').each(function(){ 

      if($('input[class=check_all]:checkbox:checked').length == 0){ 

        $(this).prop("checked", false); 

      }else{

        $(this).prop("checked", true); 

      } 

    });
  }

  function check(){

    obj = $('table tr').find('span');
     // console.log('obj',obj);
    if(obj.length==0){
      $('#basicTotal').val(0.00);
      $('#submitdata').prop('disabled',true);
    }else{
      $.each( obj, function( key, value ) {

          id= value.id;

          $('#'+id).html(key+1);

      });
    }
  }

  $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Route Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;left:58.815px" id="closeModel">X</a>',
        html:true,
        content:  $('#myForm').html()
    }).on('click', function(){
      // had to put it within the on click action so it grabs the correct info on submit
      $('#serachcode').click(function(){

           $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

           });

          var HelpRouteCode = $('#routecodeH').val();

           if(HelpRouteCode == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-route-code-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {HelpRouteCode: HelpRouteCode},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Route Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                         console.log('data');

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.ROUTE_CODE+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.ROUTE_NAME+'</td></tr>');
                             });
                      }
                 }

              });
           }
      })
  })
});

$(document).ready(function(){
     $('body').on('click', '#closeModel', function () {
          $('.popover').fadeOut();
    })
  });


</script>
@endsection