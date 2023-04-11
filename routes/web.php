<?php

// All routes defined here are automatically assigned to the `web` middleware
// group.

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeViewController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaypointController;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;
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
// Publicly available routes.
Route::view('/home', 'app')->name('home');

Route::redirect('/', 'home');

// Routes that require an authenticated session with a verified email.
Route::middleware(['auth', 'verified'])->group(function () {
    /*
     * Normal views, that can optionally take extra data.
     */

    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/new_employee', 'add_employee')->name('employee.create')->can('create', Employee::class);
    Route::view('/respond', 'respond');

    /*
     * Routes that offer functionality for resources.
     */

    Route::controller(PickupController::class)->group(function () {
        Route::get('/pickups/create/{shipment_id?}', 'create')->name('pickups.create');
        Route::get('/pickups', 'index')->name('pickups.index');
        Route::get('/pickups/{pickup}/edit', 'edit')->name('pickups.edit');
    });

    /*
     * Controllers that require custom code to be run for a request.
     */

    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employee', 'employee_page')->name('employee')->middleware('can:view_general_employee_content');
        Route::get('/overview_employee', 'employees')->name('employee-overview');
    });

    Route::controller(EmployeeViewController::class)->group(function () {
        Route::get('/employee_overview', 'index');
        Route::post('/employee_add', 'save');
    });

    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin', 'admin_page')->name('admin')->middleware('role:admin');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/admin/users', 'show')->name('users')->can('viewAny', User::class);
        Route::put('/admin/users/{id}', 'update')->name('users.update');
        Route::delete('/admin/users/{id}', 'destroy')->name('users.destroy');
        Route::post('/admin/users', 'store')->name('users.store');
        Route::put('/users/{user}/toggle-lock', 'toggleLock')->name('users.toggle-lock');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get('/admin/roles', 'index')->name('roles');
        Route::put('/admin/roles/{id}', 'update')->name('roles.update');
        Route::delete('/admin/roles/{id}', 'destroy')->name('roles.destroy');
        Route::post('/admin/roles', 'store')->name('roles.store');
    });

    Route::controller(TicketController::class)->group(function () {
        Route::get('/create-ticket', 'showForm')->name('create-ticket');
        Route::post('/submitted-ticket', 'store')->name('submitted-ticket');
        Route::get('/submitted-ticket', 'showSubmittedTicket')->name('show-ticket');
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customers', 'getCustomers')->name('customers')->middleware('can:view_all_users');
        Route::get('/customers/{id}/edit', 'edit')->name('customer.edit');
        Route::put('/customers/{id}', 'update')->name('customer.update')->middleware('role:employee|admin');
    });
});

Route::get('/orders', [OrderController::class, 'index'])->middleware(['auth', 'verified'])->name('orders.index');

Route::get('/orders/create', [OrderController::class, 'create'])->middleware(['auth', 'verified'])->name('orders.create');

Route::post('/orders', [OrderController::class, 'store'])->middleware(['auth', 'verified'])->name('orders.store');

Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->middleware(['auth', 'verified'])->name('orders.edit');

Route::patch('/orders/{order}', [OrderController::class, 'update'])->middleware(['auth', 'verified'])->name('orders.update');

Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->middleware(['auth', 'verified'])->name('orders.destroy');


Route::get('/shipments', [ShipmentController::class, 'index'])->middleware(['auth', 'verified'])->name('shipments.index');

Route::get('/shipments/create', [ShipmentController::class, 'create'])->middleware(['auth', 'verified'])->name('shipments.create');

Route::post('/shipments', [ShipmentController::class, 'store'])->middleware(['auth', 'verified'])->name('shipments.store');

Route::get('/shipments/{shipment}/edit', [ShipmentController::class, 'edit'])->middleware(['auth', 'verified'])->name('shipments.edit');

Route::patch('/shipments/{shipment}', [ShipmentController::class, 'update'])->middleware(['auth', 'verified'])->name('shipments.update');

Route::delete('/shipments/{shipment}', [ShipmentController::class, 'destroy'])->middleware(['auth', 'verified'])->name('shipments.destroy');


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


// Routes that require an authenticated session.
Route::middleware('auth')->group(function () {
    Route::view('/email/verify', 'auth.verify-email')->name('verification.notice');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    //ShipmentController
    Route::get('/shipments/create', [ShipmentController::class, 'create'])->name('shipments.create');
    Route::post('/shipments/store', [ShipmentController::class, 'store'])->name('shipments.store');
    Route::get('shipments/requests', [ShipmentController::class, 'requests'])->name('shipments.requests');
    Route::post('shipments/requests/{shipment}/evaluate', [ShipmentController::class, 'evaluate'])->name('shipments.requests.evaluate');
    Route::get('/shipments/show', [ShipmentController::class, 'index'])->name('shipments.index');

    //WaypointController
    Route::get('shipments/requests/evaluate/{shipment}/set', [WaypointController::class, 'create'])->name('shipments.requests.evaluate.set'); //create
    Route::post('shipments/requests/evaluate/{shipment}/set/store', [WaypointController::class, 'store'])->name('shipments.requests.evaluate.set.store');
    Route::get('shipments/{shipment}/update-waypoint', [WaypointController::class, 'update'])->name('shipments.update-waypoint');
});

// Email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

require __DIR__.'/auth.php';

Route::get('/airlines', 'App\Http\Controllers\ApiController@apiCall')->name('airlines.apiCall');
Route::get('/api-call', 'ApiController@apiCall');
