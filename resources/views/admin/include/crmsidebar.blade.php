
 <!-- <link rel="stylesheet" href="{{ URL::asset('public/dist/css/jquery.treeview.css') }}"> -->

 



<!-- <link rel="stylesheet" href="{{ URL::asset('public/dist/css/jquery.treeview.css') }}" /> -->


<style type="text/css">
  .treeview-menu{
    background-color: rgb(44, 59, 65) !important;
    padding-left: 22px !important;

  }
  .visible {
  height: 3em;
  width: 10em;
  background: #3c8dbc;

}

.ulview {
  margin: 0;
  padding-left: 25px;
  /*line-height: 2em;*/
  list-style: none;
  /*background-color: #fff;*/
}
.ulview li {
  position: relative;
}
.ulview li:before {
  position: absolute;
  top: 0;
  left: -15px;
  display: block;
  width: 15px;
  height: 1em;
  content: "";
  border-bottom: 1px dotted #666;
  border-left: 1px dotted #666;
}
/* hide the vertical line on the first item */
.ulview.tree > li:first-child:before {
  border-left: none;
}
.ulview li:after {
  position: absolute;
  top: 1.1em;
  bottom: 1px;
  left: -15px;
  display: block;
  content: "";
  border-left: 1px dotted #666;
}

/* hide the lines on the last item */
.ulview li:last-child:after {
  display: none;
}

/* inserted via JS  */
.js-toggle-icon {
  position: relative;
  z-index: 1;
  display: inline-block;
  width: 14px;
  margin-right: 2px;
  /*margin-left: -23px;*/
  line-height: 12px;
  text-align: center;
  cursor: pointer;
  background-color: #fff;
  border: 1px solid #666;
  border-radius: 2px;
}

.sidebar-menu .treeview-menu>li {
    margin: 0 !important;
    margin-left: 0px !important;
}



.skin-blue .sidebar-menu>li>.treeview-menu {
    margin: 0px 12px !important;
    background: #2c3b41 !important;
    width: 234px;
}

.sidebar-menu>li {
    position: relative !important;
    margin: 0px 0px 0px -12px !important;
    padding: 0 !important;
}

.sidebar-menu .treeview-menu>li>a {
    padding: 5px 0px 5px 0px !important;
    display: block !important;
    font-size: 14px !important;
}


</style>


<!-- <aside class="main-sidebar" style="width: 230px;background-color: #C7C7C7 !important;"> -->
<aside class="main-sidebar" style="width: 230px;">

        <!-- sidebar: style can be found in sidebar.less -->

        <section class="sidebar">

          <!-- Sidebar user panel -->

          <div class="user-panel">

            <div class="pull-left image">

              <img src="{{ URL::asset('public/dist/img/admin_img.jpg') }}" class="img-circle" alt="User Image">

            </div>

            <div class="pull-left info">

              <p>{{strtoupper(Session::get('username'))}}</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

            </div>

          </div>

         

          <!-- sidebar menu: : style can be found in sidebar.less -->
 

  <!--  <div class="input-group nav" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar wd" type="search" placeholder="Search" id="search" name="search" aria-label="Searc">
         
        </div> -->
          <div class="input-group sidebar-form">
              <input type="text" id="search" name="search" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="button"  class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
          </div>
         
          <ul class="sidebar-menu tree">

            
             
           <!--  <li class="header">MAIN NAVIGATION </li> -->

            <li class="treeview <?php if(Request::segment(1) === 'dashboard'){echo "active";} ?>">
              <?php 
                if(Session::get('usertype')=='admin'){
                 $compName= Session::get('company_name');
                }else{
                  $compName='';
                }

               ?>
               <?php if(Session::get('usertype')=='admin')  { ?>

              <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>
            <?php  } else { ?>

              <a href="{{ url('/crmdashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>

            <?php  } ?>

            </li>


