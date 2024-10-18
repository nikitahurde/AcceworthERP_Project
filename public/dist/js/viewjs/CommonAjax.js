var link = window.location.href;
var getseperate = link.split('/');
var folderName = getseperate[0]+'//'+getseperate[2]+'/'+getseperate[3];

/* -------------- GET ADDRESS DETAILS BY CITY ---------- */

function addresDetails(){

	var val = $("#city").val();
    var xyz = $('#cityList option').filter(function() {

      return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
      $("#city").val('');
      $("#district").val('');
      $("#statecode").val('');
      $("#country").val('');
      $("#pincode").val('');
    }else{
      $("#district").val('');
      $("#statecode").val('');
      $("#country").val('');
      $("#pincode").val('');
      var city = $("#city").val();
      $("#city").val(val+'['+msg+']');
    }

	$.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  	});

	var dataAddUrl = folderName+'/get-full-address-against-city';

  	$.ajax({

            url:dataAddUrl,
            method : "POST",
            type: "JSON",
            data: {city: city},
            success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                }else if(data1.response == 'success'){

                    var details = data1.data;
                    console.log('details',details);
                    $('#district').val(details[0]['DISTRICT_CODE']+'['+details[0]['DISTRICT_NAME']+']');
                    $('#statecode').val(details[0]['STATE_CODE']+'['+details[0]['STATE_NAME']+']');
                    $('#country').val(details[0]['COUNTRY_CODE']+'['+details[0]['COUNTRY_NAME']+']');
                    $('#pincode').val(details[0]['PIN_CODE']);
                }
            }

  	});

}

/* -------------- GET ADDRESS DETAILS BY CITY ---------- */
      