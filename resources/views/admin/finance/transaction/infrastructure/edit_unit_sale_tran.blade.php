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



    /*border: 1px solid #e0dcdc;



    border-radius: 10px;



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


            <small> Update Details</small>



          </h1>



          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('Transaction/Infrastructure/View-Unit-Sale-Tran') }}">Unit Sale Tran</a></li>

           

            <li class="active"><a href="{{ url('Transaction/Infrastructure/View-Unit-Sale-Tran') }}">Update Unit Sale Tran </a></li>


          </ol>

        </section>



	<section class="content">


    <div class="row">


      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> Update Unit Sale Tran</h2>

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



            <form action="{{ url('Transaction/Infrastructure/Update-Unit-Sale-Tran') }}" method="POST" >
             

               @csrf
              <input type="hidden"  value="{{ $editdata->UNIT_CODE}}" name="hdnunitcd">

               <div class="row">

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Unit Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                           <input list='unitList' readonly="" type="" class="form-control codeCapital" name="Unitcode" id="unitcode"  value="{{ $editdata->UNIT_CODE }}"placeholder="Enter Unit Code" maxlength="6" autocomplete="off" onclick="funUnitCode(1)">
                            <datalist id="unitList">

                        
                            
                           
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

                            <input type="text" readonly="" id="unitname" name="NameUnit" class="form-control  pull-left" value="{{ $editdata->UNIT_NAME}}"placeholder="Enter Unit name" autocomplete="off">


                            <datalist id='glList'>
                              
                            </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('NameUnit', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Account code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input type="text"  name="Acc_code" class="form-control  pull-left" value="{{ $editdata->ACC_CODE }}"placeholder="Enter Account code" autocomplete="off" >
                           
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

                            <input type="text"  name="Acc_name" class="form-control  pull-left" value="{{ $editdata->ACC_NAME }}"placeholder="Enter Account name" autocomplete="off" >
                           
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

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                            </div>

                          <input type="text" class="form-control" name="customer1" id="" value="{{ $editdata->CUSTOMER1 }}"placeholder="Enter Customer" autocomplete="off" >
                           
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

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                           <input type="text" class="form-control" name="customer2" id="" value="{{ $editdata->CUSTOMER2 }}"placeholder="Enter Customer" autocomplete="off" >


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

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="" name="customer3" class="form-control  pull-left" value="{{ $editdata->CUSTOMER3 }}" placeholder="Enter customer" autocomplete="off">
                           
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

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="" name="customer4" class="form-control  pull-left" value="{{ $editdata->CUSTOMER4 }}" placeholder="Enter customer" autocomplete="off">
                           
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

                              <i class="fa fa-phone" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="" name="Phone1" class="form-control Number rightcontent"value="{{ $editdata->PHONE1 }}"placeholder="Select Phone" autocomplete="off">
                           
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

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-phone" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="" name="Phone2" class="form-control Number rightcontent"value="{{ $editdata->PHONE2 }}"placeholder="Select Phone" autocomplete="off">
                           
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

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-phone" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="" name="Phone3"class="form-control Number rightcontent"value="{{ $editdata->PHONE3 }}" placeholder="Select Phone" autocomplete="off">
                           
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

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-phone" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="" name="Phone4" class="form-control Number rightcontent"value="{{ $editdata->PHONE4 }}"placeholder="Select Phone" autocomplete="off">
                           
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

                       UNIT_AREA : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="" name="unitarea" value="{{ $editdata->UNIT_AREA }}"class="form-control Number rightcontent" placeholder="Select Unit Area" autocomplete="off">
                           
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

                      UNIT_UM : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="" name="unitum" class="form-control  pull-left" value="{{ $editdata->UNIT_UM }}"placeholder="Select Unit UM" autocomplete="off">
                           
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

                       UNIT_RATE : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="" name="unitrate"class="form-control Number rightcontent" value="{{ $editdata->UNIT_RATE }}"placeholder="Select Unit Rate" autocomplete="off">
                           
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

                       UNIT_AMOUNT : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="" name="unitamount"class="form-control Number rightcontent" value="{{ $editdata->UNIT_AMOUNT }}"placeholder="Enter Unit Amount" autocomplete="off">
                           
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

                 <!-- <button type="Submit" class="btn btn-primary">

                    <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update
                 </button>
 -->
              </div>

            <!-- </form> -->

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

              
                    <th class="tdthtablebordr">Unit Code</th>
                    <th class="tdthtablebordr">Unit Name</th>

                    <th class="tdthtablebordr">Account-Code</th>

                    <th class="tdthtablebordr">Account-Name</th>
                    <th class="tdthtablebordr">Milestone Code</th>
                    
                    <th class="tdthtablebordr">Milestone Date</th>
                    <th class="tdthtablebordr">Amount</th>
                    <th class="tdthtablebordr">Reed Amount</th>

                  </tr>
                   
                      

                      <tr class="useful">
                        
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          <input type='checkbox' class='case' title="Delete Single Row" onclick="select_all()"/>
                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <span id='snum'>1.</span>

                          <input type='hidden' name='ProjectInfoDetlSlno[]' id='ProjectInfoDetlSlno' value='1'>

                        </td>

                  

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input list="saleList" type="" name='Unit_code[]' id='Unitcode1' class="unitcode"value="{{ old('Unit_code')}}"  autocomplete="off" style="margin-bottom:5px;"  maxlength="10"value=''><br>
                          <datalist id="saleList">

                              @foreach($unit_List as $row)

                              <option value="{{ $row->UNIT_CODE }}" data-xyz ="{{ $row->UNIT_NAME }}">{{ $row->UNIT_CODE }}  {{ $row->UNIT_NAME }}</option>

                              @endforeach


                          </datalist>


                          <small id="UnitcodeErr1"></small>


                        </td>
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type="text" name='Unit_name[]' id='Unitname1' class="" value="{{ old('Unit_name')}}" autocomplete="off" style="margin-bottom:5px;"  maxlength="30" value=""><br>

                         <small id="Unit_nameErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type="text" name='Acc_code[]' id='Acccode1' class="" value="{{ old('Acc_code')}}" autocomplete="off" style="margin-bottom:5px;"  maxlength="30" value=""><br>

                         <small id="acc_codeErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                        
                          
                          <input  type="text" name='Acc_name[]' velue="{{old('Acc_name')}}"id='Acc_name1' class="Acc_name" autocomplete="off" style="margin-bottom:5px;" maxlength="10" value=""><br>

                         <small id="Acc_nameErr1"></small>

                        </td>
                        
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type="text" name='Milestone_cd[]' value="{{ old('Milestone_cd')}}"id='Milestonecd1' class="actualst_date" autocomplete="off" style="margin-bottom:5px;" maxlength="10" value="" ><br>

                         <small id="MilestonecdErr1"></small>

                        </td>
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type="text" name='Milestone_date[]'value="{{ old('Milestone_date')}}" id='Milestonedate1' class="actualed_date" autocomplete="off" style="margin-bottom:5px;" maxlength="10"  value=""><br>

                         <small id="Milestone_dateErr1"></small>

                        </td>
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type="text" name='Amount[]' id='Amount1' value="{{ old('Amount')}}" class="" autocomplete="off" style="margin-bottom:5px;" maxlength="20" value=""><br>

                         <small id="AmountErr1"></small>

                        </td>
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type="text" name='Read_amount[]'value="{{ old('Read_amount')}}" id='Readamount1' class="" autocomplete="off" style="margin-bottom:5px;" maxlength="10" value=""><br>

                         <small id="ReadamountErr1"></small>

                        </td>
                  </tr>

                </table>

              </div>
              <button type="button" class='btn btn-danger delete' id="deleteFunction"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

              <button type="button" class='btn btn-info addmore' id="addmorhidn"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

              <div class="text-center col-md-12">
                
               
                <button type="submit" class="btn btn-success" id="AddProjectDetail"><i class="fa fa-floppy-o"></i> Update</button>


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

</div>


@include('admin.include.footer')



 <script type="text/javascript">

    function funUnitCode(id){

 $("#unitcode"+id).bind('change', function () {  

      var val = $(this).val();

       console.log('val',val);

      var xyz = $('#unitList option').filter(function() {


      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';



     if(msg == 'No Match'){
      $('#unitcode'+id).val('');
     }else{
       $('#NameUnit'+id).val('');
     }
  });
  } 
   $("#Unitcode1").bind('change', function () {

      var salecode =  $(this).val();
      var xyz = $('#saleList option').filter(function() {

        return this.value == salecode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $(this).val('');
        $('#Unitname1').val('');
      }else{
        $('#Unitname1').val(msg);
      }
    });


 
      $('#vrdate').datepicker({

          format: 'dd-mm-yyyy',

          orientation: 'bottom',

          todayHighlight: 'true',

          autoclose: 'true'

      });


    $('#Milestonedate1').datepicker({

          format: 'dd-mm-yyyy',

          orientation: 'bottom',

          todayHighlight: 'true',

          autoclose: 'true'

    });

  $(".delete").on('click', function() {
   
   
      $('.case:checkbox:checked').parents('#tblProj_details tr').remove();

      $('.check_all').prop("checked", false); 

        check();

  });  
      




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

<script type="text/javascript">
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Acc Class Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var AccClsHelp = $('#AccClsHelp').val();

           if(AccClsHelp == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-AccCode-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {AccClsHelp: AccClsHelp},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Acc Class Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.ACLASS_CODE+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.ACLASS_NAME+'</td></tr>');
                             });
                      }
                 }

              });
           }
      })
  })
})
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#AccClassSearch').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var AccClassSearch = $('#AccClassSearch').val();

        if(AccClassSearch == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-acc-class-get') }}",

             method : "POST",

             type: "JSON",

             data: {AccClassSearch: AccClassSearch},

             success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                       var objcity = data1.data;
                       $('#shoemsgonin').html('');
                       $('#showSearchCodeList').show();
                          $('#showSearchCodeList').empty();
                         $.each(objcity, function (i, objcity) {
                           $('#showSearchCodeList').append('<span class="custom-option">'+
                            objcity.ACLASS_CODE+'</span><br>');
                         });
                        
                  }
             }

          });
       }

    });

    $("body").click(function() {
        $("#showSearchCodeList").hide("fast");
    });
  });
</script>

<!-- <script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script> -->







@endsection