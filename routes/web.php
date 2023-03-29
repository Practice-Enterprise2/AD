<?php

use App\Http\Controllers\employeeViewController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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

// roles() method gives an error but it still works (I have no idea how or why)
Route::get('/employee', function () {
    return 'employee' == Auth::user()->roles()->first()->name ||
        'admin' == Auth::user()->roles()->first()->name ? view('employee') : abort(404);
})->middleware(['auth', 'verified'])->name('employee');

// admin page
Route::get('/admin', function () {
    return 'admin' == Auth::user()->roles()->first()->name ? view('admin') : abort(404);
})->middleware(['auth', 'verified'])->name('admin');

// user page
Route::get('/admin/users', [UserController::class, 'show'], function () {
    return 'admin' == Auth::user()->roles()->first()->name ? view('admin.users') : abort(404);
})->middleware(['auth', 'verified'])->name('users');
Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');

// roles page
Route::get('/admin/roles', [RoleController::class, 'show'], function () {
    return 'admin' == Auth::user()->roles()->first()->name ? view('admin.roles') : abort(404);
})->middleware(['auth', 'verified'])->name('roles');
Route::put('/admin/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/admin/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
Route::post('/admin/roles', [RoleController::class, 'store'])->name('roles.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('employee_overview', [employeeViewController::class, 'index']);
Route::get('/new_employee', function () {
    return view('Addemployee');
});
Route::post('employee_add', [employeeViewController::class, 'save']);

route::get('/respond', function () {
    return view('respond');
});

Route::get('/overview_employee', function () {
    $tickets = DB::select('SELECT ticketID, cstID, employeeID, issue, description, solution, status FROM tickets');

    // dd($tickets);

    // return redirect()->route('dump');
    return view('employee_view', ['tickets' => $tickets]);
});

// Route::get('/dump', 'ticket_overview@dump')->name('dump');

Route::get('/create-ticket', [TicketController::class, 'showForm'])->name('create-ticket');
Route::post('/submitted-ticket', [TicketController::class, 'store'])->name('submitted-ticket');
Route::get('/submitted-ticket', [TicketController::class, 'showSubmittedTicket'])->name('show-ticket');

//email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

require __DIR__ . '/auth.php';
