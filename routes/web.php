<?php

use App\Http\Controllers\ProfileController;
use App\Models\Role;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\employeeViewController;
use App\Http\Controllers\CustomerOvervieuw;

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
        Auth::user()->roles()->first()->name == 'admin' ? view('employee_overview') : abort(403);
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

Route::get('employee_overview',[employeeViewController::class, 'index']);
Route::get('/new_employee', function () {
    return view('Addemployee');
});
Route::post('employee_add',[employeeViewController::class, 'save']);


route::get("/respond", function(){
    return view("respond");
});

require __DIR__ . '/auth.php';
