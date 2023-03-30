<?php

use App\Http\Controllers\PickupController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\contractController;
use App\Http\Controllers\AirportController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\newcontractcontroller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', [App\Http\Controllers\ProfileController::class, 'checkUser'])->name('checkUser');

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', function () {
    return View::make('app');
})->name('home');


Route::get('/page2', function () {
    return view('page2');
});

Route::get(
    '/pickup/create',
    [PickupController::class, 'create']
)->middleware(['auth', 'verified'])->name('create-pickup');

Route::get('/dashboard/my-pickups', function () {
    return view('dashboard.my_pickups');
})->middleware(['auth', 'verified'])->name('my-pickups');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//roles() method gives an error but it still works (I have no idea how or why)
Route::get('/employee', function(){
    return Auth::user()->roles()->first()->name == 'employee' ||
        Auth::user()->roles()->first()->name == 'admin' ? view('employee') : abort(404);
})->middleware(['auth', 'verified'])->name('employee');


//admin page
Route::get('/admin', function(){
    return Auth::user()->roles()->first()->name == 'admin' ? view('admin') : abort(404);
})->middleware(['auth', 'verified'])->name('admin');

//user page
Route::get('/admin/users', [UserController::class, 'show'], function(){
    return Auth::user()->roles()->first()->name == 'admin' ? view('admin.users') : abort(404);
})->middleware(['auth', 'verified'])->name('users');
Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');

//roles page
Route::get('/admin/roles', [RoleController::class, 'show'],  function(){
    return Auth::user()->roles()->first()->name == 'admin' ? view('admin.roles') : abort(404);
})->middleware(['auth', 'verified'])->name('roles');
Route::put('/admin/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/admin/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
Route::post('/admin/roles', [RoleController::class, 'store'])->name('roles.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/overview', function ()
{
    $tickets = DB::select('SELECT ticketID, cstID, employeeID, issue, description, solution, status FROM tickets');

    // dd($tickets);

    // return redirect()->route('dump');
    return view('overview', ['tickets' => $tickets]);
});

// Route::get('/dump', 'ticket_overview@dump')->name('dump');

Route::get('/create-ticket', [TicketController::class, 'showForm'])->name('create-ticket');
Route::post('/submitted-ticket',  [TicketController::class, 'store'])->name('submitted-ticket');
Route::get('/submitted-ticket', [TicketController::class, 'showSubmittedTicket'])->name('show-ticket');

//  contracts view
Route::get('contract', [contractController::class, 'simpleV2']);
Route::get('edit',[contractController::class, 'alter']);
Route::get('contractGet',[contractController::class, 'simpleIndex']);
Route::get('specif', function() {
    return view('specific-contracts');
});

require __DIR__.'/auth.php';


//contractmenu
Route::get('/contractsMenu', function (){
    return view('contractsMenu');
});
//airportlist
Route::get('airportList', [AirportController::class, 'airportFiltering']);


// Add, delete and edit airportList
Route::post('airportList', [AirportController::class, 'addAirport']);
Route::get('deleteAirport/{iataCode}', [AirportController::class, 'deleteAirport']);
Route::get('editAirport/{iataCode}', [AirportController::class, 'editAirport']);
Route::post('editAirport', [AirportController::class, 'updateAirport']);

Route::post('plaats', [newcontractcontroller::class, 'plaats']);
Route::get('new_contract', [newcontractcontroller::class, 'dropdown']);

