<?php

// All routes defined here are automatically assigned to the `web` middleware
// group.

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeViewController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Publicly available routes.
Route::view('/home', 'app')->name('home');

Route::redirect('/', 'home');

// Routes that require an authenticated session with a verified email.
/* Route::middleware(['auth', 'verified'])->group(function () { */
    /*
     * Normal views, that can optionally take extra data.
     */

    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/new_employee', 'add_employee')->name('employee.create');
    Route::view('/respond', 'respond');

    /*
     * Resource controllers.
     */

    Route::resource('pickup', PickupController::class)
        ->only(['create', 'index'])
        ->names(['create' => 'create-pickup', 'index' => 'my-pickups']);

    /*
     * Controllers that require custom code to be run for a request.
     */

    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employee', 'employee_page')->name('employee');
        Route::get('/overview_employee', 'employees')->name('employee-overview');
    });

    Route::controller(EmployeeViewController::class)->group(function () {
        Route::get('/employee_overview', 'index');
        Route::post('/employee_add', 'save');
    });

    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin', 'admin_page')->name('admin');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/admin/users', 'show')->name('users');
        Route::put('/admin/users/{id}', 'update')->name('users.update');
        Route::delete('/admin/users/{id}', 'destroy')->name('users.destroy');
        Route::post('/admin/users', 'store')->name('users.store');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get('/admin/roles', 'show')->name('roles');
        Route::put('/admin/roles/{id}', 'update')->name('roles.update');
        Route::delete('admin/roles/{id}', 'destroy')->name('roles.destroy');
        Route::post('/admin/roles', 'store')->name('roles.store');
    });

    Route::controller(TicketController::class)->group(function () {
        Route::get('/create-ticket', 'showForm')->name('create-ticket');
        Route::post('/submitted-ticket', 'store')->name('submitted-ticket');
        Route::get('/submitted-ticket', 'showSubmittedTicket')->name('show-ticket');
    });

/* }); */

// Routes that require an authenticated session.
Route::middleware('auth')->group(function () {
    Route::view('/email/verify', 'auth.verify-email')->name('verification.notice');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

//email verification
/*
Route::get('/email/verify', function () {
    return view('auth.verify-email');
}); ->middleware('auth')->name('verification.notice'); 
*/

// Shipment Pages
Route::get('/shipment', function() {
    return view('shipment');
});
Route::get('/createShipment', function () {
    return view('createShipment');
});
Route::get('/shipmentOverview', function() {
    return view('shipmentOverview');
});

Route::get('/shipmentOverview/{id}',[ShipmentController::class, 'getShipmentInfo']);
Route::post('shipment', 'App\Http\Controllers\ShipmentController@insert');

Route::get('/shipmentDashboard', function() {
    return view('shipmentDashboard');
});
Route::get('/shipmentPerUser', [ShipmentController::class, 'getShipmentPerUser']);
Route::get('/shipmentConfirm', function() {
    return view('shipmentConfirm');
});


// Invoice
//Route::get('payment','App\Http\Controllers\Controller@insertform');
/* 
Route::get('/payment', function () {
    return view('payment');     
})->middleware(['auth', 'verified'])->name('payment');
Route::get('/paymentSuccess', function () {
    return view('paymentSuccess');
})->middleware(['auth', 'verified'])->name('paymentSuccess');
 */
// Airport Routes

// Depot routes



require __DIR__ . '/auth.php';
