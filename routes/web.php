<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\addAirportController;
use App\Http\Controllers\addDepotController;
use App\Http\Controllers\editAirportController;
use App\Models\Airports;
use Illuminate\Support\Facades\DB;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/airport-management', function () {
    return view('AirportManagement');
}); 

/* Route::get('/add-airport', function() {
    return view('AddAirport');
});
 */
Route::get('/depot-management', function () {
    return view('DepotManagement');
}); 

// Airport DB Routes
Route::get('airports',[AirportController::class, 'oldindex']);
Route::get('/airport-management', 'App\Http\Controllers\AirportController@index');
// Add Airport
Route::view('addAirport', 'AddAirport');
Route::post('addAirport',[addAirportController::class, 'addData']);
// Delete Airport
Route::get('delete/{id}', [AirportController::class, 'deleteAirport']);
// Edit Airport
Route::get('edit/{id}', [AirportController::class, 'showData']);
Route::post('edit/{id}',[AirportController::class, 'updateAirport']);
// Route::get('edit/{id}', [AirportController::class, 'editAirport']);
//Route::put('updateAirport/{id}',[AirportController::class, 'updateAirport']);


// Depots DB Routes
Route::get('depots',[DepotController::class, 'oldindex']);
Route::get('/depot-management', 'App\Http\Controllers\DepotController@index');
// Add Depots
Route::view('addDepot', 'AddDepot');
Route::post('addDepot',[addDepotController::class, 'addData']);
// Delete Depo
Route::get('deleteDepot/{id}', [DepotController::class, 'deleteDepot']);
// Edit Depot
Route::get('editDepot/{id}', [DepotController::class, 'showDepotData']);
Route::post('editDepot/{id}',[DepotController::class, 'updateDepot']);





