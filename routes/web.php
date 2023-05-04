<?php

// All routes defined here are automatically assigned to the `web` middleware
// group.

use App\Http\Controllers\AirportController;
use App\Http\Controllers\contractController;
use App\Http\Controllers\contractlistcontroller;
use App\Http\Controllers\ControlPanelController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeViewController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\newcontractcontroller;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaypointController;
use App\Models\Employee;
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
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

// Publicly available routes.
Route::view('/home', 'app')->name('home');

Route::redirect('/', 'home');

Route::get('/airlines', 'App\Http\Controllers\ApiController@apiCall')->name('airlines.apiCall');

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
        Route::get('/employee', 'employee_page')->name('employee')->middleware('permission:view_general_employee_content');
        Route::get('/overview_employee', 'employees')->name('employee-overview');
    });

    Route::controller(EmployeeViewController::class)->group(function () {
        Route::get('/employee_overview', 'index');
        Route::post('/employee_add', 'save');
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
        Route::get('/customers', 'getCustomers')->name('customers')->middleware('permission:view_all_users');
        Route::get('/customers/{id}/edit', 'edit')->name('customer.edit');
        Route::put('/customers/{id}', 'update')->name('customer.update');
    });

    Route::controller(ControlPanelController::class)->middleware('permission:view_all_roles|view_all_users|view_basic_server_info|view_detailed_server_info|edit_roles')->prefix('/control-panel')->group(function () {
        Route::get('/', ControlPanelController::class)->name('control-panel');
        Route::name('control-panel.')->group(function () {
            Route::get('/security', 'security')->name('security')->middleware('permission:view_detailed_server_info');
            Route::get('/users', 'users')->name('users')->middleware('permission:view_all_users');
            Route::get('/users/{user}/edit', 'users_edit')->name('users.edit')->middleware('permission:edit_any_user_info');
            Route::get('/roles', 'roles')->name('roles')->middleware('permission:view_all_roles');
            Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission:create_role');
            Route::get('/roles/{role}/edit', 'roles_edit')->name('roles.edit')->middleware('permission:edit_roles');
            Route::get('/permissions', 'permissions')->name('permissions')->middleware('permission:view_all_permissions');
            Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('permission:edit_permissions');
            Route::get('/info', 'info')->name('info')->middleware('permission:view_basic_server_info|view_detailed_server_info');
            Route::get('/log', 'log')->name('log')->middleware('permission:view_detailed_server_info');
        });
    });
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
Route::get('/employee', function () {
    return Auth::user()->roles()->first()->name == 'employee' ||
        Auth::user()->roles()->first()->name == 'admin' ? view('employee') : abort(404);
})->middleware(['auth', 'verified'])->name('employee');

//admin page
Route::get('/admin', function () {
    return Auth::user()->roles()->first()->name == 'admin' ? view('admin') : abort(404);
})->middleware(['auth', 'verified'])->name('admin');

//user page
Route::get('/admin/users', [UserController::class, 'show'], function () {
    return Auth::user()->roles()->first()->name == 'admin' ? view('admin.users') : abort(404);
})->middleware(['auth', 'verified'])->name('users');
Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');

//roles page
Route::get('/admin/roles', [RoleController::class, 'show'], function () {
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
    Route::get('/shipments', [ShipmentController::class, 'index'])->name('shipments.index');
    Route::get('/shipments/{shipment}/edit', [ShipmentController::class, 'edit'])->name('shipments.edit');
    Route::patch('/shipments/{shipment}', [ShipmentController::class, 'update'])->name('shipments.update');
    Route::delete('/shipments/{shipment}', [ShipmentController::class, 'destroy'])->name('shipments.destroy');
    Route::get('/shipments/{shipment}', [ShipmentController::class, 'show'])->name('shipments.show');

    //Email for invoice
    Route::get('/mail/invoices/{invoice}', [ShipmentController::class, 'sendInvoiceMail'])->name('mail.invoices');

    //Notification
    Route::get('/markAsRead', function () {
        auth()->user()->unreadNotifications->markAsRead();
    });

    //WaypointController
    Route::get('shipments/requests/evaluate/{shipment}/set', [WaypointController::class, 'create'])->name('shipments.requests.evaluate.set'); //create
    Route::post('shipments/requests/evaluate/{shipment}/set/store', [WaypointController::class, 'store'])->name('shipments.requests.evaluate.set.store');
    Route::get('shipments/{shipment}/update-waypoint', [WaypointController::class, 'update'])->name('shipments.update-waypoint');

    //FAQ page
    Route::get('/faq', [FaqController::class, 'show'])->name('faq.show');
});

Route::get('/overview', function () {
    $tickets = DB::select('SELECT ticketID, cstID, employeeID, issue, description, solution, status FROM tickets');

    // dd($tickets);

    // return redirect()->route('dump');
    return view('overview', ['tickets' => $tickets]);
});

// Route::get('/dump', 'ticket_overview@dump')->name('dump');

Route::get('/create-ticket', [TicketController::class, 'showForm'])->name('create-ticket');
Route::post('/submitted-ticket', [TicketController::class, 'store'])->name('submitted-ticket');
Route::get('/submitted-ticket', [TicketController::class, 'showSubmittedTicket'])->name('show-ticket');

//  contracts view
Route::get('contract', [contractController::class, 'simpleV2']);
Route::get('edit', [contractController::class, 'alter']);
Route::get('contractGet', [contractController::class, 'simpleIndex']);
Route::get('specif', function () {
    return view('specific-contracts');
});

require __DIR__.'/auth.php';

//contractmenu
Route::get('contractsMenu', function () {
    return view('contractsMenu');
});
//airportlist
Route::get('airportList', [AirportController::class, 'airportFiltering']);

// Add, delete and edit airportList
Route::post('airportList', [AirportController::class, 'addAirport']);
Route::get('deleteAirport/{id}', [AirportController::class, 'deleteAirport']);
Route::get('editAirport/{id}', [AirportController::class, 'editAirport']);
Route::post('editAirport', [AirportController::class, 'updateAirport']);

Route::post('plaats', [newcontractcontroller::class, 'plaats']);
Route::get('new_contract', [newcontractcontroller::class, 'dropdown']);
Route::get('/contract_pdf/{id}', [contractlistcontroller::class, 'contract_pdf'])->name('contract_pdf');

//contract list
Route::get('/contract_list', function () {
    return view('contract_list');
});

Route::get('contract_list', [contractlistcontroller::class, 'index']);
Route::get('contract_list', [contractlistcontroller::class, 'contractFiltering']);
// Email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

require __DIR__.'/auth.php';
