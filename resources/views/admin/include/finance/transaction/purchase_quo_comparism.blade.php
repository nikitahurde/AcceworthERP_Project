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
  .rightcontent{
  text-align:right;
  }
  ::placeholder {
    text-align:left;
  }
  .Custom-Box {
      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  @media screen and (max-width: 600px) {

    .PageTitle{

      float: left;

    }


  }


.pricing{
  margin:40px 0px;
}
.pricing .table{
  border-top:1px solid #13131324;
  background:#fff;
}
.pricing .table th,
.pricing .table {
  text-align: center;
}
.pricing .table th,
.pricing .table td {
  padding: 0px 10px;
  border:1px solid #13131324;
  vertical-align: middle;
}
.pricing .table th {
  width: 25%;
  font-size: 20px;
  font-weight: 400;
  border-bottom: 0;
  background:#d2d6de;
  color: #060607;
  text-transform: uppercase;
}
.pricing .table th.highlight{
  border-top: 4px solid #4caf50 !important;
}
.oddclr{
  background: #def3ff;
  
}
.evenclr{
  background: #c5eddb;
 
}
.pricing .table td:first-child{
  padding-left: 2px;
  text-align: center;
  padding-top:3px;
}

.pricing tr td {
  font-size: 14px;
  line-height:32px !important;
  text-transform:uppercase;
  width: 15%;
}
.hiseshowtble{
  display: none;
}
.indicaC{
  display: none;
}
.indicateClass{
  border: 1px solid;
  width: 24px;padding: 2px;
  background-color: #eaeff1; 
  border-color: #f1c88c;
  margin-right: 2px;
}
.circleindicate{
  border: 1px solid;
  width: 3px;
  border-radius: 50px;
  padding: 8px;
  background-color: #e78e0e;
  color: #e78e0e;
}
.notshowtbl{
  display: none;
}
.hidesavebtn{
  display: none;
}
.headingtab{
    background-color: aliceblue;
    font-weight: 700;
}
.itemshowtd{
    vertical-align: middle !important;
    font-weight: 700;
}
.setnametag{
  line-height: 22px;
}
.textalignRight{
  text-align: right;
}
.displaynot{
  display: none;
}
</style>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quotation comparision
        <small>Add Details</small>
      </h1>

      <ul class="breadcrumb">

        <li>
          <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
        </li>

        <li>
          <a href="{{ url('/dashboard') }}">Transaction</a>
        </li>

        <li class="active">
          <a href="{{ url('/finance/transaction/purchase-order-transaction') }}"> Quotation Comparision</a>
        </li>

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Quotation Comparision</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/finance/view-purchase-quatation') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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
                <!-- <div class="col-md-3">
                    
                  <div class="form-group">

                        <label>Quotation No.: <span class="required-field"></span>
                          </label>

                        <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                              <input list="quotatn_no_list" class="form-control" id="quotatn_no" name="item" placeholder="Enter Quotation No. " value="">

                            <datalist id="quotatn_no_list">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($quotatn_data as $key)

                              <option value='< ?php echo $key->vr_no?>'   data-xyz ="< ?php echo $key->vr_no; ?>" >< ?php echo $key->vr_no ; ?></option>

                              @endforeach

                            </datalist>

                        </div>

                    </div>

                </div>

                <div class="col-md-3">
                    
                  <div class="form-group">

                        <label>Quotation Sl No.: <span class="required-field"></span>
                          </label>

                        <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                              <input list="quotatn_sl_no_list" class="form-control" id="quotatn_sl_no" name="item" placeholder="Enter Quotation Sl No. " value="">

                            <datalist id="quotatn_sl_no_list">

                              <option selected="selected" value="">-- Select --</option>

                            </datalist>

                        </div>

                    </div>

                </div> -->
                <div class="col-md-3"></div>
                <div class="col-md-3">

                    <div class="form-group">

                        <label>Req For Quotation No.: <span class="required-field"></span>
                          </label>

                        <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                              <input list="enquiryList" class="form-control" id="enquiry_no" name="item" placeholder="Enter Enquiry No. " value="">

                            <datalist id="enquiryList">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($enquiry_no as $key)

                              <option value='<?php echo $key->vr_no?>'   data-xyz ="<?php echo $key->vr_no; ?>" ><?php echo $key->vr_no ; ?></option>

                              @endforeach

                            </datalist>

                        </div>

                        <span id=showerrenq></span>

                    </div>
                      <!-- /.form-group -->
                </div>

                <div class="col-md-2">
                  <div class="form-group">

                        <label>QC No.: <span class="required-field"></span>
                          </label>

                        <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                              <input type="text" class="form-control" id="qc_noshow" name="qc_no_get" placeholder="Enter QC No " value="<?php echo $qc_no_get; ?>" readonly>

                        </div>

                    </div>
                </div>

                <div class="col-md-2">
                  <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch" style="padding: 5px;margin-top: 26%;"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>
                </div>

                
              </div>

              <div class="row">
                    
                <div class="pricing">
                  <div class="container">

                    <div class="pricing-table table-responsive" style="width: 77%;">
                      <div id="notdtataofund"></div>
                      <div style="" class="indicaC" id="indicatetag">
                      <div class="indicateClass">
                      <div class="circleindicate"></div>
                      </div>
                       <b> Lowest Value - ( L1 )</b></div>
                        <form id="QuotatnCompare">
                          <input type="hidden" id="requstFQtn" value="" name="requstFQtn">
                          <input type="hidden" class="form-control" name="qc_no" placeholder="Enter QC No " value="<?php echo $qc_no_get; ?>" readonly>
                          <table class="table notshowtbl" id="hidetble">
                              <thead> 
                                  <tr>
                                      <th colspan="11">COMPARATIVE STATEMENT OF QUOTATION</th>
                                  </tr>
                                  
                              </thead>
                              <tbody id="getalldata">
                                  
                              </tbody>
                          </table>
                          <center><button class="btn btn-success hidesavebtn" type="button" id="submitdata"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button></center>
                        </form>
                    </div>
                  </div>

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

    $("#enquiry_no").bind('change', function () {
      var enquiry_no =  $(this).val();
      var xyz = $('#enquiryList option').filter(function() {

        return this.value == enquiry_no;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
       
      if(msg=='No Match'){
       $(this).val('');
      }else{
        
      }

    });

    $('#btnsearch').on('click',function(){

      var enquiry_no = $('#enquiry_no').val();

      if(enquiry_no == ''){

        $('#showerrenq').html('Select Req For Quotation No').css('color','red');
        $('#getalldata').empty();
        $('#submitdata').prop('disabled',true);
      }else{
        $('#showerrenq').html('');
        $('#submitdata').prop('disabled',false);
        $.ajaxSetup({

              headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

          });

          $.ajax({

                url:"{{ url('get-data-by-item-in-quo-compare') }}",

                 method : "POST",

                 type: "JSON",

                 data: {enquiry_no:enquiry_no},

                  success:function(data){

                      var data1  = JSON.parse(data);
                 
                      if (data1.response == 'error') {

                          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                      }else if(data1.response == 'success'){

                        if(data1.data == ''){

                          $('#notdtataofund').html('No Data Found').css({"color":"red","text-align":"center"});

                            $('#getalldata').empty();
                            $('#submitdata').addClass('hidesavebtn');
                            $('#indicatetag').css('display','none');
                        }else{

                          $('#notdtataofund').html('');

                            $('#hidetble').removeClass('notshowtbl');
                            $('#submitdata').removeClass('hidesavebtn');
                            $('#indicatetag').css('display','flex');
                            $('#getalldata').empty();

                        var headingtag = "<tr class='headingtab'><td>Sr. No. </td><td>Item </td><td>Qty </td><td>Party </td><td>Qtn No </td><td>Rate </td><td>Basic </td><td><div style='line-height: 19px;'>Cr Amt </div> </td><td>Landed Rate</td><td>Level</td></tr>";
                        $('#getalldata').append(headingtag);

                        var srno =1;
                        var srno1 =2;

                        var enquiry_no = $('#enquiry_no').val();
                        $('#requstFQtn').val(enquiry_no);

                        var itmCount =[];
                        $.each(data1.data, function (i, objcount) {
                              itmCount.push(objcount.item_code);
                        });

                        var fetchaccode = itmCount.filter(function (item,index,inputArray){

                              return inputArray.indexOf(item) == index;
                        });

                        var counts = {};

                        $.each(data1.data, function (i, objItem) {

                         var cramt = objItem.cr_amount;
                         var quantity = objItem.quantity;

                         var landedRate1 = parseFloat(cramt) /parseFloat(quantity);


                        if(landedRate1 % 1 ==0){
                         var landedRate =  parseFloat(landedRate1)+'.00';
                        }else{
                          var landedRate =landedRate1;
                        }

                         landedRate =  landedRate.toString();

                         var ratelan = landedRate.split('.');

                         var explodlanded = ratelan[1];

                         //console.log('explodlanded',landedRate);
                      
                         var landedRate_1 =explodlanded.slice(0, 2);
                        
                          var landedRateR = ratelan[0]+'.'+landedRate_1;

                          if (!counts.hasOwnProperty(objItem.item_code)) {
                            counts[objItem.item_code] = 1;
                          } else {
                            counts[objItem.item_code]++;
                          }

                          if(srno == 1){



                            var alldetail = "<tr class='setdifclr"+srno+"'><td><input type='hidden' id='setdifclr"+srno+"' value="+srno+">"+srno+"<input type='hidden' name='itemCode[]' value="+objItem.item_code+"><textarea class='displaynot' name='itemdetail[]'>"+objItem.remark+"</textarea><input type='hidden' value="+objItem.vrno+"><input type='hidden' value="+objItem.slno+"><input type='hidden' value="+objItem.purchase_quotation_head_id+" name='pur_qutn_head_id[]'><input type='hidden' name='pur_qtn_body_id[]' value="+objItem.id+"></td><td id='showitemcode"+srno+"' class='itemshowtd'><div class='setnametag'>"+objItem.item_code+"-"+objItem.item_name+"</div><input type='hidden' value='"+objItem.item_code+"' id='hideitmcode"+srno+"'></td><td class='textalignRight'>"+objItem.quantity+"<input type='hidden' value='"+objItem.quantity+"' name='quantity[]'><input type='hidden' value='"+objItem.Aquantity+"' name='Aquantity[]'></td><td><div class='setnametag'>"+objItem.acc_code+"-"+objItem.accname+"</div><input type='hidden' value='"+objItem.acc_code+"' name='acc_code[]'></td><td class='textalignRight'>"+objItem.vrno+"<input type='hidden' name='qtn_no[]' value="+objItem.vrno+"></td><td class='textalignRight'>"+objItem.rate+"<input type='hidden' value='"+objItem.rate+"' name='rate[]'></td><td class='textalignRight'>"+objItem.basic_amt+"<input type='hidden' value='"+objItem.basic_amt+"' name='basic_amt[]'></td><td class='textalignRight'>"+objItem.cr_amount+"<input type='hidden' id='itemCode_"+srno+"_"+srno+"' value='"+objItem.item_code+"'><input type='hidden' id='basicval_"+srno+"' value='"+srno+"'><input type='hidden' value='"+objItem.cr_amount+"' name='cr_amt[]'></td><td class='textalignRight'>"+landedRateR+"</td><td id='setleveltd"+srno+"'><div id='getLev_"+srno+"'>L"+srno+"</div><input type='hidden' value='L"+srno+"' name='level[]'></td></tr>";

                          }else{

                            var newSr = parseInt(srno) - parseInt(1);
                            var getVal = $('#itemCode_'+newSr+'_'+newSr).val();
                            var getbasic = $('#basicval_'+srno).html();
                            var creatbaseid = getbasic - parseInt(1);

                            if(getVal == undefined){

                               var newSrno = parseInt(srno1) - parseInt(srno);

                              var alldetail = "<tr><td>"+newSrno+"<input type='hidden' name='itemCode[]' value="+objItem.item_code+"><textarea class='displaynot' name='itemdetail[]'>"+objItem.remark+"</textarea><input type='hidden' value="+objItem.vrno+"><input type='hidden' value="+objItem.slno+"><input type='hidden' value="+objItem.purchase_quotation_head_id+" name='pur_qutn_head_id[]'><input type='hidden' name='pur_qtn_body_id[]' value="+objItem.id+"></td><td>"+objItem.item_code+"<input type='hidden' value='"+objItem.item_code+"'></td><td>"+objItem.quantity+"<input type='hidden' value='"+objItem.quantity+"' name='quantity[]'><input type='hidden' value='"+objItem.Aquantity+"' name='Aquantity[]'></td><td>"+objItem.acc_code+"<input type='hidden' value='"+objItem.acc_code+"' name='acc_code[]'></td><td>"+objItem.vrno+"<input type='hidden' name='qtn_no[]' value="+objItem.vrno+"></td><td>"+objItem.rate+"<input type='hidden' value='"+objItem.rate+"' name='rate[]'></td><td>"+objItem.basic_amt+"<input type='hidden' value='"+objItem.basic_amt+"' name='basic_amt[]'></td><td>"+objItem.cr_amount+"<input type='hidden' id='itemCode_"+srno+"_"+newSrno+"' value='"+objItem.item_code+"'><input type='hidden' id='basicval_"+srno+"' value='"+srno+"'><input type='hidden' value='"+objItem.cr_amount+"' name='cr_amt[]'></td><td class='textalignRight'>"+landedRateR+"</td><td id='setleveltd"+srno+"'><div id='getLev_"+srno+"'>L"+newSrno+"</div><input type='hidden' value='L"+newSrno+"' name='level[]'></td></tr>";

                            }else{


                              if(getVal == objItem.item_code){

                                var srnob = parseInt(srno) - parseInt(1);
                                var basicamt = $('#basicval_'+srnob).val();
                                var setdifclr = $('#setdifclr'+srnob).val();

                                var newSrno1 = parseInt(srno1) - parseInt(srno);

                                var newSrno2 = newSrno1 + parseInt(1);
                                var levelamt = parseInt(basicamt) + parseInt(1);

                                var alldetail = "<tr class='setdifclr"+setdifclr+"'><td><input type='hidden' id='setdifclr"+srno+"' value="+setdifclr+">"+levelamt+"<input type='hidden' name='itemCode[]' value="+objItem.item_code+"><textarea class='displaynot' name='itemdetail[]'>"+objItem.remark+"</textarea><input type='hidden' value="+objItem.vrno+"><input type='hidden' value="+objItem.slno+"><input type='hidden' value="+objItem.purchase_quotation_head_id+" name='pur_qutn_head_id[]'><input type='hidden' name='pur_qtn_body_id[]' value="+objItem.id+"></td><td class='textalignRight'>"+objItem.quantity+"<input type='hidden' value='"+objItem.quantity+"' name='quantity[]'><input type='hidden' value='"+objItem.Aquantity+"' name='Aquantity[]'></td><td><div class='setnametag'>"+objItem.acc_code+"-"+objItem.accname+"</div><input type='hidden' value='"+objItem.acc_code+"' name='acc_code[]'></td><td class='textalignRight'>"+objItem.vrno+"<input type='hidden' name='qtn_no[]' value="+objItem.vrno+"></td><td class='textalignRight'>"+objItem.rate+"<input type='hidden' value='"+objItem.rate+"' name='rate[]'></td><td class='textalignRight'>"+objItem.basic_amt+"<input type='hidden' value='"+objItem.basic_amt+"' name='basic_amt[]'></td><td class='textalignRight'>"+objItem.cr_amount+"<input type='hidden' id='itemCode_"+srno+"_"+srno+"' value='"+objItem.item_code+"'><input type='hidden' id='basicval_"+srno+"' value='"+srno+"'><input type='hidden' value='"+objItem.cr_amount+"' name='cr_amt[]'></td><td class='textalignRight'>"+landedRateR+"</td><td id='setleveltd"+srno+"'><div id='getLev_"+srno+"'>L"+levelamt+"</div><input type='hidden' value='L"+levelamt+"' name='level[]'></td></tr>";

                              }else{

                                var newSrno = parseInt(srno1) - parseInt(srno);
                                var getNewsr = parseInt(srno) -parseInt(1) ;
                                var setdifclrB = $('#setdifclr'+getNewsr).val();
                                console.log('setdifclrB',setdifclrB);
                                var getnextB = parseInt(setdifclrB) + parseInt(1);

                                var td_uniq =  newSrno + parseInt(1);

                                 var alldetail = "<tr class='setdifclr"+getnextB+"'><td><input type='hidden' id='setdifclr"+srno+"' value="+getnextB+">"+newSrno+"<input type='hidden' name='itemCode[]' value="+objItem.item_code+"><textarea class='displaynot'  name='itemdetail[]'>"+objItem.remark+"</textarea><input type='hidden' value="+objItem.vrno+"><input type='hidden' value="+objItem.slno+"><input type='hidden' value="+objItem.purchase_quotation_head_id+" name='pur_qutn_head_id[]'><input type='hidden' name='pur_qtn_body_id[]' value="+objItem.id+"></td><td id='showitemcode"+td_uniq+"' class='itemshowtd'><div class='setnametag'>"+objItem.item_code+"-"+objItem.item_name+"</div><input type='hidden' value='"+objItem.item_code+"' id='hideitmcode"+td_uniq+"'></td><td class='textalignRight'>"+objItem.quantity+"<input type='hidden' value='"+objItem.quantity+"' name='quantity[]'><input type='hidden' value='"+objItem.Aquantity+"' name='Aquantity[]'></td><td><div class='setnametag'>"+objItem.acc_code+"-"+objItem.accname+"</div><input type='hidden' value='"+objItem.acc_code+"' name='acc_code[]'></td><td class='textalignRight'>"+objItem.vrno+"<input type='hidden' name='qtn_no[]' value="+objItem.vrno+"></td><td class='textalignRight'>"+objItem.rate+"<input type='hidden' value='"+objItem.rate+"' name='rate[]'></td><td class='textalignRight'>"+objItem.basic_amt+"<input type='hidden' value='"+objItem.basic_amt+"' name='basic_amt[]'></td><td class='textalignRight'>"+objItem.cr_amount+"<input type='hidden' id='itemCode_"+srno+"_"+srno+"' value='"+objItem.item_code+"'><input type='hidden' id='basicval_"+srno+"' value='"+newSrno+"'><input type='hidden' value='"+objItem.cr_amount+"' name='cr_amt[]'></td><td class='textalignRight'>"+landedRateR+"</td><td id='setleveltd"+srno+"'><div id='getLev_"+srno+"'>L"+newSrno+"</div><input type='hidden' value='L"+newSrno+"' name='level[]'></td></tr>";

                              }

                            }

                           

                          }
                          
                          $('#getalldata').append(alldetail);
                          var getLev = $('#getLev_'+srno).html();
                          if(getLev == 'L1'){

                          $('#setleveltd'+srno).css('background-color','#f5ce9c');
                          }

                        srno++; srno1++;});


                          for(var w=0;w<fetchaccode.length;w++){
                            var countget = counts[fetchaccode[w]];
                            var getW = w + parseInt(1);
                            //console.log('getW',getW);
                           var itemcode = $('#hideitmcode'+getW).val();
                           if(fetchaccode[w] == itemcode){
                            $('#showitemcode'+getW).attr('rowspan',countget);
                           }                         
                            if(getW % 2 != 0){
                              $('.setdifclr'+getW).addClass('oddclr');
                              //$('#showitemcode'+w).attr();
                            }else if(getW % 2 == 0){
                              $('.setdifclr'+getW).addClass('evenclr');
                            }
                            
                           // $('.setdifclr1').addClass('oddclr');
                            

                          }

                        }

                      }
                 }

            });

      }

      
    });


    $("#quotatn_no").change(function(){

         $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

         });

        var quotatn_no =  $(this).val();

          $.ajax({

            url:"{{ url('get-data-quotn-slno-by-quotn-no') }}",
            method : "POST",
            type: "JSON",
            data: {quotatn_no: quotatn_no},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                  if(data1.data == ''){

                  }else{

                     var objdata = data1.data;

                    $('#quotatn_sl_no_list').empty();

                      $.each(objdata, function (i, objdata) {

                        $('#quotatn_sl_no_list').append($('<option>', { 

                          value: objdata.slno,

                          'data-xyz': objdata.slno,

                          text : objdata.slno 

                        }));

                      });

                  }

                  
                }

            }
          });
    });


     $("#submitdata").click(function(event) {

          var data = $("#QuotatnCompare").serialize();

              $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }
              });

              $.ajax({

                  type: 'POST',

                  url: "{{ url('/save-purchase-quotation-comparism') }}",

                  data: data, // here $(this) refers to the ajax object not form

                  success: function (data) {

                    console.log(data);

                    var url = "{{url('finance/purchase-quotation-comaprision-msg')}}"
                    setTimeout(function(){ window.location = url+'/savedata'; });

                  },

              });

         

   });

  });
</script>


@endsection