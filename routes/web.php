<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TicketController;

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

Route::get('/page2', function(){
    return view('page2');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/overview', function ()
{
    $tickets = DB::select('SELECT ticketID, cstID, employeeID, issue, description, solution, status FROM tickets');

    // dd($tickets);

    // return redirect()->route('dump');
    return view('overview', ['tickets' => $tickets]);
});

// Route::get('/dump', 'ticket_overview@dump')->name('dump');

Route::get('/create-ticket', [TicketController::class, 'showForm'])->name('create-ticket');
Route::post('/submitted-ticket',  [TicketController::class, 'store'])->name('submitted-ticket');
Route::get('/submitted-ticket', [TicketController::class, 'showSubmittedTicket'])->name('show-ticket');