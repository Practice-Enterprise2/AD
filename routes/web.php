<?php

// All routes defined here are automatically assigned to the `web` middleware
// group.

use App\Http\Controllers\AiGraphController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ControlPanelController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerOrderHistoryController;
use App\Http\Controllers\EmployeeComplaintController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\JobVacanciesController;
use App\Http\Controllers\NotificationController;
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
use App\Models\Review;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Publicly available routes.
Route::view('/', 'landing-page')->name('landing-page');
Route::view('/help', 'help')->name('help');
Route::get('/airlines', [ApiController::class, 'apiCall'])->name('airlines.apiCall');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');

//job vacancies person
Route::get('/viewJobs', [JobVacanciesController::class, 'get_jobs_applicant'])->name('view_jobs');
Route::get('/viewJobs/{job}/apply', [JobVacanciesController::class, 'open_job'])->name('open_job');
Route::post('/viewJobs/job/apply', [JobVacanciesController::class, 'apply_job'])->name('JobVacanciesController.apply');

// Routes that require an authenticated session with a verified email.
Route::middleware(['auth', 'verified'])->group(function () {
    /*
     * Normal views, that can optionally take extra data.
     */

    Route::view('/respond', 'respond');
    Route::view('/employee', 'employee')->name('employee')->middleware('permission:view_general_employee_content');
    Route::view('/employees/create', 'employees.create')->name('employees.create')->can('create', Employee::class);

    /*
     * Controllers that require custom code to be run for a request.
     */

    Route::controller(PickupController::class)->group(function () {
        Route::get('/pickups/create', 'create')->name('pickups.create');
        Route::get('/pickups', 'index')->name('pickups.index');
        Route::get('/pickups/{pickup}/edit', 'edit')->name('pickups.edit');
    });

    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employees', 'index')->name('employees.index')->middleware('permission:view_employee_count');
        Route::post('/employees', 'store')->name('employees.store')->can('create', Employee::class);
        Route::get('/employees/{employee}/edit', 'edit')->name('employees.edit')->middleware('permission:edit_any_employee');
        Route::post('/employees/{employee}', 'update')->name('employees.update')->middleware('permission:edit_any_employee');
        Route::get('/employee_add_contract', 'contract_index')->name('contract.index')->middleware('permission:change_employee_contracts');
        Route::post('/employee_add_contract_done', 'contract_save')->name('employee-add-contract')->middleware('permission:change_employee_contracts');
        Route::get('/employee_view_contracts', 'view_contracts_index')->name('employee-view-contracts')->middleware('permission:change_employee_contracts');
        Route::post('/employee_view_contracts/details', 'employeeContractDetails')->name('employee-contract-details')->middleware('permission:change_employee_contracts');
        Route::get('/employee_contract_search', 'searchEmployeeContract')->name('employee-contract-search')->middleware('permission:change_employee_contracts');
        Route::post('/employee_view_contracts/pdf', 'createEmployeeContractPDF')->name('employee-download-contract')->middleware('permission:change_employee_contracts');
    });

    Route::controller(InvoicesController::class)->group(function () {
        Route::get('/invoices_list', 'viewAllInvoices')->name('invoice-list')->middleware('permission:view_all_invoices');
        Route::post('/invoices_list/details', 'viewInvoiceDetails')->name('invoice-details')->middleware('permission:view_all_invoices');
        Route::get('/invoices_list/details/mail', 'invoiceMail')->name('invoice-mail')->middleware('permission:view_all_invoices');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/admin/users', 'show')->name('users')->can('viewAny', User::class);
        Route::post('/admin/users', 'store')->name('users.store');
        Route::put('/admin/users/{id}', 'update')->name('users.update');
        Route::delete('/admin/users/{id}', 'destroy')->name('users.destroy');
        Route::put('/users/{user}/toggle-lock', 'toggleLock')->name('users.toggle-lock');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get('/admin/roles', 'index')->name('roles');
        Route::post('/admin/roles', 'store')->name('roles.store');
        Route::put('/admin/roles/{id}', 'update')->name('roles.update');
        Route::delete('/admin/roles/{id}', 'destroy')->name('roles.destroy');
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

    Route::get('/hrViewJobs', [JobVacanciesController::class, 'get_jobs_hr'])->name('hr_view_jobs')->middleware('permission:add_vacant_jobs|edit_vacant_jobs');
    Route::view('/hrViewJobs/addJob', 'job-vacancies.add_job')->name('job.add')->middleware('permission:add_vacant_jobs');
    Route::post('/hrViewJobs/vacantJob_add', [JobVacanciesController::class, 'add_job'])->name('JobVacanciesController.add');
    Route::post('/hrViewJobs/filled', [JobVacanciesController::class, 'mark_filled'])->name('JobVacanciesController.filled');
    Route::get('/hrViewJobs/{job}/applicants', [JobVacanciesController::class, 'view_applicants'])->name('view_applicants')->middleware('permission:edit_vacant_jobs');
    Route::get('/hrViewJobs/{applicant}/openCV', [JobVacanciesController::class, 'open_cv'])->name('open_cv')->middleware('permission:edit_vacant_jobs');
    Route::view('/employeeComplaint', 'employeeComplaints')->name('employee_complaints')->middleware('permission:view_general_employee_content');
    Route::post('/employeeComplaint/send', [EmployeeComplaintController::class, 'sendComplaint'])->name('sendEmployeeComplaint');

    Route::controller(GraphController::class)->group(function () {
        Route::get('/employeegraph', 'index')->middleware('permission:view_employee_count')->name('employeegraph');
    });

    Route::controller(AiGraphController::class)->group(function () {
        Route::get('/ai-graph', 'index')->middleware('permission:view_all_orders')->name('ai-graph');
    });

    Route::controller(ReviewController::class)->group(function () {
        Route::get('/reviews/create', 'create')->name('reviews.create')->can('create', Review::class);
        Route::post('/reviews', 'store')->name('reviews.store')->can('create', Review::class);
    });

    Route::controller(WaypointController::class)->group(function () {
        Route::get('shipments/requests/evaluate/{shipment}/set', 'create')->name('shipments.requests.evaluate.set')->middleware('permission:edit_all_shipments');
        Route::post('shipments/requests/evaluate/{shipment}/set/store', 'store')->name('shipments.requests.evaluate.set.store')->middleware('permission:edit_all_shipments');
        Route::get('shipments/{shipment}/confirm-waypoint', 'confirmWaypoint')->name('shipments.confirm-waypoint')->middleware('permission:edit_all_shipments');
        Route::get('shipments/{shipment}/exception-waypoint', 'exceptionWaypoint')->name('shipments.exception-waypoint')->middleware('permission:edit_all_shipments');
        Route::get('shipments/{shipment}/update-waypoint', 'update')->name('shipments.update-waypoint')->middleware('permission:edit_all_shipments');
    });

    Route::controller(ShipmentController::class)->group(function () {
        Route::get('/shipments', 'index')->name('shipments.index');
        Route::get('/shipments/list-shipments', 'listShipments')->name('shipments.listShipments');
        Route::get('/shipments/create', 'create')->name('shipments.create')->can('create', Shipment::class);
        Route::post('/shipments', 'store')->name('shipments.store')->can('create', Shipment::class);
        Route::get('/shipments/requests', 'requests')->name('shipments.requests')->can('acceptAny', Shipment::class);
        Route::post('shipments/requests/{shipment}/evaluate', 'evaluate')->name('shipments.requests.evaluate')->can('accept', 'shipment');
        Route::get('/shipments/{shipment}', 'show')->name('shipments.show')->can('view', 'shipment');
        Route::get('/shipments/{shipment}/edit', 'edit')->name('shipments.edit')->can('update', 'shipment');
        Route::match(['PUT', 'PATCH'], '/shipments/{shipment}', 'update')->name('shipments.update')->can('update', 'shipment');
        Route::delete('/shipments/{shipment}', 'destroy')->name('shipments.destroy')->can('delete', 'shipment');

        Route::get('/mail/invoices/{invoice}', 'sendInvoiceMail')->name('mail.invoices');
        Route::get('/shipments/{shipment}/track-shipment', 'track')->name('shipments.track');
    });
});

