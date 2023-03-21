<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Models\Role;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
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
 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//roles() method gives an error but it still works (I have no idea how or why)
Route::get('/employee', function(){
    return Auth::user()->roles()->first()->name == 'employee' || 
        Auth::user()->roles()->first()->name == 'admin' ? view('employee') : abort(404);
})->middleware(['auth', 'verified'])->name('employee');

Route::get('/admin', function(){
    return Auth::user()->roles()->first()->name == 'admin' ? view('admin') : abort(404);
})->middleware(['auth', 'verified'])->name('admin');
Route::get('/admin/users', function(){
    return Auth::user()->roles()->first()->name == 'admin' ? view('admin.users') : abort(404);
})->middleware(['auth', 'verified'])->name('users');
Route::get('/admin/roles', [RoleController::class, 'show'],  function(){
    return Auth::user()->roles()->first()->name == 'admin' ? view('admin.roles') : abort(404);
})->middleware(['auth', 'verified'])->name('roles');
Route::put('/admin/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('admin/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
Route::post('/admin/roles', [RoleController::class, 'store'])->name('roles.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
