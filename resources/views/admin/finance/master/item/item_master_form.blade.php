@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="append_item">

@include('admin.include.navbar')

@include('admin.include.sidebar')

</div>
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
   .setheightinput{
    height: 0%;
  }
  .nameheading{
    font-size: 12px;
  }
  .setetxtintd{
    font-size: 12px !important;
    padding-top: 2% !important;
    padding-bottom: 2% !important;
  }

  .beforhidetble{
    display: none;
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
.CloseListDepot{
  display: none;
}
.popover{
    left: 70.4922px!important;
    width: 169%!important;
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
  .zindex{
    z-index: auto !important;
  }
 @media screen and (max-width: 600px) {

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
            <small>Add Details</small>
          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/finance/item-master') }}">Master Item</a></li>

            <li class="active"><a href="{{ url('/finance/item-master') }}">Add  Item</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

   

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Item </h2>

              <!-- <?php print_r(url()->current()); ?> -->

              <div class="box-tools pull-right">

                <a href="{{ url('/Master/Item/View-Item-Master') }}" class="btn btn-primary"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item</a>

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

            <form action="{{ url('/Master/Item/form-item-master-finance-save') }}" method="POST" >

               @csrf

               <div class="row">

                <div class="col-md-2">

                    <div class="form-group">

                      <label>Company Type</label>

                       <div class="input-group">

                        <input type="radio" class="optionsRadios1 company_sel" name="companySelect" value="Global" checked="">&nbsp;Global &nbsp;
                        <input type="radio" class="optionsRadios1 company_sel" name="companySelect" value="Company" id="oldBilty">&nbsp;<span id="oldBiltyNm">Company</span> &nbsp;

                      </div>
                      
                    </div>
                
                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Company Code:</label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                        <input list="compList" type="text" name="comp_code" id="comp_code" class="form-control" placeholder="Select Company Code" maxlength="11" style="z-index: 1;" autocomplete="off" readonly>

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

                        <input type="text" class="form-control" name="comp_name" id="comp_name" value="" placeholder="Enter Company Name" maxlength="40" readonly>

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

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                          <?php $itemcount = count($item_type); ?> 

                          <input list="itemTypeList" type="text" name="item_type" class="form-control zindex" id="itemtype" style="z-index: auto;" placeholder="Select Item Type" maxlength="6" value="<?php if($itemcount == 1){echo $item_type[0]->ITEMTYPE_CODE;}else{echo old('item_type');}?>" autocomplete="off">

                         <datalist id="itemTypeList">

                            <option value="">--SELECT UM--</option>

                            @foreach($item_type as $key)

                            <option value="{{$key->ITEMTYPE_CODE }}" data-xyz="{{$key->ITEM_TYPE_NAME}}">{{ $key->ITEMTYPE_CODE  }}-[{{ $key->ITEM_TYPE_NAME }}]</option>


                            @endforeach

                        </datalist>
                        

                        </div>
                         <div class="pull-left showSeletedName" id="itemTypeText"></div>
                         <small id="itemSchErr"></small>
                         <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('item_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                         </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                   <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Item Schedule: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                          <input list="itemSch" type="text" name="item_schedule" class="form-control zindex" id="item_schedule" style="z-index: auto;" placeholder="Select Item Schedule" maxlength="6" value="{{old('item_schedule')}}" autocomplete="off">

                          <datalist id="itemSch">

                          </datalist>


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

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                          <input type="text" class="form-control" name="item_name" value="{{ old('item_name') }}" placeholder="Enter Item Name" maxlength="40" autocomplete="off" style="text-transform:uppercase">

                          
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

                          <input type="text" class="form-control codeCapital" name="item_code" value="{{ old('item_code') }}" placeholder="Enter Item Code" id="ItemCodeSearch" autocomplete="off" readonly>

                         <!--  <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div> -->

                         <!--  <span class="input-group-addon" style="padding: 5px;">

                            <div class="">
                                <button type="button" id="login" class="btn btn-xs btn-info gly-radius" style="padding: 1px 3px;font-size: 7px;line-height: 1;"> <i class="fa fa-info" aria-hidden="true"></i></button>
                            </div>

                            <div id="myForm" class="hide">
                                 <div class="row">
                                      <div class="col-md-9">
                                        <input type="text" name="ItemNameH" id="ItemNameH" class="form-control input-md setheightinput" oninput="this.value = this.value.toUpperCase()">
                                      </div>
                                      <div class="col-md-3" style="margin-left: -7%;">
                                        
                                        <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                <div id="result">
                                <table class="table table-bordered" style="margin-top: 3%;" id="HideWhenSearch">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Item Code</th>
                                     <th class="nameheading">Item Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($help_item_list as $key) { ?>

                                      <tr>
                                        <td class="setetxtintd"><?php echo $key->ITEM_CODE; ?></td>
                                        <td class="setetxtintd"><?php echo $key->ITEM_NAME; ?></td>
                                      </tr>
                                     
                                    <?php } ?>
                                      
                                  </tbody>
                                </table>

                                <table class="table table-bordered beforhidetble" style="margin-top: 3%;" id="ShowWhenSeaech">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Item Code</th>
                                     <th class="nameheading">Item Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                  </tbody>
                                </table>
                                <span id="errorItem"></span>

                            </div>
                            </div>

                          </span> -->

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
                          <?php $hsncount = count($hsn_code_list); ?>
                          <input list="hsn_codeList" name="hsn_code" class="form-control" id="hsn_code" style="z-index: auto;" placeholder="Enter HSN Code" maxlength="8" value="<?php if($hsncount == 1){echo $hsn_code_list[0]->HSN_CODE;}else{echo old('hsn_code');}?>" autocomplete="off">

                           <datalist id="hsn_codeList">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($hsn_code_list as $key)

                            <option value='<?php echo $key->HSN_CODE?>'   data-xyz ="<?php echo $key->HSN_NAME; ?>" ><?php echo $key->HSN_NAME ; echo " [".$key->HSN_CODE."]" ; ?></option>

                            @endforeach

                            </datalist>

                            <input type="hidden" id="hsn_name" name="hsn_name" value="<?php if($hsncount == 1){echo $hsn_code_list[0]->HSN_NAME;}else{echo old('hsn_name');}?>">

                        </div>
                         <small>  

                          <div class="pull-left showSeletedName" id="hsn_codeText"></div>

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

                          <?php $valcount = count($valuation_code); ?> 

                          <input list="ValuationList" name="valuation_code" class="form-control" id="valuation_code" style="z-index: auto;" placeholder="Enter  Valuation Code" value="<?php if($valcount == 1){echo $valuation_code[0]->VALUATION_CODE;}else{echo old('valuation_code');}?>" maxlength="6" autocomplete="off">

                          <datalist id="ValuationList">

                            <option value="">--SELECT Item Class--</option>

                            @foreach($valuation_code as $key)

                            <option value="{{$key->VALUATION_CODE}}" data-xyz="{{$key->VALUATION_NAME}}">{{ $key->VALUATION_CODE }}-[{{ $key->VALUATION_NAME }}]</option>


                            @endforeach

                        </datalist>

                        <input type="hidden" id="valuation_name" name="valuation_name" value="<?php if($valcount == 1){echo $valuation_code[0]->VALUATION_NAME;}else{echo old('valuation_name');}?>">

                        </div>
                        <div class="pull-left showSeletedName" id="ValuationText"></div>
                         
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

                          <input type="text" name="item_detail" class="form-control zindex" id="item_detail" placeholder="Enter Item Detail" maxlength="50" value="{{old('item_detail')}}" autocomplete="off">

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
                        <?php $groupcount = count($item_group); ?>
                          <input list="itemgroupList" type="text" name="item_group" class="form-control zindex" id="itemgroup" placeholder="Select Item Group" maxlength="6" value="<?php if($groupcount == 1){echo $groupcount[0]->ITEMGROUP_CODE;}else{echo old('item_group');}?>" autocomplete="off">

                          <datalist id="itemgroupList">

                            <option value="">--SELECT AUM--</option>

                          @foreach($item_group as $key)

                            <option value="{{$key->ITEMGROUP_CODE }}" data-xyz="{{$key->ITEMGROUP_NAME}}">{{ $key->ITEMGROUP_CODE  }}-{{ $key->ITEMGROUP_NAME }}</option>

                            @endforeach

                          </datalist>

                          <input type="hidden" id="item_groupname" name="item_groupname" value="<?php if($groupcount == 1){echo $groupcount[0]->ITEMGROUP_NAME;}else{echo old('item_groupname');}?>">

                      </div>
                      <div class="pull-left showSeletedName" id="itemgroupText"></div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('item_group', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                    <!-- /.form-group -->
                  </div>


              </div>

              <div class="row">

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Item Class: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                        <?php $classcount = count($item_class); ?>
                          <input list="itemClss_List" type="text" name="item_class" class="form-control" id="item_class" style="z-index: auto;" placeholder="Select Item Class" maxlength="6" value="<?php if($classcount=='1'){echo $item_class[0]->ITEMCLASS_CODE;}else{echo old('item_class');}?>" autocomplete="off">

                         <datalist id="itemClss_List">

                            <option value="">--SELECT Item Class--</option>

                            @foreach($item_class as $key)

                            <option value="{{ $key->ITEMCLASS_CODE }}" data-xyz="{{$key->ITEMCLASS_NAME }}">{{ $key->ITEMCLASS_CODE }}-[{{ $key->ITEMCLASS_NAME }}]</option>


                            @endforeach

                        </datalist>

                        <input type="hidden" id="item_classname" name="item_classname" value="<?php if($classcount=='1'){echo $item_class[0]->ITEMCLASS_NAME;}else{echo old('item_classname');}?>">


                        </div>
                         <div class="pull-left showSeletedName" id="itemClss_Text"></div>
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
                      <?php $catcount = count($item_category); ?>
                          <input list="itemCat_List" type="text" name="item_category" class="form-control" id="item_cate" placeholder="Select Item Category" maxlength="6" value="<?php if($catcount == 1){echo $item_category[0]->ICATG_CODE;}else{echo old('item_category');}?>" autocomplete="off">

                          <datalist id="itemCat_List">

                            <option value="">--SELECT AUM--</option>

                          @foreach($item_category as $key)

                            <option value="{{$key->ICATG_CODE }}" data-xyz="{{$key->ICATG_NAME}}">{{ $key->ICATG_CODE  }}-{{ $key->ICATG_NAME }}</option>

                            @endforeach

                          </datalist>

                          <input type="hidden" id="item_catname" name="item_catname" value="<?php if($catcount == 1){echo $item_category[0]->ICATG_NAME;}else{echo old('item_catname');}?>">

                      </div>
                      <div class="pull-left showSeletedName" id="itemCat_Text"></div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('item_category', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                    <!-- /.form-group -->
                  </div>
                <!-- /.col -->
                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        UM: 

                        <span class="required-field"></span>

                      </label>


                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input list="umList" type="text" name="um" class="form-control" id="selectUm" style="z-index: auto;" placeholder="Select UM" maxlength="3" value="{{old('um')}}" autocomplete="off">

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

                    </div>
                    <!-- /.form-group -->
                    <p id="showhenSame"></p>
                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Aum : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input list="aumList" type="text" name="aum" class="form-control" id="selectUam" placeholder="Select AUM" maxlength="3" value="{{old('aum')}}" autocomplete="off">

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

                <!-- /.col -->
                
                <!-- /.col -->
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

                          <input type="text" name="aum_factor" class="form-control rightcontent" placeholder="Enter AUM Factor" value="{{ old('aum_factor')}}" maxlength="30" autocomplete="off">

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

                          <input type="text" name="qtydecimal" class="form-control Number" id="qtydecimal" placeholder="Enter Qty Decimal" maxlength="1" value="3" autocomplete="off">

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

                          <input type="text" name="rate_type" class="form-control" id="qtydecimal" placeholder="Enter Rate Type" maxlength="3" value="{{old('rate_type')}}" autocomplete="off">

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

                          <input type="text" name="material_value" class="form-control" id="material_value" placeholder="Enter Material Value" value="{{old('material_value')}}" autocomplete="off">
                          

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


                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-amount-asc"></i></span>

                          <input list="tolranceList" name="tolranceindex" class="form-control" id="tolranceindex" placeholder="Select Tolrance Index" value="{{old('tolranceindex')}}" autocomplete="off">
                          <datalist id="tolranceList">
                                <option value="">--Select Index--</option>
                                <option value="P" data-xyz ="Percent">P[Percent]</option>
                                <option value="L" data-xyz ="Lumsum">L[Lumsum]</option>
                          </datalist>

                          <input type="hidden" id="tolrancename" name="tolrancename" value="">

                      </div>



                      <div class="pull-left showSeletedName" id="tolranceText"></div>

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


                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                          <input type="text" name="tolrance_rate" class="form-control Number" id="tolrance_rate" placeholder="Enter Tolrance Rate" value="{{old('tolrance_rate')}}" autocomplete="off">

                      </div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('tolrance_rate', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                          <input list="scrapc_List"  name="scrap_code" class="form-control Number" id="scrap_code" placeholder="Enter Scrap Code" value="{{old('scrap_code')}}" maxlength="15" autocomplete="off">


                         <datalist id="scrapc_List">

                            <option value="">--SELECT Item Class--</option>

                            @foreach($help_item_list as $key)

                            <option value="{{$key->ITEM_CODE}}" data-xyz="{{$key->ITEM_NAME}}">{{ $key->ITEM_CODE }}[{{$key->ITEM_NAME}}]</option>


                            @endforeach

                        </datalist>

                        <input type="hidden" id="scrap_name" name="scrap_name" value="{{old('scrap_code')}}">

                      </div>

                      <div class="pull-left showSeletedName" id="scrapText"></div>
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

                          <input list="BatchCheckList" name="batch_check" class="form-control" id="batch_check" placeholder="Select Batch" value="NO" onchange="batechref()" autocomplete="off">
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

                        Batch Reference: 

                        <span id="batchrefreq"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-amount-asc"></i></span>

                          <input list="BatchRefList" name="bacth_ref" class="form-control" id="bacth_ref" placeholder="Select Refrance" disabled="" maxlength="20">
                          <datalist id="BatchRefList" autocomplete="off">
                                <option value="">--Select Refrance--</option>
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

                          <input type="text" class="form-control" name="length" id="length" oninput="funCalODC()" autocomplete="off">

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

                          <input type="text" class="form-control" name="width" id="width" oninput="funCalODC()" autocomplete="off">

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

                          <input type="text" class="form-control" name="height" id="height" oninput="funCalODC()" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('height', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>


                    </div>
                    <!-- /.form-group -->
                  </div>

               </div>

               <div class="row">
                 
                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Over Dimensional Consignment: 

                        <span id="batchrefreq"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="odc" id="odc" readonly>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('odc', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>


                    </div>
                    <!-- /.form-group -->
                  </div>
               </div>


              <div style="text-align: center;">

                 <button type="Submit" id="submitBtn" class="btn btn-primary">

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

  function funGenItemCode(itemsch_code){

    var itemtype = $('#itemtype').val();

    if(itemtype){

      var splite_item = itemtype.split("[");
      var likename = splite_item[0]+''+itemsch_code;
      // console.log('likename',likename);
      var tbl_name = 'MASTER_ITEM';
      var col_code = 'ITEM_CODE';
    

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

       });

      $.ajax({

       url:"{{ url('/Master/generate-dyanamic-code') }}",

       data: {likename:likename,tbl_name:tbl_name,col_code:col_code},

        success:function(data){
          var data1 = JSON.parse(data);

          if(data1.response == 'success'){

            var newcode = data1.data;
            
            if(newcode != '' || newcode != null){
              $('#ItemCodeSearch').val(newcode);
            }else{
              $('#ItemCodeSearch').val('');
            }

          }
        }
      });

    }
    
    

 
  }

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
  $(document).ready(function(){

    $('.company_sel').on('click',function(){
      var compSel = $(this).val();
      if(compSel == 'Company'){
        $('#submitBtn').prop('disabled',true);
        $('#comp_code').prop('readonly',false);
        $('#compReqErr').html('The company field is required.');
      }else{
        $('#submitBtn').prop('disabled',false);
        $('#comp_code').prop('readonly',true);
        $('#compReqErr').html('');
        $('#comp_code,#comp_name').val('');
      }
    });

    $("#selectUm").bind('change', function () {  

          var val = $(this).val();
          var xyz = $('#umList option').filter(function() {

          return this.value == val;

          }).data('xyz');
          // console.log('xyz',xyz);

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("umText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');

          }else{
            // console.log('val',val);
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

    $("#valuation_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#ValuationList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("ValuationText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             $('#valuation_name').val('');

          }else{
          	$('#valuation_name').val(msg);
          }

    });

    $("#scrap_code").bind('change', function () {  

          var val = $(this).val();
          var xyz = $('#scrapc_List option').filter(function() {

          return this.value == val;

          }).data('xyz');
          // console.log('xyz',xyz);

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

    $("#itemgroup").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#itemgroupList option').filter(function() {

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

    $("#itemtype").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#itemTypeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');

          }else{
           
            $('#itemtype').val(val+'['+msg+']');

            $.ajaxSetup({

              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
     
           });

           $.ajax({

                url:"{{ url('/Master/Item/List-Item-Schedule') }}",

                 data: {itemTypeCode: val},

                 success:function(data){

                   var data1 = JSON.parse(data);

                   if(data1.response == 'success'){

                    var count_data = data1.data.length;
                    if(count_data > 0){
                        $("#itemSch").empty();
                        $("#item_schedule").prop('readonly',false);
                        $("#itemSchErr").html('');
                    	$.each(data1.data, function(k, getdata){

                        $("#itemSch").append($('<option>',{

                          value:getdata.ISCHE_CODE ,

                          'data-xyz':getdata.ISCHE_NAME,
                          text:getdata.ISCHE_NAME

                        }));

                      });
                     
                    }else{

                       $("#itemSch").empty();
                       $("#item_schedule").prop('readonly',true);
                       $("#itemSchErr").html('Item Schedule List Not Available.').css('color','red');
                       // console.log('Not');
                    }

                   }else if(data1.response == 'list_not_available'){
                    // console.log('list_not_available');


                   }else{

                   }
                  }
            });
          }

    }); 

     $("#item_schedule").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#itemSch option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');
          

          }else{
            $('#item_schedule').val(val+'['+msg+']');
            funGenItemCode(val);
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

      $('#qtydecimal').on('input',function(){

          qtyDecimal = $(this).val();

          if(qtyDecimal > 3){
            $(this).val(3);
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

<script type="text/javascript">
  // $(document).ready(function(){
  //   $('#ItemCodeSearch').on('keyup',function(){

  //     $.ajaxSetup({

  //           headers: {
  //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //           }

  //     });

  //     var ItemCodeSearch = $('#ItemCodeSearch').val();
  //       //console.log(depot_code_search);

  //       if(ItemCodeSearch == ''){

  //          $('#showSearchCodeList').hide();

  //       }else{

  //      $.ajax({

  //           url:"{{ url('search-items-code-for-finance') }}",

  //            method : "POST",

  //            type: "JSON",

  //            data: {ItemCodeSearch: ItemCodeSearch},

  //            success:function(data){

  //                console.log(data);
  //                 var data1 = JSON.parse(data);

  //                 if (data1.response == 'error') {

  //                     $('#showSearchCodeList').empty();
  //                 }else if(data1.response == 'success'){

  //                      var objcity = data1.data;
  //                      //$('#shoemsgonin').html('');
  //                      $('#showSearchCodeList').show();
  //                         $('#showSearchCodeList').empty();
  //                        $.each(objcity, function (i, objcity) {
  //                          $('#showSearchCodeList').append('<span class="custom-option">'+
  //                           objcity.item_code+'</span><br>');
  //                        });
                        
  //                 }
  //            }

  //         });
  //      }

  //   });

  //   $("body").click(function() {
  //       $("#showSearchCodeList").hide("fast");
  //   });






  // });
</script>

<script type="text/javascript">
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Item Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var HelpItemCode = $('#ItemNameH').val();

            if(HelpItemCode == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
            }else{

                 $.ajax({

                    url:"{{ url('help-items-code-getdata-finance') }}",

                    method : "POST",
 
                    type: "JSON",

                    data: {HelpItemCode: HelpItemCode},

                     success:function(data){

                         // console.log(data);
                          var data1 = JSON.parse(data);

                          if (data1.response == 'error') {
                               $('#HideWhenSearch').hide();
                               $('#ShowWhenSeaech').hide();
                               $('#ShowWhenSeaech').empty();

                              $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Item Code Not Found...!</p>");

                          }else if(data1.response == 'success'){

                              $('#errorItem').html('');

                               var objcity = data1.data;

                                 $('#HideWhenSearch').hide();
                                 $('#ShowWhenSeaech').show();
                                 $('#ShowWhenSeaech').empty();
                                 $.each(objcity, function (i, objcity) {
                                   $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.item_code+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.item_name+'</td></tr>');
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
     $('body').on('click', '#closeModel', function () {
       // console.log('hii');
          $('.popover').fadeOut();
    })
  });
</script>

<script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script>


@endsection