<?php if(Session::get('usertype')=='CRM'){ ?>

      <?php $Fname = Session::get('form_name');  ?>


              <li class="treeview <?php if(Request::segment(3) === 'CRM-Enquery-Trans' || Request::segment(3) ==='View-Crm-Enquery-Trans' || Request::segment(3) ==='View-Crm-Quotation-Trans'  || Request::segment(3) ==='View-Crm-Order-Trans' || Request::segment(3) ==='View-Crm-Ledger-Trans' || Request::segment(3) ==='crm-delivery-challan-report') { echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:#615c55;"></i> CRM

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>


            <ul class="treeview-menu">

           
            
            <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('DCSE0' == $row &&  Session::get('usertype')=='CRM') { 

                ?>

                   <li class="<?php if(Request::segment(3) === 'CRM-Enquery-Trans' || Request::segment(3) ==='View-Crm-Enquery-Trans') { echo "active";} ?>">

                  <a href="pages/examples/invoice.html">

                    <i class="fa fa-plus" style="color:#615c55;"></i> 

                    Enquiry  

                      <i class="fa fa-angle-left pull-right"></i>

                  </a>



                   <ul class="treeview-menu">

                    <li class=" <?php if(Request::segment(3) === 'CRM-Enquery-Trans') { echo "active";} ?>">

                      <a href="{{ url('/Transaction/CRM/CRM-Enquery-Trans') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Enquiry <span style="display: none;">CS0</span>

                      </a>

                    </li>



                    <li class="<?php if(Request::segment(3) ==='View-Crm-Enquery-Trans') { echo "active";} ?>">

                      <a href="{{ url('/Transaction/Crm/View-Crm-Enquery-Trans') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Enquiry <span style="display: none;">CS0</span>

                      </a>

                    </li>

                  </ul>

                </li>

              <?php } else{} } }?>

           

                
            <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('DCSQ0' == $row &&  Session::get('usertype')=='CRM') { 

                ?>    
              
                <li class="<?php if(Request::segment(3) ==='View-Crm-Quotation-Trans') { echo "active";} ?>">

                  <a href="">

                    <i class="fa fa-plus" style="color:#615c55;;"></i> 

                    Quotation

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                   <ul class="treeview-menu">

                <!--     <li class=" < ?php if(Request::segment(3) === 'CRM-Quotation') { echo "active";} ?>">

                      <a href="{{ url('/Transaction/CRM/CRM-Quotation') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Quotation <span style="display: none;">CS1</span>

                      </a>

                    </li> -->



                    <li class="<?php if(Request::segment(3) ==='View-Crm-Quotation-Trans') { echo "active";} ?>">

                      <a href="{{ url('/Transaction/Crm/View-Crm-Quotation-Trans') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Quotation <span style="display: none;">CS1</span>

                      </a>

                    </li>

                  </ul>



                </li>

            <?php } else{} } }?>
            
                  

                  <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('DCSO0' == $row &&  Session::get('usertype')=='CRM') { 

                ?> 


                    <li class=" <?php if(Request::segment(3) ==='View-Crm-Order-Trans'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus" style="color:#615c55;"></i> Order
                             <i class="fa fa-angle-left pull-right"></i>
                          </a>

                           <ul class="treeview-menu">

                      
                            <li class="<?php if(Request::segment(3) ==='View-Crm-Order-Trans'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/CRM/View-Crm-Order-Trans') }}">

                                    <i class="fa fa-circle-o text-aqua"></i> 

                                  View Order <span style="display: none;">CS2</span>

                                  </a>

                            </li>

                          

                          </ul>

                      </li>

                  <?php } else{} } } ?> 

                    <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('DCSO0' == $row &&  Session::get('usertype')=='CRM') { 

                ?> 


                    <li class=" <?php if(Request::segment(3) ==='crm-delivery-challan-report'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus" style="color:#615c55;"></i> Challan
                             <i class="fa fa-angle-left pull-right"></i>
                          </a>

                           <ul class="treeview-menu">

                      

                            <li class="<?php if(Request::segment(3) ==='crm-delivery-challan-report'){echo "active";} ?>">

                                  <a href="{{ url('/report/crm/crm-delivery-challan-report') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                  View Delivery <span style="display: none;">CS2</span>

                                  </a>

                            </li>


                          </ul>

                      </li>

                  <?php } else{} } } ?>  


                   <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('DCSO0' == $row &&  Session::get('usertype')=='CRM') { 

                ?> 


                    <li class=" <?php if(Request::segment(3) ==='View-Crm-Ledger-Trans'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus" style="color:#615c55;"></i> Ledger
                             <i class="fa fa-angle-left pull-right"></i>
                          </a>

                           <ul class="treeview-menu">

                      

                           <li class="<?php if(Request::segment(3) ==='View-Crm-Ledger-Trans'){echo "active";} ?>">

                                  <a href="{{ url('/report/crm/View-Crm-Ledger-Trans') }}">

                                    <i class="fa fa-circle-o text-aqua"></i> 

                                  View Ledger <span style="display: none;">CS2</span>

                                  </a>

                            </li>

                          </ul>

                      </li>

                  <?php } else{} } } ?>    

           
