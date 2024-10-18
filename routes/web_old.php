C<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*----------- start : get method ----------*/
Route::prefix('/')->group(function () {

Route::group(['middleware' => 'prevent-back-history'],function(){
  
Route::get('/', 'MyAdminController@index');
Route::get('/userinactivity/{inactivity}', 'MyAdminController@index');
Route::get('/userlogout/{inactivity}', 'MyAdminController@index');
Route::get('/dashboard', 'MyAdminController@Dashboard');
Route::get('/crmdashboard', 'MyAdminController@CrmDashboard');
Route::get('/sendotpmail', 'MyAdminController@SendMailPassword');

Route::get('/students','FinanceMasterController@printindex');
Route::get('/prnpriview','FinanceMasterController@prnpriview');




/* ---------- start dashboard ---------*/

  Route::get('/qr-code-generator', 'ColdStorageTransController@GenerateQRCode');
  
  Route::get('/Dashboard/Top-Sales', 'DashboardController@TopSales');
  Route::get('/Dashboard/Top-Item', 'DashboardController@TopItem');
  Route::get('/Dashboard/Top-debitors', 'DashboardController@TopDebitors');
  Route::get('/Dashboard/Top-creditor', 'DashboardController@TopCreditors');
  Route::get('/Dashboard/Open-Order', 'DashboardController@openOrdr');
  Route::get('/Dashboard/Score-Card-Defination', 'DashboardController@scoreCardDefination');
  Route::get('/Dashboard/Vehical-doc-updation', 'DashboardController@vehicalDocUpdate');
  Route::get('/Dashboard/Trips-status', 'DashboardController@TripStatus');
  Route::get('/dashoard/track-vehicle', 'DashboardController@TrackVehicle');
  
  Route::post('/Dashboard/Party-Details-Of-Open-Order', 'DashboardController@showDetailOfOpenOrdr');
  Route::get('/Dashboard/user/tcode/form', 'DashboardController@userTcodeForm');

  Route::get('/Dashboard/Age-Analysis', 'DashboardController@AgeAnalysis');
  Route::post('/Dashboard/Party-Wise-Age-Analysis', 'DashboardController@showDetailOfAgeAnalysis');
  

  Route::post('/party-wise-data-for-bargraph', 'DashboardController@partyWiseBarGraph');
  
  Route::post('/save-user-tcode-data', 'DashboardController@SaveUserTcodeForm');
  Route::post('/delete-user-tcode-data', 'DashboardController@DeleteUserCode');
  Route::post('/assign-task-to-user', 'DashboardController@AssignTaskUser');
  Route::post('/update-task-status-of-user', 'DashboardController@updateTaskStatus');
  Route::post('/save-closed-task-trans', 'DashboardController@SaveClosedTransTrack');
  Route::post('/fetch-all-task-of-user', 'DashboardController@fetchAlTaskOfUser');
  Route::post('/save-reply-of-fromuser-for-touser', 'DashboardController@replyTaskStatus');
  Route::get('/get-data-track-vehicle','DashboardController@TrackVehicleTblData');
   Route::post('/get-live-track-vehicle-data-from-api', 'DashboardController@getTrackVehicleFromApi');

/* ---------- end dashboard ---------*/


/* --------------- for new cash bank -------------- */

  Route::get('/Transaction/Account/Check-Cash-Bank-Transaction', 'FinanceAccountTransController@CheckCashBankTransaction');


  Route::get('/Transaction/Account/Cash-Bank-Transaction', 'FinanceAccountTransController@NewCashBankTransaction');

  Route::post('/new-save-cash-bank-transaction', 'FinanceAccountTransController@NewCashBankSaveCreate');

/* --------------- for new cash bank -------------- */



/* ----------- start bill tracking -------- */

  Route::get('/Report/BillTracking/Bill-Allocation', 'BillTrackingController@BillAllocation');
  Route::get('/get-data-for-bill-allocation', 'BillTrackingController@getDataBillAllocation');
  Route::post('/get-data-for-age-analysis-in-cv-position', 'BillTrackingController@GetDataForAgeAnaForCVPonstn');
  Route::get('/view-customer-vendor/position', 'BillTrackingController@ViewCostVendorPostn');
  Route::get('/get-data-customer-or-vendor/position', 'BillTrackingController@getDataCustVenPosition');
  Route::get('/get-pending-bills-report-data/{accCode}', 'BillTrackingController@pendingBillsReport');
  Route::post('/get-data-of-pending-bill', 'BillTrackingController@pendingBillforDC');
  Route::post('/get-details-of-pending-bill', 'BillTrackingController@PendingBillsDetails');
  Route::post('/get-details-of-amnt-allocation', 'BillTrackingController@AmountAllocation');
  Route::post('/report-update-allocatAmt-bilpay', 'BillTrackingController@AmountAllocateUpdate');
  Route::get('/report-pending-complete-bill-payment', 'BillTrackingController@pendingBilPayment');
  Route::post('/get-acc-data-against-atype', 'BillTrackingController@AccListAgainstAType');
  Route::post('/get-all-data-of-bill-payment', 'BillTrackingController@getAllDataBilPay');
/* ----------- end bill tracking ---------- */

/* ------ start employee grade master ------ */
  
  Route::get('/Master/Employee/Emp-Grade-Mast', 'EmployeeMasterController@AddEmpGrade');

  Route::get('/Master/Employee/View-Emp-Grade-Mast', 'EmployeeMasterController@ViewEmployeeGrade');

  Route::get('/Master/Employee/Edit-Emp-Grade/{id}', 'EmployeeMasterController@EditEmpGrade');

  Route::post('/Master/Employee/Emp-Grade-Save', 'EmployeeMasterController@SaveEmployeeGradeMaster');

  Route::post('Master/Employee/Emp-Grade-Update', 'EmployeeMasterController@EmpGradeUpdate');
  Route::post('/delete-emp-grade', 'EmployeeMasterController@DeleteEmpGrade');

/* ------ end employee grade master ------ */

/* ----- start employee designation master ------ */

  Route::get('/Master/Employee/Emp-Designation-Mast', 'EmployeeMasterController@AddEmpDesignation');

  Route::get('/Master/Employee/View-Emp-Designation-Mast', 'EmployeeMasterController@ViewEmployeeDesignation');

  Route::get('/Master/Employee/Edit-Emp-Designation-Mast/{id}', 'EmployeeMasterController@EditEmpDesignation');

  Route::post('/Master/Employee/employee-designation-save', 'EmployeeMasterController@SaveEmployeeDesignation');

  Route::post('/Master/Employee/form-emp-designation-update', 'EmployeeMasterController@EmpDesignationUpdate');

  Route::post('/delete-emp-designation', 'EmployeeMasterController@DeleteEmpDesignation');

/* ----- end employee designation master ------ */


/* ----------start employee position master --*/


Route::get('/Master/Employee/Emp-Position-Mast', 'EmployeeMasterController@AddEmpPosition');

Route::post('/Master/Employee/employee-position-save', 'EmployeeMasterController@SaveEmployeePosition');

Route::get('/Master/Employee/View-Emp-Position-Mast', 'EmployeeMasterController@ViewEmployeePosition');

Route::post('/delete-emp-position', 'EmployeeMasterController@DeleteEmpPosition');

Route::get('/Master/Employee/Edit-Emp-Position-Mast/{id}', 'EmployeeMasterController@EditEmpPosition');

Route::post('/Master/Employee/form-emp-position-update', 'EmployeeMasterController@EmpPositionUpdate');

/* ----------end employee position master --*/

/*-----Start employee Activity--------*/

Route::get('/Master/Employee/Emp-Activity-Mast', 'EmployeeMasterController@AddEmpActivity');

Route::post('/Master/Employee/employee-activity-save', 'EmployeeMasterController@SaveEmployeeActivity');

Route::get('/Master/Employee/View-Emp-Activity-Mast', 'EmployeeMasterController@ViewEmployeeActivity');

Route::post('/delete-emp-activity', 'EmployeeMasterController@DeleteEmpActivity');

Route::get('/Master/Employee/Edit-Emp-Activity-Mast/{id}', 'EmployeeMasterController@EditEmpActivity');

Route::post('/Master/Employee/form-emp-activity-update', 'EmployeeMasterController@EmpActivityUpdate');

/*------end employee Activity---------*/

/*-----Start employee Position Activity--------*/

Route::get('/Master/Employee/Emp-Position-Activity-Mast', 'EmployeeMasterController@AddEmpPosActivity');

Route::post('/Master/Employee/employee-position-activity-save', 'EmployeeMasterController@SaveEmployeePosActivity');

Route::get('/Master/Employee/View-Emp-Position-Activity-Mast', 'EmployeeMasterController@ViewEmployeePosActivity');

Route::post('/delete-emp-position-activity', 'EmployeeMasterController@DeleteEmpPosActivity');

Route::post('/Master/Employee/View-MultiplePosition', 'EmployeeMasterController@EmpMulPosActivity');

Route::get('/Master/Employee/Edit-Emp-Pos-Activity/{id}', 'EmployeeMasterController@EditEmpPosActivity');

Route::post('/Master/Employee/form-emp-pos-activity-update', 'EmployeeMasterController@EmpPosActivityUpdate');

/*-----end employee Position Activity--------*/

/*-----Start employee City Class--------*/

Route::get('/Master/Employee/Emp-City-Class-Mast', 'EmployeeMasterController@AddEmpCityClass');

Route::post('/Master/Employee/emp-city-class-save', 'EmployeeMasterController@SaveEmployeeCityClass');

Route::get('/Master/Employee/View-Emp-City-Class-Mast', 'EmployeeMasterController@ViewEmployeeCityClass');

Route::post('/delete-emp-city-class', 'EmployeeMasterController@DeleteEmpCityClass');

Route::get('/Master/Employee/Edit-Emp-City-Class/{id}', 'EmployeeMasterController@EditEmpCityClass');

Route::post('/Master/Employee/form-emp-city-class-update', 'EmployeeMasterController@EmpCityClassUpdate');

/*-----End employee City Class--------*/

/*-----Start employee KPI --------*/

Route::get('/Master/Employee/Emp-KPI-Mast', 'EmployeeMasterController@AddEmpKPI');

Route::post('/Master/Employee/emp-KPI-save', 'EmployeeMasterController@SaveEmployeeKPI');

Route::get('/Master/Employee/View-Emp-KPI-Mast', 'EmployeeMasterController@ViewEmployeeKPI');

Route::post('/delete-emp-KPI', 'EmployeeMasterController@DeleteEmpKPI');

Route::get('/Master/Employee/Edit-Emp-KPI/{id}', 'EmployeeMasterController@EditEmpKPI');

Route::post('/Master/Employee/form-emp-KPI-update', 'EmployeeMasterController@EmpKPIUpdate');

/*-----End employee KPI--------*/

/*----Start Employee Tour Eligible--*/

Route::get('/Master/Employee/Emp-Tour-Eligible-Mast', 'EmployeeMasterController@AddEmpTourEligible');

Route::post('/Master/Employee/Emp-Tour-Eligible-Save', 'EmployeeMasterController@SaveEmpTourEligible');

Route::get('/Master/Employee/View-Emp-Tour-Eligible-Mast', 'EmployeeMasterController@ViewEmpTourEligible');

Route::post('/delete-emp-Tour-Eligible', 'EmployeeMasterController@DeleteEmpTourEligible');

Route::get('/Master/Employee/Edit-Emp-Tour-Eligible/{id}', 'EmployeeMasterController@EditEmpTourEligible');

Route::post('/Master/Employee/Form-Emp-Tour-Eligible-Update', 'EmployeeMasterController@EmpTourEligibleUpdate');

/*----End Employee Tour Eligible-- */

/*--Start employee KRA---------*/

Route::get('/Master/Employee/Emp-KRA-Mast', 'EmployeeMasterController@AddEmpKRA');

Route::post('/Master/Employee/emp-KRA-save', 'EmployeeMasterController@SaveEmployeeKRA');

Route::get('/Master/Employee/View-Emp-KRA-Mast', 'EmployeeMasterController@ViewEmployeeKRA');

Route::post('/delete-emp-KRA', 'EmployeeMasterController@DeleteEmpKRA');

Route::get('/Master/Employee/Edit-Emp-KRA/{id}', 'EmployeeMasterController@EditEmpKRA');

Route::post('/Master/Employee/form-emp-KRA-update', 'EmployeeMasterController@EmpKRAUpdate');

/*---End employee KRA----------*/

/*--Start Mode of Transport---*/

Route::get('/Master/ModeOfTransport/Emp-Mode-of-Transport-Mast', 'EmployeeMasterController@AddModeOfTransport');

Route::post('/Master/ModeOfTransport/emp-mode-of-transport-save', 'EmployeeMasterController@SaveModeOfTransport');

Route::get('/Master/ModeOfTransport/View-Emp-Mode-of-Transport-Mast', 'EmployeeMasterController@ViewModeOfTransport');

Route::post('/delete-emp-Mode-of-Transport', 'EmployeeMasterController@DeleteModeOfTransport');

Route::get('/Master/ModeOfTransport/Edit-Emp-Mode-of-Transport/{id}', 'EmployeeMasterController@EditModeOfTransport');

Route::post('/Master/ModeOfTransport/form-emp-mode-of-transport-update', 'EmployeeMasterController@UpdateModeOfTransport');

/*--End Mode of Transport---*/

/*--Start Hotel Master----*/

Route::get('/Master/Hotel/Emp-Hotel-Mast', 'EmployeeMasterController@AddHotel');

Route::post('/Master/Hotel/emp-hotel-save', 'EmployeeMasterController@SaveHotel');

Route::get('/Master/Hotel/View-Emp-Hotel-Mast', 'EmployeeMasterController@ViewHotel');

Route::post('/delete-emp-hotel', 'EmployeeMasterController@DeleteHotel');

Route::get('/Master/Hotel/Edit-Emp-Hotel/{id}', 'EmployeeMasterController@EditHotel');

Route::post('/Master/Hotel/form-emp-hotel-update', 'EmployeeMasterController@UpdateHotel');

/*---End Hotel Master*/

/* -------- start employee pay master ------- */
  
  Route::get('/Master/Employee/Emp-Pay-Mast', 'EmployeeMasterController@EmpPayMaster');

  Route::get('/Master/Employee/View-Emp-Pay-Mast', 'EmployeeMasterController@ViewEmpPayMaster');

  Route::get('/Master/Employee/Edit-Emp-Pay-Mast/{id}', 'EmployeeMasterController@EditEmpPay');

  Route::post('/Master/Employee/emp-pay-save', 'EmployeeMasterController@SaveEmpPayMaster');

  Route::post('/Master/Employee/emp-pay-update', 'EmployeeMasterController@EmppayUpdate');

  Route::post('/Master/Employee/delete-emppay', 'EmployeeMasterController@DeleteEmppay');  

  Route::post('/Transaction/EmpPayTrans/emp_pay_wage', 'HrmTransactionController@EmpPayWage');

  Route::post('/Transaction/temp-emp-pay-salary-trans', 'HrmTransactionController@TempSaveSalary'); 

 Route::get('/TransactionEmployee-Salary-excel/{MONTH_YR}/{COMP_CODE}/{FY_YEAR}/{PLANT_CODE}', 'HrmTransactionController@EmpSalaryExcelReport'); 

 Route::post('/Transaction/PaymentAdvice/Emp-payment-Advice', 'HrmTransactionController@SaveEmpPaymentAdvice'); 

 Route::post('/Transaction/PaymentAdvice/Update-Emp-payment-Advice', 'HrmTransactionController@UpdateEmpPaymentAdvice'); 

 Route::post('view-emp-payment-advice-status', 'HrmTransactionController@ViewPaymentAdviceChildRow');

 

/* -------- end employee pay master ------- */


/* ------ start leave type master ------- */
  
  Route::get('/Master/Employee/Emp-leaveType-Mast', 'EmployeeMasterController@LeaveType');

  Route::get('/Master/Employee/View-Emp-leaveType-Mast', 'EmployeeMasterController@ViewLeaveType');

  Route::get('/Master/Employee/Edit-Emp-leaveType-Mast/{id}', 'EmployeeMasterController@EditLeaveType');

  Route::post('/Master/Employee/employee-leave-type-save', 'EmployeeMasterController@SaveLeaveTypeMaster');

  Route::post('/Master/delete-emp-leave-type', 'EmployeeMasterController@DeleteLeaveType');

  Route::post('Master/Employee/form-emp-leave-type-update', 'EmployeeMasterController@EmpLeaveTypeUpdate');

/* ------ end leave type master ------- */

/* ----- start leave quota master ------ */

  Route::get('/Master/Employee/Emp-leave-Quota-Mast', 'EmployeeMasterController@LeaveQuota');

  Route::get('/Master/Employee/View-Emp-leave-Quota-Mast', 'EmployeeMasterController@ViewLeaveQuota');

  Route::get('/Master/Employee/Edit-Emp-leave-Quota-Mast/{id}', 'EmployeeMasterController@EditLeaveQuota');

  Route::post('/Master/Employee/employee-leave-quota-save', 'EmployeeMasterController@SaveLeaveQuotaMaster');

  Route::post('/Master/delete-emp-leave-quota', 'EmployeeMasterController@DeleteLeaveQuota');

  Route::post('/Master/Employee/form-emp-leave-quota-update', 'EmployeeMasterController@EmpLeaveQuotaUpdate');

/* ----- end leave quota master ------ */


/* ----- start wage indicator master ----- */
  
  Route::get('/Master/Employee/Emp-Wage-Indicator-Mast', 'EmployeeMasterController@WageIndicator');

  Route::get('/Master/Employee/View-Emp-Wage-Indicator-Mast', 'EmployeeMasterController@ViewWageIndicator');

  Route::get('/Master/Employee/Edit-Emp-Wage-Indicator-Mast/{id}', 'EmployeeMasterController@EditEmpWageIndicator');

  Route::post('/Master/Employee/employee-wage-indicator-save', 'EmployeeMasterController@SaveWageIndicatorMaster');

  Route::post('/Master/delete-emp-wage-indicator', 'EmployeeMasterController@DeleteWageIndicator');

  Route::post('/Master/Employee/form-emp-wage-indicator-update', 'EmployeeMasterController@EmpWageIndicatorUpdate');

/* ----- end wage indicator master ----- */

/* ------ start wage type master ------ */

  Route::get('/Master/Employee/Emp-Wage-Type-Mast', 'EmployeeMasterController@WageTypeMaster');

  Route::get('/Master/Employee/View-Emp-Wage-Type-Mast', 'EmployeeMasterController@ViewEmpWageType');

  Route::get('/Master/Employee/Edit-Emp-Wage-Type-Mast/{id}', 'EmployeeMasterController@EditEmpWageType');

  Route::post('/Master/Employee/Wage-Type-Save', 'EmployeeMasterController@WageTypeFormSave');

  Route::post('/Master/Employee/delete-emp-wage-type', 'EmployeeMasterController@DeleteWagetype');

  Route::post('/Master/Employee/form-emp-wage-type-update', 'EmployeeMasterController@EmpWageTypeUpdate');

  Route::post('Master/Employee/wage-indicator-type', 'EmployeeMasterController@WageIndicatorType');

  Route::get('/Master/Employee/View-employee-wage-type', 'EmployeeMasterController@ViewEmpWageType');


/* ------ end wage type master ------ */


/*------ start self declaration-------*/

Route::get('/Master/Employee/self-declaration', 'EmployeeMasterController@SelfDeclaration');

Route::get('/Master/Employee/view-self-declaration', 'EmployeeMasterController@ViewSelfDeclaration');

Route::post('/Master/Employee/self-declaration-save', 'EmployeeMasterController@selfDeclarationSave');

/**------end self declaration---------*/


/*----------start P_tax ------------*/

Route::get('/Master/Employee/p-tax-master', 'EmployeeMasterController@PTaxMaster');

Route::post('/Master/Employee/p-tax-save', 'EmployeeMasterController@PTaxSave');
/*----------end p_tax---------------*/

/*---------Strar Excel Demo---------*/

Route::get('/Master/Employee/Purchase-indent-excel', 'EmployeeMasterController@purchaseExcel');

Route::get('/Master/Employee/Contract-excel', 'EmployeeMasterController@contractExcel');
/*--------End excel Demo------*/

/* ------ start acc type master -----*/

  Route::get('/Master/Customer-Vendor/Mast-Acc-Type', 'CustomerController@AccountType');
  Route::get('/Master/Customer-Vendor/View-Acc-Type', 'CustomerController@AccountTypeView');
  Route::get('/Master/Customer-Vendor/Edit-Acc-Type/{id}','CustomerController@EditAccountType');

  Route::post('/Master/Customer-Vendor/Acc-Type-Save','CustomerController@AccountTypeSave');
  Route::post('/Master/Customer-Vendor/Acc-Type-Update','CustomerController@AccountTypeUpdate');
  Route::post('/Master/Customer-Vendor/Delete-Acc_Type', 'CustomerController@DeleteAccountType');

  Route::post('search-acc-type', 'CustomerController@search_acc_type');
  Route::post('help-acc-type-code-getdata', 'CustomerController@HelpAccTypeCodeSearch');
  

/* ------ end acc type master -----*/

/* -------- start account master ------- */

    Route::get('/Master/Customer-Vendor/Account-Mast', 'CustomerController@AddAccount');
    Route::get('/Master/Customer-Vendor/View-Account-Mast', 'CustomerController@ViewAccount');
    Route::get('/Master/Customer-Vendor/View-Account-Consinee', 'CustomerController@ViewAccountForConsinee');
    Route::get('/Master/Customer-Vendor/Edit-Account-Mast/{id}', 'CustomerController@EditAccount');
    
    Route::post('/Master/Customer-Vendor/Account-Save', 'CustomerController@AccountSave');

    Route::get('master/acc-master/save-msg/{savedata}', 'CustomerController@acc_save_msg');

    Route::post('/Master/Customer-Vendor/Account-Update', 'CustomerController@AccountUpdate');
    
    Route::post('/Master/Customer-Vendor/Delete-Account', 'CustomerController@DeleteAccount');

    Route::post('view-Account-chield-data', 'CustomerController@ViewAccountChieldRTowData');

    Route::post('view-party-finance-chield-data', 'CustomerController@ViewPartyFinanceChieldRTowData');
    
    Route::post('check-n-get-data-against-accType', 'CustomerController@GetDataAgainstAccType');

    Route::post('get-data-for-cash-bank-simulation', 'FinanceAccountTransController@CbSimulation');


/* -------- end account master ------- */

/* ------- start acc category master ------- */

  Route::get('/Master/Customer-Vendor/Acc-Category-Mast', 'CustomerController@AccCategory');
  Route::get('/Master/Customer-Vendor/View-Acc-Category-Mast', 'CustomerController@ViewAccCategory');
  Route::get('/Master/Customer-Vendor/Edit-Acc-Category/{id}', 'CustomerController@EditAccCategory');

  Route::post('/Master/Customer-Vendor/Acc-Category-Save', 'CustomerController@SaveAccCategory');
  Route::post('/Master/Customer-Vendor/Acc-Category-Update', 'CustomerController@UpdateAccCategory');
  Route::post('/Master/Customer-Vendor/Delete-Acc-Category', 'CustomerController@DeleteAccCat');

  Route::post('help-AccCatCode-getdata', 'CustomerController@HelpAccCatCodeGet');
  Route::post('sarch-acc-cat-code-get', 'CustomerController@search_AccCatCode');

/* ------- end acc category master ------- */

/* ------- start acc class master -------- */
  
  Route::get('/Master/Customer-Vendor/Acc-Class', 'CustomerController@AccClass');
  Route::get('/Master/Customer-Vendor/View-Acc-Class', 'CustomerController@ViewAccClass');
  Route::get('/Master/Customer-Vendor/Edit-Acc-Class/{id}', 'CustomerController@EditAccClass');
    
  Route::post('/Master/Customer-Vendor/Acc-Class-Save', 'CustomerController@AccClassSave');
  Route::post('/Master/Customer-Vendor/Acc-Class-Update', 'CustomerController@AccClassFormUpdate');
  Route::post('/Master/Customer-Vendor/Delete-Acc-Class', 'CustomerController@DeleteAccClass');

  Route::post('help-AccCode-getdata', 'CustomerController@HelpAccClasCodeGet');
  Route::post('search-acc-class-get', 'CustomerController@search_AccClsCode');

/* ------- end acc class master -------- */

/* ------- start account balence master -------- */

  Route::get('/Master/Customer-Vendor/Acc-Balence-Mast','CustomerController@AccBalence');
  Route::get('/Master/Customer-Vendor/View-Acc-Balence-Mast', 'CustomerController@ViewAccBalence');
  Route::get('/Master/Customer-Vendor/Edit-Acc-Balence-Mast/{accCd}/{cmpCd}/{fyCd}', 'CustomerController@EditAccBalence');

  Route::post('/Master/Customer-Vendor/Acc-Bal-Save', 'CustomerController@AccBalenceSave');
  Route::post('/Master/Customer-Vendor/Acc-Bal-Update', 'CustomerController@AccBalenceUpdate');
  Route::post('/Master/Customer-Vendor/Delete-Acc-Bal', 'CustomerController@DeleteAccBalence');

  Route::post('/finance/get_year', 'CustomerController@GetYear');


/* ------- end account balence master -------- */

/* ----- start glsch master -----*/

  Route::get('/Master/General-Ledger/Glsch-Mast', 'GlController@Glsch');
  Route::get('/Master/General-Ledger/View-Glsch', 'GlController@ViewGlsch');
  Route::get('/Master/General-Ledger/Edit-Glsch/{id}', 'GlController@EditGlsch');

  Route::post('/form-glsch-save', 'GlController@SaveGlsch');
  Route::post('/delete-glsch', 'GlController@DeleteGlsch');
  Route::post('/form-glsch-update', 'GlController@UpdateGlsch');

  Route::post('search-glsch-code', 'GlController@search_GlschCode');
  Route::post('help-glsch-code-getdata', 'GlController@HelpGlschCodeSearch');
  Route::post('get-by-glsch-type', 'GlController@search_GlschType');

/* ----- end glsch master -----*/


/* ----- start gl master -----*/

  Route::get('/Master/General-Ledger/Gl-Mast', 'GlController@GlMast');
  Route::get('/Master/General-Ledger/View-Gl-Mast', 'GlController@ViewGlMast');
  Route::get('/Master/General-Ledger/Edit-Gl-Mast/{id}', 'GlController@EditGlMast');

  Route::post('/form-glmast-save', 'GlController@SaveGlMast');
  Route::post('/delete-gl-mast', 'GlController@DeleteGl');
  Route::post('/form-gl-mast-update', 'GlController@UpdateGlMast');

  Route::post('/glsch-code-for-generate-gl', 'GlController@glschForGenerateGlCode');

/* ----- end gl master -------*/

/* ----- start gl balence master -----*/
  
  Route::get('/Master/General-Ledger/Gl-Bal-Mast','GlController@GlBalMast');
  Route::get('/Master/General-Ledger/View-Gl-Bal-Mast', 'GlController@ViewGlBalMast');
  Route::get('/Master/General-Ledger/Edit-Gl-Bal-Mast/{id}/{btnControl}', 'GlController@EditGlBalMast');


  Route::post('/finance/form-gl-bal-save', 'GlController@GlBalFormSave');
  Route::post('/finance/delete-gl-bal', 'GlController@DeleteGlBal');
  Route::post('/finance/form-mast-gl-bal-update', 'GlController@GlBalFormUpdate');

/* ----- end gl balence master -----*/

/* ----- start gl key master ----- */
  
  Route::get('/Master/General-Ledger/Gl-Key-Mast', 'GlController@GlKey');
  Route::get('/Master/General-Ledger/View-Gl-Key-Mast', 'GlController@ViewGlKey');
  Route::get('/Master/General-Ledger/Edit-Gl-Key-Mast/{id}/{glcd}', 'GlController@EditGlKey');

  Route::post('finance/form-mast-glkey-save', 'GlController@SaveGlKey');
  Route::post('/delete-gl-key', 'GlController@DeleteGlKey');
  Route::post('/finance/update-gl-keymast', 'GlController@UpdateGlKey');

  Route::post('help-gl-key-code-getdata', 'GlController@HelpGl_key_Get');
  Route::post('search-glkey-code-get', 'GlController@search_glkeycode');

/* ----- end gl key master ------ */

/* ------ start cost type master ------ */

    Route::get('/Master/Cost-Center/Cost-Type-Mast','CostCenterController@CostType');
    Route::get('/Master/Cost-Center/View-Cost-Type-Mast', 'CostCenterController@ViewCostType');
    Route::get('/Master/Cost-Center/Edit-Cost-Type/{id}', 'CostCenterController@EditCostType');

    Route::post('/Master/Cost-Center/Cost-Type-Save', 'CostCenterController@CostTypeSave');
    Route::post('/Master/Cost-Center/Cost-Type-Update', 'CostCenterController@CostTypeUpdate');
    Route::post('/Master/Cost-Center/Delete-Cost-Type', 'CostCenterController@DeleteCostType');


    Route::post('help-costtypeCode-getdata', 'CostCenterController@HelpCostTypeCodeGet');
    Route::post('search-costtype-get', 'CostCenterController@search_CostTypeCode');

/* ------ end cost type master ------ */

/* ------ start cost master -------- */

  Route::get('/Master/Cost-Center/Cost-Mast', 'CostCenterController@AddCost');
  Route::get('/Master/Cost-Center/View-Cost-Mast', 'CostCenterController@ViewCost');
  Route::get('/Master/Cost-Center/Edit-Cost-Mast/{id}/{btnControl}', 'CostCenterController@EditCost');

  Route::post('/Master/Cost-Center/Cost-Save', 'CostCenterController@CostSave');
  Route::post('/Master/Cost-Center/Delete-Cost', 'CostCenterController@DeleteCost');
  Route::post('/Master/Cost-Center/Cost-Update', 'CostCenterController@UpdateCost');

  Route::post('/get-cost-group-by-cost-type', 'CostCenterController@GetGroupCode');
  Route::post('help-cost-code-getdata', 'CostCenterController@Helpcost_Get');
  Route::post('search-cost-code-get', 'CostCenterController@search_costCode');

/* ------ end cost master -------- */

/* ------ start cost group master ------ */

    Route::get('/Master/Cost-Center/Cost-Group-Mast','CostCenterController@CostGroup');
    Route::get('/Master/Cost-Center/View-Cost-Group-Mast', 'CostCenterController@ViewCostGroup');
    Route::get('/Master/Cost-Center/Edit-Cost-Group/{id}', 'CostCenterController@EditCostGroup');

    Route::post('/Master/Cost-Center/Cost-Group-Save', 'CostCenterController@SaveCostGroup');
    Route::post('/Master/Cost-Center/COst-Group-Update', 'CostCenterController@UpdateCostGroup');
    Route::post('/Master/Cost-Center/Delete-Cost-Group', 'CostCenterController@DeleteCostGroup');

    Route::post('help-costgroupcode-getdata', 'CostCenterController@HelpCostGroupCodeGet');
    Route::post('search-costgroup-code-get', 'CostCenterController@search_CostGroupCode');

/* ------ end cost group master ------ */

/* ------ start cost category master ------ */

    Route::get('/Master/Cost-Center/Cost-Category', 'CostCenterController@CostCategory');
    Route::get('/Master/Cost-Center/View-Cost-Category', 'CostCenterController@ViewCostCategory');
    Route::get('/Master/Cost-Center/Edit-Cost-Category/{id}', 'CostCenterController@EditCostCategory');

    Route::post('/Master/Cost-Center/Cost-Category-Save', 'CostCenterController@CostCategorySave');
    Route::post('/Master/Cost-Center/Delete-Cost-Category', 'CostCenterController@DeleteCostCategory');
    Route::post('/Master/Cost-Center/Cost-Category-Update', 'CostCenterController@CostCategoryUpdate');

    Route::post('help-costcat-code-getdata', 'CostCenterController@Helpcostcat_Get');
    Route::post('search-cost-cat-code-get', 'CostCenterController@search_costcatCode');

/* ------ end cost category master ------ */

/* ------ start cost class master ------ */

    Route::get('/Master/Cost-Center/Cost-Class-Mast','CostCenterController@CostClass');
    Route::get('/Master/Cost-Center/View-Cost-Class-Mast', 'CostCenterController@ViewCostClass');
    Route::get('/Master/Cost-Center/Edit-Cost-Class/{id}', 'CostCenterController@EditCostClass');

    Route::post('/Master/Cost-Center/Cost-Class-Save', 'CostCenterController@CostClassSave');
    Route::post('/Master/Cost-Center/Delete-Cost-Class', 'CostCenterController@DeleteCostClass');
    Route::post('/Master/Cost-Center/Cost-Class-Update', 'CostCenterController@CostClassFormUpdate');

    Route::post('help-costclasscode-getdata', 'CostCenterController@HelpCostClassCodeGet');
    Route::post('search-costcls-get', 'CostCenterController@search_CostClassCode');

/* ------ end cost class master ------ */

/* ------- start valutaion master ------- */

  Route::get('/Master/Cost-Center/Valuation-Mast', 'CostCenterController@AddValuation');
  Route::get('/Master/Cost-Center/View-Valuation-Mast', 'CostCenterController@ViewValuation');
  Route::get('/Master/Cost-Center/Edit-Valuation-Mast/{id}', 'CostCenterController@EditValuation');

  Route::post('/Master/Cost-Center/Valuation-Save', 'CostCenterController@ValuationSave');
  Route::post('/Master/Cost-Center/Delete-Valuation', 'CostCenterController@DeleteValuation');
  Route::post('/Master/Cost-Center/Valuation-Update', 'CostCenterController@ValuationUpdate');

  Route::post('help-valuation-getdata', 'CostCenterController@HelpValuationSearch');
  Route::post('search-valuation-getdata', 'CostCenterController@search_ValuationCode');

/* ------- end valutaion master ------- */

/* ------- start valuation tran master ------- */
  
  Route::get('/Master/Cost-Center/Valuation-Tran-Mast', 'CostCenterController@ValuationTran');
  Route::get('/Master/Cost-Center/View-Valuation-Tran-Mast', 'CostCenterController@ViewValuationTran');
  Route::get('/Master/Cost-Center/Edit-Valuation-Tran-Mast/{id}', 'CostCenterController@EditValuationTran');

  Route::post('/Master/Cost-Center/Valuation-Tran-Save', 'CostCenterController@ValuationTransSave');
  Route::post('/Master/Cost-Center/Valution-Tran-Update', 'CostCenterController@UpdateValuationTran');
  Route::post('/Master/Cost-Center/Delete-Valuation-Tran', 'CostCenterController@DeleteValuationTrans');

/* ------- end valuation tran master ------- */

/* ------ start house bank master ----- */

  Route::get('/Master/House-bank-cash/House-Bank-Mast', 'HouseBankController@HouseBank');
  Route::get('/Master/House-bank-cash/Edit-House-Bank-Mast/{id}', 'HouseBankController@EditHouseBank');
  Route::get('/Master/House-bank-cash/View-House-Bank-Mast', 'HouseBankController@ViewHouseBank');

  Route::post('/Master/House-bank-cash/House-Bank-Save', 'HouseBankController@HouseBankSave');
  Route::post('/Master/House-bank-cash/House-Bank-Update', 'HouseBankController@HouseBankUpdate');
  Route::post('/Master/House-bank-cash/Delete-House-Bank', 'HouseBankController@DeleteHouseBank');

  Route::post('view-house-bank-mast-chield-data', 'HouseBankController@HouseBankChieldRTowData');

  Route::post('/finance/get_pfct', 'HouseBankController@GetPfctCode');

/* ------ end house bank master ----- */

/* ------- start house cash master ---------- */
  
  Route::get('/Master/House-bank-cash/House-Cash-Mast', 'HouseBankController@HouseCash');
  Route::get('/Master/House-bank-cash/View-House-Cash-Mast', 'HouseBankController@ViewHouseCash');
  Route::get('/Master/House-bank-cash/Edit-House-Cash/{id}', 'HouseBankController@EditHouseCash');

  Route::post('/Master/House-bank-cash/House-Cash-Save', 'HouseBankController@HouseCashSave');
  Route::post('/Master/House-bank-cash/House-Cash-Update', 'HouseBankController@HouseCashUpdate');
  Route::post('/Master/House-bank-cash/Delete-House-Cash', 'HouseBankController@DeleteHouseCash');

  Route::post('/finance/search-cash-code', 'HouseBankController@search_cash_code');
  Route::post('/finance/help-cash-code-getdata', 'HouseBankController@HelpCashCodeSearch');

/* ------- end house cash master ---------- */

/* ----- start bank master -----*/

  Route::get('/Master/House-Bank-Cash/Bank-Mast', 'FinanceMasterController@BankMaster');
  Route::get('/Master/House-Bank-Cash/View-Bank-Mast', 'FinanceMasterController@ViewBankMast');
  Route::get('/Master/House-Bank-Cash/Edit-Bank-Mast/{id}', 'FinanceMasterController@EditBankMast');

  Route::post('/form-bank-mast-save', 'FinanceMasterController@SaveBankMast');
  Route::post('/delete-bank-mast', 'FinanceMasterController@DeleteBankMast');
  Route::post('/form-bank-mast-update', 'FinanceMasterController@UpdateBankMast');

  Route::post('help-bankcode-getdata', 'FinanceMasterController@HelpBankCodeGet');
  Route::post('search-bank-code-get', 'FinanceMasterController@search_BankCode');

/* ----- end bank master -----*/

/* --------- start tax indicator master ------- */
  
  Route::get('/Master/InDirect-Direct-Tax/Tax-Indicator-Mast', 'IndirectTaxController@TaxIndicator');
  Route::get('/Master/InDirect-Direct-Tax/View-Tax-Indicator-Mast', 'IndirectTaxController@TaxIndicatorView');
  Route::get('/Master/InDirect-Direct-Tax/Edit-Tax-Indicator-Mast/{id}', 'IndirectTaxController@EditTaxIndicator');

  Route::post('/Master/InDirect-Direct-Tax/Tax-Indicator-Save', 'IndirectTaxController@TaxIndicatorSave');
  Route::post('/Master/InDirect-Direct-Tax/Tax-Indicator-Update', 'IndirectTaxController@TaxIndicatorUpdate');
  Route::post('/Master/InDirect-Direct-Tax/Delete-Tax-Indicator', 'IndirectTaxController@DeleteTaxIndicator');

/* --------- end tax indicator master ------- */

/* ------- start tax master ------- */

  Route::get('/Master/InDirect-Direct-Tax/Tax-Mast', 'IndirectTaxController@Tax');
  Route::get('/Master/InDirect-Direct-Tax/View-Tax-Mast', 'IndirectTaxController@ViewTax');
  Route::get('/Master/InDirect-Direct-Tax/Edit-Tax-Mast/{id}', 'IndirectTaxController@EditTax');

  Route::post('/Master/InDirect-Direct-Tax/Tax-Save', 'IndirectTaxController@SaveTax');
  Route::post('/Master/InDirect-Direct-Tax/Delete-Tax', 'IndirectTaxController@DeleteTax');
  Route::post('/Master/InDirect-Direct-Tax/Tax-Update', 'IndirectTaxController@UpdateTax');

  Route::post('search-tax-code', 'IndirectTaxController@search_TaxCode');
  Route::post('help-tax-code-getdata', 'IndirectTaxController@HelpTaxCodeSearch');

/* ------- end tax master ------- */

/* ------ start tax rate master -------- */
  
  Route::get('/Master/InDirect-Direct-Tax/Tax-Rate-Mast', 'IndirectTaxController@TaxRate');
  Route::get('/Master/InDirect-Direct-Tax/View-Tax-Rate-Mast', 'IndirectTaxController@ViewTaxRate');
  Route::get('/Master/InDirect-Direct-Tax/Edit-Tax-Rate/{id}', 'IndirectTaxController@EditTaxRate');

  Route::post('/Master/InDirect-Direct-Tax/Tax-Rate-Save', 'IndirectTaxController@TaxRateSave');
  Route::post('/Master/InDirect-Direct-Tax/Update-Tax-Rate', 'IndirectTaxController@UpdateTaxRate');
  Route::post('/Master/InDirect-Direct-Tax/Delete-Tax-Rate', 'IndirectTaxController@DeleteTaxRate');

  Route::post('/get-tax-indicator-details', 'IndirectTaxController@GetTaxIndicatorDetail');

/* ------ end tax rate master -------- */

/* ------- start tds master -------*/

  Route::get('/Master/InDirect-Direct-Tax/Tds-Mast', 'IndirectTaxController@AddTDS');
  Route::get('/Master/InDirect-Direct-Tax/View-Tds-Mast', 'IndirectTaxController@ViewTDS');
  Route::get('/Master/InDirect-Direct-Tax/Edit-Tds-Mast/{id}', 'IndirectTaxController@EditTDS');

  Route::post('/Master/InDirect-Direct-Tax/Tds-Save', 'IndirectTaxController@SaveTDS');
  Route::post('/Master/InDirect-Direct-Tax/Delete-Tds', 'IndirectTaxController@DeleteTDS');
  Route::post('/Master/InDirect-Direct-Tax/Tds-Update', 'IndirectTaxController@UpdateTDS');

  Route::post('help-tdscode-getdata', 'IndirectTaxController@HelpTDSCodeGet');
  Route::post('search-tds-code-get', 'IndirectTaxController@search_TdsCode');

/* ------- end tds master -------*/

/* ------ start tds rate master ------ */

  Route::get('/Master/InDirect-Direct-Tax/Tds-Rate-Mast', 'IndirectTaxController@TDSRate');
  Route::get('/Master/InDirect-Direct-Tax/View-Tds-Rate-Mast', 'IndirectTaxController@ViewTDSRate');
  Route::get('/Master/InDirect-Direct-Tax/Edit-Tds-Rate-Mast/{id}', 'IndirectTaxController@EditTDSRate');

  Route::post('/Master/InDirect-Direct-Tax/Tds-Rate-Save', 'IndirectTaxController@SaveTDSRate');
  Route::post('/Master/InDirect-Direct-Tax/Delete-Tds-Rate', 'IndirectTaxController@DeleteTDSRate');
  Route::post('/Master/InDirect-Direct-Tax/Tds-Rate-Update', 'IndirectTaxController@UpdateTDSRate');

/* ------ end tds rate master ------ */

/* ------- start item type master ------- */
  
  Route::get('/Master/Item/Item-Type-Mast', 'ItemController@ItemType');
  Route::get('/Master/Item/View-Item-Type', 'ItemController@ViewItemType');
  Route::get('/Master/Item/Edit-Item-Type/{id}', 'ItemController@EditItemType');

  Route::post('/Master/Item/Item-Type-Save', 'ItemController@ItemTypeSave');
  Route::post('/Master/Item/Item-Type-Update', 'ItemController@ItemTypeUpdate');
  Route::post('/Master/Item/Delete-Ttem-Yype', 'ItemController@DeleteItemType');

  Route::post('help-item-type-getdata', 'ItemController@HelpItemTypeSearch');
  Route::post('search-itemtype-oninput', 'ItemController@search_ItemTypeCode');

/* ------- end item type master ------- */

/* ------- start item master ------- */

Route::get('/Master/Item/Item-Master', 'ItemController@ItemMasterFinanc');

Route::get('/Master/Item/View-Item-Master', 'ItemController@itemMasterView');

Route::get('/Master/Item/Edit-Item-Master/{id}', 'ItemController@EditItemMaster');

Route::post('/Master/Item/form-item-master-finance-save', 'ItemController@ItemMasterFinanceSave');

Route::post('/Master/Item/form-item-master-finance-update', 'ItemController@ItemMasterFormUpdate');

Route::post('/delete-item-finance', 'ItemController@DeleteItemFinance');

/* -------- end item master ------- */

/* ------- start item group master --------- */

  Route::get('/Master/Item/Item-Group-Mast', 'ItemController@ItemGroup');
  Route::get('/Master/Item/View-Item-Group-Mast', 'ItemController@ViewItemGroup');
  Route::get('/Master/Item/Edit-Item-Group-Mast/{id}', 'ItemController@EditItemGroup');

  Route::post('/Master/Item/Item-Group-Save', 'ItemController@SaveItemGroup');
  Route::post('/Master/Item/Item-Group-Update', 'ItemController@UpdateItemGroup');
  Route::post('/Master/Item/Delete-Item-Group', 'ItemController@DeleteItemgroup');

  Route::post('help-itemgroup-getdata', 'ItemController@HelpItemGroupCodeGet');
  Route::post('search-itemgroup-code-get', 'ItemController@search_ItemGroupCode');

/* ------- end item group master --------- */

/* ------- start item category master ------ */

  Route::get('/Master/Item/Item-Category-Mast', 'ItemController@ItemCategory');
  Route::get('/Master/Item/View-Item-Category-Mast', 'ItemController@ViewItemCategory');
  Route::get('/Master/Item/Edit-Item-Category/{id}', 'ItemController@EditItemCategory');

  Route::post('/Master/Item/Item-Category-Save', 'ItemController@SaveItemCategory');
  Route::post('/Master/Item/Item-Category-Update', 'ItemController@UpdateItemCategory');
  Route::post('/Master/Item/Delete-Item-Category', 'ItemController@DeleteItemCategory');

  Route::post('help-itemcat-getdata', 'ItemController@HelpItemCatCodeGet');
  Route::post('serach-itemcat-code-getdata', 'ItemController@search_ItemCatCode');

/* ------- end item category master ------ */

/* ------- start item Schedule master ------ */

  Route::get('/Master/Item/Item-Schedule-Mast', 'ItemController@ItemSchedule');
  Route::get('/Master/Item/View-Item-Schedule-Mast', 'ItemController@ViewItemSchedule');
  Route::get('/Master/Item/Edit-Item-Schedule/{id}', 'ItemController@EditItemSchedule');

  Route::post('/Master/Item/Item-Schedule-Save', 'ItemController@SaveItemSchedule');
  Route::post('/Master/Item/Item-Schedule-Update', 'ItemController@UpdateItemSchedule');
  Route::post('/Master/Item/Delete-Item-Schedule', 'ItemController@DeleteItemSchedule');

  Route::post('help-itemSchedule-getdata', 'ItemController@HelpItemScheduleCodeGet');
  Route::post('serach-itemSchedule-code-getdata', 'ItemController@searchItemScheduleCode');

/* ------- end item Schedule master ------ */

/* ------- start item class master ------ */
  
  Route::get('/Master/Item/Item-Class-Mast', 'ItemController@ItemClass');
  Route::get('/Master/Item/View-Item-Class-Mast', 'ItemController@ViewItemClass');
  Route::get('/Master/Item/Edit-Item-Class-Mast/{id}', 'ItemController@EditItemClass');

  Route::post('/Master/Item/Item-Class-Save', 'ItemController@ItemClassSave');
  Route::post('/Master/Item/Item-Class-Update', 'ItemController@ItemClassUpdate');
  Route::post('/Master/Item/Delete-Item-Class', 'ItemController@DeleteItemClass');

  Route::post('help-item-class-getdata', 'ItemController@HelpItemClassSearch');
  Route::post('search-itemclass-oninput', 'ItemController@search_ItemClassCode');

/* ------- end item class master ------ */

/* -------- start item quality master ------- */

  Route::get('/Master/Item/Item-Quality-Mast', 'ItemController@ItemQualityMast');

  Route::get('/Master/Item/View-Item-Quality-Mast', 'ItemController@ViewItemQualityMast');

  Route::post('/Master/Item/form-mast-item-quality-save', 'ItemController@ItemQualityFormSave');

  Route::post('/Master/Item/form-mast-item-quality-update', 'ItemController@ItemQualityFormUpdate');

  Route::get('/Master/Item/Edit-Item-Quality-Mast/{id}', 'ItemController@EditItemQualityMast');

  Route::post('/Master/Item/Delete-Item-Quality-Mast', 'ItemController@DeleteItemQuality');

/* -------- end item quality master ------- */

/* -------- start item category quality master ------- */

  Route::get('/Master/Item/Item-Category-Quality-Mast', 'ItemController@ItemCatQuality');

  Route::get('/Master/Item/View-Item-Category-Quality-Mast', 'ItemController@ViewItemCatQuality');
  
  Route::get('/Master/Item/Edit-Item-Category-Quality-Mast/{id}/{iquaCd}', 'ItemController@EditItemCatQuality');

  Route::post('/Master/Item/form-item-category-quality-save', 'ItemController@SaveItemCatQuality');

  Route::post('delete-item-cat-quality-mast', 'ItemController@DeleteItemCatQuality');
  
  Route::post('/Master/Item/form-item-category-quality-update', 'ItemController@UpdateItemCategoryQuality');

  Route::post('/get_item_desc_and_um', 'ItemController@GetDescAndUm');

/* -------- end item category quality master ------- */

/* -------- start item um master --------- */

  Route::get('/Master/Item/ItemUM_Mast', 'ItemController@ItemUmForm');
  Route::get('/Master/Item/View-ItemUM_Mast', 'ItemController@ItemUmView');
  Route::get('/Master/Item/Edit-ItemUM_Mast/{itemC}/{umCd}/{aumCd}','ItemController@EditItemUmForm');

  Route::post('/Master/Item/form-mast-itemum-save','ItemController@ItemUmFormSave');
  Route::post('/Master/Item/form-mast-itemum-update', 'ItemController@ItemUmFormUpdate');
  Route::post('delete-itemum', 'ItemController@DeleteItemUm');

  Route::post('get_um_aum', 'ItemController@GetUmAum');
  
/* -------- end item um master --------- */

/* ------- start um master ------ */
  
  Route::get('/Master/Item/Um-Mast', 'ItemController@AddUm');
  Route::get('/Master/Item/view-Um-Mast', 'ItemController@ViewUm');
  Route::get('/Master/Item/Edit-Um-Mast/{id}','ItemController@EditUm');

  Route::post('/Master/Item/Um-Save', 'ItemController@UmSave');
  Route::post('/Master/Item/Um-Update', 'ItemController@UmUpdate');
  Route::post('/Master/Item/Delete-Um', 'ItemController@DeleteUm');

  Route::post('search-um-code', 'ItemController@search_um_code');
  Route::post('help-um-code-getdata', 'ItemController@HelpUmCodeSearch');

/* ------- end um master ------ */

/* -------- start item balence master ------ */ 

    Route::get('/Master/Setting/New_Yr_Item_Bal', 'SettingController@New_Yr_Item_Bal');

    Route::get('/Master/Setting/New_Yr_Acc_Gl_Bal','SettingController@AccGlBalNewYr');

    Route::get('/Master/Setting/Demo_New_Yr_Acc_Gl_Bal','SettingController@DemoAccGlBalNewYr');

    Route::get('/Master/Item/Item-Bal-Mast', 'ItemController@ItemBalance');

   Route::get('/Master/Item/View-Item-Bal-Mast', 'ItemController@ViewItemBalance');

   Route::get('/Master/Item/Edit-Item-Bal-Mast/{compcd}/{fycd}/{plantcd}/{itemcd}', 'ItemController@EditItemBalance');

   Route::post('/Master/Item/form-item-balance-save', 'ItemController@ItemBalanceSave');

   Route::post('/Master/Item/form-item-balance-update', 'ItemController@ItemBalanceUpdate');

   Route::post('/Master/Item/delete-item-balance', 'ItemController@ItemBalanceDelete');

   Route::post('/get-cfactor-by-item', 'ItemController@getCfactorByItem');

/* -------- end item balence master ------ */ 

/* ------- start item Rack master ------- */

  Route::get('/Master/Item/Item-Rack-Mast', 'ItemController@ItemRackMast');
  Route::get('/Master/Item/View-Item-Rack-Mast', 'ItemController@ViewItemRackMast');

   Route::post('/Master/Item/form-mast-item-rack-save', 'ItemController@ItemRackFormSave');
   Route::post('/Master/Item/form-mast-item-rack-update', 'ItemController@ItemRackFormUpdate');
   Route::post('/finance/delete-item_rack', 'ItemController@DeleteItemRack');

/* ------- end item Rack master ------- */

/* ------ start storage location ----------*/
  
  Route::get('/Master/Item/Add-Storage-location-Mast', 'ItemController@StorageLocation');
  Route::get('/Master/Item/View-Storage-location-Mast', 'ItemController@ViewStorageLocation');
  Route::get('/Master/Item/Edit-Storage-location-Mast/{id}', 'ItemController@EditStoLocation');

  Route::post('/Master/Item/Storage-location-Save', 'ItemController@SaveStorageLocation');
  Route::post('/Master/Item/Storage-location-Update', 'ItemController@UpdateStoLocation');
  Route::post('/Master/Item/Delete-Storage-location', 'ItemController@DeleteStoLocation');

/* ------ end storage location ----------*/

/* ------ start hsn master ------- */
  
  Route::get('/Master/Item-Tax/Hsn-Mast', 'ItemTaxController@Addhsn');
  Route::get('/Master/Item-Tax/View-Hsn-Mast', 'ItemTaxController@ViewHsn');
  Route::get('/Master/Item-Tax/Edit-Hsn-Mast/{id}', 'ItemTaxController@EditHsn');

  Route::post('/Master/Item-Tax/Hsn-Save', 'ItemTaxController@SaveHsn');
  Route::post('/Master/Item-Tax/Hsn-Update', 'ItemTaxController@UpdateHsn');
  Route::post('/Master/Item-Tax/Delete-Hsn', 'ItemTaxController@Deletehsn');

/* ------ end hsn master ------- */

/* ------- start hsn rate master ------- */

  Route::get('/Master/Item-Tax/Hsn-Rate-Mast', 'ItemTaxController@hsnRate');
  Route::get('/Master/Item-Tax/View-Hsn-Rate-Mast', 'ItemTaxController@ViewHsnRate');
  Route::get('/Master/Item-Tax/Edit-Hsn-Rate-Mast/{id}/{taxCd}', 'ItemTaxController@EditHsnRate');

  Route::post('/Master/Item-Tax/Hsn-Rate-Save', 'ItemTaxController@SaveHsnRate');
  Route::post('/Master/Item-Tax/Hsn-Rate-Update', 'ItemTaxController@UpdateHsnRate');
  Route::post('/Master/Item-Tax/Delete-Hsn-Rate', 'ItemTaxController@DeletehsnRate');

/* ------- end hsn rate master ------- */

/* ------- start zone master ------- */

  Route::get('/Master/Other/Zone-Mast', 'OtherController@AddZone');
  Route::get('/Master/Other/View-Zone-Mast', 'OtherController@ViewZone');
  Route::get('/Master/Other/Edit-Zone-Mast/{id}', 'OtherController@EditZone');

  Route::post('/Master/Other/Zone-Save', 'OtherController@ZoneSave');
  Route::post('/Master/Other/Delete-Zone', 'OtherController@DeleteZone');
  Route::post('/Master/Other/Zone-Update', 'OtherController@ZoneUpdate');

  Route::post('help-zonecode-getdata', 'OtherController@HelpZoneCodeGet');
  Route::post('search-zone-code-get', 'OtherController@search_ZoneCode');

/* ------- end zone master ------- */

/* ----- start department master -----*/

  Route::get('/Master/other/Department-Mast', 'OtherController@Department');
  Route::get('/Master/other/View-Department-Mast', 'OtherController@ViewDepartment');
  Route::get('/Master/other/Edit-Department-Mast/{id}', 'OtherController@EditDepartment');

  Route::post('/Master/other/Department-Save', 'OtherController@DepartmentSave');
  Route::post('/Master/other/Department-Update', 'OtherController@DepartmentUpdate');
  Route::post('/Master/other/Delete-Department', 'OtherController@DeleteDepartment');

  Route::post('help-deaprtment-code-getdata', 'OtherController@HelpDeaprtmentSearch');
  Route::post('search-deptcode-oninput', 'OtherController@search_DepartMentCode');

/* ----- end department master -----*/

/* ----------- start area master --------*/
  
  Route::get('/form-mast-destination', 'CAndFController@DestinationForm');
  Route::get('/view-mast-destination', 'CAndFController@DestinationView');
  Route::get('/edit-destination/{id}/{btnControl}', 'CAndFController@EditDestinationForm');

  Route::post('form-mast-destination-save', 'CAndFController@DestinationFormSave');
  Route::post('form-mast-destination-update', 'CAndFController@DestinationFormUpdate');
  Route::post('delete-destination', 'CAndFController@DeleteDestination');

  Route::post('search-area-code', 'CAndFController@search_AreaCode');
  Route::post('help-area-code-getdata', 'CAndFController@HelpAreaCodeSearch');

/* ----------- end area master --------*/

/* ----------- start depot master --------------- */
  
  Route::get('/form-mast-depot', 'CAndFController@DepotForm');
  Route::get('/view-mast-depot', 'CAndFController@DepotView');
  Route::get('/edit-depot/{id}', 'CAndFController@EditDepotForm');

  Route::post('form-mast-depot-save', 'CAndFController@DepotFormSave');
  Route::post('form-mast-depot-update', 'CAndFController@DepotFormUpdate');
  Route::post('delete-depot', 'CAndFController@DeleteDepot');

/* ----------- end depot master --------------- */

/*----------- start : fleet truck wheel form ----------*/

  Route::get('/form-fleet-truck-wheel', 'LogisticController@FleetTruckWheelForm');
  Route::get('/view-flet-truck-wheel', 'LogisticController@FleetTruckWhelView');
  Route::get('/edit-flet-truck-wheel/{id}/{btnControl}', 'LogisticController@EditFleetTruckWhel');

 Route::get('/logistic/edit-fleet-transaction/{id}', 'LogisticController@EditFleetForm');

  Route::post('fleet-truck-wheel-save', 'LogisticController@FleetTruckWhelSave');
  Route::post('fleet-truck-wheel-update', 'LogisticController@fletTrucWhelUpdate');
  Route::post('delete-fleet-truck-whel', 'LogisticController@DeleteFletTruckWhel');
 Route::post('/view-truck-wheel-chield-row-data', 'LogisticController@ViewChildTruckWheel');


/*----------- end : fleet truck wheel form ----------*/


/*----------- start : trip expense----------*/

  Route::get('/form-fleet-trip-expense', 'LogisticController@FleetTripExpenseForm');
  Route::get('/view-fleet-trip-expense', 'LogisticController@FleetTripExpenseView');
  Route::get('/edit-fleet-trip-expense/{id}', 'LogisticController@EditTripExpense');
 // Route::get('/logistic/edit-fleet-transaction/{id}', 'LogisticController@EditFleetForm');
  Route::post('fleet-trip-expense-save', 'LogisticController@FleetTripExpenseSave');
  Route::post('fleet-trip-expense-update', 'LogisticController@TripExpenseUpdate');
  Route::post('delete-trip-expense', 'LogisticController@DeleteTripExpense');

 //Route::post('/view-truck-wheel-chield-row-data', 'LogisticController@ViewChildTruckWheel');


/*----------- end : trip expense ----------*/

/* -------- start rate master ---------- */
  
  Route::get('/form-mast-freight-rate', 'LogisticController@FreightRateForm');
  Route::get('/view-mast-freight-rate', 'LogisticController@FreightRateView');
  Route::get('/edit-freight-rate/{id}', 'LogisticController@EditFreightRateForm');
   Route::post('view-mast-freight-rate-Chield-Row-Data', 'LogisticController@FreightrateChieldRTowData');

  Route::post('form-mast-rate-save','LogisticController@FreightRateFormSave');
  Route::post('form-mast-rate-update','LogisticController@FreightRateFormUpdate');
  Route::post('delete-rate', 'LogisticController@DeleteFreightRate');
  Route::post('help-route-code-getdata', 'LogisticController@HelpRouteCodeSearch');

/* -------- end rate master ---------- */

/* -------- lr-acknowledgement-penalty master -------- */


  Route::get('/logistic-transportation/master/lr-acknowledgement-penalty', 'LogisticController@LrAckPenalty');
  Route::get('/logistic-transportation/master/view-lr-acknowledgement-penalty', 'LogisticController@LrAckPenaltyView');
  Route::get('/logistic-transportation/master/edit-lr-acknowledgement-penalty/{id}', 'LogisticController@EditLrAckPenalty');
 
  Route::post('/logistic-transportation/master/save-lr-acknowledgement-penalty','LogisticController@LrAckPenaltySave');
  Route::post('/logistic-transportation/master/update-lr-acknowledgement-penalty','LogisticController@LrAckPenaltyUpdate');
  Route::post('/logistic-transportation/master/delete-lr-acknowledgement-penalty', 'LogisticController@DeleteLrAckPenalty');
  Route::post('/logistic-transportation/master/check-lr-acknowledgement-penalty-code', 'LogisticController@ChkLrAckPenaltyCode');

  
/* -------- end lr-acknowledgement-penalty ---------- */

/* -------- start CAM Master ---------- */
  Route::get('/logistic-transportation/master/add-freight-type', 'LogisticController@FreightTypeMaster');
  Route::post('/logistic-transportation/master/save-freight-type-master','LogisticController@FreightTypeSave');
  Route::get('/logistic-transportation/master/view-freight-type-master', 'LogisticController@FreightTypeView');
  Route::get('/logistic-transportation/master/edit-freight-type-master/{id}', 'LogisticController@EditFreightType');
  Route::post('/logistic-transportation/master/update-freight-type-master','LogisticController@FreightTypeUpdate');
  Route::post('/logistic-transportation/master/delete-freight-type-master', 'LogisticController@FreightTypeDelete');

/* -------- end CAM Master ---------- */

/* -------- start fleet master ------------*/

  Route::get('/form-mast-fleet', 'LogisticController@FleetForm');
  Route::get('/view-mast-fleet','LogisticController@FleetView');
  Route::get('/edit-fleet/{id}','LogisticController@EditFleetMaster');


  Route::post('/master-fleet-sync-all-vehicle', 'LogisticController@FleetListSyncAllVehcile');
  Route::post('form-mast-fleet-save', 'LogisticController@FleetFormSave');
  Route::post('form-mast-fleet-update', 'LogisticController@FleetFormUpdate');

/* -------- end fleet master ------------*/





/* -------- start lr expense master ------------*/

  Route::get('/lr-exp-mast', 'LogisticController@LrExpenseForm');

  Route::get('/view-lr-exp-mast','LogisticController@LrExpenseView');

  Route::get('/edit-lr-exp-mast/{id}','LogisticController@EditLrExpenseMaster');

  Route::post('lr-exp-save', 'LogisticController@LRExpFormSave');
  
  Route::post('lr-exp-update', 'LogisticController@LrExpenseFormUpdate');



/* -------- end lr expense master ------------*/

/* -------- start fleet expense master ------------*/

  Route::get('/fleet-exp-mast', 'LogisticController@FleetExpenseForm');

  Route::get('/view-fleet-exp-mast','LogisticController@FleetExpenseView');

  Route::get('/edit-fleet-exp-mast/{id}','LogisticController@EditFleetExpenseMaster');

  Route::post('fleet-exp-save', 'LogisticController@FleetExpenseFormSave');
  
  Route::post('fleet-exp--update', 'LogisticController@FleetExpenseFormUpdate');

/* -------- end fleet expense master ------------*/

/* ---------- start vehical manufacturing master ----------*/
  
  Route::get('/form-mast-manufacturing', 'LogisticController@MastManufacturingForm');
  Route::get('/view-manufature', 'LogisticController@manufatureView');
  Route::get('/edit-manufature/{id}/{btnControl}', 'LogisticController@EditManufactur');

  Route::post('manufacture-save', 'LogisticController@ManufaturSave');
  Route::post('delete-manufature', 'LogisticController@Deletemanufature');
  Route::post('manufature-update', 'LogisticController@ManufacturUpdate');

/* ---------- end vehical manufacturing master ----------*/

/* ---------- start vehical manufacturing master ----------*/
  
  Route::get('/diesel-rate-mast', 'LogisticController@DiselRateForm');
  Route::get('/view-diesel-rate-mast', 'LogisticController@DiselRateView');
  Route::get('/edit-diesel-rate-mast/{id}', 'LogisticController@EditDiselRateMaster');

  Route::post('diesel-rate-save', 'LogisticController@DiselRateSave');
  Route::post('delete-diesel-rate', 'LogisticController@DeleteDiselRate');
  Route::post('diesel-rate-update', 'LogisticController@DiselRateUpdate');

/* ---------- end vehical manufacturing master ----------*/

/* ------- start maintainance Transaction--------- */

  Route::get('/Transaction/Maintainance/Job-Crad-Trans', 'MaintenanceController@AddJobCardTrans');
  
  Route::get('/Transaction/Maintainance/View-Job-Crad-Trans', 'MaintenanceController@ViewJobCardTrans');

  Route::get('/Transaction/Maintenance/Edit-Equipment-Job-Crad-Trans/{id}', 'MaintenanceController@EditJobCardTrans');

  Route::post('/Transaction/Maintenance/Equipment-Job-Crad-Trans-Save', 'MaintenanceController@SaveJobCardTrans');

  Route::post('/Transaction/Maintenance/Equipment-Job-Crad-Trans-Update', 'MaintenanceController@UpdateJobCardTrans');

  Route::post('/Transaction/Maintenance/Delete-Job-Crad-Trans-Equipment', 'MaintenanceController@DeleteJobCardTrans');

  Route::post('/view-job-card-chield-row-data', 'MaintenanceController@ViewChildJobCardTrans');

   Route::post('/get-item-data-jobcard', 'MaintenanceController@Get_Item_Data_Jobcard');

   Route::get('/Transaction/view-job-card-msg/{savedata}', 'MaintenanceController@job_card_msg');


   Route::post('/Transaction/Maintenance/Update-Jobcard-Closing-Dt', 'MaintenanceController@UpdateJobCardClosingDt');


/* ------- end maintainance Transaction--------- */

/* ------- start maintainance --------- */

  Route::get('/Master/Maintenance/Equipment-Mast', 'MaintenanceController@EquipmentMast');
  Route::get('/Master/Maintenance/View-Equipment-Mast', 'MaintenanceController@ViewEquipmentMast');
  Route::get('/Master/Maintenance/Edit-Equipment-Mast/{id}', 'MaintenanceController@EditEquipmentMast');

  Route::post('/Master/Maintenance/Equipment-Save', 'MaintenanceController@SaveEquipmentMast');
  Route::post('/Master/Maintenance/Equipment-Update', 'MaintenanceController@UpdateEquipmentMast');
  Route::post('/Master/Maintenance/Delete-Equipment', 'MaintenanceController@DeleteEquipmentMast');

  Route::post('help-Equipmentgroup-getdata', 'MaintenanceController@HelpEquipmentCodeGet');
  Route::post('search-Equipmentgroup-code-get', 'MaintenanceController@search_EquipmentCode');

/* ------- end maintainance  --------- */

/* ------- start maintainance group --------- */

  Route::get('/Master/Maintenance/Equipment-Group-Mast', 'MaintenanceController@EquipmentGroup');
  Route::get('/Master/Maintenance/View-Equipment-Group-Mast', 'MaintenanceController@ViewEquipmentGroup');
  Route::get('/Master/Maintenance/Edit-Equipment-Group-Mast/{id}', 'MaintenanceController@EditEquipmentGroup');

  Route::post('/Master/Maintenance/Equipment-Group-Save', 'MaintenanceController@SaveEquipmentGroup');
  Route::post('/Master/Maintenance/Equipment-Group-Update', 'MaintenanceController@UpdateEquipmentGroup');
  Route::post('/Master/Maintenance/Delete-Equipment-Group', 'MaintenanceController@DeleteEquipmentgroup');

  Route::post('help-Equipmentgroup-getdata', 'MaintenanceController@HelpEquipmentGroupCodeGet');
  Route::post('search-Equipmentgroup-code-get', 'MaintenanceController@search_EquipmentGroupCode');

/* ------- end maintainance group --------- */

/* ------- start maintainance group --------- */

  Route::get('/Master/Maintenance/Equipment-Category-Mast', 'MaintenanceController@EquipmentCategory');
  Route::get('/Master/Maintenance/View-Equipment-Category-Mast', 'MaintenanceController@ViewEquipmentCategory');
  Route::get('/Master/Maintenance/Edit-Equipment-Category-Mast/{id}', 'MaintenanceController@EditEquipmentCategory');

  Route::post('/Master/Maintenance/Equipment-Category-Save', 'MaintenanceController@SaveEquipmentCategory');
  Route::post('/Master/Maintenance/Equipment-Category-Update', 'MaintenanceController@UpdateEquipmentCategory');
  Route::post('/Master/Maintenance/Delete-Equipment-Category', 'MaintenanceController@DeleteEquipmentcat');

/* ------- end maintainance group --------- */

/* ------- start maintainance Class --------- */

  Route::get('/Master/Maintenance/Equipment-Class-Mast', 'MaintenanceController@EquipmentClass');
  Route::get('/Master/Maintenance/View-Equipment-Class-Mast', 'MaintenanceController@ViewEquipmentClass');
  Route::get('/Master/Maintenance/Edit-Equipment-Class-Mast/{id}', 'MaintenanceController@EditEquipmentClass');
  Route::post('/Master/Maintenance/Equipment-Class-Save', 'MaintenanceController@SaveEquipmentClass');
  Route::post('/Master/Maintenance/Equipment-Class-Update', 'MaintenanceController@UpdateEquipmentClass');

  Route::post('/Master/Maintenance/Delete-Equipment-Class', 'MaintenanceController@DeleteEquipmentClass');

/* ------- end maintainance Class --------- */


/* ------- start maintainance Type --------- */

  Route::get('/Master/Maintenance/Equipment-Type-Mast', 'MaintenanceController@EquipmentType');
  Route::get('/Master/Maintenance/View-Equipment-Type-Mast', 'MaintenanceController@ViewEquipmentType');
  Route::get('/Master/Maintenance/Edit-Equipment-Type-Mast/{id}', 'MaintenanceController@EditEquipmentType');
  Route::post('/Master/Maintenance/Equipment-Type-Save', 'MaintenanceController@SaveEquipmentType');

  Route::post('/Master/Maintenance/Equipment-Type-Update', 'MaintenanceController@UpdateEquipmentType');
  
  Route::post('/Master/Maintenance/Delete-Equipment-Type', 'MaintenanceController@DeleteEquipmentType');

/* ------- end maintainance Type --------- */

/* ------- start maintainance Location --------- */

  Route::get('/Master/Maintenance/Equipment-Location-Mast', 'MaintenanceController@EquipmentLocation');

  Route::get('/Master/Maintenance/View-Equipment-Location-Mast', 'MaintenanceController@ViewEquipmentLocation');

  Route::get('/Master/Maintenance/Edit-Equipment-Location-Mast/{id}', 'MaintenanceController@EditEquipmentLocation');

  Route::post('/Master/Maintenance/Equipment-Location-Save', 'MaintenanceController@SaveEquipmentLocation');
  Route::post('/Master/Maintenance/Equipment-Location-Update', 'MaintenanceController@UpdateEquipmentLocation');
  
  Route::post('/Master/Maintenance/Delete-Equipment-Location', 'MaintenanceController@DeleteEquipmentLocation');

/* ------- end maintainance Location --------- */


/* ------- start maintainance activity --------- */

  Route::get('/Master/Maintenance/Equipment-Activity-Mast', 'MaintenanceController@EquipmentActivity');

  Route::get('/Master/Maintenance/View-Equipment-Activity-Mast', 'MaintenanceController@ViewEquipmentActivity');

  Route::get('/Master/Maintenance/Edit-Equipment-Activity-Mast/{id}', 'MaintenanceController@EditEquipmentActivity');

  Route::post('/Master/Maintenance/Equipment-Activity-Save', 'MaintenanceController@SaveEquipmentActivity');
  Route::post('/Master/Maintenance/Equipment-Activity-Update', 'MaintenanceController@UpdateEquipmentActivity');
  
  Route::post('/Master/Maintenance/Delete-Equipment-Activity', 'MaintenanceController@DeleteEquipmentActivity');

/* ------- end maintainance activity --------- */

 

  Route::get('/Transaction/ColdStorage/Edit-Equipment-Job-Crad-Trans/{id}', 'StorageController@EditBiltyTrans');

  

  Route::post('/Transaction/ColdStorage/Equipment-Job-Crad-Trans-Update', 'StorageController@UpdateBiltyTrans');

  Route::post('/Transaction/ColdStorage/Delete-Job-Crad-Trans-Equipment', 'StorageController@DeleteBiltyTrans');

  Route::post('/view-bilty-chield-row-data', 'StorageController@ViewChildBiltyTrans');

  

  

   

   Route::post('/get-bilty-data-by-acc-code', 'StorageController@Get_Bilty_Data_Item');

   Route::get('/Transaction/view-job-card-msg/{savedata}', 'StorageController@job_card_msg');



   Route::post('/Transaction/ColdStorage/Update-Jobcard-Closing-Dt', 'StorageController@UpdateJobCardClosingDt');

/* ------- start outward  --------- */

   
  
  

  Route::get('/Transaction/ColdStorage/Edit-Outward-trans/{id}', 'StorageController@EditOutwardTrans');

  Route::post('/Transaction/ColdStorage/Outward-Trans-Save', 'StorageController@SaveOutwardTrans');

  Route::post('/Transaction/ColdStorage/Outward-trans-Update', 'StorageController@UpdateOutwardTrans');

  Route::post('/Transaction/ColdStorage/Delete-Outward-trans', 'StorageController@DeleteOutwardTrans');


  /* ------- end  outward --------- */

/* ______________ START COLD STORAGE TRANSACTION ______________ */

  /* ---------- START GATE INWARD -----------*/

    Route::get('/transaction/ColdStorage/add-gate-inward-transaction', 'ColdStorageTransController@AddGateInward');
    Route::get('/transaction/ColdStorage/View-gate-inward-transaction', 'ColdStorageTransController@ViewGateInward');
    Route::get('/transaction/ColdStorage/Edit-gate-inward-transaction/{cmpCd}/{fyCd}/{tranCd}/{seriesCd}/{vrno}', 'ColdStorageTransController@EditGateInward');

    Route::post('/transaction/ColdStorage/Save-gate-inward-transaction', 'ColdStorageTransController@SaveGateInward');
    Route::post('/transaction/ColdStorage/Update-gate-inward-transaction', 'ColdStorageTransController@UpdateGateInward');
    Route::post('/Master/ColdStorage/Delete-Vehicle-entry', 'ColdStorageTransController@DeleteVehicleEntry');

  /* ---------- END GATE INWARD -----------*/

    /* ---------- START GATE OUTWARD -----------*/

    Route::get('/transaction/ColdStorage/add-gate-outward-transaction', 'ColdStorageTransController@AddGateOutward');
    Route::get('/transaction/ColdStorage/View-gate-outward-transaction', 'ColdStorageTransController@ViewGateOutward');
    Route::get('/transaction/ColdStorage/Edit-gate-Outward-transaction/{id}', 'ColdStorageTransController@EditGateOutward');

    Route::post('/transaction/ColdStorage/Save-gate-Outward-transaction', 'ColdStorageTransController@SaveGateOutward');
    Route::post('/transaction/ColdStorage/Update-gate-Outward-transaction', 'ColdStorageTransController@UpdateGateOutward');
    Route::post('/transaction/ColdStorage/Delete-gete-outward-transaction', 'ColdStorageTransController@DeleteGateOutward');

  /* ---------- END GATE OUTWARD -----------*/

  /* ------- START INWARD ENTRY --------- */

    Route::get('/transaction/ColdStorage/add-inward-entry-transaction', 'ColdStorageTransController@InwardEntryCS');
    Route::get('/transaction/ColdStorage/View-inward-entry-transaction', 'ColdStorageTransController@ViewInwardEntryCS');

    Route::get('/Master/ColdStorage/Edit-Inward-slip-Mast/{id}', 'ColdStorageTransController@EditInwardEntryCS');

    Route::post('/transaction/ColdStorage/save-inward-entry-transaction', 'ColdStorageTransController@SaveInwardEntryCS');

    Route::post('/Master/ColdStorage/Inward-slip-Update', 'ColdStorageTransController@UpdateInwardEntryCS');
    Route::post('/Master/ColdStorage/Delete-Inward-slip', 'ColdStorageTransController@DeleteInwardEntryCS');

    Route::post('get-vehicle-entry-details', 'ColdStorageTransController@getVehicleEntryDetails');

  /* ------- END INWARD ENTRY  --------- */

  /*------------ START INWARD STORAGE ----------------- */

  Route::get('/transaction/ColdStorage/add-inward-storage-transaction', 'ColdStorageTransController@AddInwardStorageCS');

  Route::post('/transaction/ColdStorage/Save-inward-storage-transaction', 'ColdStorageTransController@SaveInwardStorageCS');

  Route::get('/transaction/ColdStorage/view-inward-storage-transaction','ColdStorageTransController@ViewInwardStorageCS');

  Route::get('/transaction/ColdStorage/View-inward-storage-tran-msg/{savedata}', 'ColdStorageTransController@inward_storage_msgCS');

/*------------ END INWARD STORAGE ----------------- */

/* ______________ END COLD STORAGE TRANSACTION ______________ */

/* ------- start cold storage item packing --------- */

  Route::get('/Master/ColdStorage/Item-Packing-Mast', 'StorageController@ItemPackingMastt');

  Route::get('/Master/ColdStorage/View-Item-Packing-Mast', 'StorageController@ViewItemPackingMast');

  Route::get('/Master/ColdStorage/Edit-item-packing-Mast/{id}/{itemId}', 'StorageController@EditItemPackingMast');

  Route::post('/Master/ColdStorage/item-packing-Save', 'StorageController@SaveItemPacking');
  Route::post('/Master/ColdStorage/item-packing-Update', 'StorageController@UpdateItemPacking');
  Route::post('/Master/ColdStorage/Delete-item-packing', 'StorageController@DeleteItemPacking');

/* ------- end cold storage item packing  --------- */




/* ------- starty bilty tran  --------- */

  Route::get('/Transaction/ColdStorage/Bilty-Mast', 'ColdStorageTransController@AddBiltyTrans');
  Route::get('/Transaction/ColdStorage/View-Bilty-Mast', 'ColdStorageTransController@ViewBiltyTrans');
  Route::get('/Transaction/view-bilty-msg/{savedata}', 'ColdStorageTransController@bilty_msg');

  Route::post('/Transaction/ColdStorage/Bilty-Trans-Save', 'ColdStorageTransController@SaveBiltyTrans');

/* ------- end bilty tran  --------- */

/* ------- start outward transaction cs  --------- */

  Route::get('/Transaction/ColdStorage/Outward-trans', 'ColdStorageTransController@AddOutwardTrans');
  Route::get('/Transaction/ColdStorage/view-Outward-msg/{savedata}', 'ColdStorageTransController@outwardCs_Savemsg');
  Route::get('/Transaction/ColdStorage/View-Outward-trans', 'ColdStorageTransController@ViewOutwardTrans');

  Route::post('/transaction/ColdStorage/data-of-bilty-no', 'ColdStorageTransController@GetDataAgainstBilty');

  Route::post('/Transaction/ColdStorage/Save-Outward-trans', 'ColdStorageTransController@SaveOutwardTransCS');
   Route::post('/view-outward-chield-row-data', 'ColdStorageTransController@ViewChildOutwardTrans');
  
/* ------- end  outward transaction cs  --------- */

/* ------- start  generate bill transaction cs  --------- */

  Route::get('/Transaction/ColdStorage/add-bill-trans', 'ColdStorageTransController@AddGenerateBillTrans');
  Route::get('/Transaction/ColdStorage/save-generate-bill-msg/{savedata}', 'ColdStorageTransController@Generatebill_msg');
  Route::get('/Transaction/ColdStorage/view-bill-trans', 'ColdStorageTransController@ViewGenerateBill');

  Route::post('/Transaction/ColdStorage/Save-generate-bill', 'ColdStorageTransController@SaveBillGenerateCS');
  
  Route::post('/Transction/ColdStorage/get-simulation-data-for-cs-bil', 'ColdStorageTransController@simulationForBillCs');


/* ------- end  genearate bill transaction cs  --------- */

/* ------- start bilty transfer transaction cs  --------- */
  
  Route::get('/Transaction/ColdStorage/add-bilty-transfer-tran', 'ColdStorageTransController@AddBiltyTransferTran');

/* ------- end  bilty transfer transaction cs  --------- */

/* ------- start outward gate Pass --------- */

  Route::get('/Master/ColdStorage/Outward-Gate-Pass-Mast', 'StorageController@OutwardGatePassMast');

  Route::get('/Master/ColdStorage/View-Outward-Gate-Pass-Mast', 'StorageController@ViewOutwardGatePassMast');

  Route::get('/Master/ColdStorage/Edit-Outward-Gate-Pass-Mast/{id}', 'StorageController@EditOutwardGatePassMast');

  Route::post('/Master/ColdStorage/Outward-Gate-Pass-Save', 'StorageController@SaveOutwardGatePass');
  Route::post('/Master/ColdStorage/Outward-Gate-Pass-Update', 'StorageController@UpdateOutwardGatePass');
  Route::post('/Master/ColdStorage/Delete-Outward-Gate-Pass', 'StorageController@DeleteOutwardGatePass');

/* ------- end outward gate Pass  --------- */


/* ------- start cold storage --------- */

  Route::get('/Master/ColdStorage/Cold-storage-Mast', 'StorageController@ColdStorageMast');

  Route::get('/Master/ColdStorage/View-Cold-storage-Mast', 'StorageController@ViewColdStorageMast');

  Route::get('/Master/ColdStorage/Edit-Cold-storage-Mast/{compCD}/{plantCD}/{csCD}', 'StorageController@EditColdStorageMast');

  Route::post('/Master/ColdStorage/Cold-storage-Save', 'StorageController@SaveColdStorage');

  Route::post('/Master/ColdStorage/Cold-storage-Update', 'StorageController@UpdateColdStorage');
  
  Route::post('/Master/ColdStorage/Delete-Cold-storage', 'StorageController@DeleteColdStorage');

/* ------- end cold storage  --------- */



/* ------- start Chamber  Master--------- */

  Route::get('/Master/ColdStorage/Add-Chamber-Mast', 'StorageController@ChamberMast');

  Route::get('/Master/ColdStorage/View-Chamber-Mast', 'StorageController@ViewChamberMast');

  Route::get('/Master/ColdStorage/Edit-Chamber-Mast/{compCd}/{csCd}/{chamberCd}', 'StorageController@EditChamberMast');

  Route::post('/Master/ColdStorage/Chamber-Save', 'StorageController@SaveChamber');

  Route::post('/Master/ColdStorage/Chamber-Update', 'StorageController@UpdateChamber');
  
  Route::post('/Master/ColdStorage/Delete-Chamber', 'StorageController@DeleteChamber');

/* ------- end Chamber Master  --------- */

/* ------- start Seasonal --------- */

  Route::get('/Master/ColdStorage/Add-Seasonal-Mast', 'StorageController@SeasonalMast');

  Route::get('/Master/ColdStorage/View-Seasonal-Mast', 'StorageController@ViewSeasonalMast');

  Route::get('/Master/ColdStorage/Edit-Seasonal-Mast/{id}', 'StorageController@EditSeasonalMast');

  Route::post('/Master/ColdStorage/Seasonal-Save', 'StorageController@SaveSeasonalMast');

  Route::post('/Master/ColdStorage/Seasonal-Update', 'StorageController@UpdateSeasonal');
  
  Route::post('/Master/ColdStorage/Delete-Seasonal', 'StorageController@DeleteSeasonal');
  

/* ------- end Seasonal  --------- */

/*------------ start account item rate master ----------------- */
  
  Route::get('/Master/ColdStorage/Add-Acc-Item-Rate-Mast', 'StorageController@AddAccItemRate');
  Route::get('/Master/ColdStorage/View-Acc-Item-Rate-Mast', 'StorageController@ViewAccItemRate');
  Route::get('/Master/ColdStorage/Edit-Acc-Item-Rate-Mast/{compCd}/{accCd}', 'StorageController@EditAccItemRate');

  Route::post('/Master/ColdStorage/Update-Account-Item-Rate', 'StorageController@UpdateAccItemRate');
  Route::post('/Master/ColdStorage/Save-Account-Item-Rate', 'StorageController@SaveAccItemRate');
  Route::post('/Master/ColdStorage/Delete-Account-Item-Rate', 'StorageController@DeleteAccItemRate');

/*------------ end account item rate master ----------------- */



/*------------ start cs balence master ----------------- */
  
  Route::get('/Master/ColdStorage/Add-cs-balence-Mast', 'StorageController@AddCSBalence');

/*------------ end cs balence master ----------------- */

/* ------- start block master storage --------- */

  Route::get('/Master/ColdStorage/Block-storage-Mast', 'StorageController@BlockStorageMast');

  Route::get('/Master/ColdStorage/View-Block-storage-Mast', 'StorageController@ViewBlockStorageMast');

  Route::get('/Master/ColdStorage/Edit-Block-storage-Mast/{compCd}/{csCode}/{chamberCode}/{floorCode}/{blockCode}', 'StorageController@EditBlockStorageMast');

  Route::post('/Master/ColdStorage/Block-storage-Save', 'StorageController@SaveBlockStorage');
  Route::post('/Master/ColdStorage/Block-storage-Update', 'StorageController@UpdateBlockStorage');
  Route::post('/Master/ColdStorage/Delete-Block-storage', 'StorageController@DeleteBlockStorage');

/* ------- end block master storage  --------- */

/* ------- start floor master storage --------- */

  Route::get('/Master/ColdStorage/Floor-storage-Mast', 'StorageController@FloorStorageMast');

  Route::get('/Master/ColdStorage/View-Floor-storage-Mast', 'StorageController@ViewFloorStorageMast');

  Route::get('/Master/ColdStorage/Edit-Floor-storage-Mast/{compCd}/{csCd}/{chamberCd}/{floorCd}', 'StorageController@EditFloorStorageMast');

  Route::post('/Master/ColdStorage/Floor-storage-Save', 'StorageController@SaveFloorStorage');
  Route::post('/Master/ColdStorage/Floor-storage-Update', 'StorageController@UpdateFloorStorage');
  Route::post('/Master/ColdStorage/Delete-Floor-storage', 'StorageController@DeleteFloorStorage');

/* ------- end floor master storage  --------- */


/* ------- start floor master storage --------- */

  Route::get('/Master/ColdStorage/Bing-storage-Mast', 'StorageController@BingStorageMast');

  Route::get('/Master/ColdStorage/View-Bing-storage-Mast', 'StorageController@ViewBingStorageMast');

  Route::get('/Master/ColdStorage/Edit-Bing-storage-Mast/{compcd}/{cscd}/{chambercd}/{floorcd}/{blockcd}/{beancd}', 'StorageController@EditBingStorageMast');

  Route::post('/Master/ColdStorage/Bing-storage-Save', 'StorageController@SaveBingStorage');

  Route::post('/Master/ColdStorage/Bing-storage-Update', 'StorageController@UpdateBingStorage');
  
  Route::post('/Master/ColdStorage/Delete-Bing-storage', 'StorageController@DeleteBingStorage');

/* ------- end floor master storage  --------- */

/* ------------ cold storage ajax ------------- */
  
  Route::post('/cold-storage/get-prev-storage-data', 'StorageController@GetPrevStorageData');
  Route::post('/get-inward-data-by-acc-code', 'ColdStorageTransController@Get_Inward_Data_Item');
  Route::post('/get-item-packing-against-item', 'StorageController@GetItemPackingAgainstItem');
  Route::post('/cold-storage/get-rate-per-month/by-storage-charge', 'ColdStorageTransController@GetRatePerMonthByStorageCharge');

/* ------------ cold storage ajax ------------- */

/* --------- start fleet transaction -------------*/
  
  Route::get('/logistic/fleet-transaction', 'FinanaceLogisticController@FleetTrnas');

  Route::get('/logistic/view-fleet-transaction', 'FinanaceLogisticController@ViewFleetTrans');

  //Route::post('form-fleet-trans-save', 'FinanaceLogisticController@FleetTransSave');


  Route::post('/Transaction/Logistic/Save-Trip-Expense', 'FinanaceLogisticController@FleetTransSave');


   Route::get('/Transaction/View-Trip-Expense-msg/{savedata}', 'FinanaceLogisticController@trip_expense_msg');


  Route::post('form-fleet-trans-update', 'FinanaceLogisticController@FleetTransUpdate');

  Route::post('/view-fleet-trans-chield-row-data', 'FinanaceLogisticController@ViewChildFleetTrans');

  Route::post('/fleet_rate', 'FinanaceLogisticController@FleetRate');

  Route::post('get-vehicle-routes-details', 'FinanaceLogisticController@VehicleRoutesDetails');

  Route::post('get-vehicle-routes-details-by-vehicle-type
', 'FinanaceLogisticController@VehicleRoutebyVehicleType');

  Route::post('get-vehicle-expense-data-by-km
', 'FinanaceLogisticController@ExpenseDataByKm');

  Route::post('get-vehicle-expense-data-suppl
', 'FinanaceLogisticController@ExpenseDataBySuppl');

  Route::post('get-vehicle-routes-delivery-charge', 'FinanaceLogisticController@VehicleRoutesDeliveryChg');

   Route::post('get-toplace-from-route', 'FinanaceLogisticController@GetrouteToPlace');

  Route::post('get-Indicator-details', 'FinanaceLogisticController@IndicatorDetails');



/* --------- end fleet transaction -------------*/

// EXCEL CONFIGURATION

Route::get('/Master/Setting/Excel-Configuration', 'SettingController@ExcelConfiguration');

Route::get('/Master/Setting/View-Excel-Configuration', 'SettingController@ExcelConfigView');

Route::get('/Master/Setting/Edit-Excel-Configuration/{id}/{exlCode}','SettingController@EditExcelConfig');

Route::post('form-excel-configuration-save','SettingController@ExcelConfigSave');

Route::post('form-excel-configuration-update','SettingController@ExcelConfigUpdate');

Route::post('/delete-excel-configuration','SettingController@ExcelConfigDelete');

Route::post('/view-excel-config-child-row-data', 'SettingController@ViewExcelConfigChild');

Route::get('/Master/Setting/View-Excel-Configuration/success-message/{getName}', 'SettingController@SuccessMessage');

// END EXCEL CONFIGURATION


/* --------- start suplimentry  trip transaction -------------*/
  
  Route::get('/logistic/suplimentry-trip-trans', 'FinanaceLogisticController@SupplimentryTrnas');

  Route::get('/logistic/view-suplimentry-trip-trans', 'FinanaceLogisticController@ViewSupplimentryTrans');

  Route::post('/Transaction/Logistic/Save-suplimentry-trip-save', 'FinanaceLogisticController@SupplimentryTransSave');

  Route::post('suplimentry-trip-trans-update', 'FinanaceLogisticController@SupplimentryTransUpdate');

  Route::post('get-old-trip-entry-details', 'FinanaceLogisticController@OldTripEntryDetails');

  Route::post('/view-suplimentry-trip-trans-chield-row-data', 'FinanaceLogisticController@ViewChildSupplimentry');

 // Route::post('/fleet_rate', 'LogisticController@FleetRate');



/* --------- end suplimentry trip transaction -------------*/


/* ----------- start fleet certificate form ----------- */
  
  Route::get('/logistic/fleet-certificate-transaction-form', 'LogisticController@FleetCertTransForm');
  Route::get('/logistic/view-fleet-certificate-transaction', 'LogisticController@ViewFleetCertTrans');

  Route::post('form-fleet-certificate-save', 'LogisticController@FleetCertTransFormSave');
  Route::post('/logistic/get-certificate-data', 'LogisticController@FleetCertTransData');

  Route::post('/view-fleet-cert-chield-row-data', 'LogisticController@ViewChildFleetCert');

  Route::get('/logistic/fleet-certificate-tran/success-message/{getName}', 'LogisticController@SuccessMessage');

   Route::post('/logistic/fleet-certi-vehical-info', 'LogisticController@FleetCertVehicalInfo');

/* ----------- end fleet certificate form ----------- */

/* -------- start fleet challan receipt ------------- */
  
  Route::get('/logistic/fleet-challan-receipt', 'LogisticController@SubmitPartyBilReport');
  Route::get('/logistic/edit-fleet-challan-receipt/{id}/{trdate}', 'LogisticController@EditChallanReceipt');

  Route::post('save-party-bil', 'LogisticController@SaveInPartyBill');

/* -------- end fleet challan receipt ------------- */

/* --------- start trpt bill generate ----------- */

  Route::get('/logistic/trpt-bill-generate', 'LogisticController@PartyBillReport');

  Route::get('/logistic/transport-bill-posting', 'FinanaceLogisticController@TransporterPartyBill');

   Route::get('/logistic/transaction/transporter-bill-posting', 'FinanaceLogisticController@TransporterBillPosting');

   Route::get('/Transaction/View-lr-acknowledgment-trans-msg/{savedata}', 'FinanaceLogisticController@lr_acknowledgment_msg');
   
   Route::get('/Transaction/View-lr-bill-posting-msg/{savedata}', 'FinanaceLogisticController@ViewTransporterBillPostingMsg');

   Route::get('/logistic/transaction/view-transporter-bill-posting', 'FinanaceLogisticController@ViewTransporterBillPosting');

   Route::post('pdf-donwload-when-view-transporter-bill-posting', 'FinanaceLogisticController@GeneratePdfForTransportBill');


    Route::post('/Transction/TransporterBill/get-simulation-data-for-trans-bil', 'FinanaceLogisticController@simulationForBillTransporter');

  /* Route::post('pdf-donwload-when-view-transporter-bill-posting', 'LogisticController@GeneratePdfForTransportBill');*/

   Route::post('/view-bill-posting-chield-row-data', 'LogisticController@ViewChildTransporterPost');
  
/* --------- end trpt bill generate ----------- */

/* ------------ start task master -------------- */
  
  Route::get('/form-mast-task', 'LogisticController@TaskForm');
  Route::get('/view-mast-task', 'LogisticController@TaskView');
  Route::get('/edit-mast-task/{id}', 'LogisticController@EditTaskMast');

  Route::post('form-mast-task-save','LogisticController@SaveTaskForm');
  Route::post('form-mast-task-update','LogisticController@TaskMastUpdate');
  Route::post('delete-task', 'LogisticController@DeleteTask');

/* ------------ end task master -------------- */

/* ------ start attendance transaction -------- */

  Route::get('/Transaction/Attendance/add-emp-attendance-trans', 'HrmTransactionController@EmpAttendance');

  Route::post('/Transaction/Attendance/CheckEmpAttend', 'HrmTransactionController@CheckEmpAttend');
  
  Route::post('/Transaction/Attendance/CheckLeaveApplication', 'HrmTransactionController@CheckLeaveApplication');

  Route::post('/Transaction/Attendance/Check-PayMonth', 'HrmTransactionController@CheckPayCalender');

  Route::get('/Transaction/Attendance/view-emp-attendance-transaction', 'HrmTransactionController@ViewEmpAttendance');
  
  Route::get('/Transaction/Attendance/edit-emp-attendance/{id}', 'HrmTransactionController@EditEmpAttendance');

  Route::post('/Transaction/Attendance/emp-attendance-save', 'HrmTransactionController@SaveEmpAttendance');

  Route::post('/Transaction/Attendance/delete-emp-attendance', 'HrmTransactionController@DeleteAttendance');

  Route::post('/Transaction/Attendance/form-emp-attendance-update', 'HrmTransactionController@EmpAttendanceUpdate');

  Route::get('/Transaction/PaymentAdvice/add-emp-payment-advice-trans', 'HrmTransactionController@EmpPaymentAdvice');

  Route::get('/Transaction/PaymentAdvice/view-emp-payment-advice-transaction', 'HrmTransactionController@ViewEmpPaymentAdvice');

  Route::post('/Transaction/PaymentAdvice/delete-emp-payment-advice', 'HrmTransactionController@DeletePaymentAdvice');

  Route::get('/Transaction/PaymentAdvice/edit-emp-payment-advice/{id}', 'HrmTransactionController@EditEmpPaymentAdvice');

  /*---Start Job Opening Trans----*/

   Route::get('/Transaction/JobOpening/add-job-opening-trans', 'HrmTransactionController@JobOpening');

   Route::get('/Transaction/JobOpening/view-job-opening-trans', 'HrmTransactionController@ViewJobOpening');

   Route::get('/Transaction/JobOpening/edit-job-opening/{id}', 'HrmTransactionController@EditJobOpening');

  Route::post('/Transaction/JobOpening/save-job-opening', 'HrmTransactionController@SaveJobOpening');

  Route::post('/Transaction/JobOpening/delete-job-opening', 'HrmTransactionController@DeleteJobOpening');

  Route::post('/Transaction/JobOpening/form-job-opening-update', 'HrmTransactionController@UpdateJobOpening');


   /*---End Job Opening Trans----*/

/*---Start Job Application Trans---*/

 Route::get('/Transaction/JobApplication/add-job-application-trans', 'HrmTransactionController@JobApplication');

   Route::get('/Transaction/JobApplication/view-job-application-trans', 'HrmTransactionController@ViewJobApplication');

   Route::get('/Transaction/JobApplication/edit-job-application/{id}', 'HrmTransactionController@EditJobApplication');

  Route::post('/Transaction/JobApplication/save-job-application', 'HrmTransactionController@SaveJobApplication');

  Route::post('/Transaction/JobApplication/delete-job-application', 'HrmTransactionController@DeleteJobApplication');

  Route::post('/Transaction/JobApplication/form-job-application-update', 'HrmTransactionController@UpdateJobApplication');

  Route::post('/Transaction/JobApplication/PositionName', 'HrmTransactionController@FindJobPosition');

  Route::post('/Transaction/JobApplication/EmpInformation', 'HrmTransactionController@EmpInfo');
  
  Route::post('/Transaction/JobApplication/TravelInformation', 'HrmTransactionController@TravelInformation');

/*----End Job Application Trans----*/


/*--Start Emp Interview Trans---*/

  Route::get('/Transaction/EmpInterview/add-emp-interview-trans', 'HrmTransactionController@EmpInterview');

  Route::get('/Transaction/EmpInterview/view-emp-interview-trans', 'HrmTransactionController@ViewEmpInterview');

  Route::get('/Transaction/EmpInterview/edit-emp-interview/{id}', 'HrmTransactionController@EditEmpInterview');

  Route::post('/Transaction/EmpInterview/save-emp-interview', 'HrmTransactionController@SaveEmpInterview');

  Route::post('/Transaction/EmpInterview/delete-emp-interview', 'HrmTransactionController@DeleteEmpInterview');

  Route::post('/Transaction/EmpInterview/form-emp-interview-update', 'HrmTransactionController@UpdateEmpInterview');

  

/*---End Emp Interview Trans----*/

/*--Start Score Card Trans---*/

  Route::get('/Transaction/ScoreCard/add-score-card-trans', 'HrmTransactionController@ScoreCard');

  Route::get('/Transaction/ScoreCard/view-score-card-trans', 'HrmTransactionController@ViewScoreCard');

  Route::get('/Transaction/ScoreCard/edit-score-card/{id}', 'HrmTransactionController@EditScoreCard');

  Route::post('/Transaction/ScoreCard/save-score-card', 'HrmTransactionController@SaveScoreCard');

  Route::post('/Transaction/ScoreCard/delete-score-card', 'HrmTransactionController@DeleteScoreCard');

  Route::post('/Transaction/ScoreCard/form-score-card-update', 'HrmTransactionController@UpdateScoreCard');

  Route::post('/Transaction/ScoreCard/form-score-fun-activity-save', 'HrmTransactionController@SaveFunActivity');

  Route::post('/Transaction/ScoreCard/functionActivityDate', 'HrmTransactionController@FindFunActivityDate');

  Route::post('Add-Score-Function-Head', 'HrmTransactionController@AddScoreFunctionHead');

  Route::post('Add-payment-advice-Head', 'HrmTransactionController@AddPaymentAdviceHead');

  Route::post('Add-Score-Self-Head', 'HrmTransactionController@AddScoreSelfHead');

/*--End Score Card Trans---*/



/* ------ end attendance transaction -------- */


/*-------start leave transaction*/

  Route::get('/Transaction/Leave/leave-trans', 'HrmTransactionController@LeaveTrans');

  Route::post('/Transaction/Leave/transaction-employee-leave-save', 'HrmTransactionController@SaveTransactionLeave');

  Route::get('/Transaction/Leave/view-leave-trans', 'HrmTransactionController@ViewLeaveTrans');

  Route::post('/Transaction/Leave/view-leave-chield-trans-data', 'HrmTransactionController@LeaveTransChieldRTowData');

  Route::get('/Transaction/Leave/edit-leave-trans/{id}', 'HrmTransactionController@EditLeaveTrans');

  Route::post('/Transaction/Leave/delete-leave-transaction', 'HrmTransactionController@DeleteLeaveTrans');

  Route::post('/Transaction/Leave/leave-trans-update', 'HrmTransactionController@LeaveTransUpdate');

/*----end leave transaction----*/


/*---------Start Leave Application*/


  Route::get('/Transaction/LeaveApplication/add-leaveApplication', 'HrmTransactionController@leaveApplication');

  Route::get('/Transaction/LeaveApplication/ViewLeaveApplication', 'HrmTransactionController@ViewLeaveApplication');

  Route::post('/Transaction/LeaveApplication/leave-application-save', 'HrmTransactionController@SaveLeaveApplication');

  Route::get('/Transaction/LeaveApplication/edit-leave-application/{id}', 'HrmTransactionController@EditLeaveApplication');

  Route::post('/Transaction/LeaveApplication/leave-application-update', 'HrmTransactionController@UpdateLeaveApplication');

  Route::post('/Transaction/LeaveApplication/delete-leave-application', 'HrmTransactionController@DeleteLeaveApplication');

/*------end Leave Application-----*/

/*----start Travel Requition----*/

 Route::get('/Transaction/TravelRequisition/add-travelRequisition', 'HrmTransactionController@TravelRequisition');

 Route::get('/Transaction/TravelRequisition/view-travelRequision', 'HrmTransactionController@ViewTravelRequisition');

 Route::post('/Transaction/TravelRequisition/EmpTravelReq', 'HrmTransactionController@saveTravelReq');

 Route::post('/Transaction/TravelRequisition/View-Travel-Accommodation-Data', 'HrmTransactionController@ViewAccommodationData');

Route::post('/Transaction/TravelRequisition/View-Travel-Requision-Shedule-Data', 'HrmTransactionController@ViewTravelReqData');

Route::get('/Transaction/TravelRequisition/edit-travel-requisition/{id}', 'HrmTransactionController@EditTravelRequisition');

Route::post('/Transaction/TravelRequisition/UpdateTravelReq', 'HrmTransactionController@UpdateTravelReq');

Route::get('/Transaction/TravelRequisition/success-message/{getName}', 'HrmTransactionController@SuccessMessage');

Route::post('/Transaction/TravelRequisition/delete-travel-requisition', 'HrmTransactionController@DeleteTravelRequisition');



/*----end Travel Requition*/


/*---------start pay calender-----------*/

  Route::get('/Master/Setting/pay-calender', 'HrmTransactionController@PayCalender');

  Route::get('/Master/Setting/view-pay-calender', 'HrmTransactionController@ViewPayCalender');

  Route::post('/Master/Setting/update-pay-calender', 'HrmTransactionController@UpdatePayCalender');

  Route::post('/Master/Setting/add-pay-calendar-save', 'HrmTransactionController@SavePayCalander');

  Route::get('/Master/Setting/edit-pay-calender/{id}', 'HrmTransactionController@EditPayCalender');


  Route::post('/Master/Setting/delete-pay-calender', 'HrmTransactionController@DeletePayCalender');

/*---------end pay calender-------------*/


/*---start employee pay transaction-------*/

  Route::get('/Transaction/EmployeePay/emp-pay-trans', 'HrmTransactionController@EmpPayTrans');

  Route::post('/Transaction/EmployeePay/transaction-pfct-code', 'HrmTransactionController@EmpPayPfctCode');

  Route::post('/Transaction/EmployeePay/employee-list', 'HrmTransactionController@EmployeeList');

  Route::post('/Transaction/EmployeePay/emp-pay-salary-trans', 'HrmTransactionController@EmpPaySalaryTrans');

  Route::post('/Transaction/EmployeePay/document', 'HrmTransactionController@document');

  Route::post('/Transaction/EmployeePay/emp-pay-ctc', 'HrmTransactionController@EmppayCTC');

  Route::get('/Transaction/EmployeePay/view-pay-trans', 'HrmTransactionController@ViewEmppay');

  Route::get('/Transaction/EmployeePay/view_employee-list', 'HrmTransactionController@ViewEmployeeList');

  Route::post('/Transaction/EmployeePay/view_employee-details', 'HrmTransactionController@ViewEmployeeDetails');

  
/*-------End employee pay transaction-----*/




/*start employee master GET METHOD */

  Route::get('/Master/Employee/Add-Employee', 'EmployeeMasterController@AddEmployee');

  Route::get('/Master/Employee/Edit-Emp-Mast/{id}', 'EmployeeMasterController@EditEmployee');

  Route::get('/Master/Employee/View-Employee-Mast', 'EmployeeMasterController@ViewEmpDetails');


  /*Route::get('/finance/view-employee-master', 'EmployeeController@ViewEmployee');*/
   Route::post('help-emp-code-getdata', 'EmployeeMasterController@HelpEmpCodeSearch');
  
  Route::get('/finance/SingleEmpDetails', 'EmployeeMasterController@SingleEmpDetails');

  Route::post('/Master/Employee/add-employee-family', 'EmployeeMasterController@AddEmployeeFamily');

  Route::post('/Master/Employee/employee-career-details-save', 'EmployeeMasterController@SaveEmpCareerDetails');

  Route::post('/Master/Employee/employee-education-details-save', 'EmployeeMasterController@SaveEmpEduDetails');


  Route::post('/Master/Employee/add-employee-save', 'EmployeeMasterController@SaveEmployeeMaster');

  Route::post('view-employee-chield-row-data', 'EmployeeMasterController@view-employee-chield-row-data');

  Route::post('view-employee-chield-family-data', 'EmployeeMasterController@EmployeeFamilyChieldRTowData');

  Route::post('view-employee-chield-employee-data', 'EmployeeMasterController@EmployeeDetailsChieldRTowData');

  Route::post('view-employee-chield-career-data', 'EmployeeMasterController@EmployeeCareerChieldRTowData');

  Route::post('view-employee-chield-education-data', 'EmployeeMasterController@EmployeeChieldRTowData');
  
  Route::post('/finance/employee-master-update', 'EmployeeMasterController@UpdateEmployeeMaster');

  Route::post('/finance/employee-family-master-update', 'EmployeeMasterController@UpdateEmpFamilyMaster');

  Route::post('/finance/employee-career-master-update', 'EmployeeMasterController@UpdateEmpCareerMaster');

  Route::post('/finance/employee-education-master-update', 'EmployeeMasterController@UpdateEmpEducationMaster');

  Route::post('/finance/delete-employee-master', 'EmployeeMasterController@DeleteEmpMaster');

  Route::post('/Master/Employee/emp_gradecode-pay-master', 'EmployeeMasterController@GradecodePay');

  Route::post('/Master/Employee/emp-pay-structure-master', 'EmployeeMasterController@EmppayStructure');

  Route::post('/get-employe-data-by-department', 'EmployeeMasterController@GetEmplyeeByDepartment');

  
/*END EMPLOYEE MASTER POST METHOD */




/*GATE ENTRY PURCHASE*/


  Route::post('/get-acc-data-by-purchase-order', 'FinanaceGateEntryController@GetAccCodeByOrder');

  Route::post('/get-item-data-order', 'FinanaceGateEntryController@Get_Item_Data_Order');
  
  Route::post('/get-item-data-gate-entry-pur', 'FinanaceGateEntryController@Get_Item_Data_Gate_Entry_Pur');


  Route::post('/get-item-data-issue', 'FinanaceGateEntryController@Get_Item_Data_issue');

  Route::post('/finance/save-gate-entry-purchase', 'FinanaceGateEntryController@SaveGateEntryPurchase');

  Route::post('/view-gate-entry-purchase-chield-row-data', 'FinanaceGateEntryController@ViewGateEntryChildPurchase');


  Route::post('/finance/save-gate-entry-return', 'FinanaceGateEntryController@SaveGateEntryRetrun');

  Route::post('/view-gate-entry-return-chield-row-data', 'FinanaceGateEntryController@ViewGateEntryChildReturn');

  Route::get('/Transaction/GateEntry/Gate-Entry-Purchase', 'FinanaceGateEntryController@AddGateEntryPurchase');

  Route::get('/Transaction/GateEntry/View-Gate-Entry-Purchase', 'FinanaceGateEntryController@ViewGateEntryPurchase');

  Route::post('/get-item-by-order-num', 'FinanaceGateEntryController@GetitemByOrdernum');

   Route::get('/Transaction/GateEntry/Gate-Pass','FinanaceGateEntryController@AddGateEntryReturn');

  Route::get('/Transaction/GateEntry/View-Gate-Pass','FinanaceGateEntryController@ViewGateEntryReturn');




/* -------- start vehicle planing  ------------*/

  Route::get('/vehicle-planing-mast', 'FinanaceLogisticController@VehiclePlaningForm');
  Route::get('/view-vehicle-planing-mast','FinanaceLogisticController@VehiclePlaningView');
  Route::get('edit-vehicle-planing/{id}','FinanaceLogisticController@EditVehiclePlaning');


  Route::post('/finance/save-vehicle-plan', 'FinanaceLogisticController@SaveVehiclePlaning');

  Route::post('Vehicle-Planing-Update', 'FinanaceLogisticController@VehiclePlanUpdate');

  Route::get('/Transaction/View-vehicle-Plan-msg/{savedata}', 'FinanaceLogisticController@vehilce_Plan_msg');

   Route::post('/view-vehicle-plan-chield-row-data', 'FinanaceLogisticController@ViewChildVehiclePlan');

  Route::post('/get-do-details-do-order', 'FinanaceLogisticController@getDeliveryOrderDetaisl');

  //Route::post('/Get-Plant_Code-Name-By-Do', 'FinanaceLogisticController@getPlantNameDo');

  Route::post('/update-acc-code-to-delivery-order', 'FinanaceLogisticController@updateAccCodeDeliveryOrder');

  Route::post('/update-item-code-to-delivery-order', 'FinanaceLogisticController@updateItemCodeDeliveryOrder');
  
  Route::post('/update-item-code-to-rake', 'FinanaceLogisticController@updateItemCodeRake');

  Route::post('/get-vehicle-owner-by-vehicle', 'FinanaceLogisticController@getVehicleOwner');

  Route::post('/get-do-details-by-customer', 'FinanaceLogisticController@getDoNoDetaisl');


  Route::get('/get-do-details-by-acc_code', 'FinanaceLogisticController@getDoNoDetaislByAccCode');

  Route::post('/get-data-delivery-order-excel', 'LogisticController@getExcelConfigData');

  Route::post('/get-freight-pur-order-details', 'FinanaceLogisticController@getFreightPurDetails');

  Route::post('/get-item-delivery-order-qty', 'FinanaceLogisticController@getDeliveryOrderQty');

  Route::post('/get-allctedqty-from-do-number', 'FinanaceLogisticController@getDeliveryOrderQtyDo');
  Route::post('/update-allctedqty-from-do-number', 'FinanaceLogisticController@UpdateDeliveryOrderQty');


  Route::post('/get-allctedqty-from-order-number', 'FinanaceLogisticController@getDeliveryOrderQtyRake');
  Route::post('/update-allctedqty-from-order-number', 'FinanaceLogisticController@UpdateDeliveryRakeOrderQty');

  Route::post('/get-consinee-address-by-acc', 'FinanaceLogisticController@getConsineeAddressByAcc');

  /* ----  */
  Route::get('/logistic/cancel-delivery-order-quantity', 'LogisticController@deliveryOrderQtyCancel');

  Route::get('/logistic/get-data-cancel-delivery-order', 'LogisticController@deliveryOrderCancelQty');

  Route::get('/get-data-from-query-delivery-order', 'LogisticController@getDataFromDeliveryOrder');

  Route::get('/report/logistic/delivery-order-pending-report-excel/{from_date}/{to_date}/{vrn}/{do_no}/{cust_no}/{from_place}/{to_place}/{seriesCodeOperator}/{seriesCodeValue}/{plantCodeOperator}/{plantCodeValue}/{profitCenterOperator}/{profitCenterValue}/{QtyOperator}/{QtyValue}/{odcOperator}/{odcValue}/{ReportTypes}/{type}', 'LogisticController@DeliveryOrderPendingReportExcel');

  Route::post('/report/update-delivery-order-cancel-qty', 'LogisticController@deliveryOrderUpdateCancelQty');
  

/* -------- end vehicle planing  ------------*/

/* -------- start ePOD Transaction  ------------*/

  Route::get('/ePOD-transaction', 'LogisticController@ePODForm');
  Route::get('/view-ePOD-transaction','LogisticController@ePODTranView');
  Route::get('edit-ePOD/{id}','LogisticController@EditePODTran');


  Route::post('/ePOD-transaction-Save', 'LogisticController@ePODtranSave');

  Route::post('/ePOD-transaction-Update', 'LogisticController@ePODtranUpdate');

  Route::post('/ePOD-transaction-Delete', 'LogisticController@EPODdelete');

  Route::post('/ePOD-transaction-truck-details', 'LogisticController@ePODTruckDetails');

  Route::post('/get-truck-details-by-truck-no', 'LogisticController@getTruckDetails');

  Route::post('/view-epod-tran-chield-row-data', 'LogisticController@epodChildData');

  

/* -------- end ePOD Transaction  ------------*/

  /*logistic vehcile inward*/

  Route::get('/Transaction/Logistic/Vehicle-Gate-Inward', 'FinanaceLogisticController@AddVehicleGateInward');

  Route::post('/Transaction/Logistic/Save-Vehicle-Gate-Inward', 'FinanaceLogisticController@SaveVehicleGateInward');

   Route::get('/Transaction/Logistic/edit-vehicle-gate-inward/{id}', 'FinanaceLogisticController@EditVehicleGateInward');

   Route::post('/Transaction/Logistic/Update-Vehicle-Gate-Inward', 'FinanaceLogisticController@UpdateVehicleGateInward');

    Route::get('/Transaction/Logistic/View-Vehicle-Gate-Inward','FinanaceLogisticController@ViewVehicleGateInward');

  Route::get('/Transaction/View-vehicle-Gate-Inward-msg/{savedata}', 'FinanaceLogisticController@vehilce_inward_gate_msg');

  Route::post('get-vehicle-plan-details', 'FinanaceLogisticController@VehiclePlanDetails');
  
  Route::post('get-vehicle-plan-details-by-vehicle', 'FinanaceLogisticController@VehiclePlanByVehicleDetails');

  Route::post('get-driving-license-details', 'FinanaceLogisticController@DrivingLsDetails');

  Route::post('get-vehicle-details', 'FinanaceLogisticController@VehicleDetails');

  Route::get('/Transaction/View-vehicle-Gate-Inward-msg/{savedata}', 'FinanaceLogisticController@vehilce_inward_gate_msg');

  /*logidtic vehcile outward*/

   Route::get('/Transaction/Logistic/Vehicle-Gate-Outward', 'FinanaceLogisticController@AddVehicleGateOutward');

  Route::post('/Transaction/Logistic/Save-Vehicle-Gate-Outward', 'FinanaceLogisticController@SaveVehicleGateOutward');

   Route::get('/Transaction/Logistic/edit-vehicle-gate-Outward/{id}', 'FinanaceLogisticController@EditVehicleGateOutward');

   Route::post('/Transaction/Logistic/Update-Vehicle-Gate-Outward', 'FinanaceLogisticController@UpdateVehicleGateOutward');

    Route::get('/Transaction/Logistic/View-Vehicle-Gate-Outward','FinanaceLogisticController@ViewVehicleGateOutward');

  Route::get('/Transaction/View-vehicle-Gate-Outward-msg/{savedata}', 'FinanaceLogisticController@vehilce_inward_gate_msg');
  /*logidtic vehcile outward*/
  /*logistic lorry receipt*/

   Route::get('/Transaction/Logistic/lorry-receipt-trans', 'FinanaceLogisticController@AddLorryReceipt');

    Route::get('/Transaction/Logistic/upload-bulk-lr', 'FinanaceLogisticController@UploadLorryReceipt');


  Route::post('/Transaction/Logistic/Save-lorry-receipt-trans', 'FinanaceLogisticController@SaveLorryReceipt');

  Route::post('/Transaction/Logistic/Save-bulk-lorry-receipt', 'FinanaceLogisticController@SaveBulkLorryReceipt');

   Route::get('/Transaction/Logistic/edit-lorry-receipt-trans/{id}', 'FinanaceLogisticController@EditLorryReceipt');

   Route::post('/Transaction/Logistic/Update-lorry-receipt-trans', 'FinanaceLogisticController@UpdateLorryReceipt');

    Route::post('/Transaction/Logistic/get-lorry-offline-pdf','FinanaceLogisticController@offlineLrReceiptPDF');


    Route::get('/Transaction/Logistic/View-lorry-receipt-trans','FinanaceLogisticController@ViewLorryReceipt');

   Route::post('/Transaction/Logistic/view-lorry-receipt-chield-row-data', 'FinanaceLogisticController@ViewChildLorryReceipt');

  Route::get('/Transaction/View-lorry-receipt-msg/{savedata}', 'FinanaceLogisticController@lorry_receipt_msg');

  Route::post('/get-trip-details-by-trip-no', 'FinanaceLogisticController@getTripDetaisl');

  Route::post('/get-do-details-for-trip-plan', 'FinanaceLogisticController@getDoTripDetaisl');

   Route::post('/get-item-trip-plan-qty', 'FinanaceLogisticController@getTripOrderQty');


  Route::post('/get-ewaybill-details-for-trip-plan', 'FinanaceLogisticController@getEWayBillDetails');


 /* logistic lorry receipt */

 /*lorry receipt ackonlogement*/

  Route::get('/Transaction/Logistic/lr-acknowledgment-trans', 'FinanaceLogisticController@AddLrAcnowledgment');


  Route::post('/Transaction/Logistic/Save-lr-acknowledgment-trans', 'FinanaceLogisticController@SaveLrAcnowledgment');

   Route::get('/Transaction/Logistic/edit-lr-acknowledgment-trans/{id}', 'FinanaceLogisticController@EditLorryReceipt');

   Route::post('/Transaction/Logistic/Update-lr-acknowledgment-trans', 'FinanaceLogisticController@UpdateLorryReceipt');

    Route::get('/Transaction/Logistic/View-lr-acknowledgment-trans','FinanaceLogisticController@ViewLrAcnowledgment');

   Route::post('/Transaction/Logistic/view-lr-acknowledgment-trans-row-data', 'FinanaceLogisticController@ViewChildLrAcnowledgment');

   Route::post('/get-lr-details-by-lr-no', 'FinanaceLogisticController@getLrDetails');

  Route::get('/Transaction/View-lr-acknowledgment-trans-msg/{savedata}', 'FinanaceLogisticController@lr_acknowledgment_msg');

  Route::post('/get-achive-date-for-target-date', 'FinanaceLogisticController@getAchiveDateDetails');

 /*lorry receipt ackonlogement*/

 /* delivery order*/

  Route::get('/Transaction/Logistic/Delivery-Order', 'FinanaceLogisticController@AddDeliveryOrder');

  Route::get('/Transaction/Logistic/View-Delivery-Order', 'FinanaceLogisticController@ViewDeliveryOrder');

  Route::get('/Transaction/Logistic/View-Delivery-Order-Details', 'FinanaceLogisticController@ViewDeliveryOrderDetails');

 // Route::post('/finance/save-delivery-order', 'FinanaceLogisticController@SaveDeliveryOrder');

  Route::post('/finance/save-delivery-order', 'FinanaceStoreController@SaveDeliveryOrder');

  Route::post('/finance/save-delivery-order-exceeding', 'FinanaceStoreController@SaveDeliveryOrderExCeeding');

  Route::post('/view-delivery-order-chield-row-data', 'FinanaceLogisticController@ViewChildDeliveryOrder');

  Route::get('/Transaction/view-delivery-order-msg/{savedata}', 'FinanaceLogisticController@delivery_order_msg');

  Route::get('get-item-page-with-data', 'FinanaceLogisticController@GetItemDataForDO');
  Route::get('get-acc-page-with-data', 'FinanaceLogisticController@GetAccDataForDO');


   Route::post('get-do-excel-code-by-series', 'FinanaceLogisticController@GetDoExcelCodeBySeries');

  /* delivery order*/


  /* rack trans order*/

  Route::get('/Transaction/Logistic/Rack-Trans', 'FinanaceLogisticController@AddRackTrans');

  Route::get('/Transaction/Logistic/View-Rack-Trans', 'FinanaceLogisticController@ViewRackTrans');

  Route::get('/Transaction/Logistic/View-Rack-Order-Details', 'FinanaceLogisticController@ViewRakeOrderDetails');

  Route::post('/finance/save-rack-trans', 'FinanaceLogisticController@SaveRackTrans');

  Route::post('/view-rack-trans-chield-row-data', 'FinanaceLogisticController@ViewChildRackTrans');

  Route::get('/Transaction/view-rack-trans-msg/{savedata}', 'FinanaceLogisticController@rack_trans_msg');


  /* rack trans order*/

  /* freight sale order*/

  Route::get('/Transaction/Logistic/Freight-Sale-Order', 'FinanaceLogisticController@AddFreightSaleOrder');

  Route::get('/Transaction/Logistic/View-Freight-Sale-Order', 'FinanaceLogisticController@ViewFreightSaleOrder');
  
  Route::post('/finance/save-freight-sale-order', 'FinanaceLogisticController@SaveFreightSaleOrder');

Route::post('/view-freight-sale-order-chield-row-data', 'FinanaceLogisticController@ViewChildFreightSaleOrder');

Route::post('/get-place-from-freight-orderno', 'FinanaceLogisticController@getPlaceFreightOrder');

Route::post('/get-freight-orderno-by-customer', 'FinanaceLogisticController@getFreightOrderByCust');

Route::post('/get-route-location-by-route-code', 'FinanaceLogisticController@getLocationRoute');

Route::post('/get-city-name-by-adress', 'FinanaceLogisticController@getCityName');

Route::post('/get-route-details-by-from-place', 'FinanaceLogisticController@getRouteDetailsByFromPlace');



Route::get('/Transaction/view-freight-sale-order-msg/{savedata}', 'FinanaceLogisticController@freight_sale_order_msg');

  /* freight sale order*/

  /* freight purchase order*/

  Route::get('/Transaction/Logistic/Freight-Purchase-Order', 'FinanaceLogisticController@AddFreightPurchaseOrder');

  Route::get('/Transaction/Logistic/View-Freight-Purchase-Order', 'FinanaceLogisticController@ViewFreightPurchaseOrder');
  
  Route::post('/finance/save-freight-purchase-order', 'FinanaceLogisticController@SaveFreightPurchaseOrder');

Route::post('/view-freight-purchase-order-chield-row-data', 'FinanaceLogisticController@ViewChildFreightPurchaseOrder');

 Route::get('/Transaction/view-freight-purchase-order-msg/{savedata}', 'FinanaceLogisticController@freight_purchase_order_msg');


  /* freight purchase order*/

  /*Route::post('/finance/save-gate-entry-nonreturn', 'FinanaceGateEntryController@SaveGateEntryNonRetrun');

  Route::post('/view-gate-entry-nonreturn-chield-row-data', 'FinanaceGateEntryController@ViewGateEntryChildNonReturn');*/

  /* Route::post('/get-item-by-issue-num','FinanaceStoreController@GetitemByIssuenum');*/
   
 

 /* Route::get('/finance/transaction/gate-entry/gate-entry-nonreturn','FinanaceGateEntryController@AddGateEntryNonReturn');

  Route::get('/finance/transaction/gate-entry/view-gate-entry-nonreturn','FinanaceGateEntryController@ViewGateEntryNonReturn');*/

/*GATE ENTRY PURCHASE*/

/*STORE REQUISTION*/

  Route::get('/Transaction/Store/Store-Requistion', 'FinanaceStoreController@AddStoreRequistion');

  Route::get('/Transaction/Store/View-Store-Requistion', 'FinanaceStoreController@ViewStoreRequistion');

  Route::post('/finance/save-store-requisition-transaction', 'FinanaceStoreController@SaveStoreRequistion');

  Route::post('/view-purchase-store-requistion-chield-row-data', 'FinanaceStoreController@ViewStoreChildRequistion');

   Route::post('get_store_requistion_by_approval_purchase', 'FinanaceStoreController@GetStoreRequsitionForApp');

  Route::post('change-status-store-requisition', 'FinanaceStoreController@StatusStoreRequisition');

  Route::post('/reject-approve-store-requistion', 'FinanaceStoreController@RejectStoreRequistion');

  Route::post('/reject-payment-advice-requistion', 'HrmTransactionController@RejectPaymentAdviceReq');

  Route::post('/get-item-data-requsiton', 'FinanaceStoreController@Get_Item_Data_Requistion');

 


  Route::get('/finance/transaction/store/edit-store-requisition/{headid}/{bodyid}/{vrno}', 'FinanaceStoreController@EditStoreRequistion');

  Route::post('/get-item-by-req-num', 'FinanaceStoreController@GetitemByReqnum');

/*STORE REQUISTION*/

/*STORE ISSUE*/
  Route::get('/Transaction/Store/Store-Issue', 'FinanaceStoreController@AddStoreIssue');
  
  Route::get('/Transaction/Store/View-Store-Issue', 'FinanaceStoreController@ViewStoreIssue');
  
  Route::get('/finance/transaction/store/edit-store-issue/{headid}/{bodyid}/{vrno}', 'FinanaceStoreController@EditStoreIssue');
  
  Route::post('/get-item-return-by-issue-num', 'FinanaceStoreController@GetitemReturnByIssuenum');
  
  Route::post('/get-item-by-issue-num', 'FinanaceStoreController@GetitemByIssuenum');
  
  Route::post('/get-item-um-aum-issuenum', 'FinanaceStoreController@Get_Item_UM_AUM_Issue_No');
  
  Route::post('/finance/save-store-issue-transaction', 'FinanaceStoreController@SaveStoreIssue');
  
  Route::post('/view-purchase-store-issue-chield-row-data', 'FinanaceStoreController@ViewStoreChildIssue');

  Route::post('/get-simulation-data-for-store-issue', 'FinanaceStoreController@simulationForStoreIssue');

/*STORE ISSUE*/

/*STORE RETURN PURCHASE*/

      Route::get('/Transaction/Store/Store-Return', 'FinanaceStoreController@AddStoreReturn');
      
      Route::get('/Transaction/Store/View-Store-Return', 'FinanaceStoreController@ViewStoreReturn');
      
      Route::get('/finance/transaction/store/edit-store-return/{headid}/{bodyid}/{vrno}', 'FinanaceStoreController@EditStoreReturn');
      
      Route::post('/get-item-by-scrab-code', 'FinanaceStoreController@GetitemByScrabCode');
      
      Route::post('/get-item-um-aum-reqnum', 'FinanaceStoreController@Get_Item_UM_AUM_Req_No');

      Route::post('/get-item-um-aum-bom', 'ProductionController@Get_Item_UM_AUM_BOM');

      
      Route::post('/get-item-by-grn-data', 'FinanaceStoreController@Get_Item_Grn_Data');
      
      Route::post('/finance/save-store-retrun-transaction', 'FinanaceStoreController@SaveStoreReturn');
      
      Route::post('/view-purchase-store-return-chield-row-data', 'FinanaceStoreController@ViewStoreChildReturn');

      Route::post('/get-simulation-data-for-store-return', 'FinanaceStoreController@simulationForStoreReturn');

/*STORE RETURN PURCHASE */


/* -------- start purchase indent transaction ---------- */
  
  Route::get('/Transaction/Purchase/Purchase-Indent-Trans', 'PurchaseTransController@PurchaseIndent');
  Route::get('/Transaction/Purchase/Edit-Purchase-Indent-Trans/{headid}/{bodyid}/{vrno}', 'PurchaseTransController@EditIndentPurchase');

  Route::get('/Transaction/Purchase/View-Purchase-Indent-Trans', 'PurchaseTransController@ViewPurchaseIndent');

  Route::get('/Transaction/Purchase/View-Purchase-Indent-Msg/{savedata}', 'PurchaseTransController@purchase_indent_msg');
  Route::post('/finance/get-quality-parameter-by-item-indent', 'PurchaseTransController@GetQPIndent');
  Route::post('/Transaction/Purchase/save-Purchase-Indent-Trans', 'PurchaseTransController@SavePuchaseIndent');
  Route::post('View-Purchase-Indent-Trans-Chield-Row-Data', 'PurchaseTransController@PurchaseIndentChieldRTowData');
  Route::post('/Transaction/Purchase/Delete-Purchase-Indent-Trans', 'PurchaseTransController@DeletePurchaseIndent');
  Route::post('Transaction/Purchase/Update-Purchase-Indent-Trans', 'PurchaseTransController@UpdatePuchaseIndent');
  Route::get('/Transaction/Purchase/View-Purchase-Indent-UdMsg/{savedata}', 'PurchaseTransController@purchase_update_indent_msg');

/* ---------- end purchase indent transaction ---------- */


/* -------- start purchase enquiry transaction ---------*/

  Route::get('/Transaction/Purchase/Purchase-Enquiry-Trans', 'PurchaseTransController@PurchaseEnquiryTrans');
  Route::get('/Transaction/Purchase/View-Purchase-Enquiry-Trans', 'PurchaseTransController@ViewEnquiryTransaction');
  Route::get('/finance/view-enquiry-msg/{savedata}', 'PurchaseTransController@purchase_enquiry_msg');

  Route::post('/Transaction/Purchase/Save-Purchase-Enquiry-Trans', 'PurchaseTransController@SavePurchaseEnquiry');

  Route::post('view-enquiry-chield-row-data', 'PurchaseTransController@ViewEnquiryChildRow');
  Route::post('/Transaction/Purchase/Delete-Purchase-Enquery-Trans', 'PurchaseTransController@DeletePurchaseEnqury');
  Route::post('/get-pfct-code-name', 'PurchaseTransController@pfct_by_plantcode');
  Route::post('/get-indent-no-by-enquiry', 'PurchaseTransController@GetIndentData');
  Route::post('/get-item-name-by-enquiry', 'PurchaseTransController@GetItemEnquiryData');
  Route::post('get-qty-parameter-frm-indend-by-itm', 'PurchaseTransController@GetQtyParametrFrmIndendByItm');
  Route::post('/get-data-by-acc_code', 'PurchaseTransController@GetDataByAccCode');

/* -------- end purchase enquiry transaction ---------*/


/* --------- start purchase quotation transaction -------*/

  Route::get('/Transaction/Purchase/Purchase-Quotation-Trans', 'PurchaseTransController@PurchaseQuotation');
  Route::get('/Transaction/Purchase/View-Purchase-Quatation-Trans', 'PurchaseTransController@ViewPurchaseQuotation');
  Route::get('/Transaction/Purchase/View-Purchase-Quatation-Trans-Save-Msg/{savedata}', 'PurchaseTransController@purchase_quotatn_save_msg');

  Route::post('/Transaction/Purchase/Save-Perchase-Quotation-Trans', 'PurchaseTransController@SavePuchaseQuotation');
  Route::post('/Transaction/Purchase/Delete-Perchase-Quotation-Trans', 'PurchaseTransController@DeletePurchaseQuotation');
  Route::post('/get-item-by-enquiry-num', 'PurchaseTransController@GetitemByEnquirynum');
  Route::post('/get-item-by-enquiry-um-aum', 'PurchaseTransController@Get_Item_by_enquiry_UM_AUM');
  Route::post('/get-item-by-condition-in-add-more', 'PurchaseTransController@GetItmBYConditnInAddMore');

/* --------- end purchase quotation transaction -------*/

/* ------ start purchase quotation comparision transaction ------ */

  Route::get('/Transaction/Purchase/Purchase-Quo-Comparism-Trans', 'PurchaseTransController@PurchaseQuoComparism');
  Route::get('/Transaction/Purchase/Purchase-Quo-Comparism-Save-msg/{savedata}', 'PurchaseTransController@purQuoComparismSaveMsg');

  Route::post('get-data-by-item-in-quo-compare', 'PurchaseTransController@GetDataByItmInQuoCompare');
  Route::post('save-purchase-quotation-comparism', 'PurchaseTransController@SavePurchaseQtnComparism');

/* ------ end purchase quotation comparision transaction ------ */


/* ------ start purchase contract transaction -------- */

Route::get('/Transaction/Purchase/Purchase-Contract-Trans', 'PurchaseTransController@PurchaseContract');
Route::get('/Transaction/Purchase/purchase-contract-save-msg/{savedata}', 'PurchaseTransController@purchase_contract_save_msg');
Route::get('/Transaction/Purchase/View-Contract-Trans', 'PurchaseTransController@ViewPurchaseContract');
Route::get('/Transaction/Purchase/Edit-Contract-Trans/{headid}/{bodyid}/{vrno}', 'PurchaseTransController@EditContractTrans');

Route::post('finance/update-contract-transaction', 'PurchaseTransController@UpdateContractTrans');
Route::post('/Transaction/Purchase/save-contract-transaction', 'PurchaseTransController@SaveContractPurchase');
Route::post('/Transaction/Purchase/Delete-Purchase-Contract-Trans', 'PurchaseTransController@DeletePurchaseContract');

Route::post('get-QcNum-by-account', 'PurchaseTransController@GetQcNumByAcc');
Route::post('get-acc-by-qc-no-for-contract', 'PurchaseTransController@GetAccByQcNoForContract');
Route::post('get-qtn-data-from-quo-comparision', 'PurchaseTransController@GetQtnFrmQuoCompare');
Route::post('get-qty-parameter-frm-purchase-quo-by-itm', 'PurchaseTransController@GetQtyParametrFrmPurchaseQuoByItm');
Route::post('get-item-by-acc-code-for-contract', 'PurchaseTransController@GetItemByAccCodeInContract');
Route::post('view-purchase-contract-chield-row-data', 'PurchaseTransController@PurchaseContractChieldRTowData');

Route::post('/get-purchase-head-id-onpayterm', 'PurchaseTransController@purHeadIdOnPayTermContra');


/* ------ end purchase contract transaction -------- */

/* --------- start purchase order transaction -------*/

  Route::get('/Transaction/Purchase/Purchase-Order-Trans', 'PurchaseTransController@PurchaseOrder');
  Route::get('/Transaction/Purchase/View-Purchase-Order-Trans', 'PurchaseTransController@ViewPurchaseOrder');
  Route::get('/Transaction/Purchase/Edit-Purchase-Order-Trans/{id}', 'PurchaseTransController@EditOrderPurchase');
  Route::get('/Transaction/Purchase/View-Purchase-Order-Invoice/{savedata}/{orderid}/{headid}', 'PurchaseTransController@PurchaseOrderInvoce');
  Route::get('/finance/view-purchase-order-msg/{savedata}', 'PurchaseTransController@purchase_order_msg');

  Route::post('/Transaction/Purchase/Save-Purchase-Order-Trans', 'PurchaseTransController@SavePurchaseOrder');
  Route::post('finance/update-purchase-order-transaction', 'PurchaseTransController@UpdatePuchaseOrder');
  Route::post('view-purchase-order-chield-row-data', 'PurchaseTransController@ViewPurchaseOrderTransChildRow');
  Route::post('/Transaction/Purchase/Delete-Purchase-Order-Trans', 'PurchaseTransController@DeletePurchaseOrder');


  Route::post('get-vrno-series-by-trans-in-po', 'PurchaseTransController@getVrnoSeriesBytrans');
  Route::post('/get-contravrno-quovrno-by-account','PurchaseTransController@GetContraQuoByAcc');
  Route::post('/get-item-by-quation-n-contra', 'PurchaseTransController@GetItemByQtnNContra');
  Route::post('get-qty-parameter-frm-quo-contra-by-itm', 'PurchaseTransController@GetQtyParametrFrmQuoContraByItm');
  Route::post('get-qty-data-from-quo-contra-item', 'PurchaseTransController@GetQtnFrmQuocontraItm');
  Route::post('/get-a-field-by-trans-code-qtnno-contranum', 'PurchaseTransController@AfieldCalculationGetFrmQuoCon');

/* --------- end purchase order transaction -------*/

/* ----------- start job work order --------------- */

  Route::get('/Transaction/Purchase/Job-Work-Order', 'PurchaseTransController@JobWorkOrder');
  Route::get('/Transaction/Purchase/View-Job-Work-Order-Trans', 'PurchaseTransController@ViewJobWorkOrder');
  Route::get('/Transaction/jobWorkOrder-save-msg/{savedata}', 'PurchaseTransController@jobWorkOrderSave_msg');


  Route::post('/Transaction/Purchase/Save-Job-Work-Order', 'PurchaseTransController@SaveJobWorkOrder');

/* ----------- start job work order --------------- */


/* --------- start Direct purchase transaction -------*/
 Route::get('/Transaction/Purchase/Direct-Purchase-Bill-Trans', 'PurchaseTransController@DirectPurchaseBill');
 Route::get('/Transaction/Purchase/View-Direct-Purchase-Bill-Trans', 'PurchaseTransController@ViewDirectPurchaseBill');

 Route::post('/Transaction/Purchase/Save-Direct-Purchase-Bill', 'PurchaseTransController@SaveDirectPurchaseBil');
 Route::post('/get-order-grn-by-acc-in-dp', 'PurchaseTransController@GetordrGrnByAcc');
 Route::post('/get-item-by-order-n-grn', 'PurchaseTransController@GetItemByOrdrNGrn');


/* --------- start Direct purchase transaction -------*/


/* --------- start purchase good reciept note transaction -------*/

  Route::get('/Transaction/Purchase/Good-Reciept-Note-Trans', 'PurchaseTransController@GoodRNote');
  Route::get('/Transaction/Purchase/view-Good-Reciept-Note-Trans', 'PurchaseTransController@ViewGoodRNote');
  Route::get('/Transaction/Purchase/View-Good-Reciept-Note-Msg/{savedata}', 'PurchaseTransController@purchase_GRN_msg');

  Route::post('get-QP-frm-PO-by-item-in-grn', 'PurchaseTransController@QualityParameterGRN');
  Route::post('/get-itmdata-by-purchase-order-vrno', 'PurchaseTransController@GetItemByPurOrder');
  Route::post('/get-itmdata-by-store-issue-vrno', 'FinanaceStoreController@GetItemByStoreIssue');
  Route::post('/get-purchase-order-vrno-by-account', 'PurchaseTransController@GetPurchaseOrderVrnoByAcc');
  Route::post('/get-a-field-calc-for-grn', 'PurchaseTransController@AfieldCalculationForPurOrder');

  Route::post('/Transaction/Purchase/Save-Good-Reciept-Note', 'PurchaseTransController@SaveGoodRNote');
  Route::post('view-good-reciept-note-chield-row-data', 'PurchaseTransController@ViewGoodRecieptNoteChildRow');
  Route::post('/Transaction/Purchase/Delete-Good-Reciept-Note-Trans', 'PurchaseTransController@DeletePurchaseGRN');
  Route::post('/get-simulation-data-for-grn', 'PurchaseTransController@simulationForGRN');

/* --------- end purchase good reciept note transaction ---------*/

/* ------- start purchase bill transaction -------- */

  Route::get('/Transaction/Purchase/Purchase-Bill-Trans', 'PurchaseTransController@PurchaseTransaction');
  Route::get('/Transaction/Purchase/View-Purchase-Bill-Trans', 'PurchaseTransController@ViewPurchaseTransaction');
  Route::get('/Transaction/Purchase/Purchase-Bill-Trans/{acc_code}/{vr_no}/{series_cd}/{startYr}', 'PurchaseTransController@PurchaseTransaction');
  Route::get('/Transaction/Purchase/View-Purchase-bill-Msg/{savedata}', 'PurchaseTransController@purchase_bill_msg');
  
  Route::post('/get-grn-no-by-acc-in-purchase-bill', 'PurchaseTransController@GetGrnNoByAccInPurBill');
  Route::post('/get-gl-by-series-for-purchase', 'PurchaseTransController@GetGlBySeriesInPurchase');
  Route::post('/get-gl-code-by-account', 'PurchaseTransController@GetGlCodeOfAcc');
  Route::post('/get-grndetail-by-grn-vrno', 'PurchaseTransController@GetGrnDetailsByGRnVrno');
  Route::post('/get-data-from-grn-fro-pur-bill', 'PurchaseTransController@GetDataFrmGrnForPurBill');
  Route::post('/get-a-field-calc-for-purchase-bill', 'PurchaseTransController@AfieldCalculationForPurpurchaseBill');
  Route::post('get-qty-parameter-frm-purchase-grn-by-itm', 'PurchaseTransController@GetQtyParametrFrmGrnByItm');
  Route::post('get-simulation-data-for-purchase-bill', 'PurchaseTransController@simulationForPurBill');

  Route::post('/Transaction/Purchase/Save-Purchase-Bill-Trans', 'PurchaseTransController@SavePurchaseTrans');

  Route::post('view-purchase-chield-row-data', 'PurchaseTransController@ViewPurchaseTransChildRow');

/* ------- end purchase bill transaction -------- */

/* ----- start multiple purchase bill transaction ------ */
  
  Route::get('/finance/transaction/multiple-purchase-transaction', 'PurchaseTransController@MultiplePurchaseTransaction');

/* ----- end multiple purchase bill transaction ------ */

/* ------- Start CRM enquiery transaction ------- */
Route::get('/Transaction/CRM/CRM-Enquery-Trans', 'FinanceCRMController@CRMEnquiryTrans');

Route::get('/Transaction/Crm/Crm-Order-Trans', 'FinanceCRMController@CRMOrderTrans');

Route::post('/Transaction/Crm/Save-Crm-Enquiry-Trans', 'FinanceCRMController@SaveCrmEnquiry');

Route::get('/Transaction/Crm/View-Crm-Enquery-Trans', 'FinanceCRMController@ViewCrmEnquiryTransaction');

Route::get('/Transaction/CRM/View-Crm-Order-Trans', 'FinanceCRMController@ViewCrmOrderTransaction');

Route::get('/report/crm/crm-delivery-challan-report', 'FinanceCRMController@CrmGrnReport');

Route::get('/get-data-from-query-crm-grn', 'FinanceCRMController@getDataFromQueryFormCrmGrn');

Route::get('/report/crm/View-Crm-Ledger-Trans','FinanceCRMController@ReportLedger');





/* ------- End CRM enquiery transaction ------- */

/*SRM*/

 Route::get('/Transaction/Srm/View-Srm-Enquery-Trans', 'FinanceSRMController@ViewSrmEnquiryTransaction');

 Route::get('/Transaction/Srm/View-Srm-Quotation-Trans', 'FinanceSRMController@ViewSrmQuotation');

 Route::get('/Transaction/SRM/View-Srm-Order-Trans', 'FinanceSRMController@ViewSrmOrderTransaction');

 Route::get('/report/srm/srm-delivery-challan-report', 'FinanceSRMController@SrmGrnReport');

 Route::get('/get-data-from-query-srm-grn', 'FinanceSRMController@getDataFromQueryFormSrmGrn');
/*SRM*/

Route::get('/Transaction/Crm/View-Crm-Quotation-Trans', 'FinanceCRMController@ViewCrmQuotation');


Route::post('/transaction/sales/get-acc-type-by-acccode', 'SettingController@getAccType');


/* ------- Start sale quotation transaction ------- */
  Route::get('/Transaction/Sales/Sales-Enquery-Trans', 'FinanceSaleController@SalesEnquiryTrans');

  Route::post('/get-item-name-by-saleEnquiry', 'FinanceSaleController@GetItemSaleEnquiryData');

  Route::post('/Transaction/Sales/Save-Sales-Enquiry-Trans', 'FinanceSaleController@SaveSalesEnquiry');

  Route::get('/Transaction/Sales/View-Sales-Enquery-Trans', 'FinanceSaleController@ViewSaleEnquiryTransaction');

  Route::get('/Transaction/Sales/Track-Sales-Enquery-Trans', 'FinanceSaleController@TrackSaleEnquiryTransaction');

  Route::post('view-sales-enquiry-chield-row-data', 'FinanceSaleController@ViewSalesEnquiryChildRow');

  Route::post('/get-enqdate-by-enqnum', 'FinanceSaleController@GetEnqDateSaleEnquiryData');
  
  Route::post('/Get-Track-Sale-Enq-Data', 'FinanceSaleController@GetEnqTrackSaleEnquiryData');

  Route::post('/Transaction/Sales/Save-Track-Sales-Enquiry-Trans', 'FinanceSaleController@SaveTrackSalesEnquiry');

  Route::get('/finance/view-sale-enquiry-msg/{savedata}', 'FinanceSaleController@sale_enquiry_msg');
  Route::get('/finance/view-store-req-msg/{savedata}', 'FinanaceStoreController@store_requistion_msg');
  Route::get('/finance/view-store-issue-msg/{savedata}', 'FinanaceStoreController@store_issue_msg');
  Route::get('/finance/view-store-return-msg/{savedata}', 'FinanaceStoreController@store_return_msg');


  Route::get('/finance/view-production-msg/{savedata}', 'ProductionController@production_msg');

  Route::get('/finance/view-gatepurchase-msg/{savedata}', 'FinanaceGateEntryController@gatepurchase_msg');
  Route::get('/finance/view-gatepassreturn-msg/{savedata}', 'FinanaceGateEntryController@gatepassreturn_msg');


  Route::get('/finance/view-daily-production-msg/{savedata}', 'ProductionController@daily_production_msg');
  Route::get('/finance/view-wo-production-msg/{savedata}', 'ProductionController@woproduction_msg');


/* ------- Start sale quotation transaction ------- */


/* ------- Start sale quotation transaction ------- */

  Route::get('/Transaction/Sales/Sales-Quotation-Trans', 'FinanceSaleController@AddsalesQuotation');

  Route::get('/Transaction/Sales/View-Sales-Quotation-Trans', 'FinanceSaleController@ViewSaleQuotation');

  Route::get('/Transaction/Sales/Sales-Quotation-Save-Msg/{savedata}', 'FinanceSaleController@SaleQuoSaveMsg');

  Route::get('/Transaction/Sales/Edit-Sales-Quotation-Trans/{headid}/{bodyid}/{vrNo}', 'FinanceSaleController@EditsalesQuotation');

  Route::post('/Transaction/Sales/Save-Sale-Quotation-Trans', 'FinanceSaleController@SaveSalesQuotation');
  Route::post('/Transaction/Sales/Delete-Sale-Quotation-Trans', 'FinanceSaleController@DeleteSaleQuotation');
  Route::post('/Transaction/Sales/Update-Sale-Quotation-Trans', 'FinanceSaleController@UpdateSaleQuotation');

  Route::post('/get-item-in-salenquiry-addmore', 'FinanceSaleController@GetItmBYConditnInAddMoreSale');
  Route::post('/get-item-by-enquiryInSale', 'FinanceSaleController@GetitemByEnquiryInsale');
  Route::post('/get-data-by-rever-quo', 'FinanceSaleController@GetDataByQuoationNo');
  Route::post('/get-item-from-salequo-by-quo-num', 'FinanceSaleController@GetItmFrmSaleQuotatn');

/* ------- end sale quotation transaction ------- */

/* -------- start sale contract transaction ------ */
  
  Route::get('/Transaction/Sales/Sales-Contract-Trans', 'FinanceSaleController@AddsalesContract');
  Route::get('/Transaction/Sales/Sale-Contract-Trans-save-msg/{savedata}', 'FinanceSaleController@SaleContractSaveMsg');
  Route::get('/Transaction/Sales/View-Sale-Contract-Trans', 'FinanceSaleController@ViewSaleContractTrans');
  Route::get('/Transaction/Sales/Edit-Sale-Contract-Trans/{headid}/{bodyid}/{vrno}', 'FinanceSaleController@EditSaleContract');

  Route::post('/Transaction/Sales/Save-Sale-Contract-Trans', 'FinanceSaleController@SaveSaleContractTrans');
  Route::post('/Transaction/Sales/Delete-Sale-Contract-Trans', 'FinanceSaleController@DeleteSaleContract');
  Route::post('view-sale-contract-chield-row-data', 'FinanceSaleController@ViewSaleContractChildRow');

/* -------- end sale contract transaction ------ */

/* -------- start sale order transaction -------- */

  Route::get('/Transaction/Sales/Sales-Order-Trans', 'FinanceSaleController@AddsalesOrder');
  Route::get('/Transaction/Sales/Sales-Order-Save-Msg/{savedata}', 'FinanceSaleController@SaleOrderSaveMsg');
  Route::get('/Transaction/Sales/View-Sales-Order-Trans', 'FinanceSaleController@ViewSalesOrder');
  Route::get('/Transaction/Sales/Edit-Sale-Order/{headid}/{bodyid}/{vrno}', 'FinanceSaleController@EditSaleOrder');

  Route::post('/Transaction/Sales/Save-Sales-Order-Trans', 'FinanceSaleController@SaveSalesOrder');
  Route::post('/Transaction/Sales/Delete-Sale-Order-Trans', 'FinanceSaleController@DeleteSaleOrder');
  Route::post('view-Post-Good-Issue-chield-row-data', 'FinanceSaleController@ViewPostGoodIssueChildRow');


/* -------- end sale order transaction -------- */

/* -------- start sale trans transaction -------- */

Route::get('/Transaction/Sales/Direct-Sales-Trans', 'FinanceSaleController@AddDirectSaleTrans');
Route::get('/Transaction/Sales/Sales-Bill-Save-Msg/{savedata}', 'FinanceSaleController@SaleBillSaveMsg');

Route::post('/Transaction/Sales/Save-Direct-Sales-Trans', 'FinanceSaleController@SaveDirectSalesTrans');




/* -------- end sale trans transaction -------- */


/* ---------- start post good issue ---------- */

    Route::get('/Transaction/Sales/Post-Good-Issue', 'FinanceSaleController@AddPostGoodIssue');
    Route::get('/Transaction/Sales/View-Post-Good-Issue-Trans', 'FinanceSaleController@ViewPostGoddIssue');
    Route::get('/Transaction/Sales/Post-Good-Issue-Save-Msg/{savedata}', 'FinanceSaleController@PostGoodIssueSaveMsg');

    Route::post('/Transaction/Sales/Save-Post_Godd_Issue-Trans', 'FinanceSaleController@SavePostGoddIssue');
    Route::post('/Transaction/Sales/Delete-Post_goods_issues', 'FinanceSaleController@DeletePostGoodsIssue');

    Route::post('/get-stock-opening-qty-by-item', 'FinanceSaleController@GetStockOpnQty');
    Route::post('/get-simulation-data-for-sale-challan', 'FinanceSaleController@simulationForSaleChallan');

/* ---------- end post good issue ------------ */

/* -------- start journal transaction ----- */
  
  Route::get('/Transaction/Account/Journal-Trans', 'FinanceAccountTransController@JournalTrans');
  Route::get('/Transaction/Account/View-Journal-Trans', 'FinanceAccountTransController@ViewJournalTrans');
  Route::get('/Transaction/Account/Edit-Journal-Trans/{compCode}/{fyCode}/{tranCode}/{seriesCode}/{vrNo}', 'FinanceAccountTransController@EditJournalTrans');

  Route::post('/Transaction/Account/Save-Journal-Trans', 'FinanceAccountTransController@SaveJournalTrnas');
  Route::post('/Transaction/Account/Delete-Journal-Trans', 'FinanceAccountTransController@DeleteJournalTrans');
  Route::post('/Transaction/Account/update-Journal-Trans', 'FinanceAccountTransController@UpdateJournalTrans');

  Route::post('/get-gl-tag-from-gl-master', 'FinanceAccountTransController@getGlTagFromGl');

/* -------- end journal transaction ----- */


/* -------- start contra transaction -------- */
  
  Route::get('/Transaction/Account/Contra-Trans', 'FinanceAccountTransController@ContraTrans');
  Route::get('/Transaction/Account/View-Contra-Trans', 'FinanceAccountTransController@ViewContraTrans');
  Route::get('/Transaction/Account/Edit-Contra-Trans/{compCode}/{fyCode}/{tranCode}/{seriesCode}/{vrNo}', 'FinanceAccountTransController@EditContraTrans');
  Route::get('/Transaction/Account/View-Contra-Trans-Success-Msg/{savedata}', 'FinanceAccountTransController@ContraSaveSuccessMsg');

  Route::post('/Transaction/Account/Save-Contra-Trans', 'FinanceAccountTransController@ContraTransSave');
  Route::post('/Transaction/Account/Delete-Contra-Trans', 'FinanceAccountTransController@DeleteContraTrans');
  Route::post('/Transaction/Account/Update-Contra-Trans', 'FinanceAccountTransController@UpdateContraTrans');


/* -------- end contra transaction -------- */

/* ------------ START : C AND F AJAX FUNCTION -------------*/
  
  Route::post('/get-all-itemList', 'CandFTrnasController@getItemlist');
  Route::post('/get-vehicle-details-against-vehicle', 'CandFTrnasController@getVehicleDetailsCf');
  Route::post('/get-trip-no-details-against-vehicle', 'CandFTrnasController@getTripDeatilsOfVehicle');
  Route::post('/get-trip-no-vehicle-no-in-gate-entry-cf', 'CandFTrnasController@getTripNoOrVehicleNo');
  Route::post('/get-all-do-details-against-field', 'CandFTrnasController@getAllDoDetailsAgainstField');
  Route::post('/get-details-for-vehicle-gate-outward', 'CandFTrnasController@GetDataForVehicleGetOutward');


/* ------------ END : C AND F AJAX FUNCTION -------------*/

/* ---------- start gate inward transaction candf ---------- */
  
  Route::get('/transaction/CandF/add-gate-inward-transaction-cf', 'CandFTrnasController@AddGateInwardCF');
  Route::get('/transaction/CandF/View-gate-inward-transaction-cf', 'CandFTrnasController@ViewGateInwardCF');
  Route::get('transaction/CandF/Edit-gate-inward-transaction-cf/{compCd}/{fyCd}/{tranCd}/{seriesCd}/{vrno}', 'CandFTrnasController@EditGateInwardCF');

  Route::post('/transaction/CandF/Save-gate-inward-transaction-cf', 'CandFTrnasController@SaveGateInwardCF');
  Route::post('/transaction/CandF/Update-gate-inward-transaction-cf', 'CandFTrnasController@UpdateGateInwardCF');
  Route::post('/transaction/CandF/delete-gate-inward-transaction-cf', 'CandFTrnasController@DeleteGateInwardCF');

  Route::get('/transaction/CandF/add-gate-outward-transaction-cf', 'CandFTrnasController@AddGateOutwardCF');
  Route::post('/transaction/CandF/Save-gate-outward-transaction-cf', 'CandFTrnasController@SaveGateOutwardCF');
  Route::post('/transaction/CandF/view-gate-outward-transaction-cf', 'CandFTrnasController@ViewGateOutwardCF');

  Route::get('/transaction/c-and-f/create-delivery-order', 'PurchaseTransController@createDeliveryOrder');
  Route::get('/transaction/c-and-f/view-create-delivery-order', 'PurchaseTransController@viewCreateDeliveryOrder');
  Route::get('/transaction/c-and-f/create-do/get-rake-data-from-rakeno', 'PurchaseTransController@getRakeData');

  Route::post('/transaction/c-and-f/create-do/get-trpt-data', 'PurchaseTransController@getTrptData');

  Route::post('/transaction/c-and-f/save-delivery-order-create', 'PurchaseTransController@saveCreateDeliveryOrder');



/* ---------- end gate inward transaction candf ---------- */

/* ----------- start inward transaction -------- */
  
  Route::get('/transaction/c-and-f/form-inward-trans', 'CandFTrnasController@InwardTrans');
  Route::get('/transaction/c-and-f/view-inward-trans', 'CandFTrnasController@viewInwardTrnas');
  Route::get('edit-form-inward-trans/{id}', 'CandFTrnasController@EditInwardTrans');
  Route::get('/candf/inward-tran/save-msg/{saveMsg}', 'CandFTrnasController@inward_trans_msgCf');

  Route::post('transaction/CandF/inward-trans-submit', 'CandFTrnasController@SaveInwardTrans');
  Route::post('delete-inward-trans', 'CandFTrnasController@DeleteInwardTrans');
  Route::post('update-inward-trans', 'CandFTrnasController@UpdateInwardTrans');

  Route::post('item-um-aum', 'CandFTrnasController@Item_UM_AUM');

   
   Route::post('get-truckno-details', 'LogisticController@TruckNoDetails');
   Route::post('get-vehicle-type', 'FinanaceLogisticController@VehicleTypeDetails');

   Route::post('get-vehicle-info-for-outward', 'FinanaceLogisticController@VehicleInfoForOutward');

   Route::post('get-wheelType-details', 'LogisticController@WheelTypeDetails');
   
   Route::post('get-diesel-rate-details', 'LogisticController@DieselRateDetails');

/* ----------- end inward transaction -------- */

/* --------- start outward transaction ---------*/
  
  Route::get('transaction/CandF/add-outward-trans', 'CAndFController@OutwardTrans');
  
  Route::get('transaction/CandF/view-outward-trans', 'FinanaceLogisticController@viewOutwardTrans');

  Route::get('edit-form-outward-trans/{id}', 'CandFTrnasController@EditOutwardTrans');

  Route::get('candf/outward-dispatch/save-msg/{saveData}', 'FinanaceLogisticController@outward_dispatch_msg');

  Route::post('outward-trans-submit', 'CandFTrnasController@SaveOutwardTrans');
  Route::post('delete-outward-trans', 'CandFTrnasController@DeleteOutwardTrans');
  Route::post('update-outward-trans', 'CandFTrnasController@UpdateOutwardTrans');

  Route::post('get-by-dpt-type', 'CandFTrnasController@Dpt_Type_Ajax');

/* --------- end outward transaction ---------*/

/* ---------- start create loading slip ------------ */
  
  Route::get('/transaction/candf/create-loading-slip', 'CandFTrnasController@AddCreateLoadingSlip');
  Route::get('candf/loading-slip/save-msg/{saveData}', 'CandFTrnasController@loadingSlip_msg');
  Route::get('transaction/candf/view-loading-slip', 'CandFTrnasController@ViewLoadingSlip');

  Route::post('transaction/CandF/loading-slip-submit', 'CandFTrnasController@SaveLoadingSlip');
  Route::post('transaction/CandF/outward-dispatch-submit', 'FinanaceLogisticController@SaveoOutwardDispatch');


/* ---------- end create loading slip ------------ */

/* ---------- start sap bill transaction --------- */
  
  Route::get('/form-sap-bill', 'CandFTrnasController@SapBill');
  Route::get('/view-sap-bill', 'CandFTrnasController@viewSapBill');
  Route::get('edit-form-sap-bil/{id}', 'CandFTrnasController@EditSapBill');

  Route::post('sap-bill-submit', 'CandFTrnasController@SaveSapBill');
  Route::post('delete-sap-bill', 'CandFTrnasController@DeleteSapBill');
  Route::post('update-sap-bill', 'CandFTrnasController@UpdateSapBill');

/* ---------- end sap bill transaction --------- */

/*START PLANT MASTER*/
 Route::post('form-excel-config-table-col','SettingController@ExcelTblCol');
 
 Route::get('/Master/Setting/Plant_Mast', 'SettingController@PlantMast');

 Route::get('/Master/Setting/View-Plant_Mast', 'SettingController@ViewPlantMast');

 Route::post('view-plant-mast-chield-basic-data', 'SettingController@PlantMasterChieldRTowData');

 Route::get('/Master/Setting/Edit-Plant_Mast/{compcd}/{pfctcd}/{plantcd}', 'SettingController@EditPlantMast');

 Route::get('/Master/Setting/view-plant-msg/{savedata}', 'SettingController@plant_msg');

Route::post('/Master/Setting/Delete-Plant_Mast', 'SettingController@DeletePlant');

Route::post('/Master/Setting/form-mast-plant-save', 'SettingController@PlantFormSave');

Route::post('/Master/Setting/form-mast-plant-save2', 'SettingController@PlantFormSave2');

Route::post('/Master/Setting/form-mast-plant-save3', 'SettingController@PlantFormSave3');

Route::post('/Master/Setting/form-mast-plant-update', 'SettingController@PlantFormUpdate');

 Route::post('help-plant-code-getdata', 'SettingController@HelpPlantCode_Get');
   
   Route::post('search-plant-code-get', 'SettingController@search_PlantCodeF');

/*END PLANT MASTER*/


Route::get('/change_password', 'MyAdminController@ChangePassword');
Route::post('/sendmailpassword', 'MyAdminController@sendMail');
Route::post('/resetpassword', 'MyAdminController@ResetPassword');
Route::get('/sendotpmail', 'MyAdminController@SendMailPassword');
Route::get('/change_password', 'MyAdminController@ChangePassword');
Route::post('/sendmailpassword', 'MyAdminController@sendMail');
Route::post('/resetpassword', 'MyAdminController@ResetPassword');
Route::get('/logout', 'MyAdminController@Logout');
Route::get('/useractivity', 'MyAdminController@UserInactivity');
Route::get('/resetactivity', 'MyAdminController@ResetPass');
Route::get('/check-compny', 'MyAdminController@CheckCompny');






/*----------- start : destinaton  form ----------*/



/*USER FORM*/

Route::get('/Master/Setting/User-Mast', 'SettingController@UserForm');

Route::get('/Master/Setting/View-User-Mast', 'SettingController@UserView');

Route::get('/Master/Setting/Edit-User-Mast/{id}','SettingController@EditUserForm');

Route::post('form-mast-user-save','SettingController@UserFormSave');

Route::post('form-mast-user-update', 'SettingController@UserFormUpdate');

Route::post('get-approve-user-details', 'SettingController@ApproveUsrDetails');

Route::post('get-user-profile-details', 'SettingController@UsrProfileDetails');

Route::post('get-copy-user-details', 'SettingController@CopyUserDetails');

/*USER FORM*/



Route::get('/master/setting/user-profie-right', 'SettingController@ProfileRights');

Route::get('/master/setting/view-user-profile-right', 'SettingController@UserViewRight');


 Route::post('/master/setting/view-child-user-profile-right', 'SettingController@UserViewRightChildRow');


Route::get('/Master/Setting/form-user-right', 'SettingController@UserRight');

Route::post('/Master/Setting/save-user-right-data', 'SettingController@UserRightSave');

Route::post('/Master/Setting/update-user_right_data', 'SettingController@UserRightUpdate');

Route::post('get-userright-getdata', 'SettingController@UserRightcheck');



Route::post('get-formName-getdata', 'SettingController@UserRightForm');

Route::post('get-formName-getdata-filter', 'SettingController@UserRightFormByFilter');

Route::post('get-listof-data-fromComp', 'SettingController@getDataFromComp');

Route::post('get-formName-getdata-update', 'SettingController@EditUserRightForm');


Route::get('/Master/Setting/view-user-right-msg/{savedata}', 'SettingController@user_right_msg');

Route::get('/Master/Setting/view-user-update-msg/{update}', 'SettingController@user_right_update_msg');

Route::post('get-userright-username', 'SettingController@Getusername');

Route::get('/update-user-access/{id}','SettingController@UpdateUserAccess');


Route::post('get-userview-getdata', 'SettingController@GetuserView');


Route::get('/Master/Setting/Fy-Mast','SettingController@FyForm');

Route::get('/Master/Setting/View-Fy-Mast','SettingController@FyView');

Route::get('/Master/Setting/Edit-Fy-Mast/{compcd}/{fycd}','SettingController@EditFyForm');


/*COMPANY MASTER*/

Route::get('/Master/Setting/Company-Mast', 'SettingController@CompanyForm');

Route::get('/Master/Setting/View-Company-Mast', 'SettingController@CompanyView');

Route::get('/Master/Setting/Edit-Company-Mast/{id}','SettingController@EditCompanyForm');

Route::post('form-mast-company-save','SettingController@CompanyFormSave');

Route::post('form-mast-company-update','SettingController@CompanyFormUpdate');

/*COMPANY MASTER*/

// MASTER REMARK

Route::get('/Master/Setting/Master-Remark', 'SettingController@MasterRemark');

Route::get('/Master/Setting/View-Master-Remark', 'SettingController@MasterRemarkView');

Route::get('/Master/Setting/Edit-Master-Remark/{id}','SettingController@EditMasterRemark');

Route::post('form-master-remark-save','SettingController@MasterRemarkSave');

Route::post('form-mast-remark-update','SettingController@MasterRemarkUpdate');

Route::post('/delete-master-remark','SettingController@MasterRemarkDelete');

Route::post('/Master/Setting/TCODEInformation','SettingController@TCodeInformation');

// END MASTER



Route::get('/form-mast-um', 'MasterController@UmForm');

Route::get('/view-mast-um', 'MasterController@UmView');

Route::get('/edit-um/{id}/{btnControl}','MasterController@EditUmForm');


Route::get('/form-mast-item', 'MasterController@ItemForm');

Route::get('/view-mast-item', 'MasterController@ItemView');

Route::get('/edit-item/{id}/{btnControl}','MasterController@EditItemForm');




Route::post('userData','MasterController@OutwardSerach');


Route::get('/outward-dispatch','ReportMisController@OutwardDespatchReport');

Route::post('/report/cash-bank-report/pdf', 'ReportMisController@CashBankReportPdf');


Route::post('/report/acc-ledger-report-pdf/pdf', 'ReportMisController@AccLedgerReportPdf');
Route::post('/report/acc-ledger-summary-report-pdf/pdf', 'ReportMisController@AccLedgerSummaryPdf');
Route::post('/report/acc-ledger-transaction-report-pdf/pdf', 'ReportMisController@AccLedgerTransPdf');
Route::post('/report/item-ledger-report-pdf/pdf', 'ReportMisController@ReportItemLedgerPdf');



Route::get('/profile','MasterController@Profile');




/*----------- END : destinaton form ----------*/

/*start transaction And report / mis*/














Route::get('/view-all-data-inward-trans/{id}', 'TransactionController@viewAllDataInwardTrans');






Route::resource('/rept-sap-despatch', 'ReportMisController');

Route::resource('/journal-trans-report', 'ReportMisController');

Route::get('/sales-trans-report', 'ReportMisController@ReportSalesTransList');

Route::get('/rept-sap-list', 'ReportMisController@ReportSapList');
Route::get('/rept-inward-sto-reg', 'ReportMisController@ReportInwardSto');

/*start transaction And report / mis*/

Route::get('/sap-stock', 'MyAdminController@sapStock');
Route::get('/actual-stock', 'MyAdminController@actualStock');

Route::get('/logistic/trpt-payment-advice', 'LogisticController@TrptPaymentAdvice');

Route::get('/trpt-payment', 'LogisticController@TrptPayment');









    /*------------------ end : get method ---------------------*/




    /*--------------------- start : post method --------------*/

Route::post('/check-username-pass', 'MyAdminController@checkUsrPass');

Route::post('login', 'MyAdminController@login');
Route::post('company-submit', 'MyAdminController@CompanySubmit');

Route::post('year-submit', 'MyAdminController@YearSubmit');


Route::post('form-mast-dealer-save', 'MasterController@DealerFormSave');
Route::post('form-mast-dealer-update', 'MasterController@DealerFormUpdate');



Route::post('delete-delaer', 'MasterController@DeleteDealer');

Route::post('delete-fleet', 'MasterController@DeleteFleet');

Route::post('delete-transport', 'MasterController@DeleteTransport');

Route::post('delete-user', 'SettingController@DeleteUser');

Route::post('delete-user-right', 'SettingController@DeleteUserRight');

Route::post('delete-fy', 'SettingController@DeleteFy');

Route::post('delete-company', 'SettingController@DeleteCompany');

Route::post('delete-um', 'MasterController@DeleteUm');



Route::post('delete-item', 'MasterController@DeleteItem');




Route::post('form-mast-transport-save', 'MasterController@TransportFormSave');

Route::post('form-mast-transport-update', 'MasterController@TransportFormUpdate');








Route::post('form-mast-fy-save', 'SettingController@FyFormSave');
Route::post('form-mast-fy-update', 'SettingController@FyFormUpdate');


Route::post('form-mast-um-save', 'MasterController@UmFormSave');
Route::post('form-mast-um-update', 'MasterController@UmFormUpdate');

Route::post('form-mast-item-save','MasterController@ItemFormSave');
Route::post('form-mast-item-update', 'MasterController@ItemFormUpdate');





/*transaction And report /mis*/








Route::post('sap-despatch-search', 'ReportMisController@SapDespatchAjax');

Route::post('sap-list-search', 'ReportMisController@SapListSearchAjax');

Route::post('inward-sto-reg-search', 'ReportMisController@InwardStoSearchAjax');

Route::post('get-detail-from-trans-in-item-ledger', 'ReportMisController@GetDataFromTransInItemLedger');

Route::post('get-detail-from-trans-in-acc-ledger', 'ReportMisController@GetDataFromTransInAccLedger');




Route::post('access-control-save','MasterController@accessControl');

Route::post('access-control-update','MasterController@accessUpdateControl');

Route::post('get-umaum-show-in-edit', 'TransactionController@Get_UmAum_Show_In_Edit');


Route::post('get_comp', 'MyAdminController@GetCompny');

Route::post('get_comp_login', 'MyAdminController@GetCompnyLogin');
Route::post('check-login-details', 'MyAdminController@ChkLoginDetails');




/*transaction And report /mis*/


Route::post('fetch-otwardrecord-for-view', 'TransactionController@outward_data_fetch');

Route::post('fetch-inwardrecord-for-view', 'TransactionController@inward_data_fetch');

Route::post('fetch-sapbill-for-view', 'TransactionController@sap_bill_fetch');

Route::post('search-depot', 'MasterController@search_depot');
Route::post('help-depot-code-getdata', 'MasterController@HelpDepotCodeSearch');



Route::post('search-company-code', 'MasterController@search_CompanyCode');
Route::post('help-company-code-getdata', 'MasterController@HelpCompanyCodeSearch');

Route::post('search-items-code', 'MasterController@search_ItemsCode');
Route::post('help-items-code-getdata', 'MasterController@HelpItemCodeSearch');

Route::post('search-account-code', 'MasterController@search_AccountCode');
Route::post('help-account-code-getdata', 'MasterController@HelpAccountCodeSearch');

Route::post('search-pfct-code', 'FinanceMasterController@search_PfctCode');
Route::post('help-pfct-code-getdata', 'FinanceMasterController@HelpPfctCodeSearch');






Route::post('search-fleet-truc-wheel-code', 'MasterController@search_fleettrcuk');
Route::post('help-wheel-code-getdata', 'MasterController@HelpFletTrcukSearch');

Route::post('search-vehicle-mfg-code', 'MasterController@search_VehicleMfg');
Route::post('help-vehicle-mfg-getdata', 'MasterController@HelVehicleMfgSearch');


Route::post('search-fy-code', 'MasterController@search_fy_code');

Route::post('help-fy-code-getdata', 'MasterController@HelpFyCodeSearch');


Route::post('search-um-code', 'MasterController@search_um_code');

Route::post('help-um-code-getdata', 'MasterController@HelpUmCodeSearch');

Route::post('search-truck-no', 'MasterController@search_truck_no');

Route::post('help-trcuk-no-getdata', 'MasterController@HelpTruckNoSearch');


Route::post('/finance/transaction-profit-center-name', 'TransactionController@ProfitCenterName');

Route::post('/Master/Employee/transaction-emp-designation', 'EmployeeMasterController@EmpDesignation');












      /*---------------end : post method-----------------*/



 /*-----*************** Start: Finance Section ****************-----*/


    /*--------- Start: Finance Get Method ------------*/



  /*APPROVE IND*/

  Route::get('/Master/Setting/Approved-Ind-Mast', 'SettingController@ApproveIndMaster');

  Route::get('/Master/Setting/View-Approved-Ind-Mast', 'SettingController@ViewApproveIndMast');
  
  Route::get('/Master/Setting/Edit-Approved-Ind-Mast/{id}', 'SettingController@EditApproveIndMast');

  Route::post('/form-approve-ind-mast-save', 'SettingController@SaveApproveIndMast');
  Route::post('/form-approve-ind-mast-update', 'SettingController@UpdateApproveIndMast');
  Route::post('/approve-ind-mast', 'SettingController@DeleteApproveIndMast');


  /*APPROVE IND*/


/*VR SEQUANCE */

 Route::get('/Master/Setting/Vr-Sequence', 'SettingController@VrSequence');

 Route::get('/vr-seq-comp-details','SettingController@VrseqcompDetails');

  Route::get('/Master/Setting/View-Vr-Sequence', 'SettingController@ViewVrSequence');

  Route::get('/Master/Setting/Edit-Vr-Sequence/{cmpcd}/{fycd}/{trnascd}/{seriescd}', 'SettingController@EditVrSequence');

  Route::post('/form-vr-sequence-save', 'SettingController@VrSequenceSave');
  Route::post('/delete-cr-sequence', 'SettingController@DeletevrSequence');
  Route::post('/form-vr-sequence-update', 'SettingController@VrSequenceUpdate');

 
  Route::get('/Master/Setting/New-Vr-Sequence', 'SettingController@NewVrSequence');

  Route::post('/Master/Setting/Save-New-Vr-Seq-No', 'SettingController@NewVrSequenceSave');


  Route::post('/Master/Setting/Save-New-Item-Bal', 'SettingController@NewItemBalSave');

  Route::post('/Master/Setting/Save-New-Gl-Bal', 'SettingController@NewItemGlSave');

  Route::post('/Master/Setting/Check-item-bal-data', 'SettingController@ItemBalCheckdata');

  Route::post('/Master/Setting/Check-Gl-bal-data', 'SettingController@GlBalCheckdata');

  Route::post('/Master/Setting/Check-Vr-Seq-data', 'SettingController@VrSeqCheckdata');

 /*VR SEQUANCE */

/* ------------ master chequebook ---------- */
  
  Route::get('/configration/Setting/add-chequeBook', 'SettingController@AddChequebook');
  Route::get('/configration/Setting/view-chequeBook', 'SettingController@ViewChequeBook');
  Route::get('/configration/Setting/edit-chequebook/{headId}/{bodyId}/{slNo}', 'SettingController@EditChequebook');
  
  Route::post('/configration/Setting/save-cheque-book-data', 'SettingController@SaveChequeBookData');
  Route::post('configration/Setting/chequebook-chield-data', 'SettingController@ChequebookChieldRTowData');
  Route::post('configration/Setting/update-chequebook-data', 'SettingController@UpdateChequebook');
  Route::post('configration/Setting/delete-chequebook-data', 'SettingController@DeleteChequebook');
 
/* ------------ master chequebook ---------- */

/* ------------ master chq lief config ---------- */
  
  Route::get('/configration/Setting/add-cheque-leaf-config', 'SettingController@AddChqLeafConfig');
  Route::get('/configration/Setting/view-cheque-leaf-config', 'SettingController@ViewChqLeafConfig');
  Route::get('/configration/Setting/edit-chq-leaf-config/{leafNo}', 'SettingController@EditChqLeafConfig');

  Route::post('configration/Setting/save-cheque-leaf-config', 'SettingController@SaveChqLeafConfig');
  Route::post('configration/Setting/delete-cheque-leaf-config', 'SettingController@DeleteChqLeafConfig');
  Route::post('configration/Setting/update-cheque-leaf-config', 'SettingController@UpdateChqLeafConfig');
  Route::post('configration/Setting/cheque-leaf-chield-data', 'SettingController@ChequeLeafChieldRTowData');

/* ------------ master chq lief config ---------- */

/* ------------ master offline cheque issue ---------- */
  
  Route::get('/configration/Setting/add-offline-cheque-issue', 'SettingController@AddOfflineChequeIssue');
  Route::get('/configration/Setting/view-offline-cheque-issue', 'SettingController@ViewOfflineChequeIssue');

  Route::post('configration/Setting/save-offline-cheque-issue', 'SettingController@SaveOfflineChequeIssue');

/* ------------ master offline cheque issue ---------- */

/* ------------ master cheque print ---------- */
  
  Route::get('/configration/Setting/add-cheque-print', 'SettingController@AddChequePrint');
  Route::get('/configration/Setting/printing-cheque/{updateChqNo}/{chqno}/{glCode}/{glName}/{accCode}/{accName}/{chqDate}/{cheLeafNo}/{amount}/{amInWord}', 'SettingController@printingCheque');

/* ------------ master cheque print ---------- */

 /*New Fy Year */

 Route::get('/Master/Setting/New-Fy-Year', 'SettingController@NewFyYear');

 Route::get('/Master/Setting/Edit-New-Fy-Year/{id}', 'SettingController@EditVrSequence');

 Route::post('form-mast-new-fy-save', 'SettingController@NewFyFormSave');

  Route::post('/form-vr-sequence-save', 'SettingController@VrSequenceSave');
  Route::post('/delete-cr-sequence', 'SettingController@DeletevrSequence');
  Route::post('/form-vr-sequence-update', 'SettingController@VrSequenceUpdate');

 

 /*New Fy Year */


  Route::post('/acc-code-for-cash-bank', 'FinanceAccountTransController@acc_code_for_cash_bank');
  Route::post('/account/cash-bank/bil-track-detail', 'FinanceAccountTransController@BillTrackDetail');
  Route::post('/account/cash-bank/update-biltrack', 'FinanceAccountTransController@SaveBillTrackOnCB');

  Route::post('/acc-code-for-contra', 'FinancePurchaseTransController@acc_code_for_contra');

 

  

  Route::post('/save-cash-bank-transaction', 'FinanceAccountTransController@SaveCashBankTransaction');

  Route::get('/finance/get-bill-data', 'FinanceAccountTransController@BillTrackAccountData');


  Route::get('/Master/Setting/Transaction-Mast', 'SettingController@TransactionMaster');

  Route::get('/Master/Setting/View-Transaction-Mast', 'SettingController@ViewTransactionMast');


  Route::get('/Master/Setting/Edit-Transaction-Mast/{id}', 'SettingController@EditTransactionMast');



  Route::get('/Master/Setting/Profit-Center-Mast', 'SettingController@ProfitCenterMaster');

  
  Route::get('/Master/Setting/View-Profit-Center-Mast', 'SettingController@ViewProfitCenterMast');


  Route::get('/Master/Setting/Edit-Profit-Center-Mast/{id}/{cmpCd}', 'SettingController@EditProfitCenterMast');



  Route::get('/Master/Setting/Edit-Config-Mast/{compCd}/{tranCd}/{seriesCd}', 'SettingController@EditConfigMast');


  Route::get('/Master/Setting/Config-Mast', 'SettingController@ConfigMaster');

  Route::get('/Master/Setting/View-Config-Mast', 'SettingController@ViewConfigMast');





   Route::get('/finance/view-sales_order-msg/{savedata}', 'FinanceMasterController@sales_order_msg');

  

  Route::get('/finance/view-plant-msg-update/{updatedata}', 'FinanceMasterController@plant_msg_update');

  Route::get('/finance/edit-rack/{id}', 'FinanceMasterController@EditRackMast');

  Route::get('/Master/Item/edit-item-rack/{id}/{rackcd}', 'ItemController@EditItemRackMast');

  Route::get('finance/edit-acc-bal/{id}/{btnControl}', 'FinanceMasterController@EditAccBalMast');

  Route::get('/finance/form-mast-rack', 'FinanceMasterController@RackMast');

  Route::get('/finance/view-mast-rack', 'FinanceMasterController@ViewRackMast');

  Route::get('/finance/house-bank-mast', 'FinanceMasterController@HouseBankMast');

  Route::get('/finance/view-house-bank-mast', 'FinanceMasterController@ViewHouseBankMast');

  Route::get('/finance/acc-bal-mast','FinanceMasterController@AccBalMast');

  Route::get('/finance/view-acc-bal-mast', 'FinanceMasterController@ViewAccBalMast');

  Route::get('/finance/transaction/cash_bank_transaction', 'FinanceMasterController@CashBankTransaction');

  Route::get('/view-cash-bank-success-msg/{savedata}', 'FinanceAccountTransController@cashbank_success_msg');

  Route::get('/finance/view-cash-bank', 'FinanceAccountTransController@ViewBankCashMast');

  Route::get('/finance/transaction/cash-bank-transaction', 'FinanceAccountTransController@CashBankTransaction');

  Route::get('/view-cash-bank-updated-success-msg/{savedata}', 'FinanceAccountTransController@cashbank_update_success_msg');

  Route::get('/finance/edit-cash-bank/{id}/{updtef}', 'FinanceAccountTransController@EditCashBank');

  Route::post('glkey-by-amounttype', 'FinanceAccountTransController@get_glKeyForJournl_data');

  Route::get('/finance/transaction/sales-order-transaction', 'FinanceSaleController@SalesOrderTransaction');

  Route::post('get_sale_order_by_approval_sale', 'FinanceSaleController@GetSaleOrdForApp');

  Route::post('change-status-sale-order', 'FinanceSaleController@StatusSaleOrder');

  Route::post('/reject-approve-sale-order', 'FinanceSaleController@RejectSaleOrder');

  Route::post('/delete-multiple-data-journal', 'FinanceAccountTransController@DeleteJournalMultiple');

  Route::get('/finance/form-um-master', 'FinanceMasterController@UmFormMaster');

  Route::get('/finance/view-um-master', 'FinanceMasterController@UmViewMaster');

  Route::get('/finance/edit-um-master/{id}','FinanceMasterController@EditUmFormMaster');

  Route::get('/transaction/sales/view-sales-transaction', 'FinanceSaleController@ViewSalesTransaction');

  Route::get('/report-cash-bank','ReportMisController@ReportcashBank');

  Route::get('/report-statement-of-acc','ReportMisController@ReportstatementofAcc');

  Route::get('/report-contra','ReportMisController@ReportContra');

  Route::get('/report-acc-ledger','ReportMisController@ReportAccLedger');

  Route::get('/transaction-report-acc-ledger','ReportMisController@TransReportAccLedger');
  
  Route::get('/transaction-report-acc-ledger-crm','FinanceCRMController@TransReportAccLedgerCrm');

  Route::get('/summary-report-acc-ledger','ReportMisController@SummaryReportAccLedger');

  Route::get('/summary-report-acc-ledger-crm','FinanceCRMController@SummaryReportAccLedger');

  Route::get('/report-item-ledger','ReportMisController@ReportItemLedger');

  Route::get('/report-item-stock','ReportMisController@ReportItemStock');
    
  Route::get('/report-trial-balence','ReportMisController@ReportTrialBal');

  Route::get('/finance/payment-advice', 'FinanceAccountTransController@paymentAdvice');

  Route::post('/get-a-field-by-contract-trans-code', 'FinancePurchaseTransController@AfieldCalculationGetContract');

    Route::post('/get-a-field-by-quation-trans-code', 'FinancePurchaseTransController@AfieldCalculationGetquation');

    

    Route::post('get_contract_by_approval_purchase', 'PurchaseTransController@GetPurchaseContractForApp');

    Route::post('/reject-approve-purchase-contract', 'PurchaseTransController@RejectPurchaseContract');


    Route::post('change-status-purchase-contract', 'PurchaseTransController@StatusPurchaseContract');

    

    /*--------- End: Finance Get Method ------------*/





    /*--------- Start: Finance Post Method ------------*/



  Route::post('/form-tax-save', 'FinanceMasterController@SaveTax');
  Route::post('/delete-tax', 'FinanceMasterController@DeleteTax');
  Route::post('/form-tax-update', 'FinanceMasterController@UpdateTax');


  Route::post('/form-party-mast-save', 'FinanceMasterController@PartyMastSave');
  Route::post('delete-party-finance-mast', 'CustomerController@DeletePartyFinance');

  Route::post('/form-party-finance-update', 'FinanceMasterController@UpdatePartyFinance');



 


  Route::post('fy-year-by-comp-code', 'FinanceMasterController@get_fy_year');
  Route::post('series-code-by-comp-code', 'FinanceMasterController@get_series_code');


   Route::post('/finance/form-mast-transaction-save', 'SettingController@TransactionFormSave');


  Route::post('/finance/form-mast-transaction-update', 'SettingController@TransactionFormUpdate');


  Route::post('/finance/form-profit-center-save', 'SettingController@ProfitCenterFormSave');

  Route::post('/finance/form-profit-center-update', 'SettingController@ProfitCenterFormUpdate');


  Route::post('delete-pfct', 'SettingController@DeleteProfitCt');
  Route::post('delete-transaction', 'SettingController@DeleteTransaction');
  

  

   



  Route::post('/finance/delete-config', 'SettingController@DeleteConfig');

 

  Route::post('/finance/delete-rack', 'FinanceMasterController@DeleteRack');

  

 

  Route::post('/finance/delete-acc-bal', 'FinanceMasterController@DeleteAccBal');


  Route::post('/check-post-code-yes-no', 'FinanceMasterController@CheckAutoPostInTrnas');
  
  Route::post('/finance/form-mast-config-save', 'SettingController@ConfigFormSave');
  
  Route::post('/finance/form-mast-config-update', 'SettingController@ConfigFormUpdate');


   Route::post('/finance/form-mast-rack-save', 'FinanceMasterController@RackFormSave');

   Route::post('/finance/form-mast-rack-update', 'FinanceMasterController@RackFormUpdate');


   Route::post('/form-mast-house-bank-save', 'FinanceMasterController@HouseBankFormSave');
   
   Route::post('/finance/form-mast-plant-save2', 'FinanceMasterController@HouseBankFormSave2');

    Route::post('/finance/form-mast-house-bank-update', 'FinanceMasterController@HouseBankFormUpdate');

   

   Route::post('/finance/get_tranhead', 'FinanceMasterController@GetTranHead');


    Route::post('/finance/form-acc-bal-save', 'FinanceMasterController@AccBalFormSave');

   Route::post('/finance/form-mast-acc-bal-update', 'FinanceMasterController@AccBalFormUpdate');




   Route::post('/finance/form-mast-cash-bank-save', 'FinanceMasterController@CashBankFormSave');

   Route::post('/finance/form-mast-cash-bank-update', 'FinanceAccountTransController@CashBankFormUpdate');


   Route::post('get-checkItemC-AccC', 'FinancePurchaseTransController@checkItemC_AccC');

   Route::post('gl_code_by_series_code', 'FinanceMasterController@get_gl_data');

   Route::post('pfct_name-by-pfct-code', 'FinanceMasterController@get_pfct_data');
   Route::post('bank_name-by-bank-code', 'FinanceMasterController@get_bank_data');
   Route::post('gl-code-by-gl-key', 'FinanceMasterController@get_gl_code_data');
   Route::post('acc-name-by-acc-code', 'FinanceMasterController@get_acc_code_data');
   Route::post('cost-name-by-cost-code', 'FinanceMasterController@get_cost_code_data');

   Route::post('help-gl-code-getdata', 'FinanceMasterController@HelpGlCodeSearch');
   Route::post('help-acc-code-getdata', 'FinanceMasterController@HelpAccCodeSearch');

   Route::post('/finance/delete-cash-bank', 'FinanceAccountTransController@DeleteCashBank');





   Route::post('help-glmast-code-getdata', 'FinanceMasterController@HelpGlMastCodeHelp');
   Route::post('search-glcode-oninput', 'FinanceMasterController@search_glCd');


   Route::post('help-seriescode-code-getdata', 'FinanceMasterController@HelpSeriesCodeHelp');
   Route::post('search-series-oninput', 'FinanceMasterController@search_serieCode');

   


   Route::post('help-transaction-code-getdata', 'FinanceMasterController@HelptransactionSearch');
   Route::post('search-transactn-oninput', 'FinanceMasterController@search_TransactionCode');


   




  


   Route::post('help-rackcode-getdata', 'FinanceMasterController@HelpRackCodeGet');
   Route::post('serach-rack-code-getdata', 'FinanceMasterController@search_RackCode');



   


   




   









   Route::post('help-Acc-code-getdataforfinance', 'FinanceMasterController@HelpAccCode_Get');
   Route::post('search-Acc-code-get', 'FinanceMasterController@search_AccCode');

   




   Route::post('get-tds-name-n-code', 'FinanceMasterController@GetTdsCodeNameBySectn');

   Route::post('/item-code-for-sale-tran', 'FinanceMasterController@item_code_for_sale_tran');
   


   

   Route::post('/get-series-master-data', 'FinancePurchaseTransController@getSeriesData');

   
 
   Route::post('/get-a-field-calc-for-sale-bill', 'FinanceSaleController@AfieldCalForSaleBill');
   

   Route::post('/get-a-field-calc-for-mul-purchase-bill', 'FinancePurchaseTransController@AfieldCalCForMulPurBill');

   Route::post('/get-a-field-by-trans-code-qtnno-order', 'FinancePurchaseTransController@AfieldCalculationGetOrder');

   

   

   
   Route::post('/get-taxdetail-by-tax-code', 'FinancePurchaseTransController@GetTaxDetailByTaxCode');

   Route::post('/get-plant-code-name', 'FinanceMasterController@Plant_code_by_pfct');



   Route::post('/get-pfct-code-name-by-plant-indend', 'FinanceMasterController@pfct_by_plant_in_indend');

   Route::post('/get-series-data-by-series-code', 'FinanceMasterController@get_seriscode_data');

   

   Route::post('/get-acc-data-by-acc-code', 'FinanceMasterController@get_AccCode_data');

   Route::post('/get-acc-data-by-acc-code-cash-bank', 'FinanceAccountTransController@get_AccCode_data');
   
   

   Route::post('/get-pfct-quotn-by-plantcode', 'FinanceMasterController@pfct_quotn_by_plantcode');

   


   Route::post('/get-item-by-condition-in-add-more-contract', 'FinanceMasterController@GetItmBYConditnInAddMoreContract');

   Route::post('/get-item-by-condition-in-add-more-purchase-order', 'FinancePurchaseTransController@GetItmBYConditnInAddMorePurOrder');

   Route::post('/get-item-by-condition-in-add-more-grn', 'FinancePurchaseTransController@GetItmBYConditnInAddMoreGRN');

   

   




  Route::post('search-items-code-for-finance', 'FinanceMasterController@search_ItemsCodeFinance');
  Route::post('help-items-code-getdata-finance', 'FinanceMasterController@HelpItemCodeSearchFinance');

  Route::post('search-hsn-for-item', 'FinanceMasterController@search_hsn_for_item');
  Route::post('help-hsn-code-getdata', 'FinanceMasterController@HelpHsnCodeSearch');


  Route::post('finance/delete-um-master', 'FinanceMasterController@DeleteUmMaster');
  Route::post('finance/form-um-master-save', 'FinanceMasterController@UmFormSaveMaster');
  Route::post('finance/form-um-master-update', 'FinanceMasterController@UmFormUpdateMaster');

  



  



  Route::post('get-sale-contract-vrno-by-acc', 'FinanceSaleController@GetSaleContractVrnoByAcc');

  Route::post('get-itmdata-for-sale-contract', 'FinanceSaleController@GetItemBysaleContract');

  Route::post('get-a-field-calculation-by-tax-in-sale-order', 'FinanceSaleController@AfieldCalculationSaleOrder');
  
  Route::post('get-quo-parameter-for-sale-order', 'FinanceSaleController@GetQtyParaFrmSaleContractByItm');

  



  Route::post('get-item-by-acc-code', 'FinanceSaleController@ItmByAccountCode');
  
  Route::post('get-item-by-qty', 'FinanceSaleController@GetQtyByitem');

  Route::post('finance/save-sales-transaction', 'FinanceSaleController@SaveSalesTrans');

  Route::post('get-item-by-acc-code-purchase', 'FinancePurchaseTransController@ItmByAccountCodePurchas');

  Route::post('get-item-by-qty-purchase', 'FinancePurchaseTransController@GetQtyByitemPurchase');

 

  

  Route::post('finance/save-sale-transaction', 'FinanceSaleController@SaveSaleTrans');

  Route::post('finance/save-multiple-purchase-bil-transaction', 'FinancePurchaseTransController@SaveMultiPurchaseTrans');

  Route::post('get-payment-advice-on-cash-bank', 'FinanceAccountTransController@selectPayAdviceOnCashBank');


   Route::post('get-data-by-acc-code-for-pay-advice', 'FinanceAccountTransController@GetDataByAccCodeForPayAd');

    Route::post('save-payment-advice-perchase-order', 'FinanceAccountTransController@SavePaymentAdvicePayOrder');

    

    Route::post('get_quatation_by_approval_purchase', 'PurchaseTransController@GetPurchaseQuatationForApp');

     Route::post('get-qp-for-purchase-indent-edit', 'FinancePurchaseTransController@GetQPForPurchaseIndentEdit');

   

    Route::post('view-purchase-quatation-chield-row-data', 'PurchaseTransController@PurchasequotationChieldRTowData');

    Route::get('/finance/edit-purchase-quotation/{headid}/{bodyid}/{vrno}', 'FinancePurchaseTransController@EditQuatationPurchase');

    Route::post('finance/update-perchase-quotation-trans', 'FinancePurchaseTransController@UpdatePuchaseQuotation');

    Route::post('change-status-purchase-quatation', 'PurchaseTransController@StatusPurchaseQuatation');


    Route::post('/reject-approve-purchase-quatation', 'PurchaseTransController@RejectPurchaseQuatation');

    Route::post('get_advice_by_payment_advice', 'FinanceAccountTransController@GetAdvicByAccCode');

    Route::get('view-payment-advice','FinanceAccountTransController@ViewPaymentAdvice');

    Route::get('finance/view-payment-msg/{savedata}', 'FinanceAccountTransController@payment_advice_msg');
    Route::get('finance/journal_tran_msg/{savedata}', 'FinanceAccountTransController@journal_tran_msg');


    Route::post('get-data-from-acc-ledger-for-pay-advice', 'FinanceAccountTransController@GetByAccFromAccLegderForPayAdvice');

    /*Route::get('finance/transaction/purchase-order-approval', 'FinanceMasterController@PurchaseOrderApproval');*/


    Route::post('change-status-purchase-order', 'PurchaseTransController@StatusPurchase');
    
    Route::post('get_order_by_approval_purchase', 'PurchaseTransController@GetPurchaseOrdForApp');

    Route::get('/finance/user-approval-list/{userid}', 'PurchaseTransController@UserApprovalList');


    Route::post('get_bill_by_approval_purchase', 'PurchaseTransController@GetPurchaseBillForApp');

    Route::post('change-status-purchase-bill', 'PurchaseTransController@StatusPurchaseBill');

    


    

    


    

    


    

   

    Route::get('/transaction/sales/edit-sale-quotation/{headid}/{bodyid}/{vrno}', 'FinanceSaleController@EditSaleQuotation');

    Route::get('/finance/transaction/edit-purchase-enquiry/{headid}/{bodyid}/{vrno}', 'FinancePurchaseTransController@EditEnquiryPurchase');

    Route::get('/finance/transaction/edit-purchase-grn/{headid}/{bodyid}/{vrno}', 'FinancePurchaseTransController@EditGoodRNoteTransaction');

    Route::post('change-status-purchase-indent', 'PurchaseTransController@StatusPurchaseIndent');

    Route::post('/reject-approve-purchase-indent', 'PurchaseTransController@RejectPurchaseIndent');

    

    Route::post('get_indent_by_approval_purchase', 'PurchaseTransController@GetPurchaseIndentForApp');


    Route::post('/finance/get-quality-parameter-by-item-update', 'FinancePurchaseTransController@GetQualityParameterUpdate');

    Route::post('/finance/get-quality-parameter-by-purchase-enquery-report', 'FinancePurchaseTransController@GetQualityParameterByPurchaseEnquiry');


    Route::post('/finance/get-quality-parameter-by-item', 'FinanacePurchaseReportController@GetQualityParameter');


    Route::post('/finance/getqua-parameter-by-item', 'CommonFunction@GetQualityParameter');
    
    Route::post('/finance/get-post-code-by-account-code', 'CommonFunction@get_postCodeByAcc');

    Route::post('/finance/get-post-code-by-vehicle', 'CommonFunction@get_postCodeByAccVehicle');
  

  Route::post('/get-account-by-enquiry-num', 'FinancePurchaseTransController@GetAccountByEnquiry');


  /*Route::post('/get-item-by-billno', 'FinanceMasterController@GetItemByBillNo');*/
  
  Route::post('/get-itmdata-by-sale-vrno', 'FinanceSaleController@GetItemBysaleQc');


  Route::post('/get-data-from-so-fro-sale-bill', 'FinanceSaleController@GetDataFrmSoForSaleBill');

  Route::post('/get-data-from-pur-ordr-for-multi-pur-bill', 'FinancePurchaseTransController@GetDataFrmPurOrdrForMultPurBill');









  Route::post('/reject-approve-purchase-order', 'PurchaseTransController@RejectPurchaseOrder');

  Route::get('/finance/reject-purchase-order-msg/{savedata}', 'PurchaseTransController@purchase_reject_msg');

  Route::get('finance/transaction/purchase-order-approval', 'PurchaseTransController@PurchaseOrderApproval');

  Route::post('/reject-approve-purchase-bill', 'PurchaseTransController@RejectPurchaseBill');

  Route::post('get-data-quotn-slno-by-quotn-no', 'FinancePurchaseTransController@GetDataByQuoationNo');

    /*--------- End: Finance Post Method ------------*/


 

 Route::get('finance/transaction/view-purchase-transaction-invoice/{savedata}/{headid}/{bodyid}', 'FinancePurchaseTransController@PurchaseTransInvoce');


  Route::post('get-acc-code-address', 'FinanceMasterController@address_by_accCode');

  

 

  

  Route::post('get-qty-parameter-frm-purchase-order-by-itm', 'FinancePurchaseTransController@GetQtyParametrFrmPurchaseOrdrByItm');
  

 

  Route::post('get-qty-parameter-frm-sale-order-by-itm', 'FinanceSaleController@GetQPFrmSaleOByItm');

  Route::post('get-qty-param-frm-pur-order-by-itm', 'FinancePurchaseTransController@GetQtyParamFrmpurordrByItm');

  

 

  Route::post('get-vendor-for-enquiry', 'PurchaseTransController@GetVenderDataFrEnqyiry');
  

  Route::get('/finance/justcheck', 'FinanceMasterController@justcheck');

  

 /*-----******** End: Finance Section ************-----*/


/* ------- start item master ------*/
  
  Route::get('/Master/Item/Item-Mast', 'FinanceMasterController@AddItem');
  Route::get('/Master/Item/View-Item-Mast', 'FinanceMasterController@ViewItem');
  Route::get('/Master/Item/Edit-Item/{id}', 'FinanceMasterController@EditItem');

  Route::post('/Master/Item/Item-Save', 'FinanceMasterController@ItemSave');
  Route::post('/Master/Item/Item-Update', 'FinanceMasterController@ItemUpdate');
  Route::post('/Master/Item/Delete-Item', 'FinanceMasterController@DeleteItem');

/* ------- end item master ------*/



 /*-----******** Start: STORE SECTION ************-----*/





  /*-----***** Start: POST METHOD ******-----*/

  

  

 

  Route::post('/get-sale-order-no-by-acc-in-sale-bill', 'FinanceSaleController@GetSaleOrderNoByAccInSaleBill');
  
  Route::post('/get-soetail-by-so-vrno', 'FinanceSaleController@GetsoDetailsBySoVrno');

 

  Route::post('/get-pur-ordr-no-by-acc-in-mul-purchase-bill', 'FinancePurchaseTransController@GetPurOrdrNoByAccInMulPurBill');

 

  

  
  /*-----***** END: POST METHOD ******-----*/


  /*-----***** Start: GET METHOD ******-----*/


 

  /* Route::get('/finance/transaction/store/view-store-return', 'FinanaceStoreController@ViewStoreReturn');*/

  

  /*-----***** END: GET METHOD ******-----*/


 /*-----******** End: STORE SECTION ************-----*/

 /*-----********START:PRODUCTION SECTION************-----*/

 Route::get('/Transaction/Production/BOM', 'ProductionController@AddProduction');

 Route::get('/Transaction/Production/view-BOM', 'ProductionController@ViewProduction');

 Route::post('/view-production-chield-row-data', 'ProductionController@ViewChildProduction');

 Route::post('/finance/save-production-transaction', 'ProductionController@SaveProduction');

 Route::get('/Transaction/Production/daily-production', 'ProductionController@AddDailyProduction');

  Route::post('/get-item-from-bom-by-fg-code', 'ProductionController@GetItmFrmBom');

  Route::post('/finance/save-daily-production-transaction', 'ProductionController@SaveDailyProduction');

  Route::get('/Transaction/Production/view-daily-production', 'ProductionController@ViewDailyProduction');

  Route::post('/view-daily-production-chield-row-data', 'ProductionController@ViewChildDailyProduction');


  Route::post('/get-item-from-bom-by-bomno', 'ProductionController@GetitemByBomNum');

  Route::post('/get-itmdata-by-bill-of-material', 'ProductionController@GetitemByBom');


  Route::get('/Transaction/Production/wo-production', 'ProductionController@AddWoProduction');

 Route::get('/Transaction/Production/view-wo-production', 'ProductionController@ViewWoProduction');

 Route::post('/view-wo-production-chield-row-data', 'ProductionController@ViewChildWoProduction');

 Route::post('/get-item-from-dp-by-acc-code', 'ProductionController@GetItmFrmDailyProd');

 Route::post('/finance/save-wo-production-transaction', 'ProductionController@SaveWoProduction');


 Route::get('/finance/transaction/purchasebillpdf', 'ProductionController@PurchaseBillPdf');

  Route::post('/conavert-amt-into-word', 'ProductionController@convert_number_to_words');
  
  Route::post('/get-simulation-data-for-sdaily-production', 'ProductionController@SimulationForDailyProd');

 /*-----******** End: PRODUCTION SECTION ************-----*/



 /*-----***** Start: Finance Report Section *****-----*/


    /*-----**** START: REPORT GET METHOD ****-----*/


    Route::get('/report/purchase/purchase-indent/purchase-indent-report', 'FinanacePurchaseReportController@PurchaseIndentReport');

    Route::get('/report/purchase/purchase-indent/purchase-indent-report-excel/{vrnum}/{item_code}/{plantCodeOperator}/{plantCodeValue}/{seriesCodeOperator}/{seriesCodeValue}/{profitCenterOperator}/{profitCenterValue}/{departmentOperator}/{departmentValue}/{employeeOperator}/{employeeValue}/{QtyOperator}/{QtyValue}/{from_date}/{to_date}/{ReportTypes}', 'FinanacePurchaseReportController@PurchaseIndentReportExcel');

    Route::get('/report/purchase/purchase-indent/purchase-enquery-report-excel/{from_date}/{to_date}/{item_code}/{vr_num}/{plantCodeOperator}/{plantCodeValue}/{seriesCodeOperator}/{seriesCodeValue}/{profitCenterOperator}/{profitCenterValue}/{accCodeOperator}/{accCodeValue}/{QtyOperator}/{QtyValue}', 'FinanacePurchaseReportController@PurchaseEnqueryReportExcel');

    Route::get('/report/purchase/purchase-quotation/purchase-quotation-report-excel/{item_code}/{acct_code}/{plantCodeOperator}/{plantCodeValue}/{seriesCodeOperator}/{seriesCodeValue}/{profitCenterOperator}/{profitCenterValue}/{accCodeOperator}/{accCode}/{QtyOperator}/{QtyValue}/{from_date}/{to_date}/{ReportTypes}/{type}', 'FinanacePurchaseReportController@PurchaseQuotationReportExcel');

    Route::get('/report/purchase/purchase-quotation-monthly/purchase-quotation-monthly-report', 'FinanacePurchaseReportController@PurchaseQuotationMonthlyReport');

    Route::get('/report/purchase/purchase-contract-monthly/purchase-contract-monthly-report', 'FinanacePurchaseReportController@PurchaseContractMonthlyReport');

    Route::get('/report/purchase/purchase-order-monthly/purchase-order-monthly-report', 'FinanacePurchaseReportController@PurchaseOrderMonthlyReport');


    Route::get('/report/purchase/purchase-grn-monthly/purchase-grn-monthly-report', 'FinanacePurchaseReportController@PurchaseGrnMonthlyReport');

    Route::get('/report/purchase/purchase-bill-monthly/purchase-bill-monthly-report', 'FinanacePurchaseReportController@PurchaseBillMonthlyReport');

    Route::get('/get-data-from-query-monthly-purchase-quotation', 'FinanacePurchaseReportController@getDataMonthlyPurchaseQuotation');

    Route::get('/report/purchase/purchase-monthly-quatation/purchase-monthly-quatation-excel/{from_date}/{to_date}/{code}', 'FinanacePurchaseReportController@PurchaseQuotationMonthlyExcel');


    Route::get('/report/purchase/purchase-monthly-contract/purchase-monthly-contract-excel/{from_date}/{to_date}/{code}', 'FinanacePurchaseReportController@PurchaseContractMonthlyExcel');


    Route::get('/report/purchase/purchase-monthly-order/purchase-monthly-order-excel/{from_date}/{to_date}/{code}', 'FinanacePurchaseReportController@PurchaseOrderMonthlyExcel');

    Route::get('/report/purchase/purchase-monthly-grn/purchase-monthly-grn-excel/{from_date}/{to_date}/{code}', 'FinanacePurchaseReportController@PurchaseOrderMonthlyExcel');



    Route::get('/get-data-from-query-monthly-purchase-contract', 'FinanacePurchaseReportController@getDataMonthlyPurchaseContract');

    Route::get('/get-data-from-query-monthly-purchase-order', 'FinanacePurchaseReportController@getDataMonthlyPurchaseOrder');

    Route::get('/get-data-from-query-monthly-purchase-grn', 'FinanacePurchaseReportController@getDataMonthlyPurchaseGrn');

    Route::get('/get-data-from-query-monthly-purchase-bill', 'FinanacePurchaseReportController@getDataMonthlyPurchaseBill');


    Route::get('/report/sale/sale-enquiry/sale-enquiry-report-excel/{item_code}/{vr_num}/{plantCodeOperator}/{plantCodeValue}/{seriesCodeOperator}/{seriesCodeValue}/{profitCenterOperator}/{profitCenterValue}/{QtyOperator}/{QtyValue}/{from_date}/{to_date}/{ReportTypes}/{type}', 'FinanaceSaleReportController@SaleEnquiryReportExcel');


    Route::get('/report/sale/sale-quotation/sale-quotation-report-excel/{item_code}/{vr_num}/{plantCodeOperator}/{plantCodeValue}/{seriesCodeOperator}/{seriesCodeValue}/{profitCenterOperator}/{profitCenterValue}/{accCodeOperator}/{accCode}/{QtyOperator}/{QtyValue}/{from_date}/{to_date}/{ReportTypes}/{type}', 'FinanaceSaleReportController@SaleQuotationReportExcel');

     Route::get('/report/sale/sale-monthly-quotation/sale-monthly-quotation-report-excel/{item_code}/{acc_code}/{from_date}/{to_date}', 'FinanaceSaleReportController@SaleQuotationMonthlyReportExcel');

    Route::get('/report/sale/sale-monthly-quotation/sale-monthly-quotation-excel/{from_date}/{to_date}/{code}', 'FinanaceSaleReportController@SaleQuotationMonthlyExcel');


    Route::get('/report/sale/sale-monthly-contract/sale-monthly-contract-excel/{from_date}/{to_date}/{code}', 'FinanaceSaleReportController@SaleContractMonthlyExcel');

     Route::get('/report/sale/sale-monthly-order/sale-monthly-order-excel/{from_date}/{to_date}/{code}', 'FinanaceSaleReportController@SaleOrderMonthlyExcel');

      Route::get('/report/sale/sale-monthly-challan/sale-monthly-challan-excel/{from_date}/{to_date}/{code}', 'FinanaceSaleReportController@SaleChallanMonthlyExcel');

      Route::get('/report/sale/sale-monthly-bill/sale-monthly-bill-excel/{from_date}/{to_date}/{code}', 'FinanaceSaleReportController@SaleBillMonthlyExcel');


    Route::get('/report/sale/sale-contract/sale-contract-report-excel/{item_code}/{vr_num}/{plantCodeOperator}/{plantCodeValue}/{seriesCodeOperator}/{seriesCodeValue}/{profitCenterOperator}/{profitCenterValue}/{accCodeOperator}/{accCode}/{QtyOperator}/{QtyValue}/{from_date}/{to_date}/{ReportTypes}/{type}', 'FinanaceSaleReportController@SaleContractReportExcel');


    Route::get('/report/sale/sale-order/sale-order-report-excel/{item_code}/{vr_num}/{plantCodeOperator}/{plantCodeValue}/{seriesCodeOperator}/{seriesCodeValue}/{profitCenterOperator}/{profitCenterValue}/{accCodeOperator}/{accCode}/{QtyOperator}/{QtyValue}/{from_date}/{to_date}/{ReportTypes}/{type}', 'FinanaceSaleReportController@SaleOrderReportExcel');

     Route::get('/report/sale/sale-bill/sale-bill-report-excel/{item_code}/{vr_num}/{plantCodeOperator}/{plantCodeValue}/{seriesCodeOperator}/{seriesCodeValue}/{profitCenterOperator}/{profitCenterValue}/{accCodeOperator}/{accCode}/{QtyOperator}/{QtyValue}/{from_date}/{to_date}/{type}', 'FinanaceSaleReportController@SaleBillReportExcel');

     Route::get('/report/sale/sale-challan/sale-challan-report-excel/{item_code}/{vr_num}/{plantCodeOperator}/{plantCodeValue}/{seriesCodeOperator}/{seriesCodeValue}/{profitCenterOperator}/{profitCenterValue}/{accCodeOperator}/{accCode}/{QtyOperator}/{QtyValue}/{from_date}/{to_date}/{ReportTypes}/{type}', 'FinanaceSaleReportController@SaleChallanReportExcel');


    Route::get('/report/purchase/purchase-contract/purchase-contract-report-excel/{from_date}/{to_date}/{vrn}/{item_code}/{seriesCodeOperator}/{seriesCodeValue}/{plantCodeOperator}/{plantCodeValue}/{profitCenterOperator}/{profitCenterValue}/{accCodeOperator}/{accCode}/{costCetOperator}/{costCetCode}/{QtyOperator}/{QtyValue}/{ReportTypes}/{type}', 'FinanacePurchaseReportController@PurchaseContractReportExcel');

    Route::get('/report/purchase/purchase-order/purchase-order-report-excel/{from_date}/{to_date}/{vrn}/{item_code}/{seriesCodeOperator}/{seriesCodeValue}/{plantCodeOperator}/{plantCodeValue}/{profitCenterOperator}/{profitCenterValue}/{accCodeOperator}/{accCode}/{costCetOperator}/{costCetCode}/{QtyOperator}/{QtyValue}/{ReportTypes}/{type}', 'FinanacePurchaseReportController@PurchaseOrderReportExcel');

    Route::get('/report/purchase/purchase-grn/purchase-grn-report-excel/{from_date}/{to_date}/{vrn}/{item_code}/{seriesCodeOperator}/{seriesCodeValue}/{plantCodeOperator}/{plantCodeValue}/{profitCenterOperator}/{profitCenterValue}/{accCodeOperator}/{accCode}/{costCetOperator}/{costCetCode}/{QtyOperator}/{QtyValue}/{ReportTypes}', 'FinanacePurchaseReportController@PurchaseGrnReportExcel');

    Route::get('/report/purchase/purchase-bill/purchase-bill-report-excel/{from_date}/{to_date}/{vrn}/{item_code}/{seriesCodeOperator}/{seriesCodeValue}/{plantCodeOperator}/{plantCodeValue}/{profitCenterOperator}/{profitCenterValue}/{accCodeOperator}/{accCode}/{costCetOperator}/{costCetCode}/{QtyOperator}/{QtyValue}', 'FinanacePurchaseReportController@PurchaseBillReportExcel');

    Route::get('/get-data-from-query', 'FinanacePurchaseReportController@getDataFromQueryForm');

    Route::get('/report-purchase-indent', 'FinanacePurchaseReportController@getDataFromPurchaseIndentForm');

    Route::get('/report/purchase/purchase-enquery-report', 'FinanacePurchaseReportController@PurchaseEnqueryReport');
    
    Route::get('/get-data-from-query-purchase-enquery', 'FinanacePurchaseReportController@getDataFromQueryFormPurchaseEnquery');


    Route::get('/report/purchase/purchase-quotation-report', 'FinanacePurchaseReportController@PurchaseQuotationReport');

    Route::get('/get-data-from-query-purchase-quotation', 'FinanacePurchaseReportController@getDataFromQueryFormPurchaseQuotation');

    Route::get('/report/purchase/purchase-contract-report', 'FinanacePurchaseReportController@PurchaseContractReport');

    Route::get('/get-data-from-query-purchase-contract', 'FinanacePurchaseReportController@getDataFromQueryFormPurchaseContract');

    Route::get('/report/purchase/purchase-order-report', 'FinanacePurchaseReportController@PurchaseOrderReport');


    Route::get('/get-data-from-query-purchase-order', 'FinanacePurchaseReportController@getDataFromQueryFormPurchaseOrder');
    

    Route::get('/report/purchase/purchase-grn/grn-report', 'FinanacePurchaseReportController@PurchaseGrnReport');

     Route::get('/report/sales/sales-pgi-challan-report', 'FinanaceSaleReportController@SalesGrnReport');

      
    Route::get('/get-data-from-query-grn', 'FinanacePurchaseReportController@getDataFromQueryFormGrn');

    Route::get('/report/purchase/purchase-bill-report', 'FinanacePurchaseReportController@PurchaseBillReport');

    Route::get('/get-data-from-query-purchase-bill', 'FinanacePurchaseReportController@getDataFromQueryFormPurchaseBill');

    /*-----**** END: REPORT GET METHOD ****-----*/

    /*-----**** START: SALE REPORT GET METHOD ****-----*/

    Route::get('/report/sales/sale-enquiry/sale-enquiry-report', 'FinanaceSaleReportController@SalesEnquiryReport');

    Route::get('/get-data-from-query-sales-enquiry', 'FinanaceSaleReportController@getDataFromQueryFormSalesEnquiry');

     Route::get('/report/sales/sale-quotation/sale-quotation-report', 'FinanaceSaleReportController@SalesQuotationReport');

     Route::get('/report/sales/sale-quotation-monthly/sale-quotation-monthly-report', 'FinanaceSaleReportController@SalesQuotationMonthlyReport');

     Route::get('/get-data-from-query-sales-quotation', 'FinanaceSaleReportController@getDataFromQueryFormSalesQuotation');

      Route::get('/get-data-from-query-monthly-sales-quotation', 'FinanaceSaleReportController@getDataMonthlySalesQuotation');

     Route::get('/report/sales/sale-contract/sale-contract-report', 'FinanaceSaleReportController@SalesContractReport');

     Route::get('/report/sales/sale-contract-monthly/sale-contract-monthly-report', 'FinanaceSaleReportController@SalesContractMonthlyReport');

     Route::get('/get-data-from-query-monthly-sales-contract', 'FinanaceSaleReportController@getDataMonthlySalesContract');


     Route::get('/get-data-from-query-sales-contract', 'FinanaceSaleReportController@getDataFromQueryFormSalesContract');

     Route::get('/report/sales/sale-tran-report', 'FinanaceSaleReportController@SalesTransReport');

     Route::get('/get-data-from-query-sales-trans', 'FinanaceSaleReportController@getDataFromQueryFormSalesTrans');

     Route::get('/report/sales/sale-order/sale-order-report', 'FinanaceSaleReportController@SalesOrderReport');

     Route::get('/report/sales/sale-order-monthly/sale-order-monthly-report', 'FinanaceSaleReportController@SalesOrderMonthlyReport');

     Route::get('/get-data-from-query-monthly-sales-order', 'FinanaceSaleReportController@getDataMonthlySalesOrder');


    Route::get('/get-data-from-query-sales-order', 'FinanaceSaleReportController@getDataFromQueryFormSalesOrder');


    Route::get('/report/sales/sale-challan-monthly/sale-challan-monthly-report', 'FinanaceSaleReportController@SalesChallanMonthlyReport');

    Route::get('/get-data-from-query-monthly-sales-challan', 'FinanaceSaleReportController@getDataMonthlySalesChallan');


    Route::get('/report/sales/sale-bill-monthly/sale-bill-monthly-report', 'FinanaceSaleReportController@SalesBillMonthlyReport');

    Route::get('/get-data-from-query-monthly-sales-bill', 'FinanaceSaleReportController@getDataMonthlySalesBill');


     Route::get('/get-data-from-query-sales-grn', 'FinanaceSaleReportController@getDataFromQueryFormSalesGrn');

      Route::get('/report/store/store-requistion', 'FinanaceStoreReportController@StoreRequsitionReport');

      Route::get('/report/store/store-requistion-pending-complete-report', 'FinanaceStoreReportController@StoreRequsitionPendingReport');

      Route::get('/report/store/store-req-pending-complete-all-report', 'FinanaceStoreReportController@StoreRequsitionPendingAllReport');

      Route::get('/get-data-from-query-store-requistion', 'FinanaceStoreReportController@getDataFromQueryFormStoreRequsition');

      Route::get('/report/store/store-issue', 'FinanaceStoreReportController@StoreIssueReport');

      Route::get('/report/store/store-return', 'FinanaceStoreReportController@StoreReturnReport');

      Route::get('/get-data-from-query-store-return', 'FinanaceStoreReportController@getDataFromQueryFormStoreReturn');

      Route::get('/report/gate-entry/gate-entry-purchase-report', 'FinanaceGateEntryReportController@GateEntryPurchaseReport');

      Route::get('/get-data-from-query-gate-entry-purchase', 'FinanaceGateEntryReportController@getDataFromQueryFormGateEntryPur');

      Route::get('/report/gate-entry/gate-pass-return-report','FinanaceGateEntryReportController@GateEntryReturnReport');

      Route::get('/get-data-from-query-gate-entry-return', 'FinanaceGateEntryReportController@getDataFromQueryFormGateEntryReturn');

     Route::get('/report/gate-entry/gate-pass-nonreturn-report','FinanaceGateEntryReportController@GateEntryNonReturnReport');

     Route::get('/get-data-from-query-gate-entry-nonreturn', 'FinanaceGateEntryReportController@getDataFromQueryFormGateEntryNonReturn');


     Route::get('/report/production/bom-report','FinanaceProductionReportController@BomReport');

     Route::get('/get-data-from-query-production-bom', 'FinanaceProductionReportController@getDataFromQueryFormProductionBom');

     Route::get('/report/production/daily-production-report','FinanaceProductionReportController@DailyProductionReport');

     Route::get('/get-data-from-query-daily-production', 'FinanaceProductionReportController@getDataFromQueryFormDailyProduction');

     Route::get('/report/production/wobom-report','FinanaceProductionReportController@WoBomReport');

     Route::get('/get-data-from-query-production-wobom', 'FinanaceProductionReportController@getDataFromQueryFormProductionWoBom');


/*-----**** END:SALE REPORT GET METHOD ****-----*/

    /*-----**** START: REPORT POST METHOD ****-----*/

    
    Route::post('/get-vendor-for-enquiry-report', 'FinanacePurchaseReportController@GetVenderDataEnqueryReport');

    Route::post('/get-calTax-for-enquiry-reports', 'FinanacePurchaseReportController@GetCalTaxDataEnqueryReports');

    Route::post('/get-quapar-for-enquiry-reports', 'FinanacePurchaseReportController@GetQuaParDataEnqueryReports');

    Route::post('/get-qua-sale-reports', 'FinanaceSaleReportController@GetQuaSaleReports');

    Route::post('/get-qua-sale-cont-reports', 'FinanaceSaleReportController@GetContSaleReports');

    Route::post('/get-calTax-for-contract-reports', 'FinanacePurchaseReportController@GetCalTaxDataContractReports');

    Route::post('/get-data-for-contract-trans-pdf', 'FinanacePurchaseReportController@get_contrapdf_data');

    Route::post('/get-calTax-for-purchase-reports', 'FinanacePurchaseReportController@GetCalTaxDataPurchaseReports');

    Route::post('/get-quapar-for-purchaseorder-reports', 'FinanacePurchaseReportController@GetQuaParDataOrderReports');

    Route::post('/get-qua-for-saleorder-reports', 'FinanaceSaleReportController@GetQuaSaleOrderReports');

    Route::post('/get-calTax-for-grn-reports', 'FinanacePurchaseReportController@GetCalTaxDataGrnReports');

    Route::post('/get-calTax-for-purchasebill-reports', 'FinanacePurchaseReportController@GetCalTaxDataPurchaseBillReports');

    Route::post('/get-quapar-for-purchasebill-reports', 'FinanacePurchaseReportController@GetQuaParDataBillReports');


     Route::post('/get-calTax-for-salequo-reports', 'FinanaceSaleReportController@GetCalTaxDataSalesQuoReports');

     Route::post('/get-calTax-for-salecont-reports', 'FinanaceSaleReportController@GetCalTaxDataSalesContReports');

     Route::post('/get-calTax-for-saleorder-reports', 'FinanaceSaleReportController@GetCalTaxDataSalesOrderReports');
    /*-----**** END: REPORT POST METHOD ****-----*/



 /*-----***** End: Finance Report Section *****-----*/



/*-----******** Start: SALE SECTION ************-----*/


  /*-----***** Start: POST METHOD ******-----*/

  
  
  Route::post('/get-a-field-calculation-by-tax-in-sale-quo', 'FinanceSaleController@AfieldCalculationSaleQuo');

  Route::post('check-state-of-plant-n-acc', 'FinanceSaleController@checkSateOfPlantNAcc');


  Route::post('/finance/save-sale-order-trans', 'FinanceSaleController@SaveSaleOrderTrans');

  Route::post('/get-quo-parameter-for-sale-quo', 'FinanceSaleController@GetQtyParametrFrmSaleQuoByItm');

  Route::post('transaction/sales/view-sale-quotation-chield-row-data', 'FinanceSaleController@SaleQuoChieldRTowData');

  Route::post('transaction/sales/view-sale-order-chield-row-data', 'FinanceSaleController@SaleorderChieldRTowData');

  Route::post('transaction/sales/view-sale-tran-chield-row-data', 'FinanceSaleController@SaleTranChieldRTowData');

  Route::post('get-user-list-for-enquiry', 'FinanceCRMController@getUserlisEnquiry');

  
  Route::post('/enquiery-log-to-user', 'FinanceCRMController@EnquirylogUser');



  /*-----***** End: POST METHOD ******-----*/


  /*-----***** Start: GET METHOD ******-----*/



    

    

    Route::get('/transaction/sales/sales-transaction', 'FinanceSaleController@AddSalesTrans');
    Route::post('get-simulation-data-for-sale-bill', 'FinanceSaleController@simulationForSaleBill');

    Route::post('/finance/employee/pdf', 'FinanaceStoreReportController@createPDF');

    Route::post('/finance/store/store-return-pdf', 'FinanaceStoreReportController@storeReturnPDF');

    Route::post('/finance/gate-entry/gate-entry-pdf', 'FinanaceGateEntryReportController@GateEntryPdf');

    Route::post('/finance/production/production-pdf', 'FinanaceProductionReportController@ProductionPdf');

    Route::post('/report/purchase-indent/pdf', 'FinanacePurchaseReportController@PurchaseIndentPdf');

    Route::post('/report/purchase-quotation/pdf', 'FinanacePurchaseReportController@PurchaseQuotationPdf');

    Route::post('/report/purchase-enquery/pdf', 'FinanacePurchaseReportController@PurchaseEnqueryPdf');

    Route::post('/report/purchase-contract/pdf', 'FinanacePurchaseReportController@PurchaseContractPdf');

    Route::post('/report/purchase-order/pdf', 'FinanacePurchaseReportController@PurchaseOrderPdf');

    Route::post('/report/purchase-grn/pdf', 'FinanacePurchaseReportController@PurchaseGrnPdf');

    Route::post('/report/purchase-bill/pdf', 'FinanacePurchaseReportController@PurchaseBillPdf');

    Route::post('/report/sale-order/pdf', 'FinanaceSaleReportController@SalesOrderPdf');

    Route::post('/report/sales-trans/pdf', 'FinanaceSaleReportController@SalesTransPdf');
    
    

  /*-----***** End: GET METHOD ******-----*/

  /*-----***** End: CREDIT NOTE ******-----*/


   Route::get('/Transaction/Purchase/Credit-Note-Trans', 'PurchaseTransController@CreditNoteTransaction');

   Route::post('finance/save-credit-note-transaction', 'PurchaseTransController@SaveCreditNote');

   Route::get('/Transaction/Purchase/View-Credit-Note-Trans', 'PurchaseTransController@ViewCreditNote');


   Route::post('view-credit-note-chield-row-data', 'PurchaseTransController@ViewCreditNoteTransChildRow');


   Route::post('/get-a-field-calc-for-credit-note', 'PurchaseTransController@AfieldCalculationCreditNote');

   Route::post('/get-a-field-calc-for-credit-note-woitem', 'PurchaseTransController@AfieldCalculationCreditNoteWoItem');


    Route::get('/Transaction/Purchase/Credit-Note-Woitem-Trans', 'PurchaseTransController@CreditNoteWoItemTransaction');

    Route::get('/Transaction/Purchase/View-Credit-Note-Woitem-Trans', 'PurchaseTransController@ViewCreditWoItemNote');


   Route::post('finance/save-credit-note-transaction-woitem', 'PurchaseTransController@SaveCreditNoteWoItem');


   Route::post('/get-bill-no-by-account','PurchaseTransController@GetBillNoByAcc');

   Route::post('/get-item-by-billno', 'PurchaseTransController@GetItemByBillNo');

  Route::post('/get-item-by-billno-taxcode', 'PurchaseTransController@GetItemByBillNoTaxCode');

  Route::post('/get-item-by-billno-data', 'PurchaseTransController@GetItemByBillNoData');

   Route::post('/get-pur-bill-item-um-aum', 'PurchaseTransController@Get_Pur_Bill_Item_UM_AUM');

/*-----***** End: CREDIT NOTE ******-----*/


/*-----***** End: DEBIT NOTE ******-----*/

Route::get('/Transaction/Purchase/Debit-Note-Trans', 'PurchaseTransController@DebitNoteTransaction');

   Route::post('finance/save-debit-note-transaction', 'PurchaseTransController@SaveDebitNote');

   Route::get('/Transaction/Purchase/View-Debit-Note-Trans', 'PurchaseTransController@ViewDebitNote');

   Route::post('view-debit-note-chield-row-data', 'PurchaseTransController@ViewDebitNoteTransChildRow');


   Route::get('/Transaction/Purchase/Debit-Note-Woitem-Trans', 'PurchaseTransController@DebitNoteWoItemTransaction');

   Route::post('finance/save-debit-note-transaction-woitem', 'PurchaseTransController@SaveDebitNoteWoItem');

   Route::get('/Transaction/Purchase/View-Debit-Note-Woitem-Trans', 'PurchaseTransController@ViewDebitWoItemNote');


   //  Route::post("parse-csv", "ImportController@importLeads");

  Route::post('finance/import', 'ImportController@importExcel');

   //Route::post('finance/doimport', 'FinanaceLogisticController@importDoExcel');

  Route::post('finance/doimport', 'FinanaceStoreController@importDoExcel');

  Route::post('finance/rack-do-import', 'FinanaceLogisticController@importRackExcel');

  Route::post('finance/lrimport', 'FinanaceLogisticController@importLrExcel');

   Route::post('finance/export', 'ImportController@exportExcel');
  // Route::post('finance/import', 'ImportController@importData');



   Route::get('/finance/importfile', 'ImportController@FormImportFile');


/*-----***** End: DEBIT NOTE ******-----*/
  

/*-----******** End: SALE SECTION ************-----*/

 
Route::get('/finance/test-practice', 'FinancePurchaseTransController@testP');


/* --------- commom ajax ------ */
  
  Route::post('/Get-Pfct-Code-Name-By-Plant', 'CommonFunction@pfct_by_plant');
  Route::post('/get-plant-data-against-company', 'CommonFunction@GetPlantByComp');

  Route::post('/get-vr-sequence-by-series', 'CommonFunction@GetVrnoBySeries');
  Route::post('/get-vr-sequence-by-series-crm', 'CommonFunction@GetVrnoBySeriesCRM');

  Route::post('/get-item-um-aum', 'CommonFunction@Get_Item_UM_AUM');

  Route::post('/tds-rate-calculate', 'CommonFunction@TdsRateCalculate');

  Route::post('/get-acc-data-by-accdetail', 'CommonFunction@get_acccodeData');

  Route::post('/check-tax-in-tax-rate', 'CommonFunction@CheckTaxInTaxRate');

  Route::post('/get-cfactor-when-change-aum', 'CommonFunction@GetCfactorWhenChangeAum');

  Route::post('/check-hsn-for-taxcode', 'CommonFunction@check_hsn_for_tax');

  Route::post('/get-tolrnce-data-by-item-code', 'CommonFunction@get_Tolrance_data');

  Route::post('/get-item-data-details', 'CommonFunction@Get_Item_Data_Details');

  Route::post('check-state-n-get-trans-by-sale-vrno', 'FinanceSaleController@checkStateN_GetPrevTransData');

  Route::post('get-item-data-by-sales-vno', 'FinanceSaleController@GetItemBySalesTrans');

  Route::post('get-item-data-by-tax-state', 'FinanceSaleController@TaxStateByItemSales');

  Route::post('get-a-field-calc-by-tax-in-sales', 'FinanceSaleController@AfieldCalculationForSales');

  Route::post('get-quo-paramter-for-item-sales', 'FinanceSaleController@GetQtyParaForSales');

  Route::post('get-mulitple-item-by-prev-sales', 'FinanceSaleController@GetItemByPrevSalesVrno');

  Route::post('get-item-by-mul-tax-code', 'FinanceSaleController@GetItemByMulTaxCode');

  Route::post('get-vrno-by-series-trans-in-sale', 'FinanceSaleController@getVrnoSeriesBytransSale');
  Route::post('get-state-wise-tax-code', 'FinanceSaleController@getTaxCodeByState');

  Route::post('get-vrno-by-series-trans-in-crm', 'FinanceCRMController@getVrnoSeriesBytransCrm');

  Route::post('get-quality-parameter-for-item-purchase', 'PurchaseTransController@QualityParameterPurchase');

  Route::post('get-data-by-acc-code-in-trans', 'PurchaseTransController@GetDataByAccPurchase');

  Route::post('get-item-data-by-tax-code', 'PurchaseTransController@GetItemByTaxState');

  Route::post('get-a-field-calc-by-itm-tax-code', 'PurchaseTransController@AfieldCalculationForPerchase');
  
  Route::post('pdf-donwload-when-view-purchase-pages', 'PurchaseTransController@pdfDownloadForView');

  Route::post('pdf-donwload-when-view-sales-pages', 'FinanceSaleController@pdfDownloadForViewSales');

  Route::post('pdf-donwload-when-view-jobcard-pages', 'MaintenanceController@pdfDownloadForViewJobCrad');

  Route::post('get-full-address-against-city', 'CommonFunction@addressAgainstCity');

  Route::post('/Transaction/a-field-calc/tax-rate-calc', 'CommonFunction@AfieldCalForTax');


/* --------- commom ajax ------ */





  /* ---------- Start Get Purchase Pending Routes ------------*/



    /* --------Start Get Method-------- */


    Route::get('/report/purchase/purchase-indent/indent-pending-complete-report', 'HouseBankController@IndentPending');

    Route::get('/get-data-pending-complete-indent', 'HouseBankController@purchaseIndentPendingCompleteAll');

    Route::get('/report/purchase/purchase-indent/indent-cancel', 'HouseBankController@purchaseIndentCancel');

    Route::get('/get-data-cancel-indent', 'HouseBankController@purchaseDataIndentCancel');

    Route::get('/report/purchase/purchase-indent/cancel-indent/{hid}/{bid}', 'HouseBankController@IndentCancel');


    Route::get('/report/purchase/purchase-quotation/quotation-pending-complete-report', 'HouseBankController@QuotationPendingComplete');

    Route::get('/get-data-pending-complete-quotation', 'HouseBankController@purchaseQuotationPendingCompleteAll');

    Route::get('/report/purchase/purchase-quotation/quotation-cancel', 'HouseBankController@purchaseQuotationCancel');

    Route::get('/get-data-cancel-quotation', 'HouseBankController@purchaseDataQuotationCancel');

    Route::post('/update-quotation-cancel-qty', 'HouseBankController@QuotationUpdateCancelQty');
    
    Route::post('update-quotation-cancel-cal-tax-amt', 'HouseBankController@QuotationUpdateTaxAmt');

    Route::get('/report/purchase/purchase-contract/contract-pending-complete-report', 'HouseBankController@ContractPendingComplete');

    Route::get('/get-data-pending-complete-contract', 'HouseBankController@purchaseContractPendingCompleteAll');

    Route::get('/report/purchase/purchase-contract/contract-cancel', 'HouseBankController@purchaseContractCancel');

    Route::get('/report/purchase/purchase-contract/contract-demo', 'FinanacePurchaseReportController@purchaseContractDemo');

    Route::get('/get-data-cancel-contract', 'HouseBankController@purchaseDataContractCancel');

    Route::post('/update-contract-cancel-qty', 'HouseBankController@ContractUpdateCancelQty');

    Route::post('/update-contract-cancel-cal-tax-amt', 'HouseBankController@ContractUpdateTaxAmt');

    Route::get('/report/purchase/purchase-order/order-pending-complete-report', 'HouseBankController@OrderPendingComplete');

    Route::get('/get-data-pending-complete-order', 'HouseBankController@purchaseOrderPendingCompleteAll');

    Route::get('/report/purchase/purchase-order/order-cancel', 'HouseBankController@purchaseOrderCancel');

    Route::get('/get-data-cancel-order', 'HouseBankController@purchaseDataOrderCancel');

    Route::post('/update-order-cancel-qty', 'HouseBankController@OrderUpdateCancelQty');

    Route::post('/update-order-cancel-cal-tax-amt', 'HouseBankController@OrderUpdateTaxAmt');

    Route::get('/report/purchase/purchase-grn/grn-pending-complete-report', 'HouseBankController@GrnPendingComplete');

    Route::get('/get-data-pending-complete-grn', 'HouseBankController@purchaseGrnPendingCompleteAll');

    Route::get('/report/purchase/purchase-grn/grn-cancel', 'HouseBankController@purchaseGrnCancel');

    Route::post('get-data-from-body-for-edit', 'PurchaseTransController@getDataFromBodyPurhase');

    Route::get('/get-data-cancel-grn', 'HouseBankController@purchaseDataGrnCancel');

    Route::get('/report/sales/sale-contract/sale-contract-pending-complete-report', 'HouseBankController@SalesPendingCompleteReport');

    Route::get('/report/sales/sale-contract/get-data-sale-pending-complete-all-report', 'HouseBankController@SaleContractPendingCompleteAll');


    Route::get('/report/sales/sale-contract/sale-contract-cancel-report', 'HouseBankController@SaleContractCancelReport');

    Route::get('/get-data-cancel-sale-contract', 'HouseBankController@SaleContractCancel');

    Route::post('/update-sale-contract-cancel-qty', 'HouseBankController@SaleContractCancelQtyReport');

    Route::get('/report/sales/sale-order/sale-order-pending-complete-report', 'HouseBankController@SalesOrderPendingCompleteReport');

    Route::get('/report/sales/sale-order/sale-order-pending-complete-all-report', 'HouseBankController@SaleOrderPendingCompleteAll');

    Route::get('/report/sales/sale-contract/sale-order-cancel-report', 'HouseBankController@SaleOrderCancelReport');

    Route::get('/get-data-cancel-sale-order', 'HouseBankController@SaleOrderCancel');

    Route::post('/update-sale-order-cancel-qty', 'HouseBankController@SaleOrderCancelQtyReport');

     Route::get('/report/sales/sale-quotation/sale-quotation-pending-complete-report', 'HouseBankController@SaleQuotationPendingCompleteReport');

     Route::get('/report/sales/sale-quotation/sale-quotation-pending-complete-all-report', 'HouseBankController@SaleQuotationPendingCompleteAll');

     Route::get('/report/sales/sale-quotation/sale-quotation-cancel-report', 'HouseBankController@SaleOrderQuotation');

     Route::get('/get-data-cancel-sale-quotation', 'HouseBankController@SaleQuotationCancelReport');

     Route::get('/reports/stock/stock-age-wise-analysis','ReportMisController@stockAgeAnalysis');

    
    
    
    /* --------End Get Method-------- */




    /* --------Start Post Method-------- */


     Route::post('/update-sale-quotation-cancel-qty', 'HouseBankController@SaleQuotationCancelQtyReport');

     Route::post('/stock-wise-ageanalysis-data', 'ReportMisController@StockAgeBarGraph');


    /* --------End Post Method-------- */

   /* 
    *
    *
    *
    *
    */

    /* --------Asset Start : Get Method-------- */


    Route::get('Master/Asset/Asset-Group', 'AssetController@AssetGroup');

    Route::get('Master/Asset/View-Asset-Group', 'AssetController@ViewAssetGroup');

    Route::post('Master/Asset/Save-Asset-Group', 'AssetController@AssetGroupSave');

    Route::post('/Master/Asset/Delete-Data', 'AssetController@AssetDeleteData');
    
    Route::post('/Master/Asset/Delete-Mul-Table', 'AssetController@DeleteMulTbl');

    Route::get('Master/Asset/Update-Asset-Group/{id}', 'AssetController@EditAssetGroup');

    Route::post('Master/Asset/Asset-Group-Update/','AssetController@UpdateAssetGroup');

    Route::get('Master/Asset/Asset-Class', 'AssetController@AssetClass');

    Route::get('Master/Asset/View-Asset-Class', 'AssetController@ViewAssetClass');

    Route::post('Master/Asset/Save-Asset-Class', 'AssetController@AssetClassSave');

    Route::get('Master/Asset/Update-Asset-Class/{id}', 'AssetController@EditAssetClass');

    Route::post('Master/Asset/Asset-Class-Update/','AssetController@UpdateAssetClass');

    Route::get('Master/Asset/Asset-Category', 'AssetController@AssetCategory');

    Route::get('Master/Asset/View-Asset-Category', 'AssetController@ViewAssetCategory');

    Route::post('Master/Asset/Save-Asset-Category', 'AssetController@AssetCategorySave');

    Route::get('Master/Asset/Update-Asset-Category/{id}', 'AssetController@EditAssetCategory');

    Route::post('Master/Asset/Asset-Category-Update/','AssetController@UpdateAssetCategory');

    /* Asset Master */

    Route::get('Master/Asset/Asset-Master', 'AssetController@AssetMaster');

    Route::get('Master/Asset/View-Asset-Master', 'AssetController@ViewAssetMaster');

    Route::post('Master/Asset/Save-Asset-Master', 'AssetController@AssetMasterSave');

    Route::get('Master/Asset/Update-Asset-Master/{id}', 'AssetController@EditAssetMaster');

    Route::post('Master/Asset/Asset-Master-Update/','AssetController@UpdateAssetMaster');

    /* Asset Depreciation */

    Route::get('Master/Asset/Asset-Dep-Rate-Master', 'AssetController@AssetDepreciationMaster');

    Route::get('Master/Asset/View-Asset-Dep-Rate-Master', 'AssetController@ViewAssetDepreciationMaster');

    Route::post('Master/Asset/Save-Asset-Dep-Rate-Master', 'AssetController@AssetDepreciationMasterSave');

    Route::get('Master/Asset/Update-Asset-Dep-Rate-Master/{id}', 'AssetController@EditAssetDepreciationMaster');

    Route::post('Master/Asset/Asset-Dep-Rate-Master-Update/','AssetController@UpdateAssetDepreciationMaster');

    /* Asset Balance Master */

    Route::get('Master/Asset/Asset-Balance-Master', 'AssetController@AssetBalanceMaster');

    Route::get('Master/Asset/View-Asset-Balance-Master', 'AssetController@ViewAssetBalanceMaster');

    Route::post('Master/Asset/Save-Asset-Balance-Master', 'AssetController@AssetBalanceMasterSave');

    Route::get('Master/Asset/Update-Asset-Balance-Master/{id}/{compCode}/{fyCode}', 'AssetController@EditAssetBalanceMaster');

    Route::post('Master/Asset/Asset-Balance-Master-Update/','AssetController@UpdateAssetBalanceMaster');

    Route::post('get-gl-by-asgroupcode','AssetController@getGlfromGroupCode');

    /* ------ Asset Transaction ------- */

    Route::get('/finance/transaction/asset/asset-transaction', 'AssetController@AssetTransaction');

    Route::get('/finance/transaction/asset/view-asset-transaction', 'AssetController@ViewAssetTransaction');

    Route::get('get-data-from-assetdeptran','AssetController@getDataAssetDepTran');

    Route::post('submit-asset-plan-amt','AssetController@SaveAssetPlanAmt');

    Route::get('/finance/transaction/asset/asset-tran-success-message/{assetName}','AssetController@AssetSuccessMessage');

    Route::get('/report/dynamic-query', 'ReportMisController@dynamicQuery');
    
    Route::get('/report/c_and_f/stock-summary', 'ReportMisController@stock_summary');

    Route::get('/report/c_and_f/rake-report', 'ReportMisController@rake_report');

    Route::post('get-data-from-transaction', 'ReportMisController@TransactionData');

    Route::get('/configration/engine-table-config', 'SettingController@engineTblConfig');

    Route::post('search-trancode-code', 'SettingController@getTransactionCode');

    Route::post('get-masters-table', 'SettingController@getMasterTblList');

    Route::post('get-tablecolumn-list', 'SettingController@getTblColumnList');

    Route::post('/configration/engine-table-config-save', 'SettingController@engineTblConfigSave');

    Route::get('/configration/view-engine-table-config', 'SettingController@dynamicQueryView');

    Route::post('view-enginetbl-config-chield-row-data', 'SettingController@ViewEngineTblConfigChildRow');

    Route::get('Report/View-Dynamic-query-report', 'ReportMisController@ViewDynamicQuery');

    Route::get('/configration/save-engine-table/save-data-msg/{savedata}', 'SettingController@SaveEngineTbleMsg');

    Route::get('/configration/Edit-Engine-Table-Config/{tCode}', 'SettingController@EditengineTableConfig');

    Route::post('/configration/update-engine-table-config', 'SettingController@UpdateEngineTbleCofnig');

    Route::post('/configration/delete-engine-table-config', 'SettingController@DeletEnginTble');
    Route::get('/configration/update-engine-table/update-data-msg/{savedata}', 'SettingController@updateEngineTbleMsg');
    

    Route::get('/reporte/dynamicQuery-save/{dynamicQuery}/{tranCode}/{reportName}/{user_name}/{pfctCode}/{plantcode}/{fromdate}/{todate}/{queryName}/{queryNameWS}/{groupOneval}/{groupTwoval}/{groupThreeVal}/{dataColumn}/{columnNameFr}/{columnNameSc}/{columnNameThr}/{columnNameFour}', 'ReportMisController@dynamicQuerySave');
    
    Route::post('/Report/get-dynamic-query-for-change', 'ReportMisController@getDynamicQueryForChange');

    Route::post('/Report/get-queryName-against-tCode', 'ReportMisController@getQueryNameAgainstTCode');

    Route::get('/configration/database-config', 'SettingController@databaseConfig');
    Route::post('/configration/list-database-table', 'SettingController@listDBConfig');

    /* --------Asset Start : Get Method-------- */



    /* -------- START : Geogaraphycal - Get Method-------- */

      Route::get('/viewpage-excel-donwload-dynamic-report/{dynamicQuery}/{fromDate}/{toDate}/{tableID}', 'ReportMisController@ViewExcelOnViewDR');

      /*...Country...*/

      Route::get('/master/geogaraphycal/country-master', 'FinanceMasterController@CountryMaster');

      Route::post('/master/geogaraphycal/country-master-save', 'FinanceMasterController@CountryMasterSave');

      Route::get('/master/geogaraphycal/view-country-master', 'FinanceMasterController@ViewCountryMaster');

      Route::post('/master/geogaraphycal/delete-country-master', 'FinanceMasterController@DeleteCountryMaster');

      Route::get('/master/geogaraphycal/edit-country-master/{tblid}/{countryCode}', 'FinanceMasterController@EditCountryMaster');

      Route::post('/master/geogaraphycal/country-master-update', 'FinanceMasterController@CountryMasterUpdate');


      /*...Region...*/

      Route::get('/master/geogaraphycal/region-master', 'FinanceMasterController@RegionMaster');

      Route::post('/master/geogaraphycal/region-master-save', 'FinanceMasterController@RegionMasterSave');

      Route::get('/master/geogaraphycal/view-region-master', 'FinanceMasterController@ViewRegionMaster');

      Route::post('/master/geogaraphycal/delete-region-master', 'FinanceMasterController@DeleteRegionMaster');

      Route::get('/master/geogaraphycal/edit-region-master/{tblid}/{regionCode}', 'FinanceMasterController@EditRegionMaster');

      Route::post('/master/geogaraphycal/region-master-update', 'FinanceMasterController@RegionMasterUpdate');

      /*...State...*/

      Route::get('/master/geogaraphycal/state-master', 'FinanceMasterController@StateMaster');

      Route::post('/master/geogaraphycal/state-master-save', 'FinanceMasterController@StateMasterSave');

      Route::get('/master/geogaraphycal/view-state-master', 'FinanceMasterController@ViewStateMaster');

      Route::post('/master/geogaraphycal/delete-state-master', 'FinanceMasterController@DeleteStateMaster');

      Route::get('/master/geogaraphycal/edit-state-master/{tblid}/{stateCode}', 'FinanceMasterController@EditStateMaster');

      Route::post('/master/geogaraphycal/state-master-update', 'FinanceMasterController@StateMasterUpdate');

      /*...District...*/

      Route::get('/master/geogaraphycal/district-master', 'FinanceMasterController@DistrictMaster');

      Route::post('/master/geogaraphycal/district-master-save', 'FinanceMasterController@DistrictMasterSave');

      Route::get('/master/geogaraphycal/view-district-master', 'FinanceMasterController@ViewDistrictMaster');

      Route::post('/master/geogaraphycal/delete-district-master', 'FinanceMasterController@DeleteDistrictMaster');

      Route::get('/master/geogaraphycal/edit-district-master/{tblid}/{districtCode}', 'FinanceMasterController@EditDistrictMaster');

      Route::post('/master/geogaraphycal/district-master-update', 'FinanceMasterController@DistrictMasterUpdate');

      /*...City...*/

      Route::get('/master/geogaraphycal/city-master', 'FinanceMasterController@CityMaster');

      Route::post('/master/geogaraphycal/city-master-save', 'FinanceMasterController@CityMasterSave');

      Route::get('/master/geogaraphycal/view-city-master', 'FinanceMasterController@ViewCityMaster');

      Route::post('/master/geogaraphycal/delete-city-master', 'FinanceMasterController@DeleteCityMaster');

      Route::get('/master/geogaraphycal/edit-city-master/{tblid}/{districtCode}', 'FinanceMasterController@EditCityMaster');

      Route::post('/master/geogaraphycal/city-master-update', 'FinanceMasterController@CityMasterUpdate');


    /* -------- END : Geogaraphycal - Get Method-------- */

    //  Start : Trips/LR Status

    Route::get('/Trips/DO-for-planning', 'DashboardController@DoPlanning');

    Route::get('/Trips/do-for-lr-status', 'DashboardController@DoLrPending');
    
    Route::get('/Trips/epod-status', 'DashboardController@epodstatus');
    
    Route::get('/Trips/lr-ack-status', 'DashboardController@lrAckstatus');

    Route::get('/Trips/ewaybill-status', 'DashboardController@ewaybill');

    Route::post('/Trips/ewaybill-refreshEwb', 'DashboardController@refreshEwb');

    Route::post('/Trips/ewaybill-extendEwb', 'DashboardController@extendEwb');

    Route::post('/Trips/ewaybill-update-validUpto', 'DashboardController@updateEwbValidUpto');


    // End : Trips/LR Status

    // Start Logistics Report

    Route::get('/report/logistic/do-pending/order-report', 'LogisticController@DO_pendingReport');

    Route::get('/get-data-delivery-order-monthly-report', 'LogisticController@getDoMonthlyReport');

    Route::get('/report/logistic/do-pending/monthly-report', 'LogisticController@DoMonthlyReport');

    Route::get('/report/logistic/do-pending/pending-complete-report', 'LogisticController@DoCompleteReport');

    Route::get('/report/logistic/trip-planning/monthly-trip-planning-report', 'ReportMisController@tripPlanningMonthlyReport');

    Route::get('/get-data-trip-planning-report', 'ReportMisController@tripPlanningMonthlyReportSearch');

    Route::get('/report/logistic/trip-planning/monthly-trip-planning-report-excel/{from_date}/{to_date}/{vehicleType}/{Consinee}/{from_place}/{to_place}/{transpAgent}', 'ReportMisController@tripPlanningMonthlyReportExcel');

    Route::get('/reports/logistic/pending-gate-inward', 'ReportMisController@pendingGateInward');


    // End Logistics Report

    // start C and F Report 

    Route::get('/get-data-stock-summary-report', 'ReportMisController@getStockSummaryReport');

    Route::get('/get-data-rake-report', 'ReportMisController@getRakeReport');
    Route::post('/view-rake-detail-consignee-wise', 'ReportMisController@viewDetailsRakeConsig');

    Route::post('/view-consignee-detail', 'ReportMisController@viewcountConsignee');

    
    //  End C and F Report

    Route::get('/accont/report/view-party-wise-ageAnalysis', 'DashboardController@getPaytyTypeWiseAgeAnalysisData');

    Route::get('/accont/report/stock/view-stock-wise-ageAnalysis', 'ReportMisController@getItemTypeWiseAgeAnalysisData');


  /* ---------- End Purchase Pending Routes ------------*/



 });

});