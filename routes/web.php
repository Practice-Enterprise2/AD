<?php

use App\Http\Controllers\ProfileController;
use App\Models\Role;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShipmentController;
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
 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//roles() method gives an error but it still works (I have no idea how or why)
Route::get('/employee', function(){
    return Auth::user()->roles()->first()->name == 'employee' || 
        Auth::user()->roles()->first()->name == 'admin' ? view('employee') : abort(403);
})->middleware(['auth', 'verified'])->name('employee');

Route::get('/admin', function(){
    //this gives an error but it works
    return Auth::user()->roles()->first()->name == 'admin' ? view('admin') : abort(403);
})->middleware(['auth', 'verified'])->name('admin');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
