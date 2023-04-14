<?php

// All routes defined here are automatically assigned to the `web` middleware
// group.

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeViewController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
<<<<<<< Updated upstream
use App\Http\Controllers\CustomerController;
=======
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WaypointController;
use App\Models\Employee;
use App\Models\User;
>>>>>>> Stashed changes
use Illuminate\Support\Facades\Route;

// Publicly available routes.
Route::view('/home', 'app')->name('home');

Route::redirect('/', 'home');

// Routes that require an authenticated session with a verified email.
Route::middleware(['auth', 'verified'])->group(function () {
    /*
     * Normal views, that can optionally take extra data.
     */

    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/new_employee', 'add_employee')->name('employee.create');
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
        Route::put('/users/{user}/toggle-lock', 'toggleLock')->name('users.toggle-lock');
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
    Route::resource('/vehicle', VehicleController::class);

<<<<<<< Updated upstream
    Route::get('/customers', [CustomerController::class, 'getCustomers'])->name('customers');
    Route::get('/customers/{id}/edit', 'App\Http\Controllers\CustomerController@edit')->name('customer.edit');
    Route::put('/customers/{id}', 'App\Http\Controllers\CustomerController@update')->name('customer.update');


=======
    Route::controller(ControlPanelController::class)->middleware('permission:view_all_roles|view_all_users|view_basic_server_info|view_detailed_server_info|edit_roles')->prefix('/control-panel')->group(function () {
        Route::get('/', ControlPanelController::class)->name('control-panel');
        Route::name('control-panel.')->group(function () {
            Route::get('/security', 'security')->name('security')->middleware('permission:view_detailed_server_info');
            Route::get('/users', 'users')->name('users')->middleware('permission:view_all_users');
            Route::get('/users/{user}/edit', 'users_edit')->name('users.edit')->middleware('permission:edit_any_user_info');
            Route::get('/groups', 'groups')->name('groups')->middleware('permission:view_all_roles');
            Route::get('/groups/create', [RoleController::class, 'create'])->name('groups.create')->middleware('permission:create_role');
            Route::get('/groups/{group}/edit', 'groups_edit')->name('groups.edit')->middleware('permission:edit_roles');
            Route::get('/permissions', 'permissions')->name('permissions')->middleware('permission:view_all_permissions');
            Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('permission:edit_permissions');
            Route::get('/info', 'info')->name('info')->middleware('permission:view_basic_server_info|view_detailed_server_info');
            Route::get('/log', 'log')->name('log')->middleware('permission:view_detailed_server_info');
        });
    });
    
>>>>>>> Stashed changes

});

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
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

require __DIR__.'/auth.php';
