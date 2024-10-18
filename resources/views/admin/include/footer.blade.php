<style>
  #footerLogin{
    position: fixed;
    padding: 10px 10px 8px 10px;
    bottom: 0;
    width: 100%;
    height: 40px;
    
  }

  .footLogo{
    height: 28px;
    width: 174px;
    position: fixed;
    margin-top: -4px;
  }

  .footText{
    font-size: 14px;
    padding-top: 6px;
  }

  @media only screen and (max-width: 600px) {

    .footLogo{
      display: none;
    }

    .footText{
      font-size: 9px;
      padding-top: 6px;
      text-align: center;
    }

  }
</style>    

    <!-- <footer class="nav-down">
            This is your footer.
    </footer> -->

    

      <footer id="footerLogin" class="main-footer">

       <div class="col-lg-12">

        <div class="row">

          <div class="col-lg-8 footText">
            <strong>Copyright &copy; <?php echo date('Y'); ?>-<?php echo date('Y',strtotime('+1 year')); ?> <a href="http://aceworth.in/" target="_blank">Biztech Consultancy Services</a>.</strong> All rights reserved.
          </div>

          <div class="col-lg-4 pull-right">

            <img src="{{ URL::asset('public/dist/img/logo_new.png') }}" class="footLogo" alt="User Image">
          
          </div>


        </div>

      </div>

      </footer>

      <!-- DEVELOPED BY ACEWORTH PVT LTD -->
      <!-- 
        SMIT AGARKAR (PROJECT LEAD)
        SANGIT KACHAHE (SR DEVELOPER)
        KAMINI KHAPRE (SR DEVELOPER)
        RAJANI BAWANE (SR DEVELOPER) -->


      </div><!-- ./wrapper -->



    <!-- jQuery 2.1.4 -->

   

    <script src="{{ URL::asset('public/plugins/jQuery/jQuery-2.1.4.min.js') }}" ></script>

    <script src="{{ URL::asset('public/dist/js/viewjs/jquery.mask.min.js') }}" ></script>

   

    <!-- Bootstrap 3.3.5 -->

    <script src="{{ URL::asset('public/bootstrap/js/bootstrap.min.js') }}"></script>

  <!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
    
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
  
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
  <script src="{{ URL::asset('public/dist/js/bootstrap-multiselect.js') }}"></script>
  

    <!-- DataTables -->

    <script src="{{ URL::asset('public/plugins/datatables/jquery.dataTables.min.js') }}">   

    </script>

    <script src="{{ URL::asset('public/plugins/datatables/dataTables.bootstrap.min.js') }}">

    </script>
    <script src="{{ URL::asset('public/dist/js/dataTables.buttons.min.js') }}">
    </script>

    <script src="{{ URL::asset('public/dist/js/dataTables.buttons.min.js') }}">
    </script>


    <script type="text/javascript" src="{{ URL::asset('public/dist/js/datatable/jszip.min.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('public/dist/js/datatable/buttons.html5.min.js') }}"></script>
     
      <!-- SlimScroll -->

    <script src="{{ URL::asset('public/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Select2 -->

    <script src="{{ URL::asset('public/plugins/select2/select2.full.min.js') }}"></script>

    <!-- FastClick -->

    <script src="{{ URL::asset('public/plugins/fastclick/fastclick.min.js') }}"></script>

    <!-- AdminLTE App -->

    <script src="{{ URL::asset('public/dist/js/app.min.js') }}"></script>

    <!-- Sparkline -->

    <script src="{{ URL::asset('public/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- jvectormap -->

    <script src="{{ URL::asset('public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>

    <script src="{{ URL::asset('public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- SlimScroll 1.3.0 -->

    <script src="{{ URL::asset('public/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>

    <!-- ChartJS 1.0.1 -->

    <script src="{{ URL::asset('public/plugins/chartjs/Chart.min.js') }}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

    <!-- <script src="{{ URL::asset('public/dist/js/pages/dashboard2.js') }}"></script> -->

    <!-- AdminLTE for demo purposes -->

    <!-- <script src="{{ URL::asset('public/dist/js/notifIt.min.js') }}"></script> -->

    <script src="{{ URL::asset('public/dist/js/notifIt.js') }}"></script>

    <script src="{{ URL::asset('public/plugins/input-mask/jquery.inputmask.js') }}"></script>

    <script src="{{ URL::asset('public/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>

    <script src="{{ URL::asset('public/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('public/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ URL::asset('public/dist/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('public/dist/js/vfs_fonts.js') }}"></script>


     <script src="{{ URL::asset('public/dist/js/moment-with-locales.js') }}"></script>

    <script src="{{ URL::asset('public/dist/js/bootstrap-datetimepicker.js') }}"></script>

   

