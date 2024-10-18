@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

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
  .hidebox{
    display: none;
  }
  .showbox{
    display: block;
  }

  .Custom-Box {
/*border: 1px solid #e0dcdc;
border-radius: 10px;*/ 
box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
}

.showinmobile{
  display: none;
}
.secondSection{

  display: none;
}

.rightcontent{

  text-align:right;


}
.tcodemargin{
  margin-left: -3%;
}

::placeholder {

  text-align:left;
}
.dateWidth{
  width: 76% !important;
}
.vrmargin{
  margin-left: -7%;
}
.seriescodemargin{
  margin-left: -3%;
}
.seriescodewidth{
  width: 145% !important;
}
.pfctnamewidth{
  width: 145% !important;
}

.accnamewidth{
  width: 134% !important;
}
.accnamemargin{
  margin-left: -7%;
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

}


.stepwizard-step p {
  margin-top: 10px;
}

.stepwizard-row {
  display: table-row;
}

.stepwizard {
  display: table;
  width: 100%;
  position: relative;
}

.stepwizard-step button[disabled] {
  opacity: 1 !important;
  filter: alpha(opacity=100) !important;
}

.stepwizard-row:before {
  top: 14px;
  bottom: 0;
  position: absolute;
  content: " ";
  width: 100%;
  height: 1px;
  background-color: #ccc;
  z-order: 0;

}

.stepwizard-step {
  display: table-cell;
  text-align: center;
  position: relative;
}

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
.setwidthsel{
  width: 100px;
}
.amntFild{
  display: none;
}
.nonAccFild{
  display: none;
}
.showSeletedName{

  font-size: 15px;

  margin-top: 2%;

  text-align: center;

  font-weight: 600;

  color: #4f90b5;

}
.settblebrodr{
  border: 1px solid #cac6c6;
}
.tdlboxshadow{
  box-shadow: 0px 1px 4px -1px rgba(161,155,161,1);

}