<!----- END TAX / CASH MASTER------>


<!----- END TAX / CASH MASTER------>
               
                 


              </ul>
            </li>

             <?php } else{ }?>



   <?php if(Session::get('usertype')=='SRM'){ ?>

      <?php $Fname = Session::get('form_name');  ?>


              <li class="treeview <?php if(Request::segment(3) === 'CRM-Enquery-Trans' || Request::segment(3) ==='View-Srm-Enquery-Trans' || Request::segment(3) ==='View-Srm-Quotation-Trans'  || Request::segment(3) ==='View-Srm-Order-Trans' || Request::segment(3) ==='View-Crm-Ledger-Trans' || Request::segment(3) ==='srm-delivery-challan-report') { echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:#615c55;"></i> SRM

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>


            <ul class="treeview-menu">

           
            
            <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('DCSE0' == $row &&  Session::get('usertype')=='SRM') { 

                ?>

                   <li class="<?php if(Request::segment(3) === 'CRM-Enquery-Trans' || Request::segment(3) ==='View-Srm-Enquery-Trans') { echo "active";} ?>">

                  <a href="pages/examples/invoice.html">

                    <i class="fa fa-plus" style="color:#615c55;"></i> 

                    Enquiry  

                      <i class="fa fa-angle-left pull-right"></i>

                  </a>


                   <ul class="treeview-menu">

                    <li class="<?php if(Request::segment(3) ==='View-Srm-Enquery-Trans') { echo "active";} ?>">

                      <a href="{{ url('/Transaction/Srm/View-Srm-Enquery-Trans') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Enquiry <span style="display: none;">CS0</span>

                      </a>

                    </li>

                  </ul>

                </li>

              <?php } else{} } }?>

           

                
            <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('DCSQ0' == $row &&  Session::get('usertype')=='SRM') { 

                ?>    
              
                <li class="<?php if(Request::segment(3) ==='View-Srm-Quotation-Trans') { echo "active";} ?>">

                  <a href="">

                    <i class="fa fa-plus" style="color:#615c55;;"></i> 

                    Quotation

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                   <ul class="treeview-menu">

                <!--     <li class=" < ?php if(Request::segment(3) === 'CRM-Quotation') { echo "active";} ?>">

                      <a href="{{ url('/Transaction/CRM/CRM-Quotation') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Quotation <span style="display: none;">CS1</span>

                      </a>

                    </li> -->



                    <li class="<?php if(Request::segment(3) ==='View-Srm-Quotation-Trans') { echo "active";} ?>">

                      <a href="{{ url('/Transaction/Srm/View-Srm-Quotation-Trans') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Quotation <span style="display: none;">CS1</span>

                      </a>

                    </li>

                  </ul>



                </li>

            <?php } else{} } }?>
            
                  

                  <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('DCSO0' == $row &&  Session::get('usertype')=='SRM') { 

                ?> 


                    <li class=" <?php if(Request::segment(3) ==='View-Srm-Order-Trans'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus" style="color:#615c55;"></i> Order
                             <i class="fa fa-angle-left pull-right"></i>
                          </a>

                           <ul class="treeview-menu">

                      
                            <li class="<?php if(Request::segment(3) ==='View-Srm-Order-Trans'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/SRM/View-Srm-Order-Trans') }}">

                                    <i class="fa fa-circle-o text-aqua"></i> 

                                  View Order <span style="display: none;">CS2</span>

                                  </a>

                            </li>

                          

                          </ul>

                      </li>

                  <?php } else{} } } ?>    


                  <li class=" <?php if(Request::segment(3) ==='srm-delivery-challan-report'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus" style="color:#615c55;"></i> Challan
                             <i class="fa fa-angle-left pull-right"></i>
                          </a>

                           <ul class="treeview-menu">

                      
                            <li class="<?php if(Request::segment(3) ==='srm-delivery-challan-report'){echo "active";} ?>">

                                  <a href="{{ url('/report/srm/srm-delivery-challan-report') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                  View Delivery <span style="display: none;">CS2</span>

                                  </a>

                            </li>

                        
                          </ul>

                      </li>


                       <li class=" <?php if(Request::segment(3) ==='View-Crm-Ledger-Trans'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus" style="color:#615c55;"></i> Ledger
                             <i class="fa fa-angle-left pull-right"></i>
                          </a>

                           <ul class="treeview-menu">

                            <li class="<?php if(Request::segment(3) ==='View-Crm-Ledger-Trans'){echo "active";} ?>">

                                  <a href="{{ url('/report/crm/View-Crm-Ledger-Trans') }}">

                                    <i class="fa fa-circle-o text-aqua"></i> 

                                  View Ledger <span style="display: none;">CS2</span>

                                  </a>

                            </li>

                          </ul>

                      </li>
           
