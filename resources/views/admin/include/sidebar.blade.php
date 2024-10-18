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
    margin: 0px 15px !important;
    background: #2c3b41 !important;
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


<aside class="main-sidebar" style="width: 230px;">

        <!-- sidebar: style can be found in sidebar.less -->

        <section class="sidebar">

          <!-- Sidebar user panel -->

          <div class="user-panel">

            <div class="pull-left image">

              <img src="data:image/jpeg;base64,<?php echo base64_encode(Session::get('userImg')); ?>" class="img-circle" alt="User Image" style="width: 154%;height: 42px;">

            </div>

            <div class="pull-left info">

              <p>{{strtoupper(Session::get('username'))}}</p>

              <?php  
                $userName = Session::get('username'); 
                if(isset($userName)){ 
              ?>

                <a href="#"><i class="fa fa-circle text-success"></i> Online </a>

              <?php }else{ ?>

                <a href="#"><i class="fa fa-circle text-danger"></i> Offline </a>

              <?php } ?>

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

            <li class="treeview <?php if(Request::segment(1) === 'dashboard' || Request::segment(2) === 'Score-Card-Defination' || Request::segment(1) === 'dashboard' || Request::segment(2) === 'Vehical-doc-updation'){echo "active";} ?>">
              <?php 
                if(Session::get('usertype')=='admin'){
                 $compName= Session::get('company_name');
                }else{
                  $compName='';
                }

               ?>
               <?php if(Session::get('usertype')=='admin')  { ?>

              <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>
              <?php  }else if(Session::get('usertype')=='employee'){ ?>

               <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>
              <?php  }else { ?>

              <a href="{{ url('/crmdashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>

            <?php  } ?>

            </li>




            <?php $Fname = Session::get('form_name');  ?>

        <?php if(Session::get('usertype')=='admin'){ ?>

          <li class="treeview <?php if(Request::segment(3) === 'View-Contra-Trans' || Request::segment(3) === 'Contra-Trans' || Request::segment(3) === 'cash-bank-transaction' || Request::segment(2) === 'view-cash-bank' || Request::segment(3) === 'Journal-Trans' || Request::segment(3) === 'View-Journal-Trans' || Request::segment(3) ==='sales-transaction' || Request::segment(3) ==='view-sales-transaction' || Request::segment(3) ==='view-sales-order-transaction' || Request::segment(3) ==='sales-order-transaction' || Request::segment(3) ==='Purchase-Order-Trans' || Request::segment(3) ==='View-Purchase-Order-Trans' || Request::segment(3) ==='purchase-transaction' || Request::segment(3) ==='view-purchase-transaction' || Request::segment(3) ==='Good-Reciept-Note-Trans' || Request::segment(3) ==='view-Good-Reciept-Note-Trans' || Request::segment(3) ==='Purchase-Contract-Trans' || Request::segment(3) ==='View-Contract-Trans' || Request::segment(3) ==='Purchase-Indent-Trans' || Request::segment(3) ==='View-Purchase-Indent-Trans' || Request::segment(3) ==='Purchase-Enquiry-Trans' || Request::segment(3) ==='View-Purchase-Enquiry-Trans' || Request::segment(2) ==='payment-advice' || Request::segment(1) ==='view-payment-advice' || Request::segment(3) ==='Purchase-Quotation-Trans' || Request::segment(3) ==='View-Purchase-Quatation-Trans' || Request::segment(3) ==='Purchase-Quo-Comparism-Trans' || Request::segment(3) ==='Store-Requistion' || Request::segment(3) ==='View-Store-Requistion' || Request::segment(3) ==='Store-Issue' || Request::segment(3) ==='View-Store-Issue' || Request::segment(3) ==='Store-Return' || Request::segment(3) ==='View-Store-Return' || Request::segment(3) ==='Gate-Entry-Purchase' || Request::segment(3)==='View-Gate-Entry-Purchase' || Request::segment(3)==='Gate-Pass' || Request::segment(3)==='View-Gate-Pass' || Request::segment(3) ==='view-BOM' || Request::segment(3) ==='BOM' || Request::segment(3) ==='view-daily-production' || Request::segment(3) ==='daily-production' || Request::segment(3) ==='view-wo-production' || Request::segment(3) ==='wo-production' || Request::segment(3) ==='View-Sales-Quotation-Trans' || Request::segment(3) ==='Sales-Quotation-Trans' || Request::segment(3) === 'multiple-purchase-transaction' || Request::segment(3) ==='Credit-Note-Trans' || Request::segment(3) === 'View-Credit-Note-Trans' ||Request::segment(3) === 'Credit-Note-Woitem-Trans' || Request::segment(3) === 'Debit-Note-Trans' || Request::segment(3) === 'View-Debit-Note-Trans' || Request::segment(3) ==='Debit-Note-Woitem-Trans' || Request::segment(3) ==='View-Credit-Note-Woitem-Trans' || Request::segment(3) ==='View-Debit-Note-Woitem-Trans' || Request::segment(3) ==='Purchase-Bill-Trans' || Request::segment(3) ==='View-Purchase-Bill-Trans' || Request::segment(3) =='leave-trans' || Request::segment(3) ==='Sales-Contract-Trans' || Request::segment(3) ==='View-Sale-Contract-Trans' || Request::segment(3)==='Sales-Order-Trans' || Request::segment(3)==='View-Sales-Order-Trans' || Request::segment(3)==='Post-Good-Issue' || Request::segment(3)==='View-Post-Good-Issue-Trans' || Request::segment(3)==='Direct-Sales-Trans' || Request::segment(4) === 'asset-transaction' || Request::segment(4) === 'view-asset-transaction'||Request::segment(3) =='add-emp-attendance-trans'|| Request::segment(3) =='view-emp-attendance-transaction'||Request::segment(3) =='leave-trans'|| Request::segment(3) =='view-leave-trans'||Request::segment(3) =='emp-pay-trans'||Request::segment(3) =='view-pay-trans'|| Request::segment(3) =='add-leaveApplication'|| Request::segment(3) =='ViewLeaveApplication'||Request::segment(3) =='add-travelRequisition'||Request::segment(3) =='view-travelRequision'||Request::segment(3) =='add-emp-payment-advice-trans'||Request::segment(3) =='view-emp-payment-advice-transaction'||Request::segment(3) =='add-job-opening-trans'||Request::segment(3) =='view-job-opening-trans' || Request::segment(3)==='Sales-Enquery-Trans' || Request::segment(3) ==='View-Sales-Enquery-Trans' || Request::segment(3) ==='Track-Sales-Enquery-Trans'|| Request::segment(3) =='add-job-application-trans'||Request::segment(3) =='view-job-application-trans' || Request::segment(3) =='add-emp-interview-trans'||Request::segment(3) =='view-emp-interview-trans' || Request::segment(3) =='View-Job-Work-Order-Trans'||Request::segment(3) =='add-score-card-trans'|| Request::segment(3) =='view-score-card-trans' || Request::segment(2) == 'fleet-transaction' || Request::segment(2) =='view-fleet-transaction' || Request::segment(3)==='Vehicle-Inward' || Request::segment(3)==='View-Vehicle-Inward' || Request::segment(3) ==='Job-Crad-Trans' || Request::segment(3) ==='View-Job-Crad-Trans' || Request::segment(3) ==='Bilty-Mast' || Request::segment(3) ==='View-Bilty-Mast' || Request::segment(1) ==='vehicle-planing-mast' || Request::segment(1) ==='view-vehicle-planing-mast' || Request::segment(3) ==='aprove-trip-market' || Request::segment(1) ==='vehicle-planing-wo-item' || Request::segment(3) =='Freight-Sale-Order' || Request::segment(3) =='View-Freight-Sale-Order' || Request::segment(3) =='Delivery-Order' || Request::segment(3) =='View-Delivery-Order' || Request::segment(3) =='Freight-Purchase-Order' || Request::segment(3) =='View-Freight-Purchase-Order' || Request::segment(1) ==='ePOD-transaction' || Request::segment(1) ==='view-ePOD-transaction'|| Request::segment(3) ==='lorry-receipt-trans' || Request::segment(3) ==='View-lorry-receipt-trans' || Request::segment(3)  === 'suppl-lorry-receipt-trans' || Request::segment(2)  === 'change_vehicle-lr'|| Request::segment(3)==='Vehicle-Gate-Inward' || Request::segment(3)==='View-Vehicle-Gate-Inward' || Request::segment(3) ==='lr-acknowledgment-trans' || Request::segment(3) ==='View-lr-acknowledgment-trans' || Request::segment(3) ==='transporter-bill-posting' || Request::segment(3) ==='add-gate-inward-transaction' || Request::segment(3) ==='View-gate-inward-transaction' || Request::segment(3) === 'add-inward-entry-transaction' || Request::segment(3) === 'View-inward-entry-transaction' || Request::segment(3) === 'add-inward-storage-transaction' || Request::segment(3) === 'view-inward-storage-transaction' || Request::segment(2) === 'cancel-delivery-order-quantity' || Request::segment(2) === 'Change-Do-Destination' || Request::segment(3) === 'Outward-trans' || Request::segment(3) === 'View-Outward-trans' || Request::segment(3) === 'add-bill-trans' || Request::segment(3) === 'view-bill-trans' || Request::segment(3) === 'add-bilty-transfer-tran' || Request::segment(3) === 'view-bilty-transfer-tran' || Request::segment(3) =='create-delivery-order' || Request::segment(3) =='view-create-delivery-order' || Request::segment(3) =='create-loading-slip' || Request::segment(3) == 'create-loading-slip-without-plan' || Request::segment(3) =='create-loading-and-plan' || Request::segment(3) =='view-loading-slip' || Request::segment(3) =='add-outward-trans' || Request::segment(3) =='add-gate-inward-transaction-cf' || Request::segment(3) =='View-gate-inward-transaction-cf' || Request::segment(3) =='add-gate-outward-transaction-cf' || Request::segment(3) =='view-gate-outward-transaction-cf' || Request::segment(3) =='view-gate-outward-transaction-cf' || Request::segment(3) =='Rack-Trans' || Request::segment(3) =='form-inward-trans' || Request::segment(3) =='add-outward-trans' || Request::segment(3) =='add-outward-trans' || Request::segment(3) =='Rack-Trans' || Request::segment(3) =='View-Rack-Trans' || Request::segment(3) =='view-inward-trans' || Request::segment(3) =='view-outward-trans' || Request::segment(2) =='adhoc-advance-vehicle' || Request::segment(1) ==='create-expense-jv-self' || Request::segment(3) == 'Freight-Sale-Quatation' || Request::segment(3) =='view-freight-sale-Quatation' || Request::segment(1) == 'approve-trip-payment-advice' || Request::segment(3) === 'view-gate-outward-transaction-cf' || Request::segment(3) === 'add-order-plan-transaction' || Request::segment(3) === 'view-order-plan-transaction' || Request::segment(3) === 'Vehicle-Gate-Outward' || Request::segment(3) === 'View-Vehicle-Gate-Outward' || Request::segment(2) === 'sale-bill-provisional' || Request::segment(2) === 'sale-bill-final' || Request::segment(2) === 'e-proc-status' || Request::segment(2) === 'view-sale-bill-provisional' || Request::segment(3) =='add-billing-schedule' || Request::segment(3) =='view-billing-schedule' || Request::segment(3) === 'rent-bill-posting' || Request::segment(3) =='job-work-sale-bill' || Request::segment(3) =='job-work-purchase-bill' || Request::segment(3) ==='Add-loan-hundi-Tran' || Request::segment(3) ==='view-loan-hundi-Tran' || Request::segment(3) === 'create-interest-schedule' || Request::segment(3) =='view-job-work-sale-bill' || Request::segment(3) =='view-job-work-purchase-bill' || Request::segment(2) === 'View-Pdc-Chq-Transaction' || Request::segment(3) === 'Pdc-Chq-Transaction' || Request::segment(3) === 'add-bank-reconciliation' || Request::segment(3) === 'view-bank-reconciliation' || Request::segment(3) == 'inward-import-rake-tran' || Request::segment(3) ==='upload-bulk-lr' || Request::segment(3) ==='upload-ewb-data' || Request::segment(3) ==='Purchase-Quo-Comparision-View' || Request::segment(3) =='transporter-sale-bill' || Request::segment(3) === 'view-transporter-sale-bill' || Request::segment(2) === 'view-sale-bill-final' || Request::segment(3) =='c-and-f-bill-tran' || Request::segment(3) =='view-c-and-f-bill-tran' || Request::segment(3) ==='view-transporter-bill-posting'){echo "active";} ?>">

            <a href="#">
              <i class="sign fa fa-plus" aria-hidden="true"></i> <span style="width: 228px;">Transaction</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu ulview" style="width: 227px;padding-left: 15px;">
              

              <li class="treeview <?php if(Request::segment(3) === 'View-Contra-Trans' || Request::segment(3) === 'Contra-Trans' || Request::segment(3) === 'cash-bank-transaction' || Request::segment(2) === 'view-cash-bank' || Request::segment(3) === 'Journal-Trans' || Request::segment(3) === 'View-Journal-Trans' || Request::segment(2) ==='payment-advice' || Request::segment(1) ==='view-payment-advice' || Request::segment(2) === 'View-Pdc-Chq-Transaction' || Request::segment(3) === 'Pdc-Chq-Transaction' || Request::segment(3) === 'add-bank-reconciliation' || Request::segment(3) === 'view-bank-reconciliation'){echo "active";} ?>">
               
               
                  <a href="#">
                    <i class="fa fa-plus sign1" style="color:antiquewhite;"></i> Account 
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

               
                  <ul class="treeview-menu">

                   <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TAC0' == $row &&  Session::get('usertype')=='superAdmin' || 'TAC0' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class="<?php if(Request::segment(2) === 'view-cash-bank' || Request::segment(3) === 'cash-bank-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Cash/Bank Trans  
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <!-- <li class="<?php if(Request::segment(3) === 'cash-bank-transaction'){echo "active";} ?>">

                        <a href="{{ url('/finance/transaction/cash-bank-transaction') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Cash/Bank <span style="display: none;">TA0</span>

                        </a>

                      </li> -->

                      <li class="<?php if(Request::segment(3) === 'cash-bank-transaction'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Account/Cash-Bank-Transaction') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Cash/Bank <span style="display: none;">TA0</span>

                        </a>

                      </li>

                      <li class=" <?php if(Request::segment(2) === 'view-cash-bank'){echo "active";} ?>">

                            <a href="{{ url('/finance/view-cash-bank') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Cash/Bank <span style="display: none;">TA0</span>

                            </a>

                      </li>

                    </ul>

                </li>

            <?php } else{} } }?>

              <?php if(Session::get('usertype')=='admin'){ ?>

                <li class=" <?php if(Request::segment(2) === 'view-cash-bank' || Request::segment(3) === 'cash-bank-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Cash/Bank Trans 
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                     <!--  <li class="<?php if(Request::segment(3) === 'cash-bank-transaction'){echo "active";} ?>">

                        <a href="{{ url('/finance/transaction/cash-bank-transaction') }}" class="colapsMenu">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Cash/Bank <span style="display: none;">TA0</span>
 
                        </a>

                      </li> -->

                      <li class="<?php if(Request::segment(3) === 'cash-bank-transaction'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Account/Cash-Bank-Transaction') }}" class="colapsMenu">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Cash/Bank <span style="display: none;">TA0</span>
 
                        </a>

                      </li>

                      <li class=" <?php if(Request::segment(2) === 'view-cash-bank'){echo "active";} ?>">

                            <a href="{{ url('/finance/view-cash-bank') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Cash/Bank <span style="display: none;">TA0</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>


              <?php if(Session::get('usertype')=='admin'){ ?>

                <li class=" <?php if(Request::segment(2) === 'View-Pdc-Chq-Transaction' || Request::segment(3) === 'Pdc-Chq-Transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> PDC Chq Trans 
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                   
                      <li class="<?php if(Request::segment(3) === 'Pdc-Chq-Transaction'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Account/Pdc-Chq-Transaction') }}" class="colapsMenu">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Pdc cheque <span style="display: none;">TA0</span>
 
                        </a>

                      </li>

                      <li class=" <?php if(Request::segment(2) === 'View-Pdc-Chq-Transaction'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Account/View-Pdc-Chq-Transaction') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Pdc cheque <span style="display: none;">TA0</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>

              

              <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TAC1' == $row &&  Session::get('usertype')=='superAdmin' || 'TAC1' == $row && Session::get('usertype')=='user') { 

              ?>

                <li class=" <?php if(Request::segment(3) === 'View-Contra-Trans' || Request::segment(3) === 'Contra-Trans'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus plus-minus-toggle collapsed text-aqua"></i> Contra Transaction  
                             <i class="fa fa-angle-left pull-right"></i>
                          </a>

                           <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Contra-Trans'){echo "active";} ?>">

                              <a href="{{ url('/Transaction/Account/Contra-Trans') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Contra <span style="display: none;">TA1</span>

                              </a>

                            </li>

                            <li class="<?php if(Request::segment(3) === 'View-Contra-Trans'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/Account/View-Contra-Trans') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                  View Contra <span style="display: none;">TA1</span>

                                  </a>

                            </li>

                          </ul>

                </li>

            <?php } else{} } }?>

              <?php if(Session::get('usertype')=='admin'){ ?>

                <li class="<?php if(Request::segment(3) === 'View-Contra-Trans' || Request::segment(3) === 'Contra-Trans'){echo "active";} ?>">
                 
                          <a href="#"><i class="fa fa-plus plus-icon collapsed text-aqua"></i> Contra Transaction 
                             <i class="fa fa-angle-left pull-right"></i>
                          </a>

                           <ul class="treeview-menu">

                            <li class="<?php if(Request::segment(3) === 'Contra-Trans'){echo "active";} ?>">

                              <a href="{{ url('/Transaction/Account/Contra-Trans') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Contra  <span style="display: none;">TA1</span>

                              </a>

                            </li>

                            <li class="<?php if(Request::segment(3) === 'View-Contra-Trans'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/Account/View-Contra-Trans') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                  View Contra <span style="display: none;">TA1</span>

                                  </a>

                            </li>

                          </ul>

                </li>

              <?php } else{} ?>

             


             <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TAJ0' == $row &&  Session::get('usertype')=='superAdmin' || 'TAJ0' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class=" <?php if(Request::segment(3) === 'Journal-Trans' || Request::segment(3) === 'View-Journal-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Journal Transaction  
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) === 'Journal-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Account/Journal-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Journal <span style="display: none;">TA2</span>
                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'View-Journal-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Account/View-Journal-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Journal <span style="display: none;">TA2</span>

                            </a>

                      </li>

                    </ul>

                </li>

            <?php } else{} } }?>

            <?php if(Session::get('usertype')=='admin'){ ?>

                <li class="<?php if(Request::segment(3) === 'Journal-Trans' || Request::segment(3) === 'View-Journal-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Journal Transaction  
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) === 'Journal-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Account/Journal-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Journal <span style="display: none;">TA2</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'View-Journal-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Account/View-Journal-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Journal <span style="display: none;">TA2</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else{}  ?>

              <li class=" <?php if(Request::segment(2) ==='payment-advice' || Request::segment(1) ==='view-payment-advice'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Payment Advice 
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(2) ==='payment-advice'){echo "active";} ?>">

                        <a href="{{ url('/finance/payment-advice') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Payment Advice  <span style="display: none;">TA0</span>
 
                        </a>

                      </li>

                      <li class=" <?php if(Request::segment(1) ==='view-payment-advice'){echo "active";} ?>">

                        <a href="{{ url('view-payment-advice') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          View Payment Advice  <span style="display: none;">TA0</span>
 
                        </a>

                      </li>

                    </ul>

                </li>

                <li class=" <?php if(Request::segment(2) ==='payment-advice' || Request::segment(1) ==='view-payment-advice'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Posting Payment Advice 
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(2) ==='payment-advice'){echo "active";} ?>">

                        <a href="{{ url('/transaction/account/add-posting-payment-advice') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Posting Payment Advice  <span style="display: none;">TA0</span>
 
                        </a>

                      </li>

                    </ul>

                </li>
                <?php if(Session::get('usertype')=='admin'){ ?>

                <li class=" <?php if(Request::segment(2) === 'View-Pdc-Chq-Transaction' || Request::segment(3) === 'Pdc-Chq-Transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> PDC Chq Trans 
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                   
                      <li class="<?php if(Request::segment(3) === 'Pdc-Chq-Transaction'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Account/Pdc-Chq-Transaction') }}" class="colapsMenu">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Pdc cheque <span style="display: none;">TA0</span>
 
                        </a>

                      </li>

                      <li class=" <?php if(Request::segment(2) === 'View-Pdc-Chq-Transaction'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Account/View-Pdc-Chq-Transaction') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Pdc cheque <span style="display: none;">TA0</span>

                            </a>

                      </li>

                    </ul>

                </li>


                <li class=" <?php if(Request::segment(3) === 'Bank-Guarantee-Tran' || Request::segment(3) === 'View-Bank-Guarantee-Tran'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i>Bank Guarantee Tran
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                          <ul class="treeview-menu">

                                <li class="<?php if(Request::segment(3)==='Bank-Guarantee-Tran'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/Account/Bank-Guarantee-Tran') }}">

                                    <i class="fa fa-circle-o text-yellow"></i>

                                    Add Bank Guarantee <span style="display: none;">TP4</span>

                                  </a>

                                </li>

                                <li class="<?php if(Request::segment(3)==='View-Bank-Guarantee-Tran'){echo "active";} ?>">

                                      <a href="{{ url('/Transaction/Account/View-Bank-Guarantee-Tran') }}">

                                        <i class="fa fa-circle-o text-red"></i> 

                                      View Bank Guarantee <span style="display: none;">TP4</span>

                                      </a>

                                </li>

                          </ul>

                      </li>


                      <li class=" <?php if(Request::segment(3) === 'Renew-Bank-Guarantee-Tran' || Request::segment(3) === 'View-Renew-Bank-Guarantee-Tran'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i>Renew Bank Guarantee Tran
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                          <ul class="treeview-menu">

                                <li class="<?php if(Request::segment(3)==='Renew-Bank-Guarantee-Tran'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/Account/Renew-Bank-Guarantee-Tran') }}">

                                    <i class="fa fa-circle-o text-yellow"></i>

                                    Add Renew Bank Guarantee <span style="display: none;">TP4</span>

                                  </a>

                                </li>

                                <li class="<?php if(Request::segment(3)==='View-Renew-Bank-Guarantee-Tran'){echo "active";} ?>">

                                      <a href="{{ url('/Transaction/Account/View-Renew-Bank-Guarantee-Tran') }}">

                                        <i class="fa fa-circle-o text-red"></i> 

                                      View Renew Bank Guarantee <span style="display: none;">TP4</span>

                                      </a>

                                </li>

                          </ul>

                      </li>

              <?php } else {} ?>

                <?php if(Session::get('usertype')=='admin'){ ?>

                       <li class=" <?php if(Request::segment(3) === 'add-bank-reconciliation' || Request::segment(3) === 'view-bank-reconciliation'){echo "active";} ?>">

                             <a href="#"><i class="fa fa-plus text-aqua"></i> Bank Reconciliation
                                    <i class="fa fa-angle-left pull-right"></i>
                             </a>

                            <ul class="treeview-menu">

                          
                             <li class="<?php if(Request::segment(3) === 'add-bank-reconciliation'){echo "active";} ?>">

                               <a href="{{ url('/transaction/account/add-bank-reconciliation') }}" class="colapsMenu">

                                 <i class="fa fa-circle-o text-yellow"></i>

                                 Add Bank Reco. <span style="display: none;">TA0</span>
        
                               </a>

                             </li>

                             <li class=" <?php if(Request::segment(2) === 'view-bank-reconciliation'){echo "active";} ?>">

                                   <a href="{{ url('/transaction/account/view-bank-reconciliation') }}">

                                     <i class="fa fa-circle-o text-red"></i> 

                                   View Bank Reco. <span style="display: none;">TA0</span>

                                   </a>

                             </li>

                           </ul>

                       </li>

                     <?php } else {} ?>

                      <li class="">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Indirect/Direct Tax
                               <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class="<?php {echo "active";} ?>">

                            <a href="{{ url('/transaction/account/InDirect-Direct-Tax/Tds-payment-allowcation') }}" class="colapsMenu">

                              <i class="fa fa-circle-o text-yellow"></i>

                             Tds Payment Allocation <span style="display: none;">TAA0</span>
     
                            </a>

                          </li>
                      
                        </ul>

                      </li>

                     <li class="<?php if(Request::segment(3) =='sister-concern-entry-repair'){echo "active";}?>">
                            <a href="{{ url('/transaction/account/sister-concern-entry-repair') }}">

                             <i class="fa fa-circle-o text-danger"></i>
                           
                             Sister Concern Entry
                            </a>
                            
                        </li>
            </ul>
</li>

{{-- START : Asset Manue --}}


          <li class="treeview <?php if(Request::segment(4) === 'asset-transaction' || Request::segment(4) === 'view-asset-transaction'){echo "active";} ?>">
               
               
                  <a href="#">
                    <i class="fa fa-plus sign1" style="color:antiquewhite;"></i> Asset 
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

               
                  <ul class="treeview-menu">

                   <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TAA0' == $row &&  Session::get('usertype')=='superAdmin' || 'TAA0' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class="<?php if(Request::segment(4) === 'asset-transaction' || Request::segment(4) === 'view-asset-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Asset Transaction  
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(4) === 'asset-transaction'){echo "active";} ?>">

                        <a href="{{ url('/finance/transaction/asset/asset-transaction') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Asset Tran. <span style="display: none;">TAA0</span>

                        </a>

                      </li>

                      <li class=" <?php if(Request::segment(4) === 'view-asset-transaction'){echo "active";} ?>">

                            <a href="{{ url('/finance/transaction/asset/view-asset-transaction') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Asset Tran. <span style="display: none;">TAA0</span>

                            </a>

                      </li>

                    </ul>

                </li>

            <?php } else{} } }?>

              <?php if(Session::get('usertype')=='admin'){ ?>

                <li class=" <?php if(Request::segment(4) === 'asset-transaction' || Request::segment(4) === 'view-asset-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Asset Transaction
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(4) === 'asset-transaction'){echo "active";} ?>">

                        <a href="{{ url('/finance/transaction/asset/asset-transaction') }}" class="colapsMenu">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Asset Tran. <span style="display: none;">TAA0</span>
 
                        </a>

                      </li>

                      <li class=" <?php if(Request::segment(4) === 'view-asset-transaction'){echo "active";} ?>">

                            <a href="{{ url('/finance/transaction/asset/view-asset-transaction') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Asset Tran. <span style="display: none;">TAA0</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>

            </ul>
        </li>


{{-- END : Asset Manue --}}

          <li class=" <?php if(Request::segment(3) ==='View-Sales-Quotation-Trans' || Request::segment(3) ==='Sales-Quotation-Trans' || Request::segment(3) ==='sales-transaction' || Request::segment(3) ==='view-sales-transaction' || Request::segment(3)==='Sales-Order-Trans' || Request::segment(3)==='View-Sales-Order-Trans' || Request::segment(3) ==='sales-quotation-transaction' || Request::segment(3) ==='Sales-Contract-Trans' || Request::segment(3) ==='View-Sale-Contract-Trans' || Request::segment(3)==='Post-Good-Issue' || Request::segment(3)==='View-Post-Good-Issue-Trans' || Request::segment(4) ==='sales-pgi-challan-report' || Request::segment(3)==='Direct-Sales-Trans' || Request::segment(3)==='Sales-Enquery-Trans' || Request::segment(3) ==='View-Sales-Enquery-Trans' || Request::segment(3) ==='Track-Sales-Enquery-Trans'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Sales

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
            <ul class="treeview-menu">
               <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TSS0' == $row &&  Session::get('usertype')=='superAdmin' || 'TSS0' == $row && Session::get('usertype')=='user' || 'TSS0' == $row && Session::get('usertype')=='CRM') { 

                ?>

               <li class="<?php if(Request::segment(3)==='Sales-Enquery-Trans' || Request::segment(3) ==='View-Sales-Enquery-Trans' || Request::segment(3) ==='Track-Sales-Enquery-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Sales Enquiry
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) ==='Sales-Enquery-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Sales/Sales-Enquery-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Sales Enquiry <span style="display: none;">TS1</span>

                        </a>

                      </li>

                       <li class=" <?php if(Request::segment(3) ==='Track-Sales-Enquery-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Sales/Track-Sales-Enquery-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                         Track Sale Enquiry <span style="display: none;">TS1</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3)==='View-Sales-Enquery-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Sales/View-Sales-Enquery-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Sales Enquiry <span style="display: none;">TS1</span>

                            </a>

                      </li>

                    </ul>

                </li>



            <?php } else{} } }?>

            <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class="<?php if(Request::segment(3) ==='Sales-Enquery-Trans' || Request::segment(3)=== 'View-Sales-Enquery-Trans' || Request::segment(3) ==='Track-Sales-Enquery-Trans'){echo "active";} ?>">
                 

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Sales Enquiry
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) ==='Sales-Enquery-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Sales/Sales-Enquery-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Sales Enquiry <span style="display: none;">TS1</span>

                        </a>

                      </li>

                       <li class=" <?php if(Request::segment(3) ==='Track-Sales-Enquery-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Sales/Track-Sales-Enquery-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                         Track Sale Enquiry <span style="display: none;">TS1</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3)=== 'View-Sales-Enquery-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Sales/View-Sales-Enquery-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Sales Enquiry <span style="display: none;">TS1</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>

              <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TSS1' == $row &&  Session::get('usertype')=='superAdmin' || 'TSS1' == $row && Session::get('usertype')=='user' || 'TSS1' == $row && Session::get('usertype')=='CRM') { 

                ?>

               <li class="<?php if(Request::segment(3)==='view-sales-order-Quotation' || Request::segment(3) ==='sales-quotation-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Sales Quotation
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) ==='sales-quotation-transaction'){echo "active";} ?>">

                        <a href="{{ url('Transaction/Sales/Sales-Quotation-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Sales Quotation <span style="display: none;">TS1</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3)==='view-sales-order-Quotation'){echo "active";} ?>">

                            <a href="{{ url('Transaction/Sales/View-Sales-Quotation-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Sales Quotation <span style="display: none;">TS1</span>

                            </a>

                      </li>

                    </ul>

                </li>



            <?php } else{} } }?>

            <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class="<?php if(Request::segment(3) ==='Sales-Quotation-Trans' || Request::segment(3)=== 'View-Sales-Quotation-Trans'){echo "active";} ?>">
                 

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Sales Quotation
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) ==='Sales-Quotation-Trans'){echo "active";} ?>">

                        <a href="{{ url('Transaction/Sales/Sales-Quotation-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Sales Quotation <span style="display: none;">TS1</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3)=== 'View-Sales-Quotation-Trans'){echo "active";} ?>">

                            <a href="{{ url('Transaction/Sales/View-Sales-Quotation-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Sales Quotation <span style="display: none;">TS1</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>

               <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TSS2' == $row &&  Session::get('usertype')=='superAdmin' || 'TSS2' == $row && Session::get('usertype')=='user') { 

                ?>

               <li class="<?php if(Request::segment(3) ==='Sales-Contract-Trans' || Request::segment(3) ==='View-Sale-Contract-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Sales Contract
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) ==='Sales-Contract-Trans'){echo "active";} ?>">

                        <a href="{{ url('Transaction/Sales/Sales-Contract-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Sales Contract <span style="display: none;">TS2</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Sale-Contract-Trans'){echo "active";} ?>">

                            <a href="{{url('/Transaction/Sales/View-Sale-Contract-Trans')}}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Sales Contract <span style="display: none;">TS2</span>

                            </a>

                      </li>

                    </ul>

                </li>

            <?php } else{} } }?>

            <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class="<?php if(Request::segment(3) ==='Sales-Contract-Trans' || Request::segment(3) ==='View-Sale-Contract-Trans'){echo "active";} ?>">
                 

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Sales Contract
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) ==='Sales-Contract-Trans'){echo "active";} ?>">

                        <a href="{{ url('Transaction/Sales/Sales-Contract-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Sales Contract <span style="display: none;">TS2</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Sale-Contract-Trans'){echo "active";} ?>">

                            <a href="{{url('/Transaction/Sales/View-Sale-Contract-Trans')}}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Sales Contract <span style="display: none;">TS2</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>
           
            <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TSS3' == $row &&  Session::get('usertype')=='superAdmin' || 'TSS3' == $row && Session::get('usertype')=='user' || 'TSS3' == $row && Session::get('usertype')=='CRM') { 

                ?>

               <li class="<?php if(Request::segment(3)==='View-Sales-Order-Trans' || Request::segment(3)==='Sales-Order-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Sales Order
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3)==='Sales-Order-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Sales/Sales-Order-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Sales Order <span style="display: none;">TS3</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3)==='View-Sales-Order-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Sales/View-Sales-Order-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Sales Order <span style="display: none;">TS3</span>

                            </a>

                      </li>

                    </ul>

                </li>

            <?php } else{} } }?>

            <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class="<?php if(Request::segment(3)==='Sales-Order-Trans' || Request::segment(3)==='View-Sales-Order-Trans'){echo "active";} ?>">
                 

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Sales Order 
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3)==='Sales-Order-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Sales/Sales-Order-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Sales Order <span style="display: none;">TS3</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3)==='View-Sales-Order-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Sales/View-Sales-Order-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Sales Order <span style="display: none;">TS3</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>


              <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TSS3' == $row &&  Session::get('usertype')=='superAdmin' || 'TSS3' == $row && Session::get('usertype')=='user') { 

                ?>

               <li class="<?php if(Request::segment(3)==='Post-Good-Issue' || Request::segment(3)==='View-Post-Good-Issue-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Post Goods Issue /Challan
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3)==='Post-Good-Issue'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Sales/Post-Good-Issue') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Post Goods Issue <span style="display: none;">TS3</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3)==='View-Post-Good-Issue-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Sales/View-Post-Good-Issue-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Post Goods Issue <span style="display: none;">TS3</span>

                            </a>

                      </li>

                    </ul>

                </li>

            <?php } else{} } }?>

            <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class="<?php if(Request::segment(3)==='Post-Good-Issue' || Request::segment(3)==='View-Post-Good-Issue-Trans'){echo "active";} ?>">
                 

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Post Goods Issue /Challan
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3)==='Post-Good-Issue'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Sales/Post-Good-Issue') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Post Goods Issue <span style="display: none;">TS3</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3)==='View-Post-Good-Issue-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Sales/View-Post-Good-Issue-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Post Goods Issue <span style="display: none;">TS3</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>

             
              <?php if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TSS4' == $row &&  Session::get('usertype')=='superAdmin' || 'TSS4' == $row && Session::get('usertype')=='user') { 

                ?>

               <li class=" <?php if(Request::segment(3) === 'sales-transaction' || Request::segment(3) === 'view-sales-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Sales Bill
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) === 'sales-transaction'){echo "active";} ?>">

                        <a href="{{ url('/transaction/sales/sales-transaction') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Sales Bill <span style="display: none;">TS4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'view-sales-transaction'){echo "active";} ?>">

                            <a href="{{ url('/transaction/sales/view-sales-transaction') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Sales Bill <span style="display: none;">TS4</span>

                            </a>

                      </li>

                    </ul>

                </li>

            <?php } else{} } }?>


            <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class="<?php if(Request::segment(3) === 'sales-transaction' || Request::segment(3) === 'view-sales-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Sales Bill
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) === 'sales-transaction'){echo "active";} ?>">

                        <a href="{{ url('/transaction/sales/sales-transaction') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Sales Bill <span style="display: none;">TS4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'view-sales-transaction'){echo "active";} ?>">

                            <a href="{{ url('/transaction/sales/view-sales-transaction') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Sales Bill <span style="display: none;">TS4</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>

             
              <?php if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TSS5' == $row &&  Session::get('usertype')=='superAdmin' || 'TSS5' == $row && Session::get('usertype')=='user') { 

                ?>

               <li class=" <?php if(Request::segment(3)==='Direct-Sales-Trans' || Request::segment(3) === 'view-direct-sales-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i>Direct Sales Trans
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3)==='Direct-Sales-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Sales/Direct-Sales-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Direct Sales Trans <span style="display: none;">TS5</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'view-direct-sales-transaction'){echo "active";} ?>">

                            <a href="{{ url('/transaction/sales/view-direct-sales-transaction') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Direct Sales Trans <span style="display: none;">TS5</span>

                            </a>

                      </li>

                    </ul>

                </li>

            <?php } else{} } }?>


            <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class="<?php if(Request::segment(3)==='Direct-Sales-Trans' || Request::segment(3) === 'view-direct-sales-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i>Direct Sales Trans
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3)==='Direct-Sales-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Sales/Direct-Sales-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Direct Sales Trans <span style="display: none;">TS5</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'view-direct-sales-transaction'){echo "active";} ?>">

                            <a href="{{ url('/transaction/sales/view-sales-transaction') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Direct Sales Trans <span style="display: none;">TS5</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>

              <li class="">

                    <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 
 
                   Delivery Advice <span style="display: none;">TS5</span>

                    </a>

                </li>

                <li class="">

                    <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                   Debit Note <span style="display: none;">TS6</span>

                    </a>

                </li>

                

           </ul>

        </li>

        <li class="<?php if(Request::segment(3) ==='Purchase-Order-Trans' || Request::segment(3) ==='View-Purchase-Order-Trans' || Request::segment(3) ==='Purchase-Bill-Trans' || Request::segment(3) ==='View-Purchase-Bill-Trans'  || Request::segment(3) ==='Good-Reciept-Note-Trans' || Request::segment(3) ==='view-Good-Reciept-Note-Trans' || Request::segment(3) ==='Purchase-Contract-Trans' || Request::segment(3) ==='View-Contract-Trans' || Request::segment(3) ==='Purchase-Indent-Trans' || Request::segment(3) ==='View-Purchase-Indent-Trans' || Request::segment(3) ==='Purchase-Enquiry-Trans' || Request::segment(3) ==='View-Purchase-Enquiry-Trans' || Request::segment(3) ==='Purchase-Quotation-Trans' || Request::segment(3) ==='View-Purchase-Quatation-Trans' || Request::segment(3) ==='Purchase-Quo-Comparism-Trans' || Request::segment(3) === 'multiple-purchase-transaction' || Request::segment(3) ==='Credit-Note-Trans' || Request::segment(3) === 'view-Credit-Note-Trans' || Request::segment(3) === 'Credit-Note-Woitem-Trans' || Request::segment(3) === 'Debit-Note-Trans' || Request::segment(3) === 'View-Debit-Note-Trans' || Request::segment(3) === 'Debit-Note-Woitem-Trans' || Request::segment(3) ==='View-Credit-Note-Woitem-Trans' || Request::segment(3) ==='View-Debit-Note-Woitem-Trans' || Request::segment(3) ==='purchase-transaction_bill' || Request::segment(4) ==='sales-pgi-challan-report' || Request::segment(3) ==='View-Job-Work-Order-Trans' || Request::segment(3) =='Credit-Note-Trans' || Request::segment(3) ==='Purchase-Quo-Comparision-View'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Purchase

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
            <ul class="treeview-menu">

           <?php if(isset($Fname)){

                $Fname = Session::get('form_name');

             
                
                foreach ($Fname as $row) { 

                  if('TPI6' == $row &&  Session::get('usertype')=='superAdmin' || 'TPI6' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class="<?php if(Request::segment(3) ==='Purchase-Indent-Trans' || Request::segment(3) ==='View-Purchase-Indent-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Purchase  Indent
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) ==='Purchase-Indent-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Purchase-Indent-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Purchase Indent <span style="display: none;">TP1</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Purchase-Indent-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Purchase-Indent-Trans')}}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Purchase Indent <span style="display: none;">TP1</span>

                            </a>

                      </li>

                    </ul>

                </li>

            <?php } else{} } }?>
               <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class="<?php if(Request::segment(3) ==='Purchase-Indent-Trans' || Request::segment(3) ==='View-Purchase-Indent-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Purchase  Indent
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) ==='Purchase-Indent-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Purchase-Indent-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Purchase Indent <span style="display: none;">TP1</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Purchase-Indent-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Purchase-Indent-Trans')}}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Purchase Indent <span style="display: none;">TP1</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>

            <?php if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TPP0' == $row &&  Session::get('usertype')=='superAdmin' || 'TPP0' == $row && Session::get('usertype')=='user') { 

                ?>

                      <li class="<?php if(Request::segment(3) ==='Purchase-Enquiry-Trans'){echo "active";} ?>">
               <li class=" <?php if(Request::segment(3) ==='Purchase-Enquiry-Trans' || Request::segment(3) ==='View-Purchase-Enquiry-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Purchase Enquiry 
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Purchase-Enquiry-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Purchase-Enquiry-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Purchase Enquiry <span style="display: none;">TP0</span>

                        </a>

                      </li>

                      <li class=" <?php if(Request::segment(3) ==='View-Purchase-Enquiry-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Purchase-Enquiry-Trans')}}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Purchase Enquiry <span style="display: none;">TP0</span>

                            </a>

                      </li>

                    </ul>

                </li>

            <?php } else{} } }?>


            <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class="<?php if(Request::segment(3) ==='Purchase-Enquiry-Trans' || Request::segment(3) ==='View-Purchase-Enquiry-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Purchase  Enquiry 
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) ==='Purchase-Enquiry-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Purchase-Enquiry-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Purchase Enquiry <span style="display: none;">TP0</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Purchase-Enquiry-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Purchase-Enquiry-Trans')}}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Purchase Enquiry <span style="display: none;">TP0</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>

              <?php if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TPP1' == $row &&  Session::get('usertype')=='superAdmin' || 'TPP1' == $row && Session::get('usertype')=='user') { 

                ?>

               <li class=" <?php if(Request::segment(3) ==='Purchase-Quotation-Trans' || Request::segment(3) ==='View-Purchase-Quatation-Trans' || Request::segment(3) ==='Purchase-Quo-Comparism-Trans' || Request::segment(3) ==='Purchase-Quo-Comparision-View'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Purchase Quotation
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Purchase-Quotation-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Purchase-Quotation-Trans')}}">

                          <i class="fa fa-circle-o text-aqua"></i>
 
                          Add Purchase Quotation <span style="display: none;">TP1</span>

                        </a>

                      </li>

                      <li class=" <?php if(Request::segment(3) ==='View-Purchase-Quatation-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/View-Purchase-Quatation-Trans')}}">

                          <i class="fa fa-circle-o text-red"></i> 

                        View Purchase Quotation <span style="display: none;">TP1</span>

                        </a>

                      </li>

                      <li class=" <?php if(Request::segment(3) ==='Purchase-Quo-Comparism-Trans'){echo "active";} ?>">

                        <a href="{{ url('Transaction/Purchase/Purchase-Quo-Comparism-Trans') }}">

                          <i class="fa fa-circle-o text-aqua"></i> 

                         Quo. Comparison  <span style="display: none;">TP1</span>

                        </a>

                      </li>

                      <li class=" <?php if(Request::segment(3) ==='Purchase-Quo-Comparision-View'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Purchase-Quo-Comparision-View')}}">

                          <i class="fa fa-circle-o text-red"></i> 

                        View Quo. Comparison <span style="display: none;">TP1</span>

                        </a>

                      </li>

                     

                    </ul>

                </li>

            <?php } else{} } }?>


            <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class="<?php if(Request::segment(3) ==='Purchase-Quotation-Trans' || Request::segment(3) ==='View-Purchase-Quatation-Trans' || Request::segment(3) ==='Purchase-Quo-Comparism-Trans' || Request::segment(3) ==='Purchase-Quo-Comparision-View'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Purchase  Quotation
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) ==='Purchase-Quotation-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Purchase-Quotation-Trans')}}">

                          <i class="fa fa-circle-o text-aqua"></i>

                          Add Purchase Quotation <span style="display: none;">TP1</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Purchase-Quatation-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Purchase-Quatation-Trans')}}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Purchase Quotation <span style="display: none;">TP1</span>

                            </a>

                      </li>

                      <li class=" <?php if(Request::segment(3) ==='Purchase-Quo-Comparism-Trans'){echo "active";} ?>">

                        <a href="{{ url('Transaction/Purchase/Purchase-Quo-Comparism-Trans') }}">

                          <i class="fa fa-circle-o text-aqua"></i> 

                         Quo. Comparison  <span style="display: none;">TP1</span>

                        </a>

                      </li>

                      <li class=" <?php if(Request::segment(3) ==='Purchase-Quo-Comparision-View'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Purchase-Quo-Comparision-View')}}">

                          <i class="fa fa-circle-o text-red"></i> 

                        View Quo. Comparison <span style="display: none;">TP1</span>

                        </a>

                      </li>

                      

                    </ul>

                </li>

              <?php } else {} ?>

              <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class="<?php if(Request::segment(3) ==='Purchase-Contract-Trans' || Request::segment(3) ==='View-Contract-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Purchase  Contract
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) ==='Purchase-Contract-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Purchase-Contract-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Purchase Contract <span style="display: none;">TP2</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Contract-Trans'){echo "active";} ?>">

                            <a href="{{url('/Transaction/Purchase/View-Contract-Trans')}}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Purchase Contract <span style="display: none;">TP2</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>

              <?php if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TPP2' == $row &&  Session::get('usertype')=='superAdmin' || 'TPP2' == $row && Session::get('usertype')=='user') { 

                ?>

               <li class=" <?php if(Request::segment(3) ==='Purchase-Contract-Trans' || Request::segment(3) ==='View-Contract-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Purchase Contract
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Purchase-Contract-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Purchase-Contract-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Purchase Contract <span style="display: none;">TP2</span>

                        </a>

                      </li>

                      <li class=" <?php if(Request::segment(3) ==='View-Contract-Trans'){echo "active";} ?>">

                            <a href="{{url('/Transaction/Purchase/View-Contract-Trans')}}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Purchase Contract <span style="display: none;">TP2</span>

                            </a>

                      </li>

                    </ul>

                </li>

            <?php } else{} } }?>
            
                <?php if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TPP3' == $row &&  Session::get('usertype')=='superAdmin' || 'TPP3' == $row && Session::get('usertype')=='user') { 

                ?>

               <li class=" <?php if(Request::segment(3) ==='Purchase-Order-Trans' || Request::segment(3) ==='View-Purchase-Order-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Purchase Order
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Purchase-Order-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Purchase-Order-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Purchase Order  <span style="display: none;">TP3</span>

                        </a>

                      </li>

                      <li class=" <?php if(Request::segment(3) ==='View-Purchase-Order-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Purchase-Order-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Purchase Order  <span style="display: none;">TP3</span>

                            </a>

                      </li>

                       <li class=" <?php if(Request::segment(3) ==='purchase-order-approval'){echo "active";} ?>">

                            <a href="{{ url('/finance/transaction/purchase-order-approval') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Purchase Approval  <span style="display: none;">TP3</span>

                            </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='Job-Work-Order'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Job-Work-Order') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Job Work Order  <span style="display: none;">TP3</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Job-Work-Order-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/View-Job-Work-Order-Trans') }}">

                          <i class="fa fa-circle-o text-red"></i>

                          View Job Work Order  <span style="display: none;">TP3</span>

                        </a>

                      </li>

                    </ul>

                </li>
        <?php } else{} } }?>
            


            <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class="<?php if(Request::segment(3) ==='Purchase-Order-Trans' || Request::segment(3) ==='View-Purchase-Order-Trans' || Request::segment(3) ==='Job-Work-Order' || Request::segment(3) ==='View-Job-Work-Order-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Purchase  Order
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) ==='Purchase-Order-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Purchase-Order-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Purchase Order  <span style="display: none;">TP3</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Purchase-Order-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Purchase-Order-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Purchase Order  <span style="display: none;">TP3</span>

                            </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='Job-Work-Order'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/Job-Work-Order') }}">

                              <i class="fa fa-circle-o text-yellow"></i> 

                            Job Work Order  <span style="display: none;">TP3</span>

                            </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Job-Work-Order-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Job-Work-Order-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Job Work Order  <span style="display: none;">TP3</span>

                            </a>

                      </li>
                      
                    </ul>

                </li>

              <?php } else {} ?>

              <?php if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TPP4' == $row &&  Session::get('usertype')=='superAdmin' || 'TPP4' == $row && Session::get('usertype')=='user') { 

                ?>

               <li class="<?php if(Request::segment(3) ==='Purchase-Order-Trans' || Request::segment(3) ==='View-Purchase-Order-Trans' || Request::segment(3) ==='Job-Work-Order' || Request::segment(3) ==='View-Job-Work-Order-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Good Reciept Note
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Good-Reciept-Note-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Good-Reciept-Note-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Good Reciept Note  <span style="display: none;">TP5</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='view-Good-Reciept-Note-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/view-Good-Reciept-Note-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Good Reciept Note <span style="display: none;">TP5</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else{} } }?>

              <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class=" <?php if(Request::segment(3) ==='Good-Reciept-Note-Trans' || Request::segment(3) ==='view-Good-Reciept-Note-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Good Reciept Note
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Good-Reciept-Note-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Good-Reciept-Note-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Good Reciept Note  <span style="display: none;">TP5</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='view-Good-Reciept-Note-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/view-Good-Reciept-Note-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Good Reciept Note <span style="display: none;">TP5</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>


             

              
              <?php if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TPP5' == $row &&  Session::get('usertype')=='superAdmin' || 'TPP5' == $row && Session::get('usertype')=='user') { 

                ?>

               <li class="<?php if(Request::segment(3) ==='Purchase-Bill-Trans' || Request::segment(3) ==='purchase-transaction_bill' ||  Request::segment(3) ==='View-Purchase-Bill-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Purchase Bill
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Purchase-Bill-Trans' || Request::segment(3) ==='View-Purchase-Bill-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Purchase-Bill-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Purchase Bill  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Purchase-Bill-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Purchase-Bill-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Purchase Bill  <span style="display: none;">TP4</span>

                            </a>

                      </li>

                    </ul>

                </li>

            <?php } else{} } }?>

            <?php if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TPP4' == $row &&  Session::get('usertype')=='superAdmin' || 'TPP4' == $row && Session::get('usertype')=='user') { 

                ?>

               <li class="<?php if(Request::segment(3) === 'multiple-purchase-transaction' || Request::segment(3) ==='view-purchase-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Mul. Purchase Bill
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) === 'multiple-purchase-transaction'){echo "active";} ?>">

                        <a href="{{ url('/finance/transaction/multiple-purchase-transaction') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Mul. Purchase Bill  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='view-purchase-transaction'){echo "active";} ?>">

                            <a href="{{ url('/finance/transaction/view-purchase-transaction') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Mul. Purchase Bill  <span style="display: none;">TP4</span>

                            </a>

                      </li>

                    </ul>

                </li>

            <?php } else{} } }?>


            <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class=" <?php if(Request::segment(3) ==='Purchase-Bill-Trans' || Request::segment(3) ==='View-Purchase-Bill-Trans' || Request::segment(3) ==='purchase-transaction_bill'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Purchase Bill
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Purchase-Bill-Trans' || Request::segment(3) ==='View-Purchase-Bill-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Purchase-Bill-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Purchase Bill  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Purchase-Bill-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Purchase-Bill-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Purchase Bill  <span style="display: none;">TP4</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>


                <?php if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TPP6' == $row &&  Session::get('usertype')=='superAdmin' || 'TPP6' == $row && Session::get('usertype')=='user') { 

                ?>

               <li class="<?php if(Request::segment(3) ==='Direct-Purchase-Bill-Trans' || Request::segment(3) ==='View-Direct-Purchase-Bill-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Direct Purchase Bill
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Direct-Purchase-Bill-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Direct-Purchase-Bill-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Direct Purchase Bill <span style="display: none;">TP5</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Direct-Purchase-Bill-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Direct-Purchase-Bill-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Direct Purchase Bill <span style="display: none;">TP5</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else{} } }?>

              <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class=" <?php if(Request::segment(3) ==='Direct-Purchase-Bill-Trans' || Request::segment(3) ==='View-Direct-Purchase-Bill-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Direct Purchase Bill
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Direct-Purchase-Bill-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Direct-Purchase-Bill-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Direct Purchase Bill  <span style="display: none;">TP5</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Direct-Purchase-Bill-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Direct-Purchase-Bill-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Direct Purchase Bill<span style="display: none;">TP5</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>

              <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class=" <?php if(Request::segment(3) === 'multiple-purchase-transaction' || Request::segment(3) ==='view-purchase-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Mul. Purchase Bill
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) === 'multiple-purchase-transaction'){echo "active";} ?>">

                        <a href="{{ url('/finance/transaction/multiple-purchase-transaction') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Mul. Purchase Bill  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='view-purchase-transaction'){echo "active";} ?>">

                            <a href="{{ url('/finance/transaction/view-purchase-transaction') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Mul. Purchase Bill  <span style="display: none;">TP4</span>

                            </a>

                      </li>

                    </ul>

                </li>

              <?php } else {} ?>

              

                <!--  <li class="">

                    <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                   Purchase Bill  <span style="display: none;">TP6</span>

                    </a>

                </li> -->

                 <?php if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TPC0' == $row &&  Session::get('usertype')=='superAdmin' || 'TPC0' == $row && Session::get('usertype')=='user') { 

                ?>

               <li class=" <?php if(Request::segment(3) ==='Credit-Note-Trans' || Request::segment(3) === 'View-Credit-Note-Trans' || Request::segment(3) === 'Credit-Note-Woitem-Trans' || Request::segment(3) ==='View-Credit-Note-Woitem-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Credit Note
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) ==='Credit-Note-Trans' || Request::segment(3) === 'View-Credit-Note-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> With Item
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Credit-Note-Woitem-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Credit-Note-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Credit Note  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Credit-Note-Woitem-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Credit-Note-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Credit Note  <span style="display: none;">TP4</span>

                            </a>

                      </li>

                    </ul>

                </li>

                    </ul>

                    <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) === 'Credit-Note-Woitem-Trans' || Request::segment(3) ==='View-Credit-Note-Woitem-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Without Item
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Credit-Note-Woitem-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Credit-Note-Woitem-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Credit Note  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Credit-Note-Woitem-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Credit-Note-Woitem-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Credit Note  <span style="display: none;">TP4</span>

                            </a>

                      </li>

                    </ul>

                </li>

                    </ul>

                </li>

        <?php } else{} } }?>

        <?php if(Session::get('usertype')=='admin'){ ?>

            <li class=" <?php if(Request::segment(3) ==='Credit-Note-Trans' || Request::segment(3) === 'View-Credit-Note-Trans' || Request::segment(3) === 'Credit-Note-Woitem-Trans' || Request::segment(3) ==='View-Credit-Note-Woitem-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Credit Note
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) ==='Credit-Note-Trans' || Request::segment(3) === 'View-Credit-Note-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> With Item
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Credit-Note-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Credit-Note-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Credit Note  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Credit-Note-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Credit-Note-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Credit Note  <span style="display: none;">TP4</span>

                            </a>

                      </li>

                    </ul>

                </li>

                    </ul>

                    <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) === 'Credit-Note-Woitem-Trans' || Request::segment(3) ==='View-Credit-Note-Woitem-Trans'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Without Item
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Credit-Note-Woitem-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Credit-Note-Woitem-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Credit Note  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Credit-Note-Woitem-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Credit-Note-Woitem-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Credit Note  <span style="display: none;">TP4</span>

                            </a>

                      </li>

                    </ul>

                </li>

                    </ul>

                </li>


        <?php  } ?>



         <?php if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TPD0' == $row &&  Session::get('usertype')=='superAdmin' || 'TPD0' == $row && Session::get('usertype')=='user') { 

                ?>


                 <li class=" <?php if(Request::segment(3) === 'debit-note-transaction' || Request::segment(3) === 'view-debit-note-transaction' || Request::segment(3) === 'debit-note-woitem-transaction' || Request::segment(3) ==='view-debit-note-woitem-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Debit Note
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                    <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) === 'debit-note-transaction' || Request::segment(3) === 'view-debit-note-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> With Item
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) === 'debit-note-transaction'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Debit-Note-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Debit Note  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'view-debit-note-transaction'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Debit-Note-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Debit Note  <span style="display: none;">TP4</span>

                            </a>

                      </li>

                    </ul>


                </li>

              </ul>


                <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) === 'debit-note-woitem-transaction' || Request::segment(3) ==='view-debit-note-woitem-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Without Item
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) === 'debit-note-woitem-transaction'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Debit-Note-Woitem-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Debit Note  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='view-debit-note-woitem-transaction'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Debit-Note-Woitem-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Debit Note  <span style="display: none;">TP4</span>

                            </a>

                      </li>

                    </ul>


                </li>

              </ul>
                     

                </li>

      <?php } else{} } }?>

      <?php if(Session::get('usertype')=='admin'){ ?>
        
         <li class=" <?php if(Request::segment(3) === 'debit-note-transaction' || Request::segment(3) === 'view-debit-note-transaction' || Request::segment(3) === 'debit-note-woitem-transaction' || Request::segment(3) ==='view-debit-note-woitem-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Debit Note
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                    <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) === 'debit-note-transaction' || Request::segment(3) === 'view-debit-note-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> With Item
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) === 'debit-note-transaction'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Debit-Note-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Debit Note  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'view-debit-note-transaction'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Debit-Note-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Debit Note  <span style="display: none;">TP4</span>

                            </a>

                      </li>

                    </ul>


                </li>

              </ul>


                <ul class="treeview-menu">

                      <li class=" <?php if(Request::segment(3) === 'debit-note-woitem-transaction' || Request::segment(3) ==='view-debit-note-woitem-transaction'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus text-aqua"></i> Without Item
                             <i class="fa fa-angle-left pull-right"></i>
                      </a>

                     <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) === 'debit-note-woitem-transaction'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Purchase/Debit-Note-Woitem-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Debit Note  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='view-debit-note-woitem-transaction'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Purchase/View-Debit-Note-Woitem-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Debit Note  <span style="display: none;">TP4</span>

                            </a>

                      </li>

                    </ul>


                </li>

              </ul>
                     

                </li>

      <?php } ?>

           </ul>

        </li>



        <li class="<?php if(Request::segment(4) ==='production-bom' || Request::segment(4) ==='view-production-bom' || Request::segment(4) ==='production-wobom' || Request::segment(4) ==='view-production-wobom' ||  Request::segment(3) ==='Store-Requistion' || Request::segment(3) ==='View-Store-Requistion' || Request::segment(3) ==='Store-Issue' || Request::segment(3) ==='View-Store-Issue' || Request::segment(3) ==='Store-Return' || Request::segment(3) ==='View-Store-Return'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Store

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
            <ul class="treeview-menu">

              <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('TSS1' == $row &&  Session::get('usertype')=='superAdmin' || 'TSS1' == $row && Session::get('usertype')=='user' || 'TSS1' == $row && Session::get('usertype')=='CRM') { 

                ?>
           
            <li class="<?php if(Request::segment(3) ==='Store-Requistion' || Request::segment(3) ==='View-Store-Requistion'){echo "active";} ?>">
              <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                      Store Requisition <span style="display: none;">TD0</span>
                    <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Store-Requistion'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Store/Store-Requistion') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Store Requisition  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Store-Requistion'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Store/View-Store-Requistion') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Store Requisition <span style="display: none;">TP4</span>

                            </a>

                      </li>

            </ul>
                    
            </li>

          <?php } } } else { }?>

          <?php if(Session::get('usertype')=='admin'){ ?>

            <li class="<?php if(Request::segment(3) ==='Store-Requistion' || Request::segment(3) ==='View-Store-Requistion'){echo "active";} ?>">
              <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                      Store Requisition <span style="display: none;">TD0</span>
                    <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Store-Requistion'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Store/Store-Requistion') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Store Requisition  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Store-Requistion'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Store/View-Store-Requistion') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Store Requisition <span style="display: none;">TP4</span>

                            </a>

                      </li>

            </ul>
                    
            </li>

          <?php } ?>

            <li class="<?php if(Request::segment(3) ==='Store-Issue' || Request::segment(3) ==='View-Store-Issue'){ echo 'active'; } ?>">

                <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                   
                     Store Issue <span style="display: none;">TD1</span>

                    <i class="fa fa-angle-left pull-right"></i>

                </a>

                <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Store-Issue'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Store/Store-Issue') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Store Issue  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='View-Store-Issue'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Store/View-Store-Issue') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Store Issue <span style="display: none;">TP4</span>

                            </a>

                      </li>

                </ul>


                  
            </li>

            <li class="<?php if(Request::segment(3) ==='Store-Return' || Request::segment(3) ==='View-Store-Return'){ echo 'active'; } ?>">

                <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                   
                     Store Return <span style="display: none;">TD1</span>

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(4) ==='Store-Return'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Store/Store-Return') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Store Return  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(4) ==='View-Store-Return'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Store/View-Store-Return') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Store Return <span style="display: none;">TP4</span>

                            </a>

                      </li>

                </ul>
                  
            </li>

           </ul>

        </li>

        <li class="<?php if(Request::segment(3) ==='view-BOM' || Request::segment(3) ==='BOM' || Request::segment(3) ==='production-wobom' || Request::segment(3) ==='view-production-wobom' || Request::segment(3) ==='view-daily-production' || Request::segment(3) ==='daily-production' || Request::segment(3) ==='view-wo-production' || Request::segment(3) ==='wo-production'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Production

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
            <ul class="treeview-menu">

              
           
             <li class="<?php if(Request::segment(3) ==='BOM' || Request::segment(3) ==='view-BOM'){echo "active";} ?>">
              <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                      Production(BOM) <span style="display: none;">TD0</span>
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='BOM'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Production/BOM') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Production(BOM) <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='view-BOM'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Production/view-BOM') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Production(BOM) <span style="display: none;">TP4</span>

                            </a>

                      </li>

                </ul>

              </li>

              <li class="<?php if(Request::segment(3) ==='view-daily-production' || Request::segment(3) ==='daily-production'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                     Daily Production <span style="display: none;">TD0</span>
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                        <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='daily-production'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Production/daily-production') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Daily Production <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='view-daily-production'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Production/view-daily-production') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Daily Production <span style="display: none;">TP4</span>

                            </a>

                      </li>

                </ul>

               </li>

                <li class="<?php if(Request::segment(3) ==='view-wo-production' || Request::segment(3) ==='wo-production'){echo "active";} ?>">
                    <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                   
                     Production(WO BOM) <span style="display: none;">TD1</span>

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                   <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='wo-production'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Production/wo-production') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Production(WO BOM) <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='view-wo-production'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Production/view-wo-production') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Production( WO BOM) <span style="display: none;">TP4</span>

                            </a>

                      </li>

                      <!-- <li class="">

                            <a href="{{ url('/finance/transaction/purchasebillpdf') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            Purchase Bill Pdf <span style="display: none;">PDF1</span>

                            </a>

                      </li> -->

                </ul>
                      

             </li>

             


           </ul>

        </li>

        <li class="<?php if(Request::segment(3) ==='gate-entry-transaction' || Request::segment(3) ==='view-gate-entry-transaction' || Request::segment(3) ==='gate-entry-purchase-transaction' || Request::segment(3) ==='view-gate-entry-purchase-transaction' || Request::segment(3) ==='Gate-Entry-Purchase' || Request::segment(3)==='View-Gate-Entry-Purchase' || Request::segment(3)==='Gate-Pass' || Request::segment(3)==='View-Gate-Pass'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Gate Entry 

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
            <ul class="treeview-menu">

           
            <li class="<?php if(Request::segment(3) ==='Gate-Entry-Purchase' || Request::segment(3)==='View-Gate-Entry-Purchase'){ echo 'active'; } ?>">

                <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                   
                     Gate Entry Purchase <span style="display: none;">TD1</span>

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Gate-Entry-Purchase'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/GateEntry/Gate-Entry-Purchase') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Gate Entry  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3)==='View-Gate-Entry-Purchase'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/GateEntry/View-Gate-Entry-Purchase') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Gate Entry <span style="display: none;">TP4</span>

                            </a>

                      </li>

                </ul>
                  
            </li>

                <li class="<?php if(Request::segment(3)==='Gate-Pass' || Request::segment(3)==='View-Gate-Pass'){ echo 'active'; } ?>">

                <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                   
                     Gate Pass <span style="display: none;">TD1</span>

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3)==='Gate-Pass'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/GateEntry/Gate-Pass') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Gate Pass <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3)==='View-Gate-Pass'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/GateEntry/View-Gate-Pass') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Gate Pass <span style="display: none;">TP4</span>

                            </a>

                      </li>

                </ul>
                  
            </li>


           
              <!-- <li class="<?php if(Request::segment(4)==='gate-entry-nonreturn' || Request::segment(4)==='view-gate-entry-nonreturn'){ echo 'active'; } ?>">

                <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                   
                     Gate Pass NON RETURN <span style="display: none;">TD1</span>

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                      <li class="< ?php if(Request::segment(4)==='gate-entry-nonreturn'){echo "active";} ?>">

                        <a href="{{ url('/finance/transaction/gate-entry/gate-entry-nonreturn') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Gate Pass Non Return <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="< ?php if(Request::segment(4)==='view-gate-entry-nonreturn'){echo "active";} ?>">

                            <a href="{{ url('/finance/transaction/gate-entry/view-gate-entry-nonreturn') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Gate Pass Non Return <span style="display: none;">TP4</span>

                            </a>

                      </li>

                </ul>
                  
            </li> -->



           </ul>

        </li>


<li class="<?php if(Request::segment(3) ==='Job-Crad-Trans' || Request::segment(3) ==='View-Job-Crad-Trans'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Maintenance 

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
            <ul class="treeview-menu">

           
            <li class="<?php if(Request::segment(3) ==='Job-Crad-Trans' || Request::segment(3)==='View-Job-Crad-Trans'){ echo 'active'; } ?>">

                <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                   
                     Job Card Tran <span style="display: none;">TD1</span>

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                      <li class="<?php if(Request::segment(3) ==='Job-Crad-Trans'){echo "active";} ?>">

                        <a href="{{ url('/Transaction/Maintainance/Job-Crad-Trans') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Job Card  <span style="display: none;">TP4</span>

                        </a>

                      </li>

                      <li class="<?php if(Request::segment(3)==='View-Job-Crad-Trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Maintainance/View-Job-Crad-Trans') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            View Job Card <span style="display: none;">TP4</span>

                            </a>

                      </li>

                </ul>
                  
            </li>

              

           </ul>

        </li>





<li class=" <?php if( Request::segment(3) ==='inlet-plant-transaction' || Request::segment(3) ==='view-inlet-plant-transaction' || Request::segment(3) ==='stock-adjustment-transaction' || Request::segment(3) ==='view-stock-adjustment'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Transfer

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
            <ul class="treeview-menu">

           
            <li class="">
              <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                      Inlet Plant <span style="display: none;">TT0</span>
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                     

                    </li>
                <li class="">
                    <a href="{{ url('/DEMO-FILE')}}">

                    <i class="fa fa-plus text-aqua"></i> 
                   
                     Stock Adustment <span style="display: none;">TT1</span>

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                      

             </li>



           </ul>

        </li>

       
        <li class="<?php if(Request::segment(3) =='add-emp-attendance-trans'|| Request::segment(3) =='view-emp-attendance-transaction'|| Request::segment(3) =='leave-trans'|| Request::segment(3) =='view-leave-trans'||Request::segment(3) =='emp-pay-trans'||Request::segment(3) =='view-pay-trans'||Request::segment(3) =='add-leaveApplication'|| Request::segment(3) =='ViewLeaveApplication'||Request::segment(3) =='add-travelRequisition'||Request::segment(3) =='view-travelRequision'||Request::segment(3) =='add-emp-payment-advice-trans'||Request::segment(3) =='view-emp-payment-advice-transaction' || Request::segment(3) =='add-job-opening-trans'||Request::segment(3) =='view-job-opening-trans'||Request::segment(3) =='add-job-application-trans'||Request::segment(3) =='view-job-application-trans'|| Request::segment(3) =='add-emp-interview-trans'||Request::segment(3) =='view-emp-interview-trans'||Request::segment(3) =='add-score-card-trans'||Request::segment(3) =='view-score-card-trans'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> HRM

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                  <ul class="treeview-menu">

                    <li class="<?php if(Request::segment(3) =='add-emp-attendance-trans'|| Request::segment(3) =='view-emp-attendance-transaction'){echo "active";}?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> Attendance Trans

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
            <ul class="treeview-menu">

           
                <li class="<?php if(Request::segment(3) =='add-emp-attendance-trans'){echo "active";}?>">

                  <a href="{{ url('/Transaction/Attendance/add-emp-attendance-trans') }}">

                         <i class="fa fa-circle-o text-yellow"></i>
                          Add Attendance trans
                       

                      </a>
                </li>
                <li class="<?php if(Request::segment(3) =='view-emp-attendance-transaction'){echo "active";}?>">
                    <a href="{{ url('Transaction/Attendance/view-emp-attendance-transaction') }}">

                       <i class="fa fa-circle-o text-red"></i>
                     
                       View Attendance trans
                    </a>
                      
                </li>



           </ul>

        </li>

        <li class="<?php if(Request::segment(3) =='leave-trans'|| Request::segment(3) =='view-leave-trans'){echo "active";} ?>">

                      <a href="#">

                        <i class="fa fa-plus text-aqua"></i> Leave Transaction

                        <i class="fa fa-angle-left pull-right"></i>

                      </a>
                      <ul class="treeview-menu">

           
                          <li class="<?php if(Request::segment(3) =='leave-trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/Leave/leave-trans') }}">

                                   <i class="fa fa-circle-o text-yellow"></i>
                                    Add leave trans
                                 

                                </a>
                          </li>
                          <li class="<?php if(Request::segment(3) =='view-leave-trans'){echo "active";} ?>">
                              <a href="{{ url('/Transaction/Leave/view-leave-trans') }}">

                                 <i class="fa fa-circle-o text-red"></i>
                               
                                 View leave trans
                              </a>
                                
                          </li>



                     </ul>

                    </li>

                    <li class="<?php if(Request::segment(3) =='emp-pay-trans'||Request::segment(3) =='view-pay-trans'){echo "active";} ?>">

                      <a href="#">

                        <i class="fa fa-plus text-aqua"></i>Employee Pay Trans

                        <i class="fa fa-angle-left pull-right"></i>

                      </a>
                      <ul class="treeview-menu">

           
                          <li class="<?php if(Request::segment(3) =='emp-pay-trans'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/EmployeePay/emp-pay-trans') }}">

                                   <i class="fa fa-circle-o text-yellow"></i>
                                    Add Emp Pay Trans
                            </a>
                          </li>
                          <li class="<?php if(Request::segment(3) =='view-pay-trans'){echo "active";} ?>">
                              <a href="{{ url('/Transaction/EmployeePay/view-pay-trans') }}">

                                 <i class="fa fa-circle-o text-red"></i>
                               
                                  View Emp Pay Trans
                              </a>
                                
                          </li>



                     </ul>
                    </li>

                    <li class="<?php if(Request::segment(3) =='add-leaveApplication'|| Request::segment(3) =='ViewLeaveApplication'){echo "active";} ?>">

                      <a href="#">

                        <i class="fa fa-plus text-aqua"></i>Leave Application

                        <i class="fa fa-angle-left pull-right"></i>

                      </a>

                      <ul class="treeview-menu">
                        <li class="<?php if(Request::segment(3) =='add-leaveApplication'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/LeaveApplication/add-leaveApplication')}}">

                                   <i class="fa fa-circle-o text-yellow"></i>
                                    Add Leave Application
                            </a>
                          </li>

                          <li class="<?php if(Request::segment(3) =='ViewLeaveApplication'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/LeaveApplication/ViewLeaveApplication')}}">

                                   <i class="fa fa-circle-o text-yellow"></i>
                                    View Leave Application
                            </a>
                          </li>
                      </ul>

                     
                    </li>

                    <li class="<?php if(Request::segment(3) =='add-travelRequisition'||Request::segment(3) =='view-travelRequision'){echo "active";} ?>">

                      <a href="#">

                        <i class="fa fa-plus text-aqua"></i>Travel Requisition Form

                        <i class="fa fa-angle-left pull-right"></i>

                      </a>

                      <ul class="treeview-menu">
                        <li class="<?php if(Request::segment(3) =='add-travelRequisition'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/TravelRequisition/add-travelRequisition')}}">

                                   <i class="fa fa-circle-o text-yellow"></i>
                                    Add Travel Requisition
                            </a>
                        </li>
                        <li class="<?php if(Request::segment(3) =='view-travelRequision'){echo "active";} ?>">

                            <a href="{{ url('/Transaction/TravelRequisition/view-travelRequision')}}">

                                   <i class="fa fa-circle-o text-yellow"></i>
                                    View Travel Requisition
                            </a>
                        </li>
                      </ul>
                    </li>

                    <li class="<?php if(Request::segment(3) =='add-emp-payment-advice-trans'||Request::segment(3) =='view-emp-payment-advice-transaction'){echo "active";}?>">

                        <a href="#">

                          <i class="fa fa-plus text-aqua"></i> Emp Payment Advice

                          <i class="fa fa-angle-left pull-right"></i>

                        </a>
                        <ul class="treeview-menu">

                       
                            <li class="<?php if(Request::segment(3) =='add-emp-payment-advice-trans'){echo "active";}?>">

                              <a href="{{ url('/Transaction/PaymentAdvice/add-emp-payment-advice-trans') }}">

                                     <i class="fa fa-circle-o text-yellow"></i>
                                      Emp Payment Advice
                                   

                                  </a>
                            </li>
                            <li class="<?php if(Request::segment(3) =='view-emp-payment-advice-transaction'){echo "active";}?>">
                                <a href="{{url('/Transaction/PaymentAdvice/view-emp-payment-advice-transaction')}}">

                                   <i class="fa fa-circle-o text-red"></i>
                                 
                                  View Payment Advice
                                </a>
                                  
                            </li>



                       </ul>

                    </li>

                    <li class="<?php if(Request::segment(3) =='add-job-opening-trans'||Request::segment(3) =='view-job-opening-trans'){echo "active";}?>">

                        <a href="#">

                          <i class="fa fa-plus text-aqua"></i> Job Opening Trans

                          <i class="fa fa-angle-left pull-right"></i>

                        </a>
                        <ul class="treeview-menu">

                       
                            <li class="<?php if(Request::segment(3) =='add-job-opening-trans'){echo "active";}?>">

                              <a href="{{ url('/Transaction/JobOpening/add-job-opening-trans') }}">

                                     <i class="fa fa-circle-o text-yellow"></i>
                                      Add Job Opening
                                   

                                  </a>
                            </li>
                            <li class="<?php if(Request::segment(3) =='view-job-opening-trans'){echo "active";}?>">
                                <a href="{{url('/Transaction/JobOpening/view-job-opening-trans')}}">

                                   <i class="fa fa-circle-o text-red"></i>
                                 
                                  View Job Opening
                                </a>
                                  
                            </li>



                       </ul>

                    </li>

                    <li class="<?php if(Request::segment(3) =='add-job-application-trans'||Request::segment(3) =='view-job-application-trans'){echo "active";}?>">

                        <a href="#">

                          <i class="fa fa-plus text-aqua"></i> Job Application Trans

                          <i class="fa fa-angle-left pull-right"></i>

                        </a>
                        <ul class="treeview-menu">

                       
                            <li class="<?php if(Request::segment(3) =='add-job-application-trans'){echo "active";}?>">

                              <a href="{{ url('/Transaction/JobApplication/add-job-application-trans') }}">

                                     <i class="fa fa-circle-o text-yellow"></i>
                                      Add Job Application
                                   

                                  </a>
                            </li>
                            <li class="<?php if(Request::segment(3) =='view-job-application-trans'){echo "active";}?>">
                                <a href="{{url('/Transaction/JobApplication/view-job-application-trans')}}">

                                   <i class="fa fa-circle-o text-red"></i>
                                 
                                  View Job Application
                                </a>
                                  
                            </li>
                        </ul>

                    </li>

                    <li class="<?php if(Request::segment(3) =='add-emp-interview-trans'||Request::segment(3) =='view-emp-interview-trans'){echo "active";}?>">

                        <a href="#">

                          <i class="fa fa-plus text-aqua"></i> Emp Interview Trans

                          <i class="fa fa-angle-left pull-right"></i>

                        </a>
                        <ul class="treeview-menu">

                       
                            <li class="<?php if(Request::segment(3) =='add-emp-interview-trans'){echo "active";}?>">

                              <a href="{{ url('/Transaction/EmpInterview/add-emp-interview-trans') }}">

                                     <i class="fa fa-circle-o text-yellow"></i>
                                      Add Emp Interview
                                   

                                  </a>
                            </li>
                            <li class="<?php if(Request::segment(3) =='view-emp-interview-trans'){echo "active";}?>">
                                <a href="{{url('/Transaction/EmpInterview/view-emp-interview-trans')}}">

                                   <i class="fa fa-circle-o text-red"></i>
                                 
                                  View Emp Interview
                                </a>
                                  
                            </li>
                        </ul>

                    </li>

                    <li class="<?php if(Request::segment(3) =='add-score-card-trans'||Request::segment(3) =='view-score-card-trans'){echo "active";}?>">

                        <a href="#">

                          <i class="fa fa-plus text-aqua"></i> Score Card Trans

                          <i class="fa fa-angle-left pull-right"></i>

                        </a>
                        <ul class="treeview-menu">

                       
                            <li class="<?php if(Request::segment(3) =='add-score-card-trans'){echo "active";}?>">

                              <a href="{{ url('/Transaction/ScoreCard/add-score-card-trans') }}">

                                     <i class="fa fa-circle-o text-yellow"></i>
                                      Add Score Card
                                   

                                  </a>
                            </li>
                            <li class="<?php if(Request::segment(3) =='view-score-card-trans'){echo "active";}?>">
                                <a href="{{url('/Transaction/ScoreCard/view-score-card-trans')}}">

                                   <i class="fa fa-circle-o text-red"></i>
                                 
                                  View Score Card
                                </a>
                                  
                            </li>
                        </ul>

                    </li>

                    

                    
                  </ul>
        </li>

        <li class="<?php if(Request::segment(3) ==='add-gate-inward-transaction' || Request::segment(3) ==='View-gate-inward-transaction' || Request::segment(3) ==='Bilty-Mast' || Request::segment(3) ==='View-Bilty-Mast' || Request::segment(3) === 'add-inward-entry-transaction' || Request::segment(3) === 'View-inward-entry-transaction' || Request::segment(3) === 'add-inward-storage-transaction' || Request::segment(3) === 'view-inward-storage-transaction' || Request::segment(3) === 'Outward-trans' || Request::segment(3) === 'View-Outward-trans' || Request::segment(3) === 'add-bill-trans' || Request::segment(3) === 'view-bill-trans' || Request::segment(3) === 'add-bilty-transfer-tran' || Request::segment(3) === 'view-bilty-transfer-tran' || Request::segment(3) === 'add-order-plan-transaction' || Request::segment(3) === 'view-order-plan-transaction'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Cold Storage 

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
            <ul class="treeview-menu">

                <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

                ?>
                <li class=" <?php if(Request::segment(3) === 'add-order-plan-transaction' || Request::segment(3) === 'view-order-plan-transaction'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Order Plan
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'add-order-plan-transaction'){echo "active";} ?>">

                                <a href="{{ url('transaction/ColdStorage/add-order-plan-transaction') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Order Plan<span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'view-order-plan-transaction'){echo "active";} ?>">

                                  <a href="{{ url('transaction/ColdStorage/view-order-plan-transaction') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Order Plan<span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                        
                        <li class=" <?php if(Request::segment(3) === 'add-order-plan-transaction' || Request::segment(3) === 'view-order-plan-transaction'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Order Plan
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'add-order-plan-transaction'){echo "active";} ?>">

                                <a href="{{ url('transaction/ColdStorage/add-order-plan-transaction') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Order Plan<span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'view-order-plan-transaction'){echo "active";} ?>">

                                  <a href="{{ url('transaction/ColdStorage/view-order-plan-transaction') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Order Plan<span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>

                <li class=" <?php if(Request::segment(3) === 'add-gate-inward-transaction' || Request::segment(3) === 'View-gate-inward-transaction'){echo "active";} ?>">

                  <a href="#"><i class="fa fa-plus text-aqua"></i>Gate Entry
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu">
                      
                      <li class=" <?php if(Request::segment(3) === 'add-gate-inward-transaction' || Request::segment(3) === 'View-gate-inward-transaction'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i>Gate Inward
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'add-gate-inward-transaction'){echo "active";} ?>">

                                <a href="{{ url('/transaction/ColdStorage/add-gate-inward-transaction') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Gate Inward <span style="display: none;">MO0</span>

                                </a>

                            </li>

                           

                            <li class="<?php if(Request::segment(3) === 'View-gate-inward-transaction'){echo "active";} ?>">

                                  <a href="{{ url('/transaction/ColdStorage/View-gate-inward-transaction') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Gate Inward <span style="display: none;">MO0</span>

                                  </a>

                            </li>



                          </ul>

                      </li>

                      <li class=" <?php if(Request::segment(3) === 'add-gate-outward-transaction' || Request::segment(3) === 'View-gate-outward-transaction'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i>Gate Outward
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'add-gate-outward-transaction'){echo "active";} ?>">

                                <a href="{{ url('/transaction/ColdStorage/add-gate-outward-transaction') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Gate Outward <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-gate-outward-transaction'){echo "active";} ?>">

                                  <a href="{{ url('/transaction/ColdStorage/View-gate-outward-transaction') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Gate Outward <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                      </li>

                    </ul>

                </li>

                        
                        

                        <?php if(Session::get('usertype')=='admin'){ ?>

                          <li class=" <?php if(Request::segment(3) === 'add-inward-entry-transaction' || Request::segment(3) === 'View-inward-entry-transaction'){echo "active";} ?>">

                            <a href="#"><i class="fa fa-plus text-aqua"></i>Inward Entry
                              <i class="fa fa-angle-left pull-right"></i>
                            </a>

                            <ul class="treeview-menu">

                              <li class=" <?php if(Request::segment(3) === 'add-inward-entry-transaction'){echo "active";} ?>">

                                  <a href="{{ url('/transaction/ColdStorage/add-inward-entry-transaction') }}">

                                    <i class="fa fa-circle-o text-yellow"></i>

                                    Add Inward Entry <span style="display: none;">MO0</span>

                                  </a>

                              </li>
                              
                              <li class="<?php if(Request::segment(3) === 'View-inward-entry-transaction'){echo "active";} ?>">

                                    <a href="{{ url('/transaction/ColdStorage/View-inward-entry-transaction') }}">

                                      <i class="fa fa-circle-o text-red"></i> 

                                      View Inward Entry <span style="display: none;">MO0</span>

                                    </a>

                              </li>

                            </ul>

                          </li>
                        <?php } else{ }?>

                          <li class="<?php if(Request::segment(3)==='add-inward-storage-transaction' || Request::segment(3)==='view-inward-storage-transaction'){ echo 'active'; } ?>">

                          <a href="#">

                              <i class="fa fa-plus text-aqua"></i> 
                             
                              Inward Storage<span style="display: none;">TD1</span>

                              <i class="fa fa-angle-left pull-right"></i>

                            </a>

                            <ul class="treeview-menu">

                                <li class="<?php if(Request::segment(3)==='add-inward-storage-transaction'){echo "active";} ?>">

                                  <a href="{{ url('/transaction/ColdStorage/add-inward-storage-transaction') }}">

                                    <i class="fa fa-circle-o text-yellow"></i>

                                    Add Inward Storage<span style="display: none;">TP4</span>

                                  </a>

                                </li>

                                <li class="<?php if(Request::segment(3)==='view-inward-storage-transaction'){echo "active";} ?>">

                                      <a href="{{ url('/transaction/ColdStorage/view-inward-storage-transaction') }}">

                                        <i class="fa fa-circle-o text-red"></i> 

                                      View Inward Storage<span style="display: none;">TP4</span>

                                      </a>

                                </li>

                          </ul>
                            
                      </li>

          
            <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

                ?>
                <li class=" <?php if(Request::segment(3) === 'Bilty-Mast' || Request::segment(3) === 'View-Bilty-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Bilty Create
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Bilty-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Transaction/ColdStorage/Bilty-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Bilty Create<span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Bilty-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/ColdStorage/View-Bilty-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Bilty Create<span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

              <?php } else{} } }?>




                    <?php if(Session::get('usertype')=='admin'){ ?>

                        
                        <li class=" <?php if(Request::segment(3) === 'Bilty-Mast' || Request::segment(3) === 'View-Bilty-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Bilty Create
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Bilty-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Transaction/ColdStorage/Bilty-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Bilty Create<span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Bilty-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/ColdStorage/View-Bilty-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Bilty Create<span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>

              
                <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

                ?>
                <li class=" <?php if(Request::segment(3) === 'Outward-trans' || Request::segment(3) === 'View-Outward-trans'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Outward Entry
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Outward-trans'){echo "active";} ?>">

                                <a href="{{ url('/Transaction/ColdStorage/Outward-trans') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Outward Entry<span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Outward-trans'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/ColdStorage/View-Outward-trans') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Outward Entry<span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                        
                        <li class=" <?php if(Request::segment(3) === 'Outward-trans' || Request::segment(3) === 'View-Outward-trans'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Outward Entry
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Outward-trans'){echo "active";} ?>">

                                <a href="{{ url('/Transaction/ColdStorage/Outward-trans') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Outward Entry<span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Outward-trans'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/ColdStorage/View-Outward-trans') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Outward Entry<span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>

                      <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

                ?>
                <li class=" <?php if(Request::segment(3) === 'add-bill-trans' || Request::segment(3) === 'view-bill-trans'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Generate Bill
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'add-bill-trans'){echo "active";} ?>">

                                <a href="{{ url('/Transaction/ColdStorage/add-bill-trans') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Bill<span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'view-bill-trans'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/ColdStorage/view-bill-trans') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Bill<span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                        
                        <li class=" <?php if(Request::segment(3) === 'add-bill-trans' || Request::segment(3) === 'view-bill-trans'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Generate Bill
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'add-bill-trans'){echo "active";} ?>">

                                <a href="{{ url('/Transaction/ColdStorage/add-bill-trans') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Bill<span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'view-bill-trans'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/ColdStorage/view-bill-trans') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Bill<span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>

                      <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

                ?>
                <li class=" <?php if(Request::segment(3) === 'add-bilty-transfer-tran' || Request::segment(3) === 'view-bilty-transfer-tran'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Bilty Transfer
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'add-bilty-transfer-tran'){echo "active";} ?>">

                                <a href="{{ url('/Transaction/ColdStorage/add-bilty-transfer-tran') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Bilty Transfer<span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'view-bilty-transfer-tran'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/ColdStorage/view-bilty-transfer-tran') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Bilty Transfer<span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                        
                        <li class=" <?php if(Request::segment(3) === 'add-bilty-transfer-tran' || Request::segment(3) === 'view-bilty-transfer-tran'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Bilty Transfer
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'add-bilty-transfer-tran'){echo "active";} ?>">

                                <a href="{{ url('/Transaction/ColdStorage/add-bilty-transfer-tran') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Bilty Transfer<span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'view-bilty-transfer-tran'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/ColdStorage/view-bilty-transfer-tran') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Bilty Transfer<span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>

           </ul>

        </li>

        <li class="<?php if(Request::segment(3) =='leave-trans' || Request::segment(3) =='create-delivery-order' || Request::segment(3) =='view-create-delivery-order' || Request::segment(3) =='create-loading-slip' || Request::segment(3) == 'create-loading-slip-without-plan' || Request::segment(3) =='create-loading-and-plan' || Request::segment(3) =='view-loading-slip' || Request::segment(3) =='add-outward-trans' || Request::segment(3) =='add-gate-inward-transaction-cf' || Request::segment(3) =='View-gate-inward-transaction-cf' || Request::segment(3) =='add-gate-outward-transaction-cf' || Request::segment(3) =='view-gate-outward-transaction-cf' || Request::segment(3) =='view-gate-outward-transaction-cf' || Request::segment(3) =='Rack-Trans' || Request::segment(3) =='form-inward-trans' || Request::segment(3) =='add-outward-trans' || Request::segment(3) =='add-outward-trans' || Request::segment(3) =='Rack-Trans' || Request::segment(3) =='View-Rack-Trans' || Request::segment(3) =='view-inward-trans' || Request::segment(3) =='view-outward-trans' || Request::segment(3) === 'view-gate-outward-transaction-cf' || Request::segment(3) =='job-work-sale-bill' || Request::segment(3) =='job-work-purchase-bill' || Request::segment(3) =='view-job-work-sale-bill' || Request::segment(3) =='view-job-work-purchase-bill' || Request::segment(3) == 'inward-import-rake-tran' || Request::segment(3) =='c-and-f-bill-tran' || Request::segment(3) =='view-c-and-f-bill-tran'){echo "active";} ?>">

            <a href="#">

              <i class="fa fa-plus" style="color:antiquewhite;"></i> C and F

              <i class="fa fa-angle-left pull-right"></i>

            </a>
            <ul class="treeview-menu">

                <li class="<?php if(Request::segment(3) =='Rack-Trans' || Request::segment(3) =='View-Rack-Trans'){echo "active";}?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> Rake Transaction

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                 <ul class="treeview-menu">
           
                    <li class="<?php if(Request::segment(3) =='Rack-Trans'){echo "active";}?>">

                      <a href="{{ url('/Transaction/Logistic/Rack-Trans') }}">

                           <i class="fa fa-circle-o text-yellow"></i>
                            Add Rake Trans
                      </a>
                    </li>
                    <li class="<?php if(Request::segment(3) =='View-Rack-Trans'){echo "active";}?>">
                      <a href="{{ url('/Transaction/Logistic/View-Rack-Trans') }}">

                       <i class="fa fa-circle-o text-red"></i>
                     
                          View Rake Trans
                      </a>
                      
                    </li>

                  </ul>

                </li>

                <li class="<?php if(Request::segment(3) =='create-delivery-order' || Request::segment(3) =='view-create-delivery-order'){echo "active";}?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> Delivery Order

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                 <ul class="treeview-menu">
           
                    <li class="<?php if(Request::segment(3) =='create-delivery-order'){echo "active";}?>">

                      <a href="{{ url('/transaction/c-and-f/create-delivery-order') }}">

                           <i class="fa fa-circle-o text-yellow"></i>
                            Create DO - Rake
                      </a>
                    </li>
                    <li class="<?php if(Request::segment(3) =='view-create-delivery-order'){echo "active";}?>">
                      <a href="{{ url('/transaction/c-and-f/view-create-delivery-order') }}">

                       <i class="fa fa-circle-o text-red"></i>
                     
                          View DO Summary - Rake
                      </a>
                      
                    </li>

                  </ul>

                </li>

                <li class=" <?php if(Request::segment(3) === 'add-gate-inward-transaction-cf' || Request::segment(3) === 'View-gate-inward-transaction-cf' || Request::segment(3) === 'add-gate-outward-transaction-cf' || Request::segment(3) === 'view-gate-outward-transaction-cf' || Request::segment(3) === 'Change-Inward-Do-Destination'){echo "active";} ?>">

                  <a href="#"><i class="fa fa-plus text-aqua"></i>Gate Entry
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu">
                      
                      <li class=" <?php if(Request::segment(3) === 'add-gate-inward-transaction-cf' || Request::segment(3) === 'View-gate-inward-transaction-cf'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i>Gate Inward
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'add-gate-inward-transaction-cf'  || Request::segment(3) === 'View-gate-inward-transaction-cf'){echo "active";} ?>">

                                <a href="{{ url('/transaction/CandF/add-gate-inward-transaction-cf') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Gate Inward <span style="display: none;">MO0</span>

                                </a>

                            </li>

                             
                            
                            <li class="<?php if(Request::segment(3) === 'View-gate-inward-transaction-cf'){echo "active";} ?>">

                                  <a href="{{ url('/transaction/CandF/View-gate-inward-transaction-cf') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Gate Inward <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                      </li>

                      <li class=" <?php if(Request::segment(3) === 'add-gate-outward-transaction-cf' || Request::segment(3) === 'view-gate-outward-transaction-cf'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i>Gate Outward
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'add-gate-outward-transaction-cf'){echo "active";} ?>">

                                <a href="{{ url('/transaction/CandF/add-gate-outward-transaction-cf') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Gate Outward <span style="display: none;">MO0</span>

                                </a>

                            </li>


                            
                            <li class="<?php if(Request::segment(3) === 'view-gate-outward-transaction-cf'){echo "active";} ?>">

                                  <a href="{{ url('/transaction/CandF/view-gate-outward-transaction-cf') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Gate Outward <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                      </li>

                    </ul>

                </li>

                <li class="<?php if(Request::segment(3) =='form-inward-trans' || Request::segment(3) =='view-inward-trans' || Request::segment(3) == 'inward-import-rake-tran'){echo "active";}?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> Inward Trans

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                  <ul class="treeview-menu">
           
                    <li class="<?php if(Request::segment(3) =='form-inward-trans'){echo "active";}?>">

                      <a href="{{ url('/transaction/c-and-f/form-inward-trans') }}">

                           <i class="fa fa-circle-o text-yellow"></i>
                            Add Inward trans
                      </a>
                    </li>

                    <li class="<?php if(Request::segment(3) === 'Change-Inward-Do-Destination'){echo "active";} ?>">

                                  <a href="{{ url('/logistic/Change-Inward-Do-Destination') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    Change Inward Do Destination<span style="display: none;">MO0</span>

                                  </a>

                      </li>

                    <li class="<?php if(Request::segment(3) === 'inward-import-rake-tran'){echo "active";} ?>">

                          <a href="{{ url('/transaction/c-and-f/inward-import-rake-tran') }}">

                            <i class="fa fa-circle-o text-red"></i> 

                            Inward( Import Rake Tran)<span style="display: none;">MO0</span>

                          </a>

                    </li>

                    <li class="<?php if(Request::segment(3) =='inward-import-rake-tran'){echo "active";}?>">
                      <a href="{{ url('transaction/c-and-f/add-inward-physical-verification') }}">

                       <i class="fa fa-circle-o text-red"></i>
                     
                       Physical Verification
                      </a>
                      
                    </li>

                    <li class="<?php if(Request::segment(3) =='view-inward-trans'){echo "active";}?>">
                      <a href="{{ url('transaction/c-and-f/view-inward-trans') }}">

                       <i class="fa fa-circle-o text-red"></i>
                     
                       View Inward trans
                      </a>
                      
                    </li>

                  </ul>

                </li>

                <li class="<?php if(Request::segment(3) =='create-loading-slip' || Request::segment(3)  =='create-loading-slip-without-plan' || Request::segment(3)=='create-loading-and-plan' || Request::segment(3) =='view-loading-slip' || Request::segment(3) =='add-outward-trans' || Request::segment(3) =='view-outward-trans'){echo "active";}?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> Outward Trans

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                  <ul class="treeview-menu">

                    <li class="<?php if(Request::segment(3) =='create-loading-and-plan'){echo "active";}?>">

                      <a href="{{ url('/transaction/candf/create-loading-and-plan') }}">

                           <i class="fa fa-circle-o text-yellow"></i>
                            Loading Plan
                      </a>
                    </li>

                    <li class="<?php if(Request::segment(3) =='create-loading-slip'){echo "active";}?>">

                      <a href="{{ url('/transaction/candf/create-loading-slip') }}">

                           <i class="fa fa-circle-o text-red"></i>
                            Loading Slip (Plan)
                      </a>
                    </li>

                    <li class="<?php if(Request::segment(3) =='create-loading-slip-without-plan'){echo "active";}?>">

                      <a href="{{ url('/transaction/candf/create-loading-slip-without-plan') }}">

                           <i class="fa fa-circle-o text-yellow"></i>
                            Loading Slip (W/O Plan)
                      </a>
                    </li>

                    <li class="<?php if(Request::segment(3) =='view-loading-slip'){echo "active";}?>">

                      <a href="{{ url('/transaction/candf/view-loading-slip') }}">

                           <i class="fa fa-circle-o text-red"></i>
                            View Loading Slip
                      </a>
                    </li>
           
                    <li class="<?php if(Request::segment(3) =='add-outward-trans'){echo "active";}?>">

                      <a href="{{ url('/transaction/CandF/add-outward-trans') }}">

                           <i class="fa fa-circle-o text-yellow"></i>
                            Add Outward tran-LR
                      </a>
                    </li>
                    <li class="<?php if(Request::segment(3) =='view-outward-trans'){echo "active";}?>">
                      <a href="{{ url('/transaction/CandF/view-outward-trans') }}">

                       <i class="fa fa-circle-o text-red"></i>
                     
                       View Outward tran-LR
                      </a>
                      
                    </li>

                   

                   
                   

                  </ul>

                </li>


                 <li class="<?php if(Request::segment(3) =='job-work-sale-bill' || Request::segment(3) =='job-work-purchase-bill' || Request::segment(3) =='view-job-work-sale-bill' || Request::segment(3) =='view-job-work-purchase-bill' || Request::segment(3) =='c-and-f-bill-tran' || Request::segment(3) =='view-c-and-f-bill-tran'){echo "active";}?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> C and F Bill

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                  <ul class="treeview-menu">
           
                     <li class="<?php if(Request::segment(3) =='job-work-sale-bill'){echo "active";}?>">
                      <a href="{{ url('/transaction/CandF/job-work-sale-bill') }}">

                       <i class="fa fa-circle-o text-yellow"></i> 
                        Job Work Sale Bill 
                      </a>
                      
                    </li>

                    <li class="<?php if(Request::segment(3) =='view-job-work-sale-bill'){echo "active";}?>">
                      <a href="{{ url('/transaction/CandF/view-job-work-sale-bill') }}">

                       <i class="fa fa-circle-o text-red"></i> 
                        View Job Work Sale Bill 
                      </a>
                      
                    </li>
                    <li class="<?php if(Request::segment(3) =='job-work-purchase-bill'){echo "active";}?>">
                      <a href="{{ url('/transaction/CandF/job-work-purchase-bill') }}">

                       <i class="fa fa-circle-o text-yellow"></i> 
                        Job Work Purchase Bill 
                      </a>
                      
                    </li>
                    <li class="<?php if(Request::segment(3) =='view-job-work-purchase-bill'){echo "active";}?>">
                      <a href="{{ url('/transaction/CandF/view-job-work-purchase-bill') }}">

                       <i class="fa fa-circle-o text-red"></i> 
                        View Job Work Purchase Bill 
                      </a>
                      
                    </li>
                    <li class="<?php if(Request::segment(3) =='c-and-f-bill-tran'){echo "active";}?>">
                      <a href="{{ url('/transaction/CandF/c-and-f-bill-tran') }}">

                       <i class="fa fa-circle-o text-yellow"></i> 
                        C and F Bill 
                      </a>
                      
                    </li>

                    <li class="<?php if(Request::segment(3) =='view-c-and-f-bill-tran'){echo "active";}?>">
                      <a href="{{ url('/transaction/CandF/view-c-and-f-bill-tran') }}">

                       <i class="fa fa-circle-o text-red"></i> 
                        View C and F Bill 
                      </a>
                      
                    </li>

                  </ul>

                </li>
                 

                <!-- <li class="< ?php if(Request::segment(3) =='employee-attendance-transaction'){echo "active";}?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> Sap Bill

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                  <ul class="treeview-menu">
           
                    <li class="< ?php if(Request::segment(3) =='employee-attendance-transaction'){echo "active";}?>">

                      <a href="{{ url('/form-sap-bill') }}">

                           <i class="fa fa-circle-o text-yellow"></i>
                            Add Sap Bill trans
                      </a>
                    </li>
                    <li class="">
                      <a href="{{ url('view-sap-bill') }}">

                       <i class="fa fa-circle-o text-red"></i>
                     
                       View Sap Bill trans
                      </a>
                      
                    </li>

                  </ul>

                </li> -->
                    
            </ul>
        </li>

      <!-- logistic -->

         <li class="<?php if(Request::segment(2) =='fleet-transaction' || Request::segment(2) =='view-fleet-transaction' || Request::segment(3)==='Vehicle-Inward' || Request::segment(3)==='View-Vehicle-Inward'  || Request::segment(1) ==='vehicle-planing-mast' || Request::segment(1) ==='view-vehicle-planing-mast' || Request::segment(3) ==='aprove-trip-market' || Request::segment(1) ==='vehicle-planing-wo-item'||  Request::segment(3) =='Freight-Sale-Order' || Request::segment(3) =='View-Freight-Sale-Order' || Request::segment(3) =='Delivery-Order' || Request::segment(3) =='View-Delivery-Order' || Request::segment(3) =='Freight-Purchase-Order' || Request::segment(3) =='View-Freight-Purchase-Order'|| Request::segment(1) ==='ePOD-transaction' || Request::segment(1) ==='view-ePOD-transaction'|| Request::segment(3) ==='lorry-receipt-trans' || Request::segment(3) ==='View-lorry-receipt-trans' || Request::segment(3)  === 'suppl-lorry-receipt-trans' || Request::segment(3)==='Vehicle-Gate-Inward' || Request::segment(3)==='View-Vehicle-Gate-Inward' || Request::segment(3) ==='lr-acknowledgment-trans' || Request::segment(3) ==='View-lr-acknowledgment-trans' || Request::segment(3) ==='transporter-bill-posting' || Request::segment(2) === 'cancel-delivery-order-quantity' || Request::segment(2) === 'Change-Do-Destination' || Request::segment(2) =='adhoc-advance-vehicle' || Request::segment(1) =='create-expense-jv-self' || Request::segment(3) == 'Freight-Sale-Quatation' || Request::segment(3) =='view-freight-sale-Quatation' || Request::segment(1) == 'approve-trip-payment-advice' || Request::segment(2)  === 'change_vehicle-lr' || Request::segment(3) === 'Vehicle-Gate-Outward' || Request::segment(3) === 'View-Vehicle-Gate-Outward' || Request::segment(2) === 'sale-bill-provisional' || Request::segment(2) === 'sale-bill-final' || Request::segment(2) === 'e-proc-status' || Request::segment(2) === 'view-sale-bill-provisional' || Request::segment(3) ==='upload-bulk-lr' || Request::segment(3) ==='upload-ewb-data' || Request::segment(3) =='transporter-sale-bill' || Request::segment(3) === 'view-transporter-sale-bill' || Request::segment(2) === 'view-sale-bill-final' || Request::segment(3) ==='view-transporter-bill-posting'){echo "active";} ?>">

            <a href="#">

              <i class="fa fa-plus" style="color:antiquewhite;"></i> Logistics

              <i class="fa fa-angle-left pull-right"></i>

            </a>
            <ul class="treeview-menu">

              <li class="<?php if(Request::segment(3) == 'Freight-Sale-Quatation' || Request::segment(3) =='view-freight-sale-Quatation'){echo "active";}?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> Freight Sale Quatation

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                  <ul class="treeview-menu">
           
                    <li class="<?php if(Request::segment(3) =='Freight-Sale-Quatation'){echo "active";}?>">

                      <a href="{{ url('/Transaction/Logistic/Freight-Sale-Quatation') }}">

                           <i class="fa fa-circle-o text-yellow"></i>
                            Add Freight Sale  Quatation
                      </a>
                    </li>
                    <li class="<?php if(Request::segment(3) =='View-Freight-Sale-Quatation'){echo "active";}?>">
                      <a href="{{ url('/Transaction/Logistic/view-freight-sale-Quatation') }}">

                       <i class="fa fa-circle-o text-red"></i>
                     
                       View Freight Sale Quatation
                      </a>
                      
                    </li>

                  </ul>

              </li>

            	 <li class="<?php if(Request::segment(3) =='Freight-Sale-Order' || Request::segment(3) =='View-Freight-Sale-Order'){echo "active";}?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> Freight Sale Order

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                  <ul class="treeview-menu">
           
                    <li class="<?php if(Request::segment(3) =='Freight-Sale-Order'){echo "active";}?>">

                      <a href="{{ url('/Transaction/Logistic/Freight-Sale-Order') }}">

                           <i class="fa fa-circle-o text-yellow"></i>
                            Add Freight Sale  Order
                      </a>
                    </li>
                    <li class="<?php if(Request::segment(3) =='View-Freight-Sale-Order'){echo "active";}?>">
                      <a href="{{ url('/Transaction/Logistic/View-Freight-Sale-Order') }}">

                       <i class="fa fa-circle-o text-red"></i>
                     
                       View Freight Sale Order
                      </a>
                      
                    </li>

                  </ul>

                </li>

                <li class="<?php if(Request::segment(3) =='Freight-Purchase-Order' || Request::segment(3) =='View-Freight-Purchase-Order'){echo "active";}?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> Freight Purchase Order

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                  <ul class="treeview-menu">
           
                    <li class="<?php if(Request::segment(3) =='Freight-Purchase-Order'){echo "active";}?>">

                      <a href="{{ url('/Transaction/Logistic/Freight-Purchase-Order') }}">

                           <i class="fa fa-circle-o text-yellow"></i>
                            Add Freight Purchase  Order
                      </a>
                    </li>
                    <li class="<?php if(Request::segment(3) =='View-Freight-Purchase-Order'){echo "active";}?>">
                      <a href="{{ url('/Transaction/Logistic/View-Freight-Purchase-Order') }}">

                       <i class="fa fa-circle-o text-red"></i>
                     
                       View Freight Purchase Order
                      </a>
                      
                    </li>

                  </ul>

                </li>

                  <li class="<?php if(Request::segment(3) =='Delivery-Order' || Request::segment(3) =='View-Delivery-Order' || Request::segment(2) === 'cancel-delivery-order-quantity' || Request::segment(2) === 'Change-Do-Destination'){echo "active";}?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> Delivery Order

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                  <ul class="treeview-menu">
           
                    <li class="<?php if(Request::segment(3) =='Delivery-Order'){echo "active";}?>">

                      <a href="{{ url('/Transaction/Logistic/Delivery-Order') }}">

                           <i class="fa fa-circle-o text-yellow"></i>
                            Add Delivery Order
                      </a>
                    </li>
                     <li class="<?php if(Request::segment(2) ==='cancel-delivery-order-quantity'){echo "active";} ?>">

                          <a href="{{url('/logistic/cancel-delivery-order-quantity')}}">

                            <i class="fa fa-circle-o text-aqua"></i> 

                          Cancel D.O. Quantity. <span style="display: none;">TP4</span>

                          </a>

                    </li>

                     <li class="<?php if(Request::segment(3) =='Change-Do-Destination'){echo "active";}?>">
                      <a href="{{ url('/logistic/Change-Do-Destination') }}">

                       <i class="fa fa-circle-o text-red"></i>
                     
                       Change Do Destination
                      </a>
                      
                    </li>

                    <li class="<?php if(Request::segment(3) =='View-Delivery-Order'){echo "active";}?>">
                      <a href="{{ url('/Transaction/Logistic/View-Delivery-Order') }}">

                       <i class="fa fa-circle-o text-red"></i>
                     
                       View Delivery Order
                      </a>
                      
                    </li>

                  </ul>

                </li>

               
                 
            <li class="<?php if(Request::segment(1) ==='vehicle-planing-mast' || Request::segment(1) ==='view-vehicle-planing-mast' || Request::segment(1) ==='vehicle-planing-wo-item' || Request::segment(3) ==='aprove-trip-market'){echo "active";} ?>">

                  <a href="#"><i class="fa fa-plus text-aqua"></i>Trip planing
                        <i class="fa fa-angle-left pull-right"></i>
                      </a>

                      <ul class="treeview-menu">
                          
                        <li class=" <?php if(Request::segment(1) ==='vehicle-planing-mast'){echo "active";} ?>">

                              <a href="{{ url('/vehicle-planing-mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Trip planing <span style="display: none;">MIT0</span>

                              </a>

                          </li> 

                           <li class=" <?php if(Request::segment(1) ==='vehicle-planing-wo-item'){echo "active";} ?>">

                              <a href="{{ url('/vehicle-planing-wo-item') }}">

                                <i class="fa fa-circle-o text-aqua"></i>

                                Add JSPL - Trip planing <!-- W/o Item --> <span style="display: none;">MIT0</span>

                              </a>

                          </li> 

                          <li class="<?php if(Request::segment(1) ==='view-vehicle-planing-mast'){echo "active";} ?>">

                                <a href="{{ url('/view-vehicle-planing-mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View Trip planing <span style="display: none;">MIT0</span>

                                </a>

                          </li>

                          <li class="<?php if(Request::segment(1) ==='aprove-trip-market'){echo "active";} ?>">

                                <a href="{{ url('/logistic/trip-planning/aprove-trip-market') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  Edit Trip Plan <span style="display: none;">MIT0</span>

                                </a>

                          </li>

                          <li class="<?php if(Request::segment(2) ==='Change-Trip-Destination'){echo "active";} ?>">

                                <a href="{{ url('/logistic/Change-Trip-Destination') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  Change Trip Destination <span style="display: none;">MIT0</span>

                                </a>

                          </li>

                      </ul>

                </li>


           


                   <li class=" <?php if(Request::segment(3) === 'Vehicle-Gate-Inward' || Request::segment(3) === 'View-Vehicle-Gate-Inward' || Request::segment(3) === 'Vehicle-Gate-Outward' || Request::segment(3) === 'View-Vehicle-Gate-Outward'){echo "active";} ?>">

                  <a href="#"><i class="fa fa-plus text-aqua"></i>Gate Entry
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu">
                      
                      <li class=" <?php if(Request::segment(3) === 'Vehicle-Gate-Inward' || Request::segment(3) === 'View-Vehicle-Gate-Inward'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i>Gate Inward
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                          <ul class="treeview-menu">

                                <li class="<?php if(Request::segment(3)==='Vehicle-Gate-Inward'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/Logistic/Vehicle-Gate-Inward') }}">

                                    <i class="fa fa-circle-o text-yellow"></i>

                                    Add Gate Inward <span style="display: none;">TP4</span>

                                  </a>

                                </li>

                                <li class="<?php if(Request::segment(3)==='View-Vehicle-Gate-Inward'){echo "active";} ?>">

                                      <a href="{{ url('/Transaction/Logistic/View-Vehicle-Gate-Inward') }}">

                                        <i class="fa fa-circle-o text-red"></i> 

                                      View Gate Inward <span style="display: none;">TP4</span>

                                      </a>

                                </li>

                          </ul>

                      </li>

                      <li class=" <?php if(Request::segment(3) === 'Vehicle-Gate-Outward' || Request::segment(3) === 'View-Vehicle-Gate-Outward'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i>Gate Outward
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                          <ul class="treeview-menu">

                            <li class="<?php if(Request::segment(3)==='Vehicle-Gate-Outward'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/Logistic/Vehicle-Gate-Outward') }}">

                                    <i class="fa fa-circle-o text-yellow"></i>

                                    Add Gate Outward <span style="display: none;">TP4</span>

                                  </a>

                                </li>

                                <li class="<?php if(Request::segment(3)==='View-Vehicle-Gate-Outward'){echo "active";} ?>">

                                      <a href="{{ url('/Transaction/Logistic/View-Vehicle-Gate-Outward') }}">

                                        <i class="fa fa-circle-o text-red"></i> 

                                      View Gate Outward <span style="display: none;">TP4</span>

                                      </a>

                                </li>

                          </ul>

                      </li>

                    </ul>

                </li>

               


                

             <li class="<?php if(Request::segment(3) ==='lorry-receipt-trans' || Request::segment(3) ==='View-lorry-receipt-trans' || Request::segment(3)  === 'suppl-lorry-receipt-trans' || Request::segment(2)  === 'change_vehicle-lr' || Request::segment(3) ==='upload-bulk-lr' || Request::segment(3) ==='upload-ewb-data'){echo "active";} ?>">

                  <a href="#"><i class="fa fa-plus text-aqua"></i>Lorry Receipt
                        <i class="fa fa-angle-left pull-right"></i>
                      </a>

                      <ul class="treeview-menu">
                          
                        <li class=" <?php if(Request::segment(3) ==='lorry-receipt-trans'){echo "active";} ?>">

                              <a href="{{ url('/Transaction/Logistic/lorry-receipt-trans') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Lorry Receipt <span style="display: none;">MIT0</span>

                              </a>

                          </li> 
                         <li class=" <?php if(Request::segment(3) ==='suppl-lorry-receipt-trans'){echo "active";} ?>">

                              <a href="{{ url('/Transaction/Logistic/suppl-lorry-receipt-trans') }}">

                                <i class="fa fa-circle-o text-aqua"></i>

                                Add Supplementary LR <span style="display: none;">MIT0</span>

                              </a>

                          </li> 

                          <li class="<?php if(Request::segment(2) =='change_vehicle-lr'){echo "active";}?>">

                            <a href="{{ url('/logistic/change_vehicle-lr') }}">

                                 <i class="fa fa-circle-o text-yellow"></i>
                                  Change Vehicle - LR
                            </a>
                          </li>


                          <li class="<?php if(Request::segment(2) =='change_vehicle-lr'){echo "active";}?>">

                            <a href="{{ url('/logistic/change_Consinee-lr') }}">

                                 <i class="fa fa-circle-o text-yellow"></i>
                                  Change Consinee - LR
                            </a>
                          </li>

                          <li class="<?php if(Request::segment(3) ==='View-lorry-receipt-trans'){echo "active";} ?>">

                                <a href="{{ url('/Transaction/Logistic/View-lorry-receipt-trans') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View Lorry Receipt <span style="display: none;">MIT0</span>

                                </a>

                          </li>

                          <li class=" <?php if(Request::segment(3) ==='upload-bulk-lr'){echo "active";} ?>">

                              <a href="{{ url('/Transaction/Logistic/upload-bulk-lr') }}">

                                <i class="fa fa-circle-o text-aqua"></i>

                               Upload Bulk LR <span style="display: none;">MIT0</span>

                              </a>

                          </li> 

                          <li class=" <?php if(Request::segment(3) ==='ewaybill-data'){echo "active";} ?>">

                              <a href="{{ url('/Transaction/Logistic/upload-ewb-data') }}">

                                <i class="fa fa-circle-o text-aqua"></i>

                               EWB Data <span style="display: none;">MIT0</span>

                              </a>

                          </li>

                      </ul>

                </li>



                <li class="<?php if(Request::segment(2) =='fleet-transaction' || Request::segment(2) =='view-fleet-transaction' || Request::segment(2) =='adhoc-advance-vehicle' || Request::segment(1) =='create-expense-jv-self' || Request::segment(1) == 'approve-trip-payment-advice'){echo "active";}?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> Trip Expense

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                  <ul class="treeview-menu">
           
                    <li class="<?php if(Request::segment(2) =='fleet-transaction'){echo "active";}?>">

                      <a href="{{ url('/logistic/fleet-transaction') }}">

                           <i class="fa fa-circle-o text-yellow"></i>
                            Add Trip Exp - Own
                      </a>
                    </li>
                    <li class="<?php if(Request::segment(2) =='view-fleet-transaction'){echo "active";}?>">
                      <a href="{{ url('/logistic/view-fleet-transaction') }}">

                       <i class="fa fa-circle-o text-red"></i>
                     
                       View Trip Exp - Own
                      </a>
                      
                    </li>

                     <li class="<?php if(Request::segment(2) =='adhoc-advance-vehicle'){echo "active";}?>">
                      <a href="{{ url('/logistic/adhoc-advance-vehicle') }}">

                       <i class="fa fa-circle-o text-aqua"></i>
                     
                       Adhoc Adavance - Own
                      </a>
                      
                    </li>

                    <li class="<?php if(Request::segment(1) =='create-expense-jv-self'){echo "active";} ?>">

                                <a href="{{ url('/create-expense-jv-self') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  Create Exp JV - Own <span style="display: none;">MIT0</span>

                                </a>

                    </li>

                     <li class="<?php if(Request::segment(1) ==='approve-trip-payment-advice'){echo "active";} ?>">

                                <a href="{{ url('/approve-trip-payment-advice') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  Add Payment Advice - Market <span style="display: none;">MIT0</span>

                                </a>

                    </li>

                    

                  </ul>

                </li>


                  <!-- <li class="<?php if(Request::segment(2) =='suplimentry-trip-trans' || Request::segment(2) =='view-suplimentry-trip-trans'){echo "active";}?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> Suplimentry Trip
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                  <ul class="treeview-menu">
           
                    <li class="<?php if(Request::segment(2) =='suplimentry-trip-trans'){echo "active";}?>">

                      <a href="{{ url('/logistic/suplimentry-trip-trans') }}">

                           <i class="fa fa-circle-o text-yellow"></i>
                            Add Suplimentry Trip
                      </a>
                    </li>
                    <li class="<?php if(Request::segment(2) =='view-suplimentry-trip-trans'){echo "active";}?>">
                      <a href="{{ url('/logistic/view-suplimentry-trip-trans') }}">

                       <i class="fa fa-circle-o text-red"></i>
                     
                       View Suplimentry Trip
                      </a>
                      
                    </li>

                  </ul>

                </li> -->

                <li class="<?php if(Request::segment(1) ==='ePOD-transaction' || Request::segment(1) ==='view-ePOD-transaction'){echo "active";} ?>">

                  <a href="#"><i class="fa fa-plus text-aqua"></i>ePOD Tran
                        <i class="fa fa-angle-left pull-right"></i>
                      </a>

                      <ul class="treeview-menu">
                          
                        <li class=" <?php if(Request::segment(1) ==='ePOD-transaction'){echo "active";} ?>">

                              <a href="{{ url('/ePOD-transaction') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add ePOD Tran <span style="display: none;">MIT0</span>

                              </a>

                          </li> 

                          <li class="<?php if(Request::segment(1) ==='view-ePOD-transaction'){echo "active";} ?>">

                                <a href="{{ url('/view-ePOD-transaction') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View ePOD Tran <span style="display: none;">MIT0</span>

                                </a>

                          </li>

                      </ul>

                </li>

                 <li class="<?php if(Request::segment(3) ==='lr-acknowledgment-trans' || Request::segment(3) ==='View-lr-acknowledgment-trans'){echo "active";} ?>">

                  <a href="#"><i class="fa fa-plus text-aqua"></i>LR Acknowledgment
                        <i class="fa fa-angle-left pull-right"></i>
                      </a>

                      <ul class="treeview-menu">
                          
                        <li class=" <?php if(Request::segment(3) ==='lr-acknowledgment-trans'){echo "active";} ?>">

                              <a href="{{ url('/Transaction/Logistic/lr-acknowledgment-trans') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add LR Acknowledgment <span style="display: none;">MIT0</span>

                              </a>

                          </li> 

                          <li class="<?php if(Request::segment(3) ==='View-lr-acknowledgment-trans'){echo "active";} ?>">

                                <a href="{{ url('/Transaction/Logistic/View-lr-acknowledgment-trans') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View LR Acknowledgment <span style="display: none;">MIT0</span>

                                </a>

                          </li>

                      </ul>

                </li>


           


                <li class="<?php if(Request::segment(3) ==='transporter-bill-posting' || Request::segment(3) ==='view-transporter-bill-posting'){echo "active";} ?>">

                  <a href="#"><i class="fa fa-plus text-aqua"></i>Purchase Freight Bill
                        <i class="fa fa-angle-left pull-right"></i>
                      </a>

                      <ul class="treeview-menu">

                        <li class="<?php if(Request::segment(3) === 'transporter-bill-posting'){ echo "active";}    ?>">

                            <a href="{{ url('/logistic/transaction/transporter-bill-posting') }}"><i class="fa fa-circle-o text-aqua"></i>  Add Freight Bill Posting

                            </a>

                          </li>
                         
                          <li class="<?php if(Request::segment(3) ==='view-transporter-bill-posting'){echo "active";} ?>">

                                <a href="{{ url('/logistic/transaction/view-transporter-bill-posting') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View Freight Bill Posting <span style="display: none;">MIT0</span>

                                </a>

                          </li>




                      </ul>

                </li>

                <li class="<?php if(Request::segment(2) === 'sale-bill-provisional' || Request::segment(2) === 'sale-bill-final' || Request::segment(2) === 'e-proc-status' || Request::segment(3) =='transporter-sale-bill' || Request::segment(2) ==='view-sale-bill-provisional' || Request::segment(3) === 'view-transporter-sale-bill' || Request::segment(2) === 'view-sale-bill-final'){ echo "active";}    ?>"> 
                    <a href="#"><i class="fa fa-plus text-aqua"></i>Sale Bill
                        <i class="fa fa-angle-left pull-right"></i>
                      </a>

                      <ul class="treeview-menu">


                        <li class="<?php if(Request::segment(2) ==='sale-bill-provisional' || Request::segment(2) ==='view-sale-bill-provisional'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Provisional Bill
                                <i class="fa fa-angle-left pull-right"></i>
                              </a>

                              <ul class="treeview-menu">

                                <li class="<?php if(Request::segment(2) === 'sale-bill-provisional'){ echo "active";}    ?>">

                                    <a href="{{ url('/logistic/sale-bill-provisional') }}"><i class="fa fa-circle-o text-aqua"></i>  Add Provisional Bill

                                    </a>

                                  </li>

                                  <li class="<?php if(Request::segment(2) === 'view-sale-bill-provisional'){ echo "active";}    ?>">

                                    <a href="{{ url('/logistic/view-sale-bill-provisional') }}"><i class="fa fa-circle-o text-red"></i> View Provisional Bill

                                    </a>

                                  </li>

                              </ul>

                        </li>

                        <li class="<?php if(Request::segment(2) === 'e-proc-status'){ echo "active";}    ?>">

                          <a href="{{ url('/logistic/e-proc-status') }}"><i class="fa fa-circle-o text-aqua"></i>Update e-Proc Status

                          </a>

                        </li>

                        <li class="<?php if(Request::segment(2) === 'sale-bill-final' || Request::segment(2) ==='view-sale-bill-final'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Final Sale Bill
                                <i class="fa fa-angle-left pull-right"></i>
                              </a>

                              <ul class="treeview-menu">

                                <li class="<?php if(Request::segment(2) === 'sale-bill-final'){ echo "active";}    ?>">

                                    <a href="{{ url('/logistic/sale-bill-final') }}"><i class="fa fa-circle-o text-aqua"></i>  Add Final Sale Bill

                                    </a>

                                  </li>

                                  <li class="<?php if(Request::segment(2) === 'view-sale-bill-final'){ echo "active";}    ?>">

                                    <a href="{{ url('/logistic/view-sale-bill-final') }}"><i class="fa fa-circle-o text-red"></i> View Final Sale Bill

                                    </a>

                                  </li>

                              </ul>

                        </li>

                      
                        <li class="<?php if(Request::segment(3) =='transporter-sale-bill' || Request::segment(3) =='view-transporter-sale-bill'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Transporter Sale Bill 
                                <i class="fa fa-angle-left pull-right"></i>
                              </a>

                              <ul class="treeview-menu">


                                <li class="<?php if(Request::segment(3) === 'transporter-sale-bill'){ echo "active";}    ?>">

                                    <a href="{{ url('/transaction/Logistic/transporter-sale-bill') }}"><i class="fa fa-circle-o text-aqua"></i>  Add Trans. Sale Bill

                                    </a>

                                  </li>

                                  <li class="<?php if(Request::segment(3) === 'view-transporter-sale-bill'){ echo "active";}    ?>">

                                    <a href="{{ url('/transaction/Logistic/view-transporter-sale-bill') }}"><i class="fa fa-circle-o text-red"></i> View Trans. Sale Bill

                                    </a>

                                  </li>

                              </ul>

                        </li>
                         
                      </ul>

                </li>

            </ul>
        </li>

      <!-- logistic -->

  <!-- ~~~~~~~~~~~~~~~~ Start : Property Rental ~~~~~~~~~~ -->

         <li class="<?php if(Request::segment(3) =='add-billing-schedule' || Request::segment(3) =='view-billing-schedule' || Request::segment(3) === 'rent-bill-posting'){echo "active";} ?>">

            <a href="#">

              <i class="fa fa-plus" style="color:antiquewhite;"></i> Property Rental Utility

              <i class="fa fa-angle-left pull-right"></i>

            </a>

    <!-- ~~~~~ Start : Billing Schedule ~~~~~~~~~ -->

            <ul class="treeview-menu">

               <li class="<?php if(Request::segment(3) =='add-billing-schedule' || Request::segment(3) =='view-billing-schedule'){echo "active";}?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> Billing Schedule

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                  <ul class="treeview-menu">
           
                    <li class="<?php if(Request::segment(3) =='add-billing-schedule'){echo "active";}?>">

                      <a href="{{ url('/transaction/property-rental-utility/add-billing-schedule') }}">

                           <i class="fa fa-circle-o text-yellow"></i>
                            Add Billing Schedule
                      </a>
                    </li>
                    <li class="<?php if(Request::segment(3) =='view-billing-schedule'){echo "active";}?>">
                      <a href="{{ url('/transaction/property-rental-utility/view-billing-schedule') }}">

                       <i class="fa fa-circle-o text-red"></i>
                     
                       View Billing Schedule
                      </a>
                      
                    </li>

                  </ul>

                </li>

          <!-- ~~~~~~~~~~ Start : Rent Bill Posting ~~~~~~~~~ -->

                <li class="<?php if(Request::segment(3) === 'rent-bill-posting'){ echo "active";}    ?>">

                  <a href="{{ url('/transaction/property-rental-utility/rent-bill-posting') }}"><i class="fa fa-circle-o text-aqua"></i>  Rent Bill Posting

                  </a>

                </li>

          <!-- ~~~~~~~~ End : Rent Bill Posting ~~~~~~~~~ -->

            </ul>

    <!-- ~~~~~~~~~ End : Billing Schedule ~~~~~~~~~ -->


   


        </li>

<!-- ~~~~~~~~~~~~~~~~ End : Property Rental ~~~~~~~~~~ -->




       <li>

          <a href="#">

            <i class="fa fa-plus" style="color:antiquewhite;"></i> Infrastructure

            <i class="fa fa-angle-left pull-right"></i>

          </a>

          <ul class="treeview-menu">

            <li class="<?php if(Request::segment(1) ==='ePOD-transaction' || Request::segment(1) ==='view-ePOD-transaction'){echo "active";} ?>">

              <a href="#"><i class="fa fa-plus text-aqua"></i>Unit Sale Tran
                <i class="fa fa-angle-left pull-right"></i>
              </a>

              <ul class="treeview-menu">
                  
                <li class="<?php if(Request::segment(1) ==='ePOD-transaction'){echo "active";} ?>">

                  <a href="{{ url('Transaction/Infrastructure/Add-Unit-Sale-Tran')}}">

                    <i class="fa fa-circle-o text-yellow"></i>

                    Add Unit Sale Tran <span style="display: none;">MIT0</span>

                  </a>

                </li> 

                <li class="<?php if(Request::segment(1) ==='view-ePOD-transaction'){echo "active";} ?>">

                  <a href="{{ url('Transaction/Infrastructure/View-Unit-Sale-Tran')}}">

                    <i class="fa fa-circle-o text-red"></i> 

                    View Unit Sale Tran <span style="display: none;">MIT0</span>

                  </a>

                </li>

              </ul>

            </li>

            <li class="<?php if(Request::segment(3) ==='Add-project-budget-tranasction' || Request::segment(3) ==='view-project-budget-tranasction'){echo "active";} ?>">

              <a href="#"><i class="fa fa-plus text-aqua"></i>Project Budget Tran 
                <i class="fa fa-angle-left pull-right"></i>
              </a>

              <ul class="treeview-menu">
                  
                <li class="<?php if(Request::segment(3) ==='Add-project-budget-tranasction'){echo "active";} ?>">

                  <a href="{{ url('Transaction/Infrastructure/Add-project-budget-tranasction')}}">

                    <i class="fa fa-circle-o text-yellow"></i>

                    Add Project Budget Tran <span style="display: none;">MIT0</span>

                  </a>

                </li> 

                <li class="<?php if(Request::segment(3) ==='view-project-budget-tranasction'){echo "active";} ?>">

                  <a href="{{ url('Transaction/Infrastructure/view-project-budget-tranasction')}}">

                    <i class="fa fa-circle-o text-red"></i> 

                    View Project Budget Tran <span style="display: none;">MIT0</span>

                  </a>

                </li>

              </ul>

            </li>

            <li class="<?php if(Request::segment(3) ==='Add-project-expense-tranasction' || Request::segment(3) ==='view-project-expense-tranasction'){echo "active";} ?>">

              <a href="#"><i class="fa fa-plus text-aqua"></i>Project Expense Tran 
                <i class="fa fa-angle-left pull-right"></i>
              </a>

              <ul class="treeview-menu">
                  
                <li class="<?php if(Request::segment(3) ==='Add-project-expense-tranasction'){echo "active";} ?>">

                  <a href="{{ url('Transaction/Infrastructure/Add-project-expense-tranasction')}}">

                    <i class="fa fa-circle-o text-yellow"></i>

                    Add Project Expense Tran <span style="display: none;">MIT0</span>

                  </a>

                </li> 

                <li class="<?php if(Request::segment(3) ==='view-project-expense-tranasction'){echo "active";} ?>">

                  <a href="{{ url('Transaction/Infrastructure/view-project-expense-tranasction')}}">

                    <i class="fa fa-circle-o text-red"></i> 

                    View Project Expense Tran <span style="display: none;">MIT0</span>

                  </a>

                </li>

              </ul>

            </li>

          </ul><!--  /. first ul -->

        </li><!-- /.infrastructure li -->
        
        <!--  -----LOAN HUNDI ------ -->

        <li class="<?php if(Request::segment(3) ==='Add-loan-hundi-Tran' || Request::segment(3) ==='view-loan-hundi-Tran'){echo "active";} ?>">

          <a href="#">

            <i class="fa fa-plus" style="color:antiquewhite;"></i> Loan & Hundi

            <i class="fa fa-angle-left pull-right"></i>

          </a>

          <ul class="treeview-menu">

            <li class="<?php if(Request::segment(3) ==='Add-loan-hundi-Tran' || Request::segment(3) ==='view-loan-hundi-Tran' || Request::segment(3) === 'create-interest-schedule'){echo "active";} ?>">

              <a href="#"><i class="fa fa-plus text-aqua"></i>Loan & Hundi Tran
                <i class="fa fa-angle-left pull-right"></i>
              </a>

              <ul class="treeview-menu">
                  
                <li class="<?php if(Request::segment(3) ==='Add-loan-hundi-Tran'){echo "active";} ?>">

                  <a href="{{ url('Transaction/LoanAndHundi/Add-loan-hundi-Tran')}}">

                    <i class="fa fa-circle-o text-yellow"></i>

                    Add Loan & Hundi Tran <span style="display: none;">MIT0</span>

                  </a>

                </li> 

                <li class="<?php if(Request::segment(3) ==='view-loan-hundi-Tran'){echo "active";} ?>">

                  <a href="{{ url('Transaction/LoanAndHundi/view-loan-hundi-Tran') }}">

                    <i class="fa fa-circle-o text-red"></i> 

                    View Loan & Hundi Tran <span style="display: none;">MIT0</span>

                  </a>

                </li>

                <li class="<?php if(Request::segment(3) ==='create-interest-schedule'){echo "active";} ?>">

                  <a href="{{ url('Transaction/LoanAndHundi/create-interest-schedule') }}">

                    <i class="fa fa-circle-o text-red"></i> 

                    Create Interest Schedule <span style="display: none;">MIT0</span>

                  </a>

                </li>

              </ul>

            </li>

          </ul><!--  /. first ul -->

        </li><!-- /.infrastructure li -->

        <!--  -----LOAN HUNDI ------ -->

    </ul>

</li>

<?php } ?>

<!---------------- Start Report Menu ---------------------------->
<?php if(Session::get('usertype')=='admin'){ ?>
    
  <li class="treeview <?php if(Request::segment(1) ==='report-cash-bank' || Request::segment(1) ==='report-statement-of-acc' || Request::segment(1) === 'report-contra' || Request::segment(1) === 'journal-trans-report' || Request::segment(3) === 'sale-tran-report' || Request::segment(1) ==='report-acc-ledger' || Request::segment(4) === 'purchase-indent-report' || Request::segment(3) === 'purchase-enquery-report' || Request::segment(3) === 'purchase-quotation-report' || Request::segment(3) === 'purchase-contract-report' || Request::segment(3) === 'purchase-contract-report' || Request::segment(1) ==='report-item-ledger' || Request::segment(1) ==='report-item-stock'|| Request::segment(3) === 'purchase-order-report' || Request::segment(4) ==='grn-report' || Request::segment(3) === 'purchase-bill-report' || Request::segment(4) === 'sale-order-report' || Request::segment(4) ==='sale-quotation-report' || Request::segment(3) ==='store-requistion' || Request::segment(3) ==='store-issue' || Request::segment(3) ==='store-return' || Request::segment(3) === 'gate-entry-purchase-report' || Request::segment(3) ==='gate-pass-return-report' || Request::segment(3) ==='gate-pass-nonreturn-report' || Request::segment(3) ==='bom-report' || Request::segment(3) ==='daily-production-report' || Request::segment(3) ==='wobom-report' || Request::segment(4) ==='indent-pending-complete-report' ||  Request::segment(4) === 'indent-cancel' || Request::segment(4) === 'quotation-pending-complete-report' || Request::segment(4) ==='quotation-cancel' || Request::segment(4) === 'contract-pending-complete-report' || Request::segment(4) ==='contract-cancel' || Request::segment(4) === 'grn-pending-complete-report' || Request::segment(4) ==='grn-cancel' || Request::segment(4) ==='grn-cancel' || Request::segment(3) ==='sales-pgi-challan-report' || Request::segment(4) ==='sale-contract-report' || Request::segment(4) ==='sale-contract-pending-complete-report' || Request::segment(4) ==='sale-contract-cancel-report' || Request::segment(4) === 'sale-order-pending-complete-report' || Request::segment(4) ==='sale-order-cancel-report' || Request::segment(1) === 'report-trial-balence' || Request::segment(4) ==='sale-quotation-pending-complete-report' || Request::segment(4) ==='sale-quotation-cancel-report' || Request::segment(3) ==='store-requistion-pending-complete-report' || Request::segment(3) ==='store-requistion-cancel-report' || Request::segment(4) ==='sale-enquiry-report' || Request::segment(2) ==='dynamic-query' || Request::segment(4) === 'monthly-report' || Request::segment(4) === 'pending-complete-report' || Request::segment(4) === 'monthly-trip-planning-report' || Request::segment(2) === 'Top-Sales' || Request::segment(2) === 'Top-Item' || Request::segment(2) === 'Top-debitors' || Request::segment(2) === 'Top-creditor' || Request::segment(2) === 'Open-Order' || Request::segment(2) === 'Age-Analysis' || Request::segment(2) === 'Score-Card-Defination' || Request::segment(2) === 'Vehical-doc-updation' || Request::segment(2) === 'Trips-status' || Request::segment(3) === 'stock-age-wise-analysis' || Request::segment(3) ==='stock-summary' ||  Request::segment(3) ==='rake-summary'|| Request::segment(3) ==='stock-ledger' || Request::segment(3) ==='grn-inward' || Request::segment(3) ==='dispatch-outward' || Request::segment(3) =='rake-do-summary' || Request::segment(3) =='rake-report' || Request::segment(3) ==='process-item-age' || Request::segment(4) ==='process-item-age' ||Request::segment(4) =='panding-outward'||Request::segment(4) =='chember-report' || Request::segment(3) === 'bank-reconciliation-report' || Request::segment(3) =='export-lr-c-and-f' || Request::segment(3) =='export-do-c-and-f' || Request::segment(3) === 'trip-exp-payment-advice' || Request::segment(3) === 'Trip-compleation-status' || Request::segment(3) =='bank-reconciliation-statement' || Request::segment(3) == 'month-wise-summary-report'){ echo "active";}    ?>">

      <a href="#">
        <i class="fa fa-plus sign1"></i> <span>Report</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>

      <ul class="treeview-menu ulview" style="width: 229px;padding-left: 15px;">


               
  <!--------------- Start Account Report ------------------>


               <li class=" <?php if(Request::segment(1) ==='report-cash-bank' || Request::segment(1) ==='/report-statement-of-acc' || Request::segment(1) === 'report-contra' || Request::segment(1) === 'journal-trans-report' ||  Request::segment(1) ==='report-acc-ledger' || Request::segment(1) === 'report-trial-balence' || Request::segment(3) === 'bank-reconciliation-report' || Request::segment(3) =='bank-reconciliation-statement' || Request::segment(3) == 'month-wise-summary-report'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Account

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>


            <ul class="treeview-menu">


                <li class=" <?php if(Request::segment(1) === 'report-cash-bank'){ echo "active";}    ?>">

                   <a href="{{ url('/report-cash-bank') }}"><i class="fa fa-circle-o text-aqua"></i> Cash Bank Trans <span style="display: none;">RA0</span> 

                  </a>

                </li>

                 <li class=" <?php if(Request::segment(1) === 'report-statement-of-acc'){ echo "active";}    ?>">

                   <a href="{{ url('/report-statement-of-acc') }}"><i class="fa fa-circle-o text-aqua"></i> Statement of Account <span style="display: none;">RA0</span> 

                  </a>

                </li>
                    
                  
                <li class=" <?php if(Request::segment(1) ==='journal-trans-report'){ echo "active";}    ?>">

                  <a href="{{ url('/journal-trans-report') }}">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Journal Trans  <span style="display: none;">RA1</span>

                  </a>

                </li>
                
                <li class=" <?php if(Request::segment(1) === 'report-acc-ledger'){ echo "active";}    ?>">

                     <a href="{{ url('/report-acc-ledger') }}"><i class="fa fa-circle-o text-aqua"></i> GL/Account Ledger <span style="display: none;">RA2</span>

                    </a>

                </li>
               
                <li class="<?php if(Request::segment(1) === 'report-trial-balence'){ echo "active";}    ?>">

                     <a href="{{ url('/report-trial-balence') }}"><i class="fa fa-circle-o text-aqua"></i> Trial Balance <span style="display: none;">RA4</span>

                    </a>

                </li>
                <li class="">

                     <a href="#"><i class="fa fa-circle-o text-aqua"></i> Balance Sheet <span style="display: none;">RA5</span>

                    </a>

                </li>

                <li class="<?php if(Request::segment(3) =='bank-reconciliation-statement' || Request::segment(3) == 'bank-reconciliation-report' || Request::segment(3) == 'month-wise-summary-report'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                     Bank Reconciliation<span style="display: none;">TD0</span>
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">
                                                                                                                                                                                                                                                                                                                    
                      
                      <li class="<?php if(Request::segment(3) =='bank-reconciliation-statement'){echo "active";}?>">
                          <a href="{{ url('/transaction/account/bank-reconciliation-statement') }}">

                           <i class="fa fa-circle-o text-danger"></i>
                         
                           Bank Reco. Statement
                          </a>
                          
                      </li>
                      <li class="<?php if(Request::segment(3) === 'bank-reconciliation-report'){ echo "active";}    ?>">

                         <a href="{{ url('report/account/bank-reconciliation-report') }}"><i class="fa fa-circle-o text-aqua"></i> View Print PassBook <span style="display: none;">RA4</span>

                        </a>

                      </li>
                      <li class="<?php if(Request::segment(3) === 'month-wise-summary-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/account/month-wise-summary-report') }}"><i class="fa fa-circle-o text-aqua"></i> Month Wise Summary (BR) <span style="display: none;">RA4</span>

                          </a>

                      </li>
                   
                  </ul>

                </li>

                <li class="<?php if(Request::segment(3) =='tds-report'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                     Indirect Tax<span style="display: none;">TD0</span>
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">
                                                                                                                                                                                                                                                                                                                    
                      
                      <li class="<?php if(Request::segment(3) =='tds-report'){echo "active";}?>">
                          <a href="{{ url('/report/account/indirect-tax/tds-report') }}">

                           <i class="fa fa-circle-o text-danger"></i>
                         
                           TDS Report
                          </a>
                          
                      </li>
                   
                  </ul>

                </li>

                 <li class=" <?php if(Request::segment(1) === 'report-intrest-ledger'){ echo "active";}    ?>">

                   <a href="{{ url('/report-intrest-ledger') }}"><i class="fa fa-circle-o text-aqua"></i> Interest Ledger <span style="display: none;">RA0</span> 

                  </a>

                </li>

                  
           </ul>

        </li>


  <!--------------- End Account Report ------------------>



  <!--------------- Start Bill Tracking Report ------------------>


              <li class="">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> 
                    Bill Tracking

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>


                  <ul class="treeview-menu">

                    <li class=" <?php if(Request::segment(1) === 'Bill Allocation'){ echo "active";}    ?>">

                         <a href="{{ url('Report/BillTracking/Bill-Allocation') }}"><i class="fa fa-circle-o text-aqua"></i>Bill Allocation <span style="display: none;">RB0</span>

                        </a>

                    </li>

                    <li class=" <?php if(Request::segment(1) === 'report-view-customer-vendor-position'){ echo "active";}    ?>">

                         <a href="{{url('view-customer-vendor/position')}}"><i class="fa fa-circle-o text-aqua"></i>View Customer/Vendor Position <span style="display: none;">RB0</span>

                        </a>

                    </li>

                    <li class=" <?php if(Request::segment(1) === 'report-pending-bills-payments'){ echo "active";}    ?>">

                         <a href="{{ url('report-pending-complete-bill-payment') }}"><i class="fa fa-circle-o text-aqua"></i>Pending Bills/Payments <span style="display: none;">RB0</span>

                        </a>

                    </li>

                    <li class=" <?php if(Request::segment(1) === 'report-MIS-report'){ echo "active";}    ?>">

                         <a href="#"><i class="fa fa-circle-o text-aqua"></i>MIS <span style="display: none;">RB0</span>

                        </a>

                    </li>

                    <li class=" <?php if(Request::segment(1) === 'report-age-analysis'){ echo "active";}    ?>">

                         <a href="#"><i class="fa fa-circle-o text-aqua"></i> Age Analysis <span style="display: none;">RB0</span>

                        </a>

                    </li>

                    <li class=" <?php if(Request::segment(1) === 'report-acc-ledger'){ echo "active";}    ?>">

                         <a href="#"><i class="fa fa-circle-o text-aqua"></i> Payment Reminder Latter <span style="display: none;">RB0</span>

                        </a>

                    </li>

                  </ul>

              </li>


    <!--------------- End Bill Tracking Report ------------------>




    <!--------------- Start Sales Report ------------------>


              <li class=" <?php if(Request::segment(4) === 'sale-order-report' || Request::segment(4) ==='sale-quotation-report' || Request::segment(3) === 'sale-tran-report' || Request::segment(3) ==='sales-pgi-challan-report' || Request::segment(4) ==='sale-contract-report' || Request::segment(4) ==='sale-contract-pending-complete-report' || Request::segment(4) ==='sale-contract-cancel-report' || Request::segment(4) === 'sale-order-pending-complete-report' || Request::segment(4) ==='sale-order-cancel-report' || Request::segment(4) ==='sale-quotation-pending-complete-report' || Request::segment(4) ==='sale-quotation-cancel-report' || Request::segment(4) ==='sale-enquiry-report'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Sales

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>


                <ul class="treeview-menu">


                  <li class="<?php if(Request::segment(4) ==='sale-enquiry-report' || Request::segment(4) ==='sale-enquiry-pending-complete-report' || Request::segment(4) ==='sale-enquiry-cancel-report'){echo "active";} ?>">

                    <a href="#">

                      <i class="fa fa-plus text-aqua"></i> 
                       Sales Enquiry<span style="display: none;">TD0</span>
                      <i class="fa fa-angle-left pull-right"></i>

                    </a>

                    <ul class="treeview-menu">
                                                                                                                                                                                                                                                                                                                      
                        

                        <li class="<?php if(Request::segment(4) === 'sale-enquiry-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/sales/sale-enquiry/sale-enquiry-report') }}"><i class="fa fa-circle-o text-aqua"></i>Sale Enquiry <span style="display: none;">RP0</span>

                          </a>

                        </li>

                         <!-- <li class="< ?php if(Request::segment(4) === 'sale-contract-pending-complete-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/sales/sale-enquiry/sale-enquiry-pending-complete-report') }}"><i class="fa fa-circle-o text-yellow"></i> Pending/Complete Enq. <span style="display: none;">RP0</span>

                          </a>

                        </li> -->
 
                       <!--  <li class="< ?php if(Request::segment(4) ==='sale-contract-cancel-report'){echo "active";} ?>">

                              <a href="{{ url('/report/sales/sale-enquiry/sale-enquiry-cancel-report') }}">

                                <i class="fa fa-circle-o text-red"></i> 

                              Cancel Sale Enquiry <span style="display: none;">TP4</span>

                              </a>

                        </li> -->

                    </ul>

                  </li>

              <!------  Start: Sale Quotation Report ---->
            
                 
                  <li class="<?php if(Request::segment(4) ==='sale-quotation-report' || Request::segment(4) ==='sale-quotation-pending-complete-report' || Request::segment(4) ==='sale-quotation-cancel-report'){echo "active";} ?>">

                    <a href="#">

                      <i class="fa fa-plus text-aqua"></i> 
                       Sales Quotation<span style="display: none;">TD0</span>
                      <i class="fa fa-angle-left pull-right"></i>

                    </a>

                    <ul class="treeview-menu">
                                                                                                                                                                                                                                                                                                                      
                        

                        <li class=" <?php if(Request::segment(4) === 'sale-quotation-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/sales/sale-quotation/sale-quotation-report') }}"><i class="fa fa-circle-o text-aqua"></i> Sales Quotation <span style="display: none;">RP0</span>

                          </a>

                        </li>

                        <li class=" <?php if(Request::segment(4) === 'sale-quotation-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/sales/sale-quotation-monthly/sale-quotation-monthly-report') }}"><i class="fa fa-circle-o text-aqua"></i> Sales Quotation Monthly <span style="display: none;">RP0</span>

                          </a>

                        </li>

                      <!--   <li class=" < ?php if(Request::segment(4) === 'sale-contract-pending-complete-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/sales/sale-quotation/sale-quotation-pending-complete-report') }}"><i class="fa fa-circle-o text-yellow"></i> Pending/Complete Qut. <span style="display: none;">RP0</span>

                          </a>

                        </li>
 -->
                        <li class="<?php if(Request::segment(4) ==='sale-contract-cancel-report'){echo "active";} ?>">

                              <a href="{{ url('/report/sales/sale-quotation/sale-quotation-cancel-report') }}">

                                <i class="fa fa-circle-o text-red"></i> 

                              Cancel Sale Quotation <span style="display: none;">TP4</span>

                              </a>

                        </li>

                    </ul>

                  </li>

              <!------  End: Sale Quotation Report ---->


              <!------  Start: Sale Contract Report ---->

                  <li class="<?php if(Request::segment(4) ==='sale-contract-report' || Request::segment(4) ==='sale-contract-pending-complete-report' || Request::segment(4) ==='sale-contract-cancel-report'){echo "active";} ?>">

                    <a href="#">

                      <i class="fa fa-plus text-aqua"></i> 
                       Sales Contract<span style="display: none;">TD0</span>
                      <i class="fa fa-angle-left pull-right"></i>

                    </a>

                    <ul class="treeview-menu">
                                                                                                                                                                                                                                                                                                                      
                        

                        <li class=" <?php if(Request::segment(4) === 'sale-contract-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/sales/sale-contract/sale-contract-report') }}"><i class="fa fa-circle-o text-aqua"></i> Sale Contract <span style="display: none;">RP0</span>

                          </a>

                        </li>

                         <li class=" <?php if(Request::segment(4) === 'sale-quotation-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/sales/sale-contract-monthly/sale-contract-monthly-report') }}"><i class="fa fa-circle-o text-aqua"></i>  Monthly Sale Contract <span style="display: none;">RP0</span>

                          </a>

                        </li>

                        <!-- <li class=" < ?php if(Request::segment(4) === 'sale-contract-pending-complete-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/sales/sale-contract/sale-contract-pending-complete-report') }}"><i class="fa fa-circle-o text-yellow"></i> Pending/Complete Cnt. <span style="display: none;">RP0</span>

                          </a>

                        </li> -->

                        <li class="<?php if(Request::segment(4) ==='sale-contract-cancel-report'){echo "active";} ?>">

                              <a href="{{ url('/report/sales/sale-contract/sale-contract-cancel-report') }}">

                                <i class="fa fa-circle-o text-red"></i> 

                              Cancel Sale Contract <span style="display: none;">TP4</span>

                              </a>

                        </li>

                    </ul>

                  </li>


              <!------  End: Sale Contract Report ---->


              <!------  Start: Sale Contract Report ---->

                  <li class="<?php if(Request::segment(4) ==='sale-order-report' || Request::segment(4) === 'sale-order-pending-complete-report' || Request::segment(4) ==='sale-order-cancel-report'){echo "active";} ?>">

                    <a href="#">

                      <i class="fa fa-plus text-aqua"></i> 
                       Sales Order<span style="display: none;">TD0</span>
                      <i class="fa fa-angle-left pull-right"></i>

                    </a>

                    <ul class="treeview-menu">
                                                                                                                                                                                                                                                                                                                      
                        

                        <li class=" <?php if(Request::segment(4) === 'sale-order-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/sales/sale-order/sale-order-report') }}"><i class="fa fa-circle-o text-aqua"></i> Sale Order <span style="display: none;">RP0</span>

                          </a>

                        </li>

                        <li class=" <?php if(Request::segment(4) === 'sale-quotation-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/sales/sale-order-monthly/sale-order-monthly-report') }}"><i class="fa fa-circle-o text-aqua"></i>  Monthly Sale Order <span style="display: none;">RP0</span>

                          </a>

                        </li>

                       <!--  <li class=" < ?php if(Request::segment(4) === 'sale-order-pending-complete-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/sales/sale-order/sale-order-pending-complete-report') }}"><i class="fa fa-circle-o text-yellow"></i> Pending/Complete Ord. <span style="display: none;">RP0</span>

                          </a>

                        </li> -->

                        <li class="<?php if(Request::segment(4) ==='sale-order-cancel-report'){echo "active";} ?>">

                              <a href="{{ url('/report/sales/sale-contract/sale-order-cancel-report') }}">

                                <i class="fa fa-circle-o text-red"></i> 

                              Cancel Sale Order <span style="display: none;">TP4</span>

                              </a>

                        </li>

                    </ul>

                  </li>



                   <li class="<?php if(Request::segment(4) ==='sales-pgi-challan-report'){echo "active";} ?>">

                    <a href="#">

                      <i class="fa fa-plus text-aqua"></i> 
                       Delivery Challan<span style="display: none;">TD0</span>
                      <i class="fa fa-angle-left pull-right"></i>

                    </a>

                    <ul class="treeview-menu">
                                                                                                                                                                                                                                                                                                                      
                        

                        <li class="<?php if(Request::segment(3) ==='sales-pgi-challan-report'){ echo "active";}    ?>">

                            <a href="{{ url('/report/sales/sales-pgi-challan-report') }}">

                              <i class="fa fa-circle-o text-aqua"></i> 

                              PGI/Delivery Challan <span style="display: none;">RS4</span>

                            </a>

                        </li>



                        <li class=" <?php if(Request::segment(4) === 'sale-chllan-monthly-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/sales/sale-challan-monthly/sale-challan-monthly-report') }}"><i class="fa fa-circle-o text-aqua"></i>  Monthly PGI/Delivery <span style="display: none;">RP0</span>

                          </a>

                        </li>

                     
                    </ul>

                  </li>

              <!------  End: Sale Contract Report ---->

                 

                  


                  <li class="<?php if(Request::segment(4) ==='sales-pgi-challan-report'){echo "active";} ?>">

                    <a href="#">

                      <i class="fa fa-plus text-aqua"></i> 
                       Sales Bill<span style="display: none;">TD0</span>
                      <i class="fa fa-angle-left pull-right"></i>

                    </a>

                    <ul class="treeview-menu">
                                                                                                                                                                                                                                                                                                                      
                        

                        <li class="<?php if(Request::segment(3) ==='sale-tran-report'){ echo "active";}    ?>">

                            <a href="{{ url('/report/sales/sale-tran-report') }}">

                              <i class="fa fa-circle-o text-aqua"></i> 

                              Sales Bill <span style="display: none;">RS4</span>

                            </a>

                          </li>



                        <li class=" <?php if(Request::segment(4) === 'sale-bill-monthly-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/sales/sale-bill-monthly/sale-bill-monthly-report') }}"><i class="fa fa-circle-o text-aqua"></i>  Monthly Sales Bill <span style="display: none;">RP0</span>

                          </a>

                        </li>

                     
                    </ul>

                  </li>

                

                  <li class=" <?php if(Request::segment(1) === 'report-acc-ledger'){ echo "active";}    ?>">

                       <a href="#"><i class="fa fa-circle-o text-aqua"></i> Delivery Advice  <span style="display: none;">RS5</span>

                      </a>

                  </li>

                  <li class=" <?php if(Request::segment(1) === 'report-acc-ledger'){ echo "active";}    ?>">

                       <a href="#"><i class="fa fa-circle-o text-aqua"></i> Debit Note <span style="display: none;">RS6</span>

                      </a>

                  </li>

                </ul>

              </li>


    <!--------------- End Sales Report ------------------>



    <!--------------- Start Purchase Report ---------------->
               
                 
          <li class=" <?php if(Request::segment(4) === 'purchase-indent-report' || Request::segment(3) === 'purchase-enquery-report' || Request::segment(3) === 'purchase-quotation-report' || Request::segment(3) === 'purchase-contract-report' || Request::segment(3) === 'purchase-order-report' || Request::segment(4) ==='grn-report' || Request::segment(3) === 'purchase-bill-report' || Request::segment(4) === 'indent-pending-complete-report' ||  Request::segment(4) === 'indent-cancel' || Request::segment(4) === 'quotation-pending-complete-report' || Request::segment(4) ==='quotation-cancel' || Request::segment(4) === 'contract-pending-complete-report' || Request::segment(4) ==='contract-cancel' || Request::segment(4) === 'grn-pending-complete-report' || Request::segment(4) ==='grn-cancel' || Request::segment(4) ==='grn-cancel'){echo "active";} ?>">
 
              <a href="#">

                <i class="fa fa-plus" style="color:antiquewhite;"></i> Purchase

                <i class="fa fa-angle-left pull-right"></i>

              </a>


            <ul class="treeview-menu">

              <!------  Start: Purchase Indent ---->

                <li class="<?php if(Request::segment(4) === 'indent-pending-complete-report' || Request::segment(4) === 'purchase-indent-report' ||  Request::segment(4) === 'indent-cancel'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                     Purchase Indent<span style="display: none;">TD0</span>
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                      

                      <li class=" <?php if(Request::segment(4) === 'purchase-indent-report'){ echo "active";}    ?>">

                         <a href="{{ url('/report/purchase/purchase-indent/purchase-indent-report') }}"><i class="fa fa-circle-o text-aqua"></i> Purchase Indent <span style="display: none;">RP0</span>

                        </a>

                      </li>

                       <!-- <li class=" < ?php if(Request::segment(4) === 'indent-pending-complete-report'){ echo "active";}    ?>">

                         <a href="{{ url('/report/purchase/purchase-indent/indent-pending-complete-report') }}"><i class="fa fa-circle-o text-yellow"></i> Pending/Complete Ind. <span style="display: none;">RP0</span>

                        </a>

                      </li> -->
                      <li class="<?php if(Request::segment(4) ==='indent-cancel'){echo "active";} ?>">

                            <a href="{{ url('/report/purchase/purchase-indent/indent-cancel') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            Cancel Indent <span style="display: none;">TP4</span>

                            </a>

                      </li>

                  </ul>

                </li>


              <!------  End: Purchase Indent ---->


              <!------  Start: Purchase Enquery ---->


              <li class=" <?php if(Request::segment(3) === 'purchase-enquery-report'){ echo "active";}    ?>">

                     <a href="{{ url('/report/purchase/purchase-enquery-report') }}"><i class="fa fa-circle-o text-aqua"></i> Purchase Enquiry <span style="display: none;">RP0</span>

                    </a>

              </li>

              <!------  End: Purchase Enquery ---->


              
              <!------  Start: Purchase Quotation ---->

                <li class="<?php if(Request::segment(3) ==='purchase-quotation-report' || Request::segment(4) === 'quotation-pending-complete-report' || Request::segment(4) ==='quotation-cancel'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                     Purchase Quotation<span style="display: none;">TD0</span>
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                      

                      <li class=" <?php if(Request::segment(3) ==='purchase-quotation-report'){ echo "active";}    ?>">

                         <a href="{{ url('/report/purchase/purchase-quotation-report') }}"><i class="fa fa-circle-o text-aqua"></i> Purchase Quotation <span style="display: none;">RP0</span>

                        </a>

                      </li>

                      <li class=" <?php if(Request::segment(4) === 'purchase-quotation-monthly-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/purchase/purchase-quotation-monthly/purchase-quotation-monthly-report') }}"><i class="fa fa-circle-o text-aqua"></i>  Monthly Purchase Quo. <span style="display: none;">RP0</span>

                          </a>

                        </li>


                      <!------ <li class=" <?php if(Request::segment(4) === 'quotation-pending-complete-report'){ echo "active";}    ?>">

                         <a href="{{ url('/report/purchase/purchase-quotation/quotation-pending-complete-report') }}"><i class="fa fa-circle-o text-yellow"></i> Pending/Complete Quo. <span style="display: none;">RP0</span>

                        </a>

                      </li> ---->

                      <li class="<?php if(Request::segment(4) ==='quotation-cancel'){echo "active";} ?>">

                            <a href="{{ url('/report/purchase/purchase-quotation/quotation-cancel') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            Cancel Quotation <span style="display: none;">TP4</span>

                            </a>

                      </li>

                  </ul>

                </li>



                <!------  End: Purchase Quotation ---->



                <!------  Start: Purchase Contract ---->

                <li class="<?php if(Request::segment(3) === 'purchase-contract-report' || Request::segment(4) === 'contract-pending-complete-report' || Request::segment(4) ==='contract-cancel'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                     Purchase Contract<span style="display: none;">TD0</span>
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                      

                      <li class=" <?php if(Request::segment(3) === 'purchase-contract-report'){ echo "active";}    ?>">

                        <a href="{{ url('/report/purchase/purchase-contract-report') }}"><i class="fa fa-circle-o text-aqua"></i> Purchase Contract <span style="display: none;">RP2</span>

                        </a>

                      </li>

                       <li class=" <?php if(Request::segment(4) === 'purchase-contract-monthly-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/purchase/purchase-contract-monthly/purchase-contract-monthly-report') }}"><i class="fa fa-circle-o text-aqua"></i>  Monthly Purchase Contract <span style="display: none;">RP2</span>

                          </a>

                        </li>

                      <!-- <li class=" < ?php if(Request::segment(4) === 'contract-pending-complete-report'){ echo "active";}    ?>">

                         <a href="{{ url('/report/purchase/purchase-contract/contract-pending-complete-report') }}"><i class="fa fa-circle-o text-yellow"></i> Pending/Complete Cont. <span style="display: none;">RP0</span>

                        </a>

                      </li> -->

                      <li class="<?php if(Request::segment(4) ==='contract-cancel'){echo "active";} ?>">

                            <a href="{{ url('/report/purchase/purchase-contract/contract-cancel') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            Cancel Contract <span style="display: none;">TP4</span>

                            </a>

                      </li>

                    <!------  <li class="<?php if(Request::segment(4) ==='contract-cancel'){echo "active";} ?>">

                            <a href="{{ url('/report/purchase/purchase-contract/contract-demo') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                             Contract Demo<span style="display: none;">TP4</span>

                            </a>

                      </li> ---->

                  </ul>

                </li>


                <!------  End: Purchase Contract ---->



                <!------  Start: Purchase Order ---->


                <li class="<?php if(Request::segment(3) === 'purchase-order-report' || Request::segment(4) === 'order-pending-complete-report' || Request::segment(4) ==='order-cancel' || Request::segment(4) ==='order-cancel'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                     Purchase Order<span style="display: none;">TD0</span>
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                      


                      <li class=" <?php if(Request::segment(3) === 'purchase-order-report'){ echo "active";}    ?>">

                        <a href="{{ url('/report/purchase/purchase-order-report') }}"><i class="fa fa-circle-o text-aqua"></i> Purchase Order <span style="display: none;">RP2</span>

                        </a>

                      </li>


                      <li class=" <?php if(Request::segment(4) === 'purchase-order-monthly-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/purchase/purchase-order-monthly/purchase-order-monthly-report') }}"><i class="fa fa-circle-o text-aqua"></i>  Monthly Purchase Order <span style="display: none;">RP2</span>

                          </a>

                        </li>




                      <li class=" <?php if(Request::segment(4) === 'order-pending-complete-report'){ echo "active";}    ?>">

                         <a href="{{ url('/report/purchase/purchase-order/order-pending-complete-report') }}"><i class="fa fa-circle-o text-yellow"></i> Pending/Complete Ord. <span style="display: none;">RP0</span>

                        </a>

                      </li> 

                      <li class="<?php if(Request::segment(4) ==='order-cancel'){echo "active";} ?>">

                            <a href="{{ url('/report/purchase/purchase-order/order-cancel') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                            Cancel Order <span style="display: none;">TP4</span>

                            </a>

                      </li>

                  </ul>

                </li>


                <!------  End: Purchase Order ---->


                <!------  Start: Purchase GRN ---->


                <li class="<?php if(Request::segment(4) === 'grn-report' || Request::segment(4) === 'grn-pending-complete-report' || Request::segment(4) ==='grn-cancel' || Request::segment(4) ==='grn-cancel'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                     Good Receipt Note <span style="display: none;">TD0</span>
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                      

                      <li class=" <?php if(Request::segment(4) === 'grn-report'){ echo "active";}    ?>">

                        <a href="{{ url('/report/purchase/purchase-grn/grn-report') }}"><i class="fa fa-circle-o text-aqua"></i> Good Receipt Not  <span style="display: none;">RP2</span>

                        </a>

                      </li>

                       <li class=" <?php if(Request::segment(4) === 'purchase-grn-monthly-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/purchase/purchase-grn-monthly/purchase-grn-monthly-report') }}"><i class="fa fa-circle-o text-aqua"></i>  Monthly GRN <span style="display: none;">RP2</span>

                          </a>

                        </li>

                      <li class=" <?php if(Request::segment(4) === 'grn-pending-complete-report'){ echo "active";}    ?>">

                         <a href="{{ url('/report/purchase/purchase-grn/grn-pending-complete-report') }}"><i class="fa fa-circle-o text-yellow"></i> Pending/Complete GRN. <span style="display: none;">RP0</span>

                        </a>

                      </li>

                      

                    </ul>

                  </li>


                <!------  End: Purchase GRN ---->


                <!------  Start: Purchase Bill ---->

          <li class="<?php if(Request::segment(4) === 'grn-report' || Request::segment(4) === 'grn-pending-complete-report' || Request::segment(4) ==='grn-cancel' || Request::segment(4) ==='grn-cancel'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                     Purchase Bill  <span style="display: none;">TD0</span>
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

               <ul class="treeview-menu">

                <li class=" <?php if(Request::segment(3) === 'purchase-bill-report'){ echo "active";}    ?>">

                  <a href="{{ url('/report/purchase/purchase-bill-report') }}"><i class="fa fa-circle-o text-aqua"></i> Purchase Bill <span style="display: none;">RP2</span>

                  </a>

                </li>

                 <li class=" <?php if(Request::segment(4) === 'purchase-bill-monthly-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/purchase/purchase-bill-monthly/purchase-bill-monthly-report') }}"><i class="fa fa-circle-o text-aqua"></i>  Monthly Purchase Bill <span style="display: none;">RP2</span>

                          </a>

                  </li>

                </ul>
              </li>

                <!------  End: Purchase Bill ---->


                <!------  Start: Purchase Credit Note ---->

                <li class=" <?php if(Request::segment(1) === 'report-acc-ledger'){ echo "active";}    ?>">

                     <a href="#"><i class="fa fa-circle-o text-aqua"></i> Credit Note <span style="display: none;">RP6</span>

                    </a>

                </li>

                <!------  End: Purchase Credit Note ---->

            </ul>

          </li>


  <!--------------- End Purchase Report ------------------>




  <!--------------- Start Store Report ------------------>


          <li class="<?php if(Request::segment(3) ==='store-requistion' || Request::segment(3) ==='store-issue' || Request::segment(3) ==='store-return' || Request::segment(3) ==='store-requistion-pending-complete-report' || Request::segment(3) ==='store-requistion-cancel-report'){echo "active";} ?>">

            <a href="#">

              <i class="fa fa-plus" style="color:antiquewhite;"></i> Store

              <i class="fa fa-angle-left pull-right"></i>

            </a>

              <ul class="treeview-menu">

                <!------  Start: Store Requisition Report ---->
            
                 
                  <li class="<?php if(Request::segment(3) ==='store-requistion' || Request::segment(3) ==='store-requistion-pending-complete-report' || Request::segment(3) ==='store-requistion-cancel-report'){echo "active";} ?>">

                    <a href="#">

                      <i class="fa fa-plus text-aqua"></i> 
                       Store Requisition<span style="display: none;">TD0</span>
                      <i class="fa fa-angle-left pull-right"></i>

                    </a>

                    <ul class="treeview-menu">
                                                                                                                                                                                                                                                                                                                      
                        

                        <li class=" <?php if(Request::segment(3) === 'store-requistion'){ echo "active";}    ?>">

                           <a href="{{ url('/report/store/store-requistion') }}"><i class="fa fa-circle-o text-aqua"></i> Store Requisition <span style="display: none;">RP0</span>

                          </a>

                        </li>

                        <li class=" <?php if(Request::segment(3) === 'store-requistion-pending-complete-report'){ echo "active";}    ?>">

                           <a href="{{ url('/report/store/store-requistion-pending-complete-report') }}"><i class="fa fa-circle-o text-yellow"></i> Pending/Complete Req. <span style="display: none;">RP0</span>

                          </a>

                        </li>

                        <li class="<?php if(Request::segment(3) ==='store-requistion-cancel-report'){echo "active";} ?>">

                              <a href="{{ url('/report/store/store-requistion-cancel-report') }}">

                                <i class="fa fa-circle-o text-red"></i> 

                              Cancel Store Req. <span style="display: none;">TP4</span>

                              </a>

                        </li>

                    </ul>

                  </li>

              <!------  End: Store Requisition Report ---->

                <li class="<?php if(Request::segment(3) ==='store-issue'){ echo "active"; } ?>">

                    <a href="{{ url('/report/store/store-issue') }}">

                        <i class="fa fa-circle-o text-aqua"></i> 
                       
                         Store Issue <span style="display: none;">TD1</span>

                        <i class="fa fa-angle-left pull-right"></i>

                      </a>
                      
                </li>

                <li class="<?php if(Request::segment(3) ==='store-return'){ echo "active"; } ?>">

                    <a href="{{ url('/report/store/store-return') }}">

                        <i class="fa fa-circle-o text-aqua"></i> 
                       
                         Store Return <span style="display: none;">TD1</span>

                        <i class="fa fa-angle-left pull-right"></i>

                      </a>
                      
                </li>

              </ul>

          </li>


    <!--------------- End Store Report ------------------>



  <!--------------- Start Production Report ------------------>


          <li class=" <?php if(Request::segment(3) ==='bom-report' || Request::segment(3) ==='daily-production-report' || Request::segment(3) ==='wobom-report'){echo "active";} ?>">

            <a href="#">

              <i class="fa fa-plus" style="color:antiquewhite;"></i> Production

              <i class="fa fa-angle-left pull-right"></i>

            </a>


            <ul class="treeview-menu">

                <li class=" <?php if(Request::segment(3) === 'bom-report'){ echo "active";}    ?>">

                     <a href="{{ url('/report/production/bom-report') }}">
                      <i class="fa fa-circle-o text-aqua"></i>  BOM/WBOM <span style="display: none;">RD0</span>

                    </a>

                </li>
           
            
                <li class=" <?php if(Request::segment(3) === 'daily-production-report'){ echo "active";}    ?>">

                     <a href="{{ url('/report/production/daily-production-report') }}">
                      <i class="fa fa-circle-o text-aqua"></i> Daily Production <span style="display: none;">RD0</span>

                    </a>

                </li>
                  
            </ul>

          </li>


  <!------------- End Production Report ---------------->



  <!------------- Start Gate Entry Report ---------------->



          <li class=" <?php if(Request::segment(3) === 'gate-entry-purchase-report' || Request::segment(3) ==='gate-pass-return-report' || Request::segment(3) ==='gate-pass-nonreturn-report'){echo "active";} ?>">

              <a href="#">

                <i class="fa fa-plus" style="color:antiquewhite;"></i> Gate Entry

                <i class="fa fa-angle-left pull-right"></i>

              </a>


            <ul class="treeview-menu">

           
            
                <li class=" <?php if(Request::segment(3) === 'gate-entry-purchase-report'){ echo "active";}    ?>">

                     <a href="{{ url('/report/gate-entry/gate-entry-purchase-report') }}">
                      <i class="fa fa-circle-o text-aqua"></i> Gate Entry Purchase <span style="display: none;">RG0</span>

                    </a>

                </li>
                    
                  
                <li class=" <?php if(Request::segment(3) ==='gate-pass-return-report'){ echo "active";}    ?>">

                  <a href="{{ url('/report/gate-entry/gate-pass-return-report') }}">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Gate Pass <span style="display: none;">RG1</span>

                  </a>

                </li>


           </ul>

        </li>


  <!------------ End Gate Entry Report --------------->



  <!------------ Start Transfer Report --------------->


          <li class=" <?php if(Request::segment(2) === 'view-contra-transaction' || Request::segment(2) === 'contra-transaction' || Request::segment(3) === 'cash-bank-transaction' || Request::segment(2) === 'view-cash-bank' || Request::segment(3) === 'journal-transaction' || Request::segment(2) === 'view-journal-transaction' || Request::segment(3) ==='sales-transaction' || Request::segment(3) ==='view-sales-transaction' || Request::segment(3) ==='view-sales-order-transaction' || Request::segment(3) ==='sales-order-transaction' || Request::segment(3) ==='purchase-order-transaction' || Request::segment(3) ==='view-purchase-order-transaction' || Request::segment(3) ==='purchase-transaction' || Request::segment(3) ==='view-purchase-transaction'){echo "active";} ?>">

              <a href="#">

                <i class="fa fa-plus" style="color:antiquewhite;"></i> Stock Transfer

                <i class="fa fa-angle-left pull-right"></i>

              </a>


              <ul class="treeview-menu">

           
            
                <li class=" <?php if(Request::segment(1) === 'report-acc-ledger'){ echo "active";}    ?>">

                     <a href="#"><i class="fa fa-circle-o text-aqua"></i> Inter Plant <span style="display: none;">RT0</span>

                    </a>

                </li>
                    
                  
                <li class=" <?php if(Request::segment(1) ==='journal-trans-report'){ echo "active";}    ?>">

                  <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Stock adjustment <span style="display: none;">RT1</span>
                  </a>

                </li>

              </ul>

          </li>

  <!------------ End Transfer Report --------------->
  


  <!------------ Start Stock Report --------------->        


          <li class=" <?php if(Request::segment(1) ==='report-item-ledger' || Request::segment(1) ==='report-item-stock' || Request::segment(1) === 'item-age-analysis-report' || Request::segment(3) ==='process-item-age' ){echo "active";} ?>">

              <a href="#">

                <i class="fa fa-plus" style="color:antiquewhite;"></i> Stock / Inventory

                <i class="fa fa-angle-left pull-right"></i>

              </a>


              <ul class="treeview-menu">

           
            
                <li class=" <?php if(Request::segment(1) === 'report-item-ledger'){ echo "active";}    ?>">

                     <a href="{{ url('/report-item-ledger') }}"><i class="fa fa-circle-o text-aqua"></i> Item Ledger <span style="display: none;">RI0</span>

                    </a>

                </li>
                    
                  
                <li class=" <?php if(Request::segment(1) ==='report-item-stock'){ echo "active";}    ?>">

                  <a href="{{ url('/report-item-stock') }}">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Item Stock <span style="display: none;">RI1</span>
                  </a>

                </li>

                <li class="<?php if(Request::segment(3) ==='process-item-age'){ echo "active";}    ?>">

                  <a href="{{ url('/report/stock-inventory/process-item-age') }}">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Process Item Age <span style="display: none;">RI2</span>
                  </a>

                </li>

                
                <li class=" <?php if(Request::segment(1) ==='journal-trans-report'){ echo "active";}    ?>">

                  <a href="{{ url('/reports/stock/stock-age-wise-analysis') }}">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Item Age Analysis <span style="display: none;">RI2</span>
                  </a>

                </li>

              </ul>

          </li>



  <!------------ End Stock Report --------------->  


  <!------------ Start Dynamic Query --------------->        


          <li class=" <?php if(Request::segment(1) ==='create-dynamic-query' || Request::segment(1) ==='view-dynamic-query'){echo "active";} ?>">

              <a href="#">

                <i class="fa fa-plus" style="color:antiquewhite;"></i> Dynamic Query

                <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">
            
                <li class=" <?php if(Request::segment(1) === 'report-dynamic-query'){ echo "active";}    ?>">

                     <a href="{{ url('/report/dynamic-query') }}"><i class="fa fa-circle-o text-aqua"></i> Create Dynamic Query

                    </a>

                </li>
                    
                <li class=" <?php if(Request::segment(1) ==='report-View-Dynamic-query-report'){ echo "active";}    ?>">

                  <a href="{{ url('/Report/View-Dynamic-query-report') }}">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    View Dynamic Query
                  </a>

                </li>

              </ul>

          </li>



  <!------------ End Dynamic Query ---------------> 

    <!--  -------- start infrastructure report ---------- -->

        <li class=" <?php if(Request::segment(1) ==='project-budget-report'){echo "active";} ?>">

            <a href="#">

              <i class="fa fa-plus" style="color:antiquewhite;"></i> Infrastructure

              <i class="fa fa-angle-left pull-right"></i>

            </a>

            <ul class="treeview-menu">
          
              <li class=" <?php if(Request::segment(1) === 'project-budget-report'){ echo "active";}    ?>">

                   <a href="{{ url('/report/infrastructure/project-budget-report') }}"><i class="fa fa-circle-o text-aqua"></i> Project Cost Analysis

                  </a>

              </li>

            </ul>

        </li>

  <!--  -------- end infrastructure report ---------- -->
  
  <!-- ----------Start Cold Storage --- -->

         <li class=" <?php if(Request::segment(1) ==='create-dynamic-query' || Request::segment(1) ==='view-dynamic-query'){echo "active";} ?>">

              <a href="#">

                <i class="fa fa-plus" style="color:antiquewhite;"></i> Cold Storage

                <i class="fa fa-angle-left pull-right"></i>

              </a>

         </li>

  <!-- -------End Cold Storage ----------->

<!-- -------Start C and F ----------- -->

        <li class=" <?php if(Request::segment(3) ==='stock-summary' || Request::segment(3) ==='rake-summary' || Request::segment(3) ==='stock-ledger' || Request::segment(3) ==='grn-inward' || Request::segment(3) ==='dispatch-outward' || Request::segment(3) =='rake-do-summary' || Request::segment(3) =='rake-report'||Request::segment(4) =='panding-outward'||Request::segment(4) =='chember-report' || Request::segment(3) =='export-lr-c-and-f' || Request::segment(3) =='export-do-c-and-f'){echo "active";} ?>">

              <a href="#">

                <i class="fa fa-plus" style="color:antiquewhite;"></i> C and F

                <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">

                <li class="<?php if(Request::segment(3) =='rake-summary' || Request::segment(3) =='rake-report'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i>Rake Report

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                 <ul class="treeview-menu">
                 	 <li class="<?php if(Request::segment(3) =='rake-report'){echo "active";}?>">

                      <a href="{{ url('/report/c_and_f/rake-report') }}">

                           <i class="fa fa-circle-o text-yellow"></i>
                            Rake Report
                      </a>
                    </li>
                    <li class="<?php if(Request::segment(3) === 'rake-summary'){ echo "active";}    ?>">

                         <a href="{{ url('/report/c_and_f/rake-summary') }}"><i class="fa fa-circle-o text-red"></i> Rake Summary
                        </a>

                    </li>
                     <li class="<?php if(Request::segment(3) === 'rake-stock-party-summary'){ echo "active";}    ?>">

                         <a href="{{ url('/report/c-and-f/rake-stock-party-summary') }}"><i class="fa fa-circle-o text-red"></i> Rake Stock Party Summary
                        </a>

                    </li>
                 </ul>
                </li>

                <li class="<?php if(Request::segment(3) =='rake-do-summary'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> Delivery Order

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                  <ul class="treeview-menu">

                    <li class="<?php if(Request::segment(3) =='rake-do-summary'){echo "active";}?>">

                      <a href="{{ url('/report/c-and-f/rake-do-summary') }}">

                           <i class="fa fa-circle-o text-yellow"></i>
                            Rake - DO Summary
                      </a>
                    </li>

                  </ul>

                </li>


                <li class="<?php if(Request::segment(4) =='panding-outward' ||Request::segment(4) =='chember-report'){echo "active";}?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i>Gate Entry

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                 <ul class="treeview-menu">

                     <li class="<?php if(Request::segment(4) =='panding-outward'){echo "active";}?>">

                      <a href="{{ url('/report/c-and-f/gate-entry/panding-outward') }}">

                           <i class="fa fa-circle-o -yellow"></i>
                            Panding Outward
                      </a>
                    </li>

                    <li class="<?php if(Request::segment(4) =='chamber-report'){echo "active";}?>">

                      <a href="{{ url('/report/c-and-f/gate-entry/chamber-report') }}">

                           <i class="fa fa-circle-o -yellow"></i>
                            Chamber Master
                      </a>
                    </li>
                    <li class="<?php if(Request::segment(4) =='watermark-image'){echo "active";}?>">

                      <a href="{{ url('/report/c-and-f/gate-entry/watermark-image') }}">

                           <i class="fa fa-circle-o -yellow"></i>
                            Watermark Image
                      </a>
                    </li>
                   
                 </ul>

                </li>

                <li class="<?php if(Request::segment(3) === 'grn-inward'){ echo "active";}    ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i>Inward Report

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                  <ul class="treeview-menu">
                 	<li class="<?php if(Request::segment(3) === 'grn-inward'){ echo "active";}?>">

                     <a href="{{ url('/report/c_and_f/grn-inward') }}"><i class="fa fa-circle-o text-yellow"></i> GRN - Inward
                    </a>

                   </li>
                 </ul>
                </li>

                <li class="<?php if(Request::segment(3) === 'dispatch-outward'){ echo "active";}    ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i>Outward Report

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                  <ul class="treeview-menu">
                 	
                 	 <li class="<?php if(Request::segment(3) === 'dispatch-outward'){ echo "active";}    ?>">

                     <a href="{{ url('/report/c_and_f/dispatch-outward') }}"><i class="fa fa-circle-o text-yellow"></i> Dispatch - Outward
                     </a>

                    </li>
                  </ul>
                </li>

                <li class="<?php if(Request::segment(3) === 'stock-summary' || Request::segment(3) === 'stock-ledger'){ echo "active";}?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i>Stock Report

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
                  <ul class="treeview-menu">
                 	
                 	<li class="<?php if(Request::segment(3) === 'stock-summary'){ echo "active";}    ?>">

                     <a href="{{ url('/report/c_and_f/stock-summary') }}"><i class="fa fa-circle-o text-yellow"></i> Stock Summary
                     </a>

                    </li>

                    <li class=" <?php if(Request::segment(3) === 'stock-ledger'){ echo "active";}    ?>">

                     <a href="{{ url('/report/c_and_f/stock-ledger') }}"><i class="fa fa-circle-o text-red"></i> Stock Ledger
                     </a>
 
                    </li>

                    <li class="<?php if(Request::segment(3) === 'rake-stock-summary'){ echo "active";}    ?>">

                         <a href="{{ url('/report/c_and_f/get-rake-stock-summary') }}"><i class="fa fa-circle-o text-yellow"></i> Rake Stock Summary
                        </a>

                    </li>
                 </ul>
                </li>

                  <li class="<?php if(Request::segment(3) =='export-do-c-and-f'){echo "active";}?>">
                      <a href="{{ url('/transaction/outward-tran/export-do-c-and-f') }}">

                       <i class="fa fa-circle-o text-aqua"></i>
                     
                       Export DO
                      </a>
                      
                  </li>
            
                  <li class="<?php if(Request::segment(3) =='export-lr-c-and-f'){echo "active";}?>">
                      <a href="{{ url('/transaction/outward-tran/export-lr-c-and-f') }}">

                       <i class="fa fa-circle-o text-yellow"></i>
                     
                       Export LR
                      </a>
                      
                  </li>

                 

              </ul>

          </li>

  <!-- -------End C and F ------------- -->
  <!------------ Start Logistics Report ---------------> 

          <li class=" <?php  if(Request::segment(4) === 'monthly-report' || Request::segment(4) === 'pending-complete-report' || Request::segment(4) === 'monthly-trip-planning-report'){echo "active";} ?>">
 
              <a href="#">

                <i class="fa fa-plus" style="color:antiquewhite;"></i> Logistics

                <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">

              <!------  Start: Purchase Indent ---->

                <li class="<?php if(Request::segment(4) === 'monthly-report' || Request::segment(4) === 'pending-complete-report'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                     Delivery Order<span style="display: none;">TD0</span>
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                   <li class=" <?php if(Request::segment(4) === 'monthly-report'){ echo "active";}    ?>">

                       <a href="{{url('/report/logistic/do-pending/monthly-report')}}"><i class="fa fa-circle-o text-aqua"></i> Monthly Delivery Order <span style="display: none;">RP0</span>

                      </a>

                    </li>

                    <li class="<?php if(Request::segment(4) ==='pending-complete-report'){echo "active";} ?>">

                          <a href="{{url('/report/logistic/do-pending/pending-complete-report')}}">

                            <i class="fa fa-circle-o text-red"></i> 

                          Pending/Complete Rep. <span style="display: none;">TP4</span>

                          </a>

                    </li>

                  </ul>

                </li>
            </ul>

            <ul class="treeview-menu">

              <!------  Start: Purchase Indent ---->

                <li class="<?php if(Request::segment(4) === 'monthly-trip-planning-report'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                     Trip Planning<span style="display: none;">TD0</span>
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                     <li class=" <?php if(Request::segment(4) === 'monthly-trip-planning-report'){ echo "active";}    ?>">

                            <a href="{{url('/report/logistic/trip-planning/monthly-trip-planning-report')}}"><i class="fa fa-circle-o text-aqua"></i> Monthly Trip Planning <span style="display: none;">RP0</span>

                            </a>

                     </li>

                     <li class=" <?php if(Request::segment(4) === 'monthly-trip-planning-report'){ echo "active";}    ?>">

                       <a href="{{url('/report/logistic/trip-planning/daily-trip-plan-report')}}"><i class="fa fa-circle-o text-aqua"></i> Daily Trip Plan <span style="display: none;">RP0</span>

                      </a>

                     </li>

                     <li class=" <?php if(Request::segment(4) === 'daily-trip-expense-report'){ echo "active";}    ?>">

                       <a href="{{url('/report/logistic/trip-planning/daily-trip-expense-report')}}"><i class="fa fa-circle-o text-aqua"></i> Daily Trip Expense <span style="display: none;">RP0</span>

                      </a>

                     </li>


                  </ul>

                </li>

                <li class="<?php if(Request::segment(4) === 'monthly-report' || Request::segment(4) === 'pending-complete-report'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                     Lorry Recipt<span style="display: none;">TD0</span>
                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                   <li class=" <?php if(Request::segment(4) === 'monthly-report'){ echo "active";}    ?>">

                       <a href="{{url('/report/logistic/lorry-receipt')}}"><i class="fa fa-circle-o text-aqua"></i> Lorry Receipt Report <span style="display: none;">RP0</span>

                      </a>

                    </li>

              
                     <li class=" <?php if(Request::segment(4) === 'MIS-REPORT'){ echo "active";}    ?>">

                       <a href="{{url('/REPORT/LOGISTIC/MIS-REPORT')}}"><i class="fa fa-circle-o text-aqua"></i> MIS REPORT<span style="display: none;">RP0</span>

                      </a>

                    </li>


                  </ul>

                </li>
            </ul>

            <ul class="treeview-menu">
              <li class="<?php if(Request::segment(3) === 'stock-age-wise-analysis'){echo "active";} ?>">

                <a href="{{url('/reports/logistic/pending-gate-inward')}}"><i class="fa fa-circle-o text-aqua"></i> Pending Gate Inward <span style="display: none;">RP0</span>

                </a>

              </li>

            </ul>


  </li>

  
<!------------ End Logistics Report ---------------> 



<!------------ Start Desktop Report ---------------> 

          <li class=" <?php  if(Request::segment(2) === 'Top-Sales' || Request::segment(2) === 'Top-Item' || Request::segment(2) === 'Top-debitors' || Request::segment(2) === 'Top-creditor' || Request::segment(2) === 'Open-Order' || Request::segment(2) === 'Age-Analysis' || Request::segment(2) === 'Score-Card-Defination' || Request::segment(2) === 'Vehical-doc-updation' || Request::segment(2) === 'Trips-status' || Request::segment(3) === 'stock-age-wise-analysis' || Request::segment(3) === 'trip-exp-payment-advice' || Request::segment(3) === 'Trip-compleation-status'){echo "active";} ?>">
 
              <a href="#">

                <i class="fa fa-plus" style="color:antiquewhite;"></i> Dashboard

                <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">

                <li class="<?php if(Request::segment(2) === 'Top-Sales'){echo "active";} ?>">

                  <a href="{{url('/Dashboard/Top-Sales')}}"><i class="fa fa-circle-o text-aqua"></i> Top 10 Sales Party <span style="display: none;">RP0</span>

                  </a>

                </li>

                <li class="<?php if(Request::segment(2) === 'Top-Item'){echo "active";} ?>">

                  <a href="{{url('/Dashboard/Top-Item')}}"><i class="fa fa-circle-o text-aqua"></i> Top 10 Sales Item <span style="display: none;">RP0</span>

                  </a>

                </li>

                <li class="<?php if(Request::segment(2) === 'Top-debitors'){echo "active";} ?>">

                  <a href="{{url('/Dashboard/Top-debitors')}}"><i class="fa fa-circle-o text-aqua"></i> Top 10 Debitors Due's <span style="display: none;">RP0</span>

                  </a>

                </li>

                <li class="<?php if(Request::segment(2) === 'Top-creditor'){echo "active";} ?>">

                  <a href="{{url('/Dashboard/Top-creditor')}}"><i class="fa fa-circle-o text-aqua"></i> Top 10 Creditor Due's <span style="display: none;">RP0</span>

                  </a>

                </li>

                <li class="<?php if(Request::segment(2) === 'Open-Order'){echo "active";} ?>">

                  <a href="{{url('/Dashboard/Open-Order')}}"><i class="fa fa-circle-o text-aqua"></i> Top 10 Pending Order <span style="display: none;">RP0</span>

                  </a>

                </li>

                <li class="<?php if(Request::segment(2) === 'Age-Analysis'){echo "active";} ?>">

                  <a href="{{url('/Dashboard/Age-Analysis')}}"><i class="fa fa-circle-o text-aqua"></i> Party Wise Age Analysis <span style="display: none;">RP0</span>

                  </a>

                </li>

                <li class="<?php if(Request::segment(2) === 'Score-Card-Defination'){echo "active";} ?>">

                  <a href="{{url('/Dashboard/Score-Card-Defination')}}"><i class="fa fa-circle-o text-aqua"></i> Score Card <span style="display: none;">RP0</span>

                  </a>

                </li>

                <li class="<?php if(Request::segment(2) === 'Vehical-doc-updation'){echo "active";} ?>">

                  <a href="{{url('/Dashboard/Vehical-doc-updation')}}"><i class="fa fa-circle-o text-aqua"></i> Vehicle Doc. Updation <span style="display: none;">RP0</span>

                  </a>

                </li>

                <li class="<?php if(Request::segment(2) === 'Trips-status'){echo "active";} ?>">

                  <a href="{{url('/Dashboard/Trips-status')}}"><i class="fa fa-circle-o text-aqua"></i> Trips/LR Status <span style="display: none;">RP0</span>

                  </a>

                </li>

                <li class="<?php if(Request::segment(3) === 'stock-age-wise-analysis'){echo "active";} ?>">

                  <a href="{{url('/reports/stock/stock-age-wise-analysis')}}"><i class="fa fa-circle-o text-aqua"></i> Stock Wise Age Analysis <span style="display: none;">RP0</span>

                  </a>

                </li>

                <li class="<?php if(Request::segment(3) === 'Trip-compleation-status'){echo "active";} ?>">

                  <a href="{{url('/transaction/Logistics/Trip-compleation-status')}}"><i class="fa fa-circle-o text-aqua"></i> Trip Status at a Glance <span style="display: none;">RP0</span>

                  </a>

                </li>

                 <li class="<?php if(Request::segment(3) === 'trip-exp-payment-advice'){echo "active";} ?>">

                  <a href="{{url('/transaction/logistics/trip-exp-payment-advice')}}"><i class="fa fa-circle-o text-aqua"></i> Pending for Payment Advice - Market <span style="display: none;">RP0</span>

                  </a>

                </li>


              </ul>


  </li>

  
  <!------------ End Desktop Report ---------------> 


 

    </ul>

  </li>

<?php } ?>

<!---------------- End Report Menu ---------------------------->

<?php if(Session::get('usertype')=='admin'){ ?>

            <li class="treeview <?php if(Request::segment(3) === 'Tax-Mast' || Request::segment(3) === 'View-Tax-Mast' || Request::segment(3) === 'Glsch-Mast' || Request::segment(3) === 'View-Glsch' || Request::segment(3) === 'Gl-Mast' || Request::segment(3) === 'View-Gl-Mast'  || Request::segment(2) === 'tran-tax-mast' || Request::segment(3) === 'view-tran-tax-mast' || Request::segment(3) === 'Department-Mast' || Request::segment(3) === 'View-Department-Mast' ||  Request::segment(3) === 'Gl-Key-Mast' || Request::segment(3) === 'View-Gl-Key-Mast' || Request::segment(3) === 'Item-Class-Mast' || Request::segment(3) === 'View-Item-Class-Mast' ||  Request::segment(3) === 'Item-Type-Mast'|| Request::segment(3) ==='View-Item-Type' || Request::segment(3) ==='Valuation-Mast' || Request::segment(3) ==='View-Valuation-Mast'  || Request::segment(2) ==='form-mast-rack' || Request::segment(2) ==='view-mast-rack' || Request::segment(3) ==='Item-Rack-Mast' || Request::segment(3) ==='View-Item-Rack-Mast' || Request::segment(3) ==='Item-Category-Mast' || Request::segment(3) ==='View-Item-Category-Mast' || Request::segment(3) ==='Item-Group-Mast' || Request::segment(3) ==='View-Item-Group-Mast' || Request::segment(3) ==='Tds-Mast' || Request::segment(3) ==='View-Tds-Mast' || Request::segment(3) ==='Acc-Class' || Request::segment(3) ==='View-Acc-Class' || Request::segment(3) ==='Tds-Rate-Mast' || Request::segment(3) ==='View-Tds-Rate-Mast' || Request::segment(3) ==='Valuation-Tran-Mast' || Request::segment(3) ==='View-Valuation-Tran-Mast' ||  Request::segment(3) ==='Item-Bal-Mast' || Request::segment(3) ==='View-Item-Bal-Mast' || Request::segment(3) ==='House-Bank-Mast' || Request::segment(3) ==='View-House-Bank-Mast' || Request::segment(3) ==='Gl-Bal-Mast' || Request::segment(3) ==='View-Gl-Bal-Mast' || Request::segment(3) ==='Acc-Balence-Mast' || Request::segment(3) ==='View-Acc-Balence-Mast' || Request::segment(3) ==='Bank-Mast' || Request::segment(3) ==='View-Bank-Mast' || Request::segment(3) ==='Acc-Category-Mast' || Request::segment(3) ==='View-Acc-Category-Mast' || Request::segment(3) ==='House-Cash-Mast' || Request::segment(3) ==='View-House-Cash-Mast'  || Request::segment(3) ==='Hsn-Mast' || Request::segment(3) ==='View-Hsn-Mast' || Request::segment(3) ==='Hsn-Rate-Mast' || Request::segment(3) ==='View-Hsn-Rate-Mast' || Request::segment(3) ==='Um-Mast' || Request::segment(3) ==='view-Um-Mast' || Request::segment(3) ==='Item-Master' || Request::segment(3) ==='View-Item-Master' || Request::segment(3) ==='ItemUM_Mast' || Request::segment(3) ==='View-ItemUM_Mast' || Request::segment(3) ==='Cost-Type-Mast' || Request::segment(3) ==='View-Cost-Type-Mast' || Request::segment(3) ==='Tax-Indicator-Mast' || Request::segment(3) ==='View-Tax-Indicator-Mast' || Request::segment(3) ==='Tax-Rate-Mast' || Request::segment(3) ==='View-Tax-Rate-Mast' || Request::segment(3) ==='Cost-Group-Mast' || Request::segment(3) ==='View-Cost-Group-Mast' || Request::segment(3) ==='Cost-Class-Mast' || Request::segment(3) ==='View-Cost-Class-Mast' || Request::segment(3) ==='Zone-Mast' || Request::segment(3) ==='View-Zone-Mast' || Request::segment(3) ==='Cost-Category' || Request::segment(3) ==='View-Cost-Category' || Request::segment(3) ==='Cost-Mast' || Request::segment(3) ==='View-Cost-Mast' || Request::segment(3) ==='Account-Mast' || Request::segment(3) ==='View-Account-Mast' || Request::segment(3) ==='Mast-Acc-Type' || Request::segment(3) ==='View-Acc-Type' || Request::segment(3) === 'Item-Category-Quality-Mast' || Request::segment(3) === 'View-Item-Category-Quality-Mast' || Request::segment(3) === 'Item-Quality-Mast' || Request::segment(3) === 'View-Item-Quality-Mast' || Request::segment(3) ==='Emp-leave-Quota-Mast' || Request::segment(3) ==='Add-Employee' || Request::segment(3) === 'Emp-Grade-Mast' || Request::segment(3) === 'Emp-Wage-Indicator-Mast' || Request::segment(3) === 'Emp-leaveType-Mast' || Request::segment(2) ==='employee-attendance-master' || Request::segment(3) ==='Emp-Wage-Type-Mast' || Request::segment(3) === 'View-Employee-Mast' || Request::segment(3) === 'View-Emp-Grade-Mast' || Request::segment(3) === 'View-Emp-Wage-Indicator-Mast' || Request::segment(3) === 'View-Emp-leaveType-Mast' || Request::segment(3) === 'View-Emp-leave-Quota-Mast' || Request::segment(2) === 'view-employee-attendance-master' || Request::segment(3) === 'View-Emp-Wage-Type-Mast' || Request::segment(3) === 'Emp-Designation-Mast' || Request::segment(3) === 'View-Emp-Designation-Mast' || Request::segment(3) =='Emp-Pay-Mast' || Request::segment(3) =='View-Emp-Pay-Mast' || Request::segment(3) =='Asset-Group' || Request::segment(3) =='View-Asset-Group' || Request::segment(3) =='Asset-Class' || Request::segment(3) === 'View-Asset-Class' || Request::segment(3) === 'Asset-Category' || Request::segment(3) === 'View-Asset-Category' || Request::segment(3) === 'Asset-Master' || Request::segment(3) === 'View-Asset-Master' || Request::segment(3) === 'Asset-Dep-Rate-Master' || Request::segment(3) === 'View-Asset-Dep-Rate-Master' || Request::segment(3) === 'Asset-Balance-Master' || Request::segment(3) === 'View-Asset-Balance-Master' || Request::segment(3) ==='View-Equipment-Group-Mast' || Request::segment(3) ==='Equipment-Group-Mast'|| Request::segment(3)==='Emp-Position-Activity-Mast'||Request::segment(3) =='View-Emp-Position-Activity-Mast'|| Request::segment(3) ==='p-tax-master' || Request::segment(3) ==='View-P-TAX-Master'||Request::segment(3) === 'Emp-Position-Mast' || Request::segment(3) === 'View-Emp-Position-Mast'||Request::segment(3) === 'Emp-Activity-Mast' || Request::segment(3) === 'View-Emp-Activity-Mast' || Request::segment(3) === 'Equipment-Category-Mast' || Request::segment(3) === 'View-Equipment-Category-Mast' || Request::segment(3) === 'Emp-City-Class-Mast' || Request::segment(3) === 'View-Emp-City-Class-Mast' || Request::segment(3) === 'Emp-KPI-Mast' || Request::segment(3) === 'View-Emp-KPI-Mast' || Request::segment(3) === 'Emp-KRA-Mast' || Request::segment(3) === 'View-Emp-KRA-Mast' || Request::segment(3) === 'Emp-Tour-Eligible-Mast' || Request::segment(3) === 'View-Emp-Tour-Eligible-Mast' || Request::segment(3) ==='self-declaration' || Request::segment(3) === 'view-self-declaration'||Request::segment(3) === 'Emp-Mode-of-Transport-Mast' || Request::segment(3) === 'View-Emp-Mode-of-Transport-Mast'||Request::segment(3) === 'Emp-Hotel-Mast' || Request::segment(3) === 'View-Emp-Hotel-Mast' || Request::segment(3) ==='View-Cold-storage-Mast' || Request::segment(3) ==='Cold-storage-Mast' || Request::segment(3) === 'Item-Packing-Mast' || Request::segment(3) === 'View-Item-Packing-Mast' || Request::segment(3) === 'Vehicle-entry-Mast' || Request::segment(3) === 'View-Vehicle-entry-Mast' || Request::segment(3) === 'Inward-slip-Mast' || Request::segment(3) === 'View-Inward-slip-Mast' || Request::segment(3) === 'Block-storage-Mast' || Request::segment(3) === 'View-Block-storage-Mast' || Request::segment(3) === 'Floor-storage-Mast' || Request::segment(3) === 'View-Floor-storage-Mast' || Request::segment(3) === 'Bing-storage-Mast' || Request::segment(3) === 'View-Bing-storage-Mast' || Request::segment(1) ==='form-mast-fleet' || Request::segment(1) ==='view-mast-fleet' || Request::segment(1) ==='lr-exp-mast' || Request::segment(1) ==='view-lr-exp-mast' || Request::segment(1) ==='diesel-rate-mast' || Request::segment(1) ==='view-diesel-rate-mast' || Request::segment(1) ==='form-fleet-truck-wheel' || Request::segment(1) ==='view-flet-truck-wheel' || Request::segment(1) ==='form-mast-freight-rate' || Request::segment(1) ==='view-mast-freight-rate' || Request::segment(1) ==='form-mast-manufacturing' || Request::segment(1) ==='view-manufature' || Request::segment(1) ==='view-mast-task' || Request::segment(1) ==='form-mast-task' || Request::segment(3) === 'Equipment-Mast' || Request::segment(3) === 'View-Equipment-Mast' || Request::segment(3) === 'Equipment-Class-Mast' || Request::segment(3) === 'View-Equipment-Class-Mast' || Request::segment(3) === 'Equipment-Type-Mast' || Request::segment(3) === 'View-Equipment-Type-Mast' || Request::segment(3) === 'Equipment-Location-Mast' || Request::segment(3) === 'View-Equipment-Location-Mast' || Request::segment(3) === 'Equipment-Activity-Mast' || Request::segment(3) === 'View-Equipment-Activity-Mast' || Request::segment(3) === 'Outward-Gate-Pass-Mast' || Request::segment(3) === 'View-Outward-Gate-Pass-Mast' || Request::segment(1) ==='form-mast-destination' || Request::segment(1) ==='view-mast-destination' || Request::segment(1) ==='form-mast-depot' || Request::segment(1) ==='view-mast-depot' || Request::segment(3) ==='country-master' || Request::segment(3) ==='view-country-master' || Request::segment(3) === 'district-master' || Request::segment(3) === 'view-district-master' || Request::segment(3) ==='region-master' || Request::segment(3) ==='view-region-master' || Request::segment(3) === 'Add-Seasonal-Mast' || Request::segment(3) === 'View-Seasonal-Mast' || Request::segment(3) === 'Add-Chamber-Mast' || Request::segment(3) === 'View-Chamber-Mast' || Request::segment(3) === 'Add-Storage-location-Mast' || Request::segment(3) === 'View-Storage-location-Mast' || Request::segment(3) === 'state-master' || Request::segment(3) === 'view-state-master' || Request::segment(3) === 'city-master' || Request::segment(3) === 'view-city-master' || Request::segment(1) ==='form-fleet-trip-expense' || Request::segment(1) ==='view-fleet-trip-expense' || Request::segment(1) ==='lr-acknowledgement-penalty' || Request::segment(1) ==='view-mast-Lr-penalty'|| Request::segment(2) ==='fleet-certificate-transaction-form' || Request::segment(2) ==='view-fleet-certificate-transaction' || Request::segment(3) === 'Add-Acc-Item-Rate-Mast' || Request::segment(3) === 'View-Acc-Item-Rate-Mast' || Request::segment(3) === 'Item-Schedule-Mast' || Request::segment(3) === 'View-Item-Schedule-Mast' || Request::segment(3) ==='add-freight-type' || Request::segment(3) ==='view-freight-type-master' || Request::segment(2) ==='driver-master' || Request::segment(2) ==='view-driver-master'){ echo "active";}    ?>">
              <a href="#">
                <i class="fa fa-plus sign2"></i> <span>Master</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu ulview" style="width: 229px;
    padding-left: 15px;">


          {{-- Start : Asset Master --}}
          
          <li class="<?php if(Request::segment(3) ==='Asset-Group' || Request::segment(3) =='View-Asset-Group' || Request::segment(3) =='Asset-Class' || Request::segment(3) === 'View-Asset-Class' || Request::segment(3) === 'Asset-Category' || Request::segment(3) === 'View-Asset-Category' || Request::segment(3) === 'Asset-Master' || Request::segment(3) === 'View-Asset-Master' || Request::segment(3) === 'Asset-Dep-Rate-Master' || Request::segment(3) === 'View-Asset-Dep-Rate-Master' || Request::segment(3) === 'Asset-Balance-Master' || Request::segment(3) === 'View-Asset-Balance-Master'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Asset

                     <i class="fa fa-angle-left pull-right"></i> 

                  </a>
                <ul class="treeview-menu">
                   <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class="<?php if(Request::segment(3) ==='Asset-Group' || Request::segment(3) =='View-Asset-Group'){echo "active";} ?>">

                    <a href="#"><i class="fa fa-plus text-aqua"></i> Asset Group Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Asset-Group'){echo "active";} ?>">

                            <a href="{{ url('Master/Asset/Asset-Group') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Asset Group <span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Asset-Group'){echo "active";} ?>">

                                <a href="{{ url('Master/Asset/View-Asset-Group') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Asset Group <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'Asset-Class' || Request::segment(3) === 'View-Asset-Class'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Asset Class Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Asset-Class'){echo "active";} ?>">

                            <a href="{{ url('Master/Asset/Asset-Class') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Asset Class <span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Asset-Class'){echo "active";} ?>">

                                <a href="{{ url('Master/Asset/View-Asset-Class') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Asset Class <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'Asset-Category' || Request::segment(3) === 'View-Asset-Category'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Asset Category Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Asset-Category'){echo "active";} ?>">

                            <a href="{{ url('Master/Asset/Asset-Category') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Asset Category <span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Asset-Category'){echo "active";} ?>">

                                <a href="{{ url('Master/Asset/View-Asset-Category') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Asset Category <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'Asset-Dep-Rate-Master' || Request::segment(3) === 'View-Asset-Dep-Rate-Master'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Asset Dep. Rate Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Asset-Dep-Rate-Master'){echo "active";} ?>">

                            <a href="{{ url('Master/Asset/Asset-Dep-Rate-Master') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Depreciation Rate <span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Asset-Dep-Rate-Master'){echo "active";} ?>">

                                <a href="{{ url('Master/Asset/View-Asset-Dep-Rate-Master') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Depreciation Rate <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'Asset-Master' || Request::segment(3) === 'View-Asset-Master'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Asset Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Asset-Master'){echo "active";} ?>">

                            <a href="{{ url('Master/Asset/Asset-Master') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Asset <span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Asset-Master '){echo "active";} ?>">

                                <a href="{{ url('Master/Asset/View-Asset-Master ') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Asset <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>


                      <li class="<?php if(Request::segment(3) === 'Asset-Balance-Master' || Request::segment(3) === 'View-Asset-Balance-Master'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Asset Balance Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Asset-Balance-Master'){echo "active";} ?>">

                            <a href="{{ url('Master/Asset/Asset-Balance-Master') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Asset Balance<span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Asset-Balance-Master'){echo "active";} ?>">

                                <a href="{{ url('Master/Asset/View-Asset-Balance-Master') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Asset Balance <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>


                     

                    <?php } else{} ?>
                </ul>
          </li>



        {{-- End : Asset Master --}}
                
        
          <li class="<?php if(Request::segment(3) ==='Add-Employee' || Request::segment(2) === 'View-Acc-Type' || Request::segment(3) ==='Emp-leave-Quota-Mast' || Request::segment(3) === 'Emp-Grade-Mast' || Request::segment(3) === 'Emp-Wage-Indicator-Mast' || Request::segment(3) === 'Emp-leaveType-Mast' || Request::segment(2) ==='employee-attendance-master' || Request::segment(3) ==='Emp-Wage-Type-Mast' || Request::segment(3) === 'View-Employee-Mast' || Request::segment(3) === 'View-Emp-Grade-Mast' || Request::segment(3) === 'View-Emp-Wage-Indicator-Mast' || Request::segment(3) === 'View-Emp-leaveType-Mast' || Request::segment(3) === 'View-Emp-leave-Quota-Mast' || Request::segment(2) === 'view-employee-attendance-master' || Request::segment(3) === 'View-Emp-Wage-Type-Mast' || Request::segment(3) === 'Emp-Designation-Mast' || Request::segment(3) === 'View-Emp-Designation-Mast' || Request::segment(3) =='Emp-Pay-Mast' || Request::segment(3) =='View-Emp-Pay-Mast' || Request::segment(3) =='Emp-Position-Activity-Mast'||Request::segment(3) =='View-Emp-Position-Activity-Mast' ||Request::segment(3) ==='p-tax-master' || Request::segment(3) ==='View-P-TAX-Master'|| Request::segment(3) === 'Emp-Position-Mast' || Request::segment(3) === 'View-Emp-Position-Mast' || Request::segment(3) === 'Emp-Activity-Mast' || Request::segment(3) === 'View-Emp-Activity-Mast'|| Request::segment(3) === 'Emp-City-Class-Mast' || Request::segment(3) === 'View-Emp-City-Class-Mast'|| Request::segment(3) === 'Emp-KPI-Mast' || Request::segment(3) === 'View-Emp-KPI-Mast' || Request::segment(3) === 'Emp-KRA-Mast' || Request::segment(3) === 'View-Emp-KRA-Mast' || Request::segment(3) === 'Emp-Tour-Eligible-Mast' || Request::segment(3) === 'View-Emp-Tour-Eligible-Mast' ||Request::segment(3) ==='self-declaration' || Request::segment(3) === 'view-self-declaration' || Request::segment(3) === 'Emp-Mode-of-Transport-Mast' || Request::segment(3) === 'View-Emp-Mode-of-Transport-Mast' || Request::segment(3) === 'Emp-Hotel-Mast' || Request::segment(3) === 'View-Emp-Hotel-Mast' || Request::segment(3) === 'Emp-Hotel-Mast' || Request::segment(3) === 'View-Emp-Hotel-Mast'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Employee

                     <i class="fa fa-angle-left pull-right"></i> 

                  </a>
                <ul class="treeview-menu">
                   <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class="<?php if(Request::segment(3) ==='Add-Employee' || Request::segment(3) === 'View-Employee-Mast'){echo "active";} ?>">

                    <a href="#"><i class="fa fa-plus text-aqua"></i> Employee Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Add-Employee'){echo "active";} ?>">

                            <a href="{{ url('/Master/Employee/Add-Employee') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Employee <span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Employee-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Employee/View-Employee-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Employee <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>
                      <li class="<?php if(Request::segment(3) === 'Emp-Grade-Mast' || Request::segment(3) === 'View-Emp-Grade-Mast'){echo "active";} ?>">

                    <a href="#"><i class="fa fa-plus text-aqua"></i> Emp Grade Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Emp-Grade-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Employee/Emp-Grade-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Emp Grade <span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Emp-Grade-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Employee/View-Emp-Grade-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Emp Grade <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'Emp-Designation-Mast' || Request::segment(3) === 'View-Emp-Designation-Mast'){echo "active";} ?>">

                    <a href="#"><i class="fa fa-plus text-aqua"></i> Emp Designation Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Emp-Designation-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Employee/Emp-Designation-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Designation <span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Emp-Designation-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Employee/View-Emp-Designation-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Designation <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'Emp-Position-Mast' || Request::segment(3) === 'View-Emp-Position-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Emp Position Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Emp-Position-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Employee/Emp-Position-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Emp Position <span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Emp-Position-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Employee/View-Emp-Position-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Emp Position <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'Emp-Activity-Mast' || Request::segment(3) === 'View-Emp-Activity-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Emp Activity Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Emp-Activity-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Employee/Emp-Activity-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Emp Activity <span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Emp-Activity-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Employee/View-Emp-Activity-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Emp Activity <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'Emp-Position-Activity-Mast' || Request::segment(3) === 'View-Emp-Position-Activity-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Emp Pos. Activity Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Emp-Position-Activity-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Employee/Emp-Position-Activity-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Emp Pos. Activity <span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Emp-Position-Activity-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Employee/View-Emp-Position-Activity-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Emp Pos. Activity <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'Emp-City-Class-Mast' || Request::segment(3) === 'View-Emp-City-Class-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Emp City Class Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Emp-City-Class-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Employee/Emp-City-Class-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Emp City Class <span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Emp-City-Class-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Employee/View-Emp-City-Class-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Emp City Class <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'Emp-KPI-Mast' || Request::segment(3) === 'View-Emp-KPI-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Emp KPI Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Emp-KPI-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Employee/Emp-KPI-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add KPI <span style="display: none;">MA0</span>

                            </a>

                          </li>
                          
                          <li class="<?php if(Request::segment(3) === 'View-Emp-KPI-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/Employee/View-Emp-KPI-Mast') }}">

                                <i class="fa fa-circle-o text-red"></i> 

                                View KPI  <span style="display: none;">MA0</span>

                              </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'Emp-KRA-Mast' || Request::segment(3) === 'View-Emp-KRA-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Emp KRA Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Emp-KRA-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Employee/Emp-KRA-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add KRA <span style="display: none;">MA0</span>

                            </a>

                          </li>
                          
                          <li class="<?php if(Request::segment(3) === 'View-Emp-KRA-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/Employee/View-Emp-KRA-Mast') }}">

                                <i class="fa fa-circle-o text-red"></i> 

                                View KRA  <span style="display: none;">MA0</span>

                              </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'Emp-Tour-Eligible-Mast' || Request::segment(3) === 'View-Emp-Tour-Eligible-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Emp Tour Eligible Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Emp-Tour-Eligible-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Employee/Emp-Tour-Eligible-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Tour Eligible <span style="display: none;">MA0</span>

                            </a>

                          </li>
                          
                          <li class="<?php if(Request::segment(3) === 'View-Emp-Tour-Eligible-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/Employee/View-Emp-Tour-Eligible-Mast') }}">

                                <i class="fa fa-circle-o text-red"></i> 

                                View Emp Tour Eligible  <span style="display: none;">MA0</span>

                              </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) =='Emp-Pay-Mast' || Request::segment(3) =='View-Emp-Pay-Mast'){echo "active";}?>">

                      <a href="#">

                        <i class="fa fa-plus text-aqua"></i> Emp Pay Master
                        <i class="fa fa-angle-left pull-right"></i>

                      </a>
                      <ul class="treeview-menu">

                     
                          <li class="<?php if(Request::segment(3) =='Emp-Pay-Mast'){echo "active";}?>">

                            <a href="{{ url('/Master/Employee/Emp-Pay-Mast') }}">

                                   <i class="fa fa-circle-o text-yellow"></i>
                                    Add Pay Master
                                 

                                </a>
                          </li>
                          <li class="<?php if(Request::segment(3) =='View-Emp-Pay-Mast'){echo "active";}?>">
                              <a href="{{ url('/Master/Employee/View-Emp-Pay-Mast') }}">

                                 <i class="fa fa-circle-o text-red"></i>
                               
                                 View  Pay Master
                              </a>
                                
                          </li>



                      </ul>

                     </li>

                      
                      <li class="<?php if(Request::segment(3) === 'Emp-leaveType-Mast' || Request::segment(3) === 'View-Emp-leaveType-Mast'){echo "active";} ?>">

                    <a href="#"><i class="fa fa-plus text-aqua"></i>Leave Type
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Emp-leaveType-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Employee/Emp-leaveType-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Leave Type<span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Emp-leaveType-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Employee/View-Emp-leaveType-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Leave Type <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'Emp-leave-Quota-Mast' || Request::segment(3) === 'View-Emp-leave-Quota-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i>Leave Quota Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Emp-leave-Quota-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Employee/Emp-leave-Quota-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Leave Quota<span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Emp-leave-Quota-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Employee/View-Emp-leave-Quota-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Leave Quota <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'Emp-Mode-of-Transport-Mast' || Request::segment(3) === 'View-Emp-Mode-of-Transport-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i>Mode Of Transport Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Emp-mode-of-transport-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/ModeOfTransport/Emp-Mode-of-Transport-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Mode of Transport<span style="display: none;">MA0</span>

                            </a>

                          </li>
                         
                          <li class="<?php if(Request::segment(3) === 'View-Emp-mode-of-transport-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/ModeOfTransport/View-Emp-Mode-of-Transport-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Mode of Transport <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'Emp-Hotel-Mast' || Request::segment(3) === 'View-Emp-Hotel-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i>Hotel Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Emp-Hotel-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Hotel/Emp-Hotel-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Hotel <span style="display: none;">MA0</span>

                            </a>

                          </li>
                         
                          <li class="<?php if(Request::segment(3) === 'View-Emp-Hotel-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Hotel/View-Emp-Hotel-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Hotel <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) === 'Emp-Wage-Indicator-Mast' || Request::segment(3) === 'View-Emp-Wage-Indicator-Mast'){echo "active";} ?>">

                    <a href="#"><i class="fa fa-plus text-aqua"></i>Wage Indicator
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Emp-Wage-Indicator-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Employee/Emp-Wage-Indicator-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Wage Indicator<span style="display: none;">MA0</span>

                            </a>

                          </li>
                          
                          

                          <li class="<?php if(Request::segment(3) === 'View-Emp-Wage-Indicator-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Employee/View-Emp-Wage-Indicator-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Wage Indicator <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='Emp-Wage-Type-Mast' || Request::segment(3) === 'View-Emp-Wage-Type-Mast'){echo "active";} ?>">

                       <a href="#"><i class="fa fa-plus text-aqua"></i>Wage Type Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class="<?php if(Request::segment(3) ==='Emp-Wage-Type-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Employee/Emp-Wage-Type-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Wage Type<span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Emp-Wage-Type-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Employee/View-Emp-Wage-Type-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Wage Type <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='self-declaration' || Request::segment(3) === 'view-self-declaration'){echo "active";} ?>">

                       <a href="#"><i class="fa fa-plus text-aqua"></i>Self Declaration
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class="<?php if(Request::segment(3) ==='self-declaration'){echo "active";} ?>">

                            <a href="{{ url('/Master/Employee/self-declaration') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Self Declaration<span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'view-self-declaration'){echo "active";} ?>">

                                <a href="{{ url('/Master/Employee/view-self-declaration') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Self Declaration <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <li class="<?php if(Request::segment(3) ==='p-tax-master' || Request::segment(3) ==='View-P-TAX-Master'){echo "active";} ?>">

                       <a href="#"><i class="fa fa-plus text-aqua"></i>P_TAX Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class="<?php if(Request::segment(3) ==='p-tax-master'){echo "active";} ?>">

                            <a href="{{ url('/Master/Employee/p-tax-master') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add P_TAX <span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) ==='View-P-TAX-Master'){echo "active";} ?>">

                                <a href="#">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View P_TAX Master<span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      
                    <?php } else{} ?>
                </ul>
          </li>
          
          <li class="<?php if( Request::segment(3) ==='Acc-Class' || Request::segment(3) ==='View-Acc-Class' || Request::segment(3) ==='Acc-Category-Mast' || Request::segment(3) ==='View-Acc-Category-Mast' || Request::segment(3) ==='Account-Mast' || Request::segment(3) ==='View-Account-Mast' || Request::segment(3) ==='Mast-Acc-Type' || Request::segment(3) ==='View-Acc-Type' || Request::segment(3) ==='Acc-Balence-Mast' || Request::segment(3) ==='View-Acc-Balence-Mast'){ echo "active";}    ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Customer/Vendor

                     <i class="fa fa-angle-left pull-right"></i> 

                  </a>
            <ul class="treeview-menu">

           
            
              <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('MCA0' == $row &&  Session::get('usertype')=='superAdmin' || 'MCA0' == $row && Session::get('usertype')=='user') { 



                ?>

                <li class=" <?php if(Request::segment(3) === 'Mast-Acc-Type' || Request::segment(3) === 'View-Acc-Type'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                   
                    Master Account Type

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                  <ul class="treeview-menu">

            <li class=" <?php if(Request::segment(3) === 'Mast-Acc-Type'){echo "active";} ?>">

              <a href="{{ url('/Master/Customer-Vendor/Mast-Acc-Type') }}">



                         <i class="fa fa-circle-o text-yellow"></i>

                              Add Account Type <span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Acc-Type'){echo "active";} ?>">

                                <a href="{{ url('/Master/Customer-Vendor/View-Acc-Type') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Account Type <span style="display: none;">MA0</span>

                                </a>

                          </li>

                  </ul>

                </li>

                <?php } else{} } }?>

               

                  <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class=" <?php if(Request::segment(3) === 'Mast-Acc-Type' || Request::segment(3) === 'View-Acc-Type'){echo "active";} ?>">

                    <a href="#"><i class="fa fa-plus text-aqua"></i> Account Type Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Mast-Acc-Type'){echo "active";} ?>">

                            <a href="{{ url('/Master/Customer-Vendor/Mast-Acc-Type') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Account Type <span style="display: none;">MA0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Acc-Type'){echo "active";} ?>">

                                <a href="{{ url('/Master/Customer-Vendor/View-Acc-Type') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Account Type <span style="display: none;">MA0</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                    <?php } else{} ?>

                    <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                

                  if('MCA1' == $row &&  Session::get('usertype')=='superAdmin' || 'MCA1' == $row && Session::get('usertype')=='user') { 



                ?>

                <li class=" <?php if(Request::segment(3) === 'party-finance-master' || Request::segment(3) === 'view-party-finance-master'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus text-aqua"></i> 
                   
                    Master Account

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                  <ul class="treeview-menu">

                    <li class=" <?php if(Request::segment(3) === 'Account-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Customer-Vendor/Account-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Account <span style="display: none;">MA1</span>

                            </a>

                          </li>



                          <li class=" <?php if(Request::segment(3) === 'View-Account-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Customer-Vendor/View-Account-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Account <span style="display: none;">MA1</span>
 
                                </a>

                          </li>

                  </ul>

                </li>

                <?php } else{} } }?>

                  <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class="<?php if(Request::segment(3) === 'Account-Mast' || Request::segment(3) === 'View-Account-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Account Master
                           <i class="fa fa-angle-left pull-right"></i>
                        </a>

                         <ul class="treeview-menu">



                          <li class=" <?php if(Request::segment(3) === 'Account-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Customer-Vendor/Account-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Account  <span style="display: none;">MA1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Account-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Customer-Vendor/View-Account-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Account  <span style="display: none;">MA1</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                    <?php } else{} ?>

                    <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('MCA2' == $row &&  Session::get('usertype')=='superAdmin' || 'MCA2' == $row && Session::get('usertype')=='user') { 



                ?>

                 <li class=" <?php if(Request::segment(3) === 'Acc-Category-Mast' || Request::segment(3) === 'View-Acc-Category-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Acc Category
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Acc-Category-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Customer-Vendor/Acc-Category-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Acc Category <span style="display: none;">MA2</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Acc-Category-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Customer-Vendor/View-Acc-Category-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Acc Category <span style="display: none;">MA2</span>

                                  </a>

                            </li>

                          </ul>

                        </li>


             <?php } else{} } }?>

                     <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class=" <?php if(Request::segment(3) === 'Acc-Category-Mast' || Request::segment(3) === 'View-Acc-Category-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Acc Category Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Acc-Category-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Customer-Vendor/Acc-Category-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Acc Category <span style="display: none;">MA2</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Acc-Category-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Customer-Vendor/View-Acc-Category-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 
 
                                    View Acc Category <span style="display: none;">MA2</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                      <?php } else{ }?>

                      <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('MCA3' == $row &&  Session::get('usertype')=='superAdmin' || 'MCA3' == $row && Session::get('usertype')=='user') { 



                ?>

                <li class="<?php if(Request::segment(2) === 'Acc-Class' || Request::segment(2) === 'View-Acc-Class'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Acc Class Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Acc-Class'){echo "active";} ?>">

                                <a href="{{ url('/Master/Customer-Vendor/Acc-Class') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Acc Class  <span style="display: none;">MA3</span>

                                </a>

                            </li>



                            <li class="<?php if(Request::segment(3) === 'View-Acc-Class'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Customer-Vendor/View-Acc-Class') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Acc Class <span style="display: none;">MA3</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                <?php } else{} } }?>

                      <?php if(Session::get('usertype')=='admin'){ ?>


                    <li class="<?php if(Request::segment(3) === 'Acc-Class' || Request::segment(3) === 'View-Acc-Class'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Acc Class Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Acc-Class'){echo "active";} ?>">

                                <a href="{{ url('/Master/Customer-Vendor/Acc-Class') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Acc Class  <span style="display: none;">MA3</span>

                                </a>

                            </li>



                            <li class="<?php if(Request::segment(3) === 'View-Acc-Class'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Customer-Vendor/View-Acc-Class') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Acc Class <span style="display: none;">MA3</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                    <?php } else{ }?>

                    <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('MCA4' == $row &&  Session::get('usertype')=='superAdmin' || 'MCA4' == $row && Session::get('usertype')=='user') { 



                ?>

                <li class="<?php if(Request::segment(3) === 'Acc-Balence-Mast' || Request::segment(3) === 'View-Acc-Balence-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>   
                            Acc Bal Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Acc-Balence-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Customer-Vendor/Acc-Balence-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Acc Bal <span style="display: none;">MA4</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Acc-Balence-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Customer-Vendor/View-Acc-Balence-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Acc Bal <span style="display: none;">MA4</span>

                                  </a>

                            </li>

                          </ul>

                        </li>


                <?php } else{} } }?>







                     <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class="<?php if(Request::segment(3) === 'Acc-Balence-Mast' || Request::segment(3) === 'View-Acc-Balence-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>   
                            Acc Bal Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Acc-Balence-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Customer-Vendor/Acc-Balence-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Acc Bal <span style="display: none;">MA4</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Acc-Balence-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Customer-Vendor/View-Acc-Balence-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Acc Bal <span style="display: none;">MA4</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                     <?php } else { } ?>

              
              

           </ul>

        </li>

<!----- GL MASTER------>

  <li class="<?php if(Request::segment(3) === 'Glsch-Mast' || Request::segment(3) === 'View-Glsch' || Request::segment(3) === 'Gl-Mast' || Request::segment(3) === 'View-Gl-Mast'  || Request::segment(3) === 'Gl-Key-Mast' || Request::segment(3) === 'View-Gl-Key-Mast' || Request::segment(3) ==='Gl-Bal-Mast' || Request::segment(3) ==='View-Gl-Bal-Mast'){ echo "active";}    ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> General Ledger

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
            <ul class="treeview-menu">

           
            
              <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MGG0' == $row &&  Session::get('usertype')=='superAdmin' || 'MGG0' == $row && Session::get('usertype')=='user') { 

                ?>

                

                  <li class=" <?php if(Request::segment(3) === 'Glsch-Mast' || Request::segment(3) ==='View-Glsch'){echo "active";} ?>">

                          <a href="#">

                          <i class="fa fa-plus text-aqua"></i> 

                          GLSCH Master 

                          <i class="fa fa-angle-left pull-right"></i>

                          </a>

                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Glsch-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/General-Ledger/Glsch-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add GLSCH Master <span style="display: none;">MG0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Glsch'){echo "active";} ?>">

                            <a href="{{ url('/Master/General-Ledger/View-Glsch') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                              View GLSCH Master <span style="display: none;">MG0</span>

                            </a>

                          </li>

                        </ul>

                    </li>


              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                   <li class="<?php if(Request::segment(3) === 'Glsch-Mast' || Request::segment(3) ==='View-Glsch'){echo "active";} ?>">

                          <a href="#">

                          <i class="fa fa-plus text-aqua"></i> 

                          GLSCH Master

                          <i class="fa fa-angle-left pull-right"></i>

                          </a>

                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Glsch-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/General-Ledger/Glsch-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add GLSCH Master <span style="display: none;">MG0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) ==='View-Glsch'){echo "active";} ?>">

                            <a href="{{ url('/Master/General-Ledger/View-Glsch') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                              View GLSCH Master <span style="display: none;">MG0</span>

                            </a>

                          </li>

                        </ul>

                    </li>

                  <?php } else{ }?>

                    <?php if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MGG1' == $row &&  Session::get('usertype')=='superAdmin' || 'MGG1' == $row && Session::get('usertype')=='user') { 

                ?>

                  

                    <li class="<?php if(Request::segment(3) === 'Gl-Mast' || Request::segment(3) === 'View-Gl-Mast'){echo "active";} ?>">

                          <a href="#">

                          <i class="fa fa-plus text-aqua"></i> 

                          GL Master

                          <i class="fa fa-angle-left pull-right"></i>

                          </a>

                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Gl-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/General-Ledger/Gl-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add GL Master <span style="display: none;">MG1</span>

                            </a>

                        </li>



                          <li class="<?php if(Request::segment(3) === 'View-Gl-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/General-Ledger/View-Gl-Mast') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                              View GL Master <span style="display: none;">MG1</span>

                            </a>

                          </li>

                        </ul>

                      </li>

                <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class="<?php if(Request::segment(3) === 'Gl-Mast' || Request::segment(3) === 'View-Gl-Mast'){echo "active";} ?>">

                          <a href="#">

                          <i class="fa fa-plus text-aqua"></i> 

                          GL Master

                          <i class="fa fa-angle-left pull-right"></i>

                          </a>

                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Gl-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/General-Ledger/Gl-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add GL Master <span style="display: none;">MG1</span>

                            </a>

                        </li>



                          <li class="<?php if(Request::segment(3) === 'View-Gl-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/General-Ledger/View-Gl-Mast') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                              View GL Master <span style="display: none;">MG1</span>

                            </a>

                          </li>

                        </ul>

                      </li>
                    <?php } else{ }?>

                     <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MGG2' == $row &&  Session::get('usertype')=='superAdmin' || 'MGG2' == $row && Session::get('usertype')=='user') { 

                ?>

                 <li class=" <?php if(Request::segment(3) === 'Gl-Bal-Mast' || Request::segment(3) === 'View-Gl-Bal-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i>  GL Bal Master
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Gl-Bal-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/General-Ledger/Gl-Bal-Mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add GL Bal <span style="display: none;">MG2</span>

                              </a>

                          </li>
                          
                          <li class="<?php if(Request::segment(3) === 'View-Gl-Bal-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/General-Ledger/View-Gl-Bal-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View GL Bal <span style="display: none;">MG2</span>

                                </a>

                          </li>

                        </ul>

                      </li>

              <?php } else{} } }?>
                   

                    <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class=" <?php if(Request::segment(3) === 'Gl-Bal-Mast' || Request::segment(3) === 'View-Gl-Bal-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i>  GL Bal Master
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Gl-Bal-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/General-Ledger/Gl-Bal-Mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add GL Bal <span style="display: none;">MG2</span>

                              </a>

                          </li>
                          
                          <li class="<?php if(Request::segment(3) === 'View-Gl-Bal-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/General-Ledger/View-Gl-Bal-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View GL Bal <span style="display: none;">MG2</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <?php } else{ }?>

                       <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MGG3' == $row &&  Session::get('usertype')=='superAdmin' || 'MGG3' == $row && Session::get('usertype')=='user') { 

                ?>


                 <li class=" <?php if(Request::segment(3) === 'Gl-Key-Mast' || Request::segment(3) === 'View-Gl-Key-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Gl Key Master
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Gl-Key-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/General-Ledger/Gl-Key-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Gl Key <span style="display: none;">MG3</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Gl-Key-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/General-Ledger/View-Gl-Key-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View Gl Key <span style="display: none;">MG3</span>

                                </a>

                          </li>

                        </ul>

                    </li>



              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class=" <?php if(Request::segment(3) === 'Gl-Key-Mast' || Request::segment(3) === 'View-Gl-Key-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Gl Key Master
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Gl-Key-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/General-Ledger/Gl-Key-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Gl Key <span style="display: none;">MG3</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Gl-Key-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/General-Ledger/View-Gl-Key-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View Gl Key <span style="display: none;">MG3</span>

                                </a>

                          </li>

                        </ul>

                    </li>

                    <?php } else{ }?>


              
              

           </ul>

        </li>
<!----- GL MASTER------>


<!----- GEOGARAPHYCAL MASTER------>

  <li class="<?php if(Request::segment(3) === 'country-master' || Request::segment(3) === 'view-country-master' || Request::segment(3) === 'region-master' || Request::segment(3) === 'view-region-master'  || Request::segment(3) === 'Gl-Key-Mast' || Request::segment(3) === 'View-Gl-Key-Mast' || Request::segment(3) ==='Gl-Bal-Mast' || Request::segment(3) ==='View-Gl-Bal-Mast' || Request::segment(3) ==='state-master' || Request::segment(3) ==='view-state-master' || Request::segment(3) === 'district-master' || Request::segment(3) === 'view-district-master' || Request::segment(3) === 'city-master' || Request::segment(3) === 'view-city-master'){ echo "active";}    ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Geographical 

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
            <ul class="treeview-menu">

           
            
              <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MGG0' == $row &&  Session::get('usertype')=='superAdmin' || 'MGG0' == $row && Session::get('usertype')=='user') { 

                ?>


                  <li class=" <?php if(Request::segment(3) === 'country-master' || Request::segment(3) ==='view-country-master'){echo "active";} ?>">

                          <a href="#">

                          <i class="fa fa-plus text-aqua"></i> 

                          Country Master 

                          <i class="fa fa-angle-left pull-right"></i>

                          </a>

                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'country-master'){echo "active";} ?>">

                            <a href="{{ url('/master/geogaraphycal/country-master') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Country <span style="display: none;">MG0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'view-country-master'){echo "active";} ?>">

                            <a href="{{ url('/master/geogaraphycal/view-country-master') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                              View Country <span style="display: none;">MG0</span>

                            </a>

                          </li>

                        </ul>

                    </li>


              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                   <li class=" <?php if(Request::segment(3) === 'country-master' || Request::segment(3) ==='view-country-master'){echo "active";} ?>">

                          <a href="#">

                          <i class="fa fa-plus text-aqua"></i> 

                          Country Master 

                          <i class="fa fa-angle-left pull-right"></i>

                          </a>

                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'country-master'){echo "active";} ?>">

                            <a href="{{ url('/master/geogaraphycal/country-master') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Country <span style="display: none;">MG0</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'view-country-master'){echo "active";} ?>">

                            <a href="{{ url('/master/geogaraphycal/view-country-master') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                              View Country <span style="display: none;">MG0</span>

                            </a>

                          </li>

                        </ul>

                    </li>

                  <?php } else{ }?>

                   <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MGG2' == $row &&  Session::get('usertype')=='superAdmin' || 'MGG2' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class=" <?php if(Request::segment(3) === 'state-master' || Request::segment(3) === 'view-state-master'){echo "active";} ?>">

                  <a href="#"><i class="fa fa-plus text-aqua"></i>  State Master
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>

                  <ul class="treeview-menu">

                    <li class=" <?php if(Request::segment(3) === 'Gl-Bal-Mast'){echo "active";} ?>">

                        <a href="{{ url('/master/geogaraphycal/state-master') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add State <span style="display: none;">MG2</span>

                        </a>

                    </li>
                    
                    <li class="<?php if(Request::segment(3) === 'view-state-master'){echo "active";} ?>">

                          <a href="{{ url('/master/geogaraphycal/view-state-master') }}">

                            <i class="fa fa-circle-o text-red"></i> 

                            View State <span style="display: none;">MG2</span>

                          </a>

                    </li>

                  </ul>

                </li>

              <?php } else{} } }?>
                   

                    <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class=" <?php if(Request::segment(3) === 'state-master' || Request::segment(3) === 'view-state-master'){echo "active";} ?>">

                  <a href="#"><i class="fa fa-plus text-aqua"></i>  State Master
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>

                  <ul class="treeview-menu">

                    <li class=" <?php if(Request::segment(3) === 'state-master'){echo "active";} ?>">

                        <a href="{{ url('/master/geogaraphycal/state-master') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add State <span style="display: none;">MG2</span>

                        </a>

                    </li>
                    
                    <li class="<?php if(Request::segment(3) === 'view-state-master'){echo "active";} ?>">

                          <a href="{{ url('/master/geogaraphycal/view-state-master') }}">

                            <i class="fa fa-circle-o text-red"></i> 

                            View State <span style="display: none;">MG2</span>

                          </a>

                    </li>

                  </ul>

                </li>

                      <?php } else{ }?>

                    <?php if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MGG1' == $row &&  Session::get('usertype')=='superAdmin' || 'MGG1' == $row && Session::get('usertype')=='user') { 

                ?>

                  

                    <li class="<?php if(Request::segment(3) === 'region-master' || Request::segment(3) === 'view-region-master'){echo "active";} ?>">

                          <a href="#">

                          <i class="fa fa-plus text-aqua"></i> 

                          Region Master

                          <i class="fa fa-angle-left pull-right"></i>

                          </a>

                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'region-master'){echo "active";} ?>">

                            <a href="{{ url('/master/geogaraphycal/region-master') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Region <span style="display: none;">MG1</span>

                            </a>

                        </li>



                          <li class="<?php if(Request::segment(3) === 'view-region-master'){echo "active";} ?>">

                            <a href="{{ url('/master/geogaraphycal/view-region-master') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                              View Region <span style="display: none;">MG1</span>

                            </a>

                          </li>

                        </ul>

                      </li>

                <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class="<?php if(Request::segment(3) === 'region-master' || Request::segment(3) === 'view-region-master'){echo "active";} ?>">

                          <a href="#">

                          <i class="fa fa-plus text-aqua"></i> 

                          Region Master

                          <i class="fa fa-angle-left pull-right"></i>

                          </a>

                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'region-master'){echo "active";} ?>">

                            <a href="{{ url('/master/geogaraphycal/region-master') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Region <span style="display: none;">MG1</span>

                            </a>

                        </li>



                          <li class="<?php if(Request::segment(3) === 'view-region-master'){echo "active";} ?>">

                            <a href="{{ url('/master/geogaraphycal/view-region-master') }}">

                              <i class="fa fa-circle-o text-red"></i> 

                              View Region <span style="display: none;">MG1</span>

                            </a>

                          </li>

                        </ul>

                      </li>

                    <?php } else{ }?>

                    

                       <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MGG3' == $row &&  Session::get('usertype')=='superAdmin' || 'MGG3' == $row && Session::get('usertype')=='user') { 

                ?>


                 <li class=" <?php if(Request::segment(3) === 'district-master' || Request::segment(3) === 'view-district-master'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> District Master
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'district-master'){echo "active";} ?>">

                            <a href="{{ url('/master/geogaraphycal/district-master') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add District <span style="display: none;">MG3</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'view-district-master'){echo "active";} ?>">

                                <a href="{{ url('/master/geogaraphycal/view-district-master') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View District <span style="display: none;">MG3</span>

                                </a>

                          </li>

                        </ul>

                    </li>



              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class=" <?php if(Request::segment(3) === 'district-master' || Request::segment(3) === 'view-district-master'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> District Master
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'district-master'){echo "active";} ?>">

                            <a href="{{ url('/master/geogaraphycal/district-master') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add District <span style="display: none;">MG3</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'view-district-master'){echo "active";} ?>">

                                <a href="{{ url('/master/geogaraphycal/view-district-master') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View District <span style="display: none;">MG3</span>

                                </a>

                          </li>

                        </ul>

                    </li>

                    <?php } else{ }?>

              <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MGG3' == $row &&  Session::get('usertype')=='superAdmin' || 'MGG3' == $row && Session::get('usertype')=='user') { 

              ?>


                 <li class=" <?php if(Request::segment(3) === 'city-master' || Request::segment(3) === 'view-city-master'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> City Master
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'city-master'){echo "active";} ?>">

                            <a href="{{ url('/master/geogaraphycal/city-master') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add City <span style="display: none;">MG3</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'view-city-master'){echo "active";} ?>">

                                <a href="{{ url('/master/geogaraphycal/view-city-master') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View City <span style="display: none;">MG3</span>

                                </a>

                          </li>

                        </ul>

                    </li>



              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class=" <?php if(Request::segment(3) === 'city-master' || Request::segment(3) === 'view-city-master'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> City Master
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'city-master'){echo "active";} ?>">

                            <a href="{{ url('/master/geogaraphycal/city-master') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add City <span style="display: none;">MG3</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'view-city-master'){echo "active";} ?>">

                                <a href="{{ url('/master/geogaraphycal/view-city-master') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View City <span style="display: none;">MG3</span>

                                </a>

                          </li>

                        </ul>

                    </li>

                    <?php } else{ }?>


              
              

           </ul>

        </li>
<!----- GL MASTER------>


<!----- COST MASTER------>

<li class="treeview <?php if( Request::segment(3) ==='Cost-Type-Mast' || Request::segment(3) ==='View-Cost-Type-Mast' || Request::segment(3) ==='Cost-Group-Mast' || Request::segment(3) ==='View-Cost-Group-Mast' || Request::segment(3) ==='Cost-Class-Mast' || Request::segment(3) ==='View-Cost-Class-Mast'  || Request::segment(3) ==='Cost-Category' || Request::segment(3) ==='View-Cost-Category' || Request::segment(3) ==='Cost-Mast' || Request::segment(3) ==='View-Cost-Mast' || Request::segment(3) ==='Valuation-Tran-Mast' || Request::segment(3) ==='View-Valuation-Tran-Mast' || Request::segment(3) ==='Valuation-Mast' || Request::segment(3) ==='View-Valuation-Mast'){ echo "active";}    ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Cost Center

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
            <ul class="treeview-menu">

           
            
              <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('MCC0' == $row &&  Session::get('usertype')=='superAdmin' || 'MCC0' == $row && Session::get('usertype')=='user') { 



                ?>

                <li class="<?php if(Request::segment(3) ==='Cost-Type-Mast' || Request::segment(3) ==='View-Cost-Type-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>   
                            Cost Type Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) ==='Cost-Type-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Cost-Center/Cost-Type-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                   Add Cost Type <span style="display: none;">MC0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) ==='View-Cost-Type-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Cost-Center/View-Cost-Type-Mast') }}">

                                    <i class="fa fa-plus text-red"></i> 

                                    View Cost Type <span style="display: none;">MC0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin' || Session::get('usertype')=='Admin'){ ?>

                      
                        <li class=" <?php if(Request::segment(3) === 'Cost-Type-Mast' || Request::segment(3) === 'View-Cost-Type-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>   
                            Cost Type Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class="<?php if(Request::segment(3) === 'Cost-Type-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Cost-Center/Cost-Type-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                   Add Cost Type <span style="display: none;">MC0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) ==='View-Cost-Type-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Cost-Center/View-Cost-Type-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 
 
                                    View Cost Type <span style="display: none;">MC0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                        <?php } else{ } ?>

                    <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('MCC1' == $row &&  Session::get('usertype')=='superAdmin' || 'MCC1' == $row && Session::get('usertype')=='user') { 



                ?>

                <li class="<?php if(Request::segment(3) === 'Cost-Mast' || Request::segment(3) === 'View-Cost-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Cost Master
                             <i class="fa fa-angle-left pull-right"></i>
                          </a>

                           <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Cost-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/Cost-Center/Cost-Mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Cost <span style="display: none;">MC1</span>

                              </a>

                            </li>

                            <li class="<?php if(Request::segment(3) === 'View-Cost-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Cost-Center/View-Cost-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                  View Cost <span style="display: none;">MC1</span>

                                  </a>

                            </li>

                          </ul>

                      </li>

              <?php } else{} } }?>

                      <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class="<?php if(Request::segment(3) === 'Cost-Mast' || Request::segment(3) === 'View-Cost-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Cost Master
                             <i class="fa fa-angle-left pull-right"></i>
                          </a>

                           <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Cost-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/Cost-Center/Cost-Mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Cost <span style="display: none;">MC1</span>

                              </a>

                            </li>

                            <li class="<?php if(Request::segment(3) === 'View-Cost-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Cost-Center/View-Cost-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                  View Cost <span style="display: none;">MC1</span>

                                  </a>

                            </li>

                          </ul>

                      </li>

                        <?php } else{ }?>

                     <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');

                foreach ($Fname as $row) {
 

                  if('MCC2' == $row &&  Session::get('usertype')=='superAdmin' || 'MCC2' == $row && Session::get('usertype')=='user') { 

                ?>

              <li class=" <?php if(Request::segment(3) === 'Cost-Group-Mast' || Request::segment(3) === 'View-Cost-Group-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>   
                            Cost Group Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Cost-Group-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Cost-Center/Cost-Group-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                   Add Cost Group <span style="display: none;">MC2</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Cost-Group-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Cost-Center/View-Cost-Group-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Cost Group <span style="display: none;">MC2</span>

                                  </a>

                            </li>

                          </ul>

                        </li>


            <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class=" <?php if(Request::segment(3) === 'Cost-Group-Mast' || Request::segment(3) === 'View-Cost-Group-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>   
                            Cost Group Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Cost-Group-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Cost-Center/Cost-Group-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                   Add Cost Group <span style="display: none;">MC2</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Cost-Group-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Cost-Center/View-Cost-Group-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Cost Group <span style="display: none;">MC2</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                      <?php } else{ }?>

                        <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('MCC3' == $row &&  Session::get('usertype')=='superAdmin' || 'MCC3' == $row && Session::get('usertype')=='user') { 



                ?>

                <li class=" <?php if(Request::segment(3) === 'Cost-Category' || Request::segment(3) === 'View-Cost-Category'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Cost Category Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Cost-Category'){echo "active";} ?>">

                                <a href="{{ url('/Master/Cost-Center/Cost-Category') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Cost Category <span style="display: none;">MC3</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Cost-Category'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Cost-Center/View-Cost-Category') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Cost Category <span style="display: none;">MC3</span>

                                  </a>

                            </li>

                          </ul>

                        </li>


                <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                      <li class=" <?php if(Request::segment(3) === 'Cost-Category' || Request::segment(3) === 'View-Cost-Category'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Cost Category Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Cost-Category'){echo "active";} ?>">

                                <a href="{{ url('/Master/Cost-Center/Cost-Category') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Cost Category <span style="display: none;">MC3</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Cost-Category'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Cost-Center/View-Cost-Category') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Cost Category <span style="display: none;">MC3</span>
 
                                  </a>

                            </li>

                          </ul>

                        </li>

                      <?php } else{ }?>

                  <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('MCC4' == $row &&  Session::get('usertype')=='superAdmin' || 'MCC4' == $row && Session::get('usertype')=='user') { 



                ?>

               <li class="<?php if(Request::segment(3) === 'Cost-Class-Mast' || Request::segment(3) === 'View-Cost-Class-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>   
                            Cost Class Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Cost-Class-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Cost-Center/Cost-Class-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                   Add Cost Class <span style="display: none;">MC4</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Cost-Class-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Cost-Center/View-Cost-Class-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Cost Class <span style="display: none;">MC4</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

            <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>


                      <li class="<?php if(Request::segment(3) === 'Cost-Class-Mast' || Request::segment(3) === 'View-Cost-Class-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>   
                            Cost Class Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Cost-Class-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Cost-Center/Cost-Class-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                   Add Cost Class <span style="display: none;">MC4</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Cost-Class-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Cost-Center/View-Cost-Class-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Cost Class <span style="display: none;">MC4</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                      <?php } else{ }?>

                  <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MCV0' == $row &&  Session::get('usertype')=='superAdmin' || 'MCV0' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class=" <?php if(Request::segment(3) === 'Valuation-Mast' || Request::segment(3) === 'View-Valuation-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Valuation Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Valuation-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Cost-Center/Valuation-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Valuation <span style="display: none;">MC5</span>

                                </a>

                            </li>



                            <li class="<?php if(Request::segment(3) === 'View-Valuation-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Cost-Center/View-Valuation-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Valuation <span style="display: none;">MC5</span>

                                  </a>

                            </li>

                          </ul>

                        </li>


              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>


                         <li class=" <?php if(Request::segment(3) === 'Valuation-Mast' || Request::segment(3) === 'View-Valuation-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Valuation Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Valuation-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Cost-Center/Valuation-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Valuation <span style="display: none;">MC5</span>

                                </a>

                            </li>



                            <li class="<?php if(Request::segment(3) === 'View-Valuation-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Cost-Center/View-Valuation-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Valuation <span style="display: none;">MC5</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                      <?php } else{ }?>

                  <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MCV1' == $row &&  Session::get('usertype')=='superAdmin' || 'MCV1' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class="<?php if(Request::segment(3) === 'Valuation-Tran-Mast' || Request::segment(3) === 'View-Valuation-Tran-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Valuation Trans Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Valuation-Tran-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Cost-Center/Valuation-Tran-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Valuation Trans <span style="display: none;">MC6</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Valuation-Tran-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Cost-Center/View-Valuation-Tran-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Valuation Trans <span style="display: none;">MC6</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

            <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                        <li class="<?php if(Request::segment(3) === 'Valuation-Tran-Mast' || Request::segment(3) === 'View-Valuation-Tran-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Valuation Trans Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Valuation-Tran-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Cost-Center/Valuation-Tran-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Valuation Trans <span style="display: none;">MC6</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Valuation-Tran-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Cost-Center/View-Valuation-Tran-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Valuation Trans <span style="display: none;">MC6</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                      <?php } else{ }?>


              
              

           </ul>

        </li>
<!----- END COST MASTER------>

<!----- COST MASTER------>

<li class="treeview <?php if(Request::segment(3) ==='House-Bank-Mast' || Request::segment(3) ==='View-House-Bank-Mast' || Request::segment(3) ==='Bank-Mast' || Request::segment(3) ==='View-Bank-Mast'  || Request::segment(3) ==='House-Cash-Mast' || Request::segment(3) ==='View-House-Cash-Mast'){ echo "active";}    ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> House Bank / Cash

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
            <ul class="treeview-menu">

           
            
              <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MHB0' == $row &&  Session::get('usertype')=='superAdmin' || 'MHB0' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class="<?php if(Request::segment(3) === 'House-Bank-Mast' || Request::segment(3) === 'View-House-Bank-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> House Bank Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(2) === 'house-bank-mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/House-bank-cash/House-Bank-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add House Bank <span style="display: none;">MH0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-House-Bank-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/House-bank-cash/View-House-Bank-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View House Bank <span style="display: none;">MH0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class="<?php if(Request::segment(3) === 'House-Bank-Mast' || Request::segment(3) === 'View-House-Bank-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> House Bank Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'House-Bank-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/House-bank-cash/House-Bank-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add House Bank <span style="display: none;">MH0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-House-Bank-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/House-bank-cash/View-House-Bank-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View House Bank <span style="display: none;">MH0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>

                    
                  <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MHC0' == $row &&  Session::get('usertype')=='superAdmin' || 'MHC0' == $row && Session::get('usertype')=='user') { 

                ?>

                 <li class=" <?php if(Request::segment(3) === 'house-cash' || Request::segment(3) === 'View-House-Cash-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> House Cash Master
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(2) === 'House-Cash-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/House-bank-cash/House-Cash-Mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add House Cash <span style="display: none;">MH1</span>

                              </a>

                          </li>
                          
                          <li class="<?php if(Request::segment(2) === 'View-House-Cash-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/House-bank-cash/View-House-Cash-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View House Cash <span style="display: none;">MH1</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class=" <?php if(Request::segment(3) === 'House-Cash-Mast' || Request::segment(3) === 'View-House-Cash-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> House Cash Master
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'House-Cash-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/House-bank-cash/House-Cash-Mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add House Cash <span style="display: none;">MH1</span>

                              </a>

                          </li>
                          
                          <li class="<?php if(Request::segment(3) === 'View-House-Cash-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/House-bank-cash/View-House-Cash-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View House Cash <span style="display: none;">MH1</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                      <?php } else{ }?>

                       <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('MHB1' == $row &&  Session::get('usertype')=='superAdmin' || 'MHB1' == $row && Session::get('usertype')=='user') { 



                ?>


                <li class=" <?php if(Request::segment(3) === 'Bank-Mast' || Request::segment(3) === 'View-Bank-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Bank Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(2) === 'Bank-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/House-Bank-Cash/Bank-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Bank <span style="display: none;">MH2</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(2) === 'View-Bank-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/House-Bank-Cash/View-Bank-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Bank <span style="display: none;">MH2</span>

                                  </a>

                            </li>

                          </ul>

                        </li>



                 <?php } else{} } }?>


                    <?php if(Session::get('usertype')=='admin'){ ?>


                    <li class=" <?php if(Request::segment(3) === 'Bank-Mast' || Request::segment(3) === 'View-Bank-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Bank Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Bank-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/House-Bank-Cash/Bank-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Bank <span style="display: none;">MH2</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Bank-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/House-Bank-Cash/View-Bank-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Bank <span style="display: none;">MH2</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                     <?php } else{ }?>


                  

              
              

           </ul>

        </li>
<!----- END HOUSE BANK / CASH MASTER------>


<!----- START TAX MASTER------>

<li class=" <?php if(Request::segment(3) === 'Tax-Mast' || Request::segment(3) ==='View-Tax-Mast' || Request::segment(3) ==='Tax-Indicator-Mast' || Request::segment(3) ==='View-Tax-Indicator-Mast' || Request::segment(3) ==='Tax-Rate-Mast' || Request::segment(3) ==='View-Tax-Rate-Mast' ||Request::segment(3) ==='Tds-Mast' || Request::segment(3)==='View-Tds-Mast' ||  Request::segment(3) ==='Tds-Rate-Mast' || Request::segment(3) ==='View-Tds-Rate-Mast'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Indirect/Direct Tax

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
            <ul class="treeview-menu">

           
            
               <?php  if(isset($Fname)){

                        $Fname = Session::get('form_name');
                        
                        foreach ($Fname as $row) { 

                          if('MIT0' == $row &&  Session::get('usertype')=='superAdmin' || 'MIT0' == $row && Session::get('usertype')=='user') { 

                        ?>
                        <li class=" <?php if(Request::segment(3) ==='Tax-Indicator-Mast' || Request::segment(3) ==='View-Tax-Indicator-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>   
                            Tax Indicator Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) ==='Tax-Indicator-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/InDirect-Direct-Tax/Tax-Indicator-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Tax Indicator  <span style="display: none;">MT0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) ==='View-Tax-Indicator-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tax-Indicator-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Tax Indicator <span style="display: none;">MT0</span> 


                                  </a>

                            </li>

                          </ul>

                        </li>

                <?php } else{} } }?>

                <?php if(Session::get('usertype')=='admin'){ ?>

                      <li class=" <?php if(Request::segment(3) ==='Tax-Indicator-Mast' || Request::segment(3) ==='View-Tax-Indicator-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>   
                            Tax Indicator Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) ==='Tax-Indicator-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/InDirect-Direct-Tax/Tax-Indicator-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Tax Indicator <span style="display: none;">MT0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) ==='View-Tax-Indicator-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tax-Indicator-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Tax Indicator <span style="display: none;">MT0</span>


                                  </a>

                            </li>

                          </ul>

                        </li>

                <?php } else{ }?>

                    
                  
                   <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MIT1' == $row &&  Session::get('usertype')=='superAdmin' || 'MIT1' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class="<?php if(Request::segment(3) === 'Tax-Mast' || Request::segment(3) === 'View-Tax-Mast'){echo "active";} ?>">

                              <a href="#">

                              <i class="fa fa-plus text-aqua"></i> 

                              Tax Master

                              <i class="fa fa-angle-left pull-right"></i>

                              </a>

                               <ul class="treeview-menu">

                              <li class=" <?php if(Request::segment(3) === 'Tax-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/InDirect-Direct-Tax/Tax-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Tax <span style="display: none;">MT1</span>

                                </a>

                              </li>



                              <li class="<?php if(Request::segment(3) === 'View-Tax-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tax-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View Tax <span style="display: none;">MT1</span>

                                </a>

                              </li>

                            </ul>

                          </li>


                <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>


                          <li class="<?php if(Request::segment(3) === 'Tax-Mast' || Request::segment(3) === 'View-Tax-Mast'){echo "active";} ?>">

                              <a href="#">

                              <i class="fa fa-plus text-aqua"></i> 

                              Tax Master

                              <i class="fa fa-angle-left pull-right"></i>

                              </a>

                               <ul class="treeview-menu">

                              <li class=" <?php if(Request::segment(3) === 'Tax-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/InDirect-Direct-Tax/Tax-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Tax <span style="display: none;">MT1</span>

                                </a>

                              </li>



                              <li class="<?php if(Request::segment(3) === 'View-Tax-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tax-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View Tax <span style="display: none;">MT1</span>

                                </a>

                              </li>

                            </ul>

                          </li>

                        <?php } else{ }?>

                       <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MIT2' == $row &&  Session::get('usertype')=='superAdmin' || 'MIT2' == $row && Session::get('usertype')=='user') { 

                ?>

                 <li class="<?php if(Request::segment(3) ==='Tax-Rate-Mast' || Request::segment(3) ==='View-Tax-Rate-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Tax Rate Master
                            <i class="fa fa-angle-left pull-right"></i>
                             <ul class="treeview-menu">

                              <li class=" <?php if(Request::segment(2) === 'tax-rate-master'){echo "active";} ?>">

                                <a href="{{ url('/Master/InDirect-Direct-Tax/Tax-Rate-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Tax Rate <span style="display: none;">MT2</span>

                                </a>

                              </li>



                              <li class="<?php if(Request::segment(3) === 'View-Tax-Rate-Mast'){echo "active";} ?>">

                                    <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tax-Rate-Mast') }}">

                                      <i class="fa fa-circle-o text-red"></i> 

                                    View Tax Rate <span style="display: none;">MT2</span>

                                    </a>

                              </li>

                          </ul>
                          </a>

                            </li>

                <?php } else{} } }?>


                    <?php if(Session::get('usertype')=='admin'){ ?>
                          
                          
                         <li class="<?php if(Request::segment(3) ==='Tax-Rate-Mast' || Request::segment(3) ==='View-Tax-Rate-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Tax Rate Master
                            <i class="fa fa-angle-left pull-right"></i>
                             <ul class="treeview-menu">

                              <li class=" <?php if(Request::segment(3) === 'Tax-Rate-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/InDirect-Direct-Tax/Tax-Rate-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Tax Rate <span style="display: none;">MT2</span>

                                </a>

                              </li>



                              <li class="<?php if(Request::segment(3) === 'View-Tax-Rate-Mast'){echo "active";} ?>">

                                    <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tax-Rate-Mast') }}">

                                      <i class="fa fa-circle-o text-red"></i> 

                                    View Tax Rate <span style="display: none;">MT2</span>

                                    </a>

                              </li>

                          </ul>
                          </a>

                            </li>

                          <?php } else{ }?>


                   <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MTS0' == $row &&  Session::get('usertype')=='superAdmin' || 'MTS0' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class=" <?php if(Request::segment(3) === 'Tds-Mast' || Request::segment(3) === 'View-Tds-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> TDS Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Tds-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/InDirect-Direct-Tax/Tds-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add TDS <span style="display: none;">MT3</span>

                                </a>

                            </li>



                            <li class="<?php if(Request::segment(3) === 'View-Tds-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tds-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View TDS <span style="display: none;">MT3</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>
                        
                        <li class=" <?php if(Request::segment(3) === 'Tds-Mast' || Request::segment(3) === 'View-Tds-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> TDS Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Tds-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/InDirect-Direct-Tax/Tds-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add TDS <span style="display: none;">MT3</span>

                                </a>

                            </li>



                            <li class="<?php if(Request::segment(3) === 'View-Tds-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tds-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View TDS <span style="display: none;">MT3</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                      <?php } else{ }?>

                     <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MTS1' == $row &&  Session::get('usertype')=='superAdmin' || 'MTS1' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class="<?php if(Request::segment(3) === 'Tds-Rate-Mast' || Request::segment(3) === 'View-Tds-Rate-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> TDS Rate Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(2) === 'tds-rate-mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/InDirect-Direct-Tax/Tds-Rate-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add TDS Rate <span style="display: none;">MT4</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Tds-Rate-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tds-Rate-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View TDS Rate <span style="display: none;">MT4</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                        

                        <li class="<?php if(Request::segment(3) === 'Tds-Rate-Mast' || Request::segment(3) === 'View-Tds-Rate-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> TDS Rate Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Tds-Rate-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/InDirect-Direct-Tax/Tds-Rate-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add TDS Rate  <span style="display: none;">MT4</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Tds-Rate-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tds-Rate-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View TDS Rate <span style="display: none;">MT4</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                      <?php } else{ }?>

              
              

           </ul>

        </li>
<!----- END TAX / CASH MASTER------>


<!----- START ITEM MASTER------>

 <li class="treeview <?php if(Request::segment(3) === 'Item-Class-Mast' || Request::segment(3) === 'View-Item-Class-Mast' ||  Request::segment(3) === 'Item-Type-Mast'|| Request::segment(3) ==='View-Item-Type' || Request::segment(3) ==='Item-Rack-Mast' || Request::segment(3) ==='View-Item-Rack-Mast' || Request::segment(3) ==='Item-Category-Mast' || Request::segment(3) ==='View-Item-Category-Mast' || Request::segment(3) ==='Item-Group-Mast' || Request::segment(3) ==='View-Item-Group-Mast' || Request::segment(3) ==='Item-Bal-Mast' || Request::segment(3) ==='View-Item-Bal-Mast'  || Request::segment(3) ==='Item-Master' || Request::segment(3) ==='View-Item-Master' || Request::segment(3) === 'ItemUM_Mast' || Request::segment(3) ==='View-ItemUM_Mast' || Request::segment(3) === 'Item-Category-Quality-Mast' || Request::segment(3) === 'View-Item-Category-Quality-Mast' || Request::segment(3) === 'Item-Quality-Mast' || Request::segment(3) === 'View-Item-Quality-Mast' || Request::segment(3) ==='view-Um-Mast' || Request::segment(3) ==='Um-Mast' || Request::segment(3) === 'Item-Schedule-Mast' || Request::segment(3) === 'View-Item-Schedule-Mast'){ echo "active";}    ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Item

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
            <ul class="treeview-menu">

           
            
              <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MII0' == $row &&  Session::get('usertype')=='superAdmin' || 'MII0' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class=" <?php if(Request::segment(3) === 'Item-Type-Mast' || Request::segment(3) === 'View-Item-Type'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>  Item Type Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Item-Type-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Item-Type-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Type <span style="display: none;">MI0</span>

                                </a>

                            </li>



                            <li class="<?php if(Request::segment(3) === 'View-Item-Type'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item/View-Item-Type') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Type <span style="display: none;">MI0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>


              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>


                    <li class=" <?php if(Request::segment(3) === 'Item-Type-Mast' || Request::segment(3) === 'View-Item-Type'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>  Item Type Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Item-Type-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Item-Type-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Type <span style="display: none;">MI0</span>

                                </a>

                            </li>



                            <li class="<?php if(Request::segment(3) === 'View-Item-Type'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item/View-Item-Type') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Type <span style="display: none;">MI0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                      <?php } else{ }?>

                    
                  
                   <?php  if(isset($Fname)){

                      $Fname = Session::get('form_name');
                      
                      foreach ($Fname as $row) { 

                        if('MII1' == $row &&  Session::get('usertype')=='superAdmin' || 'MII1' == $row && Session::get('usertype')=='user') { 

                      ?>

                        <li class=" <?php if(Request::segment(3) ==='Item-Master' || Request::segment(3) ==='View-Item-Master'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>   
                            Item Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) ==='Item-Master'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Item-Master') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Master <span style="display: none;">MI1</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) ==='View-Item-Master'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item/View-Item-Master') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Master <span style="display: none;">MI1</span>


                                  </a>

                            </li>

                          </ul>

                        </li>


                      <?php } else{} } }?>


                      <?php if(Session::get('usertype')=='admin'){ ?>

                        <li class=" <?php if(Request::segment(3) ==='Item-Master' || Request::segment(3) ==='View-Item-Master'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>   
                            Item Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) ==='Item-Master'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Item-Master') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Master <span style="display: none;">MI1</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) ==='View-Item-Master'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item/View-Item-Master') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Master <span style="display: none;">MI1</span>


                                  </a>

                            </li>

                          </ul>

                        </li>


                      <?php } else{ }?>

                      <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MII2' == $row &&  Session::get('usertype')=='superAdmin' || 'MII2' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class="<?php if(Request::segment(3) === 'Item-Group-Mast' || Request::segment(3) === 'View-Item-Group-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Item Group Master
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Item-Group-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/Item/Item-Group-Mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Item Group <span style="display: none;">MI2</span>

                              </a>

                        </li>



                          <li class="<?php if(Request::segment(3) === 'View-Item-Group-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/View-Item-Group-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View Item Group <span style="display: none;">MI2</span>

                                </a>

                          </li>

                        </ul>

                      </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                     <li class="<?php if(Request::segment(3) === 'Item-Group-Mast' || Request::segment(3) === 'View-Item-Group-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Item Group Master
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Item-Group-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/Item/Item-Group-Mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Item Group <span style="display: none;">MI2</span>

                              </a>

                        </li>



                          <li class="<?php if(Request::segment(3) === 'View-Item-Group-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/View-Item-Group-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View Item Group <span style="display: none;">MI2</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                    <?php } else{ }?>


              <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MII3' == $row &&  Session::get('usertype')=='superAdmin' || 'MII3' == $row && Session::get('usertype')=='user') { 

              ?>

                <li class="<?php if(Request::segment(3) === 'Item-Category-Mast' || Request::segment(3) === 'View-Item-Category-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Item Category Master
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Item-Category-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/Item/Item-Category-Mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Item Category <span style="display: none;">MI3</span>

                              </a>

                      </li>
                          <li class="<?php if(Request::segment(3) === 'View-Item-Category-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/View-Item-Category-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View Item Category  <span style="display: none;">MI3</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                <?php } else{} } }?>

                <?php if(Session::get('usertype')=='admin'){ ?>

                  <li class="<?php if(Request::segment(3) === 'Item-Category-Mast' || Request::segment(3) === 'View-Item-Category-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Item Category Master
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Item-Category-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/Item/Item-Category-Mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Item Category <span style="display: none;">MI3</span>

                              </a>

                      </li>



                          <li class="<?php if(Request::segment(3) === 'View-Item-Category-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/View-Item-Category-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View Item Category <span style="display: none;">MI3</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                    <?php } else{ }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class="<?php if(Request::segment(3) === 'Item-Schedule-Mast' || Request::segment(3) === 'View-Item-Schedule-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Item Schedule Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Item-Schedule-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Item-Schedule-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Schedule <span style="display: none;">MI3</span>

                                </a>

                        </li>



                          <li class="<?php if(Request::segment(3) === 'View-Item-Schedule-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/View-Item-Schedule-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View Item Schedule <span style="display: none;">MI3</span>

                                </a>

                          </li>

                        </ul>

                      </li>

                    <?php } else{ }?>


                      <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MII4' == $row &&  Session::get('usertype')=='superAdmin' || 'MII4' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class=" <?php if(Request::segment(3) === 'Item-Class-Mast' || Request::segment(3) === 'View-Item-Class-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>  Item Class Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(2) === 'form-mast-item-class'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Item-Class-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Class <span style="display: none;">MI4</span>

                                </a>

                        </li>
                            <li class="<?php if(Request::segment(3) === 'View-Item-Class-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item/View-Item-Class-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Class <span style="display: none;">MI4</span>

                                  </a>

                            </li>

                          </ul>

                      </li>


              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class=" <?php if(Request::segment(3) === 'Item-Class-Mast' || Request::segment(3) === 'View-Item-Class-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>  Item Class Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Item-Class-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Item-Class-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Class <span style="display: none;">MI4</span>

                                </a>

                        </li>



                            <li class="<?php if(Request::segment(3) === 'View-Item-Class-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item/View-Item-Class-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Class <span style="display: none;">MI4</span>

                                  </a>

                            </li>

                          </ul>

                      </li>

                    <?php } else{ }?>

                    <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MII4' == $row &&  Session::get('usertype')=='superAdmin' || 'MII4' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class=" <?php if( Request::segment(3) === 'Item-Quality-Mast' || Request::segment(3) === 'View-Item-Quality-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>  Item Quality Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'form-mast-item-quality'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Item-Quality-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Quality <span style="display: none;">MI4</span>

                                </a>

                        </li>
                            <li class="<?php if(Request::segment(3) === 'view-mast-item-class'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item/View-Item-Quality-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Quality <span style="display: none;">MI4</span>

                                  </a>

                            </li>

                          </ul>

                      </li>


              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class=" <?php if( Request::segment(3) === 'Item-Quality-Mast' || Request::segment(3) === 'View-Item-Quality-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>  Item Quality Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Item-Quality-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Item-Quality-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Quality <span style="display: none;">MI4</span>

                                </a>

                        </li>



                            <li class="<?php if(Request::segment(3) === 'View-Item-Quality-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item/View-Item-Quality-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Quality <span style="display: none;">MI4</span>

                                  </a>

                            </li>

                          </ul>

                      </li>

                    <?php } else{ }?>


                    <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MII4' == $row &&  Session::get('usertype')=='superAdmin' || 'MII4' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class=" <?php if(Request::segment(3) === 'Item-Category-Quality-Mast' || Request::segment(3) === 'View-Item-Category-Quality-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>  Item Category Quality 
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Item-Category-Quality-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Item-Category-Quality-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Cate Quality <span style="display: none;">MI4</span>

                                </a>

                        </li>
                            <li class="<?php if(Request::segment(3) === 'View-Item-Category-Quality-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item/View-Item-Category-Quality-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Cate Quality  <span style="display: none;">MI4</span>

                                  </a>

                            </li>

                          </ul>

                      </li>


              <?php } else{} } }?>

               <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class=" <?php if(Request::segment(3) === 'Item-Category-Quality-Mast' || Request::segment(3) === 'View-Item-Category-Quality-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>  Item Category Quality 
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Item-Category-Quality-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Item-Category-Quality-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Cate Quality <span style="display: none;">MI4</span>

                                </a>

                        </li>



                            <li class="<?php if(Request::segment(3) === 'View-Item-Category-Quality-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item/View-Item-Category-Quality-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Cate Quality <span style="display: none;">MI4</span>

                                  </a>

                            </li>

                          </ul>

                      </li>

                    <?php } else{ }?>


                      <?php 

              if(isset($Fname)){

              $Fname = Session::get('form_name');



              foreach ($Fname as $row) {

                

                if('MII5' == $row &&  Session::get('usertype')=='superAdmin' || 'MII5' == $row && Session::get('usertype')=='user') { 



              ?>


        <li class="<?php if(Request::segment(3) ==='ItemUM_Mast' || Request::segment(3) ==='View-ItemUM_Mast'){echo "active";} ?>">
               

                  <a href="pages/examples/login.html">

                    <i class="fa fa-plus text-aqua"></i> 

                     Item Um Master

                    <i class="fa fa-angle-left pull-right"></i> 

                  </a>



                  <ul class="treeview-menu">

                    <li class=" <?php if(Request::segment(3) ==='ItemUM_Mast'){echo "active";} ?>">

                      <a href="{{ url('/Master/Item/ItemUM_Mast') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Item Um <span style="display: none;">MI5</span>

                      </a>

                    </li>


 
                    <li class=" <?php if(Request::segment(3) ==='View-ItemUM_Mast'){echo "active";} ?>">

                      <a href="{{ url('/Master/Item/View-ItemUM_Mast') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Item Um <span style="display: none;">MI5</span>

                      </a>

                    </li>

                  </ul>

                </li>

                <?php } else{} } }?>



                 <?php if(Session::get('usertype')=='admin'){ ?>

                   <li class="<?php if(Request::segment(3) ==='ItemUM_Mast' || Request::segment(3) ==='View-ItemUM_Mast'){echo "active";} ?>">

                  <a href="pages/examples/login.html">

                    <i class="fa fa-plus text-aqua"></i> 

                     Item Um Master

                    <i class="fa fa-angle-left pull-right"></i> 

                  </a>



                  <ul class="treeview-menu">

                    <li class=" <?php if(Request::segment(3) ==='ItemUM_Mast'){echo "active";} ?>">

                      <a href="{{ url('/Master/Item/ItemUM_Mast') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Item Um <span style="display: none;">MI5</span>

                      </a>

                    </li>



                    <li class=" <?php if(Request::segment(3) ==='View-ItemUM_Mast'){echo "active";} ?>">

                      <a href="{{ url('/Master/Item/View-ItemUM_Mast') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Item Um <span style="display: none;">MI5</span>

                      </a>

                    </li>

                  </ul>

                </li>



             <?php } else{} ?>

              
              <?php  if(isset($Fname)){

                      $Fname = Session::get('form_name');
                      
                      foreach ($Fname as $row) { 

                        if('MII6' == $row &&  Session::get('usertype')=='superAdmin' || 'MII6' == $row && Session::get('usertype')=='user') { 

                      ?>

                      <li class="<?php if(Request::segment(3) ==='Um-Mast' || Request::segment(3) ==='view-Um-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>   
                            Um Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) ==='Um-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Um-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Um Master <span style="display: none;">MI6</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) ==='view-Um-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item/view-Um-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 
 
                                    View Um Master  <span style="display: none;">MI6</span>


                                  </a>

                            </li>

                          </ul>

                        </li>

                      <?php } else{} } }?>

                      <?php if(Session::get('usertype')=='admin'){ ?>

                      <li class="<?php if(Request::segment(3) ==='Um-Mast' || Request::segment(3) ==='view-Um-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>   
                            Um Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) ==='Um-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Um-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Um Master <span style="display: none;">MI6</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) ==='view-Um-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item/view-Um-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Um Master <span style="display: none;">MI6</span>


                                  </a>

                            </li>

                          </ul>

                        </li>

                      <?php } else{ }?>


                      <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MII7' == $row &&  Session::get('usertype')=='superAdmin' || 'MII7' == $row && Session::get('usertype')=='user') { 

                ?>

                 <li class=" <?php if(Request::segment(3) === 'Item-Bal-Mast' || Request::segment(3) === 'View-Item-Bal-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Item Balance Master
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Item-Bal-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/Item/Item-Bal-Mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Item Balance <span style="display: none;">MI7</span>

                              </a>

                          </li>
                          
                          <li class="<?php if(Request::segment(3) === 'View-Item-Bal-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/View-Item-Bal-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View Item Balance <span style="display: none;">MI7</span>

                                </a>

                          </li>

                        </ul>

                    </li>


              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                  <li class=" <?php if(Request::segment(3) === 'Item-Bal-Mast' || Request::segment(3) === 'View-Item-Bal-Mast'){echo "active";} ?>">

                        <a href="#"><i class="fa fa-plus text-aqua"></i> Item Balance Master
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Item-Bal-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/Item/Item-Bal-Mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Item Balance <span style="display: none;">MI7</span>

                              </a>

                          </li>
                          
                          <li class="<?php if(Request::segment(3) === 'View-Item-Bal-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/View-Item-Bal-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View Item Balance <span style="display: none;">MI7</span>

                                </a>

                          </li>

                        </ul>

                    </li>

                  <?php } else{ }?>


                  <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MII8' == $row &&  Session::get('usertype')=='superAdmin' || 'MII8' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class="<?php if(Request::segment(3) === 'Item-Rack-Mast' || Request::segment(3) === 'View-Item-Rack-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Item Rack Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Item-Rack-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Item-Rack-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Rack  <span style="display: none;">MI8</span>

                                </a>

                            </li>



                            <li class="<?php if(Request::segment(3) === 'View-Item-Rack-Mast'){echo "active";} ?>">
 
                                  <a href="{{ url('/Master/Item/View-Item-Rack-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Rack  <span style="display: none;">MI8</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class="<?php if(Request::segment(3) === 'Item-Rack-Mast' || Request::segment(3) === 'View-Item-Rack-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Item Rack Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Item-Rack-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Item-Rack-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Rack  <span style="display: none;">MI8</span>

                                </a>

                            </li>



                            <li class="<?php if(Request::segment(3) === 'View-Item-Rack-Mast'){echo "active";} ?>">
 
                                  <a href="{{ url('/Master/Item/View-Item-Rack-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Rack <span style="display: none;">MI8</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                      <?php } else{ }?>

                      <li class=" <?php if(Request::segment(3) === 'Add-Item-Batch-balance' || Request::segment(3) === 'View-Item-Batch-balance'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Item Batch Bal Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Add-Item-Batch-balance'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Add-Item-Batch-balance') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Batch Bal <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Item-Batch-balance'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item/View-Item-Batch-balance') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Batch Bal <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                      <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MII8' == $row &&  Session::get('usertype')=='superAdmin' || 'MII8' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class="<?php if(Request::segment(3) === 'Add-Storage-location-Mast' || Request::segment(3) === 'View-Storage-location-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Storage Location Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Add-Storage-location-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Add-Storage-location-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Storage Location  <span style="display: none;">MI8</span>

                                </a>

                            </li>



                            <li class="<?php if(Request::segment(3) === 'View-Storage-location-Mast'){echo "active";} ?>">
 
                                  <a href="{{ url('/Master/Item/View-Storage-location-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Storage Location <span style="display: none;">MI8</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                <?php } else{} } }?>


                      <?php if(Session::get('usertype')=='admin'){ ?>

                        
                        <li class=" <?php if(Request::segment(3) === 'Add-Storage-location-Mast' || Request::segment(3) === 'View-Storage-location-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Storage Location Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Add-Storage-location-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item/Add-Storage-location-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Storage Location <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Storage-location-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item/View-Storage-location-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Storage Location <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>


                     <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MIB0' == $row &&  Session::get('usertype')=='superAdmin' || 'MIB0' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class="">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Bill Of Material
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class="">

                                <a href="#">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Bill  <span style="display: none;">MI9</span>

                                </a>

                            </li>



                            <li class="<?php if(Request::segment(2) === 'view-mast-item-rack'){echo "active";} ?>">
 
                                  <a href="">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Bill  <span style="display: none;">MI9</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class="">

                          <a href="#"><i class="fa fa-plus text-aqua"></i> Bill Of Material
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" ">

                                <a href="#">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Bill <span style="display: none;">MI9</span>

                                </a>

                            </li>



                            <li class="">
 
                                  <a href="#">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Bill <span style="display: none;">MI9</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                      <?php } else{ }?>



           </ul>

        </li>
<!----- END TAX / CASH MASTER------>

<!----- START ITEM TAX MASTER------>

 <li class="treeview <?php if(Request::segment(3) ==='Hsn-Mast' || Request::segment(3) ==='View-Hsn-Mast' || Request::segment(3) ==='Hsn-Rate-Mast' || Request::segment(3) ==='View-Hsn-Rate-Mast'){ echo "active";}    ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Item Tax

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>


            <ul class="treeview-menu">

           
            
              <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MIH0' == $row &&  Session::get('usertype')=='superAdmin' || 'MIH0' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class="<?php if(Request::segment(3) ==='Hsn-Mast' || Request::segment(3) ==='View-Hsn-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>HSN Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) ==='Hsn-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item-Tax/Hsn-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add HSN <span style="display: none;">MIT0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) ==='View-Hsn-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item-Tax/View-Hsn-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View HSN <span style="display: none;">MIT0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

              <?php } else{} } }?>

              <?php if(Session::get('usertype')=='admin'){ ?>

                        
                        <li class="<?php if(Request::segment(3) ==='Hsn-Mast' || Request::segment(3) ==='View-Hsn-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>HSN Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) ==='Hsn-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item-Tax/Hsn-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add HSN <span style="display: none;">MIT0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) ==='View-Hsn-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item-Tax/View-Hsn-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View HSN <span style="display: none;">MIT0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>

                    
                  
                   <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MIH1' == $row &&  Session::get('usertype')=='superAdmin' || 'MIH1' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class=" <?php if(Request::segment(3) ==='Hsn-Rate-Mast' || Request::segment(3) ==='View-Hsn-Rate-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>HSN Rate Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) ==='Hsn-Rate-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item-Tax/Hsn-Rate-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add HSN Rate <span style="display: none;">MIT0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) ==='View-Hsn-Rate-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item-Tax/View-Hsn-Rate-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View HSN Rate <span style="display: none;">MIT0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

              <?php } else{} } }?>

              <?php if(Session::get('usertype')=='admin'){ ?>

                        
                         <li class=" <?php if(Request::segment(3) ==='Hsn-Rate-Mast' || Request::segment(3) ==='View-Hsn-Rate-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>HSN Rate Master 
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) ==='hsn-rate-master'){echo "active";} ?>">

                                <a href="{{ url('/Master/Item-Tax/Hsn-Rate-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add HSN Rate <span style="display: none;">MIT0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) ==='View-Hsn-Rate-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Item-Tax/View-Hsn-Rate-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 
 
                                    View HSN Rate <span style="display: none;">MIT0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>


           </ul>

        </li>
<!----- END TAX / CASH MASTER------>





<li class="<?php if(Request::segment(1) ==='form-mast-task' || Request::segment(1) ==='view-mast-task'){echo "active";} ?>">

        <a href="#"><i class="fa fa-plus" style="color:antiquewhite;"></i>Task Master
              <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
                
              <li class=" <?php if(Request::segment(1) ==='form-mast-task'){echo "active";} ?>">

                    <a href="{{ url('/form-mast-task') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Task <span style="display: none;">MIT0</span>

                    </a>

                </li> 

                <li class="<?php if(Request::segment(1) ==='view-mast-task'){echo "active";} ?>">

                      <a href="{{ url('/view-mast-task') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Task <span style="display: none;">MIT0</span>

                      </a>

                </li>

            </ul>

      </li>

 


<!-- MAINTANANCE -->

  <li class="treeview <?php if(Request::segment(3) ==='View-Equipment-Group-Mast' || Request::segment(3) ==='Equipment-Group-Mast' || Request::segment(3) === 'Equipment-Category-Mast' || Request::segment(3) === 'View-Equipment-Category-Mast' || Request::segment(3) === 'Equipment-Mast' || Request::segment(3) === 'View-Equipment-Mast' || Request::segment(3) === 'Equipment-Class-Mast' || Request::segment(3) === 'View-Equipment-Class-Mast' || Request::segment(3) === 'Equipment-Type-Mast' || Request::segment(3) === 'View-Equipment-Type-Mast' || Request::segment(3) === 'Equipment-Location-Mast' || Request::segment(3) === 'View-Equipment-Location-Mast' || Request::segment(3) === 'Equipment-Activity-Mast' || Request::segment(3) === 'View-Equipment-Activity-Mast'){ echo "active";}    ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Maintenance 

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>


            <ul class="treeview-menu">

           
            
             <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

                ?>

                <li class=" <?php if(Request::segment(3) === 'Equipment-Mast' || Request::segment(3) === 'View-Equipment-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Equipment Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Equipment-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Maintenance/Equipment-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Equipment <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Equipment-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Maintenance/View-Equipment-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Equipment <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                        
                        <li class=" <?php if(Request::segment(3) === 'Equipment-Mast' || Request::segment(3) === 'View-Equipment-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Equipment Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Equipment-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Maintenance/Equipment-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Equipment <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Equipment-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Maintenance/View-Equipment-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Equipment <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>

                    
                  
                  <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOD0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOD0' == $row && Session::get('usertype')=='user') { 

                ?>

                 <li class=" <?php if(Request::segment(3) === 'Equipment-Group-Mast' || Request::segment(3) === 'View-Equipment-Group-Mast'){echo "active";} ?>">

                        <a href="#">
                          <i class="fa fa-plus text-aqua"></i> Equipment Group
                            <i class="fa fa-angle-left pull-right"></i>
                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Department-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Maintenance/Equipment-Group-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Equipment Group <span style="display: none;">MO1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Equipment-Group-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Maintenance/View-Equipment-Group-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Equipment Group <span style="display: none;">MO1</span>

                                </a>

                          </li>

                        </ul>
                        </a>

                    </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                   <li class=" <?php if(Request::segment(3) === 'Equipment-Group-Mast' || Request::segment(3) === 'View-Equipment-Group-Mast'){echo "active";} ?>">

                        <a href="#">
                          <i class="fa fa-plus text-aqua"></i> Equipment Group
                            <i class="fa fa-angle-left pull-right"></i>
                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Equipment-Group-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Maintenance/Equipment-Group-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Equipment Group <span style="display: none;">MO1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Equipment-Group-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Maintenance/View-Equipment-Group-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Equipment Group <span style="display: none;">MO1</span>

                                </a>

                          </li>

                        </ul>
                        </a>

                    </li>

                    <?php } else{ }?>



            <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOD0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOD0' == $row && Session::get('usertype')=='user') { 

                ?>

                 <li class=" <?php if(Request::segment(3) === 'Equipment-Category-Mast' || Request::segment(3) === 'View-Equipment-Category-Mast'){echo "active";} ?>">

                        <a href="#">
                          <i class="fa fa-plus text-aqua"></i> Equipment Category
                            <i class="fa fa-angle-left pull-right"></i>
                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Equipment-Category-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Maintenance/Equipment-Category-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Equipment Category <span style="display: none;">MO1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Equipment-Category-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Maintenance/View-Equipment-Category-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Equipment Category <span style="display: none;">MO1</span>

                                </a>

                          </li>

                        </ul>
                        </a>

                    </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                   <li class=" <?php if(Request::segment(3) === 'Equipment-Category-Mast' || Request::segment(3) === 'View-Equipment-Category-Mast'){echo "active";} ?>">

                        <a href="#">
                          <i class="fa fa-plus text-aqua"></i> Equipment Category
                            <i class="fa fa-angle-left pull-right"></i>
                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Equipment-Category-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Maintenance/Equipment-Category-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Equipment Category <span style="display: none;">MO1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Equipment-Category-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Maintenance/View-Equipment-Category-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Equipment Category <span style="display: none;">MO1</span>

                                </a>

                          </li>

                        </ul>
                        </a>

                    </li>

                    <?php } else{ }?>


                    <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOD0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOD0' == $row && Session::get('usertype')=='user') { 

                ?>

                 <li class=" <?php if(Request::segment(3) === 'Equipment-Class-Mast' || Request::segment(3) === 'View-Equipment-Class-Mast'){echo "active";} ?>">

                        <a href="#">
                          <i class="fa fa-plus text-aqua"></i> Equipment Class
                            <i class="fa fa-angle-left pull-right"></i>
                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Equipment-Class-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Maintenance/Equipment-Class-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Equipment Class <span style="display: none;">MO1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Equipment-Class-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Maintenance/View-Equipment-Class-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Equipment Class <span style="display: none;">MO1</span>

                                </a>

                          </li>

                        </ul>
                        </a>

                    </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                   <li class=" <?php if(Request::segment(3) === 'Equipment-Class-Mast' || Request::segment(3) === 'View-Equipment-Class-Mast'){echo "active";} ?>">

                        <a href="#">
                          <i class="fa fa-plus text-aqua"></i> Equipment Class
                            <i class="fa fa-angle-left pull-right"></i>
                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Equipment-Class-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Maintenance/Equipment-Class-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Equipment Class <span style="display: none;">MO1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Equipment-Class-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Maintenance/View-Equipment-Class-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Equipment Class <span style="display: none;">MO1</span>

                                </a>

                          </li>

                        </ul>
                        </a>

                    </li>

                    <?php } else{ }?>


                     <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOD0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOD0' == $row && Session::get('usertype')=='user') { 

                ?>

                 <li class=" <?php if(Request::segment(3) === 'Equipment-Type-Mast' || Request::segment(3) === 'View-Equipment-Type-Mast'){echo "active";} ?>">

                        <a href="#">
                          <i class="fa fa-plus text-aqua"></i> Equipment Type
                            <i class="fa fa-angle-left pull-right"></i>
                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Equipment-Type-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Maintenance/Equipment-Type-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Equipment Type <span style="display: none;">MO1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Equipment-Type-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Maintenance/View-Equipment-Type-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Equipment Type <span style="display: none;">MO1</span>

                                </a>

                          </li>

                        </ul>
                        </a>

                    </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                   <li class=" <?php if(Request::segment(3) === 'Equipment-Type-Mast' || Request::segment(3) === 'View-Equipment-Type-Mast'){echo "active";} ?>">

                        <a href="#">
                          <i class="fa fa-plus text-aqua"></i> Equipment Type
                            <i class="fa fa-angle-left pull-right"></i>
                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Equipment-Type-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Maintenance/Equipment-Type-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Equipment Type <span style="display: none;">MO1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Equipment-Type-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Maintenance/View-Equipment-Type-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Equipment Type <span style="display: none;">MO1</span>

                                </a>

                          </li>

                        </ul>
                        </a>

                    </li>

                    <?php } else{ }?>


                    <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOD0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOD0' == $row && Session::get('usertype')=='user') { 

                ?>

                 <li class=" <?php if(Request::segment(3) === 'Equipment-Location-Mast' || Request::segment(3) === 'View-Equipment-Location-Mast'){echo "active";} ?>">

                        <a href="#">
                          <i class="fa fa-plus text-aqua"></i> Equipment Location
                            <i class="fa fa-angle-left pull-right"></i>
                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Equipment-Location-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Maintenance/Equipment-Location-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Eqpt Location <span style="display: none;">MO1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Equipment-Location-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Maintenance/View-Equipment-Location-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Eqpt Location <span style="display: none;">MO1</span>

                                </a>

                          </li>

                        </ul>
                        </a>

                    </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                   <li class=" <?php if(Request::segment(3) === 'Equipment-Location-Mast' || Request::segment(3) === 'View-Equipment-Location-Mast'){echo "active";} ?>">

                        <a href="#">
                          <i class="fa fa-plus text-aqua"></i> Equipment Location
                            <i class="fa fa-angle-left pull-right"></i>
                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Equipment-Location-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Maintenance/Equipment-Location-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Eqpt Location <span style="display: none;">MO1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Equipment-Location-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Maintenance/View-Equipment-Location-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Eqpt Location <span style="display: none;">MO1</span>

                                </a>

                          </li>

                        </ul>
                        </a>

                    </li>

                    <?php } else{ }?>


                    <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOD0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOD0' == $row && Session::get('usertype')=='user') { 

                ?>

                 <li class=" <?php if(Request::segment(3) === 'Department-Mast' || Request::segment(3) === 'View-Department-Mast'){echo "active";} ?>">

                        <a href="#">
                          <i class="fa fa-plus text-aqua"></i> Equipment Activity
                            <i class="fa fa-angle-left pull-right"></i>
                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Department-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/other/Department-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Equipment Activity <span style="display: none;">MO1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Department-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/other/View-Department-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Equipment Activity <span style="display: none;">MO1</span>

                                </a>

                          </li>

                        </ul>
                        </a>

                    </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                   <li class=" <?php if(Request::segment(3) === 'Equipment-Activity-Mast' || Request::segment(3) === 'View-Equipment-Activity-Mast'){echo "active";} ?>">

                        <a href="#">
                          <i class="fa fa-plus text-aqua"></i> Equipment Activity
                            <i class="fa fa-angle-left pull-right"></i>
                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Equipment-Activity-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Maintenance/Equipment-Activity-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Equipment Activity <span style="display: none;">MO1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Equipment-Activity-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Maintenance/View-Equipment-Activity-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Equipment Activity <span style="display: none;">MO1</span>

                                </a>

                          </li>

                        </ul>
                        </a>

                    </li>

                    <?php } else{ }?>
                  

           </ul>

        </li>
  <!-- MAINTANANCE -->

   <!-- COLD STORAGE  -->

  <li class="treeview <?php if(Request::segment(3) ==='View-Cold-storage-Mast' || Request::segment(3) ==='Cold-storage-Mast' || Request::segment(3) === 'Item-Packing-Mast' || Request::segment(3) === 'View-Item-Packing-Mast' || Request::segment(3) === 'Vehicle-entry-Mast' || Request::segment(3) === 'View-Vehicle-entry-Mast' || Request::segment(3) === 'Inward-slip-Mast' || Request::segment(3) === 'View-Inward-slip-Mast' || Request::segment(3) === 'Block-storage-Mast' || Request::segment(3) === 'View-Block-storage-Mast' || Request::segment(3) === 'Floor-storage-Mast' || Request::segment(3) === 'View-Floor-storage-Mast' || Request::segment(3) === 'Bing-storage-Mast' || Request::segment(3) === 'View-Bing-storage-Mast' || Request::segment(3) === 'Outward-Gate-Pass-Mast' || Request::segment(3) === 'View-Outward-Gate-Pass-Mast' || Request::segment(3) === 'Add-Seasonal-Mast' || Request::segment(3) === 'View-Seasonal-Mast' || Request::segment(3) === 'Add-Chamber-Mast' || Request::segment(3) === 'View-Chamber-Mast' || Request::segment(3) === 'Add-Storage-location-Mast' || Request::segment(3) === 'View-Storage-location-Mast' || Request::segment(3) === 'Add-Acc-Item-Rate-Mast' || Request::segment(3) === 'View-Acc-Item-Rate-Mast'){ echo "active";}    ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Cold Storage 

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>


            <ul class="treeview-menu">
                  
                  <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOD0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOD0' == $row && Session::get('usertype')=='user') { 

                ?>

                 <li class=" <?php if(Request::segment(3) === 'Item-Packing-Mast' || Request::segment(3) === 'View-Item-Packing-Mast'){echo "active";} ?>">

                        <a href="#">
                          <i class="fa fa-plus text-aqua"></i> Item Packing 
                            <i class="fa fa-angle-left pull-right"></i>
                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Item-Packing-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/ColdStorage/Item-Packing-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Item Packing <span style="display: none;">MO1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Item-Packing-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/ColdStorage/View-Item-Packing-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Item Packing <span style="display: none;">MO1</span>

                                </a>

                          </li>

                        </ul>
                        </a>

                    </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                   <li class=" <?php if(Request::segment(3) === 'Item-Packing-Mast' || Request::segment(3) === 'View-Item-Packing-Mast'){echo "active";} ?>">

                        <a href="#">
                          <i class="fa fa-plus text-aqua"></i> Item Packing
                            <i class="fa fa-angle-left pull-right"></i>
                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Item-Packing-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/ColdStorage/Item-Packing-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Item Packing <span style="display: none;">MO1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Item-Packing-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/ColdStorage/View-Item-Packing-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Item Packing <span style="display: none;">MO1</span>

                                </a>

                          </li>

                        </ul>
                        </a>

                    </li>

                    <?php } else{ }?>


                    <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

                ?>
                <li class=" <?php if(Request::segment(3) === 'Cold-storage-Mast' || Request::segment(3) === 'View-Cold-storage-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Cold Storage
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Cold-storage-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/ColdStorage/Cold-storage-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Cold Storage <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Vehicle-entry-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/ColdStorage/View-Cold-storage-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Cold Storage <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                        
                        <li class=" <?php if(Request::segment(3) === 'Cold-storage-Mast' || Request::segment(3) === 'View-Cold-storage-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Cold Storage Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Cold-storage-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/ColdStorage/Cold-storage-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Cold Storage <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Cold-storage-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/ColdStorage/View-Cold-storage-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Cold Storage <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>

                      <?php if(Session::get('usertype')=='admin'){ ?>

                        
                        <li class=" <?php if(Request::segment(3) === 'Add-Chamber-Mast' || Request::segment(3) === 'View-Chamber-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Chamber Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Add-Chamber-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/ColdStorage/Add-Chamber-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Chamber Master <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Chamber-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/ColdStorage/View-Chamber-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Chamber Master <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>

                      <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

                ?>
                <li class=" <?php if(Request::segment(3) === 'Floor-storage-Mast' || Request::segment(3) === 'View-Floor-storage-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Floor Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Floor-storage-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/ColdStorage/Floor-storage-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Floor <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Floor-storage-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/ColdStorage/View-Floor-storage-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Floor <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                        
                        <li class=" <?php if(Request::segment(3) === 'Floor-storage-Mast' || Request::segment(3) === 'View-Floor-storage-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Floor Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Floor-storage-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/ColdStorage/Floor-storage-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Floor <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Floor-storage-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/ColdStorage/View-Floor-storage-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Floor <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>


                      <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

                ?>
                <li class=" <?php if(Request::segment(3) === 'Block-storage-Mast' || Request::segment(3) === 'View-Block-storage-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Block Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Block-storage-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/ColdStorage/Block-storage-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Block <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Block-storage-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/ColdStorage/View-Block-storage-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Block <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                        
                        <li class=" <?php if(Request::segment(3) === 'Block-storage-Mast' || Request::segment(3) === 'View-Block-storage-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Block Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Block-storage-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/ColdStorage/Block-storage-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Block <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Block-storage-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/ColdStorage/View-Block-storage-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Block <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>


            <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

                ?>
                <li class=" <?php if(Request::segment(3) === 'Bing-storage-Mast' || Request::segment(3) === 'View-Bing-storage-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Bean Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Bing-storage-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/ColdStorage/Bing-storage-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Bean <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Bing-storage-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/ColdStorage/View-Bing-storage-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Bean <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                        
                        <li class=" <?php if(Request::segment(3) === 'Bing-storage-Mast' || Request::segment(3) === 'View-Bing-storage-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Bean Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Bing-storage-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/ColdStorage/Bing-storage-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Bean <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Bing-storage-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/ColdStorage/View-Bing-storage-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Bean <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>
                      <?php if(Session::get('usertype')=='admin'){ ?>

                        
                        <li class=" <?php if(Request::segment(3) === 'Add-Seasonal-Mast' || Request::segment(3) === 'View-Seasonal-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Seasonal Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Add-Seasonal-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/ColdStorage/Add-Seasonal-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Seasonal Master <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Seasonal-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/ColdStorage/View-Seasonal-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Seasonal Master <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>

                    
                      <?php if(Session::get('usertype')=='admin'){ ?>

                        
                        <li class=" <?php if(Request::segment(3) === 'Add-Acc-Item-Rate-Mast' || Request::segment(3) === 'View-Acc-Item-Rate-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Acc Item Rate Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Add-Seasonal-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/ColdStorage/Add-Acc-Item-Rate-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Acc Item Rate Master <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Acc-Item-Rate-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/ColdStorage/View-Acc-Item-Rate-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Acc Item Rate Master <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>

             
           </ul>

        </li>
  <!-- COLD STORAGE -->

  <!-- START C AND F MASTER  -------->
        
        <li class="treeview <?php if(Request::segment(1) ==='form-mast-destination' || Request::segment(1) ==='view-mast-destination' || Request::segment(1) ==='form-mast-depot' || Request::segment(1) ==='view-mast-depot'){ echo "active";}    ?>">

    <a href="#">

      <i class="fa fa-plus" style="color:antiquewhite;"></i> C and F

      <i class="fa fa-angle-left pull-right"></i>

    </a>

    <ul class="treeview-menu">

      <li class="<?php if(Request::segment(1) ==='form-mast-destination' || Request::segment(1) ==='view-mast-destination'){echo "active";} ?>">

        <a href="#"><i class="fa fa-plus text-aqua"></i>Area Master
              <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
                
              <li class=" <?php if(Request::segment(1) ==='form-mast-destination'){echo "active";} ?>">

                    <a href="{{ url('/form-mast-destination') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Area <span style="display: none;">MIT0</span>

                    </a>

                </li> 

                <li class="<?php if(Request::segment(1) ==='view-mast-destination'){echo "active";} ?>">

                      <a href="{{ url('/view-mast-destination') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Area <span style="display: none;">MIT0</span>

                      </a>

                </li>

            </ul>

      </li>

      <li class="<?php if(Request::segment(1) ==='form-mast-depot' || Request::segment(1) ==='view-mast-depot'){echo "active";} ?>">

        <a href="#"><i class="fa fa-plus text-aqua"></i>Depot Master
              <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
                
              <li class=" <?php if(Request::segment(1) ==='form-mast-depot'){echo "active";} ?>">

                    <a href="{{ url('/form-mast-depot') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Depot <span style="display: none;">MIT0</span>

                    </a>

                </li> 

                <li class="<?php if(Request::segment(1) ==='view-mast-depot'){echo "active";} ?>">

                      <a href="{{ url('/view-mast-depot') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Depot <span style="display: none;">MIT0</span>

                      </a>

                </li>

            </ul>

      </li>

    </ul>

</li>

<!-- END C AND F MASTER  -------->

<!-- START LOGISTIC MASTER -->
  
        
<li class="treeview <?php if(Request::segment(3) ==='add-freight-type' || Request::segment(3) ==='view-freight-type-master' || Request::segment(1) ==='lr-exp-mast' || Request::segment(1) ==='view-lr-exp-mast' || Request::segment(3) ==='Hsn-Rate-Mast' || Request::segment(3) ==='View-Hsn-Rate-Mast' || Request::segment(1) ==='form-mast-fleet' || Request::segment(1) ==='view-mast-fleet' || Request::segment(1) ==='diesel-rate-mast' || Request::segment(1) ==='view-diesel-rate-mast' || Request::segment(1) ==='form-fleet-truck-wheel' || Request::segment(1) ==='view-flet-truck-wheel' || Request::segment(1) ==='form-mast-freight-rate' || Request::segment(1) ==='view-mast-freight-rate' || Request::segment(2) ==='form-mast-manufacturing' || Request::segment(1) ==='view-manufature' || Request::segment(1) ==='form-fleet-trip-expense' || Request::segment(1) ==='view-fleet-trip-expense' || Request::segment(1) ==='lr-acknowledgement-penalty' || Request::segment(1) ==='view-mast-Lr-penalty'||Request::segment(2) ==='fleet-certificate-transaction-form' || Request::segment(2) ==='view-fleet-certificate-transaction' || Request::segment(2) ==='driver-master' || Request::segment(2) ==='view-driver-master'){ echo "active";}    ?>">

    <a href="#">

      <i class="fa fa-plus" style="color:antiquewhite;"></i> Logistics

      <i class="fa fa-angle-left pull-right"></i>

    </a>

    <ul class="treeview-menu">

      <li class="<?php if(Request::segment(3) ==='add-freight-type' || Request::segment(3) ==='view-freight-type-master'){echo "active";} ?>">

        <a href="#"><i class="fa fa-plus text-aqua"></i>Freight Type Master
              <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
                
               <li class="<?php if(Request::segment(3) ==='add-freight-type'){echo "active";} ?>">

                    <a href="{{ url('/logistic-transportation/master/add-freight-type') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Freight Type <span style="display: none;">MIT0</span>

                    </a>

                </li> 

                <li class="<?php if(Request::segment(3) ==='view-freight-type-master'){echo "active";} ?>">

                      <a href="{{ url('/logistic-transportation/master/view-freight-type-master') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Freight Type <span style="display: none;">MIT0</span>

                      </a>

                </li>

            </ul>

      </li>

      <li class="<?php if(Request::segment(1) ==='form-mast-fleet' || Request::segment(1) ==='view-mast-fleet'){echo "active";} ?>">

        <a href="#"><i class="fa fa-plus text-aqua"></i>Fleet Master
              <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
                
              <li class=" <?php if(Request::segment(1) ==='form-mast-fleet'){echo "active";} ?>">

                    <a href="{{ url('/form-mast-fleet') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Fleet <span style="display: none;">MIT0</span>

                    </a>

                </li> 

                <li class="<?php if(Request::segment(1) ==='view-mast-fleet'){echo "active";} ?>">

                      <a href="{{ url('/view-mast-fleet') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Fleet <span style="display: none;">MIT0</span>

                      </a>

                </li>

            </ul>

      </li>

      <li class="<?php if(Request::segment(2) ==='driver-master' || Request::segment(2) ==='view-driver-master'){echo "active";} ?>">

        <a href="#"><i class="fa fa-plus text-aqua"></i>Driver Master
              <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
                
              <li class=" <?php if(Request::segment(2) ==='driver-master'){echo "active";} ?>">

                    <a href="{{ url('/master/logistic/driver-master') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Driver <span style="display: none;">MIT0</span>

                    </a>

                </li> 

                <li class="<?php if(Request::segment(2) ==='view-driver-master'){echo "active";} ?>">

                      <a href="{{ url('/master/logistic/view-driver-master') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Driver List <span style="display: none;">MIT0</span>

                      </a>

                </li>

            </ul>

      </li>

      <li class="<?php if(Request::segment(2) ==='fleet-certificate-transaction-form' || Request::segment(2) ==='view-fleet-certificate-transaction'){echo "active";} ?>">

          <a href="#"><i class="fa fa-plus text-aqua"></i>Fleet Certificate
                <i class="fa fa-angle-left pull-right"></i>
              </a>

              <ul class="treeview-menu">
                  
               <li class="<?php if(Request::segment(2) ==='fleet-certificate-transaction-form'){echo "active";} ?>">

                    <a href="{{ url('logistic/fleet-certificate-transaction-form') }}"><i class="fa fa-circle-o text-aqua"></i> Fleet Certificate Trans

                    </a>

                </li>


                <li class="<?php if(Request::segment(2) ==='view-fleet-certificate-transaction'){echo "active";} ?>">

                    <a href="{{ url('logistic/view-fleet-certificate-transaction') }}">

                      <i class="fa fa-circle-o text-red"></i> 

                      View Fleet Certificate <span style="display: none;">MIT0</span>

                    </a>

                </li>

                         
          </ul>

      </li>

      <li class="<?php if(Request::segment(1) ==='lr-exp-mast' || Request::segment(1) ==='view-lr-exp-mast'){echo "active";} ?>">

        <a href="#"><i class="fa fa-plus text-aqua"></i>LR Exp Master
              <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
                
              <li class=" <?php if(Request::segment(1) ==='lr-exp-mast'){echo "active";} ?>">

                    <a href="{{ url('/lr-exp-mast') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add LR Exp <span style="display: none;">MIT0</span>

                    </a>

                </li> 

                <li class="<?php if(Request::segment(1) ==='view-lr-exp-mast'){echo "active";} ?>">

                      <a href="{{ url('/view-lr-exp-mast') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View LR Exp <span style="display: none;">MIT0</span>

                      </a>

                </li>

            </ul>

      </li>


      <li class="<?php if(Request::segment(1) ==='diesel-rate-mast' || Request::segment(1) ==='view-diesel-rate-mast'){echo "active";} ?>">

        <a href="#"><i class="fa fa-plus text-aqua"></i>Diesel Rate Master
              <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
                
              <li class=" <?php if(Request::segment(1) ==='diesel-rate-mast'){echo "active";} ?>">

                    <a href="{{ url('/diesel-rate-mast') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Diesel Rate <span style="display: none;">MIT0</span>

                    </a>

                </li> 

                <li class="<?php if(Request::segment(1) ==='view-diesel-rate-mast'){echo "active";} ?>">

                      <a href="{{ url('/view-diesel-rate-mast') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Diesel Rate <span style="display: none;">MIT0</span>

                      </a>

                </li>

            </ul>

      </li>

      
      <!-- <li class="< ?php if(Request::segment(3) ==='fleet-exp-mast' || Request::segment(3) ==='view-lr-exp-mast'){echo "active";} ?>">

        <a href="#"><i class="fa fa-plus text-aqua"></i>Fleet Expense
              <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
                
              <li class=" < ?php if(Request::segment(3) ==='fleet-exp-mast'){echo "active";} ?>">

                    <a href="{{ url('/fleet-exp-mast') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Fleet Exp <span style="display: none;">MIT0</span>

                    </a>

                </li> 

                <li class="< ?php if(Request::segment(3) ==='view-fleet-exp-mast'){echo "active";} ?>">

                      <a href="{{ url('/view-fleet-exp-mast') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Fleet Exp <span style="display: none;">MIT0</span>

                      </a>

                </li>

            </ul>

      </li> -->

      <li class="<?php if(Request::segment(1) ==='form-fleet-truck-wheel' || Request::segment(1) ==='view-flet-truck-wheel'){echo "active";} ?>">

        <a href="#"><i class="fa fa-plus text-aqua"></i>Fleet Wheel Type Master
              <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
                
              <li class=" <?php if(Request::segment(1) ==='form-fleet-truck-wheel'){echo "active";} ?>">

                    <a href="{{ url('/form-fleet-truck-wheel') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Fleet Wheel Type <span style="display: none;">MIT0</span>

                    </a>

                </li> 

                <li class="<?php if(Request::segment(1) ==='view-flet-truck-wheel'){echo "active";} ?>">

                      <a href="{{ url('/view-flet-truck-wheel') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Fleet Wheel Type <span style="display: none;">MIT0</span>

                      </a>

                </li>

            </ul>

      </li>

      <li class="<?php if(Request::segment(1) ==='form-fleet-trip-expense' || Request::segment(1) ==='view-fleet-trip-expense'){echo "active";} ?>">

        <a href="#"><i class="fa fa-plus text-aqua"></i>Trip Expense Master
              <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
                
              <li class=" <?php if(Request::segment(1) ==='form-fleet-trip-expense'){echo "active";} ?>">

                    <a href="{{ url('/form-fleet-trip-expense') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Trip Expense <span style="display: none;">MIT0</span>

                    </a>

                </li> 

                <li class="<?php if(Request::segment(1) ==='view-fleet-trip-expense'){echo "active";} ?>">

                      <a href="{{ url('/view-fleet-trip-expense') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Trip Expense <span style="display: none;">MIT0</span>

                      </a>

                </li>

            </ul>

      </li>

      <li class="<?php if(Request::segment(1) ==='form-mast-freight-rate' || Request::segment(1) ==='view-mast-freight-rate'){echo "active";} ?>">

        <a href="#"><i class="fa fa-plus text-aqua"></i>Route Master
              <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
                
              <li class=" <?php if(Request::segment(1) ==='form-mast-freight-rate'){echo "active";} ?>">

                    <a href="{{ url('/form-mast-freight-rate') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Route <span style="display: none;">MIT0</span>

                    </a>

                </li> 

                <li class="<?php if(Request::segment(1) ==='view-mast-freight-rate'){echo "active";} ?>">

                      <a href="{{ url('/view-mast-freight-rate') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Route <span style="display: none;">MIT0</span>

                      </a>

                </li>

            </ul>

      </li>

      <li class="<?php if(Request::segment(1) ==='form-mast-manufacturing' || Request::segment(1) ==='view-manufature'){echo "active";} ?>">

        <a href="#"><i class="fa fa-plus text-aqua"></i>Vehicle Mfg Master
              <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
                
              <li class=" <?php if(Request::segment(1) ==='form-mast-manufacturing'){echo "active";} ?>">

                    <a href="{{ url('/form-mast-manufacturing') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Vehicle Mfg <span style="display: none;">MIT0</span>

                    </a>

                </li> 

                <li class="<?php if(Request::segment(1) ==='view-manufature'){echo "active";} ?>">

                      <a href="{{ url('/view-manufature') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Vehicle Mfg <span style="display: none;">MIT0</span>

                      </a>

                </li>

            </ul>

      </li>

      <li class="<?php if(Request::segment(1) ==='lr-acknowledgement-penalty' || Request::segment(1) ==='view-lr-acknowledgement-penalty'){echo "active";} ?>">

        <a href="#"><i class="fa fa-plus text-aqua"></i>LR Ack Penalty
              <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
                
              <li class=" <?php if(Request::segment(1) ==='form-Lr-ack-penalty'){echo "active";} ?>">

                    <a href="{{ url('/logistic-transportation/master/lr-acknowledgement-penalty') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Ack Penalty <span style="display: none;">MIT0</span>

                    </a>

                </li> 

                <li class="<?php if(Request::segment(1) ==='view-mast-Lr-penalty'){echo "active";} ?>">

                      <a href="{{ url('/logistic-transportation/master/view-lr-acknowledgement-penalty') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Ack Penalty <span style="display: none;">MIT0</span>

                      </a>

                </li>

            </ul>

      </li>

    </ul>

</li>

<!-- END LOGISTIC MASTER -->

<!-- ---------- START INFRASTRUCTURE ------------  -->
  
  <li class="treeview <?php if(Request::segment(3) === 'Department-Mast' || Request::segment(3) === 'View-Department-Mast' || Request::segment(3) ==='Zone-Mast' || Request::segment(3) ==='View-Zone-Mast'){ echo "active";}    ?>">

      <a href="#">

        <i class="fa fa-plus" style="color:antiquewhite;"></i> Infrastructure

        <i class="fa fa-angle-left pull-right"></i>

      </a>

      <ul class="treeview-menu">
      
          <?php  if(isset($Fname)){

            $Fname = Session::get('form_name');
            
            foreach ($Fname as $row) { 

              if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

          ?>

            <li class=" <?php if(Request::segment(3) === 'Zone-Mast' || Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                <a href="#"><i class="fa fa-plus text-aqua"></i>Project Master
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">

                  <li class=" <?php if(Request::segment(3) === 'Zone-Mast'){echo "active";} ?>">

                      <a href="{{ url('Master/Infrastructure/Add-Project-Master') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Project <span style="display: none;">MO0</span>

                      </a>

                  </li>
                  
                  <li class="<?php if(Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                        <a href="{{ url('Master/Infrastructure/View-Project-Master')}}') }}">

                          <i class="fa fa-circle-o text-red"></i> 

                          View Project <span style="display: none;">MO0</span>

                        </a>

                  </li>

                </ul>

            </li>

          <?php } else{} } }?>

          <?php if(Session::get('usertype')=='admin'){ ?>

            <li class=" <?php if(Request::segment(3) === 'Zone-Mast' || Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

              <a href="#"><i class="fa fa-plus text-aqua"></i>Project Master
                <i class="fa fa-angle-left pull-right"></i>
              </a>

              <ul class="treeview-menu">

                <li class=" <?php if(Request::segment(3) === 'Zone-Mast'){echo "active";} ?>">

                    <a href="{{ url('Master/Infrastructure/Add-Project-Master') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Project <span style="display: none;">MO0</span>

                    </a>

                </li>
                
                <li class="<?php if(Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                      <a href="{{ url('Master/Infrastructure/View-Project-Master')}}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Project <span style="display: none;">MO0</span>

                      </a>

                </li>

              </ul>

            </li>

          <?php } else{ }?>

          <?php  if(isset($Fname)){

            $Fname = Session::get('form_name');
            
            foreach ($Fname as $row) { 

              if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

          ?>

            <li class=" <?php if(Request::segment(3) === 'Zone-Mast' || Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                <a href="#"><i class="fa fa-plus text-aqua"></i>Project Detail Master
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">

                  <li class=" <?php if(Request::segment(3) === 'Zone-Mast'){echo "active";} ?>">

                      <a href="{{ url('Master/Infrastructure/Add-Project-Detail-Master') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Project Detail <span style="display: none;">MO0</span>

                      </a>

                  </li>
                  
                  <li class="<?php if(Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                        <a href="{{ url('/Master/Infrastructure/View-Project-Detail-Master') }}">

                          <i class="fa fa-circle-o text-red"></i> 

                          View Project Detail<span style="display: none;">MO0</span>

                        </a>

                  </li>

                </ul>

            </li>

          <?php } else{} } }?>

          <?php if(Session::get('usertype')=='admin'){ ?>

            <li class=" <?php if(Request::segment(3) === 'Zone-Mast' || Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

              <a href="#"><i class="fa fa-plus text-aqua"></i>Project Detail Master
                <i class="fa fa-angle-left pull-right"></i>
              </a>

              <ul class="treeview-menu">

                <li class=" <?php if(Request::segment(3) === 'Zone-Mast'){echo "active";} ?>">

                    <a href="{{ url('Master/Infrastructure/Add-Project-Detail-Master') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Project Detail<span style="display: none;">MO0</span>

                    </a>

                </li>
                
                <li class="<?php if(Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                      <a href="{{ url('/Master/Infrastructure/View-Project-Detail-Master') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Project Detail<span style="display: none;">MO0</span>

                      </a>

                </li>

              </ul>

            </li>

          <?php } else{ }?>

          <?php  if(isset($Fname)){

            $Fname = Session::get('form_name');
            
            foreach ($Fname as $row) { 

              if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

          ?>

            <li class=" <?php if(Request::segment(3) === 'Zone-Mast' || Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                <a href="#"><i class="fa fa-plus text-aqua"></i>Unit Type Master
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">

                  <li class=" <?php if(Request::segment(3) === 'Zone-Mast'){echo "active";} ?>">

                      <a href="{{ url('Master/Infrastructure/Add-Unit-Type') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Unit Type <span style="display: none;">MO0</span>

                      </a>

                  </li>
                  
                  <li class="<?php if(Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                        <a href="{{ url('Master/Infrastructure/View-unit-type') }}">

                          <i class="fa fa-circle-o text-red"></i> 

                          View Unit Type <span style="display: none;">MO0</span>

                        </a>

                  </li>

                </ul>

            </li>

          <?php } else{} } }?>

          <?php if(Session::get('usertype')=='admin'){ ?>

            <li class=" <?php if(Request::segment(3) === 'Zone-Mast' || Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

              <a href="#"><i class="fa fa-plus text-aqua"></i>Unit Type Master
                <i class="fa fa-angle-left pull-right"></i>
              </a>

              <ul class="treeview-menu">

                <li class=" <?php if(Request::segment(3) === 'Zone-Mast'){echo "active";} ?>">

                    <a href="{{ url('Master/Infrastructure/Add-Unit-Type')}}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Unit Type<span style="display: none;">MO0</span>

                    </a>

                </li>
                
                <li class="<?php if(Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                      <a href="{{ url('Master/Infrastructure/View-unit-type') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Unit Type<span style="display: none;">MO0</span>

                      </a>

                </li>

              </ul>

            </li>

          <?php } else{ }?>

          <?php  if(isset($Fname)){

            $Fname = Session::get('form_name');
            
            foreach ($Fname as $row) { 

              if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

          ?>

            <li class=" <?php if(Request::segment(3) === 'Zone-Mast' || Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                <a href="#"><i class="fa fa-plus text-aqua"></i>Unit Master
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">

                  <li class=" <?php if(Request::segment(3) === 'Zone-Mast'){echo "active";} ?>">

                      <a href="{{ url('/Master/Infrastructure/add-unit-master') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Unit <span style="display: none;">MO0</span>

                      </a>

                  </li>
                  
                  <li class="<?php if(Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                        <a href="{{url('/Master/Infrastructure/view-unit-master')}}">

                          <i class="fa fa-circle-o text-red"></i> 

                          View Unit <span style="display: none;">MO0</span>

                        </a>

                  </li>

                </ul>

            </li>

          <?php } else{} } }?>

          <?php if(Session::get('usertype')=='admin'){ ?>

            <li class=" <?php if(Request::segment(3) === 'Zone-Mast' || Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

              <a href="{{url('/Master/Infrastructure/view-unit-master')}}"><i class="fa fa-plus text-aqua"></i>Unit Master
                <i class="fa fa-angle-left pull-right"></i>
              </a>

              <ul class="treeview-menu">

                <li class=" <?php if(Request::segment(3) === 'Zone-Mast'){echo "active";} ?>">

                    <a href="{{ url('/Master/Infrastructure/add-unit-master') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Unit<span style="display: none;">MO0</span>

                    </a>

                </li>
                
                <li class="<?php if(Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                      <a href="{{url('/Master/Infrastructure/view-unit-master')}}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Unit<span style="display: none;">MO0</span>

                      </a>

                </li>

              </ul>

            </li>

          <?php } else{ }?>

          <?php  if(isset($Fname)){

            $Fname = Session::get('form_name');
            
            foreach ($Fname as $row) { 

              if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

          ?>

            <li class=" <?php if(Request::segment(3) === 'Zone-Mast' || Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                <a href="#"><i class="fa fa-plus text-aqua"></i>Project WBS Master
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">

                  <li class=" <?php if(Request::segment(3) === 'Zone-Mast'){echo "active";} ?>">

                      <a href="{{ url('Master/Infrastructure/Add-Project-Wbs-Master') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Project WBS <span style="display: none;">MO0</span>

                      </a>

                  </li>
                  
                  <li class="<?php if(Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                        <a href="{{ url('Master/Infrastructure/View-Project-Wbs-Master') }}">

                          <i class="fa fa-circle-o text-red"></i> 

                          View Project WBS <span style="display: none;">MO0</span>

                        </a>

                  </li>

                </ul>

            </li>

          <?php } else{} } }?>

          <?php if(Session::get('usertype')=='admin'){ ?>

            <li class=" <?php if(Request::segment(3) === 'Zone-Mast' || Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

              <a href="#"><i class="fa fa-plus text-aqua"></i>Project WBS Master
                <i class="fa fa-angle-left pull-right"></i>
              </a>

              <ul class="treeview-menu">

                <li class=" <?php if(Request::segment(3) === 'Zone-Mast'){echo "active";} ?>">

                    <a href="{{ url('Master/Infrastructure/Add-Project-Wbs-Master') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Project WBS<span style="display: none;">MO0</span>

                    </a>

                </li>
                
                <li class="<?php if(Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                      <a href="{{ url('Master/Infrastructure/View-Project-Wbs-Master') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Project WBS<span style="display: none;">MO0</span>

                      </a>

                </li>

              </ul>

            </li>

          <?php } else{ }?>

          <?php  if(isset($Fname)){

            $Fname = Session::get('form_name');
            
            foreach ($Fname as $row) { 

              if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

          ?>

            <li class=" <?php if(Request::segment(3) === 'Zone-Mast' || Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                <a href="#"><i class="fa fa-plus text-aqua"></i>MileStone Master
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">

                  <li class=" <?php if(Request::segment(3) === 'Zone-Mast'){echo "active";} ?>">

                      <a href="{{ url('Master/Infrastructure/Add-Milestone') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add MileStone <span style="display: none;">MO0</span>

                      </a>

                  </li>
                  
                  <li class="<?php if(Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                        <a href="{{ url('Master/Infrastructure/View-Milestone') }}">

                          <i class="fa fa-circle-o text-red"></i> 

                          View MileStone <span style="display: none;">MO0</span>

                        </a>

                  </li>

                </ul>

            </li>

          <?php } else{} } }?>

          <?php if(Session::get('usertype')=='admin'){ ?>

            <li class=" <?php if(Request::segment(3) === 'Zone-Mast' || Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

              <a href="#"><i class="fa fa-plus text-aqua"></i>MileStone Master
                <i class="fa fa-angle-left pull-right"></i>
              </a>

              <ul class="treeview-menu">

                <li class=" <?php if(Request::segment(3) === 'Zone-Mast'){echo "active";} ?>">

                    <a href="{{ url('Master/Infrastructure/Add-Milestone') }}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add MileStone<span style="display: none;">MO0</span>

                    </a>

                </li>
                
                <li class="<?php if(Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                      <a href="{{ url('Master/Infrastructure/View-Milestone') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View MileStone<span style="display: none;">MO0</span>

                      </a>

                </li>

              </ul>

            </li>

         <?php } else{ }?>

          <?php  if(isset($Fname)){

            $Fname = Session::get('form_name');
            
            foreach ($Fname as $row) { 

              if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

          ?>

            <li class=" <?php if(Request::segment(3) === 'Zone-Mast' || Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                <a href="#"><i class="fa fa-plus text-aqua"></i>Unit WBS Master
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">

                  <li class=" <?php if(Request::segment(3) === 'Zone-Mast'){echo "active";} ?>">

                      <a href="{{url('/Master/Infrastructure/add-unit-wbs-master')}}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Unit WBS <span style="display: none;">MO0</span>

                      </a>

                  </li>
                  
                  <li class="<?php if(Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                        <a href="{{url('/Master/Infrastructure/view-unit-wbs-master')}}">

                          <i class="fa fa-circle-o text-red"></i> 

                          View Unit WBS <span style="display: none;">MO0</span>

                        </a>

                  </li>

                </ul>

            </li>

          <?php } else{} } }?>

          <?php if(Session::get('usertype')=='admin'){ ?>

            <li class=" <?php if(Request::segment(3) === 'Zone-Mast' || Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

              <a href="#"><i class="fa fa-plus text-aqua"></i>Unit WBS Master
                <i class="fa fa-angle-left pull-right"></i>
              </a>

              <ul class="treeview-menu">

                <li class=" <?php if(Request::segment(3) === 'Zone-Mast'){echo "active";} ?>">

                    <a href="{{url('/Master/Infrastructure/add-unit-wbs-master')}}">

                      <i class="fa fa-circle-o text-yellow"></i>

                      Add Unit WBS<span style="display: none;">MO0</span>

                    </a>

                </li>
                
                <li class="<?php if(Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                      <a href="{{url('/Master/Infrastructure/view-unit-wbs-master')}}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Unit WBS<span style="display: none;">MO0</span>

                      </a>

                </li>

              </ul>

            </li>

          <?php } else{ }?>

            

     </ul>

  </li>

<!-- ---------- START INFRASTRUCTURE ------------  -->

<!----- START OTHER------>

<li class="treeview <?php if(Request::segment(3) === 'Department-Mast' || Request::segment(3) === 'View-Department-Mast' ||
Request::segment(3) ==='Zone-Mast' || Request::segment(3) ==='View-Zone-Mast'){ echo "active";}    ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Other

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>


            <ul class="treeview-menu">

           
            
             <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOZ0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOZ0' == $row && Session::get('usertype')=='user') { 

                ?>
3
                <li class=" <?php if(Request::segment(3) === 'Zone-Mast' || Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Zone Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Zone-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Other/Zone-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Zone <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Other/View-Zone-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Zone <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                        
                        <li class=" <?php if(Request::segment(3) === 'Zone-Mast' || Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus text-aqua"></i>Zone Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Zone-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/Other/Zone-Mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Zone <span style="display: none;">MO0</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Zone-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Other/View-Zone-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Zone <span style="display: none;">MO0</span>

                                  </a>

                            </li>

                          </ul>

                        </li>
                      <?php } else{ }?>

                    
                  
                  <?php   if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('MOD0' == $row &&  Session::get('usertype')=='superAdmin' || 'MOD0' == $row && Session::get('usertype')=='user') { 

                ?>

                 <li class=" <?php if(Request::segment(3) === 'Department-Mast' || Request::segment(3) === 'View-Department-Mast'){echo "active";} ?>">

                        <a href="#">
                          <i class="fa fa-plus text-aqua"></i> Department Master
                            <i class="fa fa-angle-left pull-right"></i>
                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Department-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/other/Department-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Department <span style="display: none;">MO1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Department-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/other/View-Department-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Department <span style="display: none;">MO1</span>

                                </a>

                          </li>

                        </ul>
                        </a>

                    </li>

              <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                   <li class=" <?php if(Request::segment(3) === 'Department-Mast' || Request::segment(3) === 'View-Department-Mast'){echo "active";} ?>">

                        <a href="#">
                          <i class="fa fa-plus text-aqua"></i> Department Master
                            <i class="fa fa-angle-left pull-right"></i>
                           <ul class="treeview-menu">

                          <li class=" <?php if(Request::segment(3) === 'Department-Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/other/Department-Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Department <span style="display: none;">MO1</span>

                            </a>

                          </li>



                          <li class="<?php if(Request::segment(3) === 'View-Department-Mast'){echo "active";} ?>">

                                <a href="{{ url('/Master/other/View-Department-Mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                View Department <span style="display: none;">MO1</span>

                                </a>

                          </li>

                        </ul>
                        </a>

                    </li>

                    <?php } else{ }?>


                  

           </ul>

        </li>
<!----- END TAX / CASH MASTER------>



              </ul>
            </li>

          <?php } ?>

          <?php if(Session::get('usertype')=='admin'){ ?>

            <li class="treeview <?php if(Request::segment(3) === 'User-Mast' || Request::segment(3) ==='View-User-Mast' || Request::segment(3) ==='Edit-User-Mast' || Request::segment(3) === 'view-user-right' ||  Request::segment(3) === 'form-user-right' || Request::segment(3) === 'Fy-Mast' || Request::segment(3) === 'View-Fy-Mast' || Request::segment(3) ==='New-Fy-Year' || Request::segment(3) ==='Edit-Fy-Mast'|| Request::segment(3) === 'Company-Mast' || Request::segment(3) === 'View-Company-Mast' || Request::segment(3) ==='Edit-Company-Mast'  || Request::segment(3) ==='Edit-Vr-Sequence' || Request::segment(3) === 'Config-Mast' || Request::segment(3) === 'View-Config-Mast' || Request::segment(3) === 'Transaction-Mast' || Request::segment(3) === 'View-Transaction-Mast' || Request::segment(3) === 'Vr-Sequence' || Request::segment(3) === 'New-Vr-Sequence' || Request::segment(3) === 'View-Vr-Sequence' || Request::segment(3) === 'Profit-Center-Mast' || Request::segment(3) === 'View-Profit-Center-Mast' || Request::segment(3) ==='Plant_Mast' || Request::segment(3) ==='View-Plant_Mast' || Request::segment(3) ==='Approved-Ind-Mast' || Request::segment(3) ==='View-Approved-Ind-Mast' || Request::segment(2) ==='importfile' || Request::segment(3) === 'New_Yr_Acc_Gl_Bal' || Request::segment(3) === 'New_Yr_Item_Bal'||Request::segment(3) === 'pay-calender' || Request::segment(3) === 'view-pay-calender' || Request::segment(2) === 'engine-table-config' || Request::segment(2) ==='database-config' || Request::segment(3) === 'Master-Remark' || Request::segment(3) === 'View-Master-Remark' || Request::segment(3) === 'Excel-Configuration' || Request::segment(3) === 'View-Excel-Configuration' || Request::segment(3) === 'add-chequeBook'||Request::segment(3) === 'add-chequeBook' || Request::segment(3) === 'view-chequeBook' || Request::segment(3) === 'add-offline-cheque-issue' ||Request::segment(3) === 'view-offline-cheque-issue'  || Request::segment(3) === 'add-cheque-leaf-config' || Request::segment(3) === 'view-cheque-leaf-config' || Request::segment(3) === 'add-cheque-print' || Request::segment(3) === 'view-cheque-leaf-config' || Request::segment(3) === 'add-menu-url' || Request::segment(3) === 'view-menu-url' || Request::segment(2) ==='test-api-config'){ echo "active";}    ?>">
              <a href="#">
                <i class="fa fa-plus sign3"></i> <span>Configration</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu ulview">

              <li class="treeview <?php if(Request::segment(3) === 'Fy-Mast' || Request::segment(3) ==='New-Fy-Year' || Request::segment(3) === 'View-Fy-Mast' || Request::segment(3) ==='Edit-Fy-Mast' || Request::segment(3) === 'Company-Mast' || Request::segment(3) === 'View-Company-Mast' || Request::segment(3) ==='Edit-Company-Mast' ||  Request::segment(1) ==='view-mast-transaction' || Request::segment(1) ==='form-transaction-mast' || Request::segment(1) ==='edit-transaction' ||  Request::segment(1) ==='view-vr-sequnce' || Request::segment(1) ==='vr-sequence' || Request::segment(3) === 'New-Vr-Sequence' || Request::segment(3) ==='Edit-Vr-Sequence' || Request::segment(3) === 'Config-Mast' || Request::segment(3) === 'View-Config-Mast' || Request::segment(3) === 'Transaction-Mast' || Request::segment(3) === 'View-Transaction-Mast' || Request::segment(3) === 'Vr-Sequence' || Request::segment(3) === 'View-Vr-Sequence' || Request::segment(3) === 'Profit-Center-Mast' || Request::segment(3) === 'View-Profit-Center-Mast' || Request::segment(3) ==='Plant_Mast' || Request::segment(3) ==='View-Plant_Mast' || Request::segment(3) ==='Approved-Ind-Mast' || Request::segment(3) ==='View-Approved-Ind-Mast' || Request::segment(2) ==='importfile' || Request::segment(3) === 'New_Yr_Acc_Gl_Bal' || Request::segment(3) === 'New_Yr_Item_Bal' || Request::segment(3) === 'pay-calender' || Request::segment(3) === 'view-pay-calender' || Request::segment(3) === 'Master-Remark' || Request::segment(3) === 'View-Master-Remark' ||Request::segment(3) === 'Excel-Configuration' || Request::segment(3) === 'View-Excel-Configuration' || Request::segment(3) === 'add-chequeBook'||Request::segment(3) === 'add-chequeBook' || Request::segment(3) === 'view-chequeBook' || Request::segment(3) === 'add-offline-cheque-issue' || Request::segment(3) === 'view-offline-cheque-issue' ||  Request::segment(3) === 'add-cheque-leaf-config' || Request::segment(3) === 'view-cheque-leaf-config' || Request::segment(3) === 'add-cheque-print' || Request::segment(3) === 'view-cheque-leaf-config'){ echo "active";}    ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> Setting

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>


            <ul class="treeview-menu">

           
            
            <?php if(Session::get('usertype')=='admin'){ ?>

                   <li class=" <?php if(Request::segment(3) === 'Company-Mast' || Request::segment(3) ==='View-Company-Mast' || Request::segment(3) ==='Edit-Company-Mast') { echo "active";} ?>">

                  <a href="pages/examples/invoice.html">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> 

                    Master Company 

                      <i class="fa fa-angle-left pull-right"></i>

                  </a>



                   <ul class="treeview-menu">

                    <li class=" <?php if(Request::segment(3) === 'Company-Mast') { echo "active";} ?>">

                      <a href="{{ url('/Master/Setting/Company-Mast') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Company <span style="display: none;">CS0</span>

                      </a>

                    </li>



                    <li class="<?php if(Request::segment(3) ==='View-Company-Mast') { echo "active";} ?>">

                      <a href="{{ url('/Master/Setting/View-Company-Mast') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Company <span style="display: none;">CS0</span>

                      </a>

                    </li>

                  </ul>

                </li>



             <?php } else{} ?>

                    
                  
                 <?php if(Session::get('usertype')=='admin'){ ?>

                <li class="<?php if(Request::segment(3) === 'Fy-Mast' || Request::segment(3) ==='View-Fy-Mast' || Request::segment(3) ==='Edit-Fy-Mast' ) { echo "active";} ?>">

                  <a href="">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> 

                    Master Fy  

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                   <ul class="treeview-menu">

                    <li class=" <?php if(Request::segment(3) === 'Fy-Mast') { echo "active";} ?>">

                      <a href="{{ url('/Master/Setting/Fy-Mast') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Fy <span style="display: none;">CS1</span>

                      </a>

                    </li>



                    <li class="<?php if(Request::segment(3) ==='View-Fy-Mast') { echo "active";} ?>">

                      <a href="{{ url('/Master/Setting/View-Fy-Mast') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Fy <span style="display: none;">CS1</span>

                      </a>

                    </li>

                  </ul>



                </li>

             <?php } else{} ?>

             <?php if(Session::get('usertype')=='admin'){ ?>
                    
                    <li class=" <?php if(Request::segment(3) === 'Profit-Center-Mast' || Request::segment(3) === 'View-Profit-Center-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus" style="color:antiquewhite;"></i> Profit Center Master
                             <i class="fa fa-angle-left pull-right"></i>
                          </a>

                           <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Profit-Center-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/Setting/Profit-Center-Mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Profit Center <span style="display: none;">CS2</span>

                              </a>

                            </li>



                            <li class="<?php if(Request::segment(3) === 'View-Profit-Center-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Setting/View-Profit-Center-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                  View Profit Center <span style="display: none;">CS2</span>

                                  </a>

                            </li>

                          </ul>

                      </li>

              <?php } else{ }?>

              <?php if(Session::get('usertype')=='admin'){ ?>

                  <li class="<?php if(Request::segment(3) === 'Plant_Mast' || Request::segment(3) === 'View-Plant_Mast'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus" style="color:antiquewhite;"></i> Plant Master
                        <i class="fa fa-angle-left pull-right"></i>
                      </a>

                      <ul class="treeview-menu">

                        <li class=" <?php if(Request::segment(3) === 'Plant_Mast'){echo "active";} ?>">

                            <a href="{{ url('/Master/Setting/Plant_Mast') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Plant <span style="display: none;">CS3</span>

                            </a>

                        </li>



                        <li class="<?php if(Request::segment(3) === 'View-Plant_Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/Setting/View-Plant_Mast') }}">

                                <i class="fa fa-circle-o text-red"></i> 

                                View Plant <span style="display: none;">CS3</span>

                              </a>

                        </li>

                      </ul>

                    </li>

                <?php } else{ }?>

                <?php if(Session::get('usertype')=='admin'){ ?>

                  <li class="<?php if(Request::segment(3) === 'pay-calender' || Request::segment(3) === 'view-pay-calender'){echo "active";} ?>">

                      <a href="#"><i class="fa fa-plus" style="color:antiquewhite;"></i> Pay Calender
                        <i class="fa fa-angle-left pull-right"></i>
                      </a>

                      <ul class="treeview-menu">

                        <li class=" <?php if(Request::segment(3) === 'pay-calender'){echo "active";} ?>">

                            <a href="{{ url('/Master/Setting/pay-calender') }}">

                              <i class="fa fa-circle-o text-yellow"></i>

                              Add Pay Calender <span style="display: none;">CS3</span>

                            </a>

                        </li>



                        <li class="<?php if(Request::segment(3) === 'view-pay-calender'){echo "active";} ?>">

                              <a href="{{ url('/Master/Setting/view-pay-calender') }}">

                                <i class="fa fa-circle-o text-red"></i> 

                                View Pay Calender <span style="display: none;">CS3</span>

                              </a>

                        </li>

                      </ul>

                    </li>

                <?php } else{ }?>

               <?php if(Session::get('usertype')=='admin'){ ?>
                        
                         <li class="<?php if(Request::segment(3) === 'Transaction-Mast' || Request::segment(3) === 'View-Transaction-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus" style="color:antiquewhite;"></i> Transaction Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Transaction-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/Setting/Transaction-Mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Transaction <span style="display: none;">CS4</span>

                              </a>

                            </li>



                            <li class="<?php if(Request::segment(3) === 'View-Transaction-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Setting/View-Transaction-Mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Transaction <span style="display: none;">CS4</span>

                                  </a>

                            </li>

                          </ul>

                        </li>


                      <?php } else {}?>


                      <?php if(Session::get('usertype')=='admin'){ ?>

                      <li class="<?php if(Request::segment(3) === 'Config-Mast' || Request::segment(3) === 'View-Config-Mast'){echo "active";} ?>">

                          <a href="#"> 
                            <i class="fa fa-plus" style="color:antiquewhite;"></i>Config Master
                              <i class="fa fa-angle-left pull-right"></i>
                          </a>
                             <ul class="treeview-menu">

                            <li class="<?php if(Request::segment(3) === 'Config-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/Setting/Config-Mast') }}">
                                <i class="fa fa-circle-o text-yellow"></i>Add Config
                              </a>

                            </li>

                            <li class="<?php if(Request::segment(3) === 'View-Config-Mast'){echo "active";} ?>">
                                  <a href="{{ url('Master/Setting/View-Config-Mast') }}">
                                    <i class="fa fa-circle-o text-red"></i>View Config
                                  </a>

                            </li>

                          </ul>
                       

                      </li>

                    <?php } else{ }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                      <li class="<?php if(Request::segment(3) ==='Approved-Ind-Mast' || Request::segment(3) === 'View-Approved-Ind-Mast'){echo "active";} ?>">

                          <a href="#">
                            <i class="fa fa-plus" style="color:antiquewhite;"></i> Approve Ind Master
                              <i class="fa fa-angle-left pull-right"></i>
                          </a>
                             <ul class="treeview-menu">

                            <li class="<?php if(Request::segment(3) ==='Approved-Ind-Mast'){echo "active";} ?>">

                              <a href="{{ url('/Master/Setting/Approved-Ind-Mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>Add Approve Ind
                              </a>

                            </li>

                            <li class=" <?php if(Request::segment(3) === 'View-Approved-Ind-Mast'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Setting/View-Approved-Ind-Mast') }}">
                                    <i class="fa fa-circle-o text-red"></i> 
                                  View Approve Ind
                                  </a>

                            </li>

                          </ul>
                        

                      </li>

                    <?php } else{ }?>

                        <?php if(Session::get('usertype')=='admin'){ ?>

                         <li class=" <?php if(Request::segment(3) === 'Vr-Sequence' || Request::segment(3) === 'View-Vr-Sequence'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus" style="color:antiquewhite;"></i>  Vr Seq Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Vr-Sequence'){echo "active";} ?>">

                                <a href="{{ url('/Master/Setting/Vr-Sequence') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>
 
                                  Add Vr Seq <span style="display: none;">CS5</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'View-Vr-Sequence'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Setting/View-Vr-Sequence') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Vr Seq <span style="display: none;">CS5</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                        

                       <?php } else{ }?>

                       <?php if(Session::get('usertype')=='admin'){  ?>

                         <li class="<?php if(Request::segment(3) === 'add-chequeBook'||Request::segment(3) === 'add-chequeBook' || Request::segment(3) === 'view-chequeBook' || Request::segment(3) === 'add-offline-cheque-issue' || Request::segment(3) === 'view-offline-cheque-issue' || Request::segment(3) === 'add-cheque-leaf-config' || Request::segment(3) === 'view-cheque-leaf-config' || Request::segment(3) === 'add-cheque-print' || Request::segment(3) === 'view-cheque-leaf-config' ){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus" style="color:antiquewhite;"></i>  Cheque Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                             <li class=" <?php if(Request::segment(3) === 'add-chequeBook' || Request::segment(3) === 'view-chequeBook' ){echo "active";} ?>">

                              <a href="#"><i class="fa fa-plus" style="color:antiquewhite;"></i>  Chequebook Master
                                <i class="fa fa-angle-left pull-right"></i>
                              </a>

                              <ul class="treeview-menu">

                                <li class=" <?php if(Request::segment(3) === 'add-chequeBook'){echo "active";} ?>">

                                    <a href="{{ url('/configration/Setting/add-chequeBook') }}">

                                      <i class="fa fa-circle-o text-yellow"></i>
     
                                      Add Chequebook <span style="display: none;">CS5</span>

                                    </a>

                                </li>
                                
                                <li class="<?php if(Request::segment(3) === 'view-chequeBook'){echo "active";} ?>">

                                      <a href="{{ url('/configration/Setting/view-chequeBook') }}">

                                        <i class="fa fa-circle-o text-red"></i> 

                                        View Chequebook <span style="display: none;">CS5</span>

                                      </a>

                                </li>

                              </ul>

                            </li>


                            <li class=" <?php if(Request::segment(3) === 'add-offline-cheque-issue' || Request::segment(3) === 'view-offline-cheque-issue'){echo "active";} ?>">

                              <a href="#"><i class="fa fa-plus" style="color:antiquewhite;"></i>  Offln ChqIssue Master
                                <i class="fa fa-angle-left pull-right"></i>
                              </a>

                              <ul class="treeview-menu">

                                <li class=" <?php if(Request::segment(3) === 'add-offline-cheque-issue'){echo "active";} ?>">

                                    <a href="{{ url('/configration/Setting/add-offline-cheque-issue') }}">

                                      <i class="fa fa-circle-o text-yellow"></i>
     
                                      Add Offln ChqIssue <span style="display: none;">CS5</span>

                                    </a>

                                </li>
                                
                                <li class="<?php if(Request::segment(3) === 'view-offline-cheque-issue'){echo "active";} ?>">

                                      <a href="{{ url('/configration/Setting/view-offline-cheque-issue') }}">

                                        <i class="fa fa-circle-o text-red"></i> 

                                        View Offln ChqIssue <span style="display: none;">CS5</span>

                                      </a>

                                </li>

                              </ul>

                            </li>

                        <li class=" <?php if(Request::segment(3) === 'add-cheque-leaf-config' || Request::segment(3) === 'view-cheque-leaf-config'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus" style="color:antiquewhite;"></i>  ChqLeaf Config Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'add-cheque-leaf-config'){echo "active";} ?>">

                                <a href="{{ url('/configration/Setting/add-cheque-leaf-config') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>
 
                                  Add ChqLeaf Config <span style="display: none;">CS5</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'view-cheque-leaf-config') ?>">

                                  <a href="{{ url('/configration/Setting/view-cheque-leaf-config') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View ChqLeaf Config <span style="display: none;">CS5</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                        <li class=" <?php if(Request::segment(3) === 'add-cheque-print'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus" style="color:antiquewhite;"></i>  ChqLeaf Print Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'add-cheque-print'){echo "active";} ?>">

                                <a href="{{ url('/configration/Setting/add-cheque-print') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>
 
                                  Add ChqLeaf Print Master <span style="display: none;">CS5</span>

                                </a>

                            </li>
                            
                            <li class="">

                                  <a href="{{ url('/configration/Setting/view-cheque-leaf-config') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View ChqLeaf Print Master <span style="display: none;">CS5</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                        </ul>
                           
                         </li>
                       <?php } ?>

                       <?php if(Session::get('usertype')=='admin'){ ?>

                         <li class=" <?php if(Request::segment(3) === 'New-Fy-Year' || Request::segment(3) === 'New-Vr-Sequence' || Request::segment(3) === 'New_Yr_Acc_Gl_Bal' || Request::segment(3) === 'New_Yr_Item_Bal'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus" style="color:antiquewhite;"></i>  C/F New Year
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'New-Fy-Year'){echo "active";} ?>">

                                <a href="{{ url('/Master/Setting/New-Fy-Year') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>
 
                                  New Year <span style="display: none;">CS5</span>

                                </a>

                            </li>
                            <li class=" <?php if(Request::segment(3) === 'New-Vr-Sequence'){echo "active";} ?>">

                                <a href="{{ url('/Master/Setting/New-Vr-Sequence') }}">

                                  <i class="fa fa-circle-o text-red"></i>
 
                                  Vr Seq No <span style="display: none;">CS5</span>

                                </a>

                            </li>
                            
                            <li class="<?php if(Request::segment(3) === 'New_Yr_Acc_Gl_Bal'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Setting/New_Yr_Acc_Gl_Bal') }}">

                                    <i class="fa fa-circle-o text-yellow"></i> 

                                   Account /Gl Balance <span style="display: none;">CS5</span>

                                  </a>

                            </li>

                             <!-- <li class="< ?php if(Request::segment(3) === 'Demo_New_Yr_Acc_Gl_Bal'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Setting/Demo_New_Yr_Acc_Gl_Bal') }}">

                                    <i class="fa fa-circle-o text-yellow"></i> 

                                   Demo Gl Balance <span style="display: none;">CS5</span>

                                  </a>

                            </li> -->

                            <li class="<?php if(Request::segment(3) === 'New_Yr_Item_Bal'){echo "active";} ?>">

                                  <a href="{{ url('/Master/Setting/New_Yr_Item_Bal') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                   Item Balance <span style="display: none;">CS5</span>

                                  </a>

                            </li>

                          </ul>

                        </li>

                        

                       <?php } else{ }?>

                       <?php if(Session::get('usertype')=='admin'){ ?>

                       <li class=" <?php if(Request::segment(3) === 'Master-Remark' || Request::segment(3) === 'View-Master-Remark'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus" style="color:antiquewhite;"></i> Master Remark
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Master-Remark'){echo "active";} ?>">

                                <a href="{{ url('/Master/Setting/Master-Remark') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>
 
                                  Add Remark <span style="display: none;">CS5</span>

                                </a>

                            </li>
                            <li class=" <?php if(Request::segment(3) === 'View-Master-Remark'){echo "active";} ?>">

                                <a href="{{ url('/Master/Setting/View-Master-Remark') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>
 
                                  View Remark <span style="display: none;">CS5</span>

                                </a>

                            </li>

                          </ul>
                       </li> 

                       <?php } else{ }?>

                       <?php if(Session::get('usertype')=='admin'){ ?>

                       <li class=" <?php if(Request::segment(3) === 'Excel-Configuration' || Request::segment(3) === 'View-Excel-Configuration'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus" style="color:antiquewhite;"></i> Excel Configuration
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'Excel-Configuration'){echo "active";} ?>">

                                <a href="{{ url('/Master/Setting/Excel-Configuration') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>
 
                                  Add Excel Config <span style="display: none;">CS5</span>

                                </a>

                            </li>
                            <li class=" <?php if(Request::segment(3) === 'View-Excel-Configuration'){echo "active";} ?>">

                                <a href="{{ url('/Master/Setting/View-Excel-Configuration') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>
 
                                  View Excel Config <span style="display: none;">CS5</span>

                                </a>

                            </li>

                          </ul>
                       </li> 

                       <?php } else{ }?>


                        <li class=" <?php if(Request::segment(2) ==='importfile'){echo "active";} ?>">

                          <a href="{{ url('/finance/importfile') }}"><i class="fa fa-circle-o text-red" style="color:antiquewhite;"></i>  Import Files
                            
                          </a>
                        </li> 



           </ul>

        </li>
<!----- END TAX / CASH MASTER------>


               <li class=" <?php if(Request::segment(3) === 'User-Mast' || Request::segment(3) ==='View-User-Mast' || Request::segment(3) ==='Edit-User-Mast' || Request::segment(3) === 'view-user-right' || Request::segment(3) === 'form-user-right' || Request::segment(3) === 'add-menu-url' || Request::segment(3) === 'view-menu-url'){echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> 
                    User Profile

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>


            <ul class="treeview-menu">

             <?php 

                if(Session::get('usertype')=='admin') { 

              ?>

                <li class="<?php if(Request::segment(3) === 'User-Mast' || Request::segment(3) ==='View-User-Mast' || Request::segment(3) ==='Edit-User-Mast') { echo "active";} ?>">

                  <a href="pages/examples/login.html">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> 

                    Master User 

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                    <ul class="treeview-menu">

                    <li class=" <?php if(Request::segment(3) === 'User-Mast') { echo "active";} ?>">

                      <a href="{{ url('/Master/Setting/User-Mast') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add User <span style="display: none;">CU0</span>

                      </a>

                    </li>



                    <li class="<?php if(Request::segment(3) ==='View-User-Mast') { echo "active";} ?>">

                      <a href="{{ url('/Master/Setting/View-User-Mast') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View User <span style="display: none;">CU0</span>

                      </a>

                    </li>

                  </ul>

                </li>

              <?php  } else{} ?>

               <?php 

                if(Session::get('usertype')=='admin') { 

              ?>



                <li class="<?php if(Request::segment(3) === 'user-profie-right' ||  Request::segment(3) === 'view-user-profile-right') { echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> 

                     User Profile Rights <span style="display: none;">CU1</span>

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                    <ul class="treeview-menu">

                    <li class=" <?php if(Request::segment(3) === 'user-profie-right') { echo "active";} ?>">

                      <a href="{{ url('/master/setting/user-profie-right') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add User Profile Right<span style="display: none;">CU1</span>

                      </a>

                    </li>



                    <li class="<?php if(Request::segment(3) === 'view-user-right') { echo "active";} ?>">

                      <a href="{{ url('/master/setting/view-user-profile-right') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View User Profile Right <span style="display: none;">CU1</span>

                      </a>

                    </li>

                  </ul>

                </li>

              <?php  } else{} ?>

                <?php 

                if(Session::get('usertype')=='admin') { 

              ?>



                <li class="<?php if(Request::segment(3) === 'form-user-right' ||  Request::segment(3) === 'view-user-right') { echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> 

                     User Rights <span style="display: none;">CU1</span>

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                    <ul class="treeview-menu">

                    <li class=" <?php if(Request::segment(3) === 'form-user-right') { echo "active";} ?>">

                      <a href="{{ url('/Master/Setting/form-user-right') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add User Right<span style="display: none;">CU1</span>

                      </a>

                    </li>



                    <li class="<?php if(Request::segment(3) === 'view-user-right') { echo "active";} ?>">

                      <a href="{{ url('/Master/Setting/view-user-right') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View User Right <span style="display: none;">CU1</span>

                      </a>

                    </li>

                  </ul>

                </li>

              <?php  } else{} ?>
              
               <?php 

                if(Session::get('usertype')=='admin') { 

              ?>



                <li class="<?php if(Request::segment(3) === 'add-menu-url' ||  Request::segment(3) === 'view-menu-url') { echo "active";} ?>">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> 

                     Menu URL <span style="display: none;">CU1</span>

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                    <ul class="treeview-menu">

                    <li class=" <?php if(Request::segment(3) === 'add-menu-url') { echo "active";} ?>">

                      <a href="{{ url('/Master/Setting/add-menu-url') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Menu URL<span style="display: none;">CU1</span>

                      </a>

                    </li>



                    <li class="<?php if(Request::segment(3) === 'view-menu-url') { echo "active";} ?>">

                      <a href="{{ url('/Master/Setting/view-menu-url') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Menu URL <span style="display: none;">CU1</span>

                      </a>

                    </li>

                  </ul>

                </li>

              <?php  } else{} ?>


           </ul>

        </li>


        <li class=" <?php if(Request::segment(2) === 'engine-table-config'){echo "active";} ?>">

            <a href="{{ url('configration/engine-table-config') }}">

              <i class="fa fa-plus" style="color:antiquewhite;"></i> 
              Engine Table Config

              <i class="fa fa-angle-left pull-right"></i>

            </a>

        </li>

        <li class=" <?php if(Request::segment(2) ==='database-config'){echo "active";} ?>">

          <a href="{{ url('configration/database-config') }}"><i class="fa fa-circle-o text-red" style="color:antiquewhite;"></i>  Database Config
            
          </a>
        </li> 

        <li class=" <?php if(Request::segment(2) ==='test-api-config'){echo "active";} ?>">

          <a href="{{ url('configration/test-api-config') }}"><i class="fa fa-circle-o text-orange" style="color:antiquewhite;"></i>  Test Api 
            
          </a>
        </li>

<!----- END TAX / CASH MASTER------>
               
                 


              </ul>
            </li>

             <?php } else{ }?>



<?php if(Session::get('usertype')=='CRM'){ ?>

           
              <li class="treeview ">

                  <a href="#">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> CRM

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>


            <ul class="treeview-menu">

           
            
            

                   <li class=" <?php if(Request::segment(3) === 'Company-Mast' || Request::segment(3) ==='View-Company-Mast' || Request::segment(3) ==='Edit-Company-Mast') { echo "active";} ?>">

                  <a href="pages/examples/invoice.html">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> 

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



                    <li class="<?php if(Request::segment(3) ==='View-CRM-Enquiery') { echo "active";} ?>">

                      <a href="{{ url('/Transaction/Crm/View-Crm-Enquery-Trans') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Enquiry <span style="display: none;">CS0</span>

                      </a>

                    </li>

                  </ul>

                </li>



           

                    
              
                <li class="<?php if(Request::segment(3) === 'Fy-Mast' || Request::segment(3) ==='View-Fy-Mast' || Request::segment(3) ==='Edit-Fy-Mast' ) { echo "active";} ?>">

                  <a href="">

                    <i class="fa fa-plus" style="color:antiquewhite;"></i> 

                    Quotation

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                   <ul class="treeview-menu">

                    <li class=" <?php if(Request::segment(3) === 'CRM-Quotation') { echo "active";} ?>">

                      <a href="{{ url('/Transaction/CRM/CRM-Quotation') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Quotation <span style="display: none;">CS1</span>

                      </a>

                    </li>



                    <li class="<?php if(Request::segment(3) ==='View-CRM-Quotation') { echo "active";} ?>">

                      <a href="{{ url('/Transaction/Crm/View-Crm-Quotation-Trans') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Quotation <span style="display: none;">CS1</span>

                      </a>

                    </li>

                  </ul>



                </li>


            
                    
                    <li class=" <?php if(Request::segment(3) === 'Profit-Center-Mast' || Request::segment(3) === 'View-Profit-Center-Mast'){echo "active";} ?>">

                          <a href="#"><i class="fa fa-plus" style="color:antiquewhite;"></i> Order
                             <i class="fa fa-angle-left pull-right"></i>
                          </a>

                           <ul class="treeview-menu">

                            <li class=" <?php if(Request::segment(3) === 'CRM-Order'){echo "active";} ?>">

                              <a href="{{ url('/Transaction/CRM/CRM-Order') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Order <span style="display: none;">CS2</span>

                              </a>

                            </li>



                            <li class="<?php if(Request::segment(3) === 'View-CRM-Order'){echo "active";} ?>">

                                  <a href="{{ url('/Transaction/CRM/View-CRM-Order') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                  View Order <span style="display: none;">CS2</span>

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
