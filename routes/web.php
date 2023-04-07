<?php

// All routes defined here are automatically assigned to the `web` middleware
// group.

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeViewController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

use App\Models\Shipment;
use App\Models\Waypoint;
use App\Models\Address;

// Publicly available routes.
Route::view('/home', 'app')->name('home');

Route::redirect('/', 'home');

// Routes that require an authenticated session with a verified email.
Route::middleware(['auth', 'verified'])->group(function () {
    /*
     * Normal views, that can optionally take extra data.
     */

    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/new_employee', 'add_employee')->name('employee.create');
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
        Route::get('/employee', 'employee_page')->name('employee');
        Route::get('/overview_employee', 'employees')->name('employee-overview');
    });

    Route::controller(EmployeeViewController::class)->group(function () {
        Route::get('/employee_overview', 'index');
        Route::post('/employee_add', 'save');
    });

    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin', 'admin_page')->name('admin');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/admin/users', 'show')->name('users');
        Route::put('/admin/users/{id}', 'update')->name('users.update');
        Route::delete('/admin/users/{id}', 'destroy')->name('users.destroy');
        Route::post('/admin/users', 'store')->name('users.store');
        Route::put('/users/{user}/toggle-lock', 'toggleLock')->name('users.toggle-lock');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get('/admin/roles', 'show')->name('roles');
        Route::put('/admin/roles/{id}', 'update')->name('roles.update');
        Route::delete('admin/roles/{id}', 'destroy')->name('roles.destroy');
        Route::post('/admin/roles', 'store')->name('roles.store');
    });

    Route::controller(TicketController::class)->group(function () {
        Route::get('/create-ticket', 'showForm')->name('create-ticket');
        Route::post('/submitted-ticket', 'store')->name('submitted-ticket');
        Route::get('/submitted-ticket', 'showSubmittedTicket')->name('show-ticket');
    });


    Route::get('/customers', [CustomerController::class, 'getCustomers'])->name('customers');
    Route::get('/customers/{id}/edit', 'App\Http\Controllers\CustomerController@edit')->name('customer.edit');
    Route::put('/customers/{id}', 'App\Http\Controllers\CustomerController@update')->name('customer.update');



});

// Routes that require an authenticated session.
Route::middleware('auth')->group(function () {
    Route::view('/email/verify', 'auth.verify-email')->name('verification.notice');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});


//email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');







//SHIPMENT ROUTES:
Route::get('/shipments/create', function()
{
    return view('shipments.create');
})->name('shipments.create');


Route::post('/shipments/store', function()
{

    $source_address = Address::where([
        'street' => request()->source_street,
        'house_number' => request()->source_housenumber,
        'postal_code' => request()->source_postalcode,
        'city' => request()->source_city,
        'region' => request()->source_region,
        'country' => request()->source_country
    ])->first();

    if(!$source_address)
    {
        $source_address = new Address();
        $source_address->country = request()->source_country;
        $source_address->region = request()->source_region;
        $source_address->postal_code = request()->source_postalcode;
        $source_address->city = request()->source_city;
        $source_address->street = request()->source_street;
        $source_address->house_number = request()->source_housenumber;
        $source_address->push();
    }


    $destination_address = Address::where([
        'street' => request()->destination_street,
        'house_number' => request()->destination_housenumber,
        'postal_code' => request()->destination_postalcode,
        'city' => request()->destination_city,
        'region' => request()->destination_region,
        'country' => request()->destination_country
    ])->first();

    if(!$destination_address)
    {
        $destination_address = new Address();
        $destination_address->country = request()->destination_country;
        $destination_address->region = request()->destination_region;
        $destination_address->postal_code = request()->destination_postalcode;
        $destination_address->city = request()->destination_city;
        $destination_address->street = request()->destination_street;
        $destination_address->house_number = request()->destination_housenumber;
        $destination_address->push();
    }


    $shipment = new Shipment();
    $shipment->sender_id = request()->sender_id;
    $shipment->receiver_name = request()->receiver_name;
    $shipment->receiver_email = request()->receiver_email;
    $shipment->source_address_id = $source_address->id;
    $shipment->destination_address_id = $destination_address->id;
    $shipment->handling_type = request()->handling_type[0];
    $shipment->push();

    dd($shipment->getAttributes(), $source_address->getAttributes(), $destination_address->getAttributes());

    // notify user with the shipment_id as Tracking Number
    return "Tracking Number: " . $shipment->id;

})->name('shipments.store');


Route::get('shipments/requests', function ()
{
    // dd("Catch");
    $shipments = Shipment::where('status', 'Awaiting Confirmation')->get();
    // dd("Catch");
    // dd($shipments);
    return view('/shipments.requests', compact('shipments'));
})->name('shipments.requests');


