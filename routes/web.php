<?php

// All routes defined here are automatically assigned to the `web` middleware
// group.

use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ControlPanelController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeViewController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaypointController;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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
        Route::get('/employee_add_contract', 'contract_index')->name('contract-index');
        Route::post('/employee_add_contract_done', 'contract_save')->name('employee-add-contract');
    });
    Route::controller(EmployeeViewController::class)->group(function () {
        Route::get('/employee_overview', 'index')->name('employee.overview');
        Route::post('/employee_add', 'save')->name('save-employee');
        Route::get('/new_employee', 'showAdd')->name('employee.create');
        Route::post('/employee_edit', 'employeeEdit');
        //Route::('/employee_edit_done', 'employeeEditSave')->name('employee-edit-save');
        Route::post('/employee_edit_save', 'employeeEditSave');
        Route::get('/employee_search', 'searchEmployee')->name("employee-search");
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
            Route::get('/employees', 'employees')->name('employees')->middleware('permission:view_all_employees');
            Route::get('/employees/create', 'employees_create')->name('employees.create')->middleware('permission:add_employee');
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

    //contact and messages
    Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/contact/manager', [ContactController::class, 'index'])->name('contact.index')->middleware('permission:view_all_complaints');
    Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy')->middleware('permission:view_all_complaints');
    Route::get('/contact/{id}', [ContactController::class, 'show'])->name('contact.show')->middleware('permission:view_all_complaints');
    Route::post('/contact/{id}', [ComplaintsController::class, 'createChat'])->name('chatbox.create')->middleware('permission:view_all_complaints');
    Route::get('/messages', [ComplaintsController::class, 'messages'])->name('complaints.messages');
    Route::get('/messages/content/{id}', [ComplaintsController::class, 'viewChat'])->name('complaint.viewMessage');
    Route::post('/chat-message', [ComplaintsController::class, 'sendMessage']);

    //Email for invoice
    Route::get('/mail/invoices/{invoice}', [ShipmentController::class, 'sendInvoiceMail'])->name('mail.invoices');

    //Notification
    Route::get('/markAsRead', function () {
        auth()->user()->unreadNotifications->markAsRead();
    });
    Route::get('/markAsRead/{id}', function ($id) {
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
    });

    //WaypointController
    Route::get('shipments/requests/evaluate/{shipment}/set', [WaypointController::class, 'create'])->name('shipments.requests.evaluate.set'); //create
    Route::post('shipments/requests/evaluate/{shipment}/set/store', [WaypointController::class, 'store'])->name('shipments.requests.evaluate.set.store');
    Route::get('shipments/{shipment}/update-waypoint', [WaypointController::class, 'update'])->name('shipments.update-waypoint');

    //FAQ page
    Route::get('/faq', [FaqController::class, 'show'])->name('faq.show');
    //review page
    Route::get('/review', [ReviewController::class, 'show'])->name('review');
    Route::post('/review_add', [ReviewController::class, 'save']);
    Route::get('/readreviews', [ReviewController::class, 'showread'])->name('readreviews');
    Route::get('/filterreview', [ReviewController::class, 'filter']);

    // Email verification
    Route::view('/email/verify', 'auth.verify-email')
        ->name('verification.notice');
});

Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');

require __DIR__.'/auth.php';