<!----- END TAX / CASH MASTER------>


<!----- END TAX / CASH MASTER------>
               
                 


              </ul>
            </li>

             <?php } else{ }?>
          </ul>
        <!-- </li> -->
      
        </section>

        <!-- /.sidebar -->

      </aside>

    <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script src="http://demo.expertphp.in/js/jquery.js"></script>   
    

   <script src="{{ URL::asset('public/dist/js/jquery-treeview.js') }}"></script>

    <script type="text/javascript" src="http://demo.expertphp.in/js/demo.js"></script>  -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script> -->

<script src="{{ URL::asset('public/dist/js/bootstrap-treeview.min.js') }}"></script>




    <script type="text/javascript">
      $(document).ready(function(){
          $("#search").on("keyup", function () {


if (this.value.length > 0) {   
  $("li").hide().filter(function () {
    return $(this).text().toLowerCase().indexOf($("#search").val().toLowerCase()) != -1;
  }).show(); 
 $("li").addClass('active');
 if(e.which == 13){//Enter key pressed
           //Trigger search button click event
        }
}else { 
   /*$('#search').addClass('visible');
  $('#search').val('Search Not Found...!');
  $('#search').prop('readonly',true);
   setTimeout(function(){$('#search').val(''),$('#search').removeClass('visible'),$('#search').prop('readonly',false);;},
        1500);*/
  $("li").show();
  $("li").removeClass('active');
}
});

 

      });
</script>

      <!-- <script type="text/javascript">
      
      $(function() {
      
      $('ul.tree ul').hide();
      
      $('.tree li > ul').each(function(i) {
      var $subUl = $(this);
      var $parentLi = $subUl.parent('li');
      var $toggleIcon = '<i class="js-toggle-icon">+</i>';
      
      $parentLi.addClass('has-children');
      
      $parentLi.prepend( $toggleIcon ).find('.js-toggle-icon').on('click', function() {
      $(this).text( $(this).text() == '+' ? '-' : '+' );
      $subUl.slideToggle('fast');
      });
      });
      });
      
      </script> -->
