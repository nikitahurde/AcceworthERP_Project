
               <div class="row">

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Item Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input type="text" class="form-control" name="item_code" value="{{ old('item_code') }}" placeholder="Enter Item Code" id="ItemCodeSearch" oninput="this.value = this.value.toUpperCase()" maxlength="15">

                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>

                          <span class="input-group-addon" style="padding: 5px;">

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

                          </span>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('item_code', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                          <span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="true"></i></span>

                          <input type="text" class="form-control" name="item_name" value="{{ old('item_name') }}" id="ItemName" placeholder="Enter Item Name" maxlength="40">

                          
                           <span class="tooltiptext" id="itemNameTooltip"></span>
                      </div>
                     
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('item_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="itemNameErr"></small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                <!-- /.col -->

                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        HSN Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                          <?php $hsncount = count($hsn_code_list); ?>
                          <input list="hsn_codeList" name="hsn_code" class="form-control" id="hsn_code" style="z-index: auto;" placeholder="Enter HSN Code" maxlength="8" value="<?php if($hsncount == 1){echo $hsn_code_list[0]->HSN_CODE;}else{echo old('hsn_code');}?>">

                           <datalist id="hsn_codeList">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($hsn_code_list as $key)

                            <option value='<?php echo $key->HSN_CODE?>'   data-xyz ="<?php echo $key->HSN_NAME; ?>" ><?php echo $key->HSN_NAME ; echo " [".$key->HSN_CODE."]" ; ?></option>

                            @endforeach

                            </datalist>

                        </div>
                         <small>  

                          <div class="pull-left showSeletedName" id="hsn_codeText"></div>

                        </small>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('hsn_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                          <small id="hsn_code_err"></small>

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

                          <input list="ValuationList" name="valuation_code" class="form-control" id="valuation_code" style="z-index: auto;" placeholder="Enter  Valuation Code" value="<?php if($valcount == 1){echo $valuation_code[0]->VALUATION_CODE;}else{echo old('valuation_code');}?>" maxlength="6">

                          <datalist id="ValuationList">

                            <option value="">--SELECT Item Class--</option>

                            @foreach($valuation_code as $key)

                            <option value="{{$key->VALUATION_CODE}}" data-xyz="{{$key->VALUATION_NAME}}">{{ $key->VALUATION_CODE }}-[{{ $key->VALUATION_NAME }}]</option>


                            @endforeach

                        </datalist>

                        </div>
                        <div class="pull-left showSeletedName" id="ValuationText"></div>
                        
                          <small id="valuation_code_err"></small>
                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('valuation_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                          <small id="valuation_code_err"></small>

                    </div>
                    <!-- /.form-group -->
                  </div>
                <!-- /.col -->

              </div>
              <!-- /.row -->


              <div class="row">

                  

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Item Detail : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-plus"></i></span>

                          <input type="text" name="item_detail" class="form-control zindex" id="item_detail" placeholder="Enter Item Detail" maxlength="50" value="{{old('item_detail')}}">

                      </div>
                      <small id="item_detail_err"></small>
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

                        Item Type: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                          <?php $itemcount = count($item_type); ?> 

                          <input list="itemTypeList" type="text" name="item_type" class="form-control zindex" id="itemtype" style="z-index: auto;" placeholder="Select Item Type" maxlength="6" value="<?php if($itemcount == 1){echo $item_type[0]->ITEMTYPE_CODE;}else{echo old('item_type');}?>">

                         <datalist id="itemTypeList">

                            <option value="">--SELECT UM--</option>

                            @foreach($item_type as $key)

                            <option value="{{$key->ITEMTYPE_CODE }}" data-xyz="{{$key->ITEM_TYPE_NAME}}">{{ $key->ITEMTYPE_CODE  }}-[{{ $key->ITEM_TYPE_NAME }}]</option>


                            @endforeach

                        </datalist>


                        </div>
                         <div class="pull-left showSeletedName" id="itemTypeText"></div>
                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('item_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                          <small id="item_type_err"></small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Item Group : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-object-group"></i></span>
                        <?php $groupcount = count($item_group); ?>
                          <input list="itemgroupList" type="text" name="item_group" class="form-control zindex" id="itemgroup" placeholder="Select Item Group" maxlength="6" value="<?php if($groupcount == 1){echo $groupcount[0]->ITEMGROUP_CODE;}else{echo old('item_group');}?>">

                          <datalist id="itemgroupList">

                            <option value="">--SELECT AUM--</option>

                          @foreach($item_group as $key)

                            <option value="{{$key->ITEMGROUP_CODE }}" data-xyz="{{$key->ITEMGROUP_NAME}}">{{ $key->ITEMGROUP_CODE  }}-{{ $key->ITEMGROUP_NAME }}</option>

                            @endforeach

                          </datalist>

                      </div>
                      <div class="pull-left showSeletedName" id="itemgroupText"></div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('item_group', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>
                      <small id="item_group_err"></small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Item Class: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                        <?php $classcount = count($item_class); ?>
                          <input list="itemClss_List" type="text" name="item_class" class="form-control" id="item_class" style="z-index: auto;" placeholder="Select Item Class" maxlength="6" value="<?php if($classcount=='1'){echo $item_class[0]->ITEMCLASS_CODE;}else{echo old('item_class');}?>">

                         <datalist id="itemClss_List">

                            <option value="">--SELECT Item Class--</option>

                            @foreach($item_class as $key)

                            <option value="{{ $key->ITEMCLASS_CODE }}" data-xyz="{{$key->ITEMCLASS_NAME }}">{{ $key->ITEMCLASS_CODE }}-[{{ $key->ITEMCLASS_NAME }}]</option>


                            @endforeach

                        </datalist>


                        </div>
                         <div class="pull-left showSeletedName" id="itemClss_Text"></div>
                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('item_class', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                          <small id="item_class_err"></small>
                    </div>
                    <!-- /.form-group -->
                  </div>

              </div>

              <div class="row">

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Item Category : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                      <?php $catcount = count($item_category); ?>
                          <input list="itemCat_List" type="text" name="item_category" class="form-control" id="item_cate" placeholder="Select Item Category" maxlength="6" value="<?php if($catcount == 1){echo $item_category[0]->ICATG_CODE;}else{echo old('item_category');}?>">

                          <datalist id="itemCat_List">

                            <option value="">--SELECT AUM--</option>

                          @foreach($item_category as $key)

                            <option value="{{$key->ICATG_CODE }}" data-xyz="{{$key->ICATG_NAME}}">{{ $key->ICATG_CODE  }}-{{ $key->ICATG_NAME }}</option>

                            @endforeach

                          </datalist>

                      </div>
                      <div class="pull-left showSeletedName" id="itemCat_Text"></div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('item_category', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>
                      <small id="item_catg_err"></small>

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

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input list="umList" type="text" name="um" class="form-control" id="selectUm" style="z-index: auto;" placeholder="Select UM" maxlength="3" value="{{old('um')}}">

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
                      <small id="um_err"></small>

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

                          <span class="input-group-addon"><i class="fa fa-plus"></i></span>

                          <input list="aumList" type="text" name="aum" class="form-control" id="selectUam" placeholder="Select AUM" maxlength="3" value="{{old('aum')}}">

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
                      <small id="aum_err"></small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                <!-- /.col -->
                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        AUM Factor: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-plus"></i></span>

                          <input type="text" name="aum_factor" id="aum_factor" class="form-control rightcontent" placeholder="Enter AUM Factor" value="{{ old('aum_factor')}}" maxlength="30">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('aum_factor', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="aumfactor_err"></small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                

                <!-- /.col -->
                  
              </div>

              <div class="row">

                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Qty Decimal : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-amount-asc"></i></span>

                          <input type="text" name="qtydecimal" class="form-control Number" id="qtydecimal" placeholder="Enter Qty Decimal" maxlength="1" value="3">

                      </div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('qtydecimal', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>
                      <small id="qty_dec_err"></small>

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

                          <input type="text" name="rate_type" class="form-control" id="rate_type" placeholder="Enter Rate Type" maxlength="3" value="{{old('rate_type')}}">

                      </div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('rate_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="rate_type_err"></small>
                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Tolrance Index : 


                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-amount-asc"></i></span>

                          <input list="tolranceList" name="tolranceindex" class="form-control" id="tolranceindex" placeholder="Select Tolrance Index" value="{{old('tolranceindex')}}">
                          <datalist id="tolranceList">
                                <option value="">--Select Index--</option>
                                <option value="P" data-xyz ="Percent">P[Percent]</option>
                                <option value="L" data-xyz ="Lumsum">L[Lumsum]</option>
                          </datalist>

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

                        Tolrance Rate : 


                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                          <input type="text" name="tolrance_rate" class="form-control Number" id="tolrance_rate" placeholder="Enter Tolrance Rate" value="{{old('tolrance_rate')}}">

                      </div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('tolrance_rate', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  

              </div>

             <div class="row">
               
               <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Scrap Code : 

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                          <input list="scrapc_List"  name="scrap_code" class="form-control Number" id="scrap_code" placeholder="Enter Scrap Code" value="{{old('scrap_code')}}" maxlength="15">


                         <datalist id="scrapc_List">

                            <option value="">--SELECT Item Class--</option>

                            @foreach($help_item_list as $key)

                            <option value="{{$key->ITEM_CODE}}" data-xyz="{{$key->ITEM_CODE}}">{{ $key->ITEM_CODE }}[{{$key->ITEM_NAME}}]</option>


                            @endforeach

                        </datalist>

                      </div>
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

                          <input list="BatchCheckList" name="batch_check" class="form-control" id="batch_check" placeholder="Select Batch" value="NO" onchange="batechref()">
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

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Batch Refrance : 

                        <span id="batchrefreq"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-amount-asc"></i></span>

                          <input list="BatchRefList" name="bacth_ref" class="form-control" id="bacth_ref" placeholder="Select Refrance" disabled="" maxlength="20">
                          <datalist id="BatchRefList">
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

                      <small id="length_err"></small>
                    </div>
                    <!-- /.form-group -->
                  </div>



             </div>

             <div class="row">
               
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

                      <small id="width_err"></small>
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
                      <small id="height_err"></small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Over-Dimensioned Consignment : 

                        <span id="batchrefreq"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                         <!--  <input type="hidden" class="form-control" name="odc" id="odc" readonly> -->

                         <input type="text" class="form-control" name="odc" id="odc" readonly="">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('odc', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>


                    </div>
                    <!-- /.form-group -->
                  </div>


             </div>

              


            