.btn {
  display: inline-block;
  font-weight: 400;
  text-align: center;
  vertical-align: middle;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  padding: .375rem .75rem;
  font-size: 14px;
  line-height: 1.5;
  border-radius: .25rem;
  transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.btn-success {
  color: #fff;
  background-color: #28a745;
  border-color: #28a745;
}
.btn-info {
  color: #fff;
  background-color: #04a9ff;
  border-color: #04a9ff;
}
.text-center{
  text-align: center;
}


.title{
  margin-top: 50px;
  margin-bottom: 20px;
}

table {
  border-collapse: collapse;
}

.table-responsive {
  display: block;
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}

.table {
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #dee2e6;
}
.table td, .table th {
  padding: .75rem;
  vertical-align: top;

}
.container{
  max-width: 1200px;
  margin: 0px auto;
  padding: 0px 15px;
}
/* table{border-collapse:collapse;border-radius:25px;width:880px;} */
/*table, td, th{border:1px solid #00BB64;}*/
/*tr,input{height:30px;border:1px solid #c8bebe;}*/

.inputboxclr{
  border: 1px solid #d7d3d3;
}
.tdthtablebordr{
  border: 1px solid #00BB64;
}
input:focus{border:1px solid yellow;} 
.space{margin-bottom: 2px;}
.but{
  width:105px;
  background:#00BB64;
  border:1px solid #00BB64;
  height:40px;
  border-radius:3px;
  color:white;
  margin-top:10px;
  margin:0px 0px 0px 11px;
  font-size: 14px;
}

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
  padding: 8px;
  padding-bottom: 0px !important;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 1px solid #ddd;
  text-align: center;
}
.ref::before {
  color: navy;
  content: "Ch :";
}
.toalvaldesn{
  text-align: right;
  font-weight: 800;
  margin-top: 1%;
}
.debitotldesn{
  width: 277%;
  margin-left: 45%;
  text-align: end;
}
.credittotldesn{
  width: 277%;
  margin-left: -11%;
  text-align: end;
}
.debitcreditbox{
  width: 91px;
  text-align: end;
}
.savebtnstyle{
  color: #fff;
  background-color: #204d74;
  border-color: #122b40;
}
.cnaclbtnstyle{
  color: #fff;
  background-color: #d9534f;
  border-color: #d43f3a;
}
.instrumentlbl{
  font-size: 12px;
  margin-left: -5px;
}
.instTypeMode{
  width: 15%;
  margin-bottom: 5px;
}
.textdesciptn{
  width: 250px;
  margin-bottom: 5px;
}
.tdsratebtn{
  margin-top: 33% !important;
  font-weight: 600 !important;
  font-size: 10px !important;
}
.tdsratebtnHide{
  display: none;
}
.tdsInputBox{
  margin-bottom: 2%;
}
.modltitletext{
  text-align: center;
  font-weight: 700;
  color: #5696bb;
}
.textSizeTdsModl{
  font-size: 13px;
}
.numright{
  text-align: right;
}
.remarkbtn{
  display: flex;
  height: 26px;
}
@media screen and (max-width: 600px) {

  .debitotldesn{
    width: 89px;
    margin-bottom: 5px;
    margin-left: 13%;
  }

  .credittotldesn{
    width: 89px;
    margin-bottom: 5px;
    margin-left: -34%;
  }
  .totlsetinres{
    width: 130%;
  }
  .textdesciptn{
    margin-bottom: -1%;
  }
  .debitcreditbox{
    margin-top: 0%;
  }
  .dateWidth{
    width: 100% !important;
  }
  .vrmargin{
    margin-left: 0%;
  }
  .tcodemargin{
    margin-left: 0%;
  }
  .seriescodemargin{
    margin-left: 0%;
  }
  .seriescodewidth{
    width: 100% !important;
  }
  .sereiswidth{
    width: 100% !important;
  }
  .accnamewidth{
    width: 100% !important;
  }
  .pfctnamewidth{
    width: 100% !important;
  }
  .pfctnamemargin{
    margin-left: 0% !important;
  }
  .accnamemargin{
    margin-left: 0%;
  }

}
</style>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>
      Unit Master
      <small>Update Details</small>
    </h1>

    <ul class="breadcrumb">

      <li>

        <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>

      </li>

       <li>

        <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Master</a>

      </li>

       <li>

        <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>Unit Master</a>

      </li>

      <li class="active">

        <a href="{{ url('Master/Infrastructure/add-unit-master') }}"> Update Unit Master </a>

      </li>

    </ul>

  </section>



  <section class="content">

    <div class="row">

      <div class="col-sm-12"> 

        <div class="pull-right showinmobile">

          <a href="{{ url('/Master/Infrastructure/view-unit-master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Unit Master</a>

        </div>

        <div class="pull-right hideinmobile" style="padding: 10px;">

          <a href="{{ url('/Master/Infrastructure/view-unit-master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Unit Master</a>

        </div>

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



        <div class="row">

          <div class="col-sm-12">

            <div class="box box-primary Custom-Box">

              <div class="box-body">

                <form method="POST" enctype="multipart/form-data" id="scoreCardForm" >

                  @csrf

                  <div class="table-responsive">

                    <table class="table tdthtablebordr" border="1" cellspacing="0" id="tblMilestone">

                      <tr>

                        <th>

                          <input class='check_all' type='checkbox' onclick="select_all()" title="Delete All Row">

                        </th>

                        <th>Sr.No.</th>

                        <th>Unit Code <small style="color:red;font-size:14px;">*</small></th>

                        <th>Unit Name <small style="color:red;font-size:14px;">*</small></th>

                        <th>Unit Type <small style="color:red;font-size:14px;">*</small></th>

                        <th>Unit Area <small style="color:red;font-size:14px;">*</small></th>

                        <th>Unit Um <small style="color:red;font-size:14px;">*</small></th>

                        <th>Unit Rate <small style="color:red;font-size:14px;">*</small></th>

                        <th>Wing No <small style="color:red;font-size:14px;">*</small></th>

                        <th>Tower No <small style="color:red;font-size:14px;">*</small></th>

                        <th>Floor No <small style="color:red;font-size:14px;">*</small></th>


                        <th>Unit No <small style="color:red;font-size:14px;">*</small></th>


                      </tr>

                      <tr class="useful">

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          <input type='checkbox' class='case' title="Delete Single Row" onclick="select_all()"/>
                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <span id='snum'>1.</span>

                          <input type='hidden' name='ScoreCardMilestone[]' id='ScoreCardMilestone' value='1'>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <input type='text' name='unitCode[]' id='unitCodefun1' value='{{$acctype_list->UNIT_CODE}}' class='' style="margin-bottom:5px;width:120px;" autocomplete="off" ><br>

                          <input type='hidden' name='acctypeCode[]' id='unitCodefun1' value='{{$acctype_list->UNIT_CODE}}' class='' style="margin-bottom:5px;width:120px;" autocomplete="off">


                          <datalist>



                            <option value='' data-xyz ="" ></option>



                          </datalist>


                          <small id="unitErr1"></small>





                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <input type="text" name='unitName[]' id='UnitNameFun1' class=""  autocomplete="off" style="margin-bottom:5px;width:120px;" value="{{$acctype_list->UNIT_NAME}}" ><br>

                          <datalist >



                            <option value='' data-xyz ="" ></option>



                          </datalist>


                          <small id="unitnameErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <input list='unitList' type="text" name='unitType[]' id='unitTypeFun1' class="number"  autocomplete="off" style="width:120px;margin-bottom:5px;"  value="{{$acctype_list->UNIT_TYPE}}" onclick="funUnitCode(1)"  >

                          <datalist id="unitList">

                            @foreach ($unitList as $key)

                            <option value='<?= $key->UNITTYPE_DESC ?> - <?= $key->UNITTYPE_NAME ?>' data-xyz='<?= $key->UNITTYPE_NAME?>'>{{ $key->UNITTYPE_DESC   }} = {{ $key->UNITTYPE_NAME  }}</option>

                            @endforeach



                          </datalist>

                          <small id="unitTypeErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <input type="text" name='unitArea[]' id='unitAreaFun1' class=""  autocomplete="off" style="width:120px;margin-bottom:5px;"  value="{{$acctype_list->UNIT_AREA}}" maxlength="10" class="number" ><br>

                          <small id="unitAreaErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <input list="unitUm" type="text" name='unitUm[]' id='unitUmfun1' value="{{$acctype_list->UNIT_UM}}" class=""  autocomplete="off" style="width:120px;margin-bottom:5px;" onclick="funUniTum(1)"><br>


                          <datalist id="unitUm">

                            @foreach ($unitUM as $key)

                            <option value='<?= $key->UM_CODE ?> - <?= $key->UM_NAME ?>' data-xyz='<?= $key->UM_NAME?>'>{{ $key->UM_CODE   }} = {{ $key->UM_NAME  }}</option>

                            @endforeach

                          </datalist>

                          <small id="unitUmErr1"></small>

                        </td>


                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <input  type="text" name='unitRate[]' id='unitRate1' class="" autocomplete="off" style="width:120px;margin-bottom:5px;"  value="{{$acctype_list->UNIT_RATE}}" maxlength="10" class="number" ><br>

                          <small id="unitRateErr1"></small>

                        </td>

                        <td  class="tdthtablebordr" style='padding-top: 2%;'>

                          <input  list="plantList" type="text" name='wingNo[]' id='wingNo1' class=""  autocomplete="off" style="width:120px;margin-bottom:5px;" value="{{$acctype_list->WING_NO}}" onclick="funplantCode(1)" ><br>




                          <datalist id="plantList">


                            @foreach ($plantList as $key)

                            <option value='<?= $key->WING_NO ?>' data-xyz ="<?= $key->WING_NO?>" >{{ $key->WING_NO   }}</option>

                            @endforeach

                          </datalist>

                          <small id="wingNoErr1"></small>



                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <input  list="towerList" type="text" name='towerNo[]' id='towerNo1' class=""  autocomplete="off" style="width:120px;margin-bottom:5px;" value="{{$acctype_list->TOWER_NO}}" onclick="funTower(1)" ><br>

                          <datalist id="towerList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($plantList as $key)

                            <option value='<?php echo $key->TOWER_NO?>' data-xyz ="<?php echo $key->TOWER_NO; ?>" ><?php echo $key->TOWER_NO ; ?></option>

                            @endforeach

                          </datalist>

                          <small id="towerNoErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <input   list="floorList" type="text" name='floorNo[]' id='floorNo1' class=""  autocomplete="off" style="width:120px;margin-bottom:5px;" value="{{$acctype_list->FLOOR_NO}}" onclick="funFloor(1)" ><br>

                          <datalist id="floorList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($plantList as $key)

                            <option value='<?php echo $key->FLOOR_NO?>' data-xyz ="<?php echo $key->FLOOR_NO; ?>" ><?php echo $key->FLOOR_NO ; ?></option>

                            @endforeach

                          </datalist>

                          <small id="floorNoErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <input list="unitListto" type="text" name='unitNo[]' id='unitNo1' class=""  autocomplete="off" style="width:120px;margin-bottom:5px;" value="{{$acctype_list->UNIT_NO}}" onclick="funUnit(1)" ><br>

                          <datalist id="unitListto">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($plantList as $key)

                            <option value='<?php echo $key->UNIT_NO?>' data-xyz ="<?php echo $key->UNIT_NO; ?>" ><?php echo $key->UNIT_NO ;  ?></option>

                            @endforeach

                          </datalist>
                          <small id="unitNoErr1"></small>

                        </td>


                      </tr>

                    </table>

                  </div>

                  <div class="row col-md-12">
                    <div class="text-center">
                      <button type="button" class="btn btn-success" id="checkValidation"><i class="fa fa-save"></i> Update</button>
                      <button class="btn btn-warning" id="btnReset" type="reset"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp;Reset</button>
                    </div>
                  </div>

                  <div class="text-center"><small id="totalWErr"></small></div>
                </div>
              </div>
            </div>
          </div>


          
        </div>


      </form>


    </div>



  </div>
