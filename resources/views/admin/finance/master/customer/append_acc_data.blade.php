 <div class="stepwizard">

      <div class="stepwizard-row setup-panel">

        <div class="stepwizard-step">

                  <a href="#step-1" type="button" class="btn btn-primary btn-circle" id="stepone">1</a>

                  <p>Baisc Details</p>

        </div>

            <div class="stepwizard-step hidebegore" id="show_second">

                  <a href="#step-2" type="button" class="btn btn-default btn-circle" id="steptwo"disabled="disabled">2</a>

                  <p>Direct/Indirect Tax</p>

            </div>

            <div class="stepwizard-step hideFouth" id="show_four">

                  <a href="#step-4" type="button" class="btn btn-default btn-circle" id="stepfour" disabled="disabled">3</a>

                  <p>Address Details</p>

            </div>

             <div class="stepwizard-step hideThired" id="show_third">

                  <a href="#step-3" type="button" class="btn btn-default btn-circle" id="stepthree" disabled="disabled">4</a>

                  <p>Bank Details</p>

             </div>

      </div>

  </div>

  


   <div class="row setup-content" id="step-1">

        <div class="col-xs-12">

          <div class="col-md-12">

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label>Acc Code: <span class="required-field"></span><samll id="accCodeDubErr" style="color: red"></samll></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                      <input type="text" id="acc_code" name="acc_code" class="form-control pull-left codeCapital" placeholder="Select Acc Code" maxlength="6" value="{{ old('acc_code') }}">

                      <span class="input-group-addon" style="padding: 5px 7px;">
                      
                      <div class="">
                         <button type="button" id="login" class="btn btn-xs btn-info gly-radius" style="padding: 1px 3px;font-size: 7px;line-height: 1;"> <i class="fa fa-info" aria-hidden="true"></i></button>
                      </div>
                      <div id="myForm" class="hide">
                        <div class="row">
                            <div class="col-md-9">
                            <input type="text" name="GlmstnameH" id="AccCodeHelp" class="form-control input-md setheightinput" style="text-transform: uppercase;">
                            </div>
                            <div class="col-md-3" style="margin-left: -7%;">
                            
                              <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>

                        </div>
                          <div id="result">
                                
                                <!-- New Way -->
                                <div class="boxer" id="HideWhenSearch">
                                <div class="box-row"><!--Headings-->
                                <div class="box">Account Code</div>
                                <div class="box">Account Name</div>
                                </div>
                                <?php foreach ($acc_mst_list as $key) { ?>
                                <div class="box-row">
                                <div class="box"><?php echo $key->ACC_CODE; ?></div>
                                <div class="box"><?php echo $key->ACC_NAME; ?></div>

                                </div>
                                <?php } ?>
                                </div>

                                
                                <div class="boxer" id="HideWhenSearch">
                                    <div class="box-row"><!--Headings-->
                                        <div class="box">Account Code</div>
                                        <div class="box">Account Name</div>
                                    </div>
                                    
                                    <div class="box-row" id='ShowWhenSeaech'>
                                    
                                    </div>
                                
                                </div>
                                
                                <span id="errorItem"></span>

                          </div>
                      </div>
                      
                      </span>

                          <div class="custom-select">
                              <div id="showSearchCodeList" class="custom-options">
                              
                              </div>  
                          </div>

                      </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('acc_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                        <small id="acccodeErr" class="form-text text-muted"> </small>

                      </div>

                      <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">


                      <div class="form-group">

                      <label>Acc Name: <span class="required-field"></span>

                      </label>

                      <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>



                      <input type="text" id="acc_name" name="acc_name" class="form-control  pull-left" value="{{ old('acc_name') }}" placeholder="Select Acc Name" maxlength="40">


                      </div>



                      <small id="accnameErr" class="form-text text-muted"></small>



                      </div>

                      <!-- /.form-group -->

                      </div>

                      </div>


                      <div class="row">
                          <div class="col-md-6">
                          
                          <div class="form-group">

                          <label>Company Code : </label>
                          
                          <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input list="compList" type="text" class="form-control" name="comp_code" id="comp_code" placeholder="Select Comp Code" value="">

                          <datalist id="compList">

                          @foreach($company_lists as $key) 

                          <option value="{{$key->COMP_CODE}}" data-xyz="{{ $key->COMP_NAME  }}">{{$key->COMP_CODE }} = {{$key->COMP_NAME}}</option>

                          @endforeach

                          </datalist>
                          

                          

                          </div>

                          </div>

                          </div>
                          <div class="col-md-6">
                          
                          <div class="form-group">

                          <label>Company Name : </label>
                          
                          <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                          <input  type="text" class="form-control" name="comp_name" id="comp_name" placeholder="Select Company Name" value="" readonly="">

                          </div>

                          </div>
                          </div>
                      </div>


                      <div class="row">

                          <div class="col-md-6">

                          <div class="form-group">

                          <label>Acc Type Code : <span class="required-field"></span></label>



                          <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <?php $acCount = count($acctype_lists); ?>
                          <input list="accList" type="text" class="form-control" name="acctype_code" id="acctype_code" placeholder="Select Account type" maxlength="6" value="{{ old('acctype_code') }}" <?php if($acCount ==1){echo $acctype_lists[0]->ATYPE_CODE; }else{} ?>>

                          <datalist id="accList">

                          <?php foreach ($acctype_lists as $key) { ?>

                          <option value="<?php echo $key->ATYPE_CODE; ?>" data-xyz="{{ $key->ATYPE_NAME  }}"><?php echo $key->ATYPE_CODE;?> = <?php echo   $key->ATYPE_NAME;?></option>

                          <?php } ?>

                          </datalist>
                          

                          

                          </div>

                          <div class="pull-left showSeletedName" id="acctypeText"></div>
                          

                          <small id="taxcodeErr" class="form-text text-muted"> </small>

                          <small id="accTypeErr" class="form-text text-muted"></small>



                          </div>

                          <!-- /.form-group -->

                          </div>



                          <div class="col-md-6">



                          <div class="form-group">



                          <label>Acc Category Code: 

                          </label>



                          <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                          <?php $accat = count($acccategory_lists); ?>
                          <input list="accCatList" type="text" class="form-control" name="acccategory_code" id="acccategory_code" placeholder="Select Account Category" maxlength="6" value="{{ old('acccategory_code') }}<?php if($accat ==1){echo $acccategory_lists[0]->ACATG_CODE;}else{}?>">

                          <datalist id="accCatList">

                          <option value="">--Select--</option>

                          <?php foreach ($acccategory_lists as $key) { ?>

                          <option value="<?php echo $key->ACATG_CODE ?>" data-xyz="{{ $key->ACATG_NAME }}"><?php echo $key->ACATG_CODE?> = <?php echo   $key->ACATG_NAME?></option>

                          <?php } ?>

                          </datalist>   




                          </div>

                          <div class="pull-left showSeletedName" id="accCatText"></div>

                          <small id="transcodeErr" class="form-text text-muted"></small>



                          </div>

                          <!-- /.form-group -->

                          </div>

                      </div>





                      <div class="row">

                          <div class="col-md-6">

                          <div class="form-group">

                          <label>Acc Class Code: </label>



                          <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <?php $classcount = count($accclass_lists); ?>
                          
                          <input list="accClassList" type="text" class="form-control" name="accclass_code" id="accclass_code" placeholder="Select Account Class" maxlength="6" value="{{ old('accclass_code') }}">
                          <datalist id="accClassList">
                          <option value="">--Select--</option>

                          <?php foreach ($accclass_lists as $key) { ?>

                          <option value="<?php echo $key->ACLASS_CODE  ?>" data-xyz="{{ $key->ACLASS_NAME }}"><?php echo $key->ACLASS_CODE?> = <?php echo $key->ACLASS_NAME?></option>

                          <?php } ?>

                          
                          </datalist>
                          

                          

                          </div>


                          <div class="pull-left showSeletedName" id="accClassText"></div>

                          <small id="taxcodeErr" class="form-text text-muted"> </small>



                          </div>

                          <!-- /.form-group -->

                          </div>

                           <div class="col-md-3">

                        <div class="form-group">

                          <label>Gl Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                                <?php $glcount = count($gl_lists); ?>

                                  <input list="GLList" type="text" class="form-control" name="gl_code" id="gl_code" placeholder="Select Gl Code" value="{{ old('gl_code') }}" autocomplete="off" >

                                  <datalist id="GLList">
                                    <option value="">--Select--</option>

                                    <?php foreach ($gl_lists as $key) { ?>

                                      <option value="<?php echo $key->GL_CODE  ?>" data-xyz="{{ $key->GL_NAME }}"><?php echo $key->GL_CODE?> = <?php echo $key->GL_NAME?></option>

                                    <?php } ?>

                                  </datalist>
                              
                            </div>
                            <small id="glcodeErr"  class="form-text text-muted"></small>
                            
                            
                        </div>

                        <!-- /.form-group -->

                      </div>

                          <div class="col-md-3">

                          <div class="form-group">

                          <label>Credit Limit: </label>

                          <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                          
                          <input type="text" class="form-control" name="credit_limit" id="credit_limit" placeholder="Enter Credit Limit"  value="" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                          
                          </div>

                          <div class="pull-left showSeletedName" id="accClassText"></div>

                          <small id="taxcodeErr" class="form-text text-muted"> </small>

                          </div>

                          <!-- /.form-group -->

                          </div>


                          <div class="col-md-3">

                          <div class="form-group">

                          <label>GP Days: </label>

                          <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                          
                          <input type="text" class="form-control" name="gp_days" id="gp_days" placeholder="Enter GP Days">
                          
                          </div>

                          <div class="pull-left showSeletedName" id="accClassText"></div>

                          <small id="gpErr" class="form-text text-muted"> </small>

                          </div>

                          <!-- /.form-group -->

                          </div>

                      </div>

                      <center> <button class="btn btn-primary btn-md nextBtn" type="button" id="firstStep">Next</button></center>

                      </div>

          </div>

      </div>


    <!--   step 1 -->


     <!--   step 2 -->
     <div class="row setup-content" id="step-2" style="display:none;">

                      <div class="col-xs-12">

                      <div class="col-md-12">



                      <div class="row">

                            <div class="col-md-6">

                            <div class="form-group">

                            <label>TAX Code: </label>



                            <div class="input-group">



                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                            </span>



                            
                            <input list="taxcodeList" type="text" class="form-control" name="tax_code" id="tax_code" placeholder="Select Tax Code" value="{{ old('tax_code') }}" maxlength="15">

                            <datalist id="taxcodeList">

                            <option value="">--Select--</option>

                            <?php foreach ($tax_lists as $key) { ?>

                            <option value="<?php echo $key->TAX_CODE ?>" data-xyz="{{ $key->TAX_NAME }}"><?php echo $key->TAX_CODE?> = <?php echo $key->TAX_NAME ?></option>

                            <?php } ?>

                            

                            </datalist>

                            

                            </div>

                            <div class="pull-left showSeletedName" id="taxcodeText"></div>

                            <small id="contactperErr" class="form-text text-muted"> </small>



                            </div>

                            <!-- /.form-group -->

                            </div>



                            <div class="col-md-6">



                            <div class="form-group">



                            <label>TDS Code: 

                            </label>



                            <div class="input-group">



                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>


                            <input list="tdsList" type="text" class="form-control" name="tds_code" id="tds_code" placeholder="Select Tds Code" maxlength="15" value="{{ old('tds_code') }}">

                            <datalist id="tdsList">

                            <option value="">--Select--</option>

                            <?php foreach ($tds_lists as $key) { ?>

                            <option value="<?php echo $key->TDS_CODE ?>" data-xyz="{{ $key->TDS_NAME }}"><?php echo $key->TDS_CODE?> = <?php echo $key->TDS_NAME?></option>

                            <?php } ?>

                            

                            </datalist>



                            </div>


                            <div class="pull-left showSeletedName" id="tdscodeText"></div>

                            <small id="accnameErr" class="form-text text-muted"></small>



                            </div>

                            <!-- /.form-group -->

                            </div>

                      </div>



                      <div class="row">

                          <div class="col-md-6">

                          <div class="form-group">

                          <label>TAN No: </label>



                          <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i></span>



                          <input type="text" id="tan_no" name="tan_no" class="form-control pull-left" placeholder="Enter Phone No.1" maxlength="15" value="{{ old('tan_no') }}">

                          

                          </div>



                          <small id="contactperErr" class="form-text text-muted"> </small>



                          </div>

                          <!-- /.form-group -->

                          </div>



                          <div class="col-md-6">



                          <div class="form-group">



                          <label>TIN No: 
                          </label>



                          <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i></span>



                          <input type="text" id="tinno" name="tinno" class="form-control pull-left" placeholder="Enter Phone No.1" maxlength="15" value="{{ old('tinno') }}">



                          </div>



                          <small id="accnameErr" class="form-text text-muted" style="color: red;"></small>



                          </div>

                          <!-- /.form-group -->

                          </div>

                      </div>



                      <div class="row">

                            <div class="col-md-6">

                            <div class="form-group">

                            <label>Sale Tax No: </label>



                            <div class="input-group">



                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>



                            <input type="text" id="sales_taxno" name="sales_taxno" class="form-control pull-left" placeholder="Enter Sale Tax No" maxlength="15" value="{{ old('sales_taxno') }}">

                            

                            </div>



                            <small id="contactperErr" class="form-text text-muted"> </small>



                            </div>

                            <!-- /.form-group -->

                            </div>



                   <div class="col-md-6">

                      <div class="form-group">



                      <label>CSale Tax No:</label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>



                          <input type="text" id="csales_taxno" name="csales_taxno" class="form-control pull-left" placeholder="Enter CSale Tax No" maxlength="15" value="{{ old('csales_taxno') }}">



                      </div>


                      <small id="accnameErr" class="form-text text-muted"></small>



                      </div>

                      <!-- /.form-group -->

                      </div>

                      </div>



                      <div class="row">

                            <div class="col-md-6">

                            <div class="form-group">

                            <label>Service Tax No: </label>



                            <div class="input-group">



                            <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i></span>



                            <input type="text" id="service_taxno" name="service_taxno" class="form-control pull-left" placeholder="Enter Service Tax No" maxlength="15" value="{{ old('service_taxno') }}">

                            

                            </div>



                            <small id="contactperErr" class="form-text text-muted"> </small>



                            </div>

                            <!-- /.form-group -->

                            </div>



                            <div class="col-md-6">



                            <div class="form-group">



                            <label>Pan No: 

                            </label>



                            <div class="input-group">



                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>



                            <input type="text" id="panno" name="panno" class="form-control pull-left" placeholder="Enter Pan No" maxlength="10" value="{{ old('panno') }}">

                    </div>

                   <small id="accnameErr" class="form-text text-muted"></small>

                </div>
                    <!-- /.form-group -->

                </div>

              </div>

                <center><button class="btn btn-primary btn-md nextBtn" type="button" id="secondstep">Next</button>
                </center>

            </div>

        </div>

    </div>

     <!--   step 2 -->

     <!--   step 3 -->

<div class="row setup-content" id="step-3" style="display:none;">

  <div class="col-xs-12">

    <div class="col-md-12">

          <div class="row">

              <div class="col-md-6">

              <div class="form-group">

              <label>Bank Name: <span class="required-field iconshowhide" id="bankNameTx"></span></label>



              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>


              <input type="text" class="form-control" name="bank_name" id="bank_name" value="" placeholder="Enter Bank Name" value="{{ old('bank_name') }}" >

              </div>



              <small id="banknameErr" class="form-text text-muted"></small>



              </div>

              <!-- /.form-group -->

              </div>



              <div class="col-md-6">



              <div class="form-group">



              <label>Account Number : <span class="required-field iconshowhide"></span>

              </label>



              <div class="input-group">



              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>



              <input type="text" class="form-control" name="acc_number" id="acc_number" value="" placeholder="Enter Account Number" value="{{ old('acc_number') }}" maxlength="20">
              

              </div>



              <small id="accnumberErr" class="form-text text-muted">
              </small>

              </div>

              <!-- /.form-group -->

              </div>

      </div>



  <div class="row">

      <div class="col-md-6">

      <div class="form-group">

      <label>Branch : <span class="required-field iconshowhide"></span></label>



      <div class="input-group">



      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>



      <input type="text" id="branch_name" name="branch_name" class="form-control pull-left" placeholder="Enter Branch Name" value="{{ old('branch_name') }}" maxlength="50">

      

      </div>



      <small id="branchnameErr" class="form-text text-muted"> </small>

      </div>

      <!-- /.form-group -->

      </div>



      <div class="col-md-6">

            <div class="form-group">

            <label>IFSC Code : 
            <span class="required-field iconshowhide"></span>
            </label>

            <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

            <input type="text" id="ifsc_code" name="ifsc_code" class="form-control pull-left" placeholder="Enter IFSC Code" value="{{ old('ifsc_code') }}" maxlength="11">

            </div>

            <small id="ifsccodeErr" class="form-text text-muted"></small>

            </div>

      <!-- /.form-group -->

      </div>

      </div>



      <div class="row">

            <div class="col-md-6">

            <div class="form-group">

            <label>Address : <span class="required-field iconshowhide"></span></label>



            <div class="input-group">



            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>


            <textarea class="form-control" col="50" rows="3" name="bank_address" placeholder="Enter Address" value="{{ old('bank_address') }}"></textarea>
            <!--  <input type="text" id="branch_name" name="branch_name" class="form-control pull-left" placeholder="Enter Branch Name"> -->

            

            </div>



            <small id="bankaddressErr" class="form-text text-muted"> </small>



            </div>

            <!-- /.form-group -->

            </div>


         </div>

         

          <center> <button class="btn btn-primary btn-md" type="button" onclick="submitAccData()">Save</button></center>

          </div>

          </div>
     </div>
       <!--   step 3 -->

       <!-- step 4 -->


<div class="row setup-content" id="step-4" style="display:none;">

  <div class="col-xs-12">

    <div class="col-md-12">

          

                      <div class="table-responsive tdthtablebordr" style="overflow-x: unset;">
                        <div id="acctableid">
                       <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                         <tr>

                          <th><input class='check_all' type='checkbox' onclick="select_all()"/ title="Delete All Row"></th>

                          <th>Sr.No.</th>

                          <th style="text-align: center;">Contact Information</th>

                          <th style="text-align: center;">Others</th>

                          
                          </tr>

                            <tr class="useful">



                              <td class="tdthtablebordr"><input type='checkbox' class='case' title="Delete Single Row" name='countcheckbox[]' id='countcheckbox1' /></td>

                              <td class="tdthtablebordr">

                              <span id='snum'>1.</span>

                              <input type="hidden" name="slno[]" id="slno1" value="1">

                              </td> 

                              <td class="tdthtablebordr" style="width: 45%;">

                              <small id="contactInfoReq"></small>

                              <div class="input-group">
                              <div class="classAddrs">
                              
                              <span class="required-field"></span>
                              <textarea  name="address[]" id="address1" cols="20" rows="2" placeholder="Address" style="width: 277px;margin-bottom: 5px;" value="{{ old('address') }}" autocomplete="off"></textarea></div>

                              <div class="row">
                              <div class="col-md-6">
                              <div class="classAddrs"><span class="required-field"></span> <input type="text" class="inputboxclr  getAccNAme form-group " style="width: 120px;margin-bottom: 5px;"  id="contact_person1" name="contact_person[]" placeholder="Contact Person" autocomplete="off"  value="{{ old('contact_person') }}"/></div>

                              <div class="classAddrs"><span class="required-field"></span><input type="text" class="textdesciptn discription forperticulr form-group Number"  name="pincode[]" id="pincode1" placeholder="Pincode" maxlength="8" value="{{ old('pincode') }}" style="margin-bottom: 5px;width: 120px;" autocomplete="off"></div>
                              

                              </div>
                              <div class="col-md-6">
                              
                              <div class="classAddrs"><span class="required-field"></span>
                              <input list="cityList1" class="textdesciptn discription forperticulr form-group"  name="city[]" id="city1" placeholder="City" value="{{ old('city') }}" onchange="getFullAdrs(1)" style="margin-bottom: 5px;width: 120px;" autocomplete="off">

                              <datalist id="cityList1">

                                  @foreach($city_lists as $key) 

                                    <option value="{{$key->CITY_CODE}}" data-xyz="{{ $key->CITY_NAME  }}">{{$key->CITY_CODE }} = {{$key->CITY_NAME}}</option>

                                   @endforeach

                              </datalist>

                             </div>

                              <div class="classAddrs"><span class="required-field"></span>
                              <input type="text" class="textdesciptn discription forperticulr"  name="district[]" id="district1" placeholder="District" value="{{ old('district') }}" style="margin-bottom: 5px;width: 120px;" autocomplete="off"></div>

                              
                              </div>
                              </div>

                              

                              
                              <div class="row">
                              <div class="col-md-6">
                              <div class="classAddrs"><span class="required-field"></span>
                              <input list="stateList" class="textdesciptn discription forperticulr"  name="state[]" id="state1" placeholder="State" value="{{ old('state') }}" style="margin-bottom: 5px;width: 120px;" onchange="stateName(1)">

                              <datalist id="stateList">

                              <?php foreach ($state_lists as $key) { ?>

                              <option value="<?php echo $key->STATE_CODE ?>" data-xyz="{{ $key->STATE_NAME }}"><?php echo $key->STATE_CODE?> = <?php echo $key->STATE_NAME?></option>


                              <?php  } ?>
                              
                              </datalist>
                              </div>
                              <input type="hidden" id="state_name1" name="state_name[]" value="">

                              <div class="classAddrs"><span class="required-field"></span>
                              <input type="text" class="textdesciptn discription forperticulr Number"  name="phone[]" id="phone1" placeholder="Phone No" value="{{ old('phone') }}" style="margin-bottom: 5px;width: 120px;" maxlength="10">
                              </div>

                              </div>

                              <div class="col-md-6">
                              <div class="classAddrs"><span class="required-field"></span>
                              <input type="text" class="textdesciptn discription forperticulr"  name="email[]" id="email1" value="{{ old('email') }}" placeholder="Email" style="margin-bottom: 5px;width: 120px;">
                              </div>

                               <div class="classAddrs"><span class="required-field"></span>
                                              <input list="offDaysList1" class="textdesciptn discription forperticulr form-group"  name="offDays[]" id="offDays1" placeholder="Off Days" value="{{ old('offDays') }}" onchange="getFullAdrs(1)" style="margin-bottom: 5px;width: 120px;">
                                              <datalist id="offDaysList1">

                                                  <option value="">--SELECT--</option>
                                                  <option value="SUNDAY" data-xyz="SUNDAY">SUNDAY</option>
                                                  <option value="MONDAY" data-xyz="MONDAY">MONDAY</option>
                                                  <option value="TUESDAY" data-xyz="TUESDAY">TUESDAY</option>
                                                  <option value="WEDNESDAY" data-xyz="WEDNESDAY">WEDNESDAY</option>
                                                  <option value="THURSDAY" data-xyz="THURSDAY">THURSDAY</option>
                                                  <option value="FRIDAY" data-xyz="FRIDAY">FRIDAY</option>
                                                  <option value="SATURDAY" data-xyz="SATURDAY">SATURDAY</option>

                                              </datalist>
                                            </div>

                              </div>
                              </div>
                              </div>
                              

                              </td>

                              <td class="tdthtablebordr">

                              <div class="row">
                              <div class="col-md-4">

                              <select type="text" class="inputboxclr getAccNAme" style="width: 120px;margin-bottom: 1px;height: 26px;" id="gst_type1" onclick="GstType(1)" name="gst_type[]" value="">
                              <option value="">--GST TYPE--</option>
                              <option value="Register">Register</option>
                              <option value="UnRegister">UnRegister</option>
                              <option value="Not-Applicable">Not-Applicable</option>
                              </select>

                              </div>
                              <div class="col-md-4">
                              <div id="GstNo"></div>
                              <input type="text" class="textdesciptn discription forperticulr" name="gst_num[]" id="gst_num1" style="width: 120px; margin-bottom: 5px; z-index: 0;" placeholder="GST No" value="" oninput="gstNum(1)">  
                              </div>
                              <div class="col-md-4">
                              <input type="text" class="inputboxclr getAccNAme" style="width: 110px;margin-bottom: 5px;" id='ecc_no1' name="ecc_no[]"  placeholder="ECC NO"  value="{{ old('ecc_no') }}"/>
                              </div>

                              </div>

                              <textarea type="text" class="textdesciptn discription forperticulr"  name="range_address[]" id="range_address1" style="width: 356px;margin-bottom: 5px;" placeholder="Range Address" value="{{ old('range_address') }}"></textarea>
                              <div class="row">
                              
                              <div class="col-md-6">
                              <input type="text" class="textdesciptn discription forperticulr"  name="range_no[]" id="range_no1" style="width: 120px;margin-bottom: 5px;" placeholder="Range No" value="{{ old('range_no') }}">


                              </div>
                              <div class="col-md-6">
                              <input type="text" class="inputboxclr getAccNAme" style="width: 120px;margin-bottom: 5px;" id='range_name1' name="range_name[]" placeholder="Range Name"  value="{{ old('range_name') }}"/>

                              </div>
                              </div>
                              <div class="row">
                              <div class="col-md-6">
                              
                              
                              <input type="text" class="textdesciptn discription forperticulr"  name="division[]" id="division1" style="width: 120px;margin-bottom: 5px;" placeholder="Division" value="{{ old('division') }}">

                              </div>
                              <div class="col-md-6">
                              <input type="text" class="inputboxclr getAccNAme" style="width: 120px;margin-bottom: 5px;" id='collector1' name="collector[]" style="width: 120px;margin-bottom: 5px;" placeholder="Collector"  value="{{ old('collector') }}"/>

                              
                              

                              </div>
                              </div>

                              </td>

                          </tr>
                       </table>
                       </div>
                      </div>

                      
                      <br>
                      
                      <button type="button" class='btn btn-danger btn-sm deleteacc' id="deletehidnacc" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                      <button type="button" class='btn btn-info btn-sm addmoreacc' id="addmorhidnacc" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;" ></i>&nbsp; Add More</button>


                      <p class="text-center">

                      
                      </p>


    </div>

    <center> <button class="btn btn-primary btn-md nextBtn" type="button" id="thirdStep">Next</button></center>

  </div>

</div>



   <!-- step 4 -->


 <script type="text/javascript">

  $('document').ready(function(){

      $('#firstStep').click(function(){

          var comp_code = $("#comp_code").val();

          var comp_name = $("#comp_name").val();
          
          var acc_code = $("#acc_code").val();

          var acc_name = $("#acc_name").val();

          var acc_type = $("#acctype_code").val();

          if(acc_code.trim() == '' && acc_name.trim() == '' && acc_type.trim() == ''){



           $('#acccodeErr').html('The account code field is required.').css('color','red');

           $('#accnameErr').html('The account name field is required.').css('color','red');

           $('#accTypeErr').html('The account type field is required.').css('color','red');

          /* $('#step-1').css('display','block');

           $('#step-2').css('display','none');

           $('#step-3').css('display','none');*/

           return false;

          }else if(acc_code.trim() == ''){

             $('#acccodeErr').html('The account code field is required.').css('color','red');

             return false;

          }else if(acc_name.trim() == '' && acc_type.trim() == ''){

            $('#acccodeErr').html('');

            $('#accnameErr').html('The account name field is required.').css('color','red');

            $('#accTypeErr').html('The account type field is required.').css('color','red');

            return false;



          }else if(acc_type.trim() == ''){

            $('#acccodeErr').html('');
            $('#accnameErr').html('');

            $('#accTypeErr').html('The account type field is requireds.').css('color','red');

            return false;



          }else{

            $('#acccodeErr').html('');

            $('#accnameErr').html('');

            $('#accTypeErr').html('');

            $('#stepone').removeClass('btn-primary');

            $('#steptwo').addClass('btn-primary');

            $('#step-1').css('display','none');

            $('#step-2').css('display','block');

            $('#show_second').removeClass('hidebegore');

           

            return true;

          }

      });



      /*$('#secondstep').click(function(){

               $('#step-1').css('display','none');

               $('#step-2').css('display','none');

               $('#step-3').css('display','block');

               $('#steptwo').removeClass('btn-primary');

               $('#stepthree').addClass('btn-primary');

               $('#show_third').removeClass('hideThired');

            

      });



      $('#thirdStep').click(function(){

               $('#step-1').css('display','none');

               $('#step-2').css('display','none');

               $('#step-3').css('display','none');

               $('#step-4').css('display','block');

               $('#stepthree').removeClass('btn-primary');

               $('#stepfour').addClass('btn-primary');

               $('#show_four').removeClass('hideFouth');

      });

*/
$('#secondstep').click(function(){

               $('#step-1').css('display','none');

               $('#step-2').css('display','none');

               $('#step-3').css('display','none');

               $('#step-4').css('display','block');

               $('#steptwo').removeClass('btn-primary');

               $('#stepfour').addClass('btn-primary');

                $('#show_four').removeClass('hideFouth');
               

            

      });



      $('#thirdStep').click(function(){

        var addrs    = $('#address1').val();
        var contact  = $('#contact_person1').val();
        var city     = $('#city1').val();
        var pincode  = $('#pincode1').val();
        var district = $('#district1').val();
        var state    = $('#state1').val();
        var email    = $('#email1').val();
       
        if(addrs && contact && city && pincode && district && state && email){
              $('#contactInfoReq').html('');
              $('#step-1').css('display','none');

               $('#step-2').css('display','none');

               $('#step-3').css('display','block');

               $('#step-4').css('display','none');

               $('#stepfour').removeClass('btn-primary');

               $('#stepthree').addClass('btn-primary');

              $('#show_third').removeClass('hideThired');

        }else{
            $('#contactInfoReq').html('Contact Information Required').css('color','red');
        }

               


      });






  });

</script>


<script type="text/javascript">

  function getFullAdrs(num){

    var val = $("#city"+num).val();
    var xyz = $('#cityList'+num+' option').filter(function() {

      return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
      $("#city"+num).val('');
    }else{
      var city = $("#city"+num).val();

      $("#city"+num).val(val+'['+msg+']');

      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({

            url:"{{ url('get-full-address-against-city') }}",
            method : "POST",
            type: "JSON",
            data: {city: city},
            success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                }else if(data1.response == 'success'){

                    var details = data1.data;
                    console.log('details',details);
                    $('#district'+num).val(details[0]['DISTRICT_CODE']+'['+details[0]['DISTRICT_NAME']+']');
                    $('#state'+num).val(details[0]['STATE_CODE']+'['+details[0]['STATE_NAME']+']');
                    $('#pincode'+num).val(details[0]['PIN_CODE']);
                }
            }

      });

    }

  }