<style>
  .nav-down {
      bottom: -40px;
  }
</style>

<style type="text/css">

.rTable { display: table; }

.rTableRow { display: table-row; }

.rTableHeading { display: table-header-group; }

.rTableBody { display: table-row-group; }

.rTableFoot { display: table-footer-group; }

.rTableCell, .rTableHead { display: table-cell; }

  .rTable {
   display: table;
   /*width: 100%;*/
}

.rTableRow {

   display: table-row;

}

.rTableHeading {

   display: table-header-group;

   background-color: #ddd;

}

.rTableCell, .rTableHead {

   display: table-cell;

   padding: 3px 10px;

   border: 1px solid #ebe7e7;

}

.rTableHeading {

   display: table-header-group;

   background-color: #ddd;

   font-weight: bold;

}

.rTableFoot {

   display: table-footer-group;

   font-weight: bold;

   background-color: #ddd;

}

.rTableBody {

   display: table-row-group;

}

.setInline{

  display: flex;

  margin-bottom: 4px;

}

.rowClass{

  margin: 0px;

  margin-top: 3%;

}

.rowClass1{

  margin: 0px;

  margin-top: 0%;

}

.rowClassonModel{

   margin: 0px;

  margin-top: 1%;

}

.LableTextField{

  text-align: center;

  font-weight: 600;

}

.distClass{

  display: none;



}

.sgstBlock{

  display: none;

}

.cgstBlock{

  display: none;

}

.afforblck{

  display: none;

}

.affiveblck{

  display: none;

}

.afsixblck{

  display: none;

}

.afsevenblck{

  display: none;

}

.afheadeightblck{

  display: none;

}

.afheadnineblck{

  display: none;

}

.afheadtenblck{

  display: none;

}

.afheadelvnblck{

  display: none;

}

.afheadtwelblck{

  display: none;

}