// Routes that require an authenticated session.
Route::middleware('auth')->group(function () {
    /*
     * Normal views, that can optionally take extra data.
     */

    Route::view('/home', 'app')->name('home');

    /*
     * Controllers that require custom code to be run for a request.
     */

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::controller(ContactController::class)->group(function () {
        Route::get('/contact', 'create')->name('contact.create');
        Route::post('/contact', 'store')->name('contact.store');
        Route::get('/contact/manager', 'index')->name('contact.index')->middleware('permission:view_all_complaints');
        Route::delete('/contact/{id}', 'destroy')->name('contact.destroy')->middleware('permission:view_all_complaints');
        Route::get('/contact/{id}', 'show')->name('contact.show')->middleware('permission:view_all_complaints');
    });

    Route::controller(ComplaintsController::class)->group(function () {
        Route::post('/contact/{id}', 'createChat')->name('chatbox.create')->middleware('permission:view_all_complaints');
        Route::get('/messages', 'messages')->name('complaints.messages');
        Route::get('/messages/content/{id}', 'viewChat')->name('complaint.viewMessage');
        Route::post('/chat-message', 'sendMessage');
    });

    Route::controller(NotificationController::class)->group(function () {
        Route::get('/markAsRead', 'mark_all_as_read')->name('notifications.mark_all_as_read');
        Route::get('/markAsRead/{id}', 'mark_as_read')->name('notifications.mark_as_read');
    });

    Route::controller(CustomerOrderHistoryController::class)->group(function () {
        Route::get('/order_history', 'index')->name('order-history');
    });
    Route::controller(InvoiceController::class)->group(function () {
        //Invoice overview & payment
        Route::get('/invoices', 'index')->name('invoice_overview');
        Route::get('/invoices/{id}/payment', 'nav_pay')->name('invoices.payment');
        Route::get('/invoices/{id}/payment/success', 'pay')->name('invoices.payment_success');
        Route::get('/invoices/{id}/pdf', 'createPDF')->name('createPDF');
    });
});

require __DIR__.'/auth.php';
