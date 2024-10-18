<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('test','ApiController@testApi'); 
Route::post('/user/login','ApiController@SignIn'); 

// Start ePOD trans //
Route::get('/api-epod-truck-list','ApiController@ePODTruckList'); 
Route::post('/api-epod-trip-details','ApiController@ePODTripDetails'); 
Route::post('/api-epod-update-details','ApiController@ePODUpdateTrip'); 

// End ePOD trans //

Route::post('/api-emp-punch-attendance','ApiController@empPunchAttendance');

Route::get('/api-company-name','ApiController@SelectCompName'); 

Route::post('/api-fy-year','ApiController@listFyYear');

Route::get('/api-trips-status', 'ApiController@TripLrStatus');
Route::get('/api-lr-trips', 'ApiController@lrTrips');
Route::get('/api-epod-trips', 'ApiController@epodData');
Route::get('/api-lr-ack', 'ApiController@lrAck');
Route::get('/api-ewaybill-trips', 'ApiController@ewaybilldata');
Route::get('/api-vehical-doc-updation', 'ApiController@VehicleDocUpdate');
Route::post('/api-get-login-data', 'ApiController@getData');

Route::post('/api-do-planning-searchdata', 'ApiController@doPlanningApi');

// Start Vehicle track details

Route::get('/api-track-vehicle', 'ApiController@TrackVehicle');
Route::get('/api-get-data-track-vehicle','ApiController@TrackVehicleTblData');

Route::post('/api-get-live-track-vehicle-data-from-api', 'ApiController@getTrackVehicleFromApi');

// End Vehicle track details


// Start C & F Reports

Route::get('/api-report-data', 'ApiController@getReportData');
Route::get('/api-stock-summary', 'ApiController@stock_summary');

Route::get('/api-stock-ledger-report', 'ApiController@StockLedgerReport');

Route::get('/api-rake-do-summary', 'ApiController@RakeDoSummReport');

Route::get('/api-rake-report', 'ApiController@rakeReport');

Route::get('/api-rake-summary', 'ApiController@RakeSummary');

Route::get('/api-grn-inward-report', 'ApiController@GrnInwardReport');

 Route::get('/api-dispatch-outward-report', 'ApiController@DispatchOutwardReport');

// End C & F Reports




