@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .required-field::before {
    content: "*";
    color: red;
  }
  .showinmobile{
    display: none;
  }
  .beforhidetble{
    display: none;
  }
  .popover{
    left: 80.4922px!important;
    width: 100%!important;
  }
  .setetxtintd{
    font-size: 12px !important;
    padding-top: 2% !important;
    padding-bottom: 2% !important;
  }
  .nameheading{
    font-size: 12px;
  }
  .setheightinput{
    height: 0%;
  }
  .custom-options {
    position: absolute;
    display: block;
    top: 100%;
    left: 0;
    right: 0;
    border-top: 0;
    background: #f3eded;
    transition: all 0.5s;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    z-index: 2;
    -webkit-box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
  }
  .custom-select .custom-options {
    opacity: 1;
    visibility: visible;
    pointer-events: all;
  }
  .custom-option {
    position: relative;
    display: block;
    padding-top: 10px;
    padding-left: 21%;
    font-size: 14px;
    font-weight: 600;
    color: #3b3b3b;
    line-height: 2px;
    cursor: pointer;
    transition: all 0.5s;
  }
  .CloseListDepot{
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
    .popover {
      left: 56.4922px!important;
      width: 100%!important;
    }
     .setheightinput{
      width: 65%!important;
    }
    #serachcode{
      margin-left: 5%!important;
    }
  }
  .tabTable > table > tbody > tr > th{
    border:1px solid grey !important;
    background-color: #b6d2f0;
    padding:2px;
    font-size:12px;
  }
  .tabTable > table > tbody > tr > td{
    border:1px solid grey !important;
    padding:2px;
  }
  .tabtask{
   padding: 6px !important; 
   font-weight:700;
   font-size:12px;
  }
  .inputboxclr {
    border: 1px solid #d7d3d3;
    width: 100%;
    margin-bottom: 5px;
    border-radius: 4px;
    font-size: 12px;
    height: 20px;
    font-weight: 600;
    padding: 1px 9px;
  }
  .readField{
    background-color:#e3e1e1;
  }
  .tabTable > #tableTwo > tbody > tr > th {
    border: 1px solid grey !important;
    background-color: #efdbcc;
    padding: 2px;
    font-size: 12px;
  }

  .tabTable > #tableThree > tbody > tr > th {
    border: 1px solid grey !important;
    background-color: #f2dcb7;
    padding: 2px;
    font-size: 12px;
  }
</style>