</div><!-- /.box-body -->


</div>

</div>


</div>

</section>
</div>


@include('admin.include.footer')


<script type="text/javascript">

  $(document).ready(function(){

      $("input.number").keypress(function(event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
      });

})

  function funUniTum(id){

    $("#unitUmfun"+id).bind('change', function () {  

      var val = $(this).val();

      console.log('val',val);

      var xyz = $('#unitUm option').filter(function() {


        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';



      if(msg == 'No Match'){
        $('#unitUmfun'+id).val('');
      }else{

      }
    })
  }   


  function funUnitCode(id){

    $("#unitTypeFun"+id).bind('change', function () {  

      var val = $(this).val();

      console.log('val',val);

      var xyz = $('#unitList option').filter(function() {


        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';



      if(msg == 'No Match'){
        $('#unitTypeFun'+id).val('');
      }else{

      }
    })
  }   



  function funplantCode(id){

    $("#wingNo"+id).bind('change', function () {  

      var val = $(this).val();

      console.log('val',val);

      var xyz = $('#plantList option').filter(function() {


        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';



      if(msg == 'No Match'){
        $('#wingNo'+id).val('');
      }else{

      }
    })
  }   


  function funTower(id){

    $("#towerNo"+id).bind('change', function () {  

      var val = $(this).val();

      console.log('val',val);

      var xyz = $('#towerList option').filter(function() {


        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';



      if(msg == 'No Match'){
        $('#towerNo'+id).val('');
      }else{

      }
    })
  }   

  function funFloor(id){

    $("#floorNo"+id).bind('change', function () {  

      var val = $(this).val();

      console.log('val',val);

      var xyz = $('#floorList option').filter(function() {


        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';



      if(msg == 'No Match'){
        $('#floorNo'+id).val('');
      }else{

      }
    })
  }   

  function funUnit(id){

    $("#unitNo"+id).bind('change', function () {  

      var val = $(this).val();

      console.log('val',val);

      var xyz = $('#plantList option').filter(function() {


        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';



      if(msg == 'No Match'){
        $('#unitNo'+id).val('');
      }else{

      }
    })
  }   




  $(function(){

    var i=2;

    $(".addMilestone").on('click',function(){

      count=$('#tblMilestone tr').length;

      countTr = count-1;

      var UnitCode       =  $('#unitCodefun'+countTr).val();
      var UnitName       =  $('#UnitNameFun'+countTr).val();
      var UnitType       =  $('#unitTypeFun'+countTr).val();
      var UnitArea       =  $('#unitAreaFun'+countTr).val();
      var UnitUm         =  $('#unitUmfun'+countTr).val();
      var UnitRate       =  $('#unitRate'+countTr).val();
      var WingNo         =  $('#wingNo'+countTr).val();
      var TowerNo        =  $('#towerNo'+countTr).val();
      var FloorNo        =  $('#floorNo'+countTr).val();
      var UnitNo         =  $('#unitNo'+countTr).val();


      if(UnitCode == ''){
        $('#unitErr'+countTr).html('Unit Code Is Required').css('color','red');
        return false;
      }
      else{
        $('#unitErr'+countTr).html('');
      }



      if(UnitName == ''){
        $('#unitnameErr'+countTr).html('Unit name Is Required').css('color','red');
        return false;
      }
      else{
        $('#unitnameErr'+countTr).html('');
      }



      if(UnitType == ''){
        $('#unitTypeErr'+countTr).html('Unit Type Is Required').css('color','red');
        return false;
      }
      else{
        $('#unitTypeErr'+countTr).html('');
      }



      if(UnitArea == ''){
        $('#unitAreaErr'+countTr).html('Unit Area Is Required').css('color','red');
        return false;
      }else{
        $('#unitAreaErr'+countTr).html('');
      }



      if(UnitUm == ''){
        $('#unitUmErr'+countTr).html('Unit Um Is Required').css('color','red');
        return false;
      }else{
        $('#unitUmErr'+countTr).html('');
      }


      if(UnitRate == ''){
        $('#unitRateErr'+countTr).html('Unit Rate Is Required').css('color','red');
        return false;
      }else{
        $('#unitRateErr'+countTr).html('');
      }


      if(WingNo == ''){
        $('#wingNoErr'+countTr).html('Wing No Is Required').css('color','red');
        return false;
      }else{
        $('#wingNoErr'+countTr).html('');
      }


      if(TowerNo == ''){
        $('#towerNoErr'+countTr).html('Tower No Is Required').css('color','red');
        return false;

      }else{

        $('#towerNoErr'+countTr).html('');
      }


      if(FloorNo == ''){
        $('#floorNoErr'+countTr).html('Floor no Is Required').css('color','red');
        return false;

      }else{

        $('#floorNoErr'+countTr).html('');

      }

      if(UnitNo == ''){
        $('#unitNoErr'+countTr).html('Unit No Is Required').css('color','red');
        return false;
      }else{
        $('#unitNoErr'+countTr).html('');



        var data="<tr><td class='tdthtablebordr' style='padding-top: 23px;'><input type='checkbox' class='case'/></td><td class='tdthtablebordr' style='padding-top: 22px;'><span id='snum"+i+"'>"+count+".</span><input type='hidden' name='ScoreCardMilestone[]' id='ScoreCardMilestone' value='"+count+"'></td>";

        data +="<td class='tdthtablebordr' style='padding-top: 2%;'><input  type='text' name='unitCode[]' id='unitCodefun"+count+"' value='' style='width:120px;margin-bottom: 5px; z-index: 0;'autocomplete='off'><small id='unitErr1"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input type='text' name='unitName[]' id='UnitNameFun"+count+"' value='' style='width:120px;margin-bottom: 5px; z-index: 0;'autocomplete='off' ><br><small id='unitnameErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'> <input id='unitTypeErr"+count+"' list='unitList' type='text' name='unitType[]' class='number'  autocomplete='off'style='width:120px;margin-bottom:5px;'onclick='funUnitCode("+count+")'><datalist id='unitList'>@foreach ($unitList as $key)<option value='<?= $key->UNITTYPE_DESC ?> - <?= $key->UNITTYPE_NAME ?>' data-xyz='<?= $key->UNITTYPE_NAME?>'>{{ $key->UNITTYPE_DESC   }} = {{ $key->UNITTYPE_NAME  }}</option>@endforeach</datalist><small id='unitTypeErr1'></small><small id='unitTypeErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input type='text' name='unitArea[]' id='unitAreaFun"+count+"' class='' style='width:120px;margin-bottom: 5px;' autocomplete='off' ><br><small id='unitAreaErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input  type='text' list='unitUm' name='unitUm[]' id='unitUmfun"+count+"' class='' style='width:120px;margin-bottom: 5px;'' autocomplete='off'><br><small id='unitUmErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input type='text' name='unitRate[]' id='unitRate"+count+"' class='' style='width:120px;margin-bottom: 5px;' autocomplete='off'><br><small id='unitRateErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input list='plantList' name='wingNo[]'id='wingNo"+count+"' class='' style='width:120px;margin-bottom: 5px;' autocomplete='off'><datalist id='plantList'>@foreach ($plantList as $key)<option value='<?php echo $key->WING_NO?>' data-xyz ='<?php echo $key->WING_NO; ?>' ><?php echo $key->WING_NO ;  ?></option>@endforeach</datalist><br><small id='wingNoErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input list='towerList' type='text' name='towerNo[]' id='towerNo"+count+"' class='' style='width:120px;margin-bottom: 5px;' autocomplete='off'><datalist id='plantList'>@foreach ($plantList as $key)<option value='<?php echo $key->TOWER_NO?>' data-xyz ='<?php echo $key->TOWER_NO; ?>' ><?php echo $key->TOWER_NO ;  ?></option>@endforeach</datalist><small id='towerNoErr1"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input input list='floorList' type='text' name='floorNo[]' id='floorNo"+count+"' class='' style='width:120px;margin-bottom: 5px;' autocomplete='off'><datalist id='plantList'>@foreach ($plantList as $key)<option value='<?php echo $key->FLOOR_NO?>' data-xyz ='<?php echo $key->FLOOR_NO; ?>' ><?php echo $key->FLOOR_NO ;  ?></option>@endforeach</datalist><small id='floorNoErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input list='plantList' type='text' name='unitNo[]' id='unitNo"+count+"' class='' style='width:120px;margin-bottom: 5px;' autocomplete='off'><datalist id='unitListto'>@foreach ($plantList as $key)<option value='<?php echo $key->UNIT_NO?>' data-xyz ='<?php echo $key->UNIT_NO; ?>' ><?php echo $key->UNIT_NO ;  ?></option>@endforeach</datalist><small id='unitNoErr"+count+"'></small></td></tr>";

        $('#tblMilestone').append(data);

        i++;


      }

    });

});



$(".delete").on('click', function() {


  $('.case:checkbox:checked').parents('#tblScoreCard tr').remove();

  $('.check_all').prop("checked", false); 

  check();

});

function check(){

  obj = $('#tblScoreCard tr').find('span');

  $.each( obj, function( key, value ) {

    id=value.id;

    $('#'+id).html(key+1);

  });

}

$(".delete").on('click', function() {

  $('.case:checkbox:checked').parents('#tblMilestone tr').remove();

  $('.check_all').prop("checked", false); 

  checkMilestone();

});

function checkMilestone(){

  obj = $('#tblMilestone tr').find('span');

  $.each( obj, function( key, value ) {

    id=value.id;

    $('#'+id).html(key+1);

  });

}



$(document).ready(function(){

  $('#checkValidation').on('click',function(){



    var count        = $('#tblScoreCard tr').length;
    var tblMilestone = $('#tblMilestone tr').length;

    var trCount      = count-1;
    var tblCount     = tblMilestone-1;


    for(var q=0;q<tblCount;q++){

      var y = q +1;

      var UnitCode       =  $('#unitCodefun'+y).val();
      var UnitName       =  $('#UnitNameFun'+y).val();
      var UnitType       =  $('#unitTypeFun'+y).val();
      var UnitArea       =  $('#unitAreaFun'+y).val();
      var UnitUm         =  $('#unitUmfun'+y).val();
      var UnitRate       =  $('#unitRate'+y).val();
      var WingNo         =  $('#wingNo'+y).val();
      var TowerNo        =  $('#towerNo'+y).val();
      var FloorNo        =  $('#floorNo'+y).val();
      var UnitNo         =  $('#unitNo'+y).val();


      if(UnitCode == ''){

        $('#unitErr'+y).html('Unit Code Is Required').css('color','red');
        return false;

      }else{

        $('#unitErr'+y).html('');
      }

      if(UnitName == ''){

        $('#unitnameErr'+y).html('Unit Name Required').css('color','red');
        return false;

      }else{

        $('#unitnameErr'+y).html('');

      }

      if(UnitType == ''){

        $('#unitTypeErr'+y).html('Unit Type Required').css('color','red');
        return false;

      }else{

        $('#unitTypeErr'+y).html('');
      }

      if(UnitArea == ''){

        $('#unitAreaErr'+y).html('Unit Area Is Required').css('color','red');
        return false;

      }else{

        $('#unitAreaErr'+y).html('');
      }

      if(UnitUm == ''){

        $('#unitUmErr'+y).html('Unit Um Is Required').css('color','red');
        return false;

      }else{

        $('#unitUmErr'+y).html('');
      }

      if(UnitRate == ''){

        $('#unitRateErr'+y).html('Unit Rate Is Required').css('color','red');
        return false;

      }else{

        $('#unitRateErr'+y).html('');
      }


      if(WingNo == ''){

        $('#wingNoErr'+y).html('Wing No Is Required').css('color','red');
        return false;

      }else{

        $('#wingNoErr'+y).html('');
      }


      if(TowerNo == ''){

        $('#towerNoErr'+y).html('Tower No Is Required').css('color','red');
        return false;

      }else{

        $('#towerNoErr'+y).html('');
      }


      if(FloorNo == ''){

        $('#floorNoErr'+y).html('Floor No Is Required').css('color','red');

        return false;

      }else{

        $('#floorNoErr'+y).html('');

      }



      if(UnitNo == ''){

        $('#unitNoErr'+y).html('UnitNo No Is Required').css('color','red');

        return false;

      }else{

        $('#unitNoErr'+y).html('');

      }






    }

    var data  = $('#scoreCardForm').serialize();

    $.ajaxSetup({

      headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

    $.ajax({

      type: 'JSON',

      url: "{{ url('/Master/Infrastructure/update-unit-master') }}",

      data: data,

      method:"POST",


      success: function (data) {
        var data1 = JSON.parse(data);

        console.log('data1',data1);

        if(data1.response == 'success'){

// return redirect('/Master/Infrastructure/edit-unit-master');
          window.location.href = "{{ url('/Master/Infrastructure/view-unit-master')}}";

        }else{

        }

      }


    });

  });
});






</script>




@endsection