Route::post('shipments/requests/evaluate/{shipment}', function(Shipment $shipment){
    if (request()->has('decline'))
    {
        $shipment->status = "Declined";
        $shipment->update();
        return back();
    }
    elseif (request()->has('set'))
    {
        return redirect()->route('shipments.requests.evaluate.set', ['shipment' => $shipment]);
    }
    else
    {
        dd('Something gone wrong, refer Route with URI => [shipments/requests/evaluate/{shipment}]');
    }
})->name('shipments.requests.evaluate');


Route::get('shipments/requests/evaluate/{shipment}/set', function(Shipment $shipment){
    // dd($shipment);
    return view('shipments.set', compact('shipment'));
})->name('shipments.requests.evaluate.set');


Route::post('shipments/requests/evaluate/{shipment}/set/store', function(Shipment $shipment){

    $waypoints = collect(request()->waypoints);

    for($i = 0; $i < $waypoints->count(); $i++)
    {
        if($i == 0)
        {
            // $current_address = $shipment->source_address;
            $current_address = Address::where([
                'street' => $shipment->source_address->street,
                'house_number' => $shipment->source_address->house_number,
                'postal_code' => $shipment->source_address->postal_code,
                'city' => $shipment->source_address->city,
                'region' => $shipment->source_address->region,
                'country' => $shipment->source_address->country
            ])->first();

            if(!$current_address)
            {
                $current_address = new Address();
                $current_address->street = $shipment->source_address->street;
                $current_address->house_number = $shipment->source_address->house_number;
                $current_address->postal_code = $shipment->source_address->postal_code;
                $current_address->city = $$shipment->source_address->city;
                $current_address->region = $shipment->source_address->region;
                $current_address->country = $shipment->source_address->country;
                $current_address->save();
            }

            // dd($current_address);

            if(!$current_address)
                dd("Something is wrong with the \$current_address refer:'shipments.requests.evaluate.set.store'.");


            // $next_address = $waypoints[$i];
            $next_address = Address::where([
                'street' => $waypoints[$i]['street'],
                'house_number' => $waypoints[$i]['house_number'],
                'postal_code' => $waypoints[$i]['postal_code'],
                'city' => $waypoints[$i]['city'],
                'region' => $waypoints[$i]['region'],
                'country' => $waypoints[$i]['country']
            ])->first();


            // dd($next_address);
            if(!$next_address)
            {
                $next_address = new Address();
                $next_address->street = $waypoints[$i]['street'];
                $next_address->house_number = $waypoints[$i]['house_number'];
                $next_address->postal_code = $waypoints[$i]['postal_code'];
                $next_address->city = $waypoints[$i]['city'];
                $next_address->region = $waypoints[$i]['region'];
                $next_address->country = $waypoints[$i]['country'];
                $next_address->save();

                // dd($next_address);
            }
            $status = 'Out For Delivery'; // presents this is the current waypoint.
        }
        else
        {
            // $current_address = $waypoints[$i - 1];
            $current_address = Address::where([
                'street' => $waypoints[$i - 1]['street'],
                'house_number' => $waypoints[$i - 1]['house_number'],
                'postal_code' => $waypoints[$i - 1]['postal_code'],
                'city' => $waypoints[$i - 1]['city'],
                'region' => $waypoints[$i - 1]['region'],
                'country' => $waypoints[$i - 1]['country']
            ])->first();

            if(!$current_address)
            {
                $current_address = new Address();
                $current_address->street = $waypoints[$i - 1]['street'];
                $current_address->house_number = $waypoints[$i - 1]['house_number'];
                $current_address->postal_code = $waypoints[$i - 1]['postal_code'];
                $current_address->city = $waypoints[$i - 1]['city'];
                $current_address->region = $waypoints[$i - 1]['region'];
                $current_address->country = $waypoints[$i - 1]['country'];
                $current_address->save();
            }

            // $next_address = $waypoints[$i];

            $next_address = Address::where([
                'street' => $waypoints[$i]['street'],
                'house_number' => $waypoints[$i]['house_number'],
                'postal_code' => $waypoints[$i]['postal_code'],
                'city' => $waypoints[$i]['city'],
                'region' => $waypoints[$i]['region'],
                'country' => $waypoints[$i]['country']
            ])->first();

            // dd($next_address);
            if(!$next_address)
            {
                $next_address = new Address();
                $next_address->street = $waypoints[$i]['street'];
                $next_address->house_number = $waypoints[$i]['house_number'];
                $next_address->postal_code = $waypoints[$i]['postal_code'];
                $next_address->city = $waypoints[$i]['city'];
                $next_address->region = $waypoints[$i]['region'];
                $next_address->country = $waypoints[$i]['country'];
                $next_address->save();

                // dd($next_address);
            }

            $status = 'In Transit';
        }

        $waypoint = new Waypoint();
        $waypoint->shipment_id = $shipment->id;
        $waypoint->status = $status;
        $waypoint->current_address_id = $current_address->id;
        $waypoint->next_address_id = $next_address->id;
        $waypoint->push();
    }

    // Last Waypoint
    $current_address = Address::where([
        'street' => $waypoints[$waypoints->count() - 1]['street'],
        'house_number' => $waypoints[$waypoints->count() - 1]['house_number'],
        'postal_code' => $waypoints[$waypoints->count() - 1]['postal_code'],
        'city' => $waypoints[$waypoints->count() - 1]['city'],
        'region' => $waypoints[$waypoints->count() - 1]['region'],
        'country' => $waypoints[$waypoints->count() - 1]['country']
    ])->first();

    if(!$current_address)
    {
        $current_address = new Address();
        $current_address->street = $waypoints[$waypoints->count() - 1]['street'];
        $current_address->house_number = $waypoints[$waypoints->count() - 1]['house_number'];
        $current_address->postal_code = $waypoints[$waypoints->count() - 1]['postal_code'];
        $current_address->city = $waypoints[$waypoints->count() - 1]['city'];
        $current_address->region = $waypoints[$waypoints->count() - 1]['region'];
        $current_address->country = $waypoints[$waypoints->count() - 1]['country'];
        $current_address->save();
    }

    $next_address = Address::where([
        'street' => $shipment->destination_address->street,
        'house_number' => $shipment->destination_address->house_number,
        'postal_code' => $shipment->destination_address->postal_code,
        'city' => $shipment->destination_address->city,
        'region' => $shipment->destination_address->region,
        'country' => $shipment->destination_address->country
    ])->first();

    if(!$next_address)
    {
        $next_address = new Address();
        $next_address->street = $shipment->destination_address->street;
        $next_address->house_number = $shipment->destination_address->house_number;
        $next_address->postal_code = $shipment->destination_address->postal_code;
        $next_address->city = $$shipment->destination_address->city;
        $next_address->region = $shipment->destination_address->region;
        $next_address->country = $shipment->destination_address->country;
        $next_address->save();
    }


    // dd("flag");
    $waypoint = new Waypoint();
    $waypoint->shipment_id = $shipment->id;
    $waypoint->status = 'In Transit';
    // $waypoint->current_address = $waypoints[$waypoints->count() - 1];
    $waypoint->current_address_id = $current_address->id;
    // $waypoint->next_address = $shipment->destination_address;
    $waypoint->next_address_id = $next_address->id;
    $waypoint->push();

    $shipment->status = 'Awaiting Pickup';
    $shipment->update();
    dd("Check Waypoints Table");
})->name('shipments.requests.evaluate.set.store');