<div class="content-wrapper">

  <section class="content-header">

    <h1>Account Item Rate Master<small>Add Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ URL('/dashboard')}}">Master</a></li>

      <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Account Item Rate Master</a></li>

      <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Add Account Item Rate Master</a></li>
         
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-md-12">

        <div class="box box-primary Custom-Box" >

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Account Item Rate Master</h2>

            <div class="box-tools pull-right">

              <a href="{{ url('/Master/ColdStorage/View-Acc-Item-Rate-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Account Item Rate Master</a>

            </div> 

          </div><!-- /.box-header -->

          <div class="box-body">

            <form action="{{ url('Master/ColdStorage/Save-Account-Item-Rate') }}" method="POST" >

              @csrf

              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Company Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input list="comp_list" class="form-control" name="comp_code" id="comp_code" value="{{ $comp_code }}" placeholder="Enter Company Code" id="comp_code" readonly autocomplete="off">

                      <datalist id="comp_list">
                          
                        <option value=""> --SELECT-- </option>
                        @foreach($compList as $key)

                          <option value='<?php echo $key->COMP_CODE; ?>'   data-xyz ="<?php echo $key->COMP_NAME; ?>"><?php echo $key->COMP_NAME ; echo " [".$key->COMP_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Company Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                      <input type="text" class="form-control" name="comp_name" id="comp_name" value="{{$comp_name}}" placeholder="Enter Company Name" id="comp_name" readonly autocomplete="off">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('comp_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Account Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input list="acc_list" class="form-control" name="acc_code" id="acc_code" value="{{ old('acc_code')}}" placeholder="Enter Account Code" id="acc_code" autocomplete="off">

                      <datalist id="acc_list">
                          
                        <option value=""> --SELECT-- </option>
                        @foreach($partyList as $key)

                          <option value='<?php echo $key->ACC_CODE; ?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>"><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('acc_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Account Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                      <input type="text" class="form-control" name="acc_name" id="acc_name" value="{{ old('acc_name')}}" placeholder="Enter Account Name" id="acc_name" autocomplete="off" readonly>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('acc_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>


              </div>

              <div class="row">

                <div class="col-md-1"></div>

                <div class="col-md-10">

                  <div id="childData" class="chieldTable">

                    <div class="nav-tabs-custom" style="border: 1px solid grey;">

                      <ul class="nav nav-tabs" style="background-color: #ebe7db;height: 32px;">
                        <li class="active"><a href="#tab1" class="tabtask" data-toggle="tab" aria-expanded="true">Item Packing List</a></li>
                        <li class=""><a href="#tab2" class="tabtask" data-toggle="tab" aria-expanded="false">Seasonal</a></li>
                        <li class=""><a href="#tab3" class="tabtask" data-toggle="tab" aria-expanded="false">Fixed</a></li>
                        <li class=""><a href="#tab4" class="tabtask" data-toggle="tab" aria-expanded="false">Chamber</a></li>
                      </ul>

                      <div class="tab-content">

                      <!--  ---------- start tab 1 -----------  -->

                        <div class="tab-pane active tabTable" id="tab1">

                          <table class="table-border" id="tableOne" style="width: 100%;">
                            <tr>
                              <th><input class='check_allOne'  type='checkbox' onclick="select_all()"/></th>
                              <th>Sr.No.</th>
                              <th>Item Code / Name</th>
                              <th>Item Packing Code / Name</th>
                              <th>Rate</th>
                            </tr>

                            <tr>
                              <td class="tdthtablebordr">
                                  <input type='checkbox' class='caseOne' id="firstrow" />
                              </td>
                              <td class="tdthtablebordr">
                                <span id='snum' style="width: 10px;">1.</span>
                              </td> 
                              <td style="width: 40%;">
                                  <div class="input-group" style="width: 100%;">
                                    <input list="itemList11" class="inputboxclr"  id='itemCd11' name="ipItemCode[]" onchange="getitemPacking(1,1)" autocomplete="off" />

                                    <datalist  id="itemList11">

                                        <option selected="selected" value="">-- Select --</option>

                                        @foreach ($itemList as $key)

                                        <option value='<?php echo $key->ITEM_CODE?>' data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                                        @endforeach

                                    </datalist>
                                  </div>
                              </td>

                              <td style="width: 40%;">
                                <div class="input-group" style="width: 100%;">

                                  <input list='itemPackingList11' class="inputboxclr"  id='itemPackCode11' name="ipPackingCode[]" onchange="itemPackingVal(1,1)" autocomplete="off"/>

                                  <datalist  id="itemPackingList11">

                                      <option selected="selected" value="">-- Select --</option>

                                  </datalist>
                                </div>
                              </td>

                              <td style="width: 20%;">
                                <div class="input-group" style="width: 100%;">

                                  <input type='text' class="inputboxclr"  id='rate11' name="ipRate[]" autocomplete="off"/>
                                </div>
                              </td>
                            </tr> 
                          </table>

                          <button type="button" class='btn btn-info addmoreOne' id="addmorhidn" style="padding: 2px;margin-top: 1px;"><i class="fa fa-plus" aria-hidden="true" style="font-size: 10px;"></i>&nbsp; Add More</button>

                          <button type="button" class='btn btn-danger deleteOne' id="deletehidn" style="padding: 2px;margin-top: 1px;"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                        </div>

                      <!--  ---------- end tab 1 -----------  -->

                      <!--  ---------- start tab 2 -----------  -->

                        <div class="tab-pane tabTable" id="tab2">
                          
                          <table class="table-border" id="tableTwo" style="width: 100%;">
                            <tr>
                              <th><input class='check_allTwo'  type='checkbox' onclick="select_all()"/></th>
                              <th>Sr.No.</th>
                              <th>Item Code / Name</th>
                              <th>Item Packing Code / Name</th>
                              <th>Rate</th>
                            </tr>

                            <tr>
                              <td class="tdthtablebordr">
                                  <input type='checkbox' class='caseTwo' id="Secondrow" />
                              </td>
                              <td class="tdthtablebordr">
                                <span id='snum' style="width: 10px;">1.</span>
                              </td> 
                              <td style="width: 40%;">
                                  <div class="input-group" style="width: 100%;">
                                    <input list="itemList21" class="inputboxclr"  id='itemCd21' name="sItemCode[]" onchange="getitemPacking(2,1)" autocomplete="off" />

                                    <datalist  id="itemList21">

                                        <option selected="selected" value="">-- Select --</option>

                                        @foreach ($itemList as $key)

                                        <option value='<?php echo $key->ITEM_CODE?>' data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                                        @endforeach

                                    </datalist>
                                  </div>
                              </td>

                              <td style="width: 40%;">
                                <div class="input-group" style="width: 100%;">

                                  <input list='itemPackingList21' class="inputboxclr"  id='itemPackCode21' name="sPackingCode[]" onchange="itemPackingVal(2,1)" autocomplete="off"/>

                                  <datalist  id="itemPackingList21">

                                      <option selected="selected" value="">-- Select --</option>

                                  </datalist>
                                </div>
                              </td>

                              <td style="width: 20%;">
                                <div class="input-group" style="width: 100%;">

                                  <input type='text' class="inputboxclr"  id='rate21' name="sRate[]" autocomplete="off"/>
                                </div>
                              </td>
                            </tr> 
                          </table>

                          <button type="button" class='btn btn-info addmoreTwo' id="addmorhidn" style="padding: 2px;margin-top: 1px;"><i class="fa fa-plus" aria-hidden="true" style="font-size: 10px;"></i>&nbsp; Add More</button>

                          <button type="button" class='btn btn-danger deleteTwo' id="deletehidn" style="padding: 2px;margin-top: 1px;"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                        </div>

                      <!--  ---------- end tab 2 -----------  -->
                      <!--  ---------- start tab 3 -----------  -->

                        <div class="tab-pane tabTable" id="tab3">
                          
                          <table class="table-border" id="tableThree" style="width: 100%;">
                            <tr>
                              <th><input class='check_allThree'  type='checkbox' onclick="select_all()"/></th>
                              <th>Sr.No.</th>
                              <th>Item Code / Name</th>
                              <th>Item Packing Code / Name</th>
                              <th>Rate</th>
                            </tr>

                            <tr>
                              <td class="tdthtablebordr">
                                  <input type='checkbox' class='caseThree' id="Thirdrow" />
                              </td>
                              <td class="tdthtablebordr">
                                <span id='snum' style="width: 10px;">1.</span>
                              </td> 
                              <td style="width: 40%;">
                                  <div class="input-group" style="width: 100%;">
                                    <input list="itemList31" class="inputboxclr"  id='itemCd31' name="fItemCode[]" onchange="getitemPacking(3,1)" autocomplete="off" />

                                    <datalist  id="itemList31">

                                        <option selected="selected" value="">-- Select --</option>

                                        @foreach ($itemList as $key)

                                        <option value='<?php echo $key->ITEM_CODE?>' data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                                        @endforeach

                                    </datalist>
                                  </div>
                              </td>

                              <td style="width: 40%;">
                                <div class="input-group" style="width: 100%;">

                                  <input list='itemPackingList31' class="inputboxclr"  id='itemPackCode31' name="fPackingCode[]" onchange="itemPackingVal(3,1)" autocomplete="off" />

                                  <datalist  id="itemPackingList31">

                                      <option selected="selected" value="">-- Select --</option>

                                  </datalist>
                                </div>
                              </td>

                              <td style="width: 20%;">
                                <div class="input-group" style="width: 100%;">

                                  <input type='text' class="inputboxclr"  id='rate31' name="fRate[]" autocomplete="off" />
                                </div>
                              </td>
                            </tr> 
                          </table>

                          <button type="button" class='btn btn-info addmoreThree' id="addmorhidn" style="padding: 2px;margin-top: 1px;"><i class="fa fa-plus" aria-hidden="true" style="font-size: 10px;"></i>&nbsp; Add More</button>

                          <button type="button" class='btn btn-danger deleteThree' id="deletehidn" style="padding: 2px;margin-top: 1px;"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                        </div>

                        <!--  ---------- end tab 3 -----------  -->

                        <!--  ---------- start tab 4 -----------  -->

                        <div class="tab-pane tabTable" id="tab4">
                          
                          <table class="table-border" id="tableFour" style="width: 100%;">
                            <tr>
                              <th><input class='check_allFour'  type='checkbox' onclick="select_all()"/></th>
                              <th>Sr.No.</th>
                              <th>Item Code / Name</th>
                              <th>Item Pkg Code / Name</th>
                              <th>CS Code / Name</th>
                              <th>Chamber Code / Name</th>
                              <th>Floor Code / Name</th>
                              <th>Block Code / Name</th>
                            </tr>

                            <tr>
                              <td class="tdthtablebordr">
                                  <input type='checkbox' class='caseFour' id="Forthrow" />
                              </td>

                              <td class="tdthtablebordr">
                                <span id='snum' style="width: 10px;">1.</span>
                              </td> 

                              <td>
                                  <div class="input-group" style="width: 100%;">
                                    <input list="itemList41" class="inputboxclr"  id='itemCd41' name="chItemCd[]" onchange="getitemPacking(4,1)" autocomplete="off" />

                                    <datalist  id="itemList41">

                                        <option selected="selected" value="">-- Select --</option>

                                        @foreach ($itemList as $key)

                                        <option value='<?php echo $key->ITEM_CODE?>' data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                                        @endforeach

                                    </datalist>
                                  </div>
                              </td>

                              <td>
                                <div class="input-group" style="width: 100%;">

                                  <input list='itemPackingList41' class="inputboxclr"  id='itemPackCode41' name="chItemPkg[]" onchange="itemPackingVal(4,1)" autocomplete="off" />

                                  <datalist  id="itemPackingList41">

                                      <option selected="selected" value="">-- Select --</option>

                                  </datalist>
                                </div>
                              </td>

                              <td>
                                  <div class="input-group" style="width: 100%;">
                                    <input type="text" class="inputboxclr readField"  id='csCode41' name="chcsCd[]" readonly/>
                                  </div>
                              </td>

                              <td>
                                <div class="input-group" style="width: 100%;">

                                  <input type="text" class="inputboxclr readField"  id='chamberCode41' name="chchamberCd[]" readonly/>
                                </div>
                              </td>

                              <td>
                                <div class="input-group" style="width: 100%;">

                                  <input type='text' class="inputboxclr readField"  id='floorCode41' name="chFloorCd[]" readonly/>

                                </div>
                              </td>

                              <td>
                                <div class="input-group" style="width: 100%;">

                                  <input list='blockList41' class="inputboxclr"  id='blockCode41' name="chBlockCd[]" onchange="blockList(4,1)" autocomplete="off" />

                                  <datalist  id="blockList41">

                                    <option selected="selected" value="">-- Select --</option>

                                      @foreach ($blockList as $key)

                                      <option value='<?php echo $key->BLOCK_CODE?>' data-xyz ="<?php echo $key->BLOCK_NAME; ?>" >{{$key->CS_NAME}}[{{$key->CS_CODE}}]-{{$key->CHAMBER_NAME}}[{{$key->CHAMBER_CODE}}]-{{$key->FLOOR_NAME}}[{{$key->FLOOR_CODE}}]-{{$key->BLOCK_NAME}}[{{$key->BLOCK_CODE}}]</option>

                                      @endforeach

                                  </datalist>
                                </div>
                              </td>

                            </tr>
                          </table>

                          <button type="button" class='btn btn-info addmoreFour' id="addmorhidn" style="padding: 2px;margin-top: 1px;"><i class="fa fa-plus" aria-hidden="true" style="font-size: 10px;"></i>&nbsp; Add More</button>

                          <button type="button" class='btn btn-danger deleteFour' id="deletehidn" style="padding: 2px;margin-top: 1px;"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                        </div>

                        <!--  ---------- end tab 4 -----------  -->
                        
                      </div>

                    </div>

                  </div>
                  
                </div>
                <div class="col-md-1"></div>
                
              </div>


              <div style="text-align: center;">

                <button type="Submit" class="btn btn-primary">

                  <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                </button>

              </div>

            </form>

          </div><!-- /.box-body -->

        </div>

      </div>

    </div>

  </section>

</div>


@include('admin.include.footer')


<script type="text/javascript">

/* ------------- tab one item packing list ---------------- */

  $(".deleteOne").on('click', function() {

      var rowCount = $('#tableOne tr').length;
      
      $('.caseOne:checkbox:checked').parents("tr").remove();

      $('.check_allOne').prop("checked", false); 

      check();

  }); /*--function close--*/

  var i=2;

  $(".addmoreOne").on('click',function(){

    count=$('#tableOne tr').length;

    var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='caseOne'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span> </td>"+
        "<td style='width: 40%;'><div class='input-group' style='width: 100%;'><input list='itemList1"+i+"' class='inputboxclr'  id='itemCd1"+i+"' name='ipItemCode[]'  onchange='getitemPacking(1,"+i+")' /><datalist  id='itemList1"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($itemList as $key)<option value='<?php echo $key->ITEM_CODE?>' data-xyz ='<?php echo $key->ITEM_NAME; ?>' ><?php echo $key->ITEM_NAME ; echo ' ['.$key->ITEM_CODE.']' ; ?></option>@endforeach</datalist></div></td>"+
       
        "<td style='width: 40%;'><div class='input-group' style='width: 100%;'><input list='itemPackingList1"+i+"' class='inputboxclr' id='itemPackCode1"+i+"' name='ipPackingCode[]' onchange='itemPackingVal(1,"+i+")' /><datalist  id='itemPackingList1"+i+"'><option selected='selected' value=''>-- Select --</option></datalist></div></td>"+
       
        "<td style='width: 20%;'><div class='input-group'  style='width: 100%;'><input type='text' class='inputboxclr'  id='rate1"+i+"' name='ipRate[]'/></div></td></tr>";

    $('#tableOne').append(data);

    i++;
  });

  function check(){

    obj = $('#tableOne tr').find('span');

    if(obj.length==0){
    }else{
      $.each( obj, function( key, value ) {

          id= value.id;

          $('#'+id).html(key+1);

      });
    }
  }

/* ------------- tab one item packing list ---------------- */

/* ------------- tab two seasonal ---------------- */

  $(".deleteTwo").on('click', function() {

      var rowCount = $('#tableTwo tr').length;
      
      $('.caseTwo:checkbox:checked').parents("tr").remove();

      $('.check_allTwo').prop("checked", false); 

      checkTwo();

  }); /*--function close--*/

  var j=2;

  $(".addmoreTwo").on('click',function(){

    countTwo=$('#tableTwo tr').length;



    var dataTwo="<tr><td class='tdthtablebordr'><input type='checkbox' class='caseTwo' id='Secondrow' /></td>"+

              "<td class='tdthtablebordr'><span id='snum"+j+"' style='width: 10px;'>"+countTwo+".</span></td>"+
              "<td style='width: 40%;'><div class='input-group' style='width: 100%;'><input list='itemList2"+j+"' class='inputboxclr'  id='itemCd2"+j+"' name='sItemCode[]' onchange='getitemPacking(2,"+j+")' /><datalist  id='itemList2"+j+"'><option selected='selected' value=''>-- Select --</option>@foreach ($itemList as $key)<option value='<?php echo $key->ITEM_CODE?>' data-xyz ='<?php echo $key->ITEM_NAME; ?>' ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>@endforeach</datalist></div></td>"+
              "<td style='width: 40%;'><div class='input-group' style='width: 100%;'><input list='itemPackingList2"+j+"' class='inputboxclr'  id='itemPackCode2"+j+"' name='sPackingCode[]' onchange='itemPackingVal(2,"+j+")'/><datalist  id='itemPackingList2"+j+"'><option selected='selected' value=''>-- Select --</option></datalist></div></td>"+
              "<td style='width: 20%;'><div class='input-group' style='width: 100%;'><input type='text' class='inputboxclr'  id='rate2"+j+"' name='sRate[]'/></div></td></tr>";

    $('#tableTwo').append(dataTwo);

    j++;
  });

  function checkTwo(){

    obj = $('#tableTwo tr').find('span');

    if(obj.length==0){
    }else{
      $.each( obj, function( key, value ) {

          id= value.id;

          $('#'+id).html(key+1);

      });
    }
  }

/* ------------- tab two seasonal  ---------------- */

/* ------------- tab three seasonal  ---------------- */

  $(".deleteThree").on('click', function() {

      var rowCount = $('#tableThree tr').length;
      
      $('.caseThree:checkbox:checked').parents("tr").remove();

      $('.check_allThree').prop("checked", false); 

      checkThree();

  }); /*--function close--*/

  var k=2;

  $(".addmoreThree").on('click',function(){

    countThree=$('#tableThree tr').length;



    var dataThee="<tr><td class='tdthtablebordr'><input type='checkbox' class='caseThree' id='Thirdrow' /></td>"+

              "<td class='tdthtablebordr'><span id='snum"+k+"' style='width: 10px;'>"+countThree+".</span></td> "+
              "<td style='width: 40%;'><div class='input-group' style='width: 100%;'><input list='itemList3"+k+"' class='inputboxclr'  id='itemCd3"+k+"' name='fItemCode[]' onchange='getitemPacking(3,"+k+")' /><datalist  id='itemList3"+k+"'><option selected='selected' value=''>-- Select --</option>@foreach ($itemList as $key)<option value='<?php echo $key->ITEM_CODE?>' data-xyz ='<?php echo $key->ITEM_NAME; ?>' ><?php echo $key->ITEM_NAME ; echo ' ['.$key->ITEM_CODE.']' ; ?></option>@endforeach</datalist></div></td>"+
              "<td style='width: 40%;'><div class='input-group' style='width: 100%;'><input list='itemPackingList3"+k+"' class='inputboxclr'  id='itemPackCode3"+k+"' name='fPackingCode[]' onchange='itemPackingVal(3,"+k+")'/><datalist  id='itemPackingList3"+k+"'><option selected='selected' value=''>-- Select --</option></datalist></div></td>"+
              "<td style='width: 20%;'><div class='input-group' style='width: 100%;'><input type='text' class='inputboxclr'  id='rate3"+k+"' name='fRate[]'/></div></td></tr>";

    $('#tableThree').append(dataThee);

    k++;
  });

  function checkThree(){

    obj = $('#tableThree tr').find('span');

    if(obj.length==0){
    }else{
      $.each( obj, function( key, value ) {

          id= value.id;

          $('#'+id).html(key+1);

      });
    }
  }


/* ------------- tab three seasonal  ---------------- */

/* ------------- tab four chamber  ---------------- */

    $(".deleteFour").on('click', function() {

        var rowCount = $('#tableFour tr').length;
        
        $('.caseFour:checkbox:checked').parents("tr").remove();

        $('.check_allFour').prop("checked", false); 

        checkFour();

    });

    var n=2;

    $(".addmoreFour").on('click',function(){

      countFour = $('#tableFour tr').length;

      var dataFour = "<tr><td class='tdthtablebordr'><input type='checkbox' class='caseFour' id='Forthrow'/></td>"+
          "<td class='tdthtablebordr'><span id='snum"+n+"' style='width: 10px;'>"+countFour+".</span></td>"+
          "<td><div class='input-group' style='width: 100%;'><input list='itemList4"+n+"' class='inputboxclr'  id='itemCd4"+n+"' name='chItemCd[]' onchange='getitemPacking(4,"+n+")' autocomplete='off' /><datalist  id='itemList4"+n+"'><option selected='selected' value=''>-- Select --</option>@foreach ($itemList as $key)<option value='<?php echo $key->ITEM_CODE?>' data-xyz ='<?php echo $key->ITEM_NAME; ?>' ><?php echo $key->ITEM_NAME ; echo ' ['.$key->ITEM_CODE.']' ; ?></option>@endforeach</datalist></div></td>"+
          "<td><div class='input-group' style='width: 100%;'><input list='itemPackingList4"+n+"' class='inputboxclr'  id='itemPackCode4"+n+"' name='chItemPkg[]' onchange='itemPackingVal(4,"+n+")' autocomplete='off' /><datalist  id='itemPackingList4"+n+"'><option selected='selected' value=''>-- Select --</option></datalist></div></td>"+
          "<td><div class='input-group' style='width: 100%;'><input type='text' class='inputboxclr readField'  id='csCode4"+n+"' name='chcsCd[]' readonly/></div></td>"+
          "<td><div class='input-group' style='width: 100%;'><input type='text' class='inputboxclr readField'  id='chamberCode4"+n+"' name='chchamberCd[]' readonly/></div></td>"+
          "<td><div class='input-group' style='width: 100%;'><input type='text' class='inputboxclr readField'  id='floorCode4"+n+"' name='chFloorCd[]' readonly/></div></td>"+
          "<td><div class='input-group' style='width: 100%;'><input list='blockList4"+n+"' class='inputboxclr'  id='blockCode4"+n+"' name='chBlockCd[]' onchange='blockList(4,"+n+")' autocomplete='off' /><datalist  id='blockList4"+n+"'><option selected='selected' value=''>-- Select --</option>@foreach ($blockList as $key)<option value='<?php echo $key->BLOCK_CODE?>' data-xyz ='<?php echo $key->BLOCK_NAME; ?>' >{{$key->CS_NAME}}[{{$key->CS_CODE}}]-{{$key->CHAMBER_NAME}}[{{$key->CHAMBER_CODE}}]-{{$key->FLOOR_NAME}}[{{$key->FLOOR_CODE}}]-{{$key->BLOCK_NAME}}[{{$key->BLOCK_CODE}}]</option>@endforeach</datalist></div></td></tr>";

      $('#tableFour').append(dataFour);

    n++;

  }); /*--function close--*/

  function checkFour(){

    obj = $('#tableFour tr').find('span');

    if(obj.length==0){
    }else{
      $.each( obj, function( key, value ) {

          id= value.id;

          $('#'+id).html(key+1);

      });
    }
  }

/* ------------- tab four chamber  ---------------- */

  $(document).ready(function(){


    $("#acc_code").bind('change', function () {

        var acccode =  $(this).val();
        var xyz = $('#acc_list option').filter(function() {

          return this.value == acccode;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
           $(this).val('');
           $('#acc_name').val('');
        }else{
           $('#acc_name').val(msg);
        }
    });

  });

  function blockList(tab,slno){

    var blockCd = $('#blockCode'+tab+slno).val();

    var xyz = $('#blockList'+tab+slno+' option').filter(function() {

      return this.value == blockCd;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
      $('#blockCode'+tab+slno).val('');
      $('#floorCode'+tab+slno).val('');
      $('#chamberCode'+tab+slno).val('');
      $('#csCode'+tab+slno).val('');
    }else{
      $('#floorCode'+tab+slno).val('');
      $('#chamberCode'+tab+slno).val('');
      $('#csCode'+tab+slno).val('');
      $('#blockCode'+tab+slno).val(blockCd+'[ '+msg+' ]');
      
      var block_Cd    = $('#blockCode'+tab+slno).val();
      var splitCblock = block_Cd.split('[');
      var blockCode   = splitCblock[0];
      var tableName = 'Block';
      getDataofCs(blockCode,tableName,tab,slno);
    }

  }

  function getitemPacking(row,slNo){

    var itemcd = $('#itemCd'+row+slNo).val();

    var xyz = $('#itemList'+row+slNo+' option').filter(function() {

      return this.value == itemcd;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
      $('#itemCd'+row+slNo).val('');
      $('#itemName'+row+slNo).val('');
      $('#itemPackCode'+row+slNo).val('');
      $('#itemPackingList'+row+slNo).empty();
    }else{
      $('#itemPackingList'+row+slNo).empty();
      $('#itemPackCode'+row+slNo).val('');
      $('#itemCd'+row+slNo).val(itemcd+'[ '+msg+' ]');

      var itemCode  = $('#itemCd'+row+slNo).val();
      var codesplit = itemCode.split('[');
      var item_cd   = codesplit[0];
      var tblName   = 'ItemPack';
      getDataofCs(item_cd,tblName,row,slNo);
    }
  }

  function itemPackingVal(row,slNo){

    var itempack = $('#itemPackCode'+row+slNo).val();

    var xyz = $('#itemPackingList'+row+slNo+' option').filter(function() {

      return this.value == itempack;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
      $('#itemPackCode'+row+slNo).val('');
    }else{
      $('#itemPackCode'+row+slNo).val(itempack+'[ '+msg+' ]');
    }

  }

  function getDataofCs(fieldName,tblName,tab,slNo){

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $.ajax({

          url:"{{ url('get-item-packing-against-item') }}",

          method : "POST",

          type: "JSON",

          data: {fieldName: fieldName,tblName:tblName},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  if(data1.data_List == ''){
                    //$('#floorCode'+tab+slNo).val('');
                   //$('#chamberCode'+tab+slNo).val('');
                   // $('#csCode'+tab+slNo).val('');
                  }else{

                    $('#floorCode'+tab+slNo).val(data1.data_List.FLOOR_CODE+'['+data1.data_List.FLOOR_NAME);
                    $('#chamberCode'+tab+slNo).val(data1.data_List.CHAMBER_CODE+'['+data1.data_List.CHAMBER_NAME);
                    $('#csCode'+tab+slNo).val(data1.data_List.CS_CODE+'['+data1.data_List.CS_NAME);
                  }

                  if(data1.ItemPackingList==''){

                }else{
                  $("#itemPackingList"+tab+slNo).empty();
                  $.each(data1.ItemPackingList, function(k, getData){

                    $("#itemPackingList"+tab+slNo).append($('<option>',{

                      value:getData.PACKING_ID,

                      'data-xyz':getData.PACKING_NAME,
                      text:getData.PACKING_NAME

                    }));

                  })

                }
                

              }

          }

    });
  }

  

</script>


<script type="text/javascript">
$(document).ready(function(){
   $('.Number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
    if (keycode == 46 || this.value.length==10) {
    return false;
  }
});
});
</script>

<script type="text/javascript">
  $(document).ready(function() {

  jQuery.extend(jQuery.expr[':'], {
    focusable: function (el, index, selector) {
        return $(el).is('a, button, :input, [tabindex]');
    }
});

$(document).on('keypress', 'input,select', function (e) {
    if (e.which == 13) {
        e.preventDefault();
        // Get all focusable elements on the page
        var $canfocus = $(':focusable');
        var index = $canfocus.index(document.activeElement) + 1;
        if (index >= $canfocus.length) index = 0;
        $canfocus.eq(index).focus();
    }
});

});
</script>

@endsection