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



  .rightcontent{



  text-align:right;





}



::placeholder {

  

  text-align:left;

}



.showinmobile{

  display: none;

}

.showSeletedName{



    font-size: 12px;



    margin-top: 1.4%;



    text-align: center;



    font-weight: 600;



    color: #4f90b5;



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

</style>







<div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



            Master Item



            <small>Update Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Master</a></li>



            <li class="active"><a href="{{ url('/finance/edit-item-master/'.base64_encode($item_list->  ITEM_CODE)) }}">Master Item</a></li>



            <li class="active"><a href="{{ url('/finance/edit-item-master/'.base64_encode($item_list->  ITEM_CODE)) }}">Update Mast Item</a></li>



          </ol>



        </section>



	<section class="content">



    <div class="row">



      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Master Item</h2>



              <div class="box-tools pull-right">



                <a href="{{ url('/Master/Item/View-Item-Master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item</a>



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



            <form action="{{ url('/Master/Item/form-item-master-finance-update') }}" method="POST" >

               @csrf

              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label> Company Type</label>

                     <div class="input-group">

                      <input type="radio" class="optionsRadios1 company_sel" name="companySelect" value="Global" <?php if($item_list->COMP_TYPE=='Global'){ echo 'checked';} else{ echo '';} ?>>&nbsp;Global &nbsp;
                      <input type="radio" class="optionsRadios1 company_sel" name="companySelect" value="Company" id="oldBilty" <?php if($item_list->COMP_TYPE=='Company'){ echo 'checked';} else{ echo '';} ?>>&nbsp;<span id="oldBiltyNm">Company</span> &nbsp;

                    </div>
                    
                  </div>
              
                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Company Code:</label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                      <input list="compList" type="text" name="comp_code" id="comp_code" class="form-control" placeholder="Select Company Type" value="{{ $item_list->COMP_CODE }}" maxlength="11" style="z-index: 1;" autocomplete="off" readonly>

                      <datalist id="compList">

                        <option value=''>--SELECT--</option>

                        @foreach($comp_list as $row)

                          <option value='{{ $row->COMP_CODE }}'data-xyz="{{ $row->COMP_NAME }}" >{{ $row->COMP_CODE }} = {{ $row->COMP_NAME }} </option>

                        @endforeach

                      </datalist>

                    </div>
                    <small style="color:red;" id="compReqErr"></small>
                  </div> <!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-3">

                    <div class="form-group">

                      <label>Company Name :</label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="comp_name" id="comp_name" value="{{ $item_list->COMP_NAME }}" placeholder="Enter Company Name" maxlength="40" readonly>

                      </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

              </div><!-- /.row -->


              <div class="row">

                 <div class="col-md-3">



                    <div class="form-group">



                      <label>



                        Item Type: 



                        <span class="required-field"></span>



                      </label>

                        <?php 
                             //  item type code

                              $itypecode = $item_list->ITEMTYPE_CODE;
                              // echo $itypecode;

                              $itypename = $item_list->ITEMTYPE_NAME;
                               // echo $itypename;

                              $itemcodename = '';

                              if($itypecode && $itypename){
                                $itemcodename = $itypecode.'['.$itypename.']';
                              }else if($itypecode){
                                $itemcodename = $itypecode;
                              }else{
                                $itemcodename = '';
                              }
                         ?>

                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>



                          <input type="text" name="item_type" class="form-control" value="<?php echo $itemcodename; ?>" style="z-index: auto;" placeholder="Select Item Type" readonly autocomplete="off">
                         
                        </div>


                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('item_type', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <?php 
                        // item schdule

                      $ischcode = $item_list->ITEM_SCH;


                      $ischname = $item_list->ITEM_SCHNAME;


                      $ischcodename = '';

                      if($ischcode && $ischname){
                        $ischcodename = $ischcode.'['.$ischname.']';
                      }else if($ischcode){
                        $ischcodename = $ischcode;
                      }else{
                        $ischcodename = '';
                      }

                     ?>

                    <div class="form-group">

                      <label>

                        Item Schedule: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                          <input type="text" name="item_schedule" class="form-control zindex" id="item_schedule" style="z-index: auto;" placeholder="Select Item Schedule" value="<?php echo $ischcodename; ?>" autocomplete="off" readonly="">

                        </div>

                        <div class="pull-left showSeletedName" id="itemSchText"></div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('item_schedule', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-3">



                    <div class="form-group">



                      <label>



                        Item Name : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group tooltips">



                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>



                          <input type="text" class="form-control" name="item_name" id="item_name" value="{{ $item_list->ITEM_NAME }}" placeholder="Enter Item Name" maxlength="40" autocomplete="off">

                          <span class="tooltiptext" id="itemNameTooltip"></span>

                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('item_name', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                </div>

                <div class="col-md-3">



                    <div class="form-group">



                      <label>



                        Item Code: 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input type="hidden" name="updateItemId" value="{{ $item_list->ITEM_CODE }}"> 

                          <input type="text" class="form-control" name="item_code" value="{{ $item_list->ITEM_CODE }}" placeholder="Enter Item Code" id="ItemCodeSearch" maxlength="15" readonly="" autocomplete="off">



                        </div>



                        <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('item_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                        </small>



                    </div>



                    <!-- /.form-group -->



                </div>


              </div>



              <!-- /.row -->



              <div class="row">

                   <div class="col-md-3">



                    <div class="form-group">



                      <label>



                        HSN Code: 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input list="hsn_codeList" name="hsn_code" class="form-control" id="hsn_code" style="z-index: auto;" value="{{ $item_list->HSN_CODE }}" placeholder="Enter HSN Code" maxlength="8" autocomplete="off">

                          <datalist id="hsn_codeList">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($hsn_code_list as $key)

                            <option value='<?php echo $key->HSN_CODE?>'   data-xyz ="<?php echo $key->HSN_NAME; ?>" ><?php echo $key->HSN_NAME ; echo " [".$key->HSN_CODE."]" ; ?></option>

                            @endforeach

                            </datalist>

                           <input type="hidden" id="hsn_name" name="hsn_name" value="{{$item_list->HSN_NAME}}">

                        </div>

                         <small>  

                          <div class="pull-left showSeletedName" id="hsn_codeText">{{$item_list->HSN_NAME}}</div>

                        </small>

                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('hsn_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>

                   <div class="col-md-3">



                    <div class="form-group">



                      <label>



                        Valuation Code: 



                      <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input list="ValuationList" name="valuation_code" class="form-control" id="valuation_code" value="{{ $item_list->VALUATION_CODE }}" style="z-index: auto;" placeholder="Enter  Valuation Code" maxlength="6" autocomplete="off">

                          <datalist id="ValuationList">

                            <option value="">--SELECT Item Class--</option>

                            @foreach($valuation_code as $key)

                            <option value="{{$key->VALUATION_CODE}}" data-xyz="{{$key->VALUATION_NAME}}">{{ $key->VALUATION_CODE }}-[{{ $key->VALUATION_NAME }}]</option>


                            @endforeach

                        </datalist>

                        <input type="hidden" id="valuation_name" name="valuation_name" value="{{$item_list->VALUATION_NAME}}">

                        </div>

                        <div class="pull-left showSeletedName" id="valuation_nameText">{{$item_list->VALUATION_NAME}}</div>

                         

                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('valuation_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-3">



                    <div class="form-group">



                      <label>



                        Item Detail : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>



                          <input type="text" name="item_detail" class="form-control" id="item_detail" value="{{$item_list->ITEM_DETAIL}}" placeholder="Enter Item Detail" maxlength="15" autocomplete="off">



                      </div>

                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('item_detail', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                <!-- /.col -->

                 

                    <div class="col-md-3">



                    <div class="form-group">



                      <label>



                        Item Group : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-object-group"></i></span>



                          <input list="groupList" type="text" name="item_group" id="item_group" class="form-control" value="{{$item_list->ITEMGROUP_CODE}}" placeholder="Select Item Group" maxlength="6" autocomplete="off">



                          <datalist id="groupList">



                            <option value="">--SELECT AUM--</option>



                          @foreach($item_group as $key)



                            <option value="{{$key->ITEMGROUP_CODE }}" data-xyz="{{$key->ITEMGROUP_NAME}}">{{ $key->ITEMGROUP_CODE  }}-{{ $key->ITEMGROUP_NAME }}</option>



                            @endforeach



                          </datalist>


                          <input type="hidden" id="item_groupname" name="item_groupname" value="{{$item_list->ITEMGROUP_NAME}}">



                      </div>

                     
                      <div class="pull-left showSeletedName" id="itemgroupText">{{$item_list->ITEMGROUP_NAME}}</div>

                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('item_group', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>

                    <!-- /.form-group -->

                  </div>
              </div>


              <!-- /.row -->

              <div class="row">
                
                <div class="col-md-3">



                      <div class="form-group">



                        <label>



                          Item Class: 



                          <span class="required-field"></span>



                        </label>



                          <div class="input-group">



                            <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>



                            <input list="itemClss_List" type="text" name="item_class" class="form-control" id="item_class" value="{{$item_list->ITEMCLASS_CODE}}" style="z-index: auto;" placeholder="Select Item Class" maxlength="6" autocomplete="off">



                           <datalist id="itemClss_List">



                              <option value="">--SELECT Item Class--</option>



                              @foreach($item_class as $key)



                              <option value="{{ $key->ITEMCLASS_CODE }}" data-xyz="{{ $key->ITEMCLASS_NAME}}">{{ $key->ITEMCLASS_CODE  }}-[{{ $key->ITEMCLASS_NAME }}]</option>





                              @endforeach

                           

                          </datalist>

                          <input type="hidden" id="item_classname" name="item_classname" value="{{$item_list->ITEMCLASS_NAME}}">



                          </div>

                           <div class="pull-left showSeletedName" id="itemClss_Text">{{$item_list->ITEMCLASS_NAME}}</div>

                            <small id="emailHelp" class="form-text text-muted">



                              {!! $errors->first('item_class', '<p class="help-block" style="color:red;">:message</p>') !!}



                            </small>



                      </div>

                      <!-- /.form-group -->

                </div>
                <div class="col-md-3">



                    <div class="form-group">



                      <label>



                        Item Category : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>



                          <input list="itemCat_List" type="text" name="item_category" class="form-control" id="item_cate" value="{{ $item_list->ICATG_CODE }}" placeholder="Select Item Category" maxlength="6" autocomplete="off">



                          <datalist id="itemCat_List">



                            <option value="">--SELECT AUM--</option>



                          @foreach($item_category as $key)



                            <option value="{{$key->ICATG_CODE }}" data-xyz="{{$key->ICATG_NAME}}">{{ $key->ICATG_CODE  }}-{{ $key->ICATG_NAME }}</option>



                            @endforeach



                          </datalist>

                          
                          <input type="hidden" id="item_catname" name="item_catname" value="{{ $item_list->ICATG_NAME }}">

                      </div>

                      <div class="pull-left showSeletedName" id="itemCat_Text">{{ $item_list->ICATG_NAME }}</div>

                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('item_category', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>

                    <!-- /.form-group -->

                  </div>

               <div class="col-md-3">



                    <div class="form-group">



                      <label>



                        UM: 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>



                         <!--  <input type="text" name="um" class="form-control" id="uniMeasure" style="z-index: auto;" value="{{$item_list->UM}}" placeholder="Enter UM" maxlength="11"> -->

                          <input list="umList" type="text" name="um" class="form-control" id="selectUm" style="z-index: auto;" value="{{$item_list->UM}}" placeholder="Select UM" maxlength="3" autocomplete="off">

                         <datalist id="umList">

                            <option value="">--SELECT UM--</option>

                            @foreach($um_list as $key)

                            <option value="{{$key->UM_CODE}}" data-xyz="{{$key->UM_NAME}}">{{ $key->UM_CODE }}-[{{ $key->UM_NAME }}]</option>


                            @endforeach

                        </datalist>



                        </div>

                         

                         <div class="pull-left showSeletedName" id="umText"></div>
                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('um', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>


                    <p id="showhenSame"></p>
                    </div>

                    <!-- /.form-group -->

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Aum : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input list="aumList" type="text" name="aum" class="form-control" id="selectUam" value="{{$item_list->AUM}}" placeholder="Select AUM" maxlength="3" autocomplete="off">

                          <datalist id="aumList">

                            <option value="">--SELECT AUM--</option>

                          @foreach($um_list as $key)

                            <option value="{{$key->UM_CODE}}" data-xyz="{{$key->UM_NAME}}">{{ $key->UM_CODE }}-{{ $key->UM_NAME }}</option>


                            @endforeach


                          </datalist>

                      </div>
                      <div class="pull-left showSeletedName" id="aumText"></div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('aum', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                    <!-- /.form-group -->
                  </div>


              </div>

                  

              <div class="row">


                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        AUM Factor: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" name="aum_factor" class="form-control rightcontent" placeholder="Enter AUM Factor" value=" {{ $item_list->AUM_FACTOR }}" maxlength="30" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('aum_factor', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                <div class="col-md-3">



                    <div class="form-group">



                      <label>



                        Qty Decimal : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-amount-asc"></i></span>



                          <input type="text" name="qtydecimal" class="form-control" id="qtydecimal" placeholder="Enter Qty Decimal" value="3" maxlength="1" autocomplete="off">



                      </div>

                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('qtydecimal', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>

                    <!-- /.form-group -->

                  </div>
      
               <div class="col-md-3">



                    <div class="form-group">



                      <label>



                        Rate Type : 



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>



                          <input type="text" name="rate_type" class="form-control" id="rate_type" placeholder="Enter Rate Type" value="{{$item_list->RATE_TYPE}}" maxlength="3" autocomplete="off">



                      </div>

                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('rate_type', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>

                    <!-- /.form-group -->

                  </div>

                   <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Material Value : 


                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-amount-asc"></i></span>

                          <input type="text" name="material_value" class="form-control" id="material_value" placeholder="Enter Material Value" value="{{ $item_list->STDRATE }}" autocomplete="off">
                          

                      </div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('material_value', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>


                    </div>
                    <!-- /.form-group -->
                  </div>

              </div>

              <div class="row">
                
                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Tolerance Index : 

                        <!-- <span class="required-field"></span> -->

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-amount-asc"></i></span>

                          <input list="tolranceList" name="tolranceindex" class="form-control" id="tolranceindex" placeholder="Select Tolrance Index" value="{{ $item_list->TOLERANCE_BASIS }}" autocomplete="off">
                          <datalist id="tolranceList">
                                <option value="">--Select Index--</option>
                                <option value="P" data-xyz ="Percent">P[Percent]</option>
                                <option value="L" data-xyz ="Lumsum">L[Lumsum]</option>
                          </datalist>

                           <input type="hidden" id="tolrancename" name="tolrancename" value="{{ $item_list->TOLERANCE_NAME }}">

                      </div>

                       <div class="pull-left showSeletedName" id="tolranceText">{{ $item_list->TOLERANCE_NAME}}</div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('tolranceindex', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>


                    </div>
                    <!-- /.form-group -->
                  </div>

                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Tolerance Rate : 

                        <!-- <span class="required-field"></span> -->

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                          <input type="text" name="tolrance_rate" class="form-control Number" value="{{ $item_list->TOLERANCE_QTY }}" id="tolrance_rate" placeholder="Enter Tolrance Rate" autocomplete="off">

                      </div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('rate_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Scrap Code : 

                        

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                          <input list="scrapc_List" name="scrap_code" class="form-control Number" value="{{$item_list->SCRAP_CODE }}" id="scrap_code" <?php if($item_list->SCRAP_CODE){ ?> readonly <?php }?> placeholder="Enter Scrap Code" autocomplete="off">

                          <datalist id="scrapc_List">

                            <option value="">--SELECT Item Class--</option>

                            @foreach($help_item_list as $key)

                            <option value="{{$key->ITEM_CODE}}" data-xyz="{{$key->ITEM_NAME}}">{{ $key->ITEM_CODE }}[{{$key->ITEM_NAME}}]</option>


                            @endforeach

                        </datalist>

                        <input type="hidden" id="scrap_name" name="scrap_name" value="{{$item_list->SCRAP_NAME }}">

                      </div>

                      <div class="pull-left showSeletedName" id="scrapText">{{$item_list->SCRAP_NAME }}</div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('scrap_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                    <!-- /.form-group -->
                  </div>
               
               <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Batch check : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-amount-asc"></i></span>

                          <input list="BatchCheckList" name="batch_check" class="form-control" id="batch_check" placeholder="Select Batch"  onchange="batechref()" value="{{ $item_list->BATCH_CHECKE }}" autocomplete="off">
                          <datalist id="BatchCheckList">
                                <option value="">--Select Batch--</option>
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                          </datalist>

                      </div>

                       <div class="pull-left showSeletedName" id="tolranceText"></div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('batch_check', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>


                    </div>
                    <!-- /.form-group -->
                  </div>

                  </div>
                  <div class="row">

                    <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Batch Reference : 

                        <span id="batchrefreq"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-amount-asc"></i></span>

                          <input list="BatchRefList" name="bacth_ref" class="form-control" id="bacth_ref" placeholder="Select Refrance" value="{{ $item_list->BATCH_REFRENCE }}" <?php if($item_list->BATCH_CHECKE=='NO'){echo 'disabled';}  ?> autocomplete="off">
                          <datalist id="BatchRefList">
                                <option value="GRN NO">GRN NO</option>
                                <option value="GRN DATE">GRN DATE</option>
                                <option value="PURCHASE ORDER">PURCHASE ORDER NO</option>
                                <option value="MANUAL">MANUAL</option>
                          </datalist>

                      </div>

                       <div class="pull-left showSeletedName" id="tolranceText"></div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('bacth_ref', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>


                    </div>
                    <!-- /.form-group -->
                  </div>
                   
                   <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Length : 

                        <span id="batchrefreq"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="length" id="length" oninput="funCalODC()" value="{{ $item_list->LENGTH }}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('length', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>


                    </div>
                    <!-- /.form-group -->
                  </div>

               
                   <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Width : 

                        <span id="batchrefreq"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="width" id="width" oninput="funCalODC()" value="{{ $item_list->WIDTH }}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('width', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>


                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Height : 

                        <span id="batchrefreq"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="height" id="height" oninput="funCalODC()" value="{{ $item_list->HEIGHT }}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('height', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>


                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Over Dimensional Consignment: 

                        <span id="batchrefreq"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="odc" id="odc" readonly value="{{ $item_list->ODC }}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('odc', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>


                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-3">



                    <div class="form-group">



                      <label>



                        Block Item: 



                        <span class="required-field"></span>



                      </label>



                     

                      <div class="input-group">



                          <input type="radio" class="optionsRadios1" name="item_block" value="1" <?php if($item_list->FLAG=='1'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                          <input type="radio" class="optionsRadios1" name="item_block" value="0" <?php if($item_list->FLAG=='0'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO





                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                      



                    </div>



                  </div>


             </div>

                  

             

              <div style="text-align: center;">



                 <button type="Submit" id="submitBtn" class="btn btn-primary">



                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 



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

   function funCalODC(){

    var lengthVal = $('#length').val();
    
    var widthtVal = $('#width').val();
    
    var heightVal = $('#height').val();
    
    if(lengthVal > 12000 && widthtVal > 2500 && heightVal > 2500){
      $('#odc').val('YES');
    }else if(lengthVal <= 12000 && widthtVal <= 2500 && heightVal <= 2500){
      $('#odc').val('NO');
    }else if(lengthVal > 12000 || widthtVal > 2500 || heightVal > 2500){
      $('#odc').val('YES');
    }else if(lengthVal == '' && widthtVal == '' && heightVal == ''){
       $('#odc').val('');
    }

  }
  
  function batechref(){

    var batch_check = $("#batch_check").val();

    if(batch_check=='YES'){

        $("#bacth_ref").prop('disabled',false);
        $("#batchrefreq").addClass('required-field');
    }else{
        $("#bacth_ref").prop('disabled',true);
        $("#bacth_ref").val('');
        $("#batchrefreq").removeClass('required-field');
    }

  }

</script>

 <script type="text/javascript">

  $( window ).on( "load", function() {

    var item_name = $("#item_name").val();

      $("#itemNameTooltip").html(item_name);
    //alert(item_name);

  });

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

 $("#item_group").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#groupList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("itemgroupText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             $('#item_groupname').val('');
          

          }else{
            $('#item_groupname').val(msg);

          }

    });


$("#tolranceindex").bind('change', function () {  

          var val = $(this).val();
          //console.log(val);

          var xyz = $('#tolranceList option').filter(function() {

          return this.value == val;

          }).data('xyz');

         // console.log(xyz);

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg);

         document.getElementById("tolranceText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             $('#tolrancename').val('');

          }else{
             $('#tolrancename').val(msg);
          }

      });


});

</script> 

<script type="text/javascript">

  $(document).ready(function() {

    var compCd    = $('#comp_code').val();
    var comType = $('input[name="companySelect"]:checked').val();

    if(comType == 'Company'){
      $('#comp_code').prop('readonly',false);
    }else{
      $('#comp_code').prop('readonly',true);
    }

    $('.company_sel').on('click',function(){
      var compSel = $(this).val();
      if(compSel == 'Company'){
        
        var comCd = $('#comp_code').val();
        if(comCd){
          $('#compReqErr').html('');
          $('#submitBtn').prop('disabled',false);
          $('#comp_code').prop('readonly',false);
        }else{
          $('#compReqErr').html('The company field is required.');
          $('#submitBtn').prop('disabled',true);
          $('#comp_code').prop('readonly',false);
        }
        
      }else{
        $('#submitBtn').prop('disabled',false);
        $('#comp_code').prop('readonly',true);
        $('#compReqErr').html('');
        $('#comp_code,#comp_name').val('');
      }
    });

    $("#comp_code").bind('change', function () {  

      var val = $(this).val();
      var xyz = $('#compList option').filter(function() {
        return this.value == val;
      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $(this).val('');
        $('#comp_name').val('');
        $('#submitBtn').prop('disabled',true);
      }else{
        $('#comp_name').val(msg);
        $('#submitBtn').prop('disabled',false);
      }

    });
  
  $("#selectUm").bind('change', function () {  

          var val = $(this).val();
          var xyz = $('#umList option').filter(function() {

          return this.value == val;

          }).data('xyz');
          console.log('xyz',xyz);

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("umText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');

          }else{
            console.log('val',val);
          }

    });

     $("#scrap_code").bind('change', function () {  

          var val = $(this).val();
          var xyz = $('#scrapc_List option').filter(function() {

          return this.value == val;

          }).data('xyz');
          console.log('xyz',xyz);

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("scrapText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             $('#scrap_name').val('');

          }else{
            $('#scrap_name').val(msg);
          }

    });

    $("#selectUam").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#aumList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("aumText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

    });

  });
</script>

<script type="text/javascript">

  $(document).ready(function(){

      $('#selectUm,#selectUam').change(function(){

         var getUm = $('#selectUm').val();

         var getAum =  $('#selectUam').val();
         console.log('getUm',getUm);
        
         if(getUm == getAum){

            $('#showhenSame').html('UM And AUM Can Not Be Same').css({

              "color":"red",

              "text-align":"center"

            });

            $('#selectUm').val('');

            $('#selectUam').val('');
            $('#aumText').html('');
            $('#umText').html('');

         }else{

          $('#showhenSame').html('');
         }

      });

  });

</script>

<!-- <script type="text/javascript">

  

  $(document).ready(function() {



 $('input:text:first').focus();

   



 $(document).on('keypress', 'input,select', function (e) {



    var n = $("input,select").length;



    if (e.which == 13)



    { //Enter key



      e.preventDefault(); //Skip default behavior of the enter key



      var nextIndex = $('input,select').index(this) + 1;

      if(nextIndex < n)

        $('input,select')[nextIndex].focus();

      else

      {

        $('input,select')[nextIndex-1].blur();

        

      }

    }

  });

 

});



</script> -->



<script type="text/javascript">



  $(document).ready(function() {

  $(".Number").on("keypress", function(evt) {

    var keycode = evt.charCode || evt.keyCode;

    if (keycode == 46 || this.value.length==10) {

      return false;

    }

  });



  });



</script>

<script type="text/javascript">

  $(document).ready(function(){



  $("#selectUm").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#umList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



         document.getElementById("umText").innerHTML = msg; 



          if(msg=='No Match'){



             $(this).val('');

          



          }



        });



  $("#selectUam").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#aumList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



         document.getElementById("aumText").innerHTML = msg; 



          if(msg=='No Match'){



             $(this).val('');

          



          }



        });



    $("#item_class").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#itemClss_List option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



         document.getElementById("itemClss_Text").innerHTML = msg; 



          if(msg=='No Match'){

            $(this).val('');
             $('#item_classname').val('');

          }else{
            $('#item_classname').val(msg);
          }



        }); 



      $("#item_cate").bind('change', function () {  



          var val = $(this).val();

          //console.log(val);



          var xyz = $('#itemCat_List option').filter(function() {



          return this.value == val;



          }).data('xyz');



         // console.log(xyz);



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg);



         document.getElementById("itemCat_Text").innerHTML = msg; 



          if(msg=='No Match'){
             $(this).val('');
             $('#item_catname').val('');
          }else{
            $('#item_catname').val(msg);
          }



        });



      $("#tax_code").bind('change', function () {  



          var val = $(this).val();

          //console.log(val);



          var xyz = $('#TaxList option').filter(function() {



          return this.value == val;



          }).data('xyz');



         // console.log(xyz);



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg);



         document.getElementById("TaxText").innerHTML = msg; 



          if(msg=='No Match'){



             $(this).val('');

          



          }



      });

      $("#hsn_code").bind('change', function () {  

          var val = $(this).val();
          //console.log(val);

          var xyz = $('#hsn_codeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

         // console.log(xyz);

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg);

         document.getElementById("hsn_codeText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
            $('#hsn_name').val('');

          }else{
            $('#hsn_name').val(msg);
          }

      });



   });

</script>











@endsection