.getheading{

  border: none;

  width: 61px;

}
.settaxcodemodel{
  font-size: 16px;
    font-weight: 800;
    color: #5d9abd;
}
.boxer {
  display: table;
  border-collapse: collapse;
}
.boxer .box-row {
  display: table-row;
}
.boxer .box-row:first-child {
  font-weight:bold;
}
.boxer .box10 {
  display: table-cell;
  vertical-align: top;
  border: 1px solid #ddd;
  padding: 5px;
}
.boxer .hidebordritm {
  display: table-cell;
  vertical-align: top;
  border: none;
  padding: 5px;
}
.boxer .ebay {
  padding:5px 1.5em;
}
.boxer .google {
  padding:5px 1.5em;
}
.boxer .amazon {
  padding:5px 1.5em;
}
.center {
  text-align:center;
}
.right {
  float:right;
}
.texIndbox{
  width: 7%; 
  text-align: center;
}
 .texIndbox1{
  width: 5%; 
  text-align: center;
}
.texIndbox2{
  width: 45%; 
  text-align: center;
}
.rateIndbox12{
  width: 15%;
  text-align: center;
}
.itmdetlheading{
  vertical-align: middle !important;
  text-align: center;
}
.itmdetlheading1{
  vertical-align: middle !important;
  text-align: center;
  width: 40%;
}
.rateBox{
  width: 20%;
  text-align: center;
  vertical-align: middle !important;
}
.amountBox{
  width: 20%;
  text-align: center;
  vertical-align: middle !important;
}
.inputtaxInd{
  background-color: white !important;
  border: none;
  text-align: center;
  height: 25px;
}
.showind_Ch{
  display: none;
}
.txtDate
        {
            background-image: url(https://i.imgur.com/u6upaAs.png);
            background-repeat: no-repeat;
            padding-left: 25px;
        }
</style>  



<script type="text/javascript">

  $( document ).ready(function() {

      console.log( "Footer Jquery...!" );
      $(".content-header").addClass("contentHeader");

  });

</script>



<script type="text/javascript">

  $(document).ready(function(){

    $('.codeCapital').on('input',function(){
       var codeCap =  $('.codeCapital').val();
       var newCode = codeCap.toUpperCase();
       $('.codeCapital').val(newCode);
    });

    $( window ).on( "load", function() {

     // getvrnoBySeries();

     var vrseqno = $('#vrseqnum').val();

     var vrlastnum = $('#vr_last_num').val();

      if(vrseqno == ''){

        $('#setdisable').prop('disabled',true);

      }else if(vrseqno==vrlastnum){

        $('#setdisable').prop('disabled',true);

      }else{

        $('#setdisable').prop('disabled',false);

      }


      $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });
      
          $.ajax({

            url:"{{ url('Get-Track-Sale-Enq-Data') }}",

            method : "POST",

            type: "JSON",

            success:function(data){

              var data1 = JSON.parse(data);


                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                  $('#allEnqShow').modal('hide');

                }else if(data1.response == 'success'){

                    // $('#allItemShow').modal('show');

                      $('#itemListShow').empty();
                     var tableHead= "<div class='box-row'><div class='box10 texIndbox'>#</div><div class='box10 vrnoinbox'>ENQUIRY DATE</div><div class='box10 itemIndbox'>REMARK </div><div class='box10 rateIndbox12'>CLOSING DATE</div></div>";

                      $('#itemListShow').append(tableHead);

                      var count = data1.data.length;

                      if(count > 0){
                        //$('#allEnqShow').modal('show');
                      }

                    
                    $.each(data1.data, function(k, getData) {

                        var d = new Date();

                        var month = d.getMonth()+1;
                        var day = d.getDate();

                        var CurrentDt = d.getFullYear() + '/' +
                            (month<10 ? '0' : '') + month + '/' +
                            (day<10 ? '0' : '') + day;
                            
                    
                        
                         var tableBody= "<div class='box-row'><div class='box10 texIndbox'>#</div><div class='box10 vrnoinbox' style='width: 100px;'>"+getData.ENQ_DATE+"</div><div class='box10 itemIndbox'>"+getData.TRACK_REMARK+"</div><div class='box10 rateIndbox12'><input type='date' value='"+getData.CLS_DATE+"' name='cls_date[]' id='cls_date'  class='clsdatepicker  txtDate' style='text-align:right'><input type='hidden' value='"+getData.ENQ_NO+"' name='enq_no[]' id='enq_no'></div></div>";


                         $('#itemListShow').append(tableBody);


                    });

                    var tablefooter = "<button type='button' class='btn btn-primary ' style='width: 27%;' data-dismiss='modal' onclick='saveTrackEnq()'>Ok</button><button type='button' class='btn btn-danger notshowcnlbtn' data-dismiss='modal' style='width: 16%;' id='addbtnwhenselect'>Cancel</button>";

                      $('#footer_item').append(tablefooter);

                      
                }

            }

          });



    });

  });

</script>


<script type="text/javascript">
  
  function saveTrackEnq(){

     var data = $("#salesenqtrans").serialize();


      $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "{{ url('/Transaction/Sales/Update-Track-Sales-Enquiry-Trans') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                console.log(data);

              /* var url = "{{url('finance/view-enquiry-msg')}}"
               setTimeout(function(){ window.location = url+'/savedata'; });*/
              },

          });

  }
</script>

<script type="text/javascript">
    $('.clsdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true'

    });

    function newexportaction(e, dt, button, config) {
     var self = this;
     var oldStart = dt.settings()[0]._iDisplayStart;
     dt.one('preXhr', function (e, s, data) {
         // Just this once, load all data from the server...
         data.start = 0;
         data.length = -1;
         dt.one('preDraw', function (e, settings) {
             // Call the original action function
             if (button[0].className.indexOf('buttons-copy') >= 0) {
                 $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
             } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                 $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                     $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                     $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
             } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                 $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                     $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                     $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
             } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                 $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                     $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                     $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
             } else if (button[0].className.indexOf('buttons-print') >= 0) {
                 $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
             }
             dt.one('preXhr', function (e, s, data) {
                 // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                 // Set the property to what it was before exporting.
                 settings._iDisplayStart = oldStart;
                 data.start = oldStart;
             });
             // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
             setTimeout(dt.ajax.reload, 0);
             // Prevent rendering of the full data to the DOM
             return false;
         });
     });
     // Requery the server with the new one-time export settings
     dt.ajax.reload();
  }
</script>

<script>
  $(document).ready(function(){

    /*$(".content-wrapper").removeAttr("style");*/

  });
</script>

  </body>

</html>

