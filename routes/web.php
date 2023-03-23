<?php

use App\Http\Controllers\contactController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\shipmentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('app');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/shipment', [shipmentController::class, 'index'])->name('shipment.index');
    Route::get('/shipment/create', [shipmentController::class, 'create'])->name('shipment.create');
    Route::post('/shipment', [shipmentController::class, 'store'])->name('shipment.store');
    Route::get('/shipment/{id}', [shipmentController::class , 'show'])->name('shipment.show');
    Route::delete("/shipment/{id}", [shipmentController::class, 'destroy'])->name('shipment.destroy');
    Route::get('/shipment/ajax', [shipmentController::class, 'AjaxShipment'])->name('shipment.ajax');
    Route::get('/contact', [contactController::class, 'create'])->name('contact.create');
    Route::post('/contact', [contactController::class, 'store'])->name('contact.store');
    Route::get('/contact/manager', [contactController::class, 'index'])->name('contact.index');
    Route::delete('/contact/{id}', [contactController::class, 'destroy'])->name('contact.destroy');
    Route::get('/contact/{id}', [contactController::class, 'show'])->name('contact.show');
});

require __DIR__.'/auth.php';