Route::get('/shipments/show', function(){
    $shipments = Shipment::whereNot('status', 'Awaiting Confirmation')
                        ->whereNot('status', 'Declined')
                        ->with('waypoints')
                        ->get();
    return view('shipments.index', compact('shipments'));
})->name('shipments.index');


Route::get('shipments/{shipment}/update-waypoint', function(Shipment $shipment){

    if($shipment->status == "Delivered")
    {
        dd("Shipments is already Delivered!");
    }
    $current_waypoint = $shipment->waypoints()->where('status', 'Out For Delivery')->first();

    // checking if it is the first waypoint
    if($current_waypoint->current_address_id == $shipment->source_address_id)
    {
        // more validation needed later on. (EX: what if there are no transit addresses?)
        $shipment->status = "In Transit";
        $shipment->update();
    }

    if($current_waypoint->next_address_id == $shipment->destination_address_id)
    {
        $current_waypoint->status = "Delivered";
        $current_waypoint->update();
        $shipment->status = "Delivered";
        $shipment->update();
    }
    else
    {
        $next_waypoint = $shipment->waypoints()->where('current_address_id', $current_waypoint->next_address_id)->first();
        $current_waypoint->status = "Delivered";
        $current_waypoint->update();
        $next_waypoint->status = "Out For Delivery";
        $next_waypoint->update();

        // checking if it is the last waypoint
        if($next_waypoint->next_address_id == $shipment->destination_address_id)
        {
            $shipment->status = "Out For Delivery";
            $shipment->update();
        }
    }
    dd("Waypoints updated. Check Database.");
})->name('shipments.update-waypoint');


















require __DIR__.'/auth.php';
