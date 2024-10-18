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

  .Custom-Box {


*/    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);



}


.showinmobile{
  display: none;
}
.arrow{
  left: 59.4828%;
}

.beforhidetble{
  display: none;
}
.popover{
  left: 92.4922px!important;
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
</style>


<div class="content-wrapper">



  <!-- Content Header (Page header) -->



  <section class="content-header">

    <h1>

      Unit Sale Tran

      <small> Add Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Master</a></li>

      <li class="active"><a href="{{ url('Transaction/Infrastructure/View-Unit-Sale-Tran') }}">Unit Sale Tran</a></li>

      <li class="active"><a href="{{ url('Transaction/Infrastructure/View-Unit-Sale-Tran') }}">Add Unit Sale Tran </a></li>


    </ol>

  </section>

  <form action="{{url('Transaction/Infrastructure/Save-Unit-Sale-Tran')}}" method="POST" enctype="multipart/form-data"id="unitsaletran">
              @csrf

  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> Add Unit Sale Tran</h2>

            <div class="box-tools pull-right showinmobile">

              <a href="{{ url('Transaction/Infrastructure/View-Unit-Sale-Tran') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Unit Sale Tran</a>

            </div>

            <div class="box-tools pull-right hideinmobile">


              <a href="{{ url('Transaction/Infrastructure/View-Unit-Sale-Tran') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Unit Sale Tran</a>


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

                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                      VrDate: 

                      <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>

                      <input type="text" class="form-control codeCapital vrdt" name="Vrdate" id="vr_date"  value="{{ old('Vrdate')}}" placeholder="Enter Vr date" maxlength="12"  autocomplete="off">
                  
                      <div class="custom-select">
                        <div id="showSearchCodeList" class="custom-options">

                        </div>  
                      </div>


                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('vrdate', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>
                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                      Unit Code: 

                      <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                      <input list='unitList'  type="" class="form-control pull-left" name="Unitcode" id="code_unit"  value="" placeholder="Enter Unit Code" maxlength="40"  oninput="this.value = this.value.toUpperCase()"   autocomplete="off" >
                      <datalist id="unitList">

                        @foreach($unit_List as $row)
                          
                        <option value="{{ $row->UNIT_CODE }}" data-xyz ="{{ $row->UNIT_NAME }}">{{ $row->UNIT_CODE }}  {{ $row->UNIT_NAME }}</option>

                        @endforeach


                      </datalist>


                      <div class="custom-select">
                        <div id="showSearchCodeList" class="custom-options">

                        </div>  
                      </div>


                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('Unitcode', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>


                <div class="col-md-3">

                  <div class="form-group">

                    <label>

                      Unit Name: 

                      <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>

                      <input type="text"id="name_unit"  readonly="" name="NameUnit" class="form-control  pull-left" value="{{ old('NameUnit')}}" placeholder="Enter Unit name" autocomplete="off">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('NameUnit', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                      Account code : 

                      <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>

                      <input  list="accList" type=""  name="Acc_code" id="acc_code" class="form-control  pull-left" value="{{ old('Acc_code')}}" placeholder="Enter Account code" autocomplete="off" >

                      <datalist id="accList">

                        @foreach($acc_list as $row)

                        <option value="{{ $row->ACC_CODE }}" data-xyz ="{{ $row->ACC_NAME }}">{{ $row->ACC_CODE }}  {{ $row->ACC_NAME }}</option>

                        @endforeach


                      </datalist>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('Acc_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>


                <div class="col-md-3">

                  <div class="form-group">

                    <label>

                      Account Name: 

                      <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>

                      <input type="text" id="acc_name" readonly name="Acc_name" class="form-control  pull-left" value="{{ old('Acc_name')}}" placeholder="Enter Account name" autocomplete="off" >

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('Acc_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>


              </div>

              <!-- /.col -->

              <!-- /.row -->


              <div class="row">

                <div class="col-md-3">

                  <div class="form-group">

                    <label>

                      Customer 1 : 

                      
                    </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>

                      <input type="text" class="form-control" name="customer1" id="" value="{{ old('customer1')}}" placeholder="Enter Customer_1" autocomplete="off" >

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('customer1', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>

                <!-- /.col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label>

                      Customer 2: 

                      
                    </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                      <input type="text" class="form-control" name="customer2" id="customer_2" value="{{ old('customer2')}}" placeholder="Enter Customer" autocomplete="off" >


                      <div class="custom-select">
                        <div id="showSearchCodeList" class="custom-options">

                        </div>  
                      </div>


                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('customer2', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>

                <!-- /.col -->
                <div class="col-md-3">

                  <div class="form-group">

                    <label>

                      Customer 3 : 

                      

                    </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>

                      <input type="text" id="3_customer" name="customer3" class="form-control  pull-left" value="{{ old('customer3')}}" placeholder="Enter customer" autocomplete="off">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('customer3', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>
                <div class="col-md-3">

                  <div class="form-group">

                    <label>

                      Customer 4 : 

                      

                    </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>

                      <input type="text" id="customer_3" name="customer4" class="form-control  pull-left" value="{{ old('customer4')}}" placeholder="Enter customer" autocomplete="off">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('customer4', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>


                <div class="row">

                  <div class="col-md-12">
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>

                          Phone No.1 : 

                          <span class="required-field"></span>

                        </label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-mobile" aria-hidden="true"></i>

                          </div>

                          <input type="text" id="Phone_1" name="Phone1"class="form-control Number rightcontent" value="{{ old('Phone1')}}" placeholder="Select Phone" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('Phone1', '<p class="help-block" style="color:red;">:message</p>') !!}
                        </small>
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>

                          Phone No.2 : 

                          

                        </label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-mobile" aria-hidden="true"></i>

                          </div>

                          <input type="text" id="Phone_2" name="Phone2"class="form-control Number rightcontent"value="{{ old('Phone2')}}" placeholder="Select Phone" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('Phone2', '<p class="help-block" style="color:red;">:message</p>') !!}
                        </small>
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>

                          Phone No.3 : 

                          

                        </label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-mobile" aria-hidden="true"></i>

                          </div>

                          <input type="text" id="Phone_3" name="Phone3" class="form-control Number rightcontent"value="{{ old('Phone3')}}" placeholder="Select Phone" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('Phone3', '<p class="help-block" style="color:red;">:message</p>') !!}
                        </small>
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>

                          Phone No.4 : 

                          
                        </label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-mobile" aria-hidden="true"></i>

                          </div>

                          <input type="text" id="Phone_4" name="Phone4" class="form-control Number rightcontent"value="{{ old('Phone4')}}" placeholder="Select Phone" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('Phone4', '<p class="help-block" style="color:red;">:message</p>') !!}
                        </small>
                      </div>
                      <!-- /.form-group -->
                    </div>

                  </div>

                </div>
                <div class="row">

                  <div class="col-md-12">
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>
                         
                           Unit Area: 

                          <span class="required-field"></span>

                        </label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" id="unit_area" name="unitarea" class="form-control Number rightcontent" value="{{ old('unitarea')}}" placeholder="Enter Unit Area" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('unitarea', '<p class="help-block" style="color:red;">:message</p>') !!}
                        </small>
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>
                         
                           Unit Um: 

                          <span class="required-field"></span>

                        </label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" id="unit_um" name="unitum" class="form-control  pull-left" value="{{ old('unitum')}}" placeholder="Enter Unit UM" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('unitum', '<p class="help-block" style="color:red;">:message</p>') !!}
                        </small>
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>
                          
                           Unit Rate: 

                          <span class="required-field"></span>

                        </label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" id="unit_rate" name="unitrate"class="form-control Number rightcontent" value="{{ old('unitrate')}}" placeholder="Enter Unit Rate" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('unitrate', '<p class="help-block" style="color:red;">:message</p>') !!}
                        </small>
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>
                          
                           Unit Amount: 

                          <span class="required-field"></span>

                        </label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" id="unit_amount" name="unitamount" class="form-control Number rightcontent" value="{{ old('unitamount')}}" placeholder="Enter Unit Amount" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('unitamount', '<p class="help-block" style="color:red;">:message</p>') !!}
                        </small>
                      </div>
                      <!-- /.form-group -->
                    </div>

                  </div>

                </div>



                <!-- /.row -->

                <div style="text-align: center;">

                
                </div>

             <!--  </form> -->

            </div><!-- /.box-body -->

          </div>

        </div>

        <div class="col-sm-1"></div>

      </div>


    </section>
     <section class="content" style="margin-top: -10%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tblProj_details">

                  <tr>

                    <th class="tdthtablebordr"><input class='check_all' type='checkbox' onclick="select_all()"/ title="Delete All Row"></th>

                    <th class="tdthtablebordr">Sr.No.</th>

              
                    
                    <th class="tdthtablebordr">Milestone Code</th>
                    <th class="tdthtablebordr">Milestone Name</th>
                    
                    <th class="tdthtablebordr">Milestone Date</th>
                    <th class="tdthtablebordr">Amount</th>
                    <th class="tdthtablebordr">Particular</th>

                  </tr>
                   
                      

                      <tr class="useful">
                        
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          <input type='checkbox' class='case' title="Delete Single Row" onclick="select_all()"/>
                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <span id='snum'>1.</span>

                          <input type='hidden' name='ProjectInfoDetlSlno[]' id='ProjectInfoDetlSlno' class="rowCountCls" value='1'>

                        </td>

                  

                        
                        
                        <td class='tdthtablebordr' style='padding-top: 2%;'>
                          
                          <input list='milestoneList' type='' name="Milestone_cd[]" id='Milestonecd1' class='actualst_date' autocomplete='off' style='margin-bottom:5px;' maxlength='10'onclick='funMileCode(1)'  ><br>
                           <datalist id='milestoneList'>

                        @foreach($stone_list as $row)

                        <option value="{{ $row->MILESTONE_CODE }}" data-xyz ="{{ $row->MILESTONE_NAME }}">{{ $row->MILESTONE_CODE }}  {{ $row->MILESTONE_NAME }}</option>

                        @endforeach


                      </datalist>


                         <small id='MilestonecdErr1'></small>

                        </td>
                        <td class='tdthtablebordr' style='padding-top: 2%;'>
                          
                          <input  type='text' name="Milestone_name[]" readonly=""id='Milestonename1' class='actualst_date' autocomplete='off'style='margin-bottom:5px;' maxlength='10' value=''readonly ><br>

                         <small id='MilestonenameErr1'></small>

                        </td>
                        <td class='tdthtablebordr' style='padding-top: 2%;'>
                          
                          <input  type='text'name="Milestone_date[]" id='Milestonedate1' class='Mile_date' autocomplete='off'style='margin-bottom:5px;' maxlength='10' value=''><br>

                         <small id='Milestone_dateErr1'></small>

                        </td>
                        <td class='tdthtablebordr' style='padding-top: 2%;'>
                          
                          <input  type='text' name="Amount[]" id='Amount1' class='' autocomplete='off'style='margin-bottom:5px;' maxlength="20" value=''><br>

                         <small id="AmountErr1"></small>

                        </td>
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type="text" name="Particular[]"value="" id='particular1' class="" autocomplete="off" style="margin-bottom:5px;" maxlength="10" value=""><br>

                         <small id="ParticularErr1"></small>

                        </td>
                  </tr>

                </table>

              </div>
              <button type="button" class='btn btn-danger delete' id="deleteFunction"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

              <button type="button" class='btn btn-info addmore' id="addmorhidn"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

              <div class="text-center col-md-12">
                
               <small id="fieldReqMsg" style="color:red;"></small>

                <button type="submit" class="btn btn-success" id="submitdata"><i class="fa fa-floppy-o"aria-hidden="true"onclick="submitUnitSale(0)"></i>&nbsp; Save</button>


                <button class="btn btn-warning" id="btnReset" type="reset"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp;Reset</button>
              </div>
              </div>

              <div>


              </div>

          </div><!-- /.box-body -->

        </div>

      </div>

    </div>

  </section>
  
  </form>

  </div>


  @include('admin.include.footer')



  <script type="text/javascript">

  $("#code_unit").bind('change', function () {

      var salecode =  $(this).val();
      var xyz = $('#unitList option').filter(function() {

        return this.value == salecode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $(this).val('');
        $('#name_unit').val('');
      }else{
        $('#name_unit').val(msg);
      }
    });


  $("#acc_code").bind('change', function () {

      var acccode =  $(this).val();
      var xyz = $('#accList option').filter(function() {

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
    
      function funMileCode(id){

        $("#Milestonecd"+id).bind('change', function () {  

            var val = $(this).val();

            var xyz = $('#milestoneList option').filter(function() {

              return this.value == val;

            }).data('xyz');

            var msg = xyz ?  xyz : 'No Match';

            if(msg=='No Match'){

                $(this).val('');

                $("#Milestonename"+id).val('');

              }else{

                $("#Milestonename"+id).val(msg);
              }

        })
      }  


      // function funMileCode(id){
   

      //     var Milestonecd =  $("#Milestonecd"+id).val();
          
      //     var xyz = $('#milestoneList option').filter(function() {

      //       return this.value == Milestonecd;

      //     }).data('xyz');

      //     var msg = xyz ?  xyz : 'No Match';

      //     if(msg=='No Match'){

      //       $(this).val('');

      //       $('#Milestonename'+id).val('');

      //     }else{

      //       $('#Milestonename'+id).val(msg);
      //     }

      // }
 
   $('#vr_date').datepicker({

          format: 'dd-mm-yyyy',

          orientation: 'bottom',

          todayHighlight: 'true',

          autoclose: 'true'

    });

   $('.Mile_date').datepicker({

          format: 'dd-mm-yyyy',

          orientation: 'bottom',

          todayHighlight: 'true',

          autoclose: 'true'

    });

        $(".delete").on('click', function() {
         
         
            $('.case:checkbox:checked').parents('#tblProj_details tr').remove();

            $('.check_all').prop("checked", false); 

              // check();

        });/* delete btn */


$(function(){

  var i=2;

  $(".addmore").on('click',function(){
        
    count=$('#tblProj_details tr').length;
    //console.log('count',count);
    countTr = count-1;
    //console.log('countTr',countTr);
    var Milecd = $('#Milestonecd'+countTr).val();

      if(Milecd == ''){
          $('#MilestonecdErr'+countTr).html('Milestone Code Is Required').css('color','red');
          return false;
        }
        else{
          $('#MilestonecdErr'+countTr).html('');
        }
        

        var Milename  =  $('#Milestonename'+countTr).val();

        if(Milename == ''){
          $('#MilestonenameErr'+countTr).html('Wing No Is Required').css('color','red');
          return false;
        }else{
          $('#MilestonenameErr'+countTr).html('');
        }
        
        var Milestonedt  =  $('#Milestonedate'+countTr).val();
        if(Milestonedt == ''){
          $('#Milestone_dateErr'+countTr).html('Milestonedt Is Required').css('color','red');
          return false;
        }else{
          $('#Milestone_dateErr'+countTr).html('');
        }

        var amount  =  $('#Amount'+countTr).val();
        if(amount == ''){
          $('#AmountErr'+countTr).html('Amount Is Required').css('color','red');
        return false;

        }else{
        
        $('#AmountErr'+countTr).html('');
        }

        var particular  =  $('#particular'+countTr).val();

        if(particular == ''){
          $('#ParticularErr'+countTr).html('Particular Is Required').css('color','red');
        return false;

        }else{

          $('#ParticularErr'+countTr).html('').css('color','red');


    
              var data="<tr><td class='tdthtablebordr' style='padding-top: 23px;'><input type='checkbox' class='case'/></td><td class='tdthtablebordr' style='padding-top: 22px;'><span id='snum"+i+"'>"+count+".</span><input type='hidden' name='ProjectInfoDetlSlno[]' id='ProjectInfoDetlSlno' value='"+count+"'></td>";
              data+="<td class='tdthtablebordr' style='padding-top: 2%;'><input list='milestoneList' type='' name='Milestone_cd[]' id='Milestonecd"+count+"' class='actualst_date' autocomplete='off' style='margin-bottom:5px;' maxlength='10'onclick='funMileCode("+count+")'  ><br><datalist id='milestoneList'> @foreach($stone_list as $row) <option value='{{ $row->MILESTONE_CODE }}' data-xyz ='{{ $row->MILESTONE_NAME }}'>{{ $row->MILESTONE_CODE }}  {{ $row->MILESTONE_NAME }}</option>@endforeach </datalist><small id='MilestonecdErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input  type='text' name='Milestone_name[]' value='' readonly id='Milestonename"+count+"' class='actualst_date'autocomplete='off'style='margin-bottom:5px;' maxlength='10'><br> <small id='MilestonenameErr"+count+"'></small></td><td class='tdthtablebordr'style='padding-top:2%;'><input  type='text'name='Milestone_date[]'id='Milestonedate"+count+"' class='milestone_dt'autocomplete='off'style='margin-bottom:5px;' maxlength='10' value=''><br><small id='Milestone_dateErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input  type='text' name='Amount[]' id='Amount"+count+"'class=''autocomplete='off'style='margin-bottom:5px;' maxlength='20' value=''><br><small id='AmountErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input  type='text' name='Particular[]'value=''id='particular"+count+"' class=''autocomplete='off' style='margin-bottom:5px;' maxlength='10' ><br> <small id='ParticulartErr"+count+"'></small></td>";

              $('#tblProj_details').append(data);

              i++;

              $('.milestone_dt').datepicker({

                format: 'dd-mm-yyyy',

                orientation: 'bottom',

                todayHighlight: 'true',

                autoclose: 'true'

              });
       
        }
          
  });/* addmore  */

});/* function */


  $('#code_unit').on('change',function(){
   
    var unitCode = $('#code_unit').val();
     
    $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    $.ajax({

        type: 'POST',

        url: "{{ url('Transaction/Infrastructure/getdata-Unit-Sale-Tran') }}",

        data: {unitCode:unitCode}, 
                      
        success: function (data) {
          console.log('data',data);
          var data1 = JSON.parse(data); 
          if(data1.response=='error'){

          }else if(data1.response == 'success'){

            if(data1.dataUnit == ''){

            }else{
        
              $('#unit_area').val(data1.dataUnit[0].UNIT_AREA);

              $('#unit_um').val(data1.dataUnit[0].UNIT_UM);
              $('#unit_rate').val(data1.dataUnit[0].UNIT_RATE);
                var unitarea = $("#unit_area").val();
                var unitrate = $("#unit_rate").val();
                var amount   = parseFloat(unitarea) * parseFloat(unitrate);
              $('#unit_amount').val(amount);
              
            }
          }/*  condition */
              
        }/*  Success  */

    }); /*   ajax  */

  });/*   function */

  $("#unit_amount").on("input", function() {

      
       var amount   = $('#unit_amount').val();
       
       var unitarea = $("#unit_area").val();
    
       var unitrate = parseFloat(amount) / parseFloat(unitarea);

      $("#unit_rate").val(unitrate);

      console.log('unitrate',unitrate);

  });/* unitamount input function */

 


</script>

@endsection