/*window load*/
var objvalidtn = new jsController();
  $( window ).on( "load", function() {

    var head_id           = $('#headidquo').val();

    });

/*window load*/


/*purchase order js*/
  
$("#contractNo").bind('change', function () {

    var contraNo =  $(this).val();
    var xyz = $('#contractNoList option').filter(function() {

      return this.value == contraNo;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
       $(this).val('');
    }else{
      
    }

});

$("#transcode").bind('change', function () {
  var tcode =  $(this).val();
  var xyz = $('#transCList option').filter(function() {

    return this.value == tcode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';
  console.log('msg',msg);

  if(msg=='No Match'){
     $(this).val('');
     $('#getTransCode').val('');
     $('#getVrNo').val('');
     $('#vrseqnum').val('');
     $('#series_code').val('');
     $('#Taxcodenamesh').html('');
     $('#seriesList1').empty();
  }else{
    $('#getTransCode').val(tcode);
    $('#Taxcodenamesh').html(msg);
  }

});

$("#quotationNo").bind('change', function () {
  var quoNo =  $(this).val();
  var xyz = $('#quotationNoList option').filter(function() {

    return this.value == quoNo;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
     $(this).val('');
     $('#tax_code').val('');
  }else{
    
  }

});

/*purchase order js*/

/*purchase quotation js*/
  
  $("#enquiryNum").bind('change', function () {
    var enquiryNum =  $(this).val();
    var xyz = $('#enquirynoList option').filter(function() {

      return this.value == enquiryNum;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
       $(this).val('');
       $('#getEnquiryNo').val('');
       $('#itmCountchk').val('');
    }else{
      $('#getEnquiryNo').val(enquiryNum);
    }

  });

/*purchase quotation js*/