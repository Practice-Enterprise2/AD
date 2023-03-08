<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;


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
    return view('app');
});


Route::get('/home', function () {
    return View::make('app');
})->name('home');

Route::get('/page2', function () {
    return view('page2');
});

Route::get('create-pickup', function () {
    return view('create-pickup');
})->middleware(['auth', 'verified'])->name('create-pickup');

Route::get('/dashboard/my-pickups', function () {
    return view('dashboard.my_pickups');
})->middleware(['auth', 'verified'])->name('my-pickups');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