</script>

<script type="text/javascript">
  $("#acctype_code").bind('change', function () {  

      var val = $(this).val();

      alert(val);

      var xyz = $('#accList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match'; 

      if(msg=='No Match'){
        $(this).val('');
        $('#acctypeText').val('');
        $('#isBankReq').val('');
        $('#accTypeErr').html('The account type field is required.').css('color','red');
      }else{
        $('#acctype_code').val(val+'['+msg+']');
        $('#accTypeErr').html('');
      }

      var accType      = $(this).val();
      var splitAccType = accType.split('[');
      var accTypeCode  = splitAccType[0];

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

      });

      $.ajax({

            url:"{{ url('check-n-get-data-against-accType') }}",

             method : "POST",

             type: "JSON",

             data: {accTypeCode: accTypeCode},

             success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                }else if(data1.response == 'success'){

                  console.log('data1',data1.data);

                  if(data1.data == ''){

                  }else{
                    $('#isBankReq').val(data1.data[0].BANK_REQ);
                    var bankReqYes = $('#isBankReq').val();
                    if(bankReqYes == 'YES'){
                      $('#bankNameTx,#accNameTx,#branchTx,#ifscTx,#addresTx').removeClass('iconshowhide');
                    }else{
                      $('#bankNameTx,#accNameTx,#branchTx,#ifscTx,#addresTx').addClass('iconshowhide');
                    }
                  }
                      
                }
             }

      });

    });
</script>

<script type="text/javascript">
  $("#comp_code").bind('change', function () { 
          
          var val = $(this).val();

          var xyz = $('#compList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg =='No Match'){
            $('#comp_code').val('');
            $('#comp_name').val('');
             
          }else{
            $('#comp_name').val(msg);
          }

  });


  $("#acccategory_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accCatList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){
             $(this).val('');
             $('#accCatText').val('');
          }else{
            $('#acccategory_code').val(val+'['+msg+']');
          }

        });

      $("#accclass_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accClassList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){
             $(this).val('');
             $('#accClassText').val('');
          }else{
            $('#accclass_code').val(val+'['+msg+']');
          }

      });

      $("#gl_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#GLList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){
             $(this).val('');
             $('#glText').val('');

          }else{
            $('#gl_code').val(val+'['+msg+']');
            $('#glcodeErr').html('');
          }

      });
</